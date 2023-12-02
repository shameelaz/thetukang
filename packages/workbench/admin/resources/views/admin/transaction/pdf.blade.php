
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{config('app.name')}}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }
    .tabledata, .tabledata th, .tabledata td
    {
        border: 1px solid black; border-collapse: collapse;
    }
    .border
    {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .footer {
        position: fixed;
        width: 100%;
    }

    .footer {
        bottom: 0;
    }
</style>


</head>
<body>

    <div class="footer">
        <table style="width:100%; font-size: 10px">
            <tbody>
                <tr>
                    <td style="text-align: right; width: 25%;">

                    </td>
                    <td style="text-align: center; width: 50%;">
                        Ini adalah cetakan komputer dan tidak perlu ditandatangani
                     </td>
                    <td style="text-align: left; width: 25%;">

                    </td>
                </tr>
            </tbody>
        </table>

        <table style="width:100%; font-size: 10px">
            <tbody>
                <tr>
                    <td style="text-align: left; width: 35%;">
                        No. Kebenaran : KK/BSKK/10/600-2/1/2(49)
                    </td>
                    <td style="text-align: center; width: 25%;">

                    </td>
                    <td style="text-align: right; width: 30%;">
                        JANM 11
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <table style="width:100%; font-size: 10px">v
        <tbody>
            <tr>
                <td style="text-align: left; width: 25%;">

                </td>
                <td style="text-align: center; width: 50%;">
                    <img src="{{ public_path('overide/web/themes/perakepay/assests/images/logo.png') }}" alt="Logo Perak Pay" width="110" height="120">
                </td>
                <td style="text-align: left; width: 25%;">

                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table style="width:100%; font-size: 10px">
        <tbody>
            <tr>
                <td style="text-align: left; width: 25%;">

                </td>
                <td style="text-align: center; width: 50%;">
                    <b>KERAJAAN NEGERI PERAK DARUL RIDZUAN</b>
                </td>
                <td style="text-align: left; width: 25%;" rowspan="3" valign="top">
                    <b>(Kew.38E 03-2021)</b>
                    <br>
                    No Resit : {{ data_get($data['transaction'],  'receipt_no') }}
                    <br>
                    Tarikh :  {{ date('d-m-Y', strtotime(data_get($data['transaction'], 'fkpayment.transaction_date'))) }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 25%;">

                </td>
                <td style="text-align: center; width: 50%;">
                    Resit Rasmi
                </td>

            </tr>
            <tr>
                <td style="text-align: left; width: 25%;">

                </td>
                <td style="text-align: center; width: 50%;">
                    <b>SALINAN</b>
                </td>

            </tr>
        </tbody>
    </table>

    <br>

    <table style="width:100%; font-size: 10px">
        <tbody>
            <tr>
                <td style="text-align: left; width: 30%;">
                    Diterima daripada
                </td>
                <td style="text-align: left; width: 70%;">
                    : {{ data_get($data['transaction'], 'fkpayer.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 30%;">
                    No. Kad Pengenalan/ No Daftar Perniagaan
                </td>
                <td style="text-align: left; width: 70%;">
                    : {{ data_get($data['transaction'], 'fkpayer.identification_no') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 30%;">
                    Alamat
                </td>
                <td style="text-align: left; width: 70%;">
                    : {{ data_get($data['transaction'], 'fkpayer.address') }} {{ data_get($data['transaction'], 'fkpayer.city') }}
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>

    <table style="width:100%; font-size: 10px" class="border">
        <tbody>
            <tr>
                <td class="border" style="text-align: center; padding: 10px;">
                    <b>Bil</b>
                </td>
                <td class="border" style="text-align: center; padding: 10px;">
                    <b>Perihal Terimaan</b>
                </td>
                <td class="border" style="text-align: center; padding: 10px;">
                    <b>Cara Bayaran</b>
                </td>
                <td class="border" style="text-align: center; padding: 10px;">
                    <b>No Rujukan/Tarikh</b>
                </td>
                {{-- <td class="border" style="text-align: center; padding: 10px;">
                    <b>Vot/Dana</b>
                </td> --}}
                <td class="border" style="text-align: center; padding: 10px;">
                    <b>Kod Akaun</b>
                </td>
                <td class="border" style="text-align: center; padding: 10px;">
                    <b>Amaun (RM)</b>
                </td>
            </tr>

            <?php
                $bil=1;
                $total = 0;
            ?>


            @forelse($data['payment'][0]->paymentdetail as $key =>$value)
                <tr>
                    <td class="border" style="text-align: center; padding: 10px;">
                        {{ $bil++ }}
                    </td>
                    <td class="border" style="text-align: center; padding: 10px; text-transform: uppercase;">
                        {{ data_get($value, 'details') }}
                    </td>
                    <td class="border" style="text-align: center; padding: 10px;">
                        {{ data_get($value, 'fkpayment.fkpaymentgateway.name') }}
                    </td>
                    <td class="border" style="text-align: center; padding: 10px;">
                        {{ data_get($value, 'reference_no') }}/ {{  date('d-m-Y', strtotime(data_get($value, 'fkpayment.transaction_date'))) }}
                    </td>
                    <!-- <td class="border" style="text-align: center; padding: 10px;">
                        data_get($value, 'reference_no') }}
                    </td> -->
                    <td class="border" style="text-align: center; padding: 10px;">
                        {{ data_get($value, 'kod_hasil') }}
                    </td>
                    <td class="border" style="text-align: right; padding: 10px;">
                        {{ number_format(data_get($value, 'amount'), 2, '.', ',') }}
                    </td>
                </tr>
                <?php

                    $total += data_get($value, 'amount');

                ?>
            @empty
                <tr>
                    <td class="border" style="text-align: center; padding: 10px;" colspan="6">
                        Tiada Data
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <table style="width:100%; font-size: 10px; border: 1px solid black;">
        <tbody>
            <tr>
                <td style="text-align: left; width: 65%;">

                </td>
                <td style="text-align: right; width: 35%; padding: 1px 10px;" rowspan="3">
                    <b>Jumlah Sebelum Cukai</b>
                    <br>
                    <b>Cukai (0%)</b>
                    <br>
                    <b>Jumlah Selepas Cukai</b>
                </td>
                <td style="text-align: right; width: 15%; padding: 1px 10px;" rowspan="3">
                    <b>RM {{ number_format($total, 2, '.', ',') }}</b>
                    <br>
                    <b>0.00</b>
                    <br>
                    <b>RM {{ number_format($total, 2, '.', ',') }}</b>
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table style="width:100%; font-size: 10px">
        <tbody>
            <tr>
                <td style="text-align: left; width: 20%;">
                    Ringgit Malaysia
                </td>
                <td style="text-align: left; width: 80%;">
                    :  {{ strtoupper($ringgitmalaysia) }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 20%;">
                    Catatan
                </td>
                <td style="text-align: left; width: 80%; text-transform: uppercase;">
                    : {{ data_get($data['transaction'], 'details') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 20%;">
                    Jabatan
                </td>
                <td style="text-align: left; width: 80%;">
                    :  {{ data_get($data['transaction'], 'fkkodhasil.agency.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 20%;">
                    PTJ
                </td>
                <td style="text-align: left; width: 80%;">
                    : {{ data_get($data['transaction'], 'fkkodhasil.ptj.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 20%;">
                    Pusat Terimaan
                </td>
                <td style="text-align: left; width: 80%;">
                    : {{ data_get($data['transaction'], 'fkkodhasil.ptj.code') }} - {{ data_get($data['transaction'], 'fkkodhasil.ptj.name') }}
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>

    <table style="width:100%; font-size: 10px">
        <tbody>
            <tr>
                <td style="text-align: right; width: 25%;">

                </td>
                <td style="text-align: center; width: 50%;">

                 </td>
                <td style="text-align: left; width: 25%;">
                    ({{ date('d-m-Y H:i:s', strtotime($now)) }})
                </td>
            </tr>
        </tbody>
    </table>





</body>

