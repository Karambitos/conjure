<section class="section" data-name="page4">
    <div class="content">
        <div class="content-wrapper">
            <?php
            $background = get_sub_field('background.insights_home');
            $background_mobile = get_sub_field('background_mobile.insights_home');?>
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
            <div class="title-mobile--ref alineLeft">
                <?php $title = get_sub_field('title.insights_home'); ?>
                <?php echo get_mobile_insights_title($title); ?>
                <?php $mobile_text = get_sub_field('mobile_text.insights_home'); ?>
                <p class="title-mobile--text"><?php echo $mobile_text; ?></p>
            </div>
            <div class="posts posts-main-page">
                <div class="flefible-elements posts-inner">
                    <?php
                    $args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 5,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    );
                    $insights = new WP_Query( $args );

                    if ( $insights->have_posts() ) {
                        while ( $insights->have_posts() ) {
                            $insights->the_post();
                            get_template_part('parts/grid/grid', 'post');
                        }
                    }
                    wp_reset_postdata();
                    ?>

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
                    <!-- //TODO need to add div .sidebar-title-box--border -->
                    <div class="sidebar-title-box--border">
                        <?php $title = get_sub_field('title.insights_home'); ?>
                        <?php echo get_sidebar_title($title); ?>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item"><a href="<?php echo get_post_type_archive_link('post'); ?>" target="_blank" class="sidebar-menu-item-link"><?php _e('ARCHIVE', DOMAIN); ?></a></li>
                        <?php
                        $categories = get_categories( [
                            'taxonomy'     => 'category',
                            'type'         => 'post',
                            'child_of'     => 0,
                            'parent'       => '',
                            'orderby'      => 'name',
                            'order'        => 'ASC',
                            'hide_empty'   => 1,
                            'hierarchical' => 1,
                            'exclude'      => '',
                            'include'      => '',
                            'number'       => 0,
                            'pad_counts'   => false,
                        ] );

                        if( $categories ) : ?>
                            <?php foreach( $categories as $cat ) : ?>
                                <?php $term_link = get_term_link( (int) $cat->term_id, 'category' );; ?>
                                <li class="sidebar-menu-item"><a href="<?php echo $term_link; ?>" target="_blank" class="sidebar-menu-item-link"><?php echo strtoupper($cat->name) ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>
