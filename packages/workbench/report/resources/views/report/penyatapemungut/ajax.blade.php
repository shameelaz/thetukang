<div class="table-responsive">
    <table id="data-table-penyata-pemungut" class="table mt-2" style="width:100%;font-size: 12px;">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">Bil</th>
                <th style="text-align: left;">No Rujukan</th>
                <th style="text-align: left;">Agensi</th>
                <th style="text-align: left;">PTJ</th>
                <th style="text-align: left;">Tarikh</th>
                <th style="text-align: center;">Amaun</th>
            </tr>
        </thead>
        <tbody>
            <?php $bil = 1; ?>
            @foreach ($data as $key => $value)
                <tr>
                    <td class="text-center">{{ $bil++ }}</td>
                    <td>
                        {{ data_get($value, 'no_penyata_pemungut') }}
                    </td>
                    <td>
                        {{ data_get($value, 'agency.name') }}
                    </td>
                    <td>
                        {{ data_get($value, 'ptj.name') }}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime(data_get($value, 'tarikh_pp'))) }}
                    </td>
                    <td class="text-center">
                        {{ number_format(data_get($value,'jumlah_rm'), 2, '.', ',') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
