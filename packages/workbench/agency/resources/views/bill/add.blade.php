@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Tambah Pengurusan Maklumat Pembayaran (Bil)</h5>
    </div>
</div>

<br>
<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/ptj/bill/save'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="fk_kod_hasil" value="{{ data_get($kodhasil,'id') }}"/>
        <input type="hidden" name="fk_agency" value="{{ data_get($kodhasil,'fk_agency') }}"/>
        <input type="hidden" name="fk_ptj" value="{{ data_get($kodhasil,'fk_ptj') }}"/>


        <div id="div-individu" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Kod Hasil </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                            value="{{ data_get($kodhasil, 'name')}}" disabled>
                </div>
            </div>


            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">No Akaun</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="account_no" name="account_no"
                            value="" style="text-transform: uppercase">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Pemilik Akaun <span style="color:red;">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                        value="" style="text-transform: uppercase" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">No Pengenalan <span style="color:red;">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="identification_no" name="identification_no"
                        value="" style="text-transform: uppercase" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">No Rujukan <span style="color:red;">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="reference_no" name="reference_no"
                        value="" style="text-transform: uppercase" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Amaun (RM) <span style="color:red;">*</span></label>
                <div class="col-sm-10">
                    <input type="number" min="0" step="0.01" class="form-control" id="amount" name="amount" placeholder="0.00"
                        value="" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Keterangan Pembayaran <span style="color:red;">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="bill_detail" name="bill_detail"
                        value="" style="text-transform: uppercase" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Tarikh Bil <span style="color:red;">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control datepicker1" id="bill_date" name="bill_date"
                        value="" required="required" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Tarikh Tamat <span style="color:red;">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control datepicker2" id="bill_end_date" name="bill_end_date"
                        value="" required="required" readonly>
                </div>
            </div>

            <div id="div-kaunter" name="div-kaunter">

            </div>


            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status <span style="color:red;">*</span></label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                            <option value=""> Sila Pilih</option>
                            <option value="1"> Aktif </option>
                            <option value="2"> Tidak Aktif </option>
                            <option value="3"> Bayaran di Kaunter </option>
                    </select>

                </div>
            </div>

            <a href="/ptj/bill/list/{{ data_get($kodhasil, 'id') }}" class="btn btn-dark">Kembali</a>
            <button type="submit" id="btn" class="btn btn-primary">Tambah</button>

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

        $(".datepicker1").datepicker({ format: 'dd-mm-yyyy' });
        $(".datepicker2").datepicker({ format: 'dd-mm-yyyy' });

        $("#btn").on('click', function(){
            if($(".datepicker1").val() == '')
            {
                swal({
                    title: 'Sila Pilih Tarikh Bil!',
                    icon: 'warning'
                })
            }

        });

        $("#btn").on('click', function(){
            if($(".datepicker2").val() == '')
            {
                swal({
                    title: 'Sila Pilih Tarikh Tamat!',
                    icon: 'warning'
                })
            }

        });

        $('select[name="status"]').change(function() {
                var val = $(this).val();
                // console.log(val);

                if (val == 3) {

                    $.ajax({

                        type: "GET",
                        url: "{{ URL::to('/ptj/getstatus/') }}" + "/" + val,

                        beforeSend: function() {

                            // $("#div-kaunter").hide();

                            document.getElementById("loader").classList.add("show");
                        },
                        success: function(result) {

                            document.getElementById("loader").classList.remove("show");
                            $('#div-kaunter').html(result);

                        }
                    });
                }
                else
                {
                    $.ajax({

                        type: "GET",
                        url: "{{ URL::to('/ptj/getstatus/') }}" + "/" + val,

                        beforeSend: function() {

                            // $("#div-kaunter").hide();

                            document.getElementById("loader").classList.add("show");
                        },
                        success: function(result) {

                            document.getElementById("loader").classList.remove("show");

                            $('#div-kaunter').hide();

                        }
                    });
                }

            });



    });


</script>
@endpush
