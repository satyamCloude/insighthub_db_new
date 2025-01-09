@extends('layouts.admin')

@section('title', 'Ticket')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ticket /</span> Home</h4>

  @if(Session::has('success'))

  <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>

  @endif

  <div class="row" style="justify-content: space-between;">

    <div class="col-sm-2 col-lg-2 mb-4 filter-ticket" status="1">

      <div class="card card-border-shadow-success">

        <div class="card-body">

          <div class="d-flex align-items-center mb-2 pb-1">

            <div class="avatar me-2">

              <span class="avatar-initial rounded bg-label-success"><i class="fa-solid fa-ticket"></i></span>

            </div>

            <h4 class="ms-1 mb-0">{{$Open}}</h4>

          </div>

          <p class="mb-1">Open</p>

          <p class="mb-0">

            <!-- <span class="fw-medium me-1">-8.7%</span> -->

            <!-- <small class="text-muted">than last week</small> -->

          </p>

        </div>

      </div>

    </div>

    <div class="col-sm-2 col-lg-2 mb-4 filter-ticket" status="2">

      <div class="card card-border-shadow-primary">

        <div class="card-body">

          <div class="d-flex align-items-center mb-2 pb-1">

            <div class="avatar me-2">

              <span class="avatar-initial rounded bg-label-primary"><i class="fa-solid fa-ticket"></i></span>

            </div>

            <h4 class="ms-1 mb-0">{{$InProgress}}</h4>

          </div>

          <p class="mb-1">InProgress</p>

          <p class="mb-0">

            <!-- <span class="fw-medium me-1">+18.2%</span> -->

            <!-- <small class="text-muted">than last week</small> -->

          </p>

        </div>

      </div>

    </div>

    <div class="col-sm-2 col-lg-2 mb-4 filter-ticket" status="3">

      <div class="card card-border-shadow-warning">

        <div class="card-body">

          <div class="d-flex align-items-center mb-2 pb-1">

            <div class="avatar me-2">

              <span class="avatar-initial rounded bg-label-warning"><i class="fa-solid fa-ticket"></i></span>

            </div>

            <h4 class="ms-1 mb-0">{{$OnHold}}</h4>

          </div>

          <p class="mb-1">On Hold</p>

          <p class="mb-0">

            <!-- <span class="fw-medium me-1">+4.3%</span> -->

            <!-- <small class="text-muted">than last week</small> -->

          </p>

        </div>

      </div>

    </div>

    <div class="col-sm-2 col-lg-2 mb-4 filter-ticket" status="4">

      <div class="card card-border-shadow-secondary">

        <div class="card-body">

          <div class="d-flex align-items-center mb-2 pb-1">

            <div class="avatar me-2">

              <span class="avatar-initial rounded bg-label-secondary"><i class="fa-solid fa-ticket"></i></span>

            </div>

            <h4 class="ms-1 mb-0">{{$Resolved}}</h4>

          </div>

          <p class="mb-1">Resolved</p>

          <p class="mb-0">

            <!-- <span class="fw-medium me-1">+4.3%</span> -->

            <!-- <small class="text-muted">than last week</small> -->

          </p>

        </div>

      </div>

    </div>

    <div class="col-sm-2 col-lg-2 mb-4 filter-ticket" status="5">

      <div class="card card-border-shadow-danger">

        <div class="card-body">

          <div class="d-flex align-items-center mb-2 pb-1">

            <div class="avatar me-2">

              <span class="avatar-initial rounded bg-label-danger"><i class="fa-solid fa-ticket"></i></span>

            </div>

            <h4 class="ms-1 mb-0">{{$Closed}}</h4>

          </div>

          <p class="mb-1">Unanswered</p>

          <p class="mb-0">

            <!-- <span class="fw-medium me-1">+4.3%</span> -->

            <!-- <small class="text-muted">than last week</small> -->

          </p>

        </div>

      </div>

    </div>



  </div>

  <!-- Basic Bootstrap Table -->

  <div class="card">

    <div class="row">

      <div class="col-6 ">

        <h5 class="card-header">Ticket List</h5>

        <form>

          <div class="d-flex ms-4">

            <input type="date" name="from" class="form-control" value="{{ request('from') }}">&nbsp;

            <input type="date" name="to" class="form-control" value="{{ request('to') }}">

            <button class="btn btn-sm btn-primary text-white " onclick="this.form.submit">

              <i class="fa-solid fa-search"></i>

            </button>

          </div>

        </form>



      </div>

      <div class="col-6 text-end">

        <a href="{{url('admin/Ticket/home')}}" class="btn btn-primary text-white mt-4 me-4">

          <i class="fa-solid fa-refresh"></i>

        </a>

        &nbsp;&nbsp;

        <a href="{{url('admin/Ticket/add')}}" class="btn  btn-primary text-white mt-4 me-4"><i class="fa-solid fa-plus">&nbsp;&nbsp;</i>Create Ticket</a>

      </div>

    </div>

    <div class="card-datatable table-responsive">

      <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">

        <div class="row">

          <div class="col-sm-12 col-md-6">

            <div class="dataTables_length" id="DataTables_Table_3_length"><label>

            </div>

          </div>

          <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">

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

              <tr>

                <th>#</th>

                <th>TICKET ID</th>

                <th>DEPARTMENT</th>

                <th>SUBJECT</th>

                <th>Client Name</th>

                <th>ASSIGNED TO</th>

                <th>LAST REPLY</th>

                <th>STATUS</th>

                <th>ACTION</th>

              </tr>

            </tr>

          </thead>

          <tbody>

            @if(count($Ticket) > 0)

            @foreach($Ticket as $key=>$Tick)

            @php

            $client = \App\Models\User::select('first_name','last_name','profile_img','id','company_name','email')->where('id',$Tick->ccid)->first();

            $clientUser = \App\Models\User::select('first_name','last_name','profile_img','id','company_name','email')->where('id',$Tick->client_id)->first();

            @endphp

            @php $Department = \App\Models\Department::where('id',$Tick->department_id)->first() @endphp

            <tr>

              <td>{{$key+1}}</td>

              <td>#{{$Tick->id}}</td>

              <td>@if($Department && $Department->name){{$Department->name}} @else {!!$Tick->department_id!!} @endif</td>

              <td>{{$Tick->subject}}</td>

             <!--  <td>

                @if($clientUser && $clientUser->first_name)

                {{ ucfirst($clientUser->first_name) }}

                @else

                @php

                preg_match('/<([^>]+)>/', $Tick->department_id, $matches);

                  $extractedEmail = isset($matches[1]) ? $matches[1] : null;

                  @endphp



                  {{ $extractedEmail ?? $Tick->department_id }}

                  @endif

              </td>

            -->  <td>
             @if($clientUser && $clientUser->first_name)
             <div class="parent d-flex">
              <div class="child1">
               @if($clientUser->profile_img)
               <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$clientUser->profile_img}}" height="30" width="30" alt="User avatar" />
               @else
               <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
               @endif
             </div>
             <div class="child2">
              {{ ucfirst($clientUser->first_name) }} {{$clientUser->last_name }} | (#{{$clientUser->id }}) <br> <span style="color:#6e6c76;font-size:85%">{{$clientUser->company_name }}</span>
             </div>
           </div>

           @else

           @php

           preg_match('/<([^>]+)>/', $Tick->department_id, $matches);

            $extractedEmail = isset($matches[1]) ? $matches[1] : null;

            @endphp



            {{ $extractedEmail ?? $Tick->department_id }}

            @endif
          </td>

          <td>

            @if($Tick && $Tick->ccid)

            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">

              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label=" @if($client && $client->profile_img) {{$client->first_name}} @endif" data-bs-original-title=" @if($client && $client->profile_img) {{$client->first_name}} @endif">

                @if($client && $client->profile_img)
                <img @if($client && $client->profile_img) src="{{$client->profile_img}}" @endif alt="Avatar" class="rounded-circle">
                @endif

              </li>

            </ul>

            @endif

          </td>

          <td>{{$Tick->last_reply_date}}</td>

          <td>

            <button class="btn btn-{{ 

             $Tick->status == 1 ? 'success' : 

             ($Tick->status == 2 ? 'primary' : 

             ($Tick->status == 3 ? 'warning' :

             ($Tick->status == 4 ? 'secondary' :

             ($Tick->status == 5 ? 'danger' : '')))) 

           }} btn-sm">

           {{

            $Tick->status == 1 ? 'Open' : 

            ($Tick->status == 2 ? 'In Progress' : 

            ($Tick->status == 3 ? 'On Hold' :

            ($Tick->status == 4 ? 'Resolved' :

            ($Tick->status == 5 ? 'Unanswered' : ''))))

          }}

        </button>



      </td>

      <td>

        <div class="dropdown">

          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">

            <i class="ti ti-dots-vertical"></i>

          </button>

          <div class="dropdown-menu">

            <a class="dropdown-item text-dark" href="{{url('admin/Ticket/view/'.$Tick->client_id.'?ticketId='.$Tick->id)}}"><i class="ti ti-eye me-1"></i> View</a>

            <a class="dropdown-item text-dark" href="{{url('admin/Ticket/edit/'.$Tick->id)}}"><i class="ti ti-pencil me-1"></i> Edit</a>

            <a class="dropdown-item delete_debtcase text-dark" url="{{url('admin/Ticket/delete/'.$Tick->id)}}"><i class="ti ti-trash me-1"></i> Delete</a>

          </div>

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

<div class="p-1" style="float: right;">

  {{ $Ticket->links() }}

</div>

</div>

</div>

</div>

<!--/ Basic Bootstrap Table -->

</div>

<script type="text/javascript">

  $(document).ready(function() {



    $(".delete_debtcase").click(function(e) {

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

        callback: function(result) {

          if (result) {

            window.location.href = url;

          }

        }

      });

    });

  });



  $('.filter-ticket').click(function() {

    var status = $(this).attr('status');

    // Redirect to the current page with the status query string

    window.location.href = window.location.pathname + '?status=' + status;

  });

</script>

@endsection