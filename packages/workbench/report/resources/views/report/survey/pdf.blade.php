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
                <b style="text-transform: uppercase">Laporan Kajian Kepuasan Pengguna</b>
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
            <td><b>Tahap Kepuasan</b></td>
            <td width="2%">:</td>
            <td colspan="4">
                @if ($request->level == 'lev')
                    -
                @else
                    {{ (data_get($leveltype, 'description')) }} <br />
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
                    <b>Tarikh</b>
                </td>
                <td class="border" style="text-align: center;">
                    <b>Tahap Kepuasan</b>
                </td>
                <td class="border" style="text-align: center;">
                    <b>Ulasan</b>
                </td>
            </tr>
            @forelse($data as $key => $dt)
                <tr>
                    <td class="border" style="text-align: center; padding: 5px;" valign="top">
                        {{ ++$key }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ date('d-m-Y', strtotime(data_get($dt, 'created_at'))) }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px; white-space: nowrap;" valign="top">
                        {{ data_get($dt, 'survey.description') }}
                    </td>
                    <td class="border" style="text-align: center; padding: 5px;">
                        @if (data_get($dt, 'remark') != null)
                            {{ data_get($dt, 'remark') }}
                        @else
                            -
                        @endif
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
