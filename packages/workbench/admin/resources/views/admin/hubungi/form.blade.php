@extends('web::perakepay.frontend.layouts.base')
@section('content')
<?php
    if (Session::has('locale')) {
        $locale = Session::get('locale', Config::get('app.locale'));
    } else {
        $locale = \Lang::locale();
    }

    $lastlogin = Auth::user()->last_login;
    ?>
<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style">Kemaskini Hubungi Kami</h5>
    </div>
</div>

<div class="container my-5">
    <div class="w-90 mx-auto">

            <div class="col-md-12">
                    <div class="card style-border">
                        <div class="p-md-4">
                            {!! form()->open()->post()->action(url('/admin/hubungi'))->attribute('id', 'myform')->horizontal() !!}
                            <input type="hidden" name="id" value="{{data_get($hubungi,'id')}}">
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        oninvalid="this.setCustomValidity('Sila masukkan nama penuh')"
                                        oninput="setCustomValidity('')" value="{{ data_get($hubungi,'nama')}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="alamat" name="alamat" rows="4" required>{{data_get($hubungi,'alamat')}}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone" class="col-sm-2 col-form-label">No Telefon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone_no" name="phone_no" maxlength="11"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        value="{{data_get($hubungi,'phone_no')}}" required>
                                    <p id='resultemail'></p>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="faks_no" class="col-sm-2 col-form-label">No Faks</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="faks_no" name="faks_no" maxlength="11"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        value="{{data_get($hubungi,'faks')}}" required>
                                    <p id='resultemail'></p>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Emel</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="emel" name="emel" onkeyup='validateemail(this)'
                                        value="{{data_get($hubungi,'emel')}}" required>
                                    <p id='resultemail'></p>
                                </div>

                            </div>

                            <a href="/home" class="btn btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Kemaskini</button>
                        {!!form()->close()!!}
                        </div>
                    </div>



            </div>


    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit
    });
</script>

@endpush
