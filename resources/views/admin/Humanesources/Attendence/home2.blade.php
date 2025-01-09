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
}

</style>
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
        <div class="card-body d-flex justify-content-between align-items-center"  style="padding: 20px 12px;">
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
  <div class="row" style="margin-top: 40px;">
    <div class="col-lg-3">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Today</h5>
          <div class="dropdown">
            <div class="marker" style="background-color: #ed3637;padding:2px 8px;color:white;border-radius:30px;"><span>Absent</span></div>
          </div>
        </div>
        <div class="card-body" style="position: relative;">
          <div id="radialBarChart" style="min-height: 347.3px;">
            <div id="apexcharts5uvvh00p" class="apexcharts-canvas apexcharts5uvvh00p apexcharts-theme-light" style="width: 546px; height: 347.3px;position: relative;left:-135px;">
              <svg id="SvgjsSvg5307" width="546" height="347.3000003814697" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                <foreignObject x="0" y="0" width="546" height="347.3000003814697">
                  <div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="inset: auto 0px 1px; position: absolute; max-height: 190px;">
                    <div class="apexcharts-legend-series" rel="1" seriesname="Comments" data:collapsed="false" style="margin: 2px 5px;">
                      <span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(254, 232, 2) !important; color: rgb(254, 232, 2); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span>
                      <span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Comments" data:collapsed="false" style="color: rgb(111, 107, 125); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Comments</span>
                    </div>
                    <div class="apexcharts-legend-series" rel="2" seriesname="Replies" data:collapsed="false" style="margin: 2px 5px;">
                      <span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(63, 208, 189) !important; color: rgb(63, 208, 189); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span>
                      <span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Replies" data:collapsed="false" style="color: rgb(111, 107, 125); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Replies</span>
                    </div>
                    <div class="apexcharts-legend-series" rel="3" seriesname="Shares" data:collapsed="false" style="margin: 2px 5px;">
                      <span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="background: rgb(43, 155, 244) !important; color: rgb(43, 155, 244); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span>
                      <span class="apexcharts-legend-text" rel="3" i="2" data:default-text="Shares" data:collapsed="false" style="color: rgb(111, 107, 125); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Shares</span>
                    </div>
                  </div>
                  <style type="text/css">
                    .apexcharts-legend {
                      display: flex;
                      overflow: auto;
                      padding: 0 10px;
                    }

                    .apexcharts-legend.apx-legend-position-bottom,
                    .apexcharts-legend.apx-legend-position-top {
                      flex-wrap: wrap
                    }

                    .apexcharts-legend.apx-legend-position-right,
                    .apexcharts-legend.apx-legend-position-left {
                      flex-direction: column;
                      bottom: 0;
                    }

                    .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left,
                    .apexcharts-legend.apx-legend-position-top.apexcharts-align-left,
                    .apexcharts-legend.apx-legend-position-right,
                    .apexcharts-legend.apx-legend-position-left {
                      justify-content: flex-start;
                    }

                    .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center,
                    .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                      justify-content: center;
                    }

                    .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right,
                    .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                      justify-content: flex-end;
                    }

                    .apexcharts-legend-series {
                      cursor: pointer;
                      line-height: normal;
                    }

                    .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series,
                    .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series {
                      display: flex;
                      align-items: center;
                    }

                    .apexcharts-legend-text {
                      position: relative;
                      font-size: 14px;
                    }

                    .apexcharts-legend-text *,
                    .apexcharts-legend-marker * {
                      pointer-events: none;
                    }

                    .apexcharts-legend-marker {
                      position: relative;
                      display: inline-block;
                      cursor: pointer;
                      margin-right: 3px;
                      border-style: solid;
                    }

                    .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series,
                    .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series {
                      display: inline-block;
                    }

                    .apexcharts-legend-series.apexcharts-no-click {
                      cursor: auto;
                    }

                    .apexcharts-legend .apexcharts-hidden-zero-series,
                    .apexcharts-legend .apexcharts-hidden-null-series {
                      display: none !important;
                    }

                    .apexcharts-inactive-legend {
                      opacity: 0.45;
                    }
                  </style>
                </foreignObject>
                <g id="SvgjsG5309" class="apexcharts-inner apexcharts-graphical" transform="translate(12, -25)">
                  <defs id="SvgjsDefs5308">
                    <clipPath id="gridRectMask5uvvh00p">
                      <rect id="SvgjsRect5311" width="530" height="364" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                    </clipPath>
                    <clipPath id="forecastMask5uvvh00p"></clipPath>
                    <clipPath id="nonForecastMask5uvvh00p"></clipPath>
                    <clipPath id="gridRectMarkerMask5uvvh00p">
                      <rect id="SvgjsRect5312" width="528" height="366" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                    </clipPath>
                  </defs>
                  <g id="SvgjsG5313" class="apexcharts-radialbar">
                    <g id="SvgjsG5314">
                      <g id="SvgjsG5315" class="apexcharts-tracks">
                        <g id="SvgjsG5316" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                          <path id="apexcharts-radialbarTrack-0" d="M 262 43.79634146341462 A 137.20365853658538 137.20365853658538 0 1 1 261.9760534442491 43.79634355314582" fill="none" fill-opacity="1" stroke="#a8aaae29" stroke-opacity="1" stroke-linecap="round" stroke-width="15.120170731707319" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 262 43.79634146341462 A 137.20365853658538 137.20365853658538 0 1 1 261.9760534442491 43.79634355314582"></path>
                        </g>
                        <g id="SvgjsG5318" class="apexcharts-radialbar-track apexcharts-track" rel="2">
                          <path id="apexcharts-radialbarTrack-1" d="M 262 69.3841463414634 A 111.6158536585366 111.6158536585366 0 1 1 261.98051935866124 69.38414804147007" fill="none" fill-opacity="1" stroke="#a8aaae29" stroke-opacity="1" stroke-linecap="round" stroke-width="15.120170731707319" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 262 69.3841463414634 A 111.6158536585366 111.6158536585366 0 1 1 261.98051935866124 69.38414804147007"></path>
                        </g>
                        <g id="SvgjsG5320" class="apexcharts-radialbar-track apexcharts-track" rel="3">
                          <path id="apexcharts-radialbarTrack-2" d="M 262 94.97195121951219 A 86.02804878048781 86.02804878048781 0 1 1 261.98498527307333 94.9719525297943" fill="none" fill-opacity="1" stroke="#a8aaae29" stroke-opacity="1" stroke-linecap="round" stroke-width="15.120170731707319" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 262 94.97195121951219 A 86.02804878048781 86.02804878048781 0 1 1 261.98498527307333 94.9719525297943" style="
                          display: none;
                          "></path>
                        </g>
                      </g>
                      <g id="SvgjsG5322">
                        <g id="SvgjsG5327" class="apexcharts-series apexcharts-radial-series" seriesName="Comments" rel="1" data:realIndex="0">
                          <path id="SvgjsPath5328" d="M 262 43.79634146341462 A 137.20365853658538 137.20365853658538 0 1 1 131.5115664892453 138.60173782177776" fill="none" fill-opacity="0.85" stroke="rgba(254,232,2,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="15.587804878048782" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="288" data:value="80" index="0" j="0" data:pathOrig="M 262 43.79634146341462 A 137.20365853658538 137.20365853658538 0 1 1 131.5115664892453 138.60173782177776"></path>
                        </g>
                        <g id="SvgjsG5329" class="apexcharts-series apexcharts-radial-series" seriesName="Replies" rel="2" data:realIndex="1">
                          <path id="SvgjsPath5330" d="M 262 69.3841463414634 A 111.6158536585366 111.6158536585366 0 0 1 262 292.6158536585366" fill="none" fill-opacity="0.85" stroke="rgba(63,208,189,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="15.587804878048782" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-1" data:angle="180" data:value="50" index="0" j="1" data:pathOrig="M 262 69.3841463414634 A 111.6158536585366 111.6158536585366 0 0 1 262 292.6158536585366"></path>
                        </g>
                        <g id="SvgjsG5331" class="apexcharts-series apexcharts-radial-series" seriesName="Shares" rel="3" data:realIndex="2">
                          <path id="SvgjsPath5332" d="M 262 94.97195121951219 A 86.02804878048781 86.02804878048781 0 0 1 331.5981534563316 231.56601835666822" fill="none" fill-opacity="0.85" stroke="rgba(43,155,244,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="15.587804878048782" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-2" data:angle="126" data:value="35" index="0" j="2" data:pathOrig="M 262 94.97195121951219 A 86.02804878048781 86.02804878048781 0 0 1 331.5981534563316 231.56601835666822" style="
                          display: none;
                          "></path>
                        </g>
                        <circle id="SvgjsCircle5323" r="73.46796341463417" cx="262" cy="181" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                        <g id="SvgjsG5324" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;">
                          <text id="SvgjsText5325" font-family="Helvetica, Arial, sans-serif" x="262" y="181" text-anchor="middle" dominant-baseline="auto" font-size="1.3rem" font-weight="400" fill="#5d596c" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif; fill: rgb(93, 89, 108);">Comments</text>
                          <text id="SvgjsText5326" font-family="Public Sans" x="262" y="213" text-anchor="middle" dominant-baseline="auto" font-size="1.2rem" font-weight="400" fill="#6f6b7d" class="apexcharts-text apexcharts-datalabel-value" style="font-family: &quot;Public Sans&quot;;">80%</text>
                        </g>
                      </g>
                    </g>
                  </g>
                  <line id="SvgjsLine5333" x1="0" y1="0" x2="524" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                  <line id="SvgjsLine5334" x1="0" y1="0" x2="524" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                </g>
                <g id="SvgjsG5310" class="apexcharts-annotations"></g>
              </svg>
            </div>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 595px; height: 372px;"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
        <div class="btn" style="background-color: #3178EE;color:white;margin:10px;">Mark Present</div>
      </div>
    </div>





    <div class="col-lg-4">
      <div class="h-100">
        <div class="row">
          <div class="col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="badge p-2 bg-label-primary mb-2 rounded"><i class="fas fa-stopwatch" style="font-size: 18px;"></i></div>
                <h5 class="card-title mb-1 pt-1">Average Hours</h5>
                <small class="text-muted">Last week</small>
                <p class="mb-2 mt-1">1.28k</p>
                <div class="pt-1">
                  <span class="badge bg-label-primary">-12.2%</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="badge p-2 bg-label-primary mb-2 rounded"><i class="fas fa-sign-in" style="font-size: 18px;"></i></div>
                <h5 class="card-title mb-1 pt-1">Average Check-in</h5>
                <small class="text-muted">Last week</small>
                <p class="mb-2 mt-1">$4,673</p>
                <div class="pt-1">
                  <span class="badge bg-label-primary">+25.2%</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mt-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="badge p-2 bg-label-success mb-2 rounded"><i class="fa-solid fa-clock" style="font-size: 18px;"></i></div>
                <h5 class="card-title mb-1 pt-1">On-time arrival</h5>
                <small class="text-muted">Last week</small>
                <p class="mb-2 mt-1">1.28k</p>
                <div class="pt-1">
                  <span class="badge bg-label-success">-12.2%</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mt-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="badge p-2 bg-label-danger mb-2 rounded"><i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 18px;"></i></div>
                <h5 class="card-title mb-1 pt-1">Average Check-out</h5>
                <small class="text-muted">Last week</small>
                <p class="mb-2 mt-1">$4,673</p>
                <div class="pt-1">
                  <span class="badge bg-label-danger">+25.2%</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div></div>








      <div class="col-lg-5">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">My Attendance</h5>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="topic" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-dots-vertical"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topic">
                <a class="dropdown-item" href="javascript:void(0);">Highest Views</a>
                <a class="dropdown-item" href="javascript:void(0);">See All</a>
              </div>
            </div>
          </div>
          <div class="card-body row g-3" style="padding-bottom: 0 !important;">
            <div class="col-md-6" style="position: relative;">
              <div id="horizontalBarChart" style="min-height: 375px;">
                <div id="apexcharts2pqvxr75" class="apexcharts-canvas apexcharts2pqvxr75 apexcharts-theme-light" style="width: 368px; height: 360px;">
                  <svg id="SvgjsSvg3258" width="368" height="360" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;width: 60%;">
                    <g id="SvgjsG3260" class="apexcharts-inner apexcharts-graphical" transform="translate(32.30000019073486, -5)">
                      <defs id="SvgjsDefs3259">
                        <linearGradient id="SvgjsLinearGradient3264" x1="0" y1="0" x2="0" y2="1">
                          <stop id="SvgjsStop3265" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                          <stop id="SvgjsStop3266" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                          <stop id="SvgjsStop3267" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                        </linearGradient>
                        <clipPath id="gridRectMask2pqvxr75">
                          <rect id="SvgjsRect3269" width="315.6875" height="337.406400308609" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                        </clipPath>
                        <clipPath id="forecastMask2pqvxr75"></clipPath>
                        <clipPath id="nonForecastMask2pqvxr75"></clipPath>
                        <clipPath id="gridRectMarkerMask2pqvxr75">
                          <rect id="SvgjsRect3270" width="315.6875" height="341.406400308609" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                        </clipPath>
                      </defs>
                      <rect id="SvgjsRect3268" width="0" height="337.406400308609" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient3264)" class="apexcharts-xcrosshairs" y2="337.406400308609" filter="none" fill-opacity="0.9"></rect>
                      <g id="SvgjsG3331" class="apexcharts-yaxis apexcharts-xaxis-inversed" rel="0">
                        <g id="SvgjsG3332" class="apexcharts-yaxis-texts-g apexcharts-xaxis-inversed-texts-g" transform="translate(0, 0)">
                          <text id="SvgjsText3333" font-family="Public Sans" x="-15" y="30.67330911896446" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
                            <tspan id="SvgjsTspan3334">6</tspan>
                            <title>6</title>
                          </text>
                          <text id="SvgjsText3335" font-family="Public Sans" x="-15" y="86.9077091703993" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
                            <tspan id="SvgjsTspan3336">5</tspan>
                            <title>5</title>
                          </text>
                          <text id="SvgjsText3337" font-family="Public Sans" x="-15" y="143.14210922183415" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
                            <tspan id="SvgjsTspan3338">4</tspan>
                            <title>4</title>
                          </text>
                          <text id="SvgjsText3339" font-family="Public Sans" x="-15" y="199.376509273269" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
                            <tspan id="SvgjsTspan3340">3</tspan>
                            <title>3</title>
                          </text>
                          <text id="SvgjsText3341" font-family="Public Sans" x="-15" y="255.61090932470384" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
                            <tspan id="SvgjsTspan3342">2</tspan>
                            <title>2</title>
                          </text>
                          <text id="SvgjsText3343" font-family="Public Sans" x="-15" y="311.8453093761387" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
                            <tspan id="SvgjsTspan3344">1</tspan>
                            <title>1</title>
                          </text>
                        </g>
                      </g>
                      <g id="SvgjsG3311" class="apexcharts-xaxis apexcharts-yaxis-inversed">
                        <g id="SvgjsG3312" class="apexcharts-xaxis-texts-g" transform="translate(0, -8.666666666666666)">
                          <text id="SvgjsText3313" font-family="Helvetica, Arial, sans-serif" x="311.6875" y="367.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan3315">35%</tspan>
                            <title>35%</title>
                          </text>
                          <text id="SvgjsText3316" font-family="Helvetica, Arial, sans-serif" x="249.25" y="367.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan3318">28%</tspan>
                            <title>28%</title>
                          </text>
                          <text id="SvgjsText3319" font-family="Helvetica, Arial, sans-serif" x="186.8125" y="367.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan3321">21%</tspan>
                            <title>21%</title>
                          </text>
                          <text id="SvgjsText3322" font-family="Helvetica, Arial, sans-serif" x="124.375" y="367.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan3324">14%</tspan>
                            <title>14%</title>
                          </text>
                          <text id="SvgjsText3325" font-family="Helvetica, Arial, sans-serif" x="61.9375" y="367.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan3327">7%</tspan>
                            <title>7%</title>
                          </text>
                          <text id="SvgjsText3328" font-family="Helvetica, Arial, sans-serif" x="-0.5" y="367.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan3330">0%</tspan>
                            <title>0%</title>
                          </text>
                        </g>
                      </g>
                      <g id="SvgjsG3345" class="apexcharts-grid">
                        <g id="SvgjsG3346" class="apexcharts-gridlines-horizontal"></g>
                        <g id="SvgjsG3347" class="apexcharts-gridlines-vertical">
                          <line id="SvgjsLine3348" x1="0" y1="0" x2="0" y2="337.406400308609" stroke="#dbdade" stroke-dasharray="10" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          <line id="SvgjsLine3349" x1="62.637499999999996" y1="0" x2="62.637499999999996" y2="337.406400308609" stroke="#dbdade" stroke-dasharray="10" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          <line id="SvgjsLine3350" x1="125.27499999999999" y1="0" x2="125.27499999999999" y2="337.406400308609" stroke="#dbdade" stroke-dasharray="10" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          <line id="SvgjsLine3351" x1="187.9125" y1="0" x2="187.9125" y2="337.406400308609" stroke="#dbdade" stroke-dasharray="10" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          <line id="SvgjsLine3352" x1="250.55" y1="0" x2="250.55" y2="337.406400308609" stroke="#dbdade" stroke-dasharray="10" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          <line id="SvgjsLine3353" x1="313.1875" y1="0" x2="313.1875" y2="337.406400308609" stroke="#dbdade" stroke-dasharray="10" stroke-linecap="butt" class="apexcharts-gridline"></line>
                        </g>
                        <line id="SvgjsLine3355" x1="0" y1="337.406400308609" x2="311.6875" y2="337.406400308609" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                        <line id="SvgjsLine3354" x1="0" y1="1" x2="0" y2="337.406400308609" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                      </g>
                      <g id="SvgjsG3271" class="apexcharts-bar-series apexcharts-plot-series">
                        <g id="SvgjsG3272" class="apexcharts-series" rel="1" seriesName="seriesx1" data:realIndex="0">
                          <path id="SvgjsPath3276" d="M 0.1 11.246880010286969L 304.7875 11.246880010286969Q 311.7875 11.246880010286969 311.7875 18.24688001028697L 311.7875 37.987520041147874Q 311.7875 44.987520041147874 304.7875 44.987520041147874L 304.7875 44.987520041147874L 0.1 44.987520041147874L 0.1 44.987520041147874Q 0.1 44.987520041147874 0.1 44.987520041147874L 0.1 11.246880010286969Q 0.1 11.246880010286969 0.1 11.246880010286969z" fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask2pqvxr75)" pathTo="M 0.1 11.246880010286969L 304.7875 11.246880010286969Q 311.7875 11.246880010286969 311.7875 18.24688001028697L 311.7875 37.987520041147874Q 311.7875 44.987520041147874 304.7875 44.987520041147874L 304.7875 44.987520041147874L 0.1 44.987520041147874L 0.1 44.987520041147874Q 0.1 44.987520041147874 0.1 44.987520041147874L 0.1 11.246880010286969Q 0.1 11.246880010286969 0.1 11.246880010286969z" pathFrom="M 0.1 11.246880010286969L 0.1 11.246880010286969L 0.1 44.987520041147874L 0.1 44.987520041147874L 0.1 44.987520041147874L 0.1 44.987520041147874L 0.1 44.987520041147874L 0.1 11.246880010286969" cy="67.4812800617218" cx="311.7875" j="0" val="35" barHeight="33.7406400308609" barWidth="311.6875"></path>
                          <path id="SvgjsPath3282" d="M 0.1 67.4812800617218L 171.20714285714286 67.4812800617218Q 178.20714285714286 67.4812800617218 178.20714285714286 74.4812800617218L 178.20714285714286 94.2219200925827Q 178.20714285714286 101.2219200925827 171.20714285714286 101.2219200925827L 171.20714285714286 101.2219200925827L 0.1 101.2219200925827L 0.1 101.2219200925827Q 0.1 101.2219200925827 0.1 101.2219200925827L 0.1 67.4812800617218Q 0.1 67.4812800617218 0.1 67.4812800617218z" fill="rgba(0,207,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask2pqvxr75)" pathTo="M 0.1 67.4812800617218L 171.20714285714286 67.4812800617218Q 178.20714285714286 67.4812800617218 178.20714285714286 74.4812800617218L 178.20714285714286 94.2219200925827Q 178.20714285714286 101.2219200925827 171.20714285714286 101.2219200925827L 171.20714285714286 101.2219200925827L 0.1 101.2219200925827L 0.1 101.2219200925827Q 0.1 101.2219200925827 0.1 101.2219200925827L 0.1 67.4812800617218Q 0.1 67.4812800617218 0.1 67.4812800617218z" pathFrom="M 0.1 67.4812800617218L 0.1 67.4812800617218L 0.1 101.2219200925827L 0.1 101.2219200925827L 0.1 101.2219200925827L 0.1 101.2219200925827L 0.1 101.2219200925827L 0.1 67.4812800617218" cy="123.71568011315665" cx="178.20714285714286" j="1" val="20" barHeight="33.7406400308609" barWidth="178.10714285714286"></path>
                          <path id="SvgjsPath3288" d="M 0.1 123.71568011315665L 117.77499999999999 123.71568011315665Q 124.77499999999999 123.71568011315665 124.77499999999999 130.71568011315665L 124.77499999999999 150.45632014401755Q 124.77499999999999 157.45632014401755 117.77499999999999 157.45632014401755L 117.77499999999999 157.45632014401755L 0.1 157.45632014401755L 0.1 157.45632014401755Q 0.1 157.45632014401755 0.1 157.45632014401755L 0.1 123.71568011315665Q 0.1 123.71568011315665 0.1 123.71568011315665z" fill="rgba(40,199,111,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask2pqvxr75)" pathTo="M 0.1 123.71568011315665L 117.77499999999999 123.71568011315665Q 124.77499999999999 123.71568011315665 124.77499999999999 130.71568011315665L 124.77499999999999 150.45632014401755Q 124.77499999999999 157.45632014401755 117.77499999999999 157.45632014401755L 117.77499999999999 157.45632014401755L 0.1 157.45632014401755L 0.1 157.45632014401755Q 0.1 157.45632014401755 0.1 157.45632014401755L 0.1 123.71568011315665Q 0.1 123.71568011315665 0.1 123.71568011315665z" pathFrom="M 0.1 123.71568011315665L 0.1 123.71568011315665L 0.1 157.45632014401755L 0.1 157.45632014401755L 0.1 157.45632014401755L 0.1 157.45632014401755L 0.1 157.45632014401755L 0.1 123.71568011315665" cy="179.9500801645915" cx="124.77499999999999" j="2" val="14" barHeight="33.7406400308609" barWidth="124.675"></path>
                          <path id="SvgjsPath3294" d="M 0.1 179.9500801645915L 99.96428571428571 179.9500801645915Q 106.96428571428571 179.9500801645915 106.96428571428571 186.9500801645915L 106.96428571428571 206.6907201954524Q 106.96428571428571 213.6907201954524 99.96428571428571 213.6907201954524L 99.96428571428571 213.6907201954524L 0.1 213.6907201954524L 0.1 213.6907201954524Q 0.1 213.6907201954524 0.1 213.6907201954524L 0.1 179.9500801645915Q 0.1 179.9500801645915 0.1 179.9500801645915z" fill="rgba(168,170,174,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask2pqvxr75)" pathTo="M 0.1 179.9500801645915L 99.96428571428571 179.9500801645915Q 106.96428571428571 179.9500801645915 106.96428571428571 186.9500801645915L 106.96428571428571 206.6907201954524Q 106.96428571428571 213.6907201954524 99.96428571428571 213.6907201954524L 99.96428571428571 213.6907201954524L 0.1 213.6907201954524L 0.1 213.6907201954524Q 0.1 213.6907201954524 0.1 213.6907201954524L 0.1 179.9500801645915Q 0.1 179.9500801645915 0.1 179.9500801645915z" pathFrom="M 0.1 179.9500801645915L 0.1 179.9500801645915L 0.1 213.6907201954524L 0.1 213.6907201954524L 0.1 213.6907201954524L 0.1 213.6907201954524L 0.1 213.6907201954524L 0.1 179.9500801645915" cy="236.18448021602634" cx="106.96428571428571" j="3" val="12" barHeight="33.7406400308609" barWidth="106.86428571428571"></path>
                          <path id="SvgjsPath3300" d="M 0.1 236.18448021602634L 82.15357142857142 236.18448021602634Q 89.15357142857142 236.18448021602634 89.15357142857142 243.18448021602634L 89.15357142857142 262.9251202468872Q 89.15357142857142 269.9251202468872 82.15357142857142 269.9251202468872L 82.15357142857142 269.9251202468872L 0.1 269.9251202468872L 0.1 269.9251202468872Q 0.1 269.9251202468872 0.1 269.9251202468872L 0.1 236.18448021602634Q 0.1 236.18448021602634 0.1 236.18448021602634z" fill="rgba(234,84,85,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask2pqvxr75)" pathTo="M 0.1 236.18448021602634L 82.15357142857142 236.18448021602634Q 89.15357142857142 236.18448021602634 89.15357142857142 243.18448021602634L 89.15357142857142 262.9251202468872Q 89.15357142857142 269.9251202468872 82.15357142857142 269.9251202468872L 82.15357142857142 269.9251202468872L 0.1 269.9251202468872L 0.1 269.9251202468872Q 0.1 269.9251202468872 0.1 269.9251202468872L 0.1 236.18448021602634Q 0.1 236.18448021602634 0.1 236.18448021602634z" pathFrom="M 0.1 236.18448021602634L 0.1 236.18448021602634L 0.1 269.9251202468872L 0.1 269.9251202468872L 0.1 269.9251202468872L 0.1 269.9251202468872L 0.1 269.9251202468872L 0.1 236.18448021602634" cy="292.4188802674612" cx="89.15357142857142" j="4" val="10" barHeight="33.7406400308609" barWidth="89.05357142857143"></path>
                          <path id="SvgjsPath3306" d="M 0.1 292.4188802674612L 73.24821428571427 292.4188802674612Q 80.24821428571427 292.4188802674612 80.24821428571427 299.4188802674612L 80.24821428571427 319.1595202983221Q 80.24821428571427 326.1595202983221 73.24821428571427 326.1595202983221L 73.24821428571427 326.1595202983221L 0.1 326.1595202983221L 0.1 326.1595202983221Q 0.1 326.1595202983221 0.1 326.1595202983221L 0.1 292.4188802674612Q 0.1 292.4188802674612 0.1 292.4188802674612z" fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask2pqvxr75)" pathTo="M 0.1 292.4188802674612L 73.24821428571427 292.4188802674612Q 80.24821428571427 292.4188802674612 80.24821428571427 299.4188802674612L 80.24821428571427 319.1595202983221Q 80.24821428571427 326.1595202983221 73.24821428571427 326.1595202983221L 73.24821428571427 326.1595202983221L 0.1 326.1595202983221L 0.1 326.1595202983221Q 0.1 326.1595202983221 0.1 326.1595202983221L 0.1 292.4188802674612Q 0.1 292.4188802674612 0.1 292.4188802674612z" pathFrom="M 0.1 292.4188802674612L 0.1 292.4188802674612L 0.1 326.1595202983221L 0.1 326.1595202983221L 0.1 326.1595202983221L 0.1 326.1595202983221L 0.1 326.1595202983221L 0.1 292.4188802674612" cy="348.653280318896" cx="80.24821428571427" j="5" val="9" barHeight="33.7406400308609" barWidth="80.14821428571427"></path>
                          <g id="SvgjsG3274" class="apexcharts-bar-goals-markers" style="pointer-events: none">
                            <g id="SvgjsG3275" className="apexcharts-bar-goals-groups"></g>
                            <g id="SvgjsG3281" className="apexcharts-bar-goals-groups"></g>
                            <g id="SvgjsG3287" className="apexcharts-bar-goals-groups"></g>
                            <g id="SvgjsG3293" className="apexcharts-bar-goals-groups"></g>
                            <g id="SvgjsG3299" className="apexcharts-bar-goals-groups"></g>
                            <g id="SvgjsG3305" className="apexcharts-bar-goals-groups"></g>
                          </g>
                        </g>
                        <g id="SvgjsG3273" class="apexcharts-datalabels" data:realIndex="0">
                          <g id="SvgjsG3278" class="apexcharts-data-labels" transform="rotate(0)">
                            <text id="SvgjsText3280" font-family="Public Sans" x="155.94375000000002" y="32.717199930349985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="200" fill="#ffffff" class="apexcharts-datalabel" cx="155.94375000000002" cy="32.717199930349985" style="font-family: &quot;Public Sans&quot;;">UI Design</text>
                          </g>
                          <g id="SvgjsG3284" class="apexcharts-data-labels" transform="rotate(0)">
                            <text id="SvgjsText3286" font-family="Public Sans" x="89.15357142857142" y="88.95159998178482" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="200" fill="#ffffff" class="apexcharts-datalabel" cx="89.15357142857142" cy="88.95159998178482" style="font-family: &quot;Public Sans&quot;;">UX Design</text>
                          </g>
                          <g id="SvgjsG3290" class="apexcharts-data-labels" transform="rotate(0)">
                            <text id="SvgjsText3292" font-family="Public Sans" x="62.43749999999999" y="145.18600003321967" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="200" fill="#ffffff" class="apexcharts-datalabel" cx="62.43749999999999" cy="145.18600003321967" style="font-family: &quot;Public Sans&quot;;">Music</text>
                          </g>
                          <g id="SvgjsG3296" class="apexcharts-data-labels" transform="rotate(0)">
                            <text id="SvgjsText3298" font-family="Public Sans" x="53.53214285714285" y="201.42040008465452" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="200" fill="#ffffff" class="apexcharts-datalabel" cx="53.53214285714285" cy="201.42040008465452" style="font-family: &quot;Public Sans&quot;;">Animation</text>
                          </g>
                          <g id="SvgjsG3302" class="apexcharts-data-labels" transform="rotate(0)">
                            <text id="SvgjsText3304" font-family="Public Sans" x="44.62678571428571" y="257.65480013608936" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="200" fill="#ffffff" class="apexcharts-datalabel" cx="44.62678571428571" cy="257.65480013608936" style="font-family: &quot;Public Sans&quot;;">React</text>
                          </g>
                          <g id="SvgjsG3308" class="apexcharts-data-labels" transform="rotate(0)">
                            <text id="SvgjsText3310" font-family="Public Sans" x="40.17410714285713" y="313.88920018752424" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="200" fill="#ffffff" class="apexcharts-datalabel" cx="40.17410714285713" cy="313.88920018752424" style="font-family: &quot;Public Sans&quot;;">SEO</text>
                          </g>
                        </g>
                      </g>
                      <line id="SvgjsLine3356" x1="0" y1="0" x2="311.6875" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                      <line id="SvgjsLine3357" x1="0" y1="0" x2="311.6875" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                      <g id="SvgjsG3358" class="apexcharts-yaxis-annotations"></g>
                      <g id="SvgjsG3359" class="apexcharts-xaxis-annotations"></g>
                      <g id="SvgjsG3360" class="apexcharts-point-annotations"></g>
                    </g>
                    <g id="SvgjsG3261" class="apexcharts-annotations"></g>
                  </svg>
                  <div class="apexcharts-legend" style="max-height: 180px;"></div>
                  <div class="apexcharts-tooltip apexcharts-theme-light">
                    <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                    <div class="apexcharts-tooltip-series-group" style="order: 1;">
                      <span class="apexcharts-tooltip-marker" style="background-color: rgb(115, 103, 240);"></span>
                      <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                        <div class="apexcharts-tooltip-y-group">
                          <span class="apexcharts-tooltip-text-y-label"></span>
                          <span class="apexcharts-tooltip-text-y-value"></span>
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
                  <div style="width: 385px; height: 381px;"></div>
                </div>
                <div class="contract-trigger"></div>
              </div>
            </div>
            <div class="col-md-6 d-flex justify-content-around align-items-center">
              <div>
                <div class="d-flex align-items-baseline">
                  <span class="text-primary me-2">
                    <i class="ti ti-circle-filled fs-6"></i>
                  </span>
                  <div>
                    <p class="mb-2">UI Design</p>
                    <h5>35%</h5>
                  </div>
                </div>
                <div class="d-flex align-items-baseline my-3">
                  <span class="text-success me-2">
                    <i class="ti ti-circle-filled fs-6"></i>
                  </span>
                  <div>
                    <p class="mb-2">Music</p>
                    <h5>14%</h5>
                  </div>
                </div>
                <div class="d-flex align-items-baseline">
                  <span class="text-danger me-2">
                    <i class="ti ti-circle-filled fs-6"></i>
                  </span>
                  <div>
                    <p class="mb-2">React</p>
                    <h5>10%</h5>
                  </div>
                </div>
              </div>
              <div>
                <div class="d-flex align-items-baseline">
                  <span class="text-info me-2">
                    <i class="ti ti-circle-filled fs-6"></i>
                  </span>
                  <div>
                    <p class="mb-2">UX Design</p>
                    <h5>20%</h5>
                  </div>
                </div>
                <div class="d-flex align-items-baseline my-3">
                  <span class="text-secondary me-2">
                    <i class="ti ti-circle-filled fs-6"></i>
                  </span>
                  <div>
                    <p class="mb-2">Animation</p>
                    <h5>12%</h5>
                  </div>
                </div>
                <div class="d-flex align-items-baseline">
                  <span class="text-warning me-2">
                    <i class="ti ti-circle-filled fs-6"></i>
                  </span>
                  <div>
                    <p class="mb-2">SEO</p>
                    <h5>9%</h5>
                  </div>
                </div>
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
                  <h5 class="card-title mb-0">My Team</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-6 mb-4">
                  <div class="Status_length" style="display: flex;justify-content: space-between;margin-left:6px;">
                    <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: #3178EE;">&nbsp;</span><span>In Office</span></div>
                    <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: #efc51a;">&nbsp;</span><span>Work from home</span></div>
                    <div class="status" style="display: flex;align-items: center;"><span class="status_color">&nbsp;</span><span>On leave</span></div>
                    <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: grey;">&nbsp;</span><span>Absent</span></div>
                    <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: lightgrey;">&nbsp;</span><span>Holiday</span></div>
                  </div>
                </div>
              </div>
               <div class="inner_table" style="padding:0px 23px;">
              <table class="datatables-basic table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1215px;">
                <thead>
                  <tr>
                    <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 274px;background-color: #eae8fd !important;" aria-label="Name: activate to sort column ascending">Name</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 260px;background-color: #eae8fd !important;" aria-label="Email: activate to sort column ascending">Email</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 89px;background-color: #eae8fd !important;" aria-label="Date: activate to sort column ascending">Date</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 87px;background-color: #eae8fd !important;" aria-label="Salary: activate to sort column ascending">Salary</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 105px;background-color: #eae8fd !important;" aria-label="Status: activate to sort column ascending">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded-circle bg-label-success">GG</span>
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Glyn Giacoppo</span>
                          <small class="emp_post text-truncate text-muted">Software Test Engineer</small>
                        </div>
                      </div>
                    </td>
                    <td>ggiacoppo2r@apache.org</td>
                    <td>04/15/2021</td>
                    <td>$24973.48</td>
                    <td>
                      <span class="badge  bg-label-success">Professional</span>
                    </td>
                  </tr>
                  <tr class="even">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <img src="../../assets/img/avatars/10.png" alt="Avatar" class="rounded-circle">
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Evangelina Carnock</span>
                          <small class="emp_post text-truncate text-muted">Cost Accountant</small>
                        </div>
                      </div>
                    </td>
                    <td>ecarnock2q@washington.edu</td>
                    <td>01/26/2021</td>
                    <td>$23704.82</td>
                    <td>
                      <span class="badge  bg-label-warning">Resigned</span>
                    </td>
                  </tr>
                  <tr class="odd">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Olivette Gudgin</span>
                          <small class="emp_post text-truncate text-muted">Paralegal</small>
                        </div>
                      </div>
                    </td>
                    <td>ogudgin2p@gizmodo.com</td>
                    <td>04/09/2021</td>
                    <td>$15211.60</td>
                    <td>
                      <span class="badge  bg-label-success">Professional</span>
                    </td>
                  </tr>
                  <tr class="even">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded-circle bg-label-secondary">RP</span>
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Reina Peckett</span>
                          <small class="emp_post text-truncate text-muted">Quality Control Specialist</small>
                        </div>
                      </div>
                    </td>
                    <td>rpeckett2o@timesonline.co.uk</td>
                    <td>05/20/2021</td>
                    <td>$16619.40</td>
                    <td>
                      <span class="badge  bg-label-warning">Resigned</span>
                    </td>
                  </tr>
                  <tr class="odd">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded-circle bg-label-primary">AB</span>
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Alaric Beslier</span>
                          <small class="emp_post text-truncate text-muted">Tax Accountant</small>
                        </div>
                      </div>
                    </td>
                    <td>abeslier2n@zimbio.com</td>
                    <td>04/16/2021</td>
                    <td>$19366.53</td>
                    <td>
                      <span class="badge  bg-label-warning">Resigned</span>
                    </td>
                  </tr>
                  <tr class="even">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Edwina Ebsworth</span>
                          <small class="emp_post text-truncate text-muted">Human Resources Assistant</small>
                        </div>
                      </div>
                    </td>
                    <td>eebsworth2m@sbwire.com</td>
                    <td>09/27/2021</td>
                    <td>$19586.23</td>
                    <td>
                      <span class="badge bg-label-primary">Current</span>
                    </td>
                  </tr>
                  <tr class="odd">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded-circle bg-label-primary">RH</span>
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Ronica Hasted</span>
                          <small class="emp_post text-truncate text-muted">Software Consultant</small>
                        </div>
                      </div>
                    </td>
                    <td>rhasted2l@hexun.com</td>
                    <td>07/04/2021</td>
                    <td>$24866.66</td>
                    <td>
                      <span class="badge  bg-label-warning">Resigned</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 7 of 100 entries</div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                    <ul class="pagination">
                      <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                        <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a>
                      </li>
                      <li class="paginate_button page-item active">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a>
                      </li>
                      <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis">
                        <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="14" tabindex="0" class="page-link">15</a>
                      </li>
                      <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div style="width: 1%;"></div>
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
              <div class="row">
                <div class="col-sm-12 col-md-6 mb-4">
                  <div class="Status_length" style="display: flex;justify-content: space-between;margin-left:6px;">
                    <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: #3178EE;">&nbsp;</span><span>Meeting Criteria</span></div>
                    <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: #efc51a;">&nbsp;</span><span>Criteria Unmet</span></div>
                    <div class="status" style="display: flex;align-items: center;"><span class="status_color">&nbsp;</span><span>Action needed</span></div>
                    <div class="status" style="display: flex;align-items: center;"><span class="status_color" style="background-color: lightgrey;">&nbsp;</span><span>Overtime</span></div>
                  </div>
                </div>
              </div>
               <div class="inner_table" style="padding:0px 23px;">
              <table class="datatables-basic table dataTable no-footer dtr-column ttable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1215px;">
                <thead>
                  <tr>
                    <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 274px;background-color: #eae8fd !important;" aria-label="Name: activate to sort column ascending">Name</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 260px;background-color: #eae8fd !important;" aria-label="Email: activate to sort column ascending">Email</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 89px;background-color: #eae8fd !important;" aria-label="Date: activate to sort column ascending">Date</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 87px;background-color: #eae8fd !important;" aria-label="Salary: activate to sort column ascending">Salary</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 105px;background-color: #eae8fd !important;" aria-label="Status: activate to sort column ascending">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded-circle bg-label-success">GG</span>
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Glyn Giacoppo</span>
                          <small class="emp_post text-truncate text-muted">Software Test Engineer</small>
                        </div>
                      </div>
                    </td>
                    <td>ggiacoppo2r@apache.org</td>
                    <td>04/15/2021</td>
                    <td>$24973.48</td>
                    <td>
                      <span class="badge  bg-label-success">Professional</span>
                    </td>
                  </tr>
                  <tr class="even">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <img src="../../assets/img/avatars/10.png" alt="Avatar" class="rounded-circle">
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Evangelina Carnock</span>
                          <small class="emp_post text-truncate text-muted">Cost Accountant</small>
                        </div>
                      </div>
                    </td>
                    <td>ecarnock2q@washington.edu</td>
                    <td>01/26/2021</td>
                    <td>$23704.82</td>
                    <td>
                      <span class="badge  bg-label-warning">Resigned</span>
                    </td>
                  </tr>
                  <tr class="odd">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Olivette Gudgin</span>
                          <small class="emp_post text-truncate text-muted">Paralegal</small>
                        </div>
                      </div>
                    </td>
                    <td>ogudgin2p@gizmodo.com</td>
                    <td>04/09/2021</td>
                    <td>$15211.60</td>
                    <td>
                      <span class="badge  bg-label-success">Professional</span>
                    </td>
                  </tr>
                  <tr class="even">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded-circle bg-label-secondary">RP</span>
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Reina Peckett</span>
                          <small class="emp_post text-truncate text-muted">Quality Control Specialist</small>
                        </div>
                      </div>
                    </td>
                    <td>rpeckett2o@timesonline.co.uk</td>
                    <td>05/20/2021</td>
                    <td>$16619.40</td>
                    <td>
                      <span class="badge  bg-label-warning">Resigned</span>
                    </td>
                  </tr>
                  <tr class="odd">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded-circle bg-label-primary">AB</span>
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Alaric Beslier</span>
                          <small class="emp_post text-truncate text-muted">Tax Accountant</small>
                        </div>
                      </div>
                    </td>
                    <td>abeslier2n@zimbio.com</td>
                    <td>04/16/2021</td>
                    <td>$19366.53</td>
                    <td>
                      <span class="badge  bg-label-warning">Resigned</span>
                    </td>
                  </tr>
                  <tr class="even">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Edwina Ebsworth</span>
                          <small class="emp_post text-truncate text-muted">Human Resources Assistant</small>
                        </div>
                      </div>
                    </td>
                    <td>eebsworth2m@sbwire.com</td>
                    <td>09/27/2021</td>
                    <td>$19586.23</td>
                    <td>
                      <span class="badge bg-label-primary">Current</span>
                    </td>
                  </tr>
                  <tr class="odd">
                    <td class="  control" tabindex="0" style="display: none;"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded-circle bg-label-primary">RH</span>
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate">Ronica Hasted</span>
                          <small class="emp_post text-truncate text-muted">Software Consultant</small>
                        </div>
                      </div>
                    </td>
                    <td>rhasted2l@hexun.com</td>
                    <td>07/04/2021</td>
                    <td>$24866.66</td>
                    <td>
                      <span class="badge  bg-label-warning">Resigned</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 7 of 100 entries</div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                    <ul class="pagination">
                      <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                        <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a>
                      </li>
                      <li class="paginate_button page-item active">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a>
                      </li>
                      <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis">
                        <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="14" tabindex="0" class="page-link">15</a>
                      </li>
                      <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                        <a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div style="width: 1%;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection