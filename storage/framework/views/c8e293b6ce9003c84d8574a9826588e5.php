<?php $__env->startSection('title', 'Client'); ?>
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">User /</span> Client</h4>
   <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Total Users</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Totalclient); ?></h3>
                            <!-- <p class="text-success mb-0">0</p> -->
                          </div>
                          <!-- <p class="mb-0">Total Users</p> -->
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
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>InActive Client</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($InActive); ?></h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <!-- <p class="mb-0">Last week analytics</p> -->
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
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Active Client</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Active); ?></h3>
                            <!-- <p class="text-danger mb-0"></p> -->
                          </div>
                          <!-- <p class="mb-0">Last week analytics</p> -->
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
    <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Closed Client</span>
                          <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2"><?php echo e($Closed); ?></h3>
                            <!-- <p class="text-success mb-0"></p> -->
                          </div>
                          <!-- <p class="mb-0">Last week analytics</p> -->
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
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Client's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="<?php echo e(url('admin/Client/home')); ?>" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="<?php echo e(url('admin/Client/add')); ?>" class="btn btn-primary mt-3 m-3">Add</a>
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
                  <label>Search: <input value="<?php echo e($query); ?>" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>CLIENT NAME</th>
                <!--<th>COMPANY</th>-->
                <th>Email</th>
                <th>CREATED</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php if(count($users) > 0): ?>
           
             <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
              <tr class="odd">
                  <td><?php echo e($key+1); ?> </td>
                  <td>
                    <a href="<?php echo e(url('admin/Client/view/'.$user->id)); ?>">   
                            
                            <div class="parent d-flex">
                                  <div class="child1"> <?php if($user->profile_img): ?>
                                 <img 
                                    class="rounded-circle"
                                    style="margin-right: 15px;margin-top: 10px;" 
                                    src="<?php echo e($user->profile_img); ?>"
                                    height="30"
                                    width="30"
                                    alt="User avatar" /> 
                              <?php else: ?>
                              <img 
                                    class="rounded-circle"
                                    style="margin-right: 15px;margin-top: 10px;" 
                                    src="<?php echo e(url('public/images/21104.png')); ?>"
                                    height="30"
                                    width="30"
                                    alt="User avatar" />
        
                              <?php endif; ?>   </div>
                          <div class="child2"><?php echo e($user->first_name); ?>  <?php echo e($user->last_name); ?>  (<?php echo e($user->id); ?>) <br><?php echo e($user->company_name); ?></div>
                          </div>
                      
                           </a>
                            </td>
                  <!--<td><?php if($user && $user->company_name): ?> <?php echo e($user->company_name); ?> <?php endif; ?></td>-->
                  <td><?php echo e($user->email); ?></td>
                  <td><?php echo e($user->created_at->format('Y-m-d')); ?></td>
                <td>
                  <?php if($user->status == 0): ?>
                  <span class="badge bg-label-danger">Incomplete</span>
                  <?php elseif($user->status == 1): ?>
                  <span class="badge bg-label-success">Active</span>
                  <?php elseif($user->status == 2): ?>
                   <span class="badge bg-label-warning">Suspended</span>
                  <?php elseif($user->status == 3): ?>
                  <span class="badge bg-label-warning">Terminated</span>
                  <?php elseif($user->status == 4): ?>
                  <span class="badge bg-label-danger">Incomplete</span>
                  <?php elseif($user->status == 5): ?>
                  <span class="badge bg-label-warning">Unverrified</span>
                  <?php else: ?>
                      <span></span>
                  <?php endif; ?>
                     <!--  <?php switch($user->payment_status):
                          case ('1'): ?>
                              <span class="badge bg-label-success">Active</span>
                              <?php break; ?>
                          <?php case ('0'): ?>
                              <span class="badge bg-label-danger">Inactive</span>
                              <?php break; ?>
                          <?php case ('3'): ?>
                              <span class="badge bg-label-warning">Closed</span>
                              <?php break; ?>
                          <?php default: ?>
                              <span></span>
                      <?php endswitch; ?> -->
                  </td>

                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="<?php echo e(url('admin/Client/view/'.$user->id)); ?>">View</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('admin/Client/edit/'.$user->id)); ?>">Edit</a></li>
                             <li><button class="dropdown-item delete_debtcase" url="<?php echo e(url('admin/Client/delete/'.$user->id)); ?>" id="<?php echo e($user->id); ?>">Delete</button></li> 
                          </ul>
                      </div>
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
          <div class="p-1" style="float: right;">
              <?php echo e($users->links()); ?>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/user/client/home.blade.php ENDPATH**/ ?>