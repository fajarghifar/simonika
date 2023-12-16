<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.webp') }}" />
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    <!-- Custom CSS for specific page.  -->
    @stack('page-styles')
</head>
<body >
    <div class="page">
        <!-- BEGIN : Navbar -->
        @include('dashboard.body.navbar')
        <!-- END : Navbar -->

        <div class="page-wrapper">

            <!-- BEGIN : Content -->
            @yield('content')
            <!-- END : Content -->

            <!-- BEGIN : Navbar -->
            @include('dashboard.body.footer')
            <!-- END : Navbar -->
        </div>
    </div>

    <!-- Libs JS -->
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4c897dc313.js" crossorigin="anonymous"></script>
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>

    <!-- Custom JS for specific page.  -->
    @stack('page-scripts')
</body>
</html>
