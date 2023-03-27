<?php $__env->startSection('title', config('app.name', 'Faisal')); ?>
<?php $__env->startSection('content'); ?>
    <?php $_right = ($lang=="ar"?"left":"right")?>
    <?php $_r = ($lang=="ar"?"r":"l")?>
    <?php $_l = ($lang=="ar"?"l":"r")?>
    <?php $_left = ($lang=="ar"?"right":"left")?>

    <main id="main" class="main">
        <section>
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $__currentLoopData = $section_sliders[1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $main_slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                            <img class="d-block img-fluid main-slide-img" src="<?php echo e(asset($main_slider['image'])); ?>"
                                alt="<?php echo e($main_slider['image_alt']); ?>" style="background-size:cover;">
                            <div class="carousel-caption d-none d-md-block" data-aos="fade-down" data-aos-duration="1000"
                                data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
                                data-aos-anchor-placement="top-center">
                                <a href="<?php echo e($main_slider['url']); ?>" style="text-decoration: none;" target="_blank">
                                    <p class="first-caption"><?php echo e($main_slider["first_title_$lang"]); ?></p>
                                    <p class="second-caption"><?php echo e($main_slider["second_title_$lang"]); ?></p>
                                </a>
                                
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <!-- end main slider section -->
        <!-- start about us section -->
        <section>
            <div class="container-fluid aboutUs-container" style="padding:0;">
                <div class="row aboutUs-row">
                    <fieldset class="aboutUs-feild-text" data-aos="fade-right" data-aos-duration="1000"
                        data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
                        data-aos-anchor-placement="top-center">
                        <div class="aboutUs-special-style">
                            <div class="about-us-background-text">
                                <div class="overlay-good"></div>
                                <h3 class="f-good">
                                    <span class="f-good-space">&nbsp;</span>
                                    <?php echo e($section_textBoxes[2]["first_box_title_$lang"]); ?>

                                </h3>
                                <h3 class="s-good">
                                    <?php echo e($section_textBoxes[2]["second_box_title_$lang"]); ?></h3>
                            </div>
                            <div id="innerAboutUsField" class="innerAboutUsField home-innerAboutUsField">
                                <?php echo $section_textBoxes[2]["first_box_para_$lang"]; ?>

                            </div>
                            <a href="<?php echo e(route('about_us')); ?>" class="read-more">
                                <?php echo e(__('read_more')); ?>

                            </a>
                        </div>
                    </fieldset>
                    <img class="padding-img" src="<?php echo e(asset($section_textBoxes[2]['image'])); ?>"
                        alt="<?php echo e($section_textBoxes[2]['image_alt']); ?>">
                </div>
            </div>
        </section>
        <!-- end about us section -->
        <!-- start services section -->
        <section>
            <div class="container-fluid cover-section"
                style="padding: 0; background-image: url(<?php echo e($section_textBoxes[3]['image']); ?>);">
                <div class="row cover-section-row">
                    <div class="col-md">
                        <fieldset class="border border-faisal">
                            <div class="cover-first-special-style">
                                <h5 class='text-center'><?php echo e($section_textBoxes[3]["first_box_title_$lang"]); ?>

                                </h5>
                                <div id="innerPara">
                                    <?php echo $section_textBoxes[3]["first_box_para_$lang"]; ?>

                                </div>
                            </div>

                        </fieldset>
                        <fieldset class="border-faisal-second">
                            <div class="second-special-style">
                                <div id="innerParaWithBackground">
                                    <?php echo $section_textBoxes[3]["second_box_para_$lang"]; ?>


                                </div>
                            </div>

                        </fieldset>
                    </div>
                    <div class="col-md"></div>
                </div>
            </div>
        </section>
        <!-- end services section -->
        <!-- start events section -->
        <section>
            <div class="container-fluid events-container">
                <div class="row first-service-row">
                    <div class="img1">
                        <div class="events-header-text">
                            <h5 style="color: #000;  color: rgba(0, 0, 0, 0) !important;">
                                <?php echo e($section_textBoxes[4]["first_box_title_$lang"]); ?></h5>
                        </div>
                        <div class="first-carousel">
                            <div id="carouselExampleControls1" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php $__currentLoopData = $section_sliders[4]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $main_slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($main_slider['slider_number'] == 1): ?>
                                            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                                                <img class="d-block img-fluid services-imgs"
                                                    src="<?php echo e(asset($main_slider['image'])); ?>"
                                                    alt="<?php echo e($main_slider['image_alt']); ?>"
                                                    class="animated slideInLeft infinite">
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="img2">
                        <div class="events-header-text">
                            <h5> <?php echo e($section_textBoxes[4]["first_box_title_$lang"]); ?></h5>
                        </div>
                        
                        <div class="second-carousel">
                            <div id="carouselExampleControls2" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php $__currentLoopData = $second_service_sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $main_slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                                            <img class="d-block img-fluid services-imgs"
                                                src="<?php echo e(asset($main_slider['image'])); ?>"
                                                alt="<?php echo e($main_slider['image_alt']); ?>" class="animated slideInLeft infinite"
                                                loading="lazy">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row second-service-row">
                    <div class="event-para">
                        <?php echo $section_textBoxes[4]["first_box_para_$lang"]; ?>


                    </div>

                    <div class="body-card-button">

                        <a id="vidoePopup" href="<?php echo e(route('service_events.index')); ?>" class="card-button-link"
                            target="_blank">
                            <span class="card-btn">
                                <?php echo e($section_textBoxes[4]["button_text_$lang"]); ?>

                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </section>
        <!-- end events sectino -->
        <section>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: rgba(0,0,0,.0); border:none;">
                        <div class="modal-header" style="border:none;">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <video id="faisal_video" width="100%" height="100%" controls preload="auto">
                                <source src="<?php echo e($mainInformations['vedio']); ?>" type="video/mp4">
                                <source src="<?php echo e($mainInformations['vedio']); ?>" type="video/ogg">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid owl-container" style="padding: 0;">
                <div id="main-owl-carousel" class="owl-carousel">
                    <?php $__currentLoopData = min($section_textBoxes[5], $section_sliders[5]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section_slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <img class="owl-img" src="<?php echo e(asset($section_sliders[5][$key]['image'])); ?>"
                                alt="<?php echo e($section_sliders[5][$key]['image_alt']); ?>" loading="lazy">
                        </div>
                        <div class="item card">
                            <div class="card-body servecs-slider-card-body">
                                <fieldset class="border border-slider-card">
                                    <div class="first-speial-style">

                                        <h5 class='text-center first-spec-title'>
                                            <div class="box-title">
                                                <div class="overlay-catering-box"></div>
                                                <?php echo e($section_textBoxes[5][$key]["first_box_title_$lang"]); ?>

                                            </div>
                                        </h5>
                                        <div id="innerSliderCardPara">
                                            <?php echo $section_textBoxes[5][$key]["first_box_para_$lang"]; ?>

                                        </div>
                                    </div>
                                    <!-- Button trigger modal -->
                                    <?php if($key == 0 && $mainInformations['vedio']): ?>
                                        <!-- Button trigger modal -->
                                        <button id="video_btn" type="button" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="myFunction()">
                                            <?php echo e(__('watch_video')); ?>

                                        </button>
                                    <?php endif; ?>
                                    <div class="body-card-button">
                                        <a href="<?php echo e(route('service_events.index')); ?>" class="card-button-link"
                                            target="_blank">
                                            <span class="card-btn">
                                                <?php echo e($section_textBoxes[5][$key]["button_text_$lang"]); ?>

                                            </span>
                                        </a>
                                    </div>
                                </fieldset>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </section>
        <section class="contactUs">
            <div class="container-fluid about-us-container" style="">
                <div class="row contact-row">
                    <div class="contact-div">
                        <fieldset class="contactUs-field">
                            <div class="contact-style">
                                <h5 id="headContactPara">
                                    <?php echo $section_textBoxes[6]["first_box_title_$lang"]; ?>

                                </h5>
                                <div class="home-overlay-box">
                                </div>
                                <p id="innerContactPara">
                                    <?php echo $section_textBoxes[6]["first_box_para_$lang"]; ?>

                                </p>
                                <div class="address">
                                    <p>
                                        <?php echo e($mainInformations["sub_address_$lang"]); ?><br><?php echo e($mainInformations["main_address_$lang"]); ?>

                                    </p>

                                </div>
                                <div class="social-media">
                                    <p class="social-text"><?php echo e(__('enjoy_morning')); ?></p>
                                    <?php if($social_media['facebook_link'] != null): ?>
                                        <a class="social-text" href="<?php echo e($social_media['facebook_link']); ?>"
                                            target="_blank">
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
                            <img class="padding-img_1" src="<?php echo e(asset($section_textBoxes[6]['image'])); ?>"
                                alt="<?php echo e($section_textBoxes[6]['image_alt']); ?>" loading="lazy">
                            <fieldset class="contactUs-info ml-auto">
                                <div class="contact-info-style" data-aos="fade-up" data-aos-duration="1000"
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
                                        <p id="innerInfoBackgroundEmail"><i id="innerInfoBackground"
                                                class="fa fa-envelope" aria-hidden="true"></i></p>
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
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>