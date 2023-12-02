<div class="table-responsive">
    <table id="data-table-tetapan" class="table mt-2" style="width:100%;font-size: 12px;">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">Bil</th>
                <th style="text-align: left;">Agensi</th>
                <th style="text-align: left;">PTJ</th>
                <th style="text-align: left;">Perkhidmatan</th>
                <th style="text-align: left;">Jenis</th>
                <th style="text-align: left;">Keterangan</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php $bil = 1; ?>
            @foreach ($data as $key => $value)
                <tr>
                    <td class="text-center">{{ $bil++ }}</td>
                    <td>{{ data_get($value, 'agency.name') }}</td>
                    <td>{{ data_get($value, 'ptj.name') }}</td>
                    <td>{{ data_get($value, 'lkpperkhidmatan.name') }}</td>
                    <td>{{ data_get($value, 'lkpmaster.description') }}</td>
                    <td>{{ data_get($value, 'description') }}</td>
                    @if (data_get($value, 'status') == 1)
                        <td class="text-center">Aktif</td>
                    @else
                        <td class="text-center">Tidak Aktif</td>
                    @endif
                    <td class="text-center">
                        <a href="/ptj/tetapan/edit/{{ $value->id }}"
                            class="btn btn-primary mr-1 mb-2" title="Kemaskini">
                            <i class="ri-edit-line"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
