<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseCrudController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionMediaRequest;
use App\Models\PromotionMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionMediaController extends BaseCrudController
{
    protected $view_path = 'backend.promotion_media.';  // matches your folder
    protected $route_path = 'promotion-video';  // route group
    protected $model = PromotionMedia::class;
    protected $requestClass = PromotionMediaRequest::class;
    protected $upload_path = 'promotion_media';
    protected $redirect_to = '.edit';  // after create/update, go to edit page

    public function edit($id = null)
    {
        $data = $this->model::first();  // Get the first (and only) WelcomeMessage record
        return view($this->view_path . 'form', compact('data'));
    }
 

    public function update(Request $request, $id = null)
    {
        // Validate via your FormRequest (WelcomeMessageRequest, etc.)
        $data = $this->validateRequest($request);

        // Singleton target (ignore $id). If no row, create one.
        /** @var \Illuminate\Database\Eloquent\Model $record */
        $record = ($this->model)::query()->first() ?? new $this->model;

        // Map upload destinations (fallback: use same path for both)
        $mediaPath = property_exists($this, 'upload_path') ? $this->upload_path : 'uploads';
        $coverImagePath = property_exists($this, 'cover_upload_path') ? $this->cover_upload_path : $mediaPath;

        // Handle both file fields in a loop
        $fileFields = [
            'media' => $mediaPath,
            'cover_image' => $coverImagePath,
        ];

        foreach ($fileFields as $field => $path) {
            if ($request->hasFile($field)) {
                // delete old file if present
                if (!empty($record->{$field}) && Storage::disk('public')->exists($record->{$field})) {
                    Storage::disk('public')->delete($record->{$field});
                }
                // store new file
                $data[$field] = $request->file($field)->store($path, 'public');
            } else {
                // don’t overwrite with null when no new upload
                unset($data[$field]);
            }
        }

        // Save attributes
        $record->fill($data)->save();

        return redirect()
            ->route($this->route_path . '.edit')
            ->with('message', class_basename($this->model) . ' saved successfully.');
    }
}
