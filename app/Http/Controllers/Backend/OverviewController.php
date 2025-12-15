<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Overview;
use App\Http\Requests\OverviewRequest;
use App\Http\Controllers\BaseCrudController;

class OverviewController extends BaseCrudController
{
    protected $view_path = 'backend.overview.';  // matches your folder
    protected $route_path = 'overview';  // route group
    protected $model = Overview::class;
    protected $requestClass = OverviewRequest::class;
    protected $upload_path = 'overview';


    public function edit($id = null)
    {
        // Record to edit (for the form)
        $overviews = $this->model::findOrFail($id);

        // List for the table (kept as $data)
        $data = $this->model::orderByDesc('id')->get();

        // Send both to the same view
        return view($this->view_path . 'index', compact('data', 'overviews'));
    }
}
