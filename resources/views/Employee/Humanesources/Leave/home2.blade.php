@extends('layouts.admin')
@section('title', 'Leave')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .actives{
    border: 0px solid #1ff11f;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: #1ff11f;
    }

  .inactives{
    border: 0px solid red;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: red;
    }
    .orangecose{
    border: 0px solid orange;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: orange;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leave /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
   <div class="alert alert-success" role="alert" id="ResMsg" style="display:none;"></div>
     
    @if($RoleAccess[array_search('LeaveType', array_column($RoleAccess, 'per_name'))]['view'] == 1)
     <!--<div class="card">-->
    <!--  <div class="row">-->
    <!--  <div class="col-md-6 ">-->
    <!--      <h5 class="card-header">Leave Type</h5>-->
    <!--  </div> todayonleaveCount-->
    <!--  <div class="col-md-6 text-end">-->
    <!--    @if($RoleAccess[array_search('LeaveType', array_column($RoleAccess, 'per_name'))]['add'] == 1)-->
    <!--      <button class="btn btn-primary waves-effect waves-light mt-3 m-3" data-bs-toggle="modal" data-bs-target="#backDropModal">Add Type</button>-->
    <!--    @endif-->
    <!--     <a href="{{url('Employee/Leave/home2')}}"  target="_blank" class="btn btn-label-primary me-3">-->
    <!--            <span class="align-middle"> New Leave Page</span>-->
    <!--            </a>-->
    <!--  </div>-->
    <!--   </div>-->
    <!--  <div class="card-body">-->
    <!--    @if(count($LeaveType) > 0)-->
    <!--      <div class="row g-4 mb-4">-->
    <!--        @foreach($LeaveType as $key=> $Lea)-->
    <!--        <div class="col-sm-6 col-xl-3">-->
    <!--          <div class="card bg-{{$Lea->theme}} text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            @if($RoleAccess[array_search('LeaveType', array_column($RoleAccess, 'per_name'))]['update'] == 1)-->
    <!--            <a id="{{$Lea->id}}" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--            @endif-->
    <!--            @if($RoleAccess[array_search('LeaveType', array_column($RoleAccess, 'per_name'))]['delete'] == 1)-->
    <!--            <a class="delete_debtcase" url="{{url('Employee/LeaveType/delete/'.$Lea->id)}}" id="{{$Lea->id}}" style="cursor: pointer;"><i class="ti ti-trash ti-sm"></i></a>-->
    <!--            @endif-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">{{$Lea->leave_type}}</h4>-->
    <!--                  <p class="text-white mt-3">{{$Lea->no_of_leave}}</p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>         -->
    <!--        @endforeach-->
    <!--      </div>-->
    <!--    @else-->
    <!--    <div class="text-center" style="border-bottom: 1px solid #dbdade;border-top: 1px solid #dbdade;">-->
    <!--      <p class="p-2" >No Data Found</p>-->
    <!--    </div>-->
    <!--    @endif-->
    <!--  </div>-->
    <!--</div>-->
    @endif
  <!-- Users List Table -->

    <div class="card">
    <div class="row">
    
     
           <div class="card-body">
          <div class="row g-4 mb-4">
           
            <div class="col-sm-3 col-xl-3">
              <div class="card bg-info text-white">
              <div class="text-end p-1">
                <!--<a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
              </div>
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                      <h4 class="text-white">Total Leave</h4>
                      <p class="text-white mt-3">{{$unapproveCount+$approveCount}}</p>
                  </div>
                </div>
              </div>
            </div>    
            
            <div class="col-sm-3 col-xl-3">
              <div class="card bg-success text-white">
              <div class="text-end p-1">
                <!--<a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
              </div>
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                      <h4 class="text-white">Approved</h4>
                      <p class="text-white mt-3">{{$approveCount}}</p>
                  </div>
                </div>
              </div>
            </div>     
                
                
                  <div class="col-sm-3 col-xl-3">
              <div class="card bg-danger text-white">
              <div class="text-end p-1">
                <!--<a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
              </div>
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                      <h4 class="text-white">Unapproved</h4>
                      <p class="text-white mt-3">{{$unapproveCount}}</p>
                  </div>
                </div>
              </div>
            </div>  
             <div class="col-sm-3 col-xl-3">
                   <a href="{{url('admin/Leave/home2')}}"  target="_blank" class="btn btn-label-primary me-3">
                <span class="align-middle"> New Leave Page</span>
              </a>
                <a href="{{url('Employee/Leave/add')}}" class="btn btn-primary mt-3 m-3">Add Leave</a>
            </div>
            
          </div>
             
      </div>
    </div>
    </div>
    
    
  <!-- Users List Table -->
  
        <div class="row  mt-4">
             
             <div class="col-xl-4 col-6 mb-4">
                      <div class="card">
                        <div class="card-header header-elements">
                          <h5 class="card-title mb-0">Current Month leave pattern</h5>
                          <div class="card-action-element ms-auto py-0">
                            <div class="dropdown">
                              <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-calendar"></i>
                              </button>
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
         <div class="col-xl-4 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Monthly stats</h5>
            <small class="text-muted">Weekly Earnings Overview</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="earningReports" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ti ti-dots-vertical ti-sm text-muted"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReports">
              <a class="dropdown-item" href="javascript:void(0);">Download</a>
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
            </div>
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
                  <h6 class="mb-0">Net Profit</h6>
                  <small class="text-muted">12.4k Sales</small>
                </div>
                <div class="user-progress d-flex align-items-center gap-3">
                  <small>$1,619</small>
                  <div class="d-flex align-items-center gap-1">
                    <i class="ti ti-chevron-up text-success"></i>
                    <small class="text-muted">18.6%</small>
                  </div>
                </div>
              </div>
            </li>
            <li class="d-flex mb-3">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-success">
                  <i class="ti ti-currency-dollar ti-sm"></i>
                </span>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">Total Income</h6>
                  <small class="text-muted">Sales, Affiliation</small>
                </div>
                <div class="user-progress d-flex align-items-center gap-3">
                  <small>$3,571</small>
                  <div class="d-flex align-items-center gap-1">
                    <i class="ti ti-chevron-up text-success"></i>
                    <small class="text-muted">39.6%</small>
                  </div>
                </div>
              </div>
            </li>
            <li class="d-flex mb-3">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="ti ti-credit-card ti-sm"></i>
                </span>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">Total Expenses</h6>
                  <small class="text-muted">ADVT, Marketing</small>
                </div>
                <div class="user-progress d-flex align-items-center gap-3">
                  <small>$430</small>
                  <div class="d-flex align-items-center gap-1">
                    <i class="ti ti-chevron-up text-success"></i>
                    <small class="text-muted">52.8%</small>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          <div id="reportBarChart" style="min-height: 215px;">
            <div id="apexchartsnxk9hyb3" class="apexcharts-canvas apexchartsnxk9hyb3 apexcharts-theme-light" style="width: 340px; height: 200px;">
              <svg id="SvgjsSvg1994" width="340" height="200" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                <g id="SvgjsG1996" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 10)">
                  <defs id="SvgjsDefs1995">
                    <linearGradient id="SvgjsLinearGradient1999" x1="0" y1="0" x2="0" y2="1">
                      <stop id="SvgjsStop2000" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                      <stop id="SvgjsStop2001" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                      <stop id="SvgjsStop2002" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                    </linearGradient>
                    <clipPath id="gridRectMasknxk9hyb3">
                      <rect id="SvgjsRect2004" width="354" height="150.40640030860902" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                    </clipPath>
                    <clipPath id="forecastMasknxk9hyb3"></clipPath>
                    <clipPath id="nonForecastMasknxk9hyb3"></clipPath>
                    <clipPath id="gridRectMarkerMasknxk9hyb3">
                      <rect id="SvgjsRect2005" width="354" height="154.40640030860902" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                    </clipPath>
                  </defs>
                  <rect id="SvgjsRect2003" width="30" height="150.40640030860902" x="60" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1999)" class="apexcharts-xcrosshairs" y2="150.40640030860902" filter="none" fill-opacity="0.9" x1="60" x2="60"></rect>
                  <g id="SvgjsG2024" class="apexcharts-xaxis" transform="translate(0, 0)">
                    <g id="SvgjsG2025" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                      <text id="SvgjsText2027" font-family="Helvetica, Arial, sans-serif" x="25" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2028">Mo</tspan>
                        <title>Mo</title>
                      </text>
                      <text id="SvgjsText2030" font-family="Helvetica, Arial, sans-serif" x="75" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2031">Tu</tspan>
                        <title>Tu</title>
                      </text>
                      <text id="SvgjsText2033" font-family="Helvetica, Arial, sans-serif" x="125" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2034">We</tspan>
                        <title>We</title>
                      </text>
                      <text id="SvgjsText2036" font-family="Helvetica, Arial, sans-serif" x="175" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2037">Th</tspan>
                        <title>Th</title>
                      </text>
                      <text id="SvgjsText2039" font-family="Helvetica, Arial, sans-serif" x="225" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2040">Fr</tspan>
                        <title>Fr</title>
                      </text>
                      <text id="SvgjsText2042" font-family="Helvetica, Arial, sans-serif" x="275" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2043">Sa</tspan>
                        <title>Sa</title>
                      </text>
                      <text id="SvgjsText2045" font-family="Helvetica, Arial, sans-serif" x="325" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2046">Su</tspan>
                        <title>Su</title>
                      </text>
                    </g>
                  </g>
                  <g id="SvgjsG2049" class="apexcharts-grid">
                    <g id="SvgjsG2050" class="apexcharts-gridlines-horizontal" style="display: none;">
                      <line id="SvgjsLine2052" x1="0" y1="0" x2="350" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      <line id="SvgjsLine2053" x1="0" y1="30.081280061721806" x2="350" y2="30.081280061721806" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      <line id="SvgjsLine2054" x1="0" y1="60.16256012344361" x2="350" y2="60.16256012344361" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      <line id="SvgjsLine2055" x1="0" y1="90.24384018516542" x2="350" y2="90.24384018516542" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      <line id="SvgjsLine2056" x1="0" y1="120.32512024688722" x2="350" y2="120.32512024688722" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      <line id="SvgjsLine2057" x1="0" y1="150.40640030860902" x2="350" y2="150.40640030860902" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                    </g>
                    <g id="SvgjsG2051" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                    <line id="SvgjsLine2059" x1="0" y1="150.40640030860902" x2="350" y2="150.40640030860902" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                    <line id="SvgjsLine2058" x1="0" y1="1" x2="0" y2="150.40640030860902" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                  </g>
                  <g id="SvgjsG2006" class="apexcharts-bar-series apexcharts-plot-series">
                    <g id="SvgjsG2007" class="apexcharts-series" rel="1" seriesName="seriesx1" data:realIndex="0">
                      <path id="SvgjsPath2011" d="M 10 146.40640030860902L 10 94.24384018516541Q 10 90.24384018516541 14 90.24384018516541L 36 90.24384018516541Q 40 90.24384018516541 40 94.24384018516541L 40 94.24384018516541L 40 146.40640030860902Q 40 150.40640030860902 36 150.40640030860902L 14 150.40640030860902Q 10 150.40640030860902 10 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 10 146.40640030860902L 10 94.24384018516541Q 10 90.24384018516541 14 90.24384018516541L 36 90.24384018516541Q 40 90.24384018516541 40 94.24384018516541L 40 94.24384018516541L 40 146.40640030860902Q 40 150.40640030860902 36 150.40640030860902L 14 150.40640030860902Q 10 150.40640030860902 10 146.40640030860902z" pathFrom="M 10 146.40640030860902L 10 146.40640030860902L 40 146.40640030860902L 40 146.40640030860902L 40 146.40640030860902L 40 146.40640030860902L 40 146.40640030860902L 10 146.40640030860902" cy="90.24384018516541" cx="60" j="0" val="40" barHeight="60.16256012344361" barWidth="30"></path>
                      <path id="SvgjsPath2013" d="M 60 146.40640030860902L 60 11.520320015430457Q 60 7.520320015430457 64 7.520320015430457L 86 7.520320015430457Q 90 7.520320015430457 90 11.520320015430457L 90 11.520320015430457L 90 146.40640030860902Q 90 150.40640030860902 86 150.40640030860902L 64 150.40640030860902Q 60 150.40640030860902 60 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 60 146.40640030860902L 60 11.520320015430457Q 60 7.520320015430457 64 7.520320015430457L 86 7.520320015430457Q 90 7.520320015430457 90 11.520320015430457L 90 11.520320015430457L 90 146.40640030860902Q 90 150.40640030860902 86 150.40640030860902L 64 150.40640030860902Q 60 150.40640030860902 60 146.40640030860902z" pathFrom="M 60 146.40640030860902L 60 146.40640030860902L 90 146.40640030860902L 90 146.40640030860902L 90 146.40640030860902L 90 146.40640030860902L 90 146.40640030860902L 60 146.40640030860902" cy="7.520320015430457" cx="110" j="1" val="95" barHeight="142.88608029317857" barWidth="30"></path>
                      <path id="SvgjsPath2015" d="M 110 146.40640030860902L 110 64.16256012344361Q 110 60.16256012344361 114 60.16256012344361L 136 60.16256012344361Q 140 60.16256012344361 140 64.16256012344361L 140 64.16256012344361L 140 146.40640030860902Q 140 150.40640030860902 136 150.40640030860902L 114 150.40640030860902Q 110 150.40640030860902 110 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 110 146.40640030860902L 110 64.16256012344361Q 110 60.16256012344361 114 60.16256012344361L 136 60.16256012344361Q 140 60.16256012344361 140 64.16256012344361L 140 64.16256012344361L 140 146.40640030860902Q 140 150.40640030860902 136 150.40640030860902L 114 150.40640030860902Q 110 150.40640030860902 110 146.40640030860902z" pathFrom="M 110 146.40640030860902L 110 146.40640030860902L 140 146.40640030860902L 140 146.40640030860902L 140 146.40640030860902L 140 146.40640030860902L 140 146.40640030860902L 110 146.40640030860902" cy="60.16256012344361" cx="160" j="2" val="60" barHeight="90.24384018516541" barWidth="30"></path>
                      <path id="SvgjsPath2017" d="M 160 146.40640030860902L 160 86.72352016973495Q 160 82.72352016973495 164 82.72352016973495L 186 82.72352016973495Q 190 82.72352016973495 190 86.72352016973495L 190 86.72352016973495L 190 146.40640030860902Q 190 150.40640030860902 186 150.40640030860902L 164 150.40640030860902Q 160 150.40640030860902 160 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 160 146.40640030860902L 160 86.72352016973495Q 160 82.72352016973495 164 82.72352016973495L 186 82.72352016973495Q 190 82.72352016973495 190 86.72352016973495L 190 86.72352016973495L 190 146.40640030860902Q 190 150.40640030860902 186 150.40640030860902L 164 150.40640030860902Q 160 150.40640030860902 160 146.40640030860902z" pathFrom="M 160 146.40640030860902L 160 146.40640030860902L 190 146.40640030860902L 190 146.40640030860902L 190 146.40640030860902L 190 146.40640030860902L 190 146.40640030860902L 160 146.40640030860902" cy="82.72352016973495" cx="210" j="3" val="45" barHeight="67.68288013887407" barWidth="30"></path>
                      <path id="SvgjsPath2019" d="M 210 146.40640030860902L 210 19.040640030860885Q 210 15.040640030860885 214 15.040640030860885L 236 15.040640030860885Q 240 15.040640030860885 240 19.040640030860885L 240 19.040640030860885L 240 146.40640030860902Q 240 150.40640030860902 236 150.40640030860902L 214 150.40640030860902Q 210 150.40640030860902 210 146.40640030860902z" fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 210 146.40640030860902L 210 19.040640030860885Q 210 15.040640030860885 214 15.040640030860885L 236 15.040640030860885Q 240 15.040640030860885 240 19.040640030860885L 240 19.040640030860885L 240 146.40640030860902Q 240 150.40640030860902 236 150.40640030860902L 214 150.40640030860902Q 210 150.40640030860902 210 146.40640030860902z" pathFrom="M 210 146.40640030860902L 210 146.40640030860902L 240 146.40640030860902L 240 146.40640030860902L 240 146.40640030860902L 240 146.40640030860902L 240 146.40640030860902L 210 146.40640030860902" cy="15.040640030860885" cx="260" j="4" val="90" barHeight="135.36576027774814" barWidth="30"></path>
                      <path id="SvgjsPath2021" d="M 260 146.40640030860902L 260 79.20320015430451Q 260 75.20320015430451 264 75.20320015430451L 286 75.20320015430451Q 290 75.20320015430451 290 79.20320015430451L 290 79.20320015430451L 290 146.40640030860902Q 290 150.40640030860902 286 150.40640030860902L 264 150.40640030860902Q 260 150.40640030860902 260 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 260 146.40640030860902L 260 79.20320015430451Q 260 75.20320015430451 264 75.20320015430451L 286 75.20320015430451Q 290 75.20320015430451 290 79.20320015430451L 290 79.20320015430451L 290 146.40640030860902Q 290 150.40640030860902 286 150.40640030860902L 264 150.40640030860902Q 260 150.40640030860902 260 146.40640030860902z" pathFrom="M 260 146.40640030860902L 260 146.40640030860902L 290 146.40640030860902L 290 146.40640030860902L 290 146.40640030860902L 290 146.40640030860902L 290 146.40640030860902L 260 146.40640030860902" cy="75.20320015430451" cx="310" j="5" val="50" barHeight="75.20320015430451" barWidth="30"></path>
                      <path id="SvgjsPath2023" d="M 310 146.40640030860902L 310 41.601600077152256Q 310 37.601600077152256 314 37.601600077152256L 336 37.601600077152256Q 340 37.601600077152256 340 41.601600077152256L 340 41.601600077152256L 340 146.40640030860902Q 340 150.40640030860902 336 150.40640030860902L 314 150.40640030860902Q 310 150.40640030860902 310 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 310 146.40640030860902L 310 41.601600077152256Q 310 37.601600077152256 314 37.601600077152256L 336 37.601600077152256Q 340 37.601600077152256 340 41.601600077152256L 340 41.601600077152256L 340 146.40640030860902Q 340 150.40640030860902 336 150.40640030860902L 314 150.40640030860902Q 310 150.40640030860902 310 146.40640030860902z" pathFrom="M 310 146.40640030860902L 310 146.40640030860902L 340 146.40640030860902L 340 146.40640030860902L 340 146.40640030860902L 340 146.40640030860902L 340 146.40640030860902L 310 146.40640030860902" cy="37.601600077152256" cx="360" j="6" val="75" barHeight="112.80480023145677" barWidth="30"></path>
                      <g id="SvgjsG2009" class="apexcharts-bar-goals-markers" style="pointer-events: none">
                        <g id="SvgjsG2010" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2012" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2014" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2016" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2018" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2020" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2022" className="apexcharts-bar-goals-groups"></g>
                      </g>
                    </g>
                    <g id="SvgjsG2008" class="apexcharts-datalabels" data:realIndex="0"></g>
                  </g>
                  <line id="SvgjsLine2060" x1="0" y1="0" x2="350" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                  <line id="SvgjsLine2061" x1="0" y1="0" x2="350" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                  <g id="SvgjsG2062" class="apexcharts-yaxis-annotations"></g>
                  <g id="SvgjsG2063" class="apexcharts-xaxis-annotations"></g>
                  <g id="SvgjsG2064" class="apexcharts-point-annotations"></g>
                </g>
                <g id="SvgjsG2047" class="apexcharts-yaxis" rel="0" transform="translate(-8, 0)">
                  <g id="SvgjsG2048" class="apexcharts-yaxis-texts-g"></g>
                </g>
                <g id="SvgjsG1997" class="apexcharts-annotations"></g>
              </svg>
              <div class="apexcharts-legend" style="max-height: 100px;"></div>
              <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 75px; top: -17.3375px;">
                <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">Tu</div>
                <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;">
                  <span class="apexcharts-tooltip-marker" style="background-color: rgba(115, 103, 240, 0.16);"></span>
                  <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                    <div class="apexcharts-tooltip-y-group">
                      <span class="apexcharts-tooltip-text-y-label">series-1: </span>
                      <span class="apexcharts-tooltip-text-y-value">95</span>
                    </div>
                    <div class="apexcharts-tooltip-goals-group">
                      <span class="apexcharts-tooltip-text-goals-label"></span>
                      <span class="apexcharts-tooltip-text-goals-value"></span>
                    </div>
                    <div class="apexcharts-tooltip-z-group">
                      <span class="apexcharts-tooltip-text-z-label"></span>
                      <span class="apexcharts-tooltip-text-z-value"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                <div class="apexcharts-yaxistooltip-text"></div>
              </div>
            </div>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 389px; height: 401px;"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
    </div>
        <!--     <div class="col-xl-4 col-6 mb-4">-->
        <!--              <div class="card">-->
        <!--                <div class="card-header header-elements">-->
        <!--                  <h5 class="card-title mb-0">Weekly leave pattern</h5>-->
        <!--                  <div class="card-action-element ms-auto py-0">-->
        <!--                    <div class="dropdown">-->
        <!--                      <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">-->
        <!--                        <i class="ti ti-calendar"></i>-->
        <!--                      </button>-->
        <!--                      <ul class="dropdown-menu dropdown-menu-end">-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <hr class="dropdown-divider">-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a>-->
        <!--                        </li>-->
        <!--                      </ul>-->
        <!--                    </div>-->
        <!--                  </div>-->
        <!--                </div>-->
        <!--                <div class="card-body">-->
        <!--                  <canvas id="barChart" class="chartjs" data-height="400" height="500" style="display: block; box-sizing: border-box; height: 400px; width: 545px;" width="682"></canvas>-->
        <!--                </div>-->
        <!--              </div>-->
        <!--</div>-->
        
    </div>
    
    
      <!--dynamic leave type data-->
      
      
    <!--     <div class="card">-->
    <!--<div class="row">-->
    <!--  <div class="col-md-6 ">-->
    <!--      <h5 class="card-header">Leave Type</h5>-->
    <!--  </div>-->
    <!--  <div class="col-md-6 text-end">-->
    <!--      <button class="btn btn-primary waves-effect waves-light mt-3 m-3" data-bs-toggle="modal" data-bs-target="#backDropModal">Add Type</button>-->
    <!--      <a href="{{url('admin/Leave/home2')}}"  target="_blank" class="btn btn-label-primary me-3">-->
    <!--            <span class="align-middle"> New Leave Page</span>-->
    <!--          </a>-->
    <!--  </div>-->
    <!--</div>-->
    <!--  <div class="card-body">-->
    <!--    @if(count($LeaveType) > 0)-->
    <!--      <div class="row g-4 mb-4">-->
    <!--        @foreach($LeaveType as $key=> $Lea)-->
    <!--        <div class="col-sm-6 col-xl-3">-->
    <!--          <div class="card bg-{{$Lea->theme}} text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            <a id="{{$Lea->id}}" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--            <a class="delete_debtcase" url="{{url('admin/LeaveType/delete/'.$Lea->id)}}" id="{{$Lea->id}}" style="cursor: pointer;"><i class="ti ti-trash ti-sm"></i></a>-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">{{$Lea->leave_type}}</h4>-->
    <!--                  <p class="text-white mt-3">{{$Lea->no_of_leave}}</p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>         -->
    <!--        @endforeach-->
    <!--      </div>-->
    <!--          @else-->
    <!--          <div class="text-center" style="border-bottom: 1px solid #dbdade;border-top: 1px solid #dbdade;">-->
    <!--            <p class="p-2" >No Data Found</p>-->
    <!--          </div>-->
    <!--          @endif-->
    <!--  </div>-->
    <!--</div>-->
    
          <!--dynamic leave type data end -->

    
                               @if($AuthRole->job_role_id == 15 || $AuthRole->job_role_id == 2)

  <div class="card mt-5">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">All Leave's List</h5>
      </div>
       <div class="col-md-6 text-end">
        <a href="{{url('Employee/Leave/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
            @if($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['add'] == 1)
          <a href="{{url('Employee/Leave/add')}}" class="btn btn-primary mt-3 m-3">Add Leave</a>
          @endif
      </div>
    </div>

      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-4">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
                <select name="months" class="form-select" id="months">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select name="year" class="form-select" id="year">  </select>
              </div>
            </div>

                <div class="col-sm-12 col-md-4 d-flex justify-content-center" style="align-self:center;">
                      
                        <form>
                          <div class="input-group input-daterange" id="bs-datepicker-daterange">
                          <input type="date" id="dateRangePicker" placeholder="MM/DD/YYYY" class="form-control fromDate" name="from" value="{{request()->get('from')}}" >
                          <span class="input-group-text">to</span>
                          <input type="date" placeholder="MM/DD/YYYY" class="form-control toDate" name="to" value="{{request()->get('to')}}">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                      </div>
                        </form>
                    </div>
            <div class="col-sm-12 col-md-4 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                   <form method="GET" action="">    
                  <label>Search: <input value="{{$searchTerm}}" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Employee</th>
                <th>Leave Date</th>
                <th>Duration</th>
                <th>Leave Status</th>
                <th>Leave Type</th>
                <th>Action</th>
              </tr>
            </thead>
          <tbody id="result">
              @if(count($Leave) > 0)
              @foreach($Leave as $key=> $user)
               <!-- //employee -->
               @if($user->approved_by == Auth::user()->id && $user->user_id == Auth::user()->id)

                 <tr class="odd">
                      <td>{{ $key+1 }} </td>
                        <td>
                         @if($user->profile_img)

                                                     <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />
                                                    @else

                                                    <img class="rounded-circle"

                                                    style="margin-right: 15px;margin-top: 10px;" 

                                                    src="{{url('public/images/21104.png')}}"

                                                    height="30"

                                                    width="30"

                                                    alt="User avatar" />

                                                    @endif
                        {{$user->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div>
                    <!--<img -->
                    <!--        class="rounded-circle"-->
                    <!--        style="margin-right: 15px;margin-top: 10px;" -->
                    <!--        src="{{$user->profile_img}}"-->
                    <!--        height="30"-->
                    <!--        width="30"-->
                    <!--        alt="User avatar" />{{$user->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div>-->
                          </td>
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
                          @endif
                      </td>
                      <td>

                        @if($user->user_id == Auth::user()->id)
                        @if($user->user_id = Auth::user()->id && $user->RoleID == '2' || $user->RoleID == '3' || $user->RoleID == '5')
                         @switch($user->status)
                                @case('1')
                                  <span class="badge bg-label-success">APPROVED</span>
                                    @break
                                @case('2')
                                  <span class="badge bg-label-danger">UNAPPROVED</span>
                                    @break
                                @case('3')
                                  <span class="badge bg-label-warning">PENDING</span>
                                    @break
                                @default
                              @endswitch 
                        @endif     
                        @else        
                        @if($AuthRole->admin_type_id == '5' || $AuthRole->admin_type_id == '2')
                          <select name="Status" class="form-select" onchange="LeaveStatusUpdate(this.value,{{$user->emp_Id}},{{$user->id}},{{$user->RoleID}},{{Auth::user()->id}},{{$AuthRole->admin_type_id}},{{$AuthRole->admin_type_id}},{{$user->days}})">
                            <option @if($user && $user->status == 3) selected @endif value="3">PENDING</option>
                              <option @if($user && $user->status == 1) selected @endif value="1">APPROVED</option>
                              <option @if($user && $user->status == 2) selected @endif value="2">UNAPPROVED</option>
                              
                          </select>
                        @endif     
                        @endif        
                      </td>
                      <td>{{ $user->leave_type }}</td>
                      <td>
                         @if(in_array('Leave', array_column($RoleAccess, 'per_name')))
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                   
                                    @if($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                        <li><a class="dropdown-item" href="{{url('Employee/Leave/edit/'.$user->id)}}">Edit</a></li>
                                    @elseif($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                        <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Leave/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                                    @else
                                        <li><button class="dropdown-item">No Action</button></li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                       
                      </td>
                    </tr>
                                   @endif

              <!-- //teamLeader -->
               @if($user->approved_by == Auth::user()->id && $user->sendBySatus == 1 && $AuthRole->job_role_id == 5)
                    <tr class="odd">
                      <td>{{ $key+1 }} </td>
                       <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$user->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div>
                          </td>
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
                          @endif
                      </td>
                      <td>
                        @if($user->user_id == Auth::user()->id)
                        @if($user->user_id = Auth::user()->id && $user->RoleID == '2' || $user->RoleID == '3' || $user->RoleID == '5')
                         @switch($user->status)
                                @case('1')
                                  <span class="badge bg-label-success">APPROVED</span>
                                    @break
                                @case('2')
                                  <span class="badge bg-label-danger">UNAPPROVED</span>
                                    @break
                                @case('3')
                                  <span class="badge bg-label-warning">PENDING</span>
                                    @break
                                @default
                              @endswitch 
                        @endif     
                        @else        
                        @if($AuthRole->admin_type_id == '5' || $AuthRole->admin_type_id == '2')
                          <select name="Status" class="form-select" onchange="LeaveStatusUpdate(this.value,{{$user->emp_Id}},{{$user->id}},{{$user->RoleID}},{{Auth::user()->id}},{{$AuthRole->admin_type_id}},{{$user->days}})">
                            <option @if($user && $user->status == 3) selected @endif value="3">PENDING</option>
                              <option @if($user && $user->status == 1) selected @endif value="1">APPROVED</option>
                              <option @if($user && $user->status == 2) selected @endif value="2">UNAPPROVED</option>
                              
                          </select>
                        @endif     
                        @endif        
                      </td>
                      <td>{{ $user->leave_type }}</td>
                      <td>
                         @if(in_array('Leave', array_column($RoleAccess, 'per_name')))
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                   
                                    @if($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                        <li><a class="dropdown-item" href="{{url('Employee/Leave/edit/'.$user->id)}}">Edit</a></li>
                                    @elseif($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                        <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Leave/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                                    @else
                                        <li><button class="dropdown-item">No Action</button></li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                       
                      </td>
                    </tr>
                 @endif
              <!-- //hr -->
               @if($user->approved_by == Auth::user()->id && $user->sendBySatus == 1 && $AuthRole->admin_type_id == 2)
                    <tr class="odd">
                      <td>{{ $key+1 }} </td>
                      <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$user->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div>
                          </td>
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
                          @endif
                      </td>
                      <td>
                        @if($user->user_id == Auth::user()->id)
                        @if($user->user_id = Auth::user()->id && $user->RoleID == '2' || $user->RoleID == '3' || $user->RoleID == '5')
                         @switch($user->status)
                                @case('1')
                                  <span class="badge bg-label-success">APPROVED</span>
                                    @break
                                @case('2')
                                  <span class="badge bg-label-danger">UNAPPROVED</span>
                                    @break
                                @case('3')
                                  <span class="badge bg-label-warning">PENDING</span>
                                    @break
                                @default
                              @endswitch 
                        @endif     
                        @else        
                        @if($AuthRole->admin_type_id == '5' || $AuthRole->admin_type_id == '2')
                          <select name="Status" class="form-select" onchange="LeaveStatusUpdate(this.value,{{$user->emp_Id}},{{$user->id}},{{$user->RoleID}},{{Auth::user()->id}},{{$AuthRole->admin_type_id}},{{$user->days}})">
                            <option @if($user && $user->status == 3) selected @endif value="3">PENDING</option>
                              <option @if($user && $user->status == 1) selected @endif value="1">APPROVED</option>
                              <option @if($user && $user->status == 2) selected @endif value="2">UNAPPROVED</option>
                              
                          </select>
                        @endif     
                        @endif        
                      </td>
                      <td>{{ $user->leave_type }}</td>
                      <td>
                         @if(in_array('Leave', array_column($RoleAccess, 'per_name')))
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                   
                                    @if($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                        <li><a class="dropdown-item" href="{{url('Employee/Leave/edit/'.$user->id)}}">Edit</a></li>
                                    @elseif($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                        <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Leave/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                                    @else
                                        <li><button class="dropdown-item">No Action</button></li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                       
                      </td>
                    </tr>
                 @endif
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="9">No Data Found</td>
              </tr>
              @endif
            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $Leave->links() }}
          </div>
        </div>
      </div>
  </div>        @endif
                               @if($AuthRole->job_role_id == 15 || $AuthRole->job_role_id == 2)

   <div class="row mt-5">
    <div class="col-md-6">
      <div class="card">
          <div  class="card-header"><h5>Working From Home</h5></div>
          <div  class="card-body">
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Employee</th>
                <th>Leave Date</th>
                <th>Duration</th>
              </tr>
            </thead>
            <tbody>
              @if(count($workfromhome) > 0)
              @foreach($workfromhome as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                 <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$user->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div>
                          </td>
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
                      @endif
                  </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="9">No Data Found</td>
              </tr>
              @endif
            </tbody>
            </table>
          </div>
          <div  class="card-footer p-1" style="float: right;">
              {{ $workfromhome->links() }}
          </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
         <div  class="card-header"><h5>Leaves on Today</h5></div>
          <div  class="card-body">
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Employee</th>
                <th>Leave Date</th>
                <th>Duration</th>
              </tr>
            </thead>
            <tbody>
              @if(count($todayonleave) > 0)
              @foreach($todayonleave as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                   <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$user->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div>
                          </td>
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
                      @endif
                  </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="9">No Data Found</td>
              </tr>
              @endif
            </tbody>
            </table>

          </div>
          <div  class="card-footer p-1" style="float: right;">
              {{ $todayonleave->links() }}
          </div>
      </div>
    </div>
</div> <!-- Timeline Basic-->

@endif
    <div class="col-xl-6 mb-4 mb-xl-0">
      <div class="card">
        <h5 class="card-header">My Leaves</h5>
        <div class="card-body pb-0">
          <ul class="timeline mb-0">
              @if($myleaves)
              @foreach($myleaves as $myleave)
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                  <h6 class="mb-0">29 September 2023 - 30 September 2023</h6>
                  @php
                      if($myleave->status == 1){
                       $color = 'success';
                        $status = 'APPROVED';
                        }
                        elseif($myleave->status == 2){
                        $color = 'danger';
                        $status = 'UNAPPROVED';
                        }
                        elseif($myleave->status == 3){
                        $color = 'warning';
                         $status = 'PENDING';
                         }
                  @endphp
                  
                  <button class="btn btn-{{$color}} waves-effect waves-light" style="
    padding: 6px 5px;
    margin-bottom: 9px;
">{{$status}}</button>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-2">
                  <div class="d-flex align-items-center">
                    <span>{!! $myleave->description !!}</span>
                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                    <span>{{$myleave->leave_type}}</span>
                  </div>
                  <div>
                    <span class="text-muted">{{$myleave->created_at}}</span>
                  </div>
                </div>
                <!--<div class="d-flex align-items-center">-->
                <!--  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">-->
                <!--  <span class="mb-0">bookingCard.pdf</span>-->
                <!--</div>-->
              </div>
            </li>
            @endforeach
            @endif
          
          </ul>
        </div>
      </div>
    </div>
    <!-- /Timeline Basic -->
    </div>
    </div>
<!--Modal type leave-->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <form class="modal-content" action="{{url('Employee/LeaveType/store')}}" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Leave Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="col mb-0">
            <label for="leave_type" class="form-label">Type <span class="text-danger">*</span></label>
            <input type="text" name="leave_type" class="form-control" placeholder="Enter Leave type"required>
          </div>
          <div class="col mb-0">
            <label for="no_of_leave" class="form-label">Number of Leave <span class="text-danger">*</span></label>
            <input type="number" name="no_of_leave" class="form-control"required>
          </div>
        </div>
        <div class="row mt-3">
            <label for="leave_type" class="form-label">Theme <span class="text-danger">*</span></label>
          <div class="col-md-6">
            <div class="form-check form-check-primary">
              <input class="form-check-input" required  type="radio" name="theme" value="primary" id="customCheckPrimary">
              <label class="form-check-label" for="customCheckPrimary"><span class="text-primary">Primary</span></label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-secondary">
              <input class="form-check-input" required  type="radio" name="theme" value="secondary" id="customCheckSecondary">
              <label class="form-check-label" for="customCheckSecondary"><span class="text-secondary">Secondary</span></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-success">
              <input class="form-check-input" required  type="radio" name="theme" value="success" id="customCheckSuccess">
              <label class="form-check-label" for="customCheckSuccess"><span class="text-success">Success</span></label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-danger">
              <input class="form-check-input" required  type="radio" name="theme" value="danger" id="customCheckDanger">
              <label class="form-check-label" for="customCheckDanger"><span class="text-danger">Danger</span></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-warning">
              <input class="form-check-input" required  type="radio" name="theme" value="warning" id="customCheckWarning">
              <label class="form-check-label" for="customCheckWarning"><span class="text-warning"> Warning</span> </label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-info">
              <input class="form-check-input" required  type="radio" name="theme" value="info" id="customCheckInfo">
              <label class="form-check-label" for="customCheckInfo"><span class="text-info"> Info</span> </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-dark">
              <input class="form-check-input" required  type="radio" name="theme" value="dark" id="customCheckDark">
              <label class="form-check-label" for="customCheckDark"><span class="text-dark"> Dark</span> </label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
      </div>
    </form>
  </div>
</div>
<!--Modal type leave End-->
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog"></div>
<script>
  function editCategory(element) {
      var cate_id = $(element).attr('id');

      $.ajax({
          url: "{{ url('Employee/LeaveType/edit') }}",
          method: 'GET',
          data: { id: cate_id },
          success: function (data) {
              if (data && typeof data == 'string') {
                  $('#showedit').html(data);
                  $('#showedit').modal('show');
              } else {
                  $('#showedit').html('<div>No Data Found</div>');
                  $('#showedit').modal('show');
              }
          },
          error: function () {
              $('#showedit .modal-content').html('<div>Error fetching data.</div>');
              $('#showedit').modal('show');
          }
      });
  }
</script>
<script>
    $(document).ready(function () {

        $(".delete_debtcase").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Delete'
                    },
                },
                callback: function (result) {
                    if (result) {
                        window.location.href = url;
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        var currentYear = new Date().getFullYear();
        var startYear = 2015;
        var $selectYear = $('#year');
        var $selectMonth = $('#months');

        // Populate the select elements with options
        for (var year = currentYear; year >= startYear; year--) {
            $selectYear.append($('<option>', {
                value: year,
                text: year
            }));
        }

        // Handle the change event of the select elements
        $selectYear.on('change', fetchData);
        $selectMonth.on('change', fetchData);

         function fetchData() {
            var selectedYear = $selectYear.val();
            var selectedMonth = $selectMonth.val();

            // Make an AJAX request to fetch data based on the selected year and month
            $.ajax({
                url: "{{ url('Employee/Leave/Show_leaves_yeardata') }}",
                method: 'GET',
                data: { year: selectedYear, month: selectedMonth },
                success: function (data) {
                    // Handle the successful response
                    $('#result').empty(); // Clear previous content

                    if (data.length > 0) {
                        $('#result').html(data);
                    } else {
                        $('#result').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function () {
                    $('#result').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }

         // Donut Chart
  // --------------------------------------------------------------------
  
  
   let cardColor, headingColor, labelColor, borderColor, legendColor;

  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    headingColor = config.colors_dark.headingColor;
    labelColor = config.colors_dark.textMuted;
    legendColor = config.colors_dark.bodyColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  }

  const chartColors = {
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
  
  const leaveTypePercentages = [@foreach($LeaveType as $type){{$leaveTypePercentages[$type->id]}},@endforeach];
const leaveTypeLabels = [@foreach($LeaveType as $type)'{{$type->leave_type}}',@endforeach];

const totalPercentage = {{$totalPercentage}};


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
          return parseInt(val, 10) + '%';
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
    formatter: function (val) {
        return parseFloat(val).toFixed(17) + '%';
    }
},
total: {
    show: true,
    fontSize: '1.5rem',
    color: headingColor,
    label: 'Total Leaves',
    formatter: function (w) {
        return parseFloat(totalPercentage).toFixed(2) + '%';
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

function LeaveStatusUpdate(status, empId, LeaveId, RoleID, ApproveID, AuthRole,days) {
    $.ajax({
        url: "{{ url('Employee/Leave/LeaveStatusUpdate') }}",
        method: 'POST', // Assuming you want to send data with POST request
        data: {
            _token: '{{ csrf_token() }}', // Include the CSRF token
            status: status,
            empId: empId,
            LeaveId: LeaveId,
            RoleID: RoleID,
            ApproveID: ApproveID,
            AuthRole: AuthRole,
            days: days,
        },
        success: function (response) {
            if (response.success == true) {
                $('#ResMsg').show().html(response.message);

                // Hide #ResMsg after 3 seconds
                setTimeout(function () {
                    $('#ResMsg').hide(500);
                }, 3000);
            }
        },
        error: function () {
            alert("Oops! Some technical error occurred.");
        }
    });
}

</script>

@endsection