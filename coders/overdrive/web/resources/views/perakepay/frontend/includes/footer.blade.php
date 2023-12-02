<?php
	use Workbench\Database\Model\Base\HubungiKami;
    use Workbench\Database\Model\Base\ShetabitVisits;

	$hubungi = HubungiKami::where('id',1)->first();
    $logo = \Workbench\Database\Model\Base\Logo::where('id',1)->first();

    $sumvisit = ShetabitVisits::count();
    $today = ShetabitVisits::where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<=',date('Y-m-d 23:59:59'))->count();
    $bulan = date('m');
    $tahun = date('Y');
    $monday = date('Y-m-d 00:00:00', strtotime('monday this week'));
    $sunday = date('Y-m-d 23:59:59', strtotime('sunday this week'));
    // dump($monday);
    // dump($sunday);
    // dump($bulan);
    // dump($tahun);
    $week = ShetabitVisits::where('created_at','>=',$monday)->where('created_at','<=',$sunday)->count();
    $month = ShetabitVisits::whereMonth('created_at',$bulan)->whereYear('created_at',$tahun)->count();

?>
<footer class="footer-main bg-dark text-white py-5">
	<div class="container">
		<div class="row gy-5 gy-md-0">
			<div class="col-md-4">
				<div class="fw-bold text-primary mb-2 text-uppercase">CONTACT US</div>
				<!-- Pejabat Setiausaha Kerajaan Negeri Perak<br>
				Bangunan Perak Darul Ridzuan, <br>
				Jalan Panglima Bukit Gantang Wahab, <br>
				30000 Ipoh, Perak Darul Ridzuan, <br>
				Malaysia. -->
				{{ data_get($hubungi,'nama')}} <br>
				{{ data_get($hubungi,'alamat')}} <br>

				<div class="mt-3">
					<div class="icon-list1">
						<div class="icon">
							<i class="ri-phone-line"></i> &nbsp;0196078234
						</div>
						<div class="body">

							<!-- 05-2095000 -->
						</div>
					</div>
					<div class="icon-list1">
						<div class="icon">
							<i class="ri-phone-fill"></i>&nbsp; 0335201934
						</div>
						<div class="body">

							<!-- 05-2095000 -->
						</div>
					</div>
					<div class="icon-list1 mt-2">
						<div class="icon">
							<i class="ri-mail-line"></i> &nbsp;astriyia@gmail.com
						</div>
						<div class="body">

							<!-- perak_epay@perak.gov.my -->
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="fw-bold text-primary mb-2 text-uppercase">&nbsp;</div>
				<div class="row">
					<div class="col-4">
						{{-- @lang('web::auth.today') --}}
					</div>
					<div class="col">
						{{-- {{ $today }} --}}
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						{{-- @lang('web::auth.this-week') --}}
					</div>
					<div class="col">
						{{-- {{ $week }} --}}
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						{{-- @lang('web::auth.this-month') --}}
					</div>
					<div class="col">
						{{-- {{ $month }} --}}
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						{{-- @lang('web::auth.total') --}}
					</div>
					<div class="col">
						{{-- {{ $sumvisit }} --}}
					</div>
				</div>
			</div>
			<div class="col-md-4">
                {{-- @if(data_get($logo,'logo_sistem')==NULL)
                    <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-perak-epay.svg') }}" style="height:40px" />
                @else
                    <img src="{{data_get($logo,'logo_sistem')}}" class="logo" alt="..."  style="height:40px">
                @endif --}}

				<img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}"
					style="height:40px" />
				<div class="mt-4">
					The Tukang Services 2023
				</div>
				<div class="mt-2">
					<div class="hstack gap-3 fs-3">
						<a href="#">
							<i class="ri-facebook-circle-line"></i>
						</a>
						<a href="#">
							<i class="ri-twitter-line"></i>
						</a>
					</div>
				</div>
			</div>
		</div>

		<hr class="my-4">

		<div class="row">
			<div class="col-md">
				<div class="hstack gap-2 gap-md-3 flex-column flex-md-row align-items-start align-items-md-center">
					<div>
						<a href="/">Home</a>
					</div>
					{{-- <div>
						<a href="/desclaimer">@lang('web::auth.disclaimer')</a>
					</div>
					<div>
						<a href="/privacy">@lang('web::auth.privacy-policy')</a>
					</div>
					<div>
						<a href="/security">@lang('web::auth.security-policy')</a>
					</div> --}}
				</div>
			</div>
			<div class="col-md-auto small text-muted mt-4 mt-md-0">
				<?php
                date_default_timezone_set("Asia/Kuala_Lumpur");


    			// setlocale(LC_TIME, "ms");
                $day = date('l');

    			// $day = strftime("%A",strtotime(date()));
    			switch ($day) {
    				case 'Sunday':
    					$hari =  'Sunday';
    					break;

    				case 'Monday':
                        $hari =  'Monday';
    					break;
    				case 'Tuesday':
                        $hari =  'Tuesday';
    					break;
    				case 'Wednesday':
                        $hari =  'Wednesday';
    					break;
    				case 'Thursday':
                        $hari =  'Thursday';
    					break;
    				case 'Friday':
                        $hari =  'Friday';
    					break;
    				case 'Saturday':
                        $hari =  'Saturday';
    					break;

    				default:
                        $hari =  '-';
    					break;
    			}

                ?>
				Last Updated : {{ $hari }} {{ date('d-m-Y H:i:s')}}
				<!-- Ahad 13 November 2022, 21:06:04 -->
			</div>
		</div>
	</div>
</footer>
