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
    <div class="w-90 mx-auto">
        <div class="row gx-lg-5">
            <div class="col-md-3">
                @include('web::perakepay.frontend.includes.sidemenu')
            </div>
            <div class="col-md-9">
                <div class="header-base">LIST OF BOOKING</div>
                <div class="table-responsive mt-4">
                    <table class="table" id="data-table-account" style="width:100%;font-size: 12px;">
                        <thead>
                            <tr class="table-light">
                                <th style="text-align: center;">&nbsp;</th>
                                <th style="text-align: center;">Name</th>
                                <th style="text-align: center;">Address</th>
                                <th style="text-align: center;">Phone Number</th>
                                <th style="text-align: center;">Image</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bil=1;?>
                                @foreach($account as $key =>$value)
                                    <tr>
                                        <td class="text-center">{{ $bil++}}</td>
                                        <td class="text-center">{{ data_get($value,'account_no')}}</td>
                                        <td class="text-center">{{ data_get($value,'name')}}</td>
                                        <td class="text-center">{{ data_get($value,'bill_detail')}}</td>
                                        <td class="text-center">{{ data_get($value,'amount')}}</td>
                                        <td class="text-center">{{ data_get($value,'amount')}}</td>
                                        <td class="text-center">
                                          <a href="/dashboard/updatetroli/{{data_get($value,'id')}}/{{$userid}}"> @lang('web::auth.pay') {{-- Bayar --}}<i class="ri-arrow-right-line"></i></a>
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
            'iDisplayLength': 50,
            "lengthMenu": [
                [25, 50,100,250, -1],
                [25, 50,100,250, "All"]
            ],
        });
    });

</script>

@endpush
