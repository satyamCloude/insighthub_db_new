@extends('layouts.admin')
@section('title', 'Project')
@section('content')
<!-- Content -->
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />

    <style>

.b-shadow-4 {
    box-shadow: 0 0 4px 0 #e8eef3;
}

.border-0 {
    border: 0!important;
}

.bg-white {
    background-color: #fff!important;
}

.card {
    word-wrap: break-word;
    background-clip: border-box;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
    display: flex;
    flex-direction: column;
    min-width: 0;
    position: relative;
}

.card-header:first-child {
    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}

.text-capitalize {
    text-transform: capitalize!important;
}

.pt-4, .py-4 {
    padding-top: 1.5rem!important;
}

.justify-content-between {
    justify-content: space-between!important;
}

.border-0 {
    border: 0!important;
}

.f-18 {
    font-size: 18px;
}

.f-w-500 {
    font-weight: 500!important;
}

.pt-2, .py-2 {
    padding-top: 0.5rem!important;
}

.align-items-center {
    align-items: center!important;
}


.justify-content-between {
    justify-content: space-between!important;
}

svg {
    overflow: hidden;
    vertical-align: middle;
}

.f-14 {
    font-size: 14px!important;
}

.text-lightest {
    color: #99a5b5;
}

.font-weight-normal {
    font-weight: 400!important;
}

.f-15 {
    font-size: 15px!important;
}

p {
    line-height: 24px;
    margin-top: 0;
}

.b-shadow-4 {
    box-shadow: 0 0 4px 0 #e8eef3;
}

.border-0 {
    border: 0!important;
}

.card-header:first-child {
    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}

.f-w-500 {
    font-weight: 500!important;
}

.card-horizontal {
    display: flex;
    flex: 1 1 auto;
}

.card-img {
    border-radius: 4px;
    height: 60px;
    margin: 1.25rem;
    -o-object-fit: contain;
    object-fit: contain;
    overflow: hidden;
    width: 60px;
}

.card-img img {
    height: 60px;
    -o-object-fit: cover;
    object-fit: cover;
    width: 60px;
}

.ml-xl-4, .mx-xl-4 {
    margin-left: 1.5rem!important;
}

.card-title {
    line-height: 21px;
    margin-bottom: 7px;
}


.text-dark {
    color: #28313c!important;
}

.card-text {
    line-height: 1.5;
}

.f-15 {
    font-size: 15px!important;
}

.text-capitalize {
    text-transform: capitalize!important;
}


.card {
    word-wrap: break-word;
    background-clip: border-box;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
    display: flex;
    flex-direction: column;
    min-width: 0;
    position: relative;
}



/* SCSS  */


.w-30{
    width: 30%;
}
.w-70{
    width: 70%;
}
.height-35{
    height: 39px !important;
}
.height-40{
    height: 40px !important;
}
.height-44{
    height: 44px !important;
}
.height-50{
    height: 50px !important;
}
.px-6{
    padding-left: 6px !important;
    padding-right: 6px !important;
}
.p-20{
    padding: 20px !important;
}
.pl-20{
    padding-left: 20px !important;
}
.py-20{
    padding-left: 20px !important;
    padding-right: 20px !important;
}
.mt-94{
    margin-top: 94px;
}
.mt-105{
    margin-top: 105px;

}
.mb-12{
    margin-bottom: 12px;
}
.mb-20{
    margin-bottom: 20px;
}
.mr-30{
    margin-right: 30px;
}
.b-shadow-4{
    box-shadow: 0 0 4px 0 #e8eef3;
}
.b-r-8{
    border-radius: 8px !important;
}
.d-grid{
    display: grid;
}







    </style>
  <div class="content-wrapper">
            <!-- Content -->

			            <div class="container-xxl flex-grow-1 container-p-y">
			                <div class="row">
			                    <!-- PROJECT PROGRESS START -->
			                    <div class="col-md-6 mb-4">
			                        <div class="card bg-white border-0 b-shadow-4">
			                    <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
			            <h4 class="f-18 f-w-500 mb-0">Project Progress</h4>
			        
			                    
            
       				 </div>
            
					                    <div class="card-body pt-2 d-flex d-xl-flex d-lg-block d-md-flex  justify-content-between align-items-center">
					                    <div id="progressGauge"><svg width="100" height="65"><path d="M-35,-4.2862637970157365e-15A35,35,0,0,1,23.959148707504102,-25.513901959749404L17.969361530628078,-19.135426469812053A26.25,26.25,0,0,0,-26.25,-3.214697847761802e-15Z" fill="rgb(44, 177, 0)" transform="translate(50, 42.5)"></path><path d="M-38.5,-4.7148901767173095e-15A38.5,38.5,0,0,1,26.355063578254512,-28.065292155724343L23.959148707504102,-25.513901959749404A35,35,0,0,0,-35,-4.2862637970157365e-15Z" fill="transparent" opacity="0.2" transform="translate(50, 42.5)"></path><path d="M23.959148707504102,-25.513901959749404A35,35,0,0,1,35,0L26.25,0A26.25,26.25,0,0,0,17.969361530628078,-19.135426469812053Z" fill="rgb(232, 238, 243)" transform="translate(50, 42.5)" style="opacity: 1;"></path><path d="M26.355063578254512,-28.065292155724343A38.5,38.5,0,0,1,38.5,0L35,0A35,35,0,0,0,23.959148707504102,-25.513901959749404Z" fill="rgba(232, 238, 243, 0)" opacity="0.2" transform="translate(50, 42.5)"></path><text x="17.575" y="49.7" font-size="6px" font-family="Roboto,Helvetica Neue,sans-serif">0</text><text x="75.225" y="49.7" font-size="6px" font-family="Roboto,Helvetica Neue,sans-serif">100</text><text x="42.44" y="42.5" font-size="9px" font-family="Roboto,Helvetica Neue,sans-serif">74%</text></svg></div>
					            <script>
					                // Element inside which you want to see the chart
					                var elementGauge = document.querySelector("#progressGauge")
					        
					                // Properties of the gauge
					                var gaugeOptions = {
					                    hasNeedle: false,
					                    needleColor: 'gray',
					                    needleUpdateSpeed: 1000,
					                    arcColors: ['rgb(44, 177, 0)', 'rgb(232, 238, 243)'],
					                    arcDelimiters: [74],
					                    rangeLabel: ['0', '100'],
					                    centralLabel: '74%'
					                }
					                // Drawing and updating the chart
					                GaugeChart.gaugeChart(elementGauge, 100, gaugeOptions).updateNeedle(50);
					        
					            </script>
					        
					          
					        
					                            <!-- PROGRESS START DATE START -->
					                            <div class="p-start-date mb-xl-0 mb-lg-3">
					                                <h5 class="text-lightest f-14 font-weight-normal">Start Date</h5>
					                                <p class="f-15 mb-0">23-05-2023</p>
					                            </div>
					                            <!-- PROGRESS START DATE END -->
					                            <!-- PROGRESS END DATE START -->
					                            <div class="p-end-date">
					                                <h5 class="text-lightest f-14 font-weight-normal">Deadline</h5>
					                                <p class="f-15 mb-0">
					                                    23-09-2023
					                                </p>
					                            </div>
					                            <!-- PROGRESS END DATE END -->
					                </div>
					            </div>
					                    </div>
					                    <!-- PROJECT PROGRESS END -->
					                    <!-- CLIENT START -->
					                    <div class="col-md-6 mb-4">
					                                            <div class="card bg-white border-0 b-shadow-4">
					                    <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
					            <h4 class="f-18 f-w-500 mb-0">Client</h4>
        
                    
            
        </div>
            
                    <div class="card-body pt-2 d-block d-xl-flex d-lg-block d-md-flex  justify-content-between align-items-center">
                    <div class="p-client-detail">
                                    <div class="card border-0 ">
                                        <div class="card-horizontal">
        
                                            <div class="card-img m-0">
                                                <img class="" src=" https://i.pravatar.cc/300?u=hyatt.brial9@example.org" alt="Rashawn Bernhard III">
                                            </div>
                                            <div class="card-body border-0 p-0 ml-4 ml-xl-4 ml-lg-3 ml-md-3">
                                                <h4 class="card-title f-15 font-weight-normal mb-0">
                                                                                                   <a href="https://demo-saas.worksuite.biz/account/clients/12" class="text-dark">
                                                            Rashawn Bernhard III
                                                        </a>
                                                                                            </h4>
                                                <p class="card-text f-14 text-lightest mb-0">
                                                    Rohan-Weimann
                                                </p>
                                                                                    </div>
        
                                        </div>
                                    </div>
                                </div>
                </div>
            </div>
                    
                    </div>
                    <!-- CLIENT END -->
                </div>
                <div class="row mb-4">
                    <!-- TASK STATUS START -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card bg-white border-0 b-shadow-4">
                    <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <h4 class="f-18 f-w-500 mb-0">Tasks</h4>
        
                    
            
        </div>
            
                    <div class="card-body p-0 ">
                    <div class="m-auto" style="height: 220px; width: 250px">
            <canvas id="task-chart" height="312" width="312" style="display: block; box-sizing: border-box; height: 249.6px; width: 249.6px;"></canvas>
        </div>
        <script>
        var ctx = document.getElementById("task-chart");
        
        var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
          labels: [
                    "Incomplete",
                    "To Do",
                    "Doing",
                    "Completed",
              ],
          datasets: [
            {
              label: 'Dataset 1',
              data: [
                            2,
                            1,
                            4,
                            4,
                      ],
                backgroundColor: [
                                    "#d21010",
                                    "#f5c308",
                                    "#00b5ff",
                                    "#679c0d",
                            ],
            }
          ]
        },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'right',
              },
              title: {
                display: false,
                text: 'Chart.js Pie Chart'
              }
            }
          },
        });
        </script>
                </div>
            </div>
                    </div>
                    <!-- TASK STATUS END -->
                    <!-- BUDGET VS SPENT START -->
                    <div class="col-lg-6 col-md-12">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <h4 class="f-18 f-w-500 mb-4">Statistics</h4>
                            </div>
                                                    <div class="col">
                                    <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
            <div class="d-block text-capitalize">
                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Project Budget
                            </h5>
                <div class="d-flex">
                    <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span id="">0</span>
                    </p>
                </div>
            </div>
            <div class="d-block">
                <i class="fa fa-coins text-lightest f-18"></i> 
            </div>
        </div>
                                </div>
                            
                                                    <div class="col">
                                    <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
            <div class="d-block text-capitalize">
                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Earnings
                            </h5>
                <div class="d-flex">
                    <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span id="">$45,576.00</span>
                    </p>
                </div>
            </div>
            <div class="d-block">
                 <i class="fa fa-coins text-lightest f-18"></i> 
            </div>
        </div>
                                </div>
                                            </div>
                        <div class="row">
                                                    <div class="col">
                                    <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
            <div class="d-block text-capitalize">
                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Hours Logged
                            </h5>
                <div class="d-flex">
                    <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span id="">12</span>
                    </p>
                </div>
            </div>
            <div class="d-block">
                <i class="fa fa-clock text-lightest f-18"></i> 
            </div>
        </div>
                                </div>
                            
                                                    <div class="col">
                                    <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
            <div class="d-block text-capitalize">
                <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Expenses
                            </h5>
                <div class="d-flex">
                    <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span id="">$0.00</span>
                    </p>
                </div>
            </div>
            <div class="d-block">
                <i class="fa fa-coins text-lightest f-18"></i> 
            </div>
        </div>
                                </div>
                                            </div>
                    </div>
                    <!-- BUDGET VS SPENT END -->
                </div>
                <div class="row mb-4">
                    <!-- BUDGET VS SPENT START -->
                    <div class="col-md-12">
                        <div class="card bg-white border-0 b-shadow-4">
            
                    <div class="card-body ">
                    <div class="row row-cols-lg-2">
                                                            <div class="col">
                                        <h4 class="f-18 f-w-500 mb-0">Hours Logged</h4>
                                        <div id="task-chart2" height="250"><div class="chart-container"><svg class="frappe-chart chart" width="580" height="250"><defs></defs><g class="bar-chart chart-draw-area" transform="translate(50, 30)"><g class="y axis" transform=""><g transform="translate(0, 140)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">0</text></g><g transform="translate(0, 105)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">5</text></g><g transform="translate(0, 70)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">10</text></g><g transform="translate(0, 35)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">15</text></g><g transform="translate(0, 0)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">20</text></g></g><g class="x axis" transform=""><g transform="translate(125, 0)"><line class="line-vertical " x1="0" x2="0" y1="146" y2="140" style="stroke: rgb(218, 218, 218);"></line><text x="0" y="150" dy="10px" font-size="10px" text-anchor="middle">Planned</text></g><g transform="translate(375, 0)"><line class="line-vertical " x1="0" x2="0" y1="146" y2="140" style="stroke: rgb(218, 218, 218);"></line><text x="0" y="150" dy="10px" font-size="10px" text-anchor="middle">Actual</text></g></g><g class="dataset-units dataset-bars dataset-0" transform=""><g data-point-index="0" transform="translate(25, 140)"><rect class="bar mini" style="fill: #2cb100" data-point-index="0" x="0" y="0" width="200" height="0"></rect><text class="data-point-value" x="100" y="0" dy="-5px" font-size="10px" text-anchor="middle">0</text></g><g data-point-index="1" transform="translate(275, 140)"><rect class="bar mini" style="fill: #2cb100" data-point-index="1" x="0" y="0" width="200" height="0"></rect><text class="data-point-value" x="100" y="0" dy="-5px" font-size="10px" text-anchor="middle">0</text></g></g><g class="dataset-units dataset-bars dataset-1" transform=""><g data-point-index="0" transform="translate(25, 140)"><rect class="bar mini" style="fill: #d30000" data-point-index="0" x="0" y="0" width="200" height="0"></rect><text class="data-point-value" x="100" y="0" dy="-5px" font-size="10px" text-anchor="middle">0</text></g><g data-point-index="1" transform="translate(275, 56)"><rect class="bar mini" style="fill: #d30000" data-point-index="1" x="0" y="0" width="200" height="84"></rect><text class="data-point-value" x="100" y="0" dy="-5px" font-size="10px" text-anchor="middle">12</text></g></g><g class="y-markers" transform=""><g transform="translate(0, 140)" stroke-opacity="1"><line class="line-horizontal dashed" x1="0" x2="500" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-4" y="0" dy="3px" font-size="10px" text-anchor="end"></text><text class="chart-label" x="4" y="0" dy="-5px" font-size="10px" text-anchor="start"></text></g></g></g><g class="chart-legend" transform="translate(50, 210)"><g transform="translate(0, 0)"><rect class="legend-bar" x="0" y="0" width="100" height="2px" fill="#2cb100"></rect><text class="legend-dataset-text" x="0" y="0" dy="20px" font-size="12px" text-anchor="start" fill="#555b51">Planned</text></g><g transform="translate(100, 0)"><rect class="legend-bar" x="0" y="0" width="100" height="2px" fill="#d30000"></rect><text class="legend-dataset-text" x="0" y="0" dy="20px" font-size="12px" text-anchor="start" fill="#555b51">Overrun</text></g></g></svg></div></div>
        <script>
            var data = {
                labels: [
                                    "Planned",
                                    "Actual",
                            ],
                datasets: [
                                {
                    name: "Planned",
                    values: [
                                            0,
                                            0,
                                    ],
                    chartType: 'bar'
                    },
                                {
                    name: "Overrun",
                    values: [
                                            0,
                                            12,
                                    ],
                    chartType: 'bar'
                    },
                            ],
                yMarkers: [{ label: "", value: 0, options: { labelPos: 'left' } }]
            }
        
            var chart = new frappe.Chart("#task-chart2", { // or a DOM element,
                data: data,
                type: 'bar', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
                height: 250,
                barOptions: {
                    stacked: true,
                    spaceRatio: 0.2 
                },
                valuesOverPoints: 1,
                axisOptions: {
                    yAxisMode: 'tick',
                    xAxisMode: 'tick',
                    xIsSeries: 0
                },
                colors: [
                                    "#2cb100",
                                    "#d30000",
                            ]
            });
        </script>
        
        
        
                                    </div>
                                                                                    <div class="col">
                                        <h4 class="f-18 f-w-500 mb-0">Project Budget</h4>
                                        <div id="task-chart3" height="250"><div class="chart-container" style="overflow:scroll;"><div class="graph-svg-tip comparison" style="top: 0px; left: 0px; opacity: 0;"><span class="title"></span>
                        <ul class="data-point-list"></ul>
                        <div class="svg-pointer"></div></div><svg class="frappe-chart chart" width="580" height="250"><defs></defs><g class="bar-chart chart-draw-area" transform="translate(50, 30)"><g class="y axis" transform=""><g transform="translate(0, 140)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">0</text></g><g transform="translate(0, 112)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">10000</text></g><g transform="translate(0, 84)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">20000</text></g><g transform="translate(0, 56)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">30000</text></g><g transform="translate(0, 28)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">40000</text></g><g transform="translate(0, 0)" stroke-opacity="1"><line class="line-horizontal " x1="-6" x2="0" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-10" y="0" dy="3px" font-size="10px" text-anchor="end">50000</text></g></g><g class="x axis" transform=""><g transform="translate(125, 0)"><line class="line-vertical " x1="0" x2="0" y1="146" y2="140" style="stroke: rgb(218, 218, 218);"></line><text x="0" y="150" dy="10px" font-size="10px" text-anchor="middle">Planned</text></g><g transform="translate(375, 0)"><line class="line-vertical " x1="0" x2="0" y1="146" y2="140" style="stroke: rgb(218, 218, 218);"></line><text x="0" y="150" dy="10px" font-size="10px" text-anchor="middle">Actual</text></g></g><g class="dataset-units dataset-bars dataset-0" transform=""><g data-point-index="0" transform="translate(25, 140)"><rect class="bar mini" style="fill: #2cb100" data-point-index="0" x="0" y="0" width="200" height="0"></rect><text class="data-point-value" x="100" y="0" dy="-5px" font-size="10px" text-anchor="middle">0</text></g><g data-point-index="1" transform="translate(275, 140)"><rect class="bar mini" style="fill: #2cb100" data-point-index="1" x="0" y="0" width="200" height="0"></rect><text class="data-point-value" x="100" y="0" dy="-5px" font-size="10px" text-anchor="middle">0</text></g></g><g class="dataset-units dataset-bars dataset-1" transform=""><g data-point-index="0" transform="translate(25, 140)"><rect class="bar mini" style="fill: #d30000" data-point-index="0" x="0" y="0" width="200" height="0"></rect><text class="data-point-value" x="100" y="0" dy="-5px" font-size="10px" text-anchor="middle">0</text></g><g data-point-index="1" transform="translate(275, 12.39)"><rect class="bar mini" style="fill: #d30000" data-point-index="1" x="0" y="0" width="200" height="127.61"></rect><text class="data-point-value" x="100" y="0" dy="-5px" font-size="10px" text-anchor="middle">45576</text></g></g><g class="y-markers" transform=""><g transform="translate(0, 140)" stroke-opacity="1"><line class="line-horizontal dashed" x1="0" x2="500" y1="0" y2="0" style="stroke: rgb(218, 218, 218);"></line><text x="-4" y="0" dy="3px" font-size="10px" text-anchor="end"></text><text class="chart-label" x="4" y="0" dy="-5px" font-size="10px" text-anchor="start"></text></g></g></g><g class="chart-legend" transform="translate(50, 210)"><g transform="translate(0, 0)"><rect class="legend-bar" x="0" y="0" width="100" height="2px" fill="#2cb100"></rect><text class="legend-dataset-text" x="0" y="0" dy="20px" font-size="12px" text-anchor="start" fill="#555b51">Planned</text></g><g transform="translate(100, 0)"><rect class="legend-bar" x="0" y="0" width="100" height="2px" fill="#d30000"></rect><text class="legend-dataset-text" x="0" y="0" dy="20px" font-size="12px" text-anchor="start" fill="#555b51">Overrun</text></g></g></svg></div></div>
        <script>
            var data = {
                labels: [
                                    "Planned",
                                    "Actual",
                            ],
                datasets: [
                                {
                    name: "Planned",
                    values: [
                                            0,
                                            0,
                                    ],
                    chartType: 'bar'
                    },
                                {
                    name: "Overrun",
                    values: [
                                            0,
                                            45576,
                                    ],
                    chartType: 'bar'
                    },
                            ],
                yMarkers: [{ label: "", value: 0, options: { labelPos: 'left' } }]
            }
        
            var chart = new frappe.Chart("#task-chart3", { // or a DOM element,
                data: data,
                type: 'bar', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
                height: 250,
                barOptions: {
                    stacked: true,
                    spaceRatio: 0.2 
                },
                valuesOverPoints: 1,
                axisOptions: {
                    yAxisMode: 'tick',
                    xAxisMode: 'tick',
                    xIsSeries: 0
                },
                colors: [
                                    "#2cb100",
                                    "#d30000",
                            ]
            });
        </script>
        
        
        
                                    </div>
                                                    </div>
                </div>
            </div>
                    </div>
                    <!-- BUDGET VS SPENT END -->
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card bg-white border-0 b-shadow-4">
                    <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <h4 class="f-18 f-w-500 mb-0">Project Details</h4>
        
                    
            
        </div>
            
                    <div class="card-body pt-2 d-flex justify-content-between align-items-center">
                    <div class="text-dark-grey mb-0 ql-editor p-0">Vitae ea qui nihil et nihil iusto. Odit praesentium autem vero ea eveniet recusandae. Qui est consequatur molestiae explicabo. Recusandae eius nesciunt rerum dolores sapiente qui velit.</div>
                </div>
            </div>
                    </div>
                </div>
            </div>
            <!-- / Content -->


<!-- / Content -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#securityButton").click(function() {
            // Add the "active" class to the clicked button
            $(this).addClass("active");
            
            // Remove the "active" class from other buttons (if needed)
            $("#billingButton, #connectionsButton").removeClass("active");

            // Show the corresponding screen and hide others
            $('.screenSecurity').show(500);
            $('.screenBilling').hide(500);
            $('.screenConnections').hide(500);
        });


            $("#ProfileButton").click(function() {
            // Add the "active" class to the clicked button
            $(this).addClass("active");
            
            // Remove the "active" class from other buttons (if needed)
            $("#billingButton,#securityButton, #connectionsButton").removeClass("active");

            // Show the corresponding screen and hide others
            $('.ProfileButton').show(500);
            $('.screenSecurity').hide(500);
            $('.screenBilling').hide(500);
            $('.screenConnections').hide(500);
        });

        $("#billingButton").click(function() {
            // Add the "active" class to the clicked button
            $(this).addClass("active");

            // Remove the "active" class from other buttons (if needed)
            $("#securityButton, #connectionsButton").removeClass("active");

            // Show the corresponding screen and hide others
            $('.screenBilling').show(500);
            $('.screenSecurity').hide(500);
            $('.screenConnections').hide(500);
        });

        $("#connectionsButton").click(function() {
            // Add the "active" class to the clicked button
            $(this).addClass("active");

            // Remove the "active" class from other buttons (if needed)
            $("#securityButton, #billingButton").removeClass("active");

            // Show the corresponding screen and hide others
            $('.screenBilling').hide(500);
            $('.screenSecurity').hide(500);
            $('.screenConnections').show(500);
        });
    });

</script>

<script>
    $(document).ready(function () {
        $(".formChangePassword2").submit(function (e) {
            e.preventDefault();

            // Perform client-side validation
            var newPassword = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();
            var errorSpan = $(".show_err"); // Select the error span
            var SucSpan = $(".show_succ"); // Select the error span
            errorSpan.hide(); // Hide the error span initially
            if (newPassword.length < 8 || !/[A-Z]/.test(newPassword) || !/[!@#$%^&*()_+{}|:"<>?~=\\-]/.test(newPassword)) {
                errorSpan.text("Password must be at least 8 characters long and contain at least one uppercase letter and one symbol.");
                errorSpan.show();
                return;
            }
            if (newPassword !== confirmPassword) {
                errorSpan.text("Passwords do not match.");
                errorSpan.show();
                return;
            }
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                success: function (response) {
                	SucSpan.text("Password Changed Successfully.");
                	SucSpan.show();
                    setTimeout(function () {
                        location.reload();
                    }, 600);
                return;
           						// location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle the error response, e.g., show an error message
                    //alert("Error: " + error);
                }
            });
        });
    });
</script>

@endsection

 				  