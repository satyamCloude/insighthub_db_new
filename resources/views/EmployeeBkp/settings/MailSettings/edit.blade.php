@extends('layouts.admin')
@section('title', 'Security')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Security /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Security/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Security/update/'.$Security->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="User_ip_address" class="form-label"><h5>User IP Address <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" @if($Security && $Security->User_ip_address) value="{{$Security->User_ip_address}}" @endif name="User_ip_address" />
                </div>
                <div class="col-md-6">
                      <label for="status" class="form-label"><h5>Status <span class="text-danger">*</span></h5></label>
                      <select name="status" class="form-select">
                            <option @if($Security && $Security->status == '1') selected @endif value="1">Active</option>
                            <option @if($Security && $Security->status == '2') selected @endif value="2">In Active</option>
                    </select>
                </div>
            </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Security/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div>
    <!-- /Sticky Actions -->
  </div>
  <!-- JavaScript to handle checkbox selection -->
<script>
    $(document).ready(function () {
        $('#customCheckDark').change(function () {
            var isChecked = $(this).prop('checked');
            $('input[name="id[]"]').prop('checked', isChecked);
        });

        $('input[name="id[]"]').change(function () {
            if (!$(this).prop('checked')) {
                $('#customCheckDark').prop('checked', false);
            } else {
                // Check if all checkboxes are checked
                if ($('input[name="id[]"]:checked').length === $('input[name="id[]"]').length) {
                    $('#customCheckDark').prop('checked', true);
                }
            }
        });
    });
</script>
@endsection