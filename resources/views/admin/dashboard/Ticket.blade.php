<div class="row g-4 mb-4 TicketScreen">
      <div class="col-sm-6 col-xl-6" style="130px">
         <a class="text-dark" href="{{url('admin/Client/home')}}">
            <div class="card" style="height:100%">
               <div class="card-body">
                  <div class="d-flex">
                     <div class="content-left">
                        <span>Tickets</span>
                        <div class="d-flex my-4 mb-0">
                        <a href="javascript:;" class="total-employees" data-status="open"><p class="mb-0 f-15 font-weight-bold text-blue d-grid mr-5">
                           {{$Open}}
                            <span class="f-12 font-weight-normal text-lightest">
                             <p class="mb-0 text-dark">Total Tickets</p>

                                
                             </span></p></a>

                        <a href="javascript:;" style="margin-left: 50px;" class="total-new-employees" data-status="resolved"><p class="mb-0 f-15 font-weight-bold text-dark-green d-grid ml-3">
                            {{$InProgress}}<span class="f-12 font-weight-normal text-lightest">
                           
                             <p class="mb-0 text-dark"> In-Progress Tickets</p>

                         </span></p></a>
                    </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-xl-6" style="130px">
         <a class="text-dark" href="{{url('admin/Client/home')}}">
            <div class="card" style="height:100%">
               <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                     <div class="content-left">
                        <span>Pending Ticket</span>
                        <div class="d-flex align-items-center my-2">
                           <h3 class="mb-0 me-2"></h3>
                           <!-- <p class="text-success mb-0">0</p> -->
                        </div>
                        <p class="mb-0 my-4">{{$Pending}}</p>
                     </div>
                     <div class="">
                        <span class="">
                        <i class="fas fa-ticket-alt mt-3"></i>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>

    <div class="col-12 col-xl-6 mb-4 order-1 order-lg-0 mt-4">

      <div class="card">

        <div class="card-header d-flex justify-content-between">

          <div class="card-title m-0">

            <strong >Ticket Volume</strong><br/>

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

    <div class="col-lg-6">

      <div class="card table-height" style="height:507px">

        <div class="card-datatable table-responsive pt-0">

          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

            <div class="card-header flex-column flex-md-row">

              <div class="head-label text-center">

                <strong class="card-title mb-0">Tickets List</strong>

              </div>

              <div class="dt-action-buttons text-end pt-3 pt-md-0">

                <div class="dt-buttons btn-group flex-wrap">

               

                  <a class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" href="{{url('/admin/Ticket/add')}}">

                    <span>

                      <i class="ti ti-plus me-sm-1"></i>

                      <span class="d-none d-sm-inline-block">Add New Record</span>

                    </span>

                  </a>

                </div>

              </div>

            </div>


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
                  @foreach($departments as $department)
                  <tr class="odd">

                    <td ></td>

                    <td>

                      <div class="d-flex justify-content-start align-items-center user-name">

                        <div class="avatar-wrapper">

                        </div>

                        <div class="d-flex flex-column">

                          <span class="emp_name text-truncate">{{$department->name}}</span>

                          <!-- <small class="emp_post text-truncate text-muted">Software Test Engineer</small> -->

                        </div>

                      </div>

                    </td>

                    <td>{{$department->tickets_count}}</td>

                    <td>1h 52m</td>

                    <!-- <td>$24973.48</td> -->

                   <!--  <td>

                      <span class="badge  bg-label-success">Professional</span>

                    </td> -->

                  </tr>
                  @endforeach
                </tbody>

            </table></div>           

          </div>

        </div>

      </div>

    </div>
  <div class="col-lg-6 col-sm-6 col-xl-6" style="height:370px">

      <div class="card table-height" style="height:100%">

        <div class="card-datatable table-responsive pt-0">

          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <strong >Status Wise Ticket</strong>
        </div>
        <div class="inner_table" style="padding:0px 23px;">

              <table class="datatables-basic table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1215px;">

                <thead>
                    <tr>
                        <th>Ticket Id</th>
                        <th>Ticket Subject</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if(count($LTicket) > 0)
                        @foreach($LTicket as $ticket)
                            <tr>
                                <td><a href="{{ url('admin/Ticket/home') }}" type="button"># {{ $ticket->id }}</a></td>
                                <td>{{ $ticket->subject }}</td>
                                <td>
                                    @if($ticket->status == 1)
                                        <span class="badge bg-label-success me-1">Open</span>
                                    @elseif($ticket->status == 2)
                                        <span class="badge bg-label-primary me-1">InProgress</span>
                                    @elseif($ticket->status == 3)
                                        <span class="badge bg-label-info me-1">Pending</span>
                                    @elseif($ticket->status == 4)
                                        <span class="badge bg-label-danger me-1">OnHold</span>
                                    @elseif($ticket->status == 5)
                                        <span class="badge bg-label-secondary me-1">Resolved</span>
                                    @elseif($ticket->status == 6)
                                        <span class="badge bg-label-warning me-1">Closed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="shadow-none">
                                <div class="align-items-center d-flex flex-column text-lightest p-20 w-100">
                                    <i class="fa-solid fa-list-check"></i>
                                    <div class="f-15 mt-4">- No record found. -</div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
</div>

<div class="col-sm-6 col-xl-6" style="height:370px">
    <div class="card bg-white border-0 b-shadow-4 table-height" style="height:100%">
        <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <strong >InProgress-Ticket</strong>
        </div>
        <div class="card-body p-0 h-200" style="display: block; overflow: overlay;">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th>Ticket Id</th>
                        <th>Subject</th>
                        <th>Assign to</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if(count($InProgressTicket) > 0)
                        @foreach($InProgressTicket as $ticket)
                            <tr>
                                <td><a href="{{ url('admin/Ticket/home') }}" type="button"># {{ $ticket->id }}</a></td>
                                <td>{{ $ticket->subject }}</td>
                                <td>
                                    @if($ticket->ccid)
                                        <div class="parent d-flex">
                                            <div class="child1">
                                                @if($ticket->profile_img)
                                                    <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" src="{{ $ticket->profile_img }}" height="30" width="30" alt="User avatar" />
                                                @else
                                                    <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" src="{{ url('public/images/21104.png') }}" height="30" width="30" alt="User avatar" />
                                                @endif
                                            </div>
                                            <div class="child2">
                                                {{ $ticket->first_name }} {{ $ticket->last_name }} | {{ $ticket->ccid }}<br>
                                                <span style="color:#6e6c76; font-size:85%">({{ $ticket->job_role_name }})</span>
                                            </div>
                                        </div>
                                    @else
                                        --
                                    @endif
                                </td>
                                <td>
                                    @if($ticket->status == 2)
                                        <span class="badge bg-label-primary me-1">InProgress</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="shadow-none">
                                <div class="align-items-center d-flex flex-column text-lightest p-20 w-100">
                                    <i class="fa-solid fa-list-check"></i>
                                    <div class="f-15 mt-4">- No record found. -</div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

      <div class="col-sm-6 col-xl-6" style="height:370px">
    <div class="card bg-white border-0 b-shadow-4 table-height" style="height:100%">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <strong >Pending Ticket</strong>
               </div>
               <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
                 <table class="table table-sm">
                     <thead>
                        <tr>
                           <th>Ticket Id</th>
                           <th>Subject</th>
                           <th>Assign to</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                         @if(count($PendingTicket) > 0)
                        @foreach($PendingTicket as $key => $PendingTicket)
                        <tr>
                                                     <td>           <a href="{{url('admin/Ticket/home')}}" type="button"># {{ $PendingTicket->id }}</a></td>
                           <td>@if($PendingTicket && $PendingTicket->subject) {{ $PendingTicket->subject }} @endif</td>
                           <td>
                               
                               @if($PendingTicket && $PendingTicket->ccid) 
                              <div class="parent d-flex">
                                            <div class="child1">
                                                 @if($PendingTicket->profile_img)
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$PendingTicket->profile_img}}" height="30" width="30" alt="User avatar" />
                                                    @else
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                    @endif
                                            </div>
                                            <div class="child2">
                                                  {{$PendingTicket->first_name }} {{$PendingTicket->last_name }} | {{$PendingTicket->ccid }} <br> <span style="color:#6e6c76;font-size:85%">({{$PendingTicket->job_role_name }})</span>
                                            </div>
                                        </div>
                                        @else
                                        --
                                       @endif
                           
                           </td>
                           <td>
                                 @if($PendingTicket->status == 3)
                                 <span class="badge bg-label-info me-1">Pending</span>
               
                                 @endif
                              </td>
                        </tr>
                        @endforeach
                         @else
                         <tr>
                            <td colspan="4" class="shadow-none">
                              <div class="align-items-center d-flex flex-column text-lightest p-20 w-100 my-5">
                                <i class="fa-solid fa-list-check"></i>
                                  <div class="f-15 mt-4">
                                      - No record found. -
                                  </div>
                              </div>
                            </td>
                          </tr>
                     @endif
                     </tbody>
                  </table>
               </div>
            </div>
      </div>
      <div class="col-sm-6 col-xl-6" style="height:370px">
    <div class="card bg-white border-0 b-shadow-4 table-height" style="height:100%">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <strong >Open Tickets</strong>
               </div>
              <div class="card-body p-0 h-200" style="display: block;overflow: overlay;">
                 <table class="table table-sm">
                     <thead>
                        <tr>
                           <th>Ticket Id</th>
                           <th>Subject</th>
                           <th>Assign to</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                        @foreach($OpenTicket as $key => $lst)
                        <tr>
                            <td> <a href="{{url('admin/Ticket/home')}}" type="button"># {{ $lst->id }}</a></td>
                           <td>@if($lst && $lst->subject) {{ $lst->subject }} @endif</td>
                            <td>
                               @if($lst && $lst->emp_id) 
                              <div class="parent d-flex">
                                            <div class="child1">
                                                 @if($lst->profile_img)
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{$lst->profile_img}}" height="30" width="30" alt="User avatar" />
                                                    @else
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                                                    @endif
                                            </div>
                                            <div class="child2">
                                                  {{$lst->first_name }} {{$lst->last_name }} | {{$lst->emp_id }} <br> <span style="color:#6e6c76;font-size:85%">({{$lst->job_role_name }})</span>
                                            </div>
                                        </div>
                                        @else
                                        --
                                       @endif
                           </td>
                          <td>
                                 @if($lst->status == 1)
                                 <span class="badge bg-label-info me-1">Open</span>
               
                                 @endif
                              </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
            </div>
         </div>
      </div>
</div>

<script epartment ="text/javascript">

   // Earning Reports Tabs Function
  function EarningReportsBarChart(arrayData, highlightData) {

    let cardColor, headingColor, legendColor, labelColor, borderColor;
    
      cardColor = config.colors.cardColor;
      labelColor = config.colors.textMuted;
      legendColor = config.colors.bodyColor;
      headingColor = config.colors.headingColor;
      borderColor = config.colors.borderColor;
    

    const basicColor = config.colors_label.primary,
      highlightColor = config.colors.primary;
    var colorArr = [];

    for (let i = 0; i < arrayData.length; i++) {
      if (i === highlightData) {
        colorArr.push(highlightColor);
      } else {
        colorArr.push(basicColor);
      }
    }

    const earningReportBarChartOpt = {
      chart: {
        height: 258,
        parentHeightOffset: 0,
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
        formatter: function (val) {
          return val;
        },
        offsetY: -20,
        style: {
          fontSize: '15px',
          colors: [legendColor],
          fontWeight: '500',
          fontFamily: 'Public Sans'
        }
      },
      series: [
        {
          data: arrayData
        }
      ],
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
          color: borderColor
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px',
            fontFamily: 'Public Sans'
          }
        }
      },
      yaxis: {
        labels: {
          offsetX: -15,
          formatter: function (val) {
            return parseInt(val / 1);
          },
          style: {
            fontSize: '13px',
            colors: labelColor,
            fontFamily: 'Public Sans'
          },
          min: 0,
          max: 60000,
          tickAmount: 6
        }
      },
      responsive: [
        {
          breakpoint: 1441,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '41%'
              }
            }
          }
        },
        {
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
        }
      ]
    };
    return earningReportBarChartOpt;
  }
  var chartJson = 'earning-reports-charts.json';
  // Earning Chart JSON data
 var earningReportsChart = {!! $ticketCounts !!};
  console.log(earningReportsChart);
  // Earning Reports Tabs Orders
  // --------------------------------------------------------------------
  const earningReportsTabsOrdersEl = document.querySelector('#earningReportsTabsOrders'),
    earningReportsTabsOrdersConfig = EarningReportsBarChart(
      earningReportsChart['data'][0]['chart_data'],
      earningReportsChart['data'][0]['active_option']
    );
  if (typeof earningReportsTabsOrdersEl !== undefined && earningReportsTabsOrdersEl !== null) {
    const earningReportsTabsOrders = new ApexCharts(earningReportsTabsOrdersEl, earningReportsTabsOrdersConfig);
    earningReportsTabsOrders.render();
  }
  // Earning Reports Tabs Sales
  // --------------------------------------------------------------------
  const earningReportsTabsSalesEl = document.querySelector('#earningReportsTabsSales'),
    earningReportsTabsSalesConfig = EarningReportsBarChart(
      earningReportsChart['data'][1]['chart_data'],
      earningReportsChart['data'][1]['active_option']
    );
  if (typeof earningReportsTabsSalesEl !== undefined && earningReportsTabsSalesEl !== null) {
    const earningReportsTabsSales = new ApexCharts(earningReportsTabsSalesEl, earningReportsTabsSalesConfig);
    earningReportsTabsSales.render();
  }
  // Earning Reports Tabs Profit
  // --------------------------------------------------------------------
  const earningReportsTabsProfitEl = document.querySelector('#earningReportsTabsProfit'),
    earningReportsTabsProfitConfig = EarningReportsBarChart(
      earningReportsChart['data'][2]['chart_data'],
      earningReportsChart['data'][2]['active_option']
    );
  if (typeof earningReportsTabsProfitEl !== undefined && earningReportsTabsProfitEl !== null) {
    const earningReportsTabsProfit = new ApexCharts(earningReportsTabsProfitEl, earningReportsTabsProfitConfig);
    earningReportsTabsProfit.render();
  }
  // Earning Reports Tabs Income
  // --------------------------------------------------------------------
  const earningReportsTabsIncomeEl = document.querySelector('#earningReportsTabsIncome'),
    earningReportsTabsIncomeConfig = EarningReportsBarChart(
      earningReportsChart['data'][3]['chart_data'],
      earningReportsChart['data'][3]['active_option']
    );
  if (typeof earningReportsTabsIncomeEl !== undefined && earningReportsTabsIncomeEl !== null) {
    const earningReportsTabsIncome = new ApexCharts(earningReportsTabsIncomeEl, earningReportsTabsIncomeConfig);
    earningReportsTabsIncome.render();
  }
   //  Earning Reports Tabs Income
  // --------------------------------------------------------------------
  const earningReportsTabsUnanswered = document.querySelector('#earningReportsTabsUnanswered'),
    earningReportsTabsUnansweredConfig = EarningReportsBarChart(
      earningReportsChart['data'][4]['chart_data'],
      earningReportsChart['data'][4]['active_option']
    );
  if (typeof earningReportsTabsUnanswered !== undefined && earningReportsTabsUnanswered !== null) {
    const earningReportsTabsIncome = new ApexCharts(earningReportsTabsUnanswered, earningReportsTabsUnansweredConfig);
    earningReportsTabsIncome.render();
  }

</script>