<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseCrudController;
use App\Models\Story;
use App\Http\Requests\StoryRequest;

class StoryController extends BaseCrudController
{

    protected $view_path = 'backend.story.';  // matches your folder
    protected $route_path = 'story';  // route group
    protected $model = Story::class;
    protected $requestClass = StoryRequest::class;
    protected $upload_path = 'story';
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
