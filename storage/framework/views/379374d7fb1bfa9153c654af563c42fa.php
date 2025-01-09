
<?php $__env->startSection('title', 'PayRoll'); ?>
<?php $__env->startSection('content'); ?>
<style>
    .heading {
        font-size: 18px;
    }

    .icons_s {
        font-size: 18px;
    }

    .bg-label-wallet {
        background-color: #7AE1DF !important;
    }

    .bg-label-deductions {
        background-color: #DF4C4A !important;
    }

    .bg-label-dollar {
        background-color: #7BB8F1 !important;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Payroll</h4>
    <!-- <a href="<?php echo e(url('admin/PayRoll/home2')); ?>" class="btn btn-label-primary me-3">
        <span class="align-middle"> Old Pay Roll Page</span>
    </a> -->

    <?php if(Session::has('success')): ?>
    <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
    <div class="alert alert-danger" role="alert"><?php echo e(Session::get('error')); ?></div>
    <?php endif; ?>
    <div class="row mt-4 mb-4">
    	<div class="col-md-4 d-flex">
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
            <select name="year" class="form-select" id="year"> </select>
        </div>
        
        <div class="col-md-8" style="text-align: end;">
            <div class="btn-group justify-content-center" >
                <a class="btn btn-primary text-white" onclick="openrulemodal()">Rules</a>
                <!--<a href="<?php echo e(url('admin/PayRoll/EXPORTCSV')); ?>" class="btn btn-secondary buttons-collection btn-label-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">-->
                <!--    <span>-->
                        <!-- <i class="ti ti-file-export me-sm-1"></i> -->
                <!--        <span class="d-none d-sm-inline-block">Export</span>-->
                <!--    </span>-->
                <!--</a>-->
                <a href="<?php echo e(url('admin/PayRoll/GenerateSellary')); ?>" class="btn btn-info">
                	<span>
                        <!-- <i class="fas fa-sync-alt"></i> -->
                        <span class="d-none d-sm-inline-block">Generate</span>
                    </span></a>
                <!-- <a href="<?php echo e(url('admin/PayRoll/home')); ?>" class="btn btn-secondary"><i class="fas fa-sync-alt"></i></a> -->
            </div>
        </div>
	</div>
	<div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card card-border-shadow-warning h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1" style="justify-content: space-between;">
                                <h4 class="ms-1 mb-0" id="totalEmp"><?php echo e($totalEmp); ?></h4>

                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded bg-label-warning"><i class="fa-solid fa-user icons_s"></i></span>
                                </div>
                            </div>
                            <p class="mb-1 heading">Total Employees</p>
                            <p class="mb-0">
                                <span class="fw-medium me-1" id="empTotalPercent" style="color:
								    <?php if($empTotalPercent <= 0): ?>
								        red;
								    <?php elseif($empTotalPercent <= 20): ?>
								        green;
								    <?php elseif($empTotalPercent <= 50): ?>
								        orange;
								    <?php endif; ?>">
                                   <?php echo e(number_format($empTotalPercent,2)); ?> %
                                </span>
                                <small class="text-muted">since last quarter</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1" style="justify-content: space-between;">
                                <h4 class="ms-1 mb-0" id="totalWorkingHours"><?php echo e(number_format($totalWorkingHours,2)); ?> Hrs</h4>
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="fa-solid fa-clock icons_s"></i></span>
                                </div>
                            </div>
                            <p class="mb-1 heading">Total Working Hours</p>
                           <p class="mb-0">
                                                    <span class="fw-medium me-1" id="empTotalWorkHrs" style="color:
                                                        <?php if($empTotalWorkHrs <= 0): ?>
                                                            red;
                                                        <?php elseif($empTotalWorkHrs <= 20): ?>
                                                            green;
                                                        <?php elseif($empTotalWorkHrs <= 50): ?>
                                                            orange;
                                                        <?php endif; ?>">
                                                        <?php echo e(number_format($empTotalWorkHrs, 2)); ?>%
                                                    </span>
                                                    <small class="text-muted">since last quarter</small>
                                                </p>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card card-border-shadow-warning h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1" style="justify-content: space-between;">
                                <h4 class="ms-1 mb-0"><?php echo e($currency->prefix); ?> <span id="totalPayrollCost"><?php echo e(number_format($totalPayrollCost,2)); ?></span></h4>
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded bg-label-dollar"><?php echo e($currency->prefix); ?></span>
                                </div>
                            </div>
                            <p class="mb-1 heading">Payroll Cost</p>
                            <p class="mb-0">
                                <span class="fw-medium me-1" id="payrollCostChange" style="color: <?php if($payrollCostChange >= 0): ?> green; <?php else: ?> red; <?php endif; ?>"><?php echo e($payrollCostChange); ?>%
                                    <small class="text-muted">since last month</small>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card card-border-shadow-danger h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1" style="justify-content: space-between;">
                                <h4 class="ms-1 mb-0"><?php echo e($currency->prefix); ?> <span id="totalNetSalary"><?php echo e(number_format($totalNetSalary,2)); ?></span></h4>
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded bg-label-wallet"><i class="fa-solid fa-wallet icons_s"></i></span>
                                </div>
                            </div>
                            <p class="mb-1 heading">Net Salary</p>
                            <p class="mb-0">
                                <span class="fw-medium me-1" id="netSalaryChange" style="color: <?php if($payrollCostChange >= 0): ?> green; <?php else: ?> red; <?php endif; ?>"><?php echo e($netSalaryChange); ?>%</span>
                                <small class="text-muted">than last week</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card card-border-shadow-danger h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1" style="justify-content: space-between;">
                                <h4 class="ms-1 mb-0"><?php echo e($currency->prefix); ?> <span id="totalNetDeduction"><?php echo e(number_format($totalNetDeduction,2)); ?></span></h4>
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded bg-label-deductions"><i class="fa-solid fa-minus" style="font-size: 9px;margin-right: 3px;"></i><?php echo e($currency->prefix); ?></span>
                                </div>
                            </div>
                            <p class="mb-1">Deductions</p>
                            <p class="mb-0">
                                <span class="fw-medium me-1" id="netDeductionChange" style="color: <?php if($payrollCostChange >= 0): ?> green; <?php else: ?> red; <?php endif; ?>"><?php echo e($netDeductionChange); ?>%</span>
                                <small class="text-muted">than last week</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card card-border-shadow-warning h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1" style="justify-content: space-between;">
                                <h4 class="ms-1 mb-0"><?php echo e($currency->prefix); ?> <span id="totalNetTds"><?php echo e(number_format($totalNetTds,2)); ?></span></h4>
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded bg-label-warning"><i class="fa-solid fa-minus" style="font-size: 9px;margin-right: 3px;"></i><?php echo e($currency->prefix); ?></span>
                                </div>
                            </div>
                            <p class="mb-1">TDS</p>
                            <p class="mb-0">
                                <span class="fw-medium me-1" id="netTdsChange" style="color: <?php if($payrollCostChange >= 0): ?> green; <?php else: ?> red; <?php endif; ?>"><?php echo e($netTdsChange); ?>%</span>
                                <small class="text-muted">than last week</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-3">
			<div class="row">
				<div class="col-lg-12 col-6 mb-4">
					<div class="card h-100">
						<div class="card-body text-center">
							<div class="badge rounded-pill p-2 bg-label-success mb-2" style="width: 100px;height: 100px;"><i class="fa-solid fa-briefcase" style="font-size: 40px;margin: 22px 2px;"></i></div>
							<h4 class="card-title mb-2 mt-3">Payroll Date</h4>
							<h5 class="card-title mb-2">17/01/2023</h5>
							<small>Payroll run : 28/12/2022 - 10/01/2023</small>
							<button type="button" class="btn btn-primary waves-effect waves-light mt-4">
								Payroll Details
							</button>
						</div>
					</div>
				</div>
			</div>
		</div> -->
    </div>

    <section class="emp_table">
        <div class="row">
            <div class="col-md-4 mb-4">
            <div class="d-flex justify-content-center btn-group"> <!-- Adjusted class -->
                <button onclick="Salary()" class="btn btn-success ">Salary</button>
                <button onclick="Deduction()" class="btn btn-danger ">Deduction</button>
                <button onclick="TDS()" class="btn btn-warning ">TDS</button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-datatable table-responsive pt-0">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="card-header  row">
                            <div class="col-2 head-label text-center">
                                <h5 class="card-title mb-0" style="text-align: left;"><span id="tableTitle">Salary</span> List</h5>
                            </div>
                            <div class="col-10 col-md-6 d-flex justify-content-center justify-content-md-end">
                                <div class="dt-action-buttons text-end pt-3 pt-md-0">
                                    <div class="dt-buttons btn-group flex-wrap">
                                         <div class="btn-group">
											<a href="<?php echo e(url('admin/PayRoll/EXPORTCSV')); ?>" class="btn btn-secondary buttons-collection btn-label-primary me-2 waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">
												<span>
													<i class="ti ti-file-export me-sm-1"></i>
													<span class="d-none d-sm-inline-block">Export</span>
												</span>
											</a>
										</div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pe-5 pb-3">
                            <div class="col-12   d-flex justify-content-center justify-content-md-end">
                                <form method="GET" action="">    
                                    <label>Search: 
                                        <input type="search" name="search" <?php if(request()->get('search')): ?> value="<?php echo e(request()->get('search')); ?>" <?php endif; ?> class="form-control" placeholder="" aria-controls="DataTables_Table_0">
    								</label> 
                                </form>
                            </div>
                        </div>

                        <div id="newpayroll">
                            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                                <thead>
                                    <tr>
                                        <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                        <th>ID</th>
                                        <th>EMPLOYEE</th>
                                        <th>GROSS SALARY</th>
                                        <th>NET PAID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="result">
                                    <?php
                                    $totalNetSalary = 0;
                                    $totalNetPaid = 0;
                                    ?>
                                    <?php if(count($payrolls) > 0): ?>
                                    <?php $__currentLoopData = $payrolls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    if ($user && $user->net_salary) {
                                    $totalNetSalary += $user->net_salary;
                                    }
                                    if ($user && $user->net_paid) {
                                    $totalNetPaid += $user->net_paid;
                                    }
                                    ?>

                                    <tr class="odd">
                                        <td><?php echo e($key+1); ?> </td>
                                        <td>
                                           <div class="parent d-flex">
                                           <div class="child1">
                                               <img 
                                                   class="rounded-circle" 
                                                   style="margin-right: 15px; margin-top: 10px;" 
                                                   src="<?php echo e(isset($user->profile_img) ? $user->profile_img : url('public/images/21104.png')); ?>" 
                                                   height="30" 
                                                   width="30" 
                                                   alt="User avatar" 
                                               />
                                           </div>
                                           <div class="child2">
                                               <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                               <div style="font-size: 12px;">
                                                   <?php echo e($user->user_role); ?>

                                               </div>
                                           </div>
                                       </div>

                                        </td>
                                        <td><?php if($user && $user->net_salary): ?> <?php echo e($user->net_salary); ?> <?php endif; ?></td>
                                        <td><?php if($user && $user->net_paid): ?> <?php echo e($user->net_paid); ?> <?php endif; ?></td>
                                        <td>
                                            <a onclick="editrol(this)" id="<?php echo e($user->id); ?>"><i class="fas fa-edit pointer-cursor"></i></a>&nbsp;&nbsp;
                                            <a href="<?php echo e(url('admin/PayRoll/view/'.$user->user_id)); ?>" class="text-info" ><i class="fas fa-eye pointer-cursor"></i></a>&nbsp;&nbsp;
                                            <a class="btn-link" href="<?php echo e(url('admin/PayRoll/SallarySlip/'.$user->id)); ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <!-- <tr>
                                        <td></td>
                                        <td><strong>Total</strong></td>
                                        <td><strong><?php echo e(number_format($totalNetSalary,2)); ?></strong></td>
                                        <td><strong><?php echo e(number_format($totalNetPaid,2)); ?></strong></td>
                                        <td></td>
                                    </tr> -->
                                    <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="5">No Data Found</td>
                                    </tr>
                                    <?php endif; ?>

                                </tbody>
                            </table>
                            <div class="p-1" style="float: right;">
                                <?php echo e($payrolls->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="editpayrol" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog"></div>


        <div class="modal fade" id="rulesmodal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">Rating</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo e(url('admin/PayRoll/Rules/update/'.$Rules->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="basic" class="form-label">Basic(%)on NetSalary <span class="text-danger">*</span></label>
                                    <input type="number" step="any" class="form-control" <?php if($Rules && $Rules->basic): ?> value="<?php echo e($Rules->basic); ?>" <?php endif; ?> name="basic">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="hra" class="form-label">HRA (%) On Basic <span class="text-danger">*</span></label>
                                    <input type="number" step="any" class="form-control" <?php if($Rules && $Rules->hra): ?> value="<?php echo e($Rules->hra); ?>" <?php endif; ?> name="hra">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="conveyance" class="form-label">Conveyance(Fixed Amount) <span class="text-danger">*</span></label>
                                    <input type="number" step="any" class="form-control" <?php if($Rules && $Rules->conveyance): ?> value="<?php echo e($Rules->conveyance); ?>" <?php endif; ?> name="conveyance">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="medical" class="form-label">Medical(Fixed Amount) <span class="text-danger">*</span></label>
                                    <input type="number" step="any" class="form-control" <?php if($Rules && $Rules->medical): ?> value="<?php echo e($Rules->medical); ?>" <?php endif; ?> name="medical">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script type="text/javascript">
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

            // Handle the change event of the select elements
            $selectYear.on('change', fetchData);
            $selectMonth.on('change', fetchData);

            // Function to apply color based on the value
		    function applyColor(value) {
		        var color = parseFloat(value) >= 0 ? 'green' : 'red';
		        return '<span style="color: ' + color + ';">' + parseFloat(value) + '%</span>';
		    }
function fetchData() {
    var selectedYear = $selectYear.val();
    var selectedMonth = $selectMonth.val();

    // Make an AJAX request to fetch data based on the selected year and month
    $.ajax({
        url: "<?php echo e(url('admin/PayRoll/get_SallaryData')); ?>",
        method: 'GET',
        data: {
            year: selectedYear,
            month: selectedMonth
        },
        success: function(data) {
            // Handle the successful response
            $('#result').empty(); // Clear previous content
            
            if (data.html.length > 0) {
                $('#result').html(data.html);
            } else {
                $('#result').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
            }
            $('#totalEmp').text(data.data.totalEmp);
            $('#empTotalPercent').html(applyColor(formatPercentage(data.data.empTotalPercent)));

            $('#totalWorkingHours').text(data.data.totalWorkingHours);
            $('#empTotalWorkHrs').html(applyColor(formatPercentage(data.data.empTotalWorkHrs)));
            $('#totalPayrollCost').text(data.data.totalPayrollCost);
            $('#payrollCostChange').html(applyColor(formatPercentage(data.data.payrollCostChange)));
            $('#totalNetSalary').text(data.data.totalNetSalary);
            $('#netSalaryChange').html(applyColor(formatPercentage(data.data.netSalaryChange)));
            $('#totalNetDeduction').text(data.data.totalNetDeduction);
            $('#netDeductionChange').html(applyColor(formatPercentage(data.data.netDeductionChange)));
            $('#totalNetTds').text(data.data.totalNetTds);
            $('#netTdsChange').html(applyColor(formatPercentage(data.data.netTdsChange)));
        },
        error: function() {
            $('#result').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
        }
    });
}


            function formatPercentage(value) {
    return value.toFixed(2) + '%';
}

        });

        function openrulemodal() {
            $('#rulesmodal').modal('show');
        }

        function Salary() {
            $.ajax({
                url: "<?php echo e(url('admin/PayRoll/Salary')); ?>",
                method: 'GET',
                success: function(data) {
                    // Handle the successful response
                    $('#newpayroll').empty(); // Clear previous content
                    $('#tableTitle').text("Salary");
                    if (data.length > 0) {
                        
                        $('#newpayroll').html(data);
                    } else {
                        $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function() {
                    $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }

        function Deduction() {
            $.ajax({
                url: "<?php echo e(url('admin/PayRoll/Deduction')); ?>",
                method: 'GET',
                success: function(data) {
                    // Handle the successful response
                    $('#newpayroll').empty(); // Clear previous content
                    $('#tableTitle').text("Deductions");
                    if (data.length > 0) {
                        $('#newpayroll').html(data);
                    } else {
                        $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function() {
                    $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }

        function TDS() {
            $.ajax({
                url: "<?php echo e(url('admin/PayRoll/TDS')); ?>",
                method: 'GET',
                success: function(data) {
                    // Handle the successful response
                    $('#newpayroll').empty(); // Clear previous content
                    $('#tableTitle').text("TDS");
                    if (data.length > 0) {
                        $('#newpayroll').html(data);
                    } else {
                        $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>No Data Found</span></td></tr>');
                    }
                },
                error: function() {
                    $('#newpayroll').html('<tr><td colspan="8" class="text-center"><span>Error fetching data.</span></td></tr>');
                }
            });
        }

        function editrol(element) {
            var id = element.id;

            $.ajax({
                url: "<?php echo e(url('admin/PayRoll/edit')); ?>",
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data && typeof data == 'string') {
                        $('#editpayrol').html(data);
                        $('#editpayrol').modal('show');
                    } else {
                        $('#editpayrol').html('<div>No Data Found</div>');
                        $('#editpayrol').modal('show');
                    }
                },
                error: function() {
                    $('#editpayrol .modal-content').html('<div>Error fetching data.</div>');
                    $('#editpayrol').modal('show');
                }
            });
        }
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Humanesources/PayRoll/home.blade.php ENDPATH**/ ?>