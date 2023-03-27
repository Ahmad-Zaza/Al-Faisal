<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\CategoryMenu;
use App\Http\Models\MainInformations;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{
    public function index($id)
    {
        $lang = App::getLocale();
        $category = Category::where('id', '=', $id)->first();
        $sorting = $category['sorting'];
        $next_category = Category::where('sorting', '=', ($sorting + 1))->first();
        $prev_category  = Category::where('sorting', '=', ($sorting - 1))->first();
        $mainInformations = MainInformations::first();
        $catering_categories = Category::orderBy('sorting')->get();
        $category_menus = CategoryMenu::where('category_id', '=', $id)
        ->orderBy('sorting')
        ->get();

        return view('category_menu', compact(['lang', 'category','mainInformations' ,'category_menus','catering_categories', 'next_category', 'prev_category']));
    }
}
