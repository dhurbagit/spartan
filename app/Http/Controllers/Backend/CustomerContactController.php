<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerContactRequest;
use App\Models\CustomerContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerContactController extends Controller
{
    public function index()
    {
        $CustomerContact = CustomerContact::orderBy('id', 'DESC')->get();
        return view('backend.customer_contact.index', compact('CustomerContact'));
    }

    public function store(CustomerContactRequest $request)
    {
        $data = $request->validated();
        CustomerContact::create($data);
        return back()
            ->with('success_message', 'Thank you for applying! We will contact you soon.');
    }

    public function edit($id)
    {
        $CustomerContact = CustomerContact::find($id);
        return view('backend.customer_contact.mail_reply', compact('CustomerContact'));
    }

    public function update(Request $request, $id)
    {
        $application = CustomerContact::findOrFail($id);

        // 1) Validate input
        $request->validate([
            'reply_email' => ['required', 'email'],
            'customer_reply' => ['required', 'string'],
        ]);
        $subject = 'Response to Your Customer Application';
        Mail::send('backend.customer_contact.customer_template', [
            'reply' => $request->customer_reply,
            'applicantName' => $application->name ?? null,
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
        $application = CustomerContact::findOrFail($id);
        $application->delete();  // model will handle media delete

        return back()->with('message', 'Customer application deleted successfully.');
    }
}
