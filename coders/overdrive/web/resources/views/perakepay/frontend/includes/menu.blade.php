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
                    // dump($kodhasil);
                @endphp

                @if((Auth::user()->roles['0']->id) == 7)
                {{-- role 7 pelanggan --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/home">HOME</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">@lang('web::auth.agency-services')</a>
                        <ul class="dropdown-menu">
                            @forelse($agency as $key => $value)
                                <li> <a class="dropdown-item" href="/agensi/{{ $value->id }}"> {{ data_get($value,'agensi.name') }} </a></li>
                            @empty

                            @endforelse
                        <li> <a class="dropdown-item" href="#"> Dropdown item 1 </a></li>
                        <li> <a class="dropdown-item sub" href="#"> Dropdown item 2  </a>
                            <ul class="submenu dropdown-menu">
                            <li><a class="dropdown-item" href="#">Submenu item 1</a></li>
                            <li><a class="dropdown-item" href="#">Submenu item 2</a></li>
                            <li><a class="dropdown-item sub" href="#">Submenu item 3 </a>
                                <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="#">Multi level 1</a></li>
                                <li><a class="dropdown-item" href="#">Multi level 2</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="#">Submenu item 4</a></li>
                            <li><a class="dropdown-item" href="#">Submenu item 5</a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"> Dropdown item 3 </a></li>
                        <li><a class="dropdown-item" href="#"> Dropdown item 4 </a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="/panduan"> @lang('web::auth.user-guide')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/faq">@lang('web::auth.faq')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hubungi">@lang('web::auth.contact')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/feedback">@lang('web::auth.feedback')</a>
                    </li> --}}
                </ul>

                @else
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/home">HOME</a>
                    </li>
                    @if(((Auth::user()->roles['0']->id) == 4)||((Auth::user()->roles['0']->id) == 5))
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="/handyman/service/list">Services</a>
                        </li>
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="/handyman/promotion/list">Promotion</a>
                        </li>
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="/handyman/service/list">Booking</a>
                        </li>
                    @endif
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Service</a>
                        <ul class="dropdown-menu">
                        <li>
                            @if(((Auth::user()->roles['0']->id) == 2))
                                <a class="dropdown-item sub" href="#"> Pengurusan Sistem</a>
                            @endif
                            <ul class="submenu dropdown-menu">
                            @if(((Auth::user()->roles['0']->id) != 3))

                            <li><a class="dropdown-item sub" href="#">Pengurusan Pengguna</a>
                                <ul class="submenu dropdown-menu">
                                @if(((Auth::user()->roles['0']->id) == 1)||((Auth::user()->roles['0']->id) == 2))
                                    <li><a class="dropdown-item" href="/admin/user/awam">Pengguna Awam</a></li>
                                    <li><a class="dropdown-item" href="/admin/user/internal">Pegawai Dalaman</a></li>
                                    <li><a class="dropdown-item" href="/admin/user/agency">Pegawai Agensi/PTJ</a></li>

                                @endif
                                </ul>
                            </li>
                            @endif
                            @if(((Auth::user()->roles['0']->id) == 1)||((Auth::user()->roles['0']->id) == 2))
                                <li><a class="dropdown-item sub" href="">Pengurusan Agensi / PTJ </a>
                                    <ul class="submenu dropdown-menu">
                                    <li><a class="dropdown-item" href="/admin/agency/list">Agensi</a></li>
                                    <li><a class="dropdown-item" href="/admin/agency/ptj/list">PTJ</a></li>
                                    <li><a class="dropdown-item" href="/admin/khidmat/list">Perkhidmatan</a></li>
                                    <li><a class="dropdown-item" href="/admin/hasil/list">Kod Hasil</a></li>
                                    <li><a class="dropdown-item" href="/admin/pelarasan/list">Pelarasan Kod Hasil</a></li>
                                    <li><a class="dropdown-item" href="/admin/liabiliti/list">Kod Liabiliti</a></li>
                                    <li><a class="dropdown-item" href="/ptj/tetapan/list">Tetapan Kadar Bayaran</a></li>
                                    <li><a class="dropdown-item" href="/ptj/servicerate/list">Perkhidmatan dan Kadar Bayaran</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="/admin/service/list">Pengurusan Servis</a></li>
                                <li><a class="dropdown-item" href="/admin/payment/list">Pengurusan Payment Gateway</a></li>
                                <li><a class="dropdown-item" href="/admin/transaction/list">Sejarah Transaksi</a></li>
                            @elseif ((Auth::user()->roles['0']->id) == 3)
                                <li><a class="dropdown-item sub" href="">Pengurusan Agensi / PTJ </a>
                                    <ul class="submenu dropdown-menu">
                                    <li><a class="dropdown-item" href="/admin/agency/list">Agensi</a></li>
                                    <li><a class="dropdown-item" href="/admin/agency/ptj/list">PTJ</a></li>
                                    <li><a class="dropdown-item" href="/admin/khidmat/list">Perkhidmatan</a></li>
                                    <li><a class="dropdown-item" href="/admin/hasil/list">Kod Hasil</a></li>
                                    <li><a class="dropdown-item" href="/admin/liabiliti/list">Kod Liabiliti</a></li>
                                    </ul>
                                </li>
                            @endif
                            </ul>
                        </li>
                        @if(((Auth::user()->roles['0']->id) == 1)||((Auth::user()->roles['0']->id) == 2))
                        <li><a class="dropdown-item sub" href="#"> Pengurusan Laman Utama </a>
                            <ul class="submenu dropdown-menu">
                            <li><a class="dropdown-item" href="/base/logo">Logo</a></li>
                            <li><a class="dropdown-item" href="/admin/banner/list">Banner</a></li>
                            <li><a class="dropdown-item" href="/admin/agensiptj/list">Agensi/PTJ</a></li>
                            <li><a class="dropdown-item" href="/admin/faq/list">Soalan Lazim</a></li>
                            <li><a class="dropdown-item sub" href="#">Panduan Pengguna</a>
                                    <ul class="submenu dropdown-menu">
                                        <li><a class="dropdown-item" href="/admin/userpdf/list">Panduan PDF</a></li>
                                        <li><a class="dropdown-item" href="/admin/manual/video/list">Panduan Video</a></li>
                                    </ul>
                            </li>

                            <li><a class="dropdown-item" href="/admin/hubungi">Hubungi Kami</a></li>
                            <li><a class="dropdown-item" href="/admin/survey/list">Kajian Kepuasan Pengguna</a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="/admin/audit"> Jejak Audit </a></li>

                        @endif
                        @if(((Auth::user()->roles['0']->id) == 4)||((Auth::user()->roles['0']->id) == 5))
                            <li><a class="dropdown-item" href="/handyman/service/list">Add Services</a></li>
                        @endif


                        </ul>
                    </li> --}}
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Laporan</a>
                        <ul class="dropdown-menu">
                            @if(((Auth::user()->roles['0']->id) == 1)||((Auth::user()->roles['0']->id) == 2))
                                <li><a class="dropdown-item" href="/report/receipt">Laporan Terimaan Harian/Bulanan </a></li>
                                <li><a class="dropdown-item" href="/report/receipttype">Laporan Terimaan Harian/Bulanan Ikut Jenis</a></li>
                                <li><a class="dropdown-item" href="/report/book">Laporan Buku Tunai Terimaan Harian/ Bulanan</a></li>
                                <li><a class="dropdown-item" href="/report/penyatapemungut">Laporan Penyata Pemungut Harian/ Bulanan</a></li>
                                <li><a class="dropdown-item" href="/report/pelarasan">Laporan Pelarasan Kod Hasil </a></li>
                                <li><a class="dropdown-item" href="/report/users">Laporan Senarai Pengguna</a></li>
                                <li><a class="dropdown-item" href="/report/survey">Laporan Kajian Kepuasan Pengguna</a></li>
                            @endif

                            @if(((Auth::user()->roles['0']->id) == 3)||((Auth::user()->roles['0']->id) == 4)||((Auth::user()->roles['0']->id) == 5))
                                <li><a class="dropdown-item" href="/report/receipt">Laporan Terimaan Harian/Bulanan </a></li>
                                <li><a class="dropdown-item" href="/report/receipttype">Laporan Terimaan Harian/Bulanan Ikut Jenis</a></li>
                                <li><a class="dropdown-item" href="/report/book">Laporan Buku Tunai Terimaan Harian/ Bulanan</a></li>
                                <li><a class="dropdown-item" href="/report/penyatapemungut">Laporan Penyata Pemungut Harian/ Bulanan</a></li>
                                <li><a class="dropdown-item" href="/report/pelarasan">Laporan Pelarasan Kod Hasil </a></li>
                            @endif

                        </ul>
                    </li> --}}

                    {{-- <li class="nav-item dropdown">
                        @if(((Auth::user()->roles['0']->id) == 3))
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Carian</a>
                        @else
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Transaksi</a>
                        @endif
                        <ul class="dropdown-menu">
                            @if(((Auth::user()->roles['0']->id) == 1)||((Auth::user()->roles['0']->id) == 2))
                                <li><a class="dropdown-item" href="/admin/transaction/list">Sejarah Transaksi </a></li>
                                <li><a class="dropdown-item" href="/statement/history">Sejarah Penyata Pemungut</a></li>
                            @elseif(((Auth::user()->roles['0']->id) == 3))
                                <li><a class="dropdown-item" href="/admin/transaction/list">Sejarah Transaksi </a></li>
                                <li><a class="dropdown-item" href="/statement/history">Sejarah Penyata Pemungut</a></li>
                                <li><a class="dropdown-item" href="/admin/pelarasan/list">Pelarasan Kod Hasil</a></li>
                            @endif
                            @if(((Auth::user()->roles['0']->id) == 4)||((Auth::user()->roles['0']->id) == 5))
                                <li><a class="dropdown-item" href="/admin/transaction/list">Sejarah Transaksi </a></li>
                                <li><a class="dropdown-item" href="/statement/list">Penyata Pemungut</a></li>
                                <li><a class="dropdown-item" href="/statement/history">Sejarah Penyata Pemungut</a></li>
                            @endif
                        </ul>
                    </li> --}}

                    {{-- @if(((Auth::user()->roles['0']->id) == 3))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Penyata</a>
                            <ul class="dropdown-menu">
                                @if(((Auth::user()->roles['0']->id) == 3))
                                    <li><a class="dropdown-item" href="/statement/list">Penyata Pemungut</a></li>
                                @endif

                            </ul>
                        </li>
                    @endif --}}
                </ul>

                @endif

                @else
                {{-- Public un login --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">HOME</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">@lang('web::auth.agency-services')</a>
                        <ul class="dropdown-menu">
                            @forelse($agency as $key => $value)
                                <li> <a class="dropdown-item" href="/agensi/{{$value->id}}"> {{ data_get($value,'agensi.name') }} </a></li>
                            @empty

                            @endforelse
                        <li> <a class="dropdown-item" href="#"> Dropdown item 1 </a></li>
                        <li> <a class="dropdown-item sub" href="#"> Dropdown item 2 </a>
                            <ul class="submenu dropdown-menu">
                            <li><a class="dropdown-item" href="#">Submenu item 1</a></li>
                            <li><a class="dropdown-item" href="#">Submenu item 2</a></li>
                            <li><a class="dropdown-item sub" href="#">Submenu item 3  </a>
                                <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="#">Multi level 1</a></li>
                                <li><a class="dropdown-item" href="#">Multi level 2</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="#">Submenu item 4</a></li>
                            <li><a class="dropdown-item" href="#">Submenu item 5</a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"> Dropdown item 3 </a></li>
                        <li><a class="dropdown-item" href="#"> Dropdown item 4 </a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="/panduan">@lang('web::auth.user-guide')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/faq">@lang('web::auth.faq')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hubungi">@lang('web::auth.contact')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/feedback">@lang('web::auth.feedback')</a>
                    </li> --}}
                </ul>
			@endif
