<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Error - 404</title>

    <meta name="description" content="" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/fonts/fontawesome.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/fonts/tabler-icons.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/fonts/flag-icons.css')); ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/css/rtl/core.css')); ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/css/rtl/theme-default.css')); ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo e(url('public/assets/css/demo.css')); ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/libs/node-waves/node-waves.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/libs/typeahead-js/typeahead.css')); ?>" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/css/pages/page-misc.css')); ?>" />

    <!-- Helpers -->
    <script src="<?php echo e(url('public/assets/vendor/js/helpers.js')); ?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?php echo e(url('public/assets/vendor/js/template-customizer.js')); ?>"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo e(url('public/assets/js/config.js')); ?>"></script>
  </head>

  <body>
    <!-- Content -->

    <!-- Error -->
    <div class="container-xxl container-p-y">
      <div class="misc-wrapper">
        <h2 class="mb-1 mt-4">Page Not Found :(</h2>
        <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
        <a href="<?php echo e(url('/')); ?>" class="btn btn-primary mb-4">Back to home</a>
        <div class="mt-4">
          <img
            src="<?php echo e(url('public/assets/img/illustrations/page-misc-under-maintenance.png')); ?>"
            alt="page-misc-error"
            width="225"
            class="img-fluid" />
        </div>
      </div>
    </div>
    <div class="container-fluid misc-bg-wrapper">
      <img
        src="<?php echo e(url('public/assets/img/illustrations/bg-shape-image-light.png')); ?>"
        alt="page-misc-error"
        data-app-light-img="illustrations/bg-shape-image-light.png"
        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
    </div>
    <!-- /Error -->

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="<?php echo e(url('public/assets/vendor/libs/jquery/jquery.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/popper/popper.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/js/bootstrap.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/node-waves/node-waves.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/hammer/hammer.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/i18n/i18n.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/typeahead-js/typeahead.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/js/menu.js')); ?>"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?php echo e(url('public/assets/js/main.js')); ?>"></script>

    <!-- Page JS -->
  </body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/insighthub_db/resources/views/errors/404.blade.php ENDPATH**/ ?>