 
<?php $__env->startSection('title', 'Services'); ?> 
<?php $__env->startSection('content'); ?> 
<style>

  .status_color {

    background-color: red;

    width: 15px;

    height: 15px;

    border-radius: 50%;

    display: block;

    margin-right: 8px;

  }

</style>
<script src="../../public/assets/vendor/libs/apex-charts/apexcharts.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="py-3 mb-4">

    <span class="text-muted fw-light">Tickets /</span> Ticket Overview

  </h4>

  <div class="row">
    <div class="col-lg-6 col-sm-6 mb-4">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="fa-solid fa-clock"></i>
                        </span>
                    </div>
                    <h5 class="ms-1 mb-0">Select Duration</h5>
                </div>
                <form action="" method="GET">
                    <!--<label for="dateRangePickerStart" class="form-label">Date Range</label>-->
                    <div class="input-group input-daterange" id="bs-datepicker-daterange">
                        <input type="date" id="dateRangePickerStart" name="start_date" placeholder="MM/DD/YYYY" class="form-control" style="font-size: 14px;">
                        <span class="input-group-text">to</span>
                        <input type="date" id="dateRangePickerEnd" name="end_date" placeholder="MM/DD/YYYY" class="form-control" style="font-size: 14px;">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-3  col-xl-3 col-sm-6 mb-4">
        <div class="card h-100">
            <div class="card-body pb-0">
                <div class="card-icon">
                    <span class="badge bg-label-primary rounded-pill p-2">
                        <i class="ti ti-users ti-sm"></i>
                    </span>
                </div>
                <h5 class="mb-2 mt-2 card-title">Average Resolution Time</h5>
                <h5 class="mb-0"><?php echo e($averageResolutionTime); ?> Hrs</h5>
            </div>
            <div id="salesLastYear1" style="min-height: 90px;"></div>
        </div>
    </div>

    <div class="col-lg-3  col-xl-3 col-sm-6 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0">
                <span class="badge bg-label-success rounded-pill p-2">
                    <i class="ti ti-users ti-sm"></i>
                </span>
                <h5 class="mb-2 mt-2 card-title">Average Response Time</h5>
                <h5 class="mb-0"><?php echo e($averageResponseTime); ?> Hrs</h5>
            </div>
            <div class="card-body px-0" style="position: relative;">
                <div id="salesLastYear2" style="min-height: 123px;"></div>
            </div>
        </div>
    </div>
</div>

  <div class="row">

    <div class="col-12 col-xl-12 mb-4 order-1 order-lg-0">

      <div class="card">

        <div class="card-header d-flex justify-content-between">

          <div class="card-title m-0">

            <h4 class="mb-0">Ticket Volume</h4>

            <small class="text-muted">Yearly Earnings Overview</small>

          </div>

          <div class="dropdown">

            <button class="btn p-0" type="button" id="earningReportsTabsId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              <i class="ti ti-dots-vertical ti-sm text-muted"></i>

            </button>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsTabsId">

              <a class="dropdown-item" href="javascript:void(0);">View More</a>

              <a class="dropdown-item" href="javascript:void(0);">Delete</a>

            </div>

          </div>

        </div>

        <div class="card-body">

          <ul class="nav nav-tabs widget-nav-tabs pb-3 gap-4 mx-1 d-flex flex-nowrap" role="tablist">

            <li class="nav-item" role="presentation">

              <a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-orders-id" aria-controls="navs-orders-id" aria-selected="false" tabindex="-1">

                <div class="badge bg-label-secondary rounded p-2">

                  <i class="ti ti-shopping-cart ti-sm"></i>

                </div>

                <h6 class="tab-widget-title mb-0 mt-2">Open</h6>

              </a>

            </li>

            <li class="nav-item" role="presentation">

              <a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales-id" aria-controls="navs-sales-id" aria-selected="false" tabindex="-1">

                <div class="badge bg-label-secondary rounded p-2">

                  <i class="ti ti-chart-bar ti-sm"></i>

                </div>

                <h6 class="tab-widget-title mb-0 mt-2">In Progress</h6>

              </a>

            </li>

            <li class="nav-item" role="presentation">

              <a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center " role="tab" data-bs-toggle="tab" data-bs-target="#navs-profit-id" aria-controls="navs-profit-id" aria-selected="true">

                <div class="badge bg-label-secondary rounded p-2">

                  <i class="ti ti-currency-dollar ti-sm"></i>

                </div>

                <h6 class="tab-widget-title mb-0 mt-2">On-hold</h6>

              </a>

            </li>

            <li class="nav-item" role="presentation">

              <a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id" aria-controls="navs-income-id" aria-selected="false" tabindex="-1">

                <div class="badge bg-label-secondary rounded p-2">

                  <i class="ti ti-chart-pie-2 ti-sm"></i>

                </div>

                <h6 class="tab-widget-title mb-0 mt-2">Resolved</h6>

              </a>

            </li>

            <li class="nav-item" role="presentation">

              <a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#unanswered-income-id" aria-controls="navs-income-id" aria-selected="false" tabindex="-1">

                <div class="badge bg-label-secondary rounded p-2">

                  <i class="ti ti-chart-pie-2 ti-sm"></i>

                </div>

                <h6 class="tab-widget-title mb-0 mt-2">Unanswered</h6>

              </a>

            </li>

          </ul>

          <div class="tab-content p-0 ms-0 ms-sm-2">

            <div class="tab-pane fade active show" id="navs-orders-id" role="tabpanel" style="position: relative;">

              <div id="earningReportsTabsOrders"></div>

            </div>

            <div class="tab-pane fade" id="navs-sales-id" role="tabpanel" style="position: relative;">

              <div id="earningReportsTabsSales"></div>

            </div>

            <div class="tab-pane fade  " id="navs-profit-id" role="tabpanel" style="position: relative;">

              <div id="earningReportsTabsProfit"></div>

            </div>

            <div class="tab-pane fade" id="navs-income-id" role="tabpanel" style="position: relative;">

              <div id="earningReportsTabsIncome"></div>

            </div>

            <div class="tab-pane fade" id="unanswered-income-id" role="tabpanel" style="position: relative;">

              <div id="earningReportsTabsUnanswered"></div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-8">

      <div class="card">

        <div class="card-datatable table-responsive pt-0">

          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

            <div class="card-header flex-column flex-md-row">

              <div class="head-label text-center">

                <h5 class="card-title mb-0">Tickets List</h5>

              </div>

              <div class="dt-action-buttons text-end pt-3 pt-md-0">

                <div class="dt-buttons btn-group flex-wrap">

                  <!-- <div class="btn-group">

                    <button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2 waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">

                      <span>

                        <i class="ti ti-file-export me-sm-1"></i>

                        <span class="d-none d-sm-inline-block">Export</span>

                      </span>

                    </button>

                  </div> -->

                  <a class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" href="<?php echo e(url('/admin/Ticket/add')); ?>">

                    <span>

                      <i class="ti ti-plus me-sm-1"></i>

                      <span class="d-none d-sm-inline-block">Generate Ticket</span>

                    </span>

                  </a>

                </div>

              </div>

            </div>

            <!-- <div class="row">

              <div class="col-sm-12 col-md-6">

                <div class="dataTables_length" id="DataTables_Table_0_length">

                  <label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">

                    <option value="7">7</option>

                    <option value="10">10</option>

                    <option value="25">25</option>

                    <option value="50">50</option>

                    <option value="75">75</option>

                    <option value="100">100</option>

                  </select> entries </label>

                </div>

              </div>

              <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">

                <div id="DataTables_Table_0_filter" class="dataTables_filter">

                  <label>Search: <input type="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0">

                  </label>

                </div>

              </div>

            </div> -->

            <div class="inner_table" style="padding:0px 23px;">

              <table class="datatables-basic table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1215px;">

                <thead>

                  <tr>

                    <th ></th>

                    <th >Department Name</th>

                    <th >Count</th>

                    <th >Avg. time spent</th>

                    <!-- <th >Salary</th> -->

                    <!-- <th  >Status</th> -->

                  </tr>

                </thead>

              <tbody>
    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="odd">
        <td></td>
        <td>
            <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper"></div>
                <div class="d-flex flex-column">
                    <span class="emp_name text-truncate"><?php echo e($department->name); ?></span>
                </div>
            </div>
        </td>
        <td><?php echo e($department->tickets_count); ?></td>
        <td><?php echo e($department->average_time_spent); ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>


            </table></div>           

          </div>

        </div>

      </div>

    </div>



  </div>

</div>

</div>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
    // Assuming you have included jQuery properly

    // Function to initialize ApexCharts for earnings reports
    function EarningReportsBarChart(arrayData, highlightData, config) {
      const basicColor = config.colors_label.primary;
      const highlightColor = config.colors.primary;
      let colorArr = [];

      for (let i = 0; i < arrayData.length; i++) {
        colorArr.push(i === highlightData ? highlightColor : basicColor);
      }

      const earningReportBarChartOpt = {
        chart: {
          height: 258,
          type: 'bar',
          toolbar: {
            show: false
          }
        },
        plotOptions: {
          bar: {
            columnWidth: '32%',
            startingShape: 'rounded',
            borderRadius: 4,
            distributed: true,
            dataLabels: {
              position: 'top'
            }
          }
        },
        grid: {
          show: false,
          padding: {
            top: 0,
            bottom: 0,
            left: -10,
            right: -10
          }
        },
        colors: colorArr,
        dataLabels: {
          enabled: true,
          offsetY: -20,
          style: {
            fontSize: '15px',
            fontWeight: '500',
            fontFamily: 'Public Sans',
            colors: [config.colors.bodyColor]
          }
        },
        series: [{
          data: arrayData
        }],
        legend: {
          show: false
        },
        tooltip: {
          enabled: false
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
          axisBorder: {
            show: true,
            color: config.colors.borderColor
          },
          axisTicks: {
            show: false
          },
          labels: {
            style: {
              colors: config.colors.textMuted,
              fontSize: '13px',
              fontFamily: 'Public Sans'
            }
          }
        },
        yaxis: {
          labels: {
            offsetX: -15,
            formatter: function(val) {
              return parseInt(val / 1);
            },
            style: {
              fontSize: '13px',
              colors: config.colors.textMuted,
              fontFamily: 'Public Sans'
            },
            min: 0,
            max: 60000,
            tickAmount: 6
          }
        },
        responsive: [{
          breakpoint: 1441,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '41%'
              }
            }
          }
        }, {
          breakpoint: 590,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '61%',
                borderRadius: 5
              }
            },
            yaxis: {
              labels: {
                show: false
              }
            },
            grid: {
              padding: {
                right: 0,
                left: -20
              }
            },
            dataLabels: {
              style: {
                fontSize: '12px',
                fontWeight: '400'
              }
            }
          }
        }]
      };

      return earningReportBarChartOpt;
    }

    // Assuming `config` and `$ticketCounts` are properly defined
    const earningReportsChart = <?php echo $ticketCounts; ?>;

    // Render charts for each tab
    function renderChart(elId, dataIdx, activeOptionIdx) {
      const chartEl = document.querySelector(elId);
      if (chartEl) {
        const chartConfig = EarningReportsBarChart(
          earningReportsChart['data'][dataIdx]['chart_data'],
          activeOptionIdx,
          config
        );
        const chart = new ApexCharts(chartEl, chartConfig);
        chart.render();
      }
    }

    renderChart('#earningReportsTabsOrders', 0, 0);
    renderChart('#earningReportsTabsSales', 1, 0);
    renderChart('#earningReportsTabsProfit', 2, 0);
    renderChart('#earningReportsTabsIncome', 3, 0);
    renderChart('#earningReportsTabsUnanswered', 4, 0);

});

    // Subscriber Gained chart
  document.addEventListener("DOMContentLoaded", function() {
      
    let cardColor, labelColor, shadeColor, legendColor, borderColor;
  
    cardColor = config.colors.cardColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
    shadeColor = '';
  

    

    // Example configuration for subscriber gained chart
    // Sales last year Area Chart
  // --------------------------------------------------------------------
  const salesLastYearEl1 = document.querySelector('#salesLastYear1'),
    salesLastYearConfig1 = {
      chart: {
        height: 78,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      markers: {
        colors: 'transparent',
        strokeColors: 'transparent'
      },
      grid: {
        show: false
      },
      colors: [config.colors.success],
      fill: {
        type: 'gradient',
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.8,
          opacityFrom: 0.6,
          opacityTo: 0.25
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      series: [
        {
          data: <?php echo e($resolutionTimesJson); ?>

        }
      ],
      xaxis: {
        show: true,
        lines: {
          show: false
        },
        labels: {
          show: false
        },
        stroke: {
          width: 0
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        stroke: {
          width: 0
        },
        show: false
      },
      tooltip: {
        enabled: false
      }
    };
  if (typeof salesLastYearEl1 !== undefined && salesLastYearEl1 !== null) {
    const salesLastYear = new ApexCharts(salesLastYearEl1, salesLastYearConfig1);
    salesLastYear.render();
  }

    // Example configuration for average daily sales chart
    // Sales last year Area Chart
  // --------------------------------------------------------------------
  const salesLastYearEl = document.querySelector('#salesLastYear2'),
    salesLastYearConfig = {
      chart: {
        height: 78,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      markers: {
        colors: 'transparent',
        strokeColors: 'transparent'
      },
      grid: {
        show: false
      },
      colors: [config.colors.success],
      fill: {
        type: 'gradient',
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.8,
          opacityFrom: 0.6,
          opacityTo: 0.25
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      series: [
        {
          data: <?php echo e($responseTimesJson); ?>

        }
      ],
      xaxis: {
        show: true,
        lines: {
          show: false
        },
        labels: {
          show: false
        },
        stroke: {
          width: 0
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        stroke: {
          width: 0
        },
        show: false
      },
      tooltip: {
        enabled: false
      }
    };
  if (typeof salesLastYearEl !== undefined && salesLastYearEl !== null) {
    const salesLastYear = new ApexCharts(salesLastYearEl, salesLastYearConfig);
    salesLastYear.render();
  }
  });
 
 

</script>

 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Ticket/overview.blade.php ENDPATH**/ ?>