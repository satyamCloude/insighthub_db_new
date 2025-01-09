@extends('layouts.admin')
@section('title', 'Attendence')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Attendence /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Attendence/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Attendence/update/'.$Attendence->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="email" class="form-label">Employee Name <span class="text-danger">*</span></label>
                      <select class="form-control" name="emp_Id" >
                        @foreach($Employee as $emp)
                        <option @if(isset($Attendence) && $Attendence->assign_emp_id == $emp->id) selected @endif  value="{{$emp->id}}">{{$emp->first_name}}</option>
                        @endforeach
                      </select>
                </div>
                <div class="col-md-6">
                      <label for="name" class="form-label">Punch Date <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" name="punch_date"  @if(isset($Attendence) && $Attendence->punch_date) value="{{ $Attendence->punch_date }}" @endif  required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="name" class="form-label">Punch In <span class="text-danger">*</span></label>
                      <input type="time" class="form-control" name="punch_in"  @if(isset($Attendence) && $Attendence->punch_in) value="{{ $Attendence->punch_in }}" @endif  required/>
                </div>
                <div class="col-md-6">
                      <label for="name" class="form-label">Punch Out <span class="text-danger">*</span></label>
                      <input type="time" class="form-control" name="punch_out"  @if(isset($Attendence) && $Attendence->punch_out) value="{{ $Attendence->punch_out }}" @endif  required/>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Attendence/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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