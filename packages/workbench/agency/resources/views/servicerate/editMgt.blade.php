@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Kemaskini Pengurusan Perkhidmatan dan Kadar Bayaran</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/ptj/servicerate/updMgt'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="svrid" value="{{data_get($servrate,'id')}}"/>

        <div id="div-individu" style="">

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Agensi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="fk_agency" name="fk_agency"
                            value="{{ data_get($servrate,'agency.code') }} - {{ data_get($servrate,'agency.name') }}" disabled>
                </div>

            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">PTJ</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="fk_ptj" name="fk_ptj"
                        value="{{ data_get($servrate,'ptj.code') }} - {{ data_get($servrate,'ptj.name') }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
                <div class="col-sm-10">

                    <select class="js-example-basic-single1" id="fk_kod_hasil" name="fk_kod_hasil"  required="required" style="width: 100%" disabled>
                        <option value=""> Sila Pilih</option>
                        @foreach($hasil as $ak => $av)
                            <option value="{{$av->id}}" <?php if($av->id == $servrate->fk_kod_hasil){echo "selected";}?> > {{ $av->name }} - {{ $av->lkpperkhidmatan->name }} </option>
                        @endforeach
                </select>

                </div>
            </div>

            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                            <option value=""> Sila Pilih</option>
                            <option value="1" <?php if(data_get($servrate,'status')==1){echo "selected" ;}?>> Aktif </option>
                            <option value="0" <?php if(data_get($servrate,'status')==0){echo "selected" ;}?>> Tidak Aktif </option>
                    </select>

                </div>
            </div>


            <a href="/ptj/servicerate/list" class="btn btn-dark">Kembali</a>
            <button type="submit" class="btn btn-primary">Kemaskini</button>
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
</script>
@endpush
