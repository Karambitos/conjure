<?php

/**
 * Function, that require svg-file and return or print it
 *
 * @param string $filename - file name excluding file extension
 * @param bool $return - true == include file || false == return path
 * @param string $dir - if svg files directory not eq. "svg" - set target directory related to theme root
 *
 * @return string/void
 *
 * @since       1.0.0
 * @author      Luke Kortunov
 */
function svg($filename, $return = false, $content = true, $dir = 'assets/dist/svg')
{
    $dir = mb_substr($dir, 0, 1) == '/' ? mb_substr($dir, 1, mb_strlen($dir)) : $dir;
    $dir = mb_substr($dir, -1, 1) == '/' ? mb_substr($dir, 0, mb_strlen($dir) - 1) : $dir;
    $path = get_template_directory() . '/' . $dir . '/' . $filename . '.svg';
    if ($return == false) {
        @require $path;
    } else {
        if ($content = true) {
            return file_get_contents($path);
        } else {
            return $path;
        }
    }
}


add_filter('upload_mimes', 'allowUploadSVG');
add_filter('generate_rewrite_rules', 'taxonomySlugAsPostType');

/**
 * Allow SVG files upload
 * @param $types
 * @return mixed
 */
function allowUploadSVG($types)
{
    $types['svg'] = 'image/svg+xml';
    return $types;
}


/**
 * Fix custom taxonomy terms for custom post types
 * After filter taxonomy slug in url will be replaced with post type url
 * @author http://someweblog.com/wordpress-custom-taxonomy-with-same-slug-as-custom-post-type/
 * @param $wp_rewrite
 */
function taxonomySlugAsPostType($wp_rewrite)
{
    $rules = [];

    $taxonomies = get_taxonomies(['_builtin' => false], 'objects');
    $post_types = get_post_types(['public' => true, '_builtin' => false], 'names');

    foreach ($post_types as $post_type) {

        foreach ($taxonomies as $taxonomy) {

            if ($taxonomy->object_type[0] != $post_type) {
                continue;
            }

            $categories = get_categories([
                'type' => $post_type,
                'taxonomy' => $taxonomy->name,
                'hide_empty' => 0
            ]);

            foreach ($categories as $category) {
                $rules[$post_type . '/' . $category->slug . '/?$'] = 'index.php?' . $category->taxonomy . '=' . $category->slug;
            }

        }

    }

    $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
