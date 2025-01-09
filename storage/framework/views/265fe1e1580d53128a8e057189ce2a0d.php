<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<style>
  .blurred {
    filter: blur(2px); /* Adjust the blur intensity as needed */
    pointer-events: none; /* Disable interactions with the button */
    opacity: 0.5; /* Optional: adjust opacity to visually indicate disabled state */
}


    /* Loader styles */
    #loader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .spinner {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
    <link rel="stylesheet" href="https://crm1.cloudtechtiq.com/public/assets/vendor/libs/apex-charts/apex-charts.css" />

<div class="container-xxl flex-grow-1 container-p-y">

   <div class="row">
      <!-- View sales -->
      <div class="col-xl-8 mb-4 col-lg-9 col-12"></div>
      <div class="col-xl-4 mb-4 col-lg-3 col-md-3 col-12">
        <!-- CLOCK IN CLOCK OUT START -->
      <div class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 mt-4 mt-lg-0 mt-md-0 justify-content-end" style="justify-content: flex-end !important;">
        <p class="mb-0 text-lg-right text-md-right f-15 font-weight-bold text-dark-grey d-grid align-items-center text-end" style="padding-right:10px;">
          <input type="hidden" id="current-latitude" name="current_latitude" autocomplete="off">
          <input type="hidden" id="current-longitude" name="current_longitude" autocomplete="off">
          <span class="f-10 font-weight-light"><?php echo e(\Carbon\Carbon::now()->format('l')); ?></span>
   <span id="dashboard-clock"><?php echo e(\Carbon\Carbon::now()->format('h:i A')); ?></span>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            const formattedHours = hours % 12 || 12;
            const formattedTime = `${formattedHours}:${minutes} ${ampm}`;
            document.getElementById('dashboard-clock').textContent = formattedTime;
        }

        // Update the clock immediately
        updateClock();

        // Update the clock every 5 seconds
        setInterval(updateClock, 5000);
    </script>   
    
    <span class="f-11 font-weight-normal text-lightest" style="color:#b4b2bb !important;">
            Clock In at -
            <span><?php if($CheckInTime && $CheckInTime->punch_in): ?> <?php echo e(\Carbon\Carbon::parse($CheckInTime->punch_in)->format('h:i A')); ?><?php else: ?> 00:00:00  <?php endif; ?></span>
          </span>
        </p>
       <button type="button" class="btn-danger rounded f-15 ml-4" id="clockout" value="clockout" onclick="clock(<?php echo e(auth()->id()); ?>, 'clockout')" 
                style="background-color: #7f7c8b; border: 0; color: #fff; padding: 9px 11px 20px; position: relative; text-transform: capitalize; padding-top: 20px; <?php if(Auth::user()->clock_status != 1): ?> display: none; <?php endif; ?>">
            <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>
        </button>
        
        <button type="button" class="btn-primary rounded f-15 ml-4" id="clockin" value="clockin" onclick="clock(<?php echo e(auth()->id()); ?>, 'clockin')" 
                style="background-color: #7f7c8b; border: 0; color: #fff; padding: 9px 11px 20px; position: relative; text-transform: capitalize; padding-top: 20px; <?php if(Auth::user()->clock_status == 1): ?> display: none; <?php endif; ?>">
            <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>
        </button>
      </div>
      <!-- CLOCK IN CLOCK OUT END -->

      </div>
      <!-- View sales -->
       
    
      <div class="col-xl-8 mb-4 col-lg-6 col-12">
       
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

                    <div class="col-6">

                      <ul class="list-unstyled mb-0">

                        <li class="d-flex mb-4 align-items-center">

                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="open_task"

                          style="min-width: 72px;"><?php echo e($OpenTask); ?></p>

                          <p class="mb-0">Open Tasks</p>

                        </li>

                        <li class="d-flex align-items-center mb-2">

                           <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="open_task"

                          style="min-width: 72px;"><?php echo e($currentMonthEmpPrice); ?></p>

                          <p class="mb-0">Total Sales</p>

                        </li>

                      </ul>

                    </div>

                    <div class="col-6">

                      <ul class="list-unstyled mb-0">

                        <li class="d-flex mb-4 align-items-center">

                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="open_task"

                          style="min-width: 72px;"><?php echo e($OpenTicket); ?></p>

                          <p class="mb-0">Open Tickets</p>

                        </li>

                        <li class="d-flex mb-4 align-items-center">

                             <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="open_task"

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

                  <div class="col-6">

                    <ul class="list-unstyled mb-0">

                      <li class="d-flex mb-4 align-items-center">

                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="grand-total-time"

                          style="min-width: 72px;">0</p>

                        <p class="mb-0">Total Duration</p>

                      </li>

                      <li class="d-flex align-items-center mb-2">

                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="BreakTime"

                          style="min-width: 72px;"><?php echo e($totalBreakTime); ?></p>

                        <p class="mb-0">Total Interval</p>

                      </li>

                    </ul>

                  </div>

                  <div class="col-6">

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
      
  <!-- View sales -->

  <!-- Statistics -->
  <div class="col-xl-4 mb-4 col-lg-7 col-12">

                  <div class="card h-100">
                    <div class="card-header">
                      <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Statistics</h5>
                        <!-- <small class="text-muted">Updated 1 month ago</small> -->
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row gy-3">
                        <div class="col-md-6 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                              <i class="ti ti-chart-pie-2 ti-sm"></i>
                            </div>
                            <?php
                                  if ($StaSales >= 10000000) {
                                      $formattedStaSales = round($StaSales / 10000000, 2) . 'C';
                                  } elseif ($StaSales >= 100000) {
                                      $formattedStaSales = round($StaSales / 100000, 2) . 'L';
                                  } elseif ($StaSales >= 1000) {
                                      $formattedStaSales = round($StaSales / 1000, 2) . 'k';
                                  } else {
                                      $formattedStaSales = $StaSales;
                                  }
                           ?>
                            <div class="card-info">
                              <h5 class="mb-0"><?php echo e($totalSalesCurrentMonthPrice); ?></h5>
                              <small>Total amount of sales</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                              <i class="ti ti-users ti-sm"></i>
                            </div>
                             <?php
                                  if ($StaCustomer >= 10000000) {
                                      $formattedStaCustomer = round($StaCustomer / 10000000, 2) . 'C';
                                  } elseif ($StaCustomer >= 100000) {
                                      $formattedStaCustomer = round($StaCustomer / 100000, 2) . 'L';
                                  } elseif ($StaCustomer >= 1000) {
                                      $formattedStaCustomer = round($StaCustomer / 1000, 2) . 'k';
                                  } else {
                                      $formattedStaCustomer = $StaCustomer;
                                  }
                           ?>
                            <div class="card-info">
                              <h5 class="mb-0"><?php echo e($TClient); ?></h5>
                              <small>Customers  </small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                              <i class="ti ti-shopping-cart ti-sm"></i>
                            </div>
                            <?php
                                  if ($StaProducts >= 10000000) {
                                      $formattedStaProducts = round($StaProducts / 10000000, 2) . 'C';
                                  } elseif ($StaProducts >= 100000) {
                                      $formattedStaProducts = round($StaProducts / 100000, 2) . 'L';
                                  } elseif ($StaProducts >= 1000) {
                                      $formattedStaProducts = round($StaProducts / 1000, 2) . 'k';
                                  } else {
                                      $formattedStaProducts = $StaProducts;
                                  }
                           ?>
                            <div class="card-info">
                              <h5 class="mb-0"><?php echo e($totalSaledProducts); ?></h5>
                              <small>Products</small>
                            </div>
                          </div>
                        </div>
                         <div class="col-md-6 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                              <i class="ti ti-currency-dollar ti-sm"></i>
                            </div>
                             <?php
                                  if ($StaRevenue >= 10000000) {
                                      $formattedStaRevenue = round($StaRevenue / 10000000, 2) . 'C';
                                  } elseif ($StaRevenue >= 100000) {
                                      $formattedStaRevenue = round($StaRevenue / 100000, 2) . 'L';
                                  } elseif ($StaRevenue >= 1000) {
                                      $formattedStaRevenue = round($StaRevenue / 1000, 2) . 'k';
                                  } else {
                                      $formattedStaRevenue = $StaRevenue;
                                  }
                           ?>
                            <div class="card-info">
                              <h5 class="mb-0"><?php echo e($totalOpenTickets); ?></h5>
                              <small>Open Tickets</small>
                            </div>
                          </div>
                        </div>
                      
                        <!--    <div class="card-info">-->
                        <!--      <h5 class="mb-0"><?php echo e($paidOrders); ?></h5>-->
                        <!--      <small>Total paid orders</small>-->
                        
                      </div>
                    </div>
                  </div>
  </div>
  <!--/ Statistics -->

 
     
  <div class="col-xl-6 mb-4 col-md-6">
           <div class="card h-100" >
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title m-0 me-2">
                        <h5 class="m-0 me-2">Upcoming Followups</h5>
                        <small class="text-muted"><?php echo e(now()); ?></small>
                        <form class="mb-4" style="width: 34%;">
                          <div class="d-flex gap-2">
                            <input type="date" name="from_date" class="form-control" value="<?php echo e(request('from_date')); ?>" />
                            <input type="date" name="to_date" class="form-control" value="<?php echo e(request('to_date')); ?>" />
                            <button type="submit" class="btn btn-primary">Filter</button>
                          </div>
                        </form>
                      </div>
                    
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                          <?php if($UpcommingFollowups and count($UpcommingFollowups)): ?>
                        <?php $__currentLoopData = $UpcommingFollowups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="d-flex mb-4 pb-1">
                          <div class="me-3">
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Lead Id : (#<?php echo e($Product->leads_id); ?>)</h6>
                               <small class="text-muted d-block"><?php echo e($Product->id); ?></small> 
                            </div>
                           
                            <div class="user-progress d-flex align-items-center gap-1">
                            <p class="mb-0 fw-medium">Note :<?php echo e(substr($Product->remark, 0, 15)); ?></p>
                            </div>
                          </div>
                        </li>
                        <hr/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php else: ?>
                        <tr>
                            <td class="text-center" colspan="7">No Data Found</td>
                        </tr>
                    <?php endif; ?> 
                      </ul>
                    </div>
                  </div>
            </div>
     <!--<div class="col-xl-6 col-md-6 mb-4"  style="height:500px">-->
     <!--            <div class="card" style="height:100%;overflow: scroll;"> -->
     <!--       <div class="card-header d-flex justify-content-between">-->
     <!--          <div class="card-title mb-0">-->
     <!--             <h5 class="m-0 me-2">Team Leads</h5>-->
     <!--          </div>-->
     <!--       </div>-->
     <!--       <div class="card-body pb-0" style="position: relative;">-->
     <!--          <?php $__currentLoopData = $teamLeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
     <!--          <ul class="p-0 m-0">-->
     <!--             <li class="d-flex mb-3">-->
     <!--                <div class="avatar">-->
     <!--                   <span class="rounded">-->
     <!--                   <?php if($user && $user->profile_img): ?>-->
     <!--                   <img src="<?php echo e($user ? $user->profile_img : ''); ?>" class="rounded-circle">-->
     <!--                   <?php else: ?>-->
     <!--                   <span class="avatar-initial rounded"></span>-->
     <!--                   <?php endif; ?>-->
     <!--                   </span>-->
     <!--                </div>-->
     <!--                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2" style="margin-left: 20px;">-->
     <!--                   <div class="me-2">-->
     <!--                      <h6 class="mb-0"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?> (#<?php echo e($user->id); ?>)</h6>-->
     <!--                      <small class="text-muted"><b>Department </b>: <?php echo e($user->name); ?></small><br>-->
     <!--                      <small class="text-muted"><b>Role </b>: <?php echo e($user->jobrole); ?></small>-->
     <!--                   </div>-->
     <!--                </div>-->
     <!--             </li>-->
     <!--          </ul>-->
     <!--          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
     <!--          <div class="resize-triggers">-->
     <!--             <div class="expand-trigger">-->
     <!--                <div style="width: 332px; height: 478px;"></div>-->
     <!--             </div>-->
     <!--             <div class="contract-trigger"></div>-->
     <!--          </div>-->
     <!--       </div>-->
     <!--    </div>-->
     <!-- </div>-->
      
      
   <div class="col-xl-6 col-md-6 mb-4"  style="height:500px">
              <div class="card bg-white border-0 b-shadow-4 table-height" style="height:100%">
        <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <strong>My Performance</strong>
            <!--<a href="https://crm1.cloudtechtiq.com/Employee/Performance/home" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>-->
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
                $Performance2 = DB::table('users')
                    ->select('users.id','users.first_name', 'departments.name as department_name')
                    ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
                    ->leftJoin('departments', 'departments.id', '=', 'employee_details.department_id')
                    ->where('users.id',Auth::user()->id)
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
                    <?php if($Performance2->count() > 0): ?>
                        <?php $__currentLoopData = $Performance2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
<div class="col-xl-6 col-md-12 mb-4" style="300px">
         <div class="card h-100" style="100%">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title mb-0">
                <h5 class="m-0 me-2">Leave Status</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Leave Type</th>
                            <th>Allowed</th>
                            <th>Taken</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $leaveStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($status['type']); ?></td>
                            <td><?php echo e($status['allowed']); ?></td>
                            <td><?php echo e($status['taken']); ?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar <?php echo e($status['colorClass']); ?>" role="progressbar"
                                        style="width: <?php echo e($status['percentage']); ?>%;" aria-valuenow="<?php echo e($status['percentage']); ?>"
                                        aria-valuemin="0" aria-valuemax="100"><?php echo e($status['percentage']); ?>%</div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 <div class="col-xl-6 mb-4 col-md-6">
           <div class="card h-100" >
          <div class="card-header d-flex justify-content-between">
              <div class="card-title mb-0">
                  <h5 class="m-0 me-2">Performance</h5>
              </div>
          </div>
          <div class="card-body">
              <div class="row py-4">
                  <?php
                  $employeePerformanceData = [];
                      $averageRatings = [];
                      $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
                      $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
                      $startDate = date("$year-$month-01");
                      $endDate = date("$year-$month-t", strtotime($startDate));

                              $startDateLastYear = date('$year-$month-d', strtotime('-1 year'));
              ?>
              <?php $__currentLoopData = $Performance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                      $jobrole = App\Models\Jobroles::find($user->jobrole_id);
                      $assignedTickets = DB::table('tickets')
                          ->where('ccid', $user->id)
                          ->count();

                      $resolvedTickets = DB::table('tickets')
                          ->where('ccid', $user->id)
                          ->where('status', '3')
                          ->count();

                      $ticketRating = 10;
                      if ($assignedTickets > 0) {
                          $resolvedPercentage = ($resolvedTickets / $assignedTickets) * 100;
                          if ($resolvedPercentage == 100) {
                              $ticketRating = 100;
                          } elseif ($resolvedPercentage >= 75) {
                              $ticketRating = 75;
                          } elseif ($resolvedPercentage >= 50) {
                              $ticketRating = 50;
                          } elseif ($resolvedPercentage >= 25) {
                              $ticketRating = 30;
                          } else {
                              $ticketRating = 10;
                          }
                      }

                      $onTimeArrivals = DB::table('attendences')
                          ->leftJoin('employee_details', 'attendences.emp_id', '=', 'employee_details.user_id')
                          ->leftJoin('time_shifts', 'time_shifts.id', '=', 'employee_details.shift_id')
                          ->leftJoin('users', 'users.id', '=', 'employee_details.user_id')
                          ->where('users.type', 4)
                          ->where('attendences.emp_Id', $user->id)
                          ->whereBetween('attendences.punch_date', [$startDate, $endDate])
                          ->whereRaw('TIME(attendences.punch_in) <= TIME(time_shifts.StartTime)')
                          ->count();

                      $punctualityRating = 10;
                      $totalWorkingDays = DB::table('attendences')
                          ->where('emp_id', $user->id)
                          ->whereBetween('punch_date', [$startDate, $endDate])
                          ->distinct()
                          ->count('punch_date');

                      if ($totalWorkingDays > 0) {
                          $resolvedPercentage = ($onTimeArrivals / $totalWorkingDays) * 100;
                          if ($resolvedPercentage == 100) {
                              $punctualityRating = 100;
                          } elseif ($resolvedPercentage >= 75) {
                              $punctualityRating = 75;
                          } elseif ($resolvedPercentage >= 50) {
                              $punctualityRating = 50;
                          } elseif ($resolvedPercentage >= 25) {
                              $punctualityRating = 30;
                          } else {
                              $punctualityRating = 10;
                          }
                      }

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

              $workingHoursRating = 10;
              $averageHoursPerDay = 0;
              if ($workingHoursData && $workingHoursData->working_days > 0) {
                  $totalHours = floatval($workingHoursData->total_hours);
                  $workingDays = intval($workingHoursData->working_days);
                  $shiftHours = floatval($workingHoursData->shift_hours);

                  if ($workingDays > 0) {
                      $averageHoursPerDay = $totalHours / $workingDays;

                      if ($shiftHours > 0) {
                          if ($averageHoursPerDay >= $shiftHours) {
                              $workingHoursRating = 100;
                          } elseif ($averageHoursPerDay >= 0.75 * $shiftHours) {
                              $workingHoursRating = 75;
                          } elseif ($averageHoursPerDay >= 0.5 * $shiftHours) {
                              $workingHoursRating = 50;
                          } elseif ($averageHoursPerDay >= 0.25 * $shiftHours) {
                              $workingHoursRating = 30;
                          } else {
                              $workingHoursRating = 10;
                          }
                      }
                  }
              }


                      $attendanceDays = DB::table('attendences')
                          ->where('emp_Id', $user->id)
                          ->whereBetween('punch_date', [$startDate, $endDate])
                          ->distinct('punch_date')
                          ->count();

                      $attendanceRating = 10;
                      if ($attendanceDays >= 2 && $attendanceDays <= 10) {
                          $attendanceRating = 30;
                      } elseif ($attendanceDays >= 10 && $attendanceDays <= 20) {
                          $attendanceRating = 50;
                      } elseif ($attendanceDays >= 20 && $attendanceDays <= 30) {
                          $attendanceRating = 75;
                      } elseif ($attendanceDays >= 30) {
                          $attendanceRating = 100;
                      }

                      $totalScore = $ticketRating + $punctualityRating + $workingHoursRating + $attendanceRating;
                      $maxScore = 400;
                      $calpercnt = ($totalScore / 400) * 100;
                      $employeePerformanceData[] = [
                          'name' => Auth::user()->first_name, // Replace with actual name or identifier
                          'totalScore' => $totalScore,
                          'maxScore' => $maxScore,
                      ];
                  ?>
                   
                     
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <div id="performanceChart"></div>
                  <div class="col-4 mt-4">
                      <div class="d-flex gap-2 align-items-center mb-2">
                          <span class="badge bg-label-info p-1 rounded">
                              <i class="ti ti-shopping-cart ti-xs"></i>
                          </span>
                          <p class="mb-0">Completed</p>
                      </div>
                      <h5 class="mb-0 pt-1 text-nowrap"><?php echo e($totalScore); ?></h5>
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
                          <p class="mb-0">Incomplete</p>
                          <span class="badge bg-label-primary p-1 rounded">
                              <i class="ti ti-link ti-xs"></i>
                          </span>
                      </div>
                      <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0"><?php echo e($maxScore - $totalScore); ?></h5>
                  </div>


              </div>
          </div>
      </div>
      </div>

      <!--<div class="col-xl-4 mb-4 col-md-4 col-6" style="height:400px">-->
      <!--           <div class="card" style="height:100%;"> -->
      <!--              <div class="card-header d-flex justify-content-between">-->
      <!--                <div class="card-title m-0 me-2">-->
      <!--                  <h5 class="m-0 me-2">Upcoming Followups</h5>-->
      <!--                  <small class="text-muted"><?php echo e(now()); ?></small>-->
      <!--                  <form class="mb-4" style="width: 34%;">-->
      <!--                    <div class="d-flex gap-2">-->
      <!--                      <input type="date" name="from_date" class="form-control" value="<?php echo e(request('from_date')); ?>" />-->
      <!--                      <input type="date" name="to_date" class="form-control" value="<?php echo e(request('to_date')); ?>" />-->
      <!--                      <button type="submit" class="btn btn-primary">Filter</button>-->
      <!--                    </div>-->
      <!--                  </form>-->
      <!--                </div>-->
                    
      <!--              </div>-->
      <!--              <div class="card-body">-->
      <!--                <ul class="p-0 m-0">-->
      <!--                  <?php $__currentLoopData = $UpcommingFollowups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
      <!--                  <li class="d-flex mb-4 pb-1">-->
      <!--                    <div class="me-3">-->
      <!--                    </div>-->
      <!--                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">-->
      <!--                      <div class="me-2">-->
      <!--                        <h6 class="mb-0">Lead Id : (#<?php echo e($Product->leads_id); ?>)</h6>-->
      <!--                         <small class="text-muted d-block"><?php echo e($Product->id); ?></small> -->
      <!--                      </div>-->
                           
      <!--                      <div class="user-progress d-flex align-items-center gap-1">-->
      <!--                      <p class="mb-0 fw-medium">Note :<?php echo e(substr($Product->remark, 0, 15)); ?></p>-->
      <!--                      </div>-->
      <!--                    </div>-->
      <!--                  </li>-->
      <!--                  <hr/>-->
      <!--                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
      <!--                </ul>-->
      <!--              </div>-->
      <!--            </div>-->
      <!--      </div>-->
               <!-- Sales by Countries tabs-->
<div class="col-md-6 col-xl-4 mb-4" style="height: 400px;">
    <div class="card" style="height: 100%;">
        <div class="card-header d-flex justify-content-between pb-2 mb-1">
            <div class="card-title mb-1">
                <h5 class="m-0 me-2">KRA</h5>
                <!-- Truncate HTML content -->
                <p class="truncated-kra"><?php echo \Illuminate\Support\Str::limit(strip_tags($kra->kra), 600, '...'); ?></p>
                <!-- You may need to adjust the character limit based on your content and design -->
            </div>
        </div>
        <div class="card-body">
            <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#fullKRAModal">Read More</a>
        </div>
    </div>
</div>
<!--<div class="col-xl-4 mb-4 col-md-4 col-6" style="height:400px">-->
<!--                 <div class="card" style="height:100%;"> -->
<!--                    <div class="card-header d-flex justify-content-between">-->
<!--                      <div class="card-title m-0 me-2 d-flex" style="width:100%">-->
<!--                        <h5 class="m-0 me-2">Upcoming Events</h5>-->

<!--                          <a href="<?php echo e(url('Employee/Calendar/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm" style="margin-left:40%">See-->

<!--            More</a>-->
<!--                      </div>-->
                    
<!--                    </div>-->
<!--                    <div class="card-body" style="overflow:auto;">-->
<!--                      <ul class="p-0 m-0">-->
<!--                        <?php $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
<!--                        <li class="d-flex mb-4 pb-1">-->
<!--                          <div class="me-3">-->
<!--                          </div>-->
<!--                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">-->
<!--                            <div class="me-2">-->
<!--                                    <div class="parent d-flex mb-2" style="align-items:center;">-->
<!--                                               User: <div class="child1"> <?php if($Product->profile_img): ?>-->
<!--                                                    <img-->
<!--                                                        class="rounded-circle"-->
<!--                                                        style="margin-left: 10px;margin-right:10px;"-->
<!--                                                        src="<?php echo e($Product->profile_img); ?>"-->
<!--                                                        height="30"-->
<!--                                                        width="30"-->
<!--                                                        alt="User avatar"-->
<!--                                                    />-->
<!--                                                <?php else: ?>-->
<!--                                                    <img-->
<!--                                                        class="rounded-circle"-->
<!--                                                        style="margin-left: 10px;margin-right:10px;"-->
<!--                                                        src="<?php echo e(url('public/images/21104.png')); ?>"-->
<!--                                                        height="30"-->
<!--                                                        width="30"-->
<!--                                                        alt="User avatar"-->
<!--                                                    />-->
<!--                                                <?php endif; ?> </div>-->
<!--                                                <div class="child1"><?php echo e($Product->first_name); ?> <?php echo e($Product->last_name); ?> (#<?php echo e($Product->id); ?>)</div>-->
<!--                                                </div>-->
<!--                               <small class="text-muted d-block">Dates : (<?php echo e($Product->start); ?> - <?php echo e($Product->end); ?>)</small> -->
<!--                            </div>-->
                           
<!--                            <div class="user-progress d-flex align-items-center gap-1">-->
<!--                            <p class="mb-0 fw-medium">Title :<?php echo e(substr($Product->title, 0, 15)); ?></p>-->

<!--                            </div>-->
<!--                          </div>-->
<!--                        </li>-->
<!--                        <hr/>-->
<!--                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
<!--                      </ul>-->
<!--                    </div>-->
<!--                  </div>-->
<!--            </div>-->
            <div class="col-xl-4 mb-4 col-md-4 col-6" style="height:400px">
                      <div class="card" style="height:100%">
                        <?php
                         if ($LeadsGenerated >= 10000000) {
                                $formattedLeadsGenerated = round($LeadsGenerated / 10000000, 2) . 'C';
                            } elseif ($LeadsGenerated >= 100000) {
                                $formattedLeadsGenerated = round($LeadsGenerated / 100000, 2) . 'L';
                            } elseif ($LeadsGenerated >= 1000) {
                                $formattedLeadsGenerated = round($LeadsGenerated / 1000, 2) . 'k';
                            } else {
                                $formattedLeadsGenerated = $LeadsGenerated;
                            }
                        ?>
                        <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <div class="d-flex flex-column">
                              <div class="card-title mb-auto">
                                <h5 class="mb-1 text-nowrap">Generated Leads</h5>
                                <small>Monthly Report</small>
                              </div>
                              <div class="chart-statistics">
                                <h3 class="card-title mb-1"> <?php echo e($LeadsGenerated); ?></h3>
                                <small class="text-success text-nowrap fw-medium"
                                  ></small
                                >
                              </div>
                            </div>
                            <div id="generatedsLeadsChart"></div>
                          </div>
                        </div>
                      </div>
                    </div>

  <!--upcoming event-->
        
  <div class="col-xl-4 col-12">
                  <div class="row">
                    <!-- Expenses -->
                    <!--<div class="col-xl-6 mb-4 col-md-3 col-6">-->
                    <!--  <div class="card">-->
                    <!--    if ($PayExpensesTotal != 0) {-->
                    <!--        if ($PayExpenses >= 10000000) {-->
                    <!--            $formattedPayExpenses = round($PayExpenses / 10000000, 2) . 'C';-->
                    <!--        } elseif ($PayExpenses >= 100000) {-->
                    <!--            $formattedPayExpenses = round($PayExpenses / 100000, 2) . 'L';-->
                    <!--        } elseif ($PayExpenses >= 1000) {-->
                    <!--            $formattedPayExpenses = round($PayExpenses / 1000, 2) . 'k';-->
                    <!--        } else {-->
                    <!--            $formattedPayExpenses = $PayExpenses;-->
                    <!--        }-->

                    <!--        if ($PayExpensesTotal >= 10000000) {-->
                    <!--            $formattedPayExpensesTotal = round($PayExpensesTotal / 10000000, 2) . 'C';-->
                    <!--        } elseif ($PayExpensesTotal >= 100000) {-->
                    <!--            $formattedPayExpensesTotal = round($PayExpensesTotal / 100000, 2) . 'L';-->
                    <!--        } elseif ($PayExpensesTotal >= 1000) {-->
                    <!--            $formattedPayExpensesTotal = round($PayExpensesTotal / 1000, 2) . 'k';-->
                    <!--        } else {-->
                    <!--            $formattedPayExpensesTotal = $PayExpensesTotal;-->
                    <!--        }-->

                    <!--        $Expencespercentage = ($PayExpenses / $PayExpensesTotal) * 100;-->
                    <!--    } else {-->
                    <!--        // Handle the case where $PayExpensesTotal is zero or not provided-->
                    <!--        // You can set default values or take alternative actions here-->
                    <!--        $formattedPayExpenses = $PayExpenses;-->
                    <!--        $formattedPayExpensesTotal = $PayExpensesTotal;-->
                    <!--        $Expencespercentage = 0; // or any other default value as per your logic-->
                    <!--    }-->
                    <!--    @endphp-->

                    <!--    <div class="card-header pb-0">-->
                    <!--      <small class="text-muted">Payroll Expenses</small>-->
                    <!--    </div>-->
                    <!--    <div class="card-body">-->
                    <!--      <div id="expensesChart"></div>-->
                    <!--      <div class="mt-md-2 text-center mt-lg-3 mt-3">-->
                    <!--      </div>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->
                    <!--/ Expenses -->

                       <?php
                            $ProfitLasT = $totalRevenueCurrentMonthPrice - $previousMonthAmount;

                            if ($previousMonthAmount != 0) {
                                $profitPercentage = ($ProfitLasT / $previousMonthAmount) * 100;
                            } else {
                                $profitPercentage = 0;
                            }

                            if ($ProfitLasT >= 10000000) {
                                $formattedProfitLasT = round($ProfitLasT / 10000000, 2) . 'C';
                            } elseif ($ProfitLasT >= 100000) {
                                $formattedProfitLasT = round($ProfitLasT / 100000, 2) . 'L';
                            } elseif ($ProfitLasT >= 1000) {
                                $formattedProfitLasT = round($ProfitLasT / 1000, 2) . 'k';
                            } else {
                                $formattedProfitLasT = $ProfitLasT;
                            }
                        ?>
                    <!-- Profit last month -->
                    
                    <!--/ Profit last month -->

                    <!-- Generated Leads -->
                    
                    <!--/ Generated Leads -->
                  </div>
  </div>

 

  <!-- Earning Reports -->
  <!--<div class="col-xl-4 col-md-6 mb-4">-->
  <!--                <div class="card h-100">-->
  <!--                  <div class="card-header d-flex justify-content-between">-->
  <!--                    <div class="card-title mb-0">-->
  <!--                      <h5 class="m-0 me-2">Earning Reports</h5>-->
  <!--                      <small class="text-muted">Monthly Earnings Overview</small>-->
  <!--                    </div>-->
                     
  <!--                  </div>-->
  <!--                      // Avoid division by zero-->
  <!--                      $netProfitPercentageChange = $previousMonthAmount != 0 ? ($StaSales / $previousMonthAmount) * 100 - 100 : 0;-->
  <!--                      $totalIncomePercentageChange = $PreviousTotalIncome != 0 ? ($TotalIncome / $PreviousTotalIncome) * 100 - 100 : 0;-->
  <!--                      $totalExpensesPercentageChange = $PreviousTotalExpenses != 0 ? ($PayExpenses / $PreviousTotalExpenses) * 100 - 100 : 0;-->
  <!--                  // Convert PHP variables to JavaScript numbers-->
  <!--                  $netProfitPercentageChange = floatval($netProfitPercentageChange);-->
  <!--                  $totalIncomePercentageChange = floatval($totalIncomePercentageChange);-->
  <!--                  $totalExpensesPercentageChange = floatval($totalExpensesPercentageChange);-->
  <!--              @endphp-->

  <!--                  <div class="card-body pb-0">-->
  <!--                    <ul class="p-0 m-0">-->
  <!--                      <li class="d-flex mb-3">-->
  <!--                        <div class="avatar flex-shrink-0 me-3">-->
  <!--                          <span class="avatar-initial rounded bg-label-primary"-->
  <!--                            ><i class="ti ti-chart-pie-2 ti-sm"></i-->
  <!--                          ></span>-->
  <!--                        </div>-->
  <!--                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">-->
  <!--                          <div class="me-2">-->
  <!--                            <h6 class="mb-0">Net Profit</h6>-->
  <!--                            <small class="text-muted"><?php echo e($formattedStaSales); ?> Sales</small>-->
  <!--                          </div>-->
  <!--                          <div class="user-progress d-flex align-items-center gap-3">-->
  <!--                            <small><?php echo e($default_currency->prefix); ?> <?php echo e($StaSales); ?>1</small>-->
  <!--                            <div class="d-flex align-items-center gap-1">-->
  <!--                              <i class="ti ti-chevron-up text-success"></i>-->
  <!--                                </span>-->
  <!--                            </div>-->
  <!--                          </div>-->
  <!--                        </div>-->
  <!--                      </li>-->
  <!--                      <li class="d-flex mb-3">-->
  <!--                        <div class="avatar flex-shrink-0 me-3">-->
  <!--                          <span class="avatar-initial rounded bg-label-success"-->
  <!--                            ><i class="ti ti-currency-dollar ti-sm"></i-->
  <!--                          ></span>-->
  <!--                        </div>-->
  <!--                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">-->
  <!--                          <div class="me-2">-->
  <!--                            <h6 class="mb-0">Total Income</h6>-->
  <!--                            <small class="text-muted">Sales, Affiliation</small>-->
  <!--                          </div>-->
  <!--                          <div class="user-progress d-flex align-items-center gap-3">-->
  <!--                            <small><?php echo e($default_currency->prefix); ?> <?php echo e($TotalIncome); ?></small>-->
  <!--                            <div class="d-flex align-items-center gap-1">-->
  <!--                              <i class="ti ti-chevron-up text-success"></i>-->
  <!--                                </span>-->
  <!--                            </div>-->
  <!--                          </div>-->
  <!--                        </div>-->
  <!--                      </li>-->
  <!--                      <li class="d-flex mb-3">-->
  <!--                        <div class="avatar flex-shrink-0 me-3">-->
  <!--                          <span class="avatar-initial rounded bg-label-secondary"-->
  <!--                            ><i class="ti ti-credit-card ti-sm"></i-->
  <!--                          ></span>-->
  <!--                        </div>-->
  <!--                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">-->
  <!--                          <div class="me-2">-->
  <!--                            <h6 class="mb-0">Total Expenses</h6>-->
  <!--                            <small class="text-muted">ADVT, Marketing</small>-->
  <!--                          </div>-->
  <!--                          <div class="user-progress d-flex align-items-center gap-3">-->
  <!--                            <small><?php echo e($default_currency->prefix); ?> <?php echo e($PayExpenses); ?></small>-->
  <!--                            <div class="d-flex align-items-center gap-1">-->
  <!--                              <i class="ti ti-chevron-up text-success"></i>-->
  <!--                                </span>-->
  <!--                            </div>-->
  <!--                          </div>-->
  <!--                        </div>-->
  <!--                      </li>-->
  <!--                    </ul>-->
  <!--                    <div id="radialBarChart"></div>-->
  <!--                  </div>-->
  <!--                </div>-->
  <!--</div>-->
              <!--/ Earning Reports -->

              <!-- Popular Product -->
  <!--             <div class="col-md-6 col-xl-4 mb-4">-->
  <!--                <div class="card h-100">-->
  <!--                  <div class="card-header d-flex justify-content-between">-->
  <!--                    <div class="card-title m-0 me-2">-->
  <!--                      <h5 class="m-0 me-2">Popular Products</h5>-->
  <!--                      <small class="text-muted">Monthly</small>-->
  <!--                    </div>-->
                    
  <!--                  </div>-->
  <!--                  <div class="card-body">-->
  <!--                    <ul class="p-0 m-0">-->
  <!--                      <?php $__currentLoopData = $PopularProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
  <!--                      <li class="d-flex mb-4 pb-1">-->
  <!--                        <div class="me-3">-->
  <!--                        </div>-->
  <!--                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">-->
  <!--                          <div class="me-2">-->
  <!--                            <h6 class="mb-0"><?php echo e($Product->product_name); ?></h6>-->
  <!--                            <small class="text-muted d-block"><?php echo e($Product->product_tag_line); ?></small>-->
  <!--                          </div>-->
  <!--                          <div class="user-progress d-flex align-items-center gap-1">-->
  <!--                            <p class="mb-0 fw-medium"><?php echo e($Product->price); ?> <?php echo e($default_currency->prefix); ?></p>-->
  <!--                          </div>-->
  <!--                        </div>-->
  <!--                      </li>-->
  <!--                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
  <!--                    </ul>-->
  <!--                  </div>-->
  <!--                </div>-->
  <!--</div>-->
    
            <!--/ Generated Leads -->

</div>

<!-- /Invoice table -->
</div>
</div>

<?php $__currentLoopData = $Attendence; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="odd">
    <input type="hidden" class="punch-in<?php echo e($key+1); ?>" value="<?php echo e($att->punch_in); ?>">
    <input type="hidden" class="punch-out<?php echo e($key+1); ?>" value="<?php if($att && $att->punch_out): ?><?php echo e($att->punch_out); ?> <?php else: ?> <?php echo e(\Carbon\Carbon::now()->format('H:i:s')); ?> <?php endif; ?> ">
    <input type="hidden" class="total-time<?php echo e($key+1); ?>" value="">
  </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<div id="loader" style="display: none;">
    <div class="spinner"></div>
</div>
<div class="modal fade" id="fullKRAModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="fullKRAModalLabel">Full KRA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" >
                <?php echo $kra->kra; ?>

            </div>
        </div>
    </div>
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
 DB::table('event_notifications')->insert([
        'type' => 'event',
        'user_id' => Auth::user()->id,
        'cc_id' => $lst->id,
        'notification_date' => now()->format('Y-m-d'),
    ]);

    }
?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if($bestEmployee): ?>
<?php
  $check = DB::table('event_notifications')->where([
        'type' => 'best_employee',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ])->first();
    if(!$check){
?>
<script>
  $(document).ready(function() {
    bootbox.alert({
      message: "Best Employee Of the Month : <?php echo e($bestEmployee->first_name); ?>",
      size: 'small',
      callback: function() {
        console.log("Alert displayed for event: <?php echo e($bestEmployee->first_name); ?>");
      }
    });
  });
</script>
<?php
 DB::table('event_notifications')->insert([
         'type' => 'best_employee',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ]);

    }
?>
<?php endif; ?>


<?php if($bestSaleMan): ?>
<?php
  $check = DB::table('event_notifications')->where([
        'type' => 'best_salesMan',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ])->first();
    if(!$check){
?>
<script>
  $(document).ready(function() {
    bootbox.alert({
      message: "<?php echo e($bestSaleMan->first_name); ?>",
      size: 'small',
      callback: function() {
        console.log("Alert displayed for event: <?php echo e($bestSaleMan->first_name); ?>");
      }
    });
  });
</script>
<?php
 DB::table('event_notifications')->insert([
         'type' => 'best_salesMan',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ]);

    }
?>
<?php endif; ?>

<?php if($highestGoalAchiever): ?>
<?php
  $check = DB::table('event_notifications')->where([
        'type' => 'best_goal_achiver',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ])->first();
    if(!$check){
?>
<script>
  $(document).ready(function() {
    bootbox.alert({
      message: "Best Employee Of the Month : <?php echo e($highestGoalAchiever->first_name); ?>",
      size: 'small',
      callback: function() {
        console.log("Alert displayed for event: <?php echo e($highestGoalAchiever->first_name); ?>");
      }
    });
  });
</script>
<?php
 DB::table('event_notifications')->insert([
        'type' => 'best_goal_achiver',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ]);

    }
?>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>

<script>
  function clock(id, action) {
    $.ajax({
        url: "<?php echo e(url('Employee/ClockStatusUpdate')); ?>", // Replace with your Laravel route
        method: 'GET',
        data: { id: id, action: action },
        success: function (response) {
            if (response && response.success) {
                console.log(response);
                const clockStatus = response.data.clock_status;
                updateClockButtons(clockStatus);
                 setTimeout(function() {
            location.reload(); // Reload the page
        }, 600);
            } else {
                alert('Failed to update clock status.');
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX request failed:', status, error);
            alert('Error occurred during the request.');
        }
    });
}

// Function to update clock buttons based on clock status
function updateClockButtons(clockStatus) {
    if (clockStatus === 1) {
        $('#clockin').hide();
        $('#clockout').show();
    } else {
        $('#clockin').show();
        $('#clockout').hide();
    }
}


function calculateTimeDifference(start, end) {
    var startTime = moment(start, 'HH:mm:ss a');
    var endTime = moment(end, 'HH:mm:ss a');
    return moment.duration(endTime.diff(startTime));
}
function formatTimeDifference(duration) {
    if (!moment.isDuration(duration)) {
        duration = moment.duration(duration);
    }
    var hours = Math.floor(duration.asHours());
    var minutes = duration.minutes();
    var seconds = duration.seconds();
    return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
}

function calculateTotalSeconds(duration) {
    if (!moment.isDuration(duration)) {
        duration = moment.duration(duration);
    }
    return duration.hours() * 3600 + duration.minutes() * 60 + duration.seconds();
}

function formatTotalTime(totalSeconds) {
    var hours = Math.floor(totalSeconds / 3600);
    var minutes = Math.floor((totalSeconds % 3600) / 60);
    var seconds = totalSeconds % 60;
    return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
}

function parseTime(timeStr) {
    var parts = timeStr.split(':');
    if (parts.length !== 2) {
        console.log('invalid time format');
        return { hours: 0, minutes: 0 };
    }
    return {
        hours: parseInt(parts[0], 10),
        minutes: parseInt(parts[1], 10)
    };
}

function calculateTimeDifference(start, end) {
    var startTime = moment(start, 'HH:mm');
    var endTime = moment(end, 'HH:mm');
    return moment.duration(endTime.diff(startTime));
}

$(document).ready(function () {
    // Get and format working hours
    var workingHours = '<?php echo e($TimeShift->working_hours); ?>'; // Ensure this variable is correctly passed from Laravel
    var WorkingHoursInSeconds = calculateTotalSeconds(moment.duration(parseTime(workingHours)));

    // Initialize variables
    var grandTotalSeconds = 0;
    var totalBreakSeconds = 0;

    // Iterate over each element with class 'odd'
    $('.odd').each(function (index) {
        var punchIn = $(this).find('.punch-in' + (index + 1)).val();
        var punchOut = $(this).find('.punch-out' + (index + 1)).val();

        // Check if both punchIn and punchOut are valid
        if (punchIn && punchOut) {
            var diff = calculateTimeDifference(punchIn, punchOut);
            $(this).find('.total-time' + (index + 1)).val(formatTimeDifference(diff));

            // Update grandTotalSeconds
            grandTotalSeconds += calculateTotalSeconds(diff);
        }

        // Check if previous punch-out exists for break calculation
        if (index > 0) {
            var previousPunchOut = $('.odd').eq(index - 1).find('.punch-out' + (index)).val();
            if (previousPunchOut && punchIn) {
                var breakDiff = calculateTimeDifference(previousPunchOut, punchIn);
                totalBreakSeconds += calculateTotalSeconds(breakDiff);
            }
        }
    });

    // Calculate overall times
    var overallTime = grandTotalSeconds || 0;
    var breakTime = totalBreakSeconds || 0;
    var workingTime = overallTime - breakTime;

    // Display time calculations
    $('#grand-total-time').text(formatTotalTime(overallTime));
    $('#BreakTime').text(formatTotalTime(breakTime));

    var overtime = Math.max(0, grandTotalSeconds - WorkingHoursInSeconds);
    var extraWorkingTime = Math.max(0, grandTotalSeconds - WorkingHoursInSeconds); // Ensure extraWorkingTime is non-negative

    $('#Overtime').text(formatTotalTime(overtime));
    $('#PendingTime').text(formatTotalTime(0)); // Assuming pendingTime is not used in this code
    $('#ExtraWorkingTime').text(formatTotalTime(extraWorkingTime));
    $('#ShiftHours').text(formatTotalTime(WorkingHoursInSeconds));





const percentageScore = "<?php echo e($calpercnt); ?>";

const performanceChartEl = document.querySelector('#performanceChart');

const performanceChartConfig = {
  chart: {
    height: 250, // Adjust height as needed
    type: 'radialBar',
  },
  series: [percentageScore],
  labels: ['Performance Score'], // Label for the chart
  plotOptions: {
    radialBar: {
      hollow: {
        size: '70%', // Adjust inner size of the radial bar
      },
      dataLabels: {
        showOn: 'always',
        name: {
          offsetY: -10,
          show: true,
          color: '#888',
          fontSize: '13px',
          fontFamily: 'Helvetica, Arial, sans-serif',
          fontWeight: 600,
          textAnchor: 'middle',
        },
        value: {
          color: '#111',
          fontSize: '30px',
          fontFamily: 'Helvetica, Arial, sans-serif',
          fontWeight: 400,
          offsetY: 10,
          show: true,
          formatter: function (val) {
            return parseInt(val) + '%';
          },
        },
      },
    },
  },
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'dark',
      type: 'horizontal',
      shadeIntensity: 0.5,
      gradientToColors: ['#ABE5A1'],
      inverseColors: true,
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 100],
    },
  },
  stroke: {
    lineCap: 'round',
  },
  colors: ['#20E647'],
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          height: 200,
        },
        plotOptions: {
          radialBar: {
            hollow: {
              margin: 15,
              size: '55%',
            },
            dataLabels: {
              name: {
                offsetY: -5,
                fontSize: '16px',
                fontWeight: '600',
              },
              value: {
                offsetY: 10,
                fontSize: '22px',
                fontWeight: 'bold',
                formatter: function (val) {
                  return parseInt(val) + '%';
                },
              },
            },
          },
        },
      },
    },
  ],
};

// Render the chart
if (performanceChartEl) {
  const performanceChart = new ApexCharts(performanceChartEl, performanceChartConfig);
  performanceChart.render();
}
    // Get and format working hours
  
     let cardColor, labelColor, headingColor, borderColor, legendColor;

  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    labelColor = config.colors_dark.textMuted;
    legendColor = config.colors_dark.bodyColor;
    headingColor = config.colors_dark.headingColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    headingColor = config.colors.headingColor;
    borderColor = config.colors.borderColor;
  }

  // Donut Chart Colors
  const chartColors = {
    donut: {
      series1: config.colors.success,
      series2: '#28c76fb3',
      series3: '#28c76f80',
      series4: config.colors_label.success
    }
  };


 const generatedLeadsChartEl = document.querySelector('#generatedsLeadsChart');
const LGen = parseInt("<?php echo e($LeadsGenerated); ?>") || 0;
const LPro = parseInt("<?php echo e($LeadsProgress); ?>") || 0;
const LWin = parseInt("<?php echo e($LeadsWin); ?>") || 0;
const LLoss = parseInt("<?php echo e($LeadsLoss); ?>") || 0;

console.log('Leads Generated:', LGen);
console.log('Leads Progress:', LPro);
console.log('Leads Win:', LWin);
console.log('Leads Loss:', LLoss);

const generatedLeadsChartConfig = {
  chart: {
    height: 147,
    width: 130,
    parentHeightOffset: 0,
    type: 'donut'
  },
  labels: ['Win', 'Loss', 'Progress'],
  series: [LWin, LLoss, LPro],
  colors: [
    chartColors.donut.series1,
    chartColors.donut.series2,
    chartColors.donut.series3,
    chartColors.donut.series4
  ],
  stroke: {
    width: 0
  },
  dataLabels: {
    enabled: false,
    formatter: function (val) {
      return parseInt(val) + '%';
    }
  },
  legend: {
    show: false
  },
  tooltip: {
    theme: 'dark'
  },
  grid: {
    padding: {
      top: 15,
      right: -20,
      left: -20
    }
  },
  states: {
    hover: {
      filter: {
        type: 'none'
      }
    }
  },
  plotOptions: {
    pie: {
      donut: {
        size: '70%',
        labels: {
          show: true,
          value: {
            fontSize: '1.375rem',
            fontFamily: 'Public Sans',
            color: headingColor,
            fontWeight: 500,
            offsetY: -15,
            formatter: function (val) {
              return parseInt(val) + '%';
            }
          },
          name: {
            offsetY: 20,
            fontFamily: 'Public Sans'
          },
          total: {
            show: true,
            showAlways: true,
            color: config.colors.success,
            fontSize: '.8125rem',
            label: 'Total',
            fontFamily: 'Public Sans',
            formatter: function () {
              return LGen;
            }
          }
        }
      }
    }
  },
  responsive: [
    {
      breakpoint: 1025,
      options: {
        chart: {
          height: 172,
          width: 160
        }
      }
    },
    {
      breakpoint: 769,
      options: {
        chart: {
          height: 178
        }
      }
    },
    {
      breakpoint: 426,
      options: {
        chart: {
          height: 147
        }
      }
    }
  ]
};

if (generatedLeadsChartEl !== null) {
  const generatedLeadsChart = new ApexCharts(generatedLeadsChartEl, generatedLeadsChartConfig);
  generatedLeadsChart.render();
}

  });
  function clockStatusUpdate2(id, value) {
    $.ajax({
        url: "<?php echo e(url('Employee/ClockStatusUpdate')); ?>",
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
 function formatTotalTime(totalSeconds) {
    if (totalSeconds <= 0) {
      return '00:00';
    }

    var hours = Math.floor(totalSeconds / 3600);
    var minutes = Math.floor((totalSeconds % 3600) / 60);

    return padZero(hours) + ':' + padZero(minutes);
  }

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
 function formatTimeDifference(diff) {
    return padZero(diff.hours) + ':' + padZero(diff.minutes);
  }

  function calculateTotalSeconds(diff) {
    return diff.hours * 3600 + diff.minutes * 60;
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
 function calculateTotalSeconds(diff) {
    return diff.hours * 3600 + diff.minutes * 60;
  }
    function parseTime(timeString) {
    var timeParts = timeString.split(':');
    return {
      hours: parseInt(timeParts[0], 10),
      minutes: parseInt(timeParts[1], 10),
      seconds: parseInt(timeParts[2], 10),
    };
  }
  
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/Employee/dashDepartmentType/Sales.blade.php ENDPATH**/ ?>