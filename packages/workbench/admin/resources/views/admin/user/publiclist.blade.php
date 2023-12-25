<!-- extends('laravolt::elip.layouts.base') -->
@extends('web::backend.layouts.base')
@section('content')
<?php
if (Session::has('locale')) {
    $locale = Session::get('locale', Config::get('app.locale'));
} else {

    $locale = \Lang::locale();
}
?>

<style type="text/css">

    .pos-dropdown__dropdown-menu.dropdown-menu.show{
      width: 50% !important;
      /*transform: translate(651px, 1020px) !important*/
    }
</style>
<div class="section">

<link rel="stylesheet" href="{{asset('theme/assets/css/pages/page-knowledge.css')}}">
<link rel="stylesheet" href="{{asset('theme/assets/css/pages/app-email.css')}}">

 <br>
 <br>
  <div class="intro-y grid box" id="prepdata" style="">

    <div class="intro-y box col-span-12 lg:col-span-12">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Senarai Pengguna Awam
            </h2>
           {{-- <a href="#" data-toggle="modal" data-target="#modeladd" class="btn btn-success btnadd"><i data-feather="plus" class="w-4 h-4 mr-2"></i>Tambah</a> --}}
        </div>
        <div class="col s12">
            <div class="container">
                <div class="card-content p-5">
                    <table id="data-datatable-user" class="display" style="width:100%;font-size: 12px;background-color:#87b0fb">
                    <thead>
                        <tr>
                            <th style="text-align: left;">Bil</th>
                            <th style="text-align: left;">Emel</th>
                            <th style="text-align: left;">Nama Pengguna</th>
                            <th style="text-align: left;">Status</th>
                            <th style="text-align: left;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($user as $key =>$value)
                                <tr>
                                    <td>{{ data_get($value,'id')}}</td>
                                    <td>{{ data_get($value,'email')}}</td>
                                    @if(data_get($value, 'ls_status') == 1)
                                    <td>@lang('enforcement.enforcement.kebersihan.list-active')</td>
                                    @else
                                    <td>@lang('enforcement.enforcement.kebersihan.list-notActive')</td>
                                    @endif
                                    <td>
                                        <a href="/enforcement/kebersihan/edit/{{$value->id}}" class="btn btn-primary mr-1 mb-2 invoice-action-edit">
                                        <i data-feather="edit-3" class="w-4 h-4 mr-2"></i>@lang('enforcement.enforcement.kebersihan.list-update')
                                    </a>
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



<br>






</div>
@endsection
@push('script')
<script type="text/javascript">

    function funcDelete(id){
        $("#userid").val(id);
    }

    function funcPass(id){
        $("#user_id").val(id);
    }



    $('#data-table-user').DataTable({
        "responsive": true,
        "scrollY": 600,
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

</script>
@endpush

