<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomersSays;
use App\Http\Requests\CustomersSaysRequest;
use App\Http\Controllers\BaseCrudController;

class CustomersSaysController extends BaseCrudController
{
    protected $view_path = 'backend.customer_says.';  // matches your folder
    protected $route_path = 'customer-says';  // route group
    protected $model = CustomersSays::class;
    protected $requestClass = CustomersSaysRequest::class;
    protected $upload_path = 'customer_says';
}
