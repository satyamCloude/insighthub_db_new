@extends('layouts.admin')
@section('title', 'Leads')
@section('content')
<style>


  .numcode{

      padding-right: 3px;
    }

    .inpt:focus {
      outline:none;
      border:none;
    }

    .dropdown-toggle::after {
      vertical-align: 0em;
    }

    .btn:hover {
      background-color: transparent;
      color:#6c757d;
    }

    .outline {
      outline:1px solid lightgrey;
    }




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
.light-style .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 2.25rem;
    color: #6f6b7d;
    padding-left: 0.875rem;
    width: 200px;
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
              <a href="{{url('admin/Leads/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/Leads/update/'.$user->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="input-group mb-4">
                  <!--<select name="gender" class="form-control select2">-->
                  <!--  <option>Select Gender</option>-->
                  <!--  <option @if($user && $user->gender == "Mr") selected @endif value="Mr"> Mr.</option>-->
                  <!--  <option @if($user && $user->gender == "Miss") selected @endif value="Mr"> Miss.</option>-->
                  <!--</select>-->
                  <input type="text" name="first_name" @if($user && $user->first_name) value="{{$user->first_name}}" @endif placeholder="First name" class="form-control"  required/>
                  <input type="text" name="last_name" @if($user && $user->last_name) value="{{$user->last_name}}" @endif placeholder="Last name" class="form-control" required/>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="email" class="form-label"> Email address <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" name="email" @if($user && $user->email) value="{{$user->email}}" @endif placeholder="name@example.com" required/>
                </div>
                <div class="col-md-6">
                      <label for="phone_number" class="form-label"> Contact No <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="phone_number" @if($user && $user->phone_number) value="{{$user->phone_number}}" @endif  placeholder="+1234156789" required maxlength="12"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="company_id" class="form-label"> Company Name <span class="text-danger">*</span></label>
                     <input type="text" class="form-control" name="company_name" @if($user && $user->company_name) value="{{$user->company_name}}" @endif  placeholder="company name" required/>
                </div>
                <div class="col-md-6">
                      <label for="status" class="form-label"> Status <span class="text-danger">*</span></label>
                      <select name="status" class="form-control select2">
                        @foreach($leadStatus as $status)
                            <option @if($user && $user->status ==  $status->id) selected @endif value="{{$status->id}}">{{ucfirst($status->lead_status)}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Lead</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                  <label for="date" class="form-label">Lead Source  <span class="text-danger">*</span></label>
                    <select name="lead_source" class="form-control select2" required>
                            <option value="">Select Lead</option>
                            @foreach($leads as $leadsource)
                            <option  @if($user && $user->lead_source == $leadsource->id) selected @endif value="{{$leadsource->id}}">{{$leadsource->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-md-6 ">
                  <label for="date" class="form-label">Action Schedule  <span class="text-danger">*</span></label>
                            <option value="">Select Action</option>
                         
                          <select name="action_schedule" id="select2Icons" class="select2-icons form-select" required>
                            <optgroup label="Services">
                              <option @if($user && $user->action_schedule == "Call") selected @endif value="Call" data-icon="ti ti-brand-bootstrap" selected>Call</option>
                              <option  @if($user && $user->action_schedule == "Email") selected @endif value="Email"  data-icon="ti ti-brand-codepen">Email</option>
                             
                            </optgroup>

                           
                          </select>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">3. Date / Time</h5>
               <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" name="date" @if($user && $user->date) value="{{$user->date}}" @endif required/>
                </div>
                <div class="col-md-6">
                      <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                      <input type="time" class="form-control" name="time" @if($user && $user->time) value="{{$user->time}}" @endif required/>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">4. Other</h5>
               <div class="row mb-4"> 
                <!--<div class="col-md-6">-->
                <!--      <label for="date" class="form-label">AssignedTo <span class="text-danger">*</span></label>-->
                <!--      <select name="assignedto" class="form-control select2">-->
                <!--            <option value="">Select</option>-->
                <!--            @foreach($Employee as $Emp)-->
                <!--            <option @if($user && $user->assignedto == $Emp->id) selected @endif  value="{{$Emp->id}}">{{$Emp->first_name}}</option>-->
                <!--            @endforeach-->
                <!--          </select>-->
                <!--</div>-->
                   <div class="col-md-6">
                <label for="client_id" class="form-label">AssignedTo <span class="text-danger">*</span></label>
                <div class="dropdown">
                  <!--<button class="dropbtn" id="selected_client_btn2">AssignedTo <i class="fa fa-angle-down" style="font-size:24px"></i></button>-->
                  <button class="dropbtn" >
                     <div>
                         @php
                            // Use the `firstWhere` collection method to find the first client matching the Ticket's ccid
                            $client = collect($Employee)->firstWhere('id', $user->assignedto);
                    
                            // Use null coalescence operator to handle the case when $client is null
                            $src = $client->profile_img ?? 'https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg';
                            $first_name = $client->first_name ?? '';
                            $last_name = $client->last_name ?? '';
                            $id = $client->id ?? '';
                            $jobrole = $client->jobrole ?? '';
                        @endphp
                    
                        <!-- Use the variables initialized above -->
                        <img src="{{ $src }}" style="width:30px; border-radius:50%; height:30px;" id="selected_client_img" alt="Client Image">
                        <span id="selected_client_btn2">{{ $first_name }} {{ $last_name }} ({{ $jobrole }})</span>
                    </div>
                    <i class="fa fa-angle-down" style="font-size:24px"></i>
                  </button>
                  
                  <div class="dropdown-content">
                      @foreach($Employee as $CCID)
                    <div class="outer" id="clients_{{ $CCID->id }}" style="display:flex;margin:6px;padding:4px;color:black;" 
                    onclick="selectClient2('{{ $CCID->id }}','{{$CCID->profile_img}}')">
                      @if($CCID->profile_img)<img src="{{ $CCID->profile_img }}" style="width:45px;border-radius:50%;height:45px;">
                      @else
                      <img src="{{ url('public/images/emp_proa4NN.jpg') }}" style="width:45px;border-radius:50%;height:45px;">
                      @endif
                      <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                        <span>{{ $CCID->first_name }} {{$CCID->last_name}} (#{{ $CCID->id }}) <br/>{{$CCID->jobrole}}</span>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
                <input type="hidden" name="assignedto" id="set_client_id2">
              </div>
                <!-- <div class="col-md-3">-->
                <!--      <label for="Requirement" class="form-label">Requirement <span class="text-danger">*</span></label>-->
                <!--      <input type="text" class="form-control" name="requirement" @if($user && $user->requirement) value="{{$user->requirement}}" @endif placeholder="ABC"/>-->
                <!--</div>-->
                <div class="col-md-3">
                      <label for="RequirementAmt" class="form-label">Amount<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="requirement_amt" @if($user && $user->requirement_amt) value="{{$user->requirement_amt}}" @endif placeholder="2000"/>
                </div>
                  <div class="col-md-3">
                      <label for="RequirementAmt" class="form-label">Add File<span class="text-danger">*</span></label>
                      <input type="file" name="file[]" id="files" class="form-control" multiple accept="image/jpeg, image/png, image/gif,"><br />
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-12">
                     <label for="note" class="form-label">Requirement <span class="text-danger">*</span></label>
                <div class="editor-container">
                    <div class="full-editor geteditor">{!! $user->requirement ?? '' !!}</div>
                        <input type="hidden" name="requirement" class="hidden-field" required>

                </div>
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
<!-- / Content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  numberCount = 1;
  $(document).ready(function() {
    $('#multiselect11').selectpicker();

    $('#services').change(function() {
      var selectedServiceId = $(this).val();
      var selectedClientId = $('#client_id').val();

      $('#services_type').show();
      // $('input.cost_per_item').val('');

      if (selectedServiceId && selectedClientId) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: 'GET',
          url: "{{url('admin/Invoices/get_selected_product_plan')}}",
          data: {
            selectedServiceId: selectedServiceId,
            selectedClientId: selectedClientId,
          },
          success: function(res) {
            console.log(res);
            $('.select2').select2(); // Make sure to adjust this based on your actual Select2 initialization method
          },
        });
      }
    });

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
<script>
    $(document).ready(function () {
      // Function to update the hidden field with the editor content
      function updateHiddenField() {
        var editorContentText = $(".full-editor.geteditor").html();
        console.log("Editor content: " + editorContentText);

        // Update the hidden field with the editor content
        $('.hidden-field').val(editorContentText);
      }

      // Update the hidden field on keyup and blur events
      $(document).on('keyup blur', '.full-editor.geteditor', function () {
        updateHiddenField();
      });

      // Initial update on page load
      updateHiddenField();
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
          url: "{{url('admin/Invoices/getClientDetails')}}/"+id,
          
          success: function(res) {
            console.log(res);// Make sure to adjust this based on your actual Select2 initialization method
            // alert(res.data.address_1 );
            $('#shipping_address').val(res.data.address_1 +', '+ res.data.address_2);
                  dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';

          },
        });
    }
    numberCount2 = 1;


    function selectClient2(id,src) {
      
      var clientName = $('#clients_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
      $('#selected_client_img').attr('src', src);
      $('#selected_client_btn2').text(clientName); // Set the button text to the selected client name
      $('#set_client_id2').val(id); // Set the button text to the selected client name

      $('.dropdown-content .outer').removeClass('selected');

      // Add the 'selected' class to the clicked option
      $('#clients_' + id).addClass('selected');

      $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type: 'GET',
            url: "{{url('admin/Invoices/getClientDetails')}}/"+id,
            
            success: function(res) {
              console.log(res);// Make sure to adjust this based on your actual Select2 initialization method
              // alert(res.data.address_1 );
              $('#shipping_address').val(res.data.address_1 +', '+ res.data.address_2);
            },
          });
    }
</script>
@endsection