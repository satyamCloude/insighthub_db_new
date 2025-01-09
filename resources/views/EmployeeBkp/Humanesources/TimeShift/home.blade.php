@extends('layouts.admin')
@section('title', 'TimeShift')
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">TimeShift /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif

    <div class=" card mb-4">
        <div class="row">
            <div class="col-md-12">
                <h5 class="card-header">Today Shift</h5>
                <div class="card-body">
                    <div id="horizontalBarChart"></div>
                </div>
            </div>
        </div>
    </div>
    
    
    
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Shift List</h5>
      </div>
      <div class="col-md-6 text-end">
            <a href="{{url('Employee/TimeShift/roaster')}}" class="btn btn-info mt-3 m-3">Shift Roaster</a>
            <a href="{{url('Employee/TimeShift/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
            <a href="{{url('Employee/TimeShift/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
         
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_length" id="DataTables_Table_3_length"><label>
                  </div>
                </div>
                <!--<div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">-->
                <!--  <div id="DataTables_Table_3_filter" class="dataTables_filter">-->
                <!--     <form method="GET" action="">    -->
                <!--      <label>Search: <input type="search" value="{{$searchTerm}}" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>-->
                <!--    </form>-->
                <!--  </div>-->
                <!--</div>-->
            </div>
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                <thead>
                  <tr>
                    <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                    <th>ID</th>
                    <th>Shift Name</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Working Hours</th>
                    <th>Shift Assigned</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @if(count($TimeShift) > 0)
                    @foreach($TimeShift as $key=> $user)
                        @php
                            $users = \App\Models\User::select('users.first_name', 'users.profile_img')
                                ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
                                ->where('employee_details.shift_id', $user->id)
                                ->get();
                        @endphp
                        <tr class="odd">
                        <td>{{ $key+1 }} </td>
                        <td>{{ $user->shift_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->StartTime)->format('H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->EndTime)->format('H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->working_hours)->format('H:i') }}</td>
                        <td>
                            <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                              @foreach($users as $useraa)
                              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="{{$useraa->first_name}}">
                               <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{isset($useraa->profile_img) ? $useraa->profile_img : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                              </li>
                                @endforeach()
                            </ul>
                        </td>
                       <!--  <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-end" style="">
                                <li><a class="dropdown-item" href="{{url('Employee/TimeShift/edit/'.$user->id)}}">Edit</a></li>
                                <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/TimeShift/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                              </ul>
                            </div>
                        </td> -->
                         <td>
                    @if(in_array('TimeShift', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                               
                                @if($RoleAccess[array_search('TimeShift', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/TimeShift/edit/'.$user->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('TimeShift', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/TimeShift/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
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
            <div class="p-1" style="float: right;">
                {{ $TimeShift->links() }}
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
        
    let cardColor, headingColor, labelColor, borderColor, legendColor;

    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  
        // Horizontal Bar Chart
      // --------------------------------------------------------------------
      const horizontalBarChartEl = document.querySelector('#horizontalBarChart'),
        horizontalBarChartConfig = {
          chart: {
            height: 300,
            width: 800,
            type: 'bar',
            toolbar: {
              show: false
            }
          },
          plotOptions: {
            bar: {
              horizontal: true,
              barHeight: '30%',
              startingShape: 'rounded',
              borderRadius: 8
            }
          },
          grid: {
            borderColor: borderColor,
            xaxis: {
              lines: {
                show: false
              }
            },
            padding: {
              top: -20,
              bottom: -12
            }
          },
          colors: config.colors.info,
          dataLabels: {
            enabled: false
          },
         series: [
            {
                name: 'Employee Count', // add a comma here
                data: {{ json_encode($shiftCount) }}
            }
        ],
          xaxis: {
            categories: {!! json_encode($shifts) !!},
            axisBorder: {
              show: false
            },
            axisTicks: {
              show: false
            },
            labels: {
              style: {
                colors: labelColor,
                fontSize: '13px'
              }
            }
          },
          yaxis: {
            labels: {
              style: {
                colors: labelColor,
                fontSize: '13px'
              }
            }
          }
        };
      if (typeof horizontalBarChartEl !== undefined && horizontalBarChartEl !== null) {
        const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
        horizontalBarChart.render();
      }
    });
    
    
</script>
@endsection