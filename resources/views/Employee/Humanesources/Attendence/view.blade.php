@extends('layouts.admin')
@section('title', 'Attendence')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<style>
.status_color{
  background-color: red;
  width:15px;
  height: 15px;
  border-radius: 50%;
  display: block;
  margin-right: 8px;

}


th {
  border-color: 1px solid transparent;
  background-color: #eae8fd!important;
}

</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-md-4 card m-3 mb-0">
      <div class="inner_content  card-body row">
          <div class="col-md-3 text-center">
              <img class="avatar rounded-circle" style="height:2.9rem; width:2.9rem;" src="{{$user->profile_img}}">
          </div>
          <div class="col-md-9">
            <h4 class="font-weight-bold mb-0" >
                {{ucwords($user->first_name)}} {{ucwords($user->last_name)}}
            </h4>
            <p class="mb-0">{{$user->login_email}}</p>
            <p>
                @php 
                    $jobrole = App\Models\Jobroles::find($user->jobrole_id);
                @endphp
                @if($jobrole && $jobrole->name){{$jobrole->name}}@endif
            </p>
           </div>
      </div>
    </div>
  </div>
  <div class="row" style="margin-top: 40px;">
    <div class="col-lg-5">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Today</h5>
          <div class="dropdown">
            @if($Attendence)
              <div class="marker" style="background-color:green; padding:2px 8px;color:white;border-radius:30px;">
                <span>Present</span>
              </div>
            @else
              <div class="marker" style="background-color:#ed3637; padding:2px 8px;color:white;border-radius:30px;">
                <span>Absent</span>
              </div>
            @endif
          </div>
        </div>
        <div class="card-body" style="position: relative;">
          <div id="radialBarChart"></div>

        </div>
            <!--@if($Attendence)-->
            <!--<div class="btn btn-warning" style="color:white;margin:10px;">Mark Absent</div>   -->
            <!--@else-->
            <!--<div class="btn" style="background-color: #3178EE;color:white;margin:10px;">Mark Present</div>-->
            <!--@endif-->
        
      </div>
    </div>
    
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0 me-2">Attendance</h5>
              <div class="dropdown">
                <!--<button-->
                <!--  class="btn p-0"-->
                <!--  type="button"-->
                <!--  id="topic"-->
                <!--  data-bs-toggle="dropdown"-->
                <!--  aria-haspopup="true"-->
                <!--  aria-expanded="false">-->
                <!--  <i class="ti ti-dots-vertical"></i>-->
                <!--</button>-->
                <!--<div class="dropdown-menu dropdown-menu-end" aria-labelledby="topic">-->
                <!--  <a class="dropdown-item" href="javascript:void(0);">Highest Views</a>-->
                <!--  <a class="dropdown-item" href="javascript:void(0);">See All</a>-->
                <!--</div>-->
              </div>
            </div>
            <div class="card-body row g-3">
              <div class="col-md-6">
                <div id="horizontalBarChart" ></div>
              </div>
                <div class="col-md-6 d-flex justify-content-around align-items-center">
                    <div class="row">
                    @foreach($attendanceData as $key => $value)
                    <div class="col-md-6">
                        <div class="align-items-baseline d-flex">
                            <span class="
                            @if($key==0)
                            text-primary
                            @elseif($key==1) 
                            text-success
                            @elseif($key==2) 
                            text-danger
                            @elseif($key==3) 
                            text-info
                            @elseif($key==4) 
                            text-secondary
                            @elseif($key==5) 
                            text-warning
                            @endif
                            "><i class="ti ti-circle-filled fs-6"></i></span>&nbsp;&nbsp;
                                <p class="mb-2">{{ $value['month'] }}</p>
                                
                        </div>
                        <h5 class="mx-3">{{ $value['percentage'] }}%</h5>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
          </div>
    </div>
 </div>

    <div class="row" style="margin-top:40px;">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
              <div class="card-header flex-column flex-md-row" style="padding-bottom: 16px;">
                <div class="head-label text-center">
                  <h5 class="card-title mb-0">Working History</h5>
                </div>
              </div>
              <!--<div class="row">-->
              <!--  <div class="col-sm-12 col-md-6 mb-4">-->
              <!--    <div class="Status_length" style="display: flex;justify-content: space-between;margin-left:6px;">-->
              <!--      <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: #3178EE;">&nbsp;</span><span>Meeting Criteria</span></div>-->
              <!--      <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: #efc51a;">&nbsp;</span><span>Criteria Unmet</span></div>-->
              <!--      <div class="status" style="display: flex;align-items: center;"><span class="status_color">&nbsp;</span><span>Action needed</span></div>-->
              <!--      <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: lightgrey;">&nbsp;</span><span>Overtime</span></div>-->
              <!--    </div>-->
              <!--  </div>-->
              <!--</div>-->
             <div class="inner_table" style="padding:0px 23px;">
                <div class="row mb-4">
                   <form>
                              <div class="row">
          <?php
    // Debug output
   
    // Current month
    $currentMonth = date('m');

    // Months array
    $months = [
        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
    ];

    // Determine the selected month
    $selectedMonth = isset($_GET['month']) ? $_GET['month'] : $currentMonth;
?>
<div class="col-sm-12 col-md-6">
    <form method="get">
        <div class="row">
            <div class="col-md-12 d-flex">
                <select name="month" class="form-select" id="month" onchange="this.form.submit()">
                    <?php
                        foreach ($months as $monthNumber => $monthName) {
                            $selected = ($selectedMonth == $monthNumber) ? 'selected' : '';
                            echo "<option value=\"$monthNumber\" $selected>$monthName</option>";
                        }
                    ?>
                </select>
                &nbsp;
                <select name="year" class="form-select" id="year" onchange="this.form.submit()">
                    <!-- Populate year options here -->
                </select>
            </div>
        </div>
    </form>
</div>

                    </div>
                </form>
                </div>
                  <table class="datatables-basic table dataTable no-footer dtr-column ttable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
    <thead>
        <tr>
            <th>Emp ID</th>
            <th>Date</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Working Hrs</th>
            <th>Production Hours</th>
        </tr>
    </thead>
    <tbody id="tbody">
        @if(count($attendance2) > 0)
            @foreach($attendance2 as $key => $row)
                @php
                    // Calculate total working seconds based on punch_in and punch_out times
                    $punchInTime = strtotime($row->punch_in);
                    $punchOutTime = strtotime($row->punch_out);
                    $workingSeconds = $punchOutTime - $punchInTime;

                    // Convert working seconds to hours, minutes, and seconds
                    $workingHours = floor($workingSeconds / 3600);
                    $workingMinutes = floor(($workingSeconds % 3600) / 60);
                    $workingSeconds = $workingSeconds % 60;
                    $ProductionHoursFormatted = sprintf("%02d h %02d min %02d sec", $workingHours, $workingMinutes, $workingSeconds);
                    
                    // Get the actual working hours from the database (could be in seconds)
                    $actualWorkingHours = is_numeric($row->actualworkinghours) ? $row->actualworkinghours : 0;

                    // Convert actual working hours to hours, minutes, and seconds
                    $actualHours = floor($actualWorkingHours);
                    $actualMinutes = floor(($actualWorkingHours - $actualHours) * 60);
                    $actualSeconds = round((($actualWorkingHours - $actualHours) * 3600) - ($actualMinutes * 60));
                    $ActualWorkingHoursFormatted = sprintf("%02d h %02d min %02d sec", $actualHours, $actualMinutes, $actualSeconds);

                    // Ensure variables contain numeric values before calculations
                    $totalHours = is_numeric($row->total_hours) ? $row->total_hours : 0;
                    $totalHoursDecimal = $totalHours / 3600; // Convert seconds to hours
                    
                    // Calculate break time
                    $BreakTime = max(0, $totalHoursDecimal - $actualWorkingHours);
                    $BreakTimeHours = floor($BreakTime);
                    $BreakTimeMinutes = floor(($BreakTime - $BreakTimeHours) * 60);
                    $BreakTimeSeconds = round((((($BreakTime - $BreakTimeHours) * 60) - $BreakTimeMinutes) * 60));
                    $BreakTimeFormatted = sprintf("%02d h %02d min %02d sec", $BreakTimeHours, $BreakTimeMinutes, $BreakTimeSeconds);
                    
                    // Get total overtime for the selected month
                    $startDate = date('Y-m-01');
                    $endDate = date('Y-m-t');
                    $totalOvertime = DB::table('attendences as a')
                        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
                        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
                        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
                        ->select(DB::raw('SUM(TIMESTAMPDIFF(SECOND, ts.EndTime, a.punch_out)) as total_overtime_seconds'))
                        ->where('us.type', 4)
                        ->whereBetween('a.punch_date', [$startDate, $endDate])
                        ->whereNotNull('a.punch_out')
                        ->whereRaw('TIME(a.punch_out) > TIME(ts.EndTime)')
                        ->first();

                    // Convert total overtime seconds to hours, minutes, and seconds
                    $totalOvertimeSeconds = $totalOvertime->total_overtime_seconds;
                    $totalOvertimeInHours = floor($totalOvertimeSeconds / 3600);
                    $totalOvertimeInMinutes = floor(($totalOvertimeSeconds % 3600) / 60);
                    $totalOvertimeInSeconds = $totalOvertimeSeconds % 60;
                    $totalOvertimeFormatted = sprintf("%02d h %02d min %02d sec", $totalOvertimeInHours, $totalOvertimeInMinutes, $totalOvertimeInSeconds);
                    
                    // Calculate total time by summing production hours, break time, and overtime
                    $totalTimeDecimal = $actualWorkingHours + $BreakTime + ($totalOvertimeSeconds / 3600); // Convert overtime to hours
                    $totalTimeHours = floor($totalTimeDecimal);
                    $totalTimeMinutes = floor(($totalTimeDecimal - $totalTimeHours) * 60);
                    $totalTimeSeconds = round((((($totalTimeDecimal - $totalTimeHours) * 60) - $totalTimeMinutes) * 60));
                    $totalTimeFormatted = sprintf("%02d h %02d min %02d sec", $totalTimeHours, $totalTimeMinutes, $totalTimeSeconds);
                    
                    // Find job role
                    $jobrole = App\Models\Jobroles::find($row->jobrole_id);
                @endphp
                <tr>
                    <td>#{{ $row->emp_Id }}</td>
                    <td>{{ $row->punch_date }}</td>
                    <td>{{ $row->punch_in }}</td>
                    <td>{{ $row->punch_out }}</td>
                    <td>{{ $row->ts_working_hrs }}</td>
                    <td style="color:green">{{ $ProductionHoursFormatted }}</td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="8">No Record Found</td></tr>
        @endif
    </tbody>
</table>
            </div>
            
              <div style="width: 1%;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    // Radial Bar Chart

    /**
 * Charts Apex
 */

'use strict';

$(document).ready(function(){

  let cardColor, headingColor, labelColor, borderColor, legendColor;

  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    headingColor = config.colors_dark.headingColor;
    labelColor = config.colors_dark.textMuted;
    legendColor = config.colors_dark.bodyColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  }

    // Color constant
  const chartColors = {
    column: {
      series1: '#826af9',
      series2: '#d2b0ff',
      bg: '#f8d3ff'
    },
    donut: {
      series1: '#fee802',
      series2: '#3fd0bd',
      series3: '#826bf8',
      series4: '#2b9bf4'
    },
    area: {
      series1: '#29dac7',
      series2: '#60f2ca',
      series3: '#a5f8cd'
    }
  };
  // --------------------------------------------------------------------
  const radialBarChartEl = document.querySelector('#radialBarChart'),
    radialBarChartConfig = {
      chart: {
        height: 300,
        type: 'radialBar'
      },
      colors: [chartColors.donut.series1, chartColors.donut.series2, chartColors.donut.series4],
      plotOptions: {
        radialBar: {
          size: 170,
          hollow: {
            size: '60%'
          },
          track: {
            margin: 10,
            background: config.colors_label.secondary
          },
          dataLabels: {
            name: {
              fontSize: '2rem',
              fontFamily: 'Public Sans'
            },
            value: {
              fontSize: '1.2rem',
              color: legendColor,
              fontFamily: 'Public Sans'
            },
            total: {
              show: true,
              fontWeight: 800,
              fontSize: '1.3rem',
              color: headingColor,
              label: '{{$percentage}}%',
              formatter: function (w) {
                return 'in office';
              }
            }
          }
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: -25,
          bottom: 20
        }
      },
      legend: {
        show: false,
        position: 'bottom',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      stroke: {
        lineCap: 'round'
      },
      series: ["{{$percentage}}"],
      labels: ['Comments']
    };
  if (typeof radialBarChartEl !== undefined && radialBarChartEl !== null) {
    const radialChart = new ApexCharts(radialBarChartEl, radialBarChartConfig);
    radialChart.render();
  }
  
  // Horizontal Bar Chart
  // --------------------------------------------------------------------
 const horizontalBarChartEl = document.querySelector('#horizontalBarChart'),
    horizontalBarChartConfig = {
      chart: {
        height: 360,
        type: 'bar',
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: true,
          barHeight: '60%',
          distributed: true,
          startingShape: 'rounded',
          borderRadius: 7
        }
      },
      grid: {
        strokeDashArray: 10,
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: true
          }
        },
        yaxis: {
          lines: {
            show: false
          }
        },
        padding: {
          top: -35,
          bottom: -12
        }
      },

      colors: [
        config.colors.primary,
        config.colors.info,
        config.colors.success,
        config.colors.secondary,
        config.colors.danger,
        config.colors.warning
      ],
      dataLabels: {
        enabled: true,
        style: {
          colors: ['#fff'],
          fontWeight: 200,
          fontSize: '13px',
          fontFamily: 'Public Sans'
        },
        formatter: function (val, opts) {
          return horizontalBarChartConfig.labels[opts.dataPointIndex];
        },
        offsetX: 0,
        dropShadow: {
          enabled: false
        }
      },
      labels: {!! json_encode($months) !!},
      series: [
        {
          data: {!! json_encode($attendancePercentages) !!}
        }
      ],

      xaxis: {
        categories: ['6', '5', '4', '3', '2', '1'],
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
          },
          formatter: function (val) {
            return `${val}%`;
          }
        }
      },
      yaxis: {
        max: 35,
        labels: {
          style: {
            colors: [labelColor],
            fontFamily: 'Public Sans',
            fontSize: '13px'
          }
        }
      },
      tooltip: {
        enabled: true,
        style: {
          fontSize: '12px'
        },
        onDatasetHover: {
          highlightDataSeries: false
        },
        custom: function ({ series, seriesIndex, dataPointIndex, w }) {
          return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '%</span>' + '</div>';
        }
      },
      legend: {
        show: false
      }
    };
  if (typeof horizontalBarChartEl !== undefined && horizontalBarChartEl !== null) {
    const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
    horizontalBarChart.render();
  }
   $(document).ready(function() {
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
    });
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
                url: "{{ url('Employee/Attendence/filterAttendance/'.$id) }}",
                method: 'GET',
                data: { year: selectedYear, month: selectedMonth },
                success: function (data) {
                    // Handle the successful response
                    $('#tbody').empty(); // Clear previous content

                    if (data.length > 0) {
                        $('#tbody').html(data);
                    } else {
                        $('#tbody').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function () {
                    $('#result').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }

    const currentMonth = new Date().getMonth() + 1; 
    document.getElementById('months').value = currentMonth.toString().padStart(2, '0');
    
});
  </script>
@endsection