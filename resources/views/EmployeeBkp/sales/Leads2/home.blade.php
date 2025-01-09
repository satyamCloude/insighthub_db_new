@extends('layouts.admin')
@section('title', 'Leads')
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leads /</span> Home</h4>
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
                            <h3 class="mb-0 me-2">{{$TotalLeads}}</h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">Total Leads</p>
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
                          <span>Progress Leads</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$progress}}</h3>
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
                          <span>Win Leads</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$win}}</h3>
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
                          <span>Loss Leads</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$loss}}</h3>
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
          <h5 class="card-header">Leads's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{url('Employee/Leads/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['add'] == 1)
          <a href="{{url('Employee/Leads/add')}}" class="btn btn-primary mt-3 m-3">Add Leads</a>
          @endif
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
                <select name="months" class="form-select" id="months">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select name="year" class="form-select" id="year">  </select>
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
                <th>MOBILE</th>
                <th>REQUIREMENT</th>
                <th>ASSIGNED TO</th>
                <th>Generated By</th>
                <th>SATAUS</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
              @if(count($users) > 0)
             @foreach($users as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>@if($user && $user->first_name) {{ $user->first_name }} @endif</td>
                  <td>@if($user && $user->phone_number) {{ $user->phone_number }} @endif</td>
                  <td>@if($user && $user->requirement) {{ $user->requirement }} @endif</td>
                  <td>@if($user && $user->first_name) {{ $user->assigned_first_name }} @endif</td>
                  <td>@if($user && $user->first_name) {{ $user->generated_by_first_name }} @endif</td>
                   <td>
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
                  </td>
                  <td>
                     @if(in_array('Leads', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['view'] == 1 || $RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['view'] == 2)
                                    <li><a class="dropdown-item" href="{{url('Employee/Leads/view/'.$user->id)}}">View</a></li>
                                @endif
                                @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/Leads/edit/'.$user->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Leads/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
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
                url: "{{ url('Employee/Leads/get_leads_yeardata') }}",
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