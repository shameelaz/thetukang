<!DOCTYPE html>
<html>
	<head>

		<style type="text/css">
			td.sirim
			{
				padding: 0px 0px 0px 0px; /* atas kanan bawah kiri */
				margin : 0px 0px 0px 0px; /* atas kanan bawah kiri */

			}
			.border
			{
		    	border: 1px solid black;
		    	border-collapse: collapse;
			}
			.borderkanan
			{
		    	border-right: 1px solid black;
		    	padding: 2px;
		    	border-collapse: collapse;
			}
			.ringgit
			{
				text-align: right;
				padding: 2px;
			}
			.diva4
			{
			    height:267mm;
			}
		</style>
		<meta charset="UTF-8">
	</head>
	<body>

		<table style=" font-size: 10px">
            <tbody>
                <tr>
                    <td style="text-align: left; ">
                        <b>TARIKH : {{ date('d/m/Y', strtotime($now)) }}</b>
                    </td>
                    <td style="text-align: center; ">
                        <b style="text-transform: uppercase">KERAJAAN NEGERI PERAK DARUL RIDZUAN</b>
                    </td>
                    <td style="text-align: left; " >

                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; ">
                        <b>MASA : {{ date('H:i:s', strtotime($now))  }} </b>
                    </td>
                    <td style="text-align: center; ">
                        <b style="text-transform: uppercase">
                            LAPORAN PENYATA PEMUNGUT HARIAN/BULANAN PADA
                                @if( $sd == 'start' )
                                    -
                                @else
                                    {{ $sd }}
                                @endif
                            HINGGA
                                @if( $ed == 'end' )
                                    -
                                @else
                                    {{ $ed }}
                                @endif
                        </b>
                    </td>
                    <td style="text-align: left; ">

                    </td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%">
            <tbody>
                <tr>
                    <td style="width: 100%" valign="top">
                        <table class="border" style="width: 100%">
                            <tbody>
                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 8px; text-align: center;" class="border" rowspan="2"><b>BIL.</b></td>
                                    <td style="padding: 3px; font-size: 8px; text-align: center;" class="border" colspan="2"><b>P.PENYATA PEMUNGUT</b></td>
                                    <td style="padding: 3px; font-size: 8px; text-align: center;" class="border" colspan="3"><b>TEMPOH PUNGUTAN</b></td>
                                    <td style="padding: 3px; font-size: 8px; text-align: center;" class="border" colspan="2"><b>MEMBAYAR</b></td>
                                    <td style="padding: 3px; font-size: 8px; text-align: center;" class="border" colspan="8"><b>DIMASUKIRA</b></td>
                                    <td style="padding: 3px; font-size: 8px; text-align: center;" rowspan="2"><b>NO RESIT BN</b></td>
                                    <td style="padding: 3px; font-size: 8px; text-align: center;" rowspan="2"><b>TARIKH RESIT BN</b></td>
                                    <td style="padding: 3px; font-size: 8px; text-align: center;" rowspan="2"><b>KOD STATUS</b></td>
                                    <td style="padding: 3px; font-size: 8px; text-align: center;" rowspan="2"><b>AMAUN (RM)</b></td>
                                </tr>
                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>NO RUJ</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>TARIKH</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>DARI</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>HINGGA</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>JUMLAH</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>JAB</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>PTJ/PK</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>VOT</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>JAB</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>PTJ/PK</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>PROG/AKT</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>PROJEK</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>SETIA</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>CP</b></td>
                                    <td style="padding: 3px; font-size: 8px;" class="border"><b>KOD AKAUN</b></td>
                                </tr>

                                <?php
                                    $sumamountpp = 0;
                                    $int = 0;
                                ?>

                                @forelse($data as $key => $dt)
                                    @forelse($dt->penyatapemungutdetail as $key => $dts)


                                        <tr style="padding: 3px;" class="border">
                                            <td style="padding: 3px; font-size: 8px;">{{ ++$int }}</td>
                                            <td style="padding: 3px; font-size: 8px;">{{ data_get($dt, 'no_penyata_pemungut') }}</td>
                                            <td style="padding: 3px; font-size: 8px;">{{ date('d-m-Y', strtotime(data_get($dt, 'tarikh_pp'))) }}</td>
                                            <td style="padding: 3px; font-size: 8px;">{{ date('d-m-Y', strtotime(data_get($dt, 'tarikh_bayaran'))) }}</td>
                                            <td style="padding: 3px; font-size: 8px;">{{ date('d-m-Y', strtotime(data_get($dt, 'tarikh_bayaran'))) }}</td>
                                            <td style="padding: 3px; font-size: 8px; text-align: right;">{{ number_format(data_get($dts,'amaun'), 2, '.', ',') }}</td>
                                            <td style="padding: 3px; font-size: 8px;">{{ data_get($dt, 'agency_code') }}</td>
                                            <td style="padding: 3px; font-size: 8px;">{{ data_get($dt, 'ptj_code') }}</td>
                                            <td style="padding: 3px; font-size: 8px;">{{ data_get($dts, 'vott') }}</td>
                                            <td style="padding: 3px; font-size: 8px;">{{ data_get($dt, 'agency_code') }}</td>
                                            <td style="padding: 3px; font-size: 8px;">{{ data_get($dt, 'ptj_code') }}</td>
                                            <td style="padding: 3px; font-size: 8px;"></td>
                                            <td style="padding: 3px; font-size: 8px;"></td>
                                            <td style="padding: 3px; font-size: 8px;"></td>
                                            <td style="padding: 3px; font-size: 8px;"></td>
                                            <td style="padding: 3px; font-size: 8px;">{{ data_get($dts, 'kod_hasil') }}</td>
                                            <td style="padding: 3px; font-size: 8px;">{{ data_get($dt, 'resit_perbendaharaan') }}</td>
                                            <td style="padding: 3px; font-size: 8px;">
                                                @if (data_get($dt, 'tarikh_perbendaharaan') != null)
                                                    {{ date('d-m-Y', strtotime(data_get($dt, 'tarikh_perbendaharaan'))) }}

                                                @else
                                                        &nbsp;
                                                @endif
                                            </td>
                                            <td style="padding: 3px; font-size: 8px; text-align: center;">
                                                @if (data_get($dt, 'resit_perbendaharaan') != null)
                                                    7
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td style="padding: 3px; font-size: 8px; text-align: right;">{{ number_format(data_get($dts,'amaun'), 2, '.', ',') }}   </td>
                                        </tr>

                                        <?php
                                            $sumamountpp += data_get($dts, 'amaun', 0);
                                        ?>

                                    @empty

                                        <tr style="padding: 3px;" class="border">
                                            <td style="padding: 3px; font-size: 8px;" colspan="20"> Tiada Data</td>
                                        </tr>

                                    @endforelse

                                @empty

                                    <tr style="padding: 3px;" class="border">
                                        <td style="padding: 3px; font-size: 8px;" colspan="20"> Tiada Data</td>
                                    </tr>

                                @endforelse

                                <tr style="padding: 3px;">
                                    <td style="padding: 3px; font-size: 8px; text-align: right;" colspan="19"><b>JUMLAH BESAR :</b></td>
                                    <td style="padding: 3px; font-size: 8px; text-align: right;"><b>{{ number_format($sumamountpp, 2, '.', ',') }}</b></td>
                                </tr>

                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <br>
        <br>

        <table style="width: 50%">
            <tbody>
                <tr>
                    <td style="width: 100%" valign="top">
                        <table class="border" style="width: 100%">
                            <tbody>
                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border" colspan="3"><b>RINGKASAN STATUS PENYATA PEMUNGUT</b></td>
                                </tr>
                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border"><b>KOD STATUS</b></td>
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border"><b>PERIHAL</b></td>
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border"><b>JUMLAH (RM)</b></td>
                                </tr>

                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border">1</td>
                                    <td style="padding: 3px; font-size: 10px;" class="border">SIMPAN</td>
                                    <td style="padding: 3px; font-size: 10px; text-align: right;" class="border">0.00</td>
                                </tr>

                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border">2</td>
                                    <td style="padding: 3px; font-size: 10px;" class="border">SAH SIMPAN</td>
                                    <td style="padding: 3px; font-size: 10px; text-align: right;" class="border">0.00</td>
                                </tr>

                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border">4</td>
                                    <td style="padding: 3px; font-size: 10px;" class="border">SEMAK</td>
                                    <td style="padding: 3px; font-size: 10px; text-align: right;" class="border">0.00</td>
                                </tr>

                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border">7</td>
                                    <td style="padding: 3px; font-size: 10px;" class="border">LULUS</td>
                                    <td style="padding: 3px; font-size: 10px; text-align: right;" class="border">{{ number_format($sumamountpp, 2, '.', ',') }}</td>
                                </tr>

                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border">9</td>
                                    <td style="padding: 3px; font-size: 10px;" class="border">KUIRI</td>
                                    <td style="padding: 3px; font-size: 10px; text-align: right;" class="border">0.00</td>
                                </tr>

                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border">11</td>
                                    <td style="padding: 3px; font-size: 10px;" class="border">BATAL</td>
                                    <td style="padding: 3px; font-size: 10px; text-align: right;" class="border">0.00</td>
                                </tr>

                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border">12</td>
                                    <td style="padding: 3px; font-size: 10px;" class="border">BATAL SELEPAS LULUS</td>
                                    <td style="padding: 3px; font-size: 10px; text-align: right;" class="border">0.00</td>
                                </tr>

                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border">27</td>
                                    <td style="padding: 3px; font-size: 10px;" class="border">BATAL SELEPAS SAH SIMPAN</td>
                                    <td style="padding: 3px; font-size: 10px; text-align: right;" class="border">0.00</td>
                                </tr>

                                <tr style="padding: 3px;" class="border">
                                    <td style="padding: 3px; font-size: 10px; text-align: center;" class="border">33</td>
                                    <td style="padding: 3px; font-size: 10px;" class="border">BATAL OLEH ISTEM</td>
                                    <td style="padding: 3px; font-size: 10px; text-align: right;" class="border">0.00</td>
                                </tr>


                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

	</body>
</html>

