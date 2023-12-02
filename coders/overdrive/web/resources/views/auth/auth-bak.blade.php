
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <link rel="apple-touch-icon" href="{{asset('overide/web/themes/apim/default/images/favicon/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('overide/web/themes/apim/default/images/favicon/favicon-32x32.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>@yield('site.title', "Welcome Home") | {{ config('app.name') }}</title>

    @stack('style')
    
    <!-- BEGIN: VENDOR CSS-->

    <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/vendors/vendors.min.css')}}">

    <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/themes/horizontal-menu-template/materialize.css')}}">
    <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/themes/horizontal-menu-template/style.css')}}">
    <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/layouts/style-horizontal.css')}}">
    <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/pages/login.css')}}">
    <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/custom/custom.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/sweetalert/sweetalert.css')}}">


<style type="text/css">
        .swal-title {
 color:rgba(0,0,0,.65);
 font-weight:600;
 text-transform:none;
 position:relative;
 display:block;
 padding:13px 16px;
 font-size:18px;
 line-height:normal;
 text-align:center;
 margin-bottom:0;
 word-wrap: break-word;
}

    </style>

    
</head>
<!-- END: Head-->

<style type="text/css">
    @media (min-width: 794px) 
{ 
    .big {   
       margin-left:-450px !important;
       margin-top: 100px !important
       
    }


}
</style>
<style type="text/css">
    
.discl{

position: fixed;
bottom: 15px;
width: 100%;
margin-left:unset !important;
margin-right:unset !important;
padding-right:  30px;
text-align: center;

}
.discl .disc{
color: #FFFFFF;width: 100%; background: black; text-align: center; 

}

@media only screen and (max-width:480px) {
    
.discl{

display:none !important;;
}

</style>
<body class="horizontal-layout page-header-light horizontal-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="horizontal-menu" data-col="1-column">

        <div class="row">
            <div class="col s12">
                @yield('content')
                <div class="content-overlay"></div>
            </div>
        </div>
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