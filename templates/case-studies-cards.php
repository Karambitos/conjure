<?php
/**
 * Template Name: Case Studies Cards Page
 *
 */
?>

<?php get_header(); ?>

<?php the_content(); ?>
<main class="insights case-studies-outer" id="simple-bar">
    <div class="container-wrapper">
        <div class="main-content">
            <?php get_template_part( 'parts/cards' ); ?>              
        </div>
    </div>  
</main>

<?php get_footer(); ?>


