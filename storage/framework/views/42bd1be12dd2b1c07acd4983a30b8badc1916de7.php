
<div class="container category-menu-info">
    
    <div class="row menu-row">
        
        <?php $__currentLoopData = $category_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $recipes_ar = explode('|', $category_menu['recipes_ar']);
                $recipes_en = explode('|', $category_menu['recipes_en']);
            ?>
            
            
                <div class="col-md-6 col-sm-12 menu-col">
                    <?php if($category_menu['image']): ?>
                        <img class="menu-item-img colored-menu-item-img" src="<?php echo e(asset($category_menu['image'])); ?>"
                            alt="<?php echo e($category_menu['image_alt']); ?>" loading="lazy">
                    <?php else: ?>
                        <img class="menu-item-img default-menu-img" src="<?php echo e(asset('img/covers/no-photo-img.jpg')); ?>"
                            alt="default_img" loading="lazy">
                    <?php endif; ?>

                </div>
                <div class="col-md-6 col-sm-12 menu-col menu-col-colored">
                    <div class="menu-items">
                        <h5 class="menu-title colored-menu-title"><?php echo e($category_menu["name_$lang"]); ?></h5>
                        <?php $__currentLoopData = $recipes_ar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $recipe_ar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="cat-menu-item">
                                <?php echo e($lang == 'ar' ? $recipes_ar[$key1] : $recipes_en[$key1]); ?>

                            </p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
