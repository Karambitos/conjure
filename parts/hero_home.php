<section class="section video" data-name="page1">
    <div class="content">
        <span class="mouse">
            <span>
            </span>
        </span>
        <?php
        $video =  get_sub_field('video.hero_home');
        $video_poster = get_sub_field('poster_image.hero_home');
        ?>
        <?php //if(!empty($video)) : ?>
        <div class="overlay"></div>
        <video poster="<?php echo $video_poster; ?>" autoplay muted playsinline loop preload="auto" class="video-block">
            <source src="<?php echo $video['url']; ?>" type="<?php echo $video['mime_type']; ?>">
        </video>
        <?php //endif; ?>
        <div class="page-title">
            <h2 class="title"><?php echo get_sub_field('title.hero_home'); ?></h2>
            <p class="sub-title"><?php echo get_sub_field('subtitle.hero_home'); ?></p>
            <!-- //TODO need to add <p class="sub-title--text">UX & Service Design. Rapid prototyping. Interfaces & experiences.</p>  -->
            <!-- <p class="sub-title--text">UX & Service Design. Rapid prototyping. Interfaces & experiences.</p> -->
        </div>
        <?php $logo = get_field('logo.header', 'option'); ?>
        <?php if(!empty($logo)) : ?>

        <figure class="logo-container logo-containerRef">
            <a href="/" alt="logo">
                <img class="logo" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
            </a>
        </figure>
        <?php endif; ?>
    </div>
</section>
