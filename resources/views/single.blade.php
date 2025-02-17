@php
    $current_post_id = get_the_ID();
    $args = [
        'post_type' => 'post',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
        'post__not_in' => [$current_post_id],
    ];

    $loop = new WP_Query($args);
@endphp

@extends('layouts.app')

@section('content')
    @while (have_posts())
        @php(the_post())
        <div class="page-single">
            <div class="page-single__post">
                <div class="page-single__container">
                    <article class="page-single__article">
                        @if (has_post_thumbnail())
                            <x-thumbnail size="large" />
                        @else
                            <div class="page-single__article__placeholder">
                                @php
                                    // file_get_contents(get_theme_file_path('/public/logos/logo.svg'))
                                @endphp
                            </div>
                        @endif

                        <div class="page-single__article__content">
                            <p datetime="{{ get_post_time('c', true) }}">
                                Julkaistu {{ the_date() }}
                            </p>

                            <h1>
                                {{ the_title() }}
                            </h1>

                            @php(the_content())
                        </div>
                    </article>
                </div>
            </div>

            @if ($loop->have_posts())
                <div class="page-single__latest-posts">
                    <div class="page-single__container">
                        <h2>
                            {{ __('Read also', 'glaive') }}
                        </h2>
                        <div class="page-single__post-loop">
                            @while ($loop->have_posts())
                                @php($loop->the_post())
                                @include('partials.teaser')
                            @endwhile

                            @php(wp_reset_postdata())
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endwhile
@endsection
