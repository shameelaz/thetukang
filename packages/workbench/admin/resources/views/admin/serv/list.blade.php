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
            <h5 class="header-style">Pengurusan Pendaftaran Servis</h5>
        </div>
    </div>
    <br>
    <div class="container">

        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Pengguna Agensi / PTJ -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Servis</h6>
                    </div>

                </div>

            </div>


                <div class="row g-3 mt-2">
                    <div class="col-auto ml-12" style="text-align: end;">
                        <label for="" class="col-form-label">Agensi: </label>
                        <input type="text" readonly class="form-control-plaintext" id="" value="">
                    </div>
                    <div class="col-auto">

                        <label for="" class="visually-hidden">Pilih</label>

                        <select class="js-example-basic-single" id="agency" name="agency">
                                <option value=""> Sila Pilih</option>
                                @foreach($agency as $ak => $av)
                                    <option value="{{$av->id}}"> {{ data_get($av,'code') }} : {{ $av->name }} </option>
                                @endforeach
                        </select>
                    </div>
                </div>

                <div id="div-ptj-result">
                </div>

                <div id="div-list-result">
                    <div class="card-body ">

                        <div class="row g-2">
                            <div class="col-md-12 col-lg-12">

                                <div class="table-responsive">
                                    <table id="data-table-service" class="table mt-2" style="width:100%;font-size: 12px;">
                                        <thead class="table-dark">
                                            <tr>
                                                <th style="text-align: center;">Bil</th>
                                                <th style="text-align: left;">Nama Agensi</th>
                                                <th style="text-align: left;">Nama PTJ</th>
                                                <th style="text-align: left;">Nama Perkhidmatan</th>
                                                {{-- <th style="text-align: left;">Jenis Servis</th> --}}
                                                {{-- <th style="text-align: left;">URL Servis</th> --}}
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $bil = 1; ?>
                                            @foreach ($agserv as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ $bil++ }}</td>
                                                    <td>{{ data_get($value, 'agency.name') }}</td>
                                                    <td>{{ data_get($value, 'ptj.name') }}</td>
                                                    <td>{{ data_get($value, 'lkpperkhidmatan.name') }}</td>
                                                    {{-- <td class="text-left">{{ data_get($value, 'service_type') }}</td> --}}
                                                    {{-- <td class="text-left">{{ data_get($value, 'url') }}</td> --}}
                                                    @if (data_get($value, 'status') == 1)
                                                        <td class="text-center">Aktif</td>
                                                    @else
                                                        <td class="text-center">Tidak Aktif</td>
                                                    @endif
                                                    <td class="text-center">
                                                        <a href="/admin/service/edit/{{data_get($value,'agency.id')}}/{{data_get($value,'ptj.id')}}/{{ $value->id }}"
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
            $('#data-table-service').DataTable({
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

            $('select[name="agency"]').change(function()
            {
                var val = $(this).val();

                if(val)
                {
                    $.ajax({
                    type: "GET",
                    url: "{{ URL::to('/admin/service/ajax/ptj')}}"+"/"+val,

                    beforeSend: function ()
                    {
                        $("#div-ptj").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result)
                    {
                        $("#div-ptj-result").html(result);
                        document.getElementById("loader").classList.remove("show");
                    }
                    });

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('/admin/service/ajax/agency')}}"+"/"+val,

                        beforeSend: function ()
                        {
                            $("#div-list-result").hide();

                            document.getElementById("loader").classList.add("show");

                            $("#data-table-service").DataTable().destroy();
                        },
                        success: function(result)
                        {
                            // $("#div-list-result").html(result);
                            // $("#div-list-result").show();
                            // document.getElementById("loader").classList.remove("show");
                        }
                    });
                }

            });
        });
    </script>

    <script type="text/javascript">
        function submitSearch()
        {

            var agency_id = document.getElementById('agency').value;
            var ptj_id    = document.getElementById('ptj').value;
            if(ptj_id == 0){
                alert('Sila pilih PTJ');
                return false;
            }else{
                document.getElementById("loader").classList.add("show");
                window.location.href = "/admin/service/result/"+agency_id+"/"+ptj_id;
            }


        }


        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $( ".js-example-basic-single" ).focus();

        });

    </script>
@endpush
