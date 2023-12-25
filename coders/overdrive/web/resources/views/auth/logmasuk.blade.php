<!doctype html>
<html lang="en" class="h-100">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Tukang</title>

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


    <div class="container-fluid h-100 d-flex flex-column justify-content-center">
    <div class="row h-100 align-items-center">
        <div class="col-md p-0 h-100" style="background: url('/overide/web/themes/perakepay/assets/images/bg-auth.jpg')">

        </div>
        <div class="col-md h-100 bg-dark px-0" style="    border-left: 2.5rem solid var(--bs-primary);">
            <div class="h-100 bg-light ms-5 ps-5 d-flex align-items-center" style="border-top-left-radius: 2rem; border-bottom-left-radius: 2rem">
                <div class="ms-5">
                    <div class="hstack gap-3">
                        <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}"
                            class="logo" />
                        <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-perak-epay.svg') }}"
                            style="height:40px" />
                    </div>
                    <div id="login-page"
                        class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5" style="width: 340px">
                        <h5><i class="ri-shield-keyhole-line"></i> @lang('web::auth.login')</h5>
                        <form class="mt-4" method="POST" action="{{ route('auth::login.store') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            @if(config('laravolt.auth.captcha'))
                            <div class="field">
                                {!! app('captcha')->display() !!}
                            </div>
                            @endif

                            <!-- <div class="row">
                                <div class="input-field col s12" style="text-align:center">
                                    <img src="{{asset('overide/web/themes/apim/default/images/laravolt.png')}}" style="width:130px;height:130px;">
                                </div>
                            </div> -->

                            <div>
                                <label for="exampleFormControlInput1" class="form-label">
                                    @lang('web::auth.email')</label>
                                <input id="email" type="email" name="email" placeholder="@lang('web::auth.email')" class="form-control">
                            </div>

                            <div class="mt-3">
                                <label for="exampleFormControlInput1" class="form-label">
                                    @lang('web::auth.password')</label>
                                <input type="password" name="password" placeholder="@lang('web::auth.password')"
                                    class="form-control">
                            </div>

                            <div class="mt-2">
                                <a themed href="{{ route('auth::forgot.show') }}">@lang('web::auth.forgot_password')</a>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">@lang('web::auth.login')</button>
                            <a href="/user/register"><button type="button" class="btn btn-primary mt-4">@lang('web::auth.register_here')</button></a>
                        </form>
                    </div>
                    <div class="mt-3 text-muted small">The Tukang © Services 2023</div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- <script src="{{ asset('overide/web/themes/perakepay/assets/js/splide.min.js') }}"></script> -->
    <script src="{{asset('overide/web/themes/apim/default/vendors/sweetalert/sweetalert.min.js')}}"></script>
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


    @include('web::backend.layouts.message')
    @stack('script')
  </body>

</html>
