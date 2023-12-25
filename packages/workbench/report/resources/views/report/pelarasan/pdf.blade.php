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

    <table width="100%">
        <tr>
            <td>
                <b style="text-transform: uppercase">Laporan Pelarasan Kod Hasil</b>
            </td>
        </tr>

    </table>
    <br>
    <table id="head" border="0" width="100%" cellspacing="0" cellpadding="0">

        <tr>
            <td><b>Tarikh Mula</b></td>
            <td width="2%">:</td>
            <td colspan="4">
                @if ($request->sdate == 'start')
                    -
                @else
                    {{ date('d-m-Y', strtotime(data_get($request, 'sdate'))) }}
                @endif
            </td>
            <td><b>Tarikh Hingga</b></td>
            <td width="2%">:</td>
            <td colspan="4">
                @if ($request->edate == 'end')
                    -
                @else
                    {{ date('d-m-Y', strtotime(data_get($request, 'edate'))) }} <br />
                @endif
            </td>
        </tr>

    </table>
    <br>


    <table style="width:100%; font-size: 10px" class="border">
        <tbody>
            <tr>
                <td class="border" style="text-align: center;">
                    <b>Bil</b>
                </td>
                <td class="border" style="text-align: center;">
                    <b>Perkhidmatan</b>
                </td>
                <td class="border" style="text-align: center;">
                    <b>No Penyata Pemungut</b>
                </td>
                <td class="border" style="text-align: center;">
                    <b>No Resit</b>
                </td>
                <td class="border" style="text-align: center;">
                    <b>Kod Hasil Lama</b>
                </td>
                <td class="border" style="text-align: center;">
                    <b>Kod Hasil Baru</b>
                </td>
                <td class="border" style="text-align: center;">
                    <b>Tarikh Pelarasan</b>
                </td>
            </tr>
            @forelse($data as $key => $dt)
                <tr>
                    <td class="border" style="text-align: center; padding: 5px;" valign="top">
                        {{ ++$key }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'lkpperkhidmatan.name') }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">

                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'receipt_no') }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'kod_hasil_lama') }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'kod_hasil_baru') }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ date('d-m-Y', strtotime(data_get($dt, 'tarikh_pelarasan'))) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center">
                        Tiada Data
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
