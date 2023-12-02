<!doctype html>
<html lang="en" class="h-100">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Tukang</title>
    {{-- <link rel="shortcut icon" href="https://www.perak.gov.my/images/favicon.ico"> --}}

    <link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/assets/css/splide.min.css') }}">
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

  <body class="h-100 bg-light">


    @yield('content')

    <script src="{{ asset('overide/web/themes/perakepay/assets/js/splide.min.js') }}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    @if (!empty(Session::get('errors')))


        <?php

            $error = ( Session::get('errors')->default->messages());
            // dump($error);
            if(data_get($error,'g-recaptcha-response.0')){
                // echo data_get($error,'g-recaptcha-response.0');
                $message = data_get($error,'g-recaptcha-response.0');
            }else{
                $message = data_get($error,'email.0');
            }
            // $message = $error['email'][0];


         ?>

        <script type="text/javascript">
            swal({
                title: '{!! $message !!}',
                icon: 'error'
            })
        </script>

    @endif
    @if ($message = Session::get('success'))
    <script type="text/javascript">
        swal({
            title: '{!! $message !!}',
            icon: 'success'
        })
    </script>
    @endif

    @if ($message = Session::get('warning'))
    <script type="text/javascript">
        swal({
            title: '{!! $message !!}',
            icon: 'warning'
        })
    </script>
    @endif

    @if ($message = Session::get('info'))
    <script type="text/javascript">
        swal({
            title: '{!! $message !!}',
            icon: 'info'
        })
    </script>
    @endif



    @include('web::backend.layouts.message')
    @stack('script')
  </body>

</html>
