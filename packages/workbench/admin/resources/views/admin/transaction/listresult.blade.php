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
      <h5 class="header-style">Pelarasan Kod Hasil</h5>
  </div>
</div>

<br>

<div class="container">

    <div class="card style-border">
        <div class="card-header">
            <!-- Senarai Pengguna Agensi / PTJ -->
            <div class="gap-2">
                <div style="float: left">
                    <h6 class="mt-2 float-left">Senarai Pelarasan Kod Hasil</h6>
                </div>
                {{-- <div style="float: right">
                    <a href="/admin/payment/add" class="btn btn-primary me-md-2 float-right">Tambah</a>
                </div> --}}
            </div>
            <!-- <a href="/admin/user/agency/add"> <button type="button" class="btn btn-success">Tambah</button></a> -->

        </div>

        <div class="card-body ">

            <div class="row g-2">
                <div class="col-md-12 col-lg-12">

                    <div class="table-responsive">
                        <table id="data-table-pelarasan" class="table mt-2" style="width:100%;font-size: 12px;">
                            <thead class="table-dark">
                                <tr>
                                    <th style="text-align: center;">Bil</th>
                                    <th style="text-align: center;">Agensi</th>
                                    <th style="text-align: center;">PTJ</th>
                                    <th style="text-align: center;">Perkhidmatan</th>
                                    <th style="text-align: center;">No Penyata Pemungut</th>
                                    <th style="text-align: center;">No Resit</th>
                                    <th style="text-align: center;">Kod Hasil Lama</th>
                                    <th style="text-align: center;">Kod Hasil Baru</th>
                                    <th style="text-align: center;">Tarikh Pelarasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $bil=1;?>
                                    @foreach($pelarasan as $key =>$value)
                                        <tr>
                                            <td class="text-center">{{ $bil++}}</td>
                                            <td class="text-center"> {{ data_get($value,'agency.name') }} </td>
                                            <td class="text-center"> {{ data_get($value,'ptj.name') }} </td>
                                            <td class="text-center"> {{ data_get($value,'lkpperkhidmatan.name') }} </td>
                                            <td class="text-center"> {{ data_get($value,'no_penyata_pemungut') }}</td>
                                            <td class="text-center"> {{ data_get($value,'receipt_no') }} </td>
                                            <td class="text-center"> {{ data_get($value,'kod_hasil_lama') }} </td>
                                            <td class="text-center"> {{ data_get($value,'kod_hasil_baru') }} </td>
                                            <td class="text-center"> {{ date('d-m-Y', strtotime(data_get($value,'tarikh_pelarasan'))) }} </td>
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

        $('#data-table-pelarasan').DataTable({
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
