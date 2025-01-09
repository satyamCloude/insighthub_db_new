<?php $__env->startSection('title', 'Leave'); ?>
<?php $__env->startSection('content'); ?>
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .actives{
    border: 0px solid #1ff11f;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: #1ff11f;
    }
  .non-interactive {
            pointer-events: none;
            user-select: none;
        }
  .inactives{
    border: 0px solid red;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: red;
    }
    .orangecose{
    border: 0px solid orange;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: orange;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">

    <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
    <div class="alert alert-success" role="alert" id="ResMsg" style="display:none;"></div>
    
     <div class="row g-4 mb-4 d-flex">
         <div class="col-sm-2 col-xl-4">

                     <div class="card">
                        <div class="card-body">
                           <h4 class=""><span class="text-muted fw-light"> <?php if($user_details->profile_img): ?>
                            <img 
                                class="rounded-circle"
                                style="margin-right: 15px;margin-top: 10px;" 
                                src="<?php echo e($user_details->profile_img); ?>"
                                height="40"
                                width="40"
                                alt="User avatar" 
                            />
                            <?php else: ?>
                            <img class="rounded-circle"
                                style="margin-right: 15px;margin-top: 10px;" 
                                src="<?php echo e(url('public/images/21104.png')); ?>"
                                height="30"
                                width="30"
                                alt="User avatar" 
                            />
                            <?php endif; ?>
                        <?php echo e(ucfirst($user_details->first_name)); ?> <?php echo e(ucfirst($user_details->last_name)); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($user_details->email); ?></div></h4>
                        </div>
                     </div> 
                  </div>
                  <div class="col-sm-2 col-xl-2">

                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex align-items-start justify-content-between">
                              <div class="content-left">
                                 <span>Total Leaves</span>
                                 <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2"><?php echo e($approveCount+$unapproveCount+$PendingCount); ?></h3>
                                    <!-- <p class="text-success mb-0">0</p> -->
                                 </div>
                                 <!-- <p class="mb-0">Total Quotes</p> -->
                              </div>
                              <div class="avatar">
                                 <span class="avatar-initial rounded bg-label-primary">
                                 <i class="ti ti-user ti-sm"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div> 
                  </div>
     
        
              <div class="col-sm-2 col-xl-2">
                 <div class="card">
                    <div class="card-body">
                       <div class="d-flex align-items-start justify-content-between">
                          <div class="content-left">
                             <span>Approved</span>
                             <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2"><?php echo e($approveCount); ?></h3>
                                <!-- <p class="text-success mb-0"></p> -->
                             </div>
                          </div>
                          <div class="avatar">
                             <span class="avatar-initial rounded bg-label-danger">
                             <i class="ti ti-user-plus ti-sm"></i>
                             </span>
                          </div>
                       </div>
                    </div>
                 </div>
                 
              </div>
       
      <div class="col-sm-2 col-xl-2">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Unapproved</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2"><?php echo e($unapproveCount); ?></h3>
                        <!-- <p class="text-danger mb-0"></p> -->
                     </div>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-success">
                     <i class="ti ti-user-check ti-sm"></i>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
    
         
      <div class="col-sm-2 col-xl-2">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Pending</span>
                     <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2"><?php echo e($PendingCount); ?></h3>
                        <!-- <p class="text-success mb-0"></p> -->
                     </div>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-warning">
                     <i class="ti ti-user-exclamation ti-sm"></i>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   
   </div>
    <!--<div class="row">-->

    <!--     <div class="card-body">-->
    <!--      <div class="row g-4 mb-4">-->
           
    <!--        <div class="col-sm-3 col-xl-3">-->
    <!--          <div class="card bg-info text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            <a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">Total Leave</h4>-->
    <!--                  <p class="text-white mt-3"><?php echo e($approveCount+$unapproveCount+$PendingCount); ?></p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>    -->
            
    <!--        <div class="col-sm-3 col-xl-3">-->
    <!--          <div class="card bg-success text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            <a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">Approved</h4>-->
    <!--                  <p class="text-white mt-3"><?php echo e($approveCount); ?></p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>       <div class="col-sm-3 col-xl-3">-->
    <!--          <div class="card bg-warning text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            <a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">Pending</h4>-->
    <!--                  <p class="text-white mt-3"><?php echo e($PendingCount); ?></p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>     -->
                
                
    <!--              <div class="col-sm-3 col-xl-3">-->
    <!--          <div class="card bg-danger text-white">-->
    <!--          <div class="text-end p-1">-->
    <!--            <a id="" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
    <!--          </div>-->
    <!--            <div class="card-body">-->
    <!--              <div class="d-flex align-items-start justify-content-between">-->
    <!--                  <h4 class="text-white">Unapproved</h4>-->
    <!--                  <p class="text-white mt-3"><?php echo e($unapproveCount); ?></p>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>  -->
    <!--         <div class="col-sm-3 col-xl-3">-->
    <!--               <a href="<?php echo e(url('admin/Leave/home2')); ?>"  target="_blank" class="btn btn-label-primary me-3">-->
    <!--            <span class="align-middle"> New Leave Page</span>-->
    <!--          </a>-->
    <!--            <a href="<?php echo e(url('Employee/Leave/add')); ?>" class="btn btn-primary mt-3 m-3">Add Leave</a>-->
    <!--        </div>-->
            
    <!--      </div>-->
             
    <!--  </div>-->
    <!--</div>-->

    
  <!-- Users List Table -->
  
        <div class="row  mt-4">
             
             <div class="col-xl-6 col-6 mb-4">
                
                      <div class="card">
                        <div class="card-header header-elements">
                          <h5 class="card-title mb-0">Current Month leave pattern</h5>
                          <div class="card-action-element ms-auto py-0">
                            <div class="dropdown">
                              <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-calendar"></i>
                              </button>
                              <!--<ul class="dropdown-menu dropdown-menu-end">-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <hr class="dropdown-divider">-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a>-->
                              <!--  </li>-->
                              <!--  <li>-->
                              <!--    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a>-->
                              <!--  </li>-->
                              <!--</ul>-->
                            </div>
                          </div>
                        </div>
                          <div class="card-body" style="position: relative;">
                             <div id="donutChart" style="min-height: 357.7px;">
                        </div>
                      </div>
                      </div>
        </div>
        <!--     <div class="col-xl-4 col-6 mb-4">-->
        <!--              <div class="card">-->
        <!--                <div class="card-header header-elements">-->
        <!--                  <h5 class="card-title mb-0">Weekly leave pattern</h5>-->
        <!--                  <div class="card-action-element ms-auto py-0">-->
        <!--                    <div class="dropdown">-->
        <!--                      <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">-->
        <!--                        <i class="ti ti-calendar"></i>-->
        <!--                      </button>-->
        <!--                      <ul class="dropdown-menu dropdown-menu-end">-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <hr class="dropdown-divider">-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                          <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a>-->
        <!--                        </li>-->
        <!--                      </ul>-->
        <!--                    </div>-->
        <!--                  </div>-->
        <!--                </div>-->
        <!--                <div class="card-body">-->
        <!--                  <canvas id="barChart" class="chartjs" data-height="400" height="500" style="display: block; box-sizing: border-box; height: 400px; width: 545px;" width="682"></canvas>-->
        <!--                </div>-->
        <!--              </div>-->
        <!--</div>-->
         <div class="col-xl-6 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Weekly Leaves</h5>
            <small class="text-muted">Weekly Leaves Overview</small>
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
                  <h6 class="mb-0">Total Leaves</h6>
                  <!--<small class="text-muted"><?php echo e($approveCount+$unapproveCount+$PendingCount); ?></small>-->
                </div>
                <div class="user-progress d-flex align-items-center gap-3">
                  <small><?php echo e($approveCount+$unapproveCount+$PendingCount); ?></small>
                  <!--<div class="d-flex align-items-center gap-1">-->
                  <!--  <i class="ti ti-chevron-up text-success"></i>-->
                  <!--  <small class="text-muted">18.6%</small>-->
                  <!--</div>-->
                </div>
              </div>
            </li>
         
          </ul>
         <div id="reportBarChart" style="margin-top:119px;"></div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 389px; height: 401px;"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
    </div>
    </div>
    
    
               <!--dynamic leave type data end -->

    
    
 
          <!--dynamic leave type data end -->

    
    <div class="col-xl-12 mb-4 mb-xl-0">
      <div class="card">
        <h5 class="card-header"> 
        
        <?php if($user_details->profile_img): ?>

        <!--<img -->
        <!--                    class="rounded-circle"-->
        <!--                    style="margin-right: 15px;margin-top: 10px;" -->
        <!--                    src="<?php echo e($user_details->profile_img); ?>"-->
        <!--                    height="30"-->
        <!--                    width="30"-->
        <!--                    alt="User avatar" />-->
                                                    <?php else: ?>

                                                    <!--<img class="rounded-circle"-->

                                                    <!--style="margin-right: 15px;margin-top: 10px;" -->

                                                    <!--src="<?php echo e(url('public/images/21104.png')); ?>"-->

                                                    <!--height="30"-->

                                                    <!--width="30"-->

                                                    <!--alt="User avatar" />-->

                                                    <?php endif; ?>
                         Leaves</h5>
        <div class="card-body pb-0">
                 <div class="row mb-4">
                     
                   <!-- Refresh Button -->
                              
            <div class="col-sm-12 col-md-4 col-xl-4 d-flex">
               
              <div class="dataTables_length" id="DataTables_Table_3_length">
                  <label>
                                 <select name="months" class="form-select" id="months">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>


                </div>   <div class="dataTables_length" id="DataTables_Table_3_length">
                <select name="year" class="form-select" id="year">  </select>
            </div>
            </div>
            
                <div class="col-sm-12 col-md-4 d-flex justify-content-center" style="align-self:center;">
                      
                        <form>
                          <div class="input-group input-daterange" id="bs-datepicker-daterange">
                          <input type="date" id="dateRangePicker" placeholder="MM/DD/YYYY" class="form-control fromDate" name="from" value="<?php echo e(request()->get('from')); ?>" >
                          <span class="input-group-text">to</span>
                          <input type="date" placeholder="MM/DD/YYYY" class="form-control toDate" name="to" value="<?php echo e(request()->get('to')); ?>">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                      </div>
                        </form>
                    </div>
            <div class="col-sm-12 col-md-4 d-flex justify-content-center justify-content-md-end">
                
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                   <form method="GET" action="">    
                  <label>Search: <input value="<?php echo e($searchTerm); ?>" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
                 <a id="refreshButton" class="btn btn-warning mt-3 m-3 waves-effect waves-light">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
            </div>
          </div>
          <div id="result">
          <ul class="timeline mb-0">
              <?php if($Leave): ?>
              <?php $__currentLoopData = $Leave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myleave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                 <h6 class="mb-0"><?php echo e(date('d F Y', strtotime($myleave->start_date))); ?> - <?php echo e(date('d F Y', strtotime($myleave->end_date))); ?></h6>

                  <?php
                      if($myleave->status == 1){
                       $color = 'success';
                        $status = 'APPROVED';
                        }
                        elseif($myleave->status == 2){
                        $color = 'danger';
                        $status = 'UNAPPROVED';
                        }
                        elseif($myleave->status == 3){
                        $color = 'warning';
                         $status = 'PENDING';
                         }
                  ?>
                  
                  <button class="btn btn-<?php echo e($color); ?> waves-effect waves-light" style="
                            padding: 6px 5px;
                            margin-bottom: 9px;
                        "><?php echo e($status); ?></button>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-2">
                  <div class="d-flex align-items-center" style="user-select:none;pointer-events: none;">
                    <span id="mySpan"><?php echo $myleave->description; ?></span>
                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                    <span id="mySpan"><?php echo e($myleave->leave_type); ?></span>
                  </div>
                  <div>
<span class="text-muted"><?php echo e(date('d F Y h:i A', strtotime($myleave->created_at))); ?></span>
                  </div>
                </div>
                     
             <?php if($myleave && $myleave->reply): ?>   <div class="d-flex justify-content-between flex-wrap mb-2 ml-4" style="background-color:pink;height:100px;overflow:hidden;border-radius:10px;margin-left:20%;text-align:center">
                  <div class="d-flex align-items-center">
                        <?php
                $user_details = App\Models\User::find(1);
            ?>  

        <?php if($user_details->profile_img): ?>

      <span>  
      
      <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="<?php echo e($user_details->profile_img); ?>"
                            height="30"
                            width="30"
                            alt="User avatar" />
                                                    <?php else: ?>

                                                    <img class="rounded-circle"

                                                    style="margin-right: 15px;margin-top: 10px;" 

                                                    src="<?php echo e(url('public/images/21104.png')); ?>"

                                                    height="30"

                                                    width="30"

                                                    alt="User avatar" />

                                                    <?php endif; ?>
                       </span> <br/>
                    <span id="mySpan"><?php if($myleave && $myleave->reply): ?> <?php echo e($myleave->reply); ?><?php else: ?> -- <?php endif; ?>
</span>
                   
                  </div>
                </div>
                <?php endif; ?>
                <!--<div class="d-flex align-items-center">-->
                <!--  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">-->
                <!--  <span class="mb-0">bookingCard.pdf</span>-->
                <!--</div>-->
              </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          
          </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- /Timeline Basic -->
    </div>
    </div>
<!--Modal type leave-->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <form class="modal-content" action="<?php echo e(url('Employee/LeaveType/store')); ?>" method="post">
      <?php echo csrf_field(); ?>
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Leave Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="col mb-0">
            <label for="leave_type" class="form-label">Type <span class="text-danger">*</span></label>
            <input type="text" name="leave_type" class="form-control" placeholder="Enter Leave type"required>
          </div>
          <div class="col mb-0">
            <label for="no_of_leave" class="form-label">Number of Leave <span class="text-danger">*</span></label>
            <input type="number" name="no_of_leave" class="form-control"required>
          </div>
        </div>
        <div class="row mt-3">
            <label for="leave_type" class="form-label">Theme <span class="text-danger">*</span></label>
          <div class="col-md-6">
            <div class="form-check form-check-primary">
              <input class="form-check-input" required  type="radio" name="theme" value="primary" id="customCheckPrimary">
              <label class="form-check-label" for="customCheckPrimary"><span class="text-primary">Primary</span></label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-secondary">
              <input class="form-check-input" required  type="radio" name="theme" value="secondary" id="customCheckSecondary">
              <label class="form-check-label" for="customCheckSecondary"><span class="text-secondary">Secondary</span></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-success">
              <input class="form-check-input" required  type="radio" name="theme" value="success" id="customCheckSuccess">
              <label class="form-check-label" for="customCheckSuccess"><span class="text-success">Success</span></label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-danger">
              <input class="form-check-input" required  type="radio" name="theme" value="danger" id="customCheckDanger">
              <label class="form-check-label" for="customCheckDanger"><span class="text-danger">Danger</span></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-warning">
              <input class="form-check-input" required  type="radio" name="theme" value="warning" id="customCheckWarning">
              <label class="form-check-label" for="customCheckWarning"><span class="text-warning"> Warning</span> </label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-check form-check-info">
              <input class="form-check-input" required  type="radio" name="theme" value="info" id="customCheckInfo">
              <label class="form-check-label" for="customCheckInfo"><span class="text-info"> Info</span> </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-check form-check-dark">
              <input class="form-check-input" required  type="radio" name="theme" value="dark" id="customCheckDark">
              <label class="form-check-label" for="customCheckDark"><span class="text-dark"> Dark</span> </label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
      </div>
    </form>
  </div>
</div>
<!--Modal type leave End-->
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog"></div>
<input type="hidden" value="<?php echo e($id); ?>" name="emp_id" id="emp_id">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- JavaScript to refresh the page -->
<script>
    document.getElementById('refreshButton').addEventListener('click', function() {
        location.reload();
    });
</script>
 <script>
        $(document).ready(function() {
            $('#mySpan').addClass('non-interactive');
        });
    </script>

<script>
  
  
   let cardColor, headingColor, labelColor, borderColor, legendColor;

 
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  

  const chartColors = {
  column: {
    series1: '#826af9',
    series2: '#d2b0ff',
    bg: '#f8d3ff'
  },
  donut: {
    series1: '#fee802',
    series2: '#3fd0bd',
    series3: '#826bf8',
    series4: '#2b9bf4',
    series5: '#ff8c00' // New color for series5
  },
  area: {
    series1: '#29dac7',
    series2: '#60f2ca',
    series3: '#a5f8cd'
  }
};
  
  function editCategory(element) {
      var cate_id = $(element).attr('id');

      $.ajax({
          url: "<?php echo e(url('admin/LeaveType/edit')); ?>",
          method: 'GET',
          data: { id: cate_id },
          success: function (data) {
              if (data && typeof data == 'string') {
                  $('#showedit').html(data);
                  $('#showedit').modal('show');
              } else {
                  $('#showedit').html('<div>No Data Found</div>');
                  $('#showedit').modal('show');
              }
          },
          error: function () {
              $('#showedit .modal-content').html('<div>Error fetching data.</div>');
              $('#showedit').modal('show');
          }
      });
  }

    $(document).ready(function () {

        $(".delete_debtcase").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Delete'
                    },
                },
                callback: function (result) {
                    if (result) {
                        window.location.href = url;
                    }
                }
            });
        });
    });

    $(document).ready(function () {
        var currentYear = new Date().getFullYear();
        var startYear = 2015;
        var $selectYear = $('#year');
        var $selectMonth = $('#months');

        // Populate the select elements with options
        for (var year = currentYear; year >= startYear; year--) {
            $selectYear.append($('<option>', {
                value: year,
                text: year
            }));
        }

        // Handle the change event of the select elements
        $selectYear.on('change', fetchData);
        $selectMonth.on('change', fetchData);

        function fetchData() {
            var selectedYear = $selectYear.val();
            var selectedMonth = $selectMonth.val();
            var id = $('#emp_id').val();

            // Make an AJAX request to fetch data based on the selected year and month
            $.ajax({
                url: "<?php echo e(url('admin/Leave/Show_leaves_yeardata_single')); ?>",
                method: 'GET',
                data: { year: selectedYear,id: id, month: selectedMonth },
                success: function (data) {
                    // Handle the successful response
                    $('#result').empty(); // Clear previous content

                    if (data.length > 0) {
                        $('#result').html(data);
                    } else {
                        $('#result').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function () {
                    $('#result').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }
         // Donut Chart
  // --------------------------------------------------------------------

  const leaveTypePercentages = [<?php $__currentLoopData = $LeaveType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($leaveTypePercentages[$type->id]); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>];
const leaveTypeLabels = [<?php $__currentLoopData = $LeaveType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'<?php echo e($type->leave_type); ?>',<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>];

const totalPercentage = <?php echo e($totalPercentage); ?>;


  const donutChartEl = document.querySelector('#donutChart'),
    donutChartConfig = {
      chart: {
        height: 390,
        type: 'donut'
      },
       labels: leaveTypeLabels,
        series: leaveTypePercentages,
      colors: [
    chartColors.donut.series1,
    chartColors.donut.series5, // Include the new color for series5
    chartColors.donut.series4,
    chartColors.donut.series3,
    chartColors.donut.series2
  ],
      stroke: {
        show: false,
        curve: 'straight'
      },
      dataLabels: {
        enabled: true,
        formatter: function (val, opt) {
          return parseInt(val, 10) + '%';
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        markers: { offsetX: -3 },
        itemMargin: {
          vertical: 3,
          horizontal: 10
        },
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
    plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              name: {
                fontSize: '2rem',
                fontFamily: 'Public Sans'
              },
            value: {
    fontSize: '1.2rem',
    color: legendColor,
    fontFamily: 'Public Sans',
    formatter: function (val, opt) {
    return parseFloat(val).toFixed(2) + '%';
}

},
total: {
    show: true,
    fontSize: '1.5rem',
    color: headingColor,
    label: 'Total Leaves',
    formatter: function (w) {
        return parseFloat(totalPercentage).toFixed(2).replace(/\.?0*$/, '') + '%';
    }
}
            }
          }
        }
      },
      responsive: [
        {
          breakpoint: 992,
          options: {
            chart: {
              height: 380
            },
            legend: {
              position: 'bottom',
              labels: {
                colors: legendColor,
                useSeriesColors: false
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            chart: {
              height: 320
            },
            plotOptions: {
              pie: {
                donut: {
                  labels: {
                    show: true,
                    name: {
                      fontSize: '1.5rem'
                    },
                    value: {
                      fontSize: '1rem'
                    },
                    total: {
                      fontSize: '1.5rem'
                    }
                  }
                }
              }
            },
            legend: {
              position: 'bottom',
              labels: {
                colors: legendColor,
                useSeriesColors: false
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            chart: {
              height: 280
            },
            legend: {
              show: false
            }
          }
        },
        {
          breakpoint: 360,
          options: {
            chart: {
              height: 250
            },
            legend: {
              show: false
            }
          }
        }
      ]
    };
  if (typeof donutChartEl !== undefined && donutChartEl !== null) {
    const donutChart = new ApexCharts(donutChartEl, donutChartConfig);
    donutChart.render();
  }
    });

function LeaveStatusUpdate(status, empId, LeaveId, RoleID, ApproveID, AuthRole) {
    $.ajax({
        url: "<?php echo e(url('admin/Leave/LeaveStatusUpdate')); ?>",
        method: 'POST', // Assuming you want to send data with POST request
        data: {
            _token: '<?php echo e(csrf_token()); ?>', // Include the CSRF token
            status: status,
            statusnew: status,
            empId: empId,
            LeaveId: LeaveId,
            RoleID: RoleID,
            ApproveID: ApproveID,
            AuthRole: AuthRole,
        },
        success: function (response) {
            if (response.success == true) {
                $('#ResMsg').show().html(response.message);
                
                   setTimeout(function() {
        window.location.reload();
    }, 400);
                // Hide #ResMsg after 3 seconds
                setTimeout(function () {
                    $('#ResMsg').hide(500);
                }, 600);
                
            }
        },
        error: function () {
            alert("Oops! Some technical error occurred.");
        }
    });
}



const allLeaves = <?php echo json_encode($allLeaves); ?>;

// Initialize leave counts for each weekday
const leaveCounts = {
    'Mon': 0,
    'Tue': 0,
    'Wed': 0,
    'Thurs': 0,
    'Fri': 0,
    'Sat': 0,
    'Sun': 0
};

// Get the current day of the week
const today = new Date().toLocaleDateString('en-US', { weekday: 'long' }).substr(0, 3);
allLeaves.forEach(leave => {
    // Get the start and end dates of the leave
    const startDate = new Date(leave.start_date);
    const endDate = new Date(leave.end_date);

    // If start and end dates are the same, increment count for that day
    if (startDate.getTime() === endDate.getTime()) {
        const dayOfWeek = startDate.toLocaleDateString('en-US', { weekday: 'long' }).substr(0, 3);
        leaveCounts[dayOfWeek]++;
    } else {
        // Loop through each day between the start and end dates
        for (let currentDate = new Date(startDate); currentDate <= endDate; currentDate.setDate(currentDate.getDate() + 1)) {
            // Get the day of the week for the current date
            const dayOfWeek = currentDate.toLocaleDateString('en-US', { weekday: 'long' }).substr(0, 3); // Use abbreviated form (Mon, Tue, etc.)

            // Increment the count for the corresponding weekday
            leaveCounts[dayOfWeek]++;
        }
    }
});

// Extract the leave counts and populate the series data for the chart
const leaveCountsData = Object.values(leaveCounts);

// Define the ApexCharts configuration
const reportBarChartConfig = {
    chart: {
        height: 200,
        type: 'bar',
        toolbar: {
            show: false
        }
    },
    plotOptions: {
        bar: {
            barHeight: '60%',
            columnWidth: '60%',
            startingShape: 'rounded',
            endingShape: 'rounded',
            borderRadius: 4,
            distributed: true
        }
    },
    grid: {
        show: false,
        padding: {
            top: -20,
            bottom: 0,
            left: -10,
            right: -10
        }
    },
     colors: [
        today === 'Mon' ? config.colors.primary : config.colors_label.primary,
        today === 'Tue' ? config.colors.primary : config.colors_label.primary,
        today === 'Wed' ? config.colors.primary : config.colors_label.primary,
        today === 'Thurs' ? config.colors.primary : config.colors_label.primary,
        today === 'Fri' ? config.colors.primary : config.colors_label.primary,
        today === 'Sat' ? config.colors.primary : config.colors_label.primary,
        today === 'Sun' ? config.colors.primary : config.colors_label.primary
    ],
    dataLabels: {
        enabled: false
    },
    series: [  // Corrected property name
        {
            name: 'No. of Leaves', // Changed series name
            data: leaveCountsData // Use the extracted leave counts data here
        }
    ],
    legend: {
        show: false
    },
    xaxis: {
        categories: ['Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun'], // Use abbreviated form for weekdays
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        labels: {
            style: {
                colors: labelColor,
                fontSize: '13px'
            }
        }
    },
    yaxis: {
        labels: {
            show: false
        }
    }
};

// Render the chart
const reportBarChartEl = document.querySelector('#reportBarChart');
if (typeof reportBarChartEl !== 'undefined' && reportBarChartEl !== null) {
    const barChart = new ApexCharts(reportBarChartEl, reportBarChartConfig);
    barChart.render();
}

</script>
<script>
    // Get the current month
    const currentMonth = new Date().getMonth() + 1; // JavaScript months are zero-based, so add 1 to get the correct month number

    // Set the default selected option based on the current month
    document.getElementById('months').value = currentMonth.toString().padStart(2, '0'); // Ensure two-digit format (e.g., '05' for May)
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Humanesources/Leave/view.blade.php ENDPATH**/ ?>