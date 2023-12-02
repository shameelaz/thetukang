<div class="table-responsive">
    <table id="data-table-transaction" class="table mt-2" style="width:100%;font-size: 12px;">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">Bil</th>
                <th style="text-align: center;">No Rujukan</th>
                <th style="text-align: center;">Tarikh Transaksi</th>
                <th style="text-align: center;">No Transaksi</th>
                <th style="text-align: center;">Agensi</th>
                <th style="text-align: center;">PTJ</th>
                <th style="text-align: center;">Kod Hasil</th>
                <th style="text-align: center;">Nama</th>
                <th style="text-align: center;">No Resit</th>
                <th style="text-align: center;">Jumlah (RM)</th>
                <th style="text-align: center;">Status Bayaran</th>
                <th style="text-align: center;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php $bil=1;?>
                @foreach($transaction as $key =>$value)
                    <tr>
                        <td class="text-center">{{ $bil++}}</td>
                        <td class="text-center"> {{ data_get($value,'reference_no') }} </td>
                        <td class="text-center">
                            @if(data_get($value,'fkpayment.transaction_date')=='')
                            &nbsp;
                            @else
                            {{ date('d-m-Y', strtotime(data_get($value,'fkpayment.transaction_date'))) }}
                            @endif
                        </td>
                        <td class="text-center"> {{ data_get($value,'fkpayment.transaction_no') }} </td>
                        <td> {{ data_get($value,'fkkodhasil.agency.name') }} </td>
                        <td> {{ data_get($value,'fkkodhasil.ptj.name') }} </td>
                        <td> {{ data_get($value,'fkkodhasil.name') }} </td>
                        <td> {{ data_get($value,'fkpayer.name') }} </td>
                        <td> {{ data_get($value,'receipt_no') }} </td>
                        <td class="text-center">{{ data_get($value,'amount') }}</td>
                        @if(data_get($value, 'fkpayment.status') == 1)
                            <td class="text-center">BERJAYA</td>
                        @elseif(data_get($value, 'fkpayment.status') == 2)
                            <td class="text-center">GAGAL</td>
                        @elseif(data_get($value, 'fkpayment.status') == 3)
                            <td class="text-center">MENUNGGU BAYARAN</td>
                        @else
                            <td class="text-center"></td>
                        @endif
                        <td class="text-center">
                            @if(($roleid == 2)||($roleid == 4) ||($roleid == 5) || ($roleid == 7))
                                @if(data_get($value, 'fkpayment.status') == 1)
                                    <table cellpadding="0">
                                        <tr style="padding: 0px">
                                            <td style="padding: 1px"><a href="/admin/transaction/export/{{ $value->id }}" target="_blank" class="btn btn-primary mr-1 mb-2" title="Muat Turun PDF">
                                                <i class="ri-file-pdf-line"></i></a>
                                            </td>
                                            <td style="padding: 1px"><a href="/admin/transaction/detail/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Terperinci">
                                                <i class="ri-eye-line"></i></a>
                                            </td>
                                        </tr>
                                    </table>
                                @else
                                    <a href="/admin/transaction/detail/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Terperinci">
                                    <i class="ri-eye-line"></i></a>
                                @endif
                            @elseif (($roleid == 3))

                                @if(data_get($value, 'fkpayment.status') == 1)
                                    <table cellpadding="0">
                                        <tr style="padding: 0px">
                                            <td style="padding: 1px">
                                                <a href="/admin/transaction/export/{{ $value->id }}" target="_blank" class="btn btn-primary mr-1 mb-2" title="Muat Turun PDF">
                                                <i class="ri-file-pdf-line"></i></a>
                                            </td>
                                            <td style="padding: 1px"><a href="/admin/transaction/detail/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Terperinci">
                                                <i class="ri-eye-line"></i></a>
                                            </td>
                                        </tr>
                                    </table>
                                @else
                                    <a href="/admin/transaction/detail/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Terperinci">
                                    <i class="ri-eye-line"></i></a>
                                @endif

                            {{-- @elseif (($roleid == 4) ||($roleid == 5) )
                                 <td style="padding: 1px"><a href="/admin/pelarasan/result/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Pelarasan Kod Hasil">
                                    <i class="ri-edit-line"></i></a>
                                </td> --}}
                            @endif
                        </td>
                    </tr>

                @endforeach
        </tbody>
    </table>
</div>
