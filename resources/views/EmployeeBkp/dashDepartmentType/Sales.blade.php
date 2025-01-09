@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
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
      <div class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 m mt-4 mt-lg-0 mt-md-0 justify-content-end">
        <p class="mb-0 text-lg-right text-md-right f-18 font-weight-bold text-dark-grey d-grid align-items-center text-end" style="padding-right:15px;">
          <input type="hidden" id="current-latitude" name="current_latitude" autocomplete="off">
          <input type="hidden" id="current-longitude" name="current_longitude" autocomplete="off">
          <span class="f-10 font-weight-light">{{ \Carbon\Carbon::now()->format('l')}}</span>
            <span id="dashboard-clock">{{ \Carbon\Carbon::now()->format('h:i A') }}</span>

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
            <span>@if($CheckInTime && $CheckInTime->punch_in) {{ \Carbon\Carbon::parse($CheckInTime->punch_in)->format('h:i A') }}@else 00:00:00  @endif</span>

          </span>
        </p>
        
        <button type="button" class="btn-danger rounded f-15 ml-4" id="clockout" value="clockout" onclick="clock({{ auth()->id() }}, 'clockout')" 
               style="background-color: #7f7c8b; border: 0; color: #fff; padding: 9px 11px 20px; position: relative; text-transform: capitalize; padding-top: 20px; @if(Auth::user()->clock_status != 1) display: none; @endif">
            <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>
        </button>
        
        <button type="button" class="btn-primary rounded f-15 ml-4" id="clockin" value="clockin" onclick="clock({{ auth()->id() }}, 'clockin')" 
                style="background-color: #7f7c8b; border: 0; color: #fff; padding: 9px 11px 20px; position: relative; text-transform: capitalize; padding-top: 20px; @if(Auth::user()->clock_status == 1) display: none; @endif">
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

                <h5 class="text-white mb-0 mt-2">{{Auth::user()->first_name}}</h5>

                <small>Team Lead</small></br>

                <small>Employee ID: Emp-{{Auth::user()->id}}</small>

              </div>

              <div class="row">

                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">

                  <h6 class="text-white mt-0 mt-md-3 mb-3">Overview</h6>

                  <div class="row">

                    <div class="col-6">

                      <ul class="list-unstyled mb-0">

                        <li class="d-flex mb-4 align-items-center">

                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="open_task"

                          style="min-width: 72px;">{{ $OpenTask}}</p>

                          <p class="mb-0">Open Tasks</p>

                        </li>

                        <li class="d-flex align-items-center mb-2">

                           <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="open_task"

                          style="min-width: 72px;">{{$currentMonthEmpPrice}}</p>

                          <p class="mb-0">Total Sales</p>

                        </li>

                      </ul>

                    </div>

                    <div class="col-6">

                      <ul class="list-unstyled mb-0">

                        <li class="d-flex mb-4 align-items-center">

                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="open_task"

                          style="min-width: 72px;">{{$OpenTicket}}</p>

                          <p class="mb-0">Open Tickets</p>

                        </li>

                        <li class="d-flex mb-4 align-items-center">

                             <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="open_task"

                          style="min-width: 72px;">{{$averageResponseTime}}</p>

                          <p class="mb-0">Averave response rate</p>

                        </li>

                      </ul>

                    </div>

                  </div>

                </div>

                 <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">

                <img

                src="{{Auth::user()->profile_img}}"

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

                          style="min-width: 72px;">{{$totalBreakTime}}</p>

                        <p class="mb-0">Total Interval</p>

                      </li>

                    </ul>

                  </div>

                  <div class="col-6">

                    <ul class="list-unstyled mb-0">

                      <li class="d-flex mb-4 align-items-center">

                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ExtraWorkingTime"

                          style="min-width: 72px;">{{$totalOvertime}}</p>

                        <p class="mb-0">Overtime</p>

                      </li>

                      <li class="d-flex align-items-center mb-2">

                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ShiftHours"

                          style="min-width: 72px;">{{$shiftDuration}}</p>

                        <p class="mb-0">Shift Hours</p>

                      </li>

                    </ul>

                  </div>

                </div>

              </div>

              <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">

                <img src="{{url('public/logo/clock.png')}}" alt="Website Analytics" width="170"

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
                            @php
                                  if ($StaSales >= 10000000) {
                                      $formattedStaSales = round($StaSales / 10000000, 2) . 'C';
                                  } elseif ($StaSales >= 100000) {
                                      $formattedStaSales = round($StaSales / 100000, 2) . 'L';
                                  } elseif ($StaSales >= 1000) {
                                      $formattedStaSales = round($StaSales / 1000, 2) . 'k';
                                  } else {
                                      $formattedStaSales = $StaSales;
                                  }
                           @endphp
                            <div class="card-info">
                              <h5 class="mb-0">{{$totalSalesCurrentMonthPrice}}</h5>
                              <small>Total amount of sales</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                              <i class="ti ti-users ti-sm"></i>
                            </div>
                             @php
                                  if ($StaCustomer >= 10000000) {
                                      $formattedStaCustomer = round($StaCustomer / 10000000, 2) . 'C';
                                  } elseif ($StaCustomer >= 100000) {
                                      $formattedStaCustomer = round($StaCustomer / 100000, 2) . 'L';
                                  } elseif ($StaCustomer >= 1000) {
                                      $formattedStaCustomer = round($StaCustomer / 1000, 2) . 'k';
                                  } else {
                                      $formattedStaCustomer = $StaCustomer;
                                  }
                           @endphp
                            <div class="card-info">
                              <h5 class="mb-0">{{$TClient}}</h5>
                              <small>Customers  </small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                              <i class="ti ti-shopping-cart ti-sm"></i>
                            </div>
                            @php
                                  if ($StaProducts >= 10000000) {
                                      $formattedStaProducts = round($StaProducts / 10000000, 2) . 'C';
                                  } elseif ($StaProducts >= 100000) {
                                      $formattedStaProducts = round($StaProducts / 100000, 2) . 'L';
                                  } elseif ($StaProducts >= 1000) {
                                      $formattedStaProducts = round($StaProducts / 1000, 2) . 'k';
                                  } else {
                                      $formattedStaProducts = $StaProducts;
                                  }
                           @endphp
                            <div class="card-info">
                              <h5 class="mb-0">{{$totalSaledProducts}}</h5>
                              <small>Products</small>
                            </div>
                          </div>
                        </div>
                         <div class="col-md-6 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                              <i class="ti ti-currency-dollar ti-sm"></i>
                            </div>
                             @php
                                  if ($StaRevenue >= 10000000) {
                                      $formattedStaRevenue = round($StaRevenue / 10000000, 2) . 'C';
                                  } elseif ($StaRevenue >= 100000) {
                                      $formattedStaRevenue = round($StaRevenue / 100000, 2) . 'L';
                                  } elseif ($StaRevenue >= 1000) {
                                      $formattedStaRevenue = round($StaRevenue / 1000, 2) . 'k';
                                  } else {
                                      $formattedStaRevenue = $StaRevenue;
                                  }
                           @endphp
                            <div class="card-info">
                              <h5 class="mb-0">{{$totalOpenTickets}}</h5>
                              <small>Open Tickets</small>
                            </div>
                          </div>
                        </div>
                      
                        <!--    <div class="card-info">-->
                        <!--      <h5 class="mb-0">{{$paidOrders}}</h5>-->
                        <!--      <small>Total paid orders</small>-->
                        
                      </div>
                    </div>
                  </div>
  </div>
  <!--/ Statistics -->

  <div class="col-xl-6 mb-4 col-md-6">
           <div class="card h-100" >
          <div class="card-header d-flex justify-content-between">
              <div class="card-title mb-0">
                  <h5 class="m-0 me-2">Performance</h5>
              </div>
          </div>
          <div class="card-body">
              <div class="row py-4">
                  @php
                  $employeePerformanceData = [];
                      $averageRatings = [];
                      $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
                      $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
                      $startDate = date("$year-$month-01");
                      $endDate = date("$year-$month-t", strtotime($startDate));

                              $startDateLastYear = date('$year-$month-d', strtotime('-1 year'));
              @endphp
              @foreach($Performance as $user)
                  @php
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
                  @endphp
                    <div id="performanceChart"></div>
                  <div class="col-4 mt-4">
                      <div class="d-flex gap-2 align-items-center mb-2">
                          <span class="badge bg-label-info p-1 rounded">
                              <i class="ti ti-shopping-cart ti-xs"></i>
                          </span>
                          <p class="mb-0">Completed</p>
                      </div>
                      <h5 class="mb-0 pt-1 text-nowrap">{{ $totalScore }}</h5>
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
                      <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">{{ $maxScore - $totalScore }}</h5>
                  </div>


                     
                  @endforeach
              </div>
          </div>
      </div>
  </div>
     <div class="col-xl-6 col-md-6 mb-4"  style="height:500px">
                 <div class="card" style="height:100%;overflow: scroll;"> 
            <div class="card-header d-flex justify-content-between">
               <div class="card-title mb-0">
                  <h5 class="m-0 me-2">Team Leads</h5>
               </div>
            </div>
            <div class="card-body pb-0" style="position: relative;">
               @foreach($teamLeads as $key=> $user)
               <ul class="p-0 m-0">
                  <li class="d-flex mb-3">
                     <div class="avatar">
                        <span class="rounded">
                        @if($user && $user->profile_img)
                        <img src="{{$user ? $user->profile_img : ''}}" class="rounded-circle">
                        @else
                        <span class="avatar-initial rounded"></span>
                        @endif
                        </span>
                     </div>
                     <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2" style="margin-left: 20px;">
                        <div class="me-2">
                           <h6 class="mb-0">{{$user->first_name}} {{$user->last_name}} (#{{$user->id}})</h6>
                           <small class="text-muted"><b>Department </b>: {{$user->name}}</small><br>
                           <small class="text-muted"><b>Role </b>: {{$user->jobrole}}</small>
                        </div>
                     </div>
                  </li>
               </ul>
               @endforeach
               <div class="resize-triggers">
                  <div class="expand-trigger">
                     <div style="width: 332px; height: 478px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
               </div>
            </div>
         </div>
      </div>
      
      
   <div class="col-xl-7 col-md-6 mb-4"  style="height:500px">
              <div class="card bg-white border-0 b-shadow-4 table-height" style="height:100%">
        <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <strong>My Performance</strong>
            <a href="https://crm1.cloudtechtiq.com/Employee/Performance/home" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
        </div>
        <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
            @php
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
            @endphp

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
                    @if($Performance2->count() > 0)
                        @foreach($Performance2 as $key => $user)
                            @php
                                // Retrieve user details and other necessary information
                                $user_details = DB::table('users')->find($user->id);
                                $Reviewer = DB::table('users')->select('first_name')->where('id', $user->id)->first();
                            @endphp
                            <tr class="odd">
                                <td>{{ $key + 1 }}</td>

                                <td>@if($user && $user->first_name) {{ $user->first_name }} @endif</td>

                                <td>
                                    @php
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
                                    @endphp

                                    @if($resolvedRating1 === '--')
                                        <span>--</span>
                                    @else
                                        @for ($i = 0; $i < $resolvedRating1; $i++)
                                            <i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>
                                        @endfor
                                    @endif
                                </td>

                                @php
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
                                @endphp

                                <td>
                                    @if($resolvedRating === '--')
                                        <span>--</span>
                                    @else
                                        @for ($i = 0; $i < $resolvedRating; $i++)
                                            <i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>
                                        @endfor
                                    @endif
                                </td>

                                @php
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
                                @endphp

                                <td>
                                    @if($resolvedRating === '--')
                                        <span>--</span>
                                    @else
                                        @for ($i = 0; $i < $resolvedRating; $i++)
                                            <i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>
                                        @endfor
                                    @endif
                                </td>

                                @php
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
                                @endphp

                                <td>
                                    @if($resolvedRating === '--')
                                        <span>--</span>
                                    @else
                                        @for ($i = 0; $i < $resolvedRating; $i++)
                                            <i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>
                                        @endfor
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="7">No Data Found</td>
                        </tr>
                    @endif             
                </tbody>
            </table>
        </div>
    </div>
</div>

   <div class="col-xl-5 col-md-6 mb-4"  style="height:500px">
                 <div class="card" style="height:100%;overflow: scroll;"> 
            <div class="card-header d-flex justify-content-between">
               <div class="card-title mb-0">
                  <h5 class="m-0 me-2">Team Leads</h5>
               </div>
            </div>
            <div class="card-body pb-0" style="position: relative;">
               @foreach($teamLeads as $key=> $user)
               <ul class="p-0 m-0">
                  <li class="d-flex mb-3">
                     <div class="avatar">
                        <span class="rounded">
                        @if($user && $user->profile_img)
                        <img src="{{$user ? $user->profile_img : ''}}" class="rounded-circle">
                        @else
                        <span class="avatar-initial rounded"></span>
                        @endif
                        </span>
                     </div>
                     <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2" style="margin-left: 20px;">
                        <div class="me-2">
                           <h6 class="mb-0">{{$user->first_name}} {{$user->last_name}} (#{{$user->id}})</h6>
                           <small class="text-muted"><b>Department </b>: {{$user->name}}</small><br>
                           <small class="text-muted"><b>Role </b>: {{$user->jobrole}}</small>
                        </div>
                     </div>
                  </li>
               </ul>
               @endforeach
               <div class="resize-triggers">
                  <div class="expand-trigger">
                     <div style="width: 332px; height: 478px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-4 mb-4 col-md-4 col-6" style="height:400px">
                 <div class="card" style="height:100%;"> 
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title m-0 me-2">
                        <h5 class="m-0 me-2">Upcoming Followups</h5>
                        <small class="text-muted">{{now()}}</small>
                      </div>
                    
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        @foreach($UpcommingFollowups as $Product)
                        <li class="d-flex mb-4 pb-1">
                          <div class="me-3">
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Lead Id : (#{{$Product->leads_id}})</h6>
                               <small class="text-muted d-block">{{$Product->id}}</small> 
                            </div>
                           
                            <div class="user-progress d-flex align-items-center gap-1">
                            <p class="mb-0 fw-medium">Note :{{ substr($Product->remark, 0, 15) }}</p>
                            </div>
                          </div>
                        </li>
                        <hr/>
                        @endforeach
                      </ul>
                    </div>
                  </div>
            </div>
               <!-- Sales by Countries tabs-->
<div class="col-md-6 col-xl-4 mb-4" style="height: 400px;">
    <div class="card" style="height: 100%;">
        <div class="card-header d-flex justify-content-between pb-2 mb-1">
            <div class="card-title mb-1">
                <h5 class="m-0 me-2">KRA</h5>
                <!-- Truncate HTML content -->
                <p class="truncated-kra">{!! \Illuminate\Support\Str::limit(strip_tags($kra->kra), 600, '...') !!}</p>
                <!-- You may need to adjust the character limit based on your content and design -->
            </div>
        </div>
        <div class="card-body">
            <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#fullKRAModal">Read More</a>
        </div>
    </div>
</div>
<div class="col-xl-4 mb-4 col-md-4 col-6" style="height:400px">
                 <div class="card" style="height:100%;"> 
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title m-0 me-2 d-flex" style="width:100%">
                        <h5 class="m-0 me-2">Upcoming Events</h5>

                          <a href="{{url('Employee/Calendar/home')}}" type="button" class="btn-primary rounded f-14 p-2 btn-sm" style="margin-left:40%">See

            More</a>
                      </div>
                    
                    </div>
                    <div class="card-body" style="overflow:auto;">
                      <ul class="p-0 m-0">
                        @foreach($upcomingEvents as $Product)
                        <li class="d-flex mb-4 pb-1">
                          <div class="me-3">
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                    <div class="parent d-flex mb-2" style="align-items:center;">
                                               User: <div class="child1"> @if($Product->profile_img)
                                                    <img
                                                        class="rounded-circle"
                                                        style="margin-left: 10px;margin-right:10px;"
                                                        src="{{ $Product->profile_img }}"
                                                        height="30"
                                                        width="30"
                                                        alt="User avatar"
                                                    />
                                                @else
                                                    <img
                                                        class="rounded-circle"
                                                        style="margin-left: 10px;margin-right:10px;"
                                                        src="{{ url('public/images/21104.png') }}"
                                                        height="30"
                                                        width="30"
                                                        alt="User avatar"
                                                    />
                                                @endif </div>
                                                <div class="child1">{{$Product->first_name}} {{$Product->last_name}} (#{{$Product->id}})</div>
                                                </div>
                               <small class="text-muted d-block">Dates : ({{$Product->start}} - {{$Product->end}})</small> 
                            </div>
                           
                            <div class="user-progress d-flex align-items-center gap-1">
                            <p class="mb-0 fw-medium">Title :{{ substr($Product->title, 0, 15) }}</p>

                            </div>
                          </div>
                        </li>
                        <hr/>
                        @endforeach
                      </ul>
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
                        @foreach($leaveStatus as $status)
                        <tr>
                            <td>{{ $status['type'] }}</td>
                            <td>{{ $status['allowed'] }}</td>
                            <td>{{ $status['taken'] }}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar {{ $status['colorClass'] }}" role="progressbar"
                                        style="width: {{ $status['percentage'] }}%;" aria-valuenow="{{ $status['percentage'] }}"
                                        aria-valuemin="0" aria-valuemax="100">{{ $status['percentage'] }}%</div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

  <!--upcoming event-->
        
  <div class="col-xl-4 col-12">
                  <div class="row">
                    <!-- Expenses -->
                    <div class="col-xl-6 mb-4 col-md-3 col-6">
                      <div class="card">
                       @php
                        if ($PayExpensesTotal != 0) {
                            if ($PayExpenses >= 10000000) {
                                $formattedPayExpenses = round($PayExpenses / 10000000, 2) . 'C';
                            } elseif ($PayExpenses >= 100000) {
                                $formattedPayExpenses = round($PayExpenses / 100000, 2) . 'L';
                            } elseif ($PayExpenses >= 1000) {
                                $formattedPayExpenses = round($PayExpenses / 1000, 2) . 'k';
                            } else {
                                $formattedPayExpenses = $PayExpenses;
                            }

                            if ($PayExpensesTotal >= 10000000) {
                                $formattedPayExpensesTotal = round($PayExpensesTotal / 10000000, 2) . 'C';
                            } elseif ($PayExpensesTotal >= 100000) {
                                $formattedPayExpensesTotal = round($PayExpensesTotal / 100000, 2) . 'L';
                            } elseif ($PayExpensesTotal >= 1000) {
                                $formattedPayExpensesTotal = round($PayExpensesTotal / 1000, 2) . 'k';
                            } else {
                                $formattedPayExpensesTotal = $PayExpensesTotal;
                            }

                            $Expencespercentage = ($PayExpenses / $PayExpensesTotal) * 100;
                        } else {
                            // Handle the case where $PayExpensesTotal is zero or not provided
                            // You can set default values or take alternative actions here
                            $formattedPayExpenses = $PayExpenses;
                            $formattedPayExpensesTotal = $PayExpensesTotal;
                            $Expencespercentage = 0; // or any other default value as per your logic
                        }
                        @endphp

                        <div class="card-header pb-0">
                          <h5 class="card-title mb-0">{{$default_currency->prefix}} {{$formattedPayExpenses}}</h5>
                          <small class="text-muted">Payroll Expenses</small>
                        </div>
                        <div class="card-body">
                          <div id="expensesChart"></div>
                          <div class="mt-md-2 text-center mt-lg-3 mt-3">
                            <small class="text-muted mt-3">{{$default_currency->prefix}} {{$formattedPayExpensesTotal}} Expenses of the last month</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--/ Expenses -->

                       @php
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
                        @endphp
                    <!-- Profit last month -->
                    <div class="col-xl-6 mb-4 col-md-3 col-6">
                          <div class="card">
                              <div class="card-header pb-0">
                                  <h5 class="card-title mb-0">Profit</h5>
                                  <small class="text-muted">Last Month</small>
                              </div>
                              <div class="card-body">
                                  <div id="profitLastMonth"></div>
                                  <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                      <h4 class="mb-0">{{$default_currency->prefix}} {{$formattedProfitLasT}}</h4>
                                      <small id="profitPercentage" class="text-success"></small>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <!--/ Profit last month -->

                    <!-- Generated Leads -->
                    <div class="col-xl-12 mb-2 col-md-6">
                      <div class="card">
                        @php
                         if ($LeadsGenerated >= 10000000) {
                                $formattedLeadsGenerated = round($LeadsGenerated / 10000000, 2) . 'C';
                            } elseif ($LeadsGenerated >= 100000) {
                                $formattedLeadsGenerated = round($LeadsGenerated / 100000, 2) . 'L';
                            } elseif ($LeadsGenerated >= 1000) {
                                $formattedLeadsGenerated = round($LeadsGenerated / 1000, 2) . 'k';
                            } else {
                                $formattedLeadsGenerated = $LeadsGenerated;
                            }
                        @endphp
                        <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <div class="d-flex flex-column">
                              <div class="card-title mb-auto">
                                <h5 class="mb-1 text-nowrap">Generated Leads</h5>
                                <small>Monthly Report</small>
                              </div>
                              <div class="chart-statistics">
                                <h3 class="card-title mb-1"> {{$LeadsGenerated}}</h3>
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
                    <!--/ Generated Leads -->
                  </div>
  </div>

 

  <!-- Earning Reports -->
  <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Earning Reports</h5>
                        <small class="text-muted">Monthly Earnings Overview</small>
                      </div>
                     
                    </div>
                    @php
                        // Avoid division by zero
                        $netProfitPercentageChange = $previousMonthAmount != 0 ? ($StaSales / $previousMonthAmount) * 100 - 100 : 0;
                        $totalIncomePercentageChange = $PreviousTotalIncome != 0 ? ($TotalIncome / $PreviousTotalIncome) * 100 - 100 : 0;
                        $totalExpensesPercentageChange = $PreviousTotalExpenses != 0 ? ($PayExpenses / $PreviousTotalExpenses) * 100 - 100 : 0;
                    // Convert PHP variables to JavaScript numbers
                    $netProfitPercentageChange = floatval($netProfitPercentageChange);
                    $totalIncomePercentageChange = floatval($totalIncomePercentageChange);
                    $totalExpensesPercentageChange = floatval($totalExpensesPercentageChange);
                @endphp

                    <div class="card-body pb-0">
                      <ul class="p-0 m-0">
                        <li class="d-flex mb-3">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"
                              ><i class="ti ti-chart-pie-2 ti-sm"></i
                            ></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Net Profit</h6>
                              <small class="text-muted">{{$formattedStaSales}} Sales</small>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-3">
                              <small>{{$default_currency->prefix}} {{$StaSales}}1</small>
                              <div class="d-flex align-items-center gap-1">
                                <i class="ti ti-chevron-up text-success"></i>
                                 <span class="{{ $netProfitPercentageChange >= 0 ? 'text-success' : 'text-danger' }}">
                                      {{ $netProfitPercentageChange }}%
                                  </span>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-3">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success"
                              ><i class="ti ti-currency-dollar ti-sm"></i
                            ></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Total Income</h6>
                              <small class="text-muted">Sales, Affiliation</small>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-3">
                              <small>{{$default_currency->prefix}} {{$TotalIncome}}</small>
                              <div class="d-flex align-items-center gap-1">
                                <i class="ti ti-chevron-up text-success"></i>
                                <span class="{{ $totalIncomePercentageChange >= 0 ? 'text-success' : 'text-danger' }}">
                                      {{ $totalIncomePercentageChange }}%
                                  </span>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-3">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-secondary"
                              ><i class="ti ti-credit-card ti-sm"></i
                            ></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Total Expenses</h6>
                              <small class="text-muted">ADVT, Marketing</small>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-3">
                              <small>{{$default_currency->prefix}} {{$PayExpenses}}</small>
                              <div class="d-flex align-items-center gap-1">
                                <i class="ti ti-chevron-up text-success"></i>
                                <span class="{{ $totalExpensesPercentageChange >= 0 ? 'text-success' : 'text-danger' }}">
                                      {{ $totalExpensesPercentageChange }}%
                                  </span>
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                      <div id="radialBarChart"></div>
                    </div>
                  </div>
  </div>
              <!--/ Earning Reports -->

              <!-- Popular Product -->
               <div class="col-md-6 col-xl-4 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title m-0 me-2">
                        <h5 class="m-0 me-2">Popular Products</h5>
                        <small class="text-muted">Monthly</small>
                      </div>
                    
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        @foreach($PopularProducts as $Product)
                        <li class="d-flex mb-4 pb-1">
                          <div class="me-3">
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">{{$Product->product_name}}</h6>
                              <small class="text-muted d-block">{{$Product->product_tag_line}}</small>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <p class="mb-0 fw-medium">{{$Product->price}} {{$default_currency->prefix}}</p>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
  </div>
    
            <!--/ Generated Leads -->

</div>

<!-- /Invoice table -->
</div>
</div>

@foreach($Attendence as $key => $att)
  <div class="odd">
    <input type="hidden" class="punch-in{{$key+1}}" value="{{ $att->punch_in }}">
    <input type="hidden" class="punch-out{{$key+1}}" value="@if($att && $att->punch_out){{ $att->punch_out }} @else {{ \Carbon\Carbon::now()->format('H:i:s') }} @endif ">
    <input type="hidden" class="total-time{{$key+1}}" value="">
  </div>
@endforeach


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
                {!! $kra->kra !!}
            </div>
        </div>
    </div>
</div>
@foreach($calenderEvents as $lst)
@php
  $check = DB::table('event_notifications')->where([
        'type' => 'event',
        'user_id' => Auth::user()->id,
        'cc_id' => $lst->id,
        'notification_date' => now()->format('Y-m-d'),
    ])->first();
    if(!$check){
@endphp
<script>
  $(document).ready(function() {
    bootbox.alert({
      message: "{{ $lst->title }}",
      size: 'small',
      callback: function() {
        console.log("Alert displayed for event: {{ $lst->title }}");
      }
    });
  });
</script>
@php
 DB::table('event_notifications')->insert([
        'type' => 'event',
        'user_id' => Auth::user()->id,
        'cc_id' => $lst->id,
        'notification_date' => now()->format('Y-m-d'),
    ]);

    }
@endphp
@endforeach

@if($bestEmployee)
@php
  $check = DB::table('event_notifications')->where([
        'type' => 'best_employee',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ])->first();
    if(!$check){
@endphp
<script>
  $(document).ready(function() {
    bootbox.alert({
      message: "Best Employee Of the Month : {{ $bestEmployee->first_name }}",
      size: 'small',
      callback: function() {
        console.log("Alert displayed for event: {{ $bestEmployee->first_name }}");
      }
    });
  });
</script>
@php
 DB::table('event_notifications')->insert([
         'type' => 'best_employee',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ]);

    }
@endphp
@endif


@if($bestSaleMan)
@php
  $check = DB::table('event_notifications')->where([
        'type' => 'best_salesMan',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ])->first();
    if(!$check){
@endphp
<script>
  $(document).ready(function() {
    bootbox.alert({
      message: "{{ $bestSaleMan->first_name }}",
      size: 'small',
      callback: function() {
        console.log("Alert displayed for event: {{ $bestSaleMan->first_name }}");
      }
    });
  });
</script>
@php
 DB::table('event_notifications')->insert([
         'type' => 'best_salesMan',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ]);

    }
@endphp
@endif

@if($highestGoalAchiever)
@php
  $check = DB::table('event_notifications')->where([
        'type' => 'best_goal_achiver',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ])->first();
    if(!$check){
@endphp
<script>
  $(document).ready(function() {
    bootbox.alert({
      message: "Best Employee Of the Month : {{ $highestGoalAchiever->first_name }}",
      size: 'small',
      callback: function() {
        console.log("Alert displayed for event: {{ $highestGoalAchiever->first_name }}");
      }
    });
  });
</script>
@php
 DB::table('event_notifications')->insert([
        'type' => 'best_goal_achiver',
        'user_id' => Auth::user()->id,
        'cc_id' => 0,
        'notification_date' => now()->format('Y-m-d'),
    ]);

    }
@endphp
@endif
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
  function clock(id, action) {
    $.ajax({
        url: "{{ url('Employee/ClockStatusUpdate') }}", // Replace with your Laravel route
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


  $(document).ready(function() {

const percentageScore = "{{$calpercnt}}";

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
  var workingHours = '{{$TimeShift->working_hours}}'; // Set your working hours
    var WorkingHoursInSeconds = calculateTotalSeconds(parseTime(workingHours));
    var grandTotalSeconds = 0;
    var totalBreakSeconds = 0;

    $('.odd').each(function(index) {
        var punchIn = $(this).find('.punch-in' + (index + 1)).val();
        var punchOut = $(this).find('.punch-out' + (index + 1)).val();

        var diff = calculateTimeDifference(punchIn, punchOut);
        $(this).find('.total-time' + (index + 1)).val(formatTimeDifference(diff));

        grandTotalSeconds += calculateTotalSeconds(diff);

        if (index > 0) {
            var previousPunchOut = $('.odd').eq(index - 1).find('.punch-out' + index).val();
            var breakDiff = calculateTimeDifference(previousPunchOut, punchIn);
            totalBreakSeconds += calculateTotalSeconds(breakDiff);
        }
    });

    var overallTime = grandTotalSeconds;
    var breakTime = totalBreakSeconds;
    var workingTime = overallTime - breakTime;

    $('#grand-total-time').text(formatTotalTime(grandTotalSeconds));
    $('#BreakTime').text(formatTotalTime(totalBreakSeconds));

    var overtime = 0;
    var pendingTime = 0;
    var extraWorkingTime = grandTotalSeconds - WorkingHoursInSeconds;

    if (extraWorkingTime > 0) {
        overtime = extraWorkingTime;
    } else {
        overtime = 0;
    }

    $('#Overtime').text(formatTotalTime(overtime));
    $('#PendingTime').text(formatTotalTime(pendingTime));
    $('#ExtraWorkingTime').text(formatTotalTime(extraWorkingTime));
    $('#ShiftHours').text(formatTotalTime(WorkingHoursInSeconds));
    
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

     // Radial Bar Chart
  // --------------------------------------------------------------------
  const radialBarChartEl = document.querySelector('#radialBarChart'),
    radialBarChartConfig = {
      chart: {
        height: 380,
        type: 'radialBar'
      },
      colors: [chartColors.donut.series1, chartColors.donut.series2, chartColors.donut.series4],
      plotOptions: {
        radialBar: {
          size: 185,
          hollow: {
            size: '40%'
          },
          track: {
            margin: 10,
            background: config.colors_label.secondary
          },
          dataLabels: {
            name: {
              fontSize: '2rem',
              fontFamily: 'Public Sans'
            },
            value: {
              fontSize: '1.2rem',
              color: legendColor,
              fontFamily: 'Public Sans'
            },
            total: {
              show: true,
              fontWeight: 400,
              fontSize: '1.3rem',
              color: headingColor,
              label: 'Net Profit',
              formatter: function (w) {
                return "{{$netProfitPercentageChange}} %";
              }
            }
          }
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: -25,
          bottom: -20
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      stroke: {
        lineCap: 'round'
      },
      series: ["{{$netProfitPercentageChange}}","{{$totalIncomePercentageChange}}","{{$totalExpensesPercentageChange}}"],
      labels: ['Net Profit', 'Total Income', 'Total Expenses']
    };
  if (typeof radialBarChartEl !== undefined && radialBarChartEl !== null) {
    const radialChart = new ApexCharts(radialBarChartEl, radialBarChartConfig);
    radialChart.render();
  }
   const expensesRadialChartEl = document.querySelector('#expensesChart');

// Assume you have calculated the percentage and stored it in the variable 'percentage'
const percentage = "{{round($Expencespercentage)}}";

const expensesRadialChartConfig = {
  chart: {
    height: 145,
    sparkline: {
      enabled: true
    },
    parentHeightOffset: 0,
    type: 'radialBar'
  },
  colors: [config.colors.warning],
  series: [percentage], // Use the calculated percentage here
  plotOptions: {
    radialBar: {
      offsetY: 0,
      startAngle: -90,
      endAngle: 90,
      hollow: {
        size: '65%'
      },
      track: {
        strokeWidth: '45%',
        background: borderColor
      },
      dataLabels: {
        name: {
          show: false
        },
        value: {
          fontSize: '22px',
          color: headingColor,
          fontWeight: 500,
          offsetY: -5
        }
      }
    }
  },
  grid: {
    show: false,
    padding: {
      bottom: 5
    }
  },
  stroke: {
    lineCap: 'round'
  },
  labels: ['Progress'],
  responsive: [
    {
      breakpoint: 1442,
      options: {
        chart: {
          height: 120
        },
        plotOptions: {
          radialBar: {
            dataLabels: {
              value: {
                fontSize: '18px'
              }
            },
            hollow: {
              size: '60%'
            }
          }
        }
      }
    },
    {
      breakpoint: 1025,
      options: {
        chart: {
          height: 136
        },
        plotOptions: {
          radialBar: {
            hollow: {
              size: '65%'
            },
            dataLabels: {
              value: {
                fontSize: '18px'
              }
            }
          }
        }
      }
    },
    {
      breakpoint: 769,
      options: {
        chart: {
          height: 120
        },
        plotOptions: {
          radialBar: {
            hollow: {
              size: '55%'
            }
          }
        }
      }
    },
    {
      breakpoint: 426,
      options: {
        chart: {
          height: 145
        },
        plotOptions: {
          radialBar: {
            hollow: {
              size: '65%'
            }
          }
        },
        dataLabels: {
          value: {
            offsetY: 0
          }
        }
      }
    },
    {
      breakpoint: 376,
      options: {
        chart: {
          height: 105
        },
        plotOptions: {
          radialBar: {
            hollow: {
              size: '60%'
            }
          }
        }
      }
    }
  ]
};

if (typeof expensesRadialChartEl !== undefined && expensesRadialChartEl !== null) {
  const expensesRadialChart = new ApexCharts(expensesRadialChartEl, expensesRadialChartConfig);
  expensesRadialChart.render();
}
 const generatedLeadsChartEl = document.querySelector('#generatedsLeadsChart');
const LGen = parseInt("{{$LeadsGenerated}}") || 0;
const LPro = parseInt("{{$LeadsProgress}}") || 0;
const LWin = parseInt("{{$LeadsWin}}") || 0;
const LLoss = parseInt("{{$LeadsLoss}}") || 0;

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
        url: "{{ url('Employee/ClockStatusUpdate') }}",
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

@endsection