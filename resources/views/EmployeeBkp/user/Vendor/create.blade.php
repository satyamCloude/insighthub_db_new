@extends('layouts.admin')
@section('title', '')
@section('content')
<style>
 .avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 50px auto;
}

.avatar-upload .avatar-edit {
    position: absolute;
    right: 12px;
    z-index: 1;
    top: 10px;
}

.avatar-upload .avatar-edit input {
    display: none;
}

.avatar-upload .avatar-edit label {
    display: inline-block;
    width: 34px;
    height: 34px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #ffffff;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
}

.avatar-upload .avatar-edit label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
}

.avatar-upload .avatar-edit label:after {
    content: "\f040";
    font-family: "FontAwesome";
    color: #757575;
    position: absolute;
    top: 10px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
}

.avatar-upload .avatar-preview {
    width: 192px;
    height: 192px;
    position: relative;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}

.avatar-upload .avatar-preview > div {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

</style>
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Vendor /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Vendor/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Vendor/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. Company Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                                <label for="company_id" class="form-label">Company Name</label>
                                <select class="form-select" name="company_id" required>
                                  @foreach($Company as $Company)
                                    <option value="{{$Company->id}}">{{$Company->company_name}}</option>
                                  @endforeach  
                                </select>
                          </div>
                <div class="col-md-6">
                      <label for="vendor_name" class="form-label">Vendor Name <span class="text-danger">*</span></label>
                      <input type="vendor_name" class="form-control" name="first_name" placeholder="ABC Back" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" name="email" placeholder="name@example.com" required/>
                </div>
                <div class="col-md-6">
                      <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="phone_number" placeholder="+1234156789" required/>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Address</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="address_1" class="form-label">Address 1</label>
                      <input type="text" class="form-control" name="address_1" placeholder="Address 1" required/>
                </div>
                <div class="col-md-6">
                      <label for="address_2" class="form-label">Address 2</label>
                      <input type="text" class="form-control" name="address_2" placeholder="Address 2" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="country"  class="form-label">Country</label>
                      <select class="form-select" name="country" id="country" required>
                        <option value="">Select Country</option>
                        @foreach($Country as $Count)
                        <option value="{{$Count->id}}">{{$Count->name}}</option>
                        @endforeach
                      </select>
                </div>
                <div class="col-md-3">
                      <label for="state"  class="form-label">State</label>
                      <select class="form-select" name="state" id="state" required>
                        <option value="">Select State</option>                                  
                      </select>
                </div>
                <div class="col-md-3">
                      <label for="city"  class="form-label">City</label>
                      <select class="form-select" name="city" id="city">
                        <option value="">Select City</option>
                      </select>
                </div>
                <div class="col-md-3">
                      <label for="pincode" class="form-label">Pincode</label>
                      <input type="number" class="form-control" name="pincode" placeholder="Pincode" required />
                </div>
              </div>
              <hr>
              <h5 class="mb-4">3. Tax</h5>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="gstin" class="form-label">GSTIN</label>
                      <input type="text" class="form-control" name="gstin" placeholder="GSTIN" required/>
                </div>
                <div class="col-md-3">
                      <label for="pen_ten_no" class="form-label">PAN/TAN Number</label>
                      <input type="text" class="form-control" name="pen_ten_no" placeholder="PAN/TAN Number" required/>
                </div>
                <div class="col-md-3">
                      <label for="CIN" class="form-label">CIN</label>
                      <input type="text" class="form-control" name="cin" placeholder="CIN" required/>
                </div>
                <div class="col-md-3">
                      <label for="" class="form-label">TDS %</label>
                      <input type="text" class="form-control" name="tds" placeholder="TDS" required/>
                </div>          
              </div>
              <hr>
              <h5 class="mb-4">3. Login Details</h5>  
              <div class="row mb-3"> 
                        <div class="col-md-3">
                    <label for="portal_login_url" class="form-label">Portal login URL <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="portal_login_url" placeholder="https://dev.cloudtechtiq.in/" required/>
              </div>
              <div class="col-md-3">
                    <label for="login_email" class="form-label">Login Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="login_email" placeholder="ABCBack" required/>
              </div>
                <div class="col-md-3">
                    <div class="form-password-toggle">
                      <label class="form-label" for="basic-default-password32">Password</label>
                      <div class="input-group input-group-merge">
                        <input type="password" class="form-control" name="password" id="basic-default-password32" placeholder="············" aria-describedby="basic-default-password" required>
                         <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                </div>
              <div class="col-md-3">
                    <label for="profile_img" class="form-label">Profile Photo <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="profile_img" required/>
              </div>
              </div>
              <hr>
              <h5 class="mb-4">4. Access Management</h5>                    
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="access_security"  class="form-label">Select Employees for Access Security</label>
                      <select class="form-select" name="access_security" required>
                          @foreach($Employee as $emp)
                          <option value="{{$emp->id}}">{{$emp->first_name}}</option>
                          @endforeach
                      </select>
                </div>
                <div class="col-md-6">
                      <label for="status"  class="form-label">Status</label>
                      <select class="form-select" name="status" required>
                          @foreach($Status as $Status)
                          <option value="{{$Status->id}}">{{$Status->status}}</option>
                          @endforeach
                      </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="services_offered"  class="form-label">Services offered</label>
                      <div class="editor-container">
                        <div class="full-editor geteditor"></div>
                        <input type="hidden" name="services_offered" class="hidden-field">
                      </div>
                </div>
              </div>     
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Vendor/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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

<script>
    // Function to read and display the selected image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Set the 'src' attribute of the 'img' tag
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Bind the 'change' event to the file input
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>
<script>
        $(document).ready(function() {
            // Attach an event handler to the "country" select box
            $('#country').on('change', function() {
                var selectedCountry = $(this).val();
                // Make an AJAX request to fetch states based on the selected country
                $.ajax({
                    url: "{{ url('Employee/Vendor/getstateData') }}", // Replace with your actual route name
                    method: 'post',
                    data: { countryid: selectedCountry },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data) {
                        // Clear existing options in the "state" select box
                        $('#state').empty().append('<option value="">Select State</option>');
                        // Append new options based on the AJAX response
                        $.each(data.states, function(index, state) {
                            $('#state').append($('<option>', {
                                value: state.id,
                                text: state.name
                            }));
                        });
                    },
                    error: function() {
                        console.log('Error fetching data');
                    }
                });
            });
        });
</script>
<script>
        $(document).ready(function() {
            // Attach an event handler to the "country" select box
            $('#state').on('change', function() {
                var selectedstate = $(this).val();
                // Make an AJAX request to fetch states based on the selected country
                $.ajax({
                    url: "{{ url('Employee/Vendor/getcityData') }}", // Replace with your actual route name
                    method: 'post',
                    data: { stateid: selectedstate },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data) {
                        // Clear existing options in the "state" select box
                        $('#city').empty().append('<option value="">Select City</option>');
                        // Append new options based on the AJAX response
                        $.each(data.citys, function(index, city) {
                            $('#city').append($('<option>', {
                                value: city.id,
                                text: city.name
                            }));
                        });
                    },
                    error: function() {
                        console.log('Error fetching data');
                    }
                });
            });
        });
      </script>
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