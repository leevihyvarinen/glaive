@if (has_nav_menu('main'))
    <div class="nav-wrapper nav-wrapper--main">
        <nav
            class="nav nav--main"
            aria-label="{{ __('Main Navigation', 'glaive') }}"
        >
            {!!
                wp_nav_menu([
                    'theme_location' => 'main',
                    'container' => false,
                    'menu_class' => 'nav__menu',
                    'link_before' => '',
                    'link_after' => '',
                    'walker' => new App\Walker_Nav_Menu_2(),
                    'echo' => false,
                ])
            !!}
        </nav>
    </div>
@endif
