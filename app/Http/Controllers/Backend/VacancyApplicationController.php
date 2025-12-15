<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacancyApplicationRequest;
use App\Models\VacancyApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class VacancyApplicationController extends Controller
{
    public function index()
    {
        $vacancy = VacancyApplication::orderBy('id', 'DESC')->get();
        return view('backend.vacancy_application.index', compact('vacancy'));
    }

    public function store(VacancyApplicationRequest $request)
    {
        // Validate first (if error → stops here)
        $data = $request->validated();
        unset($data['vacancy_id']);

        DB::beginTransaction();

        try {
            // Handle file upload (inside transaction)
            if ($request->hasFile('media')) {
                $path = $request->file('media')->store('applications', 'public');
                $data['media'] = $path;
            }

            // Save to database
            VacancyApplication::create($data);

            DB::commit();  // Everything OK → save

            return back()
                ->with('success_message', 'Thank you for applying! We will contact you soon.')
                ->with('open_modal', $request->vacancy_id);
        } catch (\Throwable $e) {
            DB::rollBack();  // ❌ Stop database insert

            // Delete uploaded file if it was uploaded before error
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return back()
                ->withInput()
                ->with(['error' => 'Something went wrong, please try again.']);
        }
    }

    public function edit($id)
    {
        $VacancyApplication = VacancyApplication::find($id);
        return view('backend.vacancy_application.reply_email', compact('VacancyApplication'));
    }

    public function update(Request $request, $id)
    {
        $application = VacancyApplication::findOrFail($id);

        // 1) Validate input
        $request->validate([
            'reply_email' => ['required', 'email'],
            'vacancy_reply' => ['required', 'string'],
        ]);
        $subject = 'Response to Your Job Application';
        Mail::send('backend.vacancy_application.vacancy_template', [
            'reply' => $request->vacancy_reply,
            'applicantName' => $application->name ?? null,
            'jobTitle' => $application->jobTitle ?? null,  // if you have it
            'companyName' => config('app.name'),
            'senderName' => 'HR Department',
            'senderPosition' => 'Human Resources',
            'supportEmail' => config('mail.from.address'),
            'subject' => $subject,
        ], function ($message) use ($request) {
            $message
                ->to($request->reply_email)
                ->subject('Response to Your Job Application');
        });

        return back()->with('message', 'Reply sent successfully.');
    }

    public function destroy($id)
    {
        $application = VacancyApplication::findOrFail($id);
        $application->delete();  // model will handle media delete

        return back()->with('message', 'Vacancy application deleted successfully.');
    }
}
