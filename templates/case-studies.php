<?php
/**
 * Template Name: Case Studies Page
 *
 */
?>

<?php get_header(); ?>

<?php the_content(); ?>
<main class="insights case-studies-outer">
    <div class="container-wrapper">
        <div class="main-content">
            <div id="iscroll">
                <div class="wrapper">
                    <?php get_template_part( 'parts/hero-slide'); ?>
                    <?php get_template_part( 'parts/no-text'); ?>
                    <?php get_template_part( 'parts/slide-three-images'); ?>
                    <?php get_template_part( 'parts/slide-two-images'); ?>
                    <?php get_template_part( 'parts/slide-with-blockquote'); ?>
                    <?php get_template_part( 'parts/slide-content'); ?>
                </div>
            </div>
        </div>
    </div>
</main>


<?php get_footer(); ?>


