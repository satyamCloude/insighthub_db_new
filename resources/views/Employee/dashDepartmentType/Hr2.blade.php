@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<style>
  .blurred {
    filter: blur(2px); /* Adjust the blur intensity as needed */
    pointer-events: none; /* Disable interactions with the button */
    opacity: 0.5; /* Optional: adjust opacity to visually indicate disabled state */
  }

  .spinner {
    border: 2px solid #f3f3f3; /* Light grey */
    border-top: 2px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 1s linear infinite;
    display: none; /* Hide spinner by default */
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
      <div class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 mt-4 mt-lg-0 mt-md-0 justify-content-end" style="justify-content: flex-end !important;">
        <p class="mb-0 text-lg-right text-md-right f-15 font-weight-bold text-dark-grey d-grid align-items-center text-end" style="padding-right:10px;">
          <input type="hidden" id="current-latitude" name="current_latitude" autocomplete="off">
          <input type="hidden" id="current-longitude" name="current_longitude" autocomplete="off">
          <span class="f-10 font-weight-light">{{ \Carbon\Carbon::now()->format('l')}}</span>
          <span id="dashboard-clock" style="font-weight: 700;">{{ \Carbon\Carbon::now()->format('h:i A') }}</span>
          <span class="f-11 font-weight-normal text-lightest" style="color:#b4b2bb !important;">
            Clock In at -
            <span>@if($CheckInTime && $CheckInTime->punch_in) {{ \Carbon\Carbon::parse($CheckInTime->punch_in)->format('h:i A') }}@else 00:00:00  @endif</span>
          </span>
        </p>
        @if(Auth::user()->clock_status == 1)
        <button type="button" class="btn-danger rounded f-15 ml-4" id="clockout1" value="clockout" onclick="clock({{auth()->id()}},value)"
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>
          <div class="spinner" id="clockout-spinner"></div>
        </button>
        @else
        <button type="button" class="btn-primary rounded f-15 ml-4" id="clockin1" value="clockin" onclick="clock({{auth()->id()}},value)" 
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>
          <div class="spinner" id="clockin-spinner"></div>
        </button>
        @endif
      </div>
      <!-- CLOCK IN CLOCK OUT END -->

      </div>
      <!-- View sales -->
   
      
      <!-- View sales -->
      
      <div class="col-xl-6 mb-4 col-lg-6 col-12">
         <!--<div class="card">-->
         <!--   <div class="d-flex align-items-end row">-->
              
         <!--      <div class="col-7">-->
         <!--         <div class="card-body text-nowrap">-->
         <!--            <h5 class="card-title mb-0">Welcome {{Auth::user()->first_name}} -->
         <!--               ! 🎉</h5>-->
         <!--            @if($previousYearBestSellerEmployee &&  $previousYearBestSellerEmployee->id == Auth::user()->id) <p class="mb-2">Congratulations, You are the Best seller of the month</p>@endif-->
         <!--            <h4 class="text-primary mb-1">{{$currentMonthEmpPrice}}</h4>-->
         <!--            <a href="javascript:void(0);" class="btn btn-primary">View Sales</a>-->
         <!--         </div>-->
         <!--      </div>-->
         <!--      <div class="col-5 text-center text-sm-left">-->
         <!--         <div class="card-body pb-0 px-0 px-md-4">-->
         <!--            <img-->
         <!--            src="../public/assets/img/illustrations/card-advance-sale.png"-->
         <!--            height="140"-->
         <!--            alt="view sales" />-->
         <!--         </div>-->
         <!--      </div>-->
         <!--   </div>-->
         <!--</div>-->

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

                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ShiftHours"

                          style="min-width: 72px;">{{ $OpenTask}}</p>

                          <p class="mb-0">Open Tasks</p>

                        </li>

                        <li class="d-flex align-items-center mb-2">

                           <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ShiftHours"

                          style="min-width: 72px;">{{$currentMonthEmpPrice}}</p>

                          <p class="mb-0">Total Sales</p>

                        </li>

                      </ul>

                    </div>

                    <div class="col-6">

                      <ul class="list-unstyled mb-0">

                        <li class="d-flex mb-4 align-items-center">

                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ShiftHours"

                          style="min-width: 72px;">{{$OpenTicket}}</p>

                          <p class="mb-0">Open Tickets</p>

                        </li>

                        <li class="d-flex mb-4 align-items-center">
   @if($averageResponseTime && $averageResponseTime != 'N/A')
                             <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ShiftHours"

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

                width="140" height="100"

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

  <!-- View sales -->

  <!-- View sales -->

      <!-- View sales -->
      <!-- Statistics -->  
      
     
      <div class="col-xl-6 mb-4 col-lg-7 col-12 mb-4" style="300px">
         <div class="card h-100" style="100%">
            <div class="card-header">
               <div class="d-flex justify-content-between mb-3">
                  <h5 class="card-title mb-0">Statistics</h5>
                  <small class="text-muted">Updated 1 month ago</small>
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
                           <h5 class="mb-0">1.423k</h5>
                           <small>Salary Paid</small>
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
         
 <div class="col-xl-6 col-md-12 mb-4" style="300px">
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
                  <!--<div class="d-flex align-items-center gap-1">-->
                  <!--  <i class="ti ti-chevron-up text-success"></i>-->
                  <!--  <small class="text-muted">18.6%</small>-->
                  <!--</div>-->
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
    </div>
      <!-- Revenue Report -->
        <div class="col-xl-6 col-12 mb-4" style="300px">
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

      <!--/ Revenue Report -->
      <!-- Earning Reports -->
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

 <div class="col-12 col-xl-6 mb-4" style="height:300px">
         <div class="card" style="height:100%;"> 
            <div class="card-body p-0">
               <div class="row row-bordered g-0">
                  <div class="col-md-8 position-relative p-4">
                     <div class="card-header d-inline-block p-0 text-wrap position-absolute">
                        <strong>Pending leave request</strong>&nbsp;&nbsp;<span></span>
                     </div>
                     <div id="totalRevenueChart" class="mt-n1"></div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive text-nowrap">
                        <table class="table table-sm">
                           <thead>
                              <tr>
                                 <th>ID</th>
                              <th>Employee</th>
                              <th>Leave Date</th>
                              <th>Duration</th>
                              <th>Leave Type</th>
                            
                              </tr>
                           </thead>
                           <tbody class="table-border-bottom-0">
                              @if(count($requestedLeaves) > 0)
          @foreach($requestedLeaves as $key=> $user)
           <!-- //employee -->
           
             <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->first_name }}</td>
                  <td>@if($user && $user->date) {{ $user->date }} @else {{ $user->start_date }} @endif </td>
                  <td>
                      @if($user->duration == 1)
                          {{ 'Full Day' }}
                      @elseif($user->duration == 2)
                          {{ 'Multiple' }}
                      @elseif($user->duration == 3)
                          {{ 'First Half' }}
                      @elseif($user->duration == 4)
                          {{ 'Second Half' }}
                      @endif </td> <td>{{ $user->leave_type }}</td> 
                    
                     <td>

                  
                    
                 
                              </tr>
                              @endforeach
                              @endif
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-4 mb-4 col-md-4 col-6" style="height:400px">
                 <div class="card" style="height:100%;"> 
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title m-0 me-2">
                        <h5 class="m-0 me-2">Upcomming Followups</h5>
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
                              <!-- <small class="text-muted d-block">{{$Product->id}}</small> -->
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
      <!--/ Popular Product -->
      <!-- Sales by Countries tabs-->
      <div class="col-md-6 col-xl-4 col-xl-4 mb-4" style="height:400px">
                 <div class="card" style="height:100%;"> 
                <div class="card-header d-flex justify-content-between pb-2 mb-1">
                    <div class="card-title mb-1">
                        <h5 class="m-0 me-2">KRA</h5>
                        <p class=" truncated-kra">{!! $kra->kra !!}</p>

                    </div>
                </div>
                <div class="card-body">
                    <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#fullKRAModal">Read More</a>
                </div>
            </div>
        </div>
      <!--/ Sales by Countries tabs -->
      <!-- Transactions -->
      <div class="col-xl-4 col-md-6 mb-4"  style="height:400px">
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


  

      <!-- /Invoice table -->
   </div>
</div>

<!--<div id="loader" style="display: none;">-->
<!--    <div class="spinner"></div>-->
<!--</div>-->
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

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

    function clock(id, value) {
      // Show the spinner next to the button
      if (value === 'clockin') {
        document.getElementById('clockin-spinner').style.display = 'block';
      } else if (value === 'clockout') {
        document.getElementById('clockout-spinner').style.display = 'block';
      }

      // Perform the clock status update
      clockStatusUpdate(id, value);
    }

    function clockStatusUpdate(id, value) {
      $.ajax({
        url: "{{ url('Employee/ClockStatusUpdate') }}",
        method: 'GET',
        data: { id: id, value: value },
        success: function(response) {
          if (response && response.data && response.data.clock_status !== undefined) {
            const clockStatus = response.data.clock_status;

            // Update button states based on clock status
            if (clockStatus === 0) {
              $('#clockin').hide();
              $('#clockout').show();
              $('#clockin1').hide();
              $('#clockout1').hide();
              $('#clockout').addClass('blurred');
            } else if (clockStatus === 1) {
              $('#clockin').show();
              $('#clockout').hide();
              $('#clockin1').hide();
              $('#clockout1').hide();
              $('#clockin').addClass('blurred');
            }

            // Hide the spinner and reload the page after 2 seconds
            setTimeout(function() {
              if (value === 'clockin') {
                document.getElementById('clockin-spinner').style.display = 'none';
              } else if (value === 'clockout') {
                document.getElementById('clockout-spinner').style.display = 'none';
              }
              window.location.reload();
            }, 2500);
          } else {
            console.error('Invalid response format');
            if (value === 'clockin') {
              document.getElementById('clockin-spinner').style.display = 'none';
            } else if (value === 'clockout') {
              document.getElementById('clockout-spinner').style.display = 'none';
            }
          }
        },
        error: function(xhr, status, error) {
          console.error('AJAX request failed:', status, error);
          alert('Error occurred during the request');
          if (value === 'clockin') {
            document.getElementById('clockin-spinner').style.display = 'none';
          } else if (value === 'clockout') {
            document.getElementById('clockout-spinner').style.display = 'none';
          }
        }
      });
    }



        // Get the original KRA content
        var originalKRA = $('.card-title .ql-editor ').text();
        // Check if the length of the KRA content is greater than 50 characters
        if (originalKRA.length > 50) {
            // Truncate the KRA content to 50 characters and append '...'
            var truncatedKRA = originalKRA.substr(0, 50) + '...';
            // Replace the original content with the truncated content
            $('.card-title .ql-editor ').text(truncatedKRA);
        }
        
        
        
        $(document).ready(function(){
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
        // Color constants for the chart
        const chartColors = {
            joined: '#826af9',    // Series color for joined employees
            resigned: '#f25961'   // Series color for resigned employees
        };

        // Data from PHP variables
        const joinedEmployees = @json($joinedEmployees);
        const resignedEmployees = @json($resignedEmployees);
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Configuration for ApexCharts
        const barChartConfig = {
            chart: {
                height: 400,
                type: 'bar',
                stacked: true,
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '15%',
                    colors: {
                        backgroundBarColors: [
                            '#f8d3ff', '#f8d3ff', '#f8d3ff', '#f8d3ff', '#f8d3ff', '#f8d3ff',
                            '#f8d3ff', '#f8d3ff', '#f8d3ff', '#f8d3ff', '#f8d3ff', '#f8d3ff'
                        ],
                        backgroundBarRadius: 10
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'start',
                labels: {
                    colors: '#4e4e4e',
                    useSeriesColors: false
                }
            },
            colors: [chartColors.joined, chartColors.resigned],
            stroke: {
                show: true,
                colors: ['transparent']
            },
            grid: {
                borderColor: '#f1f3fa',
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            series: [
                {
                    name: 'Joined Employees',
                    data: joinedEmployees
                },
                {
                    name: 'Resigned Employees',
                    data: resignedEmployees
                }
            ],
            xaxis: {
                categories: months,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: '#4e4e4e',
                        fontSize: '13px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#4e4e4e',
                        fontSize: '13px'
                    }
                }
            },
            fill: {
                opacity: 1
            }
        };

        // Initialize ApexCharts
        const barChartEl = document.querySelector('#barChart');
        if (barChartEl !== null) {
            const barChart = new ApexCharts(barChartEl, barChartConfig);
            barChart.render();
        }
    });
     
    document.addEventListener('DOMContentLoaded', function() {
        let cardColor, labelColor, headingColor, borderColor, legendColor;
        const isDarkStyle = document.body.classList.contains('dark-style');

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

        const chartColors = {
            donut: {
                series1: config.colors.success,
                series2: '#28c76fb3',
                series3: '#28c76f80',
                series4: config.colors_label.success
            }
        };


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
});

</script>

@endsection