@extends('layouts.app')

@section('content')
    <div class="page-404">
        <div class="page-404__container">
            <div class="page-404__content">
                <h1>
                    {{ __('Error 404', 'glaive') }}
                </h1>
                <p>
                    {{ __('It seems that nothing was found. The page may have been moved or deleted.', 'glaive') }}
                </p>
                <x-button
                    title="{{ __('Go to homepage', 'glaive') }}"
                    href="{{ home_url('/') }}"
                    rel="home"
                />
            </div>
        </div>
    </div>
@endsection
