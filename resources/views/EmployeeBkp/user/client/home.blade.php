@extends('layouts.admin')
@section('title', 'Client')
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">User /</span> Client</h4>
   @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Session</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Totalclient}}</h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">Total Users</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-user ti-sm"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>InActive Client</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$InActive}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="ti ti-user-plus ti-sm"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Active Client</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Active}}</h3>
                            <!-- <p class="text-danger mb-0"></p> -->
                          </div>
                          <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="ti ti-user-check ti-sm"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Closed Client</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Closed}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-user-exclamation ti-sm"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
  </div>
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Client's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{url('Employee/Client/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          @if($RoleAccess[array_search('Client', array_column($RoleAccess, 'per_name'))]['add'] == 1)
          <a href="{{url('Employee/Client/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
          @endif
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
                  <label>Search: <input value="{{$query}}" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive dt-row-grouping table dataTable dtr-column" id="DataTables_Table_2" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>CLIENT NAME</th>
                <th>COMPANY</th>
                <th>Email</th>
                <th>CREATED</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
        <tr class="group">
          <td colspan="8" style="background-color:#eae8fd;">Assigned Clients</td>
        </tr>
        @if(count($MyClient) > 0)
             @foreach($MyClient as $key=> $MyClients)
        <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $MyClients->first_name }}</td>
                  <td>@if($MyClients && $MyClients->company_name) {{ $MyClients->company_name }} @endif</td>
                  <td>{{ $MyClients->email }}</td>
                  <td>{{ $MyClients->created_at->format('Y-m-d') }}</td>
                  <td>
                   @switch($MyClients->status)
                          @case('1')
                            <span class="badge bg-label-success">Active</span>
                              @break
                          @case('2')
                            <span class="badge bg-label-danger">InActive</span>
                              @break
                          @case('3')
                            <span class="badge bg-label-warning">Closed</span>
                              @break
                          @default
                                <span></span>
                          @endswitch
                  </td>
                  <td>
                    @if(in_array('Client', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                @if($RoleAccess[array_search('Client', array_column($RoleAccess, 'per_name'))]['view'] == 1 || $RoleAccess[array_search('Client', array_column($RoleAccess, 'per_name'))]['view'] == 2)
                                    <li><a class="dropdown-item" href="{{url('Employee/Client/view/'.$MyClients->id)}}">View</a></li>
                                @endif
                                @if($RoleAccess[array_search('Client', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/Client/edit/'.$MyClients->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('Client', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Client/delete/'.$MyClients->id)}}" id="{{$MyClients->id}}">Delete</button></li>
                                @endif
                            </ul>
                        </div>
                    @endif

                  </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="7">No Data Found</td>
              </tr>
              @endif
        <tr class="group">
          <td colspan="8" style="background-color:#eae8fd;">All Clients</td>
        </tr>
    
        @if(count($users) > 0)
             @foreach($users as $key=> $user)
        <tr class="even">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->first_name }}</td>
                  <td>@if($user && $user->company_name) {{ $user->company_name }} @endif</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at->format('Y-m-d') }}</td>
                  <td>
                   @switch($user->status)
                          @case('1')
                            <span class="badge bg-label-success">Active</span>
                              @break
                          @case('2')
                            <span class="badge bg-label-danger">InActive</span>
                              @break
                          @case('3')
                            <span class="badge bg-label-warning">Closed</span>
                              @break
                          @default
                                <span></span>
                          @endswitch
                  </td>
                  <td>
                    @if(in_array('Client', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                @if($RoleAccess[array_search('Client', array_column($RoleAccess, 'per_name'))]['view'] == 1 || $RoleAccess[array_search('Client', array_column($RoleAccess, 'per_name'))]['view'] == 2)
                                    <li><a class="dropdown-item" href="{{url('Employee/Client/view/'.$user->id)}}">View</a></li>
                                @endif
                                @if($RoleAccess[array_search('Client', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/Client/edit/'.$user->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('Client', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Client/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                                @endif
                            </ul>
                        </div>
                    @endif

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
        @if($users)
          <div class="p-1" style="float: right;">
              {{ $users->links() }}
          </div>
          @endif
      </div>
      </div>
    </div>
</div>
<script>
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
</script>
@endsection