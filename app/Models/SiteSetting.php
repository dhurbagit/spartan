<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'media',
        'footer_message',
        'facebook',
        'instagram',
        'tiktok',
        'youtube',
        'phone_no',
        'mobile_no',
        'email',
        'zip_code',
        'location',
        'google_map'
    ];

}
