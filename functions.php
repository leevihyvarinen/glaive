<?php

/**
 * Register The Auto Loader.
 */
if (! file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'glaive'));
}

require $composer;

/**
 * Register The Bootloader.
 * 
 * @return void
 */
if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'glaive'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'glaive'),
        ]
    );
}

\Roots\bootloader()->boot();

/**
 * Register Glaive theme files.
 * 
 * @return void
 */
collect([
    'setup-theme',
    'setup-dashboard',
    'setup-tinymce',
    'filters',
    'walker-nav-menu-1',
    'walker-nav-menu-2'
])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'glaive'), $file)
            );
        }
    });
