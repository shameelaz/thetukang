@extends('web::perakepay.frontend.layouts.pelanggan')
@section('content')
<?php
    if (Session::has('locale')) {
        $locale = Session::get('locale', Config::get('app.locale'));
    } else {
        $locale = \Lang::locale();
    }

    $lastlogin = Auth::user()->last_login;
    ?>
@push('style')
    <style type="text/css">
         .dataTables_scrollHeadInner {
            width: 100% !important;
        }

        .dataTable.no-footer {
            width: 100% !important;
        }
        </style>
@endpush

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style">MY ACCOUNT  {{-- Akaun --}}</h5>
    </div>
</div>

<div class="container my-5">
    <div class="w-80 mx-auto">
        <div class="row gx-lg-5">
            <div class="col-md-3">
                @include('web::perakepay.frontend.includes.sidemenu')
            </div>
            <div class="col-md-9">
                <div class="header-base">LIST OF BOOKING</div>
                <div class="table-responsive mt-4">
                    <table id="data-table-account" class="table table-bordered table-striped mt-2" style="width:100%;font-size: 12px; vertical-align: middle;">
                        <thead class="table-dark">
                            <tr>
                                <th style="text-align: center;">&nbsp;</th>
                                <th style="text-align: center;">COMPANY NAME</th>
                                <th style="text-align: center;">PHONE NUMBER</th>
                                <th style="text-align: center;">TITLE</th>
                                <th style="text-align: center;">DESCRIPTION</th>
                                <th style="text-align: center;">DATE</th>
                                <th style="text-align: center;">PRICE (RM)</th>
                                <th style="text-align: center;">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bil=1;?>
                                @foreach($booking as $key =>$value)
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
                                            @if (data_get($value,'status') == 1)
                                                <button class="btn btn-primary" disabled>In Progress <i class="ri-timer-2-line"></i></button>
                                            @elseif (data_get($value,'status') == 3)
                                                <button class="btn btn-danger" disabled>Rejected <i class="ri-close-line"></i></button>
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
@endsection

@push('script')

<script type="text/javascript">

    $(document).ready(function(){

        $('#data-table-account').DataTable({
            "responsive": true,
            "scrollY": true,
            "scrollX": true,
            "ordering": false,
            "info": true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [25, 50,100,250, -1],
                [25, 50,100,250, "All"]
            ],
        });
    });

</script>

@endpush
