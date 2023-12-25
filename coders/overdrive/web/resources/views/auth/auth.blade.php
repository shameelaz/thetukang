<!doctype html>
<html class="loading" data-textdirection="ltr">
    <!-- BEGIN: Head-->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description"
            content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
        <meta name="keywords"
            content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
        <meta name="author" content="ThemeSelect">
        <link rel="apple-touch-icon"
            href="{{asset('overide/web/themes/apim/default/images/favicon/apple-touch-icon-152x152.png')}}">
        <link rel="shortcut icon" type="image/x-icon"
            href="{{asset('overide/web/themes/apim/default/images/favicon/favicon-32x32.png')}}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>@yield('site.title', "Welcome Home") | {{ config('app.name') }}</title>

        @stack('style')



        <link rel="stylesheet" type="text/css"
            href="{{asset('overide/web/themes/apim/default/vendors/sweetalert/sweetalert.css')}}">

        @vite(['resources/js/app.js'])

        <style type="text/css">
            .swal-title {
                color: rgba(0, 0, 0, .65);
                font-weight: 600;
                text-transform: none;
                position: relative;
                display: block;
                padding: 13px 16px;
                font-size: 18px;
                line-height: normal;
                text-align: center;
                margin-bottom: 0;
                word-wrap: break-word;
            }
        </style>


    </head>
    <!-- END: Head-->

    <body>

        @include('web::perakepay.frontend.includes.header')

        @yield('content')
        <div class="content-overlay"></div>

        @include('web::perakepay.frontend.includes.footer')

        <!-- END: Footer-->
        <!-- BEGIN VENDOR JS-->
        <script src="{{asset('overide/web/themes/apim/default/js/vendors.min.js')}}"></script>
        <!-- BEGIN VENDOR JS-->
        <!-- BEGIN PAGE VENDOR JS-->
        <!-- END PAGE VENDOR JS-->
        <!-- BEGIN THEME  JS-->
        <script src="{{asset('overide/web/themes/apim/default/js/plugins.js')}}"></script>

        <!--     <script src="../../../app-assets/js/search.js"></script>
    <script src="{{asset('overide/web/themes/apim/default/js/vendors.min.js')}}"></script> -->

        <script src="{{asset('overide/web/themes/apim/default/js/custom/custom-script.js')}}"></script>

        <script src="{{asset('overide/web/themes/apim/default/vendors/sweetalert/sweetalert.min.js')}}"></script>

        <!-- END THEME  JS-->
        <!-- BEGIN PAGE LEVEL JS-->


        @if (!empty(Session::get('errors')))


        <?php 

            $error = ( Session::get('errors')->default->messages());
            $message = $error['email'][0];

         ?>

        <script type="text/javascript">
            swal({
                title: '{!! $message !!}',
                icon: 'error'
            })
        </script>


        @endif


        @include('web::auth.message')


        <!-- END PAGE LEVEL JS-->
    </body>

</html>