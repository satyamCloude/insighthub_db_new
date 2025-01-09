@extends('layouts.admin')
@section('title', 'Edit')
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

  
  .iti{
      width:100%!important;
  }
</style>
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Client /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Client/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
              @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif
          <form action="{{url('Employee/Client/update/'.$user->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
                <div class="input-group mt-5 mb-3">
                          <!--<select name="gender" class="form-select">-->
                          <!--  <option value="" >Select Gender</option>-->
                          <!--  <option @if($user && $user->gender == "Mr") selected @endif  value="Mr"> Mr.</option>-->
                          <!--  <option @if($user && $user->gender == "Miss") selected @endif  value="Miss"> Miss.</option>-->
                          <!--</select>-->
                          <input type="text" name="first_name" placeholder="First name"@if($user && $user->first_name) value="{{$user->first_name}}" @endif class="form-control"/>
                          <input type="text" name="last_name" placeholder="Last name"@if($user && $user->last_name) value="{{$user->last_name}}" @endif class="form-control"/>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-6">
                    <label for="company_name" class="form-label">Company Name</label>
                    <select class="form-select" name="company_id" required>
                                  @foreach($Company as $Company)
                                    <option @if($ClientDetail && $ClientDetail->company_id == $Company->id) selected @endif value="{{$Company->id}}">{{$Company->company_name}}</option>
                                  @endforeach  
                                </select>
                  </div>
               
                  
                    <div class="col-md-6">
    <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label><br/>
    <input type="tel" name="phone_number" id="phone_number" class="inpt form-control" required placeholder="+1234567890" pattern="[0-9+]{1,10}" maxlength="10"  @if($user && $user->phone_number) value="{{$user->phone_number}}" @endif  oninput="this.value = this.value.replace(/[^0-9+]/g, '').slice(0, 10);">
</div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" placeholder="name@example.com" @if($user && $user->email) value="{{$user->email}}" @endif class="form-control"/>
                  </div>
                  <div class="col-md-6">
                    <div class="form-password-toggle">
                      <label class="form-label" for="basic-default-password32">Password</label>
                      <div class="input-group input-group-merge">
                        <input type="password" class="form-control" name="password" id="basic-default-password32" value="{{ old('password') }}" placeholder="············" aria-describedby="basic-default-password">
                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-6">
                    <label for="address_1" class="form-label">Address 1</label>
                    <input type="text" class="form-control" name="address_1"  @if($ClientDetail && $ClientDetail->address_1) value="{{$ClientDetail->address_1}}" @endif  placeholder="Address 1" />
                  </div>
                  <div class="col-md-6">
                    <label for="address_2" class="form-label">Address 2</label>
                    <input type="text" class="form-control" name="address_2" @if($ClientDetail && $ClientDetail->address_2) value="{{$ClientDetail->address_2}}" @endif placeholder="Address 2" />
                  </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-3">
                    <label for="country"  class="form-label">Country</label>
                    <select class="form-select select2" name="country" id="country">
                      <option value="">Select Country</option>
                        @foreach($Country as $Count)
                      <option @if($ClientDetail && $ClientDetail->country == $Count->id) selected @endif  value="{{$Count->id}}">{{$Count->name}}</option>
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
                    <input type="number" class="form-control" @if($ClientDetail && $ClientDetail->pincode) value="{{$ClientDetail->pincode}}" @endif name="pincode" placeholder="Pincode" />
                  </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-3">
                    <label for="gstin" class="form-label">GSTIN</label>
                    <input type="text" class="form-control" name="gstin" @if($ClientDetail && $ClientDetail->gstin) value="{{$ClientDetail->gstin}}" @endif placeholder="GSTIN" />
                  </div>
                  <div class="col-md-3">
                    <label for="hsn_sac" class="form-label">HSN/SAC</label>
                    <input type="text" class="form-control" name="hsn_sac" @if($ClientDetail && $ClientDetail->hsn_sac) value="{{$ClientDetail->hsn_sac}}" @endif  placeholder="HSN/SAC" />
                  </div>
                  <div class="col-md-3">
                    <label for="" class="form-label">TDS</label>
                    <input type="text" class="form-control" name="tds" @if($ClientDetail && $ClientDetail->tds) value="{{$ClientDetail->gstin}}" @endif  placeholder="TDS" />
                  </div>
                  <div class="col-md-3">
                                <label for="exampleFormControlInput1"  class="form-label">Payment Method</label>
                                <select class="select2 form-select" name="payment_method" required>
                                  @foreach($PaymentMethod as $PaymentMethod)
                                  <option @if($ClientDetail && $ClientDetail->payment_method == $PaymentMethod->id) selected  @endif value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                                  @endforeach
                                </select>
                          </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-4">
                    <label for=""  class="form-label">Currency</label>
                    <select class="form-select" name="currency">
                       @foreach($Currency as $Count)
                      <option @if($ClientDetail && $ClientDetail->currency == $Count->id) selected @endif  value="{{$Count->id}}">{{$Count->prefix}} {{$Count->code}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-4 ">
                    <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                    <select name="role_id" class="form-select">
                              @foreach($Role as $Rol)
                              <option @if($ClientDetail && $ClientDetail->role_id == $Rol->id) selected @endif value="{{$Rol->id}}">{{$Rol->name}}</option>
                              @endforeach
                      </select>
                  </div>
                  <div class="col-md-4">
                                <label for="exampleFormControlInput1"  class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                  @foreach($Status as $Status)
                                  <option @if($user && $user->status == $Status->id) selected  @endif value="{{$Status->id}}">{{$Status->status}}</option>
                                  @endforeach
                                </select>
                          </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-3">
                    <label class="switch">
                     <input type="checkbox" @if($ClientDetail && $ClientDetail->all_emails == '1') checked  @endif name="all_emails" class="switch-input">
                     <span class="switch-toggle-slider">
                       <span class="switch-on">
                         <i class="ti ti-check"></i>
                       </span>
                       <span class="switch-off">
                         <i class="ti ti-x"></i>
                       </span>
                     </span>
                     <span class="switch-label">All Emails</span>
                    </label>
                  </div>
                  <div class="col-md-3">
                    <label class="switch">
                     <input type="checkbox" name="invoices" @if($ClientDetail && $ClientDetail->invoices == '1') checked  @endif  class="switch-input">
                     <span class="switch-toggle-slider">
                       <span class="switch-on">
                         <i class="ti ti-check"></i>
                       </span>
                       <span class="switch-off">
                         <i class="ti ti-x"></i>
                       </span>
                     </span>
                     <span class="switch-label">Invoices</span>
                    </label>
                  </div>
                  <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="support" @if($ClientDetail && $ClientDetail->support == '1') checked  @endif class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
                       <span class="switch-label">Support</span>
                      </label>
                  </div>
                  <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="services" @if($ClientDetail && $ClientDetail->services == '1') checked  @endif class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
                       <span class="switch-label">Services</span>
                      </label>
                  </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="over_due_invoice" @if($ClientDetail && $ClientDetail->over_due_invoice == '1') checked  @endif class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
                       <span class="switch-label">Over Due Invoice</span>
                      </label>
                  </div>
                  <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="tax_exampt" @if($ClientDetail && $ClientDetail->tax_exampt == '1') checked  @endif class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
                       <span class="switch-label">Tax Exampt</span>
                      </label>
                  </div>
                  <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="projects" @if($ClientDetail && $ClientDetail->projects == '1') checked  @endif class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
                       <span class="switch-label">Projects</span>
                      </label>
                  </div>
                  <div class="col-md-3"></div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-6">
                    <label for="" class="form-label">Profile Picture <span class="text-danger">*</span></label>
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" id="imageUpload"  name="profile_img"  accept=".png, .jpg, .jpeg" />
                           <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                           <img id="imagePreview" width="100%" name="profile_img" @if($user && $user->profile_img) src="{{$user->profile_img}}" @endif alt="Preview" />
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <label for="" class="form-label">Document for Verification</label>
                        <input type="file" name="doc_verify"  accept="application/pdf" value="@if($ClientDetail && $ClientDetail->doc_verify) value="{{$ClientDetail->doc_verify}}" @endif" class="form-control" id="inputGroupFile01">
                        <br>
                        <br>
                        <a class="btn btn-outline-primary"  target="_blank" @if($ClientDetail && $ClientDetail->doc_verify) href="{{$ClientDetail->doc_verify}}" @endif>Download Verification Document</a>
                  </div>
                </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Client/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/23.0.12/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/23.0.12/js/intlTelInput.min.js"></script>

<!-- Your custom script -->
<script>
    $(document).ready(function() {
        var input = document.querySelector("#phone_number");
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: "in" // Set India as the default country
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function() {
                // Get the country code and image source from the data attributes
                const countryCode = this.getAttribute('data-code');
                const imgSrc = this.getAttribute('data-img');

                if (countryCode && imgSrc) {
                    // Set the country code in the button with numcode class
                    const button = document.querySelector('.numcode');
                    if (button) {
                        button.textContent = countryCode;
                    } else {
                        console.error("Element with class 'numcode' not found.");
                    }

                    // Update the flag image in the dropdown toggle button
                    const selectedFlag = document.querySelector('.selected-flag');
                    if (selectedFlag) {
                        selectedFlag.src = imgSrc;
                        selectedFlag.alt = countryCode;
                    } else {
                        console.error("Element with class 'selected-flag' not found.");
                    }
                } else {
                    console.error("Country code or image source not found in the clicked item.");
                }
            });
        });
    });


</script>
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
                    url: "{{ url('Employee/Client/getstateData') }}", // Replace with your actual route name
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
                    url: "{{ url('Employee/Client/getcityData') }}", // Replace with your actual route name
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

@endsection