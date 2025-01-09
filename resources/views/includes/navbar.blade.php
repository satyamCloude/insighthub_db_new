@if(Auth::user()->type == 4 )
@php
$empdetail = App\Models\EmployeeDetail::where('user_id',Auth::user()->id)
->select('department_id')
->first();
$notification = App\Models\Notification::where('departmentId',$empdetail->department_id)
->where('sender',0)
->where('status',0)
->get();
$countNoti = count($notification);
@endphp
@endif
@if(Auth::user()->type == 2)
@php
$notification = App\Models\Notification::where('user_id',auth::user()->id)
->where('sender',1)
->where('status',0)->get();
$countNoti = count($notification);
@endphp
@endif
<style>
   .buyprod{
   /* background:#7367f0; */
   /* box-shadow:0px 2px 6px 0px rgba(115, 103, 240, 0.48); */
   /* color:white; */
   padding: 4px 8px 4px 4px;
   border-radius:3px;
   font-size:17px;
   }
   .buyprod:hover{
   color:#7367f0;
   }
   .buyprod:focus{
   color:#7367f0;
   }
   .plusprod{
   margin:0 3px;
   margin-bottom:4px;
   }
   .dropdown-menu-end[data-bs-popper] {
   right: auto;
   left: 0;
   }
   .right2[data-bs-popper] {
   right: 0  !important;
   left: auto !important;
   }
</style>
<!-- Navbar -->
<nav
   class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
   id="layout-navbar">
   <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="ti ti-menu-2 ti-sm"></i>
      </a>
   </div>
   <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
      <!-- Search -->
      @if(auth::user()->type != '2')
      <div class="navbar-nav align-items-center">
         <div class="nav-item navbar-search-wrapper mb-0">
            <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
               <!-- <i class="ti ti-search ti-md me-2"></i> -->
               <!-- <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span> -->
            </a>
         </div>
      </div>
      @endif
      <!-- /Search -->
      <div class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0 relative text-indigo-600 transition duration-300 group-hover:text-white ease">
         @if(Auth::user()->type === 2)
         <a class="nav-link dropdown-toggle hide-arrow buyprod" href="javascript:void(0);" data-bs-toggle="dropdown">
         <i class="ti ti-md ti-plus plusprod"></i>Buy Product
         </a>
         @endif
         @php
         $data = \App\Models\Category::get();
         @endphp
         <ul class="dropdown-menu dropdown-menu-end dropdown-styles" style="overflow:auto;height:88vh;">
            @foreach($data as $product)
            <li>
               <a class="dropdown-item product-link" href="{{ url('user/get-related-data/'.$product->id) }}" data-product-id="{{ $product->id }}">
               <span class="align-middle"> {!! $product->faIcon !!} {{ $product->category_name }}</span>
               </a>
            </li>
            @endforeach
         </ul>
      </div>
      <ul class="navbar-nav flex-row align-items-center ms-auto" style="display:flex;">
         @if(Auth::user()->type===2)
         @endif
         <!-- Language -->
         <li class="nav-item dropdown-language dropdown me-2 me-xl-0 ">
            <a class="nav-link dropdown-toggle hide-arrow right2" href="javascript:void(0);" data-bs-toggle="dropdown">
            <i class="ti ti-language rounded-circle ti-md"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end right2">
               <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-language="en">
                  <span class="align-middle">English</span>
                  </a>
               </li>
            </ul>
         </li>
         <!--/ Language -->
         <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0 ">
         <li id="task_time_strt" style="display: none;">
            <span id="timer-clock">
            <span class="border rounded f-14 py-2 px-2 d-none d-sm-block mr-3">
            <span id="active-timer2" class="mr-2"></span>
            <a href="javascript:;" class="pause-active-timer mr-1 border-right" 
               data-url="https://demo-saas.worksuite.biz/account/timelogs/start-timer" 
               data-toggle="tooltip" 
               data-original-title="Pause Timer" 
               data-time-id="322">
            <i class="fa fa-pause-circle text-primary"></i>
            </a>
            <a href="javascript:;" class="stop-active-timer" 
               id="stop-active-timer" 
               data-toggle="tooltip" 
               data-original-title="Stop Timer" 
               data-url="https://demo-saas.worksuite.biz/account/timelogs/start-timer" 
               data-time-id="322">
            <i class="fa fa-stop-circle text-danger"></i> 
            </a>
            </span>
            </span>
         </li>
         </li>
         <!-- Style Switcher -->
         @if(Auth::user()->type===2)
         <li class="nav-item me-2 me-xl-0 ">
            <a class="nav-link  right2" href="{{url('user/order/cart')}}" >
            <i class="fa-solid fa-cart-shopping"></i>
            </a>
            <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-styles right2">
               <li>
                 <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                   <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                 </a>
               </li>
               <li>
                 <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                   <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                 </a>
               </li> -->
            <!-- <li>
               <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                 <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
               </a>
               </li> -->
            <!-- </ul> -->
         </li>
         @endif
         @if(Auth::user()->type != 2)
         <li class="nav-item dropdown dropdown-style-switcher me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow right2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ti ti-md ti-clock"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-styles right2">
               <li>
                  <a class="dropdown-item strttimerbtn" href="#" data-theme="system" data-bs-toggle="modal" data-bs-target="#mymodal">
                  <i class="ti ti-play me-2"></i>Start Timer
                  </a> <a class="dropdown-item stptimerbtn" style="display: none;" href="#" data-theme="system">
                  <i class="ti ti-play me-2"></i>Stop Timer
                  </a>
               </li>
            </ul>
         </li>
         @endif
         <!-- / Style Switcher-->
         <!-- Quick links  -->
         @if(auth()->check() && auth()->user()->type == '4')
         @php
         $employeeDetails = DB::table('employee_details')->where('user_id', auth()->user()->id)->first();
         @endphp
         @endif
         <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0 right1">
            <a
               class="nav-link dropdown-toggle hide-arrow right2"
               href="javascript:void(0);"
               data-bs-toggle="dropdown"
               data-bs-auto-close="outside"
               aria-expanded="false">
            <i class="ti ti-layout-grid-add ti-md"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end py-0 right2">
               @if(auth::user()->type == '2')
               <div class="dropdown-menu-header border-bottom">
                  <div class="dropdown-header d-flex align-items-center py-3">
                     <a href="{{url('user/ticket/create')}}"
                        class="dropdown-shortcuts-add text-body"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Add shortcuts"
                        >
                        <h5 class="text-body mb-0 me-auto">Generate Ticket</h5>
                     </a>
                  </div>
               </div>
               @endif
               @if(auth::user()->type != '2')
               <div class="dropdown-menu-header border-bottom">
                  <div class="dropdown-header d-flex align-items-center py-3">
                     <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                     <a
                        href="javascript:void(0)"
                        class="dropdown-shortcuts-add text-body"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Add shortcuts"
                        ><i class="ti ti-sm ti-apps"></i
                        ></a>
                  </div>
               </div>
               <div class="dropdown-shortcuts-list scrollable-container">
                  <div class="row row-bordered overflow-visible g-0">
                     @if(auth()->check() && auth()->user()->type == '4' && $employeeDetails->department_id == 5)
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-users fs-4"></i>
                        </span>
                        <a href="{{ url('Employee/Leads/home') }}" class="stretched-link">Leads</a>
                     </div>
                     @else
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-calendar fs-4"></i>
                        </span>
                        @if(auth::user()->type == '1')
                        <a href="{{url('admin/Calendar/home')}}" class="stretched-link">Calendar</a>
                        @elseif(auth::user()->type == '2')
                        <a href="{{url('user/Calendar/home')}}" class="stretched-link">Calendar</a>
                        @elseif(auth::user()->type == '4')
                        <a href="{{url('Employee/Calendar/home')}}" class="stretched-link">Calendar</a>
                        @endif
                        <!-- <small class="text-muted mb-0">Appointments</small> -->
                     </div>
                     @endif
                     @if(auth()->check() && auth()->user()->type == '4' && $employeeDetails->department_id == 4)
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-users fs-4"></i>
                        </span>
                        <a href="{{ url('Employee/Employee/home') }}" class="stretched-link">Employee</a>
                     </div>
                     @elseif(auth()->check() && auth()->user()->type == '4' && ($employeeDetails->department_id == 2 || $employeeDetails->department_id == 1))
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-clock fs-4"></i>
                        </span>
                        <a href="{{ url('Employee/TimeSheet/home') }}" class="stretched-link">TimeSheet</a>
                        <!-- <small class="text-muted mb-0">Management</small> -->
                     </div>
                     @elseif(auth()->check() && auth()->user()->type == '4' && $employeeDetails->department_id == 3)
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-file-invoice fs-4"></i>
                        </span>
                        <a href="{{ url('Employee/Invoices/home') }}" class="stretched-link">Invoices</a>
                     </div>
                     @elseif(auth()->check() && auth()->user()->type == '4' && $employeeDetails->department_id == 5)
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-file-invoice fs-4"></i>
                        </span>
                        <a href="{{ url('Employee/Project/home') }}" class="stretched-link">Project</a>
                     </div>
                     @else
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-file-invoice fs-4"></i>
                        </span>
                        @if(auth()->check())
                        @if(auth()->user()->type == '1')
                        <a href="{{ url('admin/Invoices/home') }}" class="stretched-link">Invoices</a>
                        @elseif(auth()->user()->type == '2')
                        <a href="{{ url('user/Invoices/home') }}" class="stretched-link">Invoices</a>
                        @elseif(auth()->user()->type == '4')
                        <a href="{{ url('Employee/Invoices/home') }}" class="stretched-link">Invoice</a>
                        @endif
                        @endif
                     </div>
                     @endif
                  </div>
                  <div class="row row-bordered overflow-visible g-0">
                     @if(auth()->check() && auth()->user()->type == '4' && ($employeeDetails->department_id == 4 || $employeeDetails->department_id == 3))
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-users fs-4"></i>
                        </span>
                        <a href="{{ url('Employee/PayRoll/home') }}" class="stretched-link">Payroll</a>
                        <!-- <small class="text-muted mb-0">Management</small> -->
                     </div>
                     @elseif(auth()->check() && auth()->user()->type == '4' && ($employeeDetails->department_id == 2 || $employeeDetails->department_id == 1))
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-users fs-4"></i>
                        </span>
                        <a href="{{ url('Employee/Performance/home') }}" class="stretched-link">Performance </a>
                     </div>
                     @elseif(auth()->check() && auth()->user()->type == '4' && $employeeDetails->department_id == 5)
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-users fs-4"></i>
                        </span>
                        <a href="{{ url('Employee/Task/home') }}" class="stretched-link">Task </a>
                     </div>
                     @else
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-users fs-4"></i>
                        </span>
                        @if(auth::user()->type == '1')
                        <a href="{{url('admin/Client/home')}}" class="stretched-link">Time Tracker</a>
                        @elseif(auth::user()->type == '2')
                        <a href="javascript:void(0);" class="stretched-link">Time Tracker</a>
                        @elseif(auth::user()->type == '4')
                        <a href="{{url('Employee/Client/home')}}" class="stretched-link">Time Tracker</a>
                        @endif
                     </div>
                     @endif
                     @if(auth()->check() && auth()->user()->type == '4' && $employeeDetails->department_id == 4)
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-lock fs-4"></i>
                        </span>
                        <a href="{{url('Employee/Attendence/home')}}" class="stretched-link">Attendance</a>
                     </div>
                     @elseif(auth()->check() && auth()->user()->type == '4' && ($employeeDetails->department_id == 2 || $employeeDetails->department_id == 1))
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-lock fs-4"></i>
                        </span>
                        <a href="{{url('Employee/Attendence/home')}}" class="stretched-link">KRA</a>
                     </div>
                     @elseif(auth()->check() && auth()->user()->type == '4' && ($employeeDetails->department_id == 3 || $employeeDetails->department_id == 5))
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-lock fs-4"></i>
                        </span>
                        <a href="{{url('Employee/Ticket/home')}}" class="stretched-link">Ticket</a>
                     </div>
                     @else
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-lock fs-4"></i>
                        </span>
                        @if(auth::user()->type == '1')
                        <a href="{{url('admin/Settings/home?type=Role')}}" class="stretched-link">Role Management</a>
                        @elseif(auth::user()->type == '2')
                        <a href="javascript:void(0);" class="stretched-link">Role Management</a>
                        @elseif(auth::user()->type == '4')
                        <a href="{{url('Employee/Role/home')}}" class="stretched-link">Role Management</a>
                        @endif
                        <small class="text-muted mb-0">Permission</small>
                     </div>
                     @endif
                  </div>
                  <div class="row row-bordered overflow-visible g-0">
                     @if(auth()->check() && auth()->user()->type == '4' && ($employeeDetails->department_id == 4 || $employeeDetails->department_id == 2 || $employeeDetails->department_id == 1 || $employeeDetails->department_id == 3))
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-lock fs-4"></i>
                        </span>
                        <a href="{{url('Employee/Leave/home')}}" class="stretched-link">Leaves</a>
                        <!-- <small class="text-muted mb-0">Management</small> -->
                     </div>
                     @elseif(auth()->check() && auth()->user()->type == '4' && $employeeDetails->department_id == 5)
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-lock fs-4"></i>
                        </span>
                        <a href="{{url('Employee/Inventory/home')}}" class="stretched-link">Inventory</a>
                     </div>
                     @else
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-chart-bar fs-4"></i>
                        </span>
                        @if(auth::user()->type == '1')
                        <a href="{{url('admin/dashboard')}}" class="stretched-link">Dashboard</a>
                        @elseif(auth::user()->type == '2')
                        <a href="{{url('user/dashboard')}}" class="stretched-link">Dashboard</a>
                        @elseif(auth::user()->type == '4')
                        <a href="{{url('Employee/dashboard')}}" class="stretched-link">Dashboard</a>
                        @endif
                        <small class="text-muted mb-0">User Profile</small>
                     </div>
                     @endif
                     @if(auth()->check() && auth()->user()->type == '4' && ($employeeDetails->department_id != 4 && $employeeDetails->department_id != 2  && $employeeDetails->department_id != 1 && $employeeDetails->department_id != 3 && $employeeDetails->department_id != 5))
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-settings fs-4"></i>
                        </span>
                        @if(auth::user()->type == '1')
                        <a href="{{url('admin/MyProfile')}}" class="stretched-link">Setting</a>
                        @elseif(auth::user()->type == '2')
                        <a href="{{url('user/MyProfile')}}" class="stretched-link">Setting</a>
                        @elseif(auth::user()->type == '4')
                        <a href="{{url('Employee/MyProfile')}}" class="stretched-link">Setting</a>
                        @endif
                        <small class="text-muted mb-0">Account Settings</small>
                     </div>
                     @elseif(auth()->check() && auth()->user()->type != '4')
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-settings fs-4"></i>
                        </span>
                        @if(auth::user()->type == '1')
                        <a href="{{url('admin/MyProfile')}}" class="stretched-link">Setting</a>
                        @elseif(auth::user()->type == '2')
                        <a href="{{url('user/MyProfile')}}" class="stretched-link">Setting</a>
                        @elseif(auth::user()->type == '4')
                        <a href="{{url('Employee/MyProfile')}}" class="stretched-link">Setting</a>
                        @endif
                        <small class="text-muted mb-0">Account Settings</small>
                     </div>
                     @endif
                  </div>
                  @if(auth::user()->type == '1' || auth::user()->type == '2')
                  <div class="row row-bordered overflow-visible g-0">
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-help fs-4"></i>
                        </span>
                        <a href="javascript:void(0);" class="stretched-link">FAQs</a>
                        <small class="text-muted mb-0">FAQs & Articles</small>
                     </div>
                     <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                        <i class="ti ti-square fs-4"></i>
                        </span>
                        <a href="javascript:void(0);" class="stretched-link">Modals</a>
                        <small class="text-muted mb-0">Useful Popups</small>
                     </div>
                  </div>
                  @endif
               </div>
               @endif
            </div>
         </li>
         <!-- Quick links -->
         <!-- Notification -->
         <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1 right1">
            @if(Auth::user()->id != 1)
            <a
               class="nav-link dropdown-toggle hide-arrow right2"
               href="javascript:void(0);"
               data-bs-toggle="dropdown"
               data-bs-auto-close="outside"
               aria-expanded="false">
            <i class="ti ti-bell ti-md"></i>
            <span class="badge bg-danger rounded-pill badge-notifications">{{$countNoti}}</span>
            </a>
            @endif
            <ul class="dropdown-menu dropdown-menu-end py-0 right2" style="width: 100%;">
               <li class="dropdown-menu-header border-bottom">
                  <div class="dropdown-header d-flex align-items-center py-3">
                     <h5 class="text-body mb-0 me-auto">Notification</h5>
                     <a
                        href="javascript:void(0)"
                        class="dropdown-notifications-all text-body"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Mark all as read"
                        ><i class="ti ti-mail-opened fs-4"></i
                        ></a>
                  </div>
               </li>
               @if(!empty($notification))
               @foreach($notification as $noti)
               @php
               $userPhoto = App\Models\User::where('id',$noti->user_id)->select('profile_img')->first();
               $currentDateTime = new DateTime();
               $targetDateTime = new DateTime($noti->created_at);
               $timeDifference = $currentDateTime->diff($targetDateTime);
               if ($timeDifference->days >= 1) {
               $days = $timeDifference->days . " days";
               } elseif ($timeDifference->h >= 1) {
               $days =  $timeDifference->h . " hours";
               } else {
               $days = $timeDifference->i . " minutes";
               }
               @endphp
               <li class="dropdown-notifications-list scrollable-container" onClick="updateStatus({{$noti->id}})">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                           <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                 @if(Auth::user()->type == 4)
                                 <img src="{{isset($userPhoto) ? $userPhoto->profile_img : url('public/images/21104.png')}}" alt class="h-auto rounded-circle" />
                                 @else
                                 <img src="{{url('public/logo/company.png')}}" alt class="h-auto rounded-circle" />
                                 @endif
                              </div>
                           </div>
                           <div class="flex-grow-1">
                              <h6 class="mb-1">{{$noti->subject}}</h6>
                              <p class="mb-0">{!! $noti->message !!}</p>
                              <small class="text-muted">{{$days}} ago</small>
                           </div>
                           <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                 ><span class="badge badge-dot"></span
                                 ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                 ><span class="ti ti-x"></span
                                 ></a>
                           </div>
                        </div>
                     </li>
                  </ul>
               </li>
               @endforeach
               @endif
               <li class="dropdown-menu-footer border-top">
                  @if(auth::user()->type == '1')
                  <a href="{{url('admin/notification/home')}}"
                     class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center"> View all notifications
                  </a>
                  @elseif(auth::user()->type == '2')
                  <a href="{{url('user/notification/home')}}"   class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center"> View all notifications
                  </a>
                  @elseif(auth::user()->type == '4')
                  <a href="{{url('Employee/notification/home')}}"   class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center"> View all notifications
                  </a>
                  @endif
               </li>
            </ul>
         </li>
         <!--/ Notification -->
         <!-- User -->
         <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow right2" href="javascript:void(0);" data-bs-toggle="dropdown">
               <div class="avatar avatar-online">
                  <img src="{{Auth::user()->profile_img}}" alt class="rounded-circle" />
               </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end right2">
               <li>
                  <!-- <a class="dropdown-item" href="javascript::void(0);"> -->
                  <div class="dropdown-item">
                     <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                           <div class="avatar avatar-online">
                              <img src="{{Auth::user()->profile_img}}" alt class=" rounded-circle" />
                           </div>
                        </div>
                        <div class="flex-grow-1">
                           <span class="fw-medium d-block">{{Auth::user()->first_name}}</span>
                           <small class="text-muted">@if(Auth::user()->type == 1) Admin @elseif(Auth::user()->type == 2) Client @elseif(Auth::user()->type == 4)  Employee @endif</small>
                        </div>
                     </div>
                  </div>
                  <!-- </a> -->
               </li>
               <li>
                  <div class="dropdown-divider"></div>
               </li>
               <li>
                  @if(Auth::user()->type == 1)
                  <a class="dropdown-item" href="{{url('admin/MyProfile')}}">
                  <i class="ti ti-user-check me-2 ti-sm"></i>
                  <span class="align-middle">My Profile</span>
                  </a>
                  @elseif(Auth::user()->type == 2) 
                  <a class="dropdown-item" href="{{url('user/MyProfile')}}">
                  <i class="ti ti-user-check me-2 ti-sm"></i>
                  <span class="align-middle">My Profile</span>
                  </a>
                  @elseif(Auth::user()->type == 4)  
                  <a class="dropdown-item" href="{{url('Employee/MyProfile')}}">
                  <i class="ti ti-user-check me-2 ti-sm"></i>
                  <span class="align-middle">My Profile</span>
                  </a>
                  @endif
               </li>
               <li>
                  <a class="dropdown-item" href="{{url('admin/Settings/home')}}">
                  <i class="ti ti-settings me-2 ti-sm"></i>
                  <span class="align-middle">Settings</span>
                  </a>
               </li>
               <!--<li>
                  <a class="dropdown-item" href="pages-account-settings-billing.html">
                    <span class="d-flex align-items-center align-middle">
                      <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                      <span class="flex-grow-1 align-middle">Billing</span>
                      <span class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20"
                        >2</span
                      >
                    </span>
                  </a>
                  </li>
                  <li>
                  <div class="dropdown-divider"></div>
                  </li>
                  <li>
                  <a class="dropdown-item" href="pages-faq.html">
                    <i class="ti ti-help me-2 ti-sm"></i>
                    <span class="align-middle">FAQ</span>
                  </a>
                  </li>
                  <li>
                  <a class="dropdown-item" href="pages-pricing.html">
                    <i class="ti ti-currency-dollar me-2 ti-sm"></i>
                    <span class="align-middle">Pricing</span>
                  </a>
                  </li> -->
               <li>
                  <div class="dropdown-divider"></div>
               </li>
               <li>
                  @if(auth::user()->type == '1')
                  <a class="dropdown-item" href="{{url('admin/logout')}}">
                  <i class="ti ti-logout me-2 ti-sm"></i>
                  <span class="align-middle">Log Out</span>
                  </a>
                  @elseif(auth::user()->type == '4')
                  <a class="dropdown-item" href="{{url('Employee/logout')}}">
                  <i class="ti ti-logout me-2 ti-sm"></i>
                  <span class="align-middle">Log Out</span>
                  </a>
                  @else
                  <a class="dropdown-item" href="{{url('user/logout')}}">
                  <i class="ti ti-logout me-2 ti-sm"></i>
                  <span class="align-middle">Log Out</span>
                  </a>
                  @endif
               </li>
            </ul>
         </li>
         <!--/ User -->
      </ul>
   </div>
   <!-- Search Small Screens -->
   <div class="navbar-search-wrapper search-input-wrapper d-none">
      <input
         type="text"
         class="form-control search-input container-xxl border-0"
         placeholder="Search..."
         aria-label="Search..." />
      <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
   </div>
</nav>
<!-- / Navbar -->
<div class="modal fade" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <form  id="start-timer-form" action="" class="ajax-form modal-content" autocomplete="off">
         @csrf
         <div class="modal-header" style="flex-direction:column;">
            <h5 class="modal-title" id="backDropModalTitle">Start Timer</h5>
            <br/>
            <span style="color:red" id="err_msg"></span>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col mb-3">
                  <label for="nameBackdrop" class="form-label">Project</label>
                  @php
                  $projects = DB::table('projects')->where('deleted_at',null)->select('project_name', 'id')->get();
                  @endphp
                  <div class="input-group-append d-flex">
                     <select class="form-select" id="projectSelect" name="project_id" required>
                        @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col mb-3">
                  <label for="nameBackdrop" class="form-label">Task</label>
                  <div class="input-group-append d-flex">
                     <select class="form-select" id="taskSelect" name="task_id" required>
                        <option value="0">--</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col mb-12">
                  <label for="nameBackdrop" class="form-label">Memo</label>
                  <div class="input-group-append d-flex">
                     <input type="text" class="form-control" id="memo" name="memo" required>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
            Close
            </button>
            <button type="button" class="btn btn-primary" onclick="strtTimer()">Start Timer</button>
         </div>
      </form>
   </div>
</div>
<form id="timerForm">
   <!-- Adding form tags -->
   <input type="hidden" id="timer_project_id" value="0">
   <input type="hidden" id="timer_task_id" value="0">
   <input type="hidden" id="timer_u_id" value="0">
   <input type="hidden" id="urls" value="{{Auth::user()->type}}">
</form>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
   function strtTimer() {
       var selectedProject = $('#projectSelect').val();
       var selectedTask = $('#taskSelect').val();
       var memo = $('#memo').val();
           var type = $('#urls').val();
   
    var stopTimerUrl = type == 1 ? "{{ url('admin/Task/StartTimer') }}" : "{{ url('Employee/Task/StartTimer') }}";
       if (selectedProject && selectedTask) {
           $.ajax({
           url: stopTimerUrl,
               method: 'GET',
               data: {
                   project_id: selectedProject,
                   task_id: selectedTask,
                   memo: memo,
               },
               success: function(resp) {
                   if (resp.status === false) {
                       $('#task_time_strt').hide();
                       localStorage.removeItem('counter');
                   } else {
                       $('.strttimerbtn').hide();
                       $('.stptimerbtn').show();
                       var run_status = resp.data.run_status;
                       var task_id = resp.data.task_id;
                       var project_id = resp.data.project_id;
                       var timer_u_id = resp.data.timer_u_id;
   
                       if (run_status === 1) {
                           var counter = 0;  
                           localStorage.removeItem('counter');
                           localStorage.setItem('counter', counter);
                           $('#task_time_strt').show();
                           $('#timer_u_id').val(timer_u_id);
                           $('#timer_project_id').val(project_id);
                           $('#timer_task_id').val(task_id);
                       } else {
                           localStorage.removeItem('counter');
                           $('#task_time_strt').hide();
                       }
   
                       $('#mymodal').modal('hide');
                       updateTimer(localStorage.getItem('counter') || 0);
                       $('#strtTimer').html('<i class="fas fa-play"></i>');
                   }
               },
               error: function(xhr, status, error) {
                   $('#task_time_strt').hide();
                   localStorage.removeItem('counter');
               }
           });
       }
   }
   
   $('.stptimerbtn').click(function() {
       var timer_project_id = $('#timer_task_id').val();
       var timer_u_id = $('#timer_u_id').val();
       var timer_task_id = $('#timer_project_id').val();
       var type = $('#urls').val();
       var stopTimerUrl = type == 1 ? "{{ url('admin/Task/StopTimer') }}" : "{{ url('Employee/Task/StopTimer') }}";
   
       $.ajax({
           url: stopTimerUrl,
           method: 'GET',
           data: {
               project_id: timer_project_id,
               timer_u_id: timer_u_id,
               task_id: timer_task_id,
           },
           success: function(resp) {
               $('.strttimerbtn').show();
               $('.stptimerbtn').hide();
   
               if (resp.status === false) {
                   $('#task_time_strt').hide();
                   localStorage.removeItem('counter');
               } else {
                   localStorage.removeItem('counter');
                   $('#task_time_strt').hide();
                   $('#strtTimer').html('');
               }
   
               location.reload();
           },
           error: function(xhr, status, error) {
               $('#task_time_strt').hide();
           }
       });
   
       localStorage.clear();
   });
</script>
<script>
   function updateStatus(url)
   {
    console.log('not working need to implement this functionality');
   }
   
         $(function() {
           var cnt = localStorage.getItem('counter') || 0;
           $('#displayCounter').html(formatTime(cnt));
           var counter = setInterval(function() {
               cnt++;
               $('#task_time_strt').html(formatTime(cnt));
               localStorage.setItem('counter', cnt);
           }, 1000);
           function formatTime(counter) {
               var hours = Math.floor(counter / 3600);
               var minutes = Math.floor((counter % 3600) / 60);
               var seconds = counter % 60;
               return pad(hours) + ':' + pad(minutes) + ':' + pad(seconds);
           }
   
           function pad(value) {
               return value < 10 ? '0' + value : value;
           }
       });
   
   
   function updateTimer(elapsedTime) {
       var hours = pad(Math.floor(elapsedTime / (60 * 60)));
       var minutes = pad(Math.floor((elapsedTime % (60 * 60)) / 60));
       var seconds = pad(Math.floor(elapsedTime % 60));
       var formattedTime = hours + ':' + minutes + ':' + seconds;
       $('#active-timer2').text(formattedTime);
   }
   function pad(number) {
       return number < 10 ? '0' + number : number;
   }
   
   
   
   //  $(document).ready(function() {
   //   $.ajax({
   //     url: "{{ url('admin/Task/checkStartTimer') }}",
   //     method: 'GET',
   //     success: function(resp) {
   //         console.log("Server response: ", resp);
   
   //         if (resp.status === false) {
   //             $('#task_time_strt').hide();
   //         } else {
   //             var countRunningTaskTimer = resp.countRunningTaskTimer;
   //             var timer_u_id = (resp.getRunningTaskTimer && resp.getRunningTaskTimer.id) || 0;
   
   //             if (countRunningTaskTimer > 0) {
   //                 updateTimer(localStorage.getItem('counter') || 0);
   //                 $('.strttimerbtn').hide();
   //                 $('.stptimerbtn').show();
   //                 $('#timer_u_id').val(timer_u_id);
   //                 $('#task_time_strt').show();
   //             } else {
   //                 $('#task_time_strt').hide();
   //                 $('.strttimerbtn').show();
   //                 $('.stptimerbtn').hide();
   //                 $('#strtTimer').html('<i class="fas fa-play"></i>');
   //                 localStorage.removeItem('counter');
   //             }
   //         }
   //     },
   //     error: function(xhr, status, error) {
   //         // Handle errors appropriately
   //         $('#task_time_strt').hide();
   //         console.error("Error while checking start timer:", status, error);
   //     }
   // });
   
   
   //     $('#projectSelect').change(function() {
   //       var selectedProject = $(this).val();
   //       var taskSelect = $('#taskSelect'); // Assuming the task dropdown has an ID of 'taskSelect'
   
   //       if (selectedProject) {
   //         $.ajax({
   //           url: "{{ url('admin/Task/GetTask') }}",
   //           method: 'GET',
   //           data: {
   //             project_id: selectedProject,
   //           },
   //           success: function (resp) {
   //             console.log(resp);
   
   //             taskSelect.empty();
   
   //             // Append a default option
   //             taskSelect.append('<option value="0">--</option>');
   
   //             // Append tasks from the response
   //             resp.data.forEach(function(task) {
   //               taskSelect.append('<option value="' + task.id + '">' + task.task_name + '</option>');
   //             });
   //           },
   //           error: function (xhr, status, error) {
   //             console.error("AJAX Request Failed. Status: " + status + ", Error: " + error);
   //           }
   //         });
   //       }
   //     });
   //   });
   
   
</script>



























































