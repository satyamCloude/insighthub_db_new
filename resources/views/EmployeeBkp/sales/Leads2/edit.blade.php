@extends('layouts.admin')
@section('title', 'Leads')
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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leads /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Leads/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Leads/update/'.$user->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="input-group mb-4">
                          <select name="gender" class="form-select">
                            <option>Select Gender</option>
                            <option @if($user && $user->gender == "Mr") selected @endif value="Mr"> Mr.</option>
                            <option @if($user && $user->gender == "Miss") selected @endif value="Mr"> Miss.</option>
                          </select>
                          <input type="text" name="first_name" @if($user && $user->first_name) value="{{$user->first_name}}" @endif placeholder="First name" class="form-control" />
                          <input type="text" name="last_name" @if($user && $user->last_name) value="{{$user->last_name}}" @endif placeholder="Last name" class="form-control"/>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" name="email" @if($user && $user->email) value="{{$user->email}}" @endif placeholder="name@example.com"/>
                </div>
                <div class="col-md-6">
                      <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="phone_number" @if($user && $user->phone_number) value="{{$user->phone_number}}" @endif  placeholder="+1234156789"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="company_id" class="form-label">Company Name <span class="text-danger">*</span></label>
                      <select name="company_id" class="form-select" required>
                            @foreach($Company as $Company)
                            <option  @if($user && $user->company_id ==  $Company->id) selected @endif value="{{$Company->id}}">{{$Company->company_name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                      <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                      <select name="status" class="form-select">
                            <option @if($user && $user->status ==  "1") selected @endif value="1">InProgress</option>
                            <option @if($user && $user->status ==  "2") selected @endif value="2">Win</option>
                            <option @if($user && $user->status ==  "3") selected @endif value="3">Loss</option>
                    </select>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Lead</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                  <label for="date" class="form-label">Lead Source  <span class="text-danger">*</span></label>
                    <select name="lead_source" class="form-select">
                            <option value="">Select Lead</option>
                            @foreach($leads as $leadsource)
                            <option  @if($user && $user->lead_source == $leadsource->id) selected @endif value="{{$leadsource->id}}">{{$leadsource->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-md-6 ">
                  <label for="date" class="form-label">Action Schedule  <span class="text-danger">*</span></label>
                  <select name="action_schedule" class="form-select">
                            <option value="">Select Action</option>
                            <option @if($user && $user->action_schedule == "Call") selected @endif value="Call">Call</option>
                            <option @if($user && $user->action_schedule == "Email") selected @endif value="Email">Email</option>
                    </select>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">3. Date / Time</h5>
               <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" name="date" @if($user && $user->date) value="{{$user->date}}" @endif/>
                </div>
                <div class="col-md-6">
                      <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                      <input type="time" class="form-control" name="time" @if($user && $user->time) value="{{$user->time}}" @endif/>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">4. Other</h5>
               <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="date" class="form-label">AssignedTo <span class="text-danger">*</span></label>
                      <select name="assignedto" class="form-select">
                            <option value="">Select</option>
                            @foreach($Employee as $Emp)
                            <option @if($user && $user->assignedto == $Emp->id) selected @endif  value="{{$Emp->id}}">{{$Emp->first_name}}</option>
                            @endforeach
                          </select>
                </div>
                <div class="col-md-6">
                      <label for="Requirement" class="form-label">Requirement <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="requirement" @if($user && $user->requirement) value="{{$user->requirement}}" @endif placeholder="ABC"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="note" class="form-label">Notes <span class="text-danger">*</span></label>
                       <div class="editor-container">
                            <div class="full-editor geteditor">@if($user && $user->note) {!!$user->note!!} @endif</div>
                            <input type="hidden" name="note" @if($user && $user->note) value="{{$user->note}}" @endif class="hidden-field">
                        </div>
                </div>
              </div>     
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Leads/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
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
                    url: "{{ url('Employee/Leads/getstateData') }}", // Replace with your actual route name
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
                    url: "{{ url('Employee/Leads/getcityData') }}", // Replace with your actual route name
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