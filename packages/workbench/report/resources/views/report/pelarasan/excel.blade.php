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

		<table style="width:100%; font-size: 10px" class="border">
			<tbody>
				<tr>
					<td colspan="10" class="border" style="text-align: center">
						<b>Laporan Pelarasan Kod Hasil</b>
					</td>
				</tr>
				<tr>
					<td colspan="10" class="border" style="text-align: center">
						Tarikh Mula :
						@if( $sd == 'start' )
							-
						@else
							{{ $sd }}
						@endif
						Tarikh Hingga :
						@if( $ed == 'end' )
							-
						@else
							{{ $ed }}
						@endif

					</td>
				</tr>
			</tbody>
		</table>

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
                        <td class="border" style="text-align: left; padding: 5px; white-space: nowrap;" valign="top">
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

	</body>
</html>

