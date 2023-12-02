@extends('web::perakepay.frontend.layouts.blank')

@section('content')


<div class="bg-auth container-fluid h-100 d-flex flex-column justify-content-center align-items-center">
	@if($error)
	<div class="alert alert-danger" role="alert">
             {{$error}}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
    </div>
    @endif
    @if($success)
    <div class="alert alert-info alert-dismissible show flex items-center mb-2" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i>{{ $success}} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button> </div>
    @endif


	<div id="login-page" class="box-auth bg-white rounded border-end border-bottom border-5 border-primary py-4 px-5 py-4"
        style="width: 340px">

    	<div class="hstack gap-3">
            <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}" class="logo" />
            <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-perak-epay.svg') }}"
                style="height:40px" />
        </div>

        <h5 class="mt-5"><i class="ri-shield-keyhole-line"></i> @lang('web::auth.forgot_password')</h5>
        {!! form()->open()->post()->action(url('/user/svforgot'))->attribute('id', 'form-forgot')->horizontal() !!}
        <!-- <form class="login-form" method="POST" action="{{ url('/user/svforgot') }}"> -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="exampleFormControlInput1" class="form-label">
                    @lang('web::auth.email')</label>
                <input id="email" type="email" name="email" placeholder="@lang('web::auth.email')" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-4">@lang('web::auth.send_reset_password_link')</button>
            <a href="/auth/login">
            	<button type="button" class="btn btn-primary mt-4">@lang('web::auth.login')</button>
            </a>
        <!-- </form> -->
        {!!form()->close()!!}

    </div>
    <div class="mt-3 small text-white">The Tukang © Services 2023</div>
</div>





@endsection

@push('script')

@if(config('laravolt.auth.captcha'))
{!! app('captcha')->renderJs() !!}
@endif


@if ($message = Session::get('error'))
<script type="text/javascript">
    swal({
        title: '{!! $message !!}',
        icon: 'error'
    })
</script>
@endif

@endpush
