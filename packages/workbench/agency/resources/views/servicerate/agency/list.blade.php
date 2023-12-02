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
            <h5 class="header-style">Pengurusan Perkhidmatan dan Kadar Bayaran </h5>
        </div>
    </div>
    <br>
    <div class="container">

        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Pengguna Agensi / PTJ -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Perkhidmatan dan Kadar Bayaran</h6>
                    </div>
                    <div style="float: right">

                        <a href="/ptj/servicerate/addkadar/{{ Request::segment(4) }}"
                            class="btn btn-primary me-md-2 float-right">Tambah</a>
                    </div>
                </div>

            </div>
             {{-- form()->post()->url('/admin/servicerate/result')!!} --}}

                <div id="div-list-result">
                    <div class="card-body ">

                        <div class="row g-2">
                            <div class="col-md-12 col-lg-12">

                                <div class="table-responsive">
                                    <table id="data-table-servicerate" class="table mt-2" style="width:100%;font-size: 12px;">
                                        <thead class="table-dark">
                                            <tr>
                                                <th style="text-align: center;">Bil</th>
                                                <th style="text-align: left;">Perkhidmatan</th>
                                                <th style="text-align: left;">Lokasi</th>
                                                <th style="text-align: center;">Kategori</th>
                                                <th style="text-align: center;">Unit</th>
                                                <th style="text-align: center;">Kadar (RM)</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $bil = 1; //dump($kadar);?>
                                            @foreach ($kadar as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ $bil++ }}</td>
                                                    <td>{{ data_get($value, 'serviceratemgt.lkpperkhidmatan.name') }}</td>
                                                    <td>{{ data_get($value, 'location') }}</td>
                                                    <td class="text-center">{{ data_get($value, 'fkcategory.description') }}</td>
                                                    <td class="text-center">{{ data_get($value, 'fkunit.description') }}</td>
                                                    <td class="text-center">{{ data_get($value, 'rate') }}</td>
                                                    @if (data_get($value, 'status') == 1)
                                                        <td class="text-center">Aktif</td>
                                                    @else
                                                        <td class="text-center">Tidak Aktif</td>
                                                    @endif
                                                    <td class="text-center">
                                                        <a href="/ptj/servicerate/editkadar/{{ data_get($kadar,'0.serviceratemgt.id') }}/{{ $value->id }}"
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
             {{-- form()->close() !!} --}}
        </div>

    </div>
    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#data-table-servicerate').DataTable({
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


@endpush
