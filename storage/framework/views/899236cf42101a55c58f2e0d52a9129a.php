<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<!-- Content -->
<style>
   table{
   min-width:max-content!important; 
   vertical-align:baseline!important;
   }
</style>
<div id="toast-container" class="toast-top-right">
   <div class="toast toast-success" aria-live="polite">
      <div class="toast-progress" style="width: 0%;"></div>
      <div class="toast-message">
         <i class="fas fa-hand-peace"></i> Welcome To CloudTechtiq !
      </div>
   </div>
</div>
<div class="container-xxl flex-grow-1 container-p-y">
   <div class="row">
      <!-- Website Analytics -->
      <!-- Upper_Clock_Info  -->
      <div class="d-lg-flex d-md-flex d-block py-2 pb-2 align-items-center justify-content-between">
         <!-- WELOCOME NAME START -->
         <div>
            <h3 class="heading-h3 mb-0 f-21 font-weight-bold">Welcome <?php echo e(Auth::user()->first_name); ?></h3>
         </div>
         <!-- WELOCOME NAME END -->
         <!-- CLOCK IN CLOCK OUT START -->
         <div class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 m mt-4 mt-lg-0 mt-md-0 justify-content-between">
            <p class="mb-0 text-lg-right text-md-right f-18 font-weight-bold text-dark-grey d-grid align-items-center text-end"
               style="padding-right:15px;">
               <input type="hidden" id="current-latitude" name="current_latitude" autocomplete="off">
               <input type="hidden" id="current-longitude" name="current_longitude" autocomplete="off">
               <span class="f-10 font-weight-light"><?php echo e(\Carbon\Carbon::now()->format('l')); ?></span>
               <span id="dashboard-clock" style="font-weight: 700;"><?php echo e(\Carbon\Carbon::now()->format('h:i A')); ?></span>
               <span class="f-11 font-weight-normal text-lightest" style="color:#b4b2bb !important;">
               Clock In at : 
               <span><?php if($CheckInTime && $CheckInTime->punch_in): ?> <?php echo e(\Carbon\Carbon::parse($CheckInTime->punch_in)->format('h:i A')); ?><?php else: ?> 00:00:00 <?php endif; ?></span>
               </span>
            </p>
            <?php if(Auth::user()->clock_status == 0): ?>
            <button type="button" class="btn-primary rounded f-15 ml-4" id="clockin1" value="clockin"
               onclick="clock(<?php echo e(auth()->id()); ?>, 'clockin')"
               style="border: 0;color: #fff;padding: 9px 11px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;">
            <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>
            </button>
            <button type="button" class="btn-danger rounded f-15 ml-4" id="clockout1" value="clockout" style="border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: none;padding-top:20px;">
            <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>
            </button>
            <?php else: ?>
            <button type="button" class="btn-primary rounded f-15 ml-4" id="clockin1" value="clockin" style="border: 0;color: #fff;padding: 9px 11px;position: relative;text-transform: capitalize;display: none;padding-top:20px;">
            <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>
            </button>
            <button type="button" class="btn-danger rounded f-15 ml-4" id="clockout1" value="clockout"
               onclick="clock(<?php echo e(auth()->id()); ?>, 'clockout')"
               style="border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;">
            <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>
            </button>
            <?php endif; ?>
            <!--<button type="button" class="btn-danger rounded f-15 ml-4" id="clockout" value="clockout"-->
            <!--  onclick="clock(<?php echo e(auth()->id()); ?>,value)"-->
            <!--  style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;display: none;">-->
            <!--  <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>-->
            <!--</button>-->
            <!--<button type="button" class="btn-primary rounded f-15 ml-4" id="clockin" value="clockin"-->
            <!--  onclick="clock(<?php echo e(auth()->id()); ?>,value)"-->
            <!--  style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;display: none;">-->
            <!--  <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>-->
            <!--</button>-->
         </div>
         <!-- CLOCK IN CLOCK OUT END -->
      </div>
      <?php if(Session::has('success')): ?>
      <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
      <?php endif; ?>
      <?php if(Session::has('error')): ?>
      <div class="alert alert-danger"><?php echo e(Session::get('error')); ?></div>
      <?php endif; ?>
      <div class="col-lg-8 mb-4">
         <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
            id="swiper-with-pagination-cards">
            <div class="swiper-wrapper">
               <div class="swiper-slide">
                  <div class="row">
                     <div class="col-12">
                        <h5 class="text-white mb-0 mt-2"><?php echo e(Auth::user()->first_name); ?></h5>
                        <small>Team Lead</small></br>
                        <small>Employee ID: Emp-<?php echo e(Auth::user()->id); ?></small>
                     </div>
                     <div class="row">
                        <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                           <h6 class="text-white mt-0 mt-md-3 mb-3">Overview</h6>
                           <div class="row">
                              <div class="col-7">
                                 <ul class="list-unstyled mb-0">
                                    <li class="d-flex mb-4 align-items-center">
                                       <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ShiftHours"
                                          style="min-width: 72px;"><?php echo e($OpenTicket); ?></p>
                                       <p class="mb-0"  style="min-width: 72px;">Open Tasks</p>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                       <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ShiftHours"
                                          style="min-width: 72px;"><?php echo e($TProJect); ?></p>
                                       <p class="mb-0"  style="min-width: 72px;">Projects</p>
                                    </li>
                                 </ul>
                              </div>
                              <div class="col-5">
                                 <ul class="list-unstyled mb-0">
                                    <li class="d-flex mb-4 align-items-center">
                                       <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ShiftHours"
                                          style="min-width: 72px;"><?php echo e($OpenTask); ?></p>
                                       <p class="mb-0"  style="min-width: 72px;">Open Tickets</p>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                       <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ShiftHours"
                                          style="min-width: 72px;"><?php echo e($averageResponseTime); ?></p>
                                       <p class="mb-0">Averave response rate</p>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                           <img
                              src="<?php echo e(Auth::user()->profile_img); ?>"
                              alt="Website Analytics"
                              width="170"
                              class="card-website-analytics-img" style="border-radius: 50%;"/>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="swiper-slide">
                  <div class="row">
                     <div class="col-12">
                        <h5 class="text-white mb-0 mt-2">Logs</h5>
                        <!-- <small>2 : 40 : 06 PM</small> -->
                     </div>
                     <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                        <h6 class="text-white mt-0 mt-md-3 mb-3">Time-Logs</h6>
                        <div class="row">
                           <div class="col-7">
                              <ul class="list-unstyled mb-0">
                                 <li class="d-flex mb-4 align-items-center">
                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="grand-total-time"
                                       style="min-width: 72px;">0</p>
                                    <p class="mb-0"  style="min-width: 82px;">Total Duration</p>
                                 </li>
                                 <li class="d-flex align-items-center mb-2">
                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="BreakTime"
                                       style="min-width: 72px;"><?php echo e($totalBreakTime); ?></p>
                                    <p class="mb-0"  style="min-width: 72px;">Total Interval</p>
                                 </li>
                              </ul>
                           </div>
                           <div class="col-5">
                              <ul class="list-unstyled mb-0">
                                 <li class="d-flex mb-4 align-items-center">
                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ExtraWorkingTime"
                                       style="min-width: 72px;"><?php echo e($totalOvertime); ?></p>
                                    <p class="mb-0">Overtime</p>
                                 </li>
                                 <li class="d-flex align-items-center mb-2">
                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ShiftHours"
                                       style="min-width: 72px;"><?php echo e($shiftDuration); ?></p>
                                    <p class="mb-0">Shift Hours</p>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                        <img src="<?php echo e(url('public/logo/clock.png')); ?>" alt="Website Analytics" width="170"
                           class="card-website-analytics-img" style="border-radius: 50%;" />
                     </div>
                  </div>
               </div>
            </div>
            <div class="swiper-pagination"></div>
         </div>
      </div>
      <!--/ Website Analytics -->
      <!-- Sales Overview -->
      <?php if($moduleSetting && $moduleSetting->tasks == 1): ?>
      <div class="col-lg-4 col-sm-6 mb-4">
         <div class="card">
            <div class="card-header">
               <div class="d-flex justify-content-between">
                  <h4 class="card-title mb-1">Task Overview</h4>
               </div>
               <div style="display: flex;justify-content: space-between;">
                  <small class="d-block mb-1 text-muted">Total Tasks</small>
                  <p class="card-text text-success"><?php echo e($showTTask); ?></p>
               </div>
            </div>
            <div class="card-body">
               <div class="row py-4">
                  <div class="col-4">
                     <div class="d-flex gap-2 align-items-center mb-2">
                        <span class="badge bg-label-info p-1 rounded"><i class="ti ti-shopping-cart ti-xs"></i></span>
                        <p class="mb-0">Pending</p>
                     </div>
                     <h5 class="mb-0 pt-1 text-nowrap"><?php echo e($OpenTask); ?></h5>
                  </div>
                  <div class="col-4">
                     <div class="divider divider-vertical">
                        <div class="divider-text">
                           <span class="badge-divider-bg bg-label-secondary">VS</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-4 text-end">
                     <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                        <p class="mb-0">Overdue</p>
                        <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-xs"></i></span>
                     </div>
                     <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0"><?php echo e($TasksOverDue); ?></h5>
                  </div>
               </div>
               <div class="d-flex align-items-center mt-4">
                  <div class="progress w-100" style="height: 8px">
                     <div class="progress-bar bg-info" style="width: <?php echo e(($TTask != 0) ? ($OpenTask / $TTask * 100) : 0); ?>%"
                        role="progressbar" aria-valuenow="<?php echo e($OpenTask); ?>" aria-valuemin="0" aria-valuemax="<?php echo e($TTask); ?>"></div>
                     <div class="progress-bar bg-primary"
                        style="width: <?php echo e(($TTask != 0) ? ($TasksOverDue / $TTask * 100) : 0); ?>%" role="progressbar"
                        aria-valuenow="<?php echo e($TasksOverDue); ?>" aria-valuemin="0" aria-valuemax="<?php echo e($TTask); ?>"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php endif; ?>
      <!--/ Sales Overview -->
      <!-- Revenue Generated -->
      <?php if($moduleSetting && $moduleSetting->projects == 1): ?>
      <div class="col-lg-4 col-sm-6 mb-4">
         <div class="card">
            <div class="card-header">
               <div class="d-flex justify-content-between">
                  <h4 class="card-title mb-1">Project Overview</h4>
               </div>
               <div style="display: flex;justify-content: space-between;">
                  <small class="d-block mb-1 text-muted">Total Projects</small>
                  <p class="card-text text-success"><?php echo e($showTProJect); ?></p>
               </div>
            </div>
            <div class="card-body">
               <div class="row py-4">
                  <div class="col-4">
                     <div class="d-flex gap-2 align-items-center mb-2">
                        <span class="badge bg-label-info p-1 rounded"><i class="ti ti-shopping-cart ti-xs"></i></span>
                        <p class="mb-0">Ongoing</p>
                     </div>
                     <!-- <h5 class="mb-0 pt-1 text-nowrap">2</h5> -->
                     <small class="text-muted"><?php echo e($ProJectGoingoN); ?></small>
                  </div>
                  <div class="col-4">
                     <div class="divider divider-vertical">
                        <div class="divider-text">
                           <span class="badge-divider-bg bg-label-secondary">VS</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-4 text-end">
                     <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                        <p class="mb-0">Overdue</p>
                        <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-xs"></i></span>
                     </div>
                     <!-- <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">3</h5> -->
                     <small class="text-muted"><?php echo e($ProJectOverDue); ?></small>
                  </div>
               </div>
               <div class="d-flex align-items-center mt-4">
                  <div class="progress w-100" style="height: 8px">
                     <?php if($ProJectGoingoN && $TProJect): ?>
                     <div class="progress-bar bg-info" style="width:<?php echo e($ProJectGoingoN / $TProJect * 100); ?>%" role="progressbar"
                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                     <?php else: ?>
                     <div class="progress-bar bg-info" style="width:3%" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                        aria-valuemax="100"></div>
                     <?php endif; ?>
                     <?php if($ProJectOverDue && $TProJect): ?>
                     <div class="progress-bar bg-primary" role="progressbar"
                        style="width:<?php echo e($ProJectOverDue / $TProJect * 100); ?>%" aria-valuenow="30" aria-valuemin="0"
                        aria-valuemax="100"></div>
                     <?php else: ?>
                     <div class="progress-bar bg-info" style="width:3%" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                        aria-valuemax="100"></div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php endif; ?>
      <!--/ Revenue Generated -->
      <!-- Earning Reports -->
      <div class="col-lg-8 mb-4">
         <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 100%;">
            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
               <h4 class="f-18 f-w-500 mb-0">In-Active clients</h4>
               <a href="<?php echo e(url('admin/Client/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               <!-- <a href="<?php echo e(url('admin/TimeShift/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm" id="view-shifts">Employee Shift</a> -->
               <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;" autocomplete="off">
               <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;"
                  autocomplete="off">
               <input type="email" name="f_email" class="autocomplete-password" readonly=""
                  style="opacity: 0;position: absolute;" autocomplete="off">
               <input type="text" name="f_slack_username" class="autocomplete-password" readonly=""
                  style="opacity: 0;position: absolute;" autocomplete="off">
            </div>
            <div class="card-body p-0 h-200 table-responsive mb-2" style="overflow-x:auto;">
               <table class="table" id="example">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Client Name</th>
                        <th>Email</th>
                        <!-- <th>Company</th> -->
                        <th>Status</th>
                        <th>Created</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $Profilestatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td><?php echo e($Profile->id); ?></td>
                        <td>
                           <?php if($Profile->profile_img): ?>
                           <img class="rounded-circle" style="margin-right: 15px;"
                              src="<?php echo e($Profile->profile_img); ?>" height="30" width="30" alt="User avatar" />
                           <?php else: ?>
                           <img class="rounded-circle" style="margin-right: 15px;"
                              src="<?php echo e(url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />
                           <?php endif; ?>
                           <a href="<?php echo e(url('admin/Client/home')); ?>"><?php echo e($Profile->first_name); ?> <?php echo e($Profile->last_name); ?> | (#<?php echo e($Profile->id); ?>)</a>
                           <div class="mt-0" style="font-size:12px; margin-left: 49px; margin-top: -11px;"><?php echo e($Profile->company_name); ?></div>
                        </td>
                        <td><?php echo e($Profile->email); ?></td>
                        <!-- <td><?php echo e($Profile->company_name); ?></td> -->
                        <td><span class="badge bg-label-danger">Incomplete</span></td>
                        <td><?php echo e($Profile->created_at->format('Y-m-d')); ?></td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!--/ Earning Reports -->
      <!-- Cancellation Request -->
      <div class="col-md-6 mb-4">
         <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
               <h4 class="f-18 f-w-500 mb-0">Cancellation Request</h4>
               <a href="<?php echo e(url('admin/cancelRequests')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
            </div>
            <div class="card-body p-0 h-200 table-responsive mb-2" style="overflow-x:auto;">
               <table class="table" id="example">
                  <thead>
                     <tr>
                        <th>#ID</th>
                        <th>Client</th>
                        <th>Service</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <?php
                  $allEmpty = true;
                  foreach ($cancelRequests as $requests) {
                  if (count($requests) > 0) {
                  $allEmpty = false;
                  break;
                  }
                  }
                  ?>
                  <tbody>
                     <?php if($allEmpty): ?>
                     <tr>
                        <td colspan="4" class="shadow-none">
                           <div class="d-flex align-items-center justify-content-center w-100 flex-column text-dark p-20">
                              <div class="f-15 mt-4">
                                 - No record found. -
                              </div>
                           </div>
                        </td>
                     </tr>
                     <?php else: ?>
                     <?php $__currentLoopData = $cancelRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if(isset($value)): ?>
                     <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td>#<?php echo e($lst->id); ?></td>
                        <td>
                           <?php if($lst && $lst->profile_img): ?>
                           <img class="rounded-circle" style="margin-right: 15px;"
                              src="<?php echo e($lst->profile_img); ?>" height="30" width="30" alt="User avatar" />
                           <?php else: ?>
                           <img class="rounded-circle" style="margin-right: 15px;"
                              src="<?php echo e(url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />
                           <?php endif; ?>
                           <a href="<?php echo e(url('admin/Client/home')); ?>"><?php echo e($lst->first_name); ?> <?php echo e($lst->last_name); ?> | (#<?php echo e($lst->user_id); ?>)</a>
                           <div style="font-size:12px; margin-left: 46px; margin-top: -11px;"><?php echo e($lst->company_name); ?></div>
                        </td>
                        <td><?php echo e($lst->product_name); ?></td>
                        <td class="text-danger">
                           <a href="<?php echo e(url('admin/subscription/appUnapp/'.$lst->id.'/'.$lst->category_id.'/2')); ?>">
                           <button class="btn btn-success btn-sm">Approve</button>
                           </a><br/>
                           <a href="<?php echo e(url('admin/subscription/appUnapp/'.$lst->id.'/'.$lst->category_id.'/5')); ?>">
                           <button class="btn btn-danger btn-sm mt-1" >Unapprove</button>
                           </a>
                        </td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- My Task -->
      <?php if($moduleSetting && $moduleSetting->tasks == 1): ?>
      <div class="col-md-6 mb-4">
         <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
               <h4 class="f-18 f-w-500 mb-0">My Task</h4>
               <a href="<?php echo e(url('admin/Task/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
            </div>
            <div class="card-body p-0 h-200 table-responsive mb-2" style="overflow-x:auto;">
               <table class="table" id="example">
                  <thead>
                     <tr>
                        <th>#Task</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Due Date</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $TaskD; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Tass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td>#<?php echo e($Tass->id); ?></td>
                        <td><?php echo e($Tass->task_name); ?></td>
                        <td><?php switch($Tass->status_id):
                           case ('1'): ?>
                           <span class="badge bg-label-primary">In Progress</span>
                           <?php break; ?>
                           <?php case ('2'): ?>
                           <span class="badge bg-label-success">Completed</span>
                           <?php break; ?>
                           <?php case ('3'): ?>
                           <span class="badge bg-label-warning">Over Due</span>
                           <?php break; ?>
                           <?php case ('4'): ?>
                           <span class="badge bg-label-danger">Cancel</span>
                           <?php break; ?>
                           <?php default: ?>
                           <span></span>
                           <?php endswitch; ?>
                        </td>
                        <td class="text-danger"><?php echo e($Tass->endDate); ?></td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <?php endif; ?>
      <div class="col-lg-6 mb-4">
         <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
               <h4 class="f-18 f-w-500 mb-0">Orders</h4>
               <a href="<?php echo e(url('admin/Orders/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               <!-- <a href="<?php echo e(url('admin/TimeShift/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm" id="view-shifts">Employee Shift</a> -->
               <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;" autocomplete="off">
               <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;"
                  autocomplete="off">
               <input type="email" name="f_email" class="autocomplete-password" readonly=""
                  style="opacity: 0;position: absolute;" autocomplete="off">
               <input type="text" name="f_slack_username" class="autocomplete-password" readonly=""
                  style="opacity: 0;position: absolute;" autocomplete="off">
            </div>
            <div class="card-body p-0 h-200 table-responsive mb-2" style="overflow-x:auto;">
               <table class="table" id="example">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Amount</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $Order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td><?php echo e($Profile->order_number); ?></td>
                        <td>
                           <?php if($Profile->profile_img): ?>
                           <img class="rounded-circle" style="margin-right: 15px;"
                              src="<?php echo e($Profile->profile_img); ?>" height="30" width="30" alt="User avatar" />
                           <?php else: ?>
                           <img class="rounded-circle" style="margin-right: 15px;"
                              src="<?php echo e(url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />
                           <?php endif; ?>
                           <a href="<?php echo e(url('admin/Client/home')); ?>"><?php echo e($Profile->first_name); ?> <?php echo e($Profile->last_name); ?> | (#<?php echo e($Profile->user_id); ?>)</a>
                           <div class="mt-0" style="font-size:12px; margin-left: 49px; margin-top: -11px;"><?php echo e($Profile->company_name); ?></div>
                        </td>
                        <td><?php echo e($Profile->prefix); ?> <?php echo e($Profile->amount); ?></td>
                        <td><?php if($Profile->is_payment_recieved == 0 ): ?> <span class="btn btn-danger btn-sm"> Unpad </span> <?php else: ?>
                           <span class="btn btn-success btn-sm"> Paid </span> <?php endif; ?>
                        </td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!--upcoming event-->
      <div class="col-lg-6 mb-4">
         <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
               <div class="card-title m-0 me-2 d-flex justify-content-between" style="width:100%">
                  <h4 class="f-18 f-w-500 mb-0">Upcoming Events</h4>
                  <!--<small class="text-muted"><?php echo e(now()); ?></small>-->
                  <a href="<?php echo e(url('admin/Calendar/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See
                  More</a>
               </div>
            </div>
            <div class="card-body h-200 table-responsive mb-2" style="overflow-x:auto;">
               <ul class="p-0 m-0">
                  <?php $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="d-flex mb-4 pb-1">
                     <div class="me-3">
                     </div>
                     <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                           <h6 class="mb-0">User :<?php echo e($Product->first_name); ?> <?php echo e($Product->last_name); ?> (#<?php echo e($Product->id); ?>) </h6>
                           <small class="text-muted d-block">Dates : (<?php echo e($Product->start); ?> - <?php echo e($Product->end); ?>)</small> 
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                           <p class="mb-0 fw-medium">Title :<?php echo e(substr($Product->title, 0, 15)); ?></p>
                        </div>
                     </div>
                  </li>
                  <hr/>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </ul>
            </div>
         </div>
      </div>
      <div class="col-lg-6 mb-4">
         <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
               <h4 class="f-18 f-w-500 mb-0">Invoices</h4>
               <a href="<?php echo e(url('admin/Invoices/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See
               More</a>
               <!-- <a href="<?php echo e(url('admin/TimeShift/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm" id="view-shifts">Employee Shift</a> -->
               <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;" autocomplete="off">
               <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;"
                  autocomplete="off">
               <input type="email" name="f_email" class="autocomplete-password" readonly=""
                  style="opacity: 0;position: absolute;" autocomplete="off">
               <input type="text" name="f_slack_username" class="autocomplete-password" readonly=""
                  style="opacity: 0;position: absolute;" autocomplete="off">
            </div>
            <div class="card-body p-0 h-200 table-responsive mb-2" style="overflow-x:auto;">
               <table class="table" id="example">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <!-- <th>Invoice Id</th> -->
                        <!-- <th>Company</th> -->
                        <th>Total Amount</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $Invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td><?php echo e($Profile->id); ?></td>
                        <td>
                           <?php if($Profile->profile_img): ?>
                           <img class="rounded-circle" style="margin-right: 15px;"
                              src="<?php echo e($Profile->profile_img); ?>" height="30" width="30" alt="User avatar" />
                           <?php else: ?>
                           <img class="rounded-circle" style="margin-right: 15px;"
                              src="<?php echo e(url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />
                           <?php endif; ?>
                           <a href="<?php echo e(url('admin/Client/home')); ?>"><?php echo e($Profile->first_name); ?> <?php echo e($Profile->last_name); ?> | (#<?php echo e($Profile->user_id); ?>)</a>
                           <div class="mt-0" style="font-size:12px; margin-left: 49px; margin-top: -11px;"><?php echo e($Profile->company_name); ?></div>
                        </td>
                        <!-- <td><?php echo e($Profile->invoice_number2); ?> </td> -->
                        <td><?php echo e($Profile->prefix); ?> <?php echo e($Profile->amount); ?> </td>
                        <td>
                           <?php if($Profile && $Profile->is_payment_recieved == 1): ?>
                           <span class="btn btn-success btn-sm">Paid</span>
                           <?php else: ?>
                           <span class="btn btn-danger btn-sm">Unpaid</span>
                           <?php endif; ?>
                        </td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!--/ My Task -->
      <!-- Sales By Country -->
      <!--/ Sales By Country -->
      <!-- Total Earning -->
      <?php if($moduleSetting && $moduleSetting->leaves == 1): ?>
      <div class="col-xl-6 col-md-6  mb-4">
         <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
            <div class="parent d-flex justify-content-between">
               <div class="card-header ">
                  <div class="card-title mb-0">
                     <h5 class="mb-0">On Leave Today</h5>
                     <small class="text-muted"><?php echo e(count($OnLeaves)); ?> Employees</small>
                  </div>
               </div>
               <div class="child2 mt-4" style="margin-right:4%">
                  <a href="<?php echo e(url('admin/Leave/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               </div>
            </div>
            <div class="card-body" style="overflow:auto;">
               <ul class="list-unstyled mb-0">
                  <?php if(count($OnLeaves) > 0): ?>
                  <?php $__currentLoopData = $OnLeaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Leaves): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="mb-3 pb-1">
                     <div class="d-flex align-items-start">
                        <div class="p-2 me-1 rounded">
                           <img class="rounded-circle"
                              src="<?php echo e(isset($Leaves->profile_img) ? $Leaves->profile_img : url('public/images/21104.png')); ?>"
                              height="30" width="30" alt="User avatar" />
                        </div>
                        <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                           <div class="me-2">
                              <h6 class="mb-1"><?php echo e($Leaves->first_name); ?></h6>
                              <small class="text-muted"><?php echo e($Leaves->dptname); ?></small>
                           </div>
                           <div class="d-flex align-items-center">
                              <?php switch($Leaves->status):
                              case ('1'): ?>
                              <span class="ms-3 badge bg-label-success">APPROVED</span>
                              <?php break; ?>
                              <?php case ('2'): ?>
                              <span class="ms-3 badge bg-label-danger">UNAPPROVED</span>
                              <?php break; ?>
                              <?php case ('3'): ?>
                              <span class="ms-3 badge bg-label-warning">PENDING</span>
                              <?php break; ?>
                              <?php default: ?>
                              <?php endswitch; ?>
                           </div>
                        </div>
                     </div>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
               </ul>
            </div>
         </div>
      </div>
      <?php endif; ?>
      <?php if($moduleSetting && $moduleSetting->tickets == 1): ?>
      <div class="col-xl-6 col-md-6  mb-4">
         <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
               <h4 class="f-18 f-w-500 mb-0">Tickets</h4>
               <a href="<?php echo e(url('admin/Ticket/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
            </div>
            <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
               <table class="table" id="example">
                  <thead class="">
                     <tr>
                        <th>#Ticket ID</th>
                        <th>Ticket Subject</th>
                        <th>Status</th>
                        <th class="text-right pr-20">Requested On</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if(count($LTicket) > 0): ?>
                     <?php $__currentLoopData = $LTicket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td>#<?php echo e($ticket->id); ?></td>
                        <td>
                           <?php if($ticket && $ticket->subject): ?> 
                           <?php echo e($ticket->subject); ?>

                           <?php else: ?>
                           --
                           <?php endif; ?>
                        </td>
                        <td>
                           <?php if($ticket && $ticket->status == 1): ?> 
                           <span class="badge bg-label-success me-1">
                           Open
                           </span> 
                           <?php elseif($ticket && $ticket->status == 2): ?> 
                           <span class="badge bg-label-info me-1">
                           In Progess
                           </span>
                           <?php elseif($ticket && $ticket->status == 3): ?> 
                           <span class="badge bg-label-warning me-1">
                           On Hold
                           </span>
                           <?php elseif($ticket && $ticket->status == 4): ?> 
                           <span class="badge bg-label-success me-1">
                           Resolved
                           </span>
                           <?php elseif($ticket && $ticket->status == 5): ?> 
                           <span class="badge bg-label-success me-1">
                           Closed
                           </span>
                           <?php else: ?>
                           <span class="badge bg-label-success me-1">
                           Open
                           </span>
                           <?php endif; ?>
                        </td>
                        <td><?php echo e($ticket->date); ?></td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php else: ?>
                     <tr>
                        <td colspan="4" class="shadow-none">
                           <div class="align-items-center d-flex flex-column text-lightest p-20 w-100">
                              <i class="fa-solid fa-list-check"></i>
                              <div class="f-15 mt-4">
                                 - No record found. -
                              </div>
                           </div>
                        </td>
                     </tr>
                     <?php endif; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <?php endif; ?>
      <!--/ Source Visit -->
      <?php if($moduleSetting && $moduleSetting->notices == 1): ?>
      <div class="col-xl-6 col-md-6 mb-4">
         <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
            <div class="d-flex justify-content-between b-shadow-4 p-20" style="box-shadow: 0 0 4px 0 #e8eef3;display:flex;align-items:center;padding:20px;">
               <p class="mb-0 f-18 f-w-500"> Notices </p>
               <a href="<?php echo e(url('admin/Notice/showNotice')); ?>" class="btn btn-sm btn-primary text-white"> See More </a>
            </div>
            <div class="b-shadow-4 cal-info ps ps--active-y" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" id="empDashNotice" style="height: 100%; overflow-y: auto;">
               <?php if(count($Notices) > 0): ?>
               <?php $__currentLoopData = $Notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="card border-0 b-shadow-4 p-20 rounded-0" style="box-shadow: 0 0 4px 0 #e8eef3;padding:20px;border-radius: 0!important;word-wrap: break-word;background-clip: border-box;background-color: #fff;border: 1px solid rgba(0,0,0,.125);border-radius: 0.25rem;display: flex;flex-direction: column;min-width: 0;position: relative;">
                  <div class="card-horizontal" style="display: flex;flex: 1 1 auto;">
                     <div class="card-header m-0 p-0 bg-white rounded" style="border: 1px solid #616e80!important;height: 45px;width: 37px;padding:0px; margin:0px;">
                        <span class="f-12 p-1" style="border-bottom: 1px solid #616e80!important;display:block;line-height: 17px;text-align: center;padding: 0.25rem!important;font-size:13px !important;"><?php echo e(\Carbon\Carbon::parse($Noti->Applieddate)->format('M')); ?></span>
                        <span class="f-13 f-w-500 rounded-bottom" style="display: block;line-height: 17px;text-align: center;border-bottom-left-radius: 0.25rem!important;font-size: 13px;font-size: 12px;"><?php echo e(\Carbon\Carbon::parse($Noti->Applieddate)->format('d')); ?></span>
                     </div>
                     <div class="card-body border-0 p-0 ml-3" style="padding: 0!important; margin-left: 1rem!important;border: 0!important; flex: 1 1 auto;min-height: 1px;">
                        <h4 class="card-title f-14 font-weight-normal mb-0" style="line-height: 21px;font-weight:normal;margin-bottom:0px;font-size:14px;">
                           <a href="javascript:void(0)" class="openRightModal text-darkest-grey" style="color:#4d4f5c!important;"><?php echo e($Noti->notice); ?></a>
                        </h4>
                     </div>
                  </div>
               </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php else: ?>
               <div class="align-items-center d-flex flex-column text-lightest p-20 w-100 mt-5">
                  <i class="fa-solid fa-list-check"></i>
                  <div class="f-15 mt-4">- No record found. -</div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
      <?php endif; ?>
      <!-- Projects table -->
      <!--/ Projects table -->
   </div>
</div>
<!--/ Total Duration start-->
<div class="col-xl-6 col-md-6  mb-4">
   <?php $__currentLoopData = $Attendence; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <div class="odd">
      <input type="hidden" class="punch-in<?php echo e($key+1); ?>" value="<?php echo e($att->punch_in); ?>">
      <input type="hidden" class="punch-out<?php echo e($key+1); ?>"
         value="<?php if($att && $att->punch_out): ?><?php echo e($att->punch_out); ?> <?php else: ?> <?php echo e(\Carbon\Carbon::now()->format('H:i:s')); ?> <?php endif; ?> ">
      <input type="hidden" class="total-time<?php echo e($key+1); ?>" value="">
   </div>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__currentLoopData = $calenderEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$check = DB::table('event_notifications')->where([
'type' => 'event',
'user_id' => Auth::user()->id,
'cc_id' => $lst->id,
'notification_date' => now()->format('Y-m-d'),
])->first();
if(!$check){
?>
<script>
   $(document).ready(function() {
     bootbox.alert({
       message: "<?php echo e($lst->title); ?>",
       size: 'small',
       callback: function() {
         console.log("Alert displayed for event: <?php echo e($lst->title); ?>");
       }
     });
   });
</script>
<?php
//send mail to logged in user regarding this event
DB::table('event_notifications')->insert([
'type' => 'event',
'user_id' => Auth::user()->id,
'cc_id' => $lst->id,
'notification_date' => now()->format('Y-m-d'),
]);
}
?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script>
  $(document).ready(function () {
    
      var workingHours = '<?php echo e($TimeShift && isset($TimeShift->working_hours) ? $TimeShift->working_hours : 0); ?>'; // Set your working hours, if not available, take it as 0
    
      var WorkingHoursInSeconds = calculateTotalSeconds(parseTime(workingHours));
    
      var grandTotalSeconds = 0;
    
      var totalBreakSeconds = 0;
    
    
    
      // Loop through each odd entry
    
      $('.odd').each(function (index) {
    
        var punchIn = $(this).find('.punch-in' + (index + 1)).val();
    
        var punchOut = $(this).find('.punch-out' + (index + 1)).val();
    
    
    
        var diff = calculateTimeDifference(punchIn, punchOut);
    
        $(this).find('.total-time' + (index + 1)).val(formatTimeDifference(diff));
    
    
    
        // Accumulate the total in seconds
    
        grandTotalSeconds += calculateTotalSeconds(diff);
    
    
    
        // Calculate and accumulate the break time for each pair of punch-out and punch-in
    
        if (index > 0) {
    
          var previousPunchOut = $('.odd').eq(index - 1).find('.punch-out' + (index)).val();
    
          var breakDiff = calculateTimeDifference(previousPunchOut, punchIn);
    
          totalBreakSeconds += calculateTotalSeconds(breakDiff);
    
        }
    
      });
    
    
      // Calculate overtime, pending time, and extra working time
    
      var overallTime = grandTotalSeconds;
    
      var breakTime = totalBreakSeconds;
    
      var workingTime = overallTime - breakTime;
    
      // Display the grand total time
    
      $('#grand-total-time').text(formatTotalTime(grandTotalSeconds));
    
    
    
      // Display the total break time
    
      // $('#BreakTime').text(formatTotalTime(totalBreakSeconds));
    
    
    
      // Calculate and display overtime, pending time, and extra working time
    
      var overtime = 0;
    
      var pendingTime = 0;
    
      var extraWorkingTime = 0;
      if (WorkingHoursInSeconds) {
    
        extraWorkingTime ="<?php echo e($totalOvertime); ?>";
        // Only display overtime if it is greater than zero
    
        if (extraWorkingTime > 0) {
    
          overtime = extraWorkingTime;
    
        } else {
    
          overtime = 0;
    
        }
    
      }
    
    
      <?php
      $totalOvertimeFormatted = $totalOvertime; // Format total overtime
      ?>
      
      $('#PendingTime').text(formatTotalTime(pendingTime));
      
      
      function calculateTimeDifference(start, end) {

        var startTime = new Date("2000-01-01 " + start);

        var endTime = new Date("2000-01-01 " + end);



        var timeDiff = endTime - startTime; // Difference in milliseconds



        // Calculate hours, minutes, and seconds

        var hours = Math.floor(timeDiff / 3600000); // 1 hour = 3600000 milliseconds

        var minutes = Math.floor((timeDiff % 3600000) / 60000); // 1 minute = 60000 milliseconds



        return {

          hours: hours,

          minutes: minutes,

        };

      }

      function calculateTotalSeconds(diff) {

        return diff.hours * 3600 + diff.minutes * 60;

      }

      function formatTotalTime(totalSeconds) {

        if (totalSeconds <= 0) {

          return '00:00';

        }



        var hours = Math.floor(totalSeconds / 3600);

        var minutes = Math.floor((totalSeconds % 3600) / 60);



        return padZero(hours) + ':' + padZero(minutes);

      }

      function formatTimeDifference(diff) {

        return padZero(diff.hours) + ':' + padZero(diff.minutes);

      }
      
      function padZero(value) {

        return value < 10 ? '0' + value : value;
      }
      
      function parseTime(timeString) {
    
        var timeParts = timeString.split(':');
    
        return {
    
          hours: parseInt(timeParts[0], 10),
    
          minutes: parseInt(timeParts[1], 10),
    
          seconds: parseInt(timeParts[2], 10),
    
        };
      }
    
  });
  
  function clock(id, value) {
    clockStatusUpdate(id, value);
  }

  function clockStatusUpdate(id, value) {
    $.ajax({
      url: "<?php echo e(url('admin/ClockStatusUpdate')); ?>",
      method: 'get',
      data: { id: id, value: value },
      success: function (response) {
        if (response && response.data && response.data.clock_status !== undefined) {
          const clockStatus = response.data.clock_status;
          updateClockButtons(clockStatus);
          
          window.location.reload();
        } else {
          alert('Invalid response format');
        }
      },
      error: function (xhr, status, error) {
        console.error('AJAX request failed:', status, error);
        alert('Error occurred during the request');
      }
    });
  }
    
  function updateClockButtons(clockStatus) {
    if (clockStatus === 0) {
      $('#clockin').hide();
      $('#clockout').show();
      $('#clockin1').hide();
      $('#clockout1').show();  // Changed to show, as clockStatus is 0 (clocked out)
    } else if (clockStatus === 1) {
      $('#clockin').show();
      $('#clockout').hide();
      $('#clockin1').show();  // Changed to show, as clockStatus is 1 (clocked in)
      $('#clockout1').hide();
    }
  }
  
  
  function clocksOld1(id, value) {
  
    if (value == 'clockin') {
  
      clockStatusUpdate(id, value);
  
    }
  
    else if (value == 'clockout') {
  
      clockStatusUpdate(id, value);
  
    }
  
    window.location.reload();
  
  }
   
  function clockStatusUpdatesOld1(id, value) {
   
     $.ajax({
   
      url: "<?php echo e(url('admin/ClockStatusUpdate')); ?>",
  
      method: 'get',
  
      data: { id: id, value: value },
  
      success: function (response) {
  
        if (response && response.data && response.data.clock_status !== undefined) {
  
          const clockStatus = response.data.clock_status;
  
          if (clockStatus === 0) {
  
            $('#clockin').hide();
  
            $('#clockout').show();
  
            $('#clockin1').hide();
  
            $('#clockout1').hide();
  
          } else if (clockStatus === 1) {
  
            $('#clockin').show();
  
            $('#clockout').hide();
  
            $('#clockin1').hide();
  
            $('#clockout1').hide();
  
          }
  
        } else {
  
          alert('Invalid response format');
  
        }
  
      },
  
      error: function (xhr, status, error) {
  
        console.error('AJAX request failed:', status, error);
  
        alert('Error occurred during the request');
  
      }
   
    });
   
  }
   
   
  function updateDashboardClock() {
  
    var now = new Date();
  
    var hours = now.getHours();
  
    var minutes = now.getMinutes();
  
    var seconds = now.getSeconds();
  
    var amPm = hours < 12 ? 'AM' : 'PM';
  
    hours = hours % 12;
  
    hours = hours ? hours : 12; // The hour '0' should be '12' in 12-hour format
  
    var formattedTime = padZero(hours) + ':' + padZero(minutes) + ':' + padZero(seconds) + ' ' + amPm;
  
    $('#dashboard-clock').text(formattedTime);
  
  }
  
  function padZero(number) {
  
    return (number < 10 ? '0' : '') + number;
  
  }
  
  updateDashboardClock();
  
  setInterval(updateDashboardClock, 1000);

</script>

<!-- Password Expiry model show -->
<?php
    $passwordUpdateDate = App\Models\User::where('id', \Auth::user()->id)->first();
?>

<script>
    const passwordUpdateDate = new Date("<?php echo e($passwordUpdateDate->password_updateDate); ?>");
    const selectedDays = parseInt("<?php echo e($passwordUpdateDate->days); ?>", 10) || 0;

    function calculateDaysDifference(startDate, endDate) {
        const oneDay = 24 * 60 * 60 * 1000; // Hours * Minutes * Seconds * Milliseconds
        return Math.floor((endDate - startDate) / oneDay);
    }

    const currentDate = new Date();
    const daysSinceUpdate = calculateDaysDifference(passwordUpdateDate, currentDate);

    console.log(`Days since last update: ${daysSinceUpdate}`);
    console.log(`Selected days limit: ${selectedDays}`);

    // Get the current date as YYYY-MM-DD
    const today = currentDate.toISOString().split('T')[0];

    // Check if the modal has been shown today
    const lastShownDate = localStorage.getItem('passwordExpiredModalShownDate');

    if (daysSinceUpdate > selectedDays && lastShownDate !== today) {
        // Create modal HTML dynamically
        const modalHTML = `
            <div class="modal fade show" id="passwordExpiredModal" tabindex="-1" aria-labelledby="passwordExpiredModalLabel" aria-hidden="true" style="display: block;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="passwordExpiredModalLabel">Password Expiry</h5>
                            <button type="button" class="bootbox-close-button close btn-close" aria-label="Close" data-bs-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="bootbox-body">Your password has expired! : <?php echo e(\Auth::user()->first_name); ?></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary bootbox-accept" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Append the modal to the body
        document.body.insertAdjacentHTML('beforeend', modalHTML);

        // Optionally trigger Bootstrap modal behavior if you want to show it via JS
        const modal = new bootstrap.Modal(document.getElementById('passwordExpiredModal'));
        modal.show();

        // Close the modal when the user clicks the close button or OK
        const closeButton = document.querySelector('.bootbox-close-button');
        closeButton.addEventListener('click', function() {
            modal.hide();
        });

        const acceptButton = document.querySelector('.bootbox-accept');
        acceptButton.addEventListener('click', function() {
            modal.hide();
        });

        // Save the current date in localStorage as the last shown date
        localStorage.setItem('passwordExpiredModalShownDate', today);
    } else {
        console.log(`Your password is still valid. Days since update: ${daysSinceUpdate}`);
    }
</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/insighthub_db/resources/views/admin/dashboard/index.blade.php ENDPATH**/ ?>