@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">File /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/File/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/File/update/'.$File->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-4">
                      <label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label>
                      <select name="employee_id" class="form-select" required>
                            @foreach($Employee as $Emp)
                            <option @if($File && $File->employee_id == $Emp->id) selected @endif value="{{$Emp->id}}">{{$Emp->first_name}}</option>
                            @endforeach
                          </select>
                </div>
                <div class="col-md-4">
                      <label for="document_name" class="form-label">Document Name <span class="text-danger">*</span></label>
                      <input type="text"  @if($File && $File->document_name) value="{{$File->document_name}}" @endif class="form-control" name="document_name" required/>
                </div>
                <div class="col-md-1">
                    <div class="avatar me-2 mt-4"><img  src="{{$File->documents}}" alt="Avatar" class="rounded-circle"></div>
                </div>
                <div class="col-md-3">
                      <label for="documents" class="form-label">Document <span class="text-danger">*</span></label>
                      <input type="file" class="form-control" name="documents"/>
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
@endsection