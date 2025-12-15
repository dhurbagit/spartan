<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseCrudController;
use App\Http\Controllers\Controller;
use App\Http\Requests\BackgroundImageRequest;
use App\Models\BackgroundImage;
use Illuminate\Http\Request;

class BackgroundImageController extends BaseCrudController
{
    protected $view_path = 'backend.background_image.';  // matches your folder
    protected $route_path = 'background-image';  // route group
    //protected $base_route = 'background_image.index';  // index route
    protected $model = BackgroundImage::class;
    protected $requestClass = BackgroundImageRequest::class;
    protected $upload_path = 'background_image';

    public function edit($id)
    {
        // Record to edit (for the form)
        $background_image = $this->model::findOrFail($id);

        // List for the table (kept as $data)
        $data = $this->model::orderByDesc('id')->get();

        // Send both to the same view
        return view($this->view_path . 'index', compact('data', 'background_image'));
    }
}
