
<?php
    if (Session::has('locale')) {
        $locale = Session::get('locale', Config::get('app.locale'));
    } else {
        $locale = \Lang::locale();
    }
?>

<div id="div-list">
    <div class="card-body ">

        <div class="row g-2">
            <div class="col-md-12 col-lg-12">

                <div class="table-responsive">
                    <table id="data-table-liabiliti" class="table mt-2" style="width:100%;font-size: 12px;">
                        <thead class="table-dark">
                            <tr>
                                <th style="text-align: center;">Bil</th>
                                <th style="text-align: left;">Perkhidmatan</th>
                                <th style="text-align: center;">Kod Liaibiliti</th>
                                <th style="text-align: center;">Nama Lain No Rujukan</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bil = 1; ?>
                            @foreach ($lia as $key => $value)
                                <tr>
                                    <td class="text-center">{{ $bil++ }}</td>
                                    <td>{{ data_get($value, 'lkpperkhidmatan.name') }}</td>
                                    <td class="text-center">{{ data_get($value, 'name') }}</td>
                                    <td class="text-center">{{ data_get($value, 'reference_name') }}</td>
                                    @if (data_get($value, 'status') == 1)
                                        <td class="text-center">Aktif</td>
                                    @else
                                        <td class="text-center">Tidak Aktif</td>
                                    @endif
                                    <td class="text-center">
                                        <a href="/admin/liabiliti/edit/{{ Request::segment(5) }}/{{ $value->id }}"
                                            class="btn btn-primary mr-1 mb-2" title="Kemaskini">
                                            <i class="ri-edit-line"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </div>
</div>

    <script type="text/javascript">

        $(document).ready(function()
        {
            $('#data-table-liabiliti').DataTable({
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
