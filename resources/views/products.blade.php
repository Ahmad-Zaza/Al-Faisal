@extends('layouts.app')


@php
$title = '';
foreach ($seo as $s) {
    if ($s->model == 'products') {
        $title = $s["title_$lang"];
    }
}
@endphp
@section('title', $title)

@section('content')
    <div class="super-product-main">
        <section class="all-prod_section">
            <div class="main-category-munu">
                <section class="menu-cover-section">
                    <div class="container-fluid cat-menu-cover inner-highlight-container" style="padding: 0;">
                        <img class="category-main-menu-img inner-highlight-img" src="{{ asset($Highlight['image']) }}"
                            alt="{{ $Highlight['image_alt'] }}" loading="lazy">
                        <h5 class="category-overlay-text">
                            {{ Config::get('app.locale') == 'en' ? 'Products' : 'منتجاتنا' }}
                        </h5>
                        <div class="overlay-cover-light"></div>
                        <ol class="breadcrumb highlight-overlay-text">
                            <li>
                                <a class="breadcrumb-item breadcrumb-item-home" href="{{ route('home') }}">
                                    {{ Config::get('app.locale') == 'en' ? 'Home' : 'الرئيسية' }}
                                </a>
                            </li>
                            <li><span
                                    class="fa fasl fa-angle-double-{{ Config::get('app.locale') == 'en' ? 'right' : 'left' }}"></span>
                            </li>
                            <li>
                                <p class="breadcrumb-item current-breadcrumb-item">
                                    {{ Config::get('app.locale') == 'en' ? 'Products' : 'منتجاتنا' }}
                                </p>
                            </li>
                        </ol>
                    </div>
                </section>
            </div>
            <div class="container main-products-container">
                <div class="row">
                    <div class="col-3 col-fluid pg-dark">
                        <div
                            class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 flex-prod-nav">
                            <li class="f-nav-sub-prod {{ $all == 1 ? 'active-sub-cat' : '' }}">
                                <a href="{{ route('products.index') }}"
                                    class="nav-link prod-nav-link main-prod-nav-link px-0 align-middle">
                                    {{ __('all_pro') }}
                                </a>
                            </li>
                            <div class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start ul-fluid"
                                id="menu">
                                @foreach ($product_categories as $key => $product_category)
                                    @if ($product_category['has_sub_category'] == 1)
                                        <div class="nav-sub-prod">
                                            <h4 class="nav-link prod-nav-link px-0 align-middle ">
                                                {{ $product_category["name_$lang"] }}
                                            </h4>
                                            <ul class="collapse nav flex-column ms-1 show" id="submenu{{ $key }}">
                                                @foreach ($product_category->subProductCategories as $key1 => $sub_product_category)
                                                    <li
                                                        class="w-100 sub-prod-nav-link {{ $sub_product_id ? ($sub_product_id == $sub_product_category->id ? 'active-sub-cat' : '') : '' }}">
                                                        <a href="{{ route('sub_products.index', [$sub_product_category['id']]) }}"
                                                            class="nav-link sub-prod-nav-link px-0">
                                                            {{ $sub_product_category["name_$lang"] }} (
                                                            {{ sizeof($sub_product_category->subProductCategoryInfos) }}
                                                            )
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <div class="nav-sub-prod">
                                            <h4
                                                class="nav-link prod-nav-link px-0 align-middle {{ request()->get('prod_cat_id') == $product_category['id'] ? 'active-catergory-link' : '' }}">
                                                {{ $product_category["name_$lang"] }}
                                            </h4>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col display-prod-col">
                        <div class="container">
                            @if ($product_details)
                                <div class="row products-display-row">

                                    <div class="product-card" style="width: 18rem;">
                                        <h5 class="h-catalog-title">{{ __('pro_catalog') }}</h5>
                                    </div>
                                    <div class="product-card" style="width: 18rem;">
                                        <form class="d-flex input-group search-form-prods"
                                            action="{{ route('products.index', ['searchText' => $search]) }}"
                                            method="GET">
                                            <input class="form-control nav-search-item" type="search" name="searchText"
                                                placeholder="{{ __('prod_search_placeholder') }}" aria-label="Search"
                                                value="{{ request()->get('searchText') }}" />
                                            <button class="btn btn-primary nav-search-button" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="product-card select-category-responsive"
                                        style="display: none; width: 18rem;">
                                        <select id="tdcategory" class="tdcategory-form" name="search_type_id"
                                            onchange="window.location.href=this.options[this.selectedIndex].value;">
                                            <option value="{{ route('products.index') }}"
                                                {{ $all == 1 ? 'selected' : '' }}>
                                                {{ __('all_pro') }}</option>
                                            @foreach ($product_categories as $key => $product_category)
                                                @if ($product_category['has_sub_category'] == 1)
                                                    <optgroup label="{{ $product_category["name_$lang"] }}">
                                                        @foreach ($product_category->subProductCategories as $key1 => $sub_product_category)
                                                            <option
                                                                value="{{ route('sub_products.index', [$sub_product_category['id']]) }}"
                                                                {{ $sub_product_id ? ($sub_product_id == $sub_product_category->id ? 'selected' : '') : '' }}>
                                                                {{ $sub_product_category["name_$lang"] }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @else
                                                    <option
                                                        value="{{ route('products.index', ['prod_cat_id' => $product_category['id'], 'type' => 'type2']) }}"
                                                        style="font-weight: bold;"
                                                        {{ $selected == $product_category["name_$lang"] ? 'selected' : '' }}>
                                                        {{ $product_category["name_$lang"] }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @if (!count($product_details))
                                        <h3 class="text-center not-found-prod-message">{{ __('no_products_founded') }}</h3>
                                    @endif
                                    <div id="lightgallery" class="products-display-row">
                                        @foreach ($product_details as $key => $product_detail)
                                            <div class="product-card" style="width: 18rem;">
                                                @if ($product_detail['image'])
                                                    <a data-src="{{ asset($product_detail['image']) }}"
                                                        class="gallery_item" target="_blank" data-lg-size="1600-2400">
                                                        <img class="product-img"
                                                            src="{{ asset($product_detail['image']) }}"
                                                            alt="{{ $product_detail['image_alt'] }}" loading="lazy">
                                                    </a>
                                                @else
                                                    <a data-src="{{ asset('/images/no-photo-img.jpg') }}"
                                                        class="gallery_item1" target="_blank" data-lg-size="1600-2400">
                                                        <img class="product-img"
                                                            src="{{ asset('img/covers/no-photo-img.jpg') }}"
                                                            alt="default_prod" loading="lazy">
                                                    </a>
                                                @endif

                                                <div class="card-body">
                                                    <p class="card-text product-card-title">
                                                        {{ $product_detail["title_$lang"] }}
                                                    </p>
                                                    {{-- <p class="card-text product-card-text">
                                                {{ $product_detail["description_$lang"] }}
                                            </p> --}}
                                                </div>
                                            </div>
                                        @endforeach
                                        @if (count($product_details) % 2 == 1)
                                            <div class="product-card" style="width: 18rem;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="likns-row">
                                    @if (request()->get('prod_cat_id'))
                                        {{ $product_details->appends(['prod_cat_id' => request()->get('prod_cat_id')])->links() }}
                                    @else
                                        {{ $product_details->links() }}
                                    @endif

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endsection
