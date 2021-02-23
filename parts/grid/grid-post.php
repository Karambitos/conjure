<div class="card card-horizontal">
    <?php if(has_post_thumbnail()) : ?>
    <figure class="card-horizontal-img-cont">
        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="conjure">
    </figure>
    <?php endif; ?>
    <div class="card-text">
        <h6 class="card-title"><?php the_title(); ?></h6>
        <p><?php the_excerpt(); ?></p>
    </div>
</div>
