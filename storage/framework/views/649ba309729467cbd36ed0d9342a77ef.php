<!-- Security List Table -->
<div class="card">
   <!--  <div class="row">
      <div class="col-md-6">
         <h5 class="card-header">Two-Factor Authentication </h5>
      </div>
      <div class="col-md-6 text-end">
         
      </div>
      </div> -->
   <div class="card-datatable table-responsive">
      <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
         <div class="row">
            <!-- div class="col-lg-12">
               <div class="border-grey mt-3 p-4 rounded-top">
                  <div class="row">
                     <div class="col-md-11">
                        <h6>Bulk Emails / Promo</h6>
                        <div class="d-flex justify-content-between">
                           <div>
                              <input type="radio" name="mail_setup" id="bsmtp" value="smtp" <?php if($Bulk && $Bulk->smtp ==
                              "1"): ?> checked <?php endif; ?> onclick="BulkMail(value)">
                              <label for="radio1">SMTP</label>
                           </div>
                           <div>
                              <input type="radio" name="mail_setup" id="bMailChimp" value="chimps" <?php if($Bulk &&
                                 $Bulk->chimps == "1"): ?> checked <?php endif; ?> onclick="BulkMail(value)" >
                              <label for="radio2">MailChimp</label>
                           </div>
                           <div>
                              <input type="radio" name="mail_setup" id="bMicrosoft" value="microsoft" <?php if($Bulk &&
                                 $Bulk->microsoft == "1"): ?> checked <?php endif; ?> onclick="BulkMail(value)" >
                              <label for="radio3">Microsoft Office</label>
                           </div>
                           <div>
                              <input type="radio" name="mail_setup" id="bGSuite" value="GSuite" <?php if($Bulk &&
                                 $Bulk->GSuite == "1"): ?> checked <?php endif; ?> onclick="BulkMail(value)" >
                              <label for="radio4">G-Suite</label>
                           </div>
                           <div>
                              <input type="radio" name="mail_setup" id="bSES" value="SES" <?php if($Bulk && $Bulk->SES ==
                              "1"): ?> checked <?php endif; ?> onclick="BulkMail(value)" >
                              <label for="radio5">SES</label>
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
                               <input type="radio" name="mail1" id="csmtp" value="smtp" <?php if($Complete && $Complete->smtp ==
                               "1"): ?> checked <?php endif; ?> onclick="Completemailsetup(value)">
                               <label for="radio1">SMTP</label>
                            </div>
                            <div>
                               <input type="radio" name="mail2" id="cMailChimp" value="chimps" <?php if($Complete &&
                                  $Complete->chimps == "1"): ?> checked <?php endif; ?> onclick="Completemailsetup(value)" >
                               <label for="radio2">MailChimp</label>
                            </div>
                            <div>
                               <input type="radio" name="mail3" id="cMicrosoft" value="microsoft" <?php if($Complete &&
                                  $Complete->microsoft == "1"): ?> checked <?php endif; ?> onclick="Completemailsetup(value)" >
                               <label for="radio3">Microsoft Office</label>
                            </div>
                            <div>
                               <input type="radio" name="mail4" id="cGSuite" value="GSuite" <?php if($Complete &&
                                  $Complete->GSuite == "1"): ?> checked <?php endif; ?> onclick="Completemailsetup(value)" >
                               <label for="radio4">G-Suite</label>
                            </div>
                            <div>
                               <input type="radio" name="mail5" id="cSES" value="SES" <?php if($Complete && $Complete->SES ==
                               "1"): ?> checked <?php endif; ?> onclick="Completemailsetup(value)" >
                               <label for="radio5">SES</label>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
               </div>
               
               -->
            <div class="col-lg-12 ">
               <div class="border-grey mt-3 p-4 rounded-top">
                  <div class="row">
                     <!--  <div class="col-md-11">
                        <h6>Setup Using Email
                        </h6>
                        <p class="mb-4 mt-2 f-14 text-dark-grey">Enabling this feature will send code on your email account
                           <b>admin@example.com</b> for log in.</p>
                        </div> -->
                  </div>
               </div>
            </div>
            <div class="col-lg-12">
               <div class="border-grey p-4 border-top-0 rounded-bottom">
                  <div class="row">
                     <div class="col-md-11">
                        <h6>Setup Using Email
                        </h6>
                        <p class="mb-4 mt-2 f-14 text-dark-grey">Enabling this feature will send code on your email account
                           <b><?php echo e(Auth::user()->login_email); ?></b> for log in.
                        </p>
                        <?php
                        $data = App\Models\OneTimeSetup::where('user_id',Auth::user()->id)->first();
                        ?>
                        <?php if($data && $data->is_authentication_enabled): ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                           data-bs-target="#backDropModal" data-val="enable">Enable</button>
                        <?php endif; ?>
                        <!--  <h6>Setup Using Google Authenticator</h6>
                           <p class="mb-4 mt-2 f-14 text-dark-grey">Use the Authenticator app to get free verification codes,
                              even when your phone is offline. Available for Android and iPhone.</p>
                             <?php
                                $data = App\Models\OneTimeSetup::where('user_id',Auth::user()->id)->first();
                             ?>
                           <?php if($data && $data->is_authentication_enabled): ?>
                           <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#backDropModal" data-val="enable">Enable</button>
                             
                                      <?php endif; ?> -->
                        <hr/>
                        <div id="qrcode">
                           <h6>Setup Using Google Authenticator</h6>
                           <h6><?php if(Auth::user()->google2fa_enabled): ?><?php echo e(Auth::user()->google2fa_enabled ? Auth::user()->first_name.' has enabled' : Auth::user()->first_name.' has not enabled'); ?> <?php endif; ?> two-factor authentication.</h6>
                           <p>When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.</p>
                           <?php if(Auth::user()->google2fa_enabled): ?>
                           <a data-bs-target="#confirmPasswordModal" data-bs-toggle="modal"><button
                              class="btn btn-danger">Disable</button></a>
                           <?php else: ?>
                           <a data-bs-target="#confirmPasswordModal" data-bs-toggle="modal"><button
                              class="btn btn-primary ">Enable</button></a>
                           <?php endif; ?>
                           <!--  <?php if(Auth::user()->google2fa_enabled): ?>
                              <a href="<?php echo e(url('admin/SecuritySettings/2fa/disable?id='.Auth::user()->id)); ?>" >
                                  <button class="btn btn-danger">Disable</button>
                              </a>
                              <?php else: ?>
                              <a href="<?php echo e(url('admin/SecuritySettings/2fa/enable?id='.Auth::user()->id)); ?>" >
                                  <button class="btn btn-primary">Enable</button>
                              </a>
                              <?php endif; ?> -->
                        </div>
                        <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;"
                           autocomplete="off">
                        <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;"
                           autocomplete="off">
                        <input type="email" name="f_email" class="autocomplete-password" readonly=""
                           style="opacity: 0;position: absolute;" autocomplete="off">
                        <input type="text" name="f_slack_username" class="autocomplete-password" readonly=""
                           style="opacity: 0;position: absolute;" autocomplete="off">
                     </div>
                  </div>
                  <div class="row" style="margin-top:25px">
                     <div class="col-md-12">
                        <form action="" method="POST" enctype="multipart/form-data">
                           <?php echo csrf_field(); ?>
                           <div class="row">
                              <div class="col-lg-12">
                                    <h5 class="heading-h4">Password Security Days</h5>
                              </div>
                              <?php 
                                 $passwordDays = App\Models\PasswordDays::first(); 
                              ?>

                              <div class="col-lg-4 mt-3">
                                    <div class="form-check">
                                       <input 
                                          class="form-check-input" 
                                          type="radio" 
                                          name="password_security_days" 
                                          id="password_security_60" 
                                          value="0" 
                                          autocomplete="off" 
                                          <?php echo e(isset($passwordDays) && $passwordDays->password_security_days == 0 ? 'checked' : ''); ?>>
                                       <label 
                                          class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 text-wrap" 
                                          for="password_security_60">
                                          60 Days
                                       </label>
                                    </div>
                              </div>

                              <div class="col-lg-4 mt-3">
                                    <div class="form-check">
                                       <input 
                                          class="form-check-input" 
                                          type="radio" 
                                          name="password_security_days" 
                                          id="password_security_90" 
                                          value="1" 
                                          autocomplete="off" 
                                          <?php echo e(isset($passwordDays) && $passwordDays->password_security_days == 1 ? 'checked' : ''); ?>>
                                       <label 
                                          class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 text-wrap" 
                                          for="password_security_90">
                                          90 Days
                                       </label>
                                    </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="confirmPasswordModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
      <div class="modal-content">
         <div class="modal-body p-3 p-md-5">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
               <h3 class="mb-2">Confirm Password</h3>
               <p>For your security, please confirm your password to continue.</p>
            </div>
            <form id="confirmPasswordForm" class="row g-3" onsubmit="return false;">
               <div class="col-12">
                  <label class="form-label" for="verify-password">For your security, please confirm your password to continue.</label>
                  <input type="password" id="verify-password" name="password" class="form-control" placeholder="Password" />
               </div>
               <div class="col-12 text-end">
                  <button type="submit" class="btn btn-primary">Confirm</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
       $('#confirmPasswordForm').submit(function(e) {
           e.preventDefault();
           var password = $("#verify-password").val();
   
           $.ajax({
               type: "POST",
               url: "<?php echo e(url('admin/match_password')); ?>",
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: {
                   password: password
               },
               success: function(response) {
                   if(response.status == 'disabled'){
                       location.reload();
                   } else {
                       $('.btn-close').click();
                       $('#qrcode').html(response);
                       $('#disable2FA').show(); 
                   }
               },
               error: function(xhr, status, error) {
                   var errorMessage = xhr.responseJSON.error;
                   alert("Error: " + errorMessage);
               }
           });
       });
   
       $(document).on('click','#cancelAuth',function(){
           $('#qrcode').html('<h5>You have not enabled two factor authentication.</h5>' +
               '<p>When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.</p><a data-bs-target="#confirmPasswordModal" data-bs-toggle="modal"><button class="btn btn-primary">Enable</button></a>'
           );
       });
   
       function BulkMail(value) {
           var type = "Bulk";
           $.ajax({
               url: "<?php echo e(url('admin/MailSettings/MailViaUpdate')); ?>",
               type: "get",
               data: { value: value, type: type, _token: "<?php echo e(csrf_token()); ?>" },
               success: function(response) {
                   location.reload();
               },
               error: function(error) {
                   console.log('Error:', error);
               }
           });
       }
   
       function Completemailsetup(value) {
           var type = "Complete";
           $.ajax({
               url: "<?php echo e(url('admin/MailSettings/MailViaUpdate')); ?>",
               type: "get",
               data: { value: value, type: type, _token: "<?php echo e(csrf_token()); ?>" },
               success: function(response) {
                   location.reload();
               },
               error: function(error) {
                   console.log('Error:', error);
               }
           });
       }
   
       // Attach BulkMail and Completemailsetup functions to the radio buttons
       $('input[name="mail_setup"]').change(function() {
           BulkMail($(this).val());
       });
   
       $('input[name="mail1"], input[name="mail2"], input[name="mail3"], input[name="mail4"], input[name="mail5"]').change(function() {
           Completemailsetup($(this).val());
       });
   });

      // Attach change event to the radio buttons
   document.querySelectorAll('input[name="password_security_days"]').forEach((radio) => {
         radio.addEventListener('change', function() {
            // Get the selected value
            const selectedValue = this.value;

            // Prepare the AJAX request
            fetch("<?php echo e(url('admin/updatePasswordDays')); ?>", {
                  method: "POST",
                  headers: {
                     "Content-Type": "application/json",
                     "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                  },
                  body: JSON.stringify({
                     password_security_days: selectedValue
                  })
            })
            .then(response => response.json())
            .then(data => {
                  if (data.success) {
                     alert(data.message); // Display success message
                  } else {
                     alert(data.message || "An error occurred."); // Display error message
                  }
            })
            .catch(error => {
                  console.error("Error:", error);
                  alert("An unexpected error occurred.");
            });
         });
   });

</script><?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/SecuritySettings/home.blade.php ENDPATH**/ ?>