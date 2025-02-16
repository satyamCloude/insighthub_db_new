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
    <div class="flx_bx d-flex" style="align-items:center;justify-content:space-between;">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leave /</span> Home</h4>
  <!--<a href="{{url('admin/Leave/home2')}}"  target="_blank" class="btn btn-label-primary me-3">New Page-->
  <!--                            </a>-->
                              </div>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
    <div class="alert alert-success" role="alert" id="ResMsg" style="display:none;"></div>
    
     <div class="row g-4 mb-4 d-flex" style="justify-content:center;">
                  <div class="col-sm-2 col-xl-2">
                               <a href="{{url('Employee/Leave/home?status=0')}}">
                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex align-items-start justify-content-between">
                              <div class="content-left">
                                 <span>Total Leaves</span>
                                 <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2">{{$approveCount+$unapproveCount+$PendingCount}}</h3>
                                    <!-- <p class="text-success mb-0">0</p> -->
                                 </div>
                                 <!-- <p class="mb-0">Total Quotes</p> -->
                              </div>
                              <div class="avatar">
                                 <span class="avatar-initial rounded bg-label-primary">
                                 <i class="ti ti-user ti-sm"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div> </a>
                  </div>
     
        
              <div class="col-sm-2 col-xl-2">
                   <a href="{{url('Employee/Leave/home?status=1')}}">
                 <div class="card">
                    <div class="card-body">
                       <div class="d-flex align-items-start justify-content-between">
                          <div class="content-left">
                             <span>Approved</span>
                             <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">{{$approveCount}}</h3>
                                <!-- <p class="text-success mb-0"></p> -->
                             </div>
                          </div>
                          <div class="avatar">
                             
                             <span class="avatar-initial rounded bg-label-success">
                     <i class="ti ti-user-check ti-sm"></i>
                             
                          </div>
                       </div>
                    </div>
                 </div>
                  </a>
              </div>
       
      <div class="col-sm-2 col-xl-2">
           <a href="{{url('Employee/Leave/home?status=2')}}">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Unapproved</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{$unapproveCount}}</h3>
                        <!-- <p class="text-danger mb-0"></p> -->
                     </div>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-danger">
                             <i class="ti ti-user-plus ti-sm"></i>
                             </span>
                  </div>
               </div>
            </div>
         </div>
           </a>
      </div>
    
         
      <div class="col-sm-2 col-xl-2">
           <a href="{{url('Employee/Leave/home?status=3')}}">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Pending</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{$PendingCount}}</h3>
                        <!-- <p class="text-success mb-0"></p> -->
                     </div>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-warning">
                     <i class="ti ti-user-exclamation ti-sm"></i>
                     </span>
                  </div>
               </div>
            </div>
         </div> </a>
      </div>
   
   </div>
    <!--<div class="row">-->

    <!--     <div class="card-body">-->
    <!--      <div class="row g-4 mb-4">-->
           
    <!--        <div class="col-sm-3 col-xl-3">-->
    <!--          <div class="card bg-info text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            <a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">Total Leave</h4>-->
    <!--                  <p class="text-white mt-3">{{$approveCount+$unapproveCount+$PendingCount}}</p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>    -->
            
    <!--        <div class="col-sm-3 col-xl-3">-->
    <!--          <div class="card bg-success text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            <a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">Approved</h4>-->
    <!--                  <p class="text-white mt-3">{{$approveCount}}</p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>       <div class="col-sm-3 col-xl-3">-->
    <!--          <div class="card bg-warning text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            <a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">Pending</h4>-->
    <!--                  <p class="text-white mt-3">{{$PendingCount}}</p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>     -->
                
                
    <!--              <div class="col-sm-3 col-xl-3">-->
    <!--          <div class="card bg-danger text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            <a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">Unapproved</h4>-->
    <!--                  <p class="text-white mt-3">{{$unapproveCount}}</p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>  -->
    <!--         <div class="col-sm-3 col-xl-3">-->
    <!--               <a href="{{url('admin/Leave/home2')}}"  target="_blank" class="btn btn-label-primary me-3">-->
    <!--            <span class="align-middle"> New Leave Page</span>-->
    <!--          </a>-->
    <!--            <a href="{{url('Employee/Leave/add')}}" class="btn btn-primary mt-3 m-3">Add Leave</a>-->
    <!--        </div>-->
            
    <!--      </div>-->
             
    <!--  </div>-->
    <!--</div>-->

    
  <!-- Users List Table -->
  
        <div class="row  mt-4">
             
             <div class="col-xl-6 col-12 mb-4">
                  
  
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
         <div class="col-xl-6 col-md-12 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Weekly Leaves</h5>
            <small class="text-muted">Weekly Leaves Overview</small>
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
                  <h6 class="mb-0">Total Leaves</h6>
                  <!--<small class="text-muted">{{$approveCount+$unapproveCount+$PendingCount}}</small>-->
                </div>
                <div class="user-progress d-flex align-items-center gap-3">
                  <small>{{$approveCount+$unapproveCount+$PendingCount}}</small>
                  <!--<div class="d-flex align-items-center gap-1">-->
                  <!--  <i class="ti ti-chevron-up text-success"></i>-->
                  <!--  <small class="text-muted">18.6%</small>-->
                  <!--</div>-->
                </div>
              </div>
            </li>
         
          </ul>
         <div id="reportBarChart" style="margin-top:119px;"></div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 389px; height: 401px;"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
    </div>
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

    
                                   @if($AuthRole->job_role_id >= 2)

  <div class="card mt-2">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Leave's List</h5>
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
              @if($Leave)
              @foreach($Leave as $key=> $user)
               <!-- //employee -->
        
                                   

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
                               @if($AuthRole->job_role_id >= 2 || $AuthRole->job_role_id == 15)

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
                      <div class="col-xl-12 col-12 mb-4 " >
      <div class="card" style="height:500px">
         <div  class="card-header">
            <h5>Requested Leaves</h5>
             <a href="{{url('Employee/Leave/add')}}" class="btn  btn-primary text-white float-end"><i class="fa-solid fa-plus">&nbsp;&nbsp;</i>Create Leave</a>


        </div>
          <div  class="card-body"> 

            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Employee</th>
                <th>Leave Date</th>
                
                <th>Duration</th>
                <th>Approval Reply</th>
              </tr>
            </thead>
            <tbody>
              @if(count($requestedLeaves) > 0)
              @foreach($requestedLeaves as $key=> $user)
                @php
                $jobrole = App\Models\Jobroles::find($user->jobrole_id);
            @endphp
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                      <td>
                    @if($user->profile_img)
                        <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{ $user->profile_img }}"
                            height="30"
                            width="30"
                            alt="User avatar" />
                    @else
                        <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{ url('public/images/21104.png') }}"
                            height="30"
                            width="30"
                            alt="User avatar" />
                    @endif
                    {{ $user->first_name }} {{ $user->last_name }}
                    <div style="font-size:12px;margin-left: 46px;margin-top: -11px;">
                       {{ $jobrole ? $jobrole->name : 'No Job Role' }}
                    </div>
                </td>
                             <td>
    @if($user && $user->date)
        {{ $user->date }}
    @else
        {{ $user->start_date }}
    @endif
</td>
<td>
    <?php
    $startDate = \Carbon\Carbon::parse($user->start_date);
    $endDate = \Carbon\Carbon::parse($user->end_date);
    $days = $endDate->diffInDays($startDate) + 1; // Adding 1 to include both start and end date

    if ($days == 1) {
        echo '1 day';
    } else if ($days > 1 && $days <= 30) {
        echo $days . ' days';
    } else {
        $months = intval($days / 30);
        $remainingDays = $days % 30;
        echo $months . ' month' . ($months > 1 ? 's' : '');
        if ($remainingDays > 0) {
            echo ' and ' . $remainingDays . ' day' . ($remainingDays > 1 ? 's' : '');
        }
    }
    ?>
</td>
<td>@if($user && $user->reply) {{ $user->reply }}@else -- @endif</td>
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
          {{ $requestedLeaves->links() }}
      </div>
    </div>
    
    <div class="col-xl-12 mb-4 mb-xl-0">
    
      <div class="card">
          <div class="row">
                                  <div class="col-xl-8 mb-4 mb-xl-0">

        <h5 class="card-header"> 
        
        @if($user_details->profile_img)

        <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user_details->profile_img}}"
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
                        {{ucfirst($user_details->first_name) }}'s Leaves</h5>
                        </div>
                        
           
                        <div class="col-xl-4 mb-4 mb-xl-0">
        
         <a href="{{url('Employee/Leave/add')}}" class="btn mt-3 m-3 mt-4 justify-content-end float-end">Apply For Leave &nbsp; <i class="fa fa-arrow-right"></i></a>
    </div>
    </div>
        <div class="card-body pb-0">
          <ul class="timeline mb-0">
              @if($Leave)
              @foreach($Leave as $myleave)
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                 <h6 class="mb-0">{{ date('d F Y', strtotime($myleave->start_date)) }} - {{ date('d F Y', strtotime($myleave->end_date)) }}</h6>

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
<span class="text-muted">{{ date('d F Y h:i A', strtotime($myleave->created_at)) }}</span>
                  </div>
                </div>
                
             @if($myleave && $myleave->reply)   <div class="d-flex justify-content-between flex-wrap mb-2 ml-4" style="background-color:pink;height:100px;overflow:hidden;border-radius:10px;margin-left:20%;text-align:center">
                  <div class="d-flex align-items-center">
                        @php
                $user_details = App\Models\User::find(1);
            @endphp  

        @if($user_details->profile_img)

      <span>  <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user_details->profile_img}}"
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
                       </span> <br/>
                    <span>@if($myleave && $myleave->reply) {{ $myleave->reply }}@else -- @endif
</span>
                   
                  </div>
                </div>
                @endif
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
  
  
   let cardColor, headingColor, labelColor, borderColor, legendColor;

 
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  

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
  
  function editCategory(element) {
      var cate_id = $(element).attr('id');

      $.ajax({
          url: "{{ url('admin/LeaveType/edit') }}",
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
                url: "{{ url('admin/Leave/Show_leaves_yeardata') }}",
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
    formatter: function (val, opt) {
    return parseFloat(val).toFixed(2) + '%';
}

},
total: {
    show: true,
    fontSize: '1.5rem',
    color: headingColor,
    label: 'Total Leaves',
    formatter: function (w) {
        return parseFloat(totalPercentage).toFixed(2).replace(/\.?0*$/, '') + '%';
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

function LeaveStatusUpdate(status, empId, LeaveId, RoleID, ApproveID, AuthRole) {
    $.ajax({
        url: "{{ url('admin/Leave/LeaveStatusUpdate') }}",
        method: 'POST', // Assuming you want to send data with POST request
        data: {
            _token: '{{ csrf_token() }}', // Include the CSRF token
            status: status,
            statusnew: status,
            empId: empId,
            LeaveId: LeaveId,
            RoleID: RoleID,
            ApproveID: ApproveID,
            AuthRole: AuthRole,
        },
        success: function (response) {
            if (response.success == true) {
                $('#ResMsg').show().html(response.message);
                
                   setTimeout(function() {
        window.location.reload();
    }, 400);
                // Hide #ResMsg after 3 seconds
                setTimeout(function () {
                    $('#ResMsg').hide(500);
                }, 600);
                
            }
        },
        error: function () {
            alert("Oops! Some technical error occurred.");
        }
    });
}

const allLeaves = {!! json_encode($allLeaves) !!};

// Initialize leave counts for each weekday
const leaveCounts = {
    'Mon': 0,
    'Tue': 0,
    'Wed': 0,
    'Thurs': 0,
    'Fri': 0,
    'Sat': 0,
    'Sun': 0
};

// Loop through the leave data and increment the count for each weekday
allLeaves.forEach(leave => {
    // Get the start and end dates of the leave
    const startDate = new Date(leave.start_date);
    const endDate = new Date(leave.end_date);

    // If start and end dates are the same, increment count for that day
    if (startDate.getTime() === endDate.getTime()) {
        const dayOfWeek = startDate.toLocaleDateString('en-US', { weekday: 'long' }).substr(0, 3);
        leaveCounts[dayOfWeek]++;
    } else {
        // Loop through each day between the start and end dates
        for (let currentDate = new Date(startDate); currentDate <= endDate; currentDate.setDate(currentDate.getDate() + 1)) {
            // Get the day of the week for the current date
            const dayOfWeek = currentDate.toLocaleDateString('en-US', { weekday: 'long' }).substr(0, 3); // Use abbreviated form (Mon, Tue, etc.)

            // Increment the count for the corresponding weekday
            leaveCounts[dayOfWeek]++;
        }
    }
});
// Extract the leave counts and populate the series data for the chart
const leaveCountsData = Object.values(leaveCounts);

// Define the ApexCharts configuration
const reportBarChartConfig = {
    chart: {
        height: 200,
        type: 'bar',
        toolbar: {
            show: false
        }
    },
    plotOptions: {
        bar: {
            barHeight: '60%',
            columnWidth: '60%',
            startingShape: 'rounded',
            endingShape: 'rounded',
            borderRadius: 4,
            distributed: true
        }
    },
    grid: {
        show: false,
        padding: {
            top: -20,
            bottom: 0,
            left: -10,
            right: -10
        }
    },
    colors: [
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors.primary,
        config.colors_label.primary,
        config.colors_label.primary
    ],
    dataLabels: {
        enabled: false
    },
    series: [  // Corrected property name
        {
            name: 'No. of Leaves', // Changed series name
            data: leaveCountsData // Use the extracted leave counts data here
        }
    ],
    legend: {
        show: false
    },
    xaxis: {
        categories: ['Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun'], // Use abbreviated form for weekdays
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
            show: false
        }
    }
};


// Render the chart
const reportBarChartEl = document.querySelector('#reportBarChart');
if (typeof reportBarChartEl !== 'undefined' && reportBarChartEl !== null) {
    const barChart = new ApexCharts(reportBarChartEl, reportBarChartConfig);
    barChart.render();
}

</script>
<script>
    // Get the current month
    const currentMonth = new Date().getMonth() + 1; // JavaScript months are zero-based, so add 1 to get the correct month number

    // Set the default selected option based on the current month
    document.getElementById('months').value = currentMonth.toString().padStart(2, '0'); // Ensure two-digit format (e.g., '05' for May)
</script>

@endsection
