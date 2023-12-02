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

    </div>
    <div style="float: right">


    </div>
    <br>
</div>
<br>
@forelse($faq as $key => $value)
<div class="accordion accordion-flush style-border" id="accordionFlushExample">
    <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            {{ data_get($value,'soalan_ms') }}
        </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            {{ data_get($value,'jawapan_ms') }}
        </div>
    </div>
    </div>

</div>
@empty
<div class="alert alert-danger" role="alert">
    Tiada Soalan Lazim untuk carian ini
</div>
@endforelse
<br>
{{-- <table id="data-table-faq-result" class="table mt-2" style="width:100%;font-size: 12px;">
    <thead class="table-dark">
        <tr>
            <th style="text-align: left;">Bil</th>
            <th style="text-align: left;">Perkhidmatan</th>
            <th style="text-align: left;">Soalan</th>
            <th style="text-align: left;">Jawapan</th>

        </tr>
    </thead>
    <tbody>
        @php $bil=1; @endphp
        @forelse ($faq as $key => $value)
            <tr>
                <td>{{ $bil++ }}</td>
                <td>{{ data_get($value,'fkkhidmat') }}</td>
                <td>{{ data_get($value,'soalan_ms') }}</td>
                <td>{{ data_get($value,'jawapan_ms') }}</td>


            </tr>
        @empty
        @endforelse
    </tbody>
</table> --}}

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
