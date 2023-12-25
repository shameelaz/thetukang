@extends('web::perakepay.frontend.layouts.base')
<!-- extends('web::backend.layouts.base') -->
@section('content')
<?php
if (Session::has('locale')) {
    $locale = Session::get('locale', Config::get('app.locale'));
} else {

    $locale = \Lang::locale();
}
?>

<div class="bg-light py-4">
  <div class="container">
      <h5 class="header-style">@lang('web::auth.transaction-history') {{-- Sejarah Transaksi --}}</h5>
  </div>
</div>

<br>

<div class="container">

    <div class="card style-border">
        <div class="card-header">
            <!-- Senarai Pengguna Agensi / PTJ -->
            <div class="gap-2">
                <div style="float: left">
                    <h6 class="mt-2 float-left">@lang('web::auth.payment-transaction-search') {{-- Carian Transaksi Bayaran --}}</h6>
                </div>
                {{-- <div style="float: right">
                    <a href="/admin/payment/add" class="btn btn-primary me-md-2 float-right">Tambah</a>
                </div> --}}
            </div>
            <!-- <a href="/admin/user/agency/add"> <button type="button" class="btn btn-success">Tambah</button></a> -->

        </div>

        <div class="card-body ">

            <div class="intro-y box p-5 col-span-12 lg:col-span-12">

                <div class="grid grid-cols-12 gap-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-4 col-lg-2 align-items-right">
                            <label for="" class="col-form-label" style="float: right;">@lang('web::auth.transaction-date') {{-- Tarikh Transaksi --}} :</label>
                        </div>
                        <div class="col-4 col-lg-2">
                            <input type="text" id="start_date" class="form-control datepicker1" name="start_date" readonly>
                        </div>

                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label"  style="float: right;">@lang('web::auth.date-till') {{-- Tarikh Hingga --}} :</label>
                        </div>
                        <div class="col-4 col-lg-2">
                            <input type="text" id="end_date" class="form-control datepicker1"- name="end_date" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <div class="grid grid-cols-12 gap-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;">@lang('web::auth.no-reference') {{-- No Rujukan --}} :</label>
                        </div>
                        <div class="col-4 col-lg-2">
                            <input type="text" id="reference" class="form-control" name="reference">
                        </div>

                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;">@lang('web::auth.name') {{-- Nama --}} :</label>
                        </div>
                        <div class="col-4 col-lg-2">
                            <input type="text" id="name" class="form-control" name="name">
                        </div>
                    </div>
                </div>
                <br>
                 <div class="grid grid-cols-12 gap-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;">@lang('web::auth.no-receipt') {{-- No Resit --}} :</label>
                        </div>
                        <div class="col-4 col-lg-2">
                            <input type="text" id="receipt_no" class="form-control" name="receipt_no">
                        </div>
                    </div>
                </div>
                <br>
               <!--  <div class="grid grid-cols-12 gap-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;">Agensi :</label>
                        </div>
                        <div class="col-4 col-lg-6">
                            <select class="js-example-basic-single" id="agency" name="agency" style="width: 100%">
                                <option value=""> Sila Pilih</option>
                                @foreach($agency as $ak => $av)
                                    <option value="{{$av->id}}"> {{ $av->code }} : {{ $av->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="grid grid-cols-12 gap-2" id="div-ptj-result">
                    <div class="row g-3 align-items-center" id="div-ptj">
                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;">PTJ :</label>
                        </div>
                        <div class="col-4 col-lg-6">
                            <select class="js-example-basic-single2" id="ptj" name="ptj" style="width: 100%">
                                <option value=""> Sila Pilih</option>
                                @foreach($ptj as $pk => $pv)
                                    <option value="{{$pv->id}}"> {{ $pv->code }} : {{ $pv->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="grid grid-cols-12 gap-2"  id="div-hasil-result">
                    <div class="row g-3 align-items-center" id="div-hasil">
                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;">Kod Hasil :</label>
                        </div>
                        <div class="col-4 col-lg-6">
                            <select class="js-example-basic-single3" id="kodhasil" name="" style="width: 100%">
                                <option value=""> Sila Pilih</option>
                                @foreach($kodhasil as $hk => $hv)
                                    <option value="{{$hv->id}}"> {{ $hv->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br> -->
                <div class="grid grid-cols-12 gap-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;"> &nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="col-4 col-lg-2">
                        </div>

                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;"> </label>
                        </div>
                        <div class="col-4 col-lg-2" style="text-align: right;">
                            <a href="javascript:;" class="btn btn-primary" type="button" id="clicksubmit" title="Cari">
                                <i class="ri-search-line"></i>
                                    @lang('web::auth.search') {{-- Cari --}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div id="render_ajax" class="col-md-12 col-lg-12">

                    <div class="table-responsive">
                        <table id="data-table-transaction" class="table mt-2" style="width:100%;font-size: 12px;">;
                            <thead class="table-dark">
                                <tr>
                                    <th style="text-align: center;">@lang('web::auth.bil') {{-- Bil --}}</th>
                                    <th style="text-align: center;">@lang('web::auth.no-reference') {{-- No Rujukan --}}</th>
                                    <th style="text-align: center;">@lang('web::auth.transaction-date') {{-- Tarikh Transaksi --}}</th>
                                    <th style="text-align: center;">@lang('web::auth.no-transaction') {{-- No Transaksi --}}</th>
                                    <th style="text-align: center;">@lang('web::auth.agency') {{-- Agensi --}}</th>
                                    <th style="text-align: center;">PTJ</th>
                                    <th style="text-align: center;">@lang('web::auth.code-result') {{-- Kod Hasil --}}</th>
                                    <th style="text-align: center;">@lang('web::auth.name') {{-- Nama --}}</th>
                                    <th style="text-align: center;">@lang('web::auth.no-receipt') {{-- No Resit --}}</th>
                                    <th style="text-align: center;">@lang('web::auth.total') {{-- Jumlah --}} (RM)</th>
                                    <th style="text-align: center;">@lang('web::auth.status-payment') {{-- Status Bayaran --}}</th>
                                    <th style="text-align: center;">@lang('web::auth.action') {{-- Tindakan --}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $bil=1;?>
                                    @foreach($transaction as $key =>$value)
                                        <tr>
                                            <td class="text-center">{{ $bil++}}</td>
                                            <td class="text-center"> {{ data_get($value,'reference_no') }} </td>
                                            <td class="text-center"> @if(data_get($value,'fkpayment.transaction_date')=='')
                                            &nbsp;
                                            @else
                                            {{ date('d-m-Y', strtotime(data_get($value,'fkpayment.transaction_date'))) }}
                                            @endif
                                             </td>
                                            <td class="text-center"> {{ data_get($value,'fkpayment.transaction_no') }} </td>
                                            <td> {{ data_get($value,'fkkodhasil.agency.name') }} </td>
                                            <td> {{ data_get($value,'fkkodhasil.ptj.name') }} </td>
                                            <td> {{ data_get($value,'fkkodhasil.name') }} </td>
                                            <td> {{ data_get($value,'fkpayer.name') }} </td>
                                            <td> {{ data_get($value,'receipt_no') }} </td>
                                            <td class="text-center">{{ data_get($value,'amount') }}</td>
                                            @if(data_get($value, 'fkpayment.status') == 1)
                                            <td class="text-center">BERJAYA</td>
                                            @elseif(data_get($value, 'fkpayment.status') == 2)
                                            <td class="text-center">GAGAL</td>
                                            @elseif(data_get($value, 'fkpayment.status') == 3)
                                            <td class="text-center">MENUNGGU BAYARAN</td>
                                            @else
                                            <td class="text-center"></td>
                                            @endif
                                            <td class="text-center">
                                                 @if(($roleid == 2)||($roleid == 4) || ($roleid) == 7 )
                                                 @if(data_get($value, 'fkpayment.status') == 1)
                                                        <table cellpadding="0">
                                                        <tr style="padding: 0px">
                                                        <td style="padding: 1px"><a href="/admin/transaction/export/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Muat Turun PDF">
                                                        <i class="ri-file-pdf-line"></i></a>
                                                        </td>
                                                        <td style="padding: 1px"><a href="/admin/transaction/detail/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Terperinci">
                                                        <i class="ri-eye-line"></i></a>
                                                        </td>
                                                        </tr>
                                                        </table>
                                                        @else
                                                        <a href="/admin/transaction/detail/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Terperinci">
                                                        <i class="ri-eye-line"></i></a>
                                                        @endif
                                                @elseif (($roleid == 3))
                                                @if(data_get($value, 'fkpayment.status') == 1)
                                                         <table cellpadding="0">
                                                        <tr style="padding: 0px">
                                                        <td style="padding: 1px">
                                                        <a href="/admin/transaction/export/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Muat Turun PDF">
                                                        <i class="ri-file-pdf-line"></i></a>
                                                        </td>
                                                         <td style="padding: 1px"><a href="/admin/transaction/detail/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Terperinci">
                                                        <i class="ri-eye-line"></i></a>
                                                        </td>
                                                         </tr>
                                                         </table>
                                                        @else
                                                        <a href="/admin/transaction/detail/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Terperinci">
                                                        <i class="ri-eye-line"></i></a>

                                                        @endif
                                                 @elseif (($roleid == 4) ||($roleid == 5) )
                                                         <td style="padding: 1px"><a href="/admin/pelarasan/result/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Pelarasan Kod Hasil">
                                                        <i class="ri-edit-line"></i></a>
                                                        </td>

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
    </div>

</div>
<br/>
@endsection



@push('script')
<script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function(){

        $('.datepicker1').datepicker({
            format: 'dd-mm-yyyy',

        });

        $('#data-table-transaction').DataTable({
            "responsive": true,
            "scrollY": true,
            "scrollX": true,
            "ordering": false,
            "info": true,
            'iDisplayLength': 100,
            "lengthMenu": [
                [25, 50,100,250, -1],
                [25, 50,100,250, "All"]
            ],
            @if($locale ==  'ms')
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                },
            @endif
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.datepicker1').datepicker({
            format: 'dd-mm-yyyy',

        });

        $('select[name="agency"]').change(function()
        {
            var val = $(this).val();

            if(val)
            {
                $.ajax(
                {
                    type: "GET",
                    url: "{{ URL::to('/admin/transaction/ptj')}}"+"/"+val,

                    beforeSend: function ()
                    {
                        $("#div-ptj").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result)
                    {
                        $("#render_ajax").html("");
                        $("#div-ptj-result").html(result);
                        document.getElementById("loader").classList.remove("show");
                    }
                });

                $.ajax(
                {
                    type: "GET",
                    url: "{{ URL::to('/admin/transaction/hasil')}}"+"/"+val,

                    beforeSend: function ()
                    {
                        $("#div-hasil").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result)
                    {
                        $("#render_ajax").html("");
                        $("#div-hasil-result").html(result);
                        document.getElementById("loader").classList.remove("show");
                    }
                });

            }

        });

        $('select[name="ptj"]').change(function()
        {
            var val2 = $(this).val();

            if(val2)
            {
                $.ajax(
                {
                    type: "GET",
                    url: "{{ URL::to('/admin/transaction/kodhasil')}}"+"/"+val2,

                    beforeSend: function ()
                    {
                        $("#div-hasil").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result)
                    {
                        $("#render_ajax").html("");
                        $("#div-hasil-result").html(result);
                        document.getElementById("loader").classList.remove("show");
                    }
                });

            }
        });


        $('#clicksubmit').click(function(e)
        {
            var val_start = document.getElementById("start_date").value;
            var val_end   = document.getElementById("end_date").value;
            var val_agency   = '';
            var val_ptj   = '';
            var val_kodhasil   = '';
            var val_name   = document.getElementById("name").value;
            var val_reference   = document.getElementById("reference").value;
            var val_receipt_no   = document.getElementById("receipt_no").value;



            // console.log(val_start,val_end,val_agency,val_ptj,val_kodhasil,val_name,val_reference);

            if( !val_start )
            {
                var val_start = 'start';
            }
            if( !val_end )
            {
                var val_end   = 'end';
            }
            if( !val_agency )
            {
                var val_agency   = 'agency';
            }
            if( !val_ptj )
            {
                var val_ptj   = 'ptj';
            }
            if( !val_kodhasil )
            {
                var val_kodhasil   = 'kodhasil';
            }
            if( !val_name )
            {
                var val_name   = 'name';
            }
            if( !val_reference )
            {
                var val_reference   = 'reference';
            }
            if( !val_receipt_no )
            {
                var val_receipt_no   = 'receipt_no';
            }




            $.ajax(
            {
                type: "get",
                url : "{{ URL::to('/admin/transaction/ajax') }}"+"/"+val_start+"/"+val_end+"/"+val_agency+"/"+val_ptj+"/"+val_kodhasil+"/"+val_name+"/"+val_reference+'/'+val_receipt_no,

                beforeSend: function ()
                {
                    $("#render_ajax").html("");
                    document.getElementById("loader").classList.add("show");

                },
                success: function (result)
                {
                    $("#render_ajax").html(result);

                    $('#data-table-transaction').DataTable({
                        "responsive": true,
                        "scrollY": true,
                        "scrollX": true,
                        "ordering": false,
                        "info": true,
                        'iDisplayLength': 100,
                        "lengthMenu": [
                            [25, 50, 100, 250, -1],
                            [25, 50, 100, 250, "All"]
                        ],
                        @if ($locale == 'ms')
                            "language": {
                                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                            },
                        @endif
                    });

                    document.getElementById("loader").classList.remove("show");
                }

            });

        });


    });

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $( ".js-example-basic-single" ).focus();
    });

    $(document).ready(function() {

        $('.js-example-basic-single2').select2();
        $( ".js-example-basic-single2" ).focus();
    });

    $(document).ready(function() {
        $('.js-example-basic-single3').select2();
        $( ".js-example-basic-single3" ).focus();
    });

    function pdfclick()
    {
        var val_start = document.getElementById("start_date").value;
            var val_end   = document.getElementById("end_date").value;
            var val_agency   = document.getElementById("agency").value;
            var val_ptj   = document.getElementById("ptj").value;
            var val_kodhasil   = document.getElementById("kodhasil").value;
            var val_name   = document.getElementById("name").value;
            var val_reference   = document.getElementById("reference").value;

            // console.log(val_start,val_end,val_agency,val_ptj,val_kodhasil,val_name,val_reference);

            if( !val_start )
            {
                var val_start = 'start';
            }
            if( !val_end )
            {
                var val_end   = 'end';
            }
            if( !val_agency )
            {
                var val_agency   = 'agency';
            }
            if( !val_ptj )
            {
                var val_ptj   = 'ptj';
            }
            if( !val_kodhasil )
            {
                var val_kodhasil   = 'kodhasil';
            }
            if( !val_name )
            {
                var val_name   = 'name';
            }
            if( !val_reference )
            {
                var val_reference   = 'reference';
            }

        // window.location.href = "/report/transfer/1/"+val_start+"/"+val_end+"/"+val_type+"/"+val_status;
        window.open(
            "/report/users/1/"+val_start+"/"+val_end+"/"+val_agency+"/"+val_ptj+"/"+val_kodhasil+"/"+val_name+"/"+val_reference,
            "-_blank"
        );
    };

</script>



@endpush
