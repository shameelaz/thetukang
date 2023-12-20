<?php

// $user = \Workbench\Database\Model\User\Users::where('id',Auth::user()->id)->first();
// $lastlogin = Auth::user()->last_login;
$agency = \Workbench\Database\Model\Agency\LamanAgensi::where('status',1)->with('agensi')->get();

?>

			@if(Auth::check())

                @php
                    $profile = \Workbench\Database\Model\User\UserProfile::where('fk_users',Auth::user()->id)->first();
                    $kodhasil = \Workbench\Database\Model\Agency\KodHasil::where('fk_agency',$profile->fk_agency)
                    ->where('fk_ptj',$profile->fk_ptj)
                    ->where('status', 1)
                    ->with('lkpperkhidmatan')
                    ->get();
                @endphp

                @if((Auth::user()->roles['0']->id) == 7)
                {{-- role 7 pelanggan --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/home">HOME</a>
                    </li>
                </ul>

                @else
                {{-- role 4 handyman --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/home">HOME</a>
                    </li>
                    @if(((Auth::user()->roles['0']->id) == 4))
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="/handyman/service/list">Services</a>
                        </li>
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="/handyman/promotion/list">Promotion</a>
                        </li>
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="/handyman/booking/list">Booking</a>
                        </li>
                    @elseif (((Auth::user()->roles['0']->id) == 2))
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="/admin/servicetype/list">Services</a>
                        </li>
                    @endif
                </ul>

                @endif

                @else
                {{-- Public un login --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">HOME</a>
                    </li>
                </ul>
			@endif
