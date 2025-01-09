<div class="card">
  

<div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Timer</th>
                <th>Task</th>
                <th>Completed On</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Hours Logged</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(count($Task) > 0): ?>
              <?php $__currentLoopData = $Task; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $Inventor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td><?php echo e($key+1); ?> </td>
                  <td id="strtTimer"></td>
                  <td><?php if($Inventor && $Inventor->task_name): ?> <?php echo e($Inventor->task_name); ?> <?php endif; ?></td>
                <td>
                    <?php if($Inventor && $Inventor->completed_on): ?>
                        <?php echo e(\Carbon\Carbon::parse($Inventor->completed_on)->isToday() ? 'Today' : (\Carbon\Carbon::parse($Inventor->completed_on)->isYesterday() ? 'Yesterday' : $Inventor->completed_on)); ?>

                    <?php else: ?>
                        --
                    <?php endif; ?>
                </td>
                  <td><?php if($Inventor && $Inventor->startDate): ?> <?php echo e($Inventor->startDate); ?> <?php endif; ?></td>
                  <td><?php if($Inventor && $Inventor->endDate): ?> <?php echo e($Inventor->endDate); ?> <?php endif; ?></td>
                  <td>0s</td>
                 <!--  <td >
                    <div class="progchange<?php echo e($Inventor->id); ?>">
                    </div>
                    <div class="hide<?php echo e($Inventor->id); ?>">
                      
                   
                    <div class="progress cursor-pointer" onclick="changepro(this)" id="<?php echo e($Inventor->id); ?>"><?php switch($Inventor->status_id):
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
                    </div>
                  </td> -->
                  <!-- <td><div class="avatar me-2"><img data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-dark" data-bs-original-title="<?php if($Inventor && $Inventor->project_manager_name): ?> <?php echo e($Inventor->project_manager_name); ?> <?php endif; ?>" <?php if($Inventor && $Inventor->project_manager_picture): ?> src="<?php echo e($Inventor->project_manager_picture); ?>" <?php endif; ?>  alt="Avatar" class="rounded-circle" ></div></td> -->
                  <td>
                    <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                      
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="<?php echo e($Inventor->project_manager_name); ?>">
                          <img class="rounded-circle" src="<?php echo e($Inventor->project_manager_picture); ?>" alt="Avatar">
                        </li>
                    </ul>
                  </td>
                          <td >
                            <div class="statuschange<?php echo e($Inventor->id); ?>"></div>
                            <div class="statushide<?php echo e($Inventor->id); ?>">
                            <?php switch($Inventor->status_id):
                          case ('1'): ?>
                            <span onclick="changestatus(this)" id="<?php echo e($Inventor->id); ?>" class="badge bg-label-primary">In Progress</span>
                              <?php break; ?>
                          <?php case ('2'): ?>
                            <span onclick="changestatus(this)" id="<?php echo e($Inventor->id); ?>" class="badge bg-label-success">Completed</span>
                              <?php break; ?>
                          <?php case ('3'): ?>
                            <span onclick="changestatus(this)" id="<?php echo e($Inventor->id); ?>" class="badge bg-label-warning">Over Due</span>
                              <?php break; ?>
                          <?php case ('4'): ?>
                            <span onclick="changestatus(this)" id="<?php echo e($Inventor->id); ?>" class="badge bg-label-danger">Cancel</span>
                              <?php break; ?>
                          <?php default: ?>
                                <span></span>
                          <?php endswitch; ?>
                          </div>
                        </td>
                          <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="<?php echo e(url('admin/Task/edit/'.$Inventor->id)); ?>">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('admin/Task/delete/'.$Inventor->id)); ?>" id="<?php echo e($Inventor->id); ?>">Delete</button></li>
                          </ul>
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
          <div class="p-1" style="float: right;">
          </div>
        </div>
      </div>
</div>
<script type="text/javascript">
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
</script><?php /**PATH /home/insighthub/public_html/resources/views/Employee/MyProfile/Task.blade.php ENDPATH**/ ?>