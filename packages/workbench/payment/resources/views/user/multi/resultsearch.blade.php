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
            <th style="text-align: center;">Tarikh Bil</th>
            <!-- <th style="text-align: left;">Tindakan</th> -->
            <!-- <th style="text-align: center;">Tindakan</th> -->

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
                <td style="text-align: center">{{ date('d-m-Y',strtotime(data_get($value,'bill_date'))) }}</td>
                <!-- <td> -->
                    <!-- <button class="btn btn-primary" type="submit">Pilih</button> -->
                    <!-- <input type="hidden" name="billid" value=" data_get($value,'id') }}" /> -->
                <!-- </td> -->
                <td class="text-center" valign="center" style="display: none">
                    <input type="checkbox" id="foradd" name="foradd[] " value="{{ $value->id }}" checked="true" >
                </td>
            </tr>
        @empty
            <tr><td colspan="8">Tiada Keputusan Untuk Carian Ini</td></tr>
        @endforelse

        @if(count($data) >= '1')
            <tr>
                <td colspan="7"></td>
                <td class="text-center" valign="center">
                    <button class="btn btn-primary" type="submit" style="">
                        <b>Teruskan</b> <!-- <i class="ri-secure-payment-line" style="font-size: 1rem"></i> -->
                    </button>
                </td>
            </tr>
        @endif

    </tbody>
</table>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
</div>
