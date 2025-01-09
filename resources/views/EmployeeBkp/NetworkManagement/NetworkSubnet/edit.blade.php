@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">NetworkSubnet /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/NetworkSubnet/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/NetworkSubnet/update/'.$NetworkSubnet->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="network_subnet" class="form-label">Network Subnet <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="network_subnet" @if($NetworkSubnet && $NetworkSubnet->network_subnet) value="{{$NetworkSubnet->network_subnet}}" @endif placeholder="Enter Network Subnet" required/>
                </div>
                <div class="col-md-6">
                      <label for="subnet_mask" class="form-label">Subnet Mask <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="subnet_mask" @if($NetworkSubnet && $NetworkSubnet->subnet_mask) value="{{$NetworkSubnet->subnet_mask}}" @endif placeholder="Enter VLAN" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="vlan" class="form-label">VLAN <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="vlan" @if($NetworkSubnet && $NetworkSubnet->vlan) value="{{$NetworkSubnet->vlan}}" @endif placeholder="Enter VLAN" required/>
                </div>
                <div class="col-md-6">
                      <label for="gateway" class="form-label">Gateway <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="gateway" @if($NetworkSubnet && $NetworkSubnet->gateway) value="{{$NetworkSubnet->gateway}}" @endif placeholder="Enter Gateway" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="primary_name_server" class="form-label">Primary Name Server <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="primary_name_server" @if($NetworkSubnet && $NetworkSubnet->primary_name_server) value="{{$NetworkSubnet->primary_name_server}}" @endif placeholder="Enter Primary Name Server" required/>
                </div>
                <div class="col-md-6">
                      <label for="secondary_name_server" class="form-label">Secondary Name Server<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="secondary_name_server" @if($NetworkSubnet && $NetworkSubnet->secondary_name_server) value="{{$NetworkSubnet->secondary_name_server}}" @endif placeholder="Enter Secondary Name Server" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="dc_location_id" class="form-label">DC Location <span class="text-danger">*</span></label>
                      <select class="form-control" name="dc_location_id" required>                                           
                        @foreach($Countrys as $Count)
                        <option @if($NetworkSubnet && $NetworkSubnet->dc_location_id == $Count->country_id) selected @endif value="{{$Count->country_id}}">{{$Count->country_name}}</option>                                         
                        @endforeach
                      </select>
                </div>
                <div class="col-md-6">
                      <label for="ip_type" class="form-label">IP Type <span class="text-danger">*</span></label>
                      <select class="form-control" name="ip_type"  required>                  
                        <option @if($NetworkSubnet && $NetworkSubnet->ip_type == '1') selected @endif value="1">Public</option>                         
                        <option @if($NetworkSubnet && $NetworkSubnet->ip_type == '2') selected @endif value="2">Private</option>                         
                      </select>
                </div>
              </div> 
               <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                       <div class="editor-container">
                            <div class="full-editor geteditor">@if($NetworkSubnet && $NetworkSubnet->description) {{$NetworkSubnet->description}} @endif</div>
                            <input type="hidden" name="description" @if($NetworkSubnet && $NetworkSubnet->description) value="{{$NetworkSubnet->description}}" @endif  class="hidden-field">
                        </div>
                </div>
            </div>     
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/NetworkSubnet/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
<script>
  $(document).ready(function () {
    // Function to update the hidden field based on the editor content
    function updateHiddenField(index) {
      var editorContentText = $(".full-editor.geteditor").eq(index).html();
      console.log("Editor " + (index + 1) + " Text content: " + editorContentText);

      // Update the value of the hidden field based on the index
      $('.hidden-field').eq(index).val(editorContentText);
    }

    // Use event delegation to handle keyup and blur on any .full-editor.geteditor
    $(document).on('keyup blur', '.full-editor.geteditor', function () {
      // Get the index of the editor
      var index = $(".full-editor.geteditor").index(this);

      // Update the corresponding hidden field
      updateHiddenField(index);
    });
  });
</script>
@endsection