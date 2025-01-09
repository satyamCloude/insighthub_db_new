@extends('layouts.admin')
@section('title', 'Company Login')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Company Login /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Company Login</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Total}}</h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-primary">
                            <i class="menu-icon fa-solid fa-cloud"></i>
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
                          <span>Active</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Active}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="menu-icon fa-solid fa-cloud"></i>
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
                          <span>Suspended</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Suspended}}</h3>
                            <!-- <p class="text-danger mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-warning">
                            <i class="menu-icon fa-solid fa-cloud"></i>
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
                          <span>Terminated</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Terminated}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="menu-icon fa-solid fa-cloud"></i>
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
          <h5 class="card-header">CompanyLogin's List</h5>
      </div>
      <div class="col-md-6 text-end">
          <a href="{{url('Employee/CompanyLogin/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
           @if($RoleAccess[array_search('CompanyLogin', array_column($RoleAccess, 'per_name'))]['add'] == 1)
          <a href="{{url('Employee/CompanyLogin/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
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
                  <label>Search: <input type="search" value="{{$query}}" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Company Name</th>
                <th>Login URL</th>
                <th>User Name</th>
                <th>Password</th>
                <th>SATAUS</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($CompanyLogin) > 0)
              @foreach($CompanyLogin as $key=> $Company)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($Company && $Company->company_name) {{ $Company->company_name }} @endif</td>
                  <td>@if($Company && $Company->portal_login_url) {{ $Company->portal_login_url }} @endif</td>
                  <td>@if($Company && $Company->username) {{ $Company->username }} @endif</td>
                  <td>@if($Company && $Company->password2) {{ $Company->password2 }} @endif</td>
                   <td>
                   @switch($Company->status)
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
                          @endswitch
                  </td>
                  <td>
                    @if(in_array('CompanyLogin', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                
                                @if($RoleAccess[array_search('CompanyLogin', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/CompanyLogin/edit/'.$Company->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('CompanyLogin', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/CompanyLogin/delete/'.$Company->id)}}" id="{{$Company->id}}">Delete</button></li>
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
              {{ $CompanyLogin->links() }}
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