@extends('web::perakepay.frontend.layouts.base')
@section('content')


<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style">Hubungi</h5>
    </div>
</div>

<div class="container my-5">
    <div class="card style-border">
        <div class="card-header">

        </div>
        <div class="card-body">





                <p class="card-text" id="">{{ data_get($banner,'nama') }}</p>
                <p class="card-text" id="">{{ data_get($banner,'alamat') }}</p>
                <p class="card-text" id="">{{ data_get($banner,'phone_no') }}</p>
                <p class="card-text" id="">{{ data_get($banner,'faks') }}</p>
                <p class="card-text" id="">{{ data_get($banner,'emel') }}</p>



        </div>
    </div>
</div>

@endsection
