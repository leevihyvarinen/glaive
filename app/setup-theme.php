<?php

namespace App;

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Load the theme textdomain.
     * 
     * @link https://developer.wordpress.org/reference/functions/load_theme_textdomain/
     */
    load_theme_textdomain('glaive', get_template_directory() . '/languages');

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        // 'comment-form',
        // 'comment-list',
        'gallery',
        // 'search-form',
        'script',
        'style',
    ]);

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'main' => __('Main Menu', 'glaive'),
        'mobile' => __('Mobile Menu', 'glaive'),
    ]);
}, 20);

/**
 * Register the theme styles and scripts.
 * 
 * @return void
 */
add_action(
    'wp_enqueue_scripts',
    function () {
        // Styles
        $cssFilePath = glob(get_template_directory() . '/public/styles/style.min.*.css');
        $cssFileURI = get_template_directory_uri() . '/public/styles/' . basename($cssFilePath[0]);
        wp_enqueue_style('glaive_style', $cssFileURI);

        // Scripts
        $jsFilePath = glob(get_template_directory() . '/public/scripts/main.min.*.js');
        $jsFileURI = get_template_directory_uri() . '/public/scripts/' . basename($jsFilePath[0]);
        wp_enqueue_script('glaive_script', $jsFileURI, ['jquery'], '1.0', true);
    }
);
