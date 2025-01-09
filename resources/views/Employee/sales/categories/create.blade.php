@extends('layouts.admin')
@section('title', 'Create')
@section('content')

<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leads/</span>Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/Category/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/Category/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
               <div class="col-md-6">
                      <label for="category_name" class="form-label">Category Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="category_name" placeholder="Category name" required/>
                </div><br>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="url" class="form-label">Category URL<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="url" placeholder="url" required/>
                </div>
               

                </div>
                 <div class="col-md-6">
                        <label for="status"class="form-label"><input type="checkbox" name="status">&nbsp;&nbsp;Check if this is a hidden group</label>
                     </div>
              </div>
                   
            </div>
            <div class="card-footer mt-3">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/Categories/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection