<?php
/**
 * Template Name: Work Page
 *
 */
?>

<?php get_header(); ?>

<?php the_content(); ?>
<main class="insights case-studies-outer" id="simple-bar">
    <div class="container-wrapper">
        <div class="main-content">
            <?php get_template_part( 'parts/whr-embed-hook' ); ?>         
        </div>
    </div>  
</main>

<?php get_footer(); ?>


