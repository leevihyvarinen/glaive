<?php

namespace App;

/**
 * Customize excerpt length.
 *
 * @return int
 */
function customize_excerpt_length()
{
    return 20;
}
add_filter('excerpt_length', __NAMESPACE__ . '\customize_excerpt_length');

/**
 * Customize the excerpt suffix.
 *
 * @return string
 */
function customize_excerpt_more()
{
    return '...';
}
add_filter('excerpt_more', __NAMESPACE__ . '\customize_excerpt_more');

/**
 * Customize allowed upload mime types.
 *
 * @param array  $mime_types
 * @return array Modified $mime_types
 */
function customize_upload_mimes($mime_types)
{
    $new_mime_types = [];
    $new_mime_types['svg'] = 'image/svg+xml';
    $mime_types = array_merge($mime_types, $new_mime_types);

    return $mime_types;
}
add_filter('upload_mimes', __NAMESPACE__ . '\customize_upload_mimes');

/**
 * Remove navigation menu ID.
 * 
 * @param string  $menu
 * @return string Modified HTML string
 */
function remove_navigation_menu_id($menu)
{
    return preg_replace('/ id=\"(.*?)\"/i', '', $menu);
}
add_filter('wp_nav_menu', __NAMESPACE__ . '\remove_navigation_menu_id');

/**
 * Remove navigation menu item ID.
 * 
 * @param string  $menu_id
 * @param object  $menu_item
 * @return string
 */
function remove_navigation_menu_item_id($menu_id, $menu_item)
{
    return '';
}
add_filter('nav_menu_item_id', __NAMESPACE__ . '\remove_navigation_menu_item_id', 10, 2);

/**
 * Disable Gravity Forms CSS.
 *
 * @return bool
 */
add_filter('gform_disable_css', '__return_true');

/**
 * Customize Gravity Forms field content.
 *
 * @param string  $field_content
 * @param object  $field
 * @return string
 */
add_filter(
    'gform_field_content',
    function ($field_content, $field) {
        if ($field->type == 'textarea') {
            return str_replace("rows='10'", "rows='4'", $field_content);
        }
        return $field_content;
    },
    10,
    2
);
