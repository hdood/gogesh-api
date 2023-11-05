<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login page</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <style>
        input {
            direction: ltr
        }
    </style>
    @include('tools.header')
</head>

<body>
    <div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo mb-0">
                    <img src="{{ asset('logo.svg') }}" width="150" alt="logo">
                    <div class="row justify-content-center align-items-center my-3">
                        <p class="col-8">{{ __("It's great to see you! Welcome to Gogesh dashboard.") }}
                        </p>
                    </div>
                </div>
                <form action="{{ route('auth.login') }}" method="post" class="login-form">
                    @csrf
                    <div class="form-group">
                        <label
                            style="width:100% ;@if (app()->getLocale() == 'ar') text-align:right @endif">{{ __('email') }}</label>
                        <input name="email" type="text" placeholder="{{ __('Enter email') }}" class="form-control">
                        <i class="ti-email"></i>
                    </div>
                    @error('email')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                    <div class="form-group">
                        <label
                            style="width:100% ;@if (app()->getLocale() == 'ar') text-align:right @endif">{{ __('Password') }}</label>
                        <input name="password" type="password" id="password" placeholder="{{ __('Enter password') }}"
                            class="form-control">
                        <i class="fa fa-lock " style="cursor: pointer" id="toggleButton"></i>
                    </div>
                    @error('password')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                    <div class="form-group">
                        <button type="submit" class="login-btn">{{ __('Login') }}</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <script src="{{ asset('static/js/jquery-3.3.1.min.js') }}"></script>

    <script src="{{ asset('static/js/scriptJq.js') }}"></script>
</body>

</html>
