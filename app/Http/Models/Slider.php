<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';

    protected $fillable = [
        'id',
        'first_title_ar',
        'second_title_ar',
        'first_title_en',
        'second_title_en',
        'section_id',
        'url',
        'image',
        'image_alt',
        'slider_number',
        'sorting',
        'active'
    ];

}
