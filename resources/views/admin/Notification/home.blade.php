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
                          <span>Total Users</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$Totalclient}}</h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <!-- <p class="mb-0">Total Users</p> -->
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
                          <!-- <p class="mb-0">Last week analytics</p> -->
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
                          <!-- <p class="mb-0">Last week analytics</p> -->
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
                          <!-- <p class="mb-0">Last week analytics</p> -->
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
        <a href="{{url('admin/Client/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="{{url('admin/Client/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
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
          <table class="dt-responsive table dataTable dtr-column mt-4 btmtable" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info" style="margin-top:10px;border-radius:4px;width: max-content !important;">
          <thead>
            <tr>
              <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
            <th><input type="checkbox" id="selectAll"> &nbsp;&nbsp;&nbsp;#</th>

                     <th>CLIENT NAME</th>
                     <th>SUBJECT</th>
                     <!-- <th>STAGE</th> -->
                     <th>TOTAL AMOUNT</th>
                     <th>VALID UNTIL</th>
                     <th>LAST MODIFICATION</th>
                     <th>Generated bY</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
              <tbody>
        @if(count($users) > 0)
            @foreach($users as $key => $user)
                @php 
              
                $generated_by = \App\Models\User::select('users.first_name','users.last_name','users.company_name','users.id as emp_id', 'users.profile_img', 'company_logins.company_name','jobroles.name as jobrole')
                    ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
                    ->leftJoin('jobroles', 'employee_details.jobrole_id', '=', 'jobroles.id')
                    ->leftJoin('company_logins', 'company_logins.id', '=', 'employee_details.company_id')
                    ->where('users.id', $user->quotesuser_id)
                    ->first();
            @endphp
            <tr class="odd">
                <td><input type="checkbox" name="ids[]" class="selectId" value="{{$user->id}}"> &nbsp;&nbsp;{{ $key + 1 }} </td>
                  <td  >
                      <div class="d-flex">
                      @if($user->leads_id === 0)
                          @php
                              $user_data = null;
                              if ($user->customer_name) {
                                  $user_data = \App\Models\User::select('users.first_name','users.last_name','users.company_name','users.id as client_id', 'users.profile_img', 'users.email')
                                      ->where('users.id', $user->customer_name)
                                      ->first();
                              }
                          @endphp

                          @if($user_data)
                              @if($user_data->profile_img)
                                  <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" src="{{ $user_data->profile_img }}" height="30" width="30" alt="User avatar" />
                              @else
                                  <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;">
                              @endif
                                <div >                              
                                    <a href="{{ url('admin/Quotes/view/'.$user->id) }}">
                                        {{ $user_data->first_name }} {{ $user_data->last_name }} (#{{ $user_data->client_id }})
                                    </a><br/>
                                    <small>{{ $user_data->company_name }}</small>
                                </div>
                          @endif
                      @else
                          @php
                              $user_data2 = \App\Models\Leads::select('leads.first_name', 'leads.last_name', 'leads.email')
                                  ->where('leads.id', $user->leads_id)
                                  ->first();
                          @endphp

                          @if($user_data2)
                             
                                  <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;">


                              <a href="{{ url('admin/Quotes/view/'.$user->id) }}">{{ $user_data2->first_name }} {{ $user_data2->last_name }} (#{{ $user_data2->client_id }})</a>
                              <div style="font-size:12px; margin-left: 46px; margin-top: -11px;">{{ $user_data2->jobrole }}</div>
                              @else
                               <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;">


                          @endif
                      @endif
                      </div>
                  </td>


                <td>@if($user && $user->subject) {{ $user->subject }} @endif</td>
                <td>@if($user && $user->total) {{ $user->total }} @endif</td>
                  
                    @php
                        $validDate = $user && $user->valid_until ? $user->valid_until : null;
                        $isExpired = $validDate && $user->valid_until < date('Y-m-d');
                    @endphp
                    
                    <td class="{{ $isExpired ? 'red' : 'green' }}">
                        @if($validDate)
                          {{ date('d-m-Y', strtotime($user->valid_until)) }} 
                        @endif
                    </td>

                <td>@if($user && $user->updated_at) {{ date('d-m-Y', strtotime($user->updated_at)) }} @endif</td>
                <td>
                     @if($generated_by && $generated_by->profile_img)
                                                                                                   <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" src="{{ $generated_by->profile_img }}" height="30" width="30" alt="User avatar" />

                                                  @else
                                                                                                    <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;">

                                                  @endif

                   
                    @if($generated_by && $generated_by->first_name) {{ $generated_by->first_name }} @endif @if($generated_by && $generated_by->last_name) ({{ $generated_by->emp_id }}) @endif
                    <div style="font-size:12px; margin-left: 46px; margin-top: -11px;"> @if($generated_by && $generated_by->jobrole) {{ $generated_by->jobrole }}  @else - @endif</div>
                </td>
               <!--  <td>
                    @if($user['status']=="1")
                        <button onclick="changeStatus('{{ $user->id }}', '0')" class="btn btn-danger">Decline</button>
                    @else
                        <button onclick="changeStatus('{{ $user->id }}', '1')" class="btn btn-success">Accept</button>
                    @endif

                </td> -->
                 <td>
                    @switch($user->status)
                        @case('1')
                              <button  class="btn btn-warning">Pending</button>
                            @break
                        @case('2')
                            <button  class="btn btn-warning">Pending</button>
                            @break
                        @case('3')
                            <button  class="btn btn-primary">Accepted</button>
                            @break
                        @case('4')
                           <button  class="btn btn-danger">Lost</button>
                            @break
                        @case('5')
                            <button  class="btn btn-success">Win</button>

                            @break
                        @default
                            <button  class="btn btn-warning">Pending</button>
                    @endswitch
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" style="">
                            <!-- <li><a class="dropdown-item" href="{{ url('admin/Quotes/downloadPDF/'.$user->id) }}">Download</a></li> -->
                            <li><a class="dropdown-item" href="{{ url('admin/Quotes/MakeQuotesInvoice/'.$user->id) }}">Make Invoice</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/Quotes/SendQuotes/'.$user->id) }}">Send</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/Quotes/edit/'.$user->id) }}">Edit</a></li> 
                        </ul>
                    </div>
                </td> 
            </tr>
        @endforeach
    @else
        <tr>
            <td class="text-center" colspan="10">No Data Found</td>
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