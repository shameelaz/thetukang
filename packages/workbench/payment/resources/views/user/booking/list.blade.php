@extends('web::perakepay.frontend.layouts.base')
<!-- extends('web::backend.layouts.base') -->
@section('content')

    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">USER SERVICES </h5>
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

                        {{-- <a href="/user/boo/add"
                            class="btn btn-primary me-md-2 float-right">Add</a> --}}
                    </div>
                </div>

            </div>
            <div id="div-list-result">
                <div class="card-body ">

                    <div class="row g-2">
                        <div class="col-md-12 col-lg-12">

                            <div class="table-responsive">
                                <table id="agencylist" class="table table-bordered table-striped mt-2" style="width:100%;font-size: 12px; vertical-align: middle;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;">&nbsp;</th>
                                            <th style="text-align: center;">TITLE</th>
                                            <th style="text-align: center;">DESCRIPTION</th>
                                            <th style="text-align: center;">DATE</th>
                                            <th style="text-align: center;">PRICE (RM)</th>
                                            <th style="text-align: center;">STATUS</th>
                                            <th style="text-align: center;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($book as $key => $value)
                                            <tr>
                                              <td class="text-center">{{ $bil++}}</td>
                                              <td class="text-center">{{ data_get($value,'title')}}</td>
                                              <td class="text-left">{{ data_get($value,'desc')}}</td>
                                              <td class="text-center">{{ date('d-m-Y', strtotime(data_get($value,'date_booking')))}}</td>
                                              <td class="text-center">{{ data_get($value,'mainservice.price')}}</td>
                                              <td class="text-center">
                                                @if (data_get($value,'status') == 1)
                                                  New                                             
                                                @else
                                                  Completed
                                                @endif
                                              </td>
                                              <td class="text-center">
                                                @if (data_get($value,'status') == 1)
                                                    <button class="btn btn-primary" disabled>In Progress <i class="ri-timer-2-line"></i></button>
                                                @else
                                                    <button class="btn btn-success" disabled>Success <i class="ri-check-double-line"></i></button>
                                                @endif
                                                
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
        $(document).ready(function(){
            $('#agencylist').DataTable({
                "responsive": true,
                "scrollY": true,
                "scrollX": true,
                "ordering": false,
                "info": true,
                'iDisplayLength': 50,
                "lengthMenu": [
                    [25, 50,100,250, -1],
                    [25, 50,100,250, "All"]
                ],
            });
        });
        
    </script>


@endpush
