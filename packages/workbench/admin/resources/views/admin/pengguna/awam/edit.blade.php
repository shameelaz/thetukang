@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Kemaskini Profil</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
        <div class="card rounded style-border">
            <div class="card-body p-md-4">

            @if(data_get($user,'profile.user_level') == 2)

                @if(data_get($user,'profile.user_type') ==1)
                {!! form()->open()->post()->action(url('/admin/user/awam/update'))->attribute('id', 'myform')->horizontal() !!}
                <input type="hidden" name="id" value="{{data_get($user,'id')}}">
                <div id="div-individu" style="">

                    <h5 class="mb-3">Maklumat Individu</h5>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                oninvalid="this.setCustomValidity('Sila masukkan nama penuh')"
                                oninput="setCustomValidity('')" value="{{data_get($user,'name')}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Jenis Pengenalan</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="selrefid" name="selrefid" disabled>
                                <option value="1" <?php if(data_get($user,'profile.ref_type')==1){echo "selected" ;}?> >No
                                    Kad Pengenalan
                                </option>
                                <option value="2" <?php if(data_get($user,'profile.ref_type')==2){echo "selected" ;}?>>No
                                    Paspot</option>
                                <option value="3" <?php if(data_get($user,'profile.ref_type')==3){echo "selected" ;}?>>No
                                    Polis/ Tentera
                                </option>
                                <!-- <option value="4" <?php if(data_get($user,'profile.ref_type')== 4){echo "selected";}?>>No Pendaftaran Syarikat</option> -->
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="refid" class="col-sm-2 col-form-label" id="refidlabel"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="refid" name="refid"
                                value="{{data_get($user,'profile.refid')}}">

                        </div>

                    </div>


                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Emel</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" onkeyup='validateemail(this)'
                                value="{{data_get($user,'email')}}" disabled>
                            <p id='resultemail'></p>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">No Tel. Bimbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone_no" name="phone_no" maxlength="11"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                value="{{data_get($user,'profile.mobile_no')}}">
                            <p id='resultemail'></p>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="status" name="status">
                                <option value="1" <?php if(data_get($user,'status')==1){echo "selected" ;}?>> Aktif</option>
                                <option value="0" <?php if(data_get($user,'status')==0){echo "selected" ;}?>> Tidak Aktif</option>
                            </select>
                        </div>
                    </div>


                    <input type="hidden" name="seltype" value="1">
                    <input type="hidden" name="userlevel" value="2">





                    <a href="/admin/user/awam" class="btn btn-dark">Kembali</a>
                    <button type="submit" class="btn btn-primary">Kemaskini</button>
                </div>
                {!! form()->close()!!}

                @else

                <!-- <form class="ui form" method="POST" action="{{ url('user/profile') }}" id="myform">
                        <div id="div-comp" style="">
                             <h5 class="mb-3">Maklumat Pendaftaran Syarikat</h5>


                             <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Syarikat</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="name" name="name" oninvalid="this.setCustomValidity('Sila masukkan nama penuh')" oninput="setCustomValidity('')">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Jenis Pengenalan</label>
                                <div class="col-sm-10">
                                  <select class="form-select" id="selrefid" name="selrefid" >
                                      <option value="4" selected >No Pendaftaran Syarikat</option>

                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="refid" class="col-sm-2 col-form-label" id="">No Pendaftaran Syarikat</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="refid" name="refid" >

                                </div>

                            </div>


                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Emel Syarikat</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" id="email" name="email" onkeyup='validateemail2(this)' >
                                  <p id='resultemail2'></p>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Nama Wakil Syarikat</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="refname" name="refname"  >

                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">No Tel. Bimbit Wakil Syarikat</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="phone_no" name="phone_no" maxlength="11" onkeypress='return event.charCode >= 48 && event.charCode <= 57' >
                                  <p id='resultemail'></p>
                                </div>

                            </div>
                            <input type="hidden" name="seltype" value="2">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form> -->

                @endif

            @else
                {!! form()->open()->post()->action(url('/admin/user/awam/update'))->attribute('id', 'myform')->horizontal() !!}
                <input type="hidden" name="id" value="{{data_get($user,'id')}}">
                <div id="div-individu" style="">

                    <h5 class="mb-3">Maklumat Individu</h5>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                oninvalid="this.setCustomValidity('Sila masukkan nama penuh')"
                                oninput="setCustomValidity('')" value="{{data_get($user,'name')}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Jenis Pengenalan</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="selrefid" name="selrefid" disabled>
                                <option value="1" <?php if(data_get($user,'profile.ref_type')==1){echo "selected" ;}?> >No
                                    Kad Pengenalan
                                </option>
                                <option value="2" <?php if(data_get($user,'profile.ref_type')==2){echo "selected" ;}?>>No
                                    Paspot</option>
                                <option value="3" <?php if(data_get($user,'profile.ref_type')==3){echo "selected" ;}?>>No
                                    Polis/ Tentera
                                </option>
                                <!-- <option value="4" <?php if(data_get($user,'profile.ref_type')== 4){echo "selected";}?>>No Pendaftaran Syarikat</option> -->
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="refid" class="col-sm-2 col-form-label" id="refidlabel"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="refid" name="refid"
                                value="{{data_get($user,'profile.refid')}}">

                        </div>

                    </div>


                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Emel</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" onkeyup='validateemail(this)'
                                value="{{data_get($user,'email')}}" disabled>
                            <p id='resultemail'></p>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">No Tel. Bimbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone_no" name="phone_no" maxlength="11"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                value="{{data_get($user,'profile.mobile_no')}}">
                            <p id='resultemail'></p>
                        </div>

                    </div>
                    <input type="hidden" name="seltype" value="1">
                    <input type="hidden" name="userlevel" value="1">





                    <button type="submit" class="btn btn-primary">Kemaskini</button>
                    <a href="/admin/user/awam" class="btn btn-dark">Kembali</a>
                </div>
                {!! form()->close()!!}

            @endif

        </div>
    </div>

</div>

@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit
    });
</script>

@endpush
