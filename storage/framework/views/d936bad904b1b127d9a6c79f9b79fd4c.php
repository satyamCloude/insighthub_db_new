<?php $__env->startSection('title', 'My Profile'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between">
    
    <ul class="nav nav-pills flex-column flex-md-row mb-4 mt-2">
    <?php
        $tabs = ['Profile', 'Projects', 'Tasks', 'Leaves', 'Timesheet', 'Ticket', 'ShiftRoster', 'Permissions', 'Activity'];
    ?>

    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item">
            <button class="nav-link RemoveActive <?php if(session('TabViews') == $tab): ?> active <?php endif; ?>"
                    onclick="Tab('<?php echo e($tab); ?>', <?php echo e($id); ?>, '<?php echo e($tab); ?>')"
                    value="<?php echo e($tab); ?>" id="<?php echo e($tab); ?>">
                <?php echo e($tab); ?>

            </button>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
  <button class="btn btn-label-primary" style="margin:11px 1px 28px;" onclick="EditEmployee(<?php echo e(Auth::user()->id); ?>)"><i class="fas fa-edit"></i></button>
  </div>

      <div id="TBView">
          
      </div>
</div>
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog"></div>

   <?php if(session('TabViews')): ?>
    <script>
      window.onload = function() {
    var tabs = "<?php echo e(session('TabViews')); ?>";
    if (tabs) {
        Tab(tabs, <?php echo e($id); ?>, tabs);
    }
}
    </script>
<?php endif; ?>
<script type="text/javascript">
  
  function Tab(value, id, Activeid) {
    // Remove 'active' class from all buttons
    $('.nav-link').removeClass('active');

    // Add 'active' class to the clicked button
    $('#' + Activeid).addClass('active');

    // AJAX request to load tab content
    $.ajax({
        url: "<?php echo e(url('Employee/MyProfile/TabView')); ?>",
        method: 'GET',
        data: { type: value, id: id },
        success: function (response) {
            $('#TBView').html(response);
        },
        error: function () {
            // Handle error if needed
        }
    });
}

function EditEmployee(id)
{
    $.ajax({
        url: "<?php echo e(url('Employee/MyProfile/edit')); ?>",
        method: 'GET',
        data: { id: id },
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

</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/Employee/MyProfile/index.blade.php ENDPATH**/ ?>