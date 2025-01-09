@extends('layouts.admin')
@section('title', 'Job Role')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Job Role /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/JobRole/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          @if (Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}</p>
          @endif

          @if (Session::has('error'))
            <p class="alert alert-danger">{{ Session::get('error') }}</p>
          @endif

          <!-- Display validation errors -->
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form action="{{url('admin/JobRole/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="name" class="form-label">Job Role Name <span class="text-danger">*</span></label>
                      <input type="name" class="form-control" name="name" placeholder="Job Role Name" required/>
                </div>
                <div class="col-md-6">
                      <label for="email" class="form-label">Employee Name (optional)</label>
                      <select class="form-control select2" name="assign_emp_id[]" multiple >
                        @foreach($Employee as $emp)
                        <option value="{{$emp->id}}">{{$emp->first_name}}</option>
                        @endforeach
                      </select>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/JobRole/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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