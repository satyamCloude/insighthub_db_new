<?php $__env->startSection('title', 'Edit'); ?>
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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Client /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="<?php echo e(url('admin/Client/home')); ?>" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
                   <?php if($errors->any()): ?>
      <div class="alert alert-danger">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
      <?php endif; ?>
      <?php if(session('success')): ?>
      <div class="alert alert-success">
        <?php echo e(session('success')); ?>

      </div>
      <?php endif; ?>
          <form action="<?php echo e(url('admin/Client/update/'.$user->id)); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="input-group mt-5 mb-3">
                          <!--<select name="gender" class="form-control select2">-->
                          <!--  <option value="" >Select Gender</option>-->
                          <!--  <option <?php if($user && $user->gender == "Mr"): ?> selected <?php endif; ?>  value="Mr"> Mr.</option>-->
                          <!--  <option <?php if($user && $user->gender == "Miss"): ?> selected <?php endif; ?>  value="Miss"> Miss.</option>-->
                          <!--</select>-->
                          <input type="text" name="first_name" placeholder="First name"<?php if($user && $user->first_name): ?> value="<?php echo e($user->first_name); ?>" <?php endif; ?> class="form-control"/>
                          <input type="text" name="last_name" placeholder="Last name"<?php if($user && $user->last_name): ?> value="<?php echo e($user->last_name); ?>" <?php endif; ?> class="form-control"/>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-6">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control" <?php if($user && $user->company_name): ?> value="<?php echo e($user->company_name); ?>" <?php endif; ?> name="company_name" required>
                                
                  </div>
                  <!--<div class="col-md-6">-->
                  <!--      <label for="phone_number" class="form-label">Phone number</label>-->
                  <!--  <input type="number" name="phone_number" placeholder="+9414177140" <?php if($user && $user->phone_number): ?> value="<?php echo e($user->phone_number); ?>" <?php endif; ?> class="form-control"/>-->
                  <!--</div>-->
                     <div class="col-md-6">
    <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label><br/>
    <input type="tel" name="phone_number" id="phone_number" class="inpt form-control" required placeholder="+1234567890" pattern="[0-9+]{1,10}"  <?php if($user && $user->phone_number): ?> value="<?php echo e($user->phone_number); ?>" <?php endif; ?> maxlength="10" oninput="this.value = this.value.replace(/[^0-9+]/g, '').slice(0, 10);">
</div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" placeholder="name@example.com" <?php if($user && $user->email): ?> value="<?php echo e($user->email); ?>" <?php endif; ?> class="form-control"/>
                  </div>
                  <div class="col-md-6">
                    <div class="form-password-toggle">
                      <label class="form-label" for="basic-default-password32">Password</label>
                      <div class="input-group input-group-merge">
                        <input type="password" class="form-control" name="password" id="basic-default-password32" value="<?php echo e(old('password')); ?>" placeholder="············" aria-describedby="basic-default-password">
                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-6">
                    <label for="address_1" class="form-label">Address 1</label>
                    <input type="text" class="form-control" name="address_1"  <?php if($ClientDetail && $ClientDetail->address_1): ?> value="<?php echo e($ClientDetail->address_1); ?>" <?php endif; ?>  placeholder="Address 1" />
                  </div>
                  <div class="col-md-6">
                    <label for="address_2" class="form-label">Address 2</label>
                    <input type="text" class="form-control" name="address_2" <?php if($ClientDetail && $ClientDetail->address_2): ?> value="<?php echo e($ClientDetail->address_2); ?>" <?php endif; ?> placeholder="Address 2" />
                  </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-3">
                    <label for="country"  class="form-label">Country</label>
                    <select class="form-control select2" name="country" id="country">
                      <option value="">Select Country</option>
                        <?php $__currentLoopData = $Country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php if($ClientDetail && $ClientDetail->country == $Count->id): ?> selected <?php endif; ?>  value="<?php echo e($Count->id); ?>"><?php echo e($Count->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="state"  class="form-label">State</label>
                    <select class="form-control select2" name="state" id="state">
                      <option value="">Select State</option>                                  
                      <option value="<?php if($State && $State->id): ?><?php echo e($State->id); ?> <?php endif; ?>" selected><?php if($State && $State->name): ?><?php echo e($State->name); ?> <?php endif; ?></option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="city"  class="form-label">City</label>
                    <select class="form-control select2" name="city" id="city">
                      <option value="">Select City</option>
                      <option value="<?php if($City && $City->id): ?><?php echo e($City->id); ?> <?php endif; ?>" selected><?php if($City && $City->name): ?><?php echo e($City->name); ?> <?php endif; ?></option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="pincode" class="form-label">Pincode</label>
                    <input type="number" class="form-control" <?php if($ClientDetail && $ClientDetail->pincode): ?> value="<?php echo e($ClientDetail->pincode); ?>" <?php endif; ?> name="pincode" placeholder="Pincode" />
                  </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-3">
                    <label for="gstin" class="form-label">GSTIN</label>
                    <input type="text" class="form-control" name="gstin" <?php if($ClientDetail && $ClientDetail->gstin): ?> value="<?php echo e($ClientDetail->gstin); ?>" <?php endif; ?> placeholder="GSTIN" />
                  </div>
                  <div class="col-md-3">
                    <label for="hsn_sac" class="form-label">HSN/SAC</label>
                    <input type="text" class="form-control" name="hsn_sac" <?php if($ClientDetail && $ClientDetail->hsn_sac): ?> value="<?php echo e($ClientDetail->hsn_sac); ?>" <?php endif; ?>  placeholder="HSN/SAC" />
                  </div>
                  <div class="col-md-3">
                    <label for="" class="form-label">TDS</label>
                    <input type="text" class="form-control" name="tds" <?php if($ClientDetail && $ClientDetail->tds): ?> value="<?php echo e($ClientDetail->tds); ?>" <?php endif; ?>  placeholder="TDS" />
                  </div>
                  <div class="col-md-3">
                                <label for="exampleFormControlInput1"  class="form-label">Payment Method</label>
                                <select class="form-control select2" name="payment_method" required>
                                  <?php $__currentLoopData = $PaymentMethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $PaymentMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option <?php if($ClientDetail && $ClientDetail->payment_method == $PaymentMethod->id): ?> selected  <?php endif; ?> value="<?php echo e($PaymentMethod->id); ?>"><?php echo e($PaymentMethod->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                          </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-3">
                    <label for=""  class="form-label">Currency</label>
                    <select class="form-control select2" name="currency">
                       <?php $__currentLoopData = $Currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php if($ClientDetail && $ClientDetail->currency == $Count->id): ?> selected <?php endif; ?>  value="<?php echo e($Count->id); ?>"><?php echo e($Count->prefix); ?> <?php echo e($Count->code); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <!--<div class="col-md-3 ">-->
                  <!--  <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>-->
                  <!--  <select name="role_id" class="form-control select2">-->
                  <!--            <?php $__currentLoopData = $Role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                  <!--            <option <?php if($ClientDetail && $ClientDetail->role_id == $Rol->id): ?> selected <?php endif; ?> value="<?php echo e($Rol->id); ?>"><?php echo e($Rol->name); ?></option>-->
                  <!--            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                  <!--    </select>-->
                  <!--</div>-->
                  <div class="col-md-3">
                                <label for="exampleFormControlInput1"  class="form-label">Status</label>
                                <select class="form-control select2" name="status" required>
                                  <?php $__currentLoopData = $Status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option <?php if($user && $user->status == $Status->id): ?> selected  <?php endif; ?> value="<?php echo e($Status->id); ?>"><?php echo e($Status->status); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                  </div>
                  <!--<div class="col-md-3">-->
                  <!--  <label for="exampleFormControlInput1"  class="form-label">Account Manager</label>-->
                  <!--  <select class="form-control select2" name="accountManager" required>-->
                  <!--    <?php $__currentLoopData = $accountManagers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accountManager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                  <!--    <?php if($accountManager->profile_img != ''): ?>-->
                  <!--        <?php $profile_img = $accountManager->profile_img; ?>-->
                  <!--    <?php else: ?>-->
                  <!--        <?php $profile_img = url()->asset('images/21104.png'); ?>-->
                  <!--    <?php endif; ?>-->
                  <!--    <option data-avatar="<?php echo e($profile_img); ?>" value="<?php echo e($accountManager->id); ?>" <?php echo e($accountManager->id == $user->accountManager ? 'selected':''); ?>> <?php echo e(ucfirst($accountManager->first_name)); ?></option>-->
                  <!--    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                  <!--  </select>-->
                  <!--</div>-->
                  
                    <div class="col-md-3">
                        <label for="client_id" class="form-label">Account Manager  <span class="text-danger">*</span></label><br/>
                        <div class="dropdown">
                          <!--<button class="dropbtn" id="selected_client_btn" type="button">Select Account Manager -->
                          <!--<i class="fa fa-angle-down" style="font-size:24px"></i></button>-->
                            <button type="button" class="dropbtn" >
                                <div>
                                     <?php
                                        // Use the `firstWhere` collection method to find the first client matching the Ticket's ccid
                                        $client = collect($accountManagers)->firstWhere('id', $user->accountManager);
                                        // Use null coalescence operator to handle the case when $client is null
                                        $src = $client->profile_img ?? '';
                                        $first_name = $client->first_name ?? 'Select Account Manager';
                                        $last_name = $client->last_name ?? ' ';
                                        $id = $client->id ?? '';
                                       
                                    ?>
                                    <!-- Use the variables initialized above -->
                                   <!--<?php if($src): ?> <img src="<?php echo e($src); ?>"  style="width:30px; border-radius:50%; height:30px;"-->
                                   <!--id="selected_client_img" alt="Client Image"> <?php endif; ?>-->
                                    <span id="selected_client_btn"> { $first_name }} <?php echo e($last_name); ?> (#<?php echo e($id); ?>) <br/></span>

                                </div>
                                <i class="fa fa-angle-down" style="font-size:24px"></i>
                            </button>
                          
                          <div class="dropdown-content">
                            <?php $__currentLoopData = $accountManagers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="outer" id="client_<?php echo e($client->id); ?>" style="display:flex;margin:6px;padding:4px;color:black;" 
                            onclick="selectClient(<?php echo e($client->id); ?>)">
                              <img src="<?php echo e($client->profile_img); ?>" style="width:45px;border-radius:50%;height:45px;">
                              <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                <span><?php echo e($client->first_name); ?> (#<?php echo e($client->id); ?>)</span>
                              </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                        </div>
                        <input type="hidden" name="accountManager" id="set_client_id" value="<?php echo e($id); ?>">
                    </div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-3">
                    <label class="switch">
                     <input type="checkbox" <?php if($ClientDetail && $ClientDetail->all_emails == '1'): ?> checked  <?php endif; ?> name="all_emails" class="switch-input">
                     <span class="switch-toggle-slider">
                       <span class="switch-on">
                         <i class="ti ti-check"></i>
                       </span>
                       <span class="switch-off">
                         <i class="ti ti-x"></i>
                       </span>
                     </span>
                     <span class="switch-label">All Emails</span>
                    </label>
                  </div>
                  <div class="col-md-3">
                    <label class="switch">
                     <input type="checkbox" name="invoices" <?php if($ClientDetail && $ClientDetail->invoices == '1'): ?> checked  <?php endif; ?>  class="switch-input">
                     <span class="switch-toggle-slider">
                       <span class="switch-on">
                         <i class="ti ti-check"></i>
                       </span>
                       <span class="switch-off">
                         <i class="ti ti-x"></i>
                       </span>
                     </span>
                     <span class="switch-label">Invoices</span>
                    </label>
                  </div>
                  <!-- <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="support" <?php if($ClientDetail && $ClientDetail->support == '1'): ?> checked  <?php endif; ?> class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
                       <span class="switch-label">Support</span>
                      </label>
                  </div> -->
                  <!-- <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="services" <?php if($ClientDetail && $ClientDetail->services == '1'): ?> checked  <?php endif; ?> class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
                       <span class="switch-label">Services</span>
                      </label>
                  </div> -->
                <!-- </div>
                <div class="row mb-4">  -->
                  <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="merge_same_due_date" <?php if($ClientDetail && $ClientDetail->merge_same_due_date == '1'): ?> checked  <?php endif; ?> class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
         <span class="switch-label">Do Not Merge Same Due Date Invoices</span>
                      </label>
                  </div>
                  <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="over_due_invoice" <?php if($ClientDetail && $ClientDetail->over_due_invoice == '1'): ?> checked  <?php endif; ?> class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
         <span class="switch-label">Over Due Invoice Notification</span>
                      </label>
                  </div>
                  <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="tax_exampt" <?php if($ClientDetail && $ClientDetail->tax_exampt == '1'): ?> checked  <?php endif; ?> class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
                       <span class="switch-label">Tax Exampt</span>
                      </label>
                  </div>
                  <!-- <div class="col-md-3">
                      <label class="switch">
                       <input type="checkbox" name="projects" <?php if($ClientDetail && $ClientDetail->projects == '1'): ?> checked  <?php endif; ?> class="switch-input">
                       <span class="switch-toggle-slider">
                         <span class="switch-on">
                           <i class="ti ti-check"></i>
                         </span>
                         <span class="switch-off">
                           <i class="ti ti-x"></i>
                         </span>
                       </span>
                       <span class="switch-label">Projects</span>
                      </label>
                  </div> -->
                  <div class="col-md-3"></div>
                </div>
                <div class="row mb-4"> 
                  <div class="col-md-6">
                    <label for="" class="form-label">Profile Picture <span class="text-danger">*</span></label>
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" id="imageUpload"  name="profile_img"  accept=".png, .jpg, .jpeg" />
                           <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                           <img id="imagePreview" width="100%" name="profile_img" <?php if($user && $user->profile_img): ?> src="<?php echo e($user->profile_img); ?>" <?php else: ?> src="<?php echo e(url('/')); ?>/public/images/default_profile.jpg"  <?php endif; ?> alt="Preview" />
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <label for="" class="form-label">Document for Verification</label>
                        <input type="file" name="doc_verify"  accept="application/pdf" value="<?php if($ClientDetail && $ClientDetail->doc_verify): ?> value="<?php echo e($ClientDetail->doc_verify); ?>" <?php endif; ?>" class="form-control" id="inputGroupFile01">
                        <br>
                        <br>
                        <a class="btn btn-outline-primary"  target="_blank" <?php if($ClientDetail && $ClientDetail->doc_verify): ?> href="<?php echo e($ClientDetail->doc_verify); ?>" <?php endif; ?>>Download Verification Document</a>
                  </div>
                </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="<?php echo e(url('admin/Client/home')); ?>" type="button" class="btn btn-outline-danger">Discard</a>
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
        $(document).ready(function() {
            // Attach an event handler to the "country" select box
            $('#state').on('change', function() {
                var selectedCountry = $(this).val();
                // Make an AJAX request to fetch states based on the selected country
                $.ajax({
                    url: "<?php echo e(url('admin/Client/getcityData')); ?>", // Replace with your actual route name
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
        
    numberCount = 1;
    selectClient(<?php echo e($user->accountManager); ?>);
    function selectClient(id) {
        var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
        // alert(clientName);
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
          url: "<?php echo e(url('admin/Invoices/getClientDetails')); ?>/"+id,
          
          success: function(res) {
            console.log(res);// Make sure to adjust this based on your actual Select2 initialization method
            // alert(res.data.address_1 );
            $('#shipping_address').val(res.data.address_1 +', '+ res.data.address_2);
          },
        });
  }
  
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/user/client/edit.blade.php ENDPATH**/ ?>