@extends('layouts.app')

@section('content')
    @while (have_posts())
        @php(the_post())
        <div class="page-blocks">
            @if (have_rows('blocks'))
                @while (have_rows('blocks'))
                    @php(the_row())
                    @include('blocks.' . get_row_layout())
                @endwhile
            @endif
        </div>
    @endwhile
@endsection
