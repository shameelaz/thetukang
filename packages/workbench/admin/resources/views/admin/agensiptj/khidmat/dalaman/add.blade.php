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
                    <h6 class="mt-2 float-left">Tambah Perkhidmatan Dalaman</h6>
                </div>
                <div style="float: right">

                </div>
            </div>


        </div>

        <div class="card-body ">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive">
                            {!! form()->open()->post()->action(url('/admin/agensiptj/khidmat/dalaman/save'))->attribute('id', 'myform')->horizontal() !!}

                            <input type="hidden" name="fk_laman_agensi" value="{{ Request::segment(6)  }}"/>
                            <table id="" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    {{-- <div class="ui top attached secondary segment">
                                        <div class="ui checkbox check-all">
                                          <input type="checkbox" name="checkall">
                                          <label>Pilih Semua</label>
                                        </div>
                                    </div> --}}
                                    <tr>
                                        <th style="text-align: center;">Bil</th>
                                        <th style="text-align: left;">Perkhidmatan</th>
                                        <th style="text-align: left;">Nama</th>
                                        <th style="text-align: center;">Nama Rujukan</th>
                                        <th style="text-align: center;">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $bil=1;?>
                                        @forelse($lkpkhidmat as $key =>$value)
                                            <tr>
                                                <td class="text-center">{{ $bil++}}</td>
                                                <td>{{ data_get($value,'lkpperkhidmatan.name')}}</td>
                                                <td>{{ data_get($value,'name')}}</td>

                                                <td class="text-center">{{ data_get($value,'reference_name') }}</td>

                                                <td class="text-center">
                                                    <input name="vid[]" value="{{$value->id}}"  type="checkbox">
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5">Semua sudah dikemaskini!</td></tr>
                                        @endforelse
                                </tbody>
                            </table>


                            <a href="/admin/agensiptj/khidmat/dalaman/list/{{ Request::segment(6)  }}" class="btn btn-dark">Kembali</a>
                            @if($lkpkhidmat->count() > 0)
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            @endif

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

@endpush
