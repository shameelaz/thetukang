@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Tambah Pengurusan Perkhidmatan dan Kadar Bayaran</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/ptj/servicerate/savekadar'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="id" value="{{data_get($kadar,'id')}}"/>
        <input type="hidden" name="service_rate_mgt" value="{{data_get($servrate,'id')}}"/>


        <div id="div-individu" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Agensi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($servrate, 'agency.code') }} - {{ data_get($servrate, 'agency.name')}} " disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">PTJ</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($servrate, 'ptj.code')}}  - {{ data_get($servrate, 'ptj.name') }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($servrate, 'kodhasil.name') }} - {{ data_get($servrate, 'lkpperkhidmatan.name')}}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="location" name="location"
                        value="">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single2" id="category" name="category"  required="required" style="width: 100%">
                            <option value=""> Sila Pilih</option>
                            @foreach($category as $ck => $cv)
                                <option value="{{$cv->id}}"> {{ $cv->description }} </option>
                            @endforeach
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Unit</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single2" id="unit" name="unit"  required="required" style="width: 100%">
                        <option value=""> Sila Pilih</option>
                        @foreach($unit as $uk => $uv)
                            <option value="{{$uv->id}}"> {{ $uv->description }} </option>
                        @endforeach
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Kadar (RM)</label>
                <div class="col-sm-10">
                    <input type="number" min="0" step="1" class="form-control" id="rate" name="rate"
                        value="" required="required">
                </div>
            </div>

            {{-- <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                            <option value=""> Sila Pilih</option>
                            <option value="1"> Aktif </option>
                            <option value="0"> Tidak Aktif </option>
                    </select>

                </div>
            </div> --}}


            <a href="/ptj/servicerate/list" class="btn btn-dark">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
        {!! form()->close()!!}




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

    $(document).ready(function() {
        $('.js-example-basic-single1').select2();
        $( ".js-example-basic-single1" ).focus();

    });

    $(document).ready(function() {
        $('.js-example-basic-single2').select2();
        $( ".js-example-basic-single2" ).focus();

    });


</script>
@endpush
