<!doctype html>
<html lang="en" class="light">

    <head>
        <meta charset="utf-8">
        {{-- <link rel="shortcut icon" href="https://www.perak.gov.my/images/favicon.ico"> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="The Tukang">
        <meta name="author" content="d-one-g">
        <title>The Tukang</title>

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

        @stack('script')

    </body>

</html>
