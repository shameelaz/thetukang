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
      <h5 class="header-style"> 
        @if( data_get($payment, 'status') == 1 )
            Bayaran Telah Berjaya
        @elseif( data_get($payment, 'status') == 2 )
            Bayaran Tidak Berjaya
        @elseif( data_get($payment, 'status') == 3 )
            Menunggu Bayaran
        @else
            Bayaran Tidak Berjaya - Mohon Rujuk Pentadbir Sistem
        @endif
      </h5>
  </div>
</div>
<div class="container my-5">

    <div class="card style-border">
        <div class="card-body p-md-4">
            <input type="hidden" name="paymentid" value="{{ data_get($payment,'id') }}" />
            <div id="div-individu" style="">
                <table id="data-table-user" class="table mt-2" style="width:100%;font-size: 12px;">
                    <tr>
                        <td>Order No</td>
                        <td>
                            {{ data_get($payment, 'transaction_no') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tarikh Dan Masa Transaksi</td>
                        <td>
                            {{ data_get($payment, 'transaction_date') }}
                        </td>
                    </tr>
                    <tr>
                        <td>No Transaksi</td>
                        <td>
                            {{ data_get($payment, 'transaction_id') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Cara Bayaran</td>
                        <td>
                            {{ data_get($payment, 'fkpaymentgateway.name') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            @if(data_get($payment,'status') == 1)
                                Bayaran Selesai
                            @elseif(data_get($payment,'status') == 2)
                                Bayaran Gagal
                            @else
                                Menunggu Pengesahan
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah </td>
                        <td>RM {{ number_format(data_get($payment,'total_amount'),2) }}</td>
                    </tr>
                </table>
                <br>
                <table id="data-table-user" class="table mt-2" style="width:100%;font-size: 12px;">
                    <thead class="table-dark">
                        <tr>
                            <th style="text-align: center;">Bil</th>
                            <!-- <th style="text-align: left;">Kategori</th> -->
                            <!-- <th style="text-align: left;">Bilangan</th> -->
                            <!-- <th style="text-align: left;">Fi Per Pax (RM)</th> -->
                            <th style="text-align: center;">Kod Akaun</th>
                            <th style="text-align: left;">Perihal</th>
                            <th style="text-align: center;">Amaun (RM)</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $bil = 1; $sumtotal = 0;?>
                        <!-- foreach (data_get($payment, 'paymentdetail.0.fktroli.fkservice.servicemaindetail') as $key => $value) -->
                        @foreach( data_get($payment, 'paymentdetail') as $key => $value )
                            <tr>
                                <td style="text-align: center;">{{ $bil++ }}</td>
                                <!-- <td> data_get($value,'category.fkcategory.description') }}</td> -->
                                <!-- <td> data_get($value,'number') }}</td> -->
                                <!-- <td> data_get($value,'perpax') }}</td> -->
                                <td style="text-align: center;">{{ data_get($value, 'kod_hasil') }}</td>
                                <td style="text-align: left;">{{ data_get($value, 'details') }}</td>
                                <td style="text-align: center;">
                                    {{ data_get($value, 'amount') }}
                                    <?php
                                        $sumtotal += data_get($value, 'amount');
                                    ?>
                                </td>


                            </tr>
                        @endforeach
                            <tr class="table-light">
                                <td colspan="3" class="" style="text-align: right">
                                    <b>JUMLAH KESELURUHAN (RM)</b>
                                </td>
                                <td style="text-align: center;">
                                    <b>{{ number_format($sumtotal,2) }}</b>
                                </td>

                            </tr>
                    </tbody>
                </table>

                <br>


                @if( data_get($payment, 'status') == 1 )
                    <center>
                        <h6>
                            SILA MUAT TURUN DAN SIMPAN RESIT INI SEBAGAI SIMPANAN RESIT ASAL
                        </h6>
                        <button type="button" class="btn btn-primary" id="asli" onclick="salinan()">
                            Resit
                        </button>
                    </center>
                @elseif( data_get($payment, 'status') == 2 )
                    <center>
                        <h6>
                            Bayaran Tidak Berjaya
                        </h6>
                    </center>
                @elseif( data_get($payment, 'status') == 3 )
                    <center>
                        <h6>
                            Menunggu Pengesahan Bayaran
                        </h6>
                    </center>
                @else
                    Bayaran Tidak Berjaya - Mohon Rujuk Pentadbir Sistem
                @endif
                
                <br>

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
    $('#data-table-agency').DataTable({
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

function salinan(id) 
{
    window.open("/bayaran/receipt/{{ $payment->id }}", "_blank");

    document.getElementById("asli").disabled = true;
}
</script>

@endpush
