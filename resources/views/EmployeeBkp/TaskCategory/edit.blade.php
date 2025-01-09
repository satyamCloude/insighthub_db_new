@extends('layouts.admin')
@section('title', 'Task Category')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Task Category /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/TaskCategory/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
         <form action="{{ url('Employee/TaskCategory/update/'.$id) }}" method="post" enctype="multipart/form-data">
             @csrf
            <div class="card-body">
              <h5 class="mb-4">1. Task Category</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="Task_name" class="form-label">Task Category Name  <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="category_name" @if($TaskCategory && $TaskCategory->category_name) value="{{$TaskCategory->category_name}}" @endif required/>
                </div>
             
            </div>
          </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/TaskCategory/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div>
    <!-- /Sticky Actions -->
  </div>


@endsection