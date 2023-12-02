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
      <h5 class="header-style">Pengurusan Laman Utama Agensi Perkhidmatan</h5>
  </div>
</div>
<div class="container my-5">

    <div class="card style-border">
        <div class="card-header">
            <!-- Senarai Pengguna Agensi / PTJ -->
            <div class="gap-2">
                <div style="float: left">
                    <h6 class="mt-2 float-left">Pengurusan Agensi Perkhidmatan Dalaman : {{ data_get($agency,'agensi.name') }}</h6>
                </div>
                <div style="float: right">
                    <a href="/admin/agensiptj/list" class="btn btn-primary me-md-2 float-right" title="Kembali ke Senarai Agensi di Laman Utama">Kembali</a>
                    <a href="/admin/agensiptj/khidmat/dalaman/add/{{ data_get($agency,'id') }}" class="btn btn-primary me-md-2 float-right">Tambah</a>
                </div>
            </div>


        </div>

        <div class="card-body ">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive">
                            <table id="data-table-khid" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">Bil</th>
                                        <th style="text-align: left;">Perkhidmatan</th>
                                        <th style="text-align: left;">PTJ</th>
                                        <th style="text-align: left;">Kod Hasil</th>
                                        <th style="text-align: left;">Nama Rujukan</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $bil=1;?>
                                        @foreach(data_get($agency,'perkhidmatandalaman') as $key =>$value)
                                            <tr>
                                                <td class="text-center">{{ $bil++}}</td>
                                                <td>{{ strtoupper(data_get($value,'lkpperkhidmatan.name')) }}</td>
                                                <td>{{ data_get($value,'codehasil.ptj.name')}}</td>
                                                <td>{{ data_get($value,'codehasil.name')}}</td>
                                                <td>{{ data_get($value,'codehasil.reference_name')}}</td>
                                                @if(data_get($value, 'status') == 1)
                                                <td class="text-center">Aktif</td>
                                                @else
                                                <td class="text-center">Tidak Aktif</td>
                                                @endif
                                                <td class="text-center">
                                                    <a href="/admin/agensiptj/khidmat/dalaman/edit/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Kemaskini">
                                                    <i class="ri-edit-line"></i></a>
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
    $('#data-table-khid').DataTable({
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
