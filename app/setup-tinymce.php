<?php

namespace App;

/**
 * Customize the TinyMCE heading levels.
 *
 * @param array  $settings
 * @return array Modified $settings
 */
function customize_tinymce_heading_levels($settings)
{
    $settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;';

    return $settings;
}
add_filter('tiny_mce_before_init', __NAMESPACE__ . '\customize_tinymce_heading_levels');

/**
 * Customize the TinyMCE buttons.
 *
 * This function modifies the buttons available in the TinyMCE editor by
 * setting a custom array of buttons.
 *
 * @param array  $buttons
 * @return array Modified $buttons
 */
function customize_tinymce_buttons($buttons)
{
    $buttons = [
        'formatselect',
        'bold',
        'italic',
        'bullist',
        'numlist',
        // 'blockquote',
        'link',
        'unlink',
        'charmap',
        // 'alignleft',
        // 'aligncenter',
        // 'alignright',
        'undo',
        'redo',
        'wp_help',
    ];

    return $buttons;
}
add_filter('mce_buttons', __NAMESPACE__ . '\customize_tinymce_buttons');

/**
 * Customize the TinyMCE buttons 2.
 * 
 * This function hooks into the 'mce_buttons_2' filter to remove all buttons
 * from the second row of the TinyMCE editor.
 * 
 * @param array  $buttons
 * @return array Modified $buttons
 */
function customize_tinymce_buttons_2($buttons)
{
    $buttons = [];

    return $buttons;
}
add_filter('mce_buttons_2', __NAMESPACE__ . '\customize_tinymce_buttons_2');

/**
 * Customize the TinyMCE styles.
 */
function customize_tinymce_styles()
{
    echo
    '<style>
        .wp-editor-container .quicktags-toolbar {
            display: none !important;
        }
    </style>';
}
add_action('admin_head', __NAMESPACE__ . '\customize_tinymce_styles');
