<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name', 'address', 'city', 'country', 'phone', 'email', 'description'
    ];
}
