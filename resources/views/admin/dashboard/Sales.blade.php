<div class="row g-4 mb-4 SalesScreen">
  <!-- View sales -->
  @if($currentMonthBestSellerEmployee)
     @if($previousYearBestSellerEmployee)
        <div class="col-xl-3 mb-4 col-lg-5 col-12">
    @else
        <div class="col-md-4 mb-4">
    @endif
        <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-7">
                <div class="card-body text-nowrap">
                    <h5 class="card-title mb-0">Congratulations  🎉</h5>
                    
                    <p>
                        @if($currentMonthBestSellerEmployee)
                            {{ ucfirst($currentMonthBestSellerEmployee->first_name) }} {{ ucfirst($currentMonthBestSellerEmployee->last_name) }}
                        @else
                            --
                        @endif
                        
                    <br>
                        @if($currentMonthBestSellerEmployee)
                            ID: {{ $currentMonthBestSellerEmployee->id }}
                        @else
                            --
                        @endif
                  <br/>
                  Post :@if($currentMonthBestSellerEmployee && $currentMonthBestSellerEmployee->desname )
                            {{ $currentMonthBestSellerEmployee->desname }}
                        @else
                            --
                        @endif
                 </p>

                    <h4 class="text-primary mb-1">{{$default_currency->prefix}} {{ formatNumber($currentMonthEmpPrice) }} </h4>
                    <a href="{{ url('admin/Invoices/home') }}" class="btn btn-primary">View Sales</a>
                </div>
            </div>
            <div class="col-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    @if($currentMonthBestSellerEmployee && $currentMonthBestSellerEmployee->profile_img)
                        <img src="{{ $currentMonthBestSellerEmployee->profile_img }}"  height="100%" width="100%" alt="view sales" style=" width: 149px;height: 194px;padding-bottom: 25%;padding-right: 17%;">
                    @else
                        <img src="{{ url('public/assets/img/illustrations/card-advance-sale.png') }}" height="140" alt="view sales" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if($previousYearBestSellerEmployee)
    <div class="col-xl-3 mb-4 col-lg-5 col-12">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-7">
                    <div class="card-body text-nowrap">
                        <h5 class="card-title mb-0">Congratulations 🎉</h5>
                            <p>Best Seller of the Year {{ $previousYear }}</p>
                       
                         <p>
                        @if($previousYearBestSellerEmployee)
                            {{ ucfirst($previousYearBestSellerEmployee->first_name) }} {{ ucfirst($previousYearBestSellerEmployee->last_name) }}
                        @else
                            --
                        @endif
                        
                    <br>
                        @if($previousYearBestSellerEmployee)
                            ID: {{ $previousYearBestSellerEmployee->id }}
                        @else
                            --
                        @endif
                  <br/>
                  Post :@if($previousYearBestSellerEmployee && $previousYearBestSellerEmployee->desname )
                            {{ $previousYearBestSellerEmployee->desname }}
                        @else
                            --
                        @endif
                 </p>
                    
                    

                        <h4 class="text-primary mb-1">{{$default_currency->prefix}} {{ formatNumber($currentYearEmpPrice) }}</h4>
                        <a href="{{ url('admin/Invoices/home') }}" class="btn btn-primary">View Sales</a>
                    </div>
                </div>
                <div class="col-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        @if($previousYearBestSellerEmployee && $previousYearBestSellerEmployee->profile_img)
                            <img src="{{ $previousYearBestSellerEmployee->profile_img }}"  height="100%" width="100%" alt="view sales" style=" width: 149px;height: 194px;padding-bottom: 25%;padding-right: 17%;">
                        @else
                            <img src="{{ url('public/assets/img/illustrations/card-advance-sale.png') }}" height="140" alt="view sales" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

  <!-- View sales -->

  <!-- Statistics -->
    @php
                        function formatNumber($number) {
                            if ($number >= 1000) {
                                return number_format($number / 1000, 1) . 'K';
                            } elseif ($number >= 10000000) {
                                return round($number / 10000000, 2) . 'C';
                            } elseif ($number >= 100000) {
                                return round($number / 100000, 2) . 'L';
                            } else {
                                return $number;
                            }
                        }
                    @endphp
  <div class=" @if($previousYearBestSellerEmployee && $previousYearBestSellerEmployee->id) col-xl-6 @else col-xl-4 @endif mb-4 col-lg-7">
<div class="row">
    <div class="col-xl-12 col-lg-7 mb-4">
                  <div class="card" style="min-height:268px;">
                    <div class="card-header">
                      <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Statistics</h5>
                        <small class="text-muted">Updated 1 month ago</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row gy-3">
                        <div class="col-md-6 col-6 mb-4">
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
                              <h5 class="mb-0">{{$default_currency->prefix}} {{formatNumber($totalSalesCurrentMonthPrice)}}</h5>
                              <small>Sales</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-6">
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
                              <h5 class="mb-0">{{$TClient}}</h5>
                              <small>Customers  </small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-6">
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
                              <h5 class="mb-0">17</h5>
                              <small>Products</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-6">
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
                              <h5 class="mb-0">{{$default_currency->prefix}} {{formatNumber($totalRevenueCurrentMonthPrice)}}</h5>
                              <small>Revenue</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div></div>
                  <div class="col-xl-12 col-lg-5 mb-4">
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
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">{{$Product->product_name}}</h6>
                              <small class="text-muted d-block">{{$Product->product_tag_line}}</small>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <p class="mb-0 fw-medium">{{$Product->price}} {{$default_currency->prefix}}</p>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
  </div>
                  </div>
  </div>
  <!--/ Statistics -->

  
  <!-- Revenue Report -->
  <!--<div class="col-12 col-xl-8 mb-4">-->
  <!--                <div class="card">-->
  <!--                  <div class="card-body p-0">-->
  <!--                    <div class="row row-bordered g-0">-->
  <!--                      <div class="col-md-8 position-relative p-4">-->
  <!--                        <div class="card-header d-inline-block p-0 text-wrap position-absolute">-->
  <!--                          <h5 class="m-0 card-title">Revenue Report</h5>-->
  <!--                        </div>-->
  <!--                        <div id="totalRevenueChart" class="mt-n1"></div>-->
  <!--                      </div>-->
  <!--                      <div class="col-md-4 p-4">-->
  <!--                        <div class="text-center mt-4">-->
                          
  <!--                        </div>-->
  <!--                        <h3 class="text-center pt-4 mb-0">$25,825</h3>-->
  <!--                        <p class="mb-4 text-center"><span class="fw-medium">Budget: </span>56,800</p>-->
  <!--                        <div class="px-3">-->
  <!--                          <div id="budgetChart"></div>-->
  <!--                        </div>-->
  <!--                        <div class="text-center mt-4">-->
  <!--                          <button type="button" class="btn btn-primary">Increase Budget</button>-->
  <!--                        </div>-->
  <!--                      </div>-->
  <!--                    </div>-->
  <!--                  </div>-->
  <!--                </div>-->
  <!--</div>-->
  <!--/ Revenue Report -->
 <div class="col-xl-4 col-md-5 mb-4">
                  <div class="row">
                     <!-- Expenses -->
                                <div class="col-xl-6 mb-4 col-md-6 col-6">
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
                                            if ($PayExpensesTotal >= 10000000) {
                                                $formattedPayExpensesTotal = round($PayExpensesTotal / 10000000, 2) . 'C';
                                            } elseif ($PayExpensesTotal >= 100000) {
                                                $formattedPayExpensesTotal = round($PayExpensesTotal / 100000, 2) . 'L';
                                            } elseif ($PayExpensesTotal >= 1000) {
                                                $formattedPayExpensesTotal = round($PayExpensesTotal / 1000, 2) . 'k';
                                            } else {
                                                $formattedPayExpensesTotal = $PayExpensesTotal;
                                            }
                                            $Expencespercentage = ($PayExpensesTotal != 0) ? ($PayExpenses / $PayExpensesTotal) * 100 : 0;
                                        @endphp
                                        <div class="card-header pb-0">
                                            <h5 class="card-title mb-0">{{$default_currency->prefix}} {{$formattedPayExpenses}}</h5>
                                            <small class="text-muted">Payroll Expenses</small>
                                            <form>
                                                <select name="filter" id="filter" class="form-control" onchange="Tab('Sales','Sales')">
                                                    <option value="">Filter by</option>
                                                    <option value="today">Today</option>
                                                    <option value="yesterday">Yesterday</option>
                                                    <option value="last-7-days">Last 7 Days</option>
                                                    <option value="last-30-days">Last 30 Days</option>
                                                    <option value="current-month">Current Month</option>
                                                    <option value="last-month">Last Month</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="card-body">
                                            <div id="expensesChart"></div>
                                            <div class="mt-md-2 text-center mt-lg-3 mt-3">
                                                <small class="text-muted mt-3">{{$default_currency->prefix}} {{$formattedPayExpensesTotal}} Expenses {{$filter}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Expenses -->

                                               @php
                                                    $ProfitLasT = $totalRevenueCurrentMonthPrice - $previousMonthAmount;

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
                                            <div class="col-xl-6 mb-4 col-md-6 col-6">
                                                  <div class="card" style="height:100%;">
                                                      <div class="card-header pb-0">
                                                          <h5 class="card-title mb-0">Profit</h5>
                                                          <small class="text-muted">Last Month</small>
                                                      </div>
                                                      <div class="card-body" style="margin-top:22px;">
                                                          <div id="profitLastMonth"></div>
                                                          <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                                              <h4 class="mb-0">{{$default_currency->prefix}} {{$formattedProfitLasT}}</h4>
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
                                                      <div class="card-title">
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
 <!-- Earning Reports -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title mb-0">
                <h5 class="m-0 me-2">Earning Reports</h5>
                <small class="text-muted">Monthly Earnings Overview</small>
                <form>
                    <select name="filter2" id="filter2" class="form-control" onchange="Tab('Sales','Sales')">
                        <option value="">Filter by</option>
                        <option value="current-month-report" {{ $filter2 == 'Of Current Month' ? 'selected' : '' }}>Current Month</option>
                        <option value="last-year-report" {{ $filter2 == 'Of Current Year' ? 'selected' : '' }}>Current Year</option>
                    </select>
                </form>
            </div>
        </div>
        @php
        $netProfitPercentageChange = $previousMonthAmount != 0 ? min(round((($StaSales / $previousMonthAmount) * 100 - 100), 2), 100) : 0;
        $totalIncomePercentageChange = $PreviousTotalIncome != 0 ? min(round((($TotalIncome / $PreviousTotalIncome) * 100 - 100), 2), 100) : 0;
        $totalExpensesPercentageChange = $PreviousTotalExpenses != 0 ? min(round((($PayExpenses2 / $PreviousTotalExpenses) * 100 - 100), 2), 100) : 0;
        //$netProfitPercentageChange = $previousMonthAmount != 0 ? min(round((($StaSales - $previousMonthAmount) / $previousMonthAmount * 100), 2), 100) : 0;

        if ($PayExpenses2 >= 10000000) {
            $PayExpenses2 = round($PayExpenses2 / 10000000, 2) . 'C';
        } elseif ($PayExpenses2 >= 100000) {
            $PayExpenses2 = round($PayExpenses2 / 100000, 2) . 'L';
        } elseif ($PayExpenses2 >= 1000) {
            $PayExpenses2 = round($PayExpenses2 / 1000, 2) . 'k';
        } else {
            $PayExpenses2 = $PayExpenses2;
        }
        if ($StaSales2 >= 10000000) {
            $StaSales2 = round($StaSales2 / 10000000, 2) . 'C';
        } elseif ($StaSales2 >= 100000) {
            $StaSales2 = round($StaSales2 / 100000, 2) . 'L';
        } elseif ($PayExpenses2 >= 1000) {
            $StaSales2 = round($StaSales2 / 1000, 2) . 'k';
        } else {
            $StaSales2 = $StaSales2;
        }
        @endphp


        <div class="card-body pb-0">
            <ul class="p-0 m-0">
                <li class="d-flex mb-3">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-chart-pie-2 ti-sm"></i>
                        </span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">Net Profit</h6>
                            <small class="text-muted">{{ $StaSales2 }} Sales</small>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-3">
                            <small>{{ $default_currency->prefix }} {{ $StaSales2 }}</small>
                            <div class="d-flex align-items-center gap-1">
                     
            <div class="d-flex align-items-center gap-1">
                <i class="ti ti-chevron-{{ $netProfitPercentageChange >= 0 ? 'up text-success' : 'down text-danger' }}"></i>
                <span class="{{ $netProfitPercentageChange >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ abs($netProfitPercentageChange) }}%
                </span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="d-flex mb-3">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="ti ti-currency-dollar ti-sm"></i>
                        </span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">Total Income</h6>
                            <small class="text-muted">Sales, Affiliation</small>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-3">
                            <small>{{ $default_currency->prefix }} {{ $TotalIncome }}</small>
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
                        <span class="avatar-initial rounded bg-label-secondary">
                            <i class="ti ti-credit-card ti-sm"></i>
                        </span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">Total Expenses</h6>
                            <small class="text-muted"></small>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-3">
                            <small>{{ $default_currency->prefix }} {{ $PayExpenses2 }}</small>
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
            <div id="radialBarChart"></div>
        </div>
    </div>
</div>
<!--/ Earning Reports -->


  <!-- Popular Product -->
  
  <!--/ Popular Product -->

  <!-- Transactions -->
  <!--<div class="col-md-6 col-xl-4 mb-4">-->
  <!--                <div class="card h-100">-->
  <!--                  <div class="card-header d-flex justify-content-between">-->
  <!--                    <div class="card-title m-0 me-2">-->
  <!--                      <h5 class="m-0 me-2">Transactions</h5>-->
  <!--                      <small class="text-muted">Total {{count($TotalTransation)}} Transactions done in this Month</small>-->
  <!--                    </div>-->
                     
  <!--                  </div>-->
  <!--                  <div class="card-body">-->
  <!--                    <ul class="p-0 m-0">-->
  <!--                      @foreach($TotalTransation as $trean)-->
  <!--                      <li class="d-flex mb-3 pb-1 align-items-center">-->
  <!--                        <div class="badge me-3 rounded p-2">-->
  <!--                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{isset($trean->profile_img) ? $trean->profile_img : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />-->
  <!--                        </div>-->
  <!--                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">-->
  <!--                          <div class="me-2">-->
  <!--                            <h6 class="mb-0">{{$trean->first_name}}</h6>-->
  <!--                            <small class="text-muted d-block">{{$trean->email}}</small>-->
  <!--                          </div>-->
  <!--                          <div class="user-progress d-flex align-items-center gap-1">-->
  <!--                            @if($trean->status== "captured")-->
  <!--                            <h6 class="mb-0 text-success">{{$trean->amount}}</h6>-->
  <!--                            @else-->
  <!--                            <h6 class="mb-0 text-danger">{{$trean->amount}}</h6>-->
  <!--                            @endif-->
  <!--                          </div>-->
  <!--                        </div>-->
  <!--                      </li>-->
  <!--                      @endforeach-->
  <!--                    </ul>-->
  <!--                  </div>-->
  <!--                </div>-->
  <!--</div>-->
  <!--/ Transactions -->
</div>
<script type="text/javascript">


(function () {
 

    
  // Expenses Radial Bar Chart
  // --------------------------------------------------------------------
 const expensesRadialChartEl = document.querySelector('#expensesChart');

// Assume you have calculated the percentage and stored it in the variable 'percentage'
const percentage = "{{round($Expencespercentage)}}";

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


   

    // // Color constant
    // const chartColors = {
    //     column: {
    //       series1: '#826af9',
    //       series2: '#d2b0ff',
    //       bg: '#f8d3ff'
    //     },
    //     donut: {
    //       series1: '#fee802',
    //       series2: '#3fd0bd',
    //       series3: '#826bf8',
    //       series4: '#2b9bf4'
    //     },
    //     area: {
    //       series1: '#29dac7',
    //       series2: '#60f2ca',
    //       series3: '#a5f8cd'
    //     }
    // };


  // Radial Bar Chart
  // --------------------------------------------------------------------
  var radialBarChartEl = document.querySelector('#radialBarChart'),
    radialBarChartConfig = {
      chart: {
        height: 380,
        type: 'radialBar'
      },
      colors: [chartColors.donut.series1, chartColors.donut.series2, chartColors.donut.series4],
      plotOptions: {
        radialBar: {
          size: 185,
          hollow: {
            size: '40%'
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
              fontWeight: 400,
              fontSize: '1.3rem',
              color: headingColor,
              label: 'Net Profit',
              formatter: function (w) {
                return "{{$netProfitPercentageChange}} %";
              }
            }
          }
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: -25,
          bottom: -20
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      stroke: {
        lineCap: 'round'
      },
      series: ["{{$netProfitPercentageChange}}","{{$totalIncomePercentageChange}}","{{$totalExpensesPercentageChange}}"],
      labels: ['Net Profit', 'Total Income', 'Total Expenses']
    };
  if (typeof radialBarChartEl !== undefined && radialBarChartEl !== null) {
    const radialChart = new ApexCharts(radialBarChartEl, radialBarChartConfig);
    radialChart.render();
  }

</script>