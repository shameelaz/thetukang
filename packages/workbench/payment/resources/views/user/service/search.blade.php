<div class="col-md-12 col-lg-12">

    <div class="table-responsive">
        <table id="searchlist" class="table table-bordered table-striped mt-2" style="width:100%;font-size: 12px; vertical-align: middle;">
            <thead class="table-dark">
                <tr>
                    <th style="text-align: center;">&nbsp;</th>
                    <th style="text-align: center;">Company Name</th>
                    <th style="text-align: center;">Phone Number</th>
                    <th style="text-align: center;">Services</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Location</th>
                    <th style="text-align: center;">Price (RM)</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $bil = 1; ?>
                @foreach ($search as $key => $value)
                    <tr>
                        <td class="text-center">{{ $bil++ }}</td>
                        <td class="text-center">{{ data_get($value, 'user.name') }}</td>
                        <td class="text-center">{{ data_get($value, 'user.profile.mobile_no') }}</td>
                        <td class="text-center">{{ data_get($value, 'lkpservicetype.name') }}</td>
                        <td class="text-left">{{ data_get($value, 'desc') }}</td>
                        <td class="text-center">{{ data_get($value, 'location') }}</td>
                        <td class="text-center">{{ number_format(data_get($value,'price'), 2, '.', '') }}</td>
                        <td class="text-center">
                            <a href="/user/service/booking/{{ $value->id }}"
                                class="btn btn-primary mr-1 mb-2" title="Book">
                                <i class="ri-tools-fill"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>