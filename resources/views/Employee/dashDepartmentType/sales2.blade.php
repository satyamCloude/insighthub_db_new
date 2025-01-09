@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

   <div class="row">
      <!-- View sales -->
      <div class="col-xl-8 mb-4 col-lg-5 col-12"></div>
      <div class="col-xl-4 mb-4 col-lg-5 col-12">
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
        <button type="button" class="btn-danger rounded f-15 ml-4" id="clockout1" value="clockout" onclick="clock({{auth()->id()}},value)"
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>
        </button>
        @else
        <button type="button" class="btn-primary rounded f-15 ml-4" id="clockin1" value="clockin" onclick="clock({{auth()->id()}},value)" 
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>
        </button>
        @endif
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
      <div class="col-xl-4 mb-4 col-lg-5 col-12">
         <div class="card">
            <div class="d-flex align-items-end row">
              
               <div class="col-7">
                  <div class="card-body text-nowrap">
                     <h5 class="card-title mb-0">Welcome {{Auth::user()->first_name}}! 🎉</h5>
                     <!--<p class="mb-2">Best seller of the month</p>-->
                     <h4 class="text-primary mb-1">${{$totalSale}}k</h4>
                     <a href="javascript:void(0);" class="btn btn-primary">View Sales</a>
                  </div>
               </div>
               <div class="col-5 text-center text-sm-left">
                  <div class="card-body pb-0 px-0 px-md-4">
                     <img
                     src="../public/assets/img/illustrations/card-advance-sale.png"
                     height="140"
                     alt="view sales" />
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- View sales -->
      <!-- Statistics -->
      <div class="col-xl-8 mb-4 col-lg-7 col-12">
         <div class="card h-100">
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
                           <h5 class="mb-0">{{$totalLeads}}k</h5>
                           <small>Total Leads</small>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-6">
                     <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-info me-3 p-2">
                           <i class="ti ti-users ti-sm"></i>
                        </div>
                        <div class="card-info">
                           <h5 class="mb-0">{{$LeadsWin}}k</h5>
                           <small>Won</small>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-6">
                     <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-danger me-3 p-2">
                           <i class="ti ti-shopping-cart ti-sm"></i>
                        </div>
                        <div class="card-info">
                           <h5 class="mb-0">{{$LeadsLoss}}k</h5>
                           <small>Loss</small>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-6">
                     <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                           <i class="ti ti-currency-dollar ti-sm"></i>
                        </div>
                        <div class="card-info">
                           <h5 class="mb-0">10k</h5>
                           <small>Progress</small>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--/ Statistics -->
      <div class="col-xl-4 col-12">
         <div class="row">
            <!-- Expenses -->
            <div class="col-xl-6 mb-4 col-md-3 col-6">
               <div class="card" style="height: 196px;">
                  <div class="card-header pb-0">
                     <small class="text-muted">This Month Sale</small>
                     <h5 class="card-title mb-0">{{$thisMonthSale}}k</h5>
                  </div>
                  <div class="card-body my-3">
                     <div id="expensesChart"></div>
                  </div>
               </div>
            </div>
            <!--/ Expenses -->
            <!-- Profit last month -->
            <div class="col-xl-6 mb-4 col-md-3 col-6">
               <div class="card">
                  <div class="card-header pb-0">
                     <small class="text-muted">Total Sale</small>
                     <h5 class="card-title mb-0">{{$totalSale}}k</h5>
                  </div>
                  <div class="card-body">
                     <div id="profitLastMonth"></div>
                  </div>
               </div>
            </div>
            <!--/ Profit last month -->
            <!-- Generated Leads -->
            <div class="col-xl-12 mb-4 col-md-6">
               <div class="card">
                  <div class="card-body">
                     <div class="d-flex justify-content-between">
                        <div class="d-flex flex-column">
                           <div class="card-title mb-auto">
                              <h5 class="mb-1 text-nowrap">Upcoming Events</h5>
                              <small>No Record Found</small>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--/ Generated Leads -->
         </div>
      </div>
      <!-- Revenue Report -->
      <div class="col-12 col-xl-8 mb-4">
         <div class="card">
            <div class="card-body p-0">
               <div class="row row-bordered g-0">
                  <div class="col-md-8 position-relative p-4">
                     <div class="card-header d-inline-block p-0 text-wrap position-absolute">
                        <strong>Pending Deals</strong>&nbsp;&nbsp;<span></span>
                     </div>
                     <div id="totalRevenueChart" class="mt-n1"></div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive text-nowrap">
                        <table class="table table-sm">
                           <thead>
                              <tr>
                                 <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                 <th>Name</th>
                                 <th>Services</th>
                                 <th>Amount</th>
                                 <th>Target Date</th>
                              </tr>
                           </thead>
                           <tbody class="table-border-bottom-0">
                              @foreach($pendingDeals as $key=> $User)                 
                              <tr class="odd">
                                 <td><strong>{{$User->first_name}}</strong></td>
                                 <td>{{$User->product_name}}</td>
                                 <td>{{$User->total_amt}}</td>
                                 <td>{{$User->created_at->format('Y-m-d') }}</td>
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
      <!--/ Revenue Report -->
      <!-- Earning Reports -->
      <div class="col-12 col-xl-8 mb-4">
         <div class="card">
            <div class="card-body p-0">
               <div class="row row-bordered g-0">
                  <div class="col-md-8 position-relative p-4">
                     <div class="card-header d-inline-block p-0 text-wrap position-absolute">
                        <strong>Target Achievement</strong>&nbsp;&nbsp;<span></span>
                     </div>
                     <div id="totalRevenueChart" class="mt-n1"></div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive text-nowrap">
                        <table class="table table-sm">
                           <thead>
                              <tr>
                                 <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                 <th>Date</th>
                                 <th>Total</th>
                                 <th>Achieved</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody class="table-border-bottom-0">
                              @foreach($query as $key=> $user)                   
                              <tr class="odd">
                                 <td>{{$user->date}}</td>
                                 <td>{{$user->goal_value}}</td>
                                 <td>{{$user->archieved_value}}</td>
                                 <td>@switch($user->status)
                                    @case('1')
                                    <span class="badge bg-label-danger">Failed</span>
                                    @break
                                    @case('2')
                                    <span class="badge bg-label-primary">InProgress</span>
                                    @break
                                    @case('3')
                                    <span class="badge bg-label-success">Achieved</span>
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
      <!--/ Popular Product -->
      <!-- Sales by Countries tabs-->
        <div class="col-md-6 col-xl-4 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between pb-2 mb-1">
                    <div class="card-title mb-1">
                        <h5 class="m-0 me-2">KRA</h5>
                        <p >{!! $kra->kra !!}</p>
                    </div>
                </div>
                <div class="card-body">
                    <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#fullKRAModal">Read More</a>
                </div>
            </div>
        </div>
      <!--/ Sales by Countries tabs -->
      <!-- Transactions -->
      <div class="col-xl-4 col-md-6 mb-4">
         <div class="card h-100">
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
      <div class="col-xl-4 mb-4 col-md-6">
        <div class="card">
         <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="d-flex flex-column">
                <div class="card-title mb-auto">
                 <h5 class="mb-1 text-nowrap">Efficiency</h5>
                </div>
            </div>
            <div id="generatedLeadsChart"></div>
          </div>
         </div>
        </div>
      </div>
<div class="col-xl-4 col-md-6 mb-4">
   <div class="card h-100">
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
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>id</th>
                     <th>Leave type</th>
                     <th>leaves</th>
                     <th>Theme</th>
                  </tr>
               </thead>
               <tbody class="table-border-bottom-0">
                  @foreach($leaves as $key=> $User)
                  
                   @php 
                   $countLeave = DB::table('leaves')->where('leavetype_id',$User->id)->count();
                    $idwiseCount = $User->no_of_leave - $countLeave;
                   @endphp                 
                  <tr class="odd">
                     <td><strong>{{$User->id}}</strong></td>
                     <td>{{$User->leave_type}}</td>
                     <td>{{$User->no_of_leave}}</td>
                     <td>{{$idwiseCount}}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
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


    // $(document).ready(function() {
        // Get the original KRA content
        var originalKRA = $('.card-title .ql-editor ').text();
        // Check if the length of the KRA content is greater than 50 characters
        if (originalKRA.length > 50) {
            // Truncate the KRA content to 50 characters and append '...'
            var truncatedKRA = originalKRA.substr(0, 50) + '...';
            // Replace the original content with the truncated content
            $('.card-title .ql-editor ').text(truncatedKRA);
        }
        
    // });
    
</script>

@endsection