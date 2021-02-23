<?php

/**
 * PSR-4 class autoloader
 */
require_once 'vendor/autoload.php';

// Constants
define('SITE_URL', trailingslashit(get_site_url()));
define('TEMPLATE', trailingslashit(get_template_directory()));
define('TEMPLATE_URI', trailingslashit(get_template_directory_uri()));
define('ASSETS_URI', TEMPLATE_URI . 'assets/');
define('DOMAIN', 'conjure');

use RST\Theme;

$theme = Theme::getInstance();

/**
 * Example section
 */

use RST\Base\Structure\PostType;
use RST\Base\Structure\Taxonomy;

$services = new PostType('service');
$services->setLabels([
    'name' => __('Services'),
]);

$servicesCategory = new Taxonomy('service_category', 'services');
$servicesCategory->setLabels([
    'name' => __('Services categories'),
]);
$servicesCategory->uses($services);

/**
 * Rest resource checking
 */

use RST\Rest\Resources\TestData;

$theme->rest->setNamespace('rst/v1');
$theme->rest->addResource(new TestData());

/**
 * Register custom gutenberg block with backend logic
 */

use RST\Blocks\PostSnapshot;

$theme->gutenberg->setDependencies(['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data']);

try {

    $theme->gutenberg->register([
        'block'  => 'post-snapshot',
        'render' => [PostSnapshot::class, 'renderCallback'],
    ]);

} catch (Exception $e) {
    error_log($e->getMessage());
}

/**
 * Theme setup functions
 */

/**
 * Load scripts and styles
 * @link        http://developer.wordpress.org/reference/functions/wp_enqueue_script
 * @link        http://wp-kama.ru/function/wp_enqueue_script
 * @package     WordPress
 * @subpackage  RSV v3
 * @since       1.0.0
 * @author      Luke Kortunov
 */
function rst_load_assets()
{
    //--- Load scripts and styles only for frontend: -----------------------------
    if ( ! is_admin()) {
        // Styles
        wp_enqueue_style('app', ASSETS_URI . 'dist/app.min.css');

        // Scripts
        wp_deregister_script('jquery');
        wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, null, false);
        wp_enqueue_script('jquery');

        wp_enqueue_script('simplebar', get_template_directory_uri() . '/assets/libs/simplebar.min.js', [], '', true);
        wp_enqueue_script('smoothScroll', get_template_directory_uri() . '/assets/libs/smooth-scroll.js', [], '', true);
        wp_enqueue_script('workableApi', 'https://www.workable.com/assets/embed.js', ['jquery'], '', true);
        wp_enqueue_script('workable', get_template_directory_uri() . '/assets/libs/workable.js', ['jquery', 'workableApi'], '', true);
        wp_enqueue_script('app', get_template_directory_uri() . '/assets/dist/app.min.js', [], '1.0.0', true);
        }
}

add_action('wp', 'rst_load_assets');
require_once 'src/helpers.php';
require_once 'src/Hooks/user-creating.php';
require_once 'parts/core/menu.php';
require_once 'parts/core/template_tags.php';

/**
 * Register menu items
 */
add_action( 'after_setup_theme', function() {
    register_nav_menus(array(
        'primary'     => __('Header Menu', DOMAIN),
        'footer-menu' => __('Footer Menu', DOMAIN),
    ));
});

/**
 * Register options page
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => __('Theme General Settings', DOMAIN),
        'menu_title' => __('Theme Settings', DOMAIN),
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'position'   => false,
        'redirect'   => false
    ));
}

/**
 * Disable gutenberg
 */
if( 'disable_gutenberg' ){
    add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );
    add_action( 'admin_init', function(){
        remove_action( 'admin_notices', [ 'WP_Privacy_Policy_Content', 'notice' ] );
        add_action( 'edit_form_after_title', [ 'WP_Privacy_Policy_Content', 'notice' ] );
    });
}
