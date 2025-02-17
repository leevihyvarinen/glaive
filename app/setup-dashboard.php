<?php

namespace App;

/**
 * Customize admin head.
 * 
 * @return void
 */
function customize_admin_head()
{
    remove_action('welcome_panel', 'wp_welcome_panel');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}
add_action('admin_head', __NAMESPACE__ . '\customize_admin_head');

/**
 * Disable Customizer.
 * 
 * @return void
 */
function disable_customizer()
{
    if (is_admin() && isset($_SERVER['SCRIPT_NAME']) && basename($_SERVER['SCRIPT_NAME']) === 'customize.php') {
        wp_die(__('Customizer has been disabled.', 'glaive'));
    }

    $customize_url = add_query_arg('return', urlencode(remove_query_arg(wp_removable_query_args(), wp_unslash($_SERVER['REQUEST_URI']))), 'customize.php');
    remove_submenu_page('themes.php', $customize_url);
}
add_action('admin_menu', __NAMESPACE__ . '\disable_customizer');
add_action('admin_init', __NAMESPACE__ . '\disable_customizer');

/**
 * Disable Patterns.
 * 
 * @return void
 */
function disable_patterns()
{
    remove_submenu_page('themes.php', 'site-editor.php?path=/patterns');

    if (is_admin() && isset($_GET['postType']) && sanitize_text_field($_GET['postType']) === 'wp_block' && strpos(esc_url_raw($_SERVER['REQUEST_URI']), 'site-editor.php') !== false) {
        wp_die(__('Patterns has been disabled.', 'glaive'));
    }
}
add_action('admin_init', __NAMESPACE__ . '\disable_patterns');
add_action('admin_menu', __NAMESPACE__ . '\disable_patterns');

/**
 * Disable comments.
 * 
 * @return void
 */
function disable_comments()
{
    global $pagenow;

    if (is_admin()) {
        if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
            wp_die(__('Comments have been disabled.', 'glaive'));
        }
    }

    update_option('default_comment_status', 'closed');
    update_option('default_ping_status', 'closed');

    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');

    add_action('admin_menu', function () {
        remove_meta_box('commentstatusdiv', 'post', 'normal');
        remove_meta_box('commentstatusdiv', 'page', 'normal');
        remove_meta_box('commentsdiv', 'post', 'normal');
        remove_meta_box('commentsdiv', 'page', 'normal');
        remove_menu_page('edit-comments.php');
        remove_submenu_page('options-general.php', 'options-discussion.php');
    });
}
add_action('admin_init', __NAMESPACE__ . '\disable_comments');
add_action('init', __NAMESPACE__ . '\disable_comments', 100);

/**
 * Required plugins notice.
 */
function required_plugins_notice()
{
    $required_plugins = [
        'Advanced Custom Fields PRO' => 'advanced-custom-fields-pro/acf.php',
        'Classic Editor'             => 'classic-editor/classic-editor.php',
        'Imagify'                    => 'imagify/imagify.php',
    ];

    $missing_plugins = [];

    foreach ($required_plugins as $name => $plugin) {
        if (!is_plugin_active($plugin)) {
            $missing_plugins[] = $name;
        }
    }

    if (!empty($missing_plugins)) {
        $message = 'The following plugins required by the theme are missing: ' . implode(', ', $missing_plugins) . '.';
        echo '<div class="error"><p>' . $message . '</p></div>';
    }
}
add_action('admin_notices', __NAMESPACE__ . '\required_plugins_notice');

/**
 * Customize Admin CSS.
 */
function customize_admin_css()
{
    echo
    '<style>
        #wpadminbar #wp-toolbar #wp-admin-bar-root-default #wp-admin-bar-wp-logo {
            display: none !important;
        }

        #wpadminbar #wp-toolbar #wp-admin-bar-root-default #wp-admin-bar-comments {
            display: none !important;
        }

        #screen-meta #adv-settings .metabox-prefs:nth-child(2),
        #menu-to-edit .menu-item .menu-item-settings .field-title-attribute,
        #menu-to-edit .menu-item .menu-item-settings .field-link-target,
        #menu-to-edit .menu-item .menu-item-settings .field-css-classes,
        #menu-to-edit .menu-item .menu-item-settings .field-xfn,
        #menu-to-edit .menu-item .menu-item-settings .field-description {
            display: none !important;
        }

        .postbox.acf-postbox > .postbox-header > .handle-actions a.acf-hndle-cog {
            display: none !important;
        }

        .acf-field.acf-field-flexible-content > .acf-label {
            display: none !important;
        }

        .acf-field.acf-field-flexible-content > .acf-input > .acf-flexible-content > .no-value-message {
            display: none !important;
        }

        .acf-field.acf-field-flexible-content > .acf-input > .acf-flexible-content > .acf-actions {
            padding: 16px !important;
            border: #ccc dashed 2px !important;
        }

        .acf-tooltip.top[class="acf-tooltip top"],
        .acf-tooltip.right[class="acf-tooltip right"],
        .acf-tooltip.bottom[class="acf-tooltip bottom"],
        .acf-tooltip.left[class="acf-tooltip left"] {
            opacity: 0 !important;
        }

        .limited-full-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(7),
        .limited-full-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(8),
        .limited-full-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(9),
        .limited-full-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(11),
        .limited-full-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(12),
        .limited-full-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(13) {
            display: none !important;
        }

        .limited-basic-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(3),
        .limited-basic-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(4),
        .limited-basic-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(5),
        .limited-basic-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(8),
        .limited-basic-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(9),
        .limited-basic-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(10),
        .limited-basic-wysiwyg-editor .mce-btn-group .mce-btn:nth-child(14) {
            display: none !important;
        }
    </style>';
}
add_action('admin_head', __NAMESPACE__ . '\customize_admin_css');
