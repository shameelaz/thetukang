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
                  <h6 class="mb-4">JUMLAH BAYARAN HARIAN MENGIKUT AGENSI {{ date('j/n/Y' ,strtotime(data_get($chartdailypaymentbyagency,'today'))) }}</h6>
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
                  <h6 class="mb-4">CARTA BAYARAN BULANAN MENGIKUT AGENSI {{ data_get($chartmonthlypaymentbyagency,'month') }}/{{ data_get($chartmonthlypaymentbyagency,'year') }} </h6>
                  <div style="height: 300px">
                      <canvas id="chartMonthlyAgency"></canvas>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-6">
          <div class="card shadow-sm">
              <div class="card-body p-md-4">
                  <h6 class="mb-4">CARTA BAYARAN TAHUNAN MENGIKUT AGENSI {{ data_get($chartannualpaymentbyagency,'year') }} </h6>
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
                  <h6 class="mb-4">STATISTIK BULANAN 10 PENDAPATAN TERTINGGI MENGIKUT KOD HASIL {{ data_get($charthighestpendapatan,'month') }}/{{ data_get($charthighestpendapatan,'year') }} </h6>
                  <div style="height: 300px">
                      <canvas id="chartTopTenAmount"></canvas>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-6">
          <div class="card shadow-sm">
              <div class="card-body p-md-4">
                  <h6 class="mb-4">STATISTIK BULANAN 10 PENDAPATAN TERENDAH MENGIKUT KOD HASIL {{ data_get($chartlowestpendapatan,'month') }}/{{ data_get($charthighestpendapatan,'year') }} </h6>
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
                  <h6 class="mb-4">CARTA BAYARAN MENGIKUT CARA BAYARAN DAN AGENSI {{ data_get($carabayaranxagensi,'year') }} </h6>
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
  document.addEventListener('DOMContentLoaded', function () {


    const dailyAgency = document.getElementById('chartDailyAgency');
    const chartDailyAgency = new Chart(dailyAgency, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartdailypaymentbyagency['dailyagency_label']); !!},
            datasets: [{
            label: 'Jumlah (RM)',
            data: {!! json_encode($chartdailypaymentbyagency['dailyagency_amount']); !!},
            backgroundColor: [
                '#E63D08',
                '#E67308',
                '#E6C208',
                '#E6084B'
            ],
        }]
    },
        options: {
            maintainAspectRatio: false,
        }
    });
    
    const topten = document.getElementById('chartTopTenAmount');
    const chartTopTenAmount = new Chart(topten, {
        type: 'bar',
        data: {
            labels: {!! json_encode($charthighestpendapatan['label']) !!},
            datasets: [{
                label: 'Jumlah (RM)',
                data: {!! json_encode($charthighestpendapatan['amount']) !!},
                backgroundColor: [
                    '#E6C208',
                    '#E67308',
                    '#E63D08',
                    '#E6084B'
                ],
            }]
        },
        options: {
            maintainAspectRatio: false,
            indexAxis: 'y',
        }
    });

    const bottomten = document.getElementById('chartBottomTenAmount');
    const chartBottomTenAmount = new Chart(bottomten, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartlowestpendapatan['label']) !!},
            datasets: [{
                label: 'Jumlah (RM)',
                data: {!! json_encode($chartlowestpendapatan['amount']) !!},
                backgroundColor: [
                    '#0047AB',
                    '#6495ED',
                    '#00FFFF',
                    '#ADD8E6'
                ],
            }]
        },
        options: {
            maintainAspectRatio: false,
            indexAxis: 'y',
        }
    });
    
    <?php

    $current = date('Y');
    $previous = $current - 1;
    // dd($previous);
    $cur = data_get($diffhasil, $current);
    //  dd($currentyear);
    $first = [];
    foreach ($cur as $a => $b) {
        array_push($first, $b);
    }

    // dd($first);

    $pre = data_get($diffhasil, $previous);
    // dd($pre);
    $second = [];
    foreach ($pre as $x => $y) {
        array_push($second, $y);
    }
    ?>

    const cthn = document.getElementById('chartTahunan');
    const chartTahunan = new Chart(cthn, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ogs', 'Sept', 'Okt', 'Nov',
                'Dis'
            ],
            datasets: [{
                    label: <?php echo json_encode($previous); ?>,
                    data: <?php echo json_encode($second); ?>,
                    // data: [120, 190, 300, 500, 200, 300, 412, 109, 204, 90, 119, 540],
                    borderColor: [
                        '#E6C208'
                    ],
                    backgroundColor: [
                        '#E6C208',
                    ]
                },
                {
                    label: <?php echo json_encode($current); ?>,
                    data: <?php echo json_encode($first); ?>,
                    // data: [300, 110, 100, 200, 500, 350, 100, 80, 90, 300, 221, 323],
                    borderColor: [
                        '#082DE6'
                    ],
                    backgroundColor: [
                        '#082DE6',
                    ]
                }
            ]
        }
    });

    const monthlyAgency = document.getElementById('chartMonthlyAgency');
    const chartMonthlyAgency = new Chart(monthlyAgency, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($chartmonthlypaymentbyagency['monthlyagency_name']); !!},
            datasets: [{
            label: 'Jumlah (RM)',
            data: {!! json_encode($chartmonthlypaymentbyagency['monthlyagency_amount']); !!},
            backgroundColor: [
                '#3156ff',
                '#ffdb32',
                '#9bccff',
                '#ffe59b',
                '#ffb3b3',
                '#ff6f69'
            ],
        }]
    },
        options: {
            maintainAspectRatio: false,
        }
    });

    const annualAgency = document.getElementById('chartAnnualAgency').getContext('2d');;
    const chartAnnualAgency = new Chart(annualAgency, {
      type: 'bar',
      data: {
      labels: {!! json_encode($chartannualpaymentbyagency['label']) !!},
      datasets: {!! json_encode($chartannualpaymentbyagency['data']) !!}
    },
      options: {
        responsive: true,
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true
          }
        }
      }
    });

    const annualCaraXAgency = document.getElementById('chartAnnualCaraXAgency').getContext('2d');;
    const chartAnnualCaraXAgency = new Chart(annualCaraXAgency, {
      type: 'bar',
      data: {
      labels: {!! json_encode($carabayaranxagensi['cara']) !!},
      datasets: {!! json_encode($carabayaranxagensi['data']) !!}
    },
      options: {
        responsive: true,
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true
          }
        }
      }
    });
    
  }, true);
</script>
@endpush
