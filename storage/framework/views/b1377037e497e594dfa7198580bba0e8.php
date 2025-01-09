<?php $__env->startSection('title', 'Create'); ?>
<?php $__env->startSection('content'); ?>
<!-- Content -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/23.0.12/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/23.0.12/js/intlTelInput.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"/>
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

.modal-dialog {
    max-width: 90%;
}

#image {
    max-width: 100%;
    height: auto;
}

</style>
  <div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Employee /</span> Add</h4>
    
    

    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="<?php echo e(url('Employee/Employee/home')); ?>" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
            
       <form action="<?php echo e(url('Employee/Employee/store')); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    
    <div class="card-body">
        <h5 class="mb-4">1. Employee Details</h5>
        <div class="row mb-4"> 
            <div class="col-md-4">
                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                <select name="gender" class="form-control select2" required>
                    <option value="">Select Gender</option>
                    <option value="1" <?php echo e(old('gender') == '1' ? 'selected' : ''); ?>>Male</option>
                    <option value="2" <?php echo e(old('gender') == '2' ? 'selected' : ''); ?>>Female</option>
                </select>
                <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="<?php echo e(old('first_name')); ?>" required/>
                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="<?php echo e(old('last_name')); ?>" required/>
                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="email" class="form-label">Personal Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="personal_email" name="email" placeholder="abc@gmail.com" value="<?php echo e(old('email')); ?>" required/>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label for="phone_number" class="form-label">Contact No <span class="text-danger">*</span></label>
                <input type="tel" name="phone_number" id="phone_number" class="form-control" required placeholder="+1234567890" pattern="[0-9+]{1,10}" maxlength="10" value="<?php echo e(old('phone_number')); ?>" oninput="this.value = this.value.replace(/[^0-9+]/g, '').slice(0, 10);">
                <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="dob" value="<?php echo e(old('dob')); ?>" required/>
                <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label for="marriage_anniversary" class="form-label">Marriage Anniversary (Optional)</label>
                <input type="date" class="form-control" name="marriage_anniversary" value="<?php echo e(old('marriage_anniversary')); ?>"/>
                <?php $__errorArgs = ['marriage_anniversary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="date_of_joining" class="form-label">Date of Joining <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="date_of_joining" value="<?php echo e(old('date_of_joining')); ?>" required/>
                <?php $__errorArgs = ['date_of_joining'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label for="net_salary" class="form-label">Net Salary (Monthly)<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="net_salary" name="net_salary" placeholder="1000" value="<?php echo e(old('net_salary')); ?>" required min="1000"/>
                <?php $__errorArgs = ['net_salary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="row mb-4"> 
                  <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="uploadedProfile" width="100" height="100"  src="<?php echo e(url('public/images/21104.png')); ?>" alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                <label for="profile_img" class="form-label">Employee Picture <span class="text-danger">*</span></label>
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" id="profilePictureInput"  name="profile_img"   class="image" accept=".png, .jpg, .jpeg" />
                           <label for="imageUpload"></label>
                        </div>
                      </div>
                       <?php $__errorArgs = ['profile_img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>
        <div class="row mb-4"> 
          
              <div class="col-md-6">
        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
        <textarea class="form-control" id="address" name="address" rows="3" required><?php echo e(old('address', $EmployeeDetail->address ?? '')); ?></textarea>
        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
        </div>
        <hr>
         <script>
            $(document).ready(function() {
                var existingProfileImg = $("input[name='existing_profile_img']").val();
                
                if (!existingProfileImg) {
                    $('#profile_img').attr('required', 'required');
                }
            
                $("form").on("submit", function(event) {
                    if (!existingProfileImg && !$('#profilePictureInput').val()) {
                        event.preventDefault();
                        alert("Please upload a profile image.");
                    }
                });
            });
        </script>
        <h5 class="mb-4">2. Company Details</h5>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="company_id" class="form-label">Company Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="<?php echo e($Company->company_name); ?>" placeholder="Company Name" disabled>
                <input type="hidden" class="company_id" name="company_id" value="<?php echo e($Company->id); ?>" />
            </div>
            <div class="col-md-6 ">
                <label for="department_id" class="form-label">Department <span class="text-danger">*</span></label>
                <select name="department_id" class="form-control select2" required>
                    <option value="0">Select</option>
                    <?php $__currentLoopData = $Department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Depart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Depart->id); ?>" <?php echo e(old('department_id') == $Depart->id ? 'selected' : ''); ?>><?php echo e($Depart->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="job_role_id" class="form-label">Permision Role <span class="text-danger">*</span></label>
                <select name="job_role_id" class="form-control select2" required>
                    <option value="0">Select</option>
                    <?php $__currentLoopData = $Role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Rol->id); ?>" <?php echo e(old('job_role_id') == $Rol->id ? 'selected' : ''); ?>><?php echo e($Rol->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['job_role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 select2-primary">
                <label for="permission_role_id" class="form-label">Job Role <span class="text-danger">*</span></label>
                <select name="jobrole_id" class="form-control select2" required>
                    <option value="0">Select</option>
                    <?php $__currentLoopData = $Jobrole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Per): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Per->id); ?>" <?php echo e(old('jobrole_id') == $Per->id ? 'selected' : ''); ?>><?php echo e($Per->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['jobrole_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div> 
        </div>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="team_lead" class="form-label">Team Lead (select checkbox if want to make this employee as a team lead) <span class="text-danger">*</span></label>
                <br>
                <input type="checkbox" class="form-check-input input-filter" name="team_lead" id="team_lead" <?php echo e(old('team_lead') ? 'checked' : ''); ?> />
                <?php $__errorArgs = ['team_lead'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <hr>
        <h5 class="mb-4">3. Weekly Off Details</h5>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="weekly_off_id" class="form-label">Weekly Off <span class="text-danger">*</span></label>
                <select name="weekly_off_id" id="weekly_off_id" class="form-control select2" required>
                    <option value="">Select day</option>
                    <?php $__currentLoopData = $Weekly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Week->id); ?>" <?php echo e(old('weekly_off_id') == $Week->id ? 'selected' : ''); ?>><?php echo e($Week->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['weekly_off_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 ">
                <label for="additional_week_off_first" class="form-label">Additional Week Off First (Optional)</label>
                <select name="additional_week_off_first" class="form-control select2">
                    <option value="0">Select day</option>
                    <?php $__currentLoopData = $Weekly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Week->id); ?>" <?php echo e(old('additional_week_off_first') == $Week->id ? 'selected' : ''); ?>><?php echo e($Week->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['additional_week_off_first'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="additional_week_off_second" class="form-label">Additional Week Off Second (Optional)</label>
                <select name="additional_week_off_second" class="form-control select2">
                    <option value="0">Select day</option>
                    <?php $__currentLoopData = $Weekly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Week->id); ?>" <?php echo e(old('additional_week_off_second') == $Week->id ? 'selected' : ''); ?>><?php echo e($Week->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['additional_week_off_second'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 ">
                <label for="additional_week_off_third" class="form-label">Additional Week Off Third (Optional)</label>
                <select name="additional_week_off_third" class="form-control select2">
                    <option value="0">Select day</option>
                    <?php $__currentLoopData = $Weekly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Week->id); ?>" <?php echo e(old('additional_week_off_third') == $Week->id ? 'selected' : ''); ?>><?php echo e($Week->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['additional_week_off_third'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="additional_week_off_fourth" class="form-label">Additional Week Off Fourth (Optional)</label>
                <select name="additional_week_off_fourth" class="form-control select2">
                    <option value="0">Select day</option>
                    <?php $__currentLoopData = $Weekly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Week->id); ?>" <?php echo e(old('additional_week_off_fourth') == $Week->id ? 'selected' : ''); ?>><?php echo e($Week->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['additional_week_off_fourth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 ">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control select2" required>
                    <option value="1" <?php echo e(old('status') == '1' ? 'selected' : ''); ?>>Active</option>
                    <option value="2" <?php echo e(old('status') == '2' ? 'selected' : ''); ?>>Resigned</option>
                    <option value="3" <?php echo e(old('status') == '3' ? 'selected' : ''); ?>>Terminated</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-4" id="team_lead_section">
                <label for="client_id" class="form-label">Team Lead </label>
                <div class="dropdown">
                    <button class="dropbtn" type="button" style="justify-content:space-between;margin-right:3%">
                        <div>
                            <img src="" style="width:30px;border-radius:50%;height:30px;display:none;" id="selected_emp_img">
                            <span id="selected_emp_btn2">Select Team Lead</span>
                        </div> 
                        <div>
                            <i class="fa fa-angle-down" style="font-size:24px"></i>
                        </div> 
                    </button>
                    <div class="dropdown-content">
                        <?php $__currentLoopData = $Teamlead; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="outer" id="client_<?php echo e($client->id); ?>" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient(<?php echo e($client->id); ?>)">
                            <img src="<?php echo e($client->profile_img); ?>" style="width:45px;border-radius:50%;height:45px;">
                            <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                <span><?php echo e($client->first_name); ?> <?php echo e($client->last_name); ?> (#<?php echo e($client->id); ?>)</span>
                                <span><?php echo e($client->status); ?></span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <input type="hidden" name="team_lead_id" id="set_client_id" value="<?php echo e(old('team_lead_id')); ?>">
                <?php $__errorArgs = ['team_lead_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="working_type_id" class="form-label">Working Type <span class="text-danger">*</span></label>
                <select name="working_type_id" class="form-control select2" required>
                    <option value="1" <?php echo e(old('working_type_id') == '1' ? 'selected' : ''); ?>>Work From Office</option>
                    <option value="2" <?php echo e(old('working_type_id') == '2' ? 'selected' : ''); ?>>Work From Home</option>
                </select>
                <?php $__errorArgs = ['working_type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-12">
                <label for="signature" class="form-label">Signature <span class="text-danger">*</span></label>
                <div class="editor-container">
                    <div class="full-editor geteditor"><?php echo old('signature'); ?></div>
                    <input type="hidden" name="signature" id="signature" class="hidden-field">
                </div>
                <?php $__errorArgs = ['signature'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <hr>
        <h5 class="mb-4">4. Time Shift</h5>
        <div class="row mb-4"> 
            <div class="col-md-12">
                <label for="shift_id" class="form-label">Shift <span class="text-danger">*</span></label>
                <select name="shift_id" class="form-control select2" required>
                    <?php $__currentLoopData = $TimeShift; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Time->id); ?>" <?php echo e(old('shift_id') == $Time->id ? 'selected' : ''); ?>>
                            <?php echo e($Time->shift_name); ?> <b>-</b> <?php echo e(\Carbon\Carbon::parse($Time->StartTime)->format('H:i')); ?> <b>To</b> <?php echo e(\Carbon\Carbon::parse($Time->EndTime)->format('H:i')); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['shift_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <hr>
        <h5 class="mb-4">5. KRA</h5>
        <div class="row mb-4"> 
            <div class="col-md-12">
                <label for="kra" class="form-label">KRA <span class="text-danger">*</span></label>
                <div class="editor-container">
                    <div class="full-editor geteditor"><?php echo old('kra'); ?></div>
                    <input type="hidden" name="kra" id="kra" class="hidden-field">
                </div>
                <?php $__errorArgs = ['kra'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>     
        <hr>
        <h5 class="mb-4">6. Login</h5>
        <div class="row mb-4"> 
            <div class="col-md-6">
                <label for="login_email" class="form-label">Login Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="login_email" name="login_email" value="<?php echo e(old('login_email')); ?>" required />
                <?php $__errorArgs = ['login_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <div class="d-flex">
                    <input type="password" class="form-control" name="password" required />
                    <a id="showpass" class="btn btn-label-primary mx-1 waves-effect">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a id="random" class="btn btn-label-primary mx-1 waves-effect">
                        <i class="fa fa-refresh fa-spin"></i>
                    </a>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row mb-4"> 
            <div class="col-md-6 text-end">
                <a href="<?php echo e(url('Employee/Employee/home')); ?>" type="button" class="btn btn-outline-danger">Discard</a>
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
 $(document).ready(function() {

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

    // Initialize form validation
    

    // Password visibility toggle
    $("#showpass").on('click', function() {
        const passwordField = $("input[name='password']");
        const isPassword = passwordField.attr('type') === 'password';
        passwordField.attr('type', isPassword ? 'text' : 'password');
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });


    // Random password generation
    $("#random").on('click', function() {
        const randomPassword = generateRandomPassword(12);
        $("input[name='password']").val(randomPassword);
    });

    function generateRandomPassword(length) {
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+{}[]|:;<>,.?/";
        let password = "";
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }
        return password;
    }

    // Initialize international telephone input
    const input = document.querySelector("#phone_number");
    window.intlTelInput(input, {
        separateDialCode: true,
        initialCountry: "in"
    });

    // Dropdown selection for team lead
    function selectClient(id) {
        const clientName = $(`#client_${id} .sie_cont span:first-child`).text();
        const imgSrc = $(`#client_${id} img`).attr('src');
        
        $('#selected_emp_btn2').text(clientName);
        $('#set_client_id').val(id);
        $('#selected_emp_img').show().attr('src', imgSrc);
        $('.dropdown-content .outer').removeClass('selected');
        $(`#client_${id}`).addClass('selected');

        $.ajax({
            type: 'GET',
            url: `<?php echo e(url('Employee/Invoices/getClientDetails')); ?>/${id}`,
            success: function(res) {
                $('#shipping_address').val(`${res.data.address_1}, ${res.data.address_2}`);
            }
        });
    }

    // Handle team lead checkbox
    $('#team_lead').on('change', function() {
        $('.team-lead-container').toggle(!this.checked);
    });

    // Sync personal email with login email
    $('#personal_email').on('input', function() {
        $('#login_email').val(this.value);
    });
});

$(document).ready(function() {
    // Initialize the jQuery validation
    

    // Optional: Show/hide password functionality
    $("#showpass").on('click', function() {
        const passwordField = $("input[name='password']");
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Optional: Generate a random password functionality
    $("#random").on('click', function() {
        const randomPassword = Math.random().toString(36).slice(-8); // Generate a random 8-character password
        $("input[name='password']").val(randomPassword);
    });
});

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
  $(document).ready(function() {
    // Custom method to check if value is greater than 1000
    $.validator.addMethod("greaterThan1000", function(value, element) {
      return this.optional(element) || value > 1000;
    }, "Net Salary must be greater than 1000.");

    // Initialize form validation on the form.
    $("form").validate({
      rules: {
        weekly_off_id: {
          required: true,
          min: 1
        },
        kra: "required",
        signature: "required",
        net_salary: {
          required: true,
          number: true,
          greaterThan1000: true
        }
      },
      messages: {
        weekly_off_id: "Please select a day.",
        kra: "Please enter the KRA.",
        signature: "Please enter your signature.",
        net_salary: {
          required: "Please enter the net salary.",
          number: "Please enter a valid number.",
          greaterThan1000: "Net Salary must be greater than 1000."
        }
      },
      errorElement: "div",
      errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");
        if (element.prop("type") === "select-one") {
          error.insertAfter(element.next("span.select2"));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
      }
    });

    // On form submit, set hidden fields with the editor content
    $("form").on("submit", function(event) {
      var kraContent = $('.geteditor').eq(0).text(); // Assuming the first editor is for KRA
      var signatureContent = $('.geteditor').eq(1).text(); // Assuming the second editor is for Signature
      
      $('#kra').val(kraContent);
      $('#signature').val(signatureContent);

      // Validate again before submission
      if (!$(this).valid()) {
        event.preventDefault();
      }
    });
  });
</script>

<script>

 numberCount = 1;


  function selectClient(id) {
    var clientName = $('#client_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
    var imgSrc = $('#client_' + id + ' img').attr('src'); 
    $('#selected_emp_btn2').text(clientName); // Set the button text to the selected client name
    $('#set_client_id').val(id); // Set the button text to the selected client name
     $('#selected_emp_img').show();
    $('#selected_emp_img').attr('src', imgSrc); 

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
          url: "<?php echo e(url('Employee/Invoices/getClientDetails')); ?>/"+id,
          
          success: function(res) {
            console.log(res);// Make sure to adjust this based on your actual Select2 initialization method
            // alert(res.data.address_1 );
            $('#shipping_address').val(res.data.address_1 +', '+ res.data.address_2);
          },
        });
  }


  $(document).ready(function () {
    // Function to update the hidden field based on the editor content
    function updateHiddenField(index) {
      var editorContentText = $(".full-editor.geteditor").eq(index).html();

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
  // Get the checkbox element
const teamLeadCheckbox = document.getElementById('team_lead');

// Get the div to show/hide
const teamLeadContainer = document.querySelector('.team-lead-container');

// Add event listener for checkbox change
teamLeadCheckbox.addEventListener('change', function() {
    if (this.checked) {
        // If checkbox is checked, hide the div
        teamLeadContainer.style.display = 'none';
    } else {
        // If checkbox is unchecked, show the div
        teamLeadContainer.style.display = 'block';
    }
});


  $('#showpass').click(function(){
    if($(this).children().hasClass('fa-eye')){
    $('[name="password"]').attr('type','text');
    $(this).children().addClass('fa-eye-slash').removeClass('fa-eye');
    }
    else{
      $('[name="password"]').attr('type','password');
    $(this).children().addClass('fa-eye').removeClass('fa-eye-slash');
    }
  })

  $('#random').click(function(){
    var randomPassword = generateRandomPassword(12); 
      $('[name="password"]').val(randomPassword);
      
       function generateRandomPassword(length) {
        var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+{}[]|:;<>,.?/";
        var password = "";
        for (var i = 0; i < length; i++) {
            var randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }
        return password;
    }
  })
  
    // // Get the input element for personal email
    // const personalEmailInput = document.getElementById('personal_email');
    
    // // Get the input element for login email
    // const loginEmailInput = document.getElementById('login_email');

    // // Add event listener to personal email input to capture changes
    // personalEmailInput.addEventListener('input', function() {
    //     // Set the value of login email input to the value of personal email input
    //     loginEmailInput.value = personalEmailInput.value;
    // });
    
    $(document).ready(function() {
        $('#team_lead').change(function() {
            if ($(this).is(':checked')) {
                $('#team_lead_section').hide(500); 
            } else {
                $('#team_lead_section').show(500); 
            }
        });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/Employee/Humanesources/Employee/create.blade.php ENDPATH**/ ?>