<div class="table-responsive">
    <table id="data-table-pelarasan" class="table mt-2" style="width:100%;font-size: 12px;">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">Bil</th>
                <th style="text-align: center;">Perkhidmatan</th>
                <th style="text-align: center;">No Penyata Pemungut</th>
                <th style="text-align: center;">No Resit</th>
                <th style="text-align: center;">Kod Hasil Lama</th>
                <th style="text-align: center;">Kod Hasil Baru</th>
                <th style="text-align: center;">Tarikh Pelarasan</th>
            </tr>
        </thead>
        <tbody>
            <?php $bil = 1; ?>
            @foreach ($data as $key => $value)

                <tr>
                    <td class="text-center">{{ $bil++}}</td>
                    <td class="text-left"> {{ data_get($value,'lkpperkhidmatan.name') }} </td>
                    <td class="text-center"></td>
                    <td class="text-center"> {{ data_get($value,'receipt_no') }} </td>
                    <td class="text-center"> {{ data_get($value,'kod_hasil_lama') }} </td>
                    <td class="text-center"> {{ data_get($value,'kod_hasil_baru') }} </td>
                    <td class="text-center"> {{ date('d-m-Y', strtotime(data_get($value,'tarikh_pelarasan'))) }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
