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

<style type="text/css">
    td, th
    {
        padding: 20px !important;
    }
</style>

<div class="bg-light py-4">
  <div class="container">
      <h5 class="header-style">@lang('web::auth.trolley') {{-- Troli --}}</h5>
  </div>
</div>
<div class="container my-5">

    <div class="card style-border">
        <div class="card-header">
            <!-- Senarai Pengguna Agensi / PTJ -->
            <div class="gap-2">
                <div style="float: left">
                    <h6 class="mt-2 float-left">@lang('web::auth.trolley') {{-- Troli --}}</h6>
                </div>
                <div style="float: right">

                </div>
            </div>
            <!-- <a href="/admin/user/agency/add"> <button type="button" class="btn btn-success">Tambah</button></a> -->

        </div>

 <!-- dd($list[0]->fkservice->serviceratemgt->lkpperkhidmatan->name) }} -->

        {!! form()->open()->post()->action(url('/login/cart/proceed'))->attribute('id', 'formtroli')->horizontal() !!}
            <div class="card-body ">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive">
                            <table id="data-table-agency" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">@lang('web::auth.bil') {{-- Bil --}}</th>
                                        <th style="text-align: left;">@lang('web::auth.services') {{-- Perkhidmatan --}}</th>
                                        <th style="text-align: center;">@lang('web::auth.no-account') {{-- No Akaun --}}</th>
                                        <th style="text-align: left;">@lang('web::auth.account-holder-name') {{-- Nama Pemegang Akaun --}}</th>
                                        <th style="text-align: left;">@lang('web::auth.agency') {{-- Agensi --}}</th>
                                        <th style="text-align: center;">@lang('web::auth.amount-payable') {{-- Amaun Perlu Dibayar --}}</th>
                                        <!-- <th style="text-align: center;">Status</th> -->
                                        <th style="text-align: center;">@lang('web::auth.action') {{-- Tindakan --}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $bil=1;
                                    ?>

                                        @forelse($list as $key =>$value)
                                            <tr>
                                                <td class="text-center">{{ $bil++ }}</td>
                                                <td class="text-left">
                                                    @if (data_get($value, 'fkservice.serviceratemgt.lkpperkhidmatan.name'))
                                                        {{ data_get($value, 'fkservice.serviceratemgt.lkpperkhidmatan.name') }}
                                                    @else
                                                        {{ data_get($value, 'fkpayerbill.bill_detail') }}
                                                    @endif

                                                </td>
                                                <td class="text-center">
                                                    @if (data_get($value, 'fkpayer.account_no'))
                                                        {{ data_get($value, 'fkpayer.account_no') }}
                                                    @else
                                                        {{ data_get($value, 'fkpayerbill.account_no') }}
                                                    @endif
                                                </td>  <!-- hold utk bil -->
                                                <td class="text-left">{{ data_get($value, 'fkpayerbill.name') }}</td>
                                                <td class="text-left">{{ data_get($value, 'fkservice.fkkodhasil.agency.name') }}</td>
                                                <td class="text-center">{{ data_get($value, 'amount') }}</td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="forpayment" name="forpayment[] " value="{{ $value->id }}">
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="7">@lang('web::auth.no-data') {{-- Tiada Data --}}</td>
                                            </tr>
                                        @endforelse

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary" type="submit" style="">
                        <b>@lang('web::auth.pay') {{-- Bayar --}}</b> <i class="ri-secure-payment-line" style="font-size: 1rem"></i>
                    </button>
                </div>

            </div>
        {!! form()->close() !!}

    </div>

</div>
<br/>
@endsection



@push('script')
<script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript">

// $(document).ready(function(){
//     $('#data-table-agency').DataTable({
//         "responsive": true,
//         "scrollY": true,
//         "scrollX": true,
//         "ordering": true,
//         "info": true,
//         'iDisplayLength': 10,
//         "lengthMenu": [
//             [25, 50, 100, 250, -1],
//             [25, 50, 100, 250, "All"]
//         ],
//         @if($locale ==  'ms')
//             "language": {
//                 url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
//             },
//         @endif
//   });
// });


</script>

@endpush
