<table id="data-table-user" class="table mt-2" style="width:100%;font-size: 12px;">
    <thead class="table-dark">
        <tr>
            <th style="text-align: left;">Bil</th>
            <th style="text-align: left;">No Akaun</th>
            <th style="text-align: left;">Nama</th>
            <th style="text-align: left;">No Pengenalan</th>
            <th style="text-align: left;">No Rujukan</th>
            <th style="text-align: left;">Amoun</th>
            <th style="text-align: left;">Keterangan Bil</th>
            <th style="text-align: left;">Tarikh Bil</th>
            <th style="text-align: left;">Tindakan</th>

        </tr>
    </thead>
    <tbody>
        <?php $bil = 1;?>
        @forelse($data as $key => $value)
            <tr>
                <td>{{ $bil++ }}</td>
                <td>{{ data_get($value,'account_no') }}</td>
                <td>{{ data_get($value,'name') }}</td>
                <td>{{ data_get($value,'identification_no') }}</td>
                <td>{{ data_get($value,'reference_no') }}</td>
                <td>{{ data_get($value,'amount') }}</td>
                <td>{{ data_get($value,'bill_detail') }}</td>
                <td>{{ date('d-m-Y',strtotime(data_get($value,'bill_date'))) }}</td>
                <td>
                    <button class="btn btn-primary" type="submit">Pilih</button>
                    <input type="hidden" name="billid" value="{{ data_get($value,'id') }}" />
                </td>
            </tr>
        @empty
            <tr><td colspan="9">Tiada Keputusan Untuk Carian Ini</td></tr>
        @endforelse

    </tbody>
</table>
