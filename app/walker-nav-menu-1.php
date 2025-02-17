<?php

namespace App;

class Walker_Nav_Menu_1 extends \Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        if ($depth === 0) {
            $output .= '<div class="nav__submenu-collapse js-submenu-collapse" style="display: none;">';
            $output .= '<ul class="nav__submenu">';
        } else {
            $output .= '<ul class="nav__submenu">';
        }
    }

    // Ends the list of after the elements are added.
    function end_lvl(&$output, $depth = 0, $args = null)
    {
        if ($depth === 0) {
            $output .= '</ul>';
            $output .= '</div>';
        } else {
            $output .= '</ul>';
        }
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
                if ($depth === 0) {
                    $output .= '<button class="nav__submenu-toggle js-submenu-toggle">';
                    $output .= esc_html($item->title);
                    $output .= '<svg class="icon icon--chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="-1.25 -1.25 14 14"><path d="m0.4107142857142857 3.2857142857142856 5.0488696428571425 5.048828571428571c0.16039214285714284 0.16042499999999998 0.4204399999999999 0.16042499999999998 0.5808321428571428 0L11.089285714285714 3.2857142857142856" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path></svg>';
                    $output .= '<svg class="icon icon--chevron-up" xmlns="http://www.w3.org/2000/svg" viewBox="-1.25 -1.25 14 14"><path d="m0.4107142857142857 8.214285714285714 5.0488696428571425 -5.0488696428571425c0.16039214285714284 -0.16039214285714284 0.4204399999999999 -0.16039214285714284 0.5808321428571428 0L11.089285714285714 8.214285714285714" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path></svg>';
                    $output .= '</button>';
                } else {
                    $output .= '<span>' . esc_html($item->title) . '</span>';
                }
            } else {
                if (in_array('current-menu-item', $item->classes)) {
                    $output .= '<a href="' . esc_url($item->url) . '" aria-current="page">' . esc_html($item->title) . '</a>';
                } else {
                    $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
                }
                if ($depth === 0) {
                    $output .= '<button class="nav__submenu-toggle js-submenu-toggle">';
                    $output .= '<svg class="icon icon--chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="-1.25 -1.25 14 14"><path d="m0.4107142857142857 3.2857142857142856 5.0488696428571425 5.048828571428571c0.16039214285714284 0.16042499999999998 0.4204399999999999 0.16042499999999998 0.5808321428571428 0L11.089285714285714 3.2857142857142856" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path></svg>';
                    $output .= '<svg class="icon icon--chevron-up" xmlns="http://www.w3.org/2000/svg" viewBox="-1.25 -1.25 14 14"><path d="m0.4107142857142857 8.214285714285714 5.0488696428571425 -5.0488696428571425c0.16039214285714284 -0.16039214285714284 0.4204399999999999 -0.16039214285714284 0.5808321428571428 0L11.089285714285714 8.214285714285714" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path></svg>';
                    $output .= '</button>';
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
