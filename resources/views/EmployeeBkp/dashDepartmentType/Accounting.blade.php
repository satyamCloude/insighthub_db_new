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
<div class="container-xxl flex-grow-1 container-p-y">

   <div class="row">
      <!-- View sales -->
      <div class="col-xl-8 mb-4 col-lg-9 col-12"></div>
      <div class="col-xl-4 mb-4 col-lg-3 col-md-3 col-12">
         <!-- CLOCK IN CLOCK OUT START -->
            <div class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 m mt-4 mt-lg-0 mt-md-0 justify-content-end" style="
    justify-content: flex-end !important;
">        <p class="mb-0 text-lg-right text-md-right f-15 font-weight-bold text-dark-grey d-grid align-items-center text-end" style="padding-right:10px;">
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
        
        <!--<button type="button" class="btn-danger rounded f-15 ml-4" id="clockout" value="clockout" onclick="clock({{auth()->id()}},value)"-->
        <!--  style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;display: none;">-->
        <!--  <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>-->
        <!--</button>-->
        <!--<button type="button" class="btn-primary rounded f-15 ml-4" id="clockin" value="clockin" onclick="clock({{auth()->id()}},value)" -->
        <!--  style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;display: none;">-->
        <!--  <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>-->
        <!--</button>-->
      </div>
      <!-- CLOCK IN CLOCK OUT END -->

      </div>
      <!-- View sales -->
   
      
      <!-- View sales -->

    
      <div class="col-xl-6 mb-4 col-lg-6 col-12">
       

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

                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="open_ticket"

                          style="min-width: 72px;">{{$OpenTicket}}</p>

                          <p class="mb-0">Open Tickets</p>

                        </li>

                        <li class="d-flex mb-4 align-items-center">
                           @if($averageResponseTime && $averageResponseTime != 'N/A')
                             <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="avgresprate"

                          style="min-width: 72px;">{{$averageResponseTime}}</p>
                         
                          <p class="mb-0">Averave response rate</p>
                            @endif
                        </li>

                      </ul>

                    </div>

                  </div>

                </div>

                 <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">

                <img

                src="{{Auth::user()->profile_img}}"

                alt="Website Analytics"

                width="190" height="190"

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
        @php
                        // Avoid division by zero
                        $netProfitPercentageChange = $previousMonthAmount != 0 ? ($StaSales / $previousMonthAmount) * 100 - 100 : 0;
                        $totalIncomePercentageChange = $PreviousTotalIncome != 0 ? ($TotalIncome / $PreviousTotalIncome) * 100 - 100 : 0;
                        $totalExpensesPercentageChange = $PreviousTotalExpenses != 0 ? ($PayExpenses / $PreviousTotalExpenses) * 100 - 100 : 0;
                    // Convert PHP variables to JavaScript numbers
                    $netProfitPercentageChange = floatval($netProfitPercentageChange);
                    $totalIncomePercentageChange = floatval($totalIncomePercentageChange);
                    $totalExpensesPercentageChange = floatval($totalExpensesPercentageChange);

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

                           @endphp

     
      <div class="col-xl-6 mb-4 col-lg-7 col-12 mb-4" style="300px">
         <div class="card h-100" style="100%">
            <div class="card-header">
               <div class="d-flex justify-content-between mb-3">
                  <h5 class="card-title mb-0">Statistics</h5>
                  <!-- <small class="text-muted">Updated 1 month ago</small> -->
               </div>
            </div>
            <div class="card-body">
               <div class="row gy-3">
                  <div class="col-md-3 col-6">
                     <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-primary me-3 p-2">
                           <i class="ti ti-chart-pie-2 ti-sm"></i>
                        </div>
                        <div class="card-info">
                           <h5 class="mb-0">{{$TEmp}}</h5>
                           <small>Employees</small>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-6">
                     <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-info me-3 p-2">
                           <i class="ti ti-users ti-sm"></i>
                        </div>
                        <div class="card-info">
                           <h5 class="mb-0">{{$TLeave}}</h5>
                           <small>On leave</small>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-6">
                     <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-danger me-3 p-2">
                           <i class="ti ti-shopping-cart ti-sm"></i>
                        </div>
                        <div class="card-info">
                           <h5 class="mb-0">{{$unresolvedTicketCount}}</h5>
                           <small>Pending Tickets</small>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-6">
                     <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                           <i class="ti ti-currency-dollar ti-sm"></i>
                        </div>
                        <div class="card-info">
                           <h5 class="mb-0">{{$TGenderMale}}/{{$TGenderFeMale}}</h5>
                           <small>Male/Female</small>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--/ Statistics -->

        <div class="col-xl-6 col-12">
                  <div class="row">
                    <!-- Expenses -->
                    <div class="col-xl-6 mb-4 col-md-3 col-6">
                      <div class="card">
                         @php
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
                    <div class="col-xl-12 mb-4 col-md-6">
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
                                <h3 class="card-title mb-1"> {{$formattedLeadsGenerated}}</h3>
                                <small class="text-success text-nowrap fw-medium"
                                  ></small
                                >
                              </div>
                            </div>
                            <div id="generatedLeadsChart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--/ Generated Leads -->
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
<!--  <div class="col-xl-6 col-md-12 mb-4" style="300px">
         <div class="card h-100" style="100%">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Employees</h5>
            <small class="text-muted">Yearly Employee Overview</small>
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
                  <h6 class="mb-0">Total Employees</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-3">
                  <small>{{$TEmp}}</small>
                 
                </div>
              </div>
            </li>
         
          </ul>
          <div id="barChart"></div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 389px; height: 401px;"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
    </div> -->
      <!-- Revenue Report -->
       <!--  <div class="col-xl-6 col-12 mb-4" style="300px">
         <div class="card h-100" style="100%">
        <div class="card-body p-0" style="height:100%">
            <div class="row row-bordered g-0">
                <div class="col-md-8 position-relative p-4">
                    <div class="card-header d-inline-block p-0 text-wrap position-absolute">
                        <strong>Work From Home</strong>&nbsp;&nbsp;<span></span>
                    </div>
                    <div id="totalRevenueChart" class="mt-n1"></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Employee Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @if($Team->isNotEmpty())
                                    @foreach($Team as $key => $User)
                                        <tr class="odd">
                                            <td>
                                              {{ $User->id }}
                                            </td>
                                            <td> 
                                            <div class="parent d-flex">
                                                <div class="child1"> @if($User->profile_img)
                                                    <img
                                                        class="rounded-circle"
                                                        style="margin-right: 15px;margin-top: 10px;"
                                                        src="{{ $User->profile_img }}"
                                                        height="30"
                                                        width="30"
                                                        alt="User avatar"
                                                    />
                                                @else
                                                    <img
                                                        class="rounded-circle"
                                                        style="margin-right: 15px;margin-top: 10px;"
                                                        src="{{ url('public/images/21104.png') }}"
                                                        height="30"
                                                        width="30"
                                                        alt="User avatar"
                                                    />
                                                @endif </div>
                                                <div class="child1"> {{ $User->first_name }} {{ $User->last_name }} (#{{ $User->id }}) <br>{{ $User->jobrole }}</div>
                                                </div>
                                           </td>
                                            <td>
                                                @if($User->status == 0)
                                                    <span class="badge bg-label-danger">Incomplete</span>
                                                @elseif($User->status == 1)
                                                    <span class="badge bg-label-success">Active</span>
                                                @elseif($User->status == 2)
                                                    <span class="badge bg-label-warning">Suspended</span>
                                                @elseif($User->status == 3)
                                                    <span class="badge bg-label-warning">Terminated</span>
                                                @elseif($User->status == 4)
                                                    <span class="badge bg-label-danger">Incomplete</span>
                                                @elseif($User->status == 5)
                                                    <span class="badge bg-label-warning">Unverified</span>
                                                @else
                                                    <span>N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">No Record Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 -->
 <!-- <div class="col-12 col-xl-6 mb-4">
         <div class="card">
            <div class="card-body p-0">
               <div class="row row-bordered g-0">
                  <div class="col-md-8 position-relative p-4">
                     <div class="card-header d-inline-block p-0 text-wrap position-absolute">
                        <strong>Assigned Project</strong>&nbsp;&nbsp;<span></span>
                     </div>
                     <div id="totalRevenueChart" class="mt-n1"></div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive text-nowrap">
                        <table class="table table-sm">
                           <thead>
                              <tr>
                                 <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                 <th>Project</th>
                                 <th>Start date</th>
                                 <th>Deadline</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody class="table-border-bottom-0">
                              @foreach($project as $key=> $user)                
                              <tr class="odd">
                                 <td>{{$user->project_name}}</td>
                                 <td>{{$user->start_date}}</td>
                                 <td>{{$user->deadline}}</td>
                                 <td>@switch($user->status_id)
                                    @case('1')
                                    <span class="badge bg-label-primary">In Progress</span>
                                    @break
                                    @case('2')
                                    <span class="badge bg-label-success">Completed</span>
                                    @break
                                    @case('3')
                                    <span class="badge bg-label-warning">Over Due</span>
                                    @break
                                    @case('4')
                                    <span class="badge bg-label-danger">Cancel</span>
                                    @break
                                    @default
                                    <span></span>
                                    @endswitch
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
       -->
      <!--/ Revenue Report -->
      <!-- Earning Reports -->
   <!--  <div class="col-12 col-xl-8 mb-4" style="300px">
         <div class="card h-100" style="100%">
      <div class="card-header">
         <div class="content-left">
            <strong>Task Detail</strong>&nbsp;&nbsp;<span></span>
         </div>
      </div>
      <div class="card-body">
         <div class="table-responsive text-nowrap">
            <table class="table border-top">
               <thead>
                              <tr>
                                 <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                 <th>ID</th>
                                 <th>Task</th>
                                 <th>Assigned To</th>
                                 <th>Start date</th>
                                 <th>End date</th>
                                 <th>Deadline</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                <tbody class="table-border-bottom-0">
                                @foreach($tasks as $task)
                                    <tr class="odd">
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->task_name }}</td>
                                        <td>
                                            <div class="avatar-group d-flex">
                                                <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                                                    @php
                                                        $assignedUserIds = explode(',', $task->assigned_user_id);
                                                        $usersDetails = App\Models\User::whereIn('id', $assignedUserIds)
                                                            ->select('id', 'first_name', 'last_name', 'profile_img')
                                                            ->get();
                                                    @endphp
                                                    @foreach($usersDetails as $userDetail)
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="{{ $userDetail->first_name }}">
                                                            <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{ isset($userDetail->profile_img) ? $userDetail->profile_img : url('public/images/21104.png') }}" height="30" width="30" alt="User avatar" />
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                        <td>{{ $task->startDate }}</td>
                                        <td>{{ $task->endDate }}</td>
                                        <td>{{ $task->deadline }}</td>
                                        <td>
                                            @switch($task->status_id)
                                                @case(1)
                                                    <span class="badge bg-label-primary">In Progress</span>
                                                    @break
                                                @case(2)
                                                    <span class="badge bg-label-success">Completed</span>
                                                    @break
                                                @case(3)
                                                    <span class="badge bg-label-warning">Over Due</span>
                                                    @break
                                                @case(4)
                                                    <span class="badge bg-label-danger">Cancel</span>
                                                    @break
                                                @default
                                                    <span></span>
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
            </table>
         </div>
      </div>
   </div>
</div> -->
               <!-- Revenue Report -->
                <div class="col-sm-6 col-xl-8 mb-4" style="260px">
         <div class="card h-100" style="100%">
            <div class="card-header">
               <div class="content-left">
                 <strong>Timesheet</strong>&nbsp;&nbsp;<span></span>
               </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                   <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                  
                  
                  
                                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                <th>ID</th>
                                <th>Shift Name</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Shift Assigned</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @if(count($TimeSheet) > 0)
                            @foreach($TimeSheet as $key=> $user)
                            @php
                                $users = \App\Models\User::select('users.first_name', 'users.profile_img')
                                ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
                                ->where('employee_details.shift_id', $user->id)
                                ->get();
                            @endphp
                            <tr class="odd">
                                <td>{{ $key+1 }} </td>
                                <td>{{ $user->shift_name }}</td>
                                <td>{{ $user->StartTime }}</td>
                                <td>{{ $user->EndTime }}</td>
                                <td>
                                    <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-1">
                                      @foreach($users as $useraa)
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="{{$useraa->first_name}}">
                                        <img class="rounded-circle" src="{{$useraa->profile_img}}" alt="Avatar">
                                      </li>
                                      @endforeach()
                                    </ul>
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
    </div>
                <!--/ Revenue Report -->
     
      <!--/ Popular Product -->
       <!--upcoming event-->
         <div class="col-xl-4 mb-4 col-md-4 col-6" style="height:500px">
                 <div class="card" style="height:100%;overflow:scroll"> 
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title m-0 me-2 d-flex" style="width:100%">
                        <h5 class="m-0 me-2">Upcoming Events</h5>

                          <a href="{{url('Employee/Calendar/home')}}" type="button" class="btn-primary rounded f-14 p-2 btn-sm" style="margin-left:40%">See

            More</a>
                      </div>
                    
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        @foreach($upcomingEvents as $Product)
                        <li class="d-flex mb-4 pb-1">
                          <div class="me-3">
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                    <div class="parent d-flex">
                                               User: <div class="child1"> @if($Product->profile_img)
                                                    <img
                                                        class="rounded-circle"
                                                        style="margin-right: 15px;margin-top: 10px;"
                                                        src="{{ $Product->profile_img }}"
                                                        height="30"
                                                        width="30"
                                                        alt="User avatar"
                                                    />
                                                @else
                                                    <img
                                                        class="rounded-circle"
                                                        style="margin-right: 15px;margin-top: 10px;"
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
      <!-- Sales by Countries tabs-->
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
      <!--/ Sales by Countries tabs -->
      <!-- Transactions -->
         <div class="col-xl-4 col-md-6 mb-4"  style="height:500px">
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
                        <span class="avatar-initial rounded bg-label-primary">
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
         <div class="col-xl-6 col-12 mb-4" style="300px">
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

      <div class="col-xl-4 col-md-6 mb-4"  style="200px">
         <div class="card h-100" style="100%">
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
                        <span class="avatar-initial rounded bg-label-primary">
                        @if($user && $user->profile_img)
                        <img src="{{$user ? $user->profile_img : ''}}" class="rounded-circle">
                        @else
                        <span class="avatar-initial rounded"></span>
                        @endif
                        </span>
                     </div>
                     <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2" style="margin-left: 20px;">
                        <div class="me-2">
                           <h6 class="mb-0">{{$user->first_name}}</h6>
                           <small class="text-muted">{{$user->name}}</small>
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
      <div class="col-xl-4 col-md-6 mb-4"  >
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
          if ($workingHoursData && $workingHoursData->working_days > 0) {
              if (is_numeric($workingHoursData->total_hours) && is_numeric($workingHoursData->working_days)) {
                  $averageHoursPerDay = $workingHoursData->total_hours / $workingHoursData->working_days;
                  $shiftHours = $workingHoursData->shift_hours;

                  if (is_numeric($shiftHours) && $shiftHours > 0) {
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
              } else {
                  // Handle the case where total_hours or working_days are not numeric
                  // For example, log an error message or set a default value
                  Log::error('Non-numeric value encountered in working hours data', [
                      'total_hours' => $workingHoursData->total_hours,
                      'working_days' => $workingHoursData->working_days,
                  ]);
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


  


      <!-- /Invoice table -->
   </div>
</div>
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
    // Get and format working hours
    var workingHours = '{{$TimeShift->working_hours}}'; // Ensure this variable is correctly passed from Laravel
    var WorkingHoursInSeconds = calculateTotalSeconds(parseTime(workingHours));
    var grandTotalSeconds = 0;
    var totalBreakSeconds = 0;

    $('.odd').each(function (index) {
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

    // Calculate overall times
    var overallTime = grandTotalSeconds;
    var breakTime = totalBreakSeconds;
    var workingTime = overallTime - breakTime;

    // Display time calculations
    $('#grand-total-time').text(formatTotalTime(grandTotalSeconds) || '00:00');
    $('#BreakTime').text(formatTotalTime(totalBreakSeconds) || '00:00');

    var overtime = Math.max(0, grandTotalSeconds - WorkingHoursInSeconds);
    var pendingTime = 0; // No calculation for pending time in this code
    var extraWorkingTime = grandTotalSeconds - WorkingHoursInSeconds;

    $('#Overtime').text(formatTotalTime(overtime) || '00:00');
    $('#PendingTime').text(formatTotalTime(pendingTime) || '00:00');
    $('#ExtraWorkingTime').text(formatTotalTime(extraWorkingTime) || '00:00');
    $('#ShiftHours').text(formatTotalTime(WorkingHoursInSeconds) || '00:00');
    // Call chart rendering functions
    renderRadialBarChart();
    renderExpensesRadialChart();
    renderPerformanceChart();
    truncateKRAContent();
    renderBarChart();
});

function renderRadialBarChart() {
    const radialBarChartEl = document.querySelector('#radialBarChart');
    if (!radialBarChartEl) return;

    const radialBarChartConfig = {
        chart: {
            height: 380,
            type: 'radialBar'
        },
        colors: [config.colors.success, '#28c76fb3', config.colors_label.success],
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
                        color: config.colors.bodyColor,
                        fontFamily: 'Public Sans'
                    },
                    total: {
                        show: true,
                        fontWeight: 400,
                        fontSize: '1.3rem',
                        color: config.colors.headingColor,
                        label: 'Net Profit',
                        formatter: function () {
                            return "{{$netProfitPercentageChange}} %";
                        }
                    }
                }
            }
        },
        grid: {
            borderColor: config.colors.borderColor,
            padding: {
                top: -25,
                bottom: -20
            }
        },
        legend: {
            show: true,
            position: 'bottom',
            labels: {
                colors: config.colors.bodyColor,
                useSeriesColors: false
            }
        },
        stroke: {
            lineCap: 'round'
        },
        series: ["{{$netProfitPercentageChange}}", "{{$totalIncomePercentageChange}}", "{{$totalExpensesPercentageChange}}"],
        labels: ['Net Profit', 'Total Income', 'Total Expenses']
    };

    const radialChart = new ApexCharts(radialBarChartEl, radialBarChartConfig);
    radialChart.render();
}

function renderExpensesRadialChart() {
    const expensesRadialChartEl = document.querySelector('#expensesChart');
    if (!expensesRadialChartEl) return;

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
        series: [percentage],
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
                    background: config.colors.borderColor
                },
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        fontSize: '22px',
                        color: config.colors.headingColor,
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
        labels: ['Progress']
    };

    const expensesRadialChart = new ApexCharts(expensesRadialChartEl, expensesRadialChartConfig);
    expensesRadialChart.render();
}

function renderPerformanceChart() {
    const performanceChartEl = document.querySelector('#performanceChart');
    if (!performanceChartEl) return;

    const percentageScore = "{{$calpercnt}}";
    const performanceChartConfig = {
        chart: {
            height: 250,
            type: 'radialBar'
        },
        series: [percentageScore],
        labels: ['Performance Score'],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%'
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
                        textAnchor: 'middle'
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
                        }
                    }
                }
            }
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
                stops: [0, 100]
            }
        },
        stroke: {
            dashArray: 4
        },
        colors: ['#00b0f0']
    };

    const performanceChart = new ApexCharts(performanceChartEl, performanceChartConfig);
    performanceChart.render();
}

function truncateKRAContent() {
    $('.KRA-content').each(function() {
        var maxLength = 180;
        var myStr = $(this).text();
        if ($.trim(myStr).length > maxLength) {
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append(' <a href="javascript:void(0);" class="read-more">(more)</a>');
        }
    });
}

function renderBarChart() {
    const chartEl = document.querySelector('#barChart');
    if (!chartEl) return;

    const barChartConfig = {
        chart: {
            height: 400,
            type: 'bar'
        },
        plotOptions: {
            bar: {
                horizontal: true
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 1,
            colors: ['#fff']
        },
        series: [{
            data: [40, 55, 75, 81, 56, 48, 61, 62, 60, 58, 47, 39]
        }],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        }
    };

    const barChart = new ApexCharts(chartEl, barChartConfig);
    barChart.render();
}

 // Helper functions
    function calculateTimeDifference(start, end) {
        if (!start || !end) {
            return moment.duration(0); // Return a duration of 0 if any time is missing
        }
        var startTime = moment(start, 'HH:mm:ss a');
        var endTime = moment(end, 'HH:mm:ss a');
        return moment.duration(endTime.diff(startTime));
    }

    function formatTimeDifference(duration) {
        var hours = duration.hours();
        var minutes = duration.minutes();
        var seconds = duration.seconds();
        return `${padZero(hours)}:${padZero(minutes)}:${padZero(seconds)}`;
    }

    function calculateTotalSeconds(duration) {
        if (!duration) {
            return 0; // Return 0 if duration is invalid
        }
        return duration.hours() * 3600 + duration.minutes() * 60 + duration.seconds();
    }

    function formatTotalTime(totalSeconds) {
        if (totalSeconds < 0) {
            totalSeconds = 0; // Ensure no negative time values
        }
        var hours = Math.floor(totalSeconds / 3600);
        var minutes = Math.floor((totalSeconds % 3600) / 60);
        var seconds = totalSeconds % 60;
        return `${padZero(hours)}:${padZero(minutes)}:${padZero(seconds)}`;
    }

    function parseTime(timeStr) {
        var timeParts = timeStr.split(':');
        return moment.duration({
            hours: timeParts[0],
            minutes: timeParts[1],
            seconds: timeParts[2]
        });
    }

    function padZero(value) {
        return value < 10 ? `0${value}` : value;
    }
function parseTime(timeStr) {
    var timeParts = timeStr.split(':');
    return moment.duration({
        hours: timeParts[0],
        minutes: timeParts[1],
        seconds: timeParts[2]
    });
}

</script>

@endsection