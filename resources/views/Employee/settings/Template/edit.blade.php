@extends('layouts.admin')
@section('title', 'Template')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Template /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Template/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Template/update/'.$Template->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-4">
                      <label for="name" class="form-label"><h5>Template name <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="name" @if($Template && $Template->name) value="{{$Template->name}}" @endif />
                </div>
                <div class="col-md-4">
                      <label for="subject" class="form-label"><h5>Subject <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="subject" @if($Template && $Template->subject) value="{{$Template->subject}}" @endif />
                </div>
                <div class="col-md-4">
                      <label for="status" class="form-label"><h5>Status <span class="text-danger">*</span></h5></label>
                      <select name="status" class="form-select">
                            <option @if($Template && $Template->status == '1') selected @endif value="1">Active</option>
                            <option @if($Template && $Template->status == '2') selected @endif value="2">In Active</option>
                    </select>
                </div>
              </div>
             <div class="row mb-4"> 
                <div class="col-12">
                      <label for="template" class="form-label"><h5>Template Header<span class="text-danger">*</span></h5></label>
                        <textarea type="text" name="template" class="form-control">@if($Template && $Template->template) {!!$Template->template!!} @endif </textarea>
                </div>
             </div>
             <div class="row mb-4"> 
                <div class="col-12">
                      <label for="template" class="form-label"><h5>Template Footer<span class="text-danger">*</span></h5></label>
                        <textarea type="text" name="template2" class="form-control">@if($Template && $Template->template2) {!!$Template->template2!!} @endif </textarea>
                </div>
             </div>

            
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Template/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<script>
 CKEDITOR.replace( 'template' );
 CKEDITOR.replace( 'template2' );
</script>
@endsection