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
                            LAPORAN TERIMAAN HARIAN/BULANAN MENGIKUT JENIS PADA
                                @if( $sd == 'start' )
                                    -
                                @else
                                    ({{ $sd }})
                                @endif
                            HINGGA
                                @if( $ed == 'end' )
                                    -
                                @else
                                    ({{ $ed }})
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
                    <td style="width: 25%" valign="top">
                        <table class="border" style="width: 100%">
                            <tbody>
                                <tr style="padding: 5px;" class="border">
                                    <td width="7%" style="padding: 5px; text-align: center;" colspan="4"><b>Ringkasan Terimaan</b></td>
                                </tr>
                                <tr style="padding: 5px;" class="border">
                                    <td width="7%" style="padding: 5px;" class="border"><b>Bil.</b></td>
                                    <td width="7%" style="padding: 5px;" class="border"><b>Kod Akaun</b></td>
                                    <td width="7%" style="padding: 5px;" class="border"><b>Bil. Urusniaga</b></td>
                                    <td width="79%" style="padding: 5px;" class="border"><b>Amaun (RM)</b></td>
                                </tr>
                                <?php
                                    $sumamount = 0 ;
                                    $sumkodhasil = 0 ;
                                ?>

                                @forelse($tkh as $key => $tkhs)
                                    <tr style="padding: 5px;" class="border">
                                        <td width="7%" style="padding: 5px;" class="border"><b> {{ ++$key }} </b></td>
                                        <td width="7%" style="padding: 5px;" class="border"><b> {{ data_get($tkhs, 'name') }} </b></td>
                                        <td width="7%" style="padding: 5px; text-align: center;" class="border"><b> {{ data_get($tkhs, 'id') }} </b></td>
                                        <td width="79%" style="padding: 5px; text-align: right;" class="border"><b> {{ data_get($tkhs, 'amount') }} </b></td>
                                    </tr>

                                    <?php
                                        $sumamount += data_get($tkhs, 'amount');
                                        $sumkodhasil += data_get($tkhs, 'id');
                                    ?>
                                @empty
                                    <tr style="padding: 5px;" class="border">
                                        <td width="7%" style="padding: 5px;" class="border"><b> - </b></td>
                                        <td width="7%" style="padding: 5px;" class="border"><b> - </b></td>
                                        <td width="7%" style="padding: 5px; text-align: center;" class="border"><b> - </b></td>
                                        <td width="79%" style="padding: 5px; text-align: right;" class="border"><b> - </b></td>
                                    </tr>
                                @endforelse

                                    <tr style="padding: 5px;" class="border">
                                        <td width="7%" style="padding: 5px;" colspan="2"><b>Jumlah Terimaan (Mengikut Charge Line)</b></td>
                                        <td width="7%" style="padding: 5px; text-align: center;" class="border"><b> {{ $sumkodhasil }} </b></td>
                                        <td width="79%" style="padding: 5px; text-align: right;" class="border"><b> {{  (number_format($sumamount, 2, '.', '')) }} </b></td>
                                    </tr>
                                    <tr style="padding: 5px;" class="border">
                                        <td width="7%" style="padding: 5px;" colspan="2"><b>Bilangan Urusniaga Batal</b></td>
                                        <td width="7%" style="padding: 5px; text-align: center;" class="border"><b> 0 </b></td>
                                        <td width="79%" style="padding: 5px; text-align: right;" class="border"><b> 0.00 </b></td>
                                    </tr>
                                    <tr style="padding: 5px;" class="border">
                                        <td width="7%" style="padding: 5px;" colspan="2"><b>Bilangan Urusniaga Diterima</b></td>
                                        <td width="7%" style="padding: 5px; text-align: center;" class="border"><b> {{ $sumkodhasil }}  </b></td>
                                        <td width="79%" style="padding: 5px; text-align: right;" class="border"><b> {{  (number_format($sumamount, 2, '.', '')) }} </b></td>
                                    </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="width: 50%" valign="top">
                        <table class="border" style="width: 100%">
                            <tbody>
                                <tr style="padding: 5px;" class="border">
                                    <td width="70%" style="padding: 5px; text-align: center;" class="border"><b>Ringkasan Terimaan</b></td>
                                    <td width="10%" style="padding: 5px; text-align: center;" class="border"><b>Bil Rekod</b></td>
                                    <td width="20%" style="padding: 5px; text-align: center;" class="border"><b>Amaun (RM)</b></td>
                                </tr>

                                <tr style="padding: 5px;" class="border">
                                    <td width="70%" style="padding: 5px;" class="border"><b>1.  Terimaan FPX ONLINE (W)</b></td>
                                    <td width="10%" style="padding: 5px; text-align: right;" class="border"><b> {{ $fpxcard[0]->total_fpx }} </b></td>
                                    <td width="20%" style="padding: 5px; text-align: right;" class="border"><b> {{ (number_format($fpxcard[0]->total_amount, 2, '.', '')) }} </b></td>
                                </tr>

                                <tr style="padding: 5px;">
                                    <td width="70%" style="padding: 5px;"><b>Jumlah Semua</b></td>
                                    <td width="10%" style="padding: 5px; text-align: right;"><b> {{ $fpxcard[0]->total_fpx }} </b></td>
                                    <td width="20%" style="padding: 5px; text-align: right;"><b> {{ (number_format($fpxcard[0]->total_amount, 2, '.', '')) }} </b></td>
                                </tr>
                                <tr style="padding: 5px;">
                                    <td width="70%" style="padding: 5px;"><b>Bilangan Urusniaga Batal</b></td>
                                    <td width="10%" style="padding: 5px; text-align: right;"><b>&nbsp;&nbsp;</b></td>
                                    <td width="20%" style="padding: 5px; text-align: right;"><b>0.00</b></td>
                                </tr>
                                <tr style="padding: 5px;">
                                    <td width="70%" style="padding: 5px;"><b>Bilangan Urusniaga Diterima</b></td>
                                    <td width="10%" style="padding: 5px; text-align: right;"><b> {{ $fpxcard[0]->total_fpx }} </b></td>
                                    <td width="20%" style="padding: 5px; text-align: right;"><b> {{ (number_format($fpxcard[0]->total_amount, 2, '.', '')) }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width: 100%">
                            <tbody>
                                <tr style="padding: 5px;">
                                    <td width="40%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                    <td width="10%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                    <td width="60%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                </tr>
                                <tr style="padding: 5px;">
                                    <td width="40%" style="padding: 5px;"><b>Disediakan oleh</b></td>
                                    <td width="10%" style="padding: 5px;"><b> : </b></td>
                                    <td width="60%" style="padding: 5px;"> </td>
                                </tr>
                                <tr style="padding: 5px;">
                                    <td width="40%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                    <td width="10%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                    <td width="60%" style="padding: 5px;"> &nbsp;&nbsp;  </td>
                                </tr>
                                <tr style="padding: 5px;">
                                    <td width="40%" style="padding: 5px;"><b>Tandatangan</b></td>
                                    <td width="10%" style="padding: 5px;"><b> : </b></td>
                                    <td width="60%" style="padding: 5px;"> </td>
                                </tr>
                                <tr style="padding: 5px;">
                                    <td width="40%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                    <td width="10%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                    <td width="60%" style="padding: 5px;"> &nbsp;&nbsp;  </td>
                                </tr>
                                 <tr style="padding: 5px;">
                                    <td width="40%" style="padding: 5px;"><b>Disahkan oleh</b></td>
                                    <td width="10%" style="padding: 5px;"><b> : </b></td>
                                    <td width="60%" style="padding: 5px;"> </td>
                                </tr>
                                <tr style="padding: 5px;">
                                    <td width="40%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                    <td width="10%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                    <td width="60%" style="padding: 5px;"> &nbsp;&nbsp;  </td>
                                </tr>
                                <tr style="padding: 5px;">
                                    <td width="40%" style="padding: 5px;"><b>Jawatan</b></td>
                                    <td width="10%" style="padding: 5px;"><b> : </b></td>
                                    <td width="60%" style="padding: 5px;"> </td>
                                </tr>
                                <tr style="padding: 5px;">
                                    <td width="40%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                    <td width="10%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                    <td width="60%" style="padding: 5px;"> &nbsp;&nbsp; </td>
                                </tr>
                                <tr style="padding: 5px;">
                                    <td width="40%" style="padding: 5px;"><b>Tarikh</b></td>
                                    <td width="10%" style="padding: 5px;"><b> : </b></td>
                                    <td width="60%" style="padding: 5px;"> </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

	</body>
</html>

