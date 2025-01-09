
  <!-- Security List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Two-Factor Authentication </h5>
      </div>
      <div class="col-md-6 text-end">
        <!-- <a href="{{url('admin/Security/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a> -->
          <!-- <a href="{{url('admin/Security/add')}}" class="btn btn-primary mt-3 m-3">Add</a> -->
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
        
       <div class="row">
            <div class="col-lg-12">
                <div class="border-grey mt-3 p-4 rounded-top">
                        <div class="row">
                       
                        <div class="col-md-11">
                            <h6>Bulk Emails / Promo</h6>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <input type="radio" name="mail_setup" id="bsmtp" value="smtp" @if($Bulk && $Bulk->smtp == "1") checked @endif  onclick="BulkMail(value)">
                                    <label for="radio1">Via SMTP</label>
                                </div>
                                <div>
                                    <input type="radio" name="mail_setup" id="bMailChimp" value="chimps" @if($Bulk && $Bulk->chimps == "1") checked @endif onclick="BulkMail(value)"  >
                                    <label for="radio2">Via MailChimp</label>
                                </div>
                                <div>
                                    <input type="radio" name="mail_setup" id="bMicrosoft" value="microsoft" @if($Bulk && $Bulk->microsoft == "1") checked @endif  onclick="BulkMail(value)"  >
                                    <label for="radio3">Via Microsoft Office</label>
                                </div>
                                <div>
                                    <input type="radio" name="mail_setup" id="bGSuite" value="GSuite" @if($Bulk && $Bulk->GSuite == "1") checked @endif  onclick="BulkMail(value)"  >
                                    <label for="radio4">Via G-Suite</label>
                                </div>
                                <div>
                                    <input type="radio" name="mail_setup" id="bSES" value="SES" @if($Bulk && $Bulk->SES == "1") checked @endif  onclick="BulkMail(value)"  >
                                    <label for="radio5">Via SES</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                <div class="col-lg-12">
                    <div class="border-grey mt-3 p-4 rounded-top">
                        <div class="row">
                           
                            <div class="col-md-11">
                                <h6>Complete system</h6>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <input type="radio" name="mail1" id="csmtp" value="smtp" @if($Complete && $Complete->smtp == "1") checked @endif  onclick="Completemailsetup(value)">
                                        <label for="radio1">Via SMTP</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="mail2" id="cMailChimp" value="chimps" @if($Complete && $Complete->chimps == "1") checked @endif onclick="Completemailsetup(value)"  >
                                        <label for="radio2">Via MailChimp</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="mail3" id="cMicrosoft" value="microsoft" @if($Complete && $Complete->microsoft == "1") checked @endif   onclick="Completemailsetup(value)"  >
                                        <label for="radio3">Via Microsoft Office</label>
                                    </div>
                                    <div>
                                    <input type="radio" name="mail4" id="cGSuite" value="GSuite" @if($Complete && $Complete->GSuite == "1") checked @endif  onclick="Completemailsetup(value)"  >
                                    <label for="radio4">Via G-Suite</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="mail5" id="cSES" value="SES" @if($Complete && $Complete->SES == "1") checked @endif  onclick="Completemailsetup(value)"  >
                                        <label for="radio5">Via SES</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              
                <div class="col-lg-12 ">
                    <div class="border-grey mt-3 p-4 rounded-top">
                        <div class="row">
                            
                            <div class="col-md-11">
                                <h6>Setup Using Email                                    
                                </h6>
                                <p class="mb-4 mt-2 f-14 text-dark-grey">Enabling this feature will send code on your email account <b>admin@example.com</b> for log in.</p>
                                                            </div>
                        </div>
                    </div>
                </div>
            
              <div class="col-lg-12">
                            <div class="border-grey p-4 border-top-0 rounded-bottom">
                        <div class="row">
                                   
                                    <div class="col-md-11">
                                        <h6>Setup Using Google Authenticator</h6>
                                        <p class="mb-4 mt-2 f-14 text-dark-grey">Use the Authenticator app to get free verification codes, even when your phone is offline. Available for Android and iPhone.</p>
                                    
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#backDropModal">Enable</button>
                                                <button type="button" class="btn btn-danger" id="disabl">Disable</button>


                                        <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;" autocomplete="off">
                                        <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;" autocomplete="off">
                                        <input type="email" name="f_email" class="autocomplete-password" readonly="" style="opacity: 0;position: absolute;" autocomplete="off">
                                        <input type="text" name="f_slack_username" class="autocomplete-password" readonly="" style="opacity: 0;position: absolute;" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

 
                        <!-- Modal -->
            <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
                <div class="modal-dialog">
                <form method="POST" id="reset-password-form" action="{{ url('admin/SecuritySettings/confirm_password') }}" class="ajax-form modal-content" autocomplete="off">
                    @csrf
                    <input type="hidden" id="redirect_url" name="redirect_url" value="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                              <div class="modal-header" style="flex-direction:column;">
                                <h5 class="modal-title" id="backDropModalTitle">Authentication Required</h5>
                                <br/>
                                <span style="color:red" id="err_msg"></span>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Your Password</label>
                                      
                                <div class="input-group-append d-flex">
                                   <input type="password" name="password" id="password" autocomplete="off" placeholder="Please enter your password" class="form-control height-50 f-14">
                                   <input type="hidden" name="log_user_id" id="log_user_id" value="{{ Auth::user()->id }}">
                                   <button type="button" data-toggle="tooltip" data-original-title="Show/Hide Value" class="btn btn-outline-secondary border-grey height-50 toggle-password"><i class="fa fa-eye"></i> </button>
                                </div>
                                  </div>
                                </div>
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary" onclick="checkPass()">Confirm Password</button>
                              
                              </div>
                            </form>
                          </div>
                        </div>

</div>

<script>
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