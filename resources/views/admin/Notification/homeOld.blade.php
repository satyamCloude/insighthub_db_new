@extends('layouts.admin')
@section('title', 'Quotes')
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Quotes /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <div class="row g-4 mb-4">
    <div class="col-sm-2 col-xl-2">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Total Quotes</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$TotalQuotes}}</h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <!-- <p class="mb-0">Total Quotes</p> -->
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
    <div class="col-sm-2 col-xl-2">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Delivered Quotes</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$delivered}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
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
    <div class="col-sm-2 col-xl-2">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Onhold Quotes</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$onhold}}</h3>
                            <!-- <p class="text-danger mb-0"></p> -->
                          </div>
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
    <div class="col-sm-2 col-xl-2">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Accepted Quotes</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$accepted}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
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
      <div class="col-sm-2 col-xl-2">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Lost Quotes</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$lost}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <!-- <p class="mb-0">Lost Quotes</p> -->
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
    <div class="col-sm-2 col-xl-2">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Win Quotes</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$win}}</h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <!-- <p class="mb-0">Win Quotes</p> -->
                          
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
          <h5 class="card-header">Quote's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{url('/')}}/admin/Quotes/EXPORTCSV" class="btn btn-info mt-3 m-3 waves-effect waves-light"><i class="fa-solid fa-file-csv"></i></a>
        <a href="{{url('admin/Quotes/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="{{url('admin/Quotes/add')}}" class="btn btn-primary mt-3 m-3">Add Quotes</a>
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
                <th>CUSTOMER NAME</th>
                <th>SUBJECT</th>
                <th>STAGE</th>
                <th>TOTAL</th>
                <th>VALID UNTIL</th>
                <th>LAST MODIFICATION</th>
                <th>Generated bY</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @if(count($users) > 0)
             @foreach($users as $key=> $user)
              @php 
                  $generated_by =  \App\Models\User::select('users.first_name','users.profile_img','company_logins.company_name')
                                    ->leftjoin('employee_details','employee_details.user_id','users.id')
                                    ->leftjoin('company_logins','company_logins.id','employee_details.company_id')
                                    ->where('users.id',$user->quotesuser_id)
                                    ->first();
              @endphp
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" /><a href="{{url('admin/Quotes/view/'.$user->id)}}">{{ $user->first_name }}</a><div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div></td>
                  <td>@if($user && $user->subject) {{ $user->subject }} @endif</td>
                  <td>
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
                    <td>@if($user && $user->total) {{ $user->total }} @endif</td>
                    <td>@if($user && $user->valid_until) {{ date('d-m-Y', strtotime($user->valid_until)) }} @endif</td>
                    <td>@if($user && $user->updated_at) {{ date('d-m-Y', strtotime($user->updated_at)) }} @endif</td>


                  <td><img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$generated_by->profile_img}}" height="30" width="30" alt="User avatar" />@if($generated_by && $generated_by->first_name) {{ $generated_by->first_name }} @endif<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$generated_by->company_name}}</div></td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            @if($user->status == '5')
                            <li><a class="dropdown-item" href="{{url('admin/Quotes/downloadPDF/'.$user->id)}}">Download PDF</a></li>
                            <li><a class="dropdown-item" href="{{url('admin/Quotes/printView/'.$user->id)}}">View PDF</a></li>
                            <li><a class="dropdown-item" href="{{url('admin/Quotes/view/'.$user->id)}}">View</a></li>
                            @elseif($user->status == '3')  
                            <li><a class="dropdown-item" href="{{url('admin/Quotes/GenerateQuotes/'.$user->id)}}">Generate Quotes</a></li>
                            @else  
                            <li><a class="dropdown-item" href="{{url('admin/Quotes/edit/'.$user->id)}}">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('admin/Quotes/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                            @endif
                          </ul>
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
              {{ $users->links() }}
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