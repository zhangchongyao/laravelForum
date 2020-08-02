<!DOCUMENT html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatiable" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Forum') - {{  setting('site_name', '2020美国大选')}}</title>
    <meta name="description" content="@yield('description', setting('seo_description', '2020美国选'))">
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', 'Forum社区，论坛，2020美国大选'))">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>

<body>
    <div id="app" class="{{ route_class() }}-page">

        @include('layouts._header')

        <div class="container">

            @include('shared._messages')

            @yield('content')

        </div>

        @include('layouts._footer')

    </div>

    {{--@if(app()->isLocal())
        @include('sudosu::user-selector')
    @endif--}}

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
