<?php $__env->startSection('title', 'Employee'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <ul class="nav nav-pills flex-column flex-md-row mb-4 mt-2">
    <?php
        $tabs = ['Profile','KRA','Permissions', 'Activity'];
    ?>

    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item">
            <button class="nav-link <?php if($key == 0): ?> active <?php endif; ?>"
                    onclick="Tab('<?php echo e($tab); ?>', <?php echo e($id); ?>, '<?php echo e($tab); ?>')"
                    value="<?php echo e($tab); ?>" id="<?php echo e($tab); ?>">
                <?php echo e($tab); ?>

            </button>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

      <div id="TBView">
          
      </div>
</div>

<script type="text/javascript">
  
   Tab('Profile', '<?php echo e($id); ?>', 'Profile');

  function Tab(value, id, Activeid) {
    // Remove 'active' class from all buttons
    $('.nav-link').removeClass('active');

    // Add 'active' class to the clicked button
    $('#' + Activeid).addClass('active');

    // AJAX request to load tab content
    $.ajax({
        url: "<?php echo e(url('admin/Employee/TabView')); ?>",
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

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/Humanesources/Employee/view.blade.php ENDPATH**/ ?>