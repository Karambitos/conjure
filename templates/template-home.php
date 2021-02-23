<?php
/**
 * Template Name: Home Page
 *
 */
?>

<?php get_header(); ?>

<?php the_content(); ?>
<main class="insights">
    <div class="container-wrapper">
        <div class="main-content">
            <div id="iscroll">
                <div class="wrapper">
                    <?php get_template_part( 'parts/front/hero' ); ?>
                    <?php get_template_part( 'parts/front/three-images' ); ?>
                    <?php get_template_part( 'parts/front/clients' ); ?>
                    <?php get_template_part( 'parts/front/posts' ); ?>
                    <?php get_template_part( 'parts/front/form' ); ?>
                </div>
            </div>
        </div>
    </div>
</main>


<?php get_footer(); ?>


