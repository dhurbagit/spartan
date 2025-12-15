<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners;
use App\Http\Requests\PartnersRequest;
use App\Http\Controllers\BaseCrudController;

class PartnersController extends BaseCrudController
{
    protected $view_path = 'backend.partners.';  // matches your folder
    protected $route_path = 'partners';  // route group
    protected $model = Partners::class;
    protected $requestClass = PartnersRequest::class;
    protected $upload_path = 'partners';

    public function edit($id)
    {
        // Record to edit (for the form)
        $partners = $this->model::findOrFail($id);

        // List for the table (kept as $data)
        $data = $this->model::orderByDesc('id')->get();

        // Send both to the same view
        return view($this->view_path . 'index', compact('data', 'partners'));
    }
}
