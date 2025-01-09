@extends('layouts.admin')
@section('title', 'Vendor')
@section('content')
<style>

    .dropbtn {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    background-color: #fff;
    border: 1px solid #dbdade;
    border-radius: 0.375rem;
    border-color: #C9C8CE !important;
    height: 40px;
    width: 100%;
    text-align: left;
    color: #6f6b7d;
    font-weight: 500;
    font-size: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }


  .dropdown {
    position: relative;
    /*display: inline-block;*/
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 100%;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    max-height: 350px;
    overflow-x: scroll;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #f1f1f1
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .dropdown:hover .dropbtn {
    background-color: white;
  }
</style>
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
              <a href="{{url('admin/Vendor/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>   
          </div>
          <form action="{{url('admin/Vendor/update/'.$user->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. Company Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                    <label for="company_name" class="form-label">Company Name</label>
                    <select class="form-select" name="company_id" >
                        <option @if($VendorDetail && $VendorDetail->company_id == $company->id) selected @endif value="{{$company->id}}">{{$company->company_name}}</option>
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
                     <!--<select class="form-select" name="access_security">-->
                     <!--     @foreach($Employee as $emp)-->
                     <!--     <option  @if($VendorDetail && $VendorDetail->access_security == $emp->id) selected  @endif  value="{{$emp->id}}">{{$emp->first_name}}</option>-->
                     <!--     @endforeach-->
                     <!-- </select>-->
                       <div class="dropdown">
                      <button class="dropbtn" >
                        <div>
                             @php
                                // Use the `firstWhere` collection method to find the first client matching the Ticket's ccid
                                $client = collect($Employee)->firstWhere('id', $VendorDetail->access_security);
                                // Use null coalescence operator to handle the case when $client is null
                                $src = $client->profile_img ?? '';
                                $first_name = $client->first_name ?? 'Select Employees for Access Security';
                                $last_name = $client->last_name ?? '';
                                $id = $client->id ?? '';
                               
                            @endphp
                            <!-- Use the variables initialized above -->
                           <!--@if($src) <img src="{{ $src }}"  style="width:30px; border-radius:50%; height:30px;"-->
                           <!--id="selected_client_img" alt="Client Image"> @endif-->
                            <span id="selected_client_btn2">{{ $first_name }} {{ $last_name }}  (#{{ $id }})</span>
                        </div>
                        <i class="fa fa-angle-down" style="font-size:24px"></i>
                    </button>
                      <div class="dropdown-content">
                        @foreach($Employee as $client)
                        <div class="outer" id="client_{{ $client->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient({{ $client->id }})">
                          <img src="{{ $client->profile_img }}" style="width:45px;border-radius:50%;height:45px;">
                          <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                            <span>{{ $client->first_name }} {{$client->last_name}} (#{{ $client->id }}) </span>
                            <!--<span>{{ $client->status }}</span>-->
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <input type="hidden" name="accountManager" id="set_client_id" value="{{$id}}">
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
                  <a href="{{url('admin/Vendor/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
                    url: "{{ url('admin/Vendor/getstateData') }}", // Replace with your actual route name
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
                    url: "{{ url('admin/Vendor/getcityData') }}", // Replace with your actual route name
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
  
  
      function selectClient(id) {
          
        var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
      
        $('#selected_client_btn2').text(clientName); // Set the button text to the selected client name
        $('#set_client_id').val(id); // Set the button text to the selected client name
    
        $('.dropdown-content .outer').removeClass('selected');
    
        // Add the 'selected' class to the clicked option
        $('#client_' + id).addClass('selected');
      }
</script>

@endsection