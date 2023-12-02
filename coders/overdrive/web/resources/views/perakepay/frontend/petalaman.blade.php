@extends('web::perakepay.frontend.layouts.base')
<?php
$agency = \Workbench\Database\Model\Agency\LamanAgensi::where('status',1)->with('agensi')->get();
?>
@section('content')
    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">Peta Laman</h5>
        </div>
    </div>

    <div class="container my-5">

        <div class="card style-border">
            <div class="card-header">

            </div>
            <div class="card-body">


                <div class="container">
                    <div class="frame-container frame-container-default">
                        <div class="frame-inner">
                            <header class="frame-header">
                                <h5 class="element-header "><span>Petalaman</span></h5>
                            </header>
                            <ul>
                                <li><a href="/home" title="Home">Laman Utama</a>
                                    <ul>
                                        <li><a href="/home" title="Home">Laman Utama</a></li>

                                        <li><a href="#" title="Pages">Agensi & Perkhidmatan</a>
                                            <ul>
                                                @forelse($agency as $key => $value)
                                                    <li> <a class="" href="/agensi/{{$value->id}}"> {{ data_get($value,'agensi.name') }} </a></li>
                                                @empty

                                                @endforelse


                                            </ul>
                                        </li>
                                        <li>
                                            <a href="/panduan" title="">Panduan</a>
                                        </li>
                                        <li>
                                            <a href="/faq" title="">Soalan Lazim</a>
                                        </li>
                                        <li>
                                            <a href="/hubungi" title="">Hubungi</a>
                                        </li>
                                        <li>
                                            <a href="/feedback" title="">Maklum Balas</a>
                                        </li>
                                        <li>
                                            <a href="/petalaman" title="">Petalaman</a>
                                        </li>
                                        <li>
                                            <a href="/desclaimer" title="">Penafian</a>
                                        </li>
                                        <li>
                                            <a href="/privacy" title="">Dasar Privasi</a>
                                        </li>
                                        <li>
                                            <a href="/security" title="">Dasar Keselamatan</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /container -->


            </div>
        </div>
    </div>
    <br>
@endsection
