@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<!-- Content -->

<div id="toast-container" class="toast-top-right">
  <div class="toast toast-success" aria-live="polite">
    <div class="toast-progress" style="width: 0%;"></div>
    <div class="toast-message">
      <i class="fas fa-hand-peace"></i>  Welcome To CloudTechtiq !
    </div>
  </div>
</div>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- CLOCK IN CLOCK OUT START -->
      <div class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 m mt-4 mt-lg-0 mt-md-0 justify-content-between">
        <p class="mb-0 text-lg-right text-md-right f-18 font-weight-bold text-dark-grey d-grid align-items-center text-end" style="padding-right:15px;">
          <input type="hidden" id="current-latitude" name="current_latitude" autocomplete="off">
          <input type="hidden" id="current-longitude" name="current_longitude" autocomplete="off">
          <span class="f-10 font-weight-light">{{ \Carbon\Carbon::now()->format('l')}}</span>
          <span id="dashboard-clock" style="font-weight: 700;">{{ \Carbon\Carbon::now()->format('h:i A') }}</span>
          <span class="f-11 font-weight-normal text-lightest" style="color:#b4b2bb !important;">
            Clock In at -
            <span>@if($CheckInTime && $CheckInTime->punch_in) {{ \Carbon\Carbon::parse($CheckInTime->punch_in)->format('h:i A') }}@else 00:00:00  @endif</span>

          </span>
        </p>
        @if(Auth::user()->clock_status == 1)
         <button type="button" class="btn-primary rounded f-15 ml-4" id="clockin1" value="clockin" onclick="clock({{auth()->id()}},value)" 
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>
        </button>
        @else
        <button type="button" class="btn-danger rounded f-15 ml-4" id="clockout1" value="clockout" onclick="clock({{auth()->id()}},value)"
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>
        </button>
        @endif
        <button type="button" class="btn-danger rounded f-15 ml-4" id="clockout" value="clockout" onclick="clock({{auth()->id()}},value)"
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;display: none;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock Out</span>
        </button>
        <button type="button" class="btn-primary rounded f-15 ml-4" id="clockin" value="clockin" onclick="clock({{auth()->id()}},value)" 
          style="background-color: #7f7c8b;border: 0;color: #fff;padding: 9px 11px 20px;position: relative;text-transform: capitalize;display: flex;padding-top:20px;display: none;">
          <i class="fa-solid fa-right-to-bracket p-1"></i><span style="font-size: 17px;">Clock In</span>
        </button>
      </div>
      <!-- CLOCK IN CLOCK OUT END -->
  <div class="row">
    <!-- Website Analytics -->
    <!-- Upper_Clock_Info  -->
    <div class="d-lg-flex d-md-flex d-block py-2 pb-2 align-items-center justify-content-between">
      <!-- WELOCOME NAME START -->
      <div>
        <h3 class="heading-h3 mb-0 f-21 font-weight-bold">Welcome {{Auth::user()->first_name}}</h3>
      </div>
      <!-- WELOCOME NAME END -->
    
    </div>
    <div class="col-lg-6 mb-4">
      <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg" id="swiper-with-pagination-cards">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="row">
            <div class="col-12">
              <h5 class="text-white mb-0 mt-2">{{Auth::user()->first_name}}</h5>
              <small>HR</small></br>
              <small>Employee ID: Emp-{{Auth::user()->id}}</small>
            </div>
            <div class="row">
              <!-- <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                <h6 class="text-white mt-0 mt-md-3 mb-3">Overview</h6>
                <div class="row">
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-4 align-items-center">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg"></p>
                        <p class="mb-0">Open Tasks</p>
                      </li>
                      <li class="d-flex align-items-center mb-2">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg"></p>
                        <p class="mb-0">Projects</p>
                      </li>
                    </ul>
                  </div>
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-4 align-items-center">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg"></p>
                        <p class="mb-0">Open Tickets</p>
                      </li>
                      <li class="d-flex align-items-center mb-2">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">12%</p>
                        <p class="mb-0">Averave response rate</p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div> -->
              <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                <img
                src="{{Auth::user()->profile_img}}"
                alt="Website Analytics"
                width="170"
                class="card-website-analytics-img" style="border-radius: 50%;"/>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="row">
            <div class="col-12">
              <h5 class="text-white mb-0 mt-2">Logs</h5>
              <!-- <small>2 : 40 : 06 PM</small> -->
            </div>
            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
              <h6 class="text-white mt-0 mt-md-3 mb-3">Time-Logs</h6>
              <div class="row">
                <div class="col-6">
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex mb-4 align-items-center">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="grand-total-time" style="min-width: 72px;">0</p>
                      <p class="mb-0">Total Duration</p>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="BreakTime" style="min-width: 72px;">0</p>
                      <p class="mb-0">Total Interval</p>
                    </li>
                  </ul>
                </div>
                <div class="col-6">
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex mb-4 align-items-center">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ExtraWorkingTime" style="min-width: 72px;">0</p>
                      <p class="mb-0">Overtime</p>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg"id="ShiftHours" style="min-width: 72px;">0k</p>
                      <p class="mb-0">Shift Hours</p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
              <img
              src="{{url('public/logo/clock.png')}}"
              alt="Website Analytics"
              width="170"
              class="card-website-analytics-img" style="border-radius: 50%;"/>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
  <div class="row g-4 mb-4 SalesScreen">
    <!-- View sales -->
    <div class="col-xl-4 mb-4 col-lg-5 col-12">
                    <div class="card">
                      <div class="d-flex align-items-end row">
                        <div class="col-7">
                          <div class="card-body text-nowrap">
                            <h5 class="card-title mb-0">Congratulations {{auth::user()->first_name}}! 🎉</h5>
                            <p class="mb-2">Best seller of the month</p>
                            @php
                                    if ($TotalSales >= 10000000) {
                                        $formattedTotalSales = round($TotalSales / 10000000, 2) . 'C';
                                    } elseif ($TotalSales >= 100000) {
                                        $formattedTotalSales = round($TotalSales / 100000, 2) . 'L';
                                    } elseif ($TotalSales >= 1000) {
                                        $formattedTotalSales = round($TotalSales / 1000, 2) . 'k';
                                    } else {
                                        $formattedTotalSales = $TotalSales;
                                    }
                             @endphp
                            <h4 class="text-primary mb-1">{{$formattedTotalSales}}</h4>
                            <a href="{{url('admin/Invoices/home')}}" class="btn btn-primary">View Sales</a>
                          </div>
                        </div>
                        <div class="col-5 text-center text-sm-left">
                          <div class="card-body pb-0 px-0 px-md-4">
                            <img
                              src="{{url('public/assets/img/illustrations/card-advance-sale.png')}}"
                              height="140"
                              alt="view sales" />
                          </div>
                        </div>
                      </div>
                    </div>
    </div>
    <!-- View sales -->

    <!-- Statistics -->
    <div class="col-xl-8 mb-4 col-lg-7 col-12">
                    <div class="card h-100">
                      <div class="card-header">
                        <div class="d-flex justify-content-between mb-3">
                          <h5 class="card-title mb-0">Statistics</h5>
                          <small class="text-muted">Updated 1 month ago</small>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row gy-3">
                          <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                              <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                <i class="ti ti-chart-pie-2 ti-sm"></i>
                              </div>
                              @php
                                    if ($StaSales >= 10000000) {
                                        $formattedStaSales = round($StaSales / 10000000, 2) . 'C';
                                    } elseif ($StaSales >= 100000) {
                                        $formattedStaSales = round($StaSales / 100000, 2) . 'L';
                                    } elseif ($StaSales >= 1000) {
                                        $formattedStaSales = round($StaSales / 1000, 2) . 'k';
                                    } else {
                                        $formattedStaSales = $StaSales;
                                    }
                             @endphp
                              <div class="card-info">
                                <h5 class="mb-0">{{$formattedStaSales}}</h5>
                                <small>Sales</small>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                              <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-users ti-sm"></i>
                              </div>
                               @php
                                    if ($StaCustomer >= 10000000) {
                                        $formattedStaCustomer = round($StaCustomer / 10000000, 2) . 'C';
                                    } elseif ($StaCustomer >= 100000) {
                                        $formattedStaCustomer = round($StaCustomer / 100000, 2) . 'L';
                                    } elseif ($StaCustomer >= 1000) {
                                        $formattedStaCustomer = round($StaCustomer / 1000, 2) . 'k';
                                    } else {
                                        $formattedStaCustomer = $StaCustomer;
                                    }
                             @endphp
                              <div class="card-info">
                                <h5 class="mb-0">{{$formattedStaCustomer}}</h5>
                                <small>Customers</small>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                              <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-shopping-cart ti-sm"></i>
                              </div>
                              @php
                                    if ($StaProducts >= 10000000) {
                                        $formattedStaProducts = round($StaProducts / 10000000, 2) . 'C';
                                    } elseif ($StaProducts >= 100000) {
                                        $formattedStaProducts = round($StaProducts / 100000, 2) . 'L';
                                    } elseif ($StaProducts >= 1000) {
                                        $formattedStaProducts = round($StaProducts / 1000, 2) . 'k';
                                    } else {
                                        $formattedStaProducts = $StaProducts;
                                    }
                             @endphp
                              <div class="card-info">
                                <h5 class="mb-0">{{$formattedStaProducts}}</h5>
                                <small>Products</small>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                              <div class="badge rounded-pill bg-label-success me-3 p-2">
                                <i class="ti ti-currency-dollar ti-sm"></i>
                              </div>
                               @php
                                    if ($StaRevenue >= 10000000) {
                                        $formattedStaRevenue = round($StaRevenue / 10000000, 2) . 'C';
                                    } elseif ($StaRevenue >= 100000) {
                                        $formattedStaRevenue = round($StaRevenue / 100000, 2) . 'L';
                                    } elseif ($StaRevenue >= 1000) {
                                        $formattedStaRevenue = round($StaRevenue / 1000, 2) . 'k';
                                    } else {
                                        $formattedStaRevenue = $StaRevenue;
                                    }
                             @endphp
                              <div class="card-info">
                                <h5 class="mb-0">{{$formattedStaRevenue}}</h5>
                                <small>Revenue</small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
    </div>
    <!--/ Statistics -->

    <div class="col-xl-4 col-12">
                    <div class="row">
                      <!-- Expenses -->
                      <div class="col-xl-6 mb-4 col-md-3 col-6">
                        <div class="card">
                           @php
                                if ($PayExpenses >= 10000000) {
                                    $formattedPayExpenses = round($PayExpenses / 10000000, 2) . 'C';
                                } elseif ($PayExpenses >= 100000) {
                                    $formattedPayExpenses = round($PayExpenses / 100000, 2) . 'L';
                                } elseif ($PayExpenses >= 1000) {
                                    $formattedPayExpenses = round($PayExpenses / 1000, 2) . 'k';
                                } else {
                                    $formattedPayExpenses = $PayExpenses;
                                }

                                if ($PayExpensesTotal > 0) {
                                    if ($PayExpensesTotal >= 10000000) {
                                        $formattedPayExpensesTotal = round($PayExpensesTotal / 10000000, 2) . 'C';
                                    } elseif ($PayExpensesTotal >= 100000) {
                                        $formattedPayExpensesTotal = round($PayExpensesTotal / 100000, 2) . 'L';
                                    } elseif ($PayExpensesTotal >= 1000) {
                                        $formattedPayExpensesTotal = round($PayExpensesTotal / 1000, 2) . 'k';
                                    } else {
                                        $formattedPayExpensesTotal = $PayExpensesTotal;
                                    }

                                    $Expencespercentage = ($PayExpenses / $PayExpensesTotal) * 100;
                                } else {
                                    // Handle the case where $PayExpensesTotal is zero to avoid division by zero error.
                                    $formattedPayExpensesTotal = 'N/A';
                                    $Expencespercentage = 'N/A';
                                }
                            @endphp


                          <div class="card-header pb-0">
                            <h5 class="card-title mb-0">{{$formattedPayExpenses}}</h5>
                            <small class="text-muted">Expenses</small>
                          </div>
                          <div class="card-body">
                            <div id="expensesChart"></div>
                            <div class="mt-md-2 text-center mt-lg-3 mt-3">
                              <small class="text-muted mt-3">{{$formattedPayExpensesTotal}} Expenses of the last month</small>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--/ Expenses -->

                         @php
                              $ProfitLasT = $StaRevenue - $previousMonthAmount;

                              if ($previousMonthAmount != 0) {
                                  $profitPercentage = ($ProfitLasT / $previousMonthAmount) * 100;
                              } else {
                                  $profitPercentage = 0;
                              }

                              if ($ProfitLasT >= 10000000) {
                                  $formattedProfitLasT = round($ProfitLasT / 10000000, 2) . 'C';
                              } elseif ($ProfitLasT >= 100000) {
                                  $formattedProfitLasT = round($ProfitLasT / 100000, 2) . 'L';
                              } elseif ($ProfitLasT >= 1000) {
                                  $formattedProfitLasT = round($ProfitLasT / 1000, 2) . 'k';
                              } else {
                                  $formattedProfitLasT = $ProfitLasT;
                              }
                          @endphp
                      <!-- Profit last month -->
                      <div class="col-xl-6 mb-4 col-md-3 col-6">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h5 class="card-title mb-0">Profit</h5>
                                    <small class="text-muted">Last Month</small>
                                </div>
                                <div class="card-body">
                                    <div id="profitLastMonth"></div>
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                        <h4 class="mb-0">{{$formattedProfitLasT}}</h4>
                                        <small id="profitPercentage" class="text-success"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <!--/ Profit last month -->

                      <!-- Generated Leads -->
                      <div class="col-xl-12 mb-4 col-md-6">
                        <div class="card">
                          @php
                           if ($LeadsGenerated >= 10000000) {
                                  $formattedLeadsGenerated = round($LeadsGenerated / 10000000, 2) . 'C';
                              } elseif ($LeadsGenerated >= 100000) {
                                  $formattedLeadsGenerated = round($LeadsGenerated / 100000, 2) . 'L';
                              } elseif ($LeadsGenerated >= 1000) {
                                  $formattedLeadsGenerated = round($LeadsGenerated / 1000, 2) . 'k';
                              } else {
                                  $formattedLeadsGenerated = $LeadsGenerated;
                              }
                          @endphp
                          <div class="card-body">
                            <div class="d-flex justify-content-between">
                              <div class="d-flex flex-column">
                                <div class="card-title mb-auto">
                                  <h5 class="mb-1 text-nowrap">Generated Leads</h5>
                                  <small>Monthly Report</small>
                                </div>
                                <div class="chart-statistics">
                                  <h3 class="card-title mb-1">{{$formattedLeadsGenerated}}</h3>
                                  <small class="text-success text-nowrap fw-medium"
                                    ></small
                                  >
                                </div>
                              </div>
                              <div id="generatedLeadsChart"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--/ Generated Leads -->
                    </div>
    </div>

    <!-- Revenue Report -->
    <div class="col-12 col-xl-8 mb-4">
                    <div class="card">
                      <div class="card-body p-0">
                        <div class="row row-bordered g-0">
                          <div class="col-md-8 position-relative p-4">
                            <div class="card-header d-inline-block p-0 text-wrap position-absolute">
                              <h5 class="m-0 card-title">Revenue Report</h5>
                            </div>
                            <div id="totalRevenueChart" class="mt-n1"></div>
                          </div>
                          <div class="col-md-4 p-4">
                            <div class="text-center mt-4">
                             <!--  <div class="dropdown">
                                <button
                                  class="btn btn-sm btn-outline-primary dropdown-toggle"
                                  type="button"
                                  id="budgetId"
                                  data-bs-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false">
                                  
                                  
                                  
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="budgetId">
                                  <a class="dropdown-item prev-year1" href="javascript:void(0);">
                                    
                                    
                                    
                                  </a>
                                  <a class="dropdown-item prev-year2" href="javascript:void(0);">
                                    
                                    
                                    
                                  </a>
                                  <a class="dropdown-item prev-year3" href="javascript:void(0);">
                                    
                                    
                                    
                                  </a>
                                </div>
                              </div> -->
                            </div>
                            <h3 class="text-center pt-4 mb-0">$25,825</h3>
                            <p class="mb-4 text-center"><span class="fw-medium">Budget: </span>56,800</p>
                            <div class="px-3">
                              <div id="budgetChart"></div>
                            </div>
                            <div class="text-center mt-4">
                              <button type="button" class="btn btn-primary">Increase Budget</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
    </div>
    <!--/ Revenue Report -->

    <!-- Earning Reports -->
    <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100">
                      <div class="card-header d-flex justify-content-between">
                        <div class="card-title mb-0">
                          <h5 class="m-0 me-2">Earning Reports</h5>
                          <small class="text-muted">Monthly Earnings Overview</small>
                        </div>
                        <!-- <div class="dropdown">
                          <button
                            class="btn p-0"
                            type="button"
                            id="earningReports"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReports">
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                          </div>
                        </div> -->
                      </div>
                      @php
                          // Avoid division by zero
                          $netProfitPercentageChange = $previousMonthAmount != 0 ? ($StaSales / $previousMonthAmount) * 100 - 100 : 0;
                          $totalIncomePercentageChange = $PreviousTotalIncome != 0 ? ($TotalIncome / $PreviousTotalIncome) * 100 - 100 : 0;
                          $totalExpensesPercentageChange = $PreviousTotalExpenses != 0 ? ($PayExpenses / $PreviousTotalExpenses) * 100 - 100 : 0;
                      @endphp
                      <div class="card-body pb-0">
                        <ul class="p-0 m-0">
                          <li class="d-flex mb-3">
                            <div class="avatar flex-shrink-0 me-3">
                              <span class="avatar-initial rounded bg-label-primary"
                                ><i class="ti ti-chart-pie-2 ti-sm"></i
                              ></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                <h6 class="mb-0">Net Profit</h6>
                                <small class="text-muted">{{$formattedStaSales}} Sales</small>
                              </div>
                              <div class="user-progress d-flex align-items-center gap-3">
                                <small>₹ {{$StaSales}}</small>
                                <div class="d-flex align-items-center gap-1">
                                  <i class="ti ti-chevron-up text-success"></i>
                                   <span class="{{ $netProfitPercentageChange >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $netProfitPercentageChange }}%
                                    </span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="d-flex mb-3">
                            <div class="avatar flex-shrink-0 me-3">
                              <span class="avatar-initial rounded bg-label-success"
                                ><i class="ti ti-currency-dollar ti-sm"></i
                              ></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                <h6 class="mb-0">Total Income</h6>
                                <small class="text-muted">Sales, Affiliation</small>
                              </div>
                              <div class="user-progress d-flex align-items-center gap-3">
                                <small>₹ {{$TotalIncome}}</small>
                                <div class="d-flex align-items-center gap-1">
                                  <i class="ti ti-chevron-up text-success"></i>
                                  <span class="{{ $totalIncomePercentageChange >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $totalIncomePercentageChange }}%
                                    </span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="d-flex mb-3">
                            <div class="avatar flex-shrink-0 me-3">
                              <span class="avatar-initial rounded bg-label-secondary"
                                ><i class="ti ti-credit-card ti-sm"></i
                              ></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                <h6 class="mb-0">Total Expenses</h6>
                                <small class="text-muted">ADVT, Marketing</small>
                              </div>
                              <div class="user-progress d-flex align-items-center gap-3">
                                <small>₹ {{$PayExpenses}}</small>
                                <div class="d-flex align-items-center gap-1">
                                  <i class="ti ti-chevron-up text-success"></i>
                                  <span class="{{ $totalExpensesPercentageChange >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $totalExpensesPercentageChange }}%
                                    </span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div id="reportBarChart"></div>
                      </div>
                    </div>
    </div>
    <!--/ Earning Reports -->

    <!-- Popular Product -->
    <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card h-100">
                      <div class="card-header d-flex justify-content-between">
                        <div class="card-title m-0 me-2">
                          <h5 class="m-0 me-2">Popular Products</h5>
                          <small class="text-muted">Monthly</small>
                        </div>
                       <!--  <div class="dropdown">
                          <button
                            class="btn p-0"
                            type="button"
                            id="popularProduct"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularProduct">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                          </div>
                        </div> -->
                      </div>
                      <div class="card-body">
                        <ul class="p-0 m-0">
                          @foreach($PopularProducts as $Product)
                          <li class="d-flex mb-4 pb-1">
                            <div class="me-3">
                              <img src="{{$Product->product_image}}" alt="User" class="rounded" width="46" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                <h6 class="mb-0">{{$Product->product_name}}</h6>
                                <small class="text-muted d-block">{{$Product->product_tag_line}}</small>
                              </div>
                              <div class="user-progress d-flex align-items-center gap-1">
                                <p class="mb-0 fw-medium">{{$Product->recurr_inr_monthly}} ₹</p>
                              </div>
                            </div>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
    </div>
    <!--/ Popular Product -->

    <!-- Transactions -->
    <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card h-100">
                      <div class="card-header d-flex justify-content-between">
                        <div class="card-title m-0 me-2">
                          <h5 class="m-0 me-2">Transactions</h5>
                          <small class="text-muted">Total {{count($TotalTransation)}} Transactions done in this Month</small>
                        </div>
                        <!-- <div class="dropdown">
                          <button
                            class="btn p-0"
                            type="button"
                            id="transactionID"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                          </div>
                        </div> -->
                      </div>
                      <div class="card-body">
                        <ul class="p-0 m-0">
                          @foreach($TotalTransation as $trean)
                          <li class="d-flex mb-3 pb-1 align-items-center">
                            <div class="badge me-3 rounded p-2">
                            <img src="{{$trean->profile_img}}" height="40" width="50">
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                <h6 class="mb-0">{{$trean->first_name}}</h6>
                                <small class="text-muted d-block">{{$trean->email}}</small>
                              </div>
                              <div class="user-progress d-flex align-items-center gap-1">
                                @if($trean->status== "captured")
                                <h6 class="mb-0 text-success">{{$trean->amount}}</h6>
                                @else
                                <h6 class="mb-0 text-danger">{{$trean->amount}}</h6>
                                @endif
                              </div>
                            </div>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
    </div>
    <!--/ Transactions -->
  </div>
</div>
   

<!--/ Total Duration start-->

@foreach($Attendence as $key => $att)
  <div class="odd">
    <input type="hidden" class="punch-in{{$key+1}}" value="{{ $att->punch_in }}">
    <input type="hidden" class="punch-out{{$key+1}}" value="@if($att && $att->punch_out){{ $att->punch_out }} @else {{ \Carbon\Carbon::now()->format('H:i:s') }} @endif ">
    <input type="hidden" class="total-time{{$key+1}}" value="">
  </div>
@endforeach

<script>
 $(document).ready(function() {
  var workingHours = '{{$TimeShift->working_hours}}'; // Set your working hours
  var WorkingHoursInSeconds = calculateTotalSeconds(parseTime(workingHours));
  var grandTotalSeconds = 0;
  var totalBreakSeconds = 0;

  // Loop through each odd entry
  $('.odd').each(function(index) {
    var punchIn = $(this).find('.punch-in' + (index + 1)).val();
    var punchOut = $(this).find('.punch-out' + (index + 1)).val();

    var diff = calculateTimeDifference(punchIn, punchOut);
    $(this).find('.total-time' + (index + 1)).val(formatTimeDifference(diff));

    // Accumulate the total in seconds
    grandTotalSeconds += calculateTotalSeconds(diff);

    // Calculate and accumulate the break time for each pair of punch-out and punch-in
    if (index > 0) {
      var previousPunchOut = $('.odd').eq(index - 1).find('.punch-out' + (index)).val();
      var breakDiff = calculateTimeDifference(previousPunchOut, punchIn);
      totalBreakSeconds += calculateTotalSeconds(breakDiff);
    }
  });

  // Calculate overtime, pending time, and extra working time
  var overallTime = grandTotalSeconds;
  var breakTime = totalBreakSeconds;
  var workingTime = overallTime - breakTime;

  // Display the grand total time
  $('#grand-total-time').text(formatTotalTime(grandTotalSeconds));

  // Display the total break time
  $('#BreakTime').text(formatTotalTime(totalBreakSeconds));

  // Calculate and display overtime, pending time, and extra working time
  var overtime = 0;
  var pendingTime = 0;
  var extraWorkingTime = 0;

  if (WorkingHoursInSeconds) {
    extraWorkingTime = grandTotalSeconds - WorkingHoursInSeconds;

    // Only display overtime if it is greater than zero
    if (extraWorkingTime > 0) {
      overtime = extraWorkingTime;
    } else {
      overtime = 0;
    }
  }

  $('#Overtime').text(formatTotalTime(overtime));
  $('#PendingTime').text(formatTotalTime(pendingTime));
  $('#ExtraWorkingTime').text(formatTotalTime(extraWorkingTime));
  $('#ShiftHours').text(formatTotalTime(WorkingHoursInSeconds));

  function calculateTimeDifference(start, end) {
    var startTime = new Date("2000-01-01 " + start);
    var endTime = new Date("2000-01-01 " + end);

    var timeDiff = endTime - startTime; // Difference in milliseconds

    // Calculate hours, minutes, and seconds
    var hours = Math.floor(timeDiff / 3600000); // 1 hour = 3600000 milliseconds
    var minutes = Math.floor((timeDiff % 3600000) / 60000); // 1 minute = 60000 milliseconds

    return {
      hours: hours,
      minutes: minutes,
    };
  }

  function calculateTotalSeconds(diff) {
    return diff.hours * 3600 + diff.minutes * 60;
  }

  function formatTotalTime(totalSeconds) {
    if (totalSeconds <= 0) {
      return '00:00';
    }

    var hours = Math.floor(totalSeconds / 3600);
    var minutes = Math.floor((totalSeconds % 3600) / 60);

    return padZero(hours) + ':' + padZero(minutes);
  }

  function formatTimeDifference(diff) {
    return padZero(diff.hours) + ':' + padZero(diff.minutes);
  }

  function padZero(value) {
    return value < 10 ? '0' + value : value;
  }

  function parseTime(timeString) {
    var timeParts = timeString.split(':');
    return {
      hours: parseInt(timeParts[0], 10),
      minutes: parseInt(timeParts[1], 10),
      seconds: parseInt(timeParts[2], 10),
    };
  }
});


  function clock(id,value) {
    if(value == 'clockin'){
      clockStatusUpdate(id,value);
    }
    else if(value == 'clockout'){
      clockStatusUpdate(id,value);
    }
    window.location.reload();
  }

function clockStatusUpdate(id, value) {
    $.ajax({
        url: "{{ url('Employee/ClockStatusUpdate') }}",
        method: 'get',
        data: { id: id, value: value },
        success: function (response) {
          if (response && response.data && response.data.clock_status !== undefined) {
              const clockStatus = response.data.clock_status;
              if (clockStatus === 0) {
                  $('#clockin').hide();
                  $('#clockout').show();
                  $('#clockin1').hide();
                  $('#clockout1').hide();
              } else if (clockStatus === 1) {
                  $('#clockin').show();
                  $('#clockout').hide();
                  $('#clockin1').hide();
                  $('#clockout1').hide();
              }
          } else {
              alert('Invalid response format');
          }
        },
        error: function (xhr, status, error) {
            console.error('AJAX request failed:', status, error);
            alert('Error occurred during the request');
        }
    });
}


function updateDashboardClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var amPm = hours < 12 ? 'AM' : 'PM';
    hours = hours % 12;
    hours = hours ? hours : 12; // The hour '0' should be '12' in 12-hour format
    var formattedTime = padZero(hours) + ':' + padZero(minutes) + ':' + padZero(seconds) + ' ' + amPm;   
    $('#dashboard-clock').text(formattedTime);
}
function padZero(number) {
    return (number < 10 ? '0' : '') + number;
}
updateDashboardClock();
setInterval(updateDashboardClock, 1000);
</script>
<script type="text/javascript">
(function () {
  let cardColor, labelColor, headingColor, borderColor, legendColor;

  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    labelColor = config.colors_dark.textMuted;
    legendColor = config.colors_dark.bodyColor;
    headingColor = config.colors_dark.headingColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    headingColor = config.colors.headingColor;
    borderColor = config.colors.borderColor;
  }

  // Donut Chart Colors
  const chartColors = {
    donut: {
      series1: config.colors.success,
      series2: '#28c76fb3',
      series3: '#28c76f80',
      series4: config.colors_label.success
    }
  };

  // Expenses Radial Bar Chart
  // --------------------------------------------------------------------
 const expensesRadialChartEl = document.querySelector('#expensesChart');

// Assume you have calculated the percentage and stored it in the variable 'percentage'
const percentage = {{ $Expencespercentage || 0 }};


const expensesRadialChartConfig = {
  chart: {
    height: 145,
    sparkline: {
      enabled: true
    },
    parentHeightOffset: 0,
    type: 'radialBar'
  },
  colors: [config.colors.warning],
  series: [percentage], // Use the calculated percentage here
  plotOptions: {
    radialBar: {
      offsetY: 0,
      startAngle: -90,
      endAngle: 90,
      hollow: {
        size: '65%'
      },
      track: {
        strokeWidth: '45%',
        background: borderColor
      },
      dataLabels: {
        name: {
          show: false
        },
        value: {
          fontSize: '22px',
          color: headingColor,
          fontWeight: 500,
          offsetY: -5
        }
      }
    }
  },
  grid: {
    show: false,
    padding: {
      bottom: 5
    }
  },
  stroke: {
    lineCap: 'round'
  },
  labels: ['Progress'],
  responsive: [
    {
      breakpoint: 1442,
      options: {
        chart: {
          height: 120
        },
        plotOptions: {
          radialBar: {
            dataLabels: {
              value: {
                fontSize: '18px'
              }
            },
            hollow: {
              size: '60%'
            }
          }
        }
      }
    },
    {
      breakpoint: 1025,
      options: {
        chart: {
          height: 136
        },
        plotOptions: {
          radialBar: {
            hollow: {
              size: '65%'
            },
            dataLabels: {
              value: {
                fontSize: '18px'
              }
            }
          }
        }
      }
    },
    {
      breakpoint: 769,
      options: {
        chart: {
          height: 120
        },
        plotOptions: {
          radialBar: {
            hollow: {
              size: '55%'
            }
          }
        }
      }
    },
    {
      breakpoint: 426,
      options: {
        chart: {
          height: 145
        },
        plotOptions: {
          radialBar: {
            hollow: {
              size: '65%'
            }
          }
        },
        dataLabels: {
          value: {
            offsetY: 0
          }
        }
      }
    },
    {
      breakpoint: 376,
      options: {
        chart: {
          height: 105
        },
        plotOptions: {
          radialBar: {
            hollow: {
              size: '60%'
            }
          }
        }
      }
    }
  ]
};

if (typeof expensesRadialChartEl !== undefined && expensesRadialChartEl !== null) {
  const expensesRadialChart = new ApexCharts(expensesRadialChartEl, expensesRadialChartConfig);
  expensesRadialChart.render();
}


  // Profit last month Line Chart
  // --------------------------------------------------------------------
 const profitLastMonthEl = document.querySelector('#profitLastMonth');

// Assuming you have calculated the profit and stored it in the variable 'ProfitLasT'
const ProfitLasT = parseFloat("{{$ProfitLasT}}") || 0;

const profitLastMonthConfig = {
    chart: {
        height: 90,
        type: 'line',
        parentHeightOffset: 0,
        toolbar: {
            show: false
        }
    },
    grid: {
        borderColor: borderColor,
        strokeDashArray: 6,
        xaxis: {
            lines: {
                show: true,
                colors: '#000'
            }
        },
        yaxis: {
            lines: {
                show: false
            }
        },
        padding: {
            top: -18,
            left: -4,
            right: 7,
            bottom: -10
        }
    },
    colors: [config.colors.info],
    stroke: {
        width: 2
    },
    series: [{
        data: [0, 25, 10, 40, 25, ProfitLasT]
    }],
    tooltip: {
        shared: false,
        intersect: true,
        x: {
            show: false
        }
    },
    xaxis: {
        labels: {
            show: false
        },
        axisTicks: {
            show: false
        },
        axisBorder: {
            show: false
        }
    },
    yaxis: {
        labels: {
            show: false
        }
    },
    tooltip: {
        enabled: false
    },
    markers: {
        size: 3.5,
        fillColor: config.colors.info,
        strokeColors: 'transparent',
        strokeWidth: 3.2,
        discrete: [{
            seriesIndex: 0,
            dataPointIndex: 5,
            fillColor: cardColor,
            strokeColor: config.colors.info,
            size: 5,
            shape: 'circle'
        }],
        hover: {
            size: 5.5
        }
    },
    responsive: [
        {
            breakpoint: 1442,
            options: {
                chart: {
                    height: 100
                }
            }
        },
        {
            breakpoint: 1025,
            options: {
                chart: {
                    height: 86
                }
            }
        },
        {
            breakpoint: 769,
            options: {
                chart: {
                    height: 93
                }
            }
        }
    ]
};

if (typeof profitLastMonthEl !== 'undefined' && profitLastMonthEl !== null) {
    const profitLastMonth = new ApexCharts(profitLastMonthEl, profitLastMonthConfig);
    profitLastMonth.render();
}

// Display profit percentage
const profitPercentageEl = document.querySelector('#profitPercentage');
if (profitPercentageEl !== null) {
    const previousMonthAmount = parseFloat("{{$previousMonthAmount}}") || 0;
    const profitPercentage = previousMonthAmount !== 0 ? ((ProfitLasT / previousMonthAmount) * 100).toFixed(2) : 0;
    profitPercentageEl.textContent = `+ ${profitPercentage}%`;
}


  // Generated Leads Chart
  // --------------------------------------------------------------------
 const generatedLeadsChartEl = document.querySelector('#generatedLeadsChart');
const LGen = parseInt("{{$LeadsGenerated}}");
const LPro = parseInt("{{$LeadsProgress}}");
const LWin = parseInt("{{$LeadsWin}}");
const LLoss = parseInt("{{$LeadsLoss}}");

generatedLeadsChartConfig = {
  chart: {
    height: 147,
    width: 130,
    parentHeightOffset: 0,
    type: 'donut'
  },
  labels: ['Win', 'Loss', 'Progress'],
  series: [LWin, LLoss, LPro],
  colors: [
    chartColors.donut.series1,
    chartColors.donut.series2,
    chartColors.donut.series3,
    chartColors.donut.series4
  ],
  stroke: {
    width: 0
  },
  dataLabels: {
    enabled: false,
    formatter: function (val, opt) {
      return parseInt(val) + '%';
    }
  },
  legend: {
    show: false
  },
  tooltip: {
    theme: false
  },
  grid: {
    padding: {
      top: 15,
      right: -20,
      left: -20
    }
  },
  states: {
    hover: {
      filter: {
        type: 'none'
      }
    }
  },
  plotOptions: {
    pie: {
      donut: {
        size: '70%',
        labels: {
          show: true,
          value: {
            fontSize: '1.375rem',
            fontFamily: 'Public Sans',
            color: headingColor,
            fontWeight: 500,
            offsetY: -15,
            formatter: function (val) {
              return parseInt(val) + '%';
            }
          },
          name: {
            offsetY: 20,
            fontFamily: 'Public Sans'
          },
          total: {
            show: true,
            showAlways: true,
            color: config.colors.success,
            fontSize: '.8125rem',
            label: 'Total',
            fontFamily: 'Public Sans',
            formatter: function (w) {
              return LGen;
            }
          }
        }
      }
    }
  },
  responsive: [
    {
      breakpoint: 1025,
      options: {
        chart: {
          height: 172,
          width: 160
        }
      }
    },
    {
      breakpoint: 769,
      options: {
        chart: {
          height: 178
        }
      }
    },
    {
      breakpoint: 426,
      options: {
        chart: {
          height: 147
        }
      }
    }
  ]
};

if (generatedLeadsChartEl !== null) {
  const generatedLeadsChart = new ApexCharts(generatedLeadsChartEl, generatedLeadsChartConfig);
  generatedLeadsChart.render();
}


  // Total Revenue Report Chart - Bar Chart
  // --------------------------------------------------------------------
  const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
    totalRevenueChartOptions = {
      series: [
        {
          name: 'Earning',
          data: [270, 210, 180, 200, 250, 280, 250, 270, 150]
        },
        {
          name: 'Expense',
          data: [-140, -160, -180, -150, -100, -60, -80, -100, -180]
        }
      ],
      chart: {
        height: 413,
        parentHeightOffset: 0,
        stacked: true,
        type: 'bar',
        toolbar: { show: false }
      },
      tooltip: {
        enabled: false
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '40%',
          borderRadius: 9,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      colors: [config.colors.primary, config.colors.warning],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 6,
        lineCap: 'round',
        colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'right',
        position: 'top',
        fontFamily: 'Public Sans',
        markers: {
          height: 12,
          width: 12,
          radius: 12,
          offsetX: -3,
          offsetY: 2
        },
        labels: {
          colors: legendColor
        },
        itemMargin: {
          horizontal: 10,
          vertical: 2
        }
      },
      grid: {
        show: false,
        padding: {
          bottom: -8,
          top: 20
        }
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        labels: {
          style: {
            fontSize: '13px',
            colors: labelColor,
            fontFamily: 'Public Sans'
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        labels: {
          offsetX: -16,
          style: {
            fontSize: '13px',
            colors: labelColor,
            fontFamily: 'Public Sans'
          }
        },
        min: -200,
        max: 300,
        tickAmount: 5
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '43%'
              }
            }
          }
        },
        {
          breakpoint: 1441,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '50%'
              }
            },
            chart: {
              height: 422
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '50%'
              }
            }
          }
        },
        {
          breakpoint: 1025,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '50%'
              }
            },
            chart: {
              height: 390
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '38%'
              }
            }
          }
        },
        {
          breakpoint: 850,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '50%'
              }
            }
          }
        },
        {
          breakpoint: 449,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '73%'
              }
            },
            chart: {
              height: 360
            },
            xaxis: {
              labels: {
                offsetY: -5
              }
            },
            legend: {
              show: true,
              horizontalAlign: 'right',
              position: 'top',
              itemMargin: {
                horizontal: 10,
                vertical: 0
              }
            }
          }
        },
        {
          breakpoint: 394,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '88%'
              }
            },
            legend: {
              show: true,
              horizontalAlign: 'center',
              position: 'bottom',
              markers: {
                offsetX: -3,
                offsetY: 0
              },
              itemMargin: {
                horizontal: 10,
                vertical: 5
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
    const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
    totalRevenueChart.render();
  }

  // Total Revenue Report Budget Line Chart
  const budgetChartEl = document.querySelector('#budgetChart'),
    budgetChartOptions = {
      chart: {
        height: 100,
        toolbar: { show: false },
        zoom: { enabled: false },
        type: 'line'
      },
      series: [
        {
          name: 'Last Month',
          data: [20, 10, 30, 16, 24, 5, 40, 23, 28, 5, 30]
        },
        {
          name: 'This Month',
          data: [50, 40, 60, 46, 54, 35, 70, 53, 58, 35, 60]
        }
      ],
      stroke: {
        curve: 'smooth',
        dashArray: [5, 0],
        width: [1, 2]
      },
      legend: {
        show: false
      },
      colors: [borderColor, config.colors.primary],
      grid: {
        show: false,
        borderColor: borderColor,
        padding: {
          top: -30,
          bottom: -15,
          left: 25
        }
      },
      markers: {
        size: 0
      },
      xaxis: {
        labels: {
          show: false
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        show: false
      },
      tooltip: {
        enabled: false
      }
    };
  if (typeof budgetChartEl !== undefined && budgetChartEl !== null) {
    const budgetChart = new ApexCharts(budgetChartEl, budgetChartOptions);
    budgetChart.render();
  }

  // Earning Reports Bar Chart
  // --------------------------------------------------------------------
    const reportBarChartEl = document.querySelector('#reportBarChart');
       const  netProfitPercentageChange = "{{$netProfitPercentageChange}}";
   const  totalIncomePercentageChange = "{{$totalIncomePercentageChange}}";
   const  totalExpensesPercentageChange = "{{$totalExpensesPercentageChange}}";
    const reportBarChartConfig = {
        chart: {
            height: 230,
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                barHeight: '60%',
                columnWidth: '60%',
                startingShape: 'rounded',
                endingShape: 'rounded',
                borderRadius: 4,
                distributed: true
            }
        },
        grid: {
            show: false,
            padding: {
                top: -20,
                bottom: 0,
                left: -10,
                right: -10
            }
        },
        colors: [
            config.colors_label.primary,
            config.colors_label.primary,
            config.colors_label.primary,
            config.colors_label.primary,
            config.colors.primary,
            config.colors_label.primary,
            config.colors_label.primary
        ],
        dataLabels: {
            enabled: false
        },
        series: [
            {
                data: [ netProfitPercentageChange ,totalIncomePercentageChange ,totalExpensesPercentageChange]
            }
        ],
        legend: {
            show: false
        },
        xaxis: {
            categories: ['Profit', 'Income', 'Expenses'],
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
                show: false
            }
        },
        responsive: [
            {
                breakpoint: 1025,
                options: {
                    chart: {
                        height: 190
                    }
                }
            },
            {
                breakpoint: 769,
                options: {
                    chart: {
                        height: 250
                    }
                }
            }
        ]
    };

    if (typeof reportBarChartEl !== 'undefined' && reportBarChartEl !== null) {
        const barChart = new ApexCharts(reportBarChartEl, reportBarChartConfig);
        barChart.render();
    }
  // Variable declaration for table
  var dt_invoice_table = $('.datatable-invoice');
  // Invoice datatable
  // --------------------------------------------------------------------
  if (dt_invoice_table.length) {
    var dt_invoice = dt_invoice_table.DataTable({
      ajax: assetsPath + 'json/invoice-list.json', // JSON file to add data
      columns: [
        // columns according to JSON
        { data: '' },
        { data: 'invoice_id' },
        { data: 'invoice_status' },
        { data: 'total' },
        { data: 'issued_date' },
        { data: 'invoice_status' },
        { data: 'action' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          // Invoice ID
          targets: 1,
          render: function (data, type, full, meta) {
            var $invoice_id = full['invoice_id'];
            // Creates full output for row
            var $row_output = '<a href="' + baseUrl + 'app/invoice/preview"><span>#' + $invoice_id + '</span></a>';
            return $row_output;
          }
        },
        {
          // Invoice status
          targets: 2,
          render: function (data, type, full, meta) {
            var $invoice_status = full['invoice_status'],
              $due_date = full['due_date'],
              $balance = full['balance'];
            var roleBadgeObj = {
              Sent: '<span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30"><i class="ti ti-circle-check ti-sm"></i></span>',
              Draft:
                '<span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30"><i class="ti ti-device-floppy ti-sm"></i></span>',
              'Past Due':
                '<span class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30"><i class="ti ti-info-circle ti-sm"></i></span>',
              'Partial Payment':
                '<span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="ti ti-circle-half-2 ti-sm"></i></span>',
              Paid: '<span class="badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30"><i class="ti ti-chart-pie ti-sm"></i></span>',
              Downloaded:
                '<span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30"><i class="ti ti-arrow-down-circle ti-sm"></i></span>'
            };
            return (
              "<span data-bs-toggle='tooltip' data-bs-html='true' title='<span>" +
              $invoice_status +
              '<br> <span class="fw-medium">Balance:</span> ' +
              $balance +
              '<br> <span class="fw-medium">Due Date:</span> ' +
              $due_date +
              "</span>'>" +
              roleBadgeObj[$invoice_status] +
              '</span>'
            );
          }
        },
        {
          // Total Invoice Amount
          targets: 3,
          render: function (data, type, full, meta) {
            var $total = full['total'];
            return '$' + $total;
          }
        },
        {
          // Actions
          targets: -1,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-flex align-items-center">' +
              '<a href="javascript:;" class="text-body" data-bs-toggle="tooltip" title="Send Mail"><i class="ti ti-mail me-2 ti-sm"></i></a>' +
              '<a href="' +
              baseUrl +
              'app/invoice/preview"class="text-body" data-bs-toggle="tooltip" title="Preview"><i class="ti ti-eye mx-2 ti-sm"></i></a>' +
              '<div class="d-inline-block">' +
              '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm lh-1"></i></a>' +
              '<div class="dropdown-menu dropdown-menu-end m-0">' +
              '<a href="javascript:;" class="dropdown-item">Details</a>' +
              '<a href="javascript:;" class="dropdown-item">Archive</a>' +
              '<div class="dropdown-divider"></div>' +
              '<a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>' +
              '</div>' +
              '</div>' +
              '</div>'
            );
          }
        },
        {
          // Invoice Status
          targets: -2,
          visible: false
        }
      ],
      order: [[1, 'asc']],
      dom:
        '<"row ms-2 me-3"' +
        '<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>>' +
        '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-2"f<"invoice_status mb-3 mb-md-0">>' +
        '>t' +
        '<"row d-flex align-items-center mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6 mt-1"p>' +
        '>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      language: {
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Search Invoice'
      },
      // Buttons
      buttons: [
        {
          text: '<i class="ti ti-plus me-md-2"></i><span class="d-md-inline-block d-none">Create Invoice</span>',
          className: 'btn btn-primary',
          action: function (e, dt, button, config) {
            window.location = baseUrl + 'app/invoice/add';
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      },
      initComplete: function () {
        // Adding role filter once table initialized
        this.api()
          .columns(5)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="UserRole" class="form-select"><option value=""> Select Status </option></select>'
            )
              .appendTo('.invoice_status')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
      }
    });
  }
  // On each datatable draw, initialize tooltip
  dt_invoice_table.on('draw.dt', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        boundary: document.body
      });
    });
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
})();
</script>
@endsection