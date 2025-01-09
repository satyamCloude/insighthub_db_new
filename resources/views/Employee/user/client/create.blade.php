@extends('layouts.admin')
@section('title', 'Create')
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
#gst-error {
  color: red;
  font-size: 14px;
}

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

  }

  .dropdown {
    position: relative;
    display: inline-block;
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


  .outer:hover {

    background-color: #685dd8 !important;
    color: white !important;

  }


  .outer {


    background-color: rgba(15, 103, 240, 0.08);
    color: #7367f0;

    border-radius: 10px;



  }

  .c-inv-total td{
    text-align: right;
  }
  
  .iti{
      width:100%!important;
  }
</style>


<!-- Content -->
   
      
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Client /</span> Add</h4>
  <!-- Sticky Actions -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
          <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
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
        <form action="{{url('Employee/Client/store')}}" method="post" enctype="multipart/form-data"> 
          @csrf
          <div class="card-body">
            <div class="input-group mt-5 mb-3">
              <!--<select name="gender" class="form-control select2" required>-->
              <!--  <option>Select Gender</option>-->
              <!--  <option value="Mr"> Mr.</option>-->
              <!--  <option value="Miss"> Miss.</option>-->
              <!--</select>-->
              <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First name" class="form-control" required />
              <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last name" class="form-control" required/>
            </div>
            <div class="row mb-4"> 
                <div class="col-md-6">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control" name="company_name"  value="{{ old('company_name') }}" required>
                </div>
                 <div class="col-md-6">
    <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label><br/>
    <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="inpt form-control" required placeholder="+1234567890" pattern="[0-9+]{1,10}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9+]/g, '').slice(0, 10);">
</div>
            </div>
            <div class="row mb-4"> 
              <div class="col-md-6">
                <label for="exampleForm1" class="form-label">Email address</label>
                <input type="email" class="form-control"  value="{{ old('email') }}" name="email" id="exampleFormCont1" placeholder="name@example.com" required/>
              </div>
              <div class="col-md-6">
                <div class="form-password-toggle">
                  <label class="form-label" for="basic-default-password32">Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password" class="form-control"  value="{{ old('password') }}" name="password" id="basic-default-password32" placeholder="············" aria-describedby="basic-default-password" required>
                    <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="ti ti-eye-off"></i></span><button type="button" class="btn btn-success btn-sm" id="generate-password-btn">Generate Password</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-4"> 
              <div class="col-md-6">
                <label for="exampleFormContro7lInput1" class="form-label">Address 1</label>
                <input type="text" class="form-control" value="{{ old('address_1') }}"  name="address_1" id="exampleFo7rmControlInput1" placeholder="Address 1" required/>
              </div>
              <div class="col-md-6">
                <label for="exampleFormControl8Input1" class="form-label">Address 2</label>
                <input type="text" class="form-control"  value="{{ old('address_2') }}"  name="address_2" id="exampleFormControlIn9put1" placeholder="Address 2" required/>
              </div>
            </div>
            <div class="row mb-4"> 
              <div class="col-md-3">
                <label for="exampleFormContro73lInput1"  class="form-label">Country</label>
                <select class="form-control select2"  name="country" id="country" required>
                  @foreach($Country as $Count)
                  <option value="{{$Count->id}}">{{$Count->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label for="exampleFormCont65rolInput1"  class="form-label">State</label>
                <select class="form-control select2" name="state" id="state" required>
                  <option value="">Select State</option>                                  
                </select>
              </div>
              <div class="col-md-3">
                <label for="exampleFormCon77trolInput1"  class="form-label">City</label>
                <select class="form-control select2"   name="city" id="city">
                  <option value="">Select City</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="exampleFormControl654Input1" class="form-label">Pincode</label>
                <input type="number" class="form-control" value="{{ old('pincode') }}" name="pincode" id="exampleFormjControlInput1" placeholder="Pincode" required />
              </div>
            </div>
            <div class="row mb-4"> 
              <div class="col-md-3">
                <label for="exampleFormControlIpnput1" class="form-label">GSTIN</label>
                <input type="text" class="form-control" value="{{ old('gstin') }}" name="gstin" id="gstNumber" maxlength="15" placeholder="GSTIN" required/>
                <span id="gst-error"></span>
                <span id="gst-errorr"></span>
                <span id="gst-success"></span>
              </div>
              <div class="col-md-3">
                <label for="exampleFormControlInput1" class="form-label">HSN/SAC</label>
                <input type="text" class="form-control" name="hsn_sac" value="{{ old('hsn_sac') }}" id="exampleFormConqtrolInput1" placeholder="HSN/SAC" required/>
              </div>
              <div class="col-md-3">
                <label for="exampleFormrControlInput1" class="form-label">TDS</label>
                <input type="number" class="form-control" name="tds" value="{{ old('tds') }}" id="exasmpleFormControlInput1" maxlength="10" placeholder="TDS" required/>
              </div>
              <div class="col-md-3">
                <label for="exampleFormControlItnput1"  class="form-label">Payment Method</label>
                <select class="form-control select2" name="payment_method" required>
                  @foreach($PaymentMethod as $PaymentMethod)
                  <option value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-4"> 
              <div class="col-md-3">
                <label for="exampleFormControliInput1"  class="form-label">Currency</label>
                <select class="form-control select2" name="currency" required>
                  @foreach($Currency as $Currencies)
                  <option value="{{$Currencies->id}}">{{$Currencies->prefix}} {{$Currencies->code}}</option>
                  @endforeach  
                </select>
              </div>
              <!--<div class="col-md-3 ">-->
              <!--  <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>-->
              <!--  <select name="role_id" class="form-control select2">-->
              <!--    @foreach($Role as $Rol)-->
              <!--    <option value="{{$Rol->id}}">{{$Rol->name}}</option>-->
              <!--    @endforeach-->
              <!--  </select>-->
              <!--</div>-->
              <div class="col-md-3">
                <label for="exampleFormContropulInput1"  class="form-label">Status</label>
                <select class="form-control select2" name="status" required>
                  <option value="0">Select</option>
                  @foreach($Status as $Status)
                  <option value="{{$Status->id}}">{{$Status->status}}</option>
                  @endforeach
                </select>
              </div>
         
              
              <div class="col-md-3">
                <label for="client_id" class="form-label">Account Manager <span class="text-danger">*</span></label>
                <div class="dropdown">
                  <button type="button" class="dropbtn" id="selected_client_btn">Select Account Manager <i class="fa fa-angle-down" style="font-size:24px"></i></button>
                  <div class="dropdown-content">
                    @foreach($accountManagers as $client)
                    <div class="outer" id="client_{{ $client->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient({{ $client->id }})">
                      <img src="{{ $client->profile_img }}" style="width:45px;border-radius:50%;height:45px;">
                      <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                        <span>{{ $client->first_name }} {{$client->last_name}} (#{{ $client->id }}) <br/>{{$client->jobrole}}</span>
                        <!--<span>{{ $client->status }}</span>-->
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
                <input type="hidden" name="accountManager" id="set_client_id" >
            </div>
              
              
            </div>
            <div class="row mb-4"> 
              <div class="col-md-3">
                <label class="switch">
                 <input type="checkbox" name="all_emails" class="switch-input">
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
               <input type="checkbox" name="invoices" class="switch-input">
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
           <!-- <div class="col-md-3">
            <label class="switch">
             <input type="checkbox" name="support" class="switch-input">
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
           <input type="checkbox" name="services" class="switch-input">
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
         <div class="col-md-3 mt-2">
          <label class="switch">
           <input type="checkbox" name="projects" class="switch-input">
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
       </div> -->
     </div>
     <hr>
<h4>
  Invoice setting
</h4>
 <div class="row mb-4"> 
             
                   <div class="col-md-3">
        <label class="switch">
         <input type="checkbox" name="merge_same_due_date" class="switch-input">
         <span class="switch-toggle-slider">
           <span class="switch-on">
             <i class="ti ti-check"></i>
           </span>
           <span class="switch-off">
             <i class="ti ti-x"></i>
           </span>
         </span>
         <span class="switch-label">Do Not Merge Same Due Date Invoices</span>
       </label>
     </div>
               <div class="col-md-3">
        <label class="switch">
         <input type="checkbox" name="over_due_invoice" class="switch-input">
         <span class="switch-toggle-slider">
           <span class="switch-on">
             <i class="ti ti-check"></i>
           </span>
           <span class="switch-off">
             <i class="ti ti-x"></i>
           </span>
         </span>
         <span class="switch-label">Over Due Invoice Notification</span>
       </label>
     </div>
     <div class="col-md-3">
      <label class="switch">
       <input type="checkbox" name="tax_exampt" class="switch-input">
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
</div>
<hr>
     <div class="row mb-4"> 
 
 
 <div class="col-md-3"></div>
</div>
<div class="row mb-4"> 
 <div class="col-md-6">
  <label for="exampleFormConui8trolInput1" class="form-label">Profile Picture <span class="text-danger">*</span></label>
  <div class="avatar-upload">
    <div class="avatar-edit">
      <!-- Update the input type to 'file' -->
      <input type="file" id="imageUpload"  name="profile_img" accept=".png, .jpg, .jpeg" required />
      <label for="imageUpload"></label>
    </div>
    <div class="avatar-preview">
      <!-- Add an 'img' tag for image preview -->
      <img id="imagePreview" width="100%" name="profile_img" src="{{url('/')}}/public/images/default_profile.jpg" alt="Preview" />
    </div>
  </div>
</div>
<div class="col-md-6">
  <label for="exampleFormControlInpu8ht1" class="form-label">Document for Verification</label>
  <input type="file" name="doc_verify" class="form-control" id="doc_verify" >
  <div id="validationResult"></div>
</div>
</div>

</div>
<div class="card-footer">
  <div class="row mb-4"> 
    <div class="col-md-6 text-end" >
      <a href="{{url('Employee/Client/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
    </div>
    <div class="col-md-6">
      <button type="submit" id="submit" class="btn btn-success">Submit</button>
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
 <!-- Include intl-tel-input CSS -->
 
 
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
      var selectedstate = $(this).val();
                // Make an AJAX request to fetch states based on the selected country
      $.ajax({
                    url: "{{ url('Employee/Client/getcityData') }}", // Replace with your actual route name
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

  $(document).ready(function() {
    $('#generate-password-btn').on('click', function() {
                var password = generatePassword(7); // You can specify the length of the password here
                $('#basic-default-password32').val(password);
              });

    function generatePassword(length) {
      var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+{}[]<>?";
      var password = "";
      for (var i = 0; i < length; i++) {
        var charIndex = Math.floor(Math.random() * charset.length);
        password += charset.charAt(charIndex);
      }
      return password;
    }
        /////////GST NUMBER VALIDATOR
    $('#gstNumber').keyup(function() {
      var gstNumber = $(this).val().trim();
      validateGST(gstNumber)
      $.ajax({
                    url: "{{url('Employee/Client/check-gst-number')}}", // The URL of the server-side script
                    type: 'POST',
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { gstNumber: gstNumber },
                    success: function(response) {
                      
                      if (response.status === 'exists') {
                         console.log("1");
                        $('#gst-errorr').text('GST number already exists!');
                      }
                      if(response.status === 'not_exists' && validateGST(gstNumber))
                      {
                        console.log("2");
                        $('#submit').removeAttr('disabled');
                      }
                    }
                  });

    });
  // Validate HSN/SAC
    $('#hsn_sac').on('input', function() {
        var hsn_sac = $(this).val().trim();
        if (hsn_sac.length > 8 || isNaN(hsn_sac)) {
            $('#hsn-error').text('HSN/SAC must be a number and not more than 8 digits.');
        } else {
            $('#hsn-error').text('');
        }
    });

    // Validate TDS
    $('#tds').on('input', function() {
        var tds = $(this).val().trim();
        if (tds.length > 8 || isNaN(tds)) {
            $('#tds-error').text('TDS must be a number and not more than 8 digits.');
        } else {
            $('#tds-error').text('');
        }
    });
 
  });
   function validateGST(gstNumber) {
        var gstRegex = /^(\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1})$/;
        return gstRegex.test(gstNumber);
    }

  


 $('#doc_verify').change(function() {
   var button = document.getElementById('submit');
    button.disabled = true;
        var fileInput = document.getElementById('doc_verify');
        var file = fileInput.files[0];
        var allowedExtensions = ['txt', 'pdf', 'xls', 'xlsx'];

        if (file) {
            var fileName = file.name;
            var fileExtension = fileName.split('.').pop().toLowerCase();

            if (allowedExtensions.indexOf(fileExtension) !== -1) {
              $('#submit').removeAttr('disabled');
                $('#validationResults').text('File is valid.');
            } else {

                $('#validationResult').text('Invalid file format. Allowed formats: TXT, PDF, XLS, XLSX');
            }
        } 
    });
    
    numberCount = 1;


  function selectClient(id) {
    var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
    $('#selected_client_btn').text(clientName); // Set the button text to the selected client name
    $('#set_client_id').val(id); // Set the button text to the selected client name

    $('.dropdown-content .outer').removeClass('selected');

    // Add the 'selected' class to the clicked option
    $('#client_' + id).addClass('selected');

    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: 'GET',
          url: "{{url('Employee/Invoices/getClientDetails')}}/"+id,
          
          success: function(res) {
            console.log(res);// Make sure to adjust this based on your actual Select2 initialization method
            // alert(res.data.address_1 );
            $('#shipping_address').val(res.data.address_1 +', '+ res.data.address_2);
          },
        });
  }
  
  

</script>
@endsection