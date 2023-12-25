@extends('web::perakepay.frontend.layouts.base')
@section('content')

<style>
    .select2 {
        display: initial !important;
    }
</style>

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Pelarasan Kod Hasil </h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/admin/pelarasan/save'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="fk_agency" value="{{data_get($pelarasan,'fkkodhasil.fk_agency')}}"/>
        <input type="hidden" name="fk_ptj" value="{{data_get($pelarasan,'fkkodhasil.fk_ptj')}}"/>
        <input type="hidden" name="fk_lkp_perkhidmatan" value="{{data_get($pelarasan,'fkkodhasil.fk_perkhidmatan')}}"/>
        <input type="hidden" name="no_penyata_pemungut" value="{{data_get($penyatamain,'no_penyata_pemungut')}}"/>
        <input type="hidden" name="receipt_no" value="{{data_get($pelarasan,'receipt_no')}}"/>
        <input type="hidden" name="kod_hasil_lama" value="{{data_get($pelarasan,'fkkodhasil.name')}}"/>
        <input type="hidden" name="tarikh_pelarasan" value="{{data_get($pelarasan,'created_at')}}"/>
        <input type="hidden" name="troli" value="{{data_get($pelarasan,'fk_troli')}}"/>

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
                    <select class="form-select" id="" name="" disabled/>
                        <option value="{{data_get($pelarasan,'fkperkhidmatan.id')}}" > {{data_get($pelarasan,'fkperkhidmatan.name')}}</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">No Penyata Pemungut</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_penyata_pemungutd" name="no_penyata_pemungutd"
                        value="{{data_get($penyatamain,'no_penyata_pemungut')}}" disabled/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">No Resit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{data_get($pelarasan,'receipt_no')}}" disabled/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Kod Hasil Lama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{data_get($pelarasan,'fkkodhasil.name')}}" disabled/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Kod Hasil Baru</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single" id="kod_hasil_baru" name="kod_hasil_baru">
                        <option value=""> Sila Pilih</option>
                        @foreach($kodhasilbaru as $ak => $av)
                            <option value="{{data_get($av,'id')}}">  {{ data_get($av,'name') }} : {{ data_get($av,'lkpperkhidmatan.name')}}</option>
                        @endforeach
                </select>
                </div>
            </div>


            <a href="/admin/transaction/list" class="btn btn-dark">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
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
        $('.js-example-basic-single').select2();
        $( '.js-example-basic-single' ).focus();
    });

</script>
@endpush
