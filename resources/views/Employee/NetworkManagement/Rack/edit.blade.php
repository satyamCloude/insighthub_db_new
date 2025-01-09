@extends('layouts.admin')
@section('title', 'Create')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Rack /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Rack/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Rack/update/'.$Rack->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                  <div class="col-md-6">
                      <label for="customer_id" class="form-label">Customer Name <span class="text-danger">*</span></label>
                      <select class="form-control" name="customer_id">                 
                          @foreach($client as $clients)
                              <option @if($Rack && $Rack->customer_id == $clients->id) selected @endif  value="{{$clients->id}}">{{$clients->first_name}}</option>   
                          @endforeach                                           
                      </select>
                  </div>
                  <div class="col-md-6">
                      <label for="vendor_id" class="form-label">Vendor Name <span class="text-danger">*</span></label>
                      <select class="form-control" name="vendor_id">                      
                          @foreach($Vendor as $Vend)
                              <option @if($Rack && $Rack->vendor_id == $Vend->id) selected @endif  value="{{$Vend->id}}">{{$Vend->first_name}}</option>   
                          @endforeach   
                      </select>
                  </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="rack_id" class="form-label">Rack ID <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" @if($Rack && $Rack->rack_id) value="{{$Rack->rack_id}}" @endif  name="rack_id" placeholder="Enter RacK No."/>
                </div>
                <div class="col-md-6">
                      <label for="rack_power_unit" class="form-label">Rack Power Unit <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" @if($Rack && $Rack->rack_power_unit) value="{{$Rack->rack_power_unit}}" @endif  name="rack_power_unit" placeholder="Enter Rack Power Unit"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="rack_bandwidth" class="form-label">Rack Bandwidth <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($Rack && $Rack->rack_bandwidth) value="{{$Rack->rack_bandwidth}}" @endif  name="rack_bandwidth" placeholder="Enter Rack Bandwidth"/>
                </div>
                <div class="col-md-6">
                      <label for="rack_capacity" class="form-label">Rack Capacity U <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" @if($Rack && $Rack->rack_capacity) value="{{$Rack->rack_capacity}}" @endif  name="rack_capacity" placeholder="Enter Rack Capacity U"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="dc_floor" class="form-label">DC Floor <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($Rack && $Rack->dc_floor) value="{{$Rack->dc_floor}}" @endif  name="dc_floor" placeholder="Enter DC Floor"/>
                </div>
                <div class="col-md-6">
                      <label for="dc_area_zone" class="form-label">DC Area Zone <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" @if($Rack && $Rack->dc_area_zone) value="{{$Rack->dc_area_zone}}" @endif  name="dc_area_zone" placeholder="Enter DC Area Zone"/>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Admin Notes</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="dc_area_zone" class="form-label">status <span class="text-danger">*</span></label>
                      <select class="form-control" name="status">
                        <option @if($Rack && $Rack->status == '1') selected @endif value="1">Active</option>
                        <option @if($Rack && $Rack->status == '2') selected @endif value="2">Suspended</option>
                        <option @if($Rack && $Rack->status == '3') selected @endif value="3">Terminated</option>
                      </select>
                </div>
               <div class="col-md-12">
                      <label for="rack_note" class="form-label">Rack Notes <span class="text-danger">*</span></label>
                       <div class="editor-container">
                            <div class="full-editor geteditor"> @if($Rack && $Rack->rack_note) {!! $Rack->rack_note !!} @endif </div>
                            <input type="hidden" name="rack_note" @if($Rack && $Rack->rack_note) value="{{$Rack->rack_note}}" @endif  class="hidden-field">
                        </div>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">3. Rack Unit Info</h5>
              @foreach($rack_unit as $racka)
              <div class="row mb-4"> 
                <div class="col-md-4">
                      <label for="unit_no" class="form-label">#Unit No. </label>
                      <input type="text" class="form-control" readonly @if($racka && $racka->unit_no) value="{{$racka->unit_no}}" @endif  name="unit_no[]"/>
                </div>
                <div class="col-md-4">
                      <label for="serial_no" class="form-label">Serial No </label>
                      <input type="text" class="form-control" @if($racka && $racka->serial_no) value="{{$racka->serial_no}}" @endif  name="serial_no[]"/>
                </div>
                <div class="col-md-4">
                      <label for="serial_tag" class="form-label">Serial Tag </label>
                      <input type="text" class="form-control" @if($racka && $racka->serial_tag) value="{{$racka->serial_tag}}" @endif  name="serial_tag[]"/>
                </div>
              </div>
              @endforeach      
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Rack/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
