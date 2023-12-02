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
                            LAPORAN TERIMAAN HARIAN/BULANAN PADA
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

		<table style=" font-size: 10px" class="border">
			<tbody>
				<tr>
                    <td class="border" style="text-align: center;">
                        <b>Bil</b>
                    </td>
                    {{-- <td class="border" style="text-align: center;">
                        <b>Jabatan</b>
                    </td>
                    <td class="border" style="text-align: center;">
                        <b>PTJ</b>
                    </td> --}}
                    <td class="border" style="text-align: center;">
                        <b>Nombor Resit</b>
                    </td>
                    <td class="border" style="text-align: center;">
                        <b>Perihal</b>
                    </td>
                    <td class="border" style="text-align: center;">
                        <b>Nama Pembayar</b>
                    </td>
                    <td class="border" style="text-align: center;">
                        <b>Bentuk Bayaran</b>
                    </td>
                    <td class="border" style="text-align: center;">
                        <b>Masa Urusniaga</b>
                    </td>
                    <td class="border" style="text-align: center;">
                        <b>Kod Akaun</b>
                    </td>
                    <td class="border" style="text-align: center;">
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
                        <td class="border" style="text-align: left; padding: 5px; white-space: nowrap;" valign="top">
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
                            {{ data_get($dt, 'amount') }}
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

	</body>
</html>

