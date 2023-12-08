@extends('web::perakepay.frontend.layouts.base')
<!-- extends('web::backend.layouts.base') -->
@section('content')

    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">SERVICES </h5>
        </div>
    </div>
    <br>
    <div class="container">

        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Perkhidmatan Handyman -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">List of Services</h6>
                    </div>
                    <div style="float: right">

                        <a href="/handyman/service/add"
                            class="btn btn-primary me-md-2 float-right">Add</a>
                    </div>
                </div>

            </div>
            <div id="div-list-result">
                <div class="card-body ">

                    <div class="row g-2">
                        <div class="col-md-12 col-lg-12">

                            <div class="table-responsive">
                                <table id="data-table-kodhasil" class="table table-bordered table-striped mt-2" style="width:100%;font-size: 12px; vertical-align: middle;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;">&nbsp;</th>
                                            <th style="text-align: center;">Services</th>
                                            <th style="text-align: center;">Description</th>
                                            <th style="text-align: center;">Price (RM)</th>
                                            <th style="text-align: center;">Location</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($srv as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ $bil++ }}</td>
                                                <td class="text-center">{{ data_get($value, 'lkpservicetype.name') }}</td>
                                                <td class="text-center">{{ data_get($value, 'desc') }}</td>
                                                <td class="text-center">{{ number_format(data_get($value,'price'), 2, '.', ',') }}</td>
                                                <td class="text-center">{{ data_get($value, 'location') }}</td>
                                                <td class="text-center">
                                                    <a href="/handyman/service/edit/{{ $value->id }}"
                                                        class="btn btn-primary mr-1 mb-2" title="Update">
                                                        <i class="ri-edit-line"></i></a>
                                                        <a href="/handyman/service/delete/{{ $value->id }}"
                                                            class="btn btn-primary mr-1 mb-2" title="Delete">
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
            });

        });
        
    </script>


@endpush
