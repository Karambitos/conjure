<section class="section oversize" data-name="page5">
    <div class="content">
        <div class="content-wrapper">
            <?php $background = get_sub_field('background.contact_us_home'); ?>
            <?php $background_mobile = get_sub_field('background_mobile.contact_us_home'); ?>
            <?php if(!empty($background)) : ?>
            <div class="content-image-overlay blur-dark">
                <?php //foreach ($background as $image) : ?>
                    <img src="<?php echo esc_url($background); ?>" alt="">
                <?php //endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($background_mobile)) : ?>
            <div class="content-image-overlay--mobile blur-dark">
                <img src="<?php echo esc_url($background_mobile); ?>" alt="">
            </div>
            <?php endif; ?>

            <div class="form">
                <div class="form-wrapper">
                    <div class="form-info">
                        <h2 class="form-info--title"><?php echo get_sub_field('contact_title.contact_us_home'); ?></h2>
                        <p><?php echo get_sub_field('subtitle.contact_us_home'); ?></p>
                        <ul class="contacts">
                            <li><?php echo get_sub_field('address.contact_us_home'); ?></li>
                            <?php $mail = get_sub_field('email.contact_us_home'); ?>
                            <li><a class="colorRef" href="mail:<?php echo $mail; ?>" title="mail"><?php echo $mail; ?></a></li>
                            <?php $phone = get_sub_field('phone_number.contact_us_home'); ?>
                            <li><a href="tel:<?php echo $phone; ?>" title="<?php echo $phone; ?>"><?php echo $phone; ?></a></li>
                        </ul>

                    </div>
                    <div class="form-box">
                        <h2 class="form--title"><?php echo get_sub_field('contact_form_title.contact_us_home'); ?></h2>
                        <!-- <div class="form-title-mobile">
                            <div class="form-title-mobile-box">
                                <p class="form-title-mobile-box--subtitle">GET</p>
                                <p class="form-title-mobile-box--main-title">IN TOUCHs</p>
                            </div>
                            <p class="form-title-mobile--text">
                                Every great collaboration starts with a conversation.
                            </p>
                        </div> -->
                        <?php $shortcode = get_sub_field('contact_form_shortcode.contact_us_home'); ?>
                        <?php echo do_shortcode($shortcode); ?>
                    </div>
                </div>
            </div>
            <aside class="sidebar">
                <?php $logo = get_field('logo.header', 'option'); ?>
                <figure class="logo-container">
                    <a href="/" class="logo-link">
                        <img class="logo" src="<?php echo esc_url($logo['url']); ?>" alt="conjure">
                    </a>
                </figure>
                <div class="sidebar-wrapper-inner">
                    <?php $title = get_sub_field('sidebar_title.contact_us_home'); ?>
                    <?php echo get_sidebar_title($title); ?>
                </div>
            </aside>
        </div>
    </div>
</section>
