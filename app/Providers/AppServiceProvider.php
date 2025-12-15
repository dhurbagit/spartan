<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Paginator::useBootstrapFive();  // For Bootstrap 5
        $menus = Menu::query()
            ->whereNull('parent_id')  // Fetch only parent menus
            ->whereNotIn('header_footer', [2])  // Exclude integer value 1
            ->select('id', 'menu_name', 'parent_id', 'external_link', 'category_slug', 'position', 'status', 'title_slug', 'metaTitle', 'metaDescription', 'metaKeyword')
            ->with([
                'children' => function ($query) {
                    $query
                        ->select('id', 'menu_name', 'parent_id', 'external_link', 'category_slug', 'title_slug', 'status')
                        ->whereNotIn('header_footer', [2])  // Exclude integer value 1 for children
                        ->orderBy('position', 'ASC');
                }
            ])
            ->orderBy('position', 'ASC')
            ->get();

        View::share('menus', $menus);

        $footermenus = Menu::query()
            ->whereNull('parent_id')  // Fetch only parent menus
            ->whereNotIn('header_footer', [1])  // Exclude integer value 1
            ->select('id', 'menu_name', 'parent_id', 'external_link', 'category_slug', 'position', 'status', 'title_slug')
            ->with([
                'children' => function ($query) {
                    $query
                        ->select('id', 'menu_name', 'parent_id', 'external_link', 'category_slug', 'title_slug', 'status')
                        ->whereNotIn('header_footer', [1])  // Exclude integer value 1 for children
                        ->orderBy('position', 'ASC');
                }
            ])
            ->orderBy('position', 'ASC')
            ->get();

        View::share('footermenus', $footermenus);

        $site_setting = SiteSetting::first();
        view()->share('site_setting', $site_setting);


    }
}
