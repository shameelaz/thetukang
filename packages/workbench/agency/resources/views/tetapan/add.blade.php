@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Tambah Pengurusan Tetapan</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/ptj/tetapan/save'))->attribute('id', 'myform')->horizontal() !!}

        {{-- <input type="hidden" name="fk_agency" value="{{ data_get($agency,'fk_agency') }}"/>
        <input type="hidden" name="fk_ptj" value="{{ data_get($agency,'fk_ptj') }}"/> --}}

        <div id="div-individu" style="">

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Agensi</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single1" id="fk_agency" name="fk_agency"  required="required" style="width: 100%">
                        <option value=""> Sila Pilih</option>
                        @foreach($agency as $ak => $av)
                            <option value="{{$av->id}}"> {{ $av->name }} </option>
                        @endforeach
                </select>

                </div>
            </div>

            <div id="div-ptj-tetapan-result">

            </div>

            <div id="div-hasil-tetapan-result">

            </div>

            {{-- <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">PTJ</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single2" id="fk_ptj" name="fk_ptj"  required="required" style="width: 100%">
                        <option value=""> Sila Pilih</option>
                        @foreach($ptj as $pk => $pv)
                            <option value="{{$pv->id}}"> {{ $pv->name }} </option>
                        @endforeach
                </select>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single3" id="fk_lkp_perkhidmatan" name="fk_lkp_perkhidmatan"  required="required" style="width: 100%">
                        <option value=""> Sila Pilih</option>
                        @foreach($khidmat as $ak => $av)
                            <option value="{{$av->id}}"> {{ $av->name }} </option>
                        @endforeach
                </select>

                </div>
            </div> --}}

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Jenis</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single4" id="jenis" name="jenis"  required="required" style="width: 100%">
                            <option value=""> Sila Pilih</option>
                            @foreach($lkpmaster as $lk => $lv)
                                <option value="{{$lv->id}}"> {{ $lv->description }} </option>
                            @endforeach
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="description" name="description"
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



            <a href="/ptj/tetapan/list" class="btn btn-dark">Kembali</a>
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

        $('select[name="fk_agency"]').change(function()
            {
            var val = $(this).val();

            if(val)
            {
                $.ajax(
                {
                    type: "GET",
                    url: "{{ URL::to('/ptj/tetapan/ptjtetapan')}}"+"/"+val,

                    beforeSend: function ()
                    {
                        $("#div-ptj-tetapan").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result)
                    {
                        $("#render_ajax").html("");
                        $("#div-ptj-tetapan-result").html(result);
                        document.getElementById("loader").classList.remove("show");
                    }
                });

            }

        });
    });

    $(document).ready(function() {
        $('.js-example-basic-single1').select2();
        $( ".js-example-basic-single1" ).focus();
    });

    $(document).ready(function() {
        $('.js-example-basic-single2').select2();
        $( ".js-example-basic-single2" ).focus();
    });

    $(document).ready(function() {
        $('.js-example-basic-single3').select2();
        $( ".js-example-basic-single3" ).focus();
    });

    $(document).ready(function() {
        $('.js-example-basic-single4').select2();
        $( ".js-example-basic-single4" ).focus();
    });

</script>
@endpush
