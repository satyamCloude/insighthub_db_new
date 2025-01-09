<?php $__env->startSection('title', 'Product'); ?>
<?php $__env->startSection('content'); ?>

<script src="https://kit.fontawesome.com/601f457ea1.js" crossorigin="anonymous"></script>


<script type="text/javascript" src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script type="text/javascript" src="https://www.amcharts.com/lib/3/funnel.js"></script>


<style>


	.amcharts-funnel-item .amcharts-funnel-tick{


		display: none !important;
	}

	.amcharts-funnel-label{


		display: none !important;
	}


	.fs-24{


		font-size: 21px;
	}



	#chartdiv {
		width: 50%;
		max-width:500px;
		height: 400px; 
		margin:0 auto;
	}
	.amcharts-funnel-tick {
		stroke-dasharray: 5;
	}
	.amcharts-chart-div svg + a {
		display: none !important;
	}





</style>

<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Recruitment </h4>
	<div class="row">
		<div class="col-lg-3 col-sm-6 mb-4">
			<div class="card card-border-shadow-primary h-100">
				<div class="card-body">
					<p class="mb-1 fs-24">Total Applicants</p>
					<p class="mb-0">
						<span class="fw-medium me-1" style="color:green;">+18.2%</span>
						<small class="text-muted">than last month</small>
					</p>
					<div class="d-flex align-items-center mb-2 pb-1 mt-3" style="justify-content: space-between;">
						<h4 class="ms-1 mb-0">422</h4>
						<div class="avatar me-2" style="width:26%;">
							<span class="avatar-initial rounded bg-label-success"><i class="fa-solid fa-arrow-up" style="margin-right: 7px;"></i> 12% </span>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-3 col-sm-6 mb-4">
			<div class="card card-border-shadow-primary h-100">
				<div class="card-body">
					<p class="mb-1 fs-24">Shortlisted Candidates</p>
					<p class="mb-0">
						<span class="fw-medium me-1" style="color:red;">- 0.9%</span>
						<small class="text-muted">than last month</small>
					</p>
					<div class="d-flex align-items-center mb-2 pb-1 mt-3" style="justify-content: space-between;">
						<h4 class="ms-1 mb-0">98</h4>
						<div class="avatar me-2" style="width:26%;">
							<span class="avatar-initial rounded bg-label-danger"><i class="fa-solid fa-arrow-down" style="margin-right: 7px;"></i> 0.2% </span>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-3 col-sm-6 mb-4">
			<div class="card card-border-shadow-primary h-100">
				<div class="card-body">
					<p class="mb-1 fs-24">Hired Candidates</p>
					<p class="mb-0">
						<span class="fw-medium me-1" style="color:green;">+5.2%</span>
						<small class="text-muted">than last month</small>
					</p>
					<div class="d-flex align-items-center mb-2 pb-1 mt-3" style="justify-content: space-between;">
						<h4 class="ms-1 mb-0">23</h4>
						<div class="avatar me-2" style="width:26%;">
							<span class="avatar-initial rounded bg-label-success"><i class="fa-solid fa-arrow-up" style="margin-right: 7px;"></i> 9% </span>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-3 col-sm-6 mb-4">
			<div class="card card-border-shadow-primary h-100">
				<div class="card-body">
					<p class="mb-1 fs-24">Gender Diversity Ratio</p>
					<p class="mb-0">
						<span class="fw-medium me-1" style="color:green;">+18.2%</span>
						<small class="text-muted">than last month</small>
					</p>
					<div class="d-flex align-items-center mb-2 pb-1 mt-3" style="justify-content: space-between;">
						<h4 class="ms-1 mb-0">422</h4>
						<div class="avatar me-2" style="width:26%;">
							<span class="avatar-initial rounded bg-label-success"><i class="fa-solid fa-arrow-up" style="margin-right: 7px;"></i> 12% </span>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 col-12 mb-4">
			<div class="card">
				<h5 class="card-header">Analytics</h5>
				<div class="card-body">
					<canvas id="doughnutChart" class="chartjs mb-4" data-height="350" height="424" width="424" style="display: block; box-sizing: border-box; height: 339px; width: 339px;"></canvas>
					<ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
						<li class="ct-series-0 d-flex flex-column">
							<h5 class="mb-0">Full-Time</h5>
							<span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(102, 110, 232);width:35px; height:6px;"></span>
							<div class="text-muted">80 %</div>
						</li>
						<li class="ct-series-1 d-flex flex-column">
							<h5 class="mb-0">Part-Time</h5>
							<span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(40, 208, 148);width:35px; height:6px;"></span>
							<div class="text-muted">10 %</div>
						</li>
						<li class="ct-series-2 d-flex flex-column">
							<h5 class="mb-0">Internship</h5>
							<span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(253, 172, 52);width:35px; height:6px;"></span>
							<div class="text-muted">10 %</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-12 col-xl-8 mb-4 order-1 order-lg-0">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<div class="card-title m-0">
						<h5 class="mb-0">Applications received by department</h5>
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
							<a href="javascript:void(0);" class="nav-link btn active d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-orders-id" aria-controls="navs-orders-id" aria-selected="true">
								<div class="badge bg-label-secondary rounded p-2"><i class="ti ti-shopping-cart ti-sm"></i></div>
								<h6 class="tab-widget-title mb-0 mt-2">Orders</h6>
							</a>
						</li>
						<li class="nav-item" role="presentation">
							<a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales-id" aria-controls="navs-sales-id" aria-selected="false" tabindex="-1">
								<div class="badge bg-label-secondary rounded p-2"><i class="ti ti-chart-bar ti-sm"></i></div>
								<h6 class="tab-widget-title mb-0 mt-2"> Sales</h6>
							</a>
						</li>
						<li class="nav-item" role="presentation">
							<a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-profit-id" aria-controls="navs-profit-id" aria-selected="false" tabindex="-1">
								<div class="badge bg-label-secondary rounded p-2"><i class="ti ti-currency-dollar ti-sm"></i></div>
								<h6 class="tab-widget-title mb-0 mt-2">Profit</h6>
							</a>
						</li>
						<li class="nav-item" role="presentation">
							<a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id" aria-controls="navs-income-id" aria-selected="false" tabindex="-1">
								<div class="badge bg-label-secondary rounded p-2"><i class="ti ti-chart-pie-2 ti-sm"></i></div>
								<h6 class="tab-widget-title mb-0 mt-2">Income</h6>
							</a>
						</li>
						<li class="nav-item" role="presentation">
							<a href="javascript:void(0);" class="nav-link btn d-flex align-items-center justify-content-center disabled" role="tab" data-bs-toggle="tab" aria-selected="false" tabindex="-1">
								<div class="badge bg-label-secondary rounded p-2"><i class="ti ti-plus ti-sm"></i></div>
							</a>
						</li>
					</ul>
					<div class="tab-content p-0 ms-0 ms-sm-2">
						<div class="tab-pane fade show active" id="navs-orders-id" role="tabpanel" style="position: relative;">
							<div id="earningReportsTabsOrders" style="min-height: 258px;">
								<div id="apexchartsb8ir9j0z" class="apexcharts-canvas apexchartsb8ir9j0z apexcharts-theme-light" style="width: 743px; height: 258px;">
									<svg id="SvgjsSvg2178" width="743" height="258" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
										<g id="SvgjsG2180" class="apexcharts-inner apexcharts-graphical" transform="translate(28.587499618530273, 30)">
											<defs id="SvgjsDefs2179">
												<linearGradient id="SvgjsLinearGradient2184" x1="0" y1="0" x2="0" y2="1">
													<stop id="SvgjsStop2185" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
													<stop id="SvgjsStop2186" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
													<stop id="SvgjsStop2187" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
												</linearGradient>
												<clipPath id="gridRectMaskb8ir9j0z">
													<rect id="SvgjsRect2189" width="728.4125003814697" height="188.40640030860902" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
												</clipPath>
												<clipPath id="forecastMaskb8ir9j0z"></clipPath>
												<clipPath id="nonForecastMaskb8ir9j0z"></clipPath>
												<clipPath id="gridRectMarkerMaskb8ir9j0z">
													<rect id="SvgjsRect2190" width="728.4125003814697" height="192.40640030860902" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
												</clipPath>
											</defs>
											<rect id="SvgjsRect2188" width="0" height="188.40640030860902" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient2184)" class="apexcharts-xcrosshairs" y2="188.40640030860902" filter="none" fill-opacity="0.9"></rect>
											<g id="SvgjsG2249" class="apexcharts-xaxis" transform="translate(0, 0)">
												<g id="SvgjsG2250" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
													<text id="SvgjsText2252" font-family="Public Sans" x="40.24513891008165" y="217.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
														<tspan id="SvgjsTspan2253">Jan</tspan>
														<title>Jan</title>
													</text>
													<text id="SvgjsText2255" font-family="Public Sans" x="120.73541673024495" y="217.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
														<tspan id="SvgjsTspan2256">Feb</tspan>
														<title>Feb</title>
													</text>
													<text id="SvgjsText2258" font-family="Public Sans" x="201.22569455040826" y="217.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
														<tspan id="SvgjsTspan2259">Mar</tspan>
														<title>Mar</title>
													</text>
													<text id="SvgjsText2261" font-family="Public Sans" x="281.71597237057154" y="217.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
														<tspan id="SvgjsTspan2262">Apr</tspan>
														<title>Apr</title>
													</text>
													<text id="SvgjsText2264" font-family="Public Sans" x="362.20625019073486" y="217.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
														<tspan id="SvgjsTspan2265">May</tspan>
														<title>May</title>
													</text>
													<text id="SvgjsText2267" font-family="Public Sans" x="442.6965280108982" y="217.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
														<tspan id="SvgjsTspan2268">Jun</tspan>
														<title>Jun</title>
													</text>
													<text id="SvgjsText2270" font-family="Public Sans" x="523.1868058310615" y="217.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
														<tspan id="SvgjsTspan2271">Jul</tspan>
														<title>Jul</title>
													</text>
													<text id="SvgjsText2273" font-family="Public Sans" x="603.6770836512248" y="217.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
														<tspan id="SvgjsTspan2274">Aug</tspan>
														<title>Aug</title>
													</text>
													<text id="SvgjsText2276" font-family="Public Sans" x="684.1673614713882" y="217.40640030860902" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;">
														<tspan id="SvgjsTspan2277">Sep</tspan>
														<title>Sep</title>
													</text>
												</g>
												<line id="SvgjsLine2278" x1="0" y1="189.40640030860902" x2="724.4125003814697" y2="189.40640030860902" stroke="#dbdade" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line>
											</g>
											<g id="SvgjsG2293" class="apexcharts-grid">
												<g id="SvgjsG2294" class="apexcharts-gridlines-horizontal" style="display: none;">
													<line id="SvgjsLine2296" x1="0" y1="0" x2="724.4125003814697" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
													<line id="SvgjsLine2297" x1="0" y1="37.68128006172181" x2="724.4125003814697" y2="37.68128006172181" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
													<line id="SvgjsLine2298" x1="0" y1="75.36256012344361" x2="724.4125003814697" y2="75.36256012344361" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
													<line id="SvgjsLine2299" x1="0" y1="113.04384018516542" x2="724.4125003814697" y2="113.04384018516542" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
													<line id="SvgjsLine2300" x1="0" y1="150.72512024688723" x2="724.4125003814697" y2="150.72512024688723" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
													<line id="SvgjsLine2301" x1="0" y1="188.40640030860902" x2="724.4125003814697" y2="188.40640030860902" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
												</g>
												<g id="SvgjsG2295" class="apexcharts-gridlines-vertical" style="display: none;"></g>
												<line id="SvgjsLine2303" x1="0" y1="188.40640030860902" x2="724.4125003814697" y2="188.40640030860902" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
												<line id="SvgjsLine2302" x1="0" y1="1" x2="0" y2="188.40640030860902" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
											</g>
											<g id="SvgjsG2191" class="apexcharts-bar-series apexcharts-plot-series">
												<g id="SvgjsG2192" class="apexcharts-series" rel="1" seriesName="seriesx1" data:realIndex="0">
													<path id="SvgjsPath2196" d="M 27.36669445885552 188.40640030860902L 27.36669445885552 86.89881613578797Q 27.36669445885552 82.89881613578797 31.36669445885552 82.89881613578797L 49.12358336130778 82.89881613578797Q 53.12358336130778 82.89881613578797 53.12358336130778 86.89881613578797L 53.12358336130778 86.89881613578797L 53.12358336130778 188.40640030860902Q 53.12358336130778 188.40640030860902 53.12358336130778 188.40640030860902L 27.36669445885552 188.40640030860902Q 27.36669445885552 188.40640030860902 27.36669445885552 188.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb8ir9j0z)" pathTo="M 27.36669445885552 188.40640030860902L 27.36669445885552 86.89881613578797Q 27.36669445885552 82.89881613578797 31.36669445885552 82.89881613578797L 49.12358336130778 82.89881613578797Q 53.12358336130778 82.89881613578797 53.12358336130778 86.89881613578797L 53.12358336130778 86.89881613578797L 53.12358336130778 188.40640030860902Q 53.12358336130778 188.40640030860902 53.12358336130778 188.40640030860902L 27.36669445885552 188.40640030860902Q 27.36669445885552 188.40640030860902 27.36669445885552 188.40640030860902z" pathFrom="M 27.36669445885552 188.40640030860902L 27.36669445885552 188.40640030860902L 53.12358336130778 188.40640030860902L 53.12358336130778 188.40640030860902L 53.12358336130778 188.40640030860902L 53.12358336130778 188.40640030860902L 53.12358336130778 188.40640030860902L 27.36669445885552 188.40640030860902" cy="82.89881613578797" cx="107.85697227901882" j="0" val="28" barHeight="105.50758417282105" barWidth="25.756888902452257"></path>
													<path id="SvgjsPath2202" d="M 107.85697227901882 188.40640030860902L 107.85697227901882 154.72512024688723Q 107.85697227901882 150.72512024688723 111.85697227901882 150.72512024688723L 129.61386118147107 150.72512024688723Q 133.61386118147107 150.72512024688723 133.61386118147107 154.72512024688723L 133.61386118147107 154.72512024688723L 133.61386118147107 188.40640030860902Q 133.61386118147107 188.40640030860902 133.61386118147107 188.40640030860902L 107.85697227901882 188.40640030860902Q 107.85697227901882 188.40640030860902 107.85697227901882 188.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb8ir9j0z)" pathTo="M 107.85697227901882 188.40640030860902L 107.85697227901882 154.72512024688723Q 107.85697227901882 150.72512024688723 111.85697227901882 150.72512024688723L 129.61386118147107 150.72512024688723Q 133.61386118147107 150.72512024688723 133.61386118147107 154.72512024688723L 133.61386118147107 154.72512024688723L 133.61386118147107 188.40640030860902Q 133.61386118147107 188.40640030860902 133.61386118147107 188.40640030860902L 107.85697227901882 188.40640030860902Q 107.85697227901882 188.40640030860902 107.85697227901882 188.40640030860902z" pathFrom="M 107.85697227901882 188.40640030860902L 107.85697227901882 188.40640030860902L 133.61386118147107 188.40640030860902L 133.61386118147107 188.40640030860902L 133.61386118147107 188.40640030860902L 133.61386118147107 188.40640030860902L 133.61386118147107 188.40640030860902L 107.85697227901882 188.40640030860902" cy="150.72512024688723" cx="188.34725009918213" j="1" val="10" barHeight="37.68128006172181" barWidth="25.756888902452257"></path>
													<path id="SvgjsPath2208" d="M 188.34725009918213 188.40640030860902L 188.34725009918213 22.840640030860897Q 188.34725009918213 18.840640030860897 192.34725009918213 18.840640030860897L 210.1041390016344 18.840640030860897Q 214.1041390016344 18.840640030860897 214.1041390016344 22.840640030860897L 214.1041390016344 22.840640030860897L 214.1041390016344 188.40640030860902Q 214.1041390016344 188.40640030860902 214.1041390016344 188.40640030860902L 188.34725009918213 188.40640030860902Q 188.34725009918213 188.40640030860902 188.34725009918213 188.40640030860902z" fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb8ir9j0z)" pathTo="M 188.34725009918213 188.40640030860902L 188.34725009918213 22.840640030860897Q 188.34725009918213 18.840640030860897 192.34725009918213 18.840640030860897L 210.1041390016344 18.840640030860897Q 214.1041390016344 18.840640030860897 214.1041390016344 22.840640030860897L 214.1041390016344 22.840640030860897L 214.1041390016344 188.40640030860902Q 214.1041390016344 188.40640030860902 214.1041390016344 188.40640030860902L 188.34725009918213 188.40640030860902Q 188.34725009918213 188.40640030860902 188.34725009918213 188.40640030860902z" pathFrom="M 188.34725009918213 188.40640030860902L 188.34725009918213 188.40640030860902L 214.1041390016344 188.40640030860902L 214.1041390016344 188.40640030860902L 214.1041390016344 188.40640030860902L 214.1041390016344 188.40640030860902L 214.1041390016344 188.40640030860902L 188.34725009918213 188.40640030860902" cy="18.840640030860897" cx="268.83752791934546" j="2" val="45" barHeight="169.56576027774813" barWidth="25.756888902452257"></path>
													<path id="SvgjsPath2214" d="M 268.83752791934546 188.40640030860902L 268.83752791934546 49.217536074066174Q 268.83752791934546 45.217536074066174 272.83752791934546 45.217536074066174L 290.5944168217977 45.217536074066174Q 294.5944168217977 45.217536074066174 294.5944168217977 49.217536074066174L 294.5944168217977 49.217536074066174L 294.5944168217977 188.40640030860902Q 294.5944168217977 188.40640030860902 294.5944168217977 188.40640030860902L 268.83752791934546 188.40640030860902Q 268.83752791934546 188.40640030860902 268.83752791934546 188.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb8ir9j0z)" pathTo="M 268.83752791934546 188.40640030860902L 268.83752791934546 49.217536074066174Q 268.83752791934546 45.217536074066174 272.83752791934546 45.217536074066174L 290.5944168217977 45.217536074066174Q 294.5944168217977 45.217536074066174 294.5944168217977 49.217536074066174L 294.5944168217977 49.217536074066174L 294.5944168217977 188.40640030860902Q 294.5944168217977 188.40640030860902 294.5944168217977 188.40640030860902L 268.83752791934546 188.40640030860902Q 268.83752791934546 188.40640030860902 268.83752791934546 188.40640030860902z" pathFrom="M 268.83752791934546 188.40640030860902L 268.83752791934546 188.40640030860902L 294.5944168217977 188.40640030860902L 294.5944168217977 188.40640030860902L 294.5944168217977 188.40640030860902L 294.5944168217977 188.40640030860902L 294.5944168217977 188.40640030860902L 268.83752791934546 188.40640030860902" cy="45.217536074066174" cx="349.3278057395088" j="3" val="38" barHeight="143.18886423454285" barWidth="25.756888902452257"></path>
													<path id="SvgjsPath2220" d="M 349.3278057395088 188.40640030860902L 349.3278057395088 135.8844802160263Q 349.3278057395088 131.8844802160263 353.3278057395088 131.8844802160263L 371.08469464196105 131.8844802160263Q 375.08469464196105 131.8844802160263 375.08469464196105 135.8844802160263L 375.08469464196105 135.8844802160263L 375.08469464196105 188.40640030860902Q 375.08469464196105 188.40640030860902 375.08469464196105 188.40640030860902L 349.3278057395088 188.40640030860902Q 349.3278057395088 188.40640030860902 349.3278057395088 188.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb8ir9j0z)" pathTo="M 349.3278057395088 188.40640030860902L 349.3278057395088 135.8844802160263Q 349.3278057395088 131.8844802160263 353.3278057395088 131.8844802160263L 371.08469464196105 131.8844802160263Q 375.08469464196105 131.8844802160263 375.08469464196105 135.8844802160263L 375.08469464196105 135.8844802160263L 375.08469464196105 188.40640030860902Q 375.08469464196105 188.40640030860902 375.08469464196105 188.40640030860902L 349.3278057395088 188.40640030860902Q 349.3278057395088 188.40640030860902 349.3278057395088 188.40640030860902z" pathFrom="M 349.3278057395088 188.40640030860902L 349.3278057395088 188.40640030860902L 375.08469464196105 188.40640030860902L 375.08469464196105 188.40640030860902L 375.08469464196105 188.40640030860902L 375.08469464196105 188.40640030860902L 375.08469464196105 188.40640030860902L 349.3278057395088 188.40640030860902" cy="131.8844802160263" cx="429.8180835596721" j="4" val="15" barHeight="56.521920092582704" barWidth="25.756888902452257"></path>
													<path id="SvgjsPath2226" d="M 429.8180835596721 188.40640030860902L 429.8180835596721 79.36256012344361Q 429.8180835596721 75.36256012344361 433.8180835596721 75.36256012344361L 451.5749724621244 75.36256012344361Q 455.5749724621244 75.36256012344361 455.5749724621244 79.36256012344361L 455.5749724621244 79.36256012344361L 455.5749724621244 188.40640030860902Q 455.5749724621244 188.40640030860902 455.5749724621244 188.40640030860902L 429.8180835596721 188.40640030860902Q 429.8180835596721 188.40640030860902 429.8180835596721 188.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb8ir9j0z)" pathTo="M 429.8180835596721 188.40640030860902L 429.8180835596721 79.36256012344361Q 429.8180835596721 75.36256012344361 433.8180835596721 75.36256012344361L 451.5749724621244 75.36256012344361Q 455.5749724621244 75.36256012344361 455.5749724621244 79.36256012344361L 455.5749724621244 79.36256012344361L 455.5749724621244 188.40640030860902Q 455.5749724621244 188.40640030860902 455.5749724621244 188.40640030860902L 429.8180835596721 188.40640030860902Q 429.8180835596721 188.40640030860902 429.8180835596721 188.40640030860902z" pathFrom="M 429.8180835596721 188.40640030860902L 429.8180835596721 188.40640030860902L 455.5749724621244 188.40640030860902L 455.5749724621244 188.40640030860902L 455.5749724621244 188.40640030860902L 455.5749724621244 188.40640030860902L 455.5749724621244 188.40640030860902L 429.8180835596721 188.40640030860902" cy="75.36256012344361" cx="510.30836137983545" j="5" val="30" barHeight="113.04384018516541" barWidth="25.756888902452257"></path>
													<path id="SvgjsPath2232" d="M 510.30836137983545 188.40640030860902L 510.30836137983545 60.52192009258272Q 510.30836137983545 56.52192009258272 514.3083613798354 56.52192009258272L 532.0652502822877 56.52192009258272Q 536.0652502822877 56.52192009258272 536.0652502822877 60.52192009258272L 536.0652502822877 60.52192009258272L 536.0652502822877 188.40640030860902Q 536.0652502822877 188.40640030860902 536.0652502822877 188.40640030860902L 510.30836137983545 188.40640030860902Q 510.30836137983545 188.40640030860902 510.30836137983545 188.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb8ir9j0z)" pathTo="M 510.30836137983545 188.40640030860902L 510.30836137983545 60.52192009258272Q 510.30836137983545 56.52192009258272 514.3083613798354 56.52192009258272L 532.0652502822877 56.52192009258272Q 536.0652502822877 56.52192009258272 536.0652502822877 60.52192009258272L 536.0652502822877 60.52192009258272L 536.0652502822877 188.40640030860902Q 536.0652502822877 188.40640030860902 536.0652502822877 188.40640030860902L 510.30836137983545 188.40640030860902Q 510.30836137983545 188.40640030860902 510.30836137983545 188.40640030860902z" pathFrom="M 510.30836137983545 188.40640030860902L 510.30836137983545 188.40640030860902L 536.0652502822877 188.40640030860902L 536.0652502822877 188.40640030860902L 536.0652502822877 188.40640030860902L 536.0652502822877 188.40640030860902L 536.0652502822877 188.40640030860902L 510.30836137983545 188.40640030860902" cy="56.52192009258272" cx="590.7986391999988" j="6" val="35" barHeight="131.8844802160263" barWidth="25.756888902452257"></path>
													<path id="SvgjsPath2238" d="M 590.7986391999988 188.40640030860902L 590.7986391999988 79.36256012344361Q 590.7986391999988 75.36256012344361 594.7986391999988 75.36256012344361L 612.555528102451 75.36256012344361Q 616.555528102451 75.36256012344361 616.555528102451 79.36256012344361L 616.555528102451 79.36256012344361L 616.555528102451 188.40640030860902Q 616.555528102451 188.40640030860902 616.555528102451 188.40640030860902L 590.7986391999988 188.40640030860902Q 590.7986391999988 188.40640030860902 590.7986391999988 188.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb8ir9j0z)" pathTo="M 590.7986391999988 188.40640030860902L 590.7986391999988 79.36256012344361Q 590.7986391999988 75.36256012344361 594.7986391999988 75.36256012344361L 612.555528102451 75.36256012344361Q 616.555528102451 75.36256012344361 616.555528102451 79.36256012344361L 616.555528102451 79.36256012344361L 616.555528102451 188.40640030860902Q 616.555528102451 188.40640030860902 616.555528102451 188.40640030860902L 590.7986391999988 188.40640030860902Q 590.7986391999988 188.40640030860902 590.7986391999988 188.40640030860902z" pathFrom="M 590.7986391999988 188.40640030860902L 590.7986391999988 188.40640030860902L 616.555528102451 188.40640030860902L 616.555528102451 188.40640030860902L 616.555528102451 188.40640030860902L 616.555528102451 188.40640030860902L 616.555528102451 188.40640030860902L 590.7986391999988 188.40640030860902" cy="75.36256012344361" cx="671.2889170201621" j="7" val="30" barHeight="113.04384018516541" barWidth="25.756888902452257"></path>
													<path id="SvgjsPath2244" d="M 671.2889170201621 188.40640030860902L 671.2889170201621 162.26137625923158Q 671.2889170201621 158.26137625923158 675.2889170201621 158.26137625923158L 693.0458059226144 158.26137625923158Q 697.0458059226144 158.26137625923158 697.0458059226144 162.26137625923158L 697.0458059226144 162.26137625923158L 697.0458059226144 188.40640030860902Q 697.0458059226144 188.40640030860902 697.0458059226144 188.40640030860902L 671.2889170201621 188.40640030860902Q 671.2889170201621 188.40640030860902 671.2889170201621 188.40640030860902z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb8ir9j0z)" pathTo="M 671.2889170201621 188.40640030860902L 671.2889170201621 162.26137625923158Q 671.2889170201621 158.26137625923158 675.2889170201621 158.26137625923158L 693.0458059226144 158.26137625923158Q 697.0458059226144 158.26137625923158 697.0458059226144 162.26137625923158L 697.0458059226144 162.26137625923158L 697.0458059226144 188.40640030860902Q 697.0458059226144 188.40640030860902 697.0458059226144 188.40640030860902L 671.2889170201621 188.40640030860902Q 671.2889170201621 188.40640030860902 671.2889170201621 188.40640030860902z" pathFrom="M 671.2889170201621 188.40640030860902L 671.2889170201621 188.40640030860902L 697.0458059226144 188.40640030860902L 697.0458059226144 188.40640030860902L 697.0458059226144 188.40640030860902L 697.0458059226144 188.40640030860902L 697.0458059226144 188.40640030860902L 671.2889170201621 188.40640030860902" cy="158.26137625923158" cx="751.7791948403254" j="8" val="8" barHeight="30.145024049377444" barWidth="25.756888902452257"></path>
													<g id="SvgjsG2194" class="apexcharts-bar-goals-markers" style="pointer-events: none">
														<g id="SvgjsG2195" className="apexcharts-bar-goals-groups"></g>
														<g id="SvgjsG2201" className="apexcharts-bar-goals-groups"></g>
														<g id="SvgjsG2207" className="apexcharts-bar-goals-groups"></g>
														<g id="SvgjsG2213" className="apexcharts-bar-goals-groups"></g>
														<g id="SvgjsG2219" className="apexcharts-bar-goals-groups"></g>
														<g id="SvgjsG2225" className="apexcharts-bar-goals-groups"></g>
														<g id="SvgjsG2231" className="apexcharts-bar-goals-groups"></g>
														<g id="SvgjsG2237" className="apexcharts-bar-goals-groups"></g>
														<g id="SvgjsG2243" className="apexcharts-bar-goals-groups"></g>
													</g>
												</g>
												<g id="SvgjsG2193" class="apexcharts-datalabels" data:realIndex="0">
													<g id="SvgjsG2198" class="apexcharts-data-labels" transform="rotate(0)">
														<text id="SvgjsText2200" font-family="Public Sans" x="40.24513891008165" y="80.4988165172577" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#6f6b7d" class="apexcharts-datalabel" cx="40.24513891008165" cy="80.4988165172577" style="font-family: &quot;Public Sans&quot;;">28k</text>
													</g>
													<g id="SvgjsG2204" class="apexcharts-data-labels" transform="rotate(0)">
														<text id="SvgjsText2206" font-family="Public Sans" x="120.73541673024496" y="148.32512062835696" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#6f6b7d" class="apexcharts-datalabel" cx="120.73541673024496" cy="148.32512062835696" style="font-family: &quot;Public Sans&quot;;">10k</text>
													</g>
													<g id="SvgjsG2210" class="apexcharts-data-labels" transform="rotate(0)">
														<text id="SvgjsText2212" font-family="Public Sans" x="201.2256945504083" y="16.440640412330623" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#6f6b7d" class="apexcharts-datalabel" cx="201.2256945504083" cy="16.440640412330623" style="font-family: &quot;Public Sans&quot;;">45k</text>
													</g>
													<g id="SvgjsG2216" class="apexcharts-data-labels" transform="rotate(0)">
														<text id="SvgjsText2218" font-family="Public Sans" x="281.7159723705716" y="42.8175364555359" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#6f6b7d" class="apexcharts-datalabel" cx="281.7159723705716" cy="42.8175364555359" style="font-family: &quot;Public Sans&quot;;">38k</text>
													</g>
													<g id="SvgjsG2222" class="apexcharts-data-labels" transform="rotate(0)">
														<text id="SvgjsText2224" font-family="Public Sans" x="362.2062501907349" y="129.48448059749603" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#6f6b7d" class="apexcharts-datalabel" cx="362.2062501907349" cy="129.48448059749603" style="font-family: &quot;Public Sans&quot;;">15k</text>
													</g>
													<g id="SvgjsG2228" class="apexcharts-data-labels" transform="rotate(0)">
														<text id="SvgjsText2230" font-family="Public Sans" x="442.69652801089825" y="72.96256050491334" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#6f6b7d" class="apexcharts-datalabel" cx="442.69652801089825" cy="72.96256050491334" style="font-family: &quot;Public Sans&quot;;">30k</text>
													</g>
													<g id="SvgjsG2234" class="apexcharts-data-labels" transform="rotate(0)">
														<text id="SvgjsText2236" font-family="Public Sans" x="523.1868058310615" y="54.121920474052445" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#6f6b7d" class="apexcharts-datalabel" cx="523.1868058310615" cy="54.121920474052445" style="font-family: &quot;Public Sans&quot;;">35k</text>
													</g>
													<g id="SvgjsG2240" class="apexcharts-data-labels" transform="rotate(0)">
														<text id="SvgjsText2242" font-family="Public Sans" x="603.6770836512248" y="72.96256050491334" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#6f6b7d" class="apexcharts-datalabel" cx="603.6770836512248" cy="72.96256050491334" style="font-family: &quot;Public Sans&quot;;">30k</text>
													</g>
													<g id="SvgjsG2246" class="apexcharts-data-labels" transform="rotate(0)">
														<text id="SvgjsText2248" font-family="Public Sans" x="684.1673614713882" y="155.8613766407013" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#6f6b7d" class="apexcharts-datalabel" cx="684.1673614713882" cy="155.8613766407013" style="font-family: &quot;Public Sans&quot;;">8k</text>
													</g>
												</g>
											</g>
											<line id="SvgjsLine2304" x1="0" y1="0" x2="724.4125003814697" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
											<line id="SvgjsLine2305" x1="0" y1="0" x2="724.4125003814697" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
											<g id="SvgjsG2306" class="apexcharts-yaxis-annotations"></g>
											<g id="SvgjsG2307" class="apexcharts-xaxis-annotations"></g>
											<g id="SvgjsG2308" class="apexcharts-point-annotations"></g>
										</g>
										<g id="SvgjsG2279" class="apexcharts-yaxis" rel="0" transform="translate(5.587499618530273, 0)">
											<g id="SvgjsG2280" class="apexcharts-yaxis-texts-g">
												<text id="SvgjsText2281" font-family="Public Sans" x="20" y="31.5" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
													<tspan id="SvgjsTspan2282">50k</tspan>
													<title>50k</title>
												</text>
												<text id="SvgjsText2283" font-family="Public Sans" x="20" y="69.18128006172181" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
													<tspan id="SvgjsTspan2284">40k</tspan>
													<title>40k</title>
												</text>
												<text id="SvgjsText2285" font-family="Public Sans" x="20" y="106.86256012344361" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
													<tspan id="SvgjsTspan2286">30k</tspan>
													<title>30k</title>
												</text>
												<text id="SvgjsText2287" font-family="Public Sans" x="20" y="144.54384018516544" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
													<tspan id="SvgjsTspan2288">20k</tspan>
													<title>20k</title>
												</text>
												<text id="SvgjsText2289" font-family="Public Sans" x="20" y="182.22512024688723" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
													<tspan id="SvgjsTspan2290">10k</tspan>
													<title>10k</title>
												</text>
												<text id="SvgjsText2291" font-family="Public Sans" x="20" y="219.90640030860902" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family: &quot;Public Sans&quot;;">
													<tspan id="SvgjsTspan2292">0k</tspan>
													<title>0k</title>
												</text>
											</g>
										</g>
										<g id="SvgjsG2181" class="apexcharts-annotations"></g>
									</svg>
									<div class="apexcharts-legend" style="max-height: 129px;"></div>
								</div>
							</div>
							<div class="resize-triggers">
								<div class="expand-trigger">
									<div style="width: 744px; height: 259px;"></div>
								</div>
								<div class="contract-trigger"></div>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-sales-id" role="tabpanel" style="position: relative;">
							<div id="earningReportsTabsSales" style="min-height: 258px;">
								<div id="apexchartsr18l9d32f" class="apexcharts-canvas apexchartsr18l9d32f" style="width: 0px; height: 258px;">
									<svg id="SvgjsSvg2309" width="0" height="258" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
										<g id="SvgjsG2312" class="apexcharts-annotations"></g>
										<g id="SvgjsG2311" class="apexcharts-inner apexcharts-graphical">
											<defs id="SvgjsDefs2310"></defs>
										</g>
									</svg>
									<div class="apexcharts-legend"></div>
								</div>
							</div>
							<div class="resize-triggers">
								<div class="expand-trigger">
									<div style="width: 1px; height: 1px;"></div>
								</div>
								<div class="contract-trigger"></div>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-profit-id" role="tabpanel" style="position: relative;">
							<div id="earningReportsTabsProfit" style="min-height: 258px;">
								<div id="apexchartsq3i0q1lg" class="apexcharts-canvas apexchartsq3i0q1lg" style="width: 0px; height: 258px;">
									<svg id="SvgjsSvg2313" width="0" height="258" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
										<g id="SvgjsG2316" class="apexcharts-annotations"></g>
										<g id="SvgjsG2315" class="apexcharts-inner apexcharts-graphical">
											<defs id="SvgjsDefs2314"></defs>
										</g>
									</svg>
									<div class="apexcharts-legend"></div>
								</div>
							</div>
							<div class="resize-triggers">
								<div class="expand-trigger">
									<div style="width: 1px; height: 1px;"></div>
								</div>
								<div class="contract-trigger"></div>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-income-id" role="tabpanel" style="position: relative;">
							<div id="earningReportsTabsIncome" style="min-height: 258px;">
								<div id="apexchartsxvuzviwq" class="apexcharts-canvas apexchartsxvuzviwq" style="width: 0px; height: 258px;">
									<svg id="SvgjsSvg2317" width="0" height="258" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
										<g id="SvgjsG2320" class="apexcharts-annotations"></g>
										<g id="SvgjsG2319" class="apexcharts-inner apexcharts-graphical">
											<defs id="SvgjsDefs2318"></defs>
										</g>
									</svg>
									<div class="apexcharts-legend"></div>
								</div>
							</div>
							<div class="resize-triggers">
								<div class="expand-trigger">
									<div style="width: 1px; height: 1px;"></div>
								</div>
								<div class="contract-trigger"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8">
			<div class="card">
				<div class="card-datatable table-responsive pt-0">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
						<div class="card-header flex-column flex-md-row">
							<div class="head-label text-center">
								<h5 class="card-title mb-0">Applicant Details</h5>
							</div>
							<div class="dt-action-buttons text-end pt-3 pt-md-0">
								<div class="dt-buttons btn-group flex-wrap">
									<div class="btn-group">
										<button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2 waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">
											<span>
												<i class="ti ti-file-export me-sm-1"></i>
												<span class="d-none d-sm-inline-block">Export</span>
											</span>
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
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
						</div>
						<table class="datatables-basic table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1215px;">
							<thead>
								<tr>
									<th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
									<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 274px;" aria-label="Name: activate to sort column ascending">Applicant Name</th>
									<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 220px;" aria-label="Email: activate to sort column ascending">Job Title</th>
									<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 200px;" aria-label="Date: activate to sort column ascending">Applied Date</th>
									<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 87px;" aria-label="Salary: activate to sort column ascending">Status</th>
								</tr>
							</thead>
							<tbody>
								<tr class="odd">
									<td class="  control" tabindex="0" style="display: none;"></td>
									<td>
										<div class="d-flex justify-content-start align-items-center user-name">
											<div class="avatar-wrapper">
												<div class="avatar me-2">
													<span class="avatar-initial rounded-circle bg-label-success">VJ</span>
												</div>
											</div>
											<div class="d-flex flex-column">
												<span class="emp_name text-truncate">Victoria Jules</span>
												<small class="emp_post text-truncate text-muted">saracruz@example.com</small>
											</div>
										</div>
									</td>
									<td>UI/UX Designer</td>
									<td>02/11/2022</td>
									<td>
										<span class="badge  bg-label-primary">Offer initiated</span>
									</td>
								</tr>
								<tr class="even">
									<td class="  control" tabindex="0" style="display: none;"></td>
									<td>
										<div class="d-flex justify-content-start align-items-center user-name">
											<div class="avatar-wrapper">
												<div class="avatar me-2">
													<span class="avatar-initial rounded-circle bg-label-info">GG</span>
												</div>
											</div>
											<div class="d-flex flex-column">
												<span class="emp_name text-truncate">Glyn Giacoppo</span>
												<small class="emp_post text-truncate text-muted">saracruz@example.com</small>
											</div>
										</div>
									</td>
									<td>Process Associate</td>
									<td>04/15/2021</td>
									<td>
										<span class="badge  bg-label-success">Hired</span>
									</td>
								</tr>
								<tr class="odd">
									<td class="  control" tabindex="0" style="display: none;"></td>
									<td>
										<div class="d-flex justify-content-start align-items-center user-name">
											<div class="avatar-wrapper">
												<div class="avatar me-2">
													<span class="avatar-initial rounded-circle bg-label-success">MM</span>
												</div>
											</div>
											<div class="d-flex flex-column">
												<span class="emp_name text-truncate">Mickey Mackinsey</span>
												<small class="emp_post text-truncate text-muted">Mckisney@gmail.com</small>
											</div>
										</div>
									</td>
									<td>Web Designer</td>
									<td>02/12/2023</td>
									<td>
										<span class="badge  bg-label-primary">Offer initiated</span>
									</td>
								</tr>
								<tr class="even">
									<td class="  control" tabindex="0" style="display: none;"></td>
									<td>
										<div class="d-flex justify-content-start align-items-center user-name">
											<div class="avatar-wrapper">
												<div class="avatar me-2">
													<span class="avatar-initial rounded-circle bg-label-info">RJ</span>
												</div>
											</div>
											<div class="d-flex flex-column">
												<span class="emp_name text-truncate">Ryan Joseph</span>
												<small class="emp_post text-truncate text-muted">jose@123gmail.com</small>
											</div>
										</div>
									</td>
									<td>Sales Executive</td>
									<td>01/05/2024</td>
									<td>
										<span class="badge  bg-label-warning">Screened</span>
									</td>
								</tr>

							</tbody>
						</table>
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
		<div class="col-lg-4">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title mb-0">Recruitment Funnel</h5>
				</div>
				<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
				<div class="card-footer" style="background-color: #fff;text-align: center;">
					<button type="button" class="btn btn-label-primary waves-effect">Full Report</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	

	AmCharts.makeChart("chartdiv",
	{
		"type": "funnel",
		"angle": 2,
		"balloonText": "[[title]]:<b>[[value]]</b>",
		"depth3D": 2,
		"labelPosition": "right",
		"neckHeight": "20%",
		"neckWidth": "15%",
		"startY": 50,
		"addClassNames":"true",
		"marginLeft": 15,
		"marginRight": 16,
		"startDuration": 3,
		"titleField": "title",
		"valueField": "value",
		"accessibleTitle": "",
		"allLabels": [],
		"balloon": {},
		"colors": [
			"#887ef2",
			"#00b1fa",
			"#8ad35e",
			"#ffc655",
			"#ff7c24",
			"#ff4d78",
			"#9d77f9",
			"#0D8ECF",
			"#0D52D1",
			"#2A0CD0",
			"#8A0CCF",
			"#CD0D74",
			"#754DEB",
			"#DDDDDD",
			"#999999",
			"#333333",
			"#000000",
			"#57032A",
			"#CA9726",
			"#990000",
			"#4B0C25"
			],
		"legend": {
			"enabled": true,
			"position": "bottom",
			"equalWidths": true,
		},
		"titles": [],
		"dataProvider": [
		{
			"title": "Hired",
			"value": 100
		},
		{
			"title": "Interviewed",
			"value": 123
		},
		{
			"title": "Screened",
			"value": 98
		},
		{
			"title": "Applied",
			"value": 72
		},

		]
	}
	);


</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/MonitoringService/ServiceMonitoring/index.blade.php ENDPATH**/ ?>