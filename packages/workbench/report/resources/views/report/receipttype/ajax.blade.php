<div class="table-responsive">
    <table id="data-table-receipt-type" class="table mt-2" style="width:100%;font-size: 12px;">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">Bil</th>
                <th style="text-align: left;">Jabatan</th>
                <th style="text-align: left;">PTJ</th>
                <th style="text-align: center;">Kod Akaun</th>
                {{-- <th style="text-align: left;">Bil Urusniaga</th>
                <th style="text-align: left;">Amaun (RM)</th>
                <th style="text-align: left;">Jumlah Terimaan</th>
                <th style="text-align: left;">Bilangan Urusniaga Batal</th>
                <th style="text-align: left;">Bilangan Urusniaga Diterima</th> --}}
                <th style="text-align: center;" title="Terimaan FPX Online Individu">(FPXI)</th> {{--  Terimaan FPX Online Individu --}}
                <th style="text-align: center;" title="Terimaan FPX Online Syarikat">(FPXS)</th> {{--  Terimaan FPX Online  Syarikat --}}
                <th style="text-align: center;" title="Terimaan Online Kad Debit">(KDO)</th> {{--  Terimaan Online Kad Debit  --}}
                <th style="text-align: center;" title="Terimaan Online Kad Kredit">(KKO)</th> {{--  Terimaan Online Kad Kredit --}}
                {{-- <th style="text-align: center;">Jumlah Semua</th>
                <th style="text-align: center;">Bilangan Urusniaga Batal</th>
                <th style="text-align: center;">Bilangan Urusniaga Diterima</th> --}}

            </tr>
        </thead>
        <tbody>
            <?php $bil = 1; ?>
            @foreach ($data as $key => $value)
                <tr>
                    <td class="text-center">{{ $bil++ }}</td>
                    <td>
                        {{ data_get($value, 'fkkodhasil.agency.name') }}
                    </td>
                    <td>
                        {{ data_get($value, 'fkkodhasil.ptj.name') }}
                    </td>
                    <td class="text-center">
                        {{ data_get($value, 'fkkodhasil.name') }}
                    </td>
                    {{-- <td>
                     {{ data_get($value, 'details') }}
                    </td>
                    <td>
                        {{ data_get($value, 'fkpayer.name') }}
                    </td>
                    <td>
                        {{ data_get($value, 'fkpayment.fkpaymentgateway.name') }}
                    </td>
                    <td>
                        {{ date('H:i:s', strtotime(data_get($value, 'fkpayment.transaction_date'))) }}
                    </td>
                    <td>
                        {{ data_get($value, 'fkkodhasil.name') }}
                    </td> --}}
                    <td class="text-center">
                        @if (data_get($value, 'fkpayment.fpx_type') == 1)
                            {{ data_get($value, 'fkpayment.fpx_type') }}
                        @else
                            -
                        @endif

                    </td>
                    <td class="text-center">
                        @if (data_get($value, 'fkpayment.fpx_type') == 2)
                            {{ data_get($value, 'fkpayment.fpx_type') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">
                        @if (data_get($value, 'fkpayment.card_type') == 1)
                            {{ data_get($value, 'fkpayment.card_type') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">
                        @if (data_get($value, 'fkpayment.card_type') == 1)
                            {{ data_get($value, 'fkpayment.card_type') }}
                        @else
                            -
                        @endif
                    </td>
                    {{-- <td class="text-center">
                        {{ data_get($value, 'amount') }}
                    </td>
                    <td class="text-center">
                        {{ data_get($value, 'amount') }}
                    </td>
                    <td class="text-center">
                        {{ data_get($value, 'amount') }}
                    </td> --}}

            @endforeach
        </tbody>
    </table>
</div>
