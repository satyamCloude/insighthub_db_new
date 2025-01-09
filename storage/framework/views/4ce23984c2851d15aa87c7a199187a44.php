<?php $__env->startSection('title', 'Vendor'); ?>
<?php $__env->startSection('content'); ?>
<style>

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


  .dropdown {
    position: relative;
    /*display: inline-block;*/
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
</style>
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Vendor /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="<?php echo e(url('admin/Vendor/home')); ?>" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>   
          </div>
          <form action="<?php echo e(url('admin/Vendor/update/'.$user->id)); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <h5 class="mb-4">1. Company Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                    <label for="company_name" class="form-label">Company Name</label>
                    <select class="form-select" name="company_id" >
                        <option <?php if($VendorDetail && $VendorDetail->company_id == $company->id): ?> selected <?php endif; ?> value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                    </select> 
                  </div>
                <div class="col-md-6">
                      <label for="vendor_name" class="form-label">Vendor Name <span class="text-danger">*</span></label>
                      <input type="vendor_name" class="form-control" <?php if($user && $user->first_name): ?> value="<?php echo e($user->first_name); ?>" <?php endif; ?> name="first_name" placeholder="ABC Back"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" name="email"  <?php if($user && $user->email): ?> value="<?php echo e($user->email); ?>" <?php endif; ?> placeholder="name@example.com"/>
                </div>
                <div class="col-md-6">
                      <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="phone_number" <?php if($user && $user->phone_number): ?> value="<?php echo e($user->phone_number); ?>" <?php endif; ?> placeholder="+1234156789"/>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Address</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="address_1" class="form-label">Address 1</label>
                      <input type="text" class="form-control" name="address_1" <?php if($VendorDetail && $VendorDetail->address_1): ?> value="<?php echo e($VendorDetail->address_1); ?>" <?php endif; ?> placeholder="Address 1"/>
                </div>
                <div class="col-md-6">
                      <label for="address_2" class="form-label">Address 2</label>
                      <input type="text" class="form-control" name="address_2" <?php if($VendorDetail && $VendorDetail->address_2): ?> value="<?php echo e($VendorDetail->address_2); ?>" <?php endif; ?> placeholder="Address 2"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="country"  class="form-label">Country</label>
                      <select class="form-select select2" name="country" id="country">
                      <option value="">Select Country</option>
                        <?php $__currentLoopData = $Country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php if($VendorDetail && $VendorDetail->country == $Count->id): ?> selected <?php endif; ?>  value="<?php echo e($Count->id); ?>"><?php echo e($Count->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-3">
                      <label for="state"  class="form-label">State</label>
                      <select class="form-select" name="state" id="state">
                      <option value="">Select State</option>                                  
                      <option value="<?php if($State && $State->id): ?><?php echo e($State->id); ?> <?php endif; ?>" selected><?php if($State && $State->name): ?><?php echo e($State->name); ?> <?php endif; ?></option>
                    </select>
                </div>
                <div class="col-md-3">
                      <label for="city"  class="form-label">City</label>
                      <select class="form-select" name="city" id="city">
                      <option value="">Select City</option>
                      <option value="<?php if($City && $City->id): ?><?php echo e($City->id); ?> <?php endif; ?>" selected><?php if($City && $City->name): ?><?php echo e($City->name); ?> <?php endif; ?></option>
                    </select>
                </div>
                <div class="col-md-3">
                      <label for="pincode" class="form-label">Pincode</label>
                      <input type="number" class="form-control"  <?php if($VendorDetail && $VendorDetail->pincode): ?> value="<?php echo e($VendorDetail->pincode); ?>" <?php endif; ?> name="pincode" placeholder="Pincode" />
                </div>
              </div>
              <hr>
              <h5 class="mb-4">3. Tax</h5>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="gstin" class="form-label">GSTIN</label>
                      <input type="text" class="form-control" name="gstin" placeholder="GSTIN"  <?php if($VendorDetail && $VendorDetail->gstin): ?> value="<?php echo e($VendorDetail->gstin); ?>" <?php endif; ?> />
                </div>
                <div class="col-md-3">
                      <label for="pan/tan" class="form-label">PAN/TAN Number</label>
                      <input type="text" class="form-control" name="pen_ten_no" placeholder="PAN/TAN Number"  <?php if($VendorDetail && $VendorDetail->pen_ten_no): ?> value="<?php echo e($VendorDetail->pen_ten_no); ?>" <?php endif; ?>/>
                </div>
                <div class="col-md-3">
                      <label for="CIN" class="form-label">CIN</label>
                      <input type="text" class="form-control" name="cin" placeholder="CIN" <?php if($VendorDetail && $VendorDetail->cin): ?> value="<?php echo e($VendorDetail->cin); ?>" <?php endif; ?> />
                </div>
                <div class="col-md-3">
                      <label for="" class="form-label">TDS %</label>
                      <input type="text" class="form-control" name="tds" placeholder="TDS" <?php if($VendorDetail && $VendorDetail->tds): ?> value="<?php echo e($VendorDetail->tds); ?>" <?php endif; ?> />
                </div>          
              </div>
              <hr>
              <h5 class="mb-4">3. Login Details</h5>  
              <div class="row mb-4"> 
                        <div class="col-md-3">
                    <label for="portal_login_url" class="form-label">Portal login URL <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="portal_login_url" <?php if($VendorDetail && $VendorDetail->portal_login_url): ?> value="<?php echo e($VendorDetail->portal_login_url); ?>" <?php endif; ?> placeholder="https://dev.cloudtechtiq.in/"/>
              </div>
              <div class="col-md-3">
                    <label for="login_email" class="form-label">Login Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="login_email" <?php if($user && $user->login_email): ?> value="<?php echo e($user->login_email); ?>" <?php endif; ?>/>
              </div>
                <div class="col-md-3">
                    <div class="form-password-toggle">
                      <label class="form-label" for="basic-default-password32">Password</label>
                      <div class="input-group input-group-merge">
                        <input type="password" class="form-control" name="password" id="basic-default-password32" placeholder="············" aria-describedby="basic-default-password">
                         <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="profile_img" class="form-label">Profile Photo </label> <a type="button" <?php if($user && $user->profile_img): ?> href="<?php echo e($user->profile_img); ?>" <?php endif; ?>  ><i class="fa-solid fa-download"></i></a>
                    <input type="file" class="form-control" name="profile_img" />
              </div>
              </div>
              <hr>
              <h5 class="mb-4">4. Access Management</h5>                    
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="access_security"  class="form-label">Select Employees for Access Security</label>
                     <!--<select class="form-select" name="access_security">-->
                     <!--     <?php $__currentLoopData = $Employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                     <!--     <option  <?php if($VendorDetail && $VendorDetail->access_security == $emp->id): ?> selected  <?php endif; ?>  value="<?php echo e($emp->id); ?>"><?php echo e($emp->first_name); ?></option>-->
                     <!--     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                     <!-- </select>-->
                       <div class="dropdown">
                      <button class="dropbtn" >
                        <div>
                             <?php
                                // Use the `firstWhere` collection method to find the first client matching the Ticket's ccid
                                $client = collect($Employee)->firstWhere('id', $VendorDetail->access_security);
                                // Use null coalescence operator to handle the case when $client is null
                                $src = $client->profile_img ?? '';
                                $first_name = $client->first_name ?? 'Select Employees for Access Security';
                                $last_name = $client->last_name ?? '';
                                $id = $client->id ?? '';
                               
                            ?>
                            <!-- Use the variables initialized above -->
                           <!--<?php if($src): ?> <img src="<?php echo e($src); ?>"  style="width:30px; border-radius:50%; height:30px;"-->
                           <!--id="selected_client_img" alt="Client Image"> <?php endif; ?>-->
                            <span id="selected_client_btn2"><?php echo e($first_name); ?> <?php echo e($last_name); ?>  (#<?php echo e($id); ?>)</span>
                        </div>
                        <i class="fa fa-angle-down" style="font-size:24px"></i>
                    </button>
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
                    <input type="hidden" name="accountManager" id="set_client_id" value="<?php echo e($id); ?>">
                </div>
                <div class="col-md-6">
                      <label for="status"  class="form-label">Status</label>
                      <select class="form-select" name="status">
                        <?php $__currentLoopData = $Status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($user && $user->status == $Status->id): ?> selected  <?php endif; ?> value="<?php echo e($Status->id); ?>"><?php echo e($Status->status); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="services_offered"  class="form-label">Services offered</label>
                      <div class="editor-container">
                        <div class="full-editor geteditor"><?php if($VendorDetail && $VendorDetail->services_offered): ?> <?php echo $VendorDetail->services_offered; ?> <?php endif; ?></div>
                        <input type="hidden" name="services_offered" <?php if($VendorDetail && $VendorDetail->services_offered): ?> value="<?php echo e($VendorDetail->services_offered); ?>" <?php endif; ?> class="hidden-field">
                      </div>
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
<!-- / Content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                var selectedCountry = $(this).val();
                // Make an AJAX request to fetch states based on the selected country
                $.ajax({
                    url: "<?php echo e(url('admin/Vendor/getcityData')); ?>", // Replace with your actual route name
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
  
  
      function selectClient(id) {
          
        var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
      
        $('#selected_client_btn2').text(clientName); // Set the button text to the selected client name
        $('#set_client_id').val(id); // Set the button text to the selected client name
    
        $('.dropdown-content .outer').removeClass('selected');
    
        // Add the 'selected' class to the clicked option
        $('#client_' + id).addClass('selected');
      }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/user/Vendor/edit.blade.php ENDPATH**/ ?>