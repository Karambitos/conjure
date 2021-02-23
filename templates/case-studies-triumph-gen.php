<?php
/**
 * Template Name: Case Studies Triumph-Gen Page
 *
 */
?>

<?php get_header(); ?>

<?php the_content(); ?>
<main class="insights case-studies-outer">
    <div class="container-wrapper">
        <div class="main-content">
            <div id="fullpage">
                <?php get_template_part( 'parts/case-studies-slide-1' ); ?>
								<?php get_template_part( 'parts/about-us' ); ?>
								<?php get_template_part( 'parts/case-studies-slide-3' ); ?>
                <?php get_template_part( 'parts/case-studies-slide-5' ); ?>
                <?php get_template_part( 'parts/case-studies-slide-6' ); ?>
            </div>
        </div>
    </div>
   <div id="scroll-indicator" class="scroll-indicator">
       <div id="indicator" class="indicator"><span></span></div>
   </div>
</main>


<?php get_footer(); ?>


