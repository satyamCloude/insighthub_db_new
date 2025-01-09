<?php $__env->startSection('title', 'Product'); ?>
<?php $__env->startSection('content'); ?>

<!-- <h2>Disk Monitoring</h2> -->


<style>


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
	<h4 class="py-3 mb-4"><span class="text-muted fw-light">Disk</span> Monitoring </h4>
  <div class="cadd">
   <div class="row">
    <div class="col-lg-12">
     <div class="outer_desc">
      <div class="d-flex justify-content-start align-items-center user-name">
       <div class="avatar-wrapper">
        <div class="avatar me-2">
         <img src="<?php echo e(url('/')); ?>/public/images/up-arrow.png">
       </div>
     </div>
     <div class="d-flex flex-column">
     	<div>
		    <span class="emp_name text-truncate " style="text-align:left;">DB.gayaswm.in</span>
		    <span class="emp_name text-truncate ms-1 text-muted" style="text-align:left;"><i class="fa fa-bars"></i></span>
		    <span class="emp_name text-truncate ms-1" style="text-align:left;"><i class="fa fa-repeat"></i></span>
		</div>
	    <div>
	      <small class="emp_post text-truncate text-muted ">DB.gayaswm.in</small>
	      <small class="emp_post text-truncate text-muted ms-1">[version-19.1.0]</small>
	      <small class="emp_post text-truncate text-muted ms-1">Server Monitor</small>
	      <small class="emp_post text-truncate text-muted ms-1"><i class="fa fa-tag"></i></small>
	    </div>
    </div>
  </div>
  <div class="rght_cont">
   <div class="btn-group">
   		 <button type="button" class="btn btn-outline-secondary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">Last 24 hours</button>
    	 <ul class="dropdown-menu">
	     	<li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
	    	<li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
	        <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
	        <li><hr class="dropdown-divider"></li>
	        <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
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
	    <button type="button" class="btn waves-effect" style="background-color:#d6d8dd;color:#000000;">
	    Add Custom Tab</button>

	    <button type="button" class="btn btn-outline-success  waves-effect"><i class='fas fa-comment-alt' style='font-size:18px;margin-right: 5px;'></i>Incident Chat</button>
	</div>
  </div>
  <div class="below_txt">
  	<div>	
	 <ul class="nav nav-pills flex-column flex-md-row mb-2 mt-3">

      <li class="nav-item">
        <button class="nav-link RemoveActive active" onclick="Tab('Overview', 'Overview')" value="Overview" id="Overview">
          Summary
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('Project', 'Project')" value="Project" id="Project">
          Processes
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('Client', 'Client')" value="Client" id="Client">
          CPU
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')" value="HR" id="HR">
          Memory 
        </button>
      </li> 
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')" value="HR" id="HR">
          Disks 
        </button>
      </li> 
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')" value="HR" id="HR">
          Network 
        </button>
      </li> 
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')" value="HR" id="HR">
          Plugin Integrations 
        </button>
      </li> 
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')" value="HR" id="HR">
          Checks 
        </button>
      </li> 
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')" value="HR" id="HR">
          Syslog 
        </button>
      </li> 
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')" value="HR" id="HR">
          AppLogs 
        </button>
      </li> 
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')" value="HR" id="HR">
          More 
        </button>
      </li>
     </ul>
	</div>
  </div>

</div>
</div>
</div>
<div class="row mt-3">

  <div class="col-md-12 mb-4"> 
    <div class="card">
      <div class="card-body" style="display:
      flex;justify-content: space-between;">

       <div class="inner_tab text-center">
          <span> 100% </span></br>
          <span>Availability</span>
       </div>
        <div class="inner_tab text-center">
         <span> 44.81%</span></br> 
         <span>CPU</span>

       </div>
       <div class="inner_tab text-center">
        <span> 22.84% </span></br>
        <span>Memory</span>
       </div>

       <div class="inner_tab text-center">
        <span>18%</span></br>
        <span>Disk</span>
       </div>

       <div class="inner_tab text-center">
        <span> 0 </span></br>
        <span>Downtimes</span>
       </div>

       <div class="inner_tab text-center">
        <span> - NA -</span></br>
        <span>SLA Achieved</span>
       </div>

    </div>

</div>

<div class="row mt-3">

  <div class="col-md-12 mb-4"> 
  	<div class="card">

    	<div class="card-body flex-column" style="display:flex;">
  			<div style="display:flex;justify-content: space-between;">
  			     <div class="inner_tab2">
  			       <span>Events Timeline</span>
  			     </div> 
  			   <div class="inner_tab2">
  			 	   <button type="button" class="btn waves-effect" style="background-color:#d6d8dd;color:#000000;padding: 6px;">
  				      <i class="fa fa-search-plus"></i></button>
  			    	<button type="button" class="btn waves-effect" style="background-color:#d6d8dd;color:#000000;padding: 6px;">
  				     <i class="fa fa-search-minus"></i></button>	
  			 	    <button type="button" class="btn waves-effect" style="background-color:#d6d8dd;color:#000000;padding: 6px;">
  				    <i class="fa fa-search"></i></button>	    
  			   </div>
  	 		</div>
        <hr>
  	 		<div>
  	 		 Frequency
  	 		</div>
        <div class="d-flex">
          <div class="d-flex align-items-baseline">
            <div class="box" style="background-color: red;"></div>
            <span class="ps-1">Down</span>
          </div> &nbsp &nbsp &nbsp

          <div class="d-flex align-items-baseline">
            <div class="box" style="background-color: orange;"></div>
            <span class="ps-1">Critical</span>
          </div> &nbsp &nbsp &nbsp

          <div class="d-flex align-items-baseline">
            <div class="box" style="background-color: yellow;"></div>
            <span class="ps-1">Trouble</span>
          </div> &nbsp &nbsp &nbsp

          <div class="d-flex align-items-baseline">
            <div class="box" style="background-color: purple;"></div>
            <span class="ps-1">Maintenance</span>
          </div> &nbsp &nbsp &nbsp

          <div class="d-flex align-items-baseline">
            <div class="box" style="background-color: grey;"></div>
            <span class="ps-1">Suspended</span>
          </div>

        </div>
		</div>
    </div>
  </div>
</div>

<div class="row mt-3">

    <div class="col-md-12 mb-4"> 
      <div class="card">
        <div class="card-body" style="display:
           flex;justify-content: space-between;">

          <div class="inner_tab2">
            <span>Snapshot</span>
          </div>
        </div>
        <hr>
        
          <div class="row g-0">
            <div class="col col-md-9 app-email-sidebar border-end flex-grow-0" id="app-email-sidebar">
                <div class="row m-3 justify-content-around">
                  <div class="col-lg-4 col-sm-6 mb-4">
                     <div class="card" style="background-color: #DCDCDC;">
                      <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span>
                          </div>
                          <span class="ms-1 mb-0">
                           <span class="dot" style="background-color: green;"></span>
                          </span>
                          <h4 class="ms-1 mb-0">1</h4>
                        </div>
                        <p class="mb-1">Processes</p>
                        <p class="mb-0 float-end">
                          <a href="#">Add New</a>
                        </p>
                      </div>
                    </div>
                  </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                     <div class="card" style="background-color: #DCDCDC;">
                      <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span>
                          </div>
                          <span class="ms-1 mb-0">
                           <span class="dot" style="background-color: green;"></span>
                          </span>
                          <h4 class="ms-1 mb-0">2</h4>
                        </div>
                        <p class="mb-1">NICs</p>
                        
                      </div>
                    </div>
                  </div>
                   <div class="col-lg-4 col-sm-6 mb-4">
                     <div class="card" style="background-color: #DCDCDC;">
                      <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span>
                          </div>
                          <span class="ms-1 mb-0">
                           <span class="dot" style="background-color: red;"></span>
                          </span>
                          <h4 class="ms-1 mb-0">1</h4>
                        </div>
                        <p class="mb-1">Disks</p>
                       
                      </div>
                    </div>
                  </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                     <div class="card" style="background-color: #DCDCDC;">
                      <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span>
                          </div>
                          <h4 class="ms-1 mb-0">0</h4>
                        </div>
                        <p class="mb-1">Plugins</p>
                        <p class="mb-0 float-end">
                          <a href="#">Add New</a>
                        </p>
                      </div>
                    </div>
                  </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                     <div class="card" style="background-color: #DCDCDC;">
                      <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span>
                          </div>
                          <h4 class="ms-1 mb-0">0</h4>
                        </div>
                        <p class="mb-1">Checks</p>
                        <p class="mb-0 float-end">
                          <a href="#">Add New</a>
                        </p>
                      </div>
                    </div>
                  </div>
                   <div class="col-lg-4 col-sm-6 mb-4">
                     <div class="card" style="background-color: #DCDCDC;">
                      <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                          <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span>
                          </div>
                          <h4 class="ms-1 mb-0">0</h4>
                        </div>
                        <p class="mb-1">Syslog Errors</p>
                       <p class="mb-0 float-end">
                          <a href="#">Add New</a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col col-md-3 p-3 app-email-sidebar border-end flex-grow-0" id="app-email-sidebar">
              <p class="small text-uppercase text-muted"><b>Server Details</b></p>
               <div class="info-container">
                  <ul class="list-unstyled">
                      <li class="mb-2">
                        <span class="fw-medium me-1">DB.gayaswm.in</span>
                      </li>
                      <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">10.10.34.25</span>
                      </li>
                      <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">CentOS Linux 7(Core) x86_64</span>   
                      </li>
                      <li class="mb-2 pt-1">
                        <span class="fw-medium me-1 text-primary">8 CPU Cores/32011 MBRAM</span>
                      </li>
                      <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">Commmon KVM processor</span>  
                      </li>
                  </ul>
              </div>
              <p class="small text-uppercase text-muted"><b>Server Statistics</b></p>
               <div class="info-container">
                  <ul class="list-unstyled">
                      <li class="mb-2 pt-1">
                        <span class="fw-medium me-1"> Uptime:</span>
                        <span>31day(s)7hr(s)3min(s)22sec(s)</span>
                      </li>
                      <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">Login Count:</span>
                        <span>0</span>
                      </li>
                      <li class="pt-1">
                        <span class="fw-medium me-1">Open Port Count:</span>
                        <span>50</span>
                      </li> 
                      <li class="pt-1">
                        <span class="fw-medium me-1">Total Process:</span>
                        <span>209</span>
                      </li>
                  </ul>
              </div>
            </div>
        </div>
      
    </div>
</div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/MonitoringService/DiskMonitoring/index.blade.php ENDPATH**/ ?>