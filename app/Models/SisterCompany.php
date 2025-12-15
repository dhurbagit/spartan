<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SisterCompany extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'cover_image_one',
        'cover_image_two',
        'cover_title_one',
        'cover_title_two',
        'link_one',
        'link_two',
    ];
}
