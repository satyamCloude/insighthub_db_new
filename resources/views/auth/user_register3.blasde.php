@php $AppSetting =  \App\Models\AppSetting::select('CompanyLogo','CompanyBanner','welcometext')->where('id','1')->first() @endphp
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{url('public/assets/')}}/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Client : Register</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
 <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
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
    @if($AppSetting)
    <style>
      .auth-cover-bg{
        background-image: url('{{$AppSetting->CompanyBanner}}');
        background-size: cover;
      }
      .ql-tooltip ,.ql-hidden ,.ql-clipboard{
        display: none;
      }
    </style>
    @endif
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
              <div class="app-brand justify-content-center mb-4 mt-2">
                @if($AppSetting)
                <!-- <a href="{{url('/admin')}}" class="app-brand-link"> -->
                  <img width="100%" src="{{$AppSetting->CompanyLogo}}">
                <!-- </a> -->
                @endif
              </div>
              <!-- /Logo -->
              @if($AppSetting)
              <span class="mb-4" id="welcometext">{!!$AppSetting->welcometext!!}</span>
              @endif
               @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                  <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="firstName"
                      name="first_name"
                      placeholder="Enter your First Name"
                      autofocus
                       />
                      <span class="text-danger" id="err_fname"></span>
                    </div>
                    <div class="mb-3">
                      <label for="lastName" class="form-label">Last Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="lastName"
                        name="last_name"
                        placeholder="Enter your Last Name"
                        autofocus
                         />
                         <span class="text-danger" id="err_lname"></span>
                    </div>
                   <div class="mb-3">
                              <label for="phone" class="form-label">Phone</label>
                              <input type="text" class="form-control" id="phone" name="phone_number" placeholder="Enter your Phone" maxlength="10" minlength="10" />
                              <span class="text-danger" id="err_phone"></span>
                            </div>


                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" />
                      <span class="text-danger" id="err_email"></span>
                    </div>
                    <div class="mb-3">
                      <label for="companyName" class="form-label">Company Name</label>
                      <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Enter your Company Name"  />
                      <span class="text-danger" id="err_comp"></span>
                    </div>
                    <!-- <div class="mb-3 form-password-toggle">
                      <label class="form-label" for="password">Password</label>
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
                    <div class="mb-3 form-password-toggle">
                      <label class="form-label" for="confpassword">Confirm Password</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="password"
                          id="confpassword"
                          class="form-control"
                          name="confirmed"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div> -->

                     <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>

        </div>
        <span class="text-danger" id="err_pass"></span>
    </div>
    <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password_confirmation">Confirm Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
        <span class="text-danger" id="err_cpass"></span>
    </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                  <label class="form-check-label" for="terms-conditions">
                    I agree to
                   <a href="javascript:void(0);" data-toggle="modal" data-target="#privacyModal">privacy policy & terms</a>

                  </label>
                   <span class="text-danger" id="err_terms"></span>
                </div>
              </div>
              <button class="btn btn-primary d-grid w-100" id="my_reg_form">Sign up</button>

            <p class="text-center">
              <span>Already have an account?</span>
              <a href="{{url('/')}}">
                <span>Sign in instead</span>
              </a>
            </p>
            <div class="divider my-4">
              <div class="divider-text">or</div>
            </div>

            <div class="d-flex justify-content-center">
              <!-- <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
              </a> -->
              
              <a href="{{url('login/microsoft')}}" class="btn btn-primary btn-sm me-3">
               <i class="fab fa-microsoft"></i>
              </a>

              <a href="{{url('/login/google')}}" class="btn btn-icon btn-label-google-plus me-3">
                <i class="tf-icons fa-brands fa-google fs-5"></i>
              </a>

              <!-- <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                <i class="tf-icons fa-brands fa-twitter fs-5"></i>
              </a> -->
            </div>
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="privacyModalLabel">Privacy Policy & Terms</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
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
    <script src="{{url('public/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
    <script src="{{url('public/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>

    <!-- Main JS -->
    <script src="{{url('public/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{url('public/assets/js/pages-auth.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>

    <script>
    $(document).ready(function() {
      $('.alert-success').fadeOut(5000);
      $('.alert-danger').fadeOut(5000);
    });
  </script>

  <script>
// Restrict input to digits only
$('#phone').on('keypress', function (e) {
  if (e.which < 48 || e.which > 57) {
    return false;
  }
});

// Form submission handling
$(document).on('click', '#my_reg_form', function() {
  var fname = $('#firstName').val();
  var lname = $('#lastName').val();
  var phone = $('#phone').val();
  var email = $('#email').val();
  var company = $('#companyName').val();
  var pass = $('#password').val();
  var cpass = $('#password_confirmation').val();
  var terms = $('#terms-conditions').prop('checked');

  // Clear previous errors
  $('.text-danger').text('');

  // Performing client-side validation
  if (fname == '') {
    $('#err_fname').text('* First name is required');
    return;
  }
  if (lname == '') {
    $('#err_lname').text('* Last name is required');
    return;
  }
  if (phone == '') {
    $('#err_phone').text('* Phone number is required');
    return;
  }
  if (!phone.match(/^\d{10}$/)) {
    $('#err_phone').text('* Phone number must be exactly 10 digits');
    return;
  }
  if (email == '') {
    $('#err_email').text('* Email is required');
    return;
  }
  if (company == '') {
    $('#err_comp').text('* Company name is required');
    return;
  }
  if (!terms) {
    $('#err_terms').text('* Terms and conditions are required');
    return;
  }
  if (pass == '') {
    $('#err_pass').text('* Password is required');
    return;
  }
  if (!pass.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/)) {
    $('#err_pass').text('* Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character');
    return;
  }
  if (cpass != pass) {
    $('#err_cpass').text('* Confirm password should match');
    return;
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: 'POST',
    url: "{{ url('/register') }}",
    data: {
      first_name: fname,
      last_name: lname,
      email: email,
      phone_number: phone,
      company_name: company,
      password: pass,
    },
    success: function(response) {
      if (response.status == 400) {
        $('#err_email').text(response.message.email);
      } else {
        var email = response.user.email;
        var id = response.user.id;
        var url = "{{ url('/google/resend_varification_email/') }}/" + email + "/" + id;
        window.location.href = url;
      }
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText.message.email);
    }
  });
});

</script>
<script>
$(document).ready (function () {
  $("#formAuthentication").validate ();
});
</script>
  </body>
</html>
