<?php
$title = '';
foreach ($seo as $s) {
    if ($s->model_id == $category->id) {
        $title = $s["title_$lang"];
    }
}
?>
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .cat-menu-cover {
            padding: 0;
            padding-bottom: 30px;
            background-repeat: no-repeat;
        }
    </style>

    <div class="main-category-munu">
        <section class="menu-cover-section">
            <div class="container-fluid cat-menu-cover inner-highlight-container">
                <img class="category-main-menu-img inner-highlight-img" src="<?php echo e($category['highlight']); ?>" alt=""
                    loading="lazy">
                <div class="overlay-cover-light"></div>
                <h5 class="category-overlay-text">
                    <?php echo e($category["name_$lang"]); ?>

                </h5>
                <ol class="breadcrumb category-overlay-text breadcrumb-cat-menu">
                    <li>
                        <a class="breadcrumb-item breadcrumb-item-home" href="<?php echo e(route('home')); ?>">
                            <?php echo e(Config::get('app.locale') == 'en' ? 'Home' : 'الرئيسية'); ?>

                        </a>
                    </li>
                    <li><span
                            class="fa fasl fa-angle-double-<?php echo e(Config::get('app.locale') == 'en' ? 'right' : 'left'); ?>"></span>
                    </li>
                    <li>
                        <a class="breadcrumb-item" href="<?php echo e(route('service_events.index')); ?>">
                            <?php echo e(Config::get('app.locale') == 'en' ? 'Catering' : 'خدماتنا'); ?>

                        </a>
                    </li>
                    <li><span
                            class="fa fasl fa-angle-double-<?php echo e(Config::get('app.locale') == 'en' ? 'right' : 'left'); ?>"></span>
                    </li>
                    <li>
                        <p class="breadcrumb-item current-breadcrumb-item">
                            <?php echo e($category["name_$lang"]); ?>

                        </p>
                    </li>
                </ol>
            </div>
        </section>
    </div>
    <section class="category-menu-para-section">
        <?php echo $__env->make('layouts.sub_category_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row note-row note-row-<?php echo e($lang); ?>">
            <p class="category-note">
                <?php echo e($category["note_$lang"]); ?>

            </p>
        </div>
        <?php if($category['is_downloadable']): ?>
            <div class="row download-menu-row">
                <a href="<?php echo e(route('pdf.download', ['id' => $category['id']])); ?>" target="_blank"><?php echo e(__('Download')); ?></a>
            </div>
        <?php endif; ?>
        <div class="container booking-container">
            <div class="card booking-card">
                <?php if(session()->has('message')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="width: 50%; display:flex; justify-content:center; margin: 0 auto; margin-bottom:10px;">
                        <?php echo e(__('booking_success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif(session()->has('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="width: 50%; display:flex; justify-content:center; margin: 0 auto; margin-bottom:10px;">
                        <?php echo e(__('check_email')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="card-heading"></div>
                <div class="card-body">
                    <h5 class="booking-title"><?php echo e(__('booking')); ?></h5>
                    <form class="booking-form" method="POST" action="<?php echo e(route('event.book')); ?>" accept-charset="UTF-8">
                        <?php echo e(csrf_field()); ?>

                        <div class="row row-space">
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="mb-3">
                                        <label for="booking-form" class="form-label"><?php echo e(__('name')); ?>*</label>
                                        <input class="input-booking booking-name" type="text" name="name" required>
                                        
                                        <?php if($errors->has('name')): ?>
                                            <div class="error"><?php echo e($errors->first('name')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="mb-3">
                                        <label for="booking-form" class="form-label"><?php echo e(__('catering_name')); ?>*</label>
                                        <input class="input-booking booking-catering-name" type="text"
                                            name="catering_name" value="<?php echo e($category["name_$lang"]); ?>" required>
                                        <?php if($errors->has('catering_name')): ?>
                                            <div class="error"><?php echo e($errors->first('catering_name')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="mb-3">
                                        <label for="booking-form" class="form-label"><?php echo e(__('phone_num')); ?>*</label>
                                        <input class="input-booking booking-phone-number" type="tel" pattern="[0-9]+"
                                            name="phone_number" required>
                                        <?php if($errors->has('phone_number')): ?>
                                            <div class="error"><?php echo e($errors->first('phone_number')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="mb-3">
                                        <label for="booking-form" class="form-label"><?php echo e(__('n_of_pers')); ?>*</label>
                                        <input class="input-booking booking-no-of-persons" type="number"
                                            name="no_of_persons" required>
                                        <?php if($errors->has('no_of_persons')): ?>
                                            <div class="error"><?php echo e($errors->first('no_of_persons')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="mb-3">
                                        <label for="booking-form" class="form-label"><?php echo e(__('email_address')); ?>*</label>
                                        <input class="input-booking booking-email" type="email" name="email" required>
                                        <?php if($errors->has('email')): ?>
                                            <div class="error"><?php echo e($errors->first('email')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="form-group mb-3">
                                        <label for="booking-form" class="form-label"><?php echo e(__('delivery_locatin')); ?>*</label>
                                        <input class="input-booking booking-location" type="text" name="location"
                                            required>
                                        <?php if($errors->has('location')): ?>
                                            <div class="error"><?php echo e($errors->first('location')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="form-group mb-3 note-mb-3">
                                <label for="booking-form" class="form-label"><?php echo e(__('notes')); ?></label>
                                <textarea class="form-control input-booking booking-notes" rows="3" name="note"></textarea>
                                <?php if($errors->has('note')): ?>
                                    <div class="error"><?php echo e($errors->first('note')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="form-group recapatcha-group">
                                <div class="g-recaptcha<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>"
                                    data-sitekey="<?php echo e(env('GOOGLE_RECAPTCHA_SITE_KEY')); ?>">
                                </div>
                                <small class="text-danger"><?php echo e($errors->first('g-recaptcha-response')); ?></small>
                                <div class="p-t-20">
                                    <button class="btn btn-sbmit-booking" type="submit"><?php echo e(__('submit')); ?></button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>