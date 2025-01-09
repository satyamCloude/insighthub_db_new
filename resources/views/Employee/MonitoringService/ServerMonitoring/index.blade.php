@extends('layouts.admin')
@section('title', 'Product')
@section('content')

<style>

	.inner_ellipse_list{

		box-shadow: 0 0.25rem 1.125rem rgba(75,70,92,.1);
		display: flex;
		padding: 16px 2px;
		background-color: white;
		color: #544c70;
		justify-content: center;
	}


	.out_circ{

		text-align: center;
		padding: 2px 9px;
	}


	.fig_circ{

		border-radius: 50%;
		border:3px solid #dd524d;
		height: 100%;
		width: 90px;
		display: flex;
		justify-content: center;
		align-items: center;
		height: 90px;
		box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;


	}


	.fig_circ3{

		border-radius: 50%;
/*border:3px solid red;*/
height: 100%;
width: 90px;
display: flex;
justify-content: center;
align-items: center;
height: 90px;
background-color: #F5C229;
box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}


.fig_circ4{

	border-radius: 50%;
/*border:3px solid red;*/
height: 100%;
width: 90px;
display: flex;
justify-content: center;
align-items: center;
height: 90px;
background-color: #28CE70;
box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}


.fig_circ span{


	font-size: 20px;

}



.below_card{


	display: flex;
	justify-content: space-evenly;

}


.digit{


	font-size: 20px;
}


.card{


	text-align: center;
}

.in_box{

	display: flex;
	flex-direction: column;
	text-align: center;

}

.numbe{


	color:#5d596c;
	font-weight: 500;
}



</style>
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Server</h4>
	<div class="row">
		<div class="col-lg-5">
			<div class="inner_ellipse_list" style="border-radius: 6px;">
				<div class="out_circ">
					<div class="inner_ellipse">
						<div class="fig_circ mb-2">
							<span class="numbe">0</span>
						</div>
						<div class="txt_blw">
							<span class="mt-2">Down</span>
						</div>
					</div>
				</div>
				<div class="out_circ">
					<div class="inner_ellipse">
						<div class="fig_circ mb-2">
							<span>0</span>
						</div>
						<div class="txt_blw">
							<span>Critical</span>
						</div>
					</div>
				</div>
				<div class="out_circ">
					<div class="inner_ellipse">
						<div class="fig_circ3 mb-2">
							<span style="color:white;font-size: 25px;">1</span>
						</div>
						<div class="txt_blw">
							<span>Trouble</span>
						</div>
					</div>
				</div>
				<div class="out_circ">
					<div class="inner_ellipse">
						<div class="fig_circ4 mb-2">
							<span style="color:white;font-size: 25px;">17</span>
						</div>
						<div class="txt_blw">
							<span>Up</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="inner_ellipse_list" style="border-radius: 6px;">
				<div class="out_circ">
					<div class="inner_ellipse" style="display: flex;
    flex-direction: column;
    align-items: center;">
						<div class="fig_circ mb-2">
							<span>0</span>
						</div>
						<div class="txt_blw">
							<span class="mt-2">Confirmed Anomalies</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card" style="min-height: 158px;">
			<span style="
			background-color: #9c94f4;
			border-bottom-left-radius: 40px;
			border-bottom-right-radius: 40px;
			color: white;
			font-size: 16px;
			padding: 8px 2px;
			">Total Monitors : 39</span>
			<div class="below_card">
				<div class="in_box">
					<span class="digit">0</span>
					<span>Maintenance</span>
				</div>
				<div class="in_box">
					<span class="digit">0</span>
					<span>Configuration error</span>
				</div>
			</div>
			<div class="below_card">
				<div class="in_box">
					<span class="digit">1</span>
					<span>Suspended Monitors</span>
				</div>
				<div class="in_box">
					<span class="digit">21</span>
					<span>Discovery in progress</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="table_data mt-4">
<div class="row">
	
<div class="card">
  <div class="card-datatable table-responsive pt-0">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
      <div class="card-header flex-column flex-md-row">
        <div class="head-label text-center">
          <h5 class="card-title mb-0">Performance overview</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-6">
        </div>
      </div>
      <table class="datatables-basic table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1215px;">
        <thead>
          <tr>
            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Name: activate to sort column ascending">Monitor Name</th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="text-align:center;width: 100px;">Performance</th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="text-align:center;width: 300px;">Last Polled</th>
          </tr>
        </thead>
        <tbody>
          <tr class="odd">
            <td class="control" tabindex="0" style="display: none;"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2">
                    <img src="{{url('/')}}/public/images/up-arrow.png">
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <span class="emp_name text-truncate" style="text-align:left;">DB.gayaswm.in</span>
                  <small class="emp_post text-truncate text-muted">Windows | Server Monitor | </small>
                </div>
              </div>
            </td>
            <td>11.02 KB/sec</td>
            <td>a minute ago</td>
          </tr>
          <tr class="even">
            <td class="  control" tabindex="0" style="display: none;"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2">
                   <img src="{{url('/')}}/public/images/caution.png">
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <span class="emp_name text-truncate">DB.gayaswm.in-IIS</span>
                  <small class="emp_post text-truncate text-muted">Microsoft IIS Server |</small>
                </div>
              </div>
            </td>
            <td>3,931 ms</td>
            <td>8 minutes ago</td>
          </tr>
          <tr class="odd">
            <td class="  control" tabindex="0" style="display: none;"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2">
                    <img src="{{url('/')}}/public/images/caution.png">
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <span class="emp_name text-truncate">gayaswm.in</span>
                  <small class="emp_post text-truncate text-muted">Website |</small>
                </div>
              </div>
            </td>
            <td>9.4%</td>
            <td>4 minutes ago</td>
          </tr>
          <tr class="even">
            <td class="  control" tabindex="0" style="display: none;"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2">
                    <img src="{{url('/')}}/public/images/up-arrow.png">
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <span class="emp_name text-truncate">Home Page - raajkart.com</span>
                  <small class="emp_post text-truncate text-muted">Web Page Speed (Browser) |</small>
                </div>
              </div>
            </td>
            <td>1,091 ms</td>
            <td>a few seconds ago</td>
          </tr>
          <tr class="odd">
            <td class="  control" tabindex="0" style="display: none;"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2">
                    <img src="{{url('/')}}/public/images/up-arrow.png">
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <span class="emp_name text-truncate" style="text-align:left;">linux2.tootoo.in</span>
                  <small class="emp_post text-truncate text-muted">Linux | Server Monitor</small>
                </div>
              </div>
            </td>
            <td>2,195 ms</td>
            <td>a few seconds ago</td>
          </tr>
          <tr class="even">
            <td class="  control" tabindex="0" style="display: none;"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2">
                    <img src="{{url('/')}}/public/images/up-arrow.png">
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <span class="emp_name text-truncate">Rajkaart</span>
                  <small class="emp_post text-truncate text-muted">Website |</small>
                </div>
              </div>
            </td>
            <td>74 day(s)</td>
            <td>22 minutes ago</td>
          </tr>
          <tr class="odd">
            <td class="  control" tabindex="0" style="display: none;"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2">
                    <img src="{{url('/')}}/public/images/caution.png">
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <span class="emp_name text-truncate">SchoolBookSet</span>
                  <small class="emp_post text-truncate text-muted" style="text-align:left;">Website |</small>
                </div>
              </div>
            </td>
            <td>51 day(s)</td>
            <td>21 minutes ago</td>
          </tr>
        </tbody>
      </table>
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="text-align: left;">Showing 1 to 7 of 100 entries</div>
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