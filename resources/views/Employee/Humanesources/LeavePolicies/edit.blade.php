@extends('layouts.admin')
@section('title', 'LeavePolicies')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">LeavePolicies /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/LeavePolicies/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/LeavePolicies/update/'.$LeavePolicies->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="title"  class="form-label">Title</label>
                      <input type="text" class="form-control" @if($LeavePolicies && $LeavePolicies->title) value="{{$LeavePolicies->title}}" @endif name="title" required>
                </div>
                <div class="col-md-6">
                      <label for="effective_date"  class="form-label">Effective Date</label>
                      <input type="date" class="form-control" @if($LeavePolicies && $LeavePolicies->effective_date) value="{{$LeavePolicies->effective_date}}" @endif name="effective_date" required>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for=""  class="form-label">Policies</label>
                      <div class="editor-container">
                                    <div class="full-editor geteditor">@if($LeavePolicies && $LeavePolicies->policies) {!!$LeavePolicies->policies!!} @endif</div>
                                    <input type="hidden" name="policies" @if($LeavePolicies && $LeavePolicies->policies) value="{{$LeavePolicies->policies}}" @endif class="hidden-field">
                                </div>
                </div>
              </div>     
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/LeavePolicies/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
@endsection