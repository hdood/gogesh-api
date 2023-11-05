<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="">
<!-- Normalize CSS -->
<link rel="stylesheet" href="{{ asset('static/css/normalize.css') }}">
<!-- Main CSS -->
<link rel="stylesheet" href="{{ asset('static/css/main.css') }}">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('static/css/bootstrap.min.css') }}">
<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{ asset('static/css/all.min.css') }}">
<!-- Flaticon CSS -->
<link rel="stylesheet" href="{{ asset('static/css/flaticon.css') }}">
<!-- Full Calender CSS -->
<link rel="stylesheet" href="{{ asset('static/css/fullcalendar.min.css') }}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{ asset('static/css/animate.min.css') }}">


<!-- Modernize js -->

{{-- !icons --}}
<link rel="stylesheet" href="{{ asset('static/icons/feather/css/feather.css') }}">
<link rel="stylesheet" href="{{ asset('static/icons/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('static/icons/themify-icons/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('static/icons/icofont/css/icofont.css') }}">
<link rel="stylesheet" href="{{ asset('static/icons/simple-line-icons/css/simple-line-icons.css') }}">
<link rel="stylesheet" href="{{ asset('static/icons/typicons-icons/css/typicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('static/icons/material-design/css/material-design-iconic-font.min.css') }}">
<link rel="stylesheet" href="{{ asset('static/icons/flag-icons/css/flag-icon.css') }}">

<!-- Select 2 CSS -->
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}">
</link>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<!-- Date Picker CSS -->
<link rel="stylesheet" href="{{ asset('static/css/datepicker.min.css') }}">
</link>


<style type="text/css">
    * {
        font-weight: bold !important;
        letter-spacing: 0.5px;
        font-family: 'Tajawal', sans-serif !important;
    }

    /* .dashboard-content-one {
        font-weight: bold
    } */
    #contact-show .card-body {
        direction: ltr !important;
    }
</style>
@if (app()->getLocale() == 'ar')
    <style>
        #del_feature {
            left: 0;
        }
    </style>
@else
    <style>
        #del_feature {
            right: 0;
        }
    </style>
@endif
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
<script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('static/css/main2.css') }}">
<link rel="stylesheet" href="{{ asset('static/css/chat.css') }}">
<script src="{{ asset('static/js/chat/pusher.min.js') }}"></script>
