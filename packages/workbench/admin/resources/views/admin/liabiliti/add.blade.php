@extends('web::perakepay.frontend.layouts.base')
@section('content')

<style>
    .select2 {
        display: initial !important;
    }
</style>

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Tambah Pengurusan Kod Liabiliti</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/admin/liabiliti/save'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="fk_agency" value="{{data_get($agency,'id')}}"/>
        <input type="hidden" name="fk_ptj" value="{{data_get($ptj,'id')}}"/>

        <div id="div-individu" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Agensi/Jabatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{data_get($agency,'name')}}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama PTJ</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{data_get($ptj,'name')}}" disabled/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single4" id="fk_perkhidmatan" name="fk_perkhidmatan">
                            <option value=""> Sila Pilih</option>
                            @foreach($khidmat as $ak => $av)
                                <option value="{{$av->fk_perkhidmatan}}"> {{ data_get($av, 'lkpperkhidmatan.name') }} : {{ data_get($av,'name') }} </option>
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Kod Liabiliti</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                        value="" required="required">

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Lain No Rujukan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="reference_name" name="reference_name"
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
            </div>
 --}}


            <a href="/admin/liabiliti/list" class="btn btn-dark">Kembali</a>
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
        $('.js-example-basic-single4').select2();
        $( '.js-example-basic-single4' ).focus();
    });
</script>
@endpush
