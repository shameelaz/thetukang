@extends('web::perakepay.frontend.layouts.base')
@section('content')

<style>
    .select2 {
        display: initial !important;
    }
</style>

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">@lang('web::auth.detailed-transaction-details') {{-- Butiran Transaksi Terperinci --}}</h5>
    </div>
</div>

<div class="container my-5">

    <div class="card style-border">
        <div class="card-body p-md-4">

        {{-- {!! form()->open()->post()->action(url('/admin/liabiliti/save'))->attribute('id', 'myform')->horizontal() !!} --}}

        <div id="div-individu" style="">
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.agency') {{-- Agensi --}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'fkkodhasil.agency.name') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">PTJ</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'fkkodhasil.ptj.name') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.code-result') {{-- Kod Hasil --}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'fkkodhasil.name') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.payment-mode') {{-- Mod Pembayaran --}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'fkpayment.fkpaymentgateway.name') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.no-reference') {{-- No Rujukan --}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'reference_no') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.date-time-transaction') {{-- Tarikh/Masa Transaksi --}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'fkpayment.transaction_date') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.received-from') {{-- Diterima Dari --}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'fkpayer.name') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.total-payment') {{-- Jumlah Bayaran --}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'amount') }}" disabled>

                </div>
            </div>
             <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.no-receipt') {{-- Resit No --}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'receipt_no') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.transaction-id') {{-- Transaksi ID --}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'fkpayment.transaction_id') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.no-transaction-fpx') {{-- No. Transaksi FPX --}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($transaction, 'fkpayment.transaction_no') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.status-transaction') {{-- Status Transaksi --}}</label>
                <div class="col-sm-10">
                    <select class="form-select" id="" name="" disabled>
                        <option value=""> Sila Pilih</option>
                        <option value="1" <?php if(data_get($transaction,'fkpayment.status')==1){echo "selected" ;}?>> Berjaya </option>
                        <option value="0" <?php if(data_get($transaction,'fkpayment.status')==0){echo "selected" ;}?>> Tidak Berjaya </option>
                    </select disabled>
                </div>
            </div>

            <a href="/admin/transaction/list" class="btn btn-dark">@lang('web::auth.back') {{-- Kembali --}}</a>
            {{-- <button type="submit" class="btn btn-primary">Tambah</button> --}}
        </div>
        {{-- {!! form()->close()!!} --}}




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
