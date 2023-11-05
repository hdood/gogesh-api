
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ecommerce | @yield('title', 'Home')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('static/img/ecommerce.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('static/css/checkout.css') }}">

</head>

<body>

    <div class="container" style="padding: 15px">
        @yield('content')
    </div>

    @include('tools.footer')
    @yield('script')

</body>

</html>
