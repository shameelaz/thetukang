<DOCTYPE html>
<html lang="en" class="light">

    <head>
        <meta charset="utf-8">
        {{-- <link rel="shortcut icon" href="https://www.perak.gov.my/images/favicon.ico"> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="The Tukang">
        <meta name="author" content="d-one-g">
        <title>The Tukang </title>

            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/data-tables/css/jquery.dataTables.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/data-tables/extensions/responsive/css/responsive.dataTables.css')}}">  
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/css/pages/form-select2.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/data-tables/css/select.dataTables.min.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/css/pages/data-tables.css')}}">

 


        @stack('style')

        @vite(['resources/js/app.js'])

        <?php

            use \Carbon\Carbon;
            $id = auth()->user()->id;
            $counts = \Overdrive\Web\Model\NotificationTable::where('status','=',0)->where('fk_users','=',$id)->where('created_at','>',Carbon::now()->subDays(5))->count();

        ?>

    </head>

    <body>
        @include('web::perakepay.frontend.includes.header')

        <div class="content">
            @yield('content')
        </div>

        @include('web::perakepay.frontend.includes.footer')
        <script src="{{asset('overide/web/themes/apim/default/vendors/sweetalert/sweetalert.min.js')}}"></script>

        @include('web::backend.layouts.message')

        <script src="{{asset('overide/web/themes/apim/default/js/vendors.min.js')}}"></script>
        <script src="{{asset('overide/web/themes/apim/default/js/scripts/data-tables.js')}}"></script>
        <script src="{{asset('overide/web/themes/apim/default/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('overide/web/themes/apim/default/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('overide/web/themes/apim/default/vendors/data-tables/js/dataTables.select.min.js')}}"></script>
        <script src="{{asset('overide/web/themes/apim/default/vendors/select2/select2.full.min.js')}}"></script>
        <script src="{{asset('overide/web/themes/apim/default/js/scripts/form-select2.js')}}"></script>

        
    

        @stack('script')

    </body>

</html>
