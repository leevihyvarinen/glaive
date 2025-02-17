@extends('layouts.app')

@section('content')
    <div class="page-index">
        <div class="page-index__hero">
            <div class="page-index__container">
                <div class="page-index__content">
                    <h1>
                        {{ __('Blog', 'glaive') }}
                    </h1>
                </div>
            </div>
        </div>

        @if (have_posts())
            <div class="page-index__posts">
                <div class="page-index__container">
                    <div class="page-index__post-loop">
                        @while (have_posts())
                            @php(the_post())

                            @include('partials.teaser')
                        @endwhile
                    </div>

                    @include('partials.pagination')
                </div>
            </div>
        @else
            <div class="page-index__posts-not-found">
                <div class="page-index__container">
                    <p>{{ __('No posts found.', 'glaive') }}</p>
                </div>
            </div>
        @endif
    </div>
@endsection
