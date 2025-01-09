@extends('layouts.admin')
@section('title', 'Performance')
@section('content')

<style>
  .status_color{


    background-color: red;
    width:15px;
    height: 15px;
    border-radius: 50%;
    display: block;
    margin-right: 8px;

  }


  th {
    border-color: 1px solid transparent;
  }


.color_head{

color:#83888C;

}


</style>

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
   
    <div class="col-lg-3">
      <div class="card h-100">
        <div class="card-body d-flex justify-content-between align-items-center" style="padding: 20px 12px;">
          <div class="card-title mb-0">
                                            @if($user_details->profile_img)

                                                     <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user_details->profile_img}}"
                            height="40"
                            width="40"
                            alt="User avatar" />
                                                    @else

                                                    <img class="rounded-circle"

                                                    style="margin-right: 15px;margin-top: 10px;" 

                                                    src="{{url('public/images/21104.png')}}"

                                                    height="30"

                                                    width="30"

                                                    alt="User avatar" />

                                                    @endif          @php
                                                     $department = DB::table('employee_details')->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
                                        ->where('employee_details.user_id', $id)->select('jobroles.name')
                                        ->first();
                                                    @endphp
                        {{ucfirst($user_details->first_name) }} {{ucfirst($user_details->last_name) }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$department->name}}</div>
          </div>
          <!--<div class="card-icon">-->
          <!--  @if($user_details->profile_img)-->

          <!--                                           <img -->
          <!--                  class="rounded-circle"-->
          <!--                  style="margin-right: 15px;margin-top: 10px;" -->
          <!--                  src="{{$user_details->profile_img}}"-->
          <!--                  height="40"-->
          <!--                  width="40"-->
          <!--                  alt="User avatar" />-->
          <!--                                          @else-->

          <!--                                          <img class="rounded-circle"-->

          <!--                                          style="margin-right: 15px;margin-top: 10px;" -->

          <!--                                          src="{{url('public/images/21104.png')}}"-->

          <!--                                          height="30"-->

          <!--                                          width="30"-->

          <!--                                          alt="User avatar" />-->

          <!--                                          @endif-->
          <!--</div>-->
        </div>
      </div>
    </div>
     <div class="col-md-9">
      <div class="inner_content">
   
        <!--<h6 class="fw-100">You have 2 leave request pending </h6>-->
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-3 col-sm-6 mb-4">
      <div class="card card-border-shadow h-100">
        <div class="card-body">
          <li class="d-flex mb-3" style="position: relative;">

            <div class="row w-100 align-items-center">
              <div class="col-8">
                <div class="me-2">
                  <h6 class="mb-1 color_head">My Performance</h6>
                                   @php
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
                                
                                        // Default value if no tickets are assigned
                                        $ticketRating = 0;
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
                                                $ticketRating = 0;
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
                                
                                        $punctualityRating = 0; // Default value
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
                                                $punctualityRating = 0;
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
                                
                                                   $workingHoursRating = 0; // Default value
                                                   $averageHoursPerDay = 0; // Default value
                                        if ($workingHoursData && $workingHoursData->working_days > 0) {
                                            $totalHours = $workingHoursData->total_hours;
                                            $workingDays = $workingHoursData->working_days;
                                            $shiftHours = $workingHoursData->shift_hours ?? 0;
                                        
                                            if (is_numeric($totalHours) && is_numeric($workingDays) && is_numeric($shiftHours)) {
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
                                                        $workingHoursRating = 0;
                                                    }
                                                }
                                            } else {
                                                $workingHoursRating =0;
                                                }
                                        } else {
                                            $workingHoursRating = 0;
                                        }


                                        $attendanceDays = DB::table('attendences')
                                            ->where('emp_Id', $user->id)
                                            ->whereBetween('punch_date', [$startDate, $endDate])
                                            ->distinct('punch_date')
                                            ->count();
                                
                                        $attendanceRating = 0; // Default value
                                        if ($attendanceDays >= 2 && $attendanceDays <= 10) {
                                            $attendanceRating = 30;
                                        } elseif ($attendanceDays >= 10 && $attendanceDays <= 20) {
                                            $attendanceRating = 50;
                                        } elseif ($attendanceDays >= 20 && $attendanceDays <= 30) {
                                            $attendanceRating = 75;
                                        } elseif ($attendanceDays >= 30) {
                                            $attendanceRating = 100;
                                        }
                                
                                        // Calculating total score
                                        $totalScore = $ticketRating + $punctualityRating + $workingHoursRating + $attendanceRating;
                                        $maxScore = 400; // Max score is always 400 (4 categories, each up to 100)
                                        $calpercnt = ($totalScore/400) * 100;
                                    @endphp
                                    <small>
                                        <span>{{ $totalScore }} out of {{ $maxScore }}</span>
                                    </small>
                                @endforeach

                            <!--<a href="{{url('Employee/Performance/view2/'.$id)}}" class="btn btn-primary mt-3 m-3">Old</a>-->

                </div>
              </div>
            </div>
            <div class="chart-progress me-3" data-color="success" data-series="83" data-progress_variant="true" style="min-height: 62.7px;"><div id="apexchartsa22qw2uh" class="apexcharts-canvas apexchartsa22qw2uh apexcharts-theme-light" style="width: 80px; height: 80px;"><svg id="SvgjsSvg1910" width="80" height="80" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1912" class="apexcharts-inner apexcharts-graphical" transform="translate(-18, -12)"><defs id="SvgjsDefs1911"><clipPath id="gridRectMaska22qw2uh"><rect id="SvgjsRect1914" width="98" height="91" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaska22qw2uh"></clipPath><clipPath id="nonForecastMaska22qw2uh"></clipPath><clipPath id="gridRectMarkerMaska22qw2uh"><rect id="SvgjsRect1915" width="96" height="93" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1916" class="apexcharts-radialbar"><g id="SvgjsG1917"><g id="SvgjsG1918" class="apexcharts-tracks"><g id="SvgjsG1919" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 45.99548236424567 18.615854052774676" fill="none" fill-opacity="1" stroke="#a8aaae29" stroke-opacity="1" stroke-linecap="round" stroke-width="4.223048780487806" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 45.99548236424567 18.615854052774676"></path></g></g><g id="SvgjsG1921"><g id="SvgjsG1926" class="apexcharts-series apexcharts-radial-series" seriesName="" rel="1" data:realIndex="0"><path id="SvgjsPath1927" d="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 23.361215507276 31.95111684179451" fill="none" fill-opacity="0.85" stroke="rgba(40,199,111,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="4.3536585365853675" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="299" data:value="83" index="0" j="0" data:pathOrig="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 23.361215507276 31.95111684179451"></path></g><circle id="SvgjsCircle1922" r="18.772621951219513" cx="46" cy="44.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle><g id="SvgjsG1923" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText1924" font-family="Helvetica, Arial, sans-serif" x="46" y="44.5" text-anchor="middle" dominant-baseline="auto" font-size="16px" font-weight="500" fill="#28c76f" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;"></text><text id="SvgjsText1925" font-family="Public Sans" x="46" y="50.5" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#5d596c" class="apexcharts-text apexcharts-datalabel-value" style="font-family: &quot;Public Sans&quot;;">{{$calpercnt}}%</text></g></g></g></g><line id="SvgjsLine1928" x1="0" y1="0" x2="92" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1929" x1="0" y1="0" x2="92" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1913" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 341px; height: 64px;"></div></div><div class="contract-trigger"></div></div></li>

          </div>
        </div>
      </div>
      @php
                                    $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
                                    $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
                                    $startDate = date("$year-$month-01");
                                    $endDate = date("$year-$month-t", strtotime($startDate));
                            
                                    $startDateLastYear = date('$year-$month-d', strtotime('-1 year'));
    @endphp

    @foreach($Performance as $user) 
         @php

        // Fetch total working hours for the current month
        $currentMonthWorkingHoursData = DB::table('attendences')
            ->where('emp_id', $user->id)
            ->whereBetween('punch_date', [$startDate, $endDate])
            ->select(DB::raw('SUM(TIMESTAMPDIFF(MINUTE, punch_in, punch_out) / 60) as total_hours'))
            ->first();

        $currentMonthTotalHours = $currentMonthWorkingHoursData->total_hours ?? 0;

        // Fetch total working hours for the past year
        $yearlyWorkingHoursData = DB::table('attendences')
            ->where('emp_id', $user->id)
            ->whereBetween('punch_date', [$startDateLastYear, $endDate])
            ->select(DB::raw('SUM(TIMESTAMPDIFF(MINUTE, punch_in, punch_out) / 60) as total_hours'))
            ->first();

        $yearlyTotalHours = $yearlyWorkingHoursData->total_hours ?? 0;
        $averageMonthlyHours = $yearlyTotalHours / 12;
    @endphp

    <!-- Display total working hours and average monthly working hours -->
    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-1 pb-1" style="justify-content:space-between;">
                    <div class="txt_desc">
                        <span class="color_head">Working Hrs.</span>
                    </div>
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="fa-solid fa-file" style="font-size: 19px;"></i>
                        </span>
                    </div>
                </div>
                <p class="mb-3" style="font-size: 22px;color: #2A2E31;font-weight: 500;">
                    {{ number_format($currentMonthTotalHours, 2) }}
                </p>
                <p class="mb-0 d-flex" style="align-items: center;">
                    <span class="fw-medium me-2" style="height:32px;background-color: #28c76f;display: inline-block;border-radius: 6px;">&nbsp;</span>
                    <small class="text-muted">{{ number_format($averageMonthlyHours, 2) }} Average working hours per month</small>
                </p>
            </div>
        </div>
    </div>
@endforeach

      
      <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow  h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-1 pb-1" style="justify-content:space-between;">
              <div class="txt_desc">
                <span class="color_head">Ticket assigned</span>
              </div>
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-success"><i class="fa-solid fa-file" style="font-size: 19px;"></i></span>
              </div>
            </div>
            @php
              $assignedTickets = DB::table('tickets')
                                        ->where('ccid', $id)
                                          ->whereBetween('date', [$startDate, $endDate])
                                        ->count();
                                        if($assignedTickets > 0 ){
                                                 $resolvedTickets = DB::table('tickets')
                                                ->where('ccid', $id)
                                                    ->whereBetween('date', [$startDate, $endDate])
                                                ->where('status', '3')
                                                ->count();
                                    
                                            $resolvedRating1 = 0;
                                    
                                           $resolvedPercentage = ($resolvedTickets / $assignedTickets) * 100;
                                        }else{
                                        $resolvedTickets = 0;
                                        $assignedTickets = 0;
                                        }
                            
                                   
                                        
            @endphp
            <p class="mb-3" style="font-size: 22px;color: #2A2E31;font-weight: 500;">{{$resolvedTickets}}</p>
            <p class="mb-0 d-flex" style="align-items: center;"> 
              <span class="fw-medium me-2" style="height:32px;background-color: #28c76f;display: inline-block;border-radius: 6px;">&nbsp;</span>
              <small class="text-muted">{{$assignedTickets}} Average ticket assigned</small>
            </p>
          </div>
        </div>
      </div>
   
      <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-1 pb-1" style="justify-content:space-between;">
              <div class="txt_desc">
                <span class="color_head">Attendance %</span>
              </div>
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="fas fa-sign-out" style="font-size: 19px;"></i></span>
              </div>
            </div>
           @php
    
    
   
    $attendancePercentage = 0;
        $attendanceDays = DB::table('attendences')
                            ->where('emp_Id', $id)
                            ->whereBetween('punch_date', [$startDate, $endDate])
                            ->distinct('punch_date')
                            ->count();
        
        $attendancePercentage = ($attendanceDays / 30) * 100;
  
@endphp

<p class="mb-3" style="font-size: 22px;color: #2A2E31;font-weight: 500;">{{ number_format($attendancePercentage, 2) }}%</p>

            <p class="mb-0 d-flex" style="align-items: center;">
              <span class="fw-medium me-2" style="height:32px; background-color: #7a6ff1; display: inline-block;border-radius: 6px;">&nbsp;</span>
              <small class="text-muted">Good score</small>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
              <div class="card-header flex-column flex-md-row" style="padding-bottom: 16px;">
                <div class="head-label text-center">
                  <h5 class="card-title mb-0">Performance</h5>
                </div>
              </div>
            
             
               <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
                                 <form id="filterForm" action="{{ url('Employee/Performance/view/'.$id) }}" method="GET">
                                    <div class="dataTables_length" id="DataTables_Table_3_length">
                                        <label for="filter_month">Select Month:</label>
                                       <select name="month" class="form-select" id="filter_month" onchange="submitForm()">
                                                        <option value="01" @if(isset($_GET['month']) && $_GET['month'] == '01') selected @elseif(date('m') == '01') slected @else '' @endif>January</option>
                                                            <option value="02" @if(isset($_GET['month']) && $_GET['month'] == '02') selected @elseif(date('m') == '02') slected @else '' @endif>February</option>
                                                            <option value="03" @if(isset($_GET['month']) && $_GET['month'] == '03') selected @elseif(date('m') == '03') slected @else '' @endif>March</option>
                                                            <option value="04" @if(isset($_GET['month']) && $_GET['month'] == '04') selected @elseif(date('m') == '04') slected @else '' @endif>April</option>
                                                                 <option value="05" @if(isset($_GET['month']) && $_GET['month'] == '05') selected @elseif(date('m') == '05') slected @else '' @endif>May</option>
                                                                  <option value="06" @if(isset($_GET['month']) && $_GET['month'] == '06') selected @elseif(date('m') == '06') slected @else '' @endif>June</option>
                                                                  <option value="07" @if(isset($_GET['month']) && $_GET['month'] == '07') selected @elseif(date('m') == '07') slected @else '' @endif>July</option>
                                                                  <option value="08" @if(isset($_GET['month']) && $_GET['month'] == '08') selected @elseif(date('m') == '08') slected @else '' @endif>August</option>
                                                                   <option value="09" @if(isset($_GET['month']) && $_GET['month'] == '09') selected @elseif(date('m') == '09') slected @else '' @endif>September</option>
                                                                    <option value="10" @if(isset($_GET['month']) && $_GET['month'] == '10') selected @elseif(date('m') == '10') slected @else '' @endif>October</option>
                                                                    <option value="11" @if(isset($_GET['month']) && $_GET['month'] == '11') selected @elseif(date('m') == '11') slected @else '' @endif>November</option>
                                                                     <option value="12" @if(isset($_GET['month']) && $_GET['month'] == '12') selected @elseif(date('m') == '12') slected @else '' @endif>December</option>
                                    </select>
   

                                <select name="year" class="form-select" id="filter_year" onchange="submitForm()"></select>
                            </div>
                        </form>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                 
              </div>
            </div>
          </div>
          
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
            @if(count($Performance) > 0)
                @foreach($Performance as $key => $user)
                    <tr class="odd">
                        <td>{{ $key + 1 }}</td>
                        <!--<td>-->
                        <!--    <img class="rounded-circle"-->
                        <!--         style="margin-right: 15px;margin-top: 10px;" -->
                        <!--         src="{{ $user->profile_img }}"-->
                        <!--         height="30"-->
                        <!--         width="30"-->
                        <!--         alt="User avatar" />-->
                        <!--    <a href="{{ url('Employee/Performance/view/'.$user->id) }}">{{ $user->first_name }}</a>-->
                        <!--    <div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{ $user->email }}</div>-->
                        <!--</td>-->
                        <td>@if($user && $user->departments_name) {{ $user->departments_name }} @endif</td>  
                           <td>
                                @php
                                    $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
                                    $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
                                    $startDate = date("$year-$month-01");
                                    $endDate = date("Y-m-t", strtotime($startDate));
                            
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
                                ->where('attendences.emp_Id', $user->id)
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
                
                $resolvedRating = '--';
                
                // Calculate the average working hours and determine the rating
                if ($workingHoursData && $workingHoursData->working_days > 0) {
                $workingHoursData->total_hours = $workingHoursData->total_hours ?? 0;
                    $workingHoursData->working_days = $workingHoursData->working_days ?? 0;
                    $averageHoursPerDay = $workingHoursData->total_hours / $workingHoursData->working_days;
                    $shiftHours = $workingHoursData->shift_hours ?? 0;

                    if ($shiftHours > 0) {
                        if ($averageHoursPerDay >= $shiftHours) {
                            $resolvedRating = 5;
                        } elseif ($averageHoursPerDay >= 0.75 * $shiftHours) {
                            $resolvedRating = 4;
                        } elseif ($averageHoursPerDay >= 0.5 * $shiftHours) {
                            $resolvedRating = 3;
                        } elseif ($averageHoursPerDay >= 0.25 * $shiftHours) {
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
                            ->where('emp_Id', $user->id)
                            ->whereBetween('punch_date', [$startDate, $endDate])
                            ->distinct('punch_date')
                            ->count();
                        if ($attendanceDays >= 2 && $attendanceDays <= 10) {
                            $resolvedRating = 1;
                        } elseif ($attendanceDays >= 10 && $attendanceDays <= 20) {
                            $resolvedRating = 2;
                        }elseif ($attendanceDays >= 20 && $attendanceDays <= 30) {
                            $resolvedRating = 3;
                        }elseif ($attendanceDays >= 30 && $attendanceDays <= 40) {
                            $resolvedRating = 4;
                        }  elseif ($attendanceDays == date('t')) {
                            $resolvedRating = 5;
                        }  else {
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

                
                <!--<td><a href="{{url('Employee/Performance/view/'.$user->id)}}"><i class="fa-solid fa-eye"></i></a></td>-->
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="4">No Data Found</td>
              </tr>
              @endif             

            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $Performance->links() }}
          </div>
      </div>
      </div>
            
              <div style="width: 1%;"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4 order-md-0 order-lg-0 mt-4">
        <div class="card h-100">
          <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
            <div class="card-title mb-0">
              <h5 class="mb-0">Earning Reports</h5>
              <small class="text-muted">Weekly Earnings Overview</small>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="earningReportsId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-dots-vertical ti-sm text-muted"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-md-4 d-flex flex-column align-self-end">
                <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                  <h1 class="mb-0">$468</h1>
                  <div class="badge rounded bg-label-success">+4.2%</div>
                </div>
                <small class="text-muted">You informed of this week compared to last week</small>
              </div>
              <div class="col-12 col-md-8" style="position: relative;">
                <div id="weeklyEarningReports" style="min-height: 202px;">
                  <div id="apexchartshwejr47l" class="apexcharts-canvas apexchartshwejr47l apexcharts-theme-light" style="width: 356px; height: 202px;">
                    <svg id="SvgjsSvg1800" width="356" height="202" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                      <g id="SvgjsG1802" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                        <defs id="SvgjsDefs1801">
                          <linearGradient id="SvgjsLinearGradient1805" x1="0" y1="0" x2="0" y2="1">
                            <stop id="SvgjsStop1806" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                            <stop id="SvgjsStop1807" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                            <stop id="SvgjsStop1808" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                          </linearGradient>
                          <clipPath id="gridRectMaskhwejr47l">
                            <rect id="SvgjsRect1810" width="370" height="162.40640030860902" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <clipPath id="forecastMaskhwejr47l"></clipPath>
                          <clipPath id="nonForecastMaskhwejr47l"></clipPath>
                          <clipPath id="gridRectMarkerMaskhwejr47l">
                            <rect id="SvgjsRect1811" width="370" height="166.40640030860902" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                        </defs>
                        <rect id="SvgjsRect1809" width="0" height="162.40640030860902" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1805)" class="apexcharts-xcrosshairs" y2="162.40640030860902" filter="none" fill-opacity="0.9"></rect>
                        <g id="SvgjsG1830" class="apexcharts-xaxis" transform="translate(0, 0)">
                          <g id="SvgjsG1831" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                            <text id="SvgjsText1833" font-family="Public Sans" x="26.142857142857142" y="191.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
                              <tspan id="SvgjsTspan1834">Mo</tspan>
                              <title>Mo</title>
                            </text>
                            <text id="SvgjsText1836" font-family="Public Sans" x="78.42857142857143" y="191.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
                              <tspan id="SvgjsTspan1837">Tu</tspan>
                              <title>Tu</title>
                            </text>
                            <text id="SvgjsText1839" font-family="Public Sans" x="130.71428571428572" y="191.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
                              <tspan id="SvgjsTspan1840">We</tspan>
                              <title>We</title>
                            </text>
                            <text id="SvgjsText1842" font-family="Public Sans" x="183" y="191.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
                              <tspan id="SvgjsTspan1843">Th</tspan>
                              <title>Th</title>
                            </text>
                            <text id="SvgjsText1845" font-family="Public Sans" x="235.2857142857143" y="191.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
                              <tspan id="SvgjsTspan1846">Fr</tspan>
                              <title>Fr</title>
                            </text>
                            <text id="SvgjsText1848" font-family="Public Sans" x="287.57142857142856" y="191.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
                              <tspan id="SvgjsTspan1849">Sa</tspan>
                              <title>Sa</title>
                            </text>
                            <text id="SvgjsText1851" font-family="Public Sans" x="339.85714285714283" y="191.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
                              <tspan id="SvgjsTspan1852">Su</tspan>
                              <title>Su</title>
                            </text>
                          </g>
                        </g>
                        <g id="SvgjsG1855" class="apexcharts-grid">
                          <g id="SvgjsG1856" class="apexcharts-gridlines-horizontal" style="display: none;">
                            <line id="SvgjsLine1858" x1="0" y1="0" x2="366" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1859" x1="0" y1="32.481280061721804" x2="366" y2="32.481280061721804" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1860" x1="0" y1="64.96256012344361" x2="366" y2="64.96256012344361" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1861" x1="0" y1="97.44384018516541" x2="366" y2="97.44384018516541" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1862" x1="0" y1="129.92512024688722" x2="366" y2="129.92512024688722" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1863" x1="0" y1="162.40640030860902" x2="366" y2="162.40640030860902" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          </g>
                          <g id="SvgjsG1857" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                          <line id="SvgjsLine1865" x1="0" y1="162.40640030860902" x2="366" y2="162.40640030860902" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                          <line id="SvgjsLine1864" x1="0" y1="1" x2="0" y2="162.40640030860902" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                        </g>
                        <g id="SvgjsG1812" class="apexcharts-bar-series apexcharts-plot-series">
                          <g id="SvgjsG1813" class="apexcharts-series" rel="1" seriesName="seriesx1" data:realIndex="0">
                            <path id="SvgjsPath1817" d="M 16.208571428571428 158.40640030860902L 16.208571428571428 101.44384018516541Q 16.208571428571428 97.44384018516541 20.208571428571428 97.44384018516541L 32.07714285714286 97.44384018516541Q 36.07714285714286 97.44384018516541 36.07714285714286 101.44384018516541L 36.07714285714286 101.44384018516541L 36.07714285714286 158.40640030860902Q 36.07714285714286 162.40640030860902 32.07714285714286 162.40640030860902L 20.208571428571428 162.40640030860902Q 16.208571428571428 162.40640030860902 16.208571428571428 158.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskhwejr47l)" pathTo="M 16.208571428571428 158.40640030860902L 16.208571428571428 101.44384018516541Q 16.208571428571428 97.44384018516541 20.208571428571428 97.44384018516541L 32.07714285714286 97.44384018516541Q 36.07714285714286 97.44384018516541 36.07714285714286 101.44384018516541L 36.07714285714286 101.44384018516541L 36.07714285714286 158.40640030860902Q 36.07714285714286 162.40640030860902 32.07714285714286 162.40640030860902L 20.208571428571428 162.40640030860902Q 16.208571428571428 162.40640030860902 16.208571428571428 158.40640030860902z" pathFrom="M 16.208571428571428 158.40640030860902L 16.208571428571428 158.40640030860902L 36.07714285714286 158.40640030860902L 36.07714285714286 158.40640030860902L 36.07714285714286 158.40640030860902L 36.07714285714286 158.40640030860902L 36.07714285714286 158.40640030860902L 16.208571428571428 158.40640030860902" cy="97.44384018516541" cx="68.49428571428571" j="0" val="40" barHeight="64.96256012344361" barWidth="19.86857142857143"></path>
                            <path id="SvgjsPath1819" d="M 68.49428571428571 158.40640030860902L 68.49428571428571 60.84224010801317Q 68.49428571428571 56.84224010801317 72.49428571428571 56.84224010801317L 84.36285714285714 56.84224010801317Q 88.36285714285714 56.84224010801317 88.36285714285714 60.84224010801317L 88.36285714285714 60.84224010801317L 88.36285714285714 158.40640030860902Q 88.36285714285714 162.40640030860902 84.36285714285714 162.40640030860902L 72.49428571428571 162.40640030860902Q 68.49428571428571 162.40640030860902 68.49428571428571 158.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskhwejr47l)" pathTo="M 68.49428571428571 158.40640030860902L 68.49428571428571 60.84224010801317Q 68.49428571428571 56.84224010801317 72.49428571428571 56.84224010801317L 84.36285714285714 56.84224010801317Q 88.36285714285714 56.84224010801317 88.36285714285714 60.84224010801317L 88.36285714285714 60.84224010801317L 88.36285714285714 158.40640030860902Q 88.36285714285714 162.40640030860902 84.36285714285714 162.40640030860902L 72.49428571428571 162.40640030860902Q 68.49428571428571 162.40640030860902 68.49428571428571 158.40640030860902z" pathFrom="M 68.49428571428571 158.40640030860902L 68.49428571428571 158.40640030860902L 88.36285714285714 158.40640030860902L 88.36285714285714 158.40640030860902L 88.36285714285714 158.40640030860902L 88.36285714285714 158.40640030860902L 88.36285714285714 158.40640030860902L 68.49428571428571 158.40640030860902" cy="56.84224010801317" cx="120.78" j="1" val="65" barHeight="105.56416020059585" barWidth="19.86857142857143"></path>
                            <path id="SvgjsPath1821" d="M 120.78 158.40640030860902L 120.78 85.20320015430451Q 120.78 81.20320015430451 124.78 81.20320015430451L 136.64857142857142 81.20320015430451Q 140.64857142857142 81.20320015430451 140.64857142857142 85.20320015430451L 140.64857142857142 85.20320015430451L 140.64857142857142 158.40640030860902Q 140.64857142857142 162.40640030860902 136.64857142857142 162.40640030860902L 124.78 162.40640030860902Q 120.78 162.40640030860902 120.78 158.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskhwejr47l)" pathTo="M 120.78 158.40640030860902L 120.78 85.20320015430451Q 120.78 81.20320015430451 124.78 81.20320015430451L 136.64857142857142 81.20320015430451Q 140.64857142857142 81.20320015430451 140.64857142857142 85.20320015430451L 140.64857142857142 85.20320015430451L 140.64857142857142 158.40640030860902Q 140.64857142857142 162.40640030860902 136.64857142857142 162.40640030860902L 124.78 162.40640030860902Q 120.78 162.40640030860902 120.78 158.40640030860902z" pathFrom="M 120.78 158.40640030860902L 120.78 158.40640030860902L 140.64857142857142 158.40640030860902L 140.64857142857142 158.40640030860902L 140.64857142857142 158.40640030860902L 140.64857142857142 158.40640030860902L 140.64857142857142 158.40640030860902L 120.78 158.40640030860902" cy="81.20320015430451" cx="173.06571428571428" j="2" val="50" barHeight="81.20320015430451" barWidth="19.86857142857143"></path>
                            <path id="SvgjsPath1823" d="M 173.06571428571428 158.40640030860902L 173.06571428571428 93.32352016973496Q 173.06571428571428 89.32352016973496 177.06571428571428 89.32352016973496L 188.9342857142857 89.32352016973496Q 192.9342857142857 89.32352016973496 192.9342857142857 93.32352016973496L 192.9342857142857 93.32352016973496L 192.9342857142857 158.40640030860902Q 192.9342857142857 162.40640030860902 188.9342857142857 162.40640030860902L 177.06571428571428 162.40640030860902Q 173.06571428571428 162.40640030860902 173.06571428571428 158.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskhwejr47l)" pathTo="M 173.06571428571428 158.40640030860902L 173.06571428571428 93.32352016973496Q 173.06571428571428 89.32352016973496 177.06571428571428 89.32352016973496L 188.9342857142857 89.32352016973496Q 192.9342857142857 89.32352016973496 192.9342857142857 93.32352016973496L 192.9342857142857 93.32352016973496L 192.9342857142857 158.40640030860902Q 192.9342857142857 162.40640030860902 188.9342857142857 162.40640030860902L 177.06571428571428 162.40640030860902Q 173.06571428571428 162.40640030860902 173.06571428571428 158.40640030860902z" pathFrom="M 173.06571428571428 158.40640030860902L 173.06571428571428 158.40640030860902L 192.9342857142857 158.40640030860902L 192.9342857142857 158.40640030860902L 192.9342857142857 158.40640030860902L 192.9342857142857 158.40640030860902L 192.9342857142857 158.40640030860902L 173.06571428571428 158.40640030860902" cy="89.32352016973496" cx="225.35142857142856" j="3" val="45" barHeight="73.08288013887406" barWidth="19.86857142857143"></path>
                            <path id="SvgjsPath1825" d="M 225.35142857142856 158.40640030860902L 225.35142857142856 20.240640030860902Q 225.35142857142856 16.240640030860902 229.35142857142856 16.240640030860902L 241.21999999999997 16.240640030860902Q 245.21999999999997 16.240640030860902 245.21999999999997 20.240640030860902L 245.21999999999997 20.240640030860902L 245.21999999999997 158.40640030860902Q 245.21999999999997 162.40640030860902 241.21999999999997 162.40640030860902L 229.35142857142856 162.40640030860902Q 225.35142857142856 162.40640030860902 225.35142857142856 158.40640030860902z" fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskhwejr47l)" pathTo="M 225.35142857142856 158.40640030860902L 225.35142857142856 20.240640030860902Q 225.35142857142856 16.240640030860902 229.35142857142856 16.240640030860902L 241.21999999999997 16.240640030860902Q 245.21999999999997 16.240640030860902 245.21999999999997 20.240640030860902L 245.21999999999997 20.240640030860902L 245.21999999999997 158.40640030860902Q 245.21999999999997 162.40640030860902 241.21999999999997 162.40640030860902L 229.35142857142856 162.40640030860902Q 225.35142857142856 162.40640030860902 225.35142857142856 158.40640030860902z" pathFrom="M 225.35142857142856 158.40640030860902L 225.35142857142856 158.40640030860902L 245.21999999999997 158.40640030860902L 245.21999999999997 158.40640030860902L 245.21999999999997 158.40640030860902L 245.21999999999997 158.40640030860902L 245.21999999999997 158.40640030860902L 225.35142857142856 158.40640030860902" cy="16.240640030860902" cx="277.63714285714286" j="4" val="90" barHeight="146.16576027774812" barWidth="19.86857142857143"></path>
                            <path id="SvgjsPath1827" d="M 277.63714285714286 158.40640030860902L 277.63714285714286 77.08288013887406Q 277.63714285714286 73.08288013887406 281.63714285714286 73.08288013887406L 293.5057142857143 73.08288013887406Q 297.5057142857143 73.08288013887406 297.5057142857143 77.08288013887406L 297.5057142857143 77.08288013887406L 297.5057142857143 158.40640030860902Q 297.5057142857143 162.40640030860902 293.5057142857143 162.40640030860902L 281.63714285714286 162.40640030860902Q 277.63714285714286 162.40640030860902 277.63714285714286 158.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskhwejr47l)" pathTo="M 277.63714285714286 158.40640030860902L 277.63714285714286 77.08288013887406Q 277.63714285714286 73.08288013887406 281.63714285714286 73.08288013887406L 293.5057142857143 73.08288013887406Q 297.5057142857143 73.08288013887406 297.5057142857143 77.08288013887406L 297.5057142857143 77.08288013887406L 297.5057142857143 158.40640030860902Q 297.5057142857143 162.40640030860902 293.5057142857143 162.40640030860902L 281.63714285714286 162.40640030860902Q 277.63714285714286 162.40640030860902 277.63714285714286 158.40640030860902z" pathFrom="M 277.63714285714286 158.40640030860902L 277.63714285714286 158.40640030860902L 297.5057142857143 158.40640030860902L 297.5057142857143 158.40640030860902L 297.5057142857143 158.40640030860902L 297.5057142857143 158.40640030860902L 297.5057142857143 158.40640030860902L 277.63714285714286 158.40640030860902" cy="73.08288013887406" cx="329.92285714285714" j="5" val="55" barHeight="89.32352016973496" barWidth="19.86857142857143"></path>
                            <path id="SvgjsPath1829" d="M 329.92285714285714 158.40640030860902L 329.92285714285714 52.72192009258272Q 329.92285714285714 48.72192009258272 333.92285714285714 48.72192009258272L 345.7914285714286 48.72192009258272Q 349.7914285714286 48.72192009258272 349.7914285714286 52.72192009258272L 349.7914285714286 52.72192009258272L 349.7914285714286 158.40640030860902Q 349.7914285714286 162.40640030860902 345.7914285714286 162.40640030860902L 333.92285714285714 162.40640030860902Q 329.92285714285714 162.40640030860902 329.92285714285714 158.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskhwejr47l)" pathTo="M 329.92285714285714 158.40640030860902L 329.92285714285714 52.72192009258272Q 329.92285714285714 48.72192009258272 333.92285714285714 48.72192009258272L 345.7914285714286 48.72192009258272Q 349.7914285714286 48.72192009258272 349.7914285714286 52.72192009258272L 349.7914285714286 52.72192009258272L 349.7914285714286 158.40640030860902Q 349.7914285714286 162.40640030860902 345.7914285714286 162.40640030860902L 333.92285714285714 162.40640030860902Q 329.92285714285714 162.40640030860902 329.92285714285714 158.40640030860902z" pathFrom="M 329.92285714285714 158.40640030860902L 329.92285714285714 158.40640030860902L 349.7914285714286 158.40640030860902L 349.7914285714286 158.40640030860902L 349.7914285714286 158.40640030860902L 349.7914285714286 158.40640030860902L 349.7914285714286 158.40640030860902L 329.92285714285714 158.40640030860902" cy="48.72192009258272" cx="382.2085714285714" j="6" val="70" barHeight="113.6844802160263" barWidth="19.86857142857143"></path>
                            <g id="SvgjsG1815" class="apexcharts-bar-goals-markers" style="pointer-events: none">
                              <g id="SvgjsG1816" className="apexcharts-bar-goals-groups"></g>
                              <g id="SvgjsG1818" className="apexcharts-bar-goals-groups"></g>
                              <g id="SvgjsG1820" className="apexcharts-bar-goals-groups"></g>
                              <g id="SvgjsG1822" className="apexcharts-bar-goals-groups"></g>
                              <g id="SvgjsG1824" className="apexcharts-bar-goals-groups"></g>
                              <g id="SvgjsG1826" className="apexcharts-bar-goals-groups"></g>
                              <g id="SvgjsG1828" className="apexcharts-bar-goals-groups"></g>
                            </g>
                          </g>
                          <g id="SvgjsG1814" class="apexcharts-datalabels" data:realIndex="0"></g>
                        </g>
                        <line id="SvgjsLine1866" x1="0" y1="0" x2="366" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine1867" x1="0" y1="0" x2="366" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                        <g id="SvgjsG1868" class="apexcharts-yaxis-annotations"></g>
                        <g id="SvgjsG1869" class="apexcharts-xaxis-annotations"></g>
                        <g id="SvgjsG1870" class="apexcharts-point-annotations"></g>
                      </g>
                      <g id="SvgjsG1853" class="apexcharts-yaxis" rel="0" transform="translate(-8, 0)">
                        <g id="SvgjsG1854" class="apexcharts-yaxis-texts-g"></g>
                      </g>
                      <g id="SvgjsG1803" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend" style="max-height: 101px;"></div>
                  </div>
                </div>
                <div class="resize-triggers">
                  <div class="expand-trigger">
                    <div style="width: 381px; height: 203px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
                </div>
              </div>
            </div>
            <div class="border rounded p-3 mt-2">
              <div class="row gap-4 gap-sm-0">
                <div class="col-12 col-sm-4">
                  <div class="d-flex gap-2 align-items-center">
                    <div class="badge rounded bg-label-primary p-1">
                      <i class="ti ti-currency-dollar ti-sm"></i>
                    </div>
                    <h6 class="mb-0">Earnings</h6>
                  </div>
                  <h4 class="my-2 pt-1">$545.69</h4>
                  <div class="progress w-75" style="height:4px">
                    <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="d-flex gap-2 align-items-center">
                    <div class="badge rounded bg-label-info p-1">
                      <i class="ti ti-chart-pie-2 ti-sm"></i>
                    </div>
                    <h6 class="mb-0">Profit</h6>
                  </div>
                  <h4 class="my-2 pt-1">$256.34</h4>
                  <div class="progress w-75" style="height:4px">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="d-flex gap-2 align-items-center">
                    <div class="badge rounded bg-label-danger p-1">
                      <i class="ti ti-brand-paypal ti-sm"></i>
                    </div>
                    <h6 class="mb-0">Expense</h6>
                  </div>
                  <h4 class="my-2 pt-1">$74.19</h4>
                  <div class="progress w-75" style="height:4px">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-12 mb-4 mt-4">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center mb-4">
            <div>
              <p class="card-subtitle text-muted mb-1">Ticket</p>
              <!--<h5 class="card-title mb-0">$74,382.72</h5>-->
            </div>
          
          </div>
     <div class="card-body" style="position: relative;">
                    @php
                        use Carbon\Carbon;

                          $averageRatings = [];
                        $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
                        $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
                        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
                        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
                        
                        // Calculate start and end dates of the week based on the selected month and year
                        $currentDate = Carbon::createFromDate($year, $month, date('d'));
                        $startOfWeek = $currentDate->startOfWeek()->toDateString();
                        $endOfWeek = $currentDate->endOfWeek()->toDateString();
                    
                        $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                    $assignedTicketsNew = DB::table('tickets')
                        ->select(DB::raw('COUNT(*) as total, DATE_FORMAT(date, "%a") as day'))
                        ->where('ccid', $user->id)
                        ->whereBetween('date', [$startOfWeek, $endOfWeek])
                        ->groupBy('day')
                        ->pluck('total', 'day')
                        ->toArray();
                    
                    $defaultCounts = array_fill_keys($daysOfWeek, 0);
                    
                    $ticketCounts = array_replace($defaultCounts, $assignedTicketsNew);
                    
                    // Extract the ticket counts into a simple array
                    $ticketCounts = array_values($ticketCounts);
                    

                @endphp
                <div id="horizontalBarChart" ></div>

            <div class="resize-triggers">
              <div class="expand-trigger">
                <div style="width: 595px; height: 440px;"></div>
              </div>
              <div class="contract-trigger"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
                            $(document).ready(function () {
                            
                                var currentYear = new Date().getFullYear();
                                var startYear = 2015;
                                var $selectYear = $('#filter_year');
                                
                                // Populate the select element for years
                                for (var year = currentYear; year >= startYear; year--) {
                                    $selectYear.append($('<option>', {
                                        value: year,
                                        text: year
                                    }));
                                }
                                   let cardColor, headingColor, labelColor, borderColor, legendColor;

    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  
        // Horizontal Bar Chart
      // --------------------------------------------------------------------
      const horizontalBarChartEl = document.querySelector('#horizontalBarChart'),
        horizontalBarChartConfig = {
          chart: {
            height: 300,
            width: 500,
            type: 'bar',
            toolbar: {
              show: false
            }
          },
          plotOptions: {
            bar: {
              horizontal: true,
              barHeight: '30%',
              startingShape: 'rounded',
              borderRadius: 8
            }
          },
          grid: {
            borderColor: borderColor,
            xaxis: {
              lines: {
                show: false
              }
            },
            padding: {
              top: -20,
              bottom: -12
            }
          },
          colors: config.colors.info,
          dataLabels: {
            enabled: false
          },
         series: [
            {
                name: 'Assigned Ticket Count', // add a comma here
                data: {!! json_encode($ticketCounts) !!},
            }
        ],
          xaxis: {
            categories:  ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
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
              style: {
                colors: labelColor,
                fontSize: '13px'
              }
            }
          }
        };
      if (typeof horizontalBarChartEl !== undefined && horizontalBarChartEl !== null) {
        const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
        horizontalBarChart.render();
      }
                            });
                     
    function submitForm() {
        document.getElementById("filterForm").submit();
    }
</script>


  @endsection