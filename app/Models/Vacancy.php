<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'jobTitle',
        'location',
        'jobType',
        'expireDate',
        'description',
        'status',
    ];
}
