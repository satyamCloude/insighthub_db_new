
<div class="row g-4 mb-4 OverviewScreen">
   @if($moduleSetting->clients == 1)
    <div class="col-sm-6 col-xl-3">
      <a class="text-dark" href="{{url('admin/Client/home')}}">
         <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Total Clients</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0">0</p> -->
              </div>
              <p class="mb-0">{{$TClient}}</p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-solid fa-users mt-3"></i>
              </span>
            </div>
          </div>
        </div>
         </div>
      </a>
    </div>
    @endif
    @if($moduleSetting->employees == 1)

    
    
    <div class="col-sm-6 col-xl-3">
         <a class="text-dark" href="{{url('admin/Employee/home')}}">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                    <span>Total Employees</span>
                    <div class="d-flex align-items-center my-2">
                      <h3 class="mb-0 me-2"></h3>
                      <!-- <p class="text-success mb-0"></p> -->
                    </div>
                    <p class="mb-0">{{$TOEMP}}</p>
                  </div>
                  <div class="">
                    <span class="">
                      <i class="fa-solid fa-user mt-3"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
         </a>
    </div>
    
   
    @endif
    @if($moduleSetting->projects == 1)
    <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span>Total Projects</span>
                <div class="d-flex align-items-center my-2">
                  <h3 class="mb-0 me-2"></h3>
                  <!-- <p class="text-danger mb-0"></p> -->
                </div>
                <p class="mb-0">{{$TProJect}}</p>
              </div>
              <div class="">
                <span class="">
                 <i class="fa-solid fa-layer-group mt-3"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
    @endif
    @if($moduleSetting->invoices == 1)
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Due Invoices</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0">{{ $DueInvoices }}</p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-solid fa-file-invoice mt-3"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Hours Logged</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0">{{$totalTimeFormatted}}</p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-regular fa-clock mt-3"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if($moduleSetting->invoices == 1)
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Pending Tasks</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0">{{$PendingTasksC}}</p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-solid fa-list-check mt-3"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
    @if($moduleSetting->attendance == 1)
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Today Attendance</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0">{{ $attendanceCount }}</p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-solid fa-calendar mt-3"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
       @if($moduleSetting->tickets == 1)

    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Unresolved Tickets</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0">{{ $countOpenTkt }}</p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-solid fa-ticket mt-3"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
  <div class="row g-4 mb-4 OverviewScreen">

    <div class="col-sm-6 col-xl-6" style="300px">
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
    
    <div class="col-lg-6" style="300px">

      <div class="card bg-white border-0 b-shadow-4 mb-3 table-height" style="100%">

        <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-3">

          <strong class="f-18 f-w-500 mb-0">Recent Follow Up</strong>

          <a href="{{url('admin/Leads/recent_follow_ups')}}" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>

          <!-- <a href="{{url('admin/TimeShift/home')}}" type="button" class="btn-primary rounded f-14 p-2 btn-sm" id="view-shifts">Employee Shift</a> -->

          <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;" autocomplete="off">

          <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;"

            autocomplete="off">

          <input type="email" name="f_email" class="autocomplete-password" readonly=""

            style="opacity: 0;position: absolute;" autocomplete="off">

          <input type="text" name="f_slack_username" class="autocomplete-password" readonly=""

            style="opacity: 0;position: absolute;" autocomplete="off">

        </div>

        <div class="card-body table-responsive mb-2" style="overflow-x:auto;">

          <table class="table" id="example">

            <thead>

               <tr>
                      <!-- <th>EmpId</th> -->
                      <th>Client</th>
                      <th>Mobile</th>
                      <th>Requirement</th>
                      <th>Date</th>
                      <th>TIME</th>
                  </tr>

            </thead>

              <tbody class="table-border-bottom-0">
                  @foreach($RecentFollowUp as $key => $lst)
                      <tr>
                          <!-- <td>{{ $key+1 }}</td> -->
                        <td>
                            @if($lst && $lst->leads_client_first_name) 
                                {{ $lst->leads_client_first_name }} 
                                {{ $lst->leads_client_last_name }} 
                            @endif
                        </td>
                        <td>
                            @if($lst && $lst->phone_number) 
                                {{ $lst->phone_number }} 
                            @endif
                        </td>
                        <td>
                            @if($lst && $lst->requirement) 
                                {!! $lst->requirement !!} 
                            @endif
                        </td>
                        <td>
                            @if($lst && $lst->follow_up_next) 
                                {{ $lst->follow_up_next }} 
                            @endif
                        </td>
                        <td>
                            @if($lst && $lst->start_time) 
                                {{ $lst->start_time }} 
                            @endif
                        </td>
                      </tr>
                  @endforeach
              </tbody>


          </table>

        </div>

      </div>

    </div>
    
       @if($moduleSetting->leaves == 1)

    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
         <div class="card-header">
               <div class="content-left">
                 <strong>Pending Leaves</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>
         <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
             <thead>
                  <tr>
                      <!-- <th>EmpId</th> -->
                      <th>Name of Emp</th>
                      <th>Leave Start date</th>
                      <th>Leave End date</th>
                      <!-- <th>Leave type</th> -->
                      <th>Paid</th>
                  </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  @foreach($PendingLeaves as $key => $lst)
                      <tr>
                          <!-- <td>{{ $key+1 }}</td> -->
                          <td style="display: flex;">
                              @if($lst && $lst->profile_img)
                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{isset($lst->profile_img) ? $lst->profile_img : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />  
                              @endif
                              &nbsp;&nbsp; 
                            <a href="{{ url('admin/Client/view/' . $lst->id) }}"> <div> 
                                @if($lst && $lst->first_name) 
                                    {{ $lst->first_name }} {{ $lst->last_name }} (#{{ $lst->id }})
                                @endif 
                                @if($lst->desname)
                                    <br/>
                                    {{$lst->desname}}
                                @endif 
                            </div>
                            </a>
                          </td>
                          <td>
                              @if($lst && $lst->start_date) 
                                {{ $lst->start_date }} 
                              @endif
                          </td>
                          <td>
                              @if($lst && $lst->end_date) 
                                {{ $lst->end_date }}
                              @endif
                          </td>
                          <!-- <td>@if($lst && $lst->leave_type) {{ $lst->leave_type }} @endif</td> -->
                          <td><span class="badge bg-label-primary me-1">Not Paid</span></td>
                          <!-- Your other table cell content here -->
                      </tr>
                  @endforeach
              </tbody>

            </table>
              </div>
            
         </div>
      </div>
    </div>
    @endif
           @if($moduleSetting->tickets == 1)

    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
        <div class="card-header">
               <div class="content-left">
                 <strong>Open Tickets</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>

         <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                   <thead>
                      <tr>
                        <th>Ticket Id</th>
                        <th>Subject</th>
                        <th>Assign to</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                      <tbody class="table-border-bottom-0">
                  @foreach($OpenTicket as $key => $lst)
                      <tr>
                    <td> <a href="{{url('admin/Ticket/home')}}" type="button"># {{ $lst->id }}</a></td>
                     <td>@if($lst && $lst->subject) {{ $lst->subject }} @endif</td>
                          <!-- <td>@if($lst && $lst->ccid) {{ $lst->ccid }} @endif</td> -->
                            <td>
                               
                               @if($lst && $lst->emp_id) 
                              <div class="parent d-flex">
                                            <div class="child1">
                                                 @if($lst->profile_img)
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$lst->profile_img}}" height="30" width="30" alt="User avatar" />
                                                    @else
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                    @endif
                                            </div>
                                            <div class="child2">
                                                  {{$lst->first_name }} {{$lst->last_name }} | {{$lst->emp_id }} <br> <span style="color:#6e6c76;font-size:85%">({{$lst->job_role_name }})</span>
                                            </div>
                                        </div>
                                        @else
                                        --
                                       @endif
                           
                           </td>
                          <td>
                            @if($lst && $lst->status == 1) 
                                <span class="badge bg-label-success me-1">
                                    Open
                              </span>
                              @else
                               <span class="badge bg-label-success me-1">
                                    Open
                              </span>
                           @endif
                            </td>
                      </tr>
                  @endforeach
              </tbody>

                  </table>
              </div>
            
         </div>
      </div>
    </div>
        @endif
           @if($moduleSetting->tasks == 1)

    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
         <div class="card-header">
               <div class="content-left">
                 <strong>Pending Tasks</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>
         <div class="card-body">
                <div class="table-responsive text-nowrap">
                   <table class="table border-top">
                        <thead>
                          <tr>
                            <th>Project Name</th>
                            <th>Leader</th>
                            <th>Team</th>
                            <th class="w-px-200">Status</th>
                            <th>Deadline</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($PendingTasks) > 0)
                        @foreach($PendingTasks as $key=> $Inventor)
                        <tr class="odd">
                            <td>@if($Inventor && $Inventor->project_name) {{ $Inventor->project_name }} @endif</td>
                            <td><div class="avatar me-2"><img data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-dark" data-bs-original-title="@if($Inventor && $Inventor->project_manager_name) {{ $Inventor->project_manager_name }} @endif" @if($Inventor && $Inventor->project_manager_picture) src="{{ $Inventor->project_manager_picture }}" @endif  alt="Avatar" class="rounded-circle" ></div></td>
                            <td>
                              <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                                 @php $teamlead =  \App\Models\User::whereIn('id', explode(',',$Inventor->team_id))->where('type',4)->get() @endphp
                                @foreach($teamlead as $teaml)
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="{{$teaml->first_name}}">
                                  <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{isset($teaml->profile_img) ? $teaml->profile_img : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                </li>
                                  @endforeach
                              </ul>
                            </td>
                            <td>
                              <div class="progress">@switch($Inventor->status_id)
                                    @case('1')
                                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width:{{$Inventor->status_pro}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">{{$Inventor->status_pro}}%</div>
                                        @break
                                    @case('2')
                                     <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width:{{$Inventor->status_pro}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">{{$Inventor->status_pro}}%</div>
                                        @break
                                    @case('3')
                                    <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width:{{$Inventor->status_pro}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">{{$Inventor->status_pro}}%</div>
                                        @break
                                    @case('4')
                                     <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width:{{$Inventor->status_pro}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">{{$Inventor->status_pro}}%</div>
                                        @break
                                    @default
                                          <span></span>
                                    @endswitch
                              </div>
                            </td>
                            <td>@if($Inventor && $Inventor->deadline) {{ $Inventor->deadline }} @endif</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td class="text-center" colspan="8">No Data Found</td>
                        </tr>
                        @endif 
                            </tbody>
                  </table>
              </div>
         </div>
      </div>
    </div>
    
            @endif

    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
         <div class="card-header">
               <div class="content-left">
                 <strong>Follow Up</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>
         <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                   <thead class="">
                    <tr>
                      <th>Created</th>
                      <th>Next Follow Up</th>
                      <th>Remark</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($LeadsFollowup) > 0)
                    @foreach($LeadsFollowup as $Followup)
                    <tr>
                        <td>{{$Followup->created_at}}</td>
                        <td>{{date('d-m-Y',strtotime($Followup->follow_up_next))}}</td>
                        <td>{{$Followup->remark}}</td>
                         <td>
                                @switch($Followup->status)
                                @case('0')
                                <span class="badge bg-label-primary">Upcoming</span>
                                @break
                                @case('1')
                                <span class="badge bg-label-success">Completed</span>
                                @break
                                @case('2')
                                <span class="badge bg-label-danger">Due</span>
                                @break
                                @default
                                <span></span>
                                @endswitch
                            </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td></td>
                        <td>No data found</td>
                        <td></td>
                    </tr>
                    @endif
                  </tbody>
                  </table>
              </div>
            
         </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
         <div class="card-header">
               <div class="content-left">
                 <strong>Project Activity Timeline</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>
         <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
              @if(count($ProActiTime) > 0)
              @foreach($ProActiTime as $key=> $Inventor)
              <tr class="odd">
                  <td>@if($Inventor && $Inventor->project_name) {{ $Inventor->project_name }} @endif</td>
             
                    <td>
                               
                               @if($Inventor && $Inventor->client_id) 
                              <div class="parent d-flex">
                                            <div class="child1">
                                                 @if($Inventor->client_img)
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$Inventor->client_img}}" height="30" width="30" alt="User avatar" />
                                                    @else
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                    @endif
                                            </div>
                                            <div class="child2">
                                                  {{$Inventor->client_name }} {{$Inventor->client_lst_name }} | {{$Inventor->client_id }} <br> <span style="color:#6e6c76;font-size:85%">({{$Inventor->company_name }})</span>
                                            </div>
                                        </div>
                                        @else
                                        --
                                       @endif
                           
                           </td>
                        <td >
                            @switch($Inventor->status_id)
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
                          </div>
                        </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
              </tr>
              @endif 
            </tbody>
                  </table>
              </div>
            
         </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-6" style="350px">
      <div class="card h-0" >
         <div class="card-header">
               <div class="content-left">
                 <strong>User Activity Timeline</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>
         <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>IP</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
              @if(count($UserActTime) > 0)
              @foreach($UserActTime as $key=> $Inventor)
              <tr class="odd">
                  <td style="display: flex;">
                      <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{isset($Inventor->profile_img) ? $Inventor->profile_img : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                      &nbsp;&nbsp;
                      <div>
                        @if($Inventor && $Inventor->first_name) 
                          {{ $Inventor->first_name }} 
                        @endif 
                        <br/> 
                          @if($Inventor && $Inventor->id)
                          @php 
                          $post = DB::table('jobroles')->whereRaw("FIND_IN_SET('assign_emp_id',$Inventor->id)")->value('name');
                          @endphp 
                              {{ $post }} 
                          @endif
                        
                      </div>
                      
                      </td>
                  
                        <td >    @if($Inventor && $Inventor->subject) 
                              {{ $Inventor->subject }} 
                          @endif                </td>
                        <td >    @if($Inventor && $Inventor->ip) 
                              {{ $Inventor->ip }} 
                          @endif                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
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