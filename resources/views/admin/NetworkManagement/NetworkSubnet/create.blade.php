@extends('layouts.admin')
@section('title', 'Create')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">NetworkSubnet /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/NetworkSubnet/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/NetworkSubnet/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                  <div class="col-md-6">
                      <label for="network_subnet" class="form-label">Network Subnet <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="network_subnet" id="network_subnet" placeholder="Enter Network Subnet" required/>
                  </div>
                  <div class="col-md-6">
                      <label for="subnet_mask" class="form-label">Subnet Mask <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="subnet_mask" id="subnet_mask" placeholder="Subnet Mask" readonly/>
                      <div class="col-md-12">
                      <div id="range_label"></div>
                      <input type="hidden" name="range1" id="range1">
                      <input type="hidden" name="range2" id="range2">
                  </div>
                  </div>
                  
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="vlan" class="form-label">VLAN <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="vlan" placeholder="Enter VLAN" required/>
                </div>
                <div class="col-md-6">
                      <label for="gateway" class="form-label">Gateway <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="gateway" placeholder="Enter Gateway" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="primary_name_server" class="form-label">Primary Name Server <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="primary_name_server" placeholder="Enter Primary Name Server" required/>
                </div>
                <div class="col-md-6">
                      <label for="secondary_name_server" class="form-label">Secondary Name Server<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="secondary_name_server" placeholder="Enter Secondary Name Server" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="dc_location_id" class="form-label">DC Location <span class="text-danger">*</span></label>
                      <select class="form-control" name="dc_location_id" required>                                        
                        @foreach($Countrys as $Count)
                        <option value="{{$Count->country_id}}">{{$Count->country_name}}</option>                                              
                        @endforeach
                      </select>
                </div>
                <div class="col-md-6">
                      <label for="ip_type" class="form-label">IP Type <span class="text-danger">*</span></label>
                      <select class="form-control" name="ip_type" required>                        
                        <option value="1">Public</option>                         
                        <option value="2">Private</option>                         
                      </select>
                </div>
              </div> 
              <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                       <div class="editor-container">
                            <div class="full-editor geteditor"></div>
                            <input type="hidden" name="description" class="hidden-field">
                        </div>
                </div>
            </div>     
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/NetworkSubnet/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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

   $(document).ready(function() {
        $('#network_subnet').on('input', function() {
            var cidr = $(this).val();
            var subnetData = calculateSubnet(cidr);
            $('#subnet_mask').val(subnetData.mask);
            $('#range_label').text('Range: ' + subnetData.range);
        });

        function calculateSubnet(cidr) {
            var parts = cidr.split('/');
            var network = parts[0];
            var subnetMaskLength = parseInt(parts[1]);

            var subnetMask = (0xffffffff << (32 - subnetMaskLength)) >>> 0;

            var networkLong = ipToLong(network);
            var firstIP = networkLong & subnetMask;
            var lastIP = firstIP | (~subnetMask >>> 0);

             

            var firstIPStr = longToIP(firstIP);
            var lastIPStr = longToIP(lastIP);

            $('#range1').val(firstIPStr);
              $('#range2').val(lastIPStr);

            return {
                mask: longToIP(subnetMask),
                range: firstIPStr + ' - ' + lastIPStr
            };
        }

        function ipToLong(ip) {
            return ip.split('.').reduce(function(res, item) {
                return (res << 8) + parseInt(item, 10);
            }, 0);
        }

        function longToIP(long) {
            return [
                (long >>> 24) & 0xFF,
                (long >>> 16) & 0xFF,
                (long >>> 8) & 0xFF,
                long & 0xFF
            ].join('.');
        }
    });
</script>
@endsection