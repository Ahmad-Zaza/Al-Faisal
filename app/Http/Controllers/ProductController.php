<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\CategoryMenu;
use App\Http\Models\MainInformations;
use App\Http\Models\ProductCategory;
use App\Http\Models\SectionArera;
use App\Http\Models\SiteMenu;
use App\Http\Models\SubProductCategory;
use App\Http\Models\SubProductCategoryInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    protected $paginateNumber = 10;
    public function index()
    {
        // query params
        $lang = App::getLocale();
        $search = request()->searchText ?? null;
        $prod_cat_id = request()->prod_cat_id ?? null;
        $type = request()->type;
        $selected = null;
        $catering_categories = Category::orderBy('sorting')->get();
        $mainInformations = MainInformations::first();
        // to check there is no search text coming with request to view
        $Highlight = SectionArera::where('section_id', '=', 10)->first();
        $product_categories = ProductCategory::with('subProductCategories')
            ->orderBy('sorting')
            ->get();
        if ($search) {
            $all = false;
            $product_details = SubProductCategoryInfo::where('title_ar', 'LIKE', "%{$search}%")
                ->orWhere('title_en', 'LIKE', "%{$search}%")
                ->orderBy("image", 'desc')
                ->paginate($this->paginateNumber)
                ->appends(request()->query());
        } elseif ($prod_cat_id) {
            $sub_prod_ids_array = SubProductCategoryInfo::subProductCategoriesBelongsToMainProductCategory($prod_cat_id);
            $product_details = SubProductCategoryInfo::whereIn('sub_product_category_id', $sub_prod_ids_array)
                ->paginate($this->paginateNumber)
                ->appends(request()->query());
        } else {
            $all = true;
            $product_details = SubProductCategoryInfo
                ::select("*")
                ->orderBy("image", 'desc')
                ->inRandomOrder('1234')
                ->paginate($this->paginateNumber)
                ->appends(request()->query());
        }
        return view('products', compact(['lang', 'mainInformations', 'product_categories', 'catering_categories', 'Highlight', 'product_details', 'all', 'selected']));
    }

    public function viewProducts($prod_id)
    {
        $product_comparing_id = SubProductCategory::where('id', '=', $prod_id)->first()['product_category_id'];
        $sub_product_id = $prod_id;
        $lang = App::getLocale();
        $catering_categories = Category::orderBy('sorting')->get();
        $mainInformations = MainInformations::first();
        $Highlight = SectionArera::where('section_id', '=', 10)->first();
        $product_categories = ProductCategory::with('subProductCategories', 'subProductCategories.subProductCategoryInfos')
            ->orderBy('sorting')
            ->get();
        $product_details = SubProductCategoryInfo
            ::where('sub_product_category_id', '=', $prod_id)
            ->orderBy("image", 'desc')
            ->paginate($this->paginateNumber);

        return view('products', compact(['lang', 'mainInformations', 'product_categories', 'product_details', 'catering_categories', 'Highlight', 'product_comparing_id', 'sub_product_id']));
    }

    public function search(Request $request)
    {
        $lang = App::getLocale();
        $catering_categories = Category::orderBy('sorting')->get();
        $mainInformations = MainInformations::first();
        $Highlight = SectionArera::where('section_id', '=', 10)->first();
        $product_categories = ProductCategory::with('subProductCategories')
            ->orderBy('sorting')
            ->get();
        $search = $request->search;
        $product_details = SubProductCategoryInfo::where('title_ar', 'LIKE', "%{$search}%")
            ->orWhere('title_en', 'LIKE', "%{$search}%")
            ->orderBy("image", 'desc')
            ->paginate($this->paginateNumber);
        return view('products', compact(['lang', 'mainInformations', 'product_categories', 'Highlight', 'product_details', 'catering_categories']));
    }

}
