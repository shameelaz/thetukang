<div class="table-responsive">
    <table id="data-table-receipt" class="table mt-2" style="width:100%;font-size: 12px;">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">Bil</th>
                {{-- <th style="text-align: left;">Jabatan</th> --}}
                {{-- <th style="text-align: left;">PTJ</th> --}}
                <th style="text-align: left;">Nombor Resit</th>
                <th style="text-align: left;">Perihal</th>
                <th style="text-align: left;">Nama Pembayar</th>
                <th style="text-align: left;">Bentuk Bayaran</th>
                <th style="text-align: left;">Masa Urusniaga</th>
                <th style="text-align: left;">Kod Akaun</th>
                <th style="text-align: left;">Amaun (RM)</th>
            </tr>
        </thead>
        <tbody>
            <?php $bil = 1; ?>
            @foreach ($data as $key => $value)

                <tr>
                    <td class="text-center">{{ $bil++ }}</td>
                        {{-- <td>{{ date('Y-m-d', strtotime(data_get($value, 'created_at'))) }}</td> --}}
                    {{-- <td>
                        {{ data_get($value, 'fkkodhasil.agency.name') }}
                    </td>
                    <td>
                        {{ data_get($value, 'fkkodhasil.ptj.name') }}
                    </td> --}}
                    <td style="text-align: center;">
                        {{ data_get($value, 'receipt_no') }}
                    </td>
                    <td style="text-align: left;">
                        {{ data_get($value, 'details') }}
                    </td>
                    <td style="text-align: left;">
                        {{ data_get($value, 'fkpayer.name') }}
                    </td>
                    <td style="text-align: center;">
                        {{ data_get($value, 'fkpayment.fkpaymentgateway.name') }}
                    </td>
                    <td style="text-align: center;">
                        {{ date('H:i:s', strtotime(data_get($value, 'fkpayment.transaction_date'))) }}
                    </td>
                    <td style="text-align: center;">
                        {{ data_get($value, 'fkkodhasil.name') }}
                    </td>
                    <td style="text-align: center;">
                        {{ number_format(data_get($value, 'amount'), 2, '.', ',') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
