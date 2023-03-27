<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('/clear/route', function () {
    Artisan::call('optimize');
    return "Caching Clear Done";
});

Route::get('/', "HomeController@index")->name("home");
Route::get('/catering', "ServiceEventController@index")->name('service_events.index');
Route::get('/category-menu/{category_id}', "CategoryController@index")->name('category_menu.index');
Route::get('/products', "ProductController@index")->name('products.index');
Route::get('/products/{sub_product_id}', "ProductController@viewProducts")->name('sub_products.index');
Route::get('/contact-us', "HomeController@contactUs")->name('contact_us');
Route::get('/about-us', "HomeController@aboutUs")->name('about_us');
Route::post('/send-contact', "HomeController@sendContactUs")->name('contactUs.post');
Route::post('/booking', 'BookingController@book')->name('event.book');
Route::get('/products-search', 'ProductController@search')->name('product_search');
Route::get('/downloadPDF/{id}', 'ServiceEventController@downloadPDF')->name('pdf.download');
Route::get('brochure', "HomeController@menu")->name('our_menu');
Route::get('/customProductCategoryItems', 'ProductController@getCustomProdCategoryItems')->name('products.custom_prod_cat');

Route::get('/email', function(){
    return view('template-email');
});

Route::get('/setLang/{lang}', function ($lang) {
    if (!in_array($lang, ['en', 'ar'])) {
        abort(404);
    }
    Session::put("locale", $lang);
    return redirect()->back();
})->name('change_lang');



$base_url = config('crudbooster.ADMIN_PATH');
Route::get('seo-home', "SEOController@get")->name('seo-home');
Route::get($base_url . '/pages/{id}', "PageInfoController@viewpage");
Route::post($base_url . '/sort', "SortingModelController@sorting");
Route::get($base_url . '/seo/{model}/{model_id?}', 'SEOController@get');
Route::post('/seo-store/{model}', 'SEOController@store');
Route::get($base_url . '/information/{model}', 'PageInfoController@get');
Route::post('/info-page-store/{model}', 'PageInfoController@store');
Route::get($base_url . '/viewpage/{page_id}', 'AdminPagesController@viewpage');



Route::get($base_url . '/languages', 'LanguageTranslationController@index')->name('languages');
Route::post('translations/update', 'LanguageTranslationController@transUpdate')->name('translation.update.json');
Route::post('translations/updateKey', 'LanguageTranslationController@transUpdateKey')->name('translation.update.json.key');
Route::delete('translations/destroy/{key}', 'LanguageTranslationController@destroy')->name('translations.destroy');
Route::post('translations/create', 'LanguageTranslationController@store')->name('translations.create');
//------------------------------------------------------//
//images manage
Route::get('admin/saveImagesModule', 'ImageController@saveImagesModule');
Route::get('admin/deleteImageModule/{id}', 'ImageController@deleteImageModule');
Route::get('admin/image/{fleet_id?}', "ImageController@index");
Route::get('image/upload', 'ImageController@fileCreate')->name('images.upload');
Route::post('image/upload/store/{fleet_id}', 'ImageController@fileStore');
Route::get('/image/delete/{id}', 'ImageController@fileDestroy');
Route::get('/image/showImageJson/{fleet_id?}', 'ImageController@showImageJson');
Route::get('/manage-image/resize/{width?}/{height?}/{img}', function ($width = 100, $height = 100, $img) {
    return \Image::make(public_path("$img"))->resize($width, $height)->response('jpg');
})->name('manage-image-resize')->where('img', '(.*)');

Route::get('/manage-image/crop/{width?}/{height?}/{img}', function ($width = 100, $height = 100, $img) {
    return \Image::make(public_path("$img"))->crop($width, $height)->response('jpg');
})->name('manage-image-crop')->where('img', '(.*)');
############ Added Routes ###########
Route::post('modules/sort', "SortingModelController@sorting");
