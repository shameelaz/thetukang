<!-- extends('laravolt::elip.layouts.base') -->
@extends('web::perakepay.frontend.layouts.base')
@section('content')
    <style type="text/css">
        .pos-dropdown__dropdown-menu.dropdown-menu.show {
            width: 50% !important;
            /*transform: translate(651px, 1020px) !important*/
        }
    </style>

    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style m-0">WELCOME {{ $user->name}} !</h5>
        </div>
    </div>

    <div class="container my-5">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="box-widget stats-info">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <div class="icon">
                                <i class="ri-user-2-line"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <h6 class="text-muted text-uppercase">Total of Customer</h6>
                            <h2 class="m-0">
                                {{ $totalCust }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-widget stats-success">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <div class="icon">
                                <i class="ri-user-2-line"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <h6 class="text-muted text-uppercase">Total of Handyman</h6>
                            <h2 class="m-0">
                                {{ $totalHandyman }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-widget stats-danger">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <div class="icon">
                                <i class="ri-hammer-line"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <h6 class="text-muted text-uppercase">Total of Services</h6>
                            <h2 class="m-0">
                                {{ $totalServices }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="box-widget stats-info">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <div class="icon">
                                <i class="ri-add-line"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <h6 class="text-muted text-uppercase">Total of New Booking</h6>
                            <h2 class="m-0">
                                {{ $totalBookingNew }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-widget stats-success">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <div class="icon">
                                <i class="ri-check-double-line"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <h6 class="text-muted text-uppercase">Total of Booking Completed</h6>
                            <h2 class="m-0">
                                {{ $totalBookingDone }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-widget stats-danger">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <div class="icon">
                                <i class="ri-close-line"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <h6 class="text-muted text-uppercase">Total of Booking Rejected</h6>
                            <h2 class="m-0">
                                {{ $totalBookingReject }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    </div>

    <?php  
        // dd($chartannualpaymentbyagency['aaalabel']); 
    // dd(json_encode($barChartTotalPaymentLabel));
        // dd(json_encode($chartannualpaymentbyagency['data']));
    ?>
    
@endsection