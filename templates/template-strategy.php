<?php
/**
 * Template Name: Strategy
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
                <?php get_template_part( 'parts/approach' ); ?>
                <?php get_template_part( 'parts/cards-no-scroll' ); ?>
                </div>
            </div>
        </div>
   </div>
</main>


<?php get_footer(); ?>


