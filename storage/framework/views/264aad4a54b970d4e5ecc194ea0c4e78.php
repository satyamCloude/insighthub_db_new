<?php $__env->startSection('title', 'JobRole'); ?>
<?php $__env->startSection('content'); ?>
<?php 
$id = Auth::user()->id;

$RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                        ->leftjoin('employee_details','employee_details.admin_type_id','role_accesses.role_id')
                        ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                        ->where('employee_details.user_id',$id)
                        ->where('role_accesses.view','!=',null)
                        ->orWhere('role_accesses.add','!=',null)
                        ->orWhere('role_accesses.update','!=',null)
                        ->orWhere('role_accesses.delete','!=',null)
                        ->get()
                        ->toArray();
?>
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">JobRole /</span> Home</h4>
    <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">JobRole's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="<?php echo e(url('Employee/JobRole/home')); ?>" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
           <?php if($RoleAccess[array_search('JobRole', array_column($RoleAccess, 'per_name'))]['add'] == 1): ?>
          <a href="<?php echo e(url('Employee/JobRole/add')); ?>" class="btn btn-primary mt-3 m-3">Add</a>
          <?php endif; ?>
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
                <th>Job Role Name</th>
                <th>Assigned Employee</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(count($JobRole) > 0): ?>
             <?php $__currentLoopData = $JobRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php $teamlead =  \App\Models\User::whereIn('id', explode(',',$user->assign_emp_id))->get() ?>
              <tr class="odd">
                  <td><?php echo e($key+1); ?> </td>
                  <td><?php echo e($user->name); ?></td>
                  <td>
                    <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                      <?php $__currentLoopData = $teamlead; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teaml): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="<?php echo e($teaml->first_name); ?>">
                        <img class="rounded-circle" src="<?php echo e($teaml->profile_img); ?>" alt="Avatar">
                      </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </td>
                  <td>
                     <?php if(in_array('JobRole', array_column($RoleAccess, 'per_name'))): ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                               
                                <?php if($RoleAccess[array_search('JobRole', array_column($RoleAccess, 'per_name'))]['update'] == 1): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(url('Employee/JobRole/edit/'.$user->id)); ?>">Edit</a></li>
                                <?php endif; ?>
                                <?php if($RoleAccess[array_search('JobRole', array_column($RoleAccess, 'per_name'))]['delete'] == 1): ?>
                                    <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('Employee/JobRole/delete/'.$user->id)); ?>" id="<?php echo e($user->id); ?>">Delete</button></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                   
                  </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <tr>
                <td class="text-center" colspan="5">No Data Found</td>
              </tr>
              <?php endif; ?>
            </tbody>
        </table>
          <div class="p-1" style="float: right;">
              <?php echo e($JobRole->links()); ?>

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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/Employee/Humanesources/JobRole/home.blade.php ENDPATH**/ ?>