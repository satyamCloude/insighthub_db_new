@extends('layouts.admin')
@section('title', 'Balance Sheet')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
  
 <div class="Logscreen">
                            <div class="row">
                              <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                <div class="card mb-4">
                                  <h5 class="card-header">Balance Sheet</h5>
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
                                                 
                                              </div>
                                          </div>
                                </div>
                              </div>
                            </div>
  </div>
</div>
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog"></div>
@endsection