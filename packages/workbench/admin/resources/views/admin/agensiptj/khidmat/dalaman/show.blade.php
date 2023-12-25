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
                    <h6 class="mt-2 float-left">Kemaskini Perkhidmatan Dalaman</h6>
                </div>
                <div style="float: right">

                </div>
            </div>


        </div>

        <div class="card-body ">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive">
                            {!! form()->open()->post()->action(url('/admin/agensiptj/khidmat/dalaman/update'))->attribute('id', 'myform')->horizontal() !!}

                            <input type="hidden" name="fk_laman_agensi" value="{{ data_get($khidmat,'fk_laman_agensi') }}"/>
                            <input type="hidden" name="id" value="{{ data_get($khidmat,'id') }}"/>


                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama"  value="{{ data_get($khidmat,'lkpperkhidmatan.name') }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Agensi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="agensi"  value="{{ data_get($khidmat,'lamanagensi.agensi.name') }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Kod Hasil</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kodhasil"  value="{{ data_get($khidmat,'codehasil.name') }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3" id="">
                                <label for="" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">

                                    <select class="form-select" id="status" name="status" required="required">
                                        <option value=""> Sila Pilih</option>
                                        <option value="1" <?php if(data_get($khidmat,'status')==1){echo "selected" ;}?>> Aktif </option>
                                        <option value="0" <?php if(data_get($khidmat,'status')==0){echo "selected" ;}?>> Tidak Aktif </option>
                                    </select>

                                </div>
                            </div>

                            <a href="/admin/agensiptj/khidmat/dalaman/list/{{ data_get($khidmat,'fk_laman_agensi') }}" class="btn btn-dark">Kembali</a>
                            <button type="submit" class="btn btn-primary">Kemaskini</button>



                            {!! form()->close() !!}
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
        "info": false,
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
<script type="text/javascript">
    $( document ).ready(function() {

        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit

    });
</script>

@endpush
