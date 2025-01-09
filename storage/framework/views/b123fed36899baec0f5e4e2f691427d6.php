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
   <div class="flx_bx d-flex" style="align-items:center;justify-content:space-between;">
      <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leave /</span> Home</h4>
      <!--<a href="<?php echo e(url('admin/Leave/home2')); ?>"  target="_blank" class="btn btn-label-primary me-3">New Page-->
      <!--                            </a>-->
   </div>
   <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
   <?php endif; ?>
   <div class="alert alert-success" role="alert" id="ResMsg" style="display:none;"></div>
   <div class="row g-4 mb-4 d-flex" style="justify-content:center;">
      <div class="col-sm-3 col-xl-3">
         <a href="<?php echo e(url('admin/Leave/home?status=0')); ?>">
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
         </a>
      </div>
      <div class="col-sm-3 col-xl-3">
         <a href="<?php echo e(url('admin/Leave/home?status=1')); ?>">
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
                        <span class="avatar-initial rounded bg-label-success">
                        <i class="ti ti-user-check ti-sm"></i>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-3 col-xl-3">
         <a href="<?php echo e(url('admin/Leave/home?status=2')); ?>">
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
                        <span class="avatar-initial rounded bg-label-danger">
                        <i class="ti ti-user-plus ti-sm"></i>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-3 col-xl-3">
         <a href="<?php echo e(url('admin/Leave/home?status=3')); ?>">
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
         </a>
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
      <div class="col-xl-6 col-12 mb-4">
         <div class="card" style="height:500px">
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
      <div class="col-xl-6 col-md-12 mb-4">
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
   <!--dynamic leave type data-->
   <!--     <div class="card">-->
   <!--<div class="row">-->
   <!--  <div class="col-md-6 ">-->
   <!--      <h5 class="card-header">Leave Type</h5>-->
   <!--  </div>-->
   <!--  <div class="col-md-6 text-end">-->
   <!--      <button class="btn btn-primary waves-effect waves-light mt-3 m-3" data-bs-toggle="modal" data-bs-target="#backDropModal">Add Type</button>-->
   <!--      <a href="<?php echo e(url('admin/Leave/home2')); ?>"  target="_blank" class="btn btn-label-primary me-3">-->
   <!--            <span class="align-middle"> New Leave Page</span>-->
   <!--          </a>-->
   <!--  </div>-->
   <!--</div>-->
   <!--  <div class="card-body">-->
   <!--    <?php if(count($LeaveType) > 0): ?>-->
   <!--      <div class="row g-4 mb-4">-->
   <!--        <?php $__currentLoopData = $LeaveType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $Lea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
   <!--        <div class="col-sm-6 col-xl-3">-->
   <!--          <div class="card bg-<?php echo e($Lea->theme); ?> text-white">-->
   <!--          <div class="text-end p-1">-->
   <!--            <a id="<?php echo e($Lea->id); ?>" onclick="editCategory(this)" style="cursor: pointer;"><i class="ti ti-edit ti-sm"></i></a>-->
   <!--            <a class="delete_debtcase" url="<?php echo e(url('admin/LeaveType/delete/'.$Lea->id)); ?>" id="<?php echo e($Lea->id); ?>" style="cursor: pointer;"><i class="ti ti-trash ti-sm"></i></a>-->
   <!--          </div>-->
   <!--            <div class="card-body">-->
   <!--              <div class="d-flex align-items-start justify-content-between">-->
   <!--                  <h4 class="text-white"><?php echo e($Lea->leave_type); ?></h4>-->
   <!--                  <p class="text-white mt-3"><?php echo e($Lea->no_of_leave); ?></p>-->
   <!--              </div>-->
   <!--            </div>-->
   <!--          </div>-->
   <!--        </div>         -->
   <!--        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
   <!--      </div>-->
   <!--          <?php else: ?>-->
   <!--          <div class="text-center" style="border-bottom: 1px solid #dbdade;border-top: 1px solid #dbdade;">-->
   <!--            <p class="p-2" >No Data Found</p>-->
   <!--          </div>-->
   <!--          <?php endif; ?>-->
   <!--  </div>-->
   <!--</div>-->
   <!--dynamic leave type data end -->
   <div class="card mt-2">
      <div class="row">
         <div class="col-md-6">
            <h5 class="card-header">Leave's List</h5>
         </div>
         <div class="col-md-6 text-end">
            <a href="<?php echo e(url('admin/Leave/home')); ?>" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
            <a href="<?php echo e(url('admin/Leave/add')); ?>" class="btn btn-primary mt-3 m-3">Add Leave</a>
         </div>
      </div>
      <div class="card-datatable table-responsive">
         <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
            <div class="row">
               <div class="col-sm-12 col-md-4">
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
               </div>
            </div>
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
               <thead>
                  <tr>
                     <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                     <th>ID</th>
                     <th>Employee</th>
                     <th>Leave Date</th>
                     <th>Duration</th>
                     <th>Leave Status</th>
                     <th>Leave Type</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody id="result">
                  <?php if(count($Leave) > 0): ?>
                  <?php $__currentLoopData = $Leave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                  $jobrole = App\Models\Jobroles::find($user->jobrole_id);
                  ?>
                  <tr class="odd">
                     <td><?php echo e($key+1); ?> </td>
                     <td>
                        <div class="parent d-flex">
                           <div class="child1">
                              <?php if($user->profile_img): ?>
                              <img 
                                 class="rounded-circle"
                                 style="margin-right: 15px; margin-top: 10px;" 
                                 src="<?php echo e($user->profile_img); ?>"
                                 height="30"
                                 width="30"
                                 alt="User avatar" />
                              <?php else: ?>
                              <img 
                                 class="rounded-circle"
                                 style="margin-right: 15px; margin-top: 10px;" 
                                 src="<?php echo e(url('public/images/21104.png')); ?>"
                                 height="30"
                                 width="30"
                                 alt="User avatar" />
                              <?php endif; ?>
                           </div>
                           <div class="child2">
                              <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                              <div style="font-size: 12px;">
                                 <?php echo e($jobrole ? $jobrole->name : 'No Job Role'); ?>

                              </div>
                           </div>
                        </div>
                     </td>
                     <td><?php if($user && $user->date): ?> <?php echo e($user->date); ?> <?php else: ?> <?php echo e($user->start_date); ?> <?php endif; ?> </td>
                     <td>
                        <?php if($user->duration == 1): ?>
                        <?php echo e('Full Day'); ?>

                        <?php elseif($user->duration == 2): ?>
                        <?php echo e('Multiple'); ?>

                        <?php elseif($user->duration == 3): ?>
                        <?php echo e('First Half'); ?>

                        <?php elseif($user->duration == 4): ?>
                        <?php echo e('Second Half'); ?>

                        <?php endif; ?>
                     </td>
                     <td>
                        <?php if($user && ($user->status == 3)): ?>
                        <select name="Status" class="form-select" onchange="LeaveStatusUpdate(this.value,<?php echo e($user->user_id); ?>,<?php echo e($user->id); ?>,<?php echo e($user->RoleID); ?>,<?php echo e(Auth::user()->id); ?>,<?php echo e($AuthRoles); ?>)">
                          <option <?php if($user && $user->status == 1): ?> selected <?php endif; ?> value="1">APPROVED</option>
                          <option <?php if($user && $user->status == 2): ?> selected <?php endif; ?> value="2">UNAPPROVED</option>
                          <option <?php if($user && $user->status == 3): ?> selected <?php endif; ?> value="3">PENDING</option>
                        </select> 
                        <?php else: ?>
                        <?php switch($user->status):
                        case ('2'): ?>
                        <span class="badge bg-label-danger">UNAPPROVED</span>
                        <?php break; ?>
                        <?php case ('1'): ?>
                        <span class="badge bg-label-success">APPROVED</span>
                        <?php break; ?>
                        <?php default: ?>
                        <span class="badge bg-label-warning">Pending</span>
                        <?php endswitch; ?>
                        <?php endif; ?>
                     </td>
                     <td><?php echo e($user->leave_type); ?></td>
                     <td>
                        <div class="btn-group">
                           <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="ti ti-dots-vertical"></i>
                           </button>
                           <ul class="dropdown-menu dropdown-menu-end" style="">
                              <li><a class="dropdown-item" href="<?php echo e(url('admin/Leave/edit/'.$user->id)); ?>">Edit</a></li>
                              <li><a class="dropdown-item" href="<?php echo e(url('admin/Leave/view/'.$user->id)); ?>">View</a></li>
                              <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('admin/Leave/delete/'.$user->id)); ?>" id="<?php echo e($user->id); ?>">Delete</button></li>
                           </ul>
                        </div>
                     </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                  <tr>
                     <td class="text-center" colspan="9">No Data Found</td>
                  </tr>
                  <?php endif; ?>
               </tbody>
            </table>
            <div class="p-1" style="float: right;">
               <?php echo e($Leave->links()); ?>

            </div>
         </div>
      </div>
   </div>
   <div class="row mt-5">
      <div class="col-md-6">
         <div class="card">
            <div  class="card-header">
               <h5>Working From Home</h5>
            </div>
            <div  class="card-body">
               <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                  <thead>
                     <tr>
                        <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                        <th>ID</th>
                        <th>Employee</th>
                        <th>Leave Date</th>
                        <th>Duration</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if(count($workfromhome) > 0): ?>
                     <?php $__currentLoopData = $workfromhome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr class="odd">
                        <td><?php echo e($key+1); ?> </td>
                        <td>
                           <?php if($user->profile_img): ?>
                           <img 
                              class="rounded-circle"
                              style="margin-right: 15px;margin-top: 10px;" 
                              src="<?php echo e($user->profile_img); ?>"
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
                           <?php echo e($user->first_name); ?>

                           <div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($user->email); ?></div>
                           <!--<img -->
                           <!--        class="rounded-circle"-->
                           <!--        style="margin-right: 15px;margin-top: 10px;" -->
                           <!--        src="<?php echo e($user->profile_img); ?>"-->
                           <!--        height="30"-->
                           <!--        width="30"-->
                           <!--        alt="User avatar" /><?php echo e($user->first_name); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($user->email); ?></div>-->
                        </td>
                        <td><?php if($user && $user->date): ?> <?php echo e($user->date); ?> <?php else: ?> <?php echo e($user->start_date); ?> <?php endif; ?> </td>
                        <td>
                           <?php if($user->duration == 1): ?>
                           <?php echo e('Full Day'); ?>

                           <?php elseif($user->duration == 2): ?>
                           <?php echo e('Multiple'); ?>

                           <?php elseif($user->duration == 3): ?>
                           <?php echo e('First Half'); ?>

                           <?php elseif($user->duration == 4): ?>
                           <?php echo e('Second Half'); ?>

                           <?php endif; ?>
                        </td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php else: ?>
                     <tr>
                        <td class="text-center" colspan="9">No Data Found</td>
                     </tr>
                     <?php endif; ?>
                  </tbody>
               </table>
            </div>
            <div  class="card-footer p-1" style="float: right;">
               <?php echo e($workfromhome->links()); ?>

            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="card">
            <div  class="card-header">
               <h5>Leaves on Today</h5>
            </div>
            <div  class="card-body">
               <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                  <thead>
                     <tr>
                        <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                        <th>ID</th>
                        <th>Employee</th>
                        <th>Leave Date</th>
                        <th>Duration</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if(count($todayonleave) > 0): ?>
                     <?php $__currentLoopData = $todayonleave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr class="odd">
                        <td><?php echo e($key+1); ?> </td>
                        <td>
                           <?php if($user->profile_img): ?>
                           <img 
                              class="rounded-circle"
                              style="margin-right: 15px;margin-top: 10px;" 
                              src="<?php echo e($user->profile_img); ?>"
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
                           <?php echo e($user->first_name); ?>

                           <div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($user->email); ?></div>
                           <!--<img -->
                           <!--        class="rounded-circle"-->
                           <!--        style="margin-right: 15px;margin-top: 10px;" -->
                           <!--        src="<?php echo e($user->profile_img); ?>"-->
                           <!--        height="30"-->
                           <!--        width="30"-->
                           <!--        alt="User avatar" /><?php echo e($user->first_name); ?><div style="font-size:12px;margin-left: 46px;margin-top: -11px;"><?php echo e($user->email); ?></div>-->
                        </td>
                        <td><?php if($user && $user->date): ?> <?php echo e($user->date); ?> <?php else: ?> <?php echo e($user->start_date); ?> <?php endif; ?> </td>
                        <td>
                           <?php if($user->duration == 1): ?>
                           <?php echo e('Full Day'); ?>

                           <?php elseif($user->duration == 2): ?>
                           <?php echo e('Multiple'); ?>

                           <?php elseif($user->duration == 3): ?>
                           <?php echo e('First Half'); ?>

                           <?php elseif($user->duration == 4): ?>
                           <?php echo e('Second Half'); ?>

                           <?php endif; ?>
                        </td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php else: ?>
                     <tr>
                        <td class="text-center" colspan="9">No Data Found</td>
                     </tr>
                     <?php endif; ?>
                  </tbody>
               </table>
               <?php echo e($todayonleave->links()); ?>

            </div>
         </div>
      </div>
   </div>
</div>
<!--Modal type leave-->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
   <div class="modal-dialog">
      <form class="modal-content" action="<?php echo e(url('admin/LeaveType/store')); ?>" method="post">
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
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
   
             // Make an AJAX request to fetch data based on the selected year and month
             $.ajax({
                 url: "<?php echo e(url('admin/Leave/Show_leaves_yeardata')); ?>",
                 method: 'GET',
                 data: { year: selectedYear, month: selectedMonth },
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
           return parseFloat(val, 10).toFixed(2).replace(/\.?0*$/, '') + '%';
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
   
   
   
   const allLeaves = <?php echo json_encode($allLeaves); ?>;
   
   // Initialize leave counts for each weekday
   const leaveCounts = {
     'Mon': 0,
     'Tue': 0,
     'Wed': 0,
     'Thu': 0, // Corrected from 'Thurs' to 'Thu' to match weekday abbreviation
     'Fri': 0,
     'Sat': 0,
     'Sun': 0
   };
   
   // Get the current day of the week
   const today = new Date().toLocaleDateString('en-US', { weekday: 'short' }); // Use 'short' for 'Mon', 'Tue', etc.
   
   allLeaves.forEach(leave => {
     // Get the start and end dates of the leave
     const startDate = new Date(leave.start_date);
     const endDate = new Date(leave.end_date);
   
     // If start and end dates are the same, increment count for that day
     if (startDate.getTime() === endDate.getTime()) {
         const dayOfWeek = startDate.toLocaleDateString('en-US', { weekday: 'short' });
         leaveCounts[dayOfWeek]++;
     } else {
         // Loop through each day between the start and end dates
         for (let currentDate = new Date(startDate); currentDate <= endDate; currentDate.setDate(currentDate.getDate() + 1)) {
             // Get the day of the week for the current date
             const dayOfWeek = currentDate.toLocaleDateString('en-US', { weekday: 'short' });
   
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
         today === 'Thu' ? config.colors.primary : config.colors_label.primary, // Corrected from 'Thurs' to 'Thu'
         today === 'Fri' ? config.colors.primary : config.colors_label.primary,
         today === 'Sat' ? config.colors.primary : config.colors_label.primary,
         today === 'Sun' ? config.colors.primary : config.colors_label.primary
     ],
     dataLabels: {
         enabled: false
     },
     series: [
         {
             name: 'No. of Leaves',
             data: leaveCountsData
         }
     ],
     legend: {
         show: false
     },
     xaxis: {
         categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'], // Corrected from 'Thurs' to 'Thu'
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
   if (reportBarChartEl) {
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Humanesources/Leave/home.blade.php ENDPATH**/ ?>