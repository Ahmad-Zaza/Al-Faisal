<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    .menu-row {
        font-family: DejaVu Sans !important;
        margin: 0 auto;
        width: 100%;
    }

    .menu-row-ar {
        direction: rtl;
    }

    .menu-row-en {
        direction: ltr;
    }

    .menu-title {
        /* margin-right: 10px; */
        color: #fcc233;
        font-size: 22px !important;
        /* padding-top: 35px; */
    }

    .cat-menu-item {
        /* margin-right: 20px; */
        font-size: 14px !important;
        color: #373737;
        line-height: 2;
    }

    .menu-title-ar {
        text-align: right;
    }

    .cat-menu-item-ar {
        text-align: right;
        padding-right: 15px;
        margin-right: 15px;
    }

    .menu-title-en {
        text-align: left;
    }

    .cat-menu-item-en {
        text-align: left;
        padding-left: 15px;
        margin-left: 15px;
    }
</style>
<div class="row menu-row menu-row-<?php echo e($lang); ?>">
    <table class="studies" cellpadding="2" border="0" style="" width="100%">
        <tbody>
            <?php $__currentLoopData = $category_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $recipes_ar = explode('|', $category_menu['recipes_ar']);
                    $recipes_en = explode('|', $category_menu['recipes_en']);
                ?>
                <tr class="title-tr" nobr="true">
                    <td class="menu-title menu-title-<?php echo e($lang); ?>">
                        <?php echo e($category_menu["name_$lang"]); ?>

                    </td>
                </tr>
                <?php $__currentLoopData = $recipes_ar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $recipe_ar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr nobr="true">
                        <td class="cat-menu-item cat-menu-item-<?php echo e($lang); ?>">
                            &nbsp;&nbsp;&nbsp;<?php echo e($lang == 'ar' ? $recipes_ar[$key1] : $recipes_en[$key1]); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
