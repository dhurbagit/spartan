<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SisterCompanyRequest;
use App\Models\SisterCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SisterCompanyController extends Controller
{
    protected $view_path = 'backend.sister_company.';  // matches your folder
    protected $route_path = 'sisterCompany';  // route group
    protected $model = SisterCompany::class;
    protected $requestClass = SisterCompanyRequest::class;
    protected $upload_path = 'sister_company';
    protected $redirect_to = '.edit';  // after create/update, go to edit page

    public function edit($id = null)
    {
        $data = $this->model::first();  // Get the first (and only) WelcomeMessage record
        return view($this->view_path . 'form', compact('data'));
    }

    public function update(SisterCompanyRequest $request, $id = null)
    {
        $validated = $request->validated();

        $record = $this->model::query()->first() ?? new $this->model;

        foreach (['cover_image_one', 'cover_image_two'] as $field) {
            if ($request->hasFile($field)) {
                if (!empty($record->{$field})) {
                    Storage::disk('public')->delete($record->{$field});
                }
                $validated[$field] = $request->file($field)->store($this->upload_path, 'public');
            } else {
                unset($validated[$field]);
            }
        }

        $record->fill($validated)->save();

        return redirect()
            ->route('sisterCompany.edit')
            ->with('message', 'Updated successfully.');
    }
}
