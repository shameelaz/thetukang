<?php
    $logo = \Workbench\Database\Model\Base\Logo::where('id',1)->first();

?>
<header>
	<div class="container py-2">
		<div class="row align-items-center">
			<div class="col" style="text-align-last: center;">
				@if(data_get($logo,'logo_negeri')==NULL)
                <a href="/home">
                    <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}" class="logo" />
                </a>
				@else
				<img src="{{data_get($logo,'logo_negeri')}}" alt="..." class="logo" style="height:60px">
				@endif

			</div>
			<div class="col-md-auto mt-3 mt-md-0 d-none d-md-block">
				@include('web::perakepay.frontend.includes.topbar')
			</div>
			<div class="col-auto d-md-none">
				<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
					data-bs-target="#offcanvasMenuMobile" aria-controls="offcanvasMenuMobile">
					<i class="ri-menu-3-line"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenuMobile"
		aria-labelledby="offcanvasMenuMobileLabel">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasMenuMobileLabel">Menu</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			@include('web::perakepay.frontend.includes.topbar')
			<hr>
			@include('web::perakepay.frontend.includes.menu')
			<div class="mt-auto">
				<hr>
				@if(Auth::check())
					<?php
						$badge = \Workbench\Database\Model\User\Inbox::where('kepada',Auth::user()->id)->where('status',0)->with('to','from')->count();
					?>
					<div>
						<div class="fw-bold">
							{{auth()->user()->name}}
						</div>
						<ul class="list-unstyled">
							@if(Auth::user()->roles[0]->id !=7)
							<li class="mt-2 text-muted">Tarikh Luput: {{ date('d-m-Y',strtotime(Auth::user()->expired_date))}}</li>
							@endif
							<li class="mt-4">
								<a href="/inbox" class="link-dark">
									<i class="ri-notification-2-line me-1"></i> Inbox <span
											class="badge bg-danger badge rounded-pill">{{ $badge }}</span>
								</a>
							</li>
							<li class="mt-2">
								<a href="/user/profile" class="link-dark"><i class="ri-user-line me-1"></i> Profil</a>
							</li>
							<li class="mt-2">
								<a class="link-dark" href="/auth/logout">
									<i class="ri-logout-circle-r-line me-1"></i> Log keluar
								</a>
							</li>
						</ul>
					</div>
						@else
						<a class="btn btn-dark text-primary w-100 mt-3" href="/auth/login">
							<span class="fw-bold me-2">Log masuk</span> <i class="ri-login-circle-line"></i>
						</a>
						<div class="mt-3 text-center">
							Pengguna baru? <a class="fw-bold" href="/user/register"><u>Daftar di sini.</u></a>
						</div>
					@endif
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg navbar-frontend bg-primary d-none d-md-flex">
		<div class="container">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarMainMenu" aria-controls="navbarMainMenu" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarMainMenu">
				@include('web::perakepay.frontend.includes.menu')
				<div class="d-flex align-items-center">
					@include('web::perakepay.frontend.includes.menuaction')
				</div>
			</div>
		</div>
	</nav>
</header>
