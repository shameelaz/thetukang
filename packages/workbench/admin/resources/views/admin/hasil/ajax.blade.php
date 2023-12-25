<div class="table-responsive">
    <table id="data-table-hasil" class="table mt-2" style="width:100%;font-size: 12px;">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">Bil</th>
                <th style="text-align: left;">Agensi</th>
                <th style="text-align: left;">PTJ</th>
                <th style="text-align: left;">Perkhidmatan</th>
                <th style="text-align: center;">Kod Hasil</th>
                <th style="text-align: center;">Nama Lain No Rujukan</th>
                {{-- <th style="text-align: center;">Jenis</th> --}}
                {{-- <th style="text-align: center;">Jenis Kadar Bayaran</th> --}}
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
                    <td class="text-center">{{ data_get($value, 'lkpkodhasil.kod_hasil') }}</td>
                    <td class="text-center">{{ data_get($value, 'reference_name') }}</td>
                    {{-- <td class="text-center">
                        @if(data_get($value,'type')== 1)
                        Bil
                        @elseif(data_get($value,'type')== 2)
                        Kadar Bayaran
                        @else
                        @endif
                    </td> --}}
                    {{-- <td class="text-center">
                        @if(data_get($value,'type_rate')== 0)
                        Tiada
                        @elseif(data_get($value,'type_rate')== 1)
                        Kadar Bayaran : Tiket
                        @elseif(data_get($value,'type_rate')== 2)
                        Kadar Bayaran : Timbangan
                        @else

                        @endif
                    </td> --}}
                    @if (data_get($value, 'status') == 1)
                        <td class="text-center">Aktif</td>
                    @else
                        <td class="text-center">Tidak Aktif</td>
                    @endif
                    <td class="text-center">

                        <a href="/admin/hasil/edit/{{ data_get($value,'fk_agency') }}/{{ data_get($value,'fk_ptj') }}/{{ $value->id }}"
                            class="btn btn-primary mr-1 mb-2" title="Kemaskini">
                            <i class="ri-edit-line"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
