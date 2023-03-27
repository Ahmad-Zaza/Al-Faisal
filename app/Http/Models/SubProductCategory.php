<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class SubProductCategory extends Model
{
    protected $table = 'sub_product_category';

    protected $fillable = [
        'id',
        'product_category_id',
        'name',
        'image',
        'image_alt',
        'active',
        'sorting'
    ];

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function subProductCategoryInfos(){
        return $this->hasMany(SubProductCategoryInfo::class);
    }
}
