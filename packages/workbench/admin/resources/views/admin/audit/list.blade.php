@extends('web::perakepay.frontend.layouts.base')

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
            <h5 class="header-style">Jejak Audit</h5>
        </div>
    </div>
    <div class="container my-5">

        <div class="card rounded style-border">
            <div class="card-header">
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class=" mt-2 float-left">Senarai jejak audit</h6>
                    </div>

                </div>


            </div>


            <div class="card-body">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive">
                            <table id="data-table-audit" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: left;">Bil</th>
                                        <th style="text-align: left;">Nama</th>
                                        <th style="text-align: left;">Task</th>
                                        <th style="text-align: left;">Tarikh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $bil=1; @endphp
                                    @foreach ($audit as $key => $value)
                                        <tr>
                                            <td>{{ $bil++ }}</td>
                                            <td>{{ data_get($value,'user.name') }}</td>
                                            <td>{{ data_get($value,'desc') }}</td>
                                            <td>
                                                {{ date('d-m-Y H:s:i',strtotime(data_get($value,'created_at')))  }}
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

    <!-- Modal -->
    {{-- <div class="modal fade" id="password-modal-preview" tabindex="-1" aria-labelledby="password-modal-preview"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! form()->open()->post()->action(url('/admin/user/awam/password'))->horizontal()->attribute('id', 'myform') !!}
                    <div class="p-2 text-center"> <i data-feather="alert-circle"
                            class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Perlu Tukar Katalaluan?</div>
                        <div class="text-gray-600 mt-2">Pengesahan Emel tukar katalaluan akan dihantar ke email pengguna
                            <br></div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <input type="hidden" name="id" id="id" />
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-primary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Batal</button>

                        <input type="submit" class="btn btn-primary w-30" value="Ya!">

                    </div>
                    {!! form()->close() !!}
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div> --}}

    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        function funcPass(id) {
            $("#id").val(id);
        }


        $(document).ready(function() {
            $('#data-table-audit').DataTable({
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
