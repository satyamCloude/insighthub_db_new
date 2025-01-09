<?php $__env->startSection('title', 'Project'); ?>
<?php $__env->startSection('content'); ?>
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Project /</span> Home</h4>
    <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>InProgress</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($InProgress); ?></h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-primary">
                            <i class="fa-solid fa-diagram-project"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Completed</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Completed); ?></h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="fa-solid fa-diagram-project"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>OverDue</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($OverDue); ?></h3>
                            <!-- <p class="text-danger mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-warning">
                            <i class="fa-solid fa-diagram-project"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Cancel</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Cancel); ?></h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <p class="mb-0">Total</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="fa-solid fa-diagram-project"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
  </div>
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Project's List</h5>
      </div>
      <div class="col-md-6 text-end">
         <a href="<?php echo e(url('admin/Project/EXPORTCSV')); ?>" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>
          <a href="<?php echo e(url('admin/Project/home')); ?>" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="<?php echo e(url('admin/Project/add')); ?>" class="btn btn-primary mt-3 m-3">Add</a>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                  <form method="GET" action="">
                  <label>Search: <input type="search" value="<?php echo e($search); ?>" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Project Name</th>
                <th>Members</th>
                <th>Start Date</th>
                <th>Deadline</th>
                <th>Client</th>
                <th>Progress</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(count($Task) > 0): ?>
              <?php $__currentLoopData = $Task; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $Inventor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="odd">
                  <td><?php echo e($key+1); ?> </td>
                  <td><?php if($Inventor && $Inventor->project_name): ?> <?php echo e($Inventor->project_name); ?> <?php endif; ?></td>
                <td>
                    <?php if($Inventor && $Inventor->team_id): ?>
                              <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                        <?php $__currentLoopData = explode(',', $Inventor->team_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $user2 = App\Models\User::find($userId);
                            ?>
                            <?php if($user2 && $user2->profile_img): ?>
                                <!-- <img src="<?php echo e($user2->profile_img); ?>" height="60" width="60" alt="<?php echo e($user2->first_name ?: 'Profile Image'); ?>"> -->
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="<?php echo e($user2->first_name); ?>" data-bs-original-title="<?php echo e($user2->first_name); ?>">
                                  <img class="rounded-circle" src="<?php echo e($user2->profile_img); ?>" alt="Avatar">
                                </li>
                                

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                    <?php endif; ?>
                </td>

                  <td><?php if($Inventor && $Inventor->start_date): ?> <?php echo e($Inventor->start_date); ?> <?php endif; ?></td>
                  <td><?php if($Inventor && $Inventor->deadline): ?> <?php if($Inventor->deadline == date('Y-m-d')): ?> Today <?php elseif($Inventor->deadline < date('Y-m-d')): ?> <span style="color:red;"><?php echo e($Inventor->deadline); ?></span> <?php else: ?> <?php echo e($Inventor->deadline); ?> <?php endif; ?> <?php endif; ?></td>
                    <td style="font-weight:500">
                   <!--    <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="<?php echo e($Inventor->project_manager_name); ?>">
                          <img class="rounded-circle" src="<?php echo e($Inventor->project_manager_picture); ?>" alt="Avatar">
                        </li>
                        
                      </ul> -->

                       <?php if($Inventor && $Inventor->project_manager_name): ?> 
                          <?php echo e($Inventor->project_manager_name); ?> 
                      <?php endif; ?> 
                      <br/> 
                      <span class="text-grey" style="font-weight: 100;color: #858EA1"> 
                          <?php if($Inventor && $Inventor->company_name): ?> 
                              <?php echo e($Inventor->company_name); ?> 
                          <?php endif; ?>
                      </span>
                  </td>
                 <td >
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
                  </td>

                <!--   <td><div class="avatar me-2"><img data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-dark" data-bs-original-title="<?php if($Inventor && $Inventor->project_manager_name): ?> <?php echo e($Inventor->project_manager_name); ?> <?php endif; ?>" <?php if($Inventor && $Inventor->project_manager_picture): ?> src="<?php echo e($Inventor->project_manager_picture); ?>" <?php endif; ?>  alt="Avatar" class="rounded-circle" ></div></td>
                  <td>
                    <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                       <?php $teamlead =  \App\Models\User::whereIn('id', explode(',',$Inventor->team_id))->where('type',4)->get() ?>
                      <?php $__currentLoopData = $teamlead; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teaml): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="<?php echo e($teaml->first_name); ?>">
                        <img class="rounded-circle" src="<?php echo e($teaml->profile_img); ?>" alt="Avatar">
                      </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </td> -->
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
                            <li><a class="dropdown-item" href="<?php echo e(url('admin/Project/edit/'.$Inventor->id)); ?>">Edit</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('admin/Project/view/'.$Inventor->id)); ?>">View</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('admin/Project/delete/'.$Inventor->id)); ?>" id="<?php echo e($Inventor->id); ?>">Delete</button></li>
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
              <?php echo e($Task->links()); ?>

          </div>
        </div>
      </div>
    </div>
</div>

<script>
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

function changepro(id) {
  var id = id.id;
  var status = "progress";
$('.progchange'+id).html('<select onchange="updatepro(\''+status+'\', value, '+id+')" class="form-control select2" name="status_pro">'+
                     '<option value="10">Select %</option>'+
                     '<option value="10">10 %</option>'+
                     '<option value="20">20 %</option>'+
                     '<option value="30">30 %</option>'+
                     '<option value="40">40 %</option>'+
                     '<option value="50">50 %</option>'+
                     '<option value="60">60 %</option>'+
                     '<option value="70">70 %</option>'+
                     '<option value="80">80 %</option>'+
                     '<option value="90">90 %</option>'+
                     '<option value="100">100 %</option>'+
                 '</select>');
 $('.select2').select2()
  $('.hide'+id).html('');
}

function changestatus(id) {
  var id = id.id;
  var status = "stu";
  $('.statuschange'+id).html('<select onchange="updatepro(\''+status+'\', value, '+id+')" class="form-control select2" name="status_id">'+
                         '<option value="1">Select satuts</option>'+
                         '<option value="1">In Progress</option>'+
                         '<option value="2">Completed</option>'+
                         '<option value="3">Over Due</option>'+
                         '<option value="4">Cancel</option>'+
                      '</select>');
   $('.select2').select2()
  $('.statushide'+id).html('');
}

function updatepro(status,value,id){
  $.ajax({
        url: "<?php echo e(url('admin/Project/UpdateStatus')); ?>",
        method: 'GET',
        data: { id: id,
                status_pro: value, 
                status : status
              },
        success: function () {
           location.reload();
        },
        error: function () {
           
        }
    });



}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Project/home.blade.php ENDPATH**/ ?>