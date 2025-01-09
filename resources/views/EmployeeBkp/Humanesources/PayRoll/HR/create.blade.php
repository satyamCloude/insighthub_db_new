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

</style>
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leads /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/Leads/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/Leads/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="input-group mb-4">
                          <select name="gender" class="form-select" required>
                            <option>Select Gender</option>
                            <option value="Mr"> Mr.</option>
                            <option value="Miss"> Miss.</option>
                          </select>
                          <input type="text" name="first_name" placeholder="First name" class="form-control" required />
                          <input type="text" name="last_name" placeholder="Last name" class="form-control" required/>
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
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="company_name" placeholder="ABC PVT LTD" required/>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Lead</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                  <label for="date" class="form-label">Lead Source  <span class="text-danger">*</span></label>
                    <select name="lead_source" class="form-select" required>
                            <option value="">Select Lead</option>
                            @foreach($leads as $leadsource)
                            <option value="{{$leadsource->id}}">{{$leadsource->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-md-6 ">
                  <label for="date" class="form-label">Action Schedule  <span class="text-danger">*</span></label>
                  <select name="action_schedule" class="form-select" required>
                            <option value="">Select Action</option>
                            <option value="Call">Call</option>
                            <option value="Email">Email</option>
                    </select>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">3. Date / Time</h5>
               <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" name="date" placeholder="ABC PVT LTD" required/>
                </div>
                <div class="col-md-6">
                      <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                      <input type="time" class="form-control" name="time" placeholder="ABC PVT LTD" required/>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">4. Other</h5>
               <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="date" class="form-label">AssignedTo <span class="text-danger">*</span></label>
                      <select name="assignedto" class="form-select" required>
                            <option value="">Select</option>
                            @foreach($Employee as $Emp)
                            <option value="{{$Emp->id}}">{{$Emp->first_name}}</option>
                            @endforeach
                          </select>
                </div>
                <div class="col-md-6">
                      <label for="Requirement" class="form-label">Requirement <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="requirement" placeholder="ABC" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="date" class="form-label">Notes <span class="text-danger">*</span></label>
                      <textarea class="form-control" name="note"></textarea>
                </div>
              </div>     
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/Leads/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
                    url: "{{ url('admin/Leads/getstateData') }}", // Replace with your actual route name
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
                    url: "{{ url('admin/Leads/getcityData') }}", // Replace with your actual route name
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

@endsection