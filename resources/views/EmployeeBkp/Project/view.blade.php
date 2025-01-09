@extends('layouts.admin')
@section('title', 'Project')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="container">
<div class="row">
   <div class="col-md-6 mb-4">
      <div class="card bg-white border-0 b-shadow-4">
         <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <h4 class="f-18 f-w-500 mb-0">Project Progress</h4>
         </div>
      </div>
   </div>
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
                        <!-- image       -->
                     </div>
                     <div class="card-body border-0 p-0 ml-4 ml-xl-4 ml-lg-3 ml-md-3">
                        <!-- <h4 class="card-title f-15 font-weight-normal mb-0">name</h4> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row mb-4">
   <!-- TASK STATUS START -->
   <div class="col-lg-6 col-md-12">
      <div class="card bg-white border-0 b-shadow-4">
         <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <h4 class="f-18 f-w-500 mb-0">Tasks</h4>
         </div>
         <div class="card-body p-0 ">
            <!-- Graph -->
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
               <div class="d-block text-capitalize my-3 px-md-5">
                  <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Project Budget
                  </h5>
                  <div class="d-flex">
                     <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span id="">0</span>
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
               <div class="d-block text-capitalize my-3 px-md-5">
                  <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Earnings
                  </h5>
                  <div class="d-flex">
                     <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span id="">0</span>
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col">
            <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
               <div class="d-block text-capitalize my-3 px-md-5">
                  <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Hours Logged
                  </h5>
                  <div class="d-flex">
                     <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span id="">0</span>
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center">
               <div class="d-block text-capitalize my-3 px-md-5">
                  <h5 class="f-15 f-w-500 mb-20 text-darkest-grey">Expenses
                  </h5>
                  <div class="d-flex">
                     <p class="mb-0 f-15 font-weight-bold text-blue text-primary d-grid"><span id="">0</span>
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- BUDGET VS SPENT END -->
</div>
<div class="row mb-4">
   <!-- BUDGET VS SPENT START -->
   <div class="col-lg-6 col-md-12">
      <div class="card bg-white border-0 b-shadow-4">
         <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <h4 class="f-18 f-w-500 mb-0">Hours Logged</h4>
         </div>
      </div>
   </div>
   <div class="col-lg-6 col-md-12">
      <div class="card bg-white border-0 b-shadow-4">
         <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
            <h4 class="f-18 f-w-500 mb-0">Project Budget</h4>
         </div>
      </div>
   </div>
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
@endsection