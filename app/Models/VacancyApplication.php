<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class VacancyApplication extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'media',
        'job_title',
    ];

    // Automatically delete media file when record is deleted
    protected static function booted()
    {
        static::deleting(function (VacancyApplication $application) {
            if (!empty($application->media) && Storage::disk('public')->exists($application->media)) {
                Storage::disk('public')->delete($application->media);
            }
        });
    }
}
