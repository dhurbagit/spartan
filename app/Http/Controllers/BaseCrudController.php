<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BaseCrudController extends Controller
{

    protected $redirect_to = '.index'; // default

    public function index()
    {
        $data = $this->model::orderBy('id', 'desc')->get();
        if ($data->isEmpty()) {
            return view($this->view_path . 'index');
        }
        return view($this->view_path . 'index', compact('data'));
    }

    public function create()
    {
        return view($this->view_path . 'form');
    }

    protected function validateRequest(Request $request): array
    {
        /** @var \Illuminate\Foundation\Http\FormRequest $form */
        $form = app($this->requestClass);

        // Get rules / messages / attributes from the FormRequest
        $rules = method_exists($form, 'rules') ? $form->rules() : [];
        $messages = method_exists($form, 'messages') ? $form->messages() : [];
        $attributes = method_exists($form, 'attributes') ? $form->attributes() : [];

        // Build a validator that uses those custom messages
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        return $validator->validate();  // throws back with your custom messages on failure
    }

    public function store(Request $request)
    {

        // 1) Validate (your FormRequest class name is in $this->request)
        //    Make sure your rule is: 'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5120'
        $validated = $this->validateRequest($request);
        try {

            // 2) Remove empty image key if it exists but no file was uploaded
            if (!$request->hasFile('media')) {
                unset($validated['media']);  // keeps DB insert lean
            }

            // 3) If an image is present, store it (slow path only when needed)
            if ($request->hasFile('media')) {
                $validated['media'] = $request->file('media')->store($this->upload_path, 'public');
            }

            // Only process slug if the table has slug column.
            $table = (new $this->model)->getTable();

            if (Schema::hasColumn($table, 'slug')) {
                $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(6);
            } else {
                // Remove slug from data if table doesn't have the column
                unset($validated['slug']);
            }

            // 4) Create the record (wrap in a tiny transaction for safety)
            DB::transaction(function () use ($validated) {
                $this->model::create($validated);
            });

            // 5) Redirect (you chose .create; change to '.index' if you prefer list view)
            return redirect()
                ->route($this->route_path . $this->redirect_to)
                ->with('message', class_basename($this->model) . ' created successfully.');
        } catch (\Throwable $e) {
            // Log full details for debugging; show a friendly message to user
            Log::error('Create ' . class_basename($this->model) . ' failed', [
                'exception' => $e,
                'route_path' => $this->route_path,
            ]);
            dd($e->getMessage());
            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Sorry, something went wrong while creating ' . class_basename($this->model) . '.',
                ]);

        }
    }

    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        return view($this->view_path . 'form', compact('data'));
    }

    public function update(Request $request, $id = null)
    {
        // 1) Validate (your FormRequest class name is in $this->request)
        $validated = $this->validateRequest($request);

        try {
            $update = $this->model::findOrFail($id);

            // 2) Remove empty image key if it exists but no file was uploaded
            if (!$request->hasFile('media')) {
                unset($validated['media']);  // keeps DB update lean
            }

            // 3) If an image is present, store it (slow path only when needed)
            if ($request->hasFile('media')) {
                if (!empty($update->media) && \Storage::disk('public')->exists($update->media)) {
                    \Storage::disk('public')->delete($update->media);
                }
                $validated['media'] = $request->file('media')->store($this->upload_path, 'public');
            }

            // 4) Update the record (wrap in a tiny transaction for safety)
            DB::transaction(function () use ($update, $validated) {
                $update->update($validated);
            });

            // 5) Redirect (you chose .index; change to '.edit' if you prefer to stay on edit page)
            return redirect()
                ->route($this->route_path . '.index')
                ->with('message', class_basename($this->model) . ' updated successfully.');
        } catch (\Throwable $e) {
            // Log full details for debugging; show a friendly message to user
            Log::error('Update ' . class_basename($this->model) . ' failed', [
                'exception' => $e,
                'route_path' => $this->route_path,
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'message' => 'Sorry, something went wrong while updating ' . class_basename($this->model) . '.',
                ]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->model::findOrFail($id);

            if (method_exists($delete, 'getCascadeRelations')) {
            foreach ($delete->getCascadeRelations() as $relation) {
                if (method_exists($delete, $relation)) {
                    // Delete children via Eloquent to trigger their deleting events
                    $delete->{$relation}()->each(function ($child) {
                        $child->delete();
                    });
                }
            }
        }


            // Delete associated media file if exists
            if (!empty($delete->media) && \Storage::disk('public')->exists($delete->media)) {
                \Storage::disk('public')->delete($delete->media);
            }

            $delete->delete();

            return redirect()
                ->route($this->route_path . '.index')
                ->with('message', class_basename($this->model) . ' deleted successfully.');
        } catch (\Throwable $e) {
            // Log full details for debugging; show a friendly message to user
            Log::error('Delete ' . class_basename($this->model) . ' failed', [
                'exception' => $e,
                'route_path' => $this->route_path,
            ]);

            return back()
                ->withErrors([
                    'message' => 'Sorry, something went wrong while deleting ' . class_basename($this->model) . '.',
                ]);
        }
    }

    public function status(Request $request)
    {
        $update = $this->model::find($request->id);

        if ($update) {
            $input['status'] = $update->status ? 0 : 1;
            $update->update($input);
            return 'Status Updated!';
        } else {
            return 'Not found!';
        }
    }
}
