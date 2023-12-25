<div class="table-responsive">
    <table id="data-table-book" class="table mt-2" style="width:100%;font-size: 12px;">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">Bil</th>
                <th style="text-align: left;">Jabatan</th>
                <th style="text-align: left;">PTJ</th>
                <th style="text-align: center;">No Resit</th>
                <th style="text-align: center;">Amaun</th>
                <th style="text-align: center;">Tarikh</th>

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
                        {{ data_get($value, 'receipt_no') }}
                    </td>
                    <td class="text-center">
                        {{ number_format(data_get($value,'amount'), 2, '.', ',') }}
                    </td>
                    <td class="text-center">
                        {{ date('d-m-Y', strtotime(data_get($value, 'fkpayment.transaction_date'))) }}
                    </td>

            @endforeach
        </tbody>
    </table>
</div>
