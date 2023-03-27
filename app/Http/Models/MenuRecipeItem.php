<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MenuRecipeItem extends Model
{
    protected $table = 'menu_recipe_item';

    protected $fillable = [
        'id', 
        'name_ar',
        'name_en',
        'category_menu_id',
        'created_at',
        'updated_at'
    ];
}
