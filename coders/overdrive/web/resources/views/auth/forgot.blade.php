@extends('web::auth.auth')

@section('content')

    <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/pages/forgot.css')}}">

<div class="container">
<div class="col s12 hide-on-med-and-down" style="float:left;margin-left:120px;font-size: 40px;color:#05176f;position: absolute;text-shadow: 10px 1px 30PX white;margin-top: 100px;font-weight: bolder;font-family:verdana;"><span>{{ env('APP_ENV_TITLE') }} | {{ config('app.name') }}</span>
</div>
<div class="col s12 hide-on-large-only" style="float:left;margin-left:8px;font-size: 20px;color:#05176f;position: absolute;text-shadow: 10px 1px 30PX white;margin-top: 100px;font-weight: bolder;font-family:verdana;"><span>{{ env('APP_ENV_TITLE') }} | {{ config('app.name') }}</span>
</div>



<div id="forgot-password" class="row">
  <div class="col s12 m6 l4 z-depth-4 offset-m4 card-panel border-radius-6 forgot-card bg-opacity-8">
    <form class="login-form" method="POST" action="{{ route('auth::forgot.store') }}">
      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">@lang('web::auth.forgot_password')</h5>
          <p class="ml-4">@lang('web::auth.registered_email')</p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="email" type="email">
          <label for="email" class="center-align">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1" type="submit">@lang('web::auth.send_reset_password_link')</button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <p class="margin medium-small"><a href="/auth/login">@lang('web::auth.login')</a></p>
        </div>
        <div class="input-field col s6 m6 l6">
          <p class="margin right-align medium-small"><a href="/auth/register">@lang('web::auth.register')</a></p>
        </div>
      </div>
    </form>
  </div>
</div>
</div>


@endsection

@push('script')


@endpush



