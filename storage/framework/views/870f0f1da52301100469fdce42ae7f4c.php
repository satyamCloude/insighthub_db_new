 <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>#<?php echo e($attendance->emp_Id); ?></td>
                            <td><?php echo e($attendance->punch_date); ?></td>
                            <td><?php echo e($attendance->punch_in); ?></td>
                            <td><?php echo e($attendance->punch_out); ?></td>
                            <td><?php echo e($attendance->working_hours); ?></td>
                            <td>
                                <?php 
                                // Extract hours and minutes from ts_working_hrs
                                list($hours, $minutes) = explode(':', $attendance->ts_working_hrs);
                                
                                // Calculate total hours
                                $total_hours = intval($hours) + intval($minutes) / 60;
                                
                                // Calculate overtime
                                $overtime = $attendance->working_hours - $total_hours;
                                ?>
                                <?php echo e($overtime > 0 ? $overtime : 0); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Humanesources/Attendence/attendance.blade.php ENDPATH**/ ?>