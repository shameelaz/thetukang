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
            <h5 class="header-style m-0">Dashboard</h5>
        </div>
    </div>

    <div class="container my-5">
        <h5>Selamat Datang</h5>
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
                            <h6 class="text-muted text-uppercase">Pemilik akaun</h6>
                            <h2 class="m-0">
                                {{-- {{ $account }} --}}
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
                            <h6 class="text-muted text-uppercase">Bayaran</h6>
                            <h2 class="m-0">
                                {{-- {{ $payment }} --}}
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
                                <i class="ri-user-2-line"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            <h6 class="text-muted text-uppercase">Belum bayar</h6>
                            <h2 class="m-0">
                                {{-- {{ $nopayment }} --}}
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