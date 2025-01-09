@extends('layouts.admin')
@section('title', 'Create')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">File /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/File/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
           <form action="{{ url('admin/File/store') }}" method="post" enctype="multipart/form-data">  
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-4">
                      <label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label>
                      <select name="employee_id[]" class="form-select" required>
                            @foreach($Employee as $Emp)
                            <option value="{{$Emp->id}}">{{$Emp->first_name}}</option>
                            @endforeach
                          </select>
                </div>
                <div class="col-md-4">
                      <label for="document_name" class="form-label">Document Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="document_name[]" required/>
                </div>
                <div class="col-md-3">
                    <label for="document" class="form-label">Documents <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="documents[]" multiple required/>
                </div>
                <div class="col-md-1">
                      <button type="button" onclick="addmoredoc()" class="btn-label-primary mt-4 p-1" >Add</button>
                </div>
              </div>
              <div id="appended"></div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/File/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
<!-- / Content -->
<script type="text/javascript">
    function addmoredoc() {
        $('#appended').append('<div class="row mb-4">'+ 
                '<div class="col-md-4">'+
                      '<label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label>'+
                      '<select name="employee_id[]" class="form-select" required>'+
                            '@foreach($Employee as $Emp)'+
                            '<option value="{{$Emp->id}}">{{$Emp->first_name}}</option>'+
                            '@endforeach'+
                          '</select>'+
                '</div>'+
                '<div class="col-md-4">'+
                      '<label for="document_name" class="form-label">Document Name <span class="text-danger">*</span></label>'+
                      '<input type="text" class="form-control" name="document_name[]" required/>'+
                '</div>'+
                '<div class="col-md-3">'+
                      '<label for="documents" class="form-label">Documents <span class="text-danger">*</span></label>'+
                      '<input type="file" class="form-control" name="documents[]" multiple required/>'+
                '</div>'+
                '<div class="col-md-1">'+
                      '<button type="button" onclick="removemoredoc(this)" class="btn-label-danger mt-4 p-1" >Remove</button>'+
                '</div>'+
              '</div>')
    }

    function removemoredoc(element) {
        // Get the parent element (row) and remove it
        $(element).closest('.row').remove();
    }
</script>
@endsection