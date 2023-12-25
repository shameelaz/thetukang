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
            <h5 class="header-style">Panduan Pengguna PDF</h5>
        </div>
    </div>
    <div class="container">

        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Pengguna Agensi / PTJ -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Panduan Pengguna PDF</h6>
                    </div>
                    <div style="float: right">

                        <a href="/admin/userpdf/add"
                            class="btn btn-primary me-md-2 float-right">Tambah</a>
                    </div>
                </div>

            </div>

            <div id="div-list-result">
                <div class="card-body ">

                    <div class="row g-2">
                        <div class="col-md-12 col-lg-12">

                            <div class="table-responsive">
                                <table id="data-table-userpdf" class="table mt-2" style="width:100%;font-size: 12px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;">Bil</th>
                                            <th style="text-align: left;">Nama Agensi</th>
                                            <th style="text-align: left;">Nama Perkhidmatan</th>
                                            <th style="text-align: center;">Fail</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($usrpdf as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ $bil++ }}</td>
                                                <td>{{ data_get($value, 'agensi.name') }}</td>
                                                <td>{{ data_get($value, 'lkpperkhidmatan.name') }}</td>
                                                <td class="text-center">
                                                    <a href="{{ data_get($value,'fail') }}" title="Muat Turun" class="btn btn-primary mr-1 mb-2"><i class="ri-file-pdf-fill"></i></a>

                                                </td>
                                                @if (data_get($value, 'status') == 1)
                                                    <td class="text-center">Aktif</td>
                                                @else
                                                    <td class="text-center">Tidak Aktif</td>
                                                @endif
                                                <td class="text-center">
                                                    <a href="/admin/userpdf/edit/{{ $value->fk_agensi }}/{{ $value->id }}"
                                                        class="btn btn-primary mr-1 mb-2" title="Kemaskini">
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

    </div>
    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#data-table-userpdf').DataTable({
                "responsive": true,
                "scrollY": true,
                "scrollX": true,
                "ordering": false,
                "info": true,
                'iDisplayLength': 100,
                "lengthMenu": [
                    [25, 50, 100, 250, -1],
                    [25, 50, 100, 250, "All"]
                ],
                @if ($locale == 'ms')
                    "language": {
                        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                    },
                @endif
            });

            // // onload ------------

            // // end onload ------------

            // $('select[name="agency"]').change(function()
            // {
            //     var val = $(this).val();

            //     if(val)
            //     {
            //         $.ajax({
            //         type: "GET",
            //         url: "{{ URL::to('/admin/liabiliti/ajax/ptj')}}"+"/"+val,

            //         beforeSend: function ()
            //         {
            //             $("#div-ptj").hide();

            //             document.getElementById("loader").classList.add("show");
            //         },
            //         success: function(result)
            //         {
            //             $("#div-ptj-result").html(result);
            //             document.getElementById("loader").classList.remove("show");
            //         }
            //         });

            //         $.ajax({
            //             type: "GET",
            //             url: "{{ URL::to('/admin/liabiliti/ajax/agency')}}"+"/"+val,

            //             beforeSend: function ()
            //             {
            //                 $("#div-list-result").hide();

            //                 document.getElementById("loader").classList.add("show");

            //                 $("#data-table-liabiliti").DataTable().destroy();
            //             },
            //             success: function(result)
            //             {
            //                 $("#div-list-result").html(result);
            //                 $("#div-list-result").show();
            //                 document.getElementById("loader").classList.remove("show");
            //             }
            //         });
            //     }

            // });
        });
    </script>

    {{-- <script type="text/javascript">
        function submitSearch()
        {
            var agency_id = document.getElementById('agency').value;
            var ptj_id    = document.getElementById('ptj').value;

            window.location.href = "/admin/liabiliti/result/"+agency_id+"/"+ptj_id;
        }
    </script> --}}
@endpush
