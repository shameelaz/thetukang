<!-- extends('laravolt::elip.layouts.base') -->
@extends('web::backend.layouts.base')
@section('content')
    <style type="text/css">
        .pos-dropdown__dropdown-menu.dropdown-menu.show {
            width: 50% !important;
            /*transform: translate(651px, 1020px) !important*/
        }
    </style>
    <div class="section">

        <link rel="stylesheet" href="{{ asset('theme/assets/css/pages/page-knowledge.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/assets/css/pages/app-email.css') }}">

        <br>
        <br>
        <div class="intro-y grid box" id="prepdata" style="">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Kemaskini Hubungi Kami
                </h2>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="card-content p-5">
                        {{-- {!! form()->open()->post()->action(url('enforcement/kebersihan/save'))->horizontal() !!} --}}
                        <input type="hidden" name="id" value="">

                        <div class="form-inline mt-5">
                            <label for="horizontal-form-2" class="form-label w-35">Nama</label>

                            <input placeholder="" name="desc" type="text" class="form-control" value=""
                                required>

                        </div>

                        <div class="form-inline mt-5">
                            <label for="horizontal-form-2" class="form-label w-35">Alamat</label>

                            <input placeholder="" name="desc" type="text" class="form-control" value=""
                                required>

                        </div>

                        <div class="form-inline mt-5">
                            <label for="horizontal-form-2" class="form-label w-35">No Telefon</label>

                            <input placeholder="" name="desc" type="text" class="form-control" value=""
                                required>

                        </div>

                        <div class="form-inline mt-5">
                            <label for="horizontal-form-2" class="form-label w-35">Faksimili</label>

                            <input placeholder="" name="desc" type="text" class="form-control" value=""
                                required>

                        </div>

                        <div class="form-inline mt-5">
                            <label for="horizontal-form-2" class="form-label w-35">Emel</label>

                            <input placeholder="" name="desc" type="text" class="form-control" value=""
                                required>

                        </div>

                        <div class="form-inline mt-5">
                            <label for="horizontal-form-2" class="form-label w-35">Google Map</label>

                            <input placeholder="" name="desc" type="text" class="form-control" value=""
                                required>

                        </div>

                        <div class="form-inline mt-5">
                            <label for="horizontal-form-2" class="form-label w-35"></label>

                            <div class="form-check mr-2 sm:mt-0">
                                <button class="btn btn-success" type="submit">
                                    <i data-feather="save" class="w-4 h-4 mr-2"></i>
                                    Kemaskini
                                </button>
                            </div>

                        </div>

                        {{-- {!! form()->close() !!} --}}
                    </div>
                </div>
            </div>
        </div>


    </div>



    <br>






    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#myform").on("submit", function(){
                document.getElementById("loader").classList.add("show");
            });//submit
        });
    </script>
@endpush
