<?php $__env->startSection('title', 'Product'); ?>
<?php $__env->startSection('content'); ?>

<!-- <h2>Disk Monitoring</h2> -->

<style>

  
.custom-checkbox {
   width: 220px;
   height: 30px;
}
 .custom-checkbox input#status {
   display: none;
}
 .custom-checkbox input#status + label {
   height: 100%;
   width: 100%;
}
 .custom-checkbox input#status + label > .status-switch {
   cursor: pointer;
   width: 100%;
   height: 100%;
   position: relative;
   background-color: white;
   color: black;
   transition: all 0.5s ease;
   padding: 3px;
   border-radius: 3px;
}
 .custom-checkbox input#status + label > .status-switch:before, .custom-checkbox input#status + label > .status-switch:after {
   border-radius: 2px;
   height: calc(100% - 6px);
   width: calc(50% - 3px);
   display: flex;
   align-items: center;
   position: absolute;
   justify-content: center;
   transition: all 0.3s ease;
}
 .custom-checkbox input#status + label > .status-switch:before {
   background-color: #d6d8dd;
   color: black;
   box-shadow: 0 0 4px 4px rgba(0, 0, 0, 0.2);
   left: 3px;
   z-index: 10;
   content: attr(data-unchecked);
}
 .custom-checkbox input#status + label > .status-switch:after {
   right: 0;
   content: attr(data-checked);
}
 .custom-checkbox input#status:checked + label > .status-switch {
   background-color: white;
}
 .custom-checkbox input#status:checked + label > .status-switch:after {
   left: 0;
   content: attr(data-unchecked);
}
 .custom-checkbox input#status:checked + label > .status-switch:before {
   color: black;
   left: 50%;
   content: attr(data-checked);
}

  .outer_desc{


   display: flex; justify-content: space-between; background-color: white;
   padding: 4px 9px; 

 }


 .below_txt{


   background-color: white;
   display: flex;
   justify-content: space-between;
   align-items: center;
   padding: 2px 9px;
 }

 .dot {
  height: 10px;
  width: 10px;
  /*background-color: #bbb;*/
  border-radius: 50%;
  display: inline-block;
}



 .cadd{

  box-shadow: 0 0.25rem 1.125rem rgba(75, 70, 92, 0.1);

}


.inner_tab{

  border-right: 2px solid #7367F0;
  padding-right: 70px;
}

.box {
  width: 10px;
  height: 10px;
}



</style>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Network </span>
    Monitoring </h4>
  <div class="cadd">
    <div class="row">
      <div class="col-lg-12">
        <div class="outer_desc">
          <div
            class="d-flex justify-content-start align-items-center user-name">
            <div class="avatar-wrapper">
              <div class="avatar me-2">
                <img src="<?php echo e(url('/')); ?>/public/images/up-arrow.png">
              </div>
            </div>
            <div class="d-flex flex-column">
              <div>
                <span class="emp_name text-truncate "
                  style="text-align:left;">DB.gayaswm.in</span>
                <span class="emp_name text-truncate ms-1 text-muted"
                  style="text-align:left;"><i class="fa fa-bars"></i></span>
                <span class="emp_name text-truncate ms-1"
                  style="text-align:left;"><i class="fa fa-repeat"></i></span>
              </div>
              <div>
                <small
                  class="emp_post text-truncate text-muted ">DB.gayaswm.in</small>
                <small
                  class="emp_post text-truncate text-muted ms-1">[version-19.1.0]</small>
                <small class="emp_post text-truncate text-muted ms-1">Server
                  Monitor</small>
                <small class="emp_post text-truncate text-muted ms-1"><i
                    class="fa fa-tag"></i></small>
              </div>
            </div>
          </div>
          <div class="rght_cont">
            <div class="btn-group">
              <button type="button"
                class="btn btn-outline-secondary dropdown-toggle waves-effect"
                data-bs-toggle="dropdown" aria-expanded="false">Last 24
                hours</button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item"
                    href="javascript:void(0);">Action</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Another
                    action</a></li>
                <li><a class="dropdown-item"
                    href="javascript:void(0);">Something else here</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item"
                    href="javascript:void(0);">Separated link</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="below_txt">
          <div>
          </div>
          <div>
            <button type="button" class="btn waves-effect"
              style="background-color:#d6d8dd;color:#000000;">
              Add Custom Tab</button>

            <button type="button"
              class="btn btn-outline-success  waves-effect"><i
                class='fas fa-comment-alt'
                style='font-size:18px;margin-right: 5px;'></i>Incident
              Chat</button>
          </div>
        </div>
        <div class="below_txt">
          <div>
            <ul class="nav nav-pills flex-column flex-md-row mb-2 mt-3">

              <li class="nav-item">
                <button class="nav-link RemoveActive active"
                  onclick="Tab('Overview', 'Overview')" value="Overview"
                  id="Overview">
                  Summary
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link RemoveActive"
                  onclick="Tab('Project', 'Project')" value="Project"
                  id="Project">
                  Processes
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link RemoveActive"
                  onclick="Tab('Client', 'Client')" value="Client" id="Client">
                  CPU
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')"
                  value="HR" id="HR">
                  Memory
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')"
                  value="HR" id="HR">
                  Disks
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')"
                  value="HR" id="HR">
                  Network
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')"
                  value="HR" id="HR">
                  Plugin Integrations
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')"
                  value="HR" id="HR">
                  Checks
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')"
                  value="HR" id="HR">
                  Syslog
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')"
                  value="HR" id="HR">
                  AppLogs
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')"
                  value="HR" id="HR">
                  More
                </button>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- <div class="row mt-3">

  <div class="col-md-12 mb-4"> 
    <div class="card">

      <div class="card-body flex-column" style="display:flex;">
        <div style="display:flex;justify-content: space-between;">
             <div class="inner_tab2">
               <span><b>Disk Partition Details & Usage Forecasting</b></span>
             </div> 
           <div class="inner_tab2 d-flex">
              <div class="p-1 border border-secondary rounded">
                <div class="custom-checkbox">
                  <input id="status" 
                         type="checkbox" 
                         name="status">
                  <label for="status">
                    <div class="status-switch"
                         data-unchecked="Last24Hours"
                         data-checked="LastPolled">
                    </div>
                  </label>
                </div>
              </div>
              
              <button type="button" class="btn waves-effect mx-1" style="background-color:#d6d8dd;color:#000000;padding: 6px;"> Rediscover </button>  
              <button type="button" class="btn waves-effect mx-1" style="background-color:#d6d8dd;color:#000000;padding: 6px;"> Bulk Action
              </button>     
           </div>
        </div>
        <hr>
        <div>
         Frequency
        </div>
       
    </div>
    </div>
  </div>
</div> -->

  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <div id="DataTables_Table_0_wrapper"
        class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="card-header flex-column flex-md-row pb-0">
          <div class="head-label text-center">
            <h5 class="card-title mb-0">Disk Partition Details & Usage
              Forecasting</h5>
          </div>
          <div class="dt-action-buttons text-end pt-3 pt-md-0">
            <div class="dt-buttons btn-group flex-wrap">
              <div class="inner_tab2 d-flex">
                <div class="p-1 border border-secondary rounded">
                  <div class="custom-checkbox">
                    <input id="status"
                      type="checkbox"
                      name="status">
                    <label for="status">
                      <div class="status-switch"
                        data-unchecked="Last24Hours"
                        data-checked="LastPolled">
                      </div>
                    </label>
                  </div>
                </div>

                <button type="button" class="btn waves-effect mx-1"
                  style="background-color:#d6d8dd;color:#000000;padding: 6px;">
                  Rediscover </button>
                <button type="button" class="btn waves-effect mx-1"
                  style="background-color:#d6d8dd;color:#000000;padding: 6px;">
                  Bulk Action
                </button>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="dataTables_length" id="DataTables_Table_0_length">
              <label>Show <select name="DataTables_Table_0_length"
                  aria-controls="DataTables_Table_0" class="form-select">
                  <option value="7">7</option>
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                </select> entries</label>
            </div>
          </div>
          <div
            class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
            <div id="DataTables_Table_0_filter" class="dataTables_filter">
              <label>Search:<input type="search" class="form-control"
                  placeholder aria-controls="DataTables_Table_0"></label>
            </div>
          </div>
        </div>
        <table
          class="datatables-basic table dataTable no-footer dtr-column collapsed"
          id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"
          style="width: 1044px;">
          <thead>
            <tr>
              <th class="control sorting_disabled" rowspan="1" colspan="1"
                style="width: 0px;" aria-label>
              </th>
              <th
                class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all"
                rowspan="1" colspan="1" style="width: 18px;" data-col="1"
                aria-label>
                <input type="checkbox" class="form-check-input">
              </th>
              <th class="sorting sorting_asc" tabindex="0"
                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 241px;"
                aria-label="Name: activate to sort column descending"
                aria-sort="ascending">Name</th>
              <th class="sorting" tabindex="0"
                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 229px;"
                aria-label="Email: activate to sort column ascending">File
                System</th>
              <th class="sorting" tabindex="0"
                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 75px;"
                aria-label="Date: activate to sort column ascending">Size</th>
              <th class="sorting" tabindex="0"
                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 73px;"
                aria-label="Salary: activate to sort column ascending">Used
                Space</th>
              <th class="sorting" tabindex="0"
                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 90px;"
                aria-label="Status: activate to sort column ascending">Free
                Space</th> <th class="sorting" tabindex="0"
                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 90px;"
                aria-label="Status: activate to sort column ascending">Used(%)</th>
              <th class="sorting" tabindex="0"
                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 90px;"
                aria-label="Status: activate to sort column ascending">Free(%)</th>
              <th class="sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                style="width: 0px;" aria-label="Actions">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="odd">
              <td class="control" tabindex="0" style></td>
              <td class="  dt-checkboxes-cell">
                <input type="checkbox" class="dt-checkboxes form-check-input">
              </td>
              <td class="sorting_1">
                <div
                  class="d-flex justify-content-start align-items-center user-name">
                  <div class="avatar-wrapper">
                    <div class="avatar me-2">
                      <span
                        class="avatar-initial rounded-circle bg-label-primary">AB</span>
                    </div>
                  </div>
                  <div class="d-flex flex-column">
                    <span class="emp_name text-truncate">/boot</span>
                    <!-- <small class="emp_post text-truncate text-muted">Tax Accountant</small> -->
                  </div>
                </div>
              </td>
              <td>xfs</td>
              <td>294.97GB</td>
              <td>63.25GB</td>
              <td>231.72GB</td>
              <td>21.0%</td>
              <td>78.53%</td>
              <td>
                <span class="badge  bg-label-warning">Resigned</span>
              </td>
              <td class="dtr-hidden" style="display: none;">
                <div class="d-inline-block">
                  <a href="javascript:;"
                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown">
                    <i class="text-primary ti ti-dots-vertical"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end m-0">
                    <li>
                      <a href="javascript:;" class="dropdown-item">Details</a>
                    </li>
                    <li>
                      <a href="javascript:;" class="dropdown-item">Archive</a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li>
                      <a href="javascript:;"
                        class="dropdown-item text-danger delete-record">Delete</a>
                    </li>
                  </ul>
                </div>
                <a href="javascript:;" class="btn btn-sm btn-icon item-edit">
                  <i class="text-primary ti ti-pencil"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="row mt-3">
          <div class="col-md-12 mb-4">
            <div class="card">
              <div class="card-body" style="display:
                 flex;justify-content: left ;">
                <div class="inner_tab text-center ps-1 pe-2"
                  style="border-right-color: brown;">
                  <span>Overall thershold=95% </span></br>
                </div>
                <div class="inner_tab text-center ps-1 pe-2">
                  <span>Individual threshold</span>
                </div>
                <div class="inner_tab text-center ps-1 pe-2"
                   style="border-right-color: white;">
                   <span>Predicted Value(After 7days) </span></br>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-3">

          <div class="col-md-12 mb-4"> 
            <div class="card">

              <div class="card-body flex-column" style="display:flex;">
                <div style="display:flex;justify-content: space-between;">
                     <div class="inner_tab2">
                       <span>Disks(I/O) <i style="color: #d6d8dd;" class="fa fa-line-chart"></i></span>
                     </div> 
                   
                </div>
                <hr>
                
                <div class="d-flex justify-content-center">
                  <div class="col-md-6">
                    <table class="table">
                      <thead>
                        <tr class="border border-white">
                          <th scope="col"></th>
                          <th scope="col">Average</th>
                          <th scope="col">Minimum</th>
                          <th scope="col">Maximum</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="border border-white">
                          <th scope="row">Disk Reads(Kb/sec)</th>
                          <td>14.21</td>
                          <td>0</td>
                          <td>5,365.79</td>
                        </tr>
                        <tr class="border border-white">
                          <th scope="row">Disk Writes(KB/sec)</th>
                          <td>878.85</td>
                          <td>334.33</td>
                          <td>22.33313</td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                 
                </div>
            </div>
            </div>
          </div>
        </div>



  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/MonitoringService/NetworkMonitoring/index.blade.php ENDPATH**/ ?>