@extends('layouts.admin')
@section('title', 'Log activity')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  
 <div class="Logscreen">
                            <div class="row">
                              <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                <div class="card mb-4">
                                  <h5 class="card-header">Log activity</h5>
                                  @if(Auth::user()->status == 4)
            <script>
              $(document).ready(function(){
                // alert('Your are not allowed to perform this action. first complete your profile');
                var id = {{Auth::user()->id}};
                $.ajax({
        url: "{{url('user/MyProfile/edit')}}",
        method: 'GET',
        data: { id: id },
        success: function (data) {
            if (data && typeof data == 'string') {
                $('#showedit').html(data);
                $('#showedit').modal('show');
            } else {
                $('#showedit').html('<div>No Data Found</div>');
                $('#showedit').modal('show');
            }
        },
        error: function () {
            $('#showedit .modal-content').html('<div>Error fetching data.</div>');
            $('#showedit').modal('show');
        }
    });
              });
            </script>
              @endif
                                    <div class="card-body">
                                                <div class="table-responsive">
                                                  <table class="table border-top">
                                                      <thead>
                                                        <tr>
                                                          <th class="text-truncate">Browser</th>
                                                          <th class="text-truncate">IP Address</th>
                                                          <th class="text-truncate">Last Login</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                              <tr>
                                                  <td class="text-truncate">
                                                      <i class="ti ti-brand-windows text-info ti-xs me-2"></i>
                                                      <span class="fw-medium">{{ $LastloginLogActivity->browser }}</span>
                                                  </td>                                   
                                                  <td class="text-truncate">{{ $LastloginLogActivity->ip }}</td>
                                                  <td class="text-truncate">{{ $LastloginLogActivity->created_at->format('d, F Y H:i') }}</td>
                                              </tr>
                                                      
                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div>
                                </div>
                              </div>
                            </div>
  </div>
</div>
@if(Auth::user()->status == 4)
<div class="modal fade show" id="showedit" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog" style="display: block;">
</div>
@endif
@endsection

