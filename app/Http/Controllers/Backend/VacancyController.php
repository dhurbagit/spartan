<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseCrudController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Http\Requests\VacancyRequest;

class VacancyController extends BaseCrudController
{
    protected $view_path = 'backend.vacancy.';  // matches your folder
    protected $route_path = 'vacancy';  // route group
    protected $model = Vacancy::class;
    protected $requestClass = VacancyRequest::class;
    protected $upload_path = 'vacancy';
}
