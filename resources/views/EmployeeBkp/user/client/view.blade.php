@extends('layouts.admin')
@section('title', 'Client')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="py-3 mb-4"><span class="text-muted fw-light">User / </span>View</h4>
	<ul class="nav nav-pills flex-column flex-md-row mb-4">
		<li class="nav-item">
			<button class="nav-link active" id="ProfileButton">
				<i class="ti ti-lock ti-xs me-1"></i>Profile
			</button>
		</li>
		
		<li class="nav-item">
			<button class="nav-link " id="team">
				<i class="ti ti-users ti-xs me-1"></i>Team
			</button>
		</li>
		@if($EmpDetails && $EmpDetails->department_id != 1)
		<li class="nav-item">
			<button class="nav-link" id="QuotesButton">
				<i class="ti ti-link ti-xs me-1"></i>Quote
			</button>
		</li>
		<li class="nav-item">
			<button class="nav-link" id="InvButton">
				<i class="ti ti-link ti-xs me-1"></i>Invoices
			</button>
		</li>
		<li class="nav-item">
			<button class="nav-link" id="ServiceButton">
				<i class="ti ti-link ti-xs me-1"></i>Products/Services
			</button>
		</li>
		<li class="nav-item">
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
			</button>
		</li>
		<!--<li class="nav-item">-->
		<!--	<button class="nav-link" id="TwoFactorAuth"><i class="ti ti-currency-dollar ti-xs me-1"></i>Two Factor Auth</button>-->
		<!--</li>-->
		<li class="nav-item">
			<button class="nav-link" id="CreditsButton"><i class="ti ti-currency-dollar ti-xs me-1"></i>Manage Credits</button>
		</li>
		<li class="nav-item">
			<button class="nav-link" id="BillingButton"><i class="ti ti-currency-dollar ti-xs me-1"></i>Billing & Security</button>
		</li>
		@endif
	</ul>
	
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
    @endif

	    <div class="row screenProfile">
		<!-- User Sidebar -->
		    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
			<!-- User Card -->
			    <div class="card mb-4">
				    <div class="card-body">
					<div class="user-avatar-section">
						<div class="d-flex align-items-center flex-column">
							<img class="img-fluid rounded mb-3 pt-1 mt-4"
								@if($user && $user->profile_img) src="{{$user->profile_img}}" @else src="{{url('public/images/profile_bZh2.jpg')}}" @endif
							height="100" width="100" alt="User avatar">
							<div class="user-info text-center">
								<h4 class="mb-2">CloudTechtiq_2 </h4>
							</div>
						</div>
					</div>
					<p class="mt-4 small text-uppercase text-muted">Details</p>
					<div class="info-container">
						<ul class="list-unstyled">
							<li class="mb-2">
								<span class="fw-medium me-1">Full name:</span>
								<span>	@if($user && $user->first_name)  {{$user->first_name}} @endif</span>
							</li>
							<li class="mb-2 pt-1">
								<span class="fw-medium me-1">Email:</span>
								<span>@if($user && $user->email)  {{$user->email}} @endif</span>
							</li>
							<li class="mb-2 pt-1">
								<span class="fw-medium me-1">Status:</span>
								@if($user &&  $user->status == 0)
				                  <span class="badge bg-label-danger">Incomplete</span>
				                  @elseif($user &&  $user->status == 1)
				                  <span class="badge bg-label-success">Active</span>
				                  @elseif($user &&  $user->status == 2)
				                   <span class="badge bg-label-warning">Suspended</span>
				                  @elseif($user &&  $user->status == 3)
				                  <span class="badge bg-label-warning">Terminated</span>
				                  @elseif($user &&  $user->status == 4)
				                  <span class="badge bg-label-danger">Incomplete</span>
				                  @elseif($user &&  $user->status == 5)
				                  <span class="badge bg-label-warning">Unverrified</span>
				                  @else
				                      <span></span>
				                 @endif
							</li>
							<li class="mb-2 pt-1">
								<span class="fw-medium me-1">Contact:</span>
								<span>	@if($user && $user->phone_number)  {{$user->phone_number}} @endif</span>
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
								<span>@if($ClientDetail && $ClientDetail->address_2){{$user->status }}@endif</span>
							</li>
							<li class="mb-2 pt-1">
								<span class="fw-medium me-1">Verified Document:</span>
								<span><a class="card-link" target="_blank"
									href="@if($ClientDetail && $ClientDetail->doc_verify){{$ClientDetail->doc_verify}}@endif">Download</a></span>
								</li>
							</ul>
						
							<div class="d-flex justify-content-center">
								<a href="{{url('Employee/Client/edit/'.$id)}}"
								class="btn btn-primary me-3 waves-effect waves-light">Edit</a>
							
							</div>
						</div>
					</div>
				</div>  
    			<div class=" card col-md-12 mt-4 p-3">
	                <h4>Account Manager</h4>
	                <p>Name : @if($accountManager){{$accountManager->first_name}} {{$accountManager->last_name}}@endif</p>
	                <p>Contant No. : @if($accountManager){{$accountManager->phone_number}}@endif</p>
	                <p>Role : @if($accountRole) {{$accountRole}}@endif</p>
	                
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
														<span id="">@if($ClientDetail && $ClientDetail->over_due_invoice){{$ClientDetail->over_due_invoice}} @else 0 @endif</span>
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
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="card bg-white border-0 b-shadow-4">
                            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                                <h4 class="f-18 f-w-500 mb-0">Projects</h4>
                            </div>
                            <div class="card-body pt-2">
                                <div class="m-auto" style="height: 100%; width: 100%">
                                    <canvas id="project-chart" height="300" width="300" style="display: block; box-sizing: border-box;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-white border-0 b-shadow-4">
                            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                                <h4 class="f-18 f-w-500 mb-0">Invoices</h4>
                            </div>
                            <div class="card-body pt-2">
                                <div class="m-auto" style="height: 100%; width: 100%">
                                    <canvas id="invoice-chart" height="300" width="300" style="display: block; box-sizing: border-box;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        var paidInvoicesCount = {{ $paidInvoicesCount }};
                        var unpaidInvoicesCount = {{ $unpaidInvoicesCount }};
                        // Projects Chart
                        var projectCtx = document.getElementById("project-chart").getContext('2d');
                        var projectChart = new Chart(projectCtx, {
                            type: 'pie',
                            data: {
                                labels: ["In Progress", "Not Started", "On Hold", "Canceled", "Finished"],
                                datasets: [{
                                    data: [1, 0, 0, 0, 0], // Example data, replace with your dynamic data
                                    backgroundColor: ["#00B5FF", "#616E80", "#F5C308", "#D21010", "#679C0D"],
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
                                    }
                                }
                            }
                        });
                        // Invoices Chart
                        var invoiceCtx = document.getElementById("invoice-chart").getContext("2d");
                        var invoiceChart = new Chart(invoiceCtx, {
                            type: 'pie',
                            data: {
                                labels: ["Paid", "Unpaid"],
                                datasets: [{
                                    data: [paidInvoicesCount, unpaidInvoicesCount],
                                    backgroundColor: ["#00B5FF", "#D21010"],
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: { position: 'right' },
                                title: { display: false, text: 'Invoices' },
                            }
                        });
                    }); // Close DOMContentLoaded event listener
                </script>
					<!--<div class="col-12 mt-4">-->
						<!-- Change Password -->
					<!--	<div class="card mb-4">-->
					<!--		<h5 class="card-header">Change Password</h5>-->
					<!--		<div class="card-body">-->
				 <!--               <form class="formChangePassword2" id="formChangePassword2" method="POST" action="{{ url('Employee/Client/changePassword/'.$id) }}">-->
     <!--                               @csrf-->
     <!--                               <div class="alert alert-warning" role="alert">-->
     <!--                                   <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>-->
     <!--                                   <span>Minimum 8 characters long, uppercase & symbol</span>-->
     <!--                                   <span class="show_error text-danger"></span>-->
     <!--                               </div>-->
     <!--                               <div class="alert alert-danger">-->
     <!--                                   <ul>-->
     <!--                                       @foreach ($errors->all() as $error)-->
     <!--                                           <li>{{ $error }}</li>-->
     <!--                                       @endforeach-->
     <!--                                   </ul>-->
     <!--                               </div>-->
     <!--                               <br>-->
     <!--                               <span class="alert alert-warning show_err" style="display: none;" role="alert"></span>-->
     <!--                               <span class="alert alert-success show_succ" style="display: none;" role="alert"></span>-->
     <!--                               <br>-->
                
     <!--                               <div class="row mt-3">-->
     <!--                                   <div class="mb-3 col-12 col-sm-6 form-password-toggle">-->
     <!--                                       <label class="form-label" for="newPassword">New Password</label>-->
     <!--                                       <div class="input-group input-group-merge">-->
     <!--                                           <input-->
     <!--                                           class="form-control"-->
     <!--                                           type="password"-->
     <!--                                           id="newPassword"-->
     <!--                                           name="newPassword"-->
     <!--                                           required-->
     <!--                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />-->
     <!--                                           <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>-->
     <!--                                       </div>-->
                                
     <!--                                   </div>-->
                                
                                
     <!--                                   <div class="mb-3 col-12 col-sm-6 form-password-toggle">-->
     <!--                                       <label class="form-label" for="confirmPassword">Confirm New Password</label>-->
     <!--                                       <div class="input-group input-group-merge">-->
     <!--                                           <input-->
     <!--                                           class="form-control"-->
     <!--                                           type="password"-->
     <!--                                           name="confirmPassword"-->
     <!--                                           id="confirmPassword"-->
     <!--                                           required-->
     <!--                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />-->
     <!--                                           <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>-->
     <!--                                       </div>-->
     <!--                                   </div>-->
     <!--                                   <div>-->
     <!--                                       <button type="button" id="pass_btn" class="btn btn-primary">Change Password</button>-->
     <!--                                   </div>-->
     <!--                               </div>-->
     <!--                           </form>-->
					<!--		</div>-->
					<!--	</div>-->
						<!--/ Change Password -->
					<!--</div>-->
				</div>
			</div>
			<!--/ User Content -->
		    </div>
		    
		    
		</div>
		<div class="screenTeamMember" style="display:none;">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
					<div class="card mb-4">
					    <div class="card-header d-flex justify-content-between">
					        <h5 >Team Member</h5>
					        <!--<a href="#" data-bs-target="#add-member" data-bs-toggle="modal" class="btn btn-primary">Add Member</a>-->
					    </div>
						
						<div class="card-body">
						    <div class="table-responsive">
								<table class="table border-top">
									<thead>
										<tr>
											<th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
											<th>ID</th>
											<th>Name</th>
											<th>Phone</th>
											<th>Email</th>
											<th>Address</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
        						        @foreach($teamMembers as $team)
        							        <tr >
        							            <td class="text-truncate">{{$team->id}}</td>
												<td class="text-truncate">{{$team->first_name}} {{$team->last_name}}</td>
												<td class="text-truncate">{{$team->phone}}</td>
												<td class="text-truncate">{{$team->email}}</td>
												<td class="text-truncate">{{$team->address_1}}</td>
												<td class="text-truncate ">
												    <a href="javascript:void(0)" data-id="{{$team->id}}" id="editTeam"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
												    <a href="javascript:void(0)" class="delete_debtcase" url="{{url('Employee/Client/deleteTeam/'.$team->id)}}" ><i class="fa fa-trash"></i></a>
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
		<div class="transactionsscreen" style="display:none;">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
					<div class="card mb-4">
						<h5 class="card-header">Transaction</h5>
						<div class="card-body">
						    <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                                <thead>
                                  <tr>
                                    <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                    <!-- <th scope="col">Client Name</th> -->
                                    <th scope="col">Date</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount In</th>
                                    <th scope="col">Fees</th>
                                    <th scope="col">Amount Out</th>
                                    <!-- <th scope="col">Action</th> -->
                                  </tr>
                                </thead>
                                <tbody>
                                @if(count($invoices) > 0)
                                    @foreach($invoices as $key => $Inventor)
                                    <tr class="odd">
                                        <td>@if($Inventor && $Inventor->created_at) {{ date('Y-m-d',strtotime($Inventor->created_at)) }} @endif</td>
                                        <td>
                                           Online
                                        </td>
                                        <td>Invoice Payment @if($Inventor && $Inventor->invoice_number2) 
                                                (#{{ $Inventor->invoice_number2 }})
                                                @endif
                                            <br>
                                            Trans.Id {{isset($Inventor) ? $Inventor->razorpay_payment_id : ''}}
                                            </td>
                                        <td>{{ $Inventor->prefix}} {{number_format(floatVal($Inventor->final_total_amt ?? 0),2) }}</td>
                                        <td>{{ $Inventor->prefix}} 0:00/- </td>
                                        <td>{{ $Inventor->prefix}} 0:00/- </td>
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
	
		<div class="Quotesscreen" style="display:none;">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
					<div class="card mb-4">
						<div class="card-header d-flex justify-content-between">
						    <h5>Recent Quotes</h5>
						    <a href="{{url('Employee/Quotes/add')}}" class="btn btn-primary">Create Quote</a>
						</div>

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
										@php $client =  \App\Models\User::select('first_name','profile_img','email')->where('id',$Tick->ccid)->first() @endphp
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
															<img @if($client && $client->profile_img) src="{{$client->profile_img}}" @else src="{{url('public/logo/google.jpg')}}"	 @endif alt="Avatar" class="rounded-circle">
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
					    <div class="card-header d-flex justify-content-between">
					        <h5>Recent Invoices</h5>
					        <h6>
					            <span class="text-success">
					            Paid : {{$currency->prefix}} {{number_format($amounts->total_paid,2)}}, 
					            </span>&nbsp;&nbsp;
					            <span class="text-danger">
					            Unpaid : {{$currency->prefix}} {{number_format($amounts->total_unpaid,2)}}, 
					            </span>&nbsp;&nbsp;
					            <span class="text-warning">
					            Due : {{$currency->prefix}} {{number_format($amounts->total_due,2)}}
					            </span>
					       </h6>
						    <a class="btn btn-primary" href="{{url('Employee/Invoices/add')}}" class="card-header">Create Invoice</a>
					    </div>
						<div class="card-body">
						    
							<div class="table-responsive">
								<table class="table border-top">
									<tr>
                                        <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                        <th>Customer Name</th>
                                        <th>Invoice ID</th>
                                        <th class="text-truncate">Invoice Date</th>
                                        <th>Due Date</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                      </tr>
                                    </thead>
									<tbody>
										@if(count($Invoice) > 0)
    										@foreach($Invoice as $key => $Inventor)
                                            <tr class="odd">
                                                <td>
                                                    @if($Inventor->profile_img)
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$Inventor->profile_img}}" height="30" width="30" alt="User avatar" />
                                                    @else
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                    @endif
                                                    {{$Inventor->first_name }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('Employee/Invoices/view/'.$Inventor->id) }}">
                                                        @if($Inventor && $Inventor->invoice_number2) 
                                                            {{ $Inventor->invoice_number2 }} 
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($Inventor && $Inventor->issue_date) 
                                                        {{ $Inventor->issue_date }} 
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($Inventor && $Inventor->due_date) 
                                                        {{ $Inventor->due_date }} 
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        if(floatVal($Inventor->final_total_amt) != $Inventor->paid_amount){
                                                            $final_amt = floatVal($Inventor->final_total_amt) - $Inventor->paid_amount;
                                                        }else{
                                                            $final_amt = floatVal($Inventor->final_total_amt) -0;
                                                        }
                                                    @endphp
                                                    @if($Inventor && $Inventor->is_payment_recieved == 1)
                                                        {{ isset($Inventor) ? $Inventor->prefix . number_format($final_amt, 2) : '' }}
                                                    @else
                                                        00.00
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        if(floatVal($Inventor->final_total_amt) != $Inventor->paid_amount){
                                                            $final_amt = floatVal($Inventor->final_total_amt) - $Inventor->paid_amount;
                                                        }else{
                                                            $final_amt = isset($Inventor) ? floatVal($Inventor->final_total_amt) - $Inventor->paid_amount : 0;
                                                        }
                                                    @endphp
                                                    @if($Inventor && $Inventor->is_payment_recieved == 0)
                                                        {{ isset($Inventor) ? $Inventor->prefix . number_format($final_amt, 2) : '' }}
                                                    @else
                                                        00.00
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        if (isset($Inventor)) {
                                                            $final_total_amt = floatval($Inventor->final_total_amt);
                                                            $paid_amount = floatval($Inventor->paid_amount);
                                                            $tds_percent = floatval($Inventor->tds_percent);
                                                            if ($final_total_amt == $paid_amount) {
                                                                $final_amt = $final_total_amt - (($tds_percent / 100) * $final_total_amt);
                                                            } else {
                                                                $final_amt = $final_total_amt - $paid_amount;
                                                            }
                                                        }else{
                                                            $final_amt = floatval($Inventor->final_total_amt) ?? 0.00;
                                                        }
                                                    @endphp
                                                    {{ isset($Inventor) ? $Inventor->prefix . number_format($final_amt, 2) : '' }}
                                                </td>
                                                <td>
                                                    @if($Inventor && ($Inventor->is_payment_recieved == 1 || $Inventor->is_payment_recieved == 2))
                                                        <span class="btn btn-success btn-sm">Paid</span>
                                                    @elseif($Inventor && $Inventor->paid_amount > 0 && $Inventor->paid_amount != $Inventor->final_total_amt)
                                                        <span class="btn btn-warning btn-sm">Partially Paid</span>
                                                    @else
                                                        <span class="btn btn-danger btn-sm">Unpaid</span>
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
		<div class="Servicescreen" style="display:none;">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
						<div class="card mb-4 mt-4">
							<h5 class="card-header pb-1">Total services</h5>
							<div class="card-body">
								<table class="dt-route-vehicles table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1214px;">
                                    <thead class="border-top">
                                        <tr>
                                            <th ></th>
                                            <th >Service Name</th>
                                            <th >Total Amount</th>
                                            <th >Renewal Date</th>
                                            <th >Status</th>
                                            <th >Days left</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($product_data)
                                            @foreach($product_data as $service)
                                                @if($service)
                                                    @php
                                                        $currentDate = new DateTime();
                                                        $nextDueDate = new DateTime($service->next_due_date);
                                                        $interval = $currentDate->diff($nextDueDate);
                                                        $totalDays = $interval->days;
                                                        if($service->status == 1){
                                                            $status = 'Active';
                                                            $class = 'bg-success';
                                                        } elseif($service->status == 2){
                                                            $status = 'Suspended';
                                                            $class = 'bg-danger';
                                                        } elseif($service->status == 4){
                                                            $status = 'Pending';
                                                            $class = 'bg-info';
                                                        }
                                                    @endphp
                                                    @php 
                                                        $Invoice = \App\Models\Invoice::where('id',$service->invoice_id)->first();
                                                    @endphp
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $service->product_name }}</td>
                                                        <td>{{ $Invoice->final_total_amt }}</td>
                                                        <td>{{ $service->next_due_date }}</td>
                                                        <td><span class="badge rounded {{ $class }}">{{ $status }}</span></td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="progress w-100" style="height: 8px;">
                                                                    <div class="progress-bar" role="progressbar" style="width: {{ $totalDays }}%;" aria-valuenow="{{ $totalDays }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <div class="text-body ms-3">{{ $totalDays }}</div>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">No Record Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
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
													<span class="fw-medium">@if($LastloginLogActivity) {{ $LastloginLogActivity->browser }} @endif</span>
												</td>																    
												<td class="text-truncate">@if($LastloginLogActivity) {{ $LastloginLogActivity->ip }} @endif</td>
												<td class="text-truncate">@if($LastloginLogActivity) {{ $LastloginLogActivity->created_at->format('d, F Y H:i') }} @endif</td>
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
		<div class="CreditsScreen" style="display:none;">
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
		<div class="BillingScreen" style="display:none;">
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 1 ">
					<div class="card mb-4">
						<div class="card-header d-flex justify-content-between">
						    <h5>Two Factor Authentication</h5>
						</div>
						<div class="card-body">
							    <h6>@if($user && $user->google2fa_enabled){{ $user->google2fa_enabled ? $user->first_name.' has enabled' : $user->first_name.' has not enabled' }} @endif two-factor authentication.</h6>
                                <p>When two-factor authentication is enabled, the user will be prompted for a secure, random token during authentication. This token can be retrieved from their phone's Google Authenticator application.</p>
    
                               @if($user && $user->google2fa_enabled)
                                    <a href="{{url('Employee/Client/2fa/disable?id='.$user->id)}}" >
                                        <button class="btn btn-danger">Disable</button>
                                    </a>
                                @endif
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 ">
					<div class="card mb-4">
						<div class="card-header pb-0 d-flex justify-content-between">
						    <h5>Change Password</h5>
						</div>
						<div class="card-body">
						    <form class="formChangePassword2" id="formChangePassword2" method="POST" action="{{ url('Employee/Client/changePassword/'.$id) }}">
                                @csrf
                                <div class="alert alert-warning" role="alert">
                                    <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
                                    <span>Minimum 8 characters long, uppercase & symbol</span>
                                    <span class="show_error text-danger"></span>
                                </div>
                                <!--@if(isset($errors))-->
                                <!--<div class="alert alert-danger">-->
                                <!--    <ul>-->
                                <!--        @foreach ($errors->all() as $error)-->
                                <!--            <li>{{ $error }}</li>-->
                                <!--        @endforeach-->
                                <!--    </ul>-->
                                <!--</div>-->
                                <!--@endif-->
                                <div class="alert alert-warning show_err" style="display: none;" role="alert"></div>
                                <div class="alert alert-success show_succ" style="display: none;" role="alert"></div>
                                
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
                                        <button type="button" id="pass_btn" class="btn btn-primary">Change Password</button>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
				<!--<div class="col-xl-12 col-lg-12 col-md-12 ">-->
				<!--	<div class="card mb-4">-->
				<!--		<div class="card-header pb-0 d-flex justify-content-between">-->
				<!--		    <h5>Change Password</h5>-->
				<!--		</div>-->
				<!--		<div class="card-body">-->
				<!--		    <form class="formChangePassword2" id="formChangePassword2" method="POST" action="{{ url('Employee/Client/changePassword/'.$id) }}">-->
    <!--                            @csrf-->
    <!--                            <div class="alert alert-warning" role="alert">-->
    <!--                                <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>-->
    <!--                                <span>Minimum 8 characters long, uppercase & symbol</span>-->
    <!--                                <span class="show_error text-danger"></span>-->
    <!--                            </div>-->
                                <!--@if(isset($errors))-->
                                <!--<div class="alert alert-danger">-->
                                <!--    <ul>-->
                                <!--        @foreach ($errors->all() as $error)-->
                                <!--            <li>{{ $error }}</li>-->
                                <!--        @endforeach-->
                                <!--    </ul>-->
                                <!--</div>-->
                                <!--@endif-->
    <!--                            <div class="alert alert-warning show_err" style="display: none;" role="alert"></div>-->
    <!--                            <div class="alert alert-success show_succ" style="display: none;" role="alert"></div>-->
                                
    <!--                            <div class="row mt-3">-->
    <!--                                <div class="mb-3 col-12 col-sm-6 form-password-toggle">-->
    <!--                                    <label class="form-label" for="newPassword">New Password</label>-->
    <!--                                    <div class="input-group input-group-merge">-->
    <!--                                        <input-->
    <!--                                        class="form-control"-->
    <!--                                        type="password"-->
    <!--                                        id="newPassword"-->
    <!--                                        name="newPassword"-->
    <!--                                        required-->
    <!--                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />-->
    <!--                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>-->
    <!--                                    </div>-->
                            
    <!--                                </div>-->
                            
                            
    <!--                                <div class="mb-3 col-12 col-sm-6 form-password-toggle">-->
    <!--                                    <label class="form-label" for="confirmPassword">Confirm New Password</label>-->
    <!--                                    <div class="input-group input-group-merge">-->
    <!--                                        <input-->
    <!--                                        class="form-control"-->
    <!--                                        type="password"-->
    <!--                                        name="confirmPassword"-->
    <!--                                        id="confirmPassword"-->
    <!--                                        required-->
    <!--                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />-->
    <!--                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <div>-->
    <!--                                    <button type="button" id="pass_btn" class="btn btn-primary">Change Password</button>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </form>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
			</div>
		</div>
	</div>
<div class="modal fade" id="add-member" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <form action="{{url('Employee/Client/storeTeam')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="pb-3 pt-3">Add Team Member</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body" id="editForm">
                    <div class="row">
                        <div class="col-6">
                            <label>First Name*</label>
                            <input type="text" name="first_name" class="form-control" required />
                            <input type="hidden" name="team_id" value="{{$id}}" class="form-control" required />
                        </div>
                        <div class="col-6">
                            <label>Last Name*</label>
                            <input type="text" name="last_name" class="form-control" required />
                        </div>
                        <div class="col-6 mt-3">
                            <label>Phone*</label>
                            <input type="number" name="phone" class="form-control" required />
                        </div>
                        <div class="col-6 mt-3">
                            <label>Email*</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>
                        <div class="col-6 mt-3">
                            <label>Address Line-1</label>
                            <textarea name="address_1" class="form-control"></textarea>
                        </div>
                        <div class="col-6 mt-3">
                            <label>Address Line-2</label>
                            <textarea name="address_2" class="form-control"></textarea>
                        </div>
                        <div class="col-6 mt-3">
                            <label>Pin Code*</label>
                            <input type="number" name="pincode" class="form-control" required />
                        </div>
                        <div class="col-6 mt-3">
                            <label>Country*</label>
                            <select name="country_id" class="form-control select2" required>
                                <option>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!---- credit modal ----->
<div class="modal fade" id="add-credits" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <form action="{{url('Employee/Client/Credits/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="pb-2 pt-2">Add Credits</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body" id="editForm">
                    <div class="row">
                        <div class="col-12">
                            <label>Amount*</label>
                            <input type="text" name="amount" class="form-control" placeholder="500" required />
                            <input type="hidden" name="client_id" value="{{$id}}" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!---- credit modal ----->

<!--edit team modal-->

<div class="modal fade" id="edit-member" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <form action="{{url('Employee/Client/updateTeam')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="pb-3 pt-3">Edit Team Member</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body" id="editForm">
                    <div class="row">
                        <div class="col-6">
                            <label>First Name*</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required />
                            <input type="hidden" name="id" id="id" class="form-control" required />
                        </div>
                        <div class="col-6">
                            <label>Last Name*</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required />
                        </div>
                        <div class="col-6 mt-3">
                            <label>Phone*</label>
                            <input type="number" name="phone" id="phone" class="form-control" required />
                        </div>
                        <div class="col-6 mt-3">
                            <label>Email*</label>
                            <input type="email" name="email" id="email" class="form-control" required />
                        </div>
                        <div class="col-6 mt-3">
                            <label>Address Line-1</label>
                            <textarea name="address_1" id="address_1" class="form-control"></textarea>
                        </div>
                        <div class="col-6 mt-3">
                            <label>Address Line-2</label>
                            <textarea name="address_2" id="address_2" class="form-control"></textarea>
                        </div>
                        <div class="col-6 mt-3">
                            <label>Pin Code*</label>
                            <input type="number" name="pincode" id="pincode" class="form-control" required />
                        </div>
                        <div class="col-6 mt-3">
                            <label>Country*</label>
                            <select name="country_id" id="country_id" class="form-control select2" required>
                                <option>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    function checkPasswordMatch() {
        var newPassword = $("#newPassword").val();
        var confirmPassword = $("#confirmPassword").val();
        var errorSpan = $(".show_err"); // Select the error span
        var SucSpan = $(".show_succ"); // Select the success span
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
    }

    $(document).ready(function() {
        $("#ProfileButton").click(function() {
            $(this).addClass("active");
            $("#TwoFactorAuth, #team, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss, #CreditsButton, #BillingButton").removeClass("active");
            $('.screenProfile').show(500);
            $('.CreditsScreen, .Quotesscreen, .BillingScreen, .screenTeamMember, .Ticketscreen, .Invoicescreen, .Teamscreen, .Logscreen, .Servicescreen, .transactionsscreen').hide(500);
            window.location.reload();
        });

        $("#team").click(function() {
            $(this).addClass("active");
            $('.screenTeamMember').show(500);
            $("#ProfileButton, #TwoFactorAuth, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss, #CreditsButton,#BillingButton").removeClass("active");
            $('.screenProfile, .Quotesscreen, .BillingScreen, .Ticketscreen, .Invoicescreen, .Teamscreen, .Logscreen, .Servicescreen, .CreditsScreen, .transactionsscreen').hide(500);
        });

        $("#TwoFactorAuth").click(function() {
            $(this).addClass("active");
            $("#ProfileButton, #team, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss, #CreditsButton, #BillingButton").removeClass("active");
            $('.Teamscreen').show(500);
            $('.screenProfile, .Quotesscreen, .BillingScreen, .Ticketscreen, .screenTeamMember, .Invoicescreen, .Logscreen, .Servicescreen, .CreditsScreen, .transactionsscreen').hide(500);
        });

        $("#QuotesButton").click(function() {
            $(this).addClass("active");
            $("#TwoFactorAuth, #ProfileButton, #team, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss, #CreditsButton, #BillingButton").removeClass("active");
            $('.Quotesscreen').show(500);
            $('.Teamscreen, .screenProfile, .BillingScreen, .Ticketscreen, .screenTeamMember, .Invoicescreen, .Logscreen, .Servicescreen, .CreditsScreen, .transactionsscreen').hide(500);
        });

        $("#InvButton").click(function() {
            $(this).addClass("active");
            $("#QuotesButton, #TwoFactorAuth, #team, #ProfileButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss, #CreditsButton, #BillingButton").removeClass("active");
            $('.Invoicescreen').show(500);
            $('.Quotesscreen, .Teamscreen, .BillingScreen, .screenProfile, .screenTeamMember, .Ticketscreen, .Logscreen, .Servicescreen, .CreditsScreen, .transactionsscreen').hide(500);
        });

        $("#ServiceButton").click(function() {
            $(this).addClass("active");
            $("#ProfileButton, #billingButton, #team, #TwoFactorAuth, #QuotesButton, #InvButton, #ticketButton, #transactionsButton, #LogActivityss, #CreditsButton, #BillingButton").removeClass("active");
            $('.Servicescreen').show(500);
            $('.Invoicescreen, .Quotesscreen, .BillingScreen, .Teamscreen, .screenTeamMember, .screenProfile, .Ticketscreen, .Logscreen, .CreditsScreen, .transactionsscreen').hide(500);
        });

        $("#ticketButton").click(function() {
            $(this).addClass("active");
            $("#ProfileButton, #InvButton, #team, #ServiceButton, #transactionsButton, #LogActivityss, #CreditsButton, #BillingButton").removeClass("active");
            $('.Ticketscreen').show(500);
            $('.Servicescreen, .Invoicescreen, .BillingScreen, .Quotesscreen, .screenTeamMember, .Teamscreen, .screenProfile, .Logscreen, .CreditsScreen, .transactionsscreen').hide(500);
        });

        $("#transactionsButton").click(function() {
            $(this).addClass("active");
            $("#ProfileButton, #billingButton, #team, #TwoFactorAuth, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #LogActivityss, #CreditsButton, #BillingButton").removeClass("active");
            $('.transactionsscreen').show(500);
            $('.Servicescreen, .Invoicescreen, .BillingScreen, .Quotesscreen, .screenTeamMember, .Teamscreen, .screenProfile, .Logscreen, .CreditsScreen, .Ticketscreen').hide(500);
        });

        $("#LogActivityss").click(function() {
            $(this).addClass("active");
            $("#ProfileButton, #billingButton, #team, #TwoFactorAuth, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #CreditsButton, #BillingButton").removeClass("active");
            $('.Logscreen').show(500);
            $('.screenProfile, .Quotesscreen, .BillingScreen, .Ticketscreen, .screenTeamMember, .Invoicescreen, .Teamscreen, .Servicescreen, .CreditsScreen,.transactionsscreen').hide(500);
        });

        $("#CreditsButton").click(function() {
            $(this).addClass("active");
            $("#ProfileButton, #TwoFactorAuth, #team, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss, #BillingButton").removeClass("active");
            $('.CreditsScreen').show(500);
            $('.screenProfile, .Quotesscreen, .BillingScreen, .screenTeamMember, .Ticketscreen, .Invoicescreen, .Teamscreen, .Logscreen, .Servicescreen').hide(500);
        });
        
        $("#BillingButton").click(function() {
            $(this).addClass("active");
            $("#ProfileButton, #TwoFactorAuth, #CreditsButton, #team, #QuotesButton, #InvButton, #ServiceButton, #ticketButton, #transactionsButton, #LogActivityss").removeClass("active");
            $('.BillingScreen').show(500);
            $('.screenProfile, .Quotesscreen, .CreditsScreen, .screenTeamMember, .Ticketscreen, .Invoicescreen, .Teamscreen, .Logscreen, .Servicescreen').hide(500);
        });

        $("#newPassword, #confirmPassword").keyup(checkPasswordMatch);
    });
    
    
    $('#editTeam').click(function(){
        var id = $(this).data('id');
    
        // Set up CSRF token in the headers
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url: "{{url('Employee/Client/editTeam')}}/"+id,
            type: 'GET', // or 'POST' depending on your server-side implementation
            success: function(response) {
                // Assuming response is a JSON object containing data
                $('#first_name').val(response.first_name);
                $('#last_name').val(response.last_name);
                $('#phone').val(response.phone);
                $('#email').val(response.email);
                $('#pincode').val(response.pincode);
                $('#address_1').val(response.address_1);
                $('#address_2').val(response.address_2);
                $('#country_id').val(response.country_id).change();
                $('#id').val(response.id);
                $('#edit-member').modal('show');
            },
            error: function(xhr, status, error) {
                // Handle errors
            }
        });
    });
    
    $(document).ready(function () {
        $(".delete_debtcase").click(function (e) {
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure? you want to delete this team member.",
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
    
    
    $(document).ready(function() {
        $("#pass_btn").click(function() {
            if (validatePassword()) {
                // If validation passes, submit the form
                $("#formChangePassword2").submit();
            }
        });
    });
    
        function validatePassword() {
            var password = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();
    
            // Check if passwords match
            if (password !== confirmPassword) {
                $(".show_error").text("Passwords do not match.");
                return false;
            }
    
            // Check if password meets criteria (8 characters, at least one uppercase, one lowercase, one number, and one special character)
            var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+])(?=.*[^\w\d\s]).{8,}$/;
            if (!regex.test(password)) {
                $(".show_error").text("Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.");
                return false;
            }
    
            // Password is valid
            $(".show_error").text(""); // Clear any previous error messages
            return true;
        }

</script>


@endsection