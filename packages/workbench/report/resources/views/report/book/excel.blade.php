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
                            LAPORAN BUKU TUNAI PUNGUTAN/TERIMAAN
                                (@if( $sd == 'start' )
                                    -
                                @else
                                    {{ $sd }}
                                @endif)
                            HINGGA
                                (@if( $ed == 'end' )
                                    -
                                @else
                                    {{ $ed }}
                                @endif)
                        </b>
                    </td>
                    <td style="text-align: left; ">

                    </td>
                </tr>
            </tbody>
        </table>

        <table style=" font-size: 10px;" class="border">
            <tr style="padding: 5px;">
                <td style="padding: 5px;"><b>MENERIMA</b></td>
                <td style="padding: 5px;"> </td>
                <td style="padding: 5px;"><b>KOD</b></td>
                <td  style="padding: 5px;"><b>PERIHAL</b></td>
            </tr>
            <tr style="padding: 5px;">
                <td style="padding: 5px;"><b>JABATAN</b></td>
                <td style="padding: 5px;"><b>:</b></td>
                @if ($roleid == 1 || $roleid == 2 || $roleid == 3)
                    <td width="7%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.agency.code') }} </b></td>
                    <td width="79%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.agency.name') }} </b></td>
                @elseif ($roleid == 4 || $roleid == 5)
                    <td width="7%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.agency.code') }} </b></td>
                    <td width="79%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.agency.name') }} </b></td>
                @endif
            </tr>
            <tr style="padding: 5px;">
                <td style="padding: 5px;"><b>PTJ</b></td>
                <td style="padding: 5px;"><b>:</b></td>
                @if ($roleid == 1 || $roleid == 2 || $roleid == 3)
                    <td width="7%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.ptj.code') }} </b></td>
                    <td width="79%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.ptj.name') }} </b></td>
                @elseif ($roleid == 4 || $roleid == 5)
                    <td width="7%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.ptj.code') }} </b></td>
                    <td width="79%" style="padding: 5px;"><b> {{ data_get($data, '0.fkkodhasil.ptj.name') }} </b></td>
                @endif
            </tr>
        </table>



        <table class="border" style="width: 100%; border-left: 0px solid; border-right: 0px solid; ">
            <tbody>
                <tr style="padding: 3px;" class="border">
                    <td style="padding: 3px; font-size: 11px; text-align: center;" class="border" rowspan="2"><b>TARIKH</b></td>
                    <td style="padding: 3px; font-size: 11px; text-align: center;" class="border" rowspan="2"><b>BENTUK BAYARAN</b></td>
                    <td style="padding: 3px; font-size: 11px; text-align: center;" class="border" rowspan="2"><b>NO RESIT</b></td>
                    <td style="padding: 3px; font-size: 11px; text-align: right;" class="border" rowspan="2"><b>AMAUN</b></td>
                    <td style="padding: 3px; font-size: 11px; text-align: left;" class="border" colspan="5"><b>PEMBAYARAN KEPADA PERBENDAHARAAN</b></td>
                </tr>
                <tr style="padding: 3px;" class="border">
                    <td style="padding: 3px; font-size: 11px; text-align: left;" class="border"><b>NO PEMUNGUT <br>TARIKH PEMUNGUT BANK</b></td>
                    <td style="padding: 3px; font-size: 11px; text-align: right;" class="border"><b>AMAUN</b></td>
                    <td style="padding: 3px; font-size: 11px; text-align: left;" class="border"><b>NO RESIT PERBENDAHARAAN <br>TARIKH RESIT</b></td>
                    <td style="padding: 3px; font-size: 11px; text-align: left;" class="border"><b>PERBEZAAN HARI DI BANK</b></td>
                    <td style="padding: 3px; font-size: 11px; text-align: center;" class="border"><b>STATUS</b></td>
                </tr>

                <?php
                    $sumamountpd = 0;
                    $sumamountpp = 0;
                ?>
                @forelse($data as $key => $dt)

                    <?php
                        $nopp = '';
                        $datepp = '';
                        $amountpp = '';
                        $resitpbhaan = '';
                        $tarikhpbhaan = '';

                        foreach ($dt->fkpenyatapemungutdetail as $key => $dts)
                        {
                            // dd($dts->penyatapemungutmain, 'adsads');

                            $nopp = data_get($dts, 'penyatapemungutmain.no_penyata_pemungut');
                            $datepp = date('d/m/Y', strtotime(data_get($dts, 'penyatapemungutmain.tarikh_pp')));
                            $amountpp = number_format(data_get($dts, 'amaun'), 2, '.', ',');
                            $resitpbhaan = data_get($dts, 'penyatapemungutmain.resit_perbendaharaan');
                            $tarikhpbhaan = date('d/m/Y', strtotime(data_get($dts, 'penyatapemungutmain.tarikh_perbendaharaan')));
                            $sumamountpp = $sumamountpp + data_get($dts, 'amaun', 0);

                        }
                    ?>

                    <tr style="padding: 3px;">
                        <td style="white-space: nowrap; padding: 3px; font-size: 10px; text-align: center; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px;">
                            {{ date('d/m/Y', strtotime(data_get($dt, 'fkpayment.transaction_date'))) }}
                        </td>
                        <td style="padding: 3px; font-size: 10px; text-align: left; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px;">
                            {{ (data_get($dt, 'fkpayment.fkpaymentgateway.name')) }}
                        </td>
                        <td style="padding: 3px; font-size: 10px; text-align: left; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px;">
                            {{ (data_get($dt, 'receipt_no')) }}
                        </td>
                        <td style="padding: 3px; font-size: 10px; text-align: right; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px;">
                            {{ number_format(data_get($dt,'amount'), 2, '.', ',') }}
                        </td>
                        <td style="padding: 3px; font-size: 10px; text-align: left; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px;">
                            {{ $nopp }}&nbsp;{{ $datepp }}

                        </td>
                        <td style="padding: 3px; font-size: 10px; text-align: right; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px;">
                            {{ number_format(data_get($dt,'amount'), 2, '.', ',') }}
                            {{-- {{ $amountpp }} --}}
                        </td>
                        <td style="padding: 3px; font-size: 10px; text-align: left; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px;">
                            @if ($resitpbhaan != null)
                                {{ $resitpbhaan }}&nbsp;{{ $tarikhpbhaan }}
                            @else

                            @endif
                        </td>
                        <td style="padding: 3px; font-size: 10px; text-align: center; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px;">
                            0
                        </td>
                        <td style="padding: 3px; font-size: 10px; text-align: center; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px;">
                            @if ($resitpbhaan != null)
                                LULUS
                            @else
                                BELUM SELESAI
                            @endif
                        </td>
                    </tr>

                    <?php
                        $sumamountpd += data_get($dt, 'amount',0);
                    ?>

                @empty

                    <tr style="padding: 3px;" >
                        <td style="padding: 3px; font-size: 10px; text-align: center; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px;" colspan="9">
                            Tiada Data
                        </td>
                    </tr>

                @endforelse

                <tr style="padding: 3px;">
                    <td style="padding: 3px; font-size: 10px; text-align: center; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px; border-top-style: solid; border-top-width: 1px;">

                    </td>
                    <td style="padding: 3px; font-size: 10px; text-align: left; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px; border-top-style: solid; border-top-width: 1px;">

                    </td>
                    <td style="padding: 3px; font-size: 10px; text-align: right; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px; border-top-style: solid; border-top-width: 1px;">
                        <b>JUMLAH BESAR</b>
                    </td>
                    <td style="padding: 3px; font-size: 10px; text-align: right; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px; border-top-style: solid; border-top-width: 1px;">
                        <b>{{ number_format($sumamountpd, 2, '.', ',') }}</b>
                    </td>
                    <td style="padding: 3px; font-size: 10px; text-align: left; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px; border-top-style: solid; border-top-width: 1px;">

                    </td>
                    <td style="padding: 3px; font-size: 10px; text-align: right; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px; border-top-style: solid; border-top-width: 1px;">
                        <b>{{ number_format($sumamountpd, 2, '.', ',') }}</b>
                        {{-- <b>{{ number_format($sumamountpp, 2, '.', ',')  }}</b> --}}
                    </td>
                    <td style="padding: 3px; font-size: 10px; text-align: left; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px; border-top-style: solid; border-top-width: 1px;">

                    </td>
                    <td style="padding: 3px; font-size: 10px; text-align: center; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px; border-top-style: solid; border-top-width: 1px;">

                    </td>
                    <td style="padding: 3px; font-size: 10px; text-align: center; border-left: 0px solid; border-right: 0px solid; border-bottom-style: solid; border-bottom-width: 1px; border-top-style: solid; border-top-width: 1px;">

                    </td>
                </tr>
            </tbody>
        </table>

        <br>
        <br>

        <table style="width: 50%; ">
            <tbody>
                <tr style="padding: 3px;">
                    <td style="padding: 3px; text-align: left;"><b>PENGKELASAN : FPX ONLINE</b></td>
                    <td style="padding: 3px; text-align: left;"><b>JUMLAH : {{ number_format($sumamountpd, 2, '.', '') }}</b></td>
                </tr>
            </tbody>
        </table>

	</body>
</html>

