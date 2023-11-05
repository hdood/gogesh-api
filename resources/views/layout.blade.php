<!DOCTYPE html>
<!-- saved from url=(0070) -->
<html
    class="js sizes customelements history pointerevents postmessage webgl websockets cssanimations csscolumns csscolumns-width csscolumns-span csscolumns-fill csscolumns-gap csscolumns-rule csscolumns-rulecolor csscolumns-rulestyle csscolumns-rulewidth csscolumns-breakbefore csscolumns-breakafter csscolumns-breakinside flexbox picture srcset webworkers"
    lang="" ml-update="aware">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Gogesh | @yield('title', 'Home')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    {{-- @vite('') --}}
    @include('tools.header')
    @if (app()->getlocale() == 'ar')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500&display=swap"
            rel="stylesheet">
        @include('partials.style_ar')
    @endif
    @yield('style')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="{{ asset('build/assets/app-9510a2f3.js') }}"></script> --}}
</head>

<body data-lang="{{ app()->getLocale() }}">
    <!-- Preloader Start Here -->
    {{-- <div id="preloader"></div> --}}
    <!-- Preloader End Here -->

    <div id="wrapper" class="wrapper bg-ash">

        <!-- Header Menu Area Start Here -->
        @include('partials.header')
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one"
            @if (app()->getlocale() == 'ar') style="
            direction: rtl;
        " @endif>
            <!-- Sidebar Area Start Here -->
            @include('partials.sidebar')
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one" @yield('app')>
                @yield('content')
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>

    @include('tools.footer')
    <script>
        // $('#conversation').scrollTop($(document).height());

        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: 'eu'
        });


        const channel_public = pusher.subscribe('public');
        var currentNumber = parseInt($('#count-message').text());

        channel_public.bind('public', function(data) {
            $.post('/dashboard/receive', {
                    _token: '{{ csrf_token() }}',
                    contact: data['contact'],
                })
                .done(function(res) {
                    currentNumber++;
                    $('#count-message').text(currentNumber);
                    var audio = new Audio('newmessage.mp3');
                    audio.play();
                    // console.log(res);

                    // $('#count-message');
                    $('#notification-message').prepend(res)
                    $('#contacts').prepend(res)

                });
        });
    </script>

    @yield('script')

</body>

</html>
