<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'image',
        'image_alt',
        'active',
        'sorting',
        'created_at',
        'updated_at'
    ];
}
