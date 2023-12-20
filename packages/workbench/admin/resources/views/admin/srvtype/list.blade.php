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
      <h5 class="header-style">Lookup Service Type</h5>
  </div>
</div>
<div class="container">

    <div class="card style-border">
        <div class="card-header">
            <!-- Senarai Service Type -->
            <div class="gap-2">
                <div style="float: left">
                    <h6 class="mt-2 float-left">List Service Type</h6>
                </div>
                <div style="float: right">
                    <a href="/admin/servicetype/add" class="btn btn-primary me-md-2 float-right">Add</a>
                </div>
            </div>

        </div>


        <div class="card-body ">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive">
                            <table id="data-table-srvtype" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">&nbsp;</th>
                                        <th style="text-align: left;">NAME</th>
                                        <th style="text-align: left;">DESCRIPTION</th>
                                        <th style="text-align: center;">STATUS</th>
                                        <th style="text-align: center;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $bil=1;?>
                                        @foreach($srvtype as $key =>$value)
                                            <tr>
                                                <td class="text-center">{{ $bil++}}</td>
                                                <td>{{ data_get($value,'name')}}</td>
                                                <td>{{ data_get($value,'desc')}}</td>
                                                @if(data_get($value, 'status') == 1)
                                                <td class="text-center">Active</td>
                                                @else
                                                <td class="text-center">Not Active</td>
                                                @endif
                                                <td class="text-center">
                                                    <a href="/admin/servicetype/edit/{{$value->id}}" class="btn btn-primary mr-1 mb-2" title="Update">
                                                        <i class="ri-edit-line"></i></a>
                                                    <a href="/admin/servicetype/delete/{{ $value->id }}" class="btn btn-danger mr-1 mb-2" title="Delete">
                                                        <i class="ri-delete-bin-line"></i></a>
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
    $('#data-table-srvtype').DataTable({
        "responsive": true,
        "scrollY": true,
        "scrollX": true,
        "ordering": false,
        "info": true,
        'iDisplayLength': 10,
        "lengthMenu": [
            [25, 50,100,250, -1],
            [25, 50,100,250, "All"]
        ],
  });
});


</script>

@endpush
