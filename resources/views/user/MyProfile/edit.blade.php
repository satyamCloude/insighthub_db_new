<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-body" id="editForm">
      <form action="{{url('user/MyProfile/update/')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">Edit Profile</h5>
            @if($user->gender)
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            @endif
          </div>
          <div class="modal-body">
            <div class="input-group mt-5 mb-3">
              <select name="gender" required class="form-select">
                <option value="">Select Gender</option>
                <option @if($user && $user->gender == "Mr") selected @endif value="Mr"> Mr.</option>
                <option @if($user && $user->gender == "Miss") selected @endif value="Miss"> Miss.</option>
              </select>
              <input type="text" required name="first_name" placeholder="First name" @if($user && $user->first_name) value="{{$user->first_name}}" @endif class="form-control"/>
              <input type="text" required name="last_name" placeholder="Last name" @if($user && $user->last_name) value="{{$user->last_name}}" @endif class="form-control"/>
            </div>
            <div class="row mb-4">
              <div class="col-md-6">
                <label for="company_name" class="form-label">Company Name</label>

                <input type="text" required class="form-control" name="company_name" required @if($user && $user->company_name) value="{{$user->company_name}}" @endif >
              </div>
              <div class="col-md-6">
                <label for="phone_number" class="form-label">Phone number</label>
                <input type="number" required name="phone_number" placeholder="+9414177140" @if($user && $user->phone_number) value="{{$user->phone_number}}" @endif class="form-control"/>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-6">
                <label for="email" class="form-label">Email address</label>
                <input type="email" required name="email" placeholder="name@example.com" @if($user && $user->email) value="{{$user->email}}" @endif class="form-control"/>
              </div>
              <!--<div class="col-md-6">-->
              <!--  <div class="form-password-toggle">-->
              <!--    <label class="form-label" for="basic-default-password32">Password</label>-->
              <!--    <div class="input-group input-group-merge">-->
              <!--      <input type="password"  class="form-control" name="password" id="basic-default-password32" value="{{ old('password') }}" placeholder="············" aria-describedby="basic-default-password">-->
              <!--      <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="ti ti-eye-off"></i></span>-->
              <!--    </div>-->
              <!--  </div>-->
              <!--</div>-->
            </div>
            <div class="row mb-4">
              <div class="col-md-6">
                <label for="address_1" class="form-label">Address 1</label>
                <input type="text" required class="form-control" name="address_1" @if($ClientDetail && $ClientDetail->address_1) value="{{$ClientDetail->address_1}}" @endif placeholder="Address 1" />
              </div>
              <div class="col-md-6">
                <label for="address_2" class="form-label">Address 2</label>
                <input type="text" required class="form-control" name="address_2" @if($ClientDetail && $ClientDetail->address_2) value="{{$ClientDetail->address_2}}" @endif placeholder="Address 2" />
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select select2" required name="country" id="country">
                  <option value="">Select Country</option>
                  @foreach($Country as $Count)
                  <option @if($ClientDetail && $ClientDetail->country == $Count->id) selected @endif value="{{$Count->id}}">{{$Count->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label for="state" class="form-label">State</label>
                <select class="form-select" required name="state" id="state" required>
                  <option value="">Select State</option>
                  <option value="@if($State && $State->id){{$State->id}} @endif" selected>@if($State && $State->name){{$State->name}} @endif</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="city" class="form-label">City</label>
                <select class="form-select" required name="city" id="city" required>
                  <option value="">Select City</option>
                  <option value="@if($City && $City->id){{$City->id}} @endif" selected>@if($City && $City->name){{$City->name}} @endif</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="number" required class="form-control" @if($ClientDetail && $ClientDetail->pincode) value="{{$ClientDetail->pincode}}" @endif name="pincode" placeholder="Pincode" />
              </div>

              <div class="col-md-3 my-3">
                <label for="gstin" class="form-label">GSTIN</label>
                <input type="text" required class="form-control" name="gstin" @if($ClientDetail && $ClientDetail->gstin) value="{{$ClientDetail->gstin}}" @endif placeholder="GSTIN" />
              </div>
              <div class="col-md-3 my-3">
                <label for="hsn_sac" class="form-label">HSN/SAC</label>
                <input type="number" required class="form-control" name="hsn_sac" @if($ClientDetail && $ClientDetail->hsn_sac) value="{{$ClientDetail->hsn_sac}}" @endif placeholder="HSN/SAC" />
              </div>
              <div class="col-md-3 my-3">
                <label for="" class="form-label">TAN</label>
                <input type="number" required class="form-control" name="tds" @if($ClientDetail && $ClientDetail->tds) value="{{$ClientDetail->tds}}" @endif placeholder="TAN" />
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="avatar-preview">
                  <img id="imagePreview" width="100" height="100" name="profile_img" @if($user && $user->profile_img) src="{{$user->profile_img}}" @endif alt="Preview" />
                </div>
              </div>
              <div class="col-md-6">
                <label for="" class="form-label">Profile Picture <span class="text-danger">*</span></label>
                <div class="avatar-upload">
                  <div class="avatar-edit">
                    <input type="file" id="imageUpload" name="profile_img" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload"></label>
                  </div>
                </div>
              </div>

            </div>
            <div class="row mb-4">
              <div class="col-md-6">

              </div>
              <div class="col-md-6 my-4">
                <label for="" class="form-label">Document for Verification<span class="text-danger">*</span></label>
                <div class="avatar-upload">
                  <div class="avatar-edit">
                    <input type="file" id="imageUpload" name="doc_verify" accept="application/pdf" />
                    <label for="doc_verify"></label>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
</div>
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

      $(document).ready(function() {
        // Attach an event handler to the "country" select box
        $('#country').on('change', function() {
          var selectedCountry = $(this).val();
          // Make an AJAX request to fetch states based on the selected country
          $.ajax({
            url: "{{ url('user/MyProfile/getstateData') }}", // Replace with your actual route name
            method: 'post',
            data: {
              countryid: selectedCountry
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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
      
      $(document).ready(function() {
        // Attach an event handler to the "country" select box
        $('#state').on('change', function() {
          var selectedCountry = $(this).val();
          // Make an AJAX request to fetch states based on the selected country
          $.ajax({
            url: "{{ url('user/MyProfile/getcityData') }}", // Replace with your actual route name
            method: 'post',
            data: {
              stateid: selectedCountry
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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