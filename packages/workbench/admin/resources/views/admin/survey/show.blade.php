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
      <h5 class="header-style">Kemaskini Kajian Kepuasan Pelanggan</h5>
  </div>
</div>
<div class="container my-5">

    <div class="card rounded style-border">
        <div class="p-md-4">



        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Perhatian!</h4>
            <p>Sila pastikan anda memenuhi kriteria ini sebelum memuat naik imej</p>
            <hr>
            <p class="mb-0">
                <ul>
                    <li>Sila pastikan hanya format png,jpeg,jpg</li>
                    <li>Saiz tidak kurang dari 2MB</li>
                    {{-- <li>Beresolusi 60px x 60px untuk logo negeri</li>
                    <li>Beresolusi 144px x 40px untuk logo sistem</li> --}}
                </ul>
            </p>
        </div>
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif


        {!! form()->open()->post()->action(url('/admin/survey/update'))->attribute('id', 'myform')->multipart()->horizontal() !!}
        <input type="hidden" name="id" value="{{ data_get($survey,'id') }}" />
        <div id="div" style="">

            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">

                    <figure class="figure">
                        @if( data_get($survey,'image'))
                        <img src="{{data_get($survey,'image')}}" class="img-thumbnail figure-img img-fluid rounded logo" alt="..." style="height:60px">
                        @else

                        @endif

                        <figcaption class="figure-caption">Gambar</figcaption>
                    </figure>



                </div>

            </div>

            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                    @if(data_get($survey,'image'))
                        <input class="form-control form-control-sm" placeholder="" id="" name="image" type="file" >
                    @else
                        <input class="form-control form-control-sm" placeholder="" id="" name="image" type="file" required>
                    @endif

                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" id="description" value="{{ data_get($survey,'description') }}" name="description" type="text" required>
                </div>

            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Markah</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" id="rate" name="rate" type="number" required value="{{ data_get($survey,'rate') }}">
                </div>

            </div>
            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                        <option value=""> Sila Pilih</option>
                        <option value="1" <?php if(data_get($survey,'status')==1){echo "selected" ;}?>> Aktif </option>
                        <option value="0" <?php if(data_get($survey,'status')==0){echo "selected" ;}?>> Tidak Aktif </option>
                    </select>

                </div>
            </div>













            <a href="/admin/survey/list" class="btn btn-dark">Kembali</a>
            <button type="submit" class="btn btn-primary">Kemaskini</button>
        </div>
        {!! form()->close()!!}




        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="password-modal-preview" tabindex="-1" aria-labelledby="password-modal-preview" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!! form()->open()->post()->action(url('/admin/user/awam/password'))->horizontal() !!}
             <div class="p-2 text-center"> <i data-feather="alert-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                 <div class="text-3xl mt-5">Perlu Tukar Katalaluan?</div>
                 <div class="text-gray-600 mt-2">Pengesahan Emel tukar katalaluan akan dihantar ke email pengguna <br></div>
             </div>
             <div class="px-5 pb-8 text-center">
                <input type="hidden" name="id" id="id"/>
                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Batal</button>

                <input type="submit" class="btn btn-danger w-30" value="Ya!">

            </div>
        {!!form()->close()!!}
      </div>
      <div class="modal-footer">

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
    $('#data-table-user').DataTable({
        "responsive": true,
        "scrollY": 200,
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


$(document).ready(function(){
        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit
    });


</script>

@endpush
