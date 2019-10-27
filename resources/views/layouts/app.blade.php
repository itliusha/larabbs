<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <!-- Csrf Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- title -->
    <title>@yield('title', 'laraBBS') -- Laravel进阶项目</title>
    <meta name="description" content="@yield('description', 'LaraBBS爱好者社区')">
    <!-- Styles -->
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
@if (app()->isLocal())
            @include('sudosu::user-selector')
        @endif
    <!-- script -->
    <script src="{{ mix('js/app.js') }}">

    </script>
    @yield('script')
</body>
</html>
