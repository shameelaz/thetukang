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
            <h5 class="header-style">Pengurusan Perkhidmatan dan Kod Hasil </h5>
        </div>
    </div>
    <br>
    <div class="container">

        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Pengguna Agensi / PTJ -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Kod Hasil : {{ data_get($kdhd, '0.servicekodhasil.lkpperkhidmatan.name') }}</h6>
                    </div>
                    <div style="float: right">

                        <a href="/ptj/kodhasil/adddetail/{{ Request::segment(4) }}"
                            class="btn btn-primary me-md-2 float-right">Tambah</a>
                    </div>
                </div>

            </div>
             {{-- form()->post()->url('/admin/kodhasil/result')!!} --}}

                <div id="div-list-result">
                    <div class="card-body ">

                        <div class="row g-2">
                            <div class="col-md-12 col-lg-12">

                                <div class="table-responsive">
                                    <table id="data-table-kodhasil" class="table mt-2" style="width:100%;font-size: 12px;">
                                        <thead class="table-dark">
                                            <tr>
                                                <th style="text-align: center;">Bil</th>
                                                <th style="text-align: left;">Perkhidmatan</th>
                                                <th style="text-align: left;">Kod Hasil</th>
                                                <th style="text-align: center;">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $bil = 1;?>
                                            @foreach ($kdhd as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ $bil++ }}</td>
                                                    <td>{{ data_get($value, 'servicekodhasil.lkpperkhidmatan.name') }}</td>
                                                    <td>{{ data_get($value, 'hasil.name') }}</td>
                                                    <td class="text-center">
                                                        <a href="/ptj/kodhasil/editdetail/{{ $value->id }}/{{ $value->fk_kod_hasil }}"
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
            $('#data-table-kodhasil').DataTable({
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
