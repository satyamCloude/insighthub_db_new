@extends('layouts.admin')
@section('title', 'Leads')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
   <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leads / </span>View</h4>
   <div class="row">
                <!-- User Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                  <!-- User Card -->
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                          <div class="user-info text-center">
                            <h4 class="mb-2">@if($user && $user->company_name){{$user->company_name}} @endif</h4>
                            <!-- <span class="badge bg-label-secondary mt-1">{{$user->type}}</span> -->
                          </div>
                        </div>
                      </div>
                      <p class="mt-4 small text-uppercase text-muted">Details</p>
                      <div class="info-container">
                        <ul class="list-unstyled">
                          <li class="mb-2">
                            <span class="fw-medium me-1">Full name:</span>
                            <span>@if($user && $user->gender) {{$user->gender}} @endif . @if($user && $user->first_name){{$user->first_name}} @endif  @if($user && $user->last_name){{$user->last_name}} @endif</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Email:</span>
                            <span>@if($user && $user->email){{$user->email}} @endif</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Action Schedule:</span>
                            <span>@if($user && $user->action_schedule){{$user->action_schedule}} @endif</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Date:</span>
                            <span>@if($user && $user->date){{$user->date}} @endif</span>
                          </li>
                            @php 
							                $assignedto =  \App\Models\User::select('first_name')->where('type', 'Emp')->where('id',$user->assignedto)->first();           
							                $generated_by =  \App\Models\User::select('first_name')->where('id',$user->generated_by)->first();           
							              @endphp
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Generated By:</span>
                            <span>{{$generated_by->first_name}}</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Assigned To:</span>
                            <span>{{$assignedto->first_name}}</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Status:</span>
                             @switch($user->status)
		                      @case('1')
                            <span class="badge bg-label-primary">InProgress</span>
		                          @break
		                      @case('2')
                            <span class="badge bg-label-success">Win</span>
		                          @break
		                      @case('3')
                            <span class="badge bg-label-danger">Loss</span>
		                          @break
		                      @default
		                            <span></span>
		                      @endswitch
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Contact:</span>
                            <span>@if($user && $user->phone_number){{$user->phone_number}} @endif </span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Requirement:</span>
                            <span>@if($user && $user->requirement){{$user->requirement}} @endif </span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Note:</span>
                            <span>@if($user && $user->note){{$user->note}} @endif </span>
                          </li>
                        </ul>
                        <div class="d-flex justify-content-center">
                          <a
                            href="{{url('Employee/Leads/edit/'.$user->id)}}"class="btn btn-primary me-3">Edit</a
                          >
                          <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /User Card -->

              	</div>
  	</div>
 </div>
<!-- / Content -->
@endsection

 				  