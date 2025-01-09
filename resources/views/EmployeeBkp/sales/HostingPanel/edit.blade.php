@extends('layouts.admin')
@section('title', 'Edit')
@section('content')

<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Hosting /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/HostingPanel/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/HostingPanel/update/'.$id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row">
               <div class="col-md-6">
                      <label for="hosting_name" class="form-label">Hosting Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($data && $data->hosting_name) value="{{ $data->hosting_name }}" @endif name="hosting_name" placeholder="Hosting name name" required/>
               </div>
               <div class="col-md-6 ">

                      <label for="currency_id" class="form-label">Currency<span class="text-danger">*</span></label>
                      <select class="form-control select2 height-35 f-15" name="currency_id" id="currencies">
                        @foreach($currencies as $currencies)
                        <option @if($data && $data->currency_id == $currencies->id) selected @endif value="1">{{$currencies->code}} ({{$currencies->prefix}})</option>
                        @endforeach
                     </select>
                         
                         
                      
                </div></div><br>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="price" class="form-label">Price<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($data && $data->price) value="{{ $data->price }}" @endif name="price" placeholder="hosting price" required/>
                </div>
                <!-- <div class="col-md-6">
                      <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($data && $data->status) value="{{ $data->status }}" @endif name="status" placeholder="hosting status" required/>
                </div> -->
                
                <div class="col-md-6">
                      <label for="plan_type" class="form-label">Plan Type<span class="text-danger">*</span></label>
                      <select name="plan_type" class="form-control select2">
                            <option>Select Plan</option>
                            <option @if($data && $data->plan_type == "1") selected @endif value="1"> Monthly</option>
                            <option @if($data && $data->plan_type == "2") selected @endif value="2"> Yearly.</option>
                          </select>
                </div>
               

                </div>
                 <!-- <div class="col-md-6">
                        <label for="status"class="form-label"><input type="checkbox" name="status">&nbsp;&nbsp;Check if this is a hidden group</label>
                     </div> -->
              </div>
                   
            </div>
            <div class="card-footer mt-3">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/HostingPanel/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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