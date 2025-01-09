@extends('layouts.admin')
@section('title', 'Update')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
   <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leads /</span> Update</h4>
   <!-- Sticky Actions -->
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
               <h5 class="card-title mb-sm-0 me-2">Update Detail's</h5>
               <div class="action-btns">
                  <a href="{{url('admin/Category/home')}}" class="btn btn-label-primary me-3">
                  <span class="align-middle"> Back</span>
                  </a>
               </div>
            </div>
            <form action="{{url('admin/Category/update/'.$id)}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="card-body">
                  <h5 class="mb-4">1. General Details</h5>
                  <div class="col-md-6">
                     <label for="category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                     <input type="text" id="category_name1" class="form-control" @if($Category && $Category->category_name) value="{{ $Category->category_name }}" @endif name="category_name" placeholder="Enter Category Name">
                  </div>
                  <br>
                  <div class="row mb-4">
                     <div class="col-md-6">
                        <label for="url" class="form-label">Url</label>
                        <input type="text" readonly id="url1" class="form-control" @if($Category && $Category->url) value="{{ $Category->url }}" @endif name="url" placeholder="https://www.google.com/">
                     </div>
                     <div class="col-md-6">
                        <label for="tag_line" class="form-label">Category Tag Line <span class="text-danger">*</span></label>
                        <input type="text" id="tag_line" class="form-control" @if($Category && $Category->tag_line) value="{{$Category->tag_line }}" @endif name="tag_line" placeholder="Tag Line">
                     </div>
                     <div class="col-md-6">
                        <label for="status"class="form-label"><input type="checkbox" @if($Category && $Category->status == '1') checked @endif name="status" />&nbsp;&nbsp;Check if this is a hidden group</label>
                     </div>
                  </div>
               </div>
         </div>
         <div class="card-footer">
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