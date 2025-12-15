<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\backend\VacancyApplicationController;
use App\Http\Controllers\backend\CustomerContactController;

Route::get('/', function(){
   return view('frontend.index');
});

Route::get('/',[FrontendController::class, 'index'])->name('index');
Route::get('content/{title}', [FrontendController::class, 'page'])->name('page');
Route::get('{category}', [FrontendController::class, 'category'])->name('category');
Route::post('career-application', [VacancyApplicationController::class, 'store'])->name('application.store');
Route::post('customer', [CustomerContactController::class, 'store'])->name('customer.store');

