@extends('layouts.admin')
@section('title', 'My Profile')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <div class="d-flex justify-content-between">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>My Profile</h4>

    <button class="btn btn-label-primary" style="margin:27px 0px 22px;" onclick="EditClient({{Auth::user()->id}})"><i class="fas fa-edit"></i></button>
  </div>
  <ul class="nav nav-pills flex-column flex-md-row mb-4">
      <li class="nav-item">
          <button class="nav-link active" id="ProfileButton">
              <i class="ti ti-lock ti-xs me-1"></i>Profile
          </button>
      </li>
      <!-- <li class="nav-item">
          <button class="nav-link" id="TeamButton">
              <i class="ti ti-currency-dollar ti-xs me-1"></i>Team List
          </button>
      </li> -->
     <!--  <li class="nav-item">
          <button class="nav-link" id="QuotesButton">
              <i class="ti ti-link ti-xs me-1"></i>Quote
          </button>
      </li> 
      <li class="nav-item">
          <button class="nav-link" id="InvButton">
              <i class="ti ti-link ti-xs me-1"></i>Invoices
          </button>
      </li>-->
      <li class="nav-item">
          <button class="nav-link" id="ServiceButton">
              <i class="ti ti-link ti-xs me-1"></i>Service
          </button>
      </li>
      <!-- <li class="nav-item">
          <button class="nav-link" id="ticketButton">
              <i class="ti ti-link ti-xs me-1"></i>Tickets
          </button>
      </li>
      <li class="nav-item">
          <button class="nav-link" id="transactionsButton">
              <i class="ti ti-link ti-xs me-1"></i>Transactions
          </button>
      </li>
      <li class="nav-item">
          <button class="nav-link" id="LogActivityss">
              <i class="ti ti-link ti-xs me-1"></i>Log Activity
          </button>-->
      </li>
  </ul>

  <div class="row screenProfile">
      <!-- User Sidebar -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <!-- User Card -->
        <div class="card mb-4">
          <div class="card-body">
            <div class="user-avatar-section">
              <div class="d-flex align-items-center flex-column">
                <img class="img-fluid rounded mb-3 pt-1 mt-4"
                src="{{$user->profile_img}}"
                height="100" width="100" alt="User avatar">
                <div class="user-info text-center">
                  <h4 class="mb-2">{{$user->gender}} {{$user->first_name}} </h4>
                </div>
              </div>
            </div>
                        <p class="mt-4 small text-uppercase text-muted">Details</p>
              <div class="info-container">
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <span class="fw-medium me-1">Full name:</span>
                    <span>{{$user->first_name}} {{$user->last_name}}</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Email:</span>
                    <span>{{$user->email}}</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Status:</span>
                    @if($user->status == 0)
                      <span class="badge bg-label-danger">Incomplete</span>
                      @elseif($user->status == 1)
                      <span class="badge bg-label-success">Active</span>
                      @elseif($user->status == 2)
                       <span class="badge bg-label-warning">Suspended</span>
                      @elseif($user->status == 3)
                      <span class="badge bg-label-warning">Terminated</span>
                      @elseif($user->status == 4)
                      <span class="badge bg-label-danger">Incomplete</span>
                      @elseif($user->status == 5)
                      <span class="badge bg-label-warning">Unverrified</span>
                      @else
                          <span></span>
                    @endif
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Contact:</span>
                    <span>@if($user && $user->phone_number){{$user->phone_number}}@endif</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">GSTIN:</span>
                    <span>@if($ClientDetail && $ClientDetail->gstin){{$ClientDetail->gstin}}@endif</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">HSN/SAC:</span>
                    <span>@if($ClientDetail && $ClientDetail->hsn_sac){{$ClientDetail->hsn_sac}}@endif</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">TDS:</span>
                    <span>@if($ClientDetail && $ClientDetail->tds){{$ClientDetail->tds}}@endif</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Country:</span>
                    <span>@if($Country && $Country->name){{$Country->name}}@endif</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">State:</span>
                    <span>@if($State && $State->name){{$State->name}}@endif</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">City:</span>
                    <span>@if($City && $City->name){{$City->name}}@endif</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Pincode:</span>
                    <span>@if($ClientDetail && $ClientDetail->pincode){{$ClientDetail->pincode}}@endif</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Address 1:</span>
                    <span>@if($ClientDetail && $ClientDetail->address_1){{$ClientDetail->address_1}}@endif</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Address 2:</span>
                    <span>@if($ClientDetail && $ClientDetail->address_2){{$ClientDetail->address_2}}@endif</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Verified Document:</span>
                   @if($user && $user->doc_verify)
                    <span><a class="card-link" target="_blank" href="{{$user->doc_verify}}">Download</a></span>
                @else
                    <span><a class="card-link" href="#">Download</a></span>
                @endif

                    </li>
                  </ul>
                  <!-- <div class="d-flex justify-content-center">
                    <a href="{{url('/')}}/admin/Client/edit/32"
                    class="btn btn-primary me-3 waves-effect waves-light">Edit</a>
                    <a href="javascript:;"
                    class="btn btn-label-danger suspend-user waves-effect">Suspended</a>
                  </div> -->
                </div>
              </div>
          </div>            
            <!-- <div class="card mb-4">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                  <span class="badge bg-label-primary">Standard</span>
                  <div class="d-flex justify-content-center">
                    <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">$</sup>
                    <h1 class="mb-0 text-primary">99</h1>
                    <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                  </div>
                </div>
                <ul class="ps-3 g-2 my-3">
                  <li class="mb-2">10 Users</li>
                  <li class="mb-2">Up to 10 GB storage</li>
                  <li>Basic Support</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mb-1 fw-medium text-heading">
                  <span>Days</span>
                  <span>65% Completed</span>
                </div>
                <div class="progress mb-1" style="height: 8px">
                  <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span>4 days remaining</span>
                <div class="d-grid w-100 mt-4">
                  <button class="btn btn-primary waves-effect waves-light" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">
                    Upgrade Plan
                  </button>
                </div>
              </div>
            </div> -->
      </div>
      <!--/ User Sidebar -->


      <!-- User Content -->
      <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                                <div class="row">
                                  <div class="col-4">
                                    <div class="card">
                                      <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                          <div class="col-xl-8 col-lg-6 col-md-6 ">
                                            <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                                              <div class="d-block text-capitalize">
                                                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Total Projects</h5>
                                                <div class="d-flex">
                                                  <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid">
                                                    <span id="">{{ $TotalProject }}</span>
                                                  </p>
                                                </div>
                                              </div>

                                            </div>

                                          </div>
                                          <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                                            <i class="fa-solid fa-diagram-project text-lightest f-18"></i>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-4">
                                    <div class="card">
                                      <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                          <div class="col-xl-8 col-lg-6 col-md-6 ">
                                            <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                                              <div class="d-block text-capitalize">
                                                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Total Earnings</h5>
                                                <div class="d-flex">
                                                  <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid">
                                                    <span id="">1</span>
                                                  </p>
                                                </div>
                                              </div>

                                            </div>
                                          </div>
                                          <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                                            <i class="fa fa-money text-lightest f-18"></i>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-4">
                                    <div class="card">
                                      <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                          <div class="col-xl-8 col-lg-6 col-md-6 ">
                                            <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                                              <div class="d-block text-capitalize">
                                                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Due Invoices</h5>
                                                <div class="d-flex">
                                                  <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid">
                                                    <span id="">@if($ClientDetail && $ClientDetail->over_due_invoice){{$ClientDetail->over_due_invoice}}@endif</span>
                                                  </p>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                                            <i class="fas fa-file-invoice text-lightest f-18"></i>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row mt-4">

                                  <div class="col-6">
                                    <div class="card bg-white border-0 b-shadow-4">
                                      <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                                        <h4 class="f-18 f-w-500 mb-0">Projects</h4>
                                      </div>

                                      <div class="card-body pt-2 ">
                                        <div class="m-auto" style="height: 250px; width: 300px">
                                          <canvas id="project-chart" height="375" width="375" style="display: block; box-sizing: border-box; height: 300px; width: 300px;"></canvas>
                                        </div>
                                        <script>
                                          var ctx = document.getElementById("project-chart");

                                          var myChart = new Chart(ctx, {
                                            type: 'pie',
                                            data: {
                                              labels: [
                                                "in progress",
                                                "not started",
                                                "on hold",
                                                "canceled",
                                                "finished",
                                                ],
                                              datasets: [
                                              {
                                                label: 'Dataset 1',
                                                data: [
                                                  1,
                                                  0,
                                                  0,
                                                  0,
                                                  0,
                                                  ],
                                                backgroundColor: [
                                                  "#00b5ff",
                                                  "#616e80",
                                                  "#f5c308",
                                                  "#d21010",
                                                  "#679c0d",
                                                  ],
                                              }
                                              ]
                                            },
                                            options: {
                                              responsive: true,
                                              plugins: {
                                                legend: {
                                                  position: 'right',
                                                },
                                                title: {
                                                  display: false,
                                                  text: 'Chart.js Pie Chart'
                                                }
                                              }
                                            },
                                          });
                                        </script>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="card bg-white border-0 b-shadow-4">
                                      <div class="card bg-white border-0 b-shadow-4">
                                        <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                                          <h4 class="f-18 f-w-500 mb-0">Invoices</h4>



                                        </div>

                                        <div class="card-body pt-2 ">
                                          <div class="m-auto" style="height: 250px; width: 300px">
                                            <canvas id="invoice-chart" height="375" width="375" style="display: block; box-sizing: border-box; height: 300px; width: 300px;"></canvas>
                                          </div>
                                          <script>
                                            var ctx = document.getElementById("invoice-chart");

                                            var myChart = new Chart(ctx, {
                                              type: 'pie',
                                              data: {
                                                labels: [
                                                  "Paid",
                                                  "Unpaid",
                                                  "Partial",
                                                  "Canceled",
                                                  "Draft",
                                                  ],
                                                datasets: [
                                                {
                                                  label: 'Dataset 1',
                                                  data: [
                                                    3,
                                                    0,
                                                    0,
                                                    0,
                                                    0,
                                                    ],
                                                  backgroundColor: [
                                                    "#2CB100",
                                                    "#FCBD01",
                                                    "#1d82f5",
                                                    "#D30000",
                                                    "#616e80",
                                                    ],
                                                }
                                                ]
                                              },
                                              options: {
                                                responsive: true,
                                                plugins: {
                                                  legend: {
                                                    position: 'right',
                                                  },
                                                  title: {
                                                    display: false,
                                                    text: 'Chart.js Pie Chart'
                                                  }
                                                }
                                              },
                                            });
                                          </script>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12 mt-4">
                                    <!-- Change Password -->
                                    <div class="card mb-4">
              <h5 class="card-header">Change Password</h5>
              <div class="card-body">
                 @if ($errors->any()) 
                
            @endif
          <form class="formChangePassword2" method="POST" action="{{ url('user/MyProfile/changePassword/'.$id) }}">
                  @csrf
                  <div class="alert alert-warning" role="alert">
                    <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
                    <span>Minimum 8 characters long, uppercase & symbol</span>
                    <span class="show_error text-danger"></span>

                  </div>
                  <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                  <br>
                  <span class="alert alert-warning show_err" style="display: none;" role="alert"></span>
                  <span class="alert alert-success show_succ" style="display: none;" role="alert"></span>
                  <br>

                  <div class="row mt-3">
                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                      <label class="form-label" for="newPassword">New Password</label>
                      <div class="input-group input-group-merge">
                        <input
                        class="form-control"
                        type="password"
                        id="newPassword"
                        name="newPassword"
                        required
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div>

                    </div>


                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                      <label class="form-label" for="confirmPassword">Confirm New Password</label>
                      <div class="input-group input-group-merge">
                        <input
                        class="form-control"
                        type="password"
                        name="confirmPassword"
                        id="confirmPassword"
                        required
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                    <div>
                      <button type="submit" id="pass_btn" class="btn btn-primary" onclick="return Validate()">Change Password</button>
                    </div>
                    <script type="text/javascript">
                        function Validate() {
                            var password = document.getElementById("newPassword").value;
                            var confirmPassword = document.getElementById("confirmPassword").value;
                            if (password != confirmPassword) {
                                $('#show_error').text("Passwords do not match.");
                                
                            }
                            
                        }
                    </script>
                    <script>  
                    $(document).ready (function () {  
                      $("#formChangePassword2").validate ();
                    });  
                    </script>
                  </div>
                </form>
              </div>
            </div>
                                    <!--/ Change Password -->
                                  </div>
                                </div>
      </div>
      <!--/ User Content -->
  </div>
  <div class="Teamscreen" style="display:none;">
      <div class="row">
                              <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                <div class="card mb-4">
                                  <h5 class="card-header">Team Section</h5>

                                  <div class="card-body">
                                    <div class="table-responsive">
                                      <table class="table border-top">
                                        <thead>
                                          <tr>
                                            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                            <th>ID</th>
                                            <th>SUBJECT</th>
                                            <th>CUSTOMER NAME</th>
                                            <th>STAGE</th>
                                            <th>TOTAL</th>
                                            <th>VALID UNTIL</th>
                                            <th>LAST MODIFICATION</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @if(count($quotes) > 0)
                                          @foreach($quotes as $key => $user)
                                          <tr class="odd">
                                            <td class="text-truncate">{{ $key+1 }} </td>
                                            <!-- Issue here: Use $user instead of $quotes -->
                                            <td class="text-truncate">@if($user && $user->subject) {{ $user->subject }} @endif</td>
                                            <td class="text-truncate">@if($user && $user->first_name) {{ $user->first_name }} @endif</td>
                                            <td class="text-truncate">
                                              @switch($user->status)
                                              @case('1')
                                              <span class="badge bg-label-secondary">Delivered</span>
                                              @break
                                              @case('2')
                                              <span class="badge bg-label-warning">onhold</span>
                                              @break
                                              @case('3')
                                              <span class="badge bg-label-primary">Accepted</span>
                                              @break
                                              @case('4')
                                              <span class="badge bg-label-danger">Lost</span>
                                              @break
                                              @case('5')
                                              <span class="badge bg-label-success">Win</span>
                                              @break
                                              @default
                                              <span></span>
                                              @endswitch
                                            </td>
                                            <td class="text-truncate">@if($user && $user->total) {{ $user->total }} @endif</td>
                                            <td class="text-truncate">@if($user && $user->valid_until) {{ $user->valid_until }} @endif</td>
                                            <td class="text-truncate">@if($user && $user->updated_at) {{ $user->updated_at->format('Y-m-d') }} @endif</td>                  

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
  <div class="Quotesscreen" style="display:none;">
    <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                  <div class="card mb-4">
                                    <h5 class="card-header">Recent Quotes</h5>

                                    <div class="card-body">
                                      <div class="table-responsive">
                                        <table class="table border-top">
                                          <thead>
                                            <tr>
                                              <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                              <th>ID</th>
                                              <th>SUBJECT</th>
                                              <th>CUSTOMER NAME</th>
                                              <th>STAGE</th>
                                              <th>TOTAL</th>
                                              <th>VALID UNTIL</th>
                                              <th>LAST MODIFICATION</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @if(count($quotes) > 0)
                                            @foreach($quotes as $key => $user)
                                            <tr class="odd">
                                              <td class="text-truncate">{{ $key+1 }} </td>
                                              <!-- Issue here: Use $user instead of $quotes -->
                                              <td class="text-truncate">@if($user && $user->subject) {{ $user->subject }} @endif</td>
                                              <td class="text-truncate">@if($user && $user->first_name) {{ $user->first_name }} @endif</td>
                                              <td class="text-truncate">
                                                @switch($user->status)
                                                @case('1')
                                                <span class="badge bg-label-secondary">Delivered</span>
                                                @break
                                                @case('2')
                                                <span class="badge bg-label-warning">onhold</span>
                                                @break
                                                @case('3')
                                                <span class="badge bg-label-primary">Accepted</span>
                                                @break
                                                @case('4')
                                                <span class="badge bg-label-danger">Lost</span>
                                                @break
                                                @case('5')
                                                <span class="badge bg-label-success">Win</span>
                                                @break
                                                @default
                                                <span></span>
                                                @endswitch
                                              </td>
                                              <td class="text-truncate">@if($user && $user->total) {{ $user->total }} @endif</td>
                                              <td class="text-truncate">@if($user && $user->valid_until) {{ $user->valid_until }} @endif</td>
                                              <td class="text-truncate">@if($user && $user->updated_at) {{ $user->updated_at->format('Y-m-d') }} @endif</td>                  

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
  <div class="Ticketscreen" style="display:none;">
    <div class="row">
                              <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                <div class="card mb-4">
                                  <h5 class="card-header">Recent Tickets</h5>

                                  <div class="card-body">
                                    <div class="table-responsive">
                                      <table class="table border-top">
                                        <thead>
                                          <tr>
                                            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                            <th>ID</th>
                                            <th>DEPARTMENT</th>
                                            <th>SUBJECT</th>
                                            <th>EMAIL</th>
                                            <th>ASSIGNED TO</th>
                                            <th>STATUS</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @if(count($Ticket) > 0)
                                          @foreach($Ticket as $key=>$Tick)
                                          @php $client =  \App\Models\User::select('first_name','profile_img','email')->where('id',$Tick->client_id)->where('type',2)->first() @endphp
                                          @php $Department =  \App\Models\Department::where('id',$Tick->department_id)->first() @endphp
                                          <tr>
                                            <td class="text-truncate">{{$key+1}}</td>
                                            <td class="text-truncate">@if($Department && $Department->name){{$Department->name}} @else {!!$Tick->department_id!!} @endif</td>
                                            <td class="text-truncate">{{$Tick->subject}}</td>
                                            <td class="text-truncate">
                                              @if($client && $client->email)
                                              {{ $client->email }}
                                              @else
                                              @php
                                              preg_match('/<([^>]+)>/', $Tick->department_id, $matches);
                                                $extractedEmail = isset($matches[1]) ? $matches[1] : null;
                                                @endphp

                                                {{ $extractedEmail ?? $Tick->department_id }}
                                                @endif
                                              </td>

                                              <td class="text-truncate">
                                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label=" @if($client && $client->profile_img) {{$client->first_name}} @endif" data-bs-original-title=" @if($client && $client->profile_img) {{$client->first_name}} @else Google @endif">
                                                    <img @if($client && $client->profile_img) src="{{$client->profile_img}}" @else src="{{url('public/logo/google.jpg')}}"   @endif alt="Avatar" class="rounded-circle">
                                                  </li>
                                                </ul>
                                              </td>
                                              <td class="text-truncate">
                                                @if($Tick->status == 1)
                                                <span class="badge bg-label-success me-1">Open</span>
                                                @elseif($Tick->status == 2)
                                                <span class="badge bg-label-primary me-1">InProgress</span>
                                                @elseif($Tick->status == 3)
                                                <span class="badge bg-label-info me-1">Pending</span>
                                                @elseif($Tick->status == 4)
                                                <span class="badge bg-label-danger me-1">OnHold</span>
                                                @elseif($Tick->status == 5)
                                                <span class="badge bg-label-secondary me-1">Resolved</span>
                                                @elseif($Tick->status == 6)
                                                <span class="badge bg-label-warning me-1">Closed</span>
                                                @endif
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
    </div>
  </div>
  <div class="Invoicescreen" style="display:none;">
      <div class="row">
                              <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                <div class="card mb-4">
                                  <h5 class="card-header">Recent Invoices</h5>

                                  <div class="card-body">
                                    <div class="table-responsive">
                                      <table class="table border-top">
                                        <thead>
                                          <tr>
                                            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                            <th>ID</th>
                                            <th>SUBJECT</th>
                                            <th>CUSTOMER NAME</th>
                                            <th>STAGE</th>
                                            <th>TOTAL</th>
                                            <th>VALID UNTIL</th>
                                            <th>LAST MODIFICATION</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @if(count($quotes) > 0)
                                          @foreach($quotes as $key => $user)
                                          <tr class="odd">
                                            <td class="text-truncate">{{ $key+1 }} </td>
                                            <!-- Issue here: Use $user instead of $quotes -->
                                            <td class="text-truncate">@if($user && $user->subject) {{ $user->subject }} @endif</td>
                                            <td class="text-truncate">@if($user && $user->first_name) {{ $user->first_name }} @endif</td>
                                            <td class="text-truncate">
                                              @switch($user->status)
                                              @case('1')
                                              <span class="badge bg-label-secondary">Delivered</span>
                                              @break
                                              @case('2')
                                              <span class="badge bg-label-warning">onhold</span>
                                              @break
                                              @case('3')
                                              <span class="badge bg-label-primary">Accepted</span>
                                              @break
                                              @case('4')
                                              <span class="badge bg-label-danger">Lost</span>
                                              @break
                                              @case('5')
                                              <span class="badge bg-label-success">Win</span>
                                              @break
                                              @default
                                              <span></span>
                                              @endswitch
                                            </td>
                                            <td class="text-truncate">@if($user && $user->total) {{ $user->total }} @endif</td>
                                            <td class="text-truncate">@if($user && $user->valid_until) {{ $user->valid_until }} @endif</td>
                                            <td class="text-truncate">@if($user && $user->updated_at) {{ $user->updated_at->format('Y-m-d') }} @endif</td>                  

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
  <div class="Servicescreen" style="display:none;">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
        <div class="card mb-4 mt-4">
          <h5 class="card-header pb-1">Connected Accounts</h5>
          <div class="card-body">
                                          <p class="mb-4">Display content from your connected accounts on your site</p>
                                          @if($Orders)
                                            @foreach($Orders as $datas)
                                              <div class="d-flex mb-3">
                                              <div class="flex-shrink-0">
                                                <img src="{{url('/')}}/public/logo/basemetal.png" alt="google" class="me-3" height="38">
                                              </div>
                                              <div class="flex-grow-1 row">
                                                <div class="col-9 mb-sm-0 mb-2">
                                                  <h6 class="mb-0">{{ $datas->products_name }}</h6>
                                                  <small class="text-muted">{{ $datas->product_tag_line }} </small>
                                                </div>
                                                <div class="col-3 d-flex align-items-center justify-content-end">
                                                  <div class="form-check form-switch">
                                                    <input class="form-check-input float-end" type="checkbox" checked="">
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            @endforeach
                                          @else
                                            <div class="d-flex mb-3">
                                            <h2>No services Available</h2>
                                          </div>
                                          @endif
                                         <!-- 
                                          <div class="d-flex mb-3">
                                            <div class="flex-shrink-0">
                                              <img src="{{url('/')}}/public/logo/Azure.png" alt="mailchimp" class="me-3" height="38">
                                            </div>
                                            <div class="flex-grow-1 row">
                                              <div class="col-9 mb-sm-0 mb-2">
                                                <h6 class="mb-0">Microsoft</h6>
                                                <small class="text-muted">Azure</small>
                                              </div>
                                              <div class="col-3 d-flex align-items-center justify-content-end">
                                                <div class="form-check form-switch">
                                                  <input class="form-check-input float-end" type="checkbox" checked="">
                                                </div>
                                              </div>
                                            </div>
                                          </div> -->
                                        <!--   <div class="d-flex mb-3">
                                            <div class="flex-shrink-0">
                                              <img src="{{url('/')}}/public/assets/img/icons/brands/google.png" alt="google" class="me-3" height="38">
                                            </div>
                                            <div class="flex-grow-1 row">
                                              <div class="col-9 mb-sm-0 mb-2">
                                                <h6 class="mb-0">Google</h6>
                                                <small class="text-muted">WorkSpace</small>
                                              </div>
                                              <div class="col-3 d-flex align-items-center justify-content-end">
                                                <div class="form-check form-switch">
                                                  <input class="form-check-input float-end" type="checkbox" checked="">
                                                </div>
                                              </div>
                                            </div>
                                          </div>
 -->
                                         <!--  <div class="d-flex mb-3">
                                            <div class="flex-shrink-0">
                                              <img src="{{url('/')}}/public/logo/aws.png" alt="github" class="me-3" height="38">
                                            </div>
                                            <div class="flex-grow-1 row">
                                              <div class="col-9 mb-sm-0 mb-2">
                                                <h6 class="mb-0">Amazon</h6>
                                                <small class="text-muted">WEB Services</small>
                                              </div>
                                              <div class="col-3 d-flex align-items-center justify-content-end">
                                                <div class="form-check form-switch">
                                                  <input class="form-check-input float-end" type="checkbox" checked="">
                                                </div>
                                              </div>
                                            </div>
                                          </div>
 -->
                                        <!--   <div class="d-flex">
                                            <div class="flex-shrink-0">
                                              <img src="{{url('/')}}/public/assets/img/icons/brands/asana.png" alt="asana" class="me-3" height="38">
                                            </div>
                                            <div class="flex-grow-1 row">
                                              <div class="col-9 mb-sm-0 mb-2">
                                                <h6 class="mb-0">Asana</h6>
                                                <small class="text-muted">Communication</small>
                                              </div>
                                              <div class="col-3 d-flex align-items-center justify-content-end">
                                                <div class="form-check form-switch">
                                                  <input class="form-check-input float-end" type="checkbox">
                                                </div>
                                              </div>
                                            </div>
                                          </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- log activity -->
  <div class="Logscreen" style="display:none;">
                            <div class="row">
                              <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                <div class="card mb-4">
                                  <h5 class="card-header">Log activity</h5>
                                    <div class="card-body">
                                                <div class="table-responsive">
                                                  <table class="table border-top">
                                                      <thead>
                                                        <tr>
                                                          <th class="text-truncate">Browser</th>
                                                          <th class="text-truncate">IP Address</th>
                                                          <th class="text-truncate">Last Login</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                              <tr>
                                                  <td class="text-truncate">
                                                      <i class="ti ti-brand-windows text-info ti-xs me-2"></i>
                                                      <span class="fw-medium">{{ $LastloginLogActivity->browser }}</span>
                                                  </td>                                   
                                                  <td class="text-truncate">{{ $LastloginLogActivity->ip }}</td>
                                                  <td class="text-truncate">{{ $LastloginLogActivity->created_at->format('d, F Y H:i') }}</td>
                                              </tr>
                                                      
                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div>
                                </div>
                              </div>
                            </div>
  </div>
  <!-- log activity -->
</div>
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog"></div>
<script>
$(document).ready(function() {
    $("#ProfileButton").click(function() {
        $(this).addClass("active");
        $("#TeamButton, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss").removeClass("active");
        $('.screenProfile').show(500);
        $('.Quotesscreen, .Ticketscreen, .Invoicescreen, .Teamscreen, .Logscreen, .Servicescreen').hide(500);
    });

    $("#TeamButton").click(function() {
        $(this).addClass("active");
        $("#ProfileButton, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss").removeClass("active");
        $('.Teamscreen').show(500);
        $('.screenProfile, .Quotesscreen, .Ticketscreen, .Invoicescreen, .Logscreen, .Servicescreen').hide(500);
    });

    $("#QuotesButton").click(function() {
        $(this).addClass("active");
        $("#TeamButton, #ProfileButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss").removeClass("active");
        $('.Quotesscreen').show(500);
        $('.Teamscreen, .screenProfile, .Ticketscreen, .Invoicescreen, .Logscreen, .Servicescreen').hide(500);
    });

    $("#InvButton").click(function() {
        $(this).addClass("active");
        $("#QuotesButton, #TeamButton, #ProfileButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss").removeClass("active");
        $('.Invoicescreen').show(500);
        $('.Quotesscreen, .Teamscreen, .screenProfile, .Ticketscreen, .Logscreen, .Servicescreen').hide(500);
    });

    $("#ServiceButton").click(function() {
        $(this).addClass("active");
        $("#ProfileButton, #billingButton, #TeamButton, #QuotesButton, #InvButton, #ticketButton, #transactionsButton, #LogActivityss").removeClass("active");
        $('.Servicescreen').show(500);
        $('.Invoicescreen, .Quotesscreen, .Teamscreen, .screenProfile, .Ticketscreen, .Logscreen').hide(500);
    });

    $("#ticketButton").click(function() {
        $(this).addClass("active");
        $("#ProfileButton, #InvButton, #ServiceButton, #transactionsButton, #LogActivityss").removeClass("active");
        $('.Ticketscreen').show(500);
        $('.Servicescreen, .Invoicescreen, .Quotesscreen, .Teamscreen, .screenProfile, .Logscreen').hide(500);
    });

    $("#transactionsButton").click(function() {
        $(this).addClass("active");
        $("#ProfileButton, #billingButton, #TeamButton, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #LogActivityss").removeClass("active");
         $('.transactionsscreen').show(500);
        $('.Servicescreen, .Invoicescreen, .Quotesscreen, .Teamscreen, .screenProfile, .Logscreen').hide(500);
    });

    $("#LogActivityss").click(function() {
        $(this).addClass("active");
        $("#ProfileButton, #billingButton, #TeamButton, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton").removeClass("active");
         $('.Logscreen').show(500);
        $('.screenProfile, .Quotesscreen, .Ticketscreen, .Invoicescreen, .Teamscreen, .Servicescreen').hide(500);
    });
});

function EditClient(id)
{
    $.ajax({
        url: "{{url('user/MyProfile/edit')}}",
        method: 'GET',
        data: { id: id },
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
<!-- <script>
                          $(document).ready(function () {
                            $(".formChangePassword2").submit(function (e) {
                              e.preventDefault();

            // Perform client-side validation
                              var newPassword = $("#newPassword").val();
                              var confirmPassword = $("#confirmPassword").val();
            var errorSpan = $(".show_err"); // Select the error span
            var SucSpan = $(".show_succ"); // Select the error span
            errorSpan.hide(); // Hide the error span initially
            if (newPassword.length < 8 || !/[A-Z]/.test(newPassword) || !/[!@#$%^&*()_+{}|:"<>?~=\\-]/.test(newPassword)) {
              errorSpan.text("Password must be at least 8 characters long and contain at least one uppercase letter and one symbol.");
              errorSpan.show();
              return;
            }
            if (newPassword !== confirmPassword) {
              errorSpan.text("Passwords do not match.");
              errorSpan.show();
              return;
            }
            $.ajax({
              type: "POST",
              url: $(this).attr("action"),
              data: $(this).serialize(),
              success: function (response) {
                SucSpan.text("Password Changed Successfully.");
                SucSpan.show();
                setTimeout(function () {
                  location.reload();
                }, 600);
                return;
                      // location.reload();
              },
              error: function (xhr, status, error) {
                    // Handle the error response, e.g., show an error message
                    //alert("Error: " + error);
              }
            });
        });
                          });
                        </script> -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <script>
    // Fetch project data from the backend (replace this with your actual endpoint)
                          var projectData = <?php echo json_encode($projects); ?>;

    // Process project data to get counts for each status
                          var projectStatusCounts = {
                            inProgress: 0,
                            notStarted: 0,
                            onHold: 0,
                            canceled: 0,
                            finished: 0
                          };

                          projectData.forEach(function(project) {
                            switch (project.status_id) {
                            case 1:
                              projectStatusCounts.notStarted++;
                              break;
                            case 2:
                              projectStatusCounts.onHold++;
                              break;
                            case 3:
                              projectStatusCounts.inProgress++;
                              break;
                            case 4:
                              projectStatusCounts.canceled++;
                              break;
                            case 5:
                              projectStatusCounts.finished++;
                              break;
                            default:
                              break;
                            }
                          });

    // Projects Chart
                          var projectCtx = document.getElementById("project-chart").getContext("2d");
                          var projectChart = new Chart(projectCtx, {
                            type: 'pie',
                            data: {
                              labels: ["In Progress", "Not Started", "On Hold", "Canceled", "Finished"],
                              datasets: [{
                                data: [
                                  projectStatusCounts.inProgress,
                                  projectStatusCounts.notStarted,
                                  projectStatusCounts.onHold,
                                  projectStatusCounts.canceled,
                                  projectStatusCounts.finished
                                  ],
                                backgroundColor: ["#00b5ff", "#616e80", "#f5c308", "#d21010", "#679c0d"],
                              }]
                            },
                            options: {
                              responsive: true,
                              legend: { position: 'right' },
                              title: { display: false, text: 'Projects' },
                            }
                          });


    // Fetch task data from the backend (replace this with your actual endpoint)
                          var taskData = <?php echo json_encode($tasks); ?>;

    // Process task data to get counts for each status
                          var taskStatusCounts = {
                            inProgress: 0,
                            notStarted: 0,
                            onHold: 0,
                            canceled: 0,
                            finished: 0
                          };

                          taskData.forEach(function(task) {
                            if (task.status_id == 3) {
                              taskStatusCounts.inProgress++;
                            }
                          });

    // Tasks Chart
                          var taskCtx = document.getElementById("invoice-chart").getContext("2d");
                          var taskChart = new Chart(taskCtx, {
                            type: 'pie',
                            data: {
                              labels: ["In Progress", "Not Started", "On Hold", "Canceled", "Finished"],
                              datasets: [{
                                data: [
                                  taskStatusCounts.inProgress,
                                  taskStatusCounts.notStarted,
                                  taskStatusCounts.onHold,
                                  taskStatusCounts.canceled,
                                  taskStatusCounts.finished
                                  ],
                                backgroundColor: ["#00b5ff", "#616e80", "#f5c308", "#d21010", "#679c0d"],
                              }]
                            },
                            options: {
                              responsive: true,
                              legend: { position: 'right' },
                              title: { display: false, text: 'Tasks' },
                            }
                          });
</script>
@endsection

