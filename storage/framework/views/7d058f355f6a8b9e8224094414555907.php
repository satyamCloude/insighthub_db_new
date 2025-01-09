<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"/>
<style>
.modal-dialog {
    max-width: 90%;
}

#image {
    max-width: 100%;
    height: auto;
}

</style>

<div class="card">
    <div class="row">
        <div class="col-md-6">
            <h5 class="card-header">Profile Settings</h5>
        </div>
        <div class="col-md-6 text-end">
        </div>
        <div class="col-md-12">
            <form action="<?php echo e(url('admin/ProfileSettings/store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 d-flex">
                            <div class="col-md-12">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img alt="user-avatar" class="d-block w-px-100  rounded" id="uploadedProfile"
                                        <?php if($user_details->profile_img): ?> src="<?php echo e($user_details->profile_img); ?>" <?php else: ?> src="<?php echo e(url('/')); ?>/public/images/default_profile.jpg" <?php endif; ?>>
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light"
                                            tabindex="0"
                                            onclick="document.getElementById('profilePictureInput').click();">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                        </label>
                                        <!-- <button type="button" class="btn btn-label-secondary account-image-reset mb-3 waves-effect">
                                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                      </button> -->

                                        <div class="text-muted">Allowed JPG, GIF or PNG.</div>
                                    </div>
                                </div>
                                <!-- <div class="custom-file-input-container"onclick="document.getElementById('profilePictureInput').click();"
                                  >
                                  <div class="custom-file-input">
                                      <span id="profile_picture">Choose File</span>
                                  </div>
                              </div> -->
                                <input type="file" name="profile_picture" id="profilePictureInput"
                                    class="form-control image" style="display: none;"
                                    accept="images/*">
                            </div>
            
                        </div>
                        <div class="col-md-12 d-flex mt-4">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img alt="user-avatar" class="d-block   rounded" id="uploadedBanner" style="width:38%"
                                        <?php if($user_details->banner): ?> src="<?php echo e($user_details->banner); ?>" <?php else: ?> src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/pages/profile-banner.png" <?php endif; ?>>
                                    <div class="button-wrapper mt-1">
                                        <label for="upload" class="btn btn-primary me-2 mb-1  waves-effect waves-light"
                                            tabindex="0"
                                            onclick="document.getElementById('banner').click();">
                                            <span class="d-none d-sm-block">Upload new banner</span>
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                        </label>
                                        <div class="text-muted">Allowed JPG, GIF or PNG.</div>
                                    </div>
                                </div>
                                    
                                <input type="file" name="banner" id="banner"
                                    class="form-control" style="display: none;"
                                    onchange="readURL(this,'uploadedBanner')"
                                    accept="images/*">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="User_ip_address" class="form-label">
                                <h5>First Name<span class="text-danger">*</span></h5>
                            </label><br>
                            <div class="form-group mb-0">
                                <input type="text" name="first_name" id="first_name"
                                    value="<?php echo e($user_details->first_name); ?>" required class="form-control "
                                    autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="User_ip_address" class="form-label">
                                <h5>Last Name<span class="text-danger">*</span></h5>
                            </label><br>
                            <div class="form-group mb-0">
                                <input type="text" name="last_name" id="last_name"
                                    value="<?php echo e($user_details->last_name); ?>" required class="form-control "
                                    autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="User_ip_address" class="form-label">
                                <h5>Email<span class="text-danger">*</span></h5>
                            </label><br>
                            <div class="form-group mb-0">
                                <input type="email" name="email" id="email" value="<?php echo e($user_details->email); ?>"
                                     required class="form-control " autocomplete="off">
                            </div>
                        </div>
                        
                            <!--                       <div class="col-md-4 mt-4">-->
                            <!--    <label for="old_password" class="form-label">-->
                            <!--        <h5>Old Password</h5>-->
                            <!--    </label><br>-->
                            <!--    <div class="form-password-toggle">-->
                            <!--        <div class="input-group input-group-merge">-->
                            <!--            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="············" aria-describedby="basic-default-password">-->
                            <!--            <span class="input-group-text cursor-pointer toggle-password" data-target="old_password"><i class="ti ti-eye-off"></i></span>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <!--<div class="col-md-4 mt-4">-->
                            <!--    <label for="new_password" class="form-label">-->
                            <!--        <h5>New Password</h5>-->
                            <!--    </label><br>-->
                            <!--    <div class="form-password-toggle">-->
                            <!--        <div class="input-group input-group-merge">-->
                            <!--            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="············" aria-describedby="basic-default-password">-->
                            <!--            <span class="input-group-text cursor-pointer toggle-password" data-target="new_password"><i class="ti ti-eye-off"></i></span>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->



                        <div class="col-md-4 mt-4">
                            <label for="phone_number" class="form-label">
                                <h5>Mobile<span class="text-danger">*</span></h5>
                            </label><br>
                            <input type="number" value="<?php echo e($user_details->phone_number); ?>" name="phone_number"
                                id="phone_number" required="" class="form-control" autocomplete="off"
                                oninput="javascript: if (this.value.length > 10) this.value = this.value.slice(0, 10);">

                        </div>

                        <div class="col-md-4 mt-4">
                            <label for="User_ip_address" class="form-label">
                                <h5>Gender<span class="text-danger">*</span></h5>
                            </label><br>
                            <select name="gender" id="gender" class="form-control">

                                <option value="male" <?php echo e($user_details->gender == 'male' ? 'selected' : ''); ?>>Male
                                </option>
                                <option value="female" <?php echo e($user_details->gender == 'female' ? 'selected' : ''); ?>>Female
                                </option>
                                <option value="other" <?php echo e($user_details->gender == 'other' ? 'selected' : ''); ?>>Other
                                </option>
                            </select>
                        </div>

                        <div class="col-md-4 mt-4">
                            <label for="User_ip_address" class="form-label">
                                <h5>Marital Status<span class="text-danger">*</span></h5>
                            </label><br>
                            <select name="merital_status" id="merital_status" class="form-control">

                                <option value="single"
                                    <?php echo e($user_details->merital_status == 'single' ? 'selected' : ''); ?>>
                                    Single</option>
                                <option value="merried"
                                    <?php echo e($user_details->merital_status == 'merried' ? 'selected' : ''); ?>>
                                    Married</option>
                            </select>
                        </div>

                        <!--<div class="col-md-4 mt-4">-->
                        <!--    <label for="User_ip_address" class="form-label">-->
                        <!--        <h5>Change Language<span class="text-danger">*</span></h5>-->
                        <!--    </label><br>-->
                        <!--    <select name="language" id="language" class="form-control">-->

                        <!--        <option value="eng">English</option>-->
                        <!--    </select>-->
                        <!--</div>-->
                        
                        <div class="col-md-4 mt-4">
                            <label for="User_ip_address" class="form-label">
                                <h5>Country<span class="text-danger">*</span></h5>
                            </label><br>
                            <select name="country" id="country" class="form-control select2">
                                <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($countrs->id); ?>"
                                        <?php echo e($user_details->country_id == $countrs->id ? 'selected' : ''); ?>>
                                        <?php echo e($countrs->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="User_ip_address" class="form-label">
                                <h5>Your Address<span class="text-danger">*</span></h5>
                            </label><br>
                            <textarea required class="form-control " name="address" autocomplete="off"><?php echo e($user_details->address); ?></textarea>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="User_ip_address" class="form-label">
                                <h5>About<span class="text-danger">*</span></h5>
                            </label><br>
                            <textarea class="form-control " name="about" autocomplete="off"><?php echo e($user_details->about); ?></textarea>
                        </div>

                        
                    </div>
                </div>
                
                <div class="card-footer">
            <div class="row mb-4">
                <div class="col-md-6 text-end">
                    <button onclick="Tab(value)" value="Profile" type="button"
                        class="btn btn-outline-danger">Discard</button>
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
<!-- Cropping Modal -->
<div id="modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <img id="image" src="" alt="Picture">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="crop" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>

<script>
  document.querySelectorAll('.toggle-password').forEach(item => {
    item.addEventListener('click', function() {
        var targetId = this.getAttribute('data-target');
        var passwordInput = document.getElementById(targetId);
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });
});


var $modal = $('#modal');
var image = document.getElementById('image');
var cropper;
$("body").on("change", ".image", function(e) {
  var files = e.target.files;
  var done = function(url) {
    // Check if the modal is open to avoid setting the image source when changing
    // without confirming the crop
    if (!$modal.hasClass('show')) {
       // alert();
      image.src = url;
      $modal.modal('show');
    }
  };

  var reader;
  var file;

  if (files && files.length > 0) {
    file = files[0];
    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function(e) {
        done(reader.result);
      };
      // reader.readAsDataURL(file);
    }
  }
});

$modal.on('shown.bs.modal', function() {
  cropper = new Cropper(image, {
    aspectRatio: 16 / 16,
    crop: function(e) {
      console.log(e.detail.x);
      console.log(e.detail.y);
    }
  });
}).on('hidden.bs.modal', function() {
  cropper.destroy();
  
  cropper = null;

});


$("#crop").click(function() {
  canvas = cropper.getCroppedCanvas({
    width: 200,
    height: 300,
  });

    // Set canvas rendering quality
  var cropperCanvas = cropper.getCroppedCanvas({
    imageSmoothingQuality: 'high',
  });
  
  cropperCanvas.toBlob(function(blob) {
    url = URL.createObjectURL(blob);
    var reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function() {
      var base64data = reader.result;
      $('#uploadedProfile').attr('src', base64data);

      // Create a new File object with the cropped blob
      var croppedFile = new File([blob], 'cropped_image.jpg', { type: 'image/jpeg' });

      // Create a new FileList containing the cropped file
      var filesList = new DataTransfer();
      filesList.items.add(new File([croppedFile], 'cropped_image.jpg'));

      // Set the new FileList as the value of the input type file
      $('#profilePictureInput')[0].files = filesList.files;

      $modal.modal('hide');
    };
  });
});


$(".close1").click(function(){
    // alert();
    $('#profilePictureInput').val(null);
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
            url: "<?php echo e(url('admin/SecuritySettings/confirm_password')); ?>",
            type: "POST",
            data: {
                password: passwordInput,
                user_id: userId,
                _token: "<?php echo e(csrf_token()); ?>"
            },
            success: function(response) {
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
            error: function(error) {
                $("#disabl").show(); // Show the enable button in case of an error
                console.log('Error:', error);
            }
        });
    }

    $(document).ready(function() {
        $('#submit-login').on('click', function() {
            var passwordInput = $('#password').val();

            // Perform AJAX request to check the password against the database
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    password: passwordInput,
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
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
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });
    });


    $(document).ready(function() {
        $('.toggle-password').on('click', function() {
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

    function BulkMail(value) {
        var type = "Bulk";
        $.ajax({
            url: "<?php echo e(url('admin/MailSettings/MailViaUpdate')); ?>",
            type: "get",
            data: {
                value: value,
                type: type,
                _token: "<?php echo e(csrf_token()); ?>"
            },
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
            data: {
                value: value,
                type: type,
                _token: "<?php echo e(csrf_token()); ?>"
            },
            success: function(response) {
                location.reload();
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    }
    
    
</script>
<?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/ProfileSettings/home.blade.php ENDPATH**/ ?>