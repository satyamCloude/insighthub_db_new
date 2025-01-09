@extends('layouts.admin')
@section('title', 'Department')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Department /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/Department/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/Department/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <!-- <div class="col-md-6"> -->
                      <!-- <label for="company_id" class="form-label">Company name <span class="text-danger">*</span></label> -->
                      <!-- <select class="form-select waves-effect" name="company_id">
                        @foreach($CompanyLogin as $Company)
                        <option value="{{$Company->id}}">{{$Company->company_name}}</option>
                        @endforeach
                      </select> -->

                <!-- </div> -->
                <div class="col-md-6"></div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                  <input type="hidden" name="company_id" value="1">
                      <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                      <input type="name" class="form-control" name="name" placeholder="Department Name" required/>
                </div>
                <div class="col-md-6">
                      <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" name="email" placeholder="department@gmail.com" required/>
                </div>
                <div class="col-md-6 mt-2">
                      <input type="checkbox"  name="allow_for_ticket" />
                      <label for="email" class="form-label">&nbsp;Allow For Ticket</label>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/Department/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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