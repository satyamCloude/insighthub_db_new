@extends('layouts.admin')
@section('title', 'Goal')
@section('content')

<div class="container">
  <div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
          <h5 class="card-title mb-sm-0 me-2">View Detail's</h5>
          <div class="action-btns">
            <a href="{{url('Employee/Goal/home')}}" class="btn btn-label-primary me-3">
              <span class="align-middle"> Back</span>
            </a>
          </div>
        </div>
      </div>
      <div class="row my-4">
        <div class="col-xl-4">
          <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
            <div class="card mb-4">
              <div class="card-body" style="text-align: center;">
                <div class="user-avatar-section">
                  <div class="d-flex align-items-center flex-column">
                    <img 
                    class="rounded-circle"
                    style="margin-right: 15px;margin-top: 10px;" 
                    src="{{$view->profile_img}}"
                    height="100"
                    width="100"
                    alt="User avatar" />
                    <div class="user-info text-center">
                      <h4 class="mb-2"> 
                        <!-- <span class="fw-medium me-1">Employee name:</span> -->
                        <span>{{$view->first_name}}</span>
                      </h4>
                    </div>
                  </div>
                </div>
                <p class="mt-4 small text-uppercase text-muted">Details</p>

                <ul class="list-unstyled">
                  <li class="mb-2">


                    <input type="hidden" id="Empid" value="{{$view->employee_id}}">
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Job role:</span>
                    <span>{{$view->job_name}}</span>
                  </li>
                  
                </ul>

              </div>
            </div>            
          </div>
        </div>
        <div class="col-xl-8">
          <div class="row">
            <div class="col-xl-6 col-lg-5 col-md-5 order-1 order-md-0">
              <!-- User Card -->
              <div class="card mb-4">
                <div class="card-body">
                  <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                      <!-- <img class="img-fluid rounded mb-3 pt-1 mt-4"
                      src="{{url('/')}}/public/images/profile_bZh2.jpg "
                      height="100" width="100" alt="User avatar"> -->
                      <div class="user-info text-center">
                        <h4 class="mb-2">Goal Value </h4>
                      </div>
                    </div>
                  </div>
                  <p class="mt-4 small text-uppercase text-muted" style="text-align:center;">Value</p>
                  <div class="info-container" style="text-align:center;">
                    <h4 id="goal_value_set">{{$view->goal_value}}</h4>
                  </div>
                </div>
              </div>            
            </div>

            <div class="col-xl-6 col-lg-5 col-md-5 order-1 order-md-0">
              <!-- User Card -->
              <div class="card mb-4">
                <div class="card-body">
                  <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                      <!-- <img class="img-fluid rounded mb-3 pt-1 mt-4"
                      src="{{url('/')}}/public/images/profile_bZh2.jpg "
                      height="100" width="100" alt="User avatar"> -->
                      <div class="user-info text-center">
                        <h4 class="mb-2">Achieved Value </h4>
                      </div>
                    </div>
                  </div>
                  <p class="mt-4 small text-uppercase text-muted" style="text-align:center;">Value</p>
                  <div class="info-container" style="text-align:center;">
                    <h4 id="archieved_value_set">{{$view->achieved_value}}</h4>
                  </div>
                </div>
              </div>     
            </div>
            <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0 mt-1">
              <!-- User Card -->
              <div class="card mb-4">
                <div class="card-body">
                  <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                      <!-- <img class="img-fluid rounded mb-3 pt-1 mt-4"
                      src="{{url('/')}}/public/images/profile_bZh2.jpg "
                      height="100" width="100" alt="User avatar"> -->
                      <div class="user-info text-center">
                        <h4 class="mb-2">Progress Bar</h4>
                        <br>  
                      </div>
                    </div>
                  </div>
                  <!-- <p class="mt-4 small text-uppercase text-muted" style="text-align:center;">Value</p> -->
                  <div class="info-container" style="text-align:center;">
                    @if($view && $view->goal_value != 0)
                    <?php

                    $percentage = ($view->archieved_value / $view->goal_value) * 100;
                                        $progressClass = 'bg-danger'; // Default to danger
                                        if ($percentage > 2 && $percentage < 100) {
                                          $progressClass = 'bg-warning';
                                        } elseif ($percentage >= 100) {
                                          $progressClass = 'bg-success';
                                        }
                                        ?>
                                        <div class="progress">
                                          <div id="progressASAnnual"  class="progress-bar {{ $progressClass }} progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($percentage, 2) }}%</div>
                                        </div>
                                        @else
                                        N/A
                                        @endif
                                      </div>
                                      <br>
                                    </div>
                                  </div>            

                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="row">
                              <div class="col-md-6">
                                <h5 class="card-header">Goal's List</h5>
                              </div>
                              <div class="col-md-6 text-end"></div>
                            </div>
                            <div class="card-datatable table-responsive">
                              <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
                                <!-- <div class="row">
                                  <div class="col-sm-12 col-md-4">
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

                                </div> -->
                                <div class="row">
                                  <div class="col-sm-12 col-md-4 mt-3">
                                    <div class="input-group input-daterange" id="bs-datepicker-daterange">
                                      <input type="date" id="dateRangePicker" placeholder="MM/DD/YYYY" class="form-control fromDate">
                                      <span class="input-group-text">to</span>
                                      <input type="date" placeholder="MM/DD/YYYY" class="form-control toDate">
                                      <input type="hidden" name="id" class="form-control id" value="{{ $id }}">
                                      <input type="hidden" name="Empid" class="form-control Empid" value="{{ $Empid }}">
                                    </div>
                                  </div>

                                </div>
                                <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                                  <thead>
                                    <tr>
                                      <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                      <th>ID</th>
                                      <th>MONTH</th>
                                      <!-- <th>EMPLOYEE NAME</th> -->
                                      <th>DESIGNATION</th>
                                      <th>GOAL VALUE</th>
                                      <th>ACHIEVED VALUE</th>
                                      <th>ACHIEVED %</th>
                                      <th>SATAUS</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody id="result">
                                    @if(count($Goal) > 0)
                                    @foreach($Goal as $key => $user)
                                    <tr class="odd">
                                      <td>{{ $key + 1 }} </td>
                                      <!-- <td>
                                        <img
                                        class="rounded-circle"
                                        style="margin-right: 15px;margin-top: 10px;"
                                        src="{{$user->profile_img}}"
                                        height="30"
                                        width="30"
                                        alt="User avatar" /><a href="{{ url('Employee/Goal/view/'.$user->id) }}">{{$user->first_name }}</a><div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->job_name}}</div>
                                      </td> -->
                                      <td>@if($user && $user->month_name) {{ $user->month_name }} @endif</td>
                                      <td>@if($user && $user->job_name) {{ $user->job_name }} @endif</td>
                                      <td class="goal_value">
                                        @if($user && $user->goal_value) {{ $user->goal_value }} @endif</td>
                                        <td  class="archieved_value">
                                          @if($user && $user->archieved_value) 
                                          {{ $user->archieved_value }} 
                                          @endif
                                        </td>
                                        <td>
                                          @if($user && $user->goal_value != 0)
                                          <?php
                                          $percentage = ($user->archieved_value / $user->goal_value) * 100;
                                          $progressClass = 'bg-danger'; // Default to danger
                                          if ($percentage > 2 && $percentage < 100) {
                                            $progressClass = 'bg-warning';
                                          } elseif ($percentage >= 100) {
                                            $progressClass = 'bg-success';
                                          }
                                          ?>
                                          <div class="progress">
                                            <div class="progress-bar {{ $progressClass }} progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($percentage, 2) }}%</div>
                                          </div>
                                          @else
                                          N/A
                                          @endif
                                        </td>
                                        <td>
                                          @switch($user->status)
                                          @case('1')
                                          <span class="badge bg-label-danger">Failed</span>
                                          @break
                                          @case('2')
                                          <span class="badge bg-label-primary">InProgress</span>
                                          @break
                                          @case('3')
                                          <span class="badge bg-label-success">Achieved</span>
                                          @break
                                          @default
                                          <span></span>
                                          @endswitch
                                        </td>
                                        <td>
                                          <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                              <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                              @if(Auth::user()->type == 1)
                                              <li><a class="dropdown-item" href="{{ url('Employee/Goal/view/'.$user->id.'/'.$user->employee_id) }}">View</a></li>
                                              <li><a class="dropdown-item" href="{{ url('Employee/Goal/edit/'.$user->id) }}">Edit</a></li>
                                              @else
                                              <li><a class="dropdown-item" href="{{ url('Employee/Goal/view/'.$user->id.'/'.$user->employee_id) }}">View</a></li>
                                              @endif
                                              <li>
                                                <button class="dropdown-item delete_debtcase" data-url="{{ url('Employee/Goal/delete/'.$user->id) }}" data-id="{{ $user->id }}">Delete</button>
                                              </li>
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
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <script>

  // Wait for the document to be ready
                        document.addEventListener('DOMContentLoaded', function () {
    // Set a timeout to execute the code after 2 seconds
                          setTimeout(function () {
      // Function to sum the values in goal_value and archieved_value cells
                            function sumValues(className) {
                              let sum = 0;
                              document.querySelectorAll('.' + className).forEach(function (cell) {
                                sum += parseFloat(cell.textContent) || 0;
                              });
                              return sum;
                            }

      // Get the sums
                            let goalValueSum = sumValues('goal_value');
                            let archievedValueSum = sumValues('archieved_value');

      // Update the elements in the user card
      document.getElementById('goal_value_set').textContent = goalValueSum; //5
      document.getElementById('archieved_value_set').textContent = archievedValueSum; // 13

      // Update the progress bar
      let percentage = (archievedValueSum / goalValueSum) * 100; 

      let progressClass = 'bg-danger'; // Default to danger

      if (percentage > 2 && percentage < 100) {
        progressClass = 'bg-warning';
      } else if (percentage >= 100) {
        progressClass = 'bg-success';
      }
      
      // $('#progressASAnnual').css('width',percentage);
      $('#progressASAnnual').html(percentage.toFixed(2));
      $('#progressASAnnual').css('width',percentage.toFixed(2)+'%');
      $('#progressASAnnual').attr('aria-valuenow',percentage.toFixed(2));
      $('#progressASAnnual').removeClass().addClass('progress-bar progress-bar-striped progress-bar-animated ' +progressClass);



      
// alert(percentage);
      $('#progress_bar').html(`
      @if($view && $view->goal_value != 0)
      <div class="progress">
        <div class="progress-bar ${progressClass} progress-bar-striped progress-bar-animated" role="progressbar" style="width: ${percentage.toFixed()}%" aria-valuenow="${percentage.toFixed()}" aria-valuemin="0" aria-valuemax="100">${percentage.toFixed()}%</div>
        </div>
      @else
      N/A
      @endif
      `);

    }, 100); // 2000 milliseconds = 2 seconds
                        });


                        $(document).ready(function () {

    // Function to update the table body
                          function updateTable(data) {
                            var tbody = $('#result');

      // Clear existing rows
                            tbody.empty();

                            var totalGoalValue = 0;
                            var totalArchievedValue = 0;

                            if (data.data.goalData.length > 0) {
                              $.each(data.data.goalData, function (key, user) {
                                var row = '<tr class="odd">';
                                row += '<td>' + (key + 1) + '</td>';
                                row += '<td>';
                                row += '<img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="' + user.profile_img + '" height="30" width="30" alt="User avatar" />';
                                row += '<a href="{{ url("Employee/Goal/view") }}/' + user.id + '">' + user.first_name + '</a>';
                                row += '<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">' + user.job_name + '</div>';
                                row += '</td>';
                                row += '<td>' + (user.job_name ? user.job_name : '') + '</td>';
                                row += '<td class=goal_value>' + (user.goal_value ? user.goal_value : '') + '</td>';
                                row += '<td class=archieved_value>' + (user.month_name ? user.month_name : '') + '</td>';
                                row += '<td>' + (user.archieved_value ? user.archieved_value : '') + '</td>';
                                row += '<td>';

                                if (user.goal_value != 0) {
                                  var percentage = (user.archieved_value / user.goal_value) * 100;
            var progressClass = 'bg-danger'; // Default to danger

            if (percentage > 2 && percentage < 100) {
              progressClass = 'bg-warning';
            } else if (percentage == 100) {
              progressClass = 'bg-success';
            }

            row += '<div class="progress">';
            row += '<div class="progress-bar ' + progressClass + ' progress-bar-striped progress-bar-animated" role="progressbar" style="width: ' + percentage + '%" aria-valuenow="' + percentage + '" aria-valuemin="0" aria-valuemax="100">' + percentage.toFixed(2) + '%</div>';
            row += '</div>';
          } else {
            row += 'N/A';
          }

          row += '</td>';
          row += '<td>';

          switch (user.status) {
          case '1':
            row += '<span class="badge bg-label-danger">Failed</span>';
            break;
          case '2':
            row += '<span class="badge bg-label-primary">InProgress</span>';
            break;
          case '3':
            row += '<span class="badge bg-label-success">Achieved</span>';
            break;
          default:
            row += '<span></span>';
          }

          row += '</td>';
          row += '<td>';
          row += '<div class="btn-group">';
          row += '<button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">';
          row += '<i class="ti ti-dots-vertical"></i>';
          row += '</button>';
          row += '<ul class="dropdown-menu dropdown-menu-end" style="">';
          row += '<li><button class="dropdown-item delete_debtcase" url="{{ url("Employee/Goal/delete") }}/' + user.id + '" id="' + user.id + '">Delete</button></li>';
          row += '</ul>';
          row += '</div>';
          row += '</td>';
          row += '</tr>';

          tbody.append(row);

          // Update total values
          totalGoalValue += parseFloat(user.goal_value) || 0;
          totalArchievedValue += parseFloat(user.archieved_value) || 0;

        });
                            } else {
        // Display a message if no data is found
                              var message = '<tr><td class="text-center" colspan="8">No Data Found</td></tr>';
                              tbody.append(message);
                            }


                            $('#goal_value_set').html(totalGoalValue);
                            $('#archieved_value_set').html(totalArchievedValue);



      // alert('Total Goal Value: ' + totalGoalValue.toFixed(2) + '\nTotal Archieved Value: ' + totalArchievedValue.toFixed(2));
                          }

    // Capture change event of date inputs
                          $('.fromDate, .toDate').on('change', function () {
      // Get selected dates
                            var fromDate = $('.fromDate').val();
                            var toDate = $('.toDate').val();
                            var Empid = $('.Empid').val();
                            var id = $('.id').val();

      // Make Ajax request
                            $.ajax({
                              type: 'GET',
                              url: "{{ url('Employee/Goal/get_Goal_data_date_wise') }}",
                              data: {
                                fromDate: fromDate,
                                toDate: toDate,
                                Empid: Empid,
                                id: id,
                              },
                              success: function (data) {
                                console.log(data);

                                updateTable(data);
                              },
                              error: function (error) {
                                console.error('Error fetching data:', error);
                              }
                            });
                          });
                        });
                      </script>


                      <script>
                        $(document).ready(function () {

                          $(".delete_debtcase").click(function (e) {
                            var id = $(this).attr('id');
                            var url = $(this).data('url');
                            // alert(url);
                            e.preventDefault();
                            bootbox.confirm({
                              message: "Are you sure! you want to delete this goal?",
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
                          var $Empid = $('#Empid');

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
                            var Empid = $Empid.val();

            // Make an AJAX request to fetch data based on the selected year and month
                            $.ajax({
                              url: "{{ url('Employee/Goal/get_Goal_data') }}",
                              method: 'GET',
                              data: { year: selectedYear, month: selectedMonth, Empid: Empid },
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