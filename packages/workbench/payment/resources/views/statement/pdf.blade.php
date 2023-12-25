
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

    small {
        font-size: 0.7em;
    }

    .footer {
        position: fixed;
        width: 100%;
    }

    .footer {
        bottom: 0;
    }

    .page-break {
        page-break-after: always;
    }
</style>

</head>
<body>
    <div class="footer">
        <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
            <tbody>
                <tr>
                    <td style="text-align: left; padding: 8px; width: 15%" class="border">

                    </td>

                    <td style="text-align: center; padding: 8px; width: 20%" class="border">
                        Disediakan
                    </td>

                    <td style="text-align: center; padding: 8px; width: 20%" class="border">
                        Semak
                    </td>

                    <td style="text-align: center; padding: 8px; width: 20%" class="border">
                        Lulus
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; padding: 5px; width: 15%" class="border">
                        Nama
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        {{ data_get($penyata, 'penyedia_name')  }}
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        {{ data_get($penyata, 'penyemak_name')  }}
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        {{ data_get($penyata, 'pelulus_name')  }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; padding: 5px; width: 15%" class="border">
                        Jawatan
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        {{ data_get($penyata, 'penyedia_position')  }}
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        {{ data_get($penyata, 'penyemak_position')  }}
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        {{ data_get($penyata, 'pelulus_position')  }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; padding: 5px; width: 15%" class="border">
                        Tarikh
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        {{ date('d/m/Y', strtotime(data_get($penyata, 'penyedia_date')))  }}
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        {{ date('d/m/Y', strtotime(data_get($penyata, 'penyemak_date')))  }}
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        {{ date('d/m/Y', strtotime(data_get($penyata, 'pelulus_date')))  }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; padding: 5px; width: 15%" class="border">
                        Tandatangan
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        &nbsp;&nbsp;
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        &nbsp;
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" class="border">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; padding: 5px; width: 15%" class="border">
                        Catatan
                    </td>

                    <td style="text-align: left; padding: 5px; width: 20%" colspan="3" class="border">
                        &nbsp;&nbsp;
                    </td>
                </tr>
            </tbody>
        </table>

        <small>
            No. Kelulusan Perb : 248-10(SK.6)JD.33(9)
        </small>

    </div>

    {{-- Page 1 --}}

    <table style="width:100%; font-size: 10px" class="border">
        <tbody>
            <tr>
                <td style="text-align: right; padding: 5px; width: 15%;">
                    <b>NO AKAUN :</b>
                </td>

                <td style="text-align: left; padding: 5px; width: 35%;">
                    {{ data_get($penyata, 'no_akaun') }}
                </td>

                <td style="text-align: right; padding: 5px; width: 15%; border-left-style: solid;">
                    <b>NAMA :</b>
                </td>

                <td style="text-align: left; padding: 5px; width: 35%;">
                    {{ data_get($penyata, 'merchantsetup.bank_name') }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; width: 25%; padding: 5px;">

                </td>
                <td style="text-align: center; width: 50%; padding: 5px;">
                    <b>KERAJAAN NEGERI PERAK</b>
                    <br>
                    <b>PENYATA PEMUNGUT</b>
                </td>
                <td style="text-align: right; width: 25%; padding: 5px;" rowspan="3" valign="top">
                    (Kew.38E 03-2021)
                    <br>
                    Muka surat 1/3
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 5px;" >
                    Tahun Kewangan {{ date('Y', strtotime(data_get($penyata, 'pelulus_date')))  }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Jenis Urusniaga
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Pej. Perakaunan
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    No. Penyata Pemungut
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Tarikh Penyata Pemungut
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Penyata Pemungut - AUTO
                </td>

                <td style="text-align: center; padding: 5px; width: 25%"  class="border">

                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    {{ data_get($penyata, 'no_penyata_pemungut') }}
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    {{ date('d/m/Y', strtotime(data_get($penyata, 'tarikh_pp'))) }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                    Jab.
                </td>

                <td style="text-align: center; padding: 5px; width: 12.5%" class="border">
                    {{ data_get($penyata, 'agency.code') }}
                </td>

                <td style="text-align: left; padding: 5px; width: 50%" colspan="3" class="border">
                    {{ data_get($penyata, 'agency.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                    PTJ
                </td>

                <td style="text-align: center; padding: 5px; width: 12.5%" class="border">
                    {{ data_get($penyata, 'ptj.code') }}
                </td>

                <td style="text-align: left; padding: 5px; width: 50%" colspan="3" class="border">
                    {{ data_get($penyata, 'ptj.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 100%" colspan="5" class="border">
                    Kod Pembayar
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                    Kod Panjar
                </td>

                <td style="text-align: left; padding: 5px; width: 87.5%" colspan="4" class="border">

                </td>
            </tr>

        </tbody>
    </table>

    <table style="width:100%; font-size: 10px;" class="border">
            <tbody>
                <tr>
                    <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                        Jenis Pungutan
                    </td>

                    <td style="text-align: left; padding: 5px; width: 37.5%" class="border">
                        D = Pungutan diperakaunkan sahaja
                    </td>

                    <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                        Perihal Pungutan
                    </td>

                    <td style="text-align: left; padding: 5px; width: 37.5%" class="border">
                        BAYARAN MELALUI EPAY
                    </td>
                </tr>
            </tbody>
    </table>

    <table style="width:100%; font-size: 10px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Tempoh Pungutan
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    Dari :
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    {{ date('d/m/Y', strtotime(data_get($penyata, 'tarikh_bayaran'))) }}
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    Hingga :
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    {{ date('d/m/Y', strtotime(data_get($penyata, 'tarikh_bayaran'))) }}
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    Tarikh diterima oleh bank
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    &nbsp;&nbsp;
                </td>
            </tr>
        </tbody>
    </table>
{{--
    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; padding: 8px; width: 15%" class="border">

                </td>

                <td style="text-align: center; padding: 8px; width: 20%" class="border">
                    Disediakan
                </td>

                <td style="text-align: center; padding: 8px; width: 20%" class="border">
                    Semak
                </td>

                <td style="text-align: center; padding: 8px; width: 20%" class="border">
                    Lulus
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Nama
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyedia name
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyemak name
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    pelulus name
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Jawatan
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyedia position
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyemak position
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    pelulus position
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Tarikh
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyedia date
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyemak date
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    pelulus date
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Tandatangan
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    &nbsp;&nbsp;
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    &nbsp;
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Catatan
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" colspan="3" class="border">
                    &nbsp;&nbsp;
                </td>
            </tr>
        </tbody>
    </table>

    <small>
        No. Kelulusan Perb : BNPK(8.15)
    </small> --}}

    {{-- Page 2 --}}

    <div class="page-break">
    </div>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; width: 25%; padding: 5px;">

                </td>
                <td style="text-align: center; width: 50%; padding: 5px;">
                    <b>KERAJAAN NEGERI PERAK</b>
                    <br>
                    <b>PENYATA PEMUNGUT</b>
                </td>
                <td style="text-align: right; width: 25%; padding: 5px;" rowspan="3" valign="top">
                    (Kew.38E 03-2021)
                    <br>
                    Muka surat 2/3
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 5px;" >
                    Tahun Kewangan {{ date('Y', strtotime(data_get($penyata, 'pelulus_date')))  }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Jenis Urusniaga
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Pej. Perakaunan
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    No. Penyata Pemungut
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Tarikh Penyata Pemungut
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Penyata Pemungut - AUTO
                </td>

                <td style="text-align: center; padding: 5px; width: 25%"  class="border">

                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    {{ data_get($penyata, 'no_penyata_pemungut') }}
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    {{ date('d/m/Y', strtotime(data_get($penyata, 'tarikh_pp'))) }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                    Jab.
                </td>

                <td style="text-align: center; padding: 5px; width: 12.5%" class="border">
                    {{ data_get($penyata, 'agency.code') }}
                </td>

                <td style="text-align: left; padding: 5px; width: 50%" colspan="3" class="border">
                    {{ data_get($penyata, 'agency.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                    PTJ
                </td>

                <td style="text-align: center; padding: 5px; width: 12.5%" class="border">
                    {{ data_get($penyata, 'ptj.code') }}
                </td>

                <td style="text-align: left; padding: 5px; width: 50%" colspan="3" class="border">
                    {{ data_get($penyata, 'ptj.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 100%" colspan="5" class="border">
                    Kod Pembayar
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                    Kod Panjar
                </td>

                <td style="text-align: left; padding: 5px; width: 87.5%" colspan="4" class="border">

                </td>
            </tr>

        </tbody>
    </table>

    <table style="width:100%; font-size: 10px;" class="border">
            <tbody>
                <tr>
                    <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                        Jenis Pungutan
                    </td>

                    <td style="text-align: left; padding: 5px; width: 37.5%" class="border">
                        D = Pungutan diperakaunkan sahaja
                    </td>

                    <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                        Perihal Pungutan
                    </td>

                    <td style="text-align: left; padding: 5px; width: 37.5%" class="border">
                        BAYARAN DUTI HIBURAN
                    </td>
                </tr>
            </tbody>
    </table>

    <table style="width:100%; font-size: 10px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Tempoh Pungutan
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    Dari :
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    {{ date('d/m/Y', strtotime(data_get($penyata, 'tarikh_bayaran'))) }}
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    Hingga :
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    {{ date('d/m/Y', strtotime(data_get($penyata, 'tarikh_bayaran'))) }}
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    Tarikh diterima oleh bank
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                     &nbsp;&nbsp;
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 8px; width: 100%;" colspan="12" class="border">
                    PUNGUTAN DIMASUKIRA KE DALAM AKAUN-AKAUN DI BAWAH
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    Bil.
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    Vott
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    Jab.
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    PTJ
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    Prog/Akt
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    Projek
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    Setia
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    Sub Setia
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    CP
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    Objek
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    Amaun (RM)
                </td>
                <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                    Kod Kegunaan Jabatan
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 8px; width: 100%;" colspan="12" class="border">
                    Perihal Am
                </td>
            </tr>
            <?php $bil = 1; ?>
            @foreach ($penyatapdf as $key => $value)
                <tr>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                        {{ $bil++ }}
                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                        {{ data_get($value, 'vott') }}
                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                        {{ data_get($value, 'penyatapemungutmain.agency.code') }}
                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                        {{ data_get($value, 'penyatapemungutmain.ptj.code') }}
                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >

                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >

                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >

                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >

                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >

                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                        {{ data_get($value, 'kod_hasil') }}
                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >
                        {{ data_get($value, 'amaun') }}
                    </td>
                    <td style="text-align: center; padding: 2px; width: 8.33%;" class="border" >

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px;" class="border">
        <tbody>
            {{-- <tr>
                <td style="text-align: left; padding: 5px; width: 100%;" colspan="2">
                    CUKAI HIBURAN KELAB MALAM
                </td>
                <td style="text-align: left; padding: 5px;">
                    &nbsp;&nbsp;
                </td>
                <td style="text-align: left; padding: 5px;">
                    &nbsp;&nbsp;
                </td>
                <td style="text-align: left; padding: 5px;">
                    &nbsp;&nbsp;
                </td>
            </tr> --}}
            <tr>
                <td style="text-align: left; padding: 5px; width: 50%;" >

                </td>
                <td style="text-align: center; padding: 5px; width: 12.5%;" >
                    JUMLAH
                </td>
                <td style="text-align: center; padding: 5px; width: 12.5%;" >
                    {{ data_get($penyata, 'jumlah_rm') }}
                </td>
                <td style="text-align: center; padding: 5px; width: 12.5%;" >
                    Jumlah Bil. Subsidari
                </td>
                <td style="text-align: center; padding: 5px; width: 12.5%;" >

                </td>
            </tr>
        </tbody>
    </table>


    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 8px;" colspan="5" class="border">
                    SENARAI RESIT YANG DIKELUARKAN
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px;" class="border">
                    Bil.
                </td>
                <td style="text-align: center; padding: 5px;" class="border">
                    No. Resit
                </td>
                <td style="text-align: center; padding: 5px;" class="border">
                    Tarikh
                </td>
                <td style="text-align: center; padding: 5px;" class="border">
                    Amaun (RM)
                </td>
                <td style="text-align: center; padding: 5px;" class="border">
                    Perihal
                </td>
            </tr>
            <?php $bilangan = 1; ?>
            @foreach ($penyatapdf as $key => $value)
                <tr>
                    <td style="text-align: center; padding: 5px;" class="border">
                        {{ $bilangan++ }}
                    </td>
                    <td style="text-align: center; padding: 5px;" class="border">
                        {{ data_get($value, 'receipt_no') }}
                    </td>
                    <td style="text-align: center; padding: 5px;" class="border">
                        {{  date('d/m/Y', strtotime(data_get($value, 'tarikh'))) }}
                    </td>
                    <td style="text-align: right; padding: 5px;" class="border">
                        {{ data_get($value, 'amaun') }}
                    </td>
                    <td style="text-align: left; padding: 5px;" class="border">
                        {{ data_get($value, 'perihal') }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td style="text-align: right; padding: 5px;" colspan="3">
                    JUMLAH
                </td>
                <td style="text-align: right; padding: 5px;">
                    {{ data_get($penyata, 'jumlah_rm') }}
                </td>
                <td style="text-align: center; padding: 5px;">
                    &nbsp;&nbsp;
                </td>
            </tr>
        </tbody>
    </table>

    {{-- <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; padding: 8px; width: 15%" class="border">

                </td>

                <td style="text-align: center; padding: 8px; width: 20%" class="border">
                    Disediakan
                </td>

                <td style="text-align: center; padding: 8px; width: 20%" class="border">
                    Semak
                </td>

                <td style="text-align: center; padding: 8px; width: 20%" class="border">
                    Lulus
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Nama
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyedia name
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyemak name
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    pelulus name
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Jawatan
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyedia position
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyemak position
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    pelulus position
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Tarikh
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyedia date
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    penyemak date
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    pelulus date
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Tandatangan
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    &nbsp;&nbsp;
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    &nbsp;
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" class="border">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Catatan
                </td>

                <td style="text-align: left; padding: 5px; width: 20%" colspan="3" class="border">
                    &nbsp;&nbsp;
                </td>
            </tr>
        </tbody>
    </table>

    <small>
        No. Kelulusan Perb : BNPK(8.15)
    </small> --}}


    {{-- Page 3 --}}

    <div class="page-break">
    </div>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; width: 25%; padding: 5px;">

                </td>
                <td style="text-align: center; width: 50%; padding: 5px;">
                    <b>KERAJAAN NEGERI PERAK</b>
                    <br>
                    <b>PENYATA PEMUNGUT</b>
                </td>
                <td style="text-align: right; width: 25%; padding: 5px;" rowspan="3" valign="top">
                    (Kew.38E 03-2021)
                    <br>
                    Muka surat 3/3
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 5px;" >
                    Tahun Kewangan {{ date('Y', strtotime(data_get($penyata, 'pelulus_date')))  }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Jenis Urusniaga
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Pej. Perakaunan
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    No. Penyata Pemungut
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Tarikh Penyata Pemungut
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    Penyata Pemungut - AUTO
                </td>

                <td style="text-align: center; padding: 5px; width: 25%"  class="border">

                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    {{ data_get($penyata, 'no_penyata_pemungut') }}
                </td>

                <td style="text-align: center; padding: 5px; width: 25%" class="border">
                    {{ date('d/m/Y', strtotime(data_get($penyata, 'tarikh_pp'))) }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                    Jab.
                </td>

                <td style="text-align: center; padding: 5px; width: 12.5%" class="border">
                    {{ data_get($penyata, 'agency.code') }}
                </td>

                <td style="text-align: left; padding: 5px; width: 50%" colspan="3" class="border">
                    {{ data_get($penyata, 'agency.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                    PTJ
                </td>

                <td style="text-align: center; padding: 5px; width: 12.5%" class="border">
                    {{ data_get($penyata, 'ptj.code') }}
                </td>

                <td style="text-align: left; padding: 5px; width: 50%" colspan="3" class="border">
                    {{ data_get($penyata, 'ptj.name') }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 100%" colspan="5" class="border">
                    Kod Pembayar
                </td>
            </tr>
            <tr>
                <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                    Kod Panjar
                </td>

                <td style="text-align: left; padding: 5px; width: 87.5%" colspan="4" class="border">

                </td>
            </tr>

        </tbody>
    </table>

    <table style="width:100%; font-size: 10px;" class="border">
            <tbody>
                <tr>
                    <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                        Jenis Pungutan
                    </td>

                    <td style="text-align: left; padding: 5px; width: 37.5%" class="border">
                        D = Pungutan diperakaunkan sahaja
                    </td>

                    <td style="text-align: left; padding: 5px; width: 12.5%" class="border">
                        Perihal Pungutan
                    </td>

                    <td style="text-align: left; padding: 5px; width: 37.5%" class="border">
                        BAYARAN DUTI HIBURAN
                    </td>
                </tr>
            </tbody>
    </table>

    <table style="width:100%; font-size: 10px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: left; padding: 5px; width: 15%" class="border">
                    Tempoh Pungutan
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    Dari :
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    {{ date('d/m/Y', strtotime(data_get($penyata, 'tarikh_bayaran'))) }}
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    Hingga :
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    {{ date('d/m/Y', strtotime(data_get($penyata, 'tarikh_bayaran'))) }}
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                    Tarikh diterima oleh bank
                </td>

                <td style="text-align: center; padding: 5px; width: 10%" class="border">
                     &nbsp;&nbsp;
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; font-size: 10px; margin-top: 5px;" class="border">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 8px;" colspan="5" class="border">
                    SENARAI CEK/KIRIMAN WANG/WANG POS/BANK DRAF YANG DIBAYAR - MASUK
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px;" class="border">
                    Bil.
                </td>
                <td style="text-align: center; padding: 5px;" class="border">
                    Bank Pembayar
                </td>
                <td style="text-align: center; padding: 5px;" class="border">
                    No. Cek / Kiriman Wang
                </td>
                <td style="text-align: center; padding: 5px;" class="border">
                    Tempat
                </td>
                <td style="text-align: center; padding: 5px;" class="border">
                    Amaun (RM)
                </td>
            </tr>
            <?php $bilanganbank = 1; ?>
            @foreach ($penyatapdf as $key => $value)
                <tr>
                    <td style="text-align: center; padding: 5px;" class="border">
                        {{ $bilanganbank++ }}
                    </td>
                    <td style="text-align: left; padding: 5px;" class="border">
                        {{ data_get($value, 'payment.bank') }}
                    </td>
                    <td style="text-align: left; padding: 5px;" class="border">
                        {{ data_get($value, 'payment.fkpaymentgateway.name') }}
                    </td>
                    <td style="text-align: center; padding: 5px;" class="border">
                        &nbsp;&nbsp;
                    </td>
                    <td style="text-align: right; padding: 5px;" class="border">
                        {{ data_get($value, 'amaun') }}
                    </td>
                </tr>
            @endforeach

            <tr>
                <td style="text-align: center; padding: 5px;" colspan="3">
                    &nbsp;&nbsp;
                </td>
                <td style="text-align: right; padding: 5px;">
                    JUMLAH BERSIH
                </td>
                <td style="text-align: right; padding: 5px;">
                    {{ data_get($penyata, 'jumlah_rm') }}
                </td>
            </tr>
        </tbody>
    </table>
{{--
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br> --}}





</body>

