<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10 no-js" lang="{{App::getLocale()}}"><![endif]-->
<html class="no-js" lang="{{ App::getLocale() }}" data-url="{{ asset('/') }}">
    <head>
        @section('head')
            @include('web.molecules.head.default')
        @show
    </head>

    <body id="top" class="@section('body-classes')@show">
        <a class="accessibility-text-focusable skip-to-content" href="#content">{{ __('Saltar a contenido') }}</a>

        @section('header')
            @include('web.molecules.header.default')
        @show

        @section('flash')
            @include('web.atoms.alerts.flash')
        @show

        @section('errors')
            @include('web.atoms.alerts.errors')
        @show

        <div id="content">
            @yield('content')
        </div>

        @section('footer')
            @include('web.molecules.footer.default')
        @show

        {!! HtmlHelper::jsModule('common') !!}

        @section('footer-scripts')
        {!! HtmlHelper::jsModule('main') !!}
        @show
    </body>
</html>
