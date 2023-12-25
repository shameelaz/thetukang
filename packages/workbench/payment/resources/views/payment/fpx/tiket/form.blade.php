@extends('web::perakepay.frontend.layouts.base')
<!-- extends('web::backend.layouts.base') -->
@section('content')
<?php
if (Session::has('locale')) {
    $locale = Session::get('locale', Config::get('app.locale'));
} else {

    $locale = \Lang::locale();
}
?>

<div class="bg-light py-4">
  <div class="container">
      <h5 class="header-style">Demo Payment Return</h5>
  </div>
</div>
<div class="container my-5">

    <div class="card style-border">
        <div class="card-body p-md-4">

        {!! form()->open()->post()->action(url('/bayaran/fpx/update'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="paymentid" value="{{ data_get($payment,'id') }}" />
        <input type="hidden" name="flaglogin" value="{{ $flaglogin }}" />

        <div id="div-individu" style="">
            <ul>
                <li>Transaction Date</li>
                <li>Transaction Amount</li>
                <li>Seller Order Number</li>
                <li>FPX Transaction ID</li>
                <li>Buyer Bank Name</li>
                <li>Transaction Status - Successful (00), Pending for Authorization (99), Pending (09)</li>
            </ul>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Order No</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="orderNo" name="orderNo"
                        value="{{ data_get($payment,'transaction_no') }}" required="required">

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="status" name="status"
                        value="00" required="required">

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">txnTime</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="txnTime" name="txnTime"
                        value="{{date('Y-m-d H:s:i')}}" required="required">

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="amount" name="amount"
                        value="{{ data_get($payment,'total_amount') }}" required="required">

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">txnReference</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="txnReference" name="txnReference"
                        value="{{ data_get($payment,'transaction_no') }}" required="required">

                </div>
            </div>
            <?php $txnId = "FPX".date('YmdHis');?>
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">txnId</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="txnId" name="txnId"
                        value="{{ $fpxtrans }}" required="required">

                </div>
            </div>

            {{-- <a href="#" class="btn btn-dark">Kembali</a> --}}
            <button type="submit" class="btn btn-primary">Kemaskini</button>
        </div>
        {!! form()->close()!!}




        </div>
    </div>

</div>
<br/>
@endsection



@push('script')
<script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript">

$(document).ready(function(){
    $('#data-table-agency').DataTable({
        "responsive": true,
        "scrollY": true,
        "scrollX": true,
        "ordering": false,
        "info": true,
        'iDisplayLength': 100,
        "lengthMenu": [
            [25, 50,100,250, -1],
            [25, 50,100,250, "All"]
        ],
        @if($locale ==  'ms')
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
            },
        @endif
  });
});


</script>

@endpush
