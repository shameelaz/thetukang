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
            <h5 class="header-style">Pengurusan Maklumat Pembayaran (Bil) </h5>
        </div>
    </div>

    <br>

    <div class="container">

        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Pengguna Agensi / PTJ -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Maklumat Pembayaran (Bil) : {{ data_get($kodhasil,'name') }}</h6>
                    </div>
                    <div style="float: right">

                        <a href="/ptj/bill/add/{{ data_get($kodhasil,'id')  }}"
                            class="btn btn-primary me-md-2 float-right">Tambah</a>

                        <a class="btn btn-primary me-md-2 float-right" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalImport">Import/Muat Naik</a>
                    </div>
                </div>

            </div>
                <div id="div-list-result">
                    <div class="card-body ">
                        <div>
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row g-2">
                            <div class="col-md-12 col-lg-12">

                                <div class="table-responsive">
                                    <table id="data-table-bill" class="table mt-2" style="width:100%;font-size: 12px;">
                                        <thead class="table-dark">
                                            <tr>
                                                <th style="text-align: center;">Bil</th>
                                                <th style="text-align: left;">No Akaun</th>
                                                <th style="text-align: left;">Nama Pemilik Akaun</th>
                                                <th style="text-align: center;">No Rujukan</th>
                                                <th style="text-align: center;">Amaun (RM)</th>
                                                <th style="text-align: center;">Keterangan Pembayaran</th>
                                                <th style="text-align: center;">Tarikh Bil</th>
                                                <th style="text-align: center;">Tarikh Tamat</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $bil = 1; ?>
                                            @foreach ($bill as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ $bil++ }}</td>
                                                    <td>{{ data_get($value, 'account_no') }}</td>
                                                    <td>{{ Str::upper(data_get($value, 'name')) }}</td>
                                                    <td class="text-center">{{ Str::upper(data_get($value, 'reference_no')) }}</td>
                                                    <td class="text-center">{{ data_get($value, 'amount') }}</td>
                                                    <td class="text-center">{{ data_get($value, 'bill_detail') }}</td>
                                                    <td class="text-center">{{  date('d-m-Y',strtotime(data_get($value, 'bill_date'))) }}</td>
                                                    <td class="text-center">{{  date('d-m-Y',strtotime(data_get($value, 'bill_end_date'))) }}</td>
                                                    @if (data_get($value, 'status') == 1)
                                                        <td class="text-center">Aktif</td>
                                                    @elseif (data_get($value, 'status') == 2)
                                                        <td class="text-center">Tidak Aktif</td>
                                                    @else
                                                        <td class="text-center">Bayaran Di Kaunter</td>
                                                    @endif
                                                    <td class="text-center">
                                                        <a href="/ptj/bill/edit/{{ $value->fk_kod_hasil }}/{{ $value->id }}"
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

        <div class="col s12">
            <div id="modalImport" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="terms" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="terms">Import Excel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <u><b style="font-size: 11px !important;">Note:</b></u><br>
                                <ol style="font-size: 11px !important;">
                                    <li> - Muat turun fail contoh .xlsx (<u><a
                                                href="/uploads/base/lampiran/xlsx/Contoh Maklumat Pembayaran Bil.xlsx" data-toggle="tooltip"
                                                title="Muat Turun Fail" class="invoice-action-edit mod-edit">Contoh Maklumat Pembayaran Bil.xlsx</a></u>)</li>
                                    <li> - Masukkan semua data ke dalam fail contoh .xlsx</li>
                                    <li> - Pastikan ruangan status adalah 0</li>
                                    <li> - Namakan semula fail contoh</li>
                                    <li> - Muat naik fail excel contoh dan klik butang Import</li>
                                </ol>
                                <br>
                                <br>


                                {!! form()->open()->post()->action(route('agency::bill.import'))->attribute('id', 'import')->multipart()->horizontal() !!}
                                @csrf
                                <input type="hidden" name="kodhasilid" value="{{data_get($kodhasil,'id')}}" />
                                <div class="intro-y col-span-12 sm:col-span-12">
                                    <div class="fallback"> <input name="file" id="file" type="file" required="required"> </div>
                                </div>

                                <br>
                                <br>
                                <div class="modal-footer">
                                    <button  class="btn btn-primary" type="submit" name="action" title="Import">Import</button>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" title="Batal">Batal</button>
                                </div>


                                {!! form()->close() !!}
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
            $("#import").on("submit", function(){
                document.getElementById("loader").classList.add("show");
            });//submit

            $(".modalImport").click(function(){
                $("#modalImport").modal('show');
            });

            $('#data-table-bill').DataTable({
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

