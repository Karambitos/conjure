<section class="section" data-name="page3">
    <div class="content">
        <div class="content-wrapper">
            <?php $background = get_sub_field('background.clients_home'); ?>
            <?php $background_mobile = get_sub_field('background_mobile.clients_home'); ?>
            <?php if(!empty($background)) : ?>
            <div class="content-image-overlay blur-dark">
                <?php //foreach ($background as $image) : ?>
                    <img src="<?php echo esc_url($background); ?>"alt="conjure">
                <?php //endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($background_mobile)) : ?>
            <div class="content-image-overlay--mobile blur-dark">
                <img src="<?php echo esc_url($background_mobile); ?>"alt="conjure">
            </div>
            <?php endif; ?>
            <?php if(have_rows('logos.clients_home')) : ?>
            <div class="client-logo">
                <ul class="client-logo--list">
                    <?php while( have_rows('logos.clients_home') ) : ?>
                        <?php the_row(); ?>
                        <?php $logo = get_sub_field('logo'); ?>
                        <li class="client-logo--item"><img src="<?php echo esc_url($logo['url']) ?>"alt="conjure"></li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <?php endif; ?>
            <aside class="sidebar">
                <?php $logo = get_field('logo.header', 'option'); ?>
                <figure class="logo-container">
                    <a href="/" class="logo-link">
                        <img class="logo" src="<?php echo esc_url($logo['url']); ?>" alt="conjure">
                    </a>
                </figure>
                <div class="sidebar-wrapper-inner">
                    <?php $title = get_sub_field('title.clients_home'); ?>
                    <?php echo get_sidebar_title($title); ?>

                    <?php $text = get_sub_field('text.clients_home'); ?>
                    <p class="text">
                        <?php echo $text; ?>
                    </p>
                    <?php $quote = get_sub_field('quote.clients_home'); ?>
                    <p class="quote">
                        <?php echo $quote; ?>
                    </p>
                    <?php $label = get_sub_field('lable.clients_home'); ?>
                    <p class="lable"><?php echo $label; ?></p>
                </div>
            </aside>
        </div>
    </div>
</section>
