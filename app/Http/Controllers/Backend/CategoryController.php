<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseCrudController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseCrudController
{
    protected $view_path = 'backend.category.';
    protected $route_path = 'category';
    protected $base_route = 'category.index';
    protected $model = Category::class;
    protected $requestClass = CategoryRequest::class;
    protected $upload_path = 'category';

    public function edit($id)
    {
        // Record to edit (for the form)
        $category = $this->model::findOrFail($id);

        // List for the table (kept as $data)
        $data = $this->model::orderByDesc('id')->get();

        // Send both to the same view
        return view($this->view_path . 'index', compact('data', 'category'));
    }
}
