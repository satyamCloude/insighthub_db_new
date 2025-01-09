<?php $AppSetting =  \App\Models\AppSetting::select('CompanyLogo','CompanyBanner','welcometext')->where('id','1')->first() ?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?php echo e(url('public/assets/')); ?>/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin : Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(url('public/logo/favicon.png')); ?>" />

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
    <!-- Vendor -->
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/libs/@form-validation/umd/styles/index.min.css')); ?>" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?php echo e(url('public/assets/vendor/css/pages/page-auth.css')); ?>" />

    <!-- Helpers -->
    <script src="<?php echo e(url('public/assets/vendor/js/helpers.js')); ?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?php echo e(url('public/assets/vendor/js/template-customizer.js')); ?>"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo e(url('public/assets/js/config.js')); ?>"></script>
    <?php if($AppSetting): ?>
    <style>
      .auth-cover-bg{
        background-image: url('<?php echo e($AppSetting->CompanyBanner); ?>');
        background-size: cover;
      }
      .ql-tooltip ,.ql-hidden ,.ql-clipboard{
        display: none;
      }
      
      
  
      
    </style>
    <?php endif; ?>
  </head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
      <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center"></div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
          <div class="w-px-400 mx-auto">

            <!-- Logo -->
          
           <!-- Logo -->
<div class="app-brand justify-content-center mb-4 mt-2">
    <?php if($AppSetting): ?>
    <img width="100%" src="<?php echo e($AppSetting->CompanyLogo); ?>" alt="Company Logo">
    <?php endif; ?>
</div>
<!-- /Logo -->

<!-- Welcome Text -->
<span class="mb-4" id="welcometext" contenteditable="false" style="user-select: none;">
    <?php if($AppSetting): ?>
    <?php echo $AppSetting->welcometext; ?>

    <?php endif; ?>
</span>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery to prevent interaction -->
<script>
    $(document).ready(function(){
        $('#welcometext').on('keydown paste mousedown selectstart', function(e) {
            e.preventDefault();
        });
    });
</script>


              <?php if(Session::has('message')): ?>
              <div class="alert alert-success"><?php echo e(Session::get('message')); ?></div>
              <?php endif; ?>
              <?php if(Session::has('error')): ?>
              <div class="alert alert-danger"><?php echo e(Session::get('error')); ?></div>
              <?php endif; ?>
            <form id="formAuthentication" class="mb-3" action="<?php echo e(url('admin_Login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                  <label for="email" class="form-label">Email or Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email or username"
                    autofocus />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <!-- <a href="#">
                      <small>Forgot Password?</small>
                    </a> -->
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>
            <!-- <div class="divider my-4">
              <div class="divider-text">or</div>
            </div> -->

            <div class="d-flex justify-content-center">
             <!--  <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
              </a> -->
   <!-- <a href="<?php echo e(url('/admin/google')); ?>" class="btn btn-icon btn-label-google-plus me-3">
                <i class="tf-icons fa-brands fa-google fs-5"></i>
              </a> -->

             <!--  <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                <i class="tf-icons fa-brands fa-twitter fs-5"></i>
              </a> -->
            </div>
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

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
    <script src="<?php echo e(url('public/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')); ?>"></script>

    <!-- Main JS -->
    <script src="<?php echo e(url('public/assets/js/main.js')); ?>"></script>

    <!-- Page JS -->
    <script src="<?php echo e(url('public/assets/js/pages-auth.js')); ?>"></script>

    <script>
    $(document).ready(function() {
      $('.alert-success').fadeOut(5000);
      $('.alert-danger').fadeOut(5000);
    });
  </script>
  </body>
</html>
<?php /**PATH /home/insighthub/public_html/resources/views/auth/admin_login.blade.php ENDPATH**/ ?>