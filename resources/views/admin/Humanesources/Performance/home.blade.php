@extends('layouts.admin')
@section('title', 'Performance')
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Performance /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <!-- Performance List Table -->
  <!--<div class="row mb-4">-->
  <!--    <div class="col-lg-4 order-3 order-xl-0">-->
  <!--  <div class="card">-->
  <!--    <div class="d-flex align-items-end row">-->
  <!--      <div class="col-7">-->
  <!--        <div class="card-body text-nowrap">-->
  <!--          <h5 class="card-title mb-0">Jimmy Singh! 🎉</h5>-->
  <!--          <p class="mb-2">Employee of the month</p>-->
  <!--          <h4 class="text-primary mb-1">$48.9k</h4>-->
  <!--          <a href="javascript:;" class="btn btn-primary waves-effect waves-light">View Performance</a>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--      <div class="col-5 text-center text-sm-left">-->
  <!--        <div class="card-body pb-0 px-0 px-md-4">-->
  <!--          <img src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/illustrations/card-advance-sale.png" height="140" alt="view sales">-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</div>-->
  <!--</div>-->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Performance's List</h5>
      </div>
      <div class="col-md-6 text-end">
         <a href="{{url('admin/Performance/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <button type="button" onclick="addCategory()"  class="btn btn-secondary ms-2 waves-effect waves-float waves-light m-3">Category</button>
          <button type="button" onclick="addRating()"  class="btn btn-info ms-2 waves-effect waves-float waves-light m-3">Rating</button>
          <!--<a href="{{url('admin/Performance/home2/')}}" class="btn btn-primary mt-3 m-3">Old</a>-->
      </div>
    </div>
        <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
                                                <form id="filterForm" action="{{ url('admin/Performance/home') }}" method="GET">
                                    <div class="dataTables_length" id="DataTables_Table_3_length">
                                        <label for="filter_month">Select Month:</label>
                                       <select name="month" class="form-select" id="filter_month" onchange="submitForm()">
                                                        <option value="01" @if(isset($_GET['month']) && $_GET['month'] == '01') selected @elseif(date('m') == '01') slected @else '' @endif>January</option>
                                                            <option value="02" @if(isset($_GET['month']) && $_GET['month'] == '02') selected @elseif(date('m') == '02') slected @else '' @endif>February</option>
                                                            <option value="03" @if(isset($_GET['month']) && $_GET['month'] == '03') selected @elseif(date('m') == '03') slected @else '' @endif>March</option>
                                                            <option value="04" @if(isset($_GET['month']) && $_GET['month'] == '04') selected @elseif(date('m') == '04') slected @else '' @endif>April</option>
                                                                 <option value="05" @if(isset($_GET['month']) && $_GET['month'] == '05') selected @elseif(date('m') == '05') slected @else '' @endif>May</option>
                                                                  <option value="06" @if(isset($_GET['month']) && $_GET['month'] == '06') selected @elseif(date('m') == '06') slected @else '' @endif>June</option>
                                                                  <option value="07" @if(isset($_GET['month']) && $_GET['month'] == '07') selected @elseif(date('m') == '07') slected @else '' @endif>July</option>
                                                                  <option value="08" @if(isset($_GET['month']) && $_GET['month'] == '08') selected @elseif(date('m') == '08') slected @else '' @endif>August</option>
                                                                   <option value="09" @if(isset($_GET['month']) && $_GET['month'] == '09') selected @elseif(date('m') == '09') slected @else '' @endif>September</option>
                                                                    <option value="10" @if(isset($_GET['month']) && $_GET['month'] == '10') selected @elseif(date('m') == '10') slected @else '' @endif>October</option>
                                                                    <option value="11" @if(isset($_GET['month']) && $_GET['month'] == '11') selected @elseif(date('m') == '11') slected @else '' @endif>November</option>
                                                                     <option value="12" @if(isset($_GET['month']) && $_GET['month'] == '12') selected @elseif(date('m') == '12') slected @else '' @endif>December</option>
                                    </select>
   

                                <select name="year" class="form-select" id="filter_year"></select>
                            </div>
                        </form>
                                        
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                 <form method="GET" action="">    
                  <label>Search: <input type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Rating</th>
                <th>Action</th>
              </tr>
            </thead>
<tbody id="result">
    @if(count($Performance) > 0)
        @php
            $averageRatings = [];
            $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
            $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
            $startDate = date("$year-$month-01");
            $endDate = date("Y-m-t", strtotime($startDate));
        @endphp
        @foreach($Performance as $user)
            @php
                $jobrole = App\Models\Jobroles::find($user->jobrole_id);
                $assignedTickets = DB::table('tickets')
                                    ->where('ccid', $user->id)
                                    ->whereBetween('date', [$startDate, $endDate])
                                    ->count();
                $resolvedTickets = DB::table('tickets')
                                    ->where('ccid', $user->id)
                                    ->whereBetween('date', [$startDate, $endDate])
                                    ->where('status', '3')
                                    ->count();
                $ticketRating = '--';
                if ($assignedTickets > 0) {
                    $resolvedPercentage = ($resolvedTickets / $assignedTickets) * 100;
                    if ($resolvedPercentage == 100) {
                        $ticketRating = 5;
                    } elseif ($resolvedPercentage >= 75) {
                        $ticketRating = 4;
                    } elseif ($resolvedPercentage >= 50) {
                        $ticketRating = 3;
                    } elseif ($resolvedPercentage >= 25) {
                        $ticketRating = 2;
                    } else {
                        $ticketRating = 1;
                    }
                }

                $onTimeArrivals = DB::table('attendences')
                                ->leftJoin('employee_details', 'attendences.emp_id', '=', 'employee_details.user_id')
                                ->leftJoin('time_shifts', 'time_shifts.id', '=', 'employee_details.shift_id')
                                ->leftJoin('users', 'users.id', '=', 'employee_details.user_id')
                                ->where('users.type', 4)
                                ->where('attendences.emp_Id', $user->id)
                                ->whereBetween('attendences.punch_date', [$startDate, $endDate])
                                ->whereRaw('TIME(attendences.punch_in) <= TIME(time_shifts.StartTime)')
                                ->count();
                $punctualityRating = '--'; // Default value
                $totalWorkingDays = DB::table('attendences')
                                    ->where('emp_id', $user->id)
                                    ->whereBetween('punch_date', [$startDate, $endDate])
                                    ->distinct()
                                    ->count('punch_date');
                $attendanceDays = DB::table('attendences')
                                    ->where('emp_Id', $user->id)
                                    ->whereBetween('punch_date', [$startDate, $endDate])
                                    ->distinct('punch_date')
                                    ->count();     
               $workingHoursData = DB::table('attendences as a')
                        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
                        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
                        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
                        ->where('us.type', 4)
                        ->where('a.emp_id', $user->id)
                        ->whereBetween('a.punch_date', [$startDate, $endDate])
                        ->select(
                            DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) as total_hours'),
                            DB::raw('COUNT(DISTINCT a.punch_date) as working_days'),
                            DB::raw('MIN(ts.working_hours) as shift_hours')
                        )
                        ->groupBy('a.emp_id')
                        ->first();

$workingHoursRating = '--'; // Default value
if ($workingHoursData && $workingHoursData->working_days > 0) {
    $averageHoursPerDay = $workingHoursData->total_hours / $workingHoursData->working_days;
    $shiftHours = isset($workingHoursData->shift_hours) ? $workingHoursData->shift_hours : 0;

    // Check if $averageHoursPerDay and $shiftHours are numeric
    if (is_numeric($averageHoursPerDay) && is_numeric($shiftHours)) {
        if ($shiftHours > 0) {
            if ($averageHoursPerDay >= $shiftHours) {
                $workingHoursRating = '5';
            } elseif ($averageHoursPerDay >= 0.75 * $shiftHours) {
                $workingHoursRating = '4';
            } elseif ($averageHoursPerDay >= 0.5 * $shiftHours) {
                $workingHoursRating = '3';
            } elseif ($averageHoursPerDay >= 0.25 * $shiftHours) {
                $workingHoursRating = '2';
            } else {
                $workingHoursRating = '1';
            }
        }
    }
}

                if ($totalWorkingDays > 0) {
                    $resolvedPercentage = ($onTimeArrivals / $totalWorkingDays) * 100;
                    if ($onTimeArrivals > 0) {
                        if ($resolvedPercentage == 100) {
                            $punctualityRating = 5;
                        } elseif ($resolvedPercentage >= 75) {
                            $punctualityRating = 4;
                        } elseif ($resolvedPercentage >= 50) {
                            $punctualityRating = 3;
                        } elseif ($resolvedPercentage >= 25) {
                            $punctualityRating = 2;
                        } else {
                            $punctualityRating = 1;
                        }
                    } else {
                        $punctualityRating = 1; 
                    }
                }
                $attendanceRating = '--';
                if ($attendanceDays >= 2 && $attendanceDays <= 10) {
                    $attendanceRating = 1;
                } elseif ($attendanceDays >= 10 && $attendanceDays <= 20) {
                    $attendanceRating = 2;
                } elseif ($attendanceDays >= 20 && $attendanceDays <= 30) {
                    $attendanceRating = 3;
                } elseif ($attendanceDays >= 30 && $attendanceDays <= 40) {
                    $attendanceRating = 4;
                } elseif ($attendanceDays == date('t')) {
                    $attendanceRating = 5;
                }
                $averageRating = '--'; 
                if ($ticketRating !== '--' && $punctualityRating !== '--' && $workingHoursRating !== '--' && $attendanceRating !== '--') {
                    $averageRating = round(($ticketRating + $punctualityRating + $workingHoursRating + $attendanceRating) / 4);
                }
                $averageRatings[] = $averageRating;
            @endphp
        
            <tr class="odd">
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="parent d-flex">
    <div class="child1">
        @if($user->profile_img)
            <img 
                class="rounded-circle"
                style="margin-right: 15px; margin-top: 10px;" 
                src="{{ $user->profile_img }}"
                height="30"
                width="30"
                alt="User avatar" />
        @else
            <img 
                class="rounded-circle"
                style="margin-right: 15px; margin-top: 10px;" 
                src="{{ url('public/images/21104.png') }}"
                height="30"
                width="30"
                alt="User avatar" />
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
                <td>@if($user && $user->departments_name) {{ $user->departments_name }} @endif</td>  
                <td>
                    @if($averageRatings[$loop->index] === '--')
                        <span>--</span>
                    @else
                        @for ($i = 0; $i < $averageRatings[$loop->index]; $i++)
                            <i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>
                        @endfor
                    @endif
                </td>
                <td><a href="{{url('admin/Performance/view/'.$user->id)}}"><i class="fa-solid fa-eye"></i></a></td>
            </tr>
        @endforeach
                          @else
                          <tr>
                            <td class="text-center" colspan="4">No Data Found</td>
                          </tr>
                          @endif  
                        </tbody>
        </table>
          <div class="p-1" style="float: right;">
              {{ $Performance->links() }}
          </div>
      </div>
      </div>
    </div>
</div>
<!--Modal start-->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>CATEGORY NAME</th>
                <th>DESCRIPTION</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody id="PerformanceCategorydata">
              @if(count($PerformanceCategory) > 0)
              @foreach($PerformanceCategory as $key=> $Perfo)
              <tr>
                  <td>{{$key+1}} </td>
                  <td>{{$Perfo->category_name}} </td>
                  <td>{{$Perfo->description}} </td>
                  <td><a onclick="editdatat({{$Perfo->id}})"><i class="cursor-pointer text-dark fas fa-edit"></i></a>&nbsp;&nbsp; <a onclick="deletedatat({{$Perfo->id}})" ><i class="cursor-pointer text-dark fa-solid fa-trash"></i></a></td>
              </tr>
              @endforeach
               @else
              <tr>
                <td class="text-center" colspan="4">No Data Found</td>
              </tr>
              @endif
            </tbody>
        </table>
          <div id="editdataa">
            
          </div>
          <div class="row">
            <div class="col-md-5 mb-3">
              <input type="text" id="category_name" class="form-control" name="category_name" placeholder="Enter Category Name">
            </div>
            <div class="col-md-5 mb-3">
              <input type="text" id="description" class="form-control" name="description" placeholder="Enter description">
            </div>
            <div class="col-md-2 mb-3">
              <button type="button" onclick="Submitdata()" class="btn btn-success">Submit</button>
            </div>
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
            Close
          </button>
        </div>
    </div>
    </div>
</div>
<!--Modal End-->
<!--Modal start-->
<div class="modal fade" id="ModalRatingopen" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Rating</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>RATING NAME</th>
                <th>RATING</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody id="PerformanceRating">
              @if(count($PerformanceRating) > 0)
              @foreach($PerformanceRating as $key=> $Perfo)
              <tr>
                  <td>{{$key+1}} </td>
                  <td>{{$Perfo->rating_name}} </td>
                  <td>{{$Perfo->rating}} </td>
                  <td><a onclick="editrating({{$Perfo->id}})"><i class="text-dark fas fa-edit"></i></a>&nbsp;&nbsp; <a onclick="deleterating({{$Perfo->id}})" ><i class="text-dark fa-solid fa-trash"></i></a></td>
              </tr>
              @endforeach
               @else
              <tr>
                <td class="text-center" colspan="4">No Data Found</td>
              </tr>
              @endif
            </tbody>
        </table>
          <div id="ratingdata">
            
          </div>
          <div class="row">
            <div class="col-md-5 mb-3">
              <input type="text" id="rating_name" class="form-control" name="rating_name" placeholder="Enter rating Name">
            </div>
            <div class="col-md-5 mb-3">
              <input type="number" step="any" id="rating" class="form-control" name="rating" placeholder="Enter rating">
            </div>
            <div class="col-md-2 mb-3">
              <button type="button" onclick="Submitrating()" class="btn btn-success">Submit</button>
            </div>
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
            Close
          </button>
        </div>
    </div>
    </div>
</div>
<!--Modal End-->
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
function addCategory(){
  $('#backDropModal').modal('show');
}



function updateddataa(id){
  // Get values from input fields
  var category_name = $('#category_name2').val();
  var description = $('#description2').val();

  if (category_name.trim() === '' || description.trim() === '') {
    alert('Please fill out both category name and description fields.');
  } else {
    $.ajax({
      url: "{{ url('admin/PerformanceCategory/update') }}",
      type: 'post',
      data: {
        'category_name': category_name,
        'description': description,
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceCategorydata').empty();
        if (data.length > 0) {

          $('#editdataa').html('');
          $('#PerformanceCategorydata').html(data);
        } else {
          $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
  }
}

function editdatat(id){

  $.ajax({
      url: "{{ url('admin/PerformanceCategory/edit') }}",
      type: 'post',
      data: {
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#editdataa').empty(); 
        if (data.length > 0) {
          $('#editdataa').html(data);
        } else {
          $('#editdataa').html('<div class="text-center"><span>No Data Found</span></div>');
        }
      },
      error: function () {
        $('#editdataa').html('<div colspan="4" class="text-center"><span>Error fetching data.</span></div>');
      }
    });
}

function deletedatat(id){
 $.ajax({
      url: "{{ url('admin/PerformanceCategory/delete') }}",
      type: 'post',
      data: {
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceCategorydata').empty(); 
        if (data.length > 0) {
          $('#PerformanceCategorydata').html(data);
        } else {
          $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
}



function Submitdata() {
  // Get values from input fields
  var category_name = $('#category_name').val();
  var description = $('#description').val();

  if (category_name.trim() === '' || description.trim() === '') {
    alert('Please fill out both category name and description fields.');
  } else {
    $.ajax({
      url: "{{ url('admin/PerformanceCategory/store') }}",
      type: 'post',
      data: {
        'category_name': category_name,
        'description': description,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceCategorydata').empty();
        if (data.length > 0) {
          $('#PerformanceCategorydata').html(data);
        } else {
          $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceCategorydata').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
  }
}

function addRating(){
  $('#ModalRatingopen').modal('show');
}


function Submitrating() {
  // Get values from input fields
  var rating_name = $('#rating_name').val();
  var rating = $('#rating').val();  // Fixed variable name here

  if (rating_name === '' || rating === '') {
    alert('Please fill out both rating name and rating fields.');
  } else {
    $.ajax({
      url: "{{ url('admin/PerformanceRating/store') }}",
      type: 'post',
      data: {
        'rating_name': rating_name,
        'rating': rating,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceRating').empty();
        if (data.length > 0) {
          $('#PerformanceRating').html(data);
        } else {
          $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
  }
}

function editrating(id){

  $.ajax({
      url: "{{ url('admin/PerformanceRating/edit') }}",
      type: 'post',
      data: {
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#ratingdata').empty(); 
        if (data.length > 0) {
          $('#ratingdata').html(data);
        } else {
          $('#ratingdata').html('<div class="text-center"><span>No Data Found</span></div>');
        }
      },
      error: function () {
        $('#ratingdata').html('<div colspan="4" class="text-center"><span>Error fetching data.</span></div>');
      }
    });
}

function updaterating(id){
  // Get values from input fields
  var rating_name = $('#rating_name2').val();
  var rating = $('#rating2').val();

   if (rating_name === '' || rating === '') {
    alert('Please fill out both rating name and rating fields.');
  } else {
    $.ajax({
      url: "{{ url('admin/PerformanceRating/update') }}",
      type: 'post',
      data: {
        'rating_name': rating_name,
        'rating': rating,
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceRating').empty();
        if (data.length > 0) {

          $('#ratingdata').html('');
          $('#PerformanceRating').html(data);
        } else {
          $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
  }
}

function deleterating(id){
 $.ajax({
      url: "{{ url('admin/PerformanceRating/delete') }}",
      type: 'post',
      data: {
        'id': id,
        '_token': "{{ csrf_token() }}",
      },
      success: function (data) {
        $('#PerformanceRating').empty(); 
        if (data.length > 0) {
          $('#PerformanceRating').html(data);
        } else {
          $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>No Data Found</span></td></tr>');
        }
      },
      error: function () {
        $('#PerformanceRating').html('<tr><td colspan="4" class="text-center"><span>Error fetching data.</span></td></tr>');
      }
    });
}


</script>
<script>
    function submitForm() {
        document.getElementById("filterForm").submit();
    }
</script>
<script>
    // Get the current month
    const currentMonth = new Date().getMonth() + 1; // JavaScript months are zero-based, so add 1 to get the correct month number

    // Set the default selected option based on the current month
    document.getElementById('months').value = currentMonth.toString().padStart(2, '0'); // Ensure two-digit format (e.g., '05' for May)
</script>
     <script>
                            $(document).ready(function () {
                            
                                var currentYear = new Date().getFullYear();
                                var startYear = 2015;
                                var $selectYear = $('#filter_year');
                                
                                // Populate the select element for years
                                for (var year = currentYear; year >= startYear; year--) {
                                    $selectYear.append($('<option>', {
                                        value: year,
                                        text: year
                                    }));
                                }
                            });
                        </script>

@endsection