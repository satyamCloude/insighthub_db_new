<?php $__env->startSection('title', 'Advanced'); ?>
<?php $__env->startSection('content'); ?>
<style>
    .table-height{
        height: 400px;
        /*overflow-y:scroll;*/
    }
    .table-height .card-body{
        padding:unset!important;
        overflow-y:scroll;
    }
</style>
<script>
    //first
 let cardColor, labelColor, headingColor, borderColor, legendColor;

    cardColor = config.colors.cardColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    headingColor = config.colors.headingColor;
    borderColor = config.colors.borderColor;


  // Donut Chart Colors
  const chartColors = {
    donut: {
      series1: config.colors.success,
      series2: '#28c76fb3',
      series3: '#28c76f80',
      series4: config.colors_label.success
    }
  };
</script>
<div class="container-xxl flex-grow-1 container-p-y">
    <ul class="nav nav-pills flex-column flex-md-row mb-4 mt-2">
    <?php
        $tabs = ['Overview', 'Project', 'Client', 'HR', 'Ticket', 'Sales'];
    ?>

    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item">
            <button class="nav-link RemoveActive <?php if(session('TabViews') == $tab): ?> active <?php endif; ?>"
                    onclick="Tab('<?php echo e($tab); ?>', '<?php echo e($tab); ?>')"
                    value="<?php echo e($tab); ?>" id="<?php echo e($tab); ?>">
                <?php echo e($tab); ?>

            </button>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

      <div id="TBView">
          
      </div>
</div>
   <?php if(session('TabViews')): ?>
    <script>
      window.onload = function() {
    var tabs = "<?php echo e(session('TabViews')); ?>";
    if (tabs) {
        Tab(tabs, tabs);
    }
}
    </script>
<?php endif; ?>
<script type="text/javascript">
  
  function Tab(value, Activeid) {
    // Remove 'active' class from all buttons
    var filter = $('#filter').val();
    var filter2 = $('#filter2').val();
    // console.log(filter);
  
    $('.nav-link').removeClass('active');

    // Add 'active' class to the clicked button
    $('#' + Activeid).addClass('active');

    // AJAX request to load tab content
    $.ajax({
        url: "<?php echo e(url('admin/Dashboard/TabView')); ?>",
        method: 'GET',
        data: { 
            type: value,
            filter: filter,
            filter2: filter2,
        },
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/dashboard/Advanced.blade.php ENDPATH**/ ?>