<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!!
        \Fomvasss\Seo\Facades\Seo::setDefault([
            'og_site_name' => config('app.name'),
            'og_url' => URL::full(),
            'og_locale' => app()->getLocale(),
        ])->renderHtml()
    !!}
    <script src="{{ asset('client/js/jquery-3.3.1.min.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('/client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/elegant-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('/client/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/app.css') }}">
    @stack('styles')
</head>

<body>

@include('client.layouts.inc.preloder')
@include('client.layouts.inc.offcanvas-menu')
@include('client.layouts.inc.header')

@yield('content')

@include('client.layouts.inc.footer')
@include('client.layouts.inc.search')


<script src="{{ asset('/client/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('/client/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('/client/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('/client/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('/client/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('/client/js/mixitup.min.js') }}"></script>
<script src="{{ asset('/client/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/client/js/main.js') }}"></script>
@stack('scripts')
</body>

</html>
