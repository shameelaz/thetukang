<!-- extends('laravolt::elip.layouts.base') -->
@extends('web::backend.layouts.pelanggan.pelanggan')
@section('content')
    <?php
    if (Session::has('locale')) {
        $locale = Session::get('locale', Config::get('app.locale'));
    } else {
        $locale = \Lang::locale();
    }
    ?>
    <style type="text/css">
        .pos-dropdown__dropdown-menu.dropdown-menu.show {
            width: 50% !important;
            /*transform: translate(651px, 1020px) !important*/
        }

        .text-white {
            --tw-text-opacity: 1;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .bg-theme-1 {
            --tw-bg-opacity: 1 !important;
            background-color: rgba(28, 63, 170, var(--tw-bg-opacity)) !important;
        }

        .bg-theme-6 {
            --tw-bg-opacity: 1 !important;
            background-color: rgba(211, 41, 41, var(--tw-bg-opacity)) !important;
        }

        .bg-theme-11 {
            /*orange*/
            --tw-bg-opacity: 1 !important;
            background-color: rgba(247, 139, 0, var(--tw-bg-opacity)) !important;
        }

        .bg-theme-9 {
            /*hijau*/
            --tw-bg-opacity: 1 !important;
            background-color: rgba(145, 199, 20, var(--tw-bg-opacity)) !important;
        }

        .bg-theme-14 {
            /*biru pudar*/
            --tw-bg-opacity: 1;
            background-color: rgba(230, 243, 255, var(--tw-bg-opacity));
        }

        .dataTables_scrollHeadInner {
            box-sizing: content-box;
            width: auto !important;
            padding-right: 0px;
        }
    </style>
    <div class="section">

        


        <br>
        <br>

        <div class="section">

            <link rel="stylesheet" href="{{ asset('theme/assets/css/pages/page-knowledge.css') }}">
            <link rel="stylesheet" href="{{ asset('theme/assets/css/pages/app-email.css') }}">

        </div>


        <!-- Senarai Permohonan Lesen Baharu -->
        <div class="intro-y box mt-5">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    @lang('dashboard.pelanggan.new-app-list')
                </h2>
                <a href="javascript:;" data-toggle="modal" data-target="#small-slide-over-size-preview"
                    class="btn btn-primary mr-1 mb-2">@lang('dashboard.pelanggan.new-app')</a>

            </div>
            <div class="p-5" id="responsive-table">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table class="table" id="tableapplication"
                            style="font-size: 12px;background-color:#87b0fb; width:100% !important;">
                            <thead>
                                <tr>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" style="text-align:center;">
                                        @lang('dashboard.datalist.no')</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" style="text-align:center;">
                                        @lang('dashboard.datalist.app-type')</th>
                                    <!-- <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Pemohon</th> -->
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" style="text-align:center;">
                                        @lang('dashboard.datalist.app-no')</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" style="text-align:center;">
                                        @lang('dashboard.datalist.license-holder')</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" style="text-align:center;">
                                        @lang('dashboard.datalist.reg-no')</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" style="text-align:center;">
                                        @lang('dashboard.datalist.app-date')</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" style="text-align:center;">
                                        @lang('dashboard.datalist.status')</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap" style="text-align:center;">
                                        @lang('dashboard.datalist.action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $i = 1; ?>
                                @foreach ($data as $key => $value)
                                    <tr class="hover:bg-gray-200">

                                        <td class="border-b whitespace-nowrap" style="text-align:center;">
                                            {{ $i++ }}</td>
                                        <td class="border-b whitespace-nowrap" style="text-align:center;">
                                            {{ data_get($value, 'type.description') }}</td>
                                        <!-- <td class="border-b whitespace-nowrap">{{ data_get($value, 'user.name') }}</td> -->
                                        <td class="border-b whitespace-nowrap" style="text-align:center;">
                                            {{ data_get($value, 'application_no') }}</td>
                                        <td class="border-b whitespace-nowrap" style="text-align:center;">
                                            {{ data_get($value, 'business.company_name') }}</td>
                                        <td class="border-b whitespace-nowrap" style="text-align:center;">
                                            {{ data_get($value, 'business.company_no') }}</td>
                                        <td class="border-b whitespace-nowrap" style="text-align:center;">
                                            @if (data_get($value, 'application_date') == null)
                                            @else
                                                {{ date('d-m-Y', strtotime(data_get($value, 'application_date'))) }}
                                            @endif

                                        </td>
                                        <td class="border-b whitespace-nowrap" style="text-align:center;">

                                            {{ data_get($value, 'lkpstatus.description') }}
                                        </td>
                                        <td class="border-b whitespace-nowrap" style="text-align:center;">
                                            @if (data_get($value, 'fk_app_type') == 1)
                                                <!-- lesen premis perniagaan -->
                                                @if (data_get($value, 'lkpstatus.id') == 1)
                                                    <!-- kemaskini -->


                                                    <a href="/application/premise/checkstat/{{ data_get($value, 'id') }}"
                                                        title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                        <i data-feather="edit-2" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 3)
                                                    <!-- permohonan -->
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 69)
                                                    <a href="/application/premise/query/{{ data_get($value, 'id') }}"
                                                        title="Pembetulan Terhadap Kuiri"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                    <!-- <a href="/application/premise/query/{{ data_get($value, 'id') }}" title="Pembetulan Terhadap Kuiri" class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                              <i data-feather="edit-3" class="w-4 h-4"></i>
                                            </a> -->
                                                @elseif(data_get($value, 'lkpstatus.id') == 39)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @else
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @endif
                                            @elseif(data_get($value, 'fk_app_type') == 2)
                                                <!-- kafe luaran -->

                                                @if (data_get($value, 'lkpstatus.id') == 39)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 4)
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 2)
                                                    <a href="/application/outdoor/permohonan/1/edit/{{ data_get($value, 'id') }}"
                                                        title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                        <i data-feather="edit-2" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 69)
                                                    <a href="/application/outdoor/permohonan/3/edit/{{ data_get($value, 'id') }}"
                                                        title="Pembetulan Terhadap Kuiri"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                @else
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @endif
                                            @elseif(data_get($value, 'fk_app_type') == 3)
                                                <!-- lesen iklan kekal -->


                                                @if (data_get($value, 'lkpstatus.id') == 22)
                                                    <!-- draf -->


                                                    @if (count(data_get($value, 'adstetap')) == 0)
                                                        <a href="/application/adstetap/iklantetap/{{ data_get($value, 'id') }}/2"
                                                            title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                                        </a>
                                                    @elseif(count(data_get($value, 'upload')) == 0)
                                                        <a href="/application/adstetap/upload/{{ data_get($value, 'id') }}/4"
                                                            title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                                        </a>
                                                    @elseif(count(data_get($value, 'upload')) == 0)
                                                        <a href="/application/adstetap/upload/{{ data_get($value, 'id') }}/4"
                                                            title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                                        </a>
                                                    @else
                                                        <a href="/application/adstetap/checklist/{{ data_get($value, 'id') }}/5"
                                                            title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                                        </a>
                                                    @endif
                                                @elseif(data_get($value, 'lkpstatus.id') == 23)
                                                    <!-- permohonan -->
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 39)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 69)
                                                    <a href="/application/adstetap/query/{{ data_get($value, 'id') }}/5"
                                                        title="Pembetulan Terhadap Kuiri"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                @else
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @endif
                                            @elseif(data_get($value, 'fk_app_type') == 4)
                                                <!-- lesen iklan sementara -->


                                                @if (data_get($value, 'lkpstatus.id') == 39)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 25)
                                                    <a href="/application/tempAdv/permohonan/1/edit/{{ data_get($value, 'id') }}"
                                                        title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 69)
                                                    <a href="/application/tempAdv/permohonan/5/edit/{{ data_get($value, 'id') }}"
                                                        title="Pembetulan Terhadap Kuiri"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                @else
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @endif
                                            @elseif(data_get($value, 'fk_app_type') == 5)
                                                <!-- lesen penjaja statik -->
                                                @if (data_get($value, 'lkpstatus.id') == 5)
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 39)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 27)
                                                    <a href="/application/static/permohonan/{{ data_get($value, 'id') }}/1"
                                                        title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                        <i data-feather="edit-2" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 69)
                                                    <a href="/application/static/query/{{ data_get($value, 'id') }}/5"
                                                        title="Pembetulan Terhadap Kuiri"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                @else
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @endif
                                            @elseif(data_get($value, 'fk_app_type') == 6)
                                                <!-- lesen penjaja sementara /acara -->
                                                @if (data_get($value, 'lkpstatus.id') == 29)
                                                    <a href="/application/temperory/permohonan/1/edit/{{ data_get($value, 'id') }}"
                                                        title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                        <i data-feather="edit-2" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 30)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 39)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 69)
                                                    <a href="/application/temperory/permohonan/4/edit/{{ data_get($value, 'id') }}"
                                                        title="Pembetulan Terhadap Kuiri"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                @else
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @endif
                                            @elseif(data_get($value, 'fk_app_type') == 7)
                                                <!-- lesen tempat letak kereta -->
                                                @if (data_get($value, 'lkpstatus.id') == 31)
                                                    <a href="/application/carpark/permohonan/1/edit/{{ data_get($value, 'id') }}"
                                                        title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                        <i data-feather="edit-2" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 39)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 69)
                                                    <a href="/application/carpark/permohonan/5/edit/{{ data_get($value, 'id') }}"
                                                        title="Pembetulan Terhadap Kuiri"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                @else
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @endif
                                            @elseif(data_get($value, 'fk_app_type') == 8)

                                            @elseif(data_get($value, 'fk_app_type') == 9)
                                                @if (data_get($value, 'lkpstatus.id') == 66)
                                                    <a href="/application/hotel/permohonan/1/edit/{{ data_get($value, 'id') }}"
                                                        title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                        <i data-feather="edit-2" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 39)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 69)
                                                    <a href="/application/hotel/permohonan/6/edit/{{ data_get($value, 'id') }}"
                                                        title="Pembetulan Terhadap Kuiri"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                @else
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @endif
                                            @elseif(data_get($value, 'fk_app_type') == 10)
                                                @if (data_get($value, 'lkpstatus.id') == 73)
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 72)
                                                    <a href="/application/entertaintment/permohonan/1/edit/{{ data_get($value, 'id') }}"
                                                        title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                        <i data-feather="edit-2" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 69)
                                                    <a href="/application/entertaintment/permohonan/5/edit/{{ data_get($value, 'id') }}"
                                                        title="Pembetulan Terhadap Kuiri"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 39)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @else
                                                @endif
                                            @elseif(data_get($value, 'fk_app_type') == 11)
                                                @if (data_get($value, 'lkpstatus.id') == 74)
                                                    <a href="/application/tempEntertaintment/permohonan/1/edit/{{ data_get($value, 'id') }}"
                                                        title="Kemaskini" class="btn btn-sm btn-dark w-30 mr-1 mb-2">
                                                        <i data-feather="edit-2" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 75)
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 39)
                                                    <a href="/process/application/sahkan/{{ data_get($value, 'id') }}"
                                                        title="Pengesahan Permohonan"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="zap" class="w-4 h-4"></i>
                                                    </a>
                                                @elseif(data_get($value, 'lkpstatus.id') == 69)
                                                    <a href="/application/tempEntertaintment/permohonan/5/edit/{{ data_get($value, 'id') }}"
                                                        title="Pembetulan Terhadap Kuiri"
                                                        class="btn btn-sm btn-warning w-30 mr-1 mb-2">
                                                        <i data-feather="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                @else
                                                    <a href="/application/state/{{ data_get($value, 'id') }}"
                                                        title="Info" class="btn btn-sm btn-primary w-30 mr-1 mb-2">
                                                        <i data-feather="eye" class="w-4 h-4"></i>
                                                    </a>
                                                @endif
                                            @else
                                                <!-- tiada -->
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <br>
        <!-- Senarai Permohonan Lesen Baharu -->
        <!-- BEGIN: Renew Lesen -->
        
        <!-- END: Renew Lesen -->
        <br>
        <br>
        <!-- BEGIN: Senarai Lesen -->
        
        <!-- END: Senarai Lesen -->



        




        <br>
        





    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $('#data-table-license_renew').DataTable({
            @if ($locale == 'ms')
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                },
            @endif
            "responsive": true,
            "scrollY": 400,
            "scrollX": true,
            "ordering": false,
            "info": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        $('#data-table-license').DataTable({
            @if ($locale == 'ms')
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                },
            @endif
            "responsive": true,
            "scrollY": 400,
            "scrollX": true,
            "ordering": false,
            "info": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        $('#tableapplication').DataTable({
            @if ($locale == 'ms')
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                },
            @endif
            "responsive": true,
            "scrollY": 400,
            "scrollX": true,
            "ordering": false,
            "info": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        $('#applicationselesai').DataTable({
            @if ($locale == 'ms')
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                },
            @endif
            "responsive": true,
            "scrollY": 400,
            "scrollX": true,
            "ordering": false,
            "info": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        $('#tablenew1').DataTable({
            @if ($locale == 'ms')
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                },
            @endif
            "responsive": true,
            "scrollY": 400,
            "scrollX": false,
            "ordering": false,
            "info": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });


        //    $('#tableapplication').DataTable({
        //     "language": {
        //           url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
        //       },
        //     "responsive": false,
        //     "scrollY": 400,
        //     "scrollX": true,
        //     "ordering": false,
        //     "info": false,
        //     "lengthMenu": [
        //       [10, 25, 50, -1],
        //       [10, 25, 50, "All"]
        //     ]
        // });
    </script>
    <script type="text/javascript">
        // alert('hi');
        function swapicon(typess) {

            var icplus =
                "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' class='feather feather-plus w-4 h-4 mr-2' id='" +
                typess + "'><line x1='12' y1='5' x2='12' y2='19'></line><line x1='5' y1='12' x2='19' y2='12'></line></svg>";

            var icminus =
                "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' class='feather feather-minus w-4 h-4 mr-2' id='" +
                typess + "'><line x1='5' y1='12' x2='19' y2='12'></line></svg>";

            var buttonswap = document.getElementById("buttonswap" + typess).value;
            // alert(buttonswap);
            if (buttonswap == '0') {
                $('.spanicon' + typess).html("");
                $('.spanicon' + typess).append(icplus);

                document.getElementById('buttonswap' + typess).value = '1';

            } else {
                $('.spanicon' + typess).html("");
                $('.spanicon' + typess).append(icminus);

                document.getElementById('buttonswap' + typess).value = '0';
            }
        }
    </script>
@endpush
