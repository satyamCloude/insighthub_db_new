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
      <div
      class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
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
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{$OpenTicket}}</p>
                        <p class="mb-0">Open Tasks</p>
                      </li>
                      <li class="d-flex align-items-center mb-2">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{$TProJect}}</p>
                        <p class="mb-0">Projects</p>
                      </li>
                    </ul>
                  </div>
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-4 align-items-center">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{$OpenTask}}</p>
                        <p class="mb-0">Open Tickets</p>
                      </li>
                      <li class="d-flex align-items-center mb-2">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">12%</p>
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

  <!-- Sales Overview -->
  <div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h4 class="card-title mb-1">Task Overview</h4>
        </div>
        <div style="display: flex;justify-content: space-between;">
          <small class="d-block mb-1 text-muted">Total Tasks</small>
          <p class="card-text text-success">{{$TTask}}</p>
        </div>
      </div>
      <div class="card-body">
        <div class="row py-4">
          <div class="col-4">
            <div class="d-flex gap-2 align-items-center mb-2">
              <span class="badge bg-label-info p-1 rounded"
              ><i class="ti ti-shopping-cart ti-xs"></i
              ></span>
              <p class="mb-0">Pending</p>
            </div>
            <h5 class="mb-0 pt-1 text-nowrap">{{$OpenTask}}</h5>
            <!-- <small class="text-muted"></small> -->
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
            <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">{{$TasksOverDue}}</h5>
            <!-- <small class="text-muted"></small> -->
          </div>
        </div>
        <div class="d-flex align-items-center mt-4">
          <div class="progress w-100" style="height: 8px">
            <div
            class="progress-bar bg-info"
            style="width: {{$OpenTask}}%"
            role="progressbar"
            aria-valuenow="70"
            aria-valuemin="0"
            aria-valuemax="100"></div>
            <div
            class="progress-bar bg-primary"
            role="progressbar"
            style="width: {{$TasksOverDue}}%"
            aria-valuenow="30"
            aria-valuemin="0"
            aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Sales Overview -->

  <!-- Revenue Generated -->
  <div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h4 class="card-title mb-1">Project Overview</h4>
        </div>
        <div style="display: flex;justify-content: space-between;">
          <small class="d-block mb-1 text-muted">Total Projects</small>
          <p class="card-text text-success">{{$TProJect}}</p>
        </div>
      </div>
      <div class="card-body">
        <div class="row py-4">
          <div class="col-4">
            <div class="d-flex gap-2 align-items-center mb-2">
              <span class="badge bg-label-info p-1 rounded"
              ><i class="ti ti-shopping-cart ti-xs"></i
              ></span>
              <p class="mb-0">Ongoing</p>
            </div>
            <!-- <h5 class="mb-0 pt-1 text-nowrap">2</h5> -->
            <small class="text-muted">{{$ProJectGoingoN}}</small>
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
            <small class="text-muted">{{$ProJectOverDue}}</small>
          </div>
        </div>
        <div class="d-flex align-items-center mt-4">
          <div class="progress w-100" style="height: 8px">
            <div
            class="progress-bar bg-info"
            style="width: {{$ProJectGoingoN}}%"
            role="progressbar"
            aria-valuenow="70"
            aria-valuemin="0"
            aria-valuemax="100"></div>
            <div
            class="progress-bar bg-primary"
            role="progressbar"
            style="width: {{$ProJectOverDue}}%"
            aria-valuenow="30"
            aria-valuemin="0"
            aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Revenue Generated -->

  <!-- Earning Reports -->
  <div class="col-lg-6 mb-4">
    <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
      <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
        <h4 class="f-18 f-w-500 mb-0">Shift Schedule</h4>

        <!-- <a href="{{url('Employee/TimeShift/home')}}" type="button" class="btn-primary rounded f-14 p-2 btn-sm" id="view-shifts">Employee Shift</a> -->
        <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;" autocomplete="off">
        <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;" autocomplete="off">
        <input type="email" name="f_email" class="autocomplete-password" readonly="" style="opacity: 0;position: absolute;" autocomplete="off">
        <input type="text" name="f_slack_username" class="autocomplete-password" readonly="" style="opacity: 0;position: absolute;" autocomplete="off">

      </div>

      <div class="card-body p-0 h-200 table-responsive mb-2" style="overflow-x:auto;">
          <table class="table" id="example">
              <tbody>
                  @php
                      $currentDate = \Carbon\Carbon::now();
                      $startOfWeek = $currentDate->startOfWeek();
                  @endphp

                  @for ($i = 0; $i < 7; $i++)
                      <tr>
                          <td class="pl-20">{{ $startOfWeek->toDateString() }}</td>
                          <td>{{ $startOfWeek->format('l') }}</td>
                          <td>
                              <span class="badge badge-primary" style="background-color:{{ $TimeShift->Colorname }}">{{ $TimeShift->shift_name }}</span>
                          </td>
                          <td class="pr-20 text-right">
                              This is default shift
                          </td>
                      </tr>

                      @php
                          // Reset the date to the beginning of the loop
                          $startOfWeek->addDay();
                      @endphp
                  @endfor
              </tbody>
          </table>
      </div>
    </div>
  </div>
  <!--/ Earning Reports -->

  <!-- My Task -->
  <div class="col-md-6 mb-4">
    <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
      <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
        <h4 class="f-18 f-w-500 mb-0">My Task</h4>
        <!-- <a href="{{url('Employee/Task/home')}}" type="button" class="btn-primary rounded f-14 p-2 btn-sm">More</a> -->
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
                @foreach($TaskD as $Tass)
                      <tr>
                          <td>#{{$Tass->id}}</td>
                          <td>{{$Tass->task_name}}</td>
                          <td>@switch($Tass->status_id)
                          @case('1')
                            <span class="badge bg-label-primary">InProgress</span>
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
                          @endswitch</td>
                          <td class="text-danger">{{$Tass->deadline}}</td>
                      </tr>
                @endforeach      
              </tbody>
          </table>
      </div>
    </div>
</div>
<!--/ My Task -->

<!-- Sales By Country -->

<!--/ Sales By Country -->

<!-- Total Earning -->
<div class="col-xl-6 col-md-6  mb-4">
  <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
    <div class="card-header d-flex justify-content-between">
      <div class="card-title mb-0">
        <h5 class="mb-0">On Leave Today</h5>
        <small class="text-muted">{{count($OnLeaves)}} Employees</small>
      </div>
      <div class="dropdown">
        <button
        class="btn p-0"
        type="button"
        id="sourceVisits"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        <i class="ti ti-dots-vertical ti-sm text-muted"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sourceVisits">
        <!-- <a class="dropdown-item" href="{{url('Employee/Leave/home')}}">View All</a> -->
      </div>
    </div>
    </div>
    <div class="card-body">
      <ul class="list-unstyled mb-0">
          @foreach($OnLeaves as $Leaves)
          <li class="mb-3 pb-1">
            <div class="d-flex align-items-start">
              <div class="badge bg-label-secondary p-2 me-3 rounded">
                <img src="{{$Leaves->profile_img}}" alt class="h-auto rounded-circle"  style="width:40px;"/>
              </div>
              <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                <div class="me-2">
                  <h6 class="mb-3">{{$Leaves->first_name}}</h6>
                  <small class="text-muted">{{$Leaves->dptname}}</small>
                </div>
                <div class="d-flex align-items-center">
                  @switch($Leaves->status)
                    @case('1')
                      <span class="ms-3 badge bg-label-success">APPROVED</span>
                        @break
                    @case('2')
                      <span class="ms-3 badge bg-label-danger">UNAPPROVED</span>
                        @break
                    @case('3')
                      <span class="ms-3 badge bg-label-warning">PENDING</span>
                        @break
                    @default
                  @endswitch
                </div>
              </div>
            </div>
          </li>
          @endforeach
      </ul>
    </div>
  </div>
</div>
<div class="col-xl-6 col-md-6  mb-4"> 
      <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 396px;">
        <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
          <h4 class="f-18 f-w-500 mb-0">Tickets</h4>
        </div>
        <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
          <table class="table" id="example">
            <thead class="">
              <tr>
                <th>#Tickets</th>
                <th>Ticket Subject</th>
                <th>Status</th>
                <th class="text-right pr-20">Requested On</th>
              </tr>
            </thead>
            <tbody>
              @if(count($LTicket) > 0)
                @foreach($LTicket as $ticket)
                  <tr>
                    <td>#{{$ticket->id}}</td>
                    <td>{{$ticket->subject}}</td>
                    <td>{{$ticket->status}}</td>
                    <td>{{$ticket->date}}</td>
                  </tr>
                  @endforeach
                @else
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
              @endif
            </tbody>
          </table>
        </div>
    </div>
</div>
<!--/ Source Visit -->
<div class="col-xl-6 col-md-6  mb-4">
  <div class="card app-calendar-wrapper bg-white border-0 b-shadow-4 mb-3">
    <div class="row g-0">
      <!-- Calendar & Modal -->
        <div class="col app-calendar-content">
                    <div class="card shadow-none border-0">
                      <div class="card-body pb-0">
                        <!-- FullCalendar -->
                        <div id="calendar"></div>
                      </div>
                    </div>
                    <div class="app-overlay"></div>
                    <!-- FullCalendar Offcanvas -->
                    <div
                      class="offcanvas offcanvas-end event-sidebar"
                      tabindex="-1"
                      id="addEventSidebar"
                      aria-labelledby="addEventSidebarLabel">
                      <div class="offcanvas-header my-1">
                        <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Event</h5>
                        <button
                          type="button"
                          class="btn-close text-reset"
                          data-bs-dismiss="offcanvas"
                          aria-label="Close"></button>
                      </div>
                      <div class="offcanvas-body pt-0">
                        <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                          <div class="mb-3">
                            <label class="form-label" for="eventTitle">Title</label>
                            <input
                              type="text"
                              class="form-control"
                              id="eventTitle"
                              name="eventTitle"
                              placeholder="Event Title" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="eventLabel">Label</label>
                            <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                              <option data-label="primary" value="Business" selected>Business</option>
                              <option data-label="danger" value="Personal">Personal</option>
                              <option data-label="warning" value="Family">Family</option>
                              <option data-label="success" value="Holiday">Holiday</option>
                              <option data-label="info" value="ETC">ETC</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="eventStartDate">Start Date</label>
                            <input
                              type="text"
                              class="form-control"
                              id="eventStartDate"
                              name="eventStartDate"
                              placeholder="Start Date" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="eventEndDate">End Date</label>
                            <input
                              type="text"
                              class="form-control"
                              id="eventEndDate"
                              name="eventEndDate"
                              placeholder="End Date" />
                          </div>
                          <div class="mb-3">
                            <label class="switch">
                              <input type="checkbox" class="switch-input allDay-switch" />
                              <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                              </span>
                              <span class="switch-label">All Day</span>
                            </label>
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="eventURL">Event URL</label>
                            <input
                              type="url"
                              class="form-control"
                              id="eventURL"
                              name="eventURL"
                              placeholder="https://www.google.com" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="eventLocation">Location</label>
                            <input
                              type="text"
                              class="form-control"
                              id="eventLocation"
                              name="eventLocation"
                              placeholder="Enter Location" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="eventDescription">Description</label>
                            <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
                          </div>
                          <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
                            <div>
                              <button type="submit" class="btn btn-primary btn-add-event me-sm-3 me-1">Add</button>
                              <button
                                type="reset"
                                class="btn btn-label-secondary btn-cancel me-sm-0 me-1"
                                data-bs-dismiss="offcanvas">
                                Cancel
                              </button>
                            </div>
                            <div><button class="btn btn-label-danger btn-delete-event d-none">Delete</button></div>
                          </div>
                        </form>
                      </div>
                    </div>
        </div>
        <!-- /Calendar & Modal -->
      </div>
    </div>
</div>
<div class="col-xl-6 col-md-6  mb-4"> 
 <div class="card bg-white border-0 b-shadow-4 mb-3" style="height: 737px;">
    <div class="d-flex justify-content-between b-shadow-4 p-20" style="box-shadow: 0 0 4px 0 #e8eef3;display:flex;align-items:center;padding:20px;">
      <p class="mb-0 f-18 f-w-500"> Notices </p>
      <!-- <a href="{{url('Employee/Notice/home')}}" class="btn btn-sm btn-primary text-white"> View </a> -->
    </div>
    <div class="b-shadow-4 cal-info  ps ps--active-y" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" id="empDashNotice" style="height: 430px; overflow: hidden;">
      @if(count($Notice) > 0)
      @foreach($Notice as $Noti)
      <div class="card border-0 b-shadow-4 p-20 rounded-0" style="box-shadow: 0 0 4px 0 #e8eef3;padding:20px;border-radius: 0!important;word-wrap: break-word;
                  background-clip: border-box;
                  background-color: #fff;
                  border: 1px solid rgba(0,0,0,.125);
                  border-radius: 0.25rem;
                  display: flex;
                  flex-direction: column;
                  min-width: 0;
                  position: relative; ">
      <div class="card-horizontal" style="display: flex;flex: 1 1 auto;">
          <div class="card-header m-0 p-0 bg-white rounded" style="border: 1px solid #616e80!important;height: 45px;width: 37px;padding:0px; margin:0px;">
            <span class="f-12 p-1 " style="border-bottom: 1px solid #616e80!important;display:block;line-height: 17px;text-align: center;padding: 0.25rem!important;font-size:13px !important;">{{ \Carbon\Carbon::parse($Noti->Applieddate)->format('M') }}</span>
            <span class="f-13 f-w-500 rounded-bottom" style="display: block;line-height: 17px;text-align: center;border-bottom-left-radius: 0.25rem!important;font-size: 13px;font-size: 12px;
            ">{{ \Carbon\Carbon::parse($Noti->Applieddate)->format('d') }}</span>
          </div>
          <div class="card-body border-0 p-0 ml-3" style="padding: 0!important; margin-left: 1rem!important;border: 0!important; flex: 1 1 auto;min-height: 1px;">
              <h4 class="card-title f-14 font-weight-normal mb-0" style="line-height: 21px;font-weight:normal;margin-bottom:0px;font-size:14px;">
                <a href="javascript:void(0)" class="openRightModal text-darkest-grey" style="color:#4d4f5c!important;">{{$Noti->notice}}</a>
              </h4>
          </div>
      </div>
    </div>
      @endforeach
    @else
    <div class="align-items-center d-flex flex-column text-lightest p-20 w-100 mt-5">
      <i class="fa-solid fa-list-check"></i>
        <div class="f-15 mt-4">
            - No record found. -
        </div>
    </div>
    @endif
    </div>
  </div>                                            
</div>
<!-- Projects table -->

<!--/ Projects table -->
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
              // alert(clockStatus);
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
              // alert('Invalid response format');
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