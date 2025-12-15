<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Http\Requests\SiteSettingRequest;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    protected $view_path = 'backend.site_setting.';  // matches your folder
    protected $route_path = 'site-setting';  // route group
    protected $model = SiteSetting::class;
    protected $requestClass = SiteSettingRequest::class;
    protected $upload_path = 'site_setting';
    protected $redirect_to = '.edit';  // after create/update, go to edit page

    public function edit($id = null)
    {
        $data = $this->model::first();  // Get the first (and only) WelcomeMessage record
        return view($this->view_path . 'form', compact('data'));
    }

    public function update(SiteSettingRequest $request, $id = null)
    {
        $validated = $request->validated();

        $record = $this->model::query()->first() ?? new $this->model;

        foreach (['media'] as $field) {
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
            ->route('site-setting.edit')
            ->with('message', 'Updated successfully.');
    }
}
