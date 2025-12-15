<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VacancyApplication;
use App\Models\CustomerContact;

class DashboardController extends Controller
{
    public function index(){
        $VacancyApplication = VacancyApplication::count();
        $CustomerContact = CustomerContact::count();

        return view('backend.dashboard', compact('VacancyApplication', 'CustomerContact'));
    }
}
