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
      <h5 class="header-style">@lang('web::auth.list-registered-accounts') {{-- Senarai Akaun Berdaftar --}}</h5>
  </div>
</div>
<div class="container my-5">

    <div class="card style-border">
        <div class="card-header">
            <!-- Senarai Pengguna Agensi / PTJ -->
            <div class="gap-2">
                <div style="float: left">
                    <h6 class="mt-2 float-left">@lang('web::auth.list-registered-accounts') {{-- Senarai Akaun Berdaftar --}} </h6>
                </div>
                <div style="float: right">
                    <a href="/user/favourite/add" class="btn btn-primary me-md-2 float-right">@lang('web::auth.add') {{-- Tambah --}}</a>
                </div>
            </div>
            <!-- <a href="/admin/user/agency/add"> <button type="button" class="btn btn-success">Tambah</button></a> -->

        </div>


        <div class="card-body ">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive">
                            <table id="data-table-agency" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">@lang('web::auth.bil') {{-- Bil --}}</th>
                                        <th style="text-align: left;">@lang('web::auth.agency') {{-- Agensi --}}</th>
                                        <th style="text-align: left;">PTJ</th>
                                        <th style="text-align: center;">@lang('web::auth.services') {{-- Perkhidmatan --}}</th>
                                        <th style="text-align: center;">@lang('web::auth.no-account') {{-- No Akaun --}}</th>
                                        <th style="text-align: center;">@lang('web::auth.holder-name') {{-- Nama Pemegang --}}</th>
                                        <th style="text-align: center;">@lang('web::auth.action') {{-- Tindakan --}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $bil=1;?>
                                        @foreach($list as $key =>$value)
                                            <tr>
                                                <td class="text-center">{{ $bil++}}</td>
                                                <td>{{ data_get($value,'fkpayeracc.fkagency.name') }}</td>
                                                <td>{{ data_get($value,'fkpayeracc.fkptj.name') }}</td>
                                                <td class="text-center">{{ data_get($value,'fkpayeracc.codehasil.lkpperkhidmatan.name') }}</td>

                                                <td class="text-center">{{ data_get($value,'fkpayeracc.account_no') }}</td>

                                                <td class="text-center">{{ data_get($value,'fkpayeracc.name') }}</td>
                                                <td class="text-center">

                                                </td>
                                            </tr>

                                        @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

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
