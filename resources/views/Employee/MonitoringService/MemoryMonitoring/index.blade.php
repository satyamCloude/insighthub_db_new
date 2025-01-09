@extends('layouts.admin')
@section('title', 'Product')
@section('content')

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



 .cadd{

  box-shadow: 0 0.25rem 1.125rem rgba(75, 70, 92, 0.1);

}


.inner_tab{

  border-right: 2px solid #7367F0;
  padding-right: 70px;
}


</style>

<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="py-3 mb-4"><span class="text-muted fw-light">Service /</span> Monitoring </h4>
  <div class="cadd">
   <div class="row">
    <div class="col-lg-12">
     <div class="outer_desc">
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
  <div class="rght_cont">
   <div class="btn-group">
    <button type="button" class="btn btn-outline-secondary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">Last 24 hours</button>
    <ul class="dropdown-menu">
     <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
     <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
     <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
     <li>
      <hr class="dropdown-divider">
    </li>
    <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
  </ul>
</div>

</div>
</div>
</div>
<div class="col-lg-12">
	<div class="below_txt">
		

		<ul class="nav nav-pills flex-column flex-md-row mb-2 mt-3">

      <li class="nav-item">
        <button class="nav-link RemoveActive active" onclick="Tab('Overview', 'Overview')" value="Overview" id="Overview">
          Summary
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('Project', 'Project')" value="Project" id="Project">
          Outages
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('Client', 'Client')" value="Client" id="Client">
          Inventory
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link RemoveActive" onclick="Tab('HR', 'HR')" value="HR" id="HR">
          Log Report
        </button>
      </li>
    </ul>
    <button type="button" class="btn btn-outline-success  waves-effect"><i class='fas fa-comment-alt' style='font-size:18px;margin-right: 5px;'></i>Incident Chat</button>
  </div>

</div>
</div>
</div>
<div class="row mt-3">

  <div class="col-md-12 mb-4"> <div class="card"><div class="card-body" style="display:
  flex;justify-content: space-between;">

  <div class="inner_tab text-center">
    <span> 100% </span></br>
    <span>Availability</span>
  </div>
  <div class="inner_tab text-center">
   <span> 1.37 sec(s)</span></br> 
   <span>Response Time</span>

 </div>
 <div class="inner_tab text-center">
  <span> 0 </span></br>
  <span>Downtimes</span>

</div>
<div class="inner_tab text-center">
  <span>108   KB/sec</span></br>
  <span>Throughput</span>

</div>
<div class="inner_tab text-center">
  <span> - NA -</span></br>
  <span>SLA Achieved</span>

</div>
<div class="inner_tab text-center">
  <span> Get score</span></br>
  <span>DRA risk score</span>

</div>
</div>

</div>

<div class="row mt-3">

  <div class="col-md-12 mb-4"> <div class="card">

    <div class="card-body" style="display:
  flex;justify-content: space-between;">

  <div class="inner_tab2">
    <span>Events Timeline</span>
  </div>

</div>
</div>
</div>
</div>

</div>
</div>
</div>

@endsection