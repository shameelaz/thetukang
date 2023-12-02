
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

    <table style="width:100%; font-size: 10px">
        <tbody>
            <tr>
                <td style="text-align: left; width: 25%;">

                </td>
                <td style="text-align: center; width: 50%;">
                    <!-- <img src=" asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}" alt="Logo Perak Pay" width="110" height="120"> -->
                    <img src="{{ asset('overide/web/themes/perakepay/assests/images/logo.png') }}" alt="Logo Perak Pay" width="110" height="120">
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
                    No Resit : {{ data_get($data,  'receipt_no') }}
                    <br>
                    Tarikh :  {{ date('d-m-Y', strtotime(data_get($data, 'fkpayment.transaction_date'))) }}
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
                    @if( data_get($data, 'flag_original') == 2 )
                        <b>SALINAN</b>
                    @else
                        <b>ASAL</b>
                    @endif
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
                    : {{ data_get($data, 'fkpayer.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 30%;">
                    No. Kad Pengenalan/ No Daftar Perniagaan
                </td>
                <td style="text-align: left; width: 70%;">
                    : {{ data_get($data, 'fkpayer.identification_no') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 30%;">
                    Alamat
                </td>
                <td style="text-align: left; width: 70%;">
                    : {{ data_get($data, 'fkpayer.address') }} {{ data_get($data, 'fkpayer.city') }}
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

            <tr>
                <td class="border" style="text-align: center; padding: 10px;">
                    1
                </td>
                <td class="border" style="text-align: center; padding: 10px;">
                    {{ data_get($data, 'details') }}
                </td>
                <td class="border" style="text-align: center; padding: 10px;">
                    {{ data_get($data, 'fkpayment.fkpaymentgateway.name') }}
                </td>
                <td class="border" style="text-align: center; padding: 10px;">
                    {{ data_get($data, 'reference_no') }}/ {{  date('d-m-Y', strtotime(data_get($data, 'fkpayment.transaction_date'))) }}
                </td>
                {{-- <td class="border" style="text-align: center; padding: 10px;">
                    {{ data_get($data, 'reference_no') }}
                </td> --}}
                <td class="border" style="text-align: center; padding: 10px;">
                    {{ data_get($data, 'kod_hasil') }}
                </td>
                <td class="border" style="text-align: right; padding: 10px;">
                    {{ number_format(data_get($data, 'amount'), 2, '.', ',') }}
                </td>
            </tr>
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
                    <b>{{ number_format(data_get($data, 'amount'), 2, '.', ',') }}</b>
                    <br>
                    <b>0.00</b>
                    <br>
                    <b>{{ number_format(data_get($data, 'amount'), 2, '.', ',') }}</b>
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
                    : {{--  Lima Ribu Satu Sahaja --}}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 20%;">
                    Catatan
                </td>
                <td style="text-align: left; width: 80%;">
                    : {{ data_get($data, 'details') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 20%;">
                    Jabatan
                </td>
                <td style="text-align: left; width: 80%;">
                    :  {{ data_get($data, 'fkkodhasil.agency.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 20%;">
                    PTJ
                </td>
                <td style="text-align: left; width: 80%;">
                    : {{ data_get($data, 'fkkodhasil.ptj.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 20%;">
                    Pusat Terimaan
                </td>
                <td style="text-align: left; width: 80%;">
                    : {{ data_get($data, 'fkkodhasil.ptj.code') }} - {{ data_get($data, 'fkkodhasil.ptj.name') }}
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

