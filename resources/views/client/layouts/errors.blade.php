<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>error</title>
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
    @stack('styles')
</head>

<body>
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    @yield('content')
</div>


<script src="{{ asset('client/js/bootstrap.min.js') }}"></script>

@stack('scripts')
</body>

</html>
