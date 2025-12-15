<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title_1',
        'title_2',
        'description',
        'media',
        'status',
    ];
}
