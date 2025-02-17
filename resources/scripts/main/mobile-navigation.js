/**
 * mobile-navigation.js
 */
const mobileNavigation = () => {
    const navWrapperMobile = document.querySelector('.js-nav-wrapper-mobile');
    const navToggleMobile = document.querySelector('.js-nav-toggle-mobile');
    const navMobile = document.querySelector('.js-nav-mobile');
    const navCloseMobile = document.querySelector('.js-nav-close-mobile');
    const navOverlayMobile = document.querySelector('.js-nav-overlay-mobile');

    function showNavigation() {
        navMobile.style.display = 'block';
        setTimeout(() => {
            navMobile.style.transform = 'translateX(0)';
        }, 200);
    }

    function closeNavigation() {
        document.body.classList.remove('js-nav-mobile-is-active');
        navToggleMobile.classList.remove('js-nav-toggle-mobile--active');
        navToggleMobile.setAttribute('aria-expanded', 'false');
        navMobile.classList.remove('js-nav-mobile--active');
        navOverlayMobile.classList.remove('js-nav-overlay-mobile--active');
        navMobile.style.transform = 'translateX(100%)';
        setTimeout(() => {
            navMobile.style.display = 'none';
        }, 200);
    }

    navToggleMobile.addEventListener('click', function () {
        navToggleMobile.classList.toggle('js-nav-toggle-mobile--active');

        const isActive = navToggleMobile.classList.contains(
            'js-nav-toggle-mobile--active',
        );
        navToggleMobile.setAttribute(
            'aria-expanded',
            isActive ? 'true' : 'false',
        );

        if (isActive) {
            document.body.classList.add('js-nav-mobile-is-active');
            navMobile.classList.add('js-nav-mobile--active');
            navOverlayMobile.classList.add('js-nav-overlay-mobile--active');
            showNavigation();
        } else {
            closeNavigation();
        }
    });

    navCloseMobile.addEventListener('click', function () {
        closeNavigation();
    });

    document.addEventListener('click', function (event) {
        if (!navWrapperMobile.contains(event.target)) {
            closeNavigation();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeNavigation();
        }
    });
};

export default mobileNavigation;
