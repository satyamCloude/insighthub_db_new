<div class="row g-4 mb-4 HRScreen">
      <div class="col-sm-6 col-xl-3">
         
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                     <div class="content-left">
                        <span>Leaves Approved</span>
                        <div class="d-flex align-items-center my-2">
                            
                           <h3 class="mb-0 me-2"></h3>
                           <!-- <p class="text-success mb-0">0</p> -->
                        </div>
                        <p class="mb-0"><?php echo e($Leaveapproved); ?></p>
                     </div>
                     <div class="">
                        <span class="">
                        <i class="fas fa-plane-departure mt-3"></i>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         
      </div>

          

      <div class="col-sm-6 col-xl-3">
         
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                     <div class="content-left">
                        <span>Resigned Employee</span>
                        <div class="d-flex align-items-center my-2">
                           <h3 class="mb-0 me-2"></h3>
                           <!-- <p class="text-success mb-0">0</p> -->
                        </div>
                        <p class="mb-0"><?php echo e($Suspended); ?></p>
                     </div>
                     <div class="">
                        <span class="">
                        <i class="fas fa-sign-out-alt mt-3"></i>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         
      </div> 


      <div class="col-sm-6 col-xl-3">
         
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                     <div class="content-left">
                        <span>Terminated Employee</span>
                        <div class="d-flex align-items-center my-2">
                           <h3 class="mb-0 me-2"></h3>
                           <!-- <p class="text-success mb-0">0</p> -->
                        </div>
                        <p class="mb-0"><?php echo e($Terminated); ?></p>
                     </div>
                     <div class="">
                        <span class="">
                        <i class="fas fa-wave-square mt-3"></i>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         
      </div> 


      <div class="col-sm-6 col-xl-3">
         
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                     <div class="content-left">
                        <span>Active Employees</span>
                        <div class="d-flex align-items-center my-2">
                           <h3 class="mb-0 me-2"></h3>
                           <!-- <p class="text-success mb-0">0</p> -->
                        </div>
                        <p class="mb-0"><?php echo e($Active); ?></p>
                     </div>
                     <div class="">
                        <span class="">
                        <i class="fas fa-fingerprint mt-3"></i>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         
      </div>
        <div class="col-sm-6 col-xl-6">
         
            <div class="card">
               <div class="card-body">
                  <div class="d-flex ">
                     <div class="content-left">
                        <strong>Employees</strong>
                        <div class="d-flex mt-2">
                        <a href="javascript:;" class="total-employees" data-status="open"><p class="mb-0 f-15 font-weight-bold text-blue d-grid mr-5">
                            <?php echo e($TOEMP); ?>

                            <span class="f-12 font-weight-normal text-lightest text-dark">
                                <p class="mb-0 text-dark">
                                    Total Employees
                                </p>
                            </span>
                        </a>
                        <a href="javascript:;" style="margin-left: 50px;" class="total-new-employees" data-status="resolved">
                            <p class="mb-0 f-15 font-weight-bold text-dark-green d-grid ml-3">
                            0
                            <span class="f-12 font-weight-normal text-lightest text-dark">
                            <p class="mb-0 text-dark">Total Attendance</p>
                            </span>
                        </a>
                    </div>
                     </div>
                  </div>
               </div>
            </div>
            
            
              <div class="card h-70 mt-3">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Weekly Leaves</h5>
            <small class="text-muted">Weekly Leaves Overview</small>
          </div>
        
        </div>
        
        <div class="card-body pb-0" style="position: relative;">
          <ul class="p-0 m-0">
            <li class="d-flex mb-3">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-primary">
                  <i class="ti ti-chart-pie-2 ti-sm"></i>
                </span>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">Total Leaves</h6>
                  <!--<small class="text-muted"><?php echo e($approveCount+$unapproveCount+$PendingCount); ?></small>-->
                </div>
                <div class="user-progress d-flex align-items-center gap-3">
                  <small><?php echo e($approveCount+$unapproveCount+$PendingCount); ?></small>
                  <!--<div class="d-flex align-items-center gap-1">-->
                  <!--  <i class="ti ti-chevron-up text-success"></i>-->
                  <!--  <small class="text-muted">18.6%</small>-->
                  <!--</div>-->
                </div>
              </div>
            </li>
         
          </ul>
         <div id="reportBarChart" ></div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 389px; height: 401px;"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
         
      </div>
      <div class="col-xl-6 col-12 mb-4">
                  
  
                      <div class="card">
                        <div class="card-header header-elements">
                          <h5 class="card-title mb-0">Current Month Employee pattern</h5>
                          <div class="card-action-element ms-auto py-0">
                            <div class="dropdown">
                       <form>
                          <!--<label for="filter">Filter by:</label>-->
                          <select name="filter" id="filter" class="form-control" onchange="Tab('HR','HR')">
                            <option value="">Filter by</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="last-7-days">Last 7 Days</option>
                            <option value="last-30-days">Last 30 Days</option>
                            <option value="current-month">Current Month</option>
                            <option value="last-month">Last Month</option>
                          </select>
                        </form>
                             
                              <!--<ul class="dropdown-menu dropdown-menu-end">-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <hr class="dropdown-divider">-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a>-->
                              <!--  </li>-->
                              <!--</ul>-->
                            </div>
                          </div>
                        </div>
                          <div class="card-body" style="position: relative;">
                             <div id="donutChart" style="min-height: 357.7px;">
                        </div>
                      </div>
                      </div>
        </div>
      <div class="col-sm-6 col-xl-6" style="height:380px">
         <div class="card bg-white border-0 b-shadow-4 table-height"  style="height:100%">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <strong >All Employee</strong>
                  <a href="https://crm1.cloudtechtiq.com/admin/Employee/home" type="button"
                  class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               </div>
              <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
                 <table class="table table-sm">
                     <thead>
                        <tr>
                           <th>Emp Id</th>
                           <th>Profile</th>
                           <th>Working Status</th>
                           <!-- <th>Status</th> -->
                        </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                         <?php $__currentLoopData = $AllEmployee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $AllEmployees): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($AllEmployees->id); ?></td>
                           <td>
                    <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($AllEmployees->profile_img) ? $AllEmployees->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" /><?php echo e($AllEmployees->first_name); ?> <?php echo e($AllEmployees->last_name); ?> | #<?php echo e($AllEmployees->id); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($AllEmployees->jobrole); ?></div>
                          </td>
                           <td><?php if($AllEmployees && $AllEmployees->status): ?>
                                    <?php switch($AllEmployees->status):
                                  case ('1'): ?>
                                    <span class="badge bg-label-success">Active</span>
                                      <?php break; ?>
                                  <?php case ('2'): ?>
                                    <span class="badge bg-label-warning">Resigned</span>
                                      <?php break; ?>
                                  <?php case ('3'): ?>
                                    <span class="badge bg-label-danger">Terminated</span>
                                      <?php break; ?>
                                  <?php default: ?>
                                        <span></span>
                                  <?php endswitch; ?>

                           <?php endif; ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                  </table>
            </div>
         </div>
      </div>
     <div class="col-sm-6 col-xl-6" style="height:380px">
         <div class="card bg-white border-0 b-shadow-4 table-height"  style="height:100%">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <strong >Department Wise Employee</strong>
                   <a href="https://crm1.cloudtechtiq.com/admin/Employee/home" type="button"
                  class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               </div>
              <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
                 <table class="table table-sm">
                     <thead>
                        <tr>
                           <th>Emp Id</th>
                           <th>Profile</th>
                           <th>Department</th>
                           <!-- <th>Status</th> -->
                        </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                        <?php $__currentLoopData = $HREmpDepartment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $HREmpDepartment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($HREmpDepartment->emp_id); ?></td>
                           <td>
                    <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($HREmpDepartment->profile_img) ? $HREmpDepartment->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" /><?php echo e($HREmpDepartment->first_name); ?> <?php echo e($HREmpDepartment->last_name); ?> | #<?php echo e($HREmpDepartment->emp_id); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($HREmpDepartment->jobrole); ?></div>
                          </td>
                           <td><?php if($HREmpDepartment && $HREmpDepartment->dptname): ?> <?php echo e($HREmpDepartment->dptname); ?> <?php endif; ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                  </table>
            </div>
         </div>
      </div>
     <div class="col-sm-6 col-xl-6" style="height:380px">
         <div class="card bg-white border-0 b-shadow-4 table-height"  style="height:100%">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <strong>Designation Wise Employee</strong>
                   <a href="https://crm1.cloudtechtiq.com/admin/Employee/home" type="button"
                  class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               </div>
              <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
                 <table class="table table-sm">
                     <thead>
                        <tr>
                           <th>Emp Id</th>
                           <th>Profile</th>
                           <th>Designation</th>
                           <!-- <th>Status</th> -->
                        </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                        <?php $__currentLoopData = $HREmpDesignation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $HREmpDesignation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($HREmpDesignation->emp_id); ?></td>
                           <td>
                    <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($HREmpDesignation->profile_img) ? $HREmpDesignation->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" /><?php echo e($HREmpDesignation->first_name); ?> <?php echo e($HREmpDesignation->last_name); ?> | #<?php echo e($HREmpDesignation->emp_id); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($HREmpDesignation->desname); ?></div>
                          </td>
                           <td><?php if($HREmpDesignation && $HREmpDesignation->desname): ?> <?php echo e($HREmpDesignation->desname); ?> <?php endif; ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                  </table>
            </div>
         </div>
      </div>
     <div class="col-sm-6 col-xl-6" style="height:380px">
         <div class="card bg-white border-0 b-shadow-4 table-height"  style="height:100%">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <strong >Late Attendance</strong>
                   <a href="https://crm1.cloudtechtiq.com/admin/Attendence/home" type="button"
                  class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               </div>
               <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
                 <table class="table table-sm">
                        <tr>
                           <th>Emp Id</th>
                           <th>Profile</th>
                           <th>Actual Working</th>
                           <th>Shift Hours</th>
                           <th>Total Hours</th>
                           <!-- <th>Status</th> -->
                        </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                        <?php $__currentLoopData = $HRLateattendence; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $HRLateattendence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($HRLateattendence->emp_id); ?></td>
                           <td>
                    <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($HRLateattendence->profile_img) ? $HRLateattendence->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" /><?php echo e($HRLateattendence->first_name); ?> <?php echo e($HRLateattendence->last_name); ?> | #<?php echo e($HRLateattendence->emp_id); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($HRLateattendence->desname); ?></div>
                          </td>
                           <td><?php if($HRLateattendence && $HRLateattendence->actualworkinghours): ?> <?php echo e($HRLateattendence->actualworkinghours); ?> <?php endif; ?></td>
                           <td><?php if($HRLateattendence && $HRLateattendence->shifthours): ?> <?php echo e($HRLateattendence->shifthours); ?> <?php endif; ?></td>
                           <td><?php if($HRLateattendence && $HRLateattendence->total_hours): ?> <?php echo e($HRLateattendence->total_hours); ?> <?php endif; ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                  </table>
               </div>
            </div>
      </div>
     <div class="col-sm-6 col-xl-6" style="height:380px">
    <div class="card bg-white border-0 b-shadow-4 table-height" style="height:100%">
        <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <strong>Performance            
            <i class="fas fa-question-circle ml-2" data-toggle="tooltip" data-placement="top" title="Performance is calculated on the basis of attendance, ticket, quotes, and invoice."></i>
            </strong>
            <span id="previous-month"></span>
            <a href="https://crm1.cloudtechtiq.com/admin/Performance/home" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
        </div>
        <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
            <?php
                // Determine the last month and the current year
                $currentYear = date('Y');
                $lastMonth = date('m', strtotime('first day of previous month'));

                // Set the start and end dates for the last month of the current year
                $startDate = date("$currentYear-$lastMonth-01");
                $endDate = date("Y-m-t", strtotime($startDate));

                // Get performance data and other related data from the database
                $Performance = DB::table('users')
                    ->select('users.id','users.first_name', 'departments.name as department_name')
                    ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
                    ->leftJoin('departments', 'departments.id', '=', 'employee_details.department_id')
                    ->where('users.type', 4)
                    ->whereNull('users.deleted_at')
                    ->get();

                $PerformanceCategory = DB::table('performance_categories')->get();
                $PerformanceRating = DB::table('performance_ratings')->get();
            ?>

            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                <thead>
                    <tr>
                        <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                        <th>ID</th>
                        <!--<th>Employee Name</th>-->
                        <th>Department</th>
                        <th>Ticket</th>
                        <th>Punctuality</th>
                        <th>Working hrs.</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody id="result">
                    <?php if($Performance->count() > 0): ?>
                        <?php $__currentLoopData = $Performance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                // Retrieve user details and other necessary information
                                $user_details = DB::table('users')->find($user->id);
                                $Reviewer = DB::table('users')->select('first_name')->where('id', $user->id)->first();
                            ?>
                            <tr class="odd">
                                <td><?php echo e($key + 1); ?></td>

                                <td><?php if($user && $user->first_name): ?> <?php echo e($user->first_name); ?> <?php endif; ?></td>

                                <td>
                                    <?php
                                        $assignedTickets = DB::table('tickets')
                                            ->where('ccid', $user->id)
                                            ->whereBetween('date', [$startDate, $endDate])
                                            ->count();

                                        $resolvedTickets = DB::table('tickets')
                                            ->where('ccid', $user->id)
                                            ->whereBetween('date', [$startDate, $endDate])
                                            ->where('status', '3')
                                            ->count();

                                        $resolvedRating1 = 0;

                                        if ($assignedTickets == 0) {
                                            $resolvedRating1 = '--';
                                        } else {
                                            $resolvedPercentage = ($resolvedTickets / $assignedTickets) * 100;

                                            if ($resolvedPercentage == 100) {
                                                $resolvedRating1 = 5;
                                            } elseif ($resolvedPercentage >= 75) {
                                                $resolvedRating1 = 4;
                                            } elseif ($resolvedPercentage >= 50) {
                                                $resolvedRating1 = 3;
                                            } elseif ($resolvedPercentage >= 25) {
                                                $resolvedRating1 = 2;
                                            } else {
                                                $resolvedRating1 = 1;
                                            }
                                        }
                                    ?>

                                    <?php if($resolvedRating1 === '--'): ?>
                                        <span>--</span>
                                    <?php else: ?>
                                        <?php for($i = 0; $i < $resolvedRating1; $i++): ?>
                                            <i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </td>

                                <?php
                                    $onTimeArrivals = DB::table('attendences')
                                        ->leftJoin('employee_details', 'attendences.emp_id', '=', 'employee_details.user_id')
                                        ->leftJoin('time_shifts', 'time_shifts.id', '=', 'employee_details.shift_id')
                                        ->leftJoin('users', 'users.id', '=', 'employee_details.user_id')
                                        ->where('users.type', 4)
                                        ->where('attendences.emp_id', $user->id)
                                        ->whereBetween('attendences.punch_date', [$startDate, $endDate])
                                        ->whereRaw('TIME(attendences.punch_in) <= TIME(time_shifts.StartTime)')
                                        ->count();

                                    $resolvedRating = '--';

                                    $totalWorkingDays = DB::table('attendences')
                                        ->where('emp_id', $user->id)
                                        ->whereBetween('punch_date', [$startDate, $endDate])
                                        ->distinct()
                                        ->count('punch_date');

                                    if ($totalWorkingDays > 0) {
                                        $resolvedPercentage = ($onTimeArrivals / $totalWorkingDays) * 100;

                                        if ($onTimeArrivals == 0) {
                                            $resolvedRating = '--';
                                        } elseif ($resolvedPercentage == 100) {
                                            $resolvedRating = 5;
                                        } elseif ($resolvedPercentage >= 75) {
                                            $resolvedRating = 4;
                                        } elseif ($resolvedPercentage >= 50) {
                                            $resolvedRating = 3;
                                        } elseif ($resolvedPercentage >= 25) {
                                            $resolvedRating = 2;
                                        } else {
                                            $resolvedRating = 1;
                                        }
                                    }
                                ?>

                                <td>
                                    <?php if($resolvedRating === '--'): ?>
                                        <span>--</span>
                                    <?php else: ?>
                                        <?php for($i = 0; $i < $resolvedRating; $i++): ?>
                                            <i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </td>

                                <?php
                                    $workingHoursData = DB::table('attendences as a')
                                        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
                                        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
                                        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
                                        ->where('us.type', 4)
                                        ->where('a.emp_id', $user->id)
                                        ->whereBetween('a.punch_date', [$startDate, $endDate])
                                        ->select(
                                            DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) as total_hours'),
                                            DB::raw('COUNT(DISTINCT a.punch_date) as working_days'),
                                            DB::raw('MIN(ts.working_hours) as shift_hours')
                                        )
                                        ->groupBy('a.emp_id')
                                        ->first();

                                    // Initialize default values
                                    $resolvedRating = 0; // Default rating value

                                    // Check if workingHoursData is not null and has valid working days
                                    if ($workingHoursData && $workingHoursData->working_days > 0) {
                                        // Ensure numeric values are used in calculations
                                        $totalHours = isset($workingHoursData->total_hours) ? (float)$workingHoursData->total_hours : 0;
                                        $workingDays = isset($workingHoursData->working_days) ? (int)$workingHoursData->working_days : 1;
                                        $shiftHours = isset($workingHoursData->shift_hours) ? (float)$workingHoursData->shift_hours : 1;

                                        // Calculate average hours per day
                                        $averageHoursPerDay = $totalHours / $workingDays;

                                        // Determine the rating based on average hours per day compared to shift hours
                                        if ($shiftHours > 0) {
                                            if ($averageHoursPerDay >= $shiftHours) {
                                                $resolvedRating = 5;
                                            } elseif ($averageHoursPerDay >= 7 * $shiftHours) {
                                                $resolvedRating = 4;
                                            } elseif ($averageHoursPerDay >= 4 * $shiftHours) {
                                                $resolvedRating = 3;
                                            } elseif ($averageHoursPerDay >= 3 * $shiftHours) {
                                                $resolvedRating = 2;
                                            } else {
                                                $resolvedRating = 0;
                                            }
                                        }
                                    }
                                ?>

                                <td>
                                    <?php if($resolvedRating === '--'): ?>
                                        <span>--</span>
                                    <?php else: ?>
                                        <?php for($i = 0; $i < $resolvedRating; $i++): ?>
                                            <i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </td>

                                <?php
                                    $attendanceDays = DB::table('attendences')
                                        ->where('emp_id', $user->id)
                                        ->whereBetween('punch_date', [$startDate, $endDate])
                                        ->distinct('punch_date')
                                        ->count();
                                    if ($attendanceDays >= 2 && $attendanceDays <= 10) {
                                        $resolvedRating = 1;
                                    } elseif ($attendanceDays >= 10 && $attendanceDays <= 20) {
                                        $resolvedRating = 2;
                                    } elseif ($attendanceDays >= 20 && $attendanceDays <= 30) {
                                        $resolvedRating = 3;
                                    } elseif ($attendanceDays >= 30 && $attendanceDays <= 40) {
                                        $resolvedRating = 4;
                                    } elseif ($attendanceDays == date('t')) {
                                        $resolvedRating = 5;
                                    } else {
                                        $resolvedRating = '--';
                                    }
                                ?>

                                <td>
                                    <?php if($resolvedRating === '--'): ?>
                                        <span>--</span>
                                    <?php else: ?>
                                        <?php for($i = 0; $i < $resolvedRating; $i++): ?>
                                            <i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td class="text-center" colspan="7">No Data Found</td>
                        </tr>
                    <?php endif; ?>             
                </tbody>
            </table>
        </div>
    </div>
</div>

    <div class="col-sm-6 col-xl-6" style="height:380px">
         <div class="card bg-white border-0 b-shadow-4 table-height"  style="height:100%">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <strong >Role Wise Employee</strong>
                    <a href="https://crm1.cloudtechtiq.com/admin/Employee/home" type="button"
                  class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               </div>
              <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
                 <table class="table table-sm">
                     <thead>
                        <tr>
                           <th>Emp Id</th>
                           <th>Profile</th>
                           <th>Role</th>
                           <!-- <th>Status</th> -->
                        </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                        <?php $__currentLoopData = $HREmpRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $HREmpRole): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($HREmpRole->emp_id); ?></td>
                           <td>
                            <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($HREmpRole->profile_img) ? $HREmpRole->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" /><?php echo e($HREmpRole->first_name); ?> <?php echo e($HREmpRole->last_name); ?> (#<?php echo e($HREmpRole->emp_id); ?>)<div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($HREmpRole->desname); ?></div>
                           </td>
                           <td><?php if($HREmpRole && $HREmpRole->rolename): ?> <?php echo e($HREmpRole->rolename); ?> <?php endif; ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                  </table>
              </div>
            </div>
      </div>
      <div class="col-sm-6 col-xl-6" style="height:380px">
         <div class="card bg-white border-0 b-shadow-4 table-height"  style="height:100%">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <strong >Leaves Taken</strong>
                    <a href="https://crm1.cloudtechtiq.com/admin/Leave/home" type="button"
                  class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               </div>
              <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
                 <table class="table table-sm">
                     <thead>
                        <tr>
                           <th>Emp Id</th>
                           <th>Profile</th>
                           <th>Leave Date</th>
                           <th>Duration</th>
                           <!-- <th>Status</th> -->
                        </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                        <?php if(count($HREmpLeave) > 0): ?>
                            <?php $__currentLoopData = $HREmpLeave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $HREmpLeave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                               <td><?php echo e($HREmpLeave->emp_id); ?></td>
                               <td>
                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($HREmpLeave->profile_img) ? $HREmpLeave->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" /><?php echo e($HREmpLeave->first_name); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($HREmpLeave->email); ?></div>
                              </td>
                               <td><?php if($HREmpLeave && $HREmpLeave->date): ?> <?php echo e($HREmpLeave->date); ?> <?php endif; ?></td>
                               <td>
                                   <?php if($HREmpLeave->duration == 1): ?>
                                       <?php echo e('Full Day'); ?>

                                   <?php elseif($HREmpLeave->duration == 2): ?>
                                       <?php echo e('Multiple'); ?>

                                   <?php elseif($HREmpLeave->duration == 3): ?>
                                       <?php echo e('First Half'); ?>

                                   <?php elseif($HREmpLeave->duration == 4): ?>
                                       <?php echo e('Second Half'); ?>

                                   <?php endif; ?>
                               </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center">No Record Found</td></tr>
                        <?php endif; ?>
                     </tbody>
                  </table>
            </div>
         </div>
      </div>
      <!--<div class="col-sm-6 col-xl-6">-->
      <!--     <div class="card bg-white border-0 b-shadow-4" style="height: 384px;">-->
      <!--         <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">-->
      <!--            <h4 class="f-18 f-w-500 mb-0">Events</h4>-->
      <!--         </div>-->
      <!--        <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">-->
      <!--           <table class="table table-sm">-->
      <!--               <thead>-->
      <!--                  <tr>-->
      <!--                     <th>Emp Id</th>-->
      <!--                     <th>Profile</th>-->
      <!--                     <th>Birthday</th>-->
                           <!-- <th>Status</th> -->
      <!--                  </tr>-->
      <!--               </thead>-->
      <!--               <tbody class="table-border-bottom-0">-->
      <!--                  <?php $__currentLoopData = $HREmpEvent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $HREmpEvent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
      <!--                  <tr>-->
      <!--                     <td><?php echo e($HREmpEvent->emp_id); ?></td>-->
      <!--                     <td>-->
      <!--              <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($HREmpEvent->profile_img) ? $HREmpEvent->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" /> <?php echo e($HREmpEvent->first_name); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($HREmpEvent->email); ?></div>-->
      <!--                    </td>-->
      <!--                     <td><?php if($HREmpEvent && $HREmpEvent->dob): ?> <?php echo e($HREmpEvent->dob); ?> <?php endif; ?></td>-->
      <!--                  </tr>-->
      <!--                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
      <!--               </tbody>-->
      <!--            </table>-->
      <!--  </div>-->
      <!--      </div>-->
      <!--</div>-->
      
      
    <!--    <div class="col-xl-6 col-md-12 mb-4">-->
    <!--  <div class="card h-100">-->
    <!--    <div class="card-header d-flex justify-content-between">-->
    <!--      <div class="card-title mb-0">-->
    <!--        <h5 class="m-0 me-2">Weekly Leaves</h5>-->
    <!--        <small class="text-muted">Weekly Leaves Overview</small>-->
    <!--      </div>-->
        
    <!--    </div>-->
        
    <!--    <div class="card-body pb-0" style="position: relative;">-->
    <!--      <ul class="p-0 m-0">-->
    <!--        <li class="d-flex mb-3">-->
    <!--          <div class="avatar flex-shrink-0 me-3">-->
    <!--            <span class="avatar-initial rounded bg-label-primary">-->
    <!--              <i class="ti ti-chart-pie-2 ti-sm"></i>-->
    <!--            </span>-->
    <!--          </div>-->
    <!--          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">-->
    <!--            <div class="me-2">-->
    <!--              <h6 class="mb-0">Total Leaves</h6>-->
                  <!--<small class="text-muted"><?php echo e($approveCount+$unapproveCount+$PendingCount); ?></small>-->
    <!--            </div>-->
    <!--            <div class="user-progress d-flex align-items-center gap-3">-->
    <!--              <small><?php echo e($approveCount+$unapproveCount+$PendingCount); ?></small>-->
                  <!--<div class="d-flex align-items-center gap-1">-->
                  <!--  <i class="ti ti-chevron-up text-success"></i>-->
                  <!--  <small class="text-muted">18.6%</small>-->
                  <!--</div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </li>-->
         
    <!--      </ul>-->
    <!--     <div id="reportBarChart" style="margin-top:119px;"></div>-->
    <!--      <div class="resize-triggers">-->
    <!--        <div class="expand-trigger">-->
    <!--          <div style="width: 389px; height: 401px;"></div>-->
    <!--        </div>-->
    <!--        <div class="contract-trigger"></div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
</div>
<?php
// Calculate the count of each employee status
$totalEmployees = $AllEmployee->count();
$activeEmployeesCount = $AllEmployee->where('status', 1)->count();
$resignedEmployeesCount = $AllEmployee->where('status', 2)->count();
$terminatedEmployeesCount = $AllEmployee->where('status', 3)->count();

// Calculate the percentage of each category
$activeEmployeesPercentage = ($activeEmployeesCount / $totalEmployees) * 100;
$resignedEmployeesPercentage = ($resignedEmployeesCount / $totalEmployees) * 100;
$terminatedEmployeesPercentage = ($terminatedEmployeesCount / $totalEmployees) * 100;

// Prepare the data for the chart
$leaveTypePercentages = [$activeEmployeesPercentage, $resignedEmployeesPercentage, $terminatedEmployeesPercentage];
$leaveTypeLabels = ['Active Employees', 'Resigned Employees', 'Terminated Employees'];
?>
  <!-- Include Bootstrap and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
  
        $(document).ready(function() {
            // Create a Date object for the current date
            var date = new Date();
            // Set the date to the first day of the current month
            date.setDate(1);
            // Move to the previous month
            date.setMonth(date.getMonth() - 1);
            // Get the previous month name
            var options = { month: 'long' };
            var previousMonthName = date.toLocaleDateString('en-US', options);
            // Insert the previous month name into the div
            $('#previous-month').text(previousMonthName);
        });

      $(document).ready(function () {

   let cardColor, headingColor, labelColor, borderColor, legendColor;

 
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  

  var chartColors = {
  column: {
    series1: '#826af9',
    series2: '#d2b0ff',
    bg: '#f8d3ff'
  },
  donut: {
    series1: '#fee802',
    series2: '#3fd0bd',
    series3: '#826bf8',
    series4: '#2b9bf4',
    series5: '#ff8c00' // New color for series5
  },
  area: {
    series1: '#29dac7',
    series2: '#60f2ca',
    series3: '#a5f8cd'
  }
};


const allLeaves = <?php echo json_encode($allLeaves); ?>;

// Initialize leave counts for each weekday
const leaveCounts = {
    'Mon': 0,
    'Tue': 0,
    'Wed': 0,
    'Thu': 0, // Corrected from 'Thurs' to 'Thu' to match weekday abbreviation
    'Fri': 0,
    'Sat': 0,
    'Sun': 0
};

// Get the current day of the week
const today = new Date().toLocaleDateString('en-US', { weekday: 'short' }); // Use 'short' for 'Mon', 'Tue', etc.

  

allLeaves.forEach(leave => {
    // Get the start and end dates of the leave
    const startDate = new Date(leave.start_date);
    const endDate = new Date(leave.end_date);

    // If start and end dates are the same, increment count for that day
    if (startDate.getTime() === endDate.getTime()) {
        const dayOfWeek = startDate.toLocaleDateString('en-US', { weekday: 'short' });
        leaveCounts[dayOfWeek]++;
    } else {
        // Loop through each day between the start and end dates
        for (let currentDate = new Date(startDate); currentDate <= endDate; currentDate.setDate(currentDate.getDate() + 1)) {
            // Get the day of the week for the current date
            const dayOfWeek = currentDate.toLocaleDateString('en-US', { weekday: 'short' });

            // Increment the count for the corresponding weekday
            leaveCounts[dayOfWeek]++;
        }
    }
});

// Extract the leave counts and populate the series data for the chart
const leaveCountsData = Object.values(leaveCounts);

// Define the ApexCharts configuration
const reportBarChartConfig = {
    chart: {
        height: 200,
        type: 'bar',
        toolbar: {
            show: false
        }
    },
    plotOptions: {
        bar: {
            barHeight: '60%',
            columnWidth: '60%',
            startingShape: 'rounded',
            endingShape: 'rounded',
            borderRadius: 4,
            distributed: true
        }
    },
    grid: {
        show: false,
        padding: {
            top: -20,
            bottom: 0,
            left: -10,
            right: -10
        }
    },
    colors: [
        today === 'Mon' ? config.colors.primary : config.colors_label.primary,
        today === 'Tue' ? config.colors.primary : config.colors_label.primary,
        today === 'Wed' ? config.colors.primary : config.colors_label.primary,
        today === 'Thu' ? config.colors.primary : config.colors_label.primary, // Corrected from 'Thurs' to 'Thu'
        today === 'Fri' ? config.colors.primary : config.colors_label.primary,
        today === 'Sat' ? config.colors.primary : config.colors_label.primary,
        today === 'Sun' ? config.colors.primary : config.colors_label.primary
    ],
    dataLabels: {
        enabled: false
    },
    series: [
        {
            name: 'No. of Leaves',
            data: leaveCountsData
        }
    ],
    legend: {
        show: false
    },
    xaxis: {
        categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'], // Corrected from 'Thurs' to 'Thu'
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        labels: {
            style: {
                colors: labelColor,
                fontSize: '13px'
            }
        }
    },
    yaxis: {
        labels: {
            show: false
        }
    }
};

// Render the chart
const reportBarChartEl = document.querySelector('#reportBarChart');
if (reportBarChartEl) {
    const barChart = new ApexCharts(reportBarChartEl, reportBarChartConfig);
    barChart.render();
}






  // Donut Chart
  // --------------------------------------------------------------------
const leaveTypePercentages = <?php echo json_encode($leaveTypePercentages); ?>;
const leaveTypeLabels = <?php echo json_encode($leaveTypeLabels); ?>;
const totalPercentage = <?php echo e($totalPercentage); ?> || 0;

const donutChartEl = document.querySelector('#donutChart'),
  donutChartConfig = {
    chart: {
      height: 390,
      type: 'donut'
    },
    labels: leaveTypeLabels,
    series: leaveTypePercentages,
      colors: [
    chartColors.donut.series1,
    chartColors.donut.series5, // Include the new color for series5
    chartColors.donut.series4,
    chartColors.donut.series3,
    chartColors.donut.series2
  ],
      stroke: {
        show: false,
        curve: 'straight'
      },
      dataLabels: {
        enabled: true,
        formatter: function (val, opt) {
          return parseFloat(val, 10).toFixed(2).replace(/\.?0*$/, '') + '%';
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        markers: { offsetX: -3 },
        itemMargin: {
          vertical: 3,
          horizontal: 10
        },
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              name: {
                fontSize: '2rem',
                fontFamily: 'Public Sans'
              },
            value: {
    fontSize: '1.2rem',
    color: legendColor,
    fontFamily: 'Public Sans',
   formatter: function (val, opt) {
    return parseFloat(val).toFixed(2) + '%';
}

},
total: {
    show: true,
    fontSize: '1.5rem',
    color: headingColor,
    label: 'Total Joined',
    formatter: function (w) {
        return parseInt(totalPercentage).toFixed(2).replace(/\.?0*$/, '') + '%';
    }
}

            }
          }
        }
      },
      responsive: [
        {
          breakpoint: 992,
          options: {
            chart: {
              height: 380
            },
            legend: {
              position: 'bottom',
              labels: {
                colors: legendColor,
                useSeriesColors: false
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            chart: {
              height: 320
            },
            plotOptions: {
              pie: {
                donut: {
                  labels: {
                    show: true,
                    name: {
                      fontSize: '1.5rem'
                    },
                    value: {
                      fontSize: '1rem'
                    },
                    total: {
                      fontSize: '1.5rem'
                    }
                  }
                }
              }
            },
            legend: {
              position: 'bottom',
              labels: {
                colors: legendColor,
                useSeriesColors: false
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            chart: {
              height: 280
            },
            legend: {
              show: false
            }
          }
        },
        {
          breakpoint: 360,
          options: {
            chart: {
              height: 250
            },
            legend: {
              show: false
            }
          }
        }
      ]
    };
 if (typeof donutChartEl !== undefined && donutChartEl !== null) {
  const donutChart = new ApexCharts(donutChartEl, donutChartConfig);
  donutChart.render();
}
    });

</script>
    <?php /**PATH /home/insighthub/public_html/resources/views/admin/dashboard/HR.blade.php ENDPATH**/ ?>