@extends('layouts.admin')
@section('title', 'Vendor')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Vendor /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Vendor/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Vendor/update/'.$user->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. Company Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                    <label for="company_name" class="form-label">Company Name</label>
                    <select class="form-select" name="company_id" >
                                  @foreach($Company as $Company)
                                    <option @if($VendorDetail && $VendorDetail->company_id == $Company->id) selected @endif value="{{$Company->id}}">{{$Company->company_name}}</option>
                                  @endforeach  
                                </select>
                  </div>
                <div class="col-md-6">
                      <label for="vendor_name" class="form-label">Vendor Name <span class="text-danger">*</span></label>
                      <input type="vendor_name" class="form-control" @if($user && $user->first_name) value="{{$user->first_name}}" @endif name="first_name" placeholder="ABC Back"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" name="email"  @if($user && $user->email) value="{{$user->email}}" @endif placeholder="name@example.com"/>
                </div>
                <div class="col-md-6">
                      <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="phone_number" @if($user && $user->phone_number) value="{{$user->phone_number}}" @endif placeholder="+1234156789"/>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Address</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="address_1" class="form-label">Address 1</label>
                      <input type="text" class="form-control" name="address_1" @if($VendorDetail && $VendorDetail->address_1) value="{{$VendorDetail->address_1}}" @endif placeholder="Address 1"/>
                </div>
                <div class="col-md-6">
                      <label for="address_2" class="form-label">Address 2</label>
                      <input type="text" class="form-control" name="address_2" @if($VendorDetail && $VendorDetail->address_2) value="{{$VendorDetail->address_2}}" @endif placeholder="Address 2"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="country"  class="form-label">Country</label>
                      <select class="form-select select2" name="country" id="country">
                      <option value="">Select Country</option>
                        @foreach($Country as $Count)
                      <option @if($VendorDetail && $VendorDetail->country == $Count->id) selected @endif  value="{{$Count->id}}">{{$Count->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                      <label for="state"  class="form-label">State</label>
                      <select class="form-select" name="state" id="state">
                      <option value="">Select State</option>                                  
                      <option value="@if($State && $State->id){{$State->id}} @endif" selected>@if($State && $State->name){{$State->name}} @endif</option>
                    </select>
                </div>
                <div class="col-md-3">
                      <label for="city"  class="form-label">City</label>
                      <select class="form-select" name="city" id="city">
                      <option value="">Select City</option>
                      <option value="@if($City && $City->id){{$City->id}} @endif" selected>@if($City && $City->name){{$City->name}} @endif</option>
                    </select>
                </div>
                <div class="col-md-3">
                      <label for="pincode" class="form-label">Pincode</label>
                      <input type="number" class="form-control"  @if($VendorDetail && $VendorDetail->pincode) value="{{$VendorDetail->pincode}}" @endif name="pincode" placeholder="Pincode" />
                </div>
              </div>
              <hr>
              <h5 class="mb-4">3. Tax</h5>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="gstin" class="form-label">GSTIN</label>
                      <input type="text" class="form-control" name="gstin" placeholder="GSTIN"  @if($VendorDetail && $VendorDetail->gstin) value="{{$VendorDetail->gstin}}" @endif />
                </div>
                <div class="col-md-3">
                      <label for="pan/tan" class="form-label">PAN/TAN Number</label>
                      <input type="text" class="form-control" name="pen_ten_no" placeholder="PAN/TAN Number"  @if($VendorDetail && $VendorDetail->pen_ten_no) value="{{$VendorDetail->pen_ten_no}}" @endif/>
                </div>
                <div class="col-md-3">
                      <label for="CIN" class="form-label">CIN</label>
                      <input type="text" class="form-control" name="cin" placeholder="CIN" @if($VendorDetail && $VendorDetail->cin) value="{{$VendorDetail->cin}}" @endif />
                </div>
                <div class="col-md-3">
                      <label for="" class="form-label">TDS %</label>
                      <input type="text" class="form-control" name="tds" placeholder="TDS" @if($VendorDetail && $VendorDetail->tds) value="{{$VendorDetail->tds}}" @endif />
                </div>          
              </div>
              <hr>
              <h5 class="mb-4">3. Login Details</h5>  
              <div class="row mb-4"> 
                        <div class="col-md-3">
                    <label for="portal_login_url" class="form-label">Portal login URL <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="portal_login_url" @if($VendorDetail && $VendorDetail->portal_login_url) value="{{$VendorDetail->portal_login_url}}" @endif placeholder="https://dev.cloudtechtiq.in/"/>
              </div>
              <div class="col-md-3">
                    <label for="login_email" class="form-label">Login Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="login_email" @if($user && $user->login_email) value="{{$user->login_email}}" @endif/>
              </div>
                <div class="col-md-3">
                    <div class="form-password-toggle">
                      <label class="form-label" for="basic-default-password32">Password</label>
                      <div class="input-group input-group-merge">
                        <input type="password" class="form-control" name="password" id="basic-default-password32" placeholder="············" aria-describedby="basic-default-password">
                         <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="profile_img" class="form-label">Profile Photo </label> <a type="button" @if($user && $user->profile_img) href="{{$user->profile_img}}" @endif  ><i class="fa-solid fa-download"></i></a>
                    <input type="file" class="form-control" name="profile_img" />
              </div>
              </div>
              <hr>
              <h5 class="mb-4">4. Access Management</h5>                    
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="access_security"  class="form-label">Select Employees for Access Security</label>
                     <select class="form-select" name="access_security">
                          @foreach($Employee as $emp)
                          <option  @if($VendorDetail && $VendorDetail->access_security == $emp->id) selected  @endif  value="{{$emp->id}}">{{$emp->first_name}}</option>
                          @endforeach
                      </select>
                </div>
                <div class="col-md-6">
                      <label for="status"  class="form-label">Status</label>
                      <select class="form-select" name="status">
                        @foreach($Status as $Status)
                        <option @if($user && $user->status == $Status->id) selected  @endif value="{{$Status->id}}">{{$Status->status}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="services_offered"  class="form-label">Services offered</label>
                      <div class="editor-container">
                        <div class="full-editor geteditor">@if($VendorDetail && $VendorDetail->services_offered) {!!$VendorDetail->services_offered!!} @endif</div>
                        <input type="hidden" name="services_offered" @if($VendorDetail && $VendorDetail->services_offered) value="{{$VendorDetail->services_offered}}" @endif class="hidden-field">
                      </div>
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
                var selectedCountry = $(this).val();
                // Make an AJAX request to fetch states based on the selected country
                $.ajax({
                    url: "{{ url('Employee/Vendor/getcityData') }}", // Replace with your actual route name
                    method: 'post',
                    data: { stateid: selectedCountry },
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