@extends('layouts.admin')
@section('title', 'Role')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Role /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/Role/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/Role/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="name" class="form-label"><h5>Name <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="name" />
                </div>
                <div class="col-md-6">
                      <label for="status" class="form-label"><h5>Status <span class="text-danger">*</span></h5></label>
                      <select name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="2">In Active</option>
                    </select>
                </div>
            </div>
              <hr>
              <h5 class="mb-4">2. Permission</h5>
                <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                    <thead class="bg-dark">
                        <tr>
                            <th class="text-white">ID</th>
                            <th class="text-white">Guard Name</th>
                            <th class="text-white">NAME</th>
                            <th class="text-white">
                                <div class="form-check form-check-info">
                                    <input class="form-check-input" name="id" value="all" type="checkbox" id="customCheckDark">
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Permission as $key=> $Per)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$Per->guard_name}}</td>
                            <td>{{$Per->name}}</td>
                            <td>
                                <div class="form-check form-check-dark">
                                    <input class="form-check-input" name="id[]" value="{{$Per->id}}" type="checkbox" id="customCheckDark{{$key}}">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/Role/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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