
<?php $__env->startSection('title', 'Attendence'); ?>
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Attendence /</span> Home</h4>
    <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
    
    <div class="row">
          <div class="col-lg-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="badge p-2 bg-label-primary mb-2 rounded"><i class="fas fa-stopwatch" style="font-size: 18px;"></i></div>
                <h5 class="card-title mb-1 pt-1">Average Hours</h5>
                <!--<small class="text-muted">Last week</small>-->
                <p class="mb-2 mt-1"><?php echo e($averageWorkingHours); ?></p>
                <div class="pt-1">
                  <!--<span class="badge bg-label-primary">-12.2%</span>-->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="badge p-2 bg-label-primary mb-2 rounded"><i class="fas fa-sign-in" style="font-size: 18px;"></i></div>
                <h5 class="card-title mb-1 pt-1">Total overtime</h5>
                <!--<small class="text-muted">Last week</small>-->
                <p class="mb-2 mt-1"><?php echo e($totalOvertime); ?></p>
                <div class="pt-1">
                  <!--<span class="badge bg-label-primary">+25.2%</span>-->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="badge p-2 bg-label-success mb-2 rounded"><i class="fa-solid fa-clock" style="font-size: 18px;"></i></div>
                <h5 class="card-title mb-1 pt-1">On-time arrival</h5>
                <!--<small class="text-muted">Last week</small>-->
                <p class="mb-2 mt-1"><?php echo e($onTimeArrivals); ?></p>
                <div class="pt-1">
                  <!--<span class="badge bg-label-success">-12.2%</span>-->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="badge p-2 bg-label-danger mb-2 rounded"><i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 18px;"></i></div>
                <h5 class="card-title mb-1 pt-1">Total production hours </h5>
                <!--<small class="text-muted">Last week</small>-->
                <p class="mb-2 mt-1"><?php echo e($totalProductionHours); ?></p>
                <div class="pt-1">
                  <!--<span class="badge bg-label-danger">+25.2%</span>-->
                </div>
              </div>
            </div>
          </div>
        </div>
  <!-- Users List Table -->
  <div class="card mt-4">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Attendence's List</h5>
      </div>
      <div class="col-md-6 text-end">
        <a href="<?php echo e(url('Employee/Attendence/home')); ?>" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="<?php echo e(url('Employee/Attendence/add')); ?>" class="btn btn-primary mt-3 m-3">Add</a>
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
          <?php
    // Debug output
   
    // Current month
    $currentMonth = date('m');

    // Months array
    $months = [
        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
    ];

    // Determine the selected month
    $selectedMonth = isset($_GET['month']) ? $_GET['month'] : $currentMonth;
?>
<div class="col-sm-12 col-md-6">
    <form method="get">
        <div class="row">
            <div class="col-md-12 d-flex">
                <select name="month" class="form-select" id="month" onchange="this.form.submit()">
                    <?php
                        foreach ($months as $monthNumber => $monthName) {
                            $selected = ($selectedMonth == $monthNumber) ? 'selected' : '';
                            echo "<option value=\"$monthNumber\" $selected>$monthName</option>";
                        }
                    ?>
                </select>
                &nbsp;
                <select name="year" class="form-select" id="year" onchange="this.form.submit()">
                    <!-- Populate year options here -->
                </select>
            </div>
        </div>
    </form>
</div>

            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                <form method="GET" action="">    
                  <label>Search: <input value="" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
 <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
    <thead>
        <tr>
            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
            <th>ID</th>
            <th>Employee Name</th>
            <th>Total Hours</th>
            <th>Break Time</th>
            <th>Total Overtime</th>
            <th>Total Production Hours</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if($User->isNotEmpty()): ?>
            <?php $__currentLoopData = $User; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            // Find job role
            $jobrole = App\Models\Jobroles::find($row->jobrole_id);
            ?>
            <tr>
                <td><?php echo e($key + 1); ?></td>
                <td>
                    <div class="parent d-flex">
                        <div class="child1">
                            <img 
                                class="rounded-circle"
                                style="margin-right: 15px; margin-top: 10px;" 
                                src="<?php echo e($row->profile_img); ?>"
                                height="30"
                                width="30"
                                alt="User avatar" 
                            />
                        </div>
                        <div class="child2">
                            <a href="<?php echo e(url('Employee/Attendence/View/'.$row->emp_id)); ?>">
                                <?php echo e($row->first_name.' '.$row->last_name); ?>

                            </a>
                            <div style="font-size: 12px;">
                                <?php if($jobrole && $jobrole->name): ?>
                                    <?php echo e($jobrole->name); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <?php echo e(isset($row->total_seconds) ? floor($row->total_seconds / 3600) . 'h ' . floor(($row->total_seconds % 3600) / 60) . 'min ' . ($row->total_seconds % 60) . 'sec' : '0h 0min 0sec'); ?>

                </td>
                <td>
                    <?php echo e(isset($row->break_seconds) ? floor($row->break_seconds / 3600) . 'h ' . floor(($row->break_seconds % 3600) / 60) . 'min ' . ($row->break_seconds % 60) . 'sec' : '0h 0min 0sec'); ?>

                </td>
                <td>
                    <?php echo e(isset($totalOvertime) ? $totalOvertime : '0h 0min 0sec'); ?>

                </td>
                <td>
                    <?php echo e(isset($row->total_seconds) ? floor($row->total_seconds / 3600) . 'h ' . floor(($row->total_seconds % 3600) / 60) . 'min ' . ($row->total_seconds % 60) . 'sec' : '0h 0min 0sec'); ?>

                </td>
                <td><a href="<?php echo e(url('Employee/Attendence/View/'.$row->emp_id)); ?>"><i class="fa fa-eye"></i></a></td>
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
    
    $(document).ready(function() {
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
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/Employee/Humanesources/Attendence/home.blade.php ENDPATH**/ ?>