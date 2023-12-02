<table id="data-table-agency" class="table mt-2" style="width:100%;font-size: 12px;">
    <thead class="table-dark">
        <tr>
            <th style="text-align: center;">Bil</th>
            <th style="text-align: center;">Agensi</th>
            <th style="text-align: center;">PTJ</th>
            <th style="text-align: center;">Nama</th>
            <th style="text-align: center;">No Akaun</th>
            <th style="text-align: center;">No Pengenalan</th>
            <th style="text-align: center;">Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php $bil=1;?>
            @foreach($data as $key =>$value)
                <tr>
                    <td class="text-center">{{ $bil++}}</td>
                    <td class="text-center">{{ data_get($value,'fkagency.name') }}</td>
                    <td class="text-center">{{ data_get($value,'fkptj.name') }}</td>
                    <td class="text-center">{{ data_get($value,'name') }}</td>
                    <td class="text-center">{{ data_get($value,'account_no') }}</td>
                    <td class="text-center">{{ data_get($value,'identification_no') }}</td>
                    <td class="text-center">
                        <button class="btn btn-primary" type="submit">Pilih</button>
                        <input type="hidden" name="payeraccid" value="{{ data_get($value,'id') }}" />
                    </td>
                </tr>

            @endforeach
    </tbody>
</table>
