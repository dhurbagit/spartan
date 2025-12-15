<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersSays extends Model
{
    protected $table = 'customers_says';

    protected $fillable = [
        'name',
        'position',
        'message',
        'media',
        'status',
    ];
}
