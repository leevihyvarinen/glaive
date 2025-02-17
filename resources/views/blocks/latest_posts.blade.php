@php
    $title = get_sub_field('title');
    $categories = get_sub_field('categories');
@endphp

<div class="block block--latest-posts block--no-bg">
    <div class="block__container">
        @if ($title)
            <div class="block__row">
                @if ($title)
                    <h2>{{ $title }}</h2>
                @endif

                <x-arrow-link
                    title="{{ __('All posts', 'glaive') }}"
                    href="{{ get_post_type_archive_link('post') }}"
                />
            </div>
        @endif

        @php
            $args = [
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
            ];

            if ($categories) {
                $args['tax_query'] = [
                    [
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $categories,
                    ],
                ];
            }

            $loop = new WP_Query($args);
        @endphp

        @if ($loop->have_posts())
            <div class="block__post-loop">
                @while ($loop->have_posts())
                    @php($loop->the_post())
                    @include('partials.teaser')
                @endwhile

                @php(wp_reset_postdata())
            </div>
        @else
            <div class="block__no-posts-found">
                <p>{{ __('No posts found.', 'glaive') }}</p>
            </div>
        @endif
    </div>
</div>
