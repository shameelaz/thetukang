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
    <h5 class="header-style m-0">WELCOME {{ $user->name}} !</h5>
  </div>
</div>

<div class="container my-3">
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
            <h6 class="text-muted text-uppercase">NEW</h6>
            <h2 class="m-0">
              {{ $statusNew }}
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
              <i class="ri-close-line"></i>
            </div>
          </div>
          <div class="col-9">
            <h6 class="text-muted text-uppercase">REJECTED</h6>
            <h2 class="m-0">
              {{ $statusRejected }}
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
              <i class="ri-check-double-line"></i>
            </div>
          </div>
          <div class="col-9">
            <h6 class="text-muted text-uppercase">COMPLETED</h6>
            <h2 class="m-0">
              {{ $statusSuccess }}
            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container my-5">

  <div class="card style-border">
      <div class="card-header">
          <!-- Senarai Perkhidmatan Handyman -->
          <div class="gap-2">
              <div style="float: left">
                  <h6 class="mt-2 float-left">BOOKING STATUS</h6>
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
                          <table id="agencylist" class="table table-bordered table-striped mt-2" style="width:100%;font-size: 12px; vertical-align: middle;">
                              <thead class="table-dark">
                                  <tr>
                                      <th style="text-align: center;">&nbsp;</th>
                                      <th style="text-align: center;">TITLE</th>
                                      <th style="text-align: center;">DESCRIPTION</th>
                                      <th style="text-align: center;">DATE</th>
                                      <th style="text-align: center;">PRICE (RM)</th>
                                      <th style="text-align: center;">STATUS</th>
                                      <th style="text-align: center;"></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php $bil = 1; ?>
                                  @foreach ($srv as $key => $value)
                                      <tr>
                                        <td class="text-center">{{ $bil++}}</td>
                                        <td class="text-center">{{ data_get($value,'title')}}</td>
                                        <td class="text-left">{{ data_get($value,'desc')}}</td>
                                        <td class="text-center">{{ date('d-m-Y', strtotime(data_get($value,'date_booking')))}}</td>
                                        <td class="text-center">
                                            @if (data_get($value,'discount_price') != null)
                                              {{ number_format(data_get($value,'discount_price'), 2, '.', ',') }} 
                                            @else
                                              {{ number_format(data_get($value,'mainservice.price'), 2, '.', ',') }} 
                                            @endif
                                        </td>
                                        <td class="text-center">
                                          @if (data_get($value,'status') == 1)
                                              New                                             
                                          @elseif (data_get($value,'status') == 3)
                                              Rejected
                                          @else
                                              Completed
                                          @endif
                                        </td>
                                        <td class="text-center">
                                          @if (data_get($value,'status') == 1)
                                              <a href="/handyman/booking/edit/{{$value->id}}/1" class="btn btn-primary">Approve <i class="ri-arrow-right-line"></i></a>     
                                              <a href="/handyman/booking/edit/{{$value->id}}/2" class="btn btn-danger">Reject <i class="ri-close-line"></i></a>                                            
                                          @elseif (data_get($value,'status') == 3)
                                              <button class="btn btn-danger" disabled>Rejected <i class="ri-close-line"></i></button>
                                          @else
                                              <button class="btn btn-success" disabled>Success <i class="ri-check-double-line"></i></button>
                                          @endif
                                          
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
  </div>

</div>

</div>
@endsection

@push('script')
<script type="text/javascript">
  
  $(document).ready(function(){
      $('#agencylist').DataTable({
          "responsive": true,
          "scrollY": true,
          "scrollX": true,
          "ordering": false,
          "info": true,
          'iDisplayLength': 5,
          "lengthMenu": [
              [25, 50,100,250, -1],
              [25, 50,100,250, "All"]
          ],
      });
  });

</script>
@endpush
