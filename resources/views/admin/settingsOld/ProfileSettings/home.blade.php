
                      <div class="card">
                        <div class="row">
                          <div class="col-md-6">
                              <h5 class="card-header">Profile Settings</h5>
                          </div>
                          <div class="col-md-6 text-end">
                          </div>
                          <div class="col-md-12">
                            <form action="{{url('admin/ProfileSettings/store')}}" method="post" enctype="multipart/form-data"> 
                                            @csrf
                                            <div class="card-body">
                                              <div class="row mb-4"> 
                                              <div class="col-md-6 d-flex">
                                                        <div class="col-md-6">
                                                            <label for="profilePictureInput" class="form-label"><h5>Profile Picture<span class="text-danger">*</span></h5></label>
                                                            <div class="custom-file-input-container" onclick="document.getElementById('profilePictureInput').click();">
                                                                <div class="custom-file-input">
                                                                    <span id="profile_picture">Choose File</span>
                                                                </div>
                                                            </div>
                                                            <input type="file" name="profile_picture" id="profilePictureInput" class="form-control" style="display: none;" onchange="displayFileName('profilePictureInput', 'profile_picture')">
                                                        </div>
                                                        <div class="col-md-5 text-center">
                                                            @if($chk_exst && $chk_exst->profile_picture)
                                                                <img src="{{ url($chk_exst->profile_picture) }}"  height="50px" width="50px">
                                                            @endif
                                                        </div>
                                                    </div>

                                                       
                                                    </div>

                                            <div class="row mb-4"> 
                                                <div class="col-md-4">
                                                              <label for="User_ip_address" class="form-label"><h5>First Name<span class="text-danger">*</span></h5></label><br>
                                                              <div class="form-group mb-0">
                                                               <input type="text" name="first_name" id="first_name"  value="{{ $user_details->first_name }}" required class="form-control "  autocomplete="off">
                                                             </div>
                                                        </div>
                                                <div class="col-md-4">
                                                              <label for="User_ip_address" class="form-label"><h5>Last Name<span class="text-danger">*</span></h5></label><br>
                                                              <div class="form-group mb-0">
                                                               <input type="text" name="last_name" id="last_name" value="{{ $user_details->last_name }}" required class="form-control "  autocomplete="off">
                                                             </div>
                                                        </div>
                                                <div class="col-md-4">
                                                              <label for="User_ip_address" class="form-label"><h5>Email<span class="text-danger">*</span></h5></label><br>
                                                              <div class="form-group mb-0">
                                                               <input type="email" name="email" id="email" value="{{ $user_details->email }}"  readonly required class="form-control "  autocomplete="off">
                                                             </div>
                                                        </div>
                                            </div>  
                                            

                                            <div class="row mb-4"> 
                                                <div class="col-md-4 ">
                                                              <label for="User_ip_address" class="form-label"><h5>Receive email notifications?<span class="text-danger">*</span></h5></label><br>
                                                              <div class="form-group mb-0">
                                                    <div class="d-flex">
                                                                        <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                                        <input type="radio" value="1" class="custom-control-input" id="login-yes" name="email_notifications" checked="" autocomplete="off">
                                                        <label class="custom-control-label pt-1 cursor-pointer" for="login-yes">Enable</label>
                                                    </div>
                                                                        <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                                        <input type="radio" value="0" class="custom-control-input" id="login-no" name="email_notifications" autocomplete="off">
                                                        <label class="custom-control-label pt-1 cursor-pointer" for="login-no">Disable</label>
                                                    </div>
                                                                    </div>                       
                                                  </div>
                                                </div> 
                                                <div class="col-md-4 ">
                                                              <label for="User_ip_address" class="form-label"><h5>Enable RTL Theme (Right to Left) ?<span class="text-danger">*</span></h5></label><br>
                                                              <div class="form-group mb-0">
                                                                <div class="d-flex">
                                                                                <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                                                <input type="radio" value="1" class="custom-control-input" id="rtl-yes" name="rtl" autocomplete="off">
                                                                <label class="custom-control-label pt-1 cursor-pointer" for="rtl-yes">Yes</label>
                                                            </div>
                                                                                <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                                                <input type="radio" value="0" class="custom-control-input" id="rtl-no" name="rtl" checked="" autocomplete="off">
                                                                <label class="custom-control-label pt-1 cursor-pointer" for="rtl-no">No</label>
                                                            </div>
                                                                            </div>                  
                                                              </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                              <label for="User_ip_address" class="form-label"><h5>Enable Google Calender ?<span class="text-danger">*</span></h5></label><br>
                                                              <div class="form-group mb-0">
                                                                   <div class="d-flex">
                                                                        <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                                        <input type="radio" value="1" class="custom-control-input" id="google_calendar_status-yes" name="google_calendar_status" checked="" autocomplete="off">
                                                        <label class="custom-control-label pt-1 cursor-pointer" for="google_calendar_status-yes">Yes</label>
                                                    </div>
                                                                        <div class="form-check-inline custom-control custom-radio mt-2 mr-3">
                                                        <input type="radio" value="0" class="custom-control-input" id="google_calendar_status-no" name="google_calendar_status" autocomplete="off">
                                                        <label class="custom-control-label pt-1 cursor-pointer" for="google_calendar_status-no">No</label>
                                                    </div>
                                                                    </div>                   
                                                              </div>
                                                </div>
                                            
                                               
                                            </div> 

                                              <div class="row mb-4"> 
                                                <div class="col-md-4 ">
                                                              <label for="User_ip_address" class="form-label"><h5>Country<span class="text-danger">*</span></h5></label><br>
                                                            <select name="country" id="country" class="form-control select2">
                                                               
                                                                @foreach($country as $countrs)
                                                                <option value="{{$countrs->id}}" {{ $user_details->country_id == $countrs->id ? 'selected':''}}>{{$countrs->name}}</option>
                                                                @endforeach
                                                            </select>
                                                </div> 
                                                <div class="col-md-4 ">
                                                              <label for="User_ip_address" class="form-label"><h5>Mobile<span class="text-danger">*</span></h5></label><br>
                                                                   <input type="number"   value="{{ $user_details->phone_number }}"  name="phone_number" id="phone_number"  required class="form-control "  autocomplete="off">

                                                </div>
                                                <div class="col-md-4 ">
                                                              <label for="User_ip_address" class="form-label"><h5>Change Language<span class="text-danger">*</span></h5></label><br>
                                                              <select name="language" id="country" class="form-control">
                                                             
                                                                <option value="eng">English</option>
                                                            </select>
                                                </div>
                                            
                                               
                                            </div>  
                                                <div class="row mb-4"> 
                                                 
                                                    
                                                    <div class="col-md-4 ">
                                                              <label for="User_ip_address" class="form-label"><h5>Gender<span class="text-danger">*</span></h5></label><br>
                                                              <select name="gender" id="gender" class="form-control">
                                                             
                                                                <option value="male"  {{ $user_details->gender =='male' ? 'selected':''}}>Male</option>
                                                                <option value="female"  {{ $user_details->gender =='female' ? 'selected':''}}>Female</option>
                                                                <option value="other"  {{ $user_details->gender =='other' ? 'selected':''}}>Other</option>
                                                            </select>
                                                  </div> <div class="col-md-4 ">
                                                              <label for="User_ip_address" class="form-label"><h5>Marital Status<span class="text-danger">*</span></h5></label><br>
                                                              <select name="merital_status" id="merital_status" class="form-control">
                                                             
                                                                <option value="single" {{ $user_details->merital_status =='single' ? 'selected':''}}>Single</option>
                                                                <option value="merried" {{ $user_details->merital_status == 'merried' ? 'selected':''}}>Married</option>
                                                            </select>
                                                </div> 
                                                <div class="col-md-12 mt-4">
                                                              <label for="User_ip_address" class="form-label"><h5>Your Address<span class="text-danger">*</span></h5></label><br>
                                                             <textarea required class="form-control " name="address" autocomplete="off">{{ $user_details->address }}</textarea>

                                                </div>
                                                <div class="col-md-12 mt-4">
                                                              <label for="User_ip_address" class="form-label"><h5>About<span class="text-danger">*</span></h5></label><br>
                                                             <textarea class="form-control " name="about" autocomplete="off">{{ $user_details->about }}</textarea>

                                                </div>
                                             </div> 
                                             
                                            </div>
                                            <div class="card-footer">
                                              <div class="row mb-4"> 
                                                <div class="col-md-6 text-end" >
                                                  <button  onclick="Tab(value)" value="Profile" type="button" class="btn btn-outline-danger">Discard</button>
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
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });
    function displayFileName(inputId, displayId) {
        var input = document.getElementById(inputId);
        var display = document.getElementById(displayId);
        
        if (input.files.length > 0) {
            var fileName = input.files[0].name;
            display.innerText = fileName;
        } else {
            display.innerText = 'Choose File';
        }
    }
    function checkPass() {
           var passwordInput = $('#password').val();
        var userId = $('#log_user_id').val();

        // Perform any client-side validation if needed

        // Example: Check if the password is not empty
        if (passwordInput.trim() === "") {
            alert("Please enter your password.");
            return;
        }

        // You can perform additional client-side logic here if needed

        // Perform AJAX request to check the password on the server side
          $.ajax({
            url: "{{ url('admin/SecuritySettings/confirm_password') }}",
            type: "POST",
            data: { password: passwordInput, user_id: userId, _token: "{{ csrf_token() }}" },
            success: function (response) {
                if (response.status === 'success') {
                    console.log('Password is correct');
                    $("#err_msg").text('');
                    $("#password").val('');
                    $("#disabl").show(); // Show the enable button
                    $('#backDropModal').modal('hide');
                } else {
                    $("#disabl").hide(); // Hide the enable button
                    $("#err_msg").text('Password is incorrect. Please enter the correct password.');
                }
            },
            error: function (error) {
                $("#disabl").show(); // Show the enable button in case of an error
                console.log('Error:', error);
            }
        });
    }

    $(document).ready(function () {
        $('#submit-login').on('click', function () {
            var passwordInput = $('#password').val();

            // Perform AJAX request to check the password against the database
            $.ajax({
                url: "",
                type: "POST",
                data: { password: passwordInput, _token: "{{ csrf_token() }}" },
                success: function (response) {
                    // Handle the response from the server
                    if (response.success) {
                        // Password is correct, proceed with further actions
                        // You can update this part based on your application's logic
                        console.log('Password is correct');
                    } else {
                        // Password is incorrect, show an error message or take appropriate action
                        console.log('Password is incorrect');
                    }
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        });
    });


    $(document).ready(function () {
        $('.toggle-password').on('click', function () {
            var passwordInput = $('#password');
            var icon = $(this).find('i');
            // Toggle the type attribute of the password input
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });

function BulkMail(value)
{
    var type = "Bulk"; 
     $.ajax({
                url: "{{ url('admin/MailSettings/MailViaUpdate') }}",
                type: "get",
                data: { value: value, type: type, _token: "{{ csrf_token() }}" },
                success: function (response) {
                   location.reload();
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
}

function Completemailsetup(value)
{
    var type = "Complete";
     $.ajax({
                url: "{{ url('admin/MailSettings/MailViaUpdate') }}",
                type: "get",
                data: { value: value,type: type, _token: "{{ csrf_token() }}" },
                success: function (response) {
                   location.reload();
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
}

</script>