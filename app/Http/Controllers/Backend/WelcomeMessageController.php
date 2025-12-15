<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseCrudController;
use App\Http\Controllers\Controller;
use App\Http\Requests\WelcomeMessageRequest;
use App\Models\WelcomeMessage;
use Illuminate\Http\Request;

class WelcomeMessageController extends BaseCrudController
{
    protected $view_path = 'backend.welcome_message.';  // matches your folder
    protected $route_path = 'welcome-message';  // route group
    protected $model = WelcomeMessage::class;
    protected $requestClass = WelcomeMessageRequest::class;
    protected $upload_path = 'welcome_message';
    protected $redirect_to = '.edit';  // after create/update, go to edit page

    public function edit($id = null)
    {
        $data = $this->model::first();  // Get the first (and only) WelcomeMessage record
        return view($this->view_path . 'form', compact('data'));
    }

    public function update(Request $request, $id = null)
    {
        $data = $this->validateRequest($request);

        $record = ($this->model)::query()->first() ?? new $this->model;

        if ($request->hasFile('media')) {
            if (!empty($record->media)) {
                \Storage::disk('public')->delete($record->media);
            }
            $data['media'] = $request->file('media')->store($this->upload_path, 'public');
        } else {
            unset($data['media']);
        }

        $record->fill($data)->save();

        return redirect()
            ->route($this->route_path . '.edit')
            ->with('message', class_basename($this->model) . ' saved successfully.');
    }
}
