<?php

namespace App\Http\Controllers;

use App\Models\BackgroundImage;
use App\Models\Category;
use App\Models\CustomersSays;
use App\Models\Menu;
use App\Models\Overview;
use App\Models\Partners;
use App\Models\Product;
use App\Models\PromotionMedia;
use App\Models\SisterCompany;
Use App\Models\Slider;
use App\Models\Story;
use App\Models\WelcomeMessage;
use App\Models\Vacancy;
use App\Models\Gallery;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $menu = Menu::firstWhere('category_slug', 'home');
        $sliders = Slider::where('status', 1)->get();
        $welcome_message = WelcomeMessage::first();
        $over_view = Overview::all();
        $our_products = Product::where('status', 1)->inRandomOrder()->get();
        $backgroundImage = BackgroundImage::where('status', 1)->inRandomOrder()->get();
        $customersSays = CustomersSays::where('status', 1)->inRandomOrder()->get();
        $promotionMedia = PromotionMedia::first();
        $partners = Partners::where('status', 1)->get();
        $sisterCompany = SisterCompany::first();


        return view('frontend.index', compact(
            'menu',
            'sliders',
            'welcome_message',
            'over_view',
            'our_products',
            'backgroundImage',
            'customersSays',
            'promotionMedia',
            'partners',
            'sisterCompany'
        ));
    }

    public function category($slug)
    {
        $menus = Menu::firstWhere('category_slug', $slug);

        switch ($slug) {
            case 'home':
                return redirect()->route('index');
                break;
            case 'our_products':
                 $menu = $menus;
                $backgroundImage = BackgroundImage::where('status', 1)->inRandomOrder()->get();
                $categories = Category::where('status', 1)
                    ->whereHas('products', function ($q) {
                        $q->where('status', 1);
                    })
                    ->get();

                $products = Product::with('category')
                    ->where('status', 1)
                    ->get();
                return view('frontend.product', compact('menu', 'backgroundImage', 'categories', 'products'));
                break;
            case 'about_us':
                $menu = $menus;
                $story = Story::first();
                $backgroundImage = BackgroundImage::where('status', 1)->inRandomOrder()->get();
                $our_products = Product::where('status', 1)->inRandomOrder()->get();
                $partners = Partners::where('status', 1)->get();
                $over_view = Overview::all();
                $customersSays = CustomersSays::where('status', 1)->inRandomOrder()->get();
                return view('frontend.about', compact('menu', 'story', 'backgroundImage', 'our_products', 'partners', 'over_view', 'customersSays'));
                break;
            case 'album':
                $menu = $menus;
                $gallery = Gallery::where('status', 1)->latest()->get();
                return view('frontend.gallery', compact('menu', 'gallery'));
                break;
            case 'career':
                $menu = $menus;
                $vacancy = Vacancy::where('status', 1)->get();
                return view('frontend.vacancy', compact('menu', 'vacancy'));
                break;
            case 'contact_us':
                $menu = $menus;
                return view('frontend.contact', compact('menu'));
                break;
            default:
                return 'Not Found';
        }
    }

    public function page(){
        return 'Service Not Available';
    }
}
