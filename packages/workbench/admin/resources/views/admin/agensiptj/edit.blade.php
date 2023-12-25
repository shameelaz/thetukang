@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Kemaskini Pengurusan Laman Utama Agensi/PTJ</h5>
    </div>
</div>

@if(count($errors) > 0)
@foreach($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
@endforeach
@endif

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/admin/agensiptj/update'))->attribute('id', 'myform')->multipart()->horizontal() !!}

        <input type="hidden" name="id" value=" {{  data_get($agptj,'id')  }}">

        <div id="div-individu" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Agensi</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" id="" name="" type="text" readonly value="{{ data_get($agptj,'agensi.name') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <textarea placeholder="Keterangan" class="form-control " name="keterangan_ms" rows="10"
                        required="required">{{data_get($agptj,'keterangan_ms')}}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Logo Agensi</label>
                <div class="col-sm-10">

                    <figure class="figure">
                        @if( data_get($agptj,'logo_agensi'))
                        <img src="{{data_get($agptj,'logo_agensi')}}" class="img-thumbnail figure-img img-fluid rounded " alt="..." style="width:60px; height:60px;">
                        @else

                        @endif


                    </figure>

                    @if(data_get($agptj,'logo_agensi'))
                        <input class="form-control form-control-sm" placeholder="Logo Agensi" id="" name="logo_agensi" type="file" >
                    @else
                        <input class="form-control form-control-sm" placeholder="Logo Agensi" id="" name="logo_agensi" type="file" required>
                    @endif


                </div>

            </div>



            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                        <option value=""> Sila Pilih</option>
                        <option value="1" <?php if(data_get($agptj,'status')==1){echo "selected" ;}?>> Aktif </option>
                        <option value="0" <?php if(data_get($agptj,'status')==0){echo "selected" ;}?>> Tidak Aktif </option>
                    </select>

                </div>
            </div>


            <a href="/admin/agensiptj/list" class="btn btn-dark">Kembali</a>
            <button type="submit" class="btn btn-primary">Kemaskini</button>
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
