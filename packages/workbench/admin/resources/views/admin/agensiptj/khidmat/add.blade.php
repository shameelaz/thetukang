@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Tambah Pengurusan Laman Utama Agensi Perkhidmatan</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/admin/agensiptj/khidmat/save'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="fk_laman_agensi" value="{{data_get($agensi,'id')}}"/>

        <div id="div" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Perkhidmatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="url" name="url"
                        value="" required="required">
                </div>
            </div>

            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                            <option value=""> Sila Pilih</option>
                            <option value="1"> Aktif </option>
                            <option value="0"> Tidak Aktif </option>
                    </select>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="/admin/agensiptj/list" class="btn btn-dark">Kembali</a>
        </div>
        {!! form()->close()!!}




        </div>
    </div>

</div>

@endsection

@push('script')
<script type="text/javascript">
    $( document ).ready(function() {

        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit
    
    });
</script>
@endpush
