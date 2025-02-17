<div class="teaser">
    @if (has_post_thumbnail())
        <x-thumbnail size="large" />
    @else
        <div class="teaser__placeholder">
            {!! file_get_contents(get_theme_file_path('/public/logos/skillpro.svg')) !!}
        </div>
    @endif

    <div class="teaser__content">
        <h3>
            <a href="{{ get_permalink() }}">{{ the_title() }}</a>
        </h3>
        <p datetime="{{ get_post_time('c', true) }}">
            {!! __('Published on', 'glaive') . '&nbsp;' . get_the_date() !!}
        </p>
    </div>
</div>
