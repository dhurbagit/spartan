 <?php

use App\Http\Controllers\Backend\BackgroundImageController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomersSaysController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\Backend\OverviewController;
use App\Http\Controllers\Backend\PartnersController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PromotionMediaController;
use App\Http\Controllers\Backend\SisterCompanyController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StoryController;
use App\Http\Controllers\Backend\UserProfileController;
use App\Http\Controllers\Backend\VacancyController;
use App\Http\Controllers\Backend\WelcomeMessageController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\backend\VacancyApplicationController;
use App\Http\Controllers\backend\CustomerContactController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




// Disable default register route (since you're using custom modal)
Auth::routes(['register' => true]);

// Fallback for 404
Route::fallback(fn() => redirect('/'));

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', DashboardController::class)->names('dashboard');

    // User profile routes (only needed ones)
    Route::singleton('profile', UserProfileController::class)->only(['edit', 'update'])->names('profile');
    Route::resource('/slider', SliderController::class)->names('slider');
    Route::post('slider-status', [SliderController::class, 'status'])->name('slider.status');
    Route::resource('/product', ProductController::class)->names('product');
    Route::post('product-status', [ProductController::class, 'status'])->name('product.status');
    Route::resource('/category', CategoryController::class)->names('category');
    Route::post('category-status', [CategoryController::class, 'status'])->name('category.status');
    Route::resource('/background-image', BackgroundImageController::class)->names('background-image');
    Route::post('background-image-status', [BackgroundImageController::class, 'status'])->name('background-image.status');
    Route::singleton('welcome-message', WelcomeMessageController::class)->only(['edit', 'update'])->names('welcome-message');
    Route::resource('overview', OverviewController::class)->names('overview');
    Route::resource('customer-says', CustomersSaysController::class)->names('customer-says');
    Route::post('customer-says-status', [CustomersSaysController::class, 'status'])->name('customer-says.status');
    Route::singleton('promotion-video', PromotionMediaController::class)->only(['edit', 'update'])->names('promotion-video');
    Route::resource('partners', PartnersController::class)->names('partners');
    Route::post('partners-status', [PartnersController::class, 'status'])->name('partners.status');
    Route::singleton('sisterCompany', SisterCompanyController::class)->only(['edit', 'update'])->names('sisterCompany');
    Route::singleton('story', StoryController::class)->only(['edit', 'update'])->names('story');
    Route::resource('gallery', GalleryController::class)->names('gallery');
    Route::post('gallery-status', [GalleryController::class, 'status'])->name('gallery.status');
    Route::resource('vacancy', VacancyController::class)->names('vacancy');
    Route::post('vacancy-status', [VacancyController::class, 'status'])->name('vacancy.status');
    Route::resource('menu', MenuController::class)->names('menu');
    Route::post('menu-status', [MenuController::class, 'status'])->name('menu.status');
    Route::post('updateMenu', [MenuController::class, 'updateMenuOrder'])->name('updateMenuOrder');
    Route::post('menu-status', [MenuController::class, 'status'])->name('menu.status');
    Route::singleton('site-setting', SiteSettingController::class)->only(['edit', 'update'])->names('site-setting');
    Route::get('vacancy-view', [VacancyApplicationController::class, 'index'])->name('vacancy-view.index');
    Route::get('vacancy-view/{id}', [VacancyApplicationController::class, 'edit'])->name('vacancy-view.edit');
    Route::put('vacancy-view/{id}', [VacancyApplicationController::class, 'update'])->name('vacancy-view.update');
    Route::delete('vacancy-view/{id}', [VacancyApplicationController::class, 'destroy'])->name('vacancy-view.destroy');
    Route::get('customer-contact', [CustomerContactController::class, 'index'])->name('customer-contact.index');
    Route::get('customer-contact/{id}', [CustomerContactController::class, 'edit'])->name('customer-contact.edit');
    Route::put('customer-contact/{id}', [CustomerContactController::class, 'update'])->name('customer-contact.update');
    Route::delete('customer-contact/{id}', [CustomerContactController::class, 'destroy'])->name('customer-contact.destroy');

});
require_once __DIR__.'/frontend.php';
