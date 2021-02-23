<?php
/**
 * Get array items for menu location
 *
 * @param $menu_location
 * @return array
 */
function get_header_menu_array($menu_location)
{
    $locations = get_nav_menu_locations();
    $arr_menu = [];

    if ($locations && isset($locations[$menu_location])) {

        $menu_items = wp_get_nav_menu_items($locations[$menu_location]);

        foreach ((array)$menu_items as $key => $menu_item) {

            if (array_key_exists($menu_item->menu_item_parent, $arr_menu) && $menu_item->menu_item_parent != 0) {

                $arr_menu[$menu_item->menu_item_parent]['submenu'][$menu_item->ID] = [
                    'id' => $menu_item->ID,
                    'title_menu' => $menu_item->title,
                    'url' => $menu_item->url,
                ];
            } else {

                $arr_menu[$menu_item->ID] = [
                    'id' => $menu_item->ID,
                    'title_menu' => $menu_item->title,
                    'url' => $menu_item->url,
                ];
            }
        }
    } else {

    }
    return $arr_menu;
}
