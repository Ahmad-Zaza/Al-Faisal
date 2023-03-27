<?php
$title = '';
foreach ($seo as $s) {
    if ($s->model == 'products') {
        $title = $s["title_$lang"];
    }
}
?>
<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
    <div class="super-product-main">
        <section class="all-prod_section">
            <div class="main-category-munu">
                <section class="menu-cover-section">
                    <div class="container-fluid cat-menu-cover inner-highlight-container" style="padding: 0;">
                        <img class="category-main-menu-img inner-highlight-img" src="<?php echo e(asset($Highlight['image'])); ?>"
                            alt="<?php echo e($Highlight['image_alt']); ?>" loading="lazy">
                        <h5 class="category-overlay-text">
                            <?php echo e(Config::get('app.locale') == 'en' ? 'Products' : 'منتجاتنا'); ?>

                        </h5>
                        <div class="overlay-cover-light"></div>
                        <ol class="breadcrumb highlight-overlay-text">
                            <li>
                                <a class="breadcrumb-item breadcrumb-item-home" href="<?php echo e(route('home')); ?>">
                                    <?php echo e(Config::get('app.locale') == 'en' ? 'Home' : 'الرئيسية'); ?>

                                </a>
                            </li>
                            <li><span
                                    class="fa fasl fa-angle-double-<?php echo e(Config::get('app.locale') == 'en' ? 'right' : 'left'); ?>"></span>
                            </li>
                            <li>
                                <p class="breadcrumb-item current-breadcrumb-item">
                                    <?php echo e(Config::get('app.locale') == 'en' ? 'Products' : 'منتجاتنا'); ?>

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
                            <li class="f-nav-sub-prod <?php echo e($all == 1 ? 'active-sub-cat' : ''); ?>">
                                <a href="<?php echo e(route('products.index')); ?>"
                                    class="nav-link prod-nav-link main-prod-nav-link px-0 align-middle">
                                    <?php echo e(__('all_pro')); ?>

                                </a>
                            </li>
                            <div class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start ul-fluid"
                                id="menu">
                                <?php $__currentLoopData = $product_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($product_category['has_sub_category'] == 1): ?>
                                        <div class="nav-sub-prod">
                                            <h4 class="nav-link prod-nav-link px-0 align-middle ">
                                                <?php echo e($product_category["name_$lang"]); ?>

                                            </h4>
                                            <ul class="collapse nav flex-column ms-1 show" id="submenu<?php echo e($key); ?>">
                                                <?php $__currentLoopData = $product_category->subProductCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $sub_product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li
                                                        class="w-100 sub-prod-nav-link <?php echo e($sub_product_id ? ($sub_product_id == $sub_product_category->id ? 'active-sub-cat' : '') : ''); ?>">
                                                        <a href="<?php echo e(route('sub_products.index', [$sub_product_category['id']])); ?>"
                                                            class="nav-link sub-prod-nav-link px-0">
                                                            <?php echo e($sub_product_category["name_$lang"]); ?> (
                                                            <?php echo e(sizeof($sub_product_category->subProductCategoryInfos)); ?>

                                                            )
                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php else: ?>
                                        <div class="nav-sub-prod">
                                            <h4
                                                class="nav-link prod-nav-link px-0 align-middle <?php echo e(request()->get('prod_cat_id') == $product_category['id'] ? 'active-catergory-link' : ''); ?>">
                                                <?php echo e($product_category["name_$lang"]); ?>

                                            </h4>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col display-prod-col">
                        <div class="container">
                            <?php if($product_details): ?>
                                <div class="row products-display-row">

                                    <div class="product-card" style="width: 18rem;">
                                        <h5 class="h-catalog-title"><?php echo e(__('pro_catalog')); ?></h5>
                                    </div>
                                    <div class="product-card" style="width: 18rem;">
                                        <form class="d-flex input-group search-form-prods"
                                            action="<?php echo e(route('products.index', ['searchText' => $search])); ?>"
                                            method="GET">
                                            <input class="form-control nav-search-item" type="search" name="searchText"
                                                placeholder="<?php echo e(__('prod_search_placeholder')); ?>" aria-label="Search"
                                                value="<?php echo e(request()->get('searchText')); ?>" />
                                            <button class="btn btn-primary nav-search-button" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="product-card select-category-responsive"
                                        style="display: none; width: 18rem;">
                                        <select id="tdcategory" class="tdcategory-form" name="search_type_id"
                                            onchange="window.location.href=this.options[this.selectedIndex].value;">
                                            <option value="<?php echo e(route('products.index')); ?>"
                                                <?php echo e($all == 1 ? 'selected' : ''); ?>>
                                                <?php echo e(__('all_pro')); ?></option>
                                            <?php $__currentLoopData = $product_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($product_category['has_sub_category'] == 1): ?>
                                                    <optgroup label="<?php echo e($product_category["name_$lang"]); ?>">
                                                        <?php $__currentLoopData = $product_category->subProductCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $sub_product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e(route('sub_products.index', [$sub_product_category['id']])); ?>"
                                                                <?php echo e($sub_product_id ? ($sub_product_id == $sub_product_category->id ? 'selected' : '') : ''); ?>>
                                                                <?php echo e($sub_product_category["name_$lang"]); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>
                                                <?php else: ?>
                                                    <option
                                                        value="<?php echo e(route('products.index', ['prod_cat_id' => $product_category['id'], 'type' => 'type2'])); ?>"
                                                        style="font-weight: bold;"
                                                        <?php echo e($selected == $product_category["name_$lang"] ? 'selected' : ''); ?>>
                                                        <?php echo e($product_category["name_$lang"]); ?>

                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php if(!count($product_details)): ?>
                                        <h3 class="text-center not-found-prod-message"><?php echo e(__('no_products_founded')); ?></h3>
                                    <?php endif; ?>
                                    <div id="lightgallery" class="products-display-row">
                                        <?php $__currentLoopData = $product_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="product-card" style="width: 18rem;">
                                                <?php if($product_detail['image']): ?>
                                                    <a data-src="<?php echo e(asset($product_detail['image'])); ?>"
                                                        class="gallery_item" target="_blank" data-lg-size="1600-2400">
                                                        <img class="product-img"
                                                            src="<?php echo e(asset($product_detail['image'])); ?>"
                                                            alt="<?php echo e($product_detail['image_alt']); ?>" loading="lazy">
                                                    </a>
                                                <?php else: ?>
                                                    <a data-src="<?php echo e(asset('/images/no-photo-img.jpg')); ?>"
                                                        class="gallery_item1" target="_blank" data-lg-size="1600-2400">
                                                        <img class="product-img"
                                                            src="<?php echo e(asset('img/covers/no-photo-img.jpg')); ?>"
                                                            alt="default_prod" loading="lazy">
                                                    </a>
                                                <?php endif; ?>

                                                <div class="card-body">
                                                    <p class="card-text product-card-title">
                                                        <?php echo e($product_detail["title_$lang"]); ?>

                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($product_details) % 2 == 1): ?>
                                            <div class="product-card" style="width: 18rem;">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="likns-row">
                                    <?php if(request()->get('prod_cat_id')): ?>
                                        <?php echo e($product_details->appends(['prod_cat_id' => request()->get('prod_cat_id')])->links()); ?>

                                    <?php else: ?>
                                        <?php echo e($product_details->links()); ?>

                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>