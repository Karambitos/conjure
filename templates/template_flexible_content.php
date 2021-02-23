<?php
/*

Template name: Flexible Content

*/
?>
<?php get_header(); ?>
<?php $page_type = get_field('page_type'); ?>
<main class="insights <?php echo !empty($page_type) ? $page_type : ''; ?>">
    <div class="container-wrapper">
        <div class="main-content">
            <div id="iscroll">
                <div class="wrapper">
                <?php if (have_rows('layout')) {
                    while (have_rows('layout')) {
                        the_row();
                        switch (get_row_layout()) {
                            case 'hero_home':
                                get_template_part('parts/hero_home');
                                break;

                            case 'about_us_home':
                                get_template_part('parts/about_us_home');
                                break;

                            case 'clients_home':
                                get_template_part('parts/clients_home');
                                break;

                            case 'insights_home':
                                get_template_part('parts/insights_home');
                                break;

                            case 'contact_us_home':
                                get_template_part('parts/contact_us_home');
                                break;
                        }
                    }
                } ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
