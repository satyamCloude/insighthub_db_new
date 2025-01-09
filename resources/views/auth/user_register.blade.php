@php $AppSetting =  \App\Models\AppSetting::select('CompanyLogo','welcometextClient','CompanyBannerClient')->where('id','1')->first() @endphp
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Client : Register</title>
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{csrf_token()}}">
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
        background-image: url('{{$AppSetting->CompanyBannerClient}}');
        background-size: cover;
      }
      .ql-tooltip ,.ql-hidden ,.ql-clipboard{
        display: none;
      }
    </style>
    @endif
    <style>
        #welcometext {
            pointer-events: none;
            user-select: none;
        }
    </style>
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
                <!-- <a href="{{url('/admin')}}" class="app-brand-link"> -->
                    @if($AppSetting)
                  <img width="100%" src="{{$AppSetting->CompanyLogo}}">
                  @endif
                <!-- </a> -->
              </div>
              <!-- /Logo -->
             
              
        <span class="mb-4" id="welcometext">@if($AppSetting){!!$AppSetting->welcometextClient!!}@endif </span>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#welcometext').on('keydown paste', function(e) {
                    e.preventDefault();
                });
                $('#welcometext').on('mousedown', function(e) {
                    e.preventDefault();
                });
                $('#welcometext').on('selectstart', function(e) {
                    e.preventDefault();
                });
            });
        </script>

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
            <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter your First Name" autofocus />
            <span class="text-danger" id="err_fname"></span>
          </div>
          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter your Last Name" autofocus />
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
            <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Enter your Company Name" />
            <span class="text-danger" id="err_comp"></span>
          </div>
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
                I agree to <a href="javascript:void(0);" data-toggle="modal" data-target="#privacyModal">privacy policy & terms</a>
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
            <!-- <div class="divider my-4">
              <div class="divider-text">or</div>
            </div> -->

            <div class="d-flex justify-content-center">
                  <!-- <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                    <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                  </a> -->
                  
                  <!--<a href="{{url('login/microsoft')}}" class="btn btn-primary btn-sm me-3">-->
                  <!-- <i class="fab fa-microsoft"></i>-->
                  <!--</a>-->

                  <!-- mycode -->
                <!-- <a href="{{url('login/microsoft')}}" class="btn btn-icon  me-3">
                      <img src="{{ asset('public/images/micro.png') }}" alt="MicroSoft Login" class="fs-5" height="35" />
                  </a>
                <a href="{{url('/login/google')}}" class="btn btn-icon  me-3">
                  <img src="{{ asset('public/images/googlelogin3.png') }}" alt="Google Login" class="fs-5" height="40" width="40"/>
                </a> -->


              <!-- <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                <i class="tf-icons fa-brands fa-twitter fs-5"></i>
              </a> -->
            </div>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
  <!-- / Content -->

  <!-- Privacy Policy Modal -->
  <div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="privacyModalLabel">Privacy Policy & Terms</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Include your privacy policy content here -->
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Privacy Policy Modal -->

  <!-- Core JS -->
  <!-- Include jQuery and Bootstrap JS in the correct order -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    $(document).ready(function() {
      $('#privacyModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);
        // If necessary, you can update the modal content here
      });
    });
</script>
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

  // Client-side validation
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

  $.ajax({
    type: 'POST',
    url: "{{ url('/Uregister') }}",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
      first_name: fname,
      last_name: lname,
      email: email,
      phone_number: phone,
      company_name: company,
      password: pass,
      password_confirmation: cpass,
      terms: terms
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
    error: function(xhr) {
      if (xhr.status == 422) {
        var errors = xhr.responseJSON.errors;
        if (errors.first_name) {
          $('#err_fname').text(errors.first_name[0]);
        }
        if (errors.last_name) {
          $('#err_lname').text(errors.last_name[0]);
        }
        if (errors.phone_number) {
          $('#err_phone').text(errors.phone_number[0]);
        }
        if (errors.email) {
          $('#err_email').text(errors.email[0]);
        }
        if (errors.company_name) {
          $('#err_comp').text(errors.company_name[0]);
        }
        if (errors.password) {
          $('#err_pass').text(errors.password[0]);
        }
        if (errors.password_confirmation) {
          $('#err_cpass').text(errors.password_confirmation[0]);
        }
        if (errors.terms) {
          $('#err_terms').text(errors.terms[0]);
        }
      } else {
        console.log('Something Went Wrong');
      }
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