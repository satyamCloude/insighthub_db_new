@extends('layouts.admin')
@section('title', 'Employee')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Employee /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Employee</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{$TotalEmployee}}</h3>
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
              <span>Active</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{$Active}}</h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0">Total</p>
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
              <span>Resigned</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{$Suspended}}</h3>
                <!-- <p class="text-danger mb-0"></p> -->
              </div>
              <p class="mb-0">Total</p>
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
              <span>Terminated</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">{{$Terminated}}</h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0">Total</p>
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
  <!-- Employee List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6 card-header">
          <h5 >Employee's List</h5>
          
      </div>
      <div class="col-md-6 text-end">
         <a href="{{url('Employee/Employee/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="{{url('Employee/Employee/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5" style="min-height: 270px;">
            <form method="GET" action="">  
              <div class="row m-2 ">  
                <div class="col-3 float-left"> 
                  <label>Filter:</label>
                  <select name="status" class="form-control select2" onchange="this.form.submit();">
                    <option value="" >Filter</option>
                    <option value="1" @if(request()->get('status') == 1) selected @endif >Work From Home</option>
                    <option value="2" @if(request()->get('status') == 2) selected @endif>In Office</option>
                    <option value="3" @if(request()->get('status') == 3) selected @endif>Resigned</option>
                    <option value="4" @if(request()->get('status') == 4) selected @endif>Terminated</option>
                  </select>
                </div>
                <div class="col-9 justify-content-end d-flex"> 
                  <label>Search: <input type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </div>
              </div>
            </form>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Employee</th>
                <th>Company</th>
                <th>Department</th>
                <th>Phone</th>
                <th>Work Status</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
          <tbody id="result">
    @if(count($Employee) > 0)
        @foreach($Employee as $key => $user)
            @php
                $jobrole = App\Models\Jobroles::find($user->jobrole_id);
            @endphp
            <tr class="odd">
                <td>{{ $key + 1 }}</td>
                <td>
                    <div class="parent d-flex" style="align-items:center;">
    <div class="child1">
        @if($user->profile_img)
            <img 
                class="rounded-circle"
                style="margin-right:15px;margin-top:8px;" 
                src="{{ $user->profile_img }}"
                height="30"
                width="30"
                alt="User avatar" 
            />
        @else
            <img 
                class="rounded-circle"
                style="margin-right:15px;margin-top:8px;" 
                src="{{ url('public/images/21104.png') }}"
                height="30"
                width="30"
                alt="User avatar" 
            style="margin-right:15px;margin-top:8px;"/>
        @endif
    </div>
    <div class="child2">
        {{ $user->first_name }} {{ $user->last_name }}
        <div style="font-size: 12px;">
            {{ $jobrole ? $jobrole->name : 'No Job Role' }}
        </div>
    </div>
</div>

                </td>
                  <td>@if($user && $user->company_name) {{ $user->company_name }} @endif</td>
                  <td>@if($user && $user->department_name) {{ $user->department_name }} @endif</td>
                  <td>@if($user && $user->phone_number) {{ $user->phone_number }} @endif</td>
                   <td>
                   @switch($user->working_type_id)
                          @case('1')
                            <span class="badge bg-label-primary">In Office</span>
                              @break
                          @case('2')
                            <span class="badge bg-label-success">At Home</span>
                              @break
                          @default
                                <span></span>
                          @endswitch
                  </td>
                  <td>
                   @switch($user->status)
                          @case('1')
                            <span class="badge bg-label-success">Active</span>
                              @break
                          @case('2')
                            <span class="badge bg-label-warning">Resigned</span>
                              @break
                          @case('3')
                            <span class="badge bg-label-danger">Terminated</span>
                              @break
                          @default
                                <span></span>
                          @endswitch
                  </td>
                 <td>
                     @if(in_array('Employee', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                @if($RoleAccess[array_search('Employee', array_column($RoleAccess, 'per_name'))]['view'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/Employee/view/'.$user->id)}}">View</a></li>
                                @endif
                                @if($RoleAccess[array_search('Employee', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/Employee/edit/'.$user->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('Employee', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Employee/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                                @endif
                            </ul>
                        </div>
                    @endif
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="9">No Data Found</td>
              </tr>
              @endif             

            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $Employee->links() }}
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
<script>
    $(document).ready(function () {
        var currentYear = new Date().getFullYear();
        var startYear = 2015;
        var $selectYear = $('#year');
        var $selectMonth = $('#months');

        // Populate the select elements with options
        for (var year = currentYear; year >= startYear; year--) {
            $selectYear.append($('<option>', {
                value: year,
                text: year
            }));
        }

        // Handle the change event of the select elements
        $selectYear.on('change', fetchData);
        $selectMonth.on('change', fetchData);

        function fetchData() {
            var selectedYear = $selectYear.val();
            var selectedMonth = $selectMonth.val();

            // Make an AJAX request to fetch data based on the selected year and month
            $.ajax({
                url: "{{ url('Employee/Employee/get_Employee_yeardata') }}",
                method: 'GET',
                data: { year: selectedYear, month: selectedMonth },
                success: function (data) {
                    // Handle the successful response
                    $('#result').empty(); // Clear previous content

                    if (data.length > 0) {
                        $('#result').html(data);
                    } else {
                        $('#result').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function () {
                    $('#result').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }
    });
</script>




@endsection