@extends('web::perakepay.frontend.layouts.blank')

@section('content')
<?php
    $logo = \Workbench\Database\Model\Base\Logo::where('id',1)->first();

?>
<div class="bg-auth container-fluid h-100 d-flex flex-column justify-content-center align-items-center">
    <div id="login-page" class="box-auth bg-white rounded border-end border-bottom border-5 border-primary py-4 px-5 py-4"
        style="width: 370px">
        <div class="hstack gap-3">
            <a href="/"><img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}" class="logo" /></a>
        </div>
        <h6 class="mt-4"><i class="ri-shield-keyhole-line"></i> Login</h6>
        <form class="mt-3" method="POST" action="{{ route('auth::login.store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

{{-- 
            @if(config('laravolt.auth.captcha'))
            <div class="field">
                {!! app('captcha')->display() !!}
            </div>
            @endif
 --}}
            <div>
                <label for="exampleFormControlInput1" class="form-label">
                    Email</label>
                <input id="email" type="email" name="email" placeholder="Enter Your Email Address" class="form-control" required>
            </div>

            <div class="mt-3">
                <label for="exampleFormControlInput1" class="form-label">
                    Password</label>
                <input type="password" name="password" placeholder="Enter Your Password" class="form-control" required>
            </div>

            <br>

            {{-- <div class="field action">
                {!! Captcha::display( ['data-theme' => 'dark',]) !!}
            </div>
            @if ($errors->has('g-recaptcha-response'))

            <div class="field action">
                <span class="help-block">
                    <strong><font color="red">@lang('web::auth.captcha')</font></strong>
                </span>
            </div>
            @endif --}}

            <button type="submit" class="btn btn-primary mt-3 w-100">Login</button>
            <div class="mt-3">
                @lang('web::auth.new-user') <a href="/user/register"><u>New user</u></a>
            </div>

            <div class="mt-2">
                <!-- <a themed href="{{ route('auth::forgot.show') }}">@lang('web::auth.forgot_password')</a> -->
                <a themed href="{{ url('user/forgot') }}"><u>Forgot Password?</u></a>
            </div>



        </form>
    </div>



    <a href="/" class="mt-4 d-block link-light"><i class="ri-arrow-left-line"></i> Back</a>
    <div class="mt-3 small text-white">The Tukang © Services 2023</div>
</div>


@endsection



@push('script')

@if(config('laravolt.auth.captcha'))
{!! app('captcha')->renderJs() !!}
@endif

@if($response)
<script type="text/javascript">

    swal({
        title: '{!! $response !!}',
        icon: 'success'
    })
</script>
@endif

@endpush
