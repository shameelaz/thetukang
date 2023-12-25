<!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Tukang</title>
    {{-- <link rel="shortcut icon" href="https://www.perak.gov.my/images/favicon.ico"> --}}

    <link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/assets/css/splide.min.css') }}">
    <link rel="stylesheet" type="text/css"
      href="{{asset('overide/web/themes/apim/default/vendors/data-tables/css/jquery.dataTables.css')}}">
    <link rel="stylesheet"
      href="{{ asset('overide/web/themes/perakepay/assets/vitalets-bootstrap-datepicker/css/datepicker.css') }}">
    <link rel="stylesheet"
      href="{{ asset('overide/web/themes/perakepay/assets/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/assets/css/select2.min.css') }}">

    <!-- <link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"> -->
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> -->



    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

    @vite(['resources/js/app.js'])
    <style type="text/css">
      .box-pay {
        width: auto;
        box-shadow: 6px 6px 6px 4px #0009;
      }

      .swal-title {
        color: rgba(0, 0, 0, .65);
        font-weight: 600;
        text-transform: none;
        position: relative;
        display: block;
        padding: 13px 16px;
        font-size: 16px !important;
        line-height: normal;
        text-align: center;
        margin-bottom: 0;
      }


    </style>

  </head>

  <body>
    @include('web::perakepay.frontend.includes.header')

    @yield('content')
    <br>
    @include('web::perakepay.frontend.includes.footer')

    <div class="loader-overlay" id="loader">
      <div class="loader">
        <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}" class="logo" />
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
    <!-- <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
    <script src="{{ asset('overide/web/themes/perakepay/assets/js/splide.min.js') }}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ asset('overide/web/themes/perakepay/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('overide/web/themes/perakepay/assets/vitalets-bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <!-- <script src="{{ asset('overide/web/themes/perakepay/assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script> -->

    <script src="{{asset('overide/web/themes/apim/default/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('overide/web/themes/apim/default/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>

    <script src="{{ asset('overide/web/themes/perakepay/assets/js/select2.min.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <script>
        var size = 15;

        function setFontSize(s) {
            size = s;
            $('body').css('font-size', '' + size + 'px');
            $('div').css('font-size', '' + size + 'px');
            $('h6').css('font-size', '' + size + 'px');
        }

        function increaseFontSize() {
            setFontSize(size + 5);
        }

        function resetFontSize() {
            setFontSize(size = 15);
        }

        function decreaseFontSize() {
            if(size > 5)
                setFontSize(size - 5);
        }

        $('#inc').click(increaseFontSize);
        $('#reset').click(resetFontSize);
        $('#dec').click(decreaseFontSize);
        setFontSize(size);

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>

    @include('web::backend.layouts.message')
    @stack('script')
  </body>

</html>
