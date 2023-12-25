@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="m-0">Kemaskini Pengurusan PTJ</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">

        {!! form()->open()->post()->action(url('/admin/agency/ptj/update'))->attribute('id', 'myform')->horizontal() !!}
        <input type="hidden" name="id" value="{{ data_get($ptj,'id')  }}">
        <div id="div-individu" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Agensi/Jabatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{data_get($ptj,'agency.name')}}" readonly="true" disabled>
                    <input type="hidden" name="fk_agency" value="{{data_get($ptj,'fk_agency')}}"/>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama PTJ</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single1" id="ptj" name="ptj" required style="width: 100%;">
                            <option value=""> Sila Pilih</option>
                        @foreach($lkpptj as $pk => $pv)
                            <option value="{{$pv->id}}"  <?php if(data_get($ptj,'name') == $pv->ptj_name){echo "selected";}?>> {{ $pv->ptj_code }} : {{ $pv->ptj_name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="div-kod-ptj-result">

                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Kod PTJ</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="code" name="code"
                            value="{{data_get($ptj,'code')}}" required="required">

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Kod Prefix</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prefix" name="prefix"
                            value="{{data_get($ptj,'prefix')}}" required="required">

                    </div>
                </div>

                <div class="row mb-3" id="div-kodswift">
                    <label for="" class="col-sm-2 col-form-label">Nama Bank</label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-single2" id="lkp_bank" name="lkp_bank" style="width: 100%;">
                            <option value=""> Sila Pilih</option>
                            @foreach ($getlkpbank as $bk => $bv)
                                <option value="{{ $bv->id }}" <?php if(data_get($lkpbank,'id') == $bv->id){echo "selected";}?>> {{ $bv->bank_name }} </option>
                            @endforeach
                        </select>

                    </div>
                </div>

            </div>

            <div id="div-kod-swift-result">

                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Kod Swift Bank</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="bank_swift_code" name="bank_swift_code" value="{{data_get($merchant,'bank_swift_code')}}"
                            >

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">No Akaun Bank</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="bank_account_no" name="bank_account_no" value="{{data_get($merchant,'bank_account_no')}}"
                            >

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Seller ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="seller_id" name="seller_id" value="{{data_get($merchant,'seller_id')}}"
                            >

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Exchange ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="exchange_id" name="exchange_id" value="{{data_get($merchant,'exchange_id')}}"
                            >

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Merchant ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="merchant_id" name="merchant_id" value="{{data_get($merchant,'merchant_id')}}"
                            >

                    </div>
                </div>

            </div>

            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                        <option value=""> Sila Pilih</option>
                        <option value="1" <?php if(data_get($ptj,'status')==1){echo "selected" ;}?>> Aktif </option>
                        <option value="0" <?php if(data_get($ptj,'status')==0){echo "selected" ;}?>> Tidak Aktif </option>
                    </select>

                </div>
            </div>

            <a href="/admin/agency/ptj/list" class="btn btn-dark">Kembali</a>
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

        $('select[name="ptj"]').change(function() {
            var val = $(this).val();
            console.log(val);

            if (val) {
                $.ajax({

                    type: "GET",
                    url: "{{ URL::to('/admin/agency/getkod/') }}" + "/" + val,

                    beforeSend: function() {

                        $("#div-ptj").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result) {

                        document.getElementById("loader").classList.remove("show");
                        $("#div-ptj-code").html(result);

                    }
                });
            }

        });

        //swiftbank
        $('select[name="lkp_bank"]').change(function() {

            // alert('WOIIII');
            var val = $(this).val();
            console.log(val);

            if (val) {
                $.ajax({

                    type: "GET",
                    url: "{{ URL::to('/admin/agency/getswift/') }}" + "/" + val,

                    beforeSend: function() {

                        $("#div-kod").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result) {


                        document.getElementById("loader").classList.remove("show");
                        $("#div-kod-swift-result").html(result);

                    }
                });
            }

        });


    });



    $(document).ready(function(){
        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit

    });

    $(document).ready(function() {
        $('.js-example-basic-single1').select2();
        $(".js-example-basic-single1").focus();

    });

    $(document).ready(function() {
        $('.js-example-basic-single2').select2();
        $(".js-example-basic-single2").focus();

    });


</script>


@endpush
