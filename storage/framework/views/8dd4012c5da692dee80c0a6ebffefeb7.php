<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?php echo e(url('public/assets/')); ?>/"
  data-template="vertical-menu-template">
<?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <div class="layout-page">
            <?php echo $__env->make('includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <div class="content-backdrop fade"></div>
          </div>
          </div>
    </div>
    <!-- Overlay --> 
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
  </div>
</body>
</html>
<?php /**PATH /home/insighthub/public_html/resources/views/layouts/admin.blade.php ENDPATH**/ ?>