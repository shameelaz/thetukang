@extends('web::perakepay.frontend.layouts.base')
@section('content')


{{-- <div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style"></h5>
    </div>
</div> --}}

<div class="container my-5">

    <div class="card style-border">
        <div class="col-span-12 lg:col-span-4 xxl:col-span-3" style="padding-top: 22px">
            <div class="intro-y box col-span-12 lg:col-span-12">
                <div class="box p-5">

                    <div class="items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto" style="text-align: center; font-size: 30px">
                            Kajian Kepuasan Pengguna
                        </h2>
                    </div>

                    <div class="grid grid-cols-12 gap-6">
                        <div class="intro-y col-span-12 lg:col-span-12">
                            <div class="p-5" style="width: 100%">
                                <div class="preview">

                                    <!-- start -------------------------------------------------------------------------------------------------------- -->

                                    {!! form()->post()->action(url('/public/survey/save'))->attribute('id', 'myform')->multipart()->horizontal() !!}

                                        <center>
                                            <!-- <p style="font-size: 30px">Berjaya Log Keluar</p><br/> -->
                                            <p style="font-size: 15px">Terima Kasih kerana telah menggunakan Sistem The Tukang<!-- Terima Kasih kerana telah menggunakan Sistem Elesen Putrajaya --></p><br><br>
                                            <p style="font-size: 15px"><b>Sila klik pada ikon mengikut tahap kepuasan anda<!-- Sila klik pada ikon mengikut tahap kepuasan anda --></b></p><br>

                                                @forelse($survey as $key => $value)

                                                {{-- <input class="input-hidden" type="radio" name="fk_survey[{{ $value->id }}]" id="emotion[{{ $value->id }}]" value="{{ $value->id }}">
                                                <label for="fk_survey[{{ $value->id }}]">
                                                    <img src="{{ url( data_get($value, 'image')) }}" alt="Feedback" width="100" height="100"><br/>
                                                    <p>{{ $value->description }}</p>
                                                </label> --}}
                                                    {{-- <input class="input-hidden" type="radio" name="fk_survey" id="fk_survey" value="{{ data_get($survey,'rate') }}">
                                                    <label for="fk_survey">
                                                        <img src="{{ data_get($value,'image') }}" alt="Feedback" width="100" height="100"><br>
                                                        <p>{{ data_get($value,'description') }}</p>
                                                    </label> --}}


                                                    <div class="form-check form-check-inline">
                                                        <img src="{{ data_get($value,'image') }}" alt="Feedback" width="100" height="100"><br>
                                                        <input class="form-check-input" type="radio" name="fk_survey" id="fk_survey[{{ $value->id }}]" value="{{ data_get($value,'rate') }}">
                                                        <label class="form-check-label" for="fk_survey">{{ data_get($value,'description') }}</label>
                                                    </div>


                                                @empty
                                                @endforelse
                                            <br>
                                            <br>

                                            <!-- textarea  -->

                                            <div class="grid grid-cols-12">

                                                <div class="form-inline col-span-3">
                                                </div>
                                                <div class="form-inline col-span-6">
                                                    <span style="width: 100%; text-align: center; ">
                                                        <center>
                                                            <textarea id="horizontal-form-1" name="remark" class="form-control" placeholder="Cadangan Penambahbaikan" rows="5"></textarea>
                                                        </center>
                                                    </span>
                                                </div>
                                                <div class="form-inline col-span-3">
                                                </div>
                                            </div>

                                            <br>

                                            <!-- button submit -->

                                            <p style="font-size: 15px"><b>Kami menghargai maklum balas anda<!-- Kami menghargai maklum balas anda --></b></p><br>
                                            <p style="font-size: 15px">Terima Kasih<!-- Terima Kasih --></p><br>

                                            <br>

                                            <div class="flex sm:justify-end mt-5">
                                                <a href="/" class="btn btn-dark">Kembali</a>
                                                <button type="submit" class="btn btn-primary">Hantar</button>
                                            </div>
                                        </center>

                                    {!! form()->close() !!}
                                    <!-- end   -------------------------------------------------------------------------------------------------------- -->

                                </div>
                            </div>
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
    $( document ).ready(function() {

      $("#myform").on("submit", function(){
              document.getElementById("loader").classList.add("show");
          });//submit

      });
  </script>
@endpush
