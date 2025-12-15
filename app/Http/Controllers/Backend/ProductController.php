<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseCrudController;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Models\Category;

class ProductController extends BaseCrudController
{

    protected $view_path = 'backend.product.';
    protected $route_path = 'product';
    protected $base_route = 'product.index';
    protected $model = Product::class;
    protected $requestClass  = ProductRequest::class;
    protected $upload_path = 'product';



    public function create(){
        $categories = Category::orderBy('name')->get();
        return view($this->view_path . 'form', compact('categories'));
    }

    public function edit($id){
         // Record to edit (for the form)
        $data = $this->model::findOrFail($id);

        // List for the table (kept as $data)
        $categories = Category::orderBy('name')->get();

        // Send both to the same view
        return view($this->view_path . 'form', compact('data', 'categories'));
    }
}
