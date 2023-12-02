<?php
    if (Session::has('locale')) {
        $locale = Session::get('locale', Config::get('app.locale'));
    } else {
        $locale = \Lang::locale();
    }
    ?>

<div class="gap-2">
    <div style="float: left">
        {{-- <h6 class="mt-2 float-left">Senarai Kod Hasil</h6> --}}
        <a href="/admin/faq/add/{{ data_get($request,'id') }}" class="btn btn-primary me-md-2 float-left">Tambah Soalan</a>
    </div>
    <div style="float: right">


    </div>
    <br>
</div>
<br>
<table id="data-table-faq-result" class="table mt-2" style="width:100%;font-size: 12px;">
    <thead class="table-dark">
        <tr>
            <th style="text-align: left;">Bil</th>
            <th style="text-align: left;">Perkhidmatan</th>
            <th style="text-align: left;">Soalan</th>
            <th style="text-align: left;">Jawapan</th>
            <th style="text-align: left;">Status</th>
            <th style="text-align: left;">Tindakan</th>
        </tr>
    </thead>
    <tbody>
        @php $bil=1; @endphp
        @forelse ($faq as $key => $value)
            <tr>
                <td>{{ $bil++ }}</td>
                <td>{{ data_get($value,'fkkhidmat.name') }}</td>
                <td>{{ data_get($value,'soalan_ms') }}</td>
                <td>{{ data_get($value,'jawapan_ms') }}</td>
                <td>
                    @if (data_get($value, 'status') == 1)
                        <td class="text-center">Aktif</td>
                    @else
                        <td class="text-center">Tidak Aktif</td>
                    @endif
                </td>
                <td>
                     <a href="/admin/faq/edit/{{$value->fk_agency}}/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Kemaskini">
                                                    <i class="ri-edit-line"></i></a>
                </td>

            </tr>
        @empty
        @endforelse
    </tbody>
</table>

<script>
    $(document).ready(function() {
            $('#data-table-faq-result').DataTable({
                "responsive": true,
                "scrollY": true,
                "scrollX": true,
                "ordering": false,
                "info": true,
                'iDisplayLength': 100,
                "lengthMenu": [
                    [25, 50, 100, 250, -1],
                    [25, 50, 100, 250, "All"]
                ],
                @if ($locale == 'ms')
                    "language": {
                        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                    },
                @endif
            });
        });
</script>
