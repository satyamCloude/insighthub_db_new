@extends('layouts.admin')
@section('title', 'Leave')
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leave /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
   <div class="alert alert-success" role="alert" id="ResMsg" style="display:none;"></div>
     
   

    <div class="card">
    <div class="row">
    
           <div class="card-body">
          <div class="row g-4 mb-4">
           
            <div class="col-sm-3 col-xl-3">
              <div class="card bg-info text-white">
              <div class="text-end p-1">
                <!--<a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
              </div>
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                      <h4 class="text-white">Total Leave</h4>
                      <p class="text-white mt-3">{{$unapproveCount+$approveCount}}</p>
                  </div>
                </div>
              </div>
            </div>    
            
            <div class="col-sm-3 col-xl-3">
              <div class="card bg-success text-white">
              <div class="text-end p-1">
                <!--<a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
              </div>
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                      <h4 class="text-white">Approved</h4>
                      <p class="text-white mt-3">{{$approveCount}}</p>
                  </div>
                </div>
              </div>
            </div>       <div class="col-sm-3 col-xl-3">
              <div class="card bg-warning text-white">
              <div class="text-end p-1">
                <!--<a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
              </div>
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                      <h4 class="text-white">Pending</h4>
                      <p class="text-white mt-3">{{$PendingCount}}</p>
                  </div>
                </div>
              </div>
            </div>     
                
                
                  <div class="col-sm-3 col-xl-3">
              <div class="card bg-danger text-white">
              <div class="text-end p-1">
                <!--<a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
              </div>
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                      <h4 class="text-white">Unapproved</h4>
                      <p class="text-white mt-3">{{$unapproveCount}}</p>
                  </div>
                </div>
              </div>
            </div>  
             <div class="col-sm-3 col-xl-3">
                   <a href="{{url('admin/Leave/home2')}}"  target="_blank" class="btn btn-label-primary me-3">
                <span class="align-middle"> New Leave Page</span>
              </a>
                <a href="{{url('Employee/Leave/add')}}" class="btn btn-primary mt-3 m-3">Add Leave</a>
            </div>
            
          </div>
             
      </div>
    </div>
    </div>
    
    
  <!-- Users List Table -->
  
        <div class="row  mt-4">
             
             <div class="col-xl-4 col-6 mb-4">
                      <div class="card">
                        <div class="card-header header-elements">
                          <h5 class="card-title mb-0">Current Month leave pattern</h5>
                          <div class="card-action-element ms-auto py-0">
                            <div class="dropdown">
                              <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-calendar"></i>
                              </button>
                              <!--<ul class="dropdown-menu dropdown-menu-end">-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <hr class="dropdown-divider">-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a>-->
                              <!--  </li>-->
                              <!--</ul>-->
                            </div>
                          </div>
                        </div>
                          <div class="card-body" style="position: relative;">
                             <div id="donutChart" style="min-height: 357.7px;">
                        </div>
                      </div>
                      </div>
        </div>
        <!--     <div class="col-xl-4 col-6 mb-4">-->
        <!--              <div class="card">-->
        <!--                <div class="card-header header-elements">-->
        <!--                  <h5 class="card-title mb-0">Weekly leave pattern</h5>-->
        <!--                  <div class="card-action-element ms-auto py-0">-->
        <!--                    <div class="dropdown">-->
        <!--                      <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">-->
        <!--                        <i class="ti ti-calendar"></i>-->
        <!--                      </button>-->
        <!--                      <ul class="dropdown-menu dropdown-menu-end">-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <hr class="dropdown-divider">-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a>-->
        <!--                        </li>-->
        <!--                      </ul>-->
        <!--                    </div>-->
        <!--                  </div>-->
        <!--                </div>-->
        <!--                <div class="card-body">-->
        <!--                  <canvas id="barChart" class="chartjs" data-height="400" height="500" style="display: block; box-sizing: border-box; height: 400px; width: 545px;" width="682"></canvas>-->
        <!--                </div>-->
        <!--              </div>-->
        <!--</div>-->
        
    </div>
    
    
      <!--dynamic leave type data-->
      
      
    <!--     <div class="card">-->
    <!--<div class="row">-->
    <!--  <div class="col-md-6 ">-->
    <!--      <h5 class="card-header">Leave Type</h5>-->
    <!--  </div>-->
    <!--  <div class="col-md-6 text-end">-->
    <!--      <button class="btn btn-primary waves-effect waves-light mt-3 m-3" data-bs-toggle="modal" data-bs-target="#backDropModal">Add Type</button>-->
    <!--      <a href="{{url('admin/Leave/home2')}}"  target="_blank" class="btn btn-label-primary me-3">-->
    <!--            <span class="align-middle"> New Leave Page</span>-->
    <!--          </a>-->
    <!--  </div>-->
    <!--</div>-->
    <!--  <div class="card-body">-->
    <!--    @if(count($LeaveType) > 0)-->
    <!--      <div class="row g-4 mb-4">-->
    <!--        @foreach($LeaveType as $key=> $Lea)-->
    <!--        <div class="col-sm-6 col-xl-3">-->
    <!--          <div class="card bg-{{$Lea->theme}} text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            <a id="{{$Lea->id}}" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--            <a class="delete_debtcase" url="{{url('admin/LeaveType/delete/'.$Lea->id)}}" id="{{$Lea->id}}" style="cursor: pointer;"><i class="ti ti-trash ti-sm"></i></a>-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">{{$Lea->leave_type}}</h4>-->
    <!--                  <p class="text-white mt-3">{{$Lea->no_of_leave}}</p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>         -->
    <!--        @endforeach-->
    <!--      </div>-->
    <!--          @else-->
    <!--          <div class="text-center" style="border-bottom: 1px solid #dbdade;border-top: 1px solid #dbdade;">-->
    <!--            <p class="p-2" >No Data Found</p>-->
    <!--          </div>-->
    <!--          @endif-->
    <!--  </div>-->
    <!--</div>-->
    
          <!--dynamic leave type data end -->

    
    <div class="col-xl-6 mb-4 mb-xl-0">
      <div class="card">
        <h5 class="card-header">My Leaves</h5>
        <div class="card-body pb-0">
          <ul class="timeline mb-0">
              @if($myleaves)
              @foreach($myleaves as $myleave)
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                  <h6 class="mb-0">29 September 2023 - 30 September 2023</h6>
                  @php
                      if($myleave->status == 1){
                       $color = 'success';
                        $status = 'APPROVED';
                        }
                        elseif($myleave->status == 2){
                        $color = 'danger';
                        $status = 'UNAPPROVED';
                        }
                        elseif($myleave->status == 3){
                        $color = 'warning';
                         $status = 'PENDING';
                         }
                  @endphp
                  
                  <button class="btn btn-{{$color}} waves-effect waves-light" style="
    padding: 6px 5px;
    margin-bottom: 9px;
">{{$status}}</button>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-2">
                  <div class="d-flex align-items-center">
                    <span>{!! $myleave->description !!}</span>
                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                    <span>{{$myleave->leave_type}}</span>
                  </div>
                  <div>
                    <span class="text-muted">{{$myleave->created_at}}</span>
                  </div>
                </div>
                <!--<div class="d-flex align-items-center">-->
                <!--  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">-->
                <!--  <span class="mb-0">bookingCard.pdf</span>-->
                <!--</div>-->
              </div>
            </li>
            @endforeach
            @endif
          
          </ul>
        </div>
      </div>
    </div>
    <!-- /Timeline Basic -->
    </div>
    </div>
<!--Modal type leave-->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <form class="modal-content" action="{{url('Employee/LeaveType/store')}}" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Leave Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="col mb-0">
            <label for="leave_type" class="form-label">Type <span class="text-danger">*</span></label>
            <input type="text" name="leave_type" class="form-control" placeholder="Enter Leave type"required>
          </div>
          <div class="col mb-0">
            <label for="no_of_leave" class="form-label">Number of Leave <span class="text-danger">*</span></label>
            <input type="number" name="no_of_leave" class="form-control"required>
          </div>
        </div>
        <div class="row mt-3">
            <label for="leave_type" class="form-label">Theme <span class="text-danger">*</span></label>
          <div class="col-md-6">
            <div class="form-check form-check-primary">
              <input class="form-check-input" required  type="radio" name="theme" value="primary" id="customCheckPrimary">
              <label class="form-check-label" for="customCheckPrimary"><span class="text-primary">Primary</span></label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-secondary">
              <input class="form-check-input" required  type="radio" name="theme" value="secondary" id="customCheckSecondary">
              <label class="form-check-label" for="customCheckSecondary"><span class="text-secondary">Secondary</span></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-success">
              <input class="form-check-input" required  type="radio" name="theme" value="success" id="customCheckSuccess">
              <label class="form-check-label" for="customCheckSuccess"><span class="text-success">Success</span></label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-danger">
              <input class="form-check-input" required  type="radio" name="theme" value="danger" id="customCheckDanger">
              <label class="form-check-label" for="customCheckDanger"><span class="text-danger">Danger</span></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-warning">
              <input class="form-check-input" required  type="radio" name="theme" value="warning" id="customCheckWarning">
              <label class="form-check-label" for="customCheckWarning"><span class="text-warning"> Warning</span> </label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-info">
              <input class="form-check-input" required  type="radio" name="theme" value="info" id="customCheckInfo">
              <label class="form-check-label" for="customCheckInfo"><span class="text-info"> Info</span> </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-dark">
              <input class="form-check-input" required  type="radio" name="theme" value="dark" id="customCheckDark">
              <label class="form-check-label" for="customCheckDark"><span class="text-dark"> Dark</span> </label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
      </div>
    </form>
  </div>
</div>
<!--Modal type leave End-->
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog"></div>
<script>
  function editCategory(element) {
      var cate_id = $(element).attr('id');

      $.ajax({
          url: "{{ url('Employee/LeaveType/edit') }}",
          method: 'GET',
          data: { id: cate_id },
          success: function (data) {
              if (data && typeof data == 'string') {
                  $('#showedit').html(data);
                  $('#showedit').modal('show');
              } else {
                  $('#showedit').html('<div>No Data Found</div>');
                  $('#showedit').modal('show');
              }
          },
          error: function () {
              $('#showedit .modal-content').html('<div>Error fetching data.</div>');
              $('#showedit').modal('show');
          }
      });
  }
</script>
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
                url: "{{ url('Employee/Leave/Show_leaves_yeardata') }}",
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

         // Donut Chart
  // --------------------------------------------------------------------
  
  
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
    series4: '#2b9bf4',
    series5: '#ff8c00' // New color for series5
  },
  area: {
    series1: '#29dac7',
    series2: '#60f2ca',
    series3: '#a5f8cd'
  }
};
  
  const leaveTypePercentages = [@foreach($LeaveType as $type){{$leaveTypePercentages[$type->id]}},@endforeach];
const leaveTypeLabels = [@foreach($LeaveType as $type)'{{$type->leave_type}}',@endforeach];

const totalPercentage = {{$totalPercentage}};


  const donutChartEl = document.querySelector('#donutChart'),
    donutChartConfig = {
      chart: {
        height: 390,
        type: 'donut'
      },
       labels: leaveTypeLabels,
        series: leaveTypePercentages,
      colors: [
    chartColors.donut.series1,
    chartColors.donut.series5, // Include the new color for series5
    chartColors.donut.series4,
    chartColors.donut.series3,
    chartColors.donut.series2
  ],
      stroke: {
        show: false,
        curve: 'straight'
      },
      dataLabels: {
        enabled: true,
        formatter: function (val, opt) {
          return parseInt(val, 10) + '%';
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        markers: { offsetX: -3 },
        itemMargin: {
          vertical: 3,
          horizontal: 10
        },
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              name: {
                fontSize: '2rem',
                fontFamily: 'Public Sans'
              },
            value: {
    fontSize: '1.2rem',
    color: legendColor,
    fontFamily: 'Public Sans',
    formatter: function (val) {
        return parseFloat(val).toFixed(17) + '%';
    }
},
total: {
    show: true,
    fontSize: '1.5rem',
    color: headingColor,
    label: 'Total Leaves',
    formatter: function (w) {
        return parseFloat(totalPercentage).toFixed(2) + '%';
    }
}

            }
          }
        }
      },
      responsive: [
        {
          breakpoint: 992,
          options: {
            chart: {
              height: 380
            },
            legend: {
              position: 'bottom',
              labels: {
                colors: legendColor,
                useSeriesColors: false
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            chart: {
              height: 320
            },
            plotOptions: {
              pie: {
                donut: {
                  labels: {
                    show: true,
                    name: {
                      fontSize: '1.5rem'
                    },
                    value: {
                      fontSize: '1rem'
                    },
                    total: {
                      fontSize: '1.5rem'
                    }
                  }
                }
              }
            },
            legend: {
              position: 'bottom',
              labels: {
                colors: legendColor,
                useSeriesColors: false
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            chart: {
              height: 280
            },
            legend: {
              show: false
            }
          }
        },
        {
          breakpoint: 360,
          options: {
            chart: {
              height: 250
            },
            legend: {
              show: false
            }
          }
        }
      ]
    };
  if (typeof donutChartEl !== undefined && donutChartEl !== null) {
    const donutChart = new ApexCharts(donutChartEl, donutChartConfig);
    donutChart.render();
  }
    });

function LeaveStatusUpdate(status, empId, LeaveId, RoleID, ApproveID, AuthRole,days) {
    $.ajax({
        url: "{{ url('Employee/Leave/LeaveStatusUpdate') }}",
        method: 'POST', // Assuming you want to send data with POST request
        data: {
            _token: '{{ csrf_token() }}', // Include the CSRF token
            status: status,
            empId: empId,
            LeaveId: LeaveId,
            RoleID: RoleID,
            ApproveID: ApproveID,
            AuthRole: AuthRole,
            days: days,
        },
        success: function (response) {
            if (response.success == true) {
                $('#ResMsg').show().html(response.message);

                // Hide #ResMsg after 3 seconds
                setTimeout(function () {
                    $('#ResMsg').hide(500);
                }, 3000);
            }
        },
        error: function () {
            alert("Oops! Some technical error occurred.");
        }
    });
}

</script>

@endsection