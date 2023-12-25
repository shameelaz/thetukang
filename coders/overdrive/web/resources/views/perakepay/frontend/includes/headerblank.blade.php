<header>
	<div class="container py-3">
		<div class="row align-items-center">
			<div class="col">
				<img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}" class="logo" />
				{{-- <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-perak-epay.svg') }}"
					style="height:40px" /> --}}
			</div>
			{{-- <div class="col-md-auto mt-3 mt-md-0 d-none d-md-block">
				<div class="hstack gap-3">
					<img src="{{ asset('overide/web/themes/perakepay/assets/images/icon/icon-faq.png') }}"
						class="h-24" />
					<img src="{{ asset('overide/web/themes/perakepay/assets/images/icon/icon-hubungi.png') }}"
						class="h-24" />
					<img src="{{ asset('overide/web/themes/perakepay/assets/images/icon/icon-maklumbalas.png') }}"
						class="h-24" />
					<img src="{{ asset('overide/web/themes/perakepay/assets/images/icon/icon-peta.png') }}"
						class="h-24" />
					<button class="btn btn-light">
						<i class="ri-wheelchair-line"></i>
					</button>
					<div class="input-group search-icon">
						<input class="form-control rounded" type="text" placeholder="Carian">
						<span class="input-group-append">
							<button class="btn border-0" type="button">
								<i class="ri-search-line"></i>
							</button>
						</span>
					</div>
				</div>
			</div> --}}
			<div class="col-auto d-md-none">
				<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
					data-bs-target="#offcanvasMenuMobile" aria-controls="offcanvasMenuMobile">
					<i class="ri-menu-3-line"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenuMobile" aria-labelledby="offcanvasMenuMobileLabel">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasMenuMobileLabel">Offcanvas</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<div>
				Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images,
				lists, etc.
			</div>
			<div class="dropdown mt-3">
				<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
					Dropdown button
				</button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Action</a></li>
					<li><a class="dropdown-item" href="#">Another action</a></li>
					<li><a class="dropdown-item" href="#">Something else here</a></li>
				</ul>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-frontend bg-primary d-none d-md-flex">
		<div class="container">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="/">Utama</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="/">Agensi & Perkhidmatan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="/">Panduan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="/">Soalan Lazim</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="/hubungi">Hubungi</a>
					</li>
				</ul>
				<div class="d-flex align-items-center">
					<a class="nav-link me-4 fw-bold" aria-current="page" href="/">Daftar</a>
					<a class="btn btn-dark text-primary" aria-current="page" href="/auth/login">
						<span class="fw-bold me-2">Log masuk</span> <i class="ri-login-circle-line"></i>
					</a>
				</div>
			</div>
		</div>
	</nav>
</header>