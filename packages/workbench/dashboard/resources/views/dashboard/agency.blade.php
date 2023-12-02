<!-- extends('laravolt::elip.layouts.base') -->
@extends('web::perakepay.frontend.layouts.base')
@section('content')

<style type="text/css">
  .pos-dropdown__dropdown-menu.dropdown-menu.show {
    width: 50% !important;
    /*transform: translate(651px, 1020px) !important*/
  }
</style>

<div class="bg-light py-4">
  <div class="container">
    <h5 class="header-style m-0">DASHBOARD HANDYMAN</h5>
  </div>
</div>

<div class="container my-5">
  <h5>Welcome !</h5>
  <div class="row mt-4">
    <div class="col-md-4">
      <div class="box-widget stats-info">
        <div class="row align-items-center">
          <div class="col-3">
            <div class="icon">
              <i class="ri-user-2-line"></i>
            </div>
          </div>
          <div class="col-9">
            <h6 class="text-muted text-uppercase">JOB</h6>
            <h2 class="m-0">
                {{ $account }}
            </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="box-widget stats-success">
        <div class="row align-items-center">
          <div class="col-3">
            <div class="icon">
              <i class="ri-user-2-line"></i>
            </div>
          </div>
          <div class="col-9">
            <h6 class="text-muted text-uppercase">ONGOING</h6>
            <h2 class="m-0">
                {{ $payment }}
            </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="box-widget stats-danger">
        <div class="row align-items-center">
          <div class="col-3">
            <div class="icon">
              <i class="ri-user-2-line"></i>
            </div>
          </div>
          <div class="col-9">
            <h6 class="text-muted text-uppercase">COMPLETED</h6>
            <h2 class="m-0">
                {{ $nopayment }}
            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="container">

  <div class="card style-border">
      <div class="card-header">
          <!-- Senarai Perkhidmatan Handyman -->
          <div class="gap-2">
              <div style="float: left">
                  <h6 class="mt-2 float-left">Notification</h6>
              </div>
              {{-- <div style="float: right">

                  <a href="/handyman/service/add"
                      class="btn btn-primary me-md-2 float-right">Add</a>
              </div> --}}
          </div>

      </div>
      <div id="div-list-result">
          <div class="card-body ">

              <div class="row g-2">
                  <div class="col-md-12 col-lg-12">

                      <div class="table-responsive">
                          <table id="data-table-kodhasil" class="table mt-2" style="width:100%;font-size: 12px;">
                              <thead class="table-dark">
                                  <tr>
                                      <th style="text-align: center;">&nbsp;</th>
                                      <th style="text-align: center;">Services</th>
                                      <th style="text-align: center;">Description</th>
                                      <th style="text-align: center;">Price</th>
                                      <th style="text-align: center;">Location</th>
                                      <th style="text-align: center;">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  {{-- <?php $bil = 1; ?>
                                  @foreach ($srv as $key => $value)
                                      <tr>
                                          <td class="text-center">{{ $bil++ }}</td>
                                          <td class="text-center">{{ data_get($value, 'lkpservicetype.name') }}</td>
                                          <td class="text-center">{{ data_get($value, 'desc') }}</td>
                                          <td class="text-center">{{ data_get($value, 'price') }}</td>
                                          <td class="text-center">{{ data_get($value, 'location') }}</td>
                                          <td class="text-center">
                                              <a href="/handyman/service/edit/{{ $value->id }}"
                                                  class="btn btn-primary mr-1 mb-2" title="Update">
                                                  <i class="ri-edit-line"></i></a>
                                                  <a href="/handyman/service/delete/{{ $value->id }}"
                                                      class="btn btn-primary mr-1 mb-2" title="Delete">
                                                      <i class="ri-delete-bin-line"></i></a>
                                          </td>
                                      </tr>
                                  @endforeach --}}
                              </tbody>
                          </table>
                      </div>


                  </div>
              </div>

          </div>
      </div>
  </div>

</div>

</div>
@endsection
@push('script')
<script type="text/javascript">
  
</script>
@endpush
