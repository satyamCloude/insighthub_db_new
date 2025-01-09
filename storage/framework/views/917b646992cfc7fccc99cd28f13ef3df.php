<?php $__env->startSection('title', 'Create'); ?>
<?php $__env->startSection('content'); ?>
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
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Vendor /</span> Add</h4>
    <?php if(Session::has('error')): ?>
        <div class="alert alert-danger mb-3" role="alert"><?php echo e(Session::get('error')); ?></div>
    <?php endif; ?>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="<?php echo e(url('admin/Vendor/home')); ?>" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
            
          <form action="<?php echo e(url('admin/Vendor/store')); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. Company Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                    <label for="company_id" class="form-label">Company Name</label>
                    <select class="form-select" name="company_id" required>
                      <?php if($company): ?>
                          <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                      <?php else: ?>
                          <option value="">No Company Found</option>
                      <?php endif; ?>
                    </select>
                 </div>
                <div class="col-md-6">
                      <label for="vendor_name" class="form-label">Vendor Name <span class="text-danger">*</span></label>
                      <input type="vendor_name" class="form-control" name="first_name" placeholder="ABC Back" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" name="email" placeholder="name@example.com" required/>
                </div>
                  <div class="col-md-6">
    <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label><br/>
    <input type="tel" name="phone_number" id="phone_number" class="inpt form-control" required placeholder="+1234567890" pattern="[0-9+]{1,10}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9+]/g, '').slice(0, 10);">
</div>
              </div>
              <hr>
              <h5 class="mb-4">2. Address</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="address_1" class="form-label">Address 1</label>
                      <input type="text" class="form-control" name="address_1" placeholder="Address 1" required/>
                </div>
                <div class="col-md-6">
                      <label for="address_2" class="form-label">Address 2</label>
                      <input type="text" class="form-control" name="address_2" placeholder="Address 2" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="country"  class="form-label">Country</label>
                      <select class="form-select" name="country" id="country" required>
                        <option value="">Select Country</option>
                        <?php $__currentLoopData = $Country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Count->id); ?>"><?php echo e($Count->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <div class="col-md-3">
                      <label for="state"  class="form-label">State</label>
                      <select class="form-select" name="state" id="state" required>
                        <option value="">Select State</option>                                  
                      </select>
                </div>
                <div class="col-md-3">
                      <label for="city"  class="form-label">City</label>
                      <select class="form-select" name="city" id="city">
                        <option value="">Select City</option>
                      </select>
                </div>
                <div class="col-md-3">
                      <label for="pincode" class="form-label">Pincode</label>
                      <input type="number" class="form-control" name="pincode" placeholder="Pincode" required />
                </div>
              </div>
              <hr>
              <h5 class="mb-4">3. Tax</h5>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="gstin" class="form-label">GSTIN</label>
                      <input type="text" class="form-control" name="gstin" placeholder="GSTIN" required/>
                </div>
                <div class="col-md-3">
                      <label for="pen_ten_no" class="form-label">PAN/TAN Number</label>
                      <input type="text" class="form-control" name="pen_ten_no" placeholder="PAN/TAN Number" required/>
                </div>
                <div class="col-md-3">
                      <label for="CIN" class="form-label">CIN</label>
                      <input type="text" class="form-control" name="cin" placeholder="CIN" required/>
                </div>
                <div class="col-md-3">
                      <label for="" class="form-label">TDS %</label>
                      <input type="text" class="form-control" name="tds" placeholder="TDS" required/>
                </div>          
              </div>
              <hr>
              <h5 class="mb-4">3. Login Details</h5>  
              <div class="row mb-3"> 
                        <div class="col-md-3">
                    <label for="portal_login_url" class="form-label">Portal login URL <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="portal_login_url" placeholder="https://dev.cloudtechtiq.in/" required/>
              </div>
              <div class="col-md-3">
                    <label for="login_email" class="form-label">Login Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="login_email" placeholder="ABCBack" required/>
              </div>
                <div class="col-md-3">
                    <div class="form-password-toggle">
                      <label class="form-label" for="basic-default-password32">Password</label>
                      <div class="input-group input-group-merge">
                        <input type="password" class="form-control" name="password" id="basic-default-password32" placeholder="············" aria-describedby="basic-default-password" required>
                         <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                </div>
              <div class="col-md-3">
                    <label for="profile_img" class="form-label">Profile Photo <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="profile_img" required/>
              </div>
              </div>
              <hr>
              <h5 class="mb-4">4. Access Management</h5>                    
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="access_security"  class="form-label">Select Employees for Access Security <span class="text-danger">*</span></label>
                      <!--<select class="form-select" name="access_security" required>-->
                      <!--    <?php $__currentLoopData = $Employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                      <!--    <option value="<?php echo e($emp->id); ?>"><?php echo e($emp->first_name); ?></option>-->
                      <!--    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                      <!--</select>-->
                      <div class="dropdown">
                      <button type="button" class="dropbtn" id="selected_client_btn">Select Employees for Access Security <i class="fa fa-angle-down" style="font-size:24px"></i></button>
                      <div class="dropdown-content">
                        <?php $__currentLoopData = $Employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="outer" id="client_<?php echo e($client->id); ?>" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient(<?php echo e($client->id); ?>)">
                          <img src="<?php echo e($client->profile_img); ?>" style="width:45px;border-radius:50%;height:45px;">
                          <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                            <span><?php echo e($client->first_name); ?> <?php echo e($client->last_name); ?> (#<?php echo e($client->id); ?>) </span>
                            <!--<span><?php echo e($client->status); ?></span>-->
                          </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    </div>
                    <input type="hidden" name="accountManager" id="set_client_id">
                </div>
                <div class="col-md-6">
                      <label for="status"  class="form-label">Status</label>
                      <select class="form-select" name="status" required>
                          <?php $__currentLoopData = $Status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($Status->id); ?>"><?php echo e($Status->status); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="services_offered"  class="form-label">Services offered</label>
                      <div class="editor-container">
                        <div class="full-editor geteditor"></div>
                        <input type="hidden" name="services_offered" class="hidden-field">
                      </div>
                </div>
              </div>     
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="<?php echo e(url('admin/Vendor/home')); ?>" type="button" class="btn btn-outline-danger">Discard</a>
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
                    url: "<?php echo e(url('admin/Client/getstateData')); ?>", // Replace with your actual route name
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
                    url: "<?php echo e(url('admin/Vendor/getstateData')); ?>", // Replace with your actual route name
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
                    url: "<?php echo e(url('admin/Vendor/getcityData')); ?>", // Replace with your actual route name
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
  
  
  
    function selectClient(id) {
    var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
    $('#selected_client_btn').text(clientName); // Set the button text to the selected client name
    $('#set_client_id').val(id); // Set the button text to the selected client name

    $('.dropdown-content .outer').removeClass('selected');

    // Add the 'selected' class to the clicked option
    $('#client_' + id).addClass('selected');
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/user/Vendor/create.blade.php ENDPATH**/ ?>