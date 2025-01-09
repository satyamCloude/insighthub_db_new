@extends('layouts.admin') @section('title', 'Leave') @section('content')

<style>


.circle_status{


background-color: #b3b5b8;
width:15px;
height: 15px;
border-radius: 50%;


}


  </style>
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-md-9">
      <div class="inner_content">
        <h3 class="heading-h3 mb-0 f-21 font-weight-bold mb-2" style="font-size: 31px;">Good afternoon, Saurav!</h3>
        <h6 class="fw-100">You have 2 leave request pending </h6>
        
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card h-100">
        <div class="card-body d-flex justify-content-between align-items-center" style="padding: 20px 12px;">
          <div class="card-title mb-0">
            <h6 class="mb-0 me-2">Current time</h6>
            <h6 class="mb-0 mt-2" style="font-weight: 700;">26 Sept 2023, 12:10 PM</h6>
             
          </div>
          <div class="card-icon">
            <span class="avatar-initial rounded bg-label-info p-2">
              <i class="ti ti-clock ti-md"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row  mt-4">
    <div class="col-xl-4 col-12 mb-4">
      <div class="card">
        <div class="card-header header-elements">
          <h5 class="card-title mb-0">Weekly leave pattern</h5>
          <div class="card-action-element ms-auto py-0">
            <div class="dropdown">
              <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-calendar"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>
                </li>
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>
                </li>
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a>
                </li>
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a>
                </li>
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <canvas id="barChart" class="chartjs" data-height="400" height="500" style="display: block; box-sizing: border-box; height: 400px; width: 545px;" width="682"></canvas>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Monthly stats</h5>
            <small class="text-muted">Weekly Earnings Overview</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="earningReports" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ti ti-dots-vertical ti-sm text-muted"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReports">
              <a class="dropdown-item" href="javascript:void(0);">Download</a>
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
            </div>
          </div>
        </div>
        <div class="card-body pb-0" style="position: relative;">
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
                  <small class="text-muted">12.4k Sales</small>
                </div>
                <div class="user-progress d-flex align-items-center gap-3">
                  <small>$1,619</small>
                  <div class="d-flex align-items-center gap-1">
                    <i class="ti ti-chevron-up text-success"></i>
                    <small class="text-muted">18.6%</small>
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
                  <small>$3,571</small>
                  <div class="d-flex align-items-center gap-1">
                    <i class="ti ti-chevron-up text-success"></i>
                    <small class="text-muted">39.6%</small>
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
                  <small class="text-muted">ADVT, Marketing</small>
                </div>
                <div class="user-progress d-flex align-items-center gap-3">
                  <small>$430</small>
                  <div class="d-flex align-items-center gap-1">
                    <i class="ti ti-chevron-up text-success"></i>
                    <small class="text-muted">52.8%</small>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          <div id="reportBarChart" style="min-height: 215px;">
            <div id="apexchartsnxk9hyb3" class="apexcharts-canvas apexchartsnxk9hyb3 apexcharts-theme-light" style="width: 340px; height: 200px;">
              <svg id="SvgjsSvg1994" width="340" height="200" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                <g id="SvgjsG1996" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 10)">
                  <defs id="SvgjsDefs1995">
                    <linearGradient id="SvgjsLinearGradient1999" x1="0" y1="0" x2="0" y2="1">
                      <stop id="SvgjsStop2000" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                      <stop id="SvgjsStop2001" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                      <stop id="SvgjsStop2002" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                    </linearGradient>
                    <clipPath id="gridRectMasknxk9hyb3">
                      <rect id="SvgjsRect2004" width="354" height="150.40640030860902" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                    </clipPath>
                    <clipPath id="forecastMasknxk9hyb3"></clipPath>
                    <clipPath id="nonForecastMasknxk9hyb3"></clipPath>
                    <clipPath id="gridRectMarkerMasknxk9hyb3">
                      <rect id="SvgjsRect2005" width="354" height="154.40640030860902" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                    </clipPath>
                  </defs>
                  <rect id="SvgjsRect2003" width="30" height="150.40640030860902" x="60" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1999)" class="apexcharts-xcrosshairs" y2="150.40640030860902" filter="none" fill-opacity="0.9" x1="60" x2="60"></rect>
                  <g id="SvgjsG2024" class="apexcharts-xaxis" transform="translate(0, 0)">
                    <g id="SvgjsG2025" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                      <text id="SvgjsText2027" font-family="Helvetica, Arial, sans-serif" x="25" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2028">Mo</tspan>
                        <title>Mo</title>
                      </text>
                      <text id="SvgjsText2030" font-family="Helvetica, Arial, sans-serif" x="75" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2031">Tu</tspan>
                        <title>Tu</title>
                      </text>
                      <text id="SvgjsText2033" font-family="Helvetica, Arial, sans-serif" x="125" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2034">We</tspan>
                        <title>We</title>
                      </text>
                      <text id="SvgjsText2036" font-family="Helvetica, Arial, sans-serif" x="175" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2037">Th</tspan>
                        <title>Th</title>
                      </text>
                      <text id="SvgjsText2039" font-family="Helvetica, Arial, sans-serif" x="225" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2040">Fr</tspan>
                        <title>Fr</title>
                      </text>
                      <text id="SvgjsText2042" font-family="Helvetica, Arial, sans-serif" x="275" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2043">Sa</tspan>
                        <title>Sa</title>
                      </text>
                      <text id="SvgjsText2045" font-family="Helvetica, Arial, sans-serif" x="325" y="179.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan2046">Su</tspan>
                        <title>Su</title>
                      </text>
                    </g>
                  </g>
                  <g id="SvgjsG2049" class="apexcharts-grid">
                    <g id="SvgjsG2050" class="apexcharts-gridlines-horizontal" style="display: none;">
                      <line id="SvgjsLine2052" x1="0" y1="0" x2="350" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      <line id="SvgjsLine2053" x1="0" y1="30.081280061721806" x2="350" y2="30.081280061721806" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      <line id="SvgjsLine2054" x1="0" y1="60.16256012344361" x2="350" y2="60.16256012344361" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      <line id="SvgjsLine2055" x1="0" y1="90.24384018516542" x2="350" y2="90.24384018516542" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      <line id="SvgjsLine2056" x1="0" y1="120.32512024688722" x2="350" y2="120.32512024688722" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      <line id="SvgjsLine2057" x1="0" y1="150.40640030860902" x2="350" y2="150.40640030860902" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                    </g>
                    <g id="SvgjsG2051" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                    <line id="SvgjsLine2059" x1="0" y1="150.40640030860902" x2="350" y2="150.40640030860902" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                    <line id="SvgjsLine2058" x1="0" y1="1" x2="0" y2="150.40640030860902" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                  </g>
                  <g id="SvgjsG2006" class="apexcharts-bar-series apexcharts-plot-series">
                    <g id="SvgjsG2007" class="apexcharts-series" rel="1" seriesName="seriesx1" data:realIndex="0">
                      <path id="SvgjsPath2011" d="M 10 146.40640030860902L 10 94.24384018516541Q 10 90.24384018516541 14 90.24384018516541L 36 90.24384018516541Q 40 90.24384018516541 40 94.24384018516541L 40 94.24384018516541L 40 146.40640030860902Q 40 150.40640030860902 36 150.40640030860902L 14 150.40640030860902Q 10 150.40640030860902 10 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 10 146.40640030860902L 10 94.24384018516541Q 10 90.24384018516541 14 90.24384018516541L 36 90.24384018516541Q 40 90.24384018516541 40 94.24384018516541L 40 94.24384018516541L 40 146.40640030860902Q 40 150.40640030860902 36 150.40640030860902L 14 150.40640030860902Q 10 150.40640030860902 10 146.40640030860902z" pathFrom="M 10 146.40640030860902L 10 146.40640030860902L 40 146.40640030860902L 40 146.40640030860902L 40 146.40640030860902L 40 146.40640030860902L 40 146.40640030860902L 10 146.40640030860902" cy="90.24384018516541" cx="60" j="0" val="40" barHeight="60.16256012344361" barWidth="30"></path>
                      <path id="SvgjsPath2013" d="M 60 146.40640030860902L 60 11.520320015430457Q 60 7.520320015430457 64 7.520320015430457L 86 7.520320015430457Q 90 7.520320015430457 90 11.520320015430457L 90 11.520320015430457L 90 146.40640030860902Q 90 150.40640030860902 86 150.40640030860902L 64 150.40640030860902Q 60 150.40640030860902 60 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 60 146.40640030860902L 60 11.520320015430457Q 60 7.520320015430457 64 7.520320015430457L 86 7.520320015430457Q 90 7.520320015430457 90 11.520320015430457L 90 11.520320015430457L 90 146.40640030860902Q 90 150.40640030860902 86 150.40640030860902L 64 150.40640030860902Q 60 150.40640030860902 60 146.40640030860902z" pathFrom="M 60 146.40640030860902L 60 146.40640030860902L 90 146.40640030860902L 90 146.40640030860902L 90 146.40640030860902L 90 146.40640030860902L 90 146.40640030860902L 60 146.40640030860902" cy="7.520320015430457" cx="110" j="1" val="95" barHeight="142.88608029317857" barWidth="30"></path>
                      <path id="SvgjsPath2015" d="M 110 146.40640030860902L 110 64.16256012344361Q 110 60.16256012344361 114 60.16256012344361L 136 60.16256012344361Q 140 60.16256012344361 140 64.16256012344361L 140 64.16256012344361L 140 146.40640030860902Q 140 150.40640030860902 136 150.40640030860902L 114 150.40640030860902Q 110 150.40640030860902 110 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 110 146.40640030860902L 110 64.16256012344361Q 110 60.16256012344361 114 60.16256012344361L 136 60.16256012344361Q 140 60.16256012344361 140 64.16256012344361L 140 64.16256012344361L 140 146.40640030860902Q 140 150.40640030860902 136 150.40640030860902L 114 150.40640030860902Q 110 150.40640030860902 110 146.40640030860902z" pathFrom="M 110 146.40640030860902L 110 146.40640030860902L 140 146.40640030860902L 140 146.40640030860902L 140 146.40640030860902L 140 146.40640030860902L 140 146.40640030860902L 110 146.40640030860902" cy="60.16256012344361" cx="160" j="2" val="60" barHeight="90.24384018516541" barWidth="30"></path>
                      <path id="SvgjsPath2017" d="M 160 146.40640030860902L 160 86.72352016973495Q 160 82.72352016973495 164 82.72352016973495L 186 82.72352016973495Q 190 82.72352016973495 190 86.72352016973495L 190 86.72352016973495L 190 146.40640030860902Q 190 150.40640030860902 186 150.40640030860902L 164 150.40640030860902Q 160 150.40640030860902 160 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 160 146.40640030860902L 160 86.72352016973495Q 160 82.72352016973495 164 82.72352016973495L 186 82.72352016973495Q 190 82.72352016973495 190 86.72352016973495L 190 86.72352016973495L 190 146.40640030860902Q 190 150.40640030860902 186 150.40640030860902L 164 150.40640030860902Q 160 150.40640030860902 160 146.40640030860902z" pathFrom="M 160 146.40640030860902L 160 146.40640030860902L 190 146.40640030860902L 190 146.40640030860902L 190 146.40640030860902L 190 146.40640030860902L 190 146.40640030860902L 160 146.40640030860902" cy="82.72352016973495" cx="210" j="3" val="45" barHeight="67.68288013887407" barWidth="30"></path>
                      <path id="SvgjsPath2019" d="M 210 146.40640030860902L 210 19.040640030860885Q 210 15.040640030860885 214 15.040640030860885L 236 15.040640030860885Q 240 15.040640030860885 240 19.040640030860885L 240 19.040640030860885L 240 146.40640030860902Q 240 150.40640030860902 236 150.40640030860902L 214 150.40640030860902Q 210 150.40640030860902 210 146.40640030860902z" fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 210 146.40640030860902L 210 19.040640030860885Q 210 15.040640030860885 214 15.040640030860885L 236 15.040640030860885Q 240 15.040640030860885 240 19.040640030860885L 240 19.040640030860885L 240 146.40640030860902Q 240 150.40640030860902 236 150.40640030860902L 214 150.40640030860902Q 210 150.40640030860902 210 146.40640030860902z" pathFrom="M 210 146.40640030860902L 210 146.40640030860902L 240 146.40640030860902L 240 146.40640030860902L 240 146.40640030860902L 240 146.40640030860902L 240 146.40640030860902L 210 146.40640030860902" cy="15.040640030860885" cx="260" j="4" val="90" barHeight="135.36576027774814" barWidth="30"></path>
                      <path id="SvgjsPath2021" d="M 260 146.40640030860902L 260 79.20320015430451Q 260 75.20320015430451 264 75.20320015430451L 286 75.20320015430451Q 290 75.20320015430451 290 79.20320015430451L 290 79.20320015430451L 290 146.40640030860902Q 290 150.40640030860902 286 150.40640030860902L 264 150.40640030860902Q 260 150.40640030860902 260 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 260 146.40640030860902L 260 79.20320015430451Q 260 75.20320015430451 264 75.20320015430451L 286 75.20320015430451Q 290 75.20320015430451 290 79.20320015430451L 290 79.20320015430451L 290 146.40640030860902Q 290 150.40640030860902 286 150.40640030860902L 264 150.40640030860902Q 260 150.40640030860902 260 146.40640030860902z" pathFrom="M 260 146.40640030860902L 260 146.40640030860902L 290 146.40640030860902L 290 146.40640030860902L 290 146.40640030860902L 290 146.40640030860902L 290 146.40640030860902L 260 146.40640030860902" cy="75.20320015430451" cx="310" j="5" val="50" barHeight="75.20320015430451" barWidth="30"></path>
                      <path id="SvgjsPath2023" d="M 310 146.40640030860902L 310 41.601600077152256Q 310 37.601600077152256 314 37.601600077152256L 336 37.601600077152256Q 340 37.601600077152256 340 41.601600077152256L 340 41.601600077152256L 340 146.40640030860902Q 340 150.40640030860902 336 150.40640030860902L 314 150.40640030860902Q 310 150.40640030860902 310 146.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMasknxk9hyb3)" pathTo="M 310 146.40640030860902L 310 41.601600077152256Q 310 37.601600077152256 314 37.601600077152256L 336 37.601600077152256Q 340 37.601600077152256 340 41.601600077152256L 340 41.601600077152256L 340 146.40640030860902Q 340 150.40640030860902 336 150.40640030860902L 314 150.40640030860902Q 310 150.40640030860902 310 146.40640030860902z" pathFrom="M 310 146.40640030860902L 310 146.40640030860902L 340 146.40640030860902L 340 146.40640030860902L 340 146.40640030860902L 340 146.40640030860902L 340 146.40640030860902L 310 146.40640030860902" cy="37.601600077152256" cx="360" j="6" val="75" barHeight="112.80480023145677" barWidth="30"></path>
                      <g id="SvgjsG2009" class="apexcharts-bar-goals-markers" style="pointer-events: none">
                        <g id="SvgjsG2010" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2012" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2014" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2016" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2018" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2020" className="apexcharts-bar-goals-groups"></g>
                        <g id="SvgjsG2022" className="apexcharts-bar-goals-groups"></g>
                      </g>
                    </g>
                    <g id="SvgjsG2008" class="apexcharts-datalabels" data:realIndex="0"></g>
                  </g>
                  <line id="SvgjsLine2060" x1="0" y1="0" x2="350" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                  <line id="SvgjsLine2061" x1="0" y1="0" x2="350" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                  <g id="SvgjsG2062" class="apexcharts-yaxis-annotations"></g>
                  <g id="SvgjsG2063" class="apexcharts-xaxis-annotations"></g>
                  <g id="SvgjsG2064" class="apexcharts-point-annotations"></g>
                </g>
                <g id="SvgjsG2047" class="apexcharts-yaxis" rel="0" transform="translate(-8, 0)">
                  <g id="SvgjsG2048" class="apexcharts-yaxis-texts-g"></g>
                </g>
                <g id="SvgjsG1997" class="apexcharts-annotations"></g>
              </svg>
              <div class="apexcharts-legend" style="max-height: 100px;"></div>
              <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 75px; top: -17.3375px;">
                <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">Tu</div>
                <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;">
                  <span class="apexcharts-tooltip-marker" style="background-color: rgba(115, 103, 240, 0.16);"></span>
                  <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                    <div class="apexcharts-tooltip-y-group">
                      <span class="apexcharts-tooltip-text-y-label">series-1: </span>
                      <span class="apexcharts-tooltip-text-y-value">95</span>
                    </div>
                    <div class="apexcharts-tooltip-goals-group">
                      <span class="apexcharts-tooltip-text-goals-label"></span>
                      <span class="apexcharts-tooltip-text-goals-value"></span>
                    </div>
                    <div class="apexcharts-tooltip-z-group">
                      <span class="apexcharts-tooltip-text-z-label"></span>
                      <span class="apexcharts-tooltip-text-z-value"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                <div class="apexcharts-yaxistooltip-text"></div>
              </div>
            </div>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 389px; height: 401px;"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4 order-1 order-xl-0">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title m-0 me-2">
            <h5 class="m-0 me-2">Consumed leave types</h5>
            <small class="text-muted">Counter April 2022</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="employeeList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ti ti-dots-vertical ti-sm text-muted"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="employeeList">
              <a class="dropdown-item" href="javascript:void(0);">Download</a>
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">
            <li class="d-flex mb-4 pb-1 align-items-center">
              <!-- <span class="circle_status">&nbsp;</span> -->
              <div class="d-flex w-100 align-items-center gap-2" style="position: relative;">
                <div class="d-flex justify-content-between flex-grow-1 flex-wrap">
                  <div>
                    <h6 class="mb-0">Privilege Leave</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-2">
                    <h6 class="mb-0" style="
    color: #b3b5b8;
">90.4%</h6>
                  </div>
                </div>
                <div class="chart-progress" data-color="secondary" data-series="85" style="min-height: 35.7px;"> sdfsdfsd
                  <div id="apexcharts5rfu14o2" class="apexcharts-canvas apexcharts5rfu14o2 apexcharts-theme-light" style="width: 43px; height: 35.7px;">
                    <svg id="SvgjsSvg1712" width="43" height="35.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                      <g id="SvgjsG1714" class="apexcharts-inner apexcharts-graphical" transform="translate(-5, -15)">
                        <defs id="SvgjsDefs1713">
                          <clipPath id="gridRectMask5rfu14o2">
                            <rect id="SvgjsRect1716" width="69" height="75" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <clipPath id="forecastMask5rfu14o2"></clipPath>
                          <clipPath id="nonForecastMask5rfu14o2"></clipPath>
                          <clipPath id="gridRectMarkerMask5rfu14o2">
                            <rect id="SvgjsRect1717" width="67" height="77" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                        </defs>
                        <g id="SvgjsG1718" class="apexcharts-radialbar">
                          <g id="SvgjsG1719">
                            <g id="SvgjsG1720" class="apexcharts-tracks">
                              <g id="SvgjsG1721" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                                <path id="apexcharts-radialbarTrack-0" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428" fill="none" fill-opacity="1" stroke="#a8aaae29" stroke-opacity="1" stroke-linecap="round" stroke-width="3.186568292682929" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428"></path>
                              </g>
                            </g>
                            <g id="SvgjsG1723">
                              <g id="SvgjsG1725" class="apexcharts-series apexcharts-radial-series" seriesName="Progress" rel="1" data:realIndex="0">
                                <path id="SvgjsPath1726" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 19.52329268315146 22.798412788836565" fill="none" fill-opacity="0.85" stroke="rgba(168,170,174,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="3.285121951219514" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="306" data:value="85" index="0" j="0" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 19.52329268315146 22.798412788836565"></path>
                              </g>
                              <circle id="SvgjsCircle1724" r="8.210740243902439" cx="31.5" cy="31.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                            </g>
                          </g>
                        </g>
                        <line id="SvgjsLine1727" x1="0" y1="0" x2="63" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine1728" x1="0" y1="0" x2="63" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                      </g>
                      <g id="SvgjsG1715" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend"></div>
                  </div>
                </div>
                <div class="resize-triggers">
                  <div class="expand-trigger">
                    <div style="width: 297px; height: 37px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
                </div>
              </div>
            </li>
            <li class="d-flex mb-4 pb-1 align-items-center">
              <div class="d-flex w-100 align-items-center gap-2" style="position: relative;">
                <div class="d-flex justify-content-between flex-grow-1 flex-wrap">
                  <div>
                    <h6 class="mb-0">Casual leave</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-2">
                    <h6 class="mb-0" style="
    color: #46cd82;
">70.6%</h6>
                  </div>
                </div>
                <div class="chart-progress" data-color="success" data-series="70" style="min-height: 35.7px;">
                  <div id="apexcharts7e79hykbl" class="apexcharts-canvas apexcharts7e79hykbl apexcharts-theme-light" style="width: 43px; height: 35.7px;">
                    <svg id="SvgjsSvg1729" width="43" height="35.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                      <g id="SvgjsG1731" class="apexcharts-inner apexcharts-graphical" transform="translate(-5, -15)">
                        <defs id="SvgjsDefs1730">
                          <clipPath id="gridRectMask7e79hykbl">
                            <rect id="SvgjsRect1733" width="69" height="75" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <clipPath id="forecastMask7e79hykbl"></clipPath>
                          <clipPath id="nonForecastMask7e79hykbl"></clipPath>
                          <clipPath id="gridRectMarkerMask7e79hykbl">
                            <rect id="SvgjsRect1734" width="67" height="77" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                        </defs>
                        <g id="SvgjsG1735" class="apexcharts-radialbar">
                          <g id="SvgjsG1736">
                            <g id="SvgjsG1737" class="apexcharts-tracks">
                              <g id="SvgjsG1738" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                                <path id="apexcharts-radialbarTrack-0" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428" fill="none" fill-opacity="1" stroke="#a8aaae29" stroke-opacity="1" stroke-linecap="round" stroke-width="3.186568292682929" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428"></path>
                              </g>
                            </g>
                            <g id="SvgjsG1740">
                              <g id="SvgjsG1742" class="apexcharts-series apexcharts-radial-series" seriesName="Progress" rel="1" data:realIndex="0">
                                <path id="SvgjsPath1743" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 17.42053613626615 36.074695121726585" fill="none" fill-opacity="0.85" stroke="rgba(40,199,111,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="3.285121951219514" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="252" data:value="70" index="0" j="0" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 17.42053613626615 36.074695121726585"></path>
                              </g>
                              <circle id="SvgjsCircle1741" r="8.210740243902439" cx="31.5" cy="31.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                            </g>
                          </g>
                        </g>
                        <line id="SvgjsLine1744" x1="0" y1="0" x2="63" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine1745" x1="0" y1="0" x2="63" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                      </g>
                      <g id="SvgjsG1732" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend"></div>
                  </div>
                </div>
                <div class="resize-triggers">
                  <div class="expand-trigger">
                    <div style="width: 297px; height: 37px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
                </div>
              </div>
            </li>
            <li class="d-flex mb-4 pb-1 align-items-center">
              <div class="d-flex w-100 align-items-center gap-2" style="position: relative;">
                <div class="d-flex justify-content-between flex-grow-1 flex-wrap">
                  <div>
                    <h6 class="mb-0">Sick Leave</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-2">
                    <h6 class="mb-0" style="color: #867cf0;">35.5%</h6>
                  </div>
                </div>
                <div class="chart-progress" data-color="primary" data-series="25" style="min-height: 35.7px;">
                  <div id="apexcharts0nbov9ig" class="apexcharts-canvas apexcharts0nbov9ig apexcharts-theme-light" style="width: 43px; height: 35.7px;">
                    <svg id="SvgjsSvg1746" width="43" height="35.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                      <g id="SvgjsG1748" class="apexcharts-inner apexcharts-graphical" transform="translate(-5, -15)">
                        <defs id="SvgjsDefs1747">
                          <clipPath id="gridRectMask0nbov9ig">
                            <rect id="SvgjsRect1750" width="69" height="75" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <clipPath id="forecastMask0nbov9ig"></clipPath>
                          <clipPath id="nonForecastMask0nbov9ig"></clipPath>
                          <clipPath id="gridRectMarkerMask0nbov9ig">
                            <rect id="SvgjsRect1751" width="67" height="77" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                        </defs>
                        <g id="SvgjsG1752" class="apexcharts-radialbar">
                          <g id="SvgjsG1753">
                            <g id="SvgjsG1754" class="apexcharts-tracks">
                              <g id="SvgjsG1755" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                                <path id="apexcharts-radialbarTrack-0" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428" fill="none" fill-opacity="1" stroke="#a8aaae29" stroke-opacity="1" stroke-linecap="round" stroke-width="3.186568292682929" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428"></path>
                              </g>
                            </g>
                            <g id="SvgjsG1757">
                              <g id="SvgjsG1759" class="apexcharts-series apexcharts-radial-series" seriesName="Progress" rel="1" data:realIndex="0">
                                <path id="SvgjsPath1760" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 0 1 46.3040243902439 31.5" fill="none" fill-opacity="0.85" stroke="rgba(115,103,240,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="3.285121951219514" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="90" data:value="25" index="0" j="0" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 0 1 46.3040243902439 31.5"></path>
                              </g>
                              <circle id="SvgjsCircle1758" r="8.210740243902439" cx="31.5" cy="31.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                            </g>
                          </g>
                        </g>
                        <line id="SvgjsLine1761" x1="0" y1="0" x2="63" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine1762" x1="0" y1="0" x2="63" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                      </g>
                      <g id="SvgjsG1749" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend"></div>
                  </div>
                </div>
                <div class="resize-triggers">
                  <div class="expand-trigger">
                    <div style="width: 297px; height: 37px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
                </div>
              </div>
            </li>
            <li class="d-flex mb-4 pb-1 align-items-center">
              <div class="d-flex w-100 align-items-center gap-2" style="position: relative;">
                <div class="d-flex justify-content-between flex-grow-1 flex-wrap">
                  <div>
                    <h6 class="mb-0">Maternity Leave</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-2">
                    <h6 class="mb-0" style="
    color: #eb6b6c;
">80.0%</h6>
                  </div>
                </div>
                <div class="chart-progress" data-color="danger" data-series="75" style="min-height: 35.7px;">
                  <div id="apexcharts7qi4aydr" class="apexcharts-canvas apexcharts7qi4aydr apexcharts-theme-light" style="width: 43px; height: 35.7px;">
                    <svg id="SvgjsSvg1763" width="43" height="35.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                      <g id="SvgjsG1765" class="apexcharts-inner apexcharts-graphical" transform="translate(-5, -15)">
                        <defs id="SvgjsDefs1764">
                          <clipPath id="gridRectMask7qi4aydr">
                            <rect id="SvgjsRect1767" width="69" height="75" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <clipPath id="forecastMask7qi4aydr"></clipPath>
                          <clipPath id="nonForecastMask7qi4aydr"></clipPath>
                          <clipPath id="gridRectMarkerMask7qi4aydr">
                            <rect id="SvgjsRect1768" width="67" height="77" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                        </defs>
                        <g id="SvgjsG1769" class="apexcharts-radialbar">
                          <g id="SvgjsG1770">
                            <g id="SvgjsG1771" class="apexcharts-tracks">
                              <g id="SvgjsG1772" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                                <path id="apexcharts-radialbarTrack-0" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428" fill="none" fill-opacity="1" stroke="#a8aaae29" stroke-opacity="1" stroke-linecap="round" stroke-width="3.186568292682929" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428"></path>
                              </g>
                            </g>
                            <g id="SvgjsG1774">
                              <g id="SvgjsG1776" class="apexcharts-series apexcharts-radial-series" seriesName="Progress" rel="1" data:realIndex="0">
                                <path id="SvgjsPath1777" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 16.695975609756097 31.500000000000004" fill="none" fill-opacity="0.85" stroke="rgba(234,84,85,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="3.285121951219514" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="270" data:value="75" index="0" j="0" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 16.695975609756097 31.500000000000004"></path>
                              </g>
                              <circle id="SvgjsCircle1775" r="8.210740243902439" cx="31.5" cy="31.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                            </g>
                          </g>
                        </g>
                        <line id="SvgjsLine1778" x1="0" y1="0" x2="63" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine1779" x1="0" y1="0" x2="63" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                      </g>
                      <g id="SvgjsG1766" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend"></div>
                  </div>
                </div>
                <div class="resize-triggers">
                  <div class="expand-trigger">
                    <div style="width: 297px; height: 37px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
                </div>
              </div>
            </li>
            <li class="d-flex mb-4 pb-1 align-items-center">
              <div class="d-flex w-100 align-items-center gap-2" style="position: relative;">
                <div class="d-flex justify-content-between flex-grow-1 flex-wrap">
                  <div>
                    <h6 class="mb-0">Internet Explorer</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-2">
                    <h6 class="mb-0" style="
    color: #24d4e9;
">62.2%</h6>
                  </div>
                </div>
                <div class="chart-progress" data-color="info" data-series="60" style="min-height: 35.7px;">
                  <div id="apexchartse6u4ut44" class="apexcharts-canvas apexchartse6u4ut44 apexcharts-theme-light" style="width: 43px; height: 35.7px;">
                    <svg id="SvgjsSvg1780" width="43" height="35.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                      <g id="SvgjsG1782" class="apexcharts-inner apexcharts-graphical" transform="translate(-5, -15)">
                        <defs id="SvgjsDefs1781">
                          <clipPath id="gridRectMaske6u4ut44">
                            <rect id="SvgjsRect1784" width="69" height="75" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <clipPath id="forecastMaske6u4ut44"></clipPath>
                          <clipPath id="nonForecastMaske6u4ut44"></clipPath>
                          <clipPath id="gridRectMarkerMaske6u4ut44">
                            <rect id="SvgjsRect1785" width="67" height="77" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                        </defs>
                        <g id="SvgjsG1786" class="apexcharts-radialbar">
                          <g id="SvgjsG1787">
                            <g id="SvgjsG1788" class="apexcharts-tracks">
                              <g id="SvgjsG1789" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                                <path id="apexcharts-radialbarTrack-0" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428" fill="none" fill-opacity="1" stroke="#a8aaae29" stroke-opacity="1" stroke-linecap="round" stroke-width="3.186568292682929" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428"></path>
                              </g>
                            </g>
                            <g id="SvgjsG1791">
                              <g id="SvgjsG1793" class="apexcharts-series apexcharts-radial-series" seriesName="Progress" rel="1" data:realIndex="0">
                                <path id="SvgjsPath1794" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 22.798412788836565 43.47670731684853" fill="none" fill-opacity="0.85" stroke="rgba(0,207,232,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="3.285121951219514" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="216" data:value="60" index="0" j="0" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 22.798412788836565 43.47670731684853"></path>
                              </g>
                              <circle id="SvgjsCircle1792" r="8.210740243902439" cx="31.5" cy="31.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                            </g>
                          </g>
                        </g>
                        <line id="SvgjsLine1795" x1="0" y1="0" x2="63" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine1796" x1="0" y1="0" x2="63" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                      </g>
                      <g id="SvgjsG1783" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend"></div>
                  </div>
                </div>
                <div class="resize-triggers">
                  <div class="expand-trigger">
                    <div style="width: 297px; height: 37px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center">
              <div class="d-flex w-100 align-items-center gap-2" style="position: relative;">
                <div class="d-flex justify-content-between flex-grow-1 flex-wrap">
                  <div>
                    <h6 class="mb-0">Brave</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-2">
                    <h6 class="mb-0" style="
    color: #fdab5d;
">46.3%</h6>
                  </div>
                </div>
                <div class="chart-progress" data-color="warning" data-series="45" style="min-height: 35.7px;">
                  <div id="apexcharts9umuwav7" class="apexcharts-canvas apexcharts9umuwav7 apexcharts-theme-light" style="width: 43px; height: 35.7px;">
                    <svg id="SvgjsSvg1797" width="43" height="35.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                      <g id="SvgjsG1799" class="apexcharts-inner apexcharts-graphical" transform="translate(-5, -15)">
                        <defs id="SvgjsDefs1798">
                          <clipPath id="gridRectMask9umuwav7">
                            <rect id="SvgjsRect1801" width="69" height="75" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <clipPath id="forecastMask9umuwav7"></clipPath>
                          <clipPath id="nonForecastMask9umuwav7"></clipPath>
                          <clipPath id="gridRectMarkerMask9umuwav7">
                            <rect id="SvgjsRect1802" width="67" height="77" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                        </defs>
                        <g id="SvgjsG1803" class="apexcharts-radialbar">
                          <g id="SvgjsG1804">
                            <g id="SvgjsG1805" class="apexcharts-tracks">
                              <g id="SvgjsG1806" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                                <path id="apexcharts-radialbarTrack-0" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428" fill="none" fill-opacity="1" stroke="#a8aaae29" stroke-opacity="1" stroke-linecap="round" stroke-width="3.186568292682929" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 1 1 31.49741621033156 16.69597583523428"></path>
                              </g>
                            </g>
                            <g id="SvgjsG1808">
                              <g id="SvgjsG1810" class="apexcharts-series apexcharts-radial-series" seriesName="Progress" rel="1" data:realIndex="0">
                                <path id="SvgjsPath1811" d="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 0 1 36.074695121726585 45.57946386373385" fill="none" fill-opacity="0.85" stroke="rgba(255,159,67,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="3.285121951219514" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="162" data:value="45" index="0" j="0" data:pathOrig="M 31.5 16.695975609756097 A 14.804024390243903 14.804024390243903 0 0 1 36.074695121726585 45.57946386373385"></path>
                              </g>
                              <circle id="SvgjsCircle1809" r="8.210740243902439" cx="31.5" cy="31.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                            </g>
                          </g>
                        </g>
                        <line id="SvgjsLine1812" x1="0" y1="0" x2="63" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine1813" x1="0" y1="0" x2="63" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                      </g>
                      <g id="SvgjsG1800" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend"></div>
                  </div>
                </div>
                <div class="resize-triggers">
                  <div class="expand-trigger">
                    <div style="width: 297px; height: 37px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row  mt-4">
    <!-- Timeline Basic-->
    <div class="col-xl-6 mb-4 mb-xl-0">
      <div class="card">
        <h5 class="card-header">My Leaves</h5>
        <div class="card-body pb-0">
          <ul class="timeline mb-0">
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                  <h6 class="mb-0">29 September 2023 - 30 September 2023</h6>
                  <button class="btn btn-warning waves-effect waves-light" style="
    padding: 6px 5px;
    margin-bottom: 9px;
">Pending</button>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-2">
                  <div class="d-flex align-items-center">
                    <span>Charles de Gaulle Airport, Paris</span>
                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                    <span>Heathrow Airport, London</span>
                  </div>
                  <div>
                    <span class="text-muted">6:30 AM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">
                  <span class="mb-0">bookingCard.pdf</span>
                </div>
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                  <h6 class="mb-0">29 September 2023 - 30 September 2023</h6>
                  <button class="btn btn-success waves-effect waves-light" style="
    padding: 6px 5px;
    margin-bottom: 9px;
">Approved</button>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-2">
                  <div class="d-flex align-items-center">
                    <span>Charles de Gaulle Airport, Paris</span>
                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                    <span>Heathrow Airport, London</span>
                  </div>
                  <div>
                    <span class="text-muted">6:30 AM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">
                  <span class="mb-0">bookingCard.pdf</span>
                </div>
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                  <h6 class="mb-0">29 September 2023 - 30 September 2023</h6>
                  <button class="btn btn-success waves-effect waves-light" style="
    padding: 6px 5px;
    margin-bottom: 9px;
">Approved</button>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-2">
                  <div class="d-flex align-items-center">
                    <span>Charles de Gaulle Airport, Paris</span>
                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                    <span>Heathrow Airport, London</span>
                  </div>
                  <div>
                    <span class="text-muted">6:30 AM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">
                  <span class="mb-0">bookingCard.pdf</span>
                </div>
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                  <h6 class="mb-0">29 September 2023 - 30 September 2023</h6>
                  <button class="btn btn-danger waves-effect waves-light" style="
    padding: 6px 5px;
    margin-bottom: 9px;
">Rejected</button>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-2">
                  <div class="d-flex align-items-center">
                    <span>Charles de Gaulle Airport, Paris</span>
                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                    <span>Heathrow Airport, London</span>
                  </div>
                  <div>
                    <span class="text-muted">6:30 AM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">
                  <span class="mb-0">bookingCard.pdf</span>
                </div>
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                  <h6 class="mb-0">29 September 2023 - 30 September 2023</h6>
                  <button class="btn btn-success waves-effect waves-light" style="
    padding: 6px 5px;
    margin-bottom: 9px;
">Approved</button>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-2">
                  <div class="d-flex align-items-center">
                    <span>Charles de Gaulle Airport, Paris</span>
                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                    <span>Heathrow Airport, London</span>
                  </div>
                  <div>
                    <span class="text-muted">6:30 AM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">
                  <span class="mb-0">bookingCard.pdf</span>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Timeline Basic -->
    <!-- Timeline Advanced-->
    <div class="col-xl-6">
      <div class="card">
        <h5 class="card-header">Advanced</h5>
        <div class="card-body pb-0">
          <ul class="timeline pt-3">
            <li class="timeline-item pb-4 timeline-item-primary border-left-dashed">
              <span class="timeline-indicator-advanced timeline-indicator-primary">
                <i class="ti ti-send rounded-circle scaleX-n1-rtl"></i>
              </span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                  <h6 class="mb-0">Get on the flight</h6>
                  <span class="text-muted">3rd October</span>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-2">
                  <div class="d-flex align-items-center">
                    <span>Charles de Gaulle Airport, Paris</span>
                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                    <span>Heathrow Airport, London</span>
                  </div>
                  <div>
                    <span>6:30 AM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">
                  <span class="mb-0">bookingCard.pdf</span>
                </div>
              </div>
            </li>
            <li class="timeline-item pb-4 timeline-item-success border-left-dashed">
              <span class="timeline-indicator-advanced timeline-indicator-success">
                <i class="ti ti-brush rounded-circle scaleX-n1-rtl"></i>
              </span>
              <div class="timeline-event pb-3">
                <div class="timeline-header mb-sm-0 mb-3">
                  <h6 class="mb-0">Design Review</h6>
                  <span class="text-muted">4th October</span>
                </div>
                <p> Weekly review of freshly prepared design for our new application. </p>
                <div class="d-flex justify-content-between">
                  <h6>New Application</h6>
                  <div class="d-flex">
                    <div class="avatar avatar-xs me-2">
                      <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="avatar avatar-xs">
                      <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="timeline-item pb-4 timeline-item-danger border-left-dashed">
              <span class="timeline-indicator-advanced timeline-indicator-danger">
                <i class="ti ti-basket rounded-circle"></i>
              </span>
              <div class="timeline-event pb-3">
                <div class="d-flex flex-sm-row flex-column">
                  <img src="../../assets/img/elements/11.jpg" class="rounded me-3" alt="Shoe img" height="62" width="62">
                  <div>
                    <div class="timeline-header flex-wrap mb-2 mt-3 mt-sm-0">
                      <h6 class="mb-0">Sold Puma POPX Blue Color</h6>
                      <span class="text-muted">5th October</span>
                    </div>
                    <p> PUMA presents the latest shoes from its collection. Light &amp; comfortable made with highly durable material. </p>
                  </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-sm-row flex-column text-center">
                  <div class="mb-sm-0 mb-2">
                    <p class="mb-0">Customer</p>
                    <span class="text-muted">Micheal Scott</span>
                  </div>
                  <div class="mb-sm-0 mb-2">
                    <p class="mb-0">Price</p>
                    <span class="text-muted">$375.00</span>
                  </div>
                  <div>
                    <p class="mb-0">Quantity</p>
                    <span class="text-muted">1</span>
                  </div>
                </div>
              </div>
            </li>
            <li class="timeline-item pb-4 timeline-item-info border-left-dashed">
              <span class="timeline-indicator-advanced timeline-indicator-info">
                <i class="ti ti-user-circle rounded-circle"></i>
              </span>
              <div class="timeline-event pb-3">
                <div class="timeline-header">
                  <h6 class="mb-0">Interview Schedule</h6>
                  <span class="text-muted">6th October</span>
                </div>
                <p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus quos, voluptates voluptas rem veniam expedita. </p>
                <hr>
                <div class="d-flex justify-content-between flex-wrap gap-2">
                  <div class="d-flex flex-wrap">
                    <div class="avatar me-3">
                      <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                    </div>
                    <div>
                      <p class="mb-0">Rebecca Godman</p>
                      <span class="text-muted">Javascript Developer</span>
                    </div>
                  </div>
                  <div class="d-flex flex-wrap align-items-center cursor-pointer">
                    <i class="ti ti-brand-hipchat me-2"></i>
                    <i class="ti ti-phone-call"></i>
                  </div>
                </div>
              </div>
            </li>
            <li class="timeline-item pb-0 timeline-item-warning border-transparent">
              <span class="timeline-indicator-advanced timeline-indicator-warning">
                <i class="ti ti-bell rounded-circle"></i>
              </span>
              <div class="timeline-event pb-3">
                <div class="timeline-header">
                  <h6 class="mb-0">2 Notifications</h6>
                  <span class="text-muted">7th October</span>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                    <div class="d-flex flex-wrap align-items-center">
                      <ul class="list-unstyled users-list d-flex align-items-center avatar-group m-0 my-3 me-2">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                          <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Allen Rieske" data-bs-original-title="Allen Rieske">
                          <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Julee Rossignol" data-bs-original-title="Julee Rossignol">
                          <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar">
                        </li>
                      </ul>
                      <span>Commented on your post.</span>
                    </div>
                    <button class="btn btn-outline-primary btn-sm my-sm-0 my-3 waves-effect"> View </button>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap pb-0 px-0">
                    <div class="d-flex flex-sm-row flex-column align-items-center">
                      <img src="../../assets/img/avatars/4.png" class="rounded-circle me-3" alt="avatar" height="24" width="24">
                      <div class="user-info">
                        <p class="my-0">Dwight repaid you</p>
                        <span class="text-muted">30 minutes ago</span>
                      </div>
                    </div>
                    <h5 class="mb-0">$20</h5>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Timeline Advanced-->
  </div>
</div> @endsection