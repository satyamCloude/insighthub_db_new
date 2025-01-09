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
            <!-- <a href="<?php echo e(url('admin/Attendence/home')); ?>" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a> -->
            <form action="<?php echo e(url('admin/Attendence/fetch')); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-warning mt-3 m-3">
                    <i class="fas fa-sync-alt"></i> 
                </button>
            </form>

            <a href="<?php echo e(url('admin/Attendence/add')); ?>" class="btn btn-primary mt-3 m-3">Add</a>
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
                     <th>ID</th>
                     <th>Employee Name</th>
                     <th>Shift Name</th>
                     <th>Total Hours</th>
                     <th>Break Time</th>
                     <th>Total Overtime</th>
                     <th>Total Production Hours</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <!-- <tbody>
                  <?php if($users->isNotEmpty()): ?>
                  <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                  $totalOvertimeData = DB::table('attendences as a')
                  ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
                  ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
                  ->where('a.emp_id', $user->emp_id)
                  ->whereBetween('a.punch_date', [$startDate, $endDate])
                  ->whereNotNull('a.punch_out')
                  ->whereRaw('TIME(a.punch_out) > TIME(ts.EndTime)')
                  ->select(DB::raw('SUM(TIMESTAMPDIFF(SECOND, TIME(ts.EndTime), TIME(a.punch_out))) as total_overtime_seconds'))
                  ->first();
                  $totalOvertimeSeconds = $totalOvertimeData->total_overtime_seconds ?? 0;
                  $totalOvertimeHours = floor($totalOvertimeSeconds / 3600);
                  $totalOvertimeMinutes = floor(($totalOvertimeSeconds % 3600) / 60);
                  $totalOvertimeSeconds = $totalOvertimeSeconds % 60;
                  $totalOvertimeFormatted = "{$totalOvertimeHours}h {$totalOvertimeMinutes}min {$totalOvertimeSeconds}sec";
                  $totalProductionData = DB::table('attendences as a')
                  ->where('a.emp_id', $user->emp_id)
                  ->whereBetween('a.punch_date', [$startDate, $endDate])
                  ->whereNotNull('a.punch_in')
                  ->whereNotNull('a.punch_out')
                  ->select(DB::raw('SUM(TIMESTAMPDIFF(SECOND, a.punch_in, a.punch_out)) as total_production_seconds'))
                  ->first();
                  $totalOvertimeSeconds = $totalOvertimeData->total_overtime_seconds ?? 0;
                  $totalOvertimeHours = floor($totalOvertimeSeconds / 3600);
                  $totalOvertimeMinutes = floor(($totalOvertimeSeconds % 3600) / 60);
                  $totalOvertimeSeconds = $totalOvertimeSeconds % 60;
                  $totalOvertimeFormatted = "{$totalOvertimeHours}h {$totalOvertimeMinutes}min {$totalOvertimeSeconds}sec";
                  $totalProductionSeconds = $totalProductionData->total_production_seconds ?? 0;
                  $totalProductionHours = floor($totalProductionSeconds / 3600);
                  $totalProductionMinutes = floor(($totalProductionSeconds % 3600) / 60);
                  $totalProductionSeconds = $totalProductionSeconds % 60;
                  $totalProductionFormatted = "{$totalProductionHours}h {$totalProductionMinutes}min {$totalProductionSeconds}sec";
                  $jobrole = App\Models\Jobroles::find($user->jobrole_id);
                  // Fetch the working hours in 'HH:MM:SS' format
                  $workingHours = $user->ts_working_hrs; // e.g., '08:30:00'
                  // Convert the working hours to total seconds
                  list($hours, $minutes, $seconds) = explode(':', $workingHours);
                  $workingSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;
                  $Attendances= DB::table('attendences as a')
                  ->where('a.emp_id', $user->emp_id)
                  ->whereBetween('a.punch_date', [$startDate, $endDate])
                  ->whereNotNull('a.punch_in')
                  ->whereNotNull('a.punch_out')
                  ->groupBy('a.punch_date')
                  ->get();
                  $Attendances = count($Attendances);
                  $totalSeconds = $workingSeconds * $Attendances;
                  $hoursWorked = floor($totalSeconds / 3600);
                  $minutesWorked = floor(($totalSeconds % 3600) / 60);
                  $secondsWorked = $totalSeconds % 60;
                  $formattedTime = sprintf('%02d:%02d:%02d', $hoursWorked, $minutesWorked, $secondsWorked);
                  ?>
                  <tr>
                     <td><?php echo e($key + 1); ?></td>
                     <td>
                        <div class="parent d-flex">
                           <div class="child1">
                              <img 
                                 class="rounded-circle"
                                 style="margin-right: 15px; margin-top: 10px;" 
                                 src="<?php echo e($user->profile_img); ?>"
                                 height="30"
                                 width="30"
                                 alt="User avatar" 
                                 />
                           </div>
                           <div class="child2">
                              <a href="<?php echo e(url('admin/Attendence/View/'.$user->emp_id)); ?>">
                              <?php echo e($user->first_name.' '.$user->last_name); ?>

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
                        <?php echo e($formattedTime); ?>

                     </td>
                     <td>
                        <?php echo e(isset($user->break_seconds) ? floor($user->break_seconds / 3600) . 'h ' . floor(($user->break_seconds % 3600) / 60) . 'min ' . ($user->break_seconds % 60) . 'sec' : '0h 0min 0sec'); ?>

                     </td>
                     <td>
                        <?php echo e(isset($totalOvertimeFormatted) ? $totalOvertimeFormatted : '0h 0min 0sec'); ?>

                     </td>
                     <td>
                        <?php echo e(isset($totalProductionFormatted) ? $totalProductionFormatted : '0h 0min 0sec'); ?>

                     </td>
                     <td><a href="<?php echo e(url('admin/Attendence/View/'.$user->emp_id)); ?>"><i class="fa fa-eye"></i></a></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                  <tr>
                     <td class="text-center" colspan="7">No Data Found</td>
                  </tr>
                  <?php endif; ?>
               </tbody> -->
               <tbody>
                  <?php if($users->isNotEmpty()): ?>
                     <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        // Calculate total overtime
                        $totalOvertimeData = DB::table('attendences as a')
                           ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
                           ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
                           ->where('a.emp_id', $user->emp_id)
                           ->whereBetween('a.punch_date', [$startDate, $endDate])
                           ->whereNotNull('a.punch_out')
                           ->whereRaw('TIME(a.punch_out) > TIME(ts.EndTime)')
                           ->select(DB::raw('SUM(TIMESTAMPDIFF(SECOND, TIME(ts.EndTime), TIME(a.punch_out))) as total_overtime_seconds'))
                           ->first();
                        $totalOvertimeSeconds = $totalOvertimeData->total_overtime_seconds ?? 0;
                        $totalOvertimeFormatted = sprintf('%02dh %02dmin %02dsec', 
                           floor($totalOvertimeSeconds / 3600), 
                           floor(($totalOvertimeSeconds % 3600) / 60), 
                           $totalOvertimeSeconds % 60);

                        // Calculate total production
                        $totalProductionData = DB::table('attendences as a')
                           ->where('a.emp_id', $user->emp_id)
                           ->whereBetween('a.punch_date', [$startDate, $endDate])
                           ->whereNotNull('a.punch_in')
                           ->whereNotNull('a.punch_out')
                           ->select(DB::raw('SUM(TIMESTAMPDIFF(SECOND, a.punch_in, a.punch_out)) as total_production_seconds'))
                           ->first();
                        $totalProductionSeconds = $totalProductionData->total_production_seconds ?? 0;
                        $totalProductionFormatted = sprintf('%02dh %02dmin %02dsec', 
                           floor($totalProductionSeconds / 3600), 
                           floor(($totalProductionSeconds % 3600) / 60), 
                           $totalProductionSeconds % 60);

                     
                        // Fetch job role
                        $jobrole = App\Models\Jobroles::find($user->jobrole_id);

                       

                        // Get all entries for the user (replace this with your actual query to get user data)
                        $userEntries = DB::table('attendences')->where('emp_id', $user->emp_id)->whereBetween('punch_date', [$startDate, $endDate])->get();

                        // Initialize totals for the user
                        $totalWorkedHoursInSeconds = 0;
                        $totalOvertimeInSeconds = 0;
                        $totalBreakTimeInSeconds = 0;
                        $totalProductionInSeconds = 0;

                        // Loop through all the user entries
                        foreach ($userEntries as $entry) {
                           // Get punch-in and punch-out times
                           $punchIn = $entry->punch_in;  // Example: '08:00:00'
                           $punchOut = $entry->punch_out; // Example: '17:00:00'

                           // Treat "00:00:00" as midnight (12:00 AM)
                           if ($punchIn === '00:00:00') {
                              $punchIn = '12:00:00';
                           }
                           if ($punchOut === '00:00:00') {
                              $punchOut = '12:00:00';
                           }

                           // Convert punch-in and punch-out to timestamps
                           $punchInTime = strtotime($punchIn);
                           $punchOutTime = strtotime($punchOut);

                           // Calculate total seconds worked
                           $totalSecondsWorked = max(0, $punchOutTime - $punchInTime); // Ensure non-negative value
                           $totalWorkedHoursInSeconds += $totalSecondsWorked;

                           // Parse overtime (format: 0h 00min 00sec), default to 0 if invalid
                           $overtimeInSeconds = !empty($entry->overtime) && preg_match('/(\d+)h (\d+)min (\d+)sec/', $entry->overtime, $matches)
                              ? ($matches[1] * 3600) + ($matches[2] * 60) + $matches[3]
                              : 0;
                           $totalOvertimeInSeconds += $overtimeInSeconds;

                           // Convert break time to seconds, default to 0 if invalid
                           $breakTimeInSeconds = is_numeric($entry->break_time) ? $entry->break_time * 60 : 0;
                           $totalBreakTimeInSeconds += $breakTimeInSeconds;

                           // Calculate total production time: (totalhours + overtime) - break_time
                           $totalProductionInSecondsForEntry = max(0, $totalSecondsWorked + $overtimeInSeconds - $breakTimeInSeconds);
                           $totalProductionInSeconds += $totalProductionInSecondsForEntry;
                        }

                        // After all entries have been processed, format the results
                        // Total worked hours
                        $totalWorkedHours = sprintf('%02dh %02dmin %02dsec',
                           floor($totalWorkedHoursInSeconds / 3600),
                           floor(($totalWorkedHoursInSeconds % 3600) / 60),
                           $totalWorkedHoursInSeconds % 60
                        );

                        // Total overtime hours
                        $totalOvertime = sprintf('%02dh %02dmin %02dsec',
                           floor($totalOvertimeInSeconds / 3600),
                           floor(($totalOvertimeInSeconds % 3600) / 60),
                           $totalOvertimeInSeconds % 60
                        );

                        // Total break time
                        $totalBreakTime = sprintf('%02dh %02dmin %02dsec',
                           floor($totalBreakTimeInSeconds / 3600),
                           floor(($totalBreakTimeInSeconds % 3600) / 60),
                           $totalBreakTimeInSeconds % 60
                        );

                        // Total production time
                        $totalProductionTime = sprintf('%02dh %02dmin %02dsec',
                           floor($totalProductionInSeconds / 3600),
                           floor(($totalProductionInSeconds % 3600) / 60),
                           $totalProductionInSeconds % 60
                        );

                        ?>
                        <tr>
                           <td><?php echo e($key + 1); ?></td>
                           <td>
                              <div class="d-flex align-items-center">
                                 <img class="rounded-circle me-2" src="<?php echo e($user->profile_img); ?>" alt="User avatar" width="30" height="30">
                                 <div>
                                    <a href="<?php echo e(url('admin/Attendence/View/'.$user->emp_id)); ?>"><?php echo e($user->first_name.' '.$user->last_name); ?></a>
                                    <div class="small text-muted"><?php echo e($jobrole->name ?? ''); ?></div>
                                 </div>
                              </div>
                           </td>
                           <td>
                                 <?php echo e($user->shift_name); ?>

                              <div class="small text-muted">
                                 (<?php echo e(\Carbon\Carbon::parse($user->ts_working_hrs)->format('G:i').'Hr'); ?>)
                              </div>
                           </td>
                           <td><?php echo e($totalWorkedHours); ?></td>
                           <td><?php echo e($totalBreakTime); ?></td>
                           <td><?php echo e($totalOvertime); ?></td>
                           <td><?php echo e($totalProductionTime); ?></td>
                           <td><a href="<?php echo e(url('admin/Attendence/View/'.$user->emp_id)); ?>"><i class="fa fa-eye"></i></a></td>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/insighthub_db/resources/views/admin/Humanesources/Attendence/home.blade.php ENDPATH**/ ?>