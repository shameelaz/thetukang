<div class="col-md-12 col-lg-12">

    <div class="table-responsive">
        <table id="searchlist" class="table table-bordered table-striped mt-2" style="width:100%;font-size: 12px; vertical-align: middle;">
            <thead class="table-dark">
                <tr>
                    <th style="text-align: center; text-transform: uppercase;">&nbsp;</th>
                    <th style="text-align: center; text-transform: uppercase;">Company Name</th>
                    <th style="text-align: center; text-transform: uppercase;">Phone Number</th>
                    <th style="text-align: center; text-transform: uppercase;">Services</th>
                    <th style="text-align: center; text-transform: uppercase;">Description</th>
                    <th style="text-align: center; text-transform: uppercase;">Location</th>
                    <th style="text-align: center; text-transform: uppercase;">Price (RM)</th>
                    <th style="text-align: center; text-transform: uppercase;">Discount (%)</th>
                    <th style="text-align: center; text-transform: uppercase;">Discount Price (RM)</th>
                    <th style="text-align: center; text-transform: uppercase;">Promotion Start Date</th>
                    <th style="text-align: center; text-transform: uppercase;">Promotion End Date</th>
                    <th style="text-align: center; text-transform: uppercase;">Promotion Details</th>
                    <th style="text-align: center; text-transform: uppercase;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $bil = 1; ?>
                @foreach ($search as $key => $value)
                @php

                    $discountPercentage = data_get($value, 'promotion.0.percent', 0) / 100; // Assuming the percentage is stored as an integer
                    $discountprice      = data_get($value, 'price') * (1 - $discountPercentage);

                @endphp
                    <tr>
                        <td class="text-center">{{ $bil++ }}</td>
                        <td class="text-center">{{ data_get($value, 'user.name') }}</td>
                        <td class="text-center">{{ data_get($value, 'user.profile.mobile_no') }}</td>
                        <td class="text-center">{{ data_get($value, 'lkpservicetype.name') }}</td>
                        <td class="text-left">{{ data_get($value, 'desc') }}</td>
                        <td class="text-center">{{ data_get($value, 'location') }}</td>
                        <td class="text-center">{{ number_format(data_get($value,'price'), 2, '.', ',') }}</td>
                        <td class="text-center">
                            @if (data_get($value,'promotion.0.percent') != null)
                                {{ number_format(data_get($value,'promotion.0.percent'), 2, '.', ',') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            @if (data_get($value,'promotion.0.percent') != null)
                                {{ number_format(($discountprice), 2, '.', '') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            @if (data_get($value,'promotion.0.percent') != null)
                                {{  date('d-m-Y', strtotime(data_get($value, 'promotion.0.start_date'))) }} 
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            @if (data_get($value,'promotion.0.percent') != null)
                                {{  date('d-m-Y', strtotime(data_get($value, 'promotion.0.end_date'))) }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-left">
                            @if (data_get($value,'promotion.0.percent') != null)
                                <strong>{{ data_get($value, 'promotion.0.title') }}</strong> - {{ data_get($value, 'promotion.0.desc') }}
                            @else
                                -
                            @endif
                        </td>
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