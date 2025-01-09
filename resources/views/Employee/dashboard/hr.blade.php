@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<!-- Content -->

<div id="toast-container" class="toast-top-right">
  <div class="toast toast-success" aria-live="polite">
    <div class="toast-progress" style="width: 0%;"></div>
    <div class="toast-message">
      <i class="fas fa-hand-peace"></i>  Welcome To CloudTechtiq !
    </div>
  </div>
</div>
<div class="container-xxl flex-grow-1 container-p-y">
   <!-- CLOCK IN CLOCK OUT START -->
      <div class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 m mt-4 mt-lg-0 mt-md-0 justify-content-between">
        <p class="mb-0 text-lg-right text-md-right f-18 font-weight-bold text-dark-grey d-grid align-items-center text-end" style="padding-right:15px;">
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
         <button type="button" class="btn-primary rounded f-15 ml-4" id="clockin1" value="clockin" onclick="clock({{auth()->id()}},value)" 
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>
        </button>
        @else
        <button type="button" class="btn-danger rounded f-15 ml-4" id="clockout1" value="clockout" onclick="clock({{auth()->id()}},value)"
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>
        </button>
        @endif
        <button type="button" class="btn-danger rounded f-15 ml-4" id="clockout" value="clockout" onclick="clock({{auth()->id()}},value)"
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;display: none;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>
        </button>
        <button type="button" class="btn-primary rounded f-15 ml-4" id="clockin" value="clockin" onclick="clock({{auth()->id()}},value)" 
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;display: none;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>
        </button>
      </div>
      <!-- CLOCK IN CLOCK OUT END -->
  <div class="row">
    <!-- Website Analytics -->
    <!-- Upper_Clock_Info  -->
    <div class="d-lg-flex d-md-flex d-block py-2 pb-2 align-items-center justify-content-between">
      <!-- WELOCOME NAME START -->
      <div>
        <h3 class="heading-h3 mb-0 f-21 font-weight-bold">Welcome {{Auth::user()->first_name}}</h3>
      </div>
      <!-- WELOCOME NAME END -->
     
    </div>
    <div class="col-lg-6 mb-4">
      <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg" id="swiper-with-pagination-cards">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="row">
            <div class="col-12">
              <h5 class="text-white mb-0 mt-2">{{Auth::user()->first_name}}</h5>
              <small>HR</small></br>
              <small>Employee ID: Emp-{{Auth::user()->id}}</small>
            </div>
            <div class="row">
              <!-- <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                <h6 class="text-white mt-0 mt-md-3 mb-3">Overview</h6>
                <div class="row">
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-4 align-items-center">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg"></p>
                        <p class="mb-0">Open Tasks</p>
                      </li>
                      <li class="d-flex align-items-center mb-2">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg"></p>
                        <p class="mb-0">Projects</p>
                      </li>
                    </ul>
                  </div>
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-4 align-items-center">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg"></p>
                        <p class="mb-0">Open Tickets</p>
                      </li>
                      <li class="d-flex align-items-center mb-2">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">12%</p>
                        <p class="mb-0">Averave response rate</p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div> -->
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
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="grand-total-time" style="min-width: 72px;">0</p>
                      <p class="mb-0">Total Duration</p>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="BreakTime" style="min-width: 72px;">0</p>
                      <p class="mb-0">Total Interval</p>
                    </li>
                  </ul>
                </div>
                <div class="col-6">
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex mb-4 align-items-center">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ExtraWorkingTime" style="min-width: 72px;">0</p>
                      <p class="mb-0">Overtime</p>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg"id="ShiftHours" style="min-width: 72px;">0k</p>
                      <p class="mb-0">Shift Hours</p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
              <img
              src="{{url('public/logo/clock.png')}}"
              alt="Website Analytics"
              width="170"
              class="card-website-analytics-img" style="border-radius: 50%;"/>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
      </div>
    </div>
    <!--/ Website Analytics -->
    <div class="col-lg-6 mb-4">
      <div class="row">
        <div class="col-sm-6 mb-3">
           <a class="text-dark" href="{{url('admin/Client/home')}}">
              <div class="card">
                 <div class="card-body">
                    <div class="d-flex ">
                       <div class="content-left">
                          <div class="d-flex">
                          <a href="javascript:;" class="total-employees" data-status="open"><p class="mb-1 f-15 font-weight-bold text-blue d-grid mr-5">
                              {{$TEmp}}
                              <br>
                              <span class="f-12 font-weight-normal text-dark">
                                  Total Employees</span></p>
                          </a>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="javascript:;" class="total-new-employees" data-status="resolved"><p class="mb-1 f-15 font-weight-bold text-dark-green d-grid ml-3">
                              {{$TPresent}}
                              <br>
                              <span class="f-12 font-weight-normal text-dark">Total Attendance</span></p></a>
                      </div>
                       </div>
                    </div>
                 </div>
              </div>
           </a>
        </div>
        <div class="col-sm-6 mb-3">
           <a class="text-dark" href="{{url('admin/Client/home')}}">
              <div class="card">
                 <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                       <div class="content-left">
                          <span>Suspended Employee</span>
                          <div class="d-flex align-items-center">
                             <h3 class="mb-0 me-2"></h3>
                             <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">{{$TESuspended}}</p>
                       </div>
                       <div class="">
                          <span class="">
                          <i class="fas fa-sign-out-alt mt-3"></i>
                          </span>
                       </div>
                    </div>
                 </div>
              </div>
           </a>
        </div>
        <div class="col-sm-6">
           <a class="text-dark" href="{{url('admin/Client/home')}}">
              <div class="card">
                 <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                       <div class="content-left">
                          <span>Terminated Employee</span>
                          <div class="d-flex align-items-center my-2">
                             <h3 class="mb-0 me-2"></h3>
                             <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">{{$TETerminated}}</p>
                       </div>
                       <div class="">
                          <span class="">
                          <i class="fas fa-wave-square mt-3"></i>
                          </span>
                       </div>
                    </div>
                 </div>
              </div>
           </a>
        </div>
        <div class="col-sm-6">
           <a class="text-dark" href="{{url('admin/Client/home')}}">
              <div class="card">
                 <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                       <div class="content-left">
                          <span>Active Employees</span>
                          <div class="d-flex align-items-center my-2">
                             <h3 class="mb-0 me-2"></h3>
                             <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">{{$TEActive}}</p>
                       </div>
                       <div class="">
                          <span class="">
                          <i class="fas fa-fingerprint mt-3"></i>
                          </span>
                       </div>
                    </div>
                 </div>
              </div>
           </a>
        </div>  
      </div>  
    </div>
  </div>
    <div class="row">
        <div class="col-sm-6 col-xl-6 mb-4">
         <div class="card bg-white border-0 b-shadow-4"  style="height: 384px;">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <h4 class="f-18 f-w-500 mb-0">Department Wise Employee</h4>
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
                        @foreach($HREmpDepartment as $key => $HREmpDepartment)
                        <tr>
                           <td>{{ $key+1 }}</td>
                           <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$HREmpDepartment->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$HREmpDepartment->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$HREmpDepartment->email}}</div>
                          </td>
                           <td>@if($HREmpDepartment && $HREmpDepartment->dptname) {{ $HREmpDepartment->dptname }} @endif</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
            </div>
         </div>
        </div>
        <div class="col-sm-6 col-xl-6 mb-4">
          <div class="card bg-white border-0 b-shadow-4"  style="height: 384px;">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <h4 class="f-18 f-w-500 mb-0">Designation Wise Employee</h4>
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
                        @foreach($HREmpDesignation as $key => $HREmpDesignation)
                        <tr>
                           <td>{{ $key+1 }}</td>
                           <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$HREmpDesignation->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$HREmpDesignation->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$HREmpDesignation->email}}</div>
                          </td>
                           <td>@if($HREmpDesignation && $HREmpDesignation->desname) {{ $HREmpDesignation->desname }} @endif</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
            </div>
         </div>
        </div>
        <div class="col-sm-6 col-xl-6 mb-4">
          <div class="card bg-white border-0 b-shadow-4" style="height: 384px;">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <h4 class="f-18 f-w-500 mb-0">Late Attendance</h4>
               </div>
               <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
                 <table class="table table-sm">
                     <thead>
                        <tr>
                           <th>Id</th>
                           <th>Profile</th>
                           <th>Emp Id</th>
                           <th>Actually Working</th>
                           <th>Shift Hours</th>
                           <th>Total Hours</th>
                           <!-- <th>Status</th> -->
                        </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                        @foreach($HRLateattendence as $key => $HRLateattendence)
                        <tr>
                           <td>{{ $key+1 }}</td>
                           <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$HRLateattendence->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$HRLateattendence->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$HRLateattendence->email}}</div>
                          </td>
                           <td>@if($HRLateattendence && $HRLateattendence->emp_id) {{ $HRLateattendence->emp_id }} @endif</td>
                           <td>@if($HRLateattendence && $HRLateattendence->actualworkinghours) {{ $HRLateattendence->actualworkinghours }} @endif</td>
                           <td>@if($HRLateattendence && $HRLateattendence->shifthours) {{ $HRLateattendence->shifthours }} @endif</td>
                           <td>@if($HRLateattendence && $HRLateattendence->total_hours) {{ $HRLateattendence->total_hours }} @endif</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-6 mb-4">
         <div class="card bg-white border-0 b-shadow-4"  style="height: 384px;">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <h4 class="f-18 f-w-500 mb-0">Role Wise Employee</h4>
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
                        @foreach($HREmpRole as $key => $HREmpRole)
                        <tr>
                           <td>{{ $key+1 }}</td>
                           <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$HREmpRole->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$HREmpRole->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$HREmpRole->email}}</div>
                          </td>
                           <td>@if($HREmpRole && $HREmpRole->rolename) {{ $HREmpRole->rolename }} @endif</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
              </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-6 mb-4">
          <div class="card bg-white border-0 b-shadow-4"  style="height: 384px;">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <h4 class="f-18 f-w-500 mb-0">Leaves Taken</h4>
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
                        @foreach($HREmpLeave as $key => $HREmpLeave)
                        <tr>
                           <td>{{ $key+1 }}</td>
                           <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$HREmpLeave->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$HREmpLeave->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$HREmpLeave->email}}</div>
                          </td>
                           <td>@if($HREmpLeave && $HREmpLeave->date) {{ $HREmpLeave->date }} @endif</td>
                           <td>
                               @if($HREmpLeave->duration == 1)
                                   {{ 'Full Day' }}
                               @elseif($HREmpLeave->duration == 2)
                                   {{ 'Multiple' }}
                               @elseif($HREmpLeave->duration == 3)
                                   {{ 'First Half' }}
                               @elseif($HREmpLeave->duration == 4)
                                   {{ 'Second Half' }}
                               @endif
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
            </div>
         </div>
        </div>
        <div class="col-sm-6 col-xl-6 mb-4">
           <div class="card bg-white border-0 b-shadow-4" style="height: 384px;">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <h4 class="f-18 f-w-500 mb-0">Events</h4>
               </div>
              <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
                 <table class="table table-sm">
                     <thead>
                        <tr>
                           <th>Emp Id</th>
                           <th>Profile</th>
                           <th>Birthday</th>
                           <!-- <th>Status</th> -->
                        </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                        @foreach($HREmpEvent as $key => $HREmpEvent)
                        <tr>
                           <td>{{ $key+1 }}</td>
                           <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$HREmpEvent->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$HREmpEvent->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$HREmpEvent->email}}</div>
                          </td>
                           <td>@if($HREmpEvent && $HREmpEvent->dob) {{ $HREmpEvent->dob }} @endif</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
        </div>
            </div>
        </div>
    </div>
  
</div>

<!--/ Total Duration start-->

@foreach($Attendence as $key => $att)
  <div class="odd">
    <input type="hidden" class="punch-in{{$key+1}}" value="{{ $att->punch_in }}">
    <input type="hidden" class="punch-out{{$key+1}}" value="@if($att && $att->punch_out){{ $att->punch_out }} @else {{ \Carbon\Carbon::now()->format('H:i:s') }} @endif ">
    <input type="hidden" class="total-time{{$key+1}}" value="">
  </div>
@endforeach

<script>
 $(document).ready(function() {
  var workingHours = '{{$TimeShift->working_hours}}'; // Set your working hours
  var WorkingHoursInSeconds = calculateTotalSeconds(parseTime(workingHours));
  var grandTotalSeconds = 0;
  var totalBreakSeconds = 0;

  // Loop through each odd entry
  $('.odd').each(function(index) {
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
  $('#BreakTime').text(formatTotalTime(totalBreakSeconds));

  // Calculate and display overtime, pending time, and extra working time
  var overtime = 0;
  var pendingTime = 0;
  var extraWorkingTime = 0;

  if (WorkingHoursInSeconds) {
    extraWorkingTime = grandTotalSeconds - WorkingHoursInSeconds;

    // Only display overtime if it is greater than zero
    if (extraWorkingTime > 0) {
      overtime = extraWorkingTime;
    } else {
      overtime = 0;
    }
  }

  $('#Overtime').text(formatTotalTime(overtime));
  $('#PendingTime').text(formatTotalTime(pendingTime));
  $('#ExtraWorkingTime').text(formatTotalTime(extraWorkingTime));
  $('#ShiftHours').text(formatTotalTime(WorkingHoursInSeconds));

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


  function clock(id,value) {
    if(value == 'clockin'){
      clockStatusUpdate(id,value);
    }
    else if(value == 'clockout'){
      clockStatusUpdate(id,value);
    }
    window.location.reload();
  }

function clockStatusUpdate(id, value) {
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

@endsection