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
            <h5 class="header-style">Sejarah Penyata Pemungut</h5>
        </div>
    </div>
    <div class="container">

        <br>

        <div class="card style-border">
            <div class="card-header">
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Sejarah Penyata Pemungut</h6>
                    </div>
                </div>

            </div>

            <div id="div-list-result">
                <div class="card-body ">

                    <div class="row g-2">
                        <div id="render_ajax" class="col-md-12 col-lg-12">

                            <div class="table-responsive">
                                <table id="data-table-statement" class="table mt-2" style="width:100%;font-size: 12px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;">Bil</th>
                                            <th style="text-align: center;">No Penyata Pemungut</th>
                                            @if(($roleid == 1)||($roleid == 2))
                                                <th style="text-align: center;">Agensi</th>
                                                <th style="text-align: center;">PTJ</th>
                                            @endif
                                            <th style="text-align: center;">Tarikh Bayaran</th>
                                            <th style="text-align: center;">Tarikh Hantar PP</th>
                                            <th style="text-align: center;">Jumlah (RM)</th>
                                            <th style="text-align: center;">Janaan Ispeks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($penyata as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ $bil++ }}</td>
                                                <td class="text-center"> {{ data_get($value, 'no_penyata_pemungut') }} </td>
                                                @if(($roleid == 1)||($roleid == 2))
                                                    <td class="text-left"> {{ data_get($value, 'agency.name') }} </td>
                                                    <td class="text-left"> {{ data_get($value, 'ptj.name') }} </td>
                                                @endif
                                                <td class="text-center"> {{ date('d-m-Y', strtotime(data_get($value,'tarikh_bayaran'))) }} </td>
                                                <td class="text-center"> {{ date('d-m-Y', strtotime(data_get($value,'tarikh_pp')))  }} </td>
                                                <td class="text-center"> {{ number_format(data_get($value,'jumlah_rm'), 2, '.', ',') }} </td>
                                                <td class="text-center">
                                                    <a href="/statement/log/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Lihat Fail">
                                                        <i class="ri-file-pdf-line"></i></a>&nbsp;
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
         $(document).ready(function() {
            $('#data-table-statement').DataTable({
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
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#myform").on("submit", function() {
                document.getElementById("loader").classList.add("show");
            }); //submit
        });
    </script>
@endpush
