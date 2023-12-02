@if(Auth::check())
	<?php
		$badge = \Workbench\Database\Model\User\Inbox::where('kepada',Auth::user()->id)->where('status',0)->with('to','from')->count();
        $userprofile = \Workbench\Database\Model\User\Users::where('id',Auth::user()->id)->with('profile.userPtj','profile.userAgency')->first();
        // dd($userprofile);
        $cart = \Workbench\Database\Model\Bill\Troli::where('fk_user',Auth::user()->id)->where('status',1)->count();
        // dd($cart);exit;
	?>

	<a href="/home">
    	<button type="button" class="btn btn-primary" style="padding-left: 0px;padding-right: 0px;">
    		<i class="ri-notification-2-fill"></i> <span
    			class="badge bg-danger start-30 translate-middle badge rounded-pill">{{ $badge }}</span>
    	</button>
	</a>

    {{-- <a href="/login/cart/list">
        <button type="button" class="btn btn-primary" style="padding-left: 0px;padding-right: 0px;">
            <i class="ri-shopping-cart-fill"></i> <span
                class="badge bg-danger start-30 translate-middle badge rounded-pill">{{ $cart }}</span>
        </button>
    </a> --}}

	<div class="dropdown">
		<a class="nav-link dropdown-toggle fw-bold" href="/user/profile" role="button"
			data-bs-toggle="dropdown" aria-expanded="false">
			<i class="ri-user-line"></i> <span class="ms-1">{{ strtoupper(auth()->user()->name)}}</span>

		</a>
		<ul class="dropdown-menu dropdown-menu-end" style="width: 250px;">

			<li><a class="dropdown-item text-uppercase" href="/user/profile">PROFILE</a></li>
			@if(Auth::user()->roles[0]->id !=7)
			<li><hr class="dropdown-divider"></li>
            <li class="mt-2 text-muted">

                <div class="card" style="">
                    {{-- <img src="" class="card-img-top" alt=""> --}}
                    <div class="card-body">
                       <table class="table table-bordered">
                            <tr>
                                <td>ROLE</td>
                                <td>{{ strtoupper(Auth::user()->roles[0]->name)  }}</td>
                            </tr>
                            {{-- <tr>
                                <td>AGENSI</td>
                                <td>{{ strtoupper(data_get($userprofile,'profile.userAgency.name')) }}</td>
                            </tr>
                            <tr>
                                <td>PTJ</td>
                                <td>{{ strtoupper(data_get($userprofile,'profile.userPtj.name')) }}</td>
                            </tr> --}}

                       </table>

                    </div>
                </div>

                {{-- <div class="card text-center">
                    <div class="card-header">
                        PERANAN : {{  Auth::user()->roles[0]->name;  }}
                    </div>
                    <div class="card-body">
                      <h6 class="card-title">Tarikh Luput: <font style="color:red;">{{ date('d-m-Y',strtotime(Auth::user()->expired_date))}}</font></h6>
                        @if(Auth::user()->roles[0]->id != 2)
                        <p class="card-text">AGENSI : {{ strtoupper(data_get($userprofile,'profile.userAgency.name')) }}</p>
                        <p class="card-text">PTJ : {{ data_get($userprofile,'profile.userPtj.name') }}</p>
                        @endif

                    </div>
                    <div class="card-footer text-muted">

                    </div>
                </div> --}}

                {{-- <div class="alert alert-primary" role="alert">
                    Peranan : {{  Auth::user()->roles[0]->name;  }}
                </div>
                <div class="alert alert-primary" role="alert">
                    Tarikh Luput: {{ date('d-m-Y',strtotime(Auth::user()->expired_date))}}
                </div>
                <div class="alert alert-primary" role="alert">
                    <p>Agensi : {{ data_get($userprofile,'profile.userAgency.name') }}</p>

                    <p>PTJ : {{ data_get($userprofile,'profile.userPtj.name') }}</p>
                </div> --}}


            </li>
			@endif
		</ul>
	</div>
	<a class="nav-link fw-bold" href="/auth/logout">
		<i class="ri-logout-circle-r-line"></i> <span class="ms-1 text-uppercase">LOGOUT</span>
	</a>
	@else
	<a class="nav-link me-4 fw-bold text-uppercase" href="/user/register">REGISTER</a>
	<a class="btn btn-dark text-primary" href="/auth/login">
		<span class="fw-bold me-2 text-uppercase">LOGIN</span> <i class="ri-login-circle-line"></i>
	</a>
	@endif
