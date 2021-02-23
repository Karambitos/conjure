<section class="section">
    <div class="content">
        <div class="content-wrapper marginRef">
            <script src='https://www.workable.com/assets/embed.js' type='text/javascript'></script>
            <?php $images = get_sub_field('images.about_us_home'); ?>
            <?php if(!empty($images)) : ?>
            <!-- //TODO need to add option - remove gradient class  -->
            <div class="images-box gradient">
                <?php foreach ($images as $image) : ?>
                    <div class="card-img">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($images)) : ?>
            <!-- //TODO need to add option - remove gradient class  -->
            <div class="images-box--mobile gradient">
                <div class="card-img">
                    <img src="<?php echo esc_url($images[0]['url']); ?>" alt="<?php echo esc_attr($images[0]['alt']); ?>">
                </div>
            </div>
            <?php endif; ?>
            <aside class="sidebar">
                <?php $logo = get_field('logo.header', 'option'); ?>
                <figure class="logo-container">
                    <a href="/" class="logo-link">
                        <img class="logo" src="<?php echo esc_url($logo['url']); ?>" alt="conjure">
                    </a>
                </figure>
                <?php $title = get_sub_field('title.about_us_home'); ?>
                <div class="sidebar-wrapper-inner">
                    <div class="sidebar-title-box">
                        <?php
                        $words = preg_split ('/\s+/' , $title) ;
                        $count = count($words);

                        if($count===2): ?>
                            <p class="sidebar-wrapper-inner-subtitle"><?php echo $words[0]; ?></p>
                            <p class="sidebar-wrapper-inner-title"><?php echo $words[1]; ?></p>
                        <?php else: ?>
                            <p class="sidebar-wrapper-inner-subtitle"><?php echo $title; ?></p>
                        <?php endif; ?>
                    </div>
                    <p class="text">
                        <?php echo get_sub_field('text.about_us_home'); ?>
                    </p>
                </div>
            </aside>
            <div class="title-mobile">
                <div class="title-mobile-box">
                    <p class="title-mobile-box--main-title"><?php echo $title; ?></p>
                </div>
                <?php $text_mobile = get_sub_field('text_mobile.about_us_home'); ?>
                <p class="title-mobile--text">
                    <?php echo $text_mobile; ?>
                </p>
            </div>
        </div>
    </div>
</section>
