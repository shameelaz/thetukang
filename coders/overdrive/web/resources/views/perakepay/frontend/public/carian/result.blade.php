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
            <h5 class="header-style">Carian </h5>
        </div>
    </div>
    <div class="container my-5">

        <div class="card style-border">
            <div class="card-header">

                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Carian</h6>
                    </div>

                </div>

            </div>

            <div id="div-list-result">
                <div class="card-body ">

                    <div class="row g-2">
                        <div class="col-md-12 col-lg-12">
                            {!! form()->open()->get()->action(url('/carian/form'))->attribute('id', 'myform')->horizontal() !!}
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="" value="{{ data_get($request,'search') }}"  name="search" aria-label="" aria-describedby="button-search">
                                <button class="btn btn-outline-secondary" type="submit" id="button-search">Carian</button>
                            </div>
                            {!! form()->close() !!}

                            <div class="" >
                                <div class="alert alert-primary" role="alert">
                                    <strong> Jumlah: <span class="">{{ $form->count() }}</span> keputusan dijumpai </strong>
                                </div>


                            </div>

                            <div class="table-responsive">
                                <table id="data-table-userpdf" class="" style="">
                                    {{-- <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;">Bil</th>
                                            <th style="text-align: left;">Nama Agensi</th>
                                            <th style="text-align: left;">Nama Perkhidmatan</th>
                                            <th style="text-align: center;">Fail</th>


                                        </tr>
                                    </thead> --}}
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($form as $key => $value)
                                            <tr>
                                                {{-- <td class="text-center">{{ $bil++ }}</td> --}}
                                                <td><a href="/agensi/{{ data_get($value,'id') }}">{{ data_get($value,'agensi.name') }}</a></td>
                                                <td>
                                                    <?php
                                                    $search = data_get($request,'search');
                                                    $content = data_get($value,'keterangan_ms');
                                                    $aftersearch = "<span style='font-weight:bold;color:red;'>".$search."</span>";
                                                    $body = collect();
                                                    collect(explode('</p>', str_replace('<p>','', data_get($value,'keterangan_ms'))))
                                                    ->each(function($item,$key) use($body, $search,$aftersearch){
                                                        if(!is_null($item) && $item != ''):
                                                            $body->push(
                                                                ucfirst(
                                                                    str_replace(array($search,), array($aftersearch), $item)
                                                                )
                                                            );
                                                        endif;
                                                    });

                                                    $b = json_decode($body);

                                                    ?>
                                                    {!! $b[0] !!}
                                                </td>
                                                <td class="text-center">
                                                    <a href="/agensi/{{ data_get($value,'id') }}" title="Papar" class="btn btn-primary mr-1 mb-2"><i class="ri-search-eye-fill"></i></a>

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
                "scrollY": 200,
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
