<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{url('public/assets')}}/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Two Steps Verifications</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('public/logo/favicon.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{url('public/assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/fonts/tabler-icons.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{url('public/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/page-auth.css')}}" />

    <!-- Helpers -->
    <script src="{{url('public/assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{url('public/assets/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{url('public/assets/js/config.js')}}"></script>
    <!-- Add this overlay HTML somewhere in your page -->
  <style>
    /* Define a CSS animation for rotation */
    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Apply the rotation animation to the spinner */
    .spinner {
        animation: rotate 1s linear infinite;
    }
</style>
  </head>

  <body>
    <div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color:  rgb(0 0 0 / 66%); z-index: 9999;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white;">
        Loading... &nbsp;&nbsp; <i class="fa-solid fa-spinner spinner"></i>
    </div>
</div>
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover authentication-bg">
      <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="{{url('public/assets/img/illustrations/auth-two-step-illustration-light.png')}}"
              alt="auth-two-steps-cover"
              class="img-fluid my-5 auth-illustration"
              data-app-light-img="illustrations/auth-two-step-illustration-light.png"
              data-app-dark-img="illustrations/auth-two-step-illustration-dark.png" />

            <img
              src="{{url('public/assets/img/illustrations/bg-shape-image-light.png')}}"
              alt="auth-two-steps-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" />
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Two Steps Verification -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-4 p-sm-5">
          <div class="w-px-400 mx-auto">
            <!-- Logo -->
            <div class="app-brand mb-4">
              <a href="{{url('admin/TwoStepOtp')}}" class="app-brand-link gap-2">
                <!-- Logo -->
                <div class="app-brand justify-content-center mb-4 mt-2">
                  <a href="#" class="app-brand-link">
                    <img width="20%" src="{{url('public/logo/company.png')}}">
                  </a>
                </div>
                <!-- /Logo -->
              </a>
            </div>
            <!-- /Logo -->
          


          @if(Session::has('success'))
              <div class="alert alert-success hidemsg">{{ Session::get('success') }}</div>
              @php
                  Session::forget('success');
              @endphp
          @endif

          @if(Session::has('error'))
              <div class="alert alert-danger hidemsg">{{ Session::get('error') }}</div>
              @php
                  Session::forget('error');
              @endphp
          @endif
           <div>
            <h4 class="mb-1">Two Step Verification 📱</h4>
            <p class="text-start mb-4">
              Enter the code generated by your authenticator app on your phone in the field below.
            </p>
            <p class="mb-0 fw-medium">Enter the 6-digit authentication code:</p>
            <form id="twoStepsForm" action="{{ url('2fa/admin-verify') }}" method="POST">
              @csrf
              <div class="mb-3">
                <div class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                  <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" autofocus required>
                  <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" required>
                  <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" required>
                  <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" required>
                  <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" required>
                  <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" required>
                </div>
                <!-- Create a hidden field which is combined by 3 fields above -->
                <input type="hidden" id="combinedCode" name="two_factor_recovery_codes" />
              </div>
              <button type="submit" class="btn btn-primary d-grid w-100 mb-3">Verify Code</button>
            </form>
          </div>
          </div>
        </div>
        <!-- /Two Steps Verification -->
      </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{url('public/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{url('public/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/node-waves/node-waves.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
    <script src="{{url('public/assets/vendor/js/menu.js')}}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{url('public/assets/vendor/libs/cleavejs/cleave.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>

    <!-- Main JS -->
    <script src="{{url('public/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{url('public/assets/js/pages-auth.js')}}"></script>
    <script src="{{url('public/assets/js/pages-auth-two-steps.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.auth-input').on('input', function() {
          var combinedValue = '';
          $('.auth-input').each(function() {
            combinedValue += $(this).val();
          });
          $('#combinedCode').val(combinedValue);
        });
      });
    </script>

  </body>
</html>
