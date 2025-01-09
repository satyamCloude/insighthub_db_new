<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-6">
    <a class="text-dark" href="#">
      <div class="card">
        <div class="card-body">
          <div class="row">
          <div class="col-sm-3">
               <img class="img-fluid" <?php if($Profile->profile_img): ?> src="<?php echo e($Profile->profile_img); ?>" <?php else: ?> src="<?php echo e(url('public/images/default_profile.jpg')); ?>" <?php endif; ?> width="115" alt="Avatar" style="width: 135px;">
          </div>
          <div class="col-sm-9" style="margin-top: 13px;">
                <h3 style="color: #000; font-size: 24px; line-height: 7px"><?php echo e($Profile->first_name); ?> <?php echo e($Profile->last_name); ?></h3>
                <p style=" margin-top: 0px; line-height: 7px"><?php echo e($Profile->name); ?></p>
                <p style="font-size: 14px; margin-top: 0px; line-height: 7px">Last login at -- <?php echo e($lastPunchTime); ?></p>
                <p style="font-size: 14px; margin-top: 0px; line-height: 7px">Role : <?php echo e($role); ?></p>
          </div>
        </div>
      </div>
    </a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-white border-0 b-shadow-4 mb-4 h-100">
       <div class="card-body ">
          <div class="justify-content-between">
              <p class="f-14 text-dark-grey" style="color:#000">Reporting To :</p>
               <?php if($ReportingTo): ?> <?php echo e(ucfirst($ReportingTo->first_name)); ?> <?php else: ?> -- <?php endif; ?>
          </div> 
       </div>
    </div>
  </div>

    <div class="col-md-3">
    <div class="card bg-white border-0 b-shadow-4 mb-4 h-100">
       <div class="card-body ">
          <div class=" justify-content-between">
              <p class="f-14 text-dark-grey" style="color:#000">Department Name : </p>
              <?php if($ReportingTeam): ?><?php echo e(ucfirst($ReportingTeam->name)); ?> <?php else: ?> -- <?php endif; ?>
          </div>
       </div>
    </div>
  </div>
  <!-- <div class="col-md-6">
    <div class="card bg-white border-0 b-shadow-4">
       <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
          <h4 class="f-18 f-w-500 mb-0" style="color:#000">KRA</h4>
       </div>
       <div class="card-body pt-2 ">
          <div style="color: #000;"><?php echo $Profile->kra; ?></div>
       </div>
    </div>
  </div>   -->
  <div class="col-md-6">
      <div class="card bg-white border-0 b-shadow-4">
       <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
          <h4 class="f-18 f-w-500 mb-0" style="color:#000">Profile Info</h4>
       </div>
       <div class="card-body pt-2">
       <div class="row">
        <div class="col-sm-4">
          <h5 class="text-dark small">Employee ID</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-"><?php echo e($Profile->id); ?></h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Full Name</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-"><?php echo e($Profile->first_name); ?> <?php echo e($Profile->last_name); ?></h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Designation</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-"><?php echo e($Profile->desg); ?></h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Department</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-"><?php echo e($Profile->department_name); ?></h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Gender</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-"><?php if($Profile->gender == 1): ?> Male <?php else: ?> Female <?php endif; ?></h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Marriage Anniversary</h5>
        </div>
        <div class="col-sm-8">
            <?php
            // Check if $Profile->dob is a date string
            $dobTimestamp = strtotime($Profile->marriage_anniversary);
        ?>
        
        <h6 class="ms-"><?php echo e(date('d-m-Y', $dobTimestamp)); ?></h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Date of Birth</h5>
        </div>
        <div class="col-sm-8">
<?php
    // Check if $Profile->dob is a date string
    $dobTimestamp = strtotime($Profile->dob);
?>

<h6 class="ms-"><?php echo e(date('d-m-Y', $dobTimestamp)); ?></h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Email</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-"><?php echo e($Profile->email); ?></h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Mobile</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-"><?php echo e($Profile->phone_number); ?></h6>
        </div>  
        <div class="col-sm-4">
          <h5 class="text-dark small">Address</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-"><?php echo e($Profile->address); ?></h6>
        </div>
       </div>
        
       </div>
      </div>
    </div> 

  <div class="col-md-3">
      <div class="card bg-white border-0 b-shadow-4 mb-4">
        <div class="card-header">
          <h6>Late Attendance &nbsp;<i class="fa-solid fa-question"></i></h6>
        </div>
         <div class="card-body ">
           <?php echo e($totalLateDays); ?>

         </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-white border-0 b-shadow-4 mb-4">
        <div class="card-header">
          <h6>Leaves Taken &nbsp;<i class="fa-solid fa-question"></i></h6>
        </div>
         <div class="card-body ">
           <?php echo e($totalLeaveTaken); ?>

         </div>
      </div>
    </div>
     
     
   <!-- <div class="col-md-6">
    
    <div class="card bg-white border-0 b-shadow-4">
       <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
          <h4 class="f-18 f-w-500 mb-0" style="color:#000">Tasks</h4>
       </div>
       <div class="card-body pt-2 ">
         <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                   <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Assign to</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                      <tbody class="table-border-bottom-0">
                  <?php $__currentLoopData = $RTTask; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td><?php echo e($key+1); ?></td>
                          <td><?php if($lst && $lst->task_name): ?> <?php echo e($lst->task_name); ?> <?php endif; ?></td>
                          <td><?php if($lst && $lst->AssignedTo): ?> <?php echo e(Auth::user()->first_name); ?> <?php endif; ?></td>
                          <td><?php if($lst && $lst->status_id == 1): ?> <span class="badge bg-label-primary me-1"> progress </span> <?php elseif($lst && $lst->status_id == 2): ?>  <span class="badge bg-label-danger me-1"> Overdue </span><?php endif; ?></td>
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>

                  </table>
              </div>
       </div>
    </div>
    <div class="row">
      <div class="col-md-12 my-4">
        <div class="card bg-white border-0 b-shadow-4">
       <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
          <h4 class="f-18 f-w-500 mb-0" style="color:#000">Tickets</h4>
       </div>
       <div style="text-align: center;" class="card-body pt-2 ">
        <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                   <thead>
                      <tr>
                        <th>Ticket Id</th>
                        <th>Subject</th>
                        <th>Assign to</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                      <tbody class="table-border-bottom-0">
                  <?php $__currentLoopData = $RTTicket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td><?php echo e($key+1); ?></td>
                          <td><?php if($lst && $lst->subject): ?> <?php echo e($lst->subject); ?> <?php endif; ?></td>
                          <td><?php if($lst && $lst->ccid): ?> <?php echo e(Auth::user()->first_name); ?> <?php endif; ?></td>
                          <td><?php if($lst && $lst->status == 1): ?><span class="badge bg-label-primary me-1"> progress </span><?php else: ?> if($lst && $lst->status == 1)  <span class="badge bg-label-danger me-1"> Overdue </span><?php endif; ?></td>
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>

                  </table>
              </div>
       </div>
    </div>
        
      </div>
    </div>
  </div> -->

  <?php /**PATH /home/insighthub/public_html/resources/views/Employee/Humanesources/Employee/Profile.blade.php ENDPATH**/ ?>