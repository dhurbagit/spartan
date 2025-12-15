<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseCrudController;
use App\Models\Gallery;
use App\Http\Requests\GalleryRequest;

class GalleryController extends BaseCrudController
{
    protected $view_path = 'backend.gallery.';  // matches your folder
    protected $route_path = 'gallery';  // route group
    protected $model = Gallery::class;
    protected $requestClass = GalleryRequest::class;
    protected $upload_path = 'gallery';

    public function edit($id)
    {
        // Record to edit (for the form)
        $gallery = $this->model::findOrFail($id);

        // List for the table (kept as $data)
        $data = $this->model::orderByDesc('id')->get();

        // Send both to the same view
        return view($this->view_path . 'index', compact('data', 'gallery'));
    }
}
