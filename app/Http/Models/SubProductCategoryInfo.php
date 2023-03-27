<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class SubProductCategoryInfo extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'id',
        'sub_product_category_id',
        'product_category_id',
        'title_ar',
        'title_en',
        'image',
        'image_alt'
    ];

    public function subProductCategory(){
        return $this->belongsTo(SubProductCategory::class, 'sub_product_category_id');
    }

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public static function subProductCategoriesBelongsToMainProductCategory($prod_cat_id){
        $sub_prod_cat_ids = array();
        $data =  SubProductCategory::where('product_category_id', '=', $prod_cat_id)->get();
        foreach($data as $item){
            array_push($sub_prod_cat_ids, $item->id);
        }
        return $sub_prod_cat_ids;
    }
}
