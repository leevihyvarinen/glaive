@if (has_nav_menu('mobile'))
    <div class="nav-wrapper-mobile js-nav-wrapper-mobile">
        <button
            class="nav-toggle-mobile js-nav-toggle-mobile"
            id="mobile-navigation-toggle"
            type="button"
            aria-controls="mobile-navigation"
            aria-expanded="false"
        >
            <span class="screen-reader-text">
                {{ __('Mobile Navigation', 'glaive') }}
            </span>
            <x-icon name="hamburger" />
        </button>
        <nav
            class="nav nav--mobile js-nav-mobile"
            id="mobile-navigation"
            aria-labelledby="mobile-navigation-toggle"
            aria-label="Mobiilinavigaatio"
            style="display: block; transform: translateX(100%)"
        >
            <button
                class="nav__close js-nav-close-mobile"
                id="mobile-navigation-close"
                type="button"
                aria-controls="mobile-navigation"
                aria-label="Sulje mobiilinavigaatio"
            >
                <x-icon name="close" />
            </button>

            {!!
                wp_nav_menu([
                    'theme_location' => 'mobile',
                    'container' => false,
                    'menu_class' => 'nav__menu',
                    'link_before' => '',
                    'link_after' => '',
                    'walker' => new App\Walker_Nav_Menu_2(),
                    'echo' => false,
                ])
            !!}
        </nav>
        <div
            class="nav-overlay-mobile js-nav-overlay-mobile"
            aria-hidden="true"
        ></div>
    </div>
@endif
