<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'name',
        'species',
        'age',
        'status',
        'description',
        'image_path'
    ];
}
