<form
    class="search-form"
    role="search"
    method="get"
    action="{{ home_url('/') }}"
>
    <label>
        <span class="sr-only">
            {{ _x('Search for:', 'label', 'glaive') }}
        </span>

        <input
            type="search"
            placeholder="{!! esc_attr_x('Search &hellip;', 'placeholder', 'glaive') !!}"
            value="{{ get_search_query() }}"
            name="s"
        />
    </label>

    <button>{{ _x('Search', 'submit button', 'glaive') }}</button>
</form>
