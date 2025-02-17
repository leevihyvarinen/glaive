@php
    global $wp_query;

    $navClass = 'pagination';
    $itemClass = $navClass . '__item';
    $currentPage = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $totalPages = intval($wp_query->max_num_pages);

    if ($totalPages <= 1) {
        return;
    }

    $pageLinks = [];

    if ($totalPages === 2) {
        $pageLinks = [1, 2];
    } elseif ($currentPage === 1) {
        $pageLinks = [1, 2, 3];
    } elseif ($currentPage === $totalPages) {
        $pageLinks = [$totalPages - 2, $totalPages - 1, $totalPages];
    } else {
        if ($currentPage > 1) {
            $pageLinks[] = $currentPage - 1;
        }
        $pageLinks[] = $currentPage;
        if ($currentPage < $totalPages) {
            $pageLinks[] = $currentPage + 1;
        }
    }

    $previousPageLink = get_previous_posts_link('');
    $nextPageLink = get_next_posts_link('');
@endphp

<nav
    class="{{ $navClass }}"
    aria-label="{{ __('Page Navigation', 'glaive') }}"
>
    <ul class="{{ $navClass }}__items">
        @if ($previousPageLink)
            <li class="{{ $itemClass }} {{ $itemClass }}--prev">
                {!! preg_replace('/<a(.*?)>/', '<a$1 aria-label="' . __('Go to previous page', 'glaive') . '">', str_replace('</a>', '<svg class="icon icon--arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" height="24px" width="24px" fill="none"><path fill="currentColor" d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z" /></svg></a>', $previousPageLink)) !!}
            </li>
        @endif

        @if (! in_array(1, $pageLinks))
            <li
                class="{{ $itemClass }}{{ $currentPage == 1 ? ' ' . $itemClass . '--current' : '' }}"
            >
                <a
                    href="{{ esc_url(get_pagenum_link(1)) }}"
                    aria-label="{{ $currentPage == 1 ? __('Current page, page 1', 'glaive') : __('Go to page 1', 'glaive') }}"
                    {{ $currentPage == 1 ? 'aria-current="page"' : '' }}
                >
                    1
                </a>
            </li>
            @unless (in_array(2, $pageLinks))
                <li class="{{ $itemClass }} {{ $itemClass }}--hellip">
                    &hellip;
                </li>
            @endunless
        @endif

        @foreach ($pageLinks as $pageLink)
            <li
                class="{{ $itemClass }}{{ $currentPage == $pageLink ? ' ' . $itemClass . '--current' : '' }}"
            >
                <a
                    href="{{ esc_url(get_pagenum_link($pageLink)) }}"
                    aria-label="{{ $currentPage == $pageLink ? ($currentPage == $totalPages ? __('Current and last page, page', 'glaive') : __('Current page, page', 'glaive')) . " $pageLink" : __('Go to page', 'glaive') . " $pageLink" }}"
                    {{ $currentPage == $pageLink ? 'aria-current="page"' : '' }}
                >
                    {{ $pageLink }}
                </a>
            </li>
        @endforeach

        @if (! in_array($totalPages, $pageLinks))
            @unless (in_array($totalPages - 1, $pageLinks))
                <li class="{{ $itemClass }} {{ $itemClass }}--hellip">
                    &hellip;
                </li>
            @endunless

            <li
                class="{{ $itemClass }}{{ $currentPage == $totalPages ? ' ' . $itemClass . '--current' : '' }}"
            >
                <a
                    href="{{ esc_url(get_pagenum_link($totalPages)) }}"
                    aria-label="{{ $currentPage == $totalPages ? __('Current and last page, page', 'glaive') : __('Go to last page, page', 'glaive') }} {{ $totalPages }}"
                    {{ $currentPage == $totalPages ? 'aria-current="page"' : '' }}
                >
                    {{ $totalPages }}
                </a>
            </li>
        @endif

        @if ($nextPageLink)
            <li class="{{ $itemClass }} {{ $itemClass }}--next">
                {!! preg_replace('/<a(.*?)>/', '<a$1 aria-label="' . __('Go to next page', 'glaive') . '">', str_replace('</a>', '<svg class="icon icon--arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" height="24px" width="24px" fill="none"><path fill="currentColor" d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z" /></svg></a>', $nextPageLink)) !!}
            </li>
        @endif
    </ul>
</nav>
