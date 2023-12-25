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

    <div class="row mt-4 mt-md-5">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-md-4">
                    <h6 class="mb-4">JUMLAH BAYARAN HARIAN MENGIKUT AGENSI </h6>
                    <div style="height: 300px">
                        <canvas id="chartDailyAgency"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body p-md-4">
                    <h6 class="mb-4">PERBANDINGAN TERIMAAN HASIL 2022 DAN TAHUN 2023</h6>
                    <div style="height: 300px">
                        <canvas id="chartTahunan"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mt-md-5">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-md-4">
                    <h6 class="mb-4">CARTA BAYARAN BULANAN MENGIKUT AGENSI  </h6>
                    <div style="height: 300px">
                        <canvas id="chartMonthlyAgency"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-md-4">
                    <h6 class="mb-4">CARTA BAYARAN TAHUNAN MENGIKUT AGENSI </h6>
                    <div style="height: 300px">
                        <canvas id="chartAnnualAgency"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mt-md-5">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-md-4">
                    <h6 class="mb-4">STATISTIK BULANAN 10 PENDAPATAN TERTINGGI MENGIKUT KOD HASIL  </h6>
                    <div style="height: 300px">
                        <canvas id="chartTopTenAmount"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-md-4">
                    <h6 class="mb-4">STATISTIK BULANAN 10 PENDAPATAN TERENDAH MENGIKUT KOD HASIL </h6>
                    <div style="height: 300px">
                        <canvas id="chartBottomTenAmount"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mt-md-5">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-md-4">
                    <h6 class="mb-4">CARTA BAYARAN MENGIKUT CARA BAYARAN DAN AGENSI  </h6>
                    <div style="height: 300px">
                        <canvas id="chartAnnualCaraXAgency"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
@endsection
@push('script')
<script type="text/javascript">
  
</script>
@endpush