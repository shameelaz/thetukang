<!DOCTYPE html>
<!--
Template Name: Rubick - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('theme/assets/images/lhdn.png') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
         <title>@yield('site.title', "Welcome Home") | {{ config('app.name') }}</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset('theme2/assets/css/app.css')}}" />

         <!-- BEGIN: VENDOR CSS-->

    <link rel="stylesheet" href="{{asset('theme/assets/vendors/vendors.min.css')}}">

<!--     <link rel="stylesheet" href="{{asset('theme/assets/css/themes/horizontal-menu-template/materialize.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/themes/horizontal-menu-template/style.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/layouts/style-horizontal.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/pages/login.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/custom/custom.css')}}"> -->
    
    <link rel="stylesheet" type="text/css" href="{{asset('theme/assets/vendors/sweetalert/sweetalert.css')}}">
        <!-- END: CSS Assets-->
    </head>
    <img src="{{ env('SSOLOGOUT'), '' }}" style="display:none;" />
    <!-- END: Head -->
    <body class="login" style="
    background-color: #efef74;">

        @yield('content')

        <!-- BEGIN: JS Assets-->
    <script src="{{asset('theme2/assets/js/app.js')}}"></script>

           <!-- BEGIN VENDOR JS-->
    <script src="{{asset('theme/assets/js/vendors.min.js')}}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset('theme/assets/js/plugins.js')}}"></script>

<!--     <script src="../../../app-assets/js/search.js"></script>
    <script src="{{asset('theme/assets/js/vendors.min.js')}}"></script> -->

    <script src="{{asset('theme/assets/js/custom/custom-script.js')}}"></script>

    <script src="{{asset('theme/assets/vendors/sweetalert/sweetalert.min.js')}}"></script>

        <!-- END: JS Assets-->

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

        
    @include('laravolt::apim.layouts.message')


    <!-- END PAGE LEVEL JS-->
    </body>
</html>