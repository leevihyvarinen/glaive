@extends('layouts.app')

@section('content')
    <div class="page-archive">
        <div class="page-archive__hero">
            <div class="page-archive__container">
                <div class="page-archive__content">
                    <h1>
                        @if (is_post_type_archive())
                            {{ post_type_archive_title() }}
                        @else
                            {{ single_term_title() }}
                        @endif
                    </h1>
                </div>
            </div>
        </div>

        @if (have_posts())
            <div class="page-archive__posts">
                <div class="page-archive__container">
                    <div class="page-archive__post-loop">
                        @while (have_posts())
                            @php(the_post())

                            @include('partials.teaser')
                        @endwhile
                    </div>

                    @include('partials.pagination')
                </div>
            </div>
        @else
            <div class="page-archive__posts-not-found">
                <div class="page-archive__container">
                    <p>{{ __('No posts found.', 'glaive') }}</p>
                </div>
            </div>
        @endif
    </div>
@endsection
