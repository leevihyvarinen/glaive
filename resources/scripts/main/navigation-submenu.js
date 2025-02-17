/**
 * navigation-submenu.js
 */
const navigationSubmenu = () => {
    const submenuToggles = document.querySelectorAll('.js-submenu-toggle');
    const submenuCollapses = document.querySelectorAll('.js-submenu-collapse');

    submenuToggles.forEach(function (submenuToggle, index) {
        const submenuToggleId = 'submenu-toggle-' + (index + 1);
        const submenuId = 'submenu-collapse-' + (index + 1);
        submenuToggle.setAttribute('id', submenuToggleId);
        submenuToggle.setAttribute('aria-controls', submenuId);
        submenuToggle.setAttribute('aria-expanded', 'false');

        submenuToggle.addEventListener('click', function () {
            toggleSubmenu(submenuToggle);
            submenuToggle.classList.toggle('js-submenu-toggle--active');
            submenuToggle.setAttribute(
                'aria-expanded',
                submenuToggle.classList.contains('js-submenu-toggle--active')
                    ? 'true'
                    : 'false',
            );
        });

        submenuToggle.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });

    submenuCollapses.forEach(function (submenuCollapse, index) {
        const submenuCollapseId = 'submenu-collapse-' + (index + 1);
        submenuCollapse.setAttribute('id', submenuCollapseId);
        submenuCollapse.setAttribute(
            'aria-labelledby',
            'submenu-toggle-' + (index + 1),
        );
        submenuCollapse.style.display = 'none';
        submenuCollapse.style.height = '0';
    });

    function toggleSubmenu(activeSubmenuToggle) {
        submenuCollapses.forEach(function (submenuCollapse) {
            const submenuToggle = submenuCollapse.previousElementSibling;
            if (submenuToggle === activeSubmenuToggle) {
                submenuCollapse.classList.toggle('js-submenu-collapse--active');
                if (
                    submenuCollapse.classList.contains(
                        'js-submenu-collapse--active',
                    )
                ) {
                    submenuCollapse.style.display = 'block';
                    submenuCollapse.style.height =
                        submenuCollapse.scrollHeight + 'px';
                } else {
                    submenuCollapse.style.height = '0';
                    setTimeout(function () {
                        submenuCollapse.style.display = 'none';
                    }, 125);
                }
            } else {
                submenuCollapse.classList.remove('js-submenu-collapse--active');
                submenuCollapse.style.height = '0';
                setTimeout(function () {
                    submenuCollapse.style.display = 'none';
                }, 125);
            }
        });
    }

    document.addEventListener('click', function (event) {
        submenuToggles.forEach(function (submenuToggle) {
            if (
                !submenuToggle.contains(event.target) &&
                !submenuToggle.nextElementSibling.contains(event.target)
            ) {
                submenuToggle.classList.remove('js-submenu-toggle--active');
                submenuToggle.setAttribute('aria-expanded', 'false');
            }
        });

        submenuCollapses.forEach(function (submenuCollapse) {
            if (!submenuCollapse.contains(event.target)) {
                submenuCollapse.classList.remove('js-submenu--active');
            }
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            submenuToggles.forEach(function (submenuToggle) {
                submenuToggle.classList.remove('js-submenu-toggle--active');
                submenuToggle.setAttribute('aria-expanded', 'false');
            });

            submenuCollapses.forEach(function (submenuCollapse) {
                submenuCollapse.classList.remove('js-submenu--active');
            });
        }
    });
};

export default navigationSubmenu;
