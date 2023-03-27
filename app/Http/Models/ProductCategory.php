<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model
{
    protected $table = 'product_category';

    protected $fillable = [
        'id',
        'name',
        'image',
        'image_alt',
        'active',
        'sorting',
        'has_sub_category'
    ];

    public function subProductCategories()
    {
        return $this->hasMany(SubProductCategory::class);
    }

    public function products(){
        return $this->hasMany(SubProductCategoryInfo::class);
    }
}
