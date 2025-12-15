<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Controllers\BaseCrudController;
use App\Http\Requests\SliderRequest;

class SliderController extends BaseCrudController
{
    protected $view_path = 'backend.slider.';
    protected $route_path = 'slider';
    protected $base_route = 'slider.index';
    protected $model = Slider::class;
    protected $requestClass  = SliderRequest::class;
    protected $upload_path = 'sliders';



    // protected $folder = 'slider';
    // protected $file_name = 'image';
    // protected $thumb = ['200', '400'];
    // protected $width = 1920;
    // protected $height = 1080;

    // protected $base_route = 'slider.index';
    // protected $title;
    // protected $folder_path;
    // protected $file_path;
    // protected $file_delete_path;
    // protected $thumb_path;
    // protected $thumb_delete_path;
    // protected $thumb_width = 200;
    // protected $thumb_height = 200;
    // protected $thumb2_width = 400;
    // protected $thumb2_height = 400;
    // protected $storage;
    // protected $disk;
    // protected $image;
    // protected $file;
    // protected $file_size = 1048576; // 1MB
    // protected $file_type = ['jpg', 'jpeg', 'png', 'gif', 'webp'];


}
