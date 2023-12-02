<div class="table-responsive">
    <table id="data-table-survey" class="table mt-2" style="width:100%;font-size: 12px;">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">Bil</th>
                <th style="text-align: left;">Tarikh</th>
                <th style="text-align: left;">Tahap Kepuasan</th>
                <th style="text-align: left;">Ulasan</th>
            </tr>
        </thead>
        <tbody>
            <?php $bil = 1; ?>
            @foreach ($data as $key => $value)

                <tr>
                    <td class="text-center">{{ $bil++ }}</td>
                    <td>{{ date('d-m-Y', strtotime(data_get($value, 'created_at'))) }}</td>
                    <td>
                        {{ data_get($value, 'survey.description') }}
                    </td>
                    <td>
                        @if ( data_get($value, 'remark') != NULL)
                            {{ data_get($value, 'remark') }}
                        @else
                            -
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
