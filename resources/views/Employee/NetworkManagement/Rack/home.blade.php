@extends('layouts.admin')
@section('title', 'Rack')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Rack /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Rack</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Total}}</h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">Total</p>
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
                          <span>Rack</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$totalSuspended}}</h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">Suspended</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
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
                          <span>Rack</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$totalActive}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Active</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
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
                          <span>Rack</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$totalTerminated}}</h3>
                            <!-- <p class="text-danger mb-0"></p> -->
                          </div>
                          <p class="mb-0">Terminated</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="ti ti-user-check ti-sm"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
  </div>
  <!-- Rack List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Rack's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{url('Employee/Rack/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="{{url('Employee/Rack/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
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
                  <label>Search: <input type="search" value="{{$searchTerm}}" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Rack ID</th>
                <th>Hardware Tag</th>
                <th>Rack Capacity</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
              @if(count($Rack) > 0)
             @foreach($Rack as $key=> $user)
              @php 
                $first_name =  \App\Models\User::select('first_name','id','last_name','email')->where('id',$user->customer_id)->first();                    
              @endphp
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                <td>
                     @if($first_name->profile_img)
                                       <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$first_name->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />
                                                                                @else
                                                                             <img src="{{url('/')}}/public/images/profile_Ri1o.jpeg"   class="rounded-circle" height="30"
                            width="30" style="margin-right: 15px;margin-top: 10px;" 
                            alt="User avatar" />
                                                                                @endif
                   {{$first_name->first_name }} {{$first_name->last_name }} (#{{$first_name->user_id}})<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$first_name->email}}</div>
                          </td>                  <td>@if($user && $user->rack_id) {{ $user->rack_id }} @endif</td>
                  <td>@if($user && $user->rack_bandwidth) {{ $user->rack_bandwidth }} @endif</td>
                  <td>@if($user && $user->rack_capacity) {{ $user->rack_capacity }} @endif</td>
                  <td>@switch($user->status)
                          @case('1')
                            <span class="badge bg-label-success">Active</span>
                              @break
                          @case('2')
                            <span class="badge bg-label-warning">Suspended</span>
                              @break
                          @case('3')
                            <span class="badge bg-label-danger">Terminated</span>
                              @break
                          @default
                                <span></span>
                          @endswitch</td>
                  <td>
                     @if(in_array('Rack', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                
                                @if($RoleAccess[array_search('Rack', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/Rack/edit/'.$user->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('Rack', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Rack/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                                @endif
                            </ul>
                        </div>
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
          <div class="p-1" style="float: right;">
              {{ $Rack->links() }}
          </div>
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