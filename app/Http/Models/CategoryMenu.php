<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryMenu extends Model
{
    protected $table = 'category_menu';
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'category_id',
        'recipes_ar',
        'recipes_en',
        'image',
        'highlight',
        'highlight_alt',
        'image_alt',
        'menu_pdf',
        'created_at',
        'updated_at'
    ];
}
