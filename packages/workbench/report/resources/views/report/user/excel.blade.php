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
						<b>Laporan Senarai Pengguna</b>
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

                        Peranan :
                        @if( $ro == 'rol' )
							-
						@else
							{{ data_get($role, 'name') }}
						@endif
					</td>
				</tr>
			</tbody>
		</table>

		<table style="width:100%; font-size: 10px" class="border">
			<tbody>
				<tr>
					<td class="border" style="text-align: center">
						<b>Bil</b>
					</td>
					<td class="border" style="text-align: center">
                        <b>Nama Pengguna</b>
                    </td>
                    <td class="border" style="text-align: center">
                        <b>Email</b>
                    </td>
                    <td class="border" style="text-align: center">
                        <b>Agensi</b>
                    </td>
                    <td class="border" style="text-align: center">
                        <b>PTJ</b>
                    </td>
                    <td class="border" style="text-align: center">
                        <b>Peranan</b>
                    </td>
                    <td class="border" style="text-align: center">
                        <b>Tarikh Daftar</b>
                    </td>
                    <td class="border" style="text-align: center">
                        <b>Tarikh Tamat</b>
                    </td>
                    <td class="border" style="text-align: center">
                        <b>Tarikh Terakhir Masuk Sistem</b>
                    </td>
					<td class="border" style="text-align: center">
						<b>Status</b>
					</td>
				</tr>
				@forelse($data as $key => $dt)
					<tr>
						<td class="border" style="text-align: center" valign="top">
							{{ ++$key }}
						</td>
						<td class="border" style="text-align: left" valign="top">
                            {{ data_get($dt, 'name') }}
                        </td>
                        <td class="border" style="text-align: left" valign="top">
                            {{ data_get($dt, 'email') }}
                        </td>
                        <td class="border" style="text-align: left" valign="top">
                            @if (data_get($dt, 'profile.userAgency.name') != NULL)
                                {{ data_get($dt, 'profile.userAgency.name') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="border" style="text-align: left" valign="top">
                            @if (data_get($dt, 'profile.userPtj.name') != NULL)
                                {{ data_get($dt, 'profile.userPtj.name') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="border" style="text-align: left" valign="top">
                            {{ data_get($dt, 'role.0.name.name') }}
                        </td>
                        <td class="border" style="text-align: center" valign="top">
                            @if (data_get($dt, 'email_verified_at') != null)
                                {{  date('d-m-Y', strtotime(data_get($dt, 'email_verified_at'))) }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="border" style="text-align: center" valign="top">
                            @if (data_get($dt, 'expired_date') != null)
                                {{ date('d-m-Y', strtotime(data_get($dt, 'expired_date'))) }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="border" style="text-align: center;" valign="top">
                            @if (data_get($dt, 'last_login') != null)
                                {{ date('d-m-Y', strtotime(data_get($dt, 'last_login'))) }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="border" style="text-align: center;">
                            @if (data_get($dt, 'status') == 1)
                                Aktif
                            @else
                                Tidak Aktif
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





	</body>
</html>

