@extends('layouts.admin')
@section('title', 'My Profile')
@section('content')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"/>
<style>
.modal-dialog {
    max-width: 90%;
}

#image {
    max-width: 100%;
    height: auto;
}

</style>
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
        @endif
        <div class="d-flex justify-content-between">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">My Profile</span>
            </h4>
            <a class="btn btn-label-primary" style="margin:27px 0px 22px;" data-bs-target="#edit-profile" data-bs-toggle="modal"><i
                    class="fas fa-edit"></i></a>
        </div>
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-0 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class=" bg-label-primary rounded-3 text-center d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{ $user->profile_img }}" height="100"
                                    width="100" alt="User avatar">
                                <div class="user-info text-center mb-1">
                                    <h4 class="mb-2">{{ $user->gender }} {{ $user->first_name }}</h4>
                                    <span class="badge bg-label-secondary mt-1">
                                        @if (auth::user()->type == 2)
                                            Client
                                        @else
                                            Employee
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                            <div class="d-flex align-items-start me-4 mt-3 gap-2">
                                <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-checkbox ti-sm"></i></span>
                                <div>
                                    <p class="mb-0 fw-medium">1.23k</p>
                                    <small>Tasks Done</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mt-3 gap-2">
                                <span class="badge bg-label-primary p-2 rounded"><i
                                        class="ti ti-briefcase ti-sm"></i></span>
                                <div>
                                    <p class="mb-0 fw-medium">568</p>
                                    <small>Projects Done</small>
                                </div>
                            </div>
                        </div>
                        <p class="mt-4 small text-uppercase text-muted">Details</p>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="fw-medium me-1">Username:</span>
                                    <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-medium me-1">Email:</span>
                                    <span>{{ $user->email }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-medium me-1">Status:</span>
                                    @if ($user->status == 0)
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
                                    <span class="fw-medium me-1">Role:</span>
                                    <span>
                                        @if (auth::user()->type == 2)
                                            Client
                                        @else
                                            Employee
                                        @endif
                                    </span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-medium me-1">Tax id:</span>
                                    <span>Tax-8965</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-medium me-1">Contact:</span>
                                    <span>
                                        @if ($user && $user->phone_number)
                                            {{ $user->phone_number }}
                                        @endif
                                    </span>
                                </li>
                                <!-- <li class="mb-2 pt-1">
                                    <span class="fw-medium me-1">Languages:</span>
                                    <span>French</span>
                                </li> -->
                                <li class="pt-1">
                                    <span class="fw-medium me-1">Country:</span>
                                    <span>
                                        @if ($Country && $Country->name)
                                            {{ $Country->name }}
                                        @endif
                                    </span>
                                </li>
                            </ul>
                            <div class="d-flex">
                                  <a class="btn btn-label-primary" style="margin:27px 0px 22px;" data-bs-target="#edit-profile" data-bs-toggle="modal"><i
                    class="fas fa-edit"></i>Edit</a>
                                <!-- <a href="javascript:;" class="btn btn-label-danger suspend-user waves-effect">Suspended</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
                <!-- Plan Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="badge bg-label-primary">Standard</span>
                            <div class="d-flex justify-content-center">
                                <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">$</sup>
                                <h1 class="fw-medium mb-0 text-primary">99</h1>
                                <sub class="h6 pricing-duration mt-auto mb-2 fw-normal text-muted">/month</sub>
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
                            <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>4 days remaining</span>
                        <div class="d-grid w-100 mt-4">
                            <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">
                                Upgrade Plan
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="justify-content-between align-items-start">
                            <h5>Account Manager</h5>
                            <p>Name : @if($accountManager){{$accountManager->first_name}} {{$accountManager->last_name}}@endif</p>
	                        <p>Email : @if($accountManager){{$accountManager->email}}@endif</p>
	                        <p>Contant No. : @if($accountManager){{$accountManager->phone_number}}@endif</p>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7 order-1 order-md-1">
                <!-- User Pills -->
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
                    
                    <li class="nav-item">
                        <button class="nav-link" id="CreditButton">
                            <i class="ti ti-link ti-xs me-1"></i>Credit
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

                <div class="col-xl-12 col-lg-12 col-md-12 order-0 order-md-1 screenProfile">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-xl-8 col-lg-6 col-md-6 ">
                                            <div
                                                class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                                                <div class="d-block text-capitalize">
                                                    <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Total Projects</h5>
                                                    <div class="d-flex">
                                                        <p
                                                            class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid">
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
                                            <div
                                                class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                                                <div class="d-block text-capitalize">
                                                    <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Total Earnings</h5>
                                                    <div class="d-flex">
                                                        <p
                                                            class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid">
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
                                            <div
                                                class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
                                                <div class="d-block text-capitalize">
                                                    <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Due Invoices</h5>
                                                    <div class="d-flex">
                                                        <p
                                                            class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid">
                                                            <span id="">
                                                                @if ($ClientDetail && $ClientDetail->over_due_invoice)
                                                                    {{ $ClientDetail->over_due_invoice }}
                                                                @endif
                                                            </span>
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
                                <div
                                    class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                                    <h4 class="f-18 f-w-500 mb-0">Projects</h4>
                                </div>
                                <div class="card-body pt-2 ">
                                    <div class="m-auto" style="height: 250px; width: 300px">
                                        <canvas id="project-chart" height="375" width="375"
                                            style="display: block; box-sizing: border-box; height: 300px; width: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-white border-0 b-shadow-4">
                                <div class="card bg-white border-0 b-shadow-4">
                                    <div
                                        class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                                        <h4 class="f-18 f-w-500 mb-0">Invoices</h4>
                                    </div>
                                    <div class="card-body pt-2 ">
                                        <div class="m-auto" style="height: 250px; width: 300px">
                                            <canvas id="invoice-chart" height="375" width="375"
                                                style="display: block; box-sizing: border-box; height: 300px; width: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="card mb-4">
                                
                                <div class="card-body">
                                    <div id="qrcode">
                                        <h5>You have {{Auth::user()->google2fa_enabled ? '' : 'not' }} enabled two factor authentication.</h5>
                                        <p>When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.</p>
                                       
                                        @if(Auth::user()->google2fa_enabled)
                                            <a data-bs-target="#confirmPasswordModal" data-bs-toggle="modal"><button
                                                class="btn btn-danger">Disable</button></a>
                                        @else
                                            <a data-bs-target="#confirmPasswordModal" data-bs-toggle="modal"><button
                                                class="btn btn-primary ">Enable</button></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="card mb-4">
                                <h5 class="card-header">Change Password</h5>
                                <div class="card-body">
                                    <form id="formChangePassword" method="POST" onsubmit="return false">
                                        <div class="alert alert-warning" role="alert">
                                            <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
                                            <span>Minimum 8 characters long, uppercase & symbol</span>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                                <label class="form-label" for="newPassword">New Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input class="form-control" type="password" id="newPassword"
                                                        name="newPassword"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="ti ti-eye-off"></i></span>
                                                </div>
                                            </div>

                                            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                                <label class="form-label" for="confirmPassword">Confirm New
                                                    Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input class="form-control" type="password" name="confirmPassword"
                                                        id="confirmPassword"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="ti ti-eye-off"></i></span>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary me-2">Change
                                                    Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--/ Change Password -->
                    </div>
                    <!--/ User Content -->
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 order-0 order-md-1 creditScreen" style="display:none;">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                            <div class="card mb-4">
        						<div class="card-header d-flex justify-content-between">
        						    <h5>Credit History</h5>
        						    <h5>Balance : <span class="text-success">{{$currency->prefix}} {{ number_format($credits->sum('amount'), 2) }}</span></h5>
        						    <a href="jsvascript:void(0)" class="btn btn-primary" data-bs-target="#add-credits" data-bs-toggle="modal">Add Credit</a>
        						</div>
        						<div class="card-body">
        							<div class="table-responsive">
        								<table class="table border-top">
        									<thead>
        										<tr>
        											<th class="text-truncate"></th>
        											<th class="text-truncate">ID</th>
        											<th class="text-truncate">Amount</th>
        											<th class="text-truncate">Date</th>
        										</tr>
        									</thead>
        									<tbody>
        									    @foreach($credits as $credit)
        										<tr>
        											<td class="text-truncate"></td>																    
        											<td class="text-truncate">{{$credit->id}}</td>																    
        											<td class="text-truncate @if($credit->amount > 0) text-success @else text-danger @endif" >{{number_format($credit->amount,2)}}</td>
        											<td class="text-truncate">{{$credit->created_at->format('Y-m-d H:i:s')}}</td>
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
                
                
                

               

                <div class="col-xl-12 col-lg-12 col-md-12 order-0 order-md-1 Servicescreen" style="display:none;">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                            <div class="card mb-4 mt-4">
                                <h5 class="card-header pb-1">Connected Accounts</h5>
                                <div class="card-body">
                                    <p class="mb-4">Display content from your connected accounts on your site</p>
                                    @if ($Orders)
                                        @foreach ($Orders as $datas)
                                            <div class="d-flex mb-3">
                                                <div class="flex-shrink-0">
                                                    <img src="{{url('/')}}/public/logo/basemetal.png"
                                                        alt="google" class="me-3" height="38">
                                                </div>
                                                <div class="flex-grow-1 row">
                                                    <div class="col-9 mb-sm-0 mb-2">
                                                        <h6 class="mb-0">{{ $datas->products_name }}</h6>
                                                        <small class="text-muted">{{ $datas->product_tag_line }} </small>
                                                    </div>
                                                    <div class="col-3 d-flex align-items-center justify-content-end">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input float-end" type="checkbox"
                                                                checked="">
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
                <div class="col-xl-12 col-lg-12 col-md-12 order-0 order-md-1 Logscreen" style="display:none;">
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
                                                        <span
                                                            class="fw-medium">{{ $LastloginLogActivity->browser }}</span>
                                                    </td>
                                                    <td class="text-truncate">{{ $LastloginLogActivity->ip }}</td>
                                                    <td class="text-truncate">
                                                        {{ $LastloginLogActivity->created_at->format('d, F Y H:i') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<div class="modal fade" id="confirmPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
        <div class="modal-content">
            <div class="modal-body p-3 p-md-5">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Confirm Password</h3>
                    <p>For your security, please confirm your password to continue.</p>
                </div>

                <form id="confirmPasswordForm" class="row g-3" onsubmit="return false;">
                    <div class="col-12">
                        <label class="form-label" for="verify-password">For your security, please confirm your password to continue.</label>
                        <input type="password" id="verify-password" name="password" class="form-control" placeholder="Password" />
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="modal-title mb-2">Edit User Information</h3>
                    <p class="text-muted">Updating user details will receive a privacy audit.</p>
                </div>
                <form id="editUserForm" class="row g-3" onsubmit="return false">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserFirstName">First Name</label>
                        <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLastName">Last Name</label>
                        <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="Doe" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalEditUserName">Username</label>
                        <input type="text" id="modalEditUserName" name="modalEditUserName" class="form-control" placeholder="john.doe.007" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserEmail">Email</label>
                        <input type="email" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" placeholder="example@domain.com" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserStatus">Status</label>
                        <select id="modalEditUserStatus" name="modalEditUserStatus" class="select2 form-select" aria-label="Select Status">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                            <option value="3">Suspended</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditTaxID">Tax ID</label>
                        <input type="text" id="modalEditTaxID" name="modalEditTaxID" class="form-control modal-edit-tax-id" placeholder="123 456 7890" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserPhone">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text">US (+1)</span>
                            <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="202 555 0111" />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLanguage">Language</label>
                        <select id="modalEditUserLanguage" name="modalEditUserLanguage" class="select2 form-select" multiple>
                            <option value="english" selected>English</option>
                            <option value="spanish">Spanish</option>
                            <option value="french">French</option>
                            <option value="german">German</option>
                            <option value="dutch">Dutch</option>
                            <option value="hebrew">Hebrew</option>
                            <option value="sanskrit">Sanskrit</option>
                            <option value="hindi">Hindi</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserCountry">Country</label>
                        <select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select" data-allow-clear="true">
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="switch">
                            <input type="checkbox" class="switch-input" />
                            <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                            </span>
                            <span class="switch-label">Use as a billing address?</span>
                        </label>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="modal-title mb-2">Enable One Time Password</h3>
                    <p>Verify Your Mobile Number for SMS</p>
                </div>
                <p>Enter your mobile phone number with country code and we will send you a verification code.</p>
                <form id="enableOTPForm" class="row g-3" onsubmit="return false;">
                    <div class="col-12">
                        <label class="form-label" for="modalEnableOTPPhone">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text">US (+1)</span>
                            <input type="text" id="modalEnableOTPPhone" name="modalEnableOTPPhone" class="form-control phone-number-otp-mask" placeholder="202 555 0111" />
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

            
            <!---- credit modal ----->
            <div class="modal fade" id="add-credits" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h4 class="pb-2 pt-2">Add Credits</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <hr>
                        <div class="modal-body" id="editForm">
                            <div class="row">
                                <div class="col-12">
                                    <label>Amount*</label>
                                    <input type="text" name="amount" class="form-control" id="wallet_amt" placeholder="500" required />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a class="btn btn-primary text-white" data-bs-target="#paymentMethods" data-bs-toggle="modal">Pay</a>
                        </div>
                    </div>
                </div>
            </div>
            <!---- credit modal ----->
            
            <!-- Payment Methods modal -->
            <div class="modal fade " id="paymentMethods" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-enable-otp modal-dialog-centered">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close hide-payment-method" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-3">Select payment methods</h3>
                                <p class="text-muted">Supported payment methods</p>
                            </div>
            
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" id="rzp-button1" style="cursor: pointer;">
                                <div class="d-flex gap-2 align-items-center">
                                    <img src="../../assets/img/icons/payments/razor-light.png" class="img-fluid w-px-50 h-px-30" alt="visa-card" data-app-light-img="icons/payments/razor-light.png" data-app-dark-img="icons/payments/razor-light.png">
            
                                    <h6 class="m-0">Razor Pay</h6>
                                </div>
                                <h6 class="m-0 d-none d-sm-block">Debit / Credit</h6>
                            </div>
                            
                            <div class="d-flex justify-content-sm-between align-items-center border-bottom pb-3 mb-3" id="paypalButton">
                                <div class="d-flex gap-2 align-items-center">
                                    <img src="../../assets/img/icons/payments/paypal-light.png" class="img-fluid w-px-50 h-px-30" alt="american-express-card" data-app-light-img="icons/payments/paypal-light.png" data-app-dark-img="icons/payments/paypal-dark.png">
                                    <h6 class="m-0">Paypal</h6>
                                </div>
                                <h6 class="m-0 d-none d-sm-block">Credit Card</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


          <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
        <div class="modal-content">
            <div class="modal-body p-3 p-md-5">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Upgrade Plan</h3>
                    <p>Choose the best plan for user.</p>
                </div>
                <form id="upgradePlanForm" class="row g-3" onsubmit="return false">
                    <div class="col-sm-8">
                        <label class="form-label" for="choosePlan">Choose Plan</label>
                        <select id="choosePlan" name="choosePlan" class="form-select" aria-label="Choose Plan">
                            <option selected disabled>Choose Plan</option>
                            <option value="standard">Standard - $99/month</option>
                            <option value="exclusive">Exclusive - $249/month</option>
                            <option value="enterprise">Enterprise - $499/month</option>
                        </select>
                    </div>
                    <div class="col-sm-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Upgrade</button>
                    </div>
                </form>
            </div>
            <hr class="mx-n3" />
            <div class="modal-body">
                <p class="mb-0">User's current plan is Standard plan</p>
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex justify-content-center me-2">
                        <sup class="h6 pricing-currency pt-1 mt-3 mb-0 me-1 text-primary">$</sup>
                        <h1 class="display-5 mb-0 text-primary">99</h1>
                        <sub class="h5 pricing-duration mt-auto mb-2 text-muted">/month</sub>
                    </div>
                    <button class="btn btn-label-danger cancel-subscription mt-3">Cancel Subscription</button>
                </div>
            </div>
        </div>
    </div>
</div>

            <!--/ Add New Credit Card Modal -->

            <!-- /Modals -->

            <!-- / Content -->
            <!-- <div class="content-backdrop fade"></div> -->
        </div>
       <!--  <div class="modal fade" id="showedit"  data-bs-backdrop="statics" tabindex="-1" aria-modal="true"
            role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-lg" >
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                </div>
                <div class="modal-body" id="editForm">
                    
                </div>
            </div>

        </div> -->
        <div class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-body" id="editForm">
      <form action="{{url('user/MyProfile/update/')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">Edit Profile</h5>
            @if($user->gender)
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            @endif
          </div>
          <div class="modal-body">
            <div class="input-group mt-5 mb-3">
              <select name="gender" required class="form-select">
                <option value="">Select Gender</option>
                <option @if($user && $user->gender == "Mr") selected @endif value="Mr"> Mr.</option>
                <option @if($user && $user->gender == "Miss") selected @endif value="Miss"> Miss.</option>
              </select>
              <input type="text" required name="first_name" placeholder="First name" @if($user && $user->first_name) value="{{$user->first_name}}" @endif class="form-control"/>
              <input type="text" required name="last_name" placeholder="Last name" @if($user && $user->last_name) value="{{$user->last_name}}" @endif class="form-control"/>
            </div>
            <div class="row mb-4">
              <div class="col-md-6">
                <label for="company_name" class="form-label">Company Name</label>

                <input type="text" required class="form-control" name="company_name" required @if($user && $user->company_name) value="{{$user->company_name}}" @endif >
              </div>
              <div class="col-md-6">
                <label for="phone_number" class="form-label">Phone number</label>
                <input type="number" required name="phone_number" placeholder="+9414177140" @if($user && $user->phone_number) value="{{$user->phone_number}}" @endif class="form-control"/>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-6">
                <label for="email" class="form-label">Email address</label>
                <input type="email" required name="email" placeholder="name@example.com" @if($user && $user->email) value="{{$user->email}}" @endif class="form-control"/>
              </div>
              <!--<div class="col-md-6">-->
              <!--  <div class="form-password-toggle">-->
              <!--    <label class="form-label" for="basic-default-password32">Password</label>-->
              <!--    <div class="input-group input-group-merge">-->
              <!--      <input type="password"  class="form-control" name="password" id="basic-default-password32" value="{{ old('password') }}" placeholder="············" aria-describedby="basic-default-password">-->
              <!--      <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="ti ti-eye-off"></i></span>-->
              <!--    </div>-->
              <!--  </div>-->
              <!--</div>-->
            </div>
            <div class="row mb-4">
              <div class="col-md-6">
                <label for="address_1" class="form-label">Address 1</label>
                <input type="text" required class="form-control" name="address_1" @if($ClientDetail && $ClientDetail->address_1) value="{{$ClientDetail->address_1}}" @endif placeholder="Address 1" />
              </div>
              <div class="col-md-6">
                <label for="address_2" class="form-label">Address 2</label>
                <input type="text" required class="form-control" name="address_2" @if($ClientDetail && $ClientDetail->address_2) value="{{$ClientDetail->address_2}}" @endif placeholder="Address 2" />
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select select2" required name="country" id="country">
                  <option value="">Select Country</option>
                  @foreach($Countrys as $Count)
                  <option @if($ClientDetail && $ClientDetail->country == $Count->id) selected @endif value="{{$Count->id}}">{{$Count->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label for="state" class="form-label">State</label>
                <select class="form-select" required name="state" id="state" required>
                  <option value="">Select State</option>
                  <option value="@if($State && $State->id){{$State->id}} @endif" selected>@if($State && $State->name){{$State->name}} @endif</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="city" class="form-label">City</label>
                <select class="form-select" required name="city" id="city" required>
                  <option value="">Select City</option>
                  <option value="@if($City && $City->id){{$City->id}} @endif" selected>@if($City && $City->name){{$City->name}} @endif</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="number" required class="form-control" @if($ClientDetail && $ClientDetail->pincode) value="{{$ClientDetail->pincode}}" @endif name="pincode" placeholder="Pincode" />
              </div>

              <div class="col-md-3 my-3">
                <label for="gstin" class="form-label">GSTIN</label>
                <input type="text" required class="form-control" name="gstin" @if($ClientDetail && $ClientDetail->gstin) value="{{$ClientDetail->gstin}}" @endif placeholder="GSTIN" />
              </div>
              <div class="col-md-3 my-3">
                <label for="hsn_sac" class="form-label">HSN/SAC</label>
                <input type="number" required class="form-control" name="hsn_sac" @if($ClientDetail && $ClientDetail->hsn_sac) value="{{$ClientDetail->hsn_sac}}" @endif placeholder="HSN/SAC" />
              </div>
              <div class="col-md-3 my-3">
                <label for="" class="form-label">TAN</label>
                <input type="number" required class="form-control" name="tds" @if($ClientDetail && $ClientDetail->tds) value="{{$ClientDetail->tds}}" @endif placeholder="TAN" />
              </div>
            </div>
            <div class="row mb-4"> 
                  <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="uploadedProfile" width="100" height="100"  name="profile_img" @if($user && $user->profile_img) src="{{$user->profile_img}}" @endif alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                    <label for="" class="form-label">Profile Picture <span class="text-danger">*</span></label>
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" id="profilePictureInput"  name="profile_img"   class="image" accept=".png, .jpg, .jpeg" />
                           <label for="imageUpload"></label>
                        </div>
                      </div>
                  </div>
                </div>
            <div class="row mb-4">
              <div class="col-md-6">

              </div>
              <div class="col-md-6 my-4">
                <label for="" class="form-label">Document for Verification<span class="text-danger">*</span></label>
                <div class="avatar-upload">
                  <div class="avatar-edit">
                    <input type="file" id="imageUpload" name="doc_verify" accept="application/pdf" />
                    <label for="doc_verify"></label>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
</div>
  
        </div>
        <!-- Cropping Modal -->
<div id="modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <img id="image" src="" alt="Picture">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="crop" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>

        
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

        <script>
    

            $(document).ready(function() {
                $("#ProfileButton").click(function() {
                    $(this).addClass("active");
                    $("#TeamButton, #QuotesButton, #CreditButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss")
                        .removeClass("active");
                    $('.screenProfile').show(500);
                    $('.Quotesscreen, .Ticketscreen, .Invoicescreen, .Teamscreen, .Logscreen, .Servicescreen')
                        .hide(500);
                });

                // $("#TeamButton").click(function() {
                //     $(this).addClass("active");
                //     $("#ProfileButton, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss")
                //         .removeClass("active");
                //     $('.Teamscreen').show(500);
                //     $('.screenProfile, .Quotesscreen, .Ticketscreen, .Invoicescreen, .Logscreen, .Servicescreen')
                //         .hide(500);
                // });

                // $("#QuotesButton").click(function() {
                //     $(this).addClass("active");
                //     $("#TeamButton, #ProfileButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss")
                //         .removeClass("active");
                //     $('.Quotesscreen').show(500);
                //     $('.Teamscreen, .screenProfile, .Ticketscreen, .Invoicescreen, .Logscreen, .Servicescreen')
                //         .hide(500);
                // });

                // $("#InvButton").click(function() {
                //     $(this).addClass("active");
                //     $("#QuotesButton, #TeamButton, #ProfileButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss")
                //         .removeClass("active");
                //     $('.Invoicescreen').show(500);
                //     $('.Quotesscreen, .Teamscreen, .screenProfile, .Ticketscreen, .Logscreen, .Servicescreen')
                //         .hide(500);
                // });

                $("#ServiceButton").click(function() {
                    $(this).addClass("active");
                    $("#ProfileButton, #billingButton, #TeamButton, #QuotesButton, #InvButton, #ticketButton, #transactionsButton, #LogActivityss")
                        .removeClass("active");
                    $('.Servicescreen').show(500);
                    $('.Invoicescreen, .Quotesscreen, .Teamscreen, .screenProfile, .Ticketscreen, .Logscreen')
                        .hide(500);
                });
                $("#CreditButton").click(function() {
                    $(this).addClass("active");
                    $("#ProfileButton, #ServiceButton").removeClass("active");
                    $('.creditScreen').show(500);
                    $('.Servicescreen, .Quotesscreen, .screenProfile').hide(500);
                });

                // $("#ticketButton").click(function() {
                //     $(this).addClass("active");
                //     $("#ProfileButton, #InvButton, #ServiceButton, #transactionsButton, #LogActivityss")
                //         .removeClass("active");
                //     $('.Ticketscreen').show(500);
                //     $('.Servicescreen, .Invoicescreen, .Quotesscreen, .Teamscreen, .screenProfile, .Logscreen')
                //         .hide(500);
                // });

                // $("#transactionsButton").click(function() {
                //     $(this).addClass("active");
                //     $("#ProfileButton, #billingButton, #TeamButton, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #LogActivityss")
                //         .removeClass("active");
                //     $('.transactionsscreen').show(500);
                //     $('.Servicescreen, .Invoicescreen, .Quotesscreen, .Teamscreen, .screenProfile, .Logscreen')
                //         .hide(500);
                // });

                // $("#LogActivityss").click(function() {
                //     $(this).addClass("active");
                //     $("#ProfileButton, #billingButton, #TeamButton, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton")
                //         .removeClass("active");
                //     $('.Logscreen').show(500);
                //     $('.screenProfile, .Quotesscreen, .Ticketscreen, .Invoicescreen, .Teamscreen, .Servicescreen')
                //         .hide(500);
                // });
                    

var $modal = $('#modal');
var image = document.getElementById('image');
var cropper;
$("body").on("change", ".image", function(e) {
  var files = e.target.files;
  var done = function(url) {
    // Check if the modal is open to avoid setting the image source when changing
    // without confirming the crop
    if (!$modal.hasClass('show')) {
       // alert();
      image.src = url;
      $modal.modal('show');
    }
  };

  var reader;
  var file;

  if (files && files.length > 0) {
    file = files[0];
    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function(e) {
        done(reader.result);
      };
      // reader.readAsDataURL(file);
    }
  }
});

$modal.on('shown.bs.modal', function() {
  cropper = new Cropper(image, {
    aspectRatio: 16 / 16,
    crop: function(e) {
      console.log(e.detail.x);
      console.log(e.detail.y);
    }
  });
}).on('hidden.bs.modal', function() {
  cropper.destroy();
  
  cropper = null;

});


$("#crop").click(function() {
  canvas = cropper.getCroppedCanvas({
    width: 200,
    height: 300,
  });

    // Set canvas rendering quality
  var cropperCanvas = cropper.getCroppedCanvas({
    imageSmoothingQuality: 'high',
  });
  
  cropperCanvas.toBlob(function(blob) {
    url = URL.createObjectURL(blob);
    var reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function() {
      var base64data = reader.result;
      $('#uploadedProfile').attr('src', base64data);

      // Create a new File object with the cropped blob
      var croppedFile = new File([blob], 'cropped_image.jpg', { type: 'image/jpeg' });

      // Create a new FileList containing the cropped file
      var filesList = new DataTransfer();
      filesList.items.add(new File([croppedFile], 'cropped_image.jpg'));

      // Set the new FileList as the value of the input type file
      $('#profilePictureInput')[0].files = filesList.files;

      $modal.modal('hide');
    };
  });
});


$(".close1").click(function(){
    // alert();
    $('#profilePictureInput').val(null);
});
  
            });
  function displayFileName(inputId, displayId) {
        var input = document.getElementById(inputId);
        var display = document.getElementById(displayId);

        if (input.files.length > 0) {
            var fileName = input.files[0].name;
            display.innerText = fileName;
        } else {
            display.innerText = 'Choose File';
        }
    }
            // function EditClient(id) {
                
            //     $.ajax({
            //         url: "{{ url('user/MyProfile/edit') }}",
            //         method: 'GET',
            //         data: {
            //             id: id
            //         },
            //         success: function(data) {
            //             if (data && typeof data == 'string') {
            //                 $('#edit-profile').html(data);
            //                 $('#edit-profile').modal('show');
            //             } else {
            //                 $('#edit-profile').html('<div>No Data Found</div>');
            //                 $('#edit-profile').modal('show');
            //             }
            //         },
            //         error: function() {
            //             $('#edit-profile').html('<div>Error fetching data.</div>');
            //             $('#edit-profile').modal('show');
            //         }
            //     });
            // }

            $(document).ready(function() {
                $(".formChangePassword2").submit(function(e) {
                    e.preventDefault();

                    // Perform client-side validation
                    var newPassword = $("#newPassword").val();
                    var confirmPassword = $("#confirmPassword").val();
                    var errorSpan = $(".show_err"); // Select the error span
                    var SucSpan = $(".show_succ"); // Select the error span
                    errorSpan.hide(); // Hide the error span initially
                    if (newPassword.length < 8 || !/[A-Z]/.test(newPassword) || !/[!@#$%^&*()_+{}|:"<>?~=\\-]/
                        .test(newPassword)) {
                        errorSpan.text(
                            "Password must be at least 8 characters long and contain at least one uppercase letter and one symbol."
                            );
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
                        success: function(response) {
                            SucSpan.text("Password Changed Successfully.");
                            SucSpan.show();
                            setTimeout(function() {
                                location.reload();
                            }, 600);
                            return;
                            // location.reload();
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response, e.g., show an error message
                            //alert("Error: " + error);
                        }
                    });
                });
            });
        </script>
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
                    legend: {
                        position: 'right'
                    },
                    title: {
                        display: false,
                        text: 'Projects'
                    },
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
                    legend: {
                        position: 'right'
                    },
                    title: {
                        display: false,
                        text: 'Tasks'
                    },
                }
            });

        $(document).ready(function() {
            $('#confirmPasswordFrom').submit(function(e) {
                e.preventDefault();
                var password = $("#verify-password").val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('user/match_password') }}", // Assuming 'match_password' is the route name
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        password: password
                    },
                    success: function(response) {
                        if(response.status == 'disabled'){
                            location.reload();
                        }else{
                           $('.btn-close').click();
                            $('#qrcode').html(response);
                            $('#disable2FA').show(); 
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response, e.g., show an error message
                        var errorMessage = xhr.responseJSON.error;
                        alert("Error: " + errorMessage);
                    }
                });
            });

            $(document).on('click','#cancelAuth',function(){
                $('#qrcode').html('<h5>You have not enabled two factor authentication.</h5>' +
                    '<p>When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.</p><a data-bs-target="#confirmPasswordModal" data-bs-toggle="modal"><button class="btn btn-primary">Enable</button></a>'
                    );
            });
        });



        
        
        
        
    
    
$(document).ready(function() {
    
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
                datasets: [{
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
                }]
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

    $(document).on('click', '#rzp-button1', function(e) {
        
        var amount = $('#wallet_amt').val();
        var options = {
            "key": "{{ $PaymentDetail->key_id ?? 'rzp_test_905d9rOq4TKriv' }}",
            "amount": amount * 100, // Convert amount to smallest currency unit (e.g., paisa for INR)
            "currency": "{{$currency->code}}",
            "name": "CloudTechtiq",
            "image": "{{$PaymentDetail->logo_url ?? url('public/logo/company.png') }}",
            "theme": {
                "color": "{{$PaymentDetail->theme_color ?? '#3399cc'}}"
            },
            "handler": function(response) {
                console.log(response);
                window.location.href = "{{ url('user/Credit/store') }}?amount=" + amount+"&payment_id=" + response.razorpay_payment_id;
            }
        };

        var rzp1 = new Razorpay(options);
        rzp1.open();
    });
    
    $('#paypalButton').click(function() {
        // alert("{{ url('paypal/handle-payment') }}?type=credit&amount=" + $('#wallet_amt').val());
        // Construct the URL with the value of #wallet_amt
        window.location.href= "{{ url('paypal/handle-payment') }}?type=credit&amount=" + $('#wallet_amt').val();
    });
    
    
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
        datasets: [{
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
        }]
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
});






        </script>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
      // Function to read and display the selected image
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            // Set the 'src' attribute of the 'img' tag
            $('#imagePreview').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      // Bind the 'change' event to the file input
      $("#imageUpload").change(function() {
        readURL(this);
      });

      $(document).ready(function() {
        // Attach an event handler to the "country" select box
        $('#country').on('change', function() {
          var selectedCountry = $(this).val();
          // Make an AJAX request to fetch states based on the selected country
          $.ajax({
            url: "{{ url('user/MyProfile/getstateData') }}", // Replace with your actual route name
            method: 'post',
            data: {
              countryid: selectedCountry
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
              // Clear existing options in the "state" select box
              $('#state').empty().append('<option value="">Select State</option>');
              // Append new options based on the AJAX response
              $.each(data.states, function(index, state) {
                $('#state').append($('<option>', {
                  value: state.id,
                  text: state.name
                }));
              });
            },
            error: function() {
              console.log('Error fetching data');
            }
          });
        });
      });
      
      $(document).ready(function() {
        // Attach an event handler to the "country" select box
        $('#state').on('change', function() {
          var selectedCountry = $(this).val();
          // Make an AJAX request to fetch states based on the selected country
          $.ajax({
            url: "{{ url('user/MyProfile/getcityData') }}", // Replace with your actual route name
            method: 'post',
            data: {
              stateid: selectedCountry
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
              // Clear existing options in the "state" select box
              $('#city').empty().append('<option value="">Select City</option>');
              // Append new options based on the AJAX response
              $.each(data.citys, function(index, city) {
                $('#city').append($('<option>', {
                  value: city.id,
                  text: city.name
                }));
              });
            },
            error: function() {
              console.log('Error fetching data');
            }
          });
        });
      });
    </script>
    @endsection
