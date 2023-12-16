@extends('web::perakepay.frontend.layouts.base')
<!-- extends('web::backend.layouts.base') -->

@section('content')

    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">BOOKING </h5>
        </div>
    </div>
    <br>
    <div class="container">

        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Perkhidmatan Handyman -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">List of Booking</h6>
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
                                            <th style="text-align: center;">COMPANY NAME</th>
                                            <th style="text-align: center;">PHONE NUMBER</th>
                                            <th style="text-align: center;">TITLE</th>
                                            <th style="text-align: center;">DESCRIPTION</th>
                                            <th style="text-align: center;">DATE</th>
                                            <th style="text-align: center;">PRICE (RM)</th>
                                            <th style="text-align: center;">IMAGE/ACTION</th>
                                            <th style="text-align: center;">STATUS</th>
                                            <th style="text-align: center;">RATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($book as $key => $value)
                                            <tr>
                                              <td class="text-center">{{ $bil++}}</td>
                                              <td class="text-center">{{ data_get($value,'mainservice.user.name')}}</td>
                                              <td class="text-center">{{ data_get($value,'mainservice.user.profile.mobile_no')}}</td>
                                              <td class="text-center">{{ data_get($value,'title')}}</td>
                                              <td class="text-left">{{ data_get($value,'desc')}}</td>
                                              <td class="text-center">{{ date('d/m/Y', strtotime(data_get($value,'date_booking')))}}</td>
                                              <td class="text-center">
                                                    @if (data_get($value,'discount_price') != null)
                                                        {{ number_format(data_get($value,'discount_price'), 2, '.', ',') }} 
                                                    @else
                                                        {{ number_format(data_get($value,'mainservice.price'), 2, '.', ',') }} 
                                                    @endif
                                              </td>
                                              <td class="text-center">
                                                    @foreach ($value->attachmenthandymanbooking as $attachment)
                                                        <a href="{{URL::to($attachment->full_path)}}" class="btn btn-secondary btn-sm active" target="_blank">Preview <i class="ri-eye-line"></i></a> <br>
                                                    @endforeach
                                                @if (data_get($value,'status') == 3)
                                                    {{ data_get($value,'desc_reject_handyman')}}
                                                
                                                @endif
                                              </td>
                                              <td class="text-center">
                                                @if (data_get($value,'status') == 1)
                                                    <button class="btn btn-primary" disabled>In Progress <i class="ri-timer-2-line"></i></button>
                                                @elseif (data_get($value,'status') == 3)
                                                    <button class="btn btn-danger" disabled>Rejected <i class="ri-close-line"></i></button>
                                                @else
                                                    <button class="btn btn-success" disabled>Success <i class="ri-check-double-line"></i></button>
                                                @endif
                                              </td>
                                              <td class="text-center">
                                                @if (data_get($value,'status') != 1 && data_get($value,'fk_lkp_rating') == null)
                                                    <a onclick="modalRate({{ data_get($value, 'id')}})" class="btn btn-warning"><i class="ri-star-line"></i></a>
                                                @elseif (data_get($value,'fk_lkp_rating') != null && data_get($value,'rating.status') == 1)
                                                    <i class="ri-star-line"></i>
                                                @elseif (data_get($value,'fk_lkp_rating') != null && data_get($value,'rating.status') == 2)
                                                    <i class="ri-star-line"></i><i class="ri-star-line"></i>
                                                @elseif (data_get($value,'fk_lkp_rating') != null && data_get($value,'rating.status') == 3)
                                                    <i class="ri-star-line"></i><i class="ri-star-line"></i><i class="ri-star-line"></i>
                                                @elseif (data_get($value,'fk_lkp_rating') != null && data_get($value,'rating.status') == 4)
                                                    <i class="ri-star-line"></i><i class="ri-star-line"></i><i class="ri-star-line"></i><i class="ri-star-line"></i>
                                                @elseif (data_get($value,'fk_lkp_rating') != null && data_get($value,'rating.status') == 5)
                                                    <i class="ri-star-line"></i><i class="ri-star-line"></i><i class="ri-star-line"></i><i class="ri-star-line"></i><i class="ri-star-line"></i>
                                                @elseif (data_get($value,'status') == 3 && data_get($value,'fk_lkp_rating') == null)
                                                    -
                                                @else
                                                    -
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

   
    <div class="modal fade " id="ratingsave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadmodalcontent" style="font-size:12px !important">

                </div>
            </div>
        </div>
    </div>
   
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
                'iDisplayLength': 25,
                "lengthMenu": [
                    [25, 50,100,250, -1],
                    [25, 50,100,250, "All"]
                ],
            });
        });

        // VIEW MODAL (RATE)
        function modalRate(id)
        {

            

            $.ajax(
            {
                url: "{{ URL::to('user/rating/modal') }}" + "/" + id,
                type: "get",

                beforeSend: function() 
                {
                    $('#ratingsave').modal('show');

                    document.getElementById('loadmodalcontent').innerHTML = '<div class="align-items-center text-center"><strong>Loading...</strong><div class="spinner-border s-auto" role="status" aria-hidden="true"></div></div>';
                    // document.getElementById("loader").classList.add("show");
                },
                success: function(result) 
                {
                    document.getElementById('loadmodalcontent').innerHTML = result;
                    // document.getElementById("loader").classList.remove("show");

                    // $("#div-result").html(result);
                }
            });
        }
        
    </script>


@endpush
