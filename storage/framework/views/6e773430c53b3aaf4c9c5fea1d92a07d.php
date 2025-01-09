
<div class="row g-4 mb-4 OverviewScreen">
   <?php if($moduleSetting->clients == 1): ?>
    <div class="col-sm-6 col-xl-3">
      <a class="text-dark" href="<?php echo e(url('admin/Client/home')); ?>">
         <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Total Clients</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0">0</p> -->
              </div>
              <p class="mb-0"><?php echo e($TClient); ?></p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-solid fa-users mt-3"></i>
              </span>
            </div>
          </div>
        </div>
         </div>
      </a>
    </div>
    <?php endif; ?>
    <?php if($moduleSetting->employees == 1): ?>

    
    
    <div class="col-sm-6 col-xl-3">
         <a class="text-dark" href="<?php echo e(url('admin/Employee/home')); ?>">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                    <span>Total Employees</span>
                    <div class="d-flex align-items-center my-2">
                      <h3 class="mb-0 me-2"></h3>
                      <!-- <p class="text-success mb-0"></p> -->
                    </div>
                    <p class="mb-0"><?php echo e($TOEMP); ?></p>
                  </div>
                  <div class="">
                    <span class="">
                      <i class="fa-solid fa-user mt-3"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
         </a>
    </div>
    
   
    <?php endif; ?>
    <?php if($moduleSetting->projects == 1): ?>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span>Total Projects</span>
                <div class="d-flex align-items-center my-2">
                  <h3 class="mb-0 me-2"></h3>
                  <!-- <p class="text-danger mb-0"></p> -->
                </div>
                <p class="mb-0"><?php echo e($TProJect); ?></p>
              </div>
              <div class="">
                <span class="">
                 <i class="fa-solid fa-layer-group mt-3"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if($moduleSetting->invoices == 1): ?>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Due Invoices</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0"><?php echo e($DueInvoices); ?></p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-solid fa-file-invoice mt-3"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Hours Logged</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0"><?php echo e($totalTimeFormatted); ?></p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-regular fa-clock mt-3"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if($moduleSetting->invoices == 1): ?>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Pending Tasks</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0"><?php echo e($PendingTasksC); ?></p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-solid fa-list-check mt-3"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php if($moduleSetting->attendance == 1): ?>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Today Attendance</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0"><?php echo e($attendanceCount); ?></p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-solid fa-calendar mt-3"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
       <?php if($moduleSetting->tickets == 1): ?>

    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Unresolved Tickets</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2"></h3>
                <!-- <p class="text-success mb-0"></p> -->
              </div>
              <p class="mb-0"><?php echo e($countOpenTkt); ?></p>
            </div>
            <div class="">
              <span class="">
                <i class="fa-solid fa-ticket mt-3"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <div class="row g-4 mb-4 OverviewScreen">

    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
            <div class="card-header">
               <div class="content-left">
                 <strong>Timesheet</strong>&nbsp;&nbsp;<span></span>
               </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                   <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                  
                  
                  
                                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                <th>ID</th>
                                <th>Shift Name</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Shift Assigned</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        <?php if(count($TimeSheet) > 0): ?>
                            <?php $__currentLoopData = $TimeSheet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $users = \App\Models\User::select('users.first_name', 'users.profile_img')
                                ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
                                ->where('employee_details.shift_id', $user->id)
                                ->get();
                            ?>
                            <tr class="odd">
                                <td><?php echo e($key+1); ?> </td>
                                <td><?php echo e($user->shift_name); ?></td>
                                <td><?php echo e($user->StartTime); ?></td>
                                <td><?php echo e($user->EndTime); ?></td>
                                <td>
                                    <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-1">
                                      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $useraa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="<?php echo e($useraa->first_name); ?>">
                                        <img class="rounded-circle" src="<?php echo e($useraa->profile_img); ?>" alt="Avatar">
                                      </li>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td class="text-center" colspan="7">No Data Found</td>
                            </tr>
                        <?php endif; ?>
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6" style="300px">

      <div class="card bg-white border-0 b-shadow-4 mb-3 table-height" style="100%">

        <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-3">

          <strong class="f-18 f-w-500 mb-0">Recent Follow Up</strong>

          <a href="<?php echo e(url('admin/Leads/recent_follow_ups')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>

          <!-- <a href="<?php echo e(url('admin/TimeShift/home')); ?>" type="button" class="btn-primary rounded f-14 p-2 btn-sm" id="view-shifts">Employee Shift</a> -->

          <input type="search" class="autocomplete-password" style="opacity: 0;position: absolute;" autocomplete="off">

          <input type="password" class="autocomplete-password" style="opacity: 0;position: absolute;"

            autocomplete="off">

          <input type="email" name="f_email" class="autocomplete-password" readonly=""

            style="opacity: 0;position: absolute;" autocomplete="off">

          <input type="text" name="f_slack_username" class="autocomplete-password" readonly=""

            style="opacity: 0;position: absolute;" autocomplete="off">

        </div>

        <div class="card-body table-responsive mb-2" style="overflow-x:auto;">

          <table class="table" id="example">

            <thead>

               <tr>
                      <!-- <th>EmpId</th> -->
                      <th>Client</th>
                      <th>Mobile</th>
                      <th>Requirement</th>
                      <th>Date</th>
                      <th>TIME</th>
                  </tr>

            </thead>

              <tbody class="table-border-bottom-0">
                  <?php $__currentLoopData = $RecentFollowUp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <!-- <td><?php echo e($key+1); ?></td> -->
                        <td>
                            <?php if($lst && $lst->leads_client_first_name): ?> 
                                <?php echo e($lst->leads_client_first_name); ?> 
                                <?php echo e($lst->leads_client_last_name); ?> 
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($lst && $lst->phone_number): ?> 
                                <?php echo e($lst->phone_number); ?> 
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($lst && $lst->requirement): ?> 
                                <?php echo $lst->requirement; ?> 
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($lst && $lst->follow_up_next): ?> 
                                <?php echo e($lst->follow_up_next); ?> 
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($lst && $lst->start_time): ?> 
                                <?php echo e($lst->start_time); ?> 
                            <?php endif; ?>
                        </td>
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>


          </table>

        </div>

      </div>

    </div>
    
       <?php if($moduleSetting->leaves == 1): ?>

    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
         <div class="card-header">
               <div class="content-left">
                 <strong>Pending Leaves</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>
         <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
             <thead>
                  <tr>
                      <!-- <th>EmpId</th> -->
                      <th>Name of Emp</th>
                      <th>Leave Start date</th>
                      <th>Leave End date</th>
                      <!-- <th>Leave type</th> -->
                      <th>Paid</th>
                  </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  <?php $__currentLoopData = $PendingLeaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <!-- <td><?php echo e($key+1); ?></td> -->
                          <td style="display: flex;">
                              <?php if($lst && $lst->profile_img): ?>
                                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($lst->profile_img) ? $lst->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />  
                              <?php endif; ?>
                              &nbsp;&nbsp; 
                            <a href="<?php echo e(url('admin/Client/view/' . $lst->id)); ?>"> <div> 
                                <?php if($lst && $lst->first_name): ?> 
                                    <?php echo e($lst->first_name); ?> <?php echo e($lst->last_name); ?> (#<?php echo e($lst->id); ?>)
                                <?php endif; ?> 
                                <?php if($lst->desname): ?>
                                    <br/>
                                    <?php echo e($lst->desname); ?>

                                <?php endif; ?> 
                            </div>
                            </a>
                          </td>
                          <td>
                              <?php if($lst && $lst->start_date): ?> 
                                <?php echo e($lst->start_date); ?> 
                              <?php endif; ?>
                          </td>
                          <td>
                              <?php if($lst && $lst->end_date): ?> 
                                <?php echo e($lst->end_date); ?>

                              <?php endif; ?>
                          </td>
                          <!-- <td><?php if($lst && $lst->leave_type): ?> <?php echo e($lst->leave_type); ?> <?php endif; ?></td> -->
                          <td><span class="badge bg-label-primary me-1">Not Paid</span></td>
                          <!-- Your other table cell content here -->
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>

            </table>
              </div>
            
         </div>
      </div>
    </div>
    <?php endif; ?>
           <?php if($moduleSetting->tickets == 1): ?>

    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
        <div class="card-header">
               <div class="content-left">
                 <strong>Open Tickets</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>

         <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                   <thead>
                      <tr>
                        <th>Ticket Id</th>
                        <th>Subject</th>
                        <th>Assign to</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                      <tbody class="table-border-bottom-0">
                  <?php $__currentLoopData = $OpenTicket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                    <td> <a href="<?php echo e(url('admin/Ticket/home')); ?>" type="button"># <?php echo e($lst->id); ?></a></td>
                     <td><?php if($lst && $lst->subject): ?> <?php echo e($lst->subject); ?> <?php endif; ?></td>
                          <!-- <td><?php if($lst && $lst->ccid): ?> <?php echo e($lst->ccid); ?> <?php endif; ?></td> -->
                            <td>
                               
                               <?php if($lst && $lst->emp_id): ?> 
                              <div class="parent d-flex">
                                            <div class="child1">
                                                 <?php if($lst->profile_img): ?>
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e($lst->profile_img); ?>" height="30" width="30" alt="User avatar" />
                                                    <?php else: ?>
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />
                                                    <?php endif; ?>
                                            </div>
                                            <div class="child2">
                                                  <?php echo e($lst->first_name); ?> <?php echo e($lst->last_name); ?> | <?php echo e($lst->emp_id); ?> <br> <span style="color:#6e6c76;font-size:85%">(<?php echo e($lst->job_role_name); ?>)</span>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        --
                                       <?php endif; ?>
                           
                           </td>
                          <td>
                            <?php if($lst && $lst->status == 1): ?> 
                                <span class="badge bg-label-success me-1">
                                    Open
                              </span>
                              <?php else: ?>
                               <span class="badge bg-label-success me-1">
                                    Open
                              </span>
                           <?php endif; ?>
                            </td>
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>

                  </table>
              </div>
            
         </div>
      </div>
    </div>
        <?php endif; ?>
           <?php if($moduleSetting->tasks == 1): ?>

    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
         <div class="card-header">
               <div class="content-left">
                 <strong>Pending Tasks</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>
         <div class="card-body">
                <div class="table-responsive text-nowrap">
                   <table class="table border-top">
                        <thead>
                          <tr>
                            <th>Project Name</th>
                            <th>Leader</th>
                            <th>Team</th>
                            <th class="w-px-200">Status</th>
                            <th>Deadline</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php if(count($PendingTasks) > 0): ?>
                        <?php $__currentLoopData = $PendingTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $Inventor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd">
                            <td><?php if($Inventor && $Inventor->project_name): ?> <?php echo e($Inventor->project_name); ?> <?php endif; ?></td>
                            <td><div class="avatar me-2"><img data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-dark" data-bs-original-title="<?php if($Inventor && $Inventor->project_manager_name): ?> <?php echo e($Inventor->project_manager_name); ?> <?php endif; ?>" <?php if($Inventor && $Inventor->project_manager_picture): ?> src="<?php echo e($Inventor->project_manager_picture); ?>" <?php endif; ?>  alt="Avatar" class="rounded-circle" ></div></td>
                            <td>
                              <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                                 <?php $teamlead =  \App\Models\User::whereIn('id', explode(',',$Inventor->team_id))->where('type',4)->get() ?>
                                <?php $__currentLoopData = $teamlead; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teaml): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="<?php echo e($teaml->first_name); ?>">
                                  <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($teaml->profile_img) ? $teaml->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />
                                </li>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                            </td>
                            <td>
                              <div class="progress"><?php switch($Inventor->status_id):
                                    case ('1'): ?>
                                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width:<?php echo e($Inventor->status_pro); ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo e($Inventor->status_pro); ?>%</div>
                                        <?php break; ?>
                                    <?php case ('2'): ?>
                                     <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width:<?php echo e($Inventor->status_pro); ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo e($Inventor->status_pro); ?>%</div>
                                        <?php break; ?>
                                    <?php case ('3'): ?>
                                    <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width:<?php echo e($Inventor->status_pro); ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo e($Inventor->status_pro); ?>%</div>
                                        <?php break; ?>
                                    <?php case ('4'): ?>
                                     <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width:<?php echo e($Inventor->status_pro); ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo e($Inventor->status_pro); ?>%</div>
                                        <?php break; ?>
                                    <?php default: ?>
                                          <span></span>
                                    <?php endswitch; ?>
                              </div>
                            </td>
                            <td><?php if($Inventor && $Inventor->deadline): ?> <?php echo e($Inventor->deadline); ?> <?php endif; ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                          <td class="text-center" colspan="8">No Data Found</td>
                        </tr>
                        <?php endif; ?> 
                            </tbody>
                  </table>
              </div>
         </div>
      </div>
    </div>
    
            <?php endif; ?>

    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
         <div class="card-header">
               <div class="content-left">
                 <strong>Follow Up</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>
         <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                   <thead class="">
                    <tr>
                      <th>Created</th>
                      <th>Next Follow Up</th>
                      <th>Remark</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(count($LeadsFollowup) > 0): ?>
                    <?php $__currentLoopData = $LeadsFollowup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Followup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($Followup->created_at); ?></td>
                        <td><?php echo e(date('d-m-Y',strtotime($Followup->follow_up_next))); ?></td>
                        <td><?php echo e($Followup->remark); ?></td>
                         <td>
                                <?php switch($Followup->status):
                                case ('0'): ?>
                                <span class="badge bg-label-primary">Upcoming</span>
                                <?php break; ?>
                                <?php case ('1'): ?>
                                <span class="badge bg-label-success">Completed</span>
                                <?php break; ?>
                                <?php case ('2'): ?>
                                <span class="badge bg-label-danger">Due</span>
                                <?php break; ?>
                                <?php default: ?>
                                <span></span>
                                <?php endswitch; ?>
                            </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr>
                        <td></td>
                        <td>No data found</td>
                        <td></td>
                    </tr>
                    <?php endif; ?>
                  </tbody>
                  </table>
              </div>
            
         </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-6" style="300px">
         <div class="card h-100" style="100%">
         <div class="card-header">
               <div class="content-left">
                 <strong>Project Activity Timeline</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>
         <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
              <?php if(count($ProActiTime) > 0): ?>
              <?php $__currentLoopData = $ProActiTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $Inventor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td><?php if($Inventor && $Inventor->project_name): ?> <?php echo e($Inventor->project_name); ?> <?php endif; ?></td>
             
                    <td>
                               
                               <?php if($Inventor && $Inventor->client_id): ?> 
                              <div class="parent d-flex">
                                            <div class="child1">
                                                 <?php if($Inventor->client_img): ?>
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e($Inventor->client_img); ?>" height="30" width="30" alt="User avatar" />
                                                    <?php else: ?>
                                                        <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />
                                                    <?php endif; ?>
                                            </div>
                                            <div class="child2">
                                                  <?php echo e($Inventor->client_name); ?> <?php echo e($Inventor->client_lst_name); ?> | <?php echo e($Inventor->client_id); ?> <br> <span style="color:#6e6c76;font-size:85%">(<?php echo e($Inventor->company_name); ?>)</span>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        --
                                       <?php endif; ?>
                           
                           </td>
                        <td >
                            <?php switch($Inventor->status_id):
                          case ('1'): ?>
                            <span class="badge bg-label-primary">In Progress</span>
                              <?php break; ?>
                          <?php case ('2'): ?>
                            <span class="badge bg-label-success">Completed</span>
                              <?php break; ?>
                          <?php case ('3'): ?>
                            <span class="badge bg-label-warning">Over Due</span>
                              <?php break; ?>
                          <?php case ('4'): ?>
                            <span class="badge bg-label-danger">Cancel</span>
                              <?php break; ?>
                          <?php default: ?>
                                <span></span>
                          <?php endswitch; ?>
                          </div>
                        </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
              </tr>
              <?php endif; ?> 
            </tbody>
                  </table>
              </div>
            
         </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-6" style="350px">
      <div class="card h-0" >
         <div class="card-header">
               <div class="content-left">
                 <strong>User Activity Timeline</strong>&nbsp;&nbsp;<span></span>
               </div>
         </div>
         <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>IP</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
              <?php if(count($UserActTime) > 0): ?>
              <?php $__currentLoopData = $UserActTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $Inventor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td style="display: flex;">
                      <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($Inventor->profile_img) ? $Inventor->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />
                      &nbsp;&nbsp;
                      <div>
                        <?php if($Inventor && $Inventor->first_name): ?> 
                          <?php echo e($Inventor->first_name); ?> 
                        <?php endif; ?> 
                        <br/> 
                          <?php if($Inventor && $Inventor->id): ?>
                          <?php 
                          $post = DB::table('jobroles')->whereRaw("FIND_IN_SET('assign_emp_id',$Inventor->id)")->value('name');
                          ?> 
                              <?php echo e($post); ?> 
                          <?php endif; ?>
                        
                      </div>
                      
                      </td>
                  
                        <td >    <?php if($Inventor && $Inventor->subject): ?> 
                              <?php echo e($Inventor->subject); ?> 
                          <?php endif; ?>                </td>
                        <td >    <?php if($Inventor && $Inventor->ip): ?> 
                              <?php echo e($Inventor->ip); ?> 
                          <?php endif; ?>                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
              </tr>
              <?php endif; ?> 
            </tbody>
                  </table>
              </div>
         </div>
      </div>
    </div>
  </div>
</div><?php /**PATH /home/insighthub/public_html/resources/views/admin/dashboard/Overview.blade.php ENDPATH**/ ?>