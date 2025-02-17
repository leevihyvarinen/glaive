<?php

namespace App;

class Walker_Nav_Menu_2 extends \Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<ul class="nav__submenu">';
    }

    // Ends the list of after the elements are added.
    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</ul>';
    }

    // Starts the element output.
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        // Define class based on depth.
        $item_classes = ('nav__item nav__item--lvl-' . ($depth + 1));

        // Add '--children' class for items that have child items.
        if (in_array('menu-item-has-children', $item->classes)) {
            $item_classes .= (' nav__item--children');
        }

        // Add class based on whether the item has a link or not.
        if ($item->url === '#') {
            $item_classes .= (' nav__item--no-link');
        } else {
            $item_classes .= (' nav__item--link');
        }

        // Add '--current' class to the item if it is a current page.
        if (in_array('current-menu-item', $item->classes)) {
            $item_classes .= ' nav__item--current';
        }

        $output .= '<li class="' . esc_attr($item_classes) . '">';

        // Define the content of the <li> element.
        if (in_array('menu-item-has-children', $item->classes)) {
            if ($item->url === '#') {
                $output .= '<span>' . esc_html($item->title) . '</span>';
            } else {
                if (in_array('current-menu-item', $item->classes)) {
                    $output .= '<a href="' . esc_url($item->url) . '" aria-current="page">' . esc_html($item->title) . '</a>';
                } else {
                    $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
                }
            }
        } else {
            if ($item->url === '#') {
                $output .= '<span>' . esc_html($item->title) . '</span>';
            } elseif (in_array('current-menu-item', $item->classes)) {
                $output .= '<a href="' . esc_url($item->url) . '" aria-current="page">' . esc_html($item->title) . '</a>';
            } else {
                $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
            }
        }
    }

    // Ends the element output, if needed.
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }
}
