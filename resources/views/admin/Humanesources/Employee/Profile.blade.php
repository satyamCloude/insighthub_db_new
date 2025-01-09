<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-6">
    <a class="text-dark" href="#">
      <div class="card">
        <div class="card-body">
          <div class="row">
          <div class="col-sm-3">
               <img class="img-fluid" @if($Profile->profile_img) src="{{$Profile->profile_img}}" @else src="{{url('public/images/default_profile.jpg')}}" @endif width="115" alt="Avatar" style="width: 135px;">
          </div>
          <div class="col-sm-9" style="margin-top: 13px;">
                <h3 style="color: #000; font-size: 24px; line-height: 7px">{{$Profile->first_name}} {{$Profile->last_name}}</h3>
                <p style=" margin-top: 0px; line-height: 7px">{{$Profile->name}}</p>
                <p style="font-size: 14px; margin-top: 0px; line-height: 7px">Last login at -- {{$lastPunchTime}}</p>
                <p style="font-size: 14px; margin-top: 0px; line-height: 7px">Role : {{$role}}</p>
          </div>
        </div>
      </div>
    </a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-white border-0 b-shadow-4 mb-4 h-100">
       <div class="card-body ">
          <div class="justify-content-between">
              <p class="f-14 text-dark-grey" style="color:#000">Reporting To :</p>
               @if($ReportingTo) {{ucfirst($ReportingTo->first_name)}} @else -- @endif
          </div> 
       </div>
    </div>
  </div>

    <div class="col-md-3">
    <div class="card bg-white border-0 b-shadow-4 mb-4 h-100">
       <div class="card-body ">
          <div class=" justify-content-between">
              <p class="f-14 text-dark-grey" style="color:#000">Department Name : </p>
              @if($ReportingTeam){{ucfirst($ReportingTeam->name)}} @else -- @endif
          </div>
       </div>
    </div>
  </div>
  <!-- <div class="col-md-6">
    <div class="card bg-white border-0 b-shadow-4">
       <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
          <h4 class="f-18 f-w-500 mb-0" style="color:#000">KRA</h4>
       </div>
       <div class="card-body pt-2 ">
          <div style="color: #000;">{!!$Profile->kra!!}</div>
       </div>
    </div>
  </div>   -->
  <div class="col-md-6">
      <div class="card bg-white border-0 b-shadow-4">
       <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
          <h4 class="f-18 f-w-500 mb-0" style="color:#000">Profile Info</h4>
       </div>
       <div class="card-body pt-2">
       <div class="row">
        <div class="col-sm-4">
          <h5 class="text-dark small">Employee ID</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-">{{$Profile->id}}</h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Full Name</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-">{{$Profile->first_name}} {{$Profile->last_name}}</h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Designation</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-">{{$Profile->desg}}</h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Department</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-">{{$Profile->department_name}}</h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Gender</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-">@if($Profile->gender == 1) Male @else Female @endif</h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Marriage Anniversary</h5>
        </div>
        <div class="col-sm-8">
            @php
            // Check if $Profile->dob is a date string
            $dobTimestamp = strtotime($Profile->marriage_anniversary);
        @endphp
        
        <h6 class="ms-">{{ date('d-m-Y', $dobTimestamp) }}</h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Date of Birth</h5>
        </div>
        <div class="col-sm-8">
@php
    // Check if $Profile->dob is a date string
    $dobTimestamp = strtotime($Profile->dob);
@endphp

<h6 class="ms-">{{ date('d-m-Y', $dobTimestamp) }}</h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Email</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-">{{$Profile->email}}</h6>
        </div>
        <div class="col-sm-4">
          <h5 class="text-dark small">Mobile</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-">{{$Profile->phone_number}}</h6>
        </div>  
        <div class="col-sm-4">
          <h5 class="text-dark small">Address</h5>
        </div>
        <div class="col-sm-8">
          <h6 class="ms-">{{$Profile->address}}</h6>
        </div>
       </div>
        
       </div>
      </div>
    </div> 

  <div class="col-md-3">
      <div class="card bg-white border-0 b-shadow-4 mb-4">
        <div class="card-header">
          <h6>Late Attendance &nbsp;<i class="fa-solid fa-question"></i></h6>
        </div>
         <div class="card-body ">
           {{$totalLateDays}}
         </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-white border-0 b-shadow-4 mb-4">
        <div class="card-header">
          <h6>Leaves Taken &nbsp;<i class="fa-solid fa-question"></i></h6>
        </div>
         <div class="card-body ">
           {{$totalLeaveTaken}}
         </div>
      </div>
    </div>
     
     
   <!-- <div class="col-md-6">
    
    <div class="card bg-white border-0 b-shadow-4">
       <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
          <h4 class="f-18 f-w-500 mb-0" style="color:#000">Tasks</h4>
       </div>
       <div class="card-body pt-2 ">
         <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                   <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Assign to</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                      <tbody class="table-border-bottom-0">
                  @foreach($RTTask as $key => $lst)
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td>@if($lst && $lst->task_name) {{ $lst->task_name }} @endif</td>
                          <td>@if($lst && $lst->AssignedTo) {{Auth::user()->first_name}} @endif</td>
                          <td>@if($lst && $lst->status_id == 1) <span class="badge bg-label-primary me-1"> progress </span> @elseif($lst && $lst->status_id == 2)  <span class="badge bg-label-danger me-1"> Overdue </span>@endif</td>
                      </tr>
                  @endforeach
              </tbody>

                  </table>
              </div>
       </div>
    </div>
    <div class="row">
      <div class="col-md-12 my-4">
        <div class="card bg-white border-0 b-shadow-4">
       <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
          <h4 class="f-18 f-w-500 mb-0" style="color:#000">Tickets</h4>
       </div>
       <div style="text-align: center;" class="card-body pt-2 ">
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
                  @foreach($RTTicket as $key => $lst)
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td>@if($lst && $lst->subject) {{ $lst->subject }} @endif</td>
                          <td>@if($lst && $lst->ccid) {{Auth::user()->first_name}} @endif</td>
                          <td>@if($lst && $lst->status == 1)<span class="badge bg-label-primary me-1"> progress </span>@else if($lst && $lst->status == 1)  <span class="badge bg-label-danger me-1"> Overdue </span>@endif</td>
                      </tr>
                  @endforeach
              </tbody>

                  </table>
              </div>
       </div>
    </div>
        
      </div>
    </div>
  </div> -->

  