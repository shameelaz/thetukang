
<div class="table-responsive">
    <table id="data-table-user" class="table mt-2" style="width:100%;font-size: 12px;">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">Bil</th>
                <th style="text-align: left;">Nama Pengguna</th>
                <th style="text-align: left;">Emel</th>
                <th style="text-align: left;">Agensi</th>
                <th style="text-align: left;">PTJ</th>
                <th style="text-align: left;">Peranan</th>
                <th style="text-align: center;">Tarikh Daftar</th>
                <th style="text-align: center;">Tarikh Tamat</th>
                <th style="text-align: center;">Tarikh Terakhir Masuk Sistem</th>
                <th style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $bil = 1; ?>
            @foreach ($data as $key => $value)
                <tr>
                    <td class="text-center">{{ $bil++ }}</td>
                    <td>{{ data_get($value, 'name') }}</td>
                    <td>{{ data_get($value, 'email') }}</td>
                    <td>
                        @if (data_get($value, 'profile.userAgency.name') != null)
                            {{ data_get($value, 'profile.userAgency.name') }}
                        @else
                            -
                        @endif

                    </td>
                    <td>
                        @if (data_get($value, 'profile.userPtj.name') != null)
                            {{ data_get($value, 'profile.userPtj.name') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ data_get($value, 'role.0.name.name') }}</td>
                    <td class="text-center" style="white-space: nowrap;">
                        @if (data_get($value, 'email_verified_at') != null)
                            {{ date('d-m-Y', strtotime(data_get($value, 'email_verified_at'))) }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center" style="white-space: nowrap;">
                        @if (data_get($value, 'expired_date') != null)
                            {{ date('d-m-Y', strtotime(data_get($value, 'expired_date'))) }}
                        @else
                            -
                        @endif
                    </td>

            <td class="text-center" style="white-space: nowrap;">
                @if (data_get($value, 'last_login') != null)
                    {{ date('d-m-Y', strtotime(data_get($value, 'last_login'))) }}
                @else
                    -
                @endif
            </td>
            @if (data_get($value, 'status') == 1)
                <td class="text-center">Aktif</td>
            @else
                <td class="text-center">Tidak Aktif</td>
            @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
