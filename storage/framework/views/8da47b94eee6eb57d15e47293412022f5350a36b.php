<?php
$title = '';
foreach ($seo as $s) {
    if ($s->model == 'contact-us') {
        $title = $s["title_$lang"];
    }
}
?>
<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

    <div class="main-contact-us">
        <section class="contact-cover-section">
            <div class="container-fluid contact-cover inner-highlight-container" style="padding: 0;">
                <img class="contact-cover-img inner-highlight-img" src="<?php echo e(asset($Highlight['image'])); ?>"
                    alt="<?php echo e($Highlight['image_alt']); ?>" loading="lazy">
                <h5 class="category-overlay-text">
                    <?php echo e(__('contact_us')); ?>

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
                            <?php echo e(Config::get('app.locale') == 'en' ? 'Contact Us' : 'اتصل بنا'); ?>

                        </p>
                    </li>
                </ol>
            </div>
        </section>
        <section class="contactUs">
            <div class="container" style="padding:0;">
                <div class="row breadcrumb-row"
                    style="<?php echo e(Config::get('app.locale') == 'en' ? '' : 'margin-right:-85px;'); ?>">
                </div>
                <div class="row contact-row">
                    <div class="contact-div contact-main-div">
                        <fieldset class="contactUs-field main-contactUs-field">
                            <div class="contact-style">
                                <div class="colored-contact-div"></div>
                                <h5 id="headContactPara">
                                    <?php echo $contactUs_section_info["first_box_title_$lang"]; ?>

                                </h5>
                                <div class="overlay-box">
                                </div>
                                <div id="innerContactPara">
                                    <?php echo $contactUs_section_info["first_box_para_$lang"]; ?>

                                </div>
                                <div class="address">
                                    <p>
                                        <?php echo e($mainInformations["sub_address_$lang"]); ?><br><?php echo e($mainInformations["main_address_$lang"]); ?>

                                    </p>

                                </div>
                                <div class="social-media">
                                    <p class="social-text"><?php echo e(__('enjoy_morning')); ?></p>
                                    <?php if($social_media['facebook_link'] != null): ?>
                                        <a class="social-text" href="<?php echo e($social_media['facebook_link']); ?>" target="_blank">
                                            
                                            <img class="inst-img"
                                                src="<?php echo e(asset('img/icons8-facebook-f-material-filled-32.png')); ?>"
                                                alt="ins-icon" loading="lazy">
                                        </a>
                                    <?php endif; ?>
                                    <?php if($social_media['instagram_link'] != null): ?>
                                        <a class="social-link social-text" href="<?php echo e($social_media['instagram_link']); ?>"
                                            target="_blank">
                                            
                                            <img class="inst-img"
                                                src="<?php echo e(asset('img/icons8-instagram-material-filled-32.png')); ?>"
                                                alt="ins-icon" loading="lazy">
                                        </a>
                                    <?php endif; ?>
                                    <?php if($social_media['youtube_link'] != null): ?>
                                        <a class="social-link social-text" href="<?php echo e($social_media['youtube_link']); ?>"
                                            target="_blank">
                                            

                                            <img class="inst-img"
                                                src="<?php echo e(asset('img/icons8-youtube-logo-material-filled-32.png')); ?>"
                                                alt="ins-icon" loading="lazy">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="contact-with-img">
                            <fieldset class="contactUs-info ml-auto contact-main-page-info">
                                <div class="contact-info-style" data-aos="fade-left" data-aos-duration="1000"
                                    data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
                                    data-aos-anchor-placement="top-center">
                                    <p id="ParaInfoBackground">
                                        <?php echo e(__('welcome')); ?>

                                    </p>
                                    <h2 class="contact_us_h">
                                        <?php echo e(__('contact_us')); ?>

                                    </h2>
                                    <div id="innerInfoBackground">
                                        <div class="tel" style="display: inline-flex">
                                            <i id="innerInfoBackground" class="fa fa-phone phone-icon"
                                                aria-hidden="true"></i>
                                            <div class="tels">
                                                <a href="tel:<?php echo e($mainInformations->tel_number); ?>">
                                                    <p id="innerInfoBackground1">
                                                        <?php echo e($mainInformations->tel_number); ?>

                                                    </p>
                                                </a>
                                                <a href="tel:<?php echo e($mainInformations->tel_number); ?>">
                                                    <p id="innerInfoBackground1">
                                                        <?php echo e($mainInformations->tel_number1); ?>

                                                    </p>
                                                </a>
                                            </div>
                                        </div><br>
                                        <div class="mobile" style="display: inline-flex">
                                            <i id="innerInfoBackground" class="fa fa-mobile mobile-icon"
                                                aria-hidden="true"></i>
                                            <a href="tel:<?php echo e($mainInformations->mob_number); ?>">
                                                <p id="innerInfoBackground1">
                                                    <?php echo e($mainInformations->mob_number); ?>

                                                </p>
                                            </a>
                                        </div><br>
                                        <div class="event" style="display: inline-flex">
                                            <i id="innerInfoBackground" class="fa fa-calendar celander-icon"></i>
                                            <a href="tel:<?php echo e($mainInformations->event); ?>">
                                                <p id="innerInfoBackground1"><?php echo e($mainInformations->event); ?></p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="email">
                                        <p id="innerInfoBackgroundEmail"><i id="innerInfoBackground" class="fa fa-envelope"
                                                aria-hidden="true"></i></p>
                                        <a class="emailto-link" href="mailto:<?php echo e($mainInformations->email); ?>">
                                            <p id="emailBackground">
                                                <?php echo e($mainInformations->email); ?>

                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container contact-form-container">
            <div class="card contactUs-card">
                <?php if(session()->has('message')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="width: 50%; display:flex; justify-content:center; margin: 0 auto; margin-bottom:10px;">
                        <?php echo e(__('contact_msg_success')); ?>

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
                    <h5 class="booking-title"><?php echo e(__('love_eat')); ?></h2>
                        <form class="contactUs-form" method="POST" action="<?php echo e(route('contactUs.post')); ?>"
                            accept-charset="UTF-8">
                            <?php echo e(csrf_field()); ?>

                            <div class="row row-space">
                                <div class="col-form">
                                    <div class="form-group input-group">
                                        <div class="mb-3">
                                            <label for="contactUs-form" class="form-label"><?php echo e(__('name')); ?>*</label>
                                            <input class="input-contactUs booking-name" type="text" name="name"
                                                required>
                                            <?php if($errors->has('name')): ?>
                                                <div class="error"><?php echo e($errors->first('name')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-form">
                                    <div class="form-group input-group">
                                        <div class="mb-3">
                                            <label for="contactUs-form"
                                                class="form-label"><?php echo e(__('email_address')); ?>*</label>
                                            <input class="input-contactUs booking-email" type="email" name="email"
                                                required>
                                            <?php if($errors->has('email')): ?>
                                                <div class="error"><?php echo e($errors->first('email')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-form">
                                    <div class="form-group input-group">
                                        <div class="mb-3">
                                            <label for="contactUs-form" class="form-label"><?php echo e(__('phone_num')); ?>*</label>
                                            <input class="input-contactUs booking-phone-number" type="tel"
                                                pattern="[0-9]+" name="phone_number" required>
                                            <?php if($errors->has('phone_number')): ?>
                                                <div class="error"><?php echo e($errors->first('phone_number')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-form">
                                    <div class="form-group input-group">
                                        <div class="mb-3">
                                            <label for="contactUs-form" class="form-label"><?php echo e(__('address')); ?>*</label>
                                            <input class="input-contactUs booking-no-of-persons" type="text"
                                                name="address" required>
                                            <?php if($errors->has('address')): ?>
                                                <div class="error"><?php echo e($errors->first('address')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="form-group mb-3 note-mb-3">
                                    <label for="contactUs-form" class="form-label"><?php echo e(__('message')); ?>*</label>
                                    <textarea class="form-control input-contactUs booking-notes" rows="3" name="message" required></textarea>
                                    <?php if($errors->has('message')): ?>
                                        <div class="error"><?php echo e($errors->first('message')); ?></div>
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>