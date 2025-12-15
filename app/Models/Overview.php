<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    protected $fillable = [
        'media',
        'name',
        'counters_number',
        'message',
    ];
}
