<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .tabledata,
        .tabledata th,
        .tabledata td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .border {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>

</head>

<body>

    <table style="width:100%; font-size: 10px">
        <tbody>
            <tr>
                <td style="text-align: left; width: 25%;">

                </td>
                <td style="text-align: center; width: 50%;">
                    <img src=""
                        alt="Logo Perak Pay" width="110" height="120">
                </td>
                <td style="text-align: left; width: 25%;">

                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>

    <table style="width:100%; font-size: 10px">
        <tbody>
            <tr>
                <td style="text-align: left; width: 25%;">
                    <b>TARIKH : {{ date('d/m/Y', strtotime($now)) }}</b>
                </td>
                <td style="text-align: center; width: 50%;">
                    <b style="text-transform: uppercase">KERAJAAN NEGERI PERAK DARUL RIDZUAN</b>
                </td>
                <td style="text-align: left; width: 25%;" >

                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 25%;">
                    <b>MASA : {{ date('H:i:s', strtotime($now))  }} </b>
                </td>
                <td style="text-align: center; width: 50%;">
                    <b style="text-transform: uppercase">
                        LAPORAN TERIMAAN HARIAN/BULANAN PADA
                            @if ($request->sdate == 'start')
                                -
                            @else
                                ({{ date('d/m/Y', strtotime(data_get($request, 'sdate'))) }})
                            @endif
                        HINGGA
                            @if ($request->edate == 'end')
                                -
                            @else
                                ({{ date('d/m/Y', strtotime(data_get($request, 'edate'))) }}) <br />
                            @endif
                    </b>
                </td>
                <td style="text-align: left; width: 25%;">

                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <br>

    <table style="width:100%; font-size: 10px;" class="border">
        <tr style="padding: 5px;">
            <td width="7%" style="padding: 5px;"><b>MENERIMA</b></td>
            <td width="7%" style="padding: 5px;"> </td>
            <td width="7%" style="padding: 5px;"><b>KOD</b></td>
            <td width="79%" style="padding: 5px;"><b>PERIHAL</b></td>
        </tr>
        <tr style="padding: 5px;">
            <td width="7%" style="padding: 5px;"><b>JABATAN</b></td>
            <td width="7%" style="padding: 5px;"><b>:</b></td>
            @if ($roleid == 1 || $roleid == 2 || $roleid == 3)
                <td width="7%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.agency.code') }} </b></td>
                <td width="79%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.agency.name') }} </b></td>
            @elseif ($roleid == 4 || $roleid == 5)
                <td width="7%" style="padding: 5px;"><b> {{ data_get($userprofile, 'userAgency.code') }} </b></td>
                <td width="79%" style="padding: 5px;"><b> {{ data_get($userprofile, 'userAgency.name') }} </b></td>
            @endif

        </tr>
        <tr style="padding: 5px;">
            <td width="7%" style="padding: 5px;"><b>PTJ</b></td>
            <td width="7%" style="padding: 5px;"><b>:</b></td>
            @if ($roleid == 1 || $roleid == 2 || $roleid == 3)
                <td width="7%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.ptj.code') }} </b></td>
                <td width="79%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.ptj.name') }} </b></td>
            @elseif ($roleid == 4 || $roleid == 5)
                <td width="7%" style="padding: 5px;"><b> {{ data_get($userprofile, 'userPtj.code') }} </b></td>
                <td width="79%" style="padding: 5px;"><b> {{ data_get($userprofile, 'userPtj.name') }} </b></td>
            @endif
        </tr>
    </table>

    <br>

    <br>


    <table style="width:100%; font-size: 10px" class="border">
        <tbody>
            <tr>
                <td class="border" style="text-align: center; padding: 5px;">
                    <b>Bil</b>
                </td>
                {{-- <td class="border" style="text-align: center; padding: 5px;">
                    <b>Jabatan</b>
                </td>
                <td class="border" style="text-align: center; padding: 5px;">
                    <b>PTJ</b>
                </td> --}}
                <td class="border" style="text-align: center; padding: 5px;">
                    <b>Nombor Resit</b>
                </td>
                <td class="border" style="text-align: center; padding: 5px;">
                    <b>Perihal</b>
                </td>
                <td class="border" style="text-align: center; padding: 5px;">
                    <b>Nama Pembayar</b>
                </td>
                <td class="border" style="text-align: center; padding: 5px;">
                    <b>Bentuk Bayaran</b>
                </td>
                <td class="border" style="text-align: center; padding: 5px;">
                    <b>Masa Urusniaga</b>
                </td>
                <td class="border" style="text-align: center; padding: 5px;">
                    <b>Kod Akaun</b>
                </td>
                <td class="border" style="text-align: center; padding: 5px;">
                    <b>Amaun (RM)</b>
                </td>
            </tr>

            <?php $total= 0 ; ?>

            @forelse($data as $key => $dt)
                <tr>
                    <td class="border" style="text-align: center; padding: 5px;" valign="top">
                        {{ ++$key }}
                    </td>
                    {{-- <td class="border" style="text-align: left; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'fkkodhasil.agency.name') }}
                    </td>
                    <td class="border" style="text-align: left; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'fkkodhasil.ptj.name') }}
                    </td> --}}
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'receipt_no') }}
                    </td>
                    <td class="border" style="text-align: left; padding: 5px;" valign="top">
                        {{ data_get($dt, 'details') }}
                    </td>
                    <td class="border" style="text-align: left; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'fkpayer.name') }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'fkpayment.fkpaymentgateway.name') }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ date('H:i:s', strtotime(data_get($dt, 'fkpayment.transaction_date'))) }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'fkkodhasil.name') }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ number_format(data_get($dt, 'amount'), 2, '.', ',') }}
                    </td>
                </tr>

                <?php
                    $total += data_get($dt, 'amount');
                ?>

            @empty
                <tr>
                    <td colspan="8" style="text-align: center">
                        Tiada Data
                    </td>
                </tr>
            @endforelse
                <tr>
                    <td class="border" colspan="7" style="text-align: right; padding: 5px;">
                        <b>JUMLAH</b>
                    </td>
                    <td class="border" colspan="1" style="text-align: center; padding: 5px;">
                        <b>{{ number_format($total, 2, '.', '') }}</b>
                    </td>
                </tr>
        </tbody>
    </table>
