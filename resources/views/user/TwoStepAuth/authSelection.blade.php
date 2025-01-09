@php 
$AppSetting =  \App\Models\AppSetting::select('CompanyLogo','CompanyBanner','welcometext')->where('id','1')->first(); 
@endphp
<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{url('public/assets/')}}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
 <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Client: Identity Verification</title>

    <meta name="description" content="" />

    <!-- Favicon -->
     <link rel="icon" type="image/x-icon" href="{{url('public/logo/favicon.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
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
    <script src="{{url('public/assets/vendor/js/template-customizer.js')}}"></script>
    <script src="{{url('public/assets/js/config.js')}}"></script>
    <script src="https://kit.fontawesome.com/601f457ea1.js" crossorigin="anonymous"></script>
    <style>
       @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .spinner {
            animation: rotate 1s linear infinite;
        }
        .qr-code {
            display: none; /* Initially hidden */
            margin-top: 20px;
        }
        body {

            font-family: "Montserrat", sans-serif;


        }

        .auth-cover-bg {
            background-image: url('{{$AppSetting->CompanyBanner}}');;
            background-size: cover;
        }

        .ql-tooltip,
        .ql-hidden,
        .ql-clipboard {
            display: none;
        }

        :root {
            --black: #ffffff;
            --white: #ffffff;
            --primary: #7367f0;
        }


        h1 {
            font-size: 3rem;
            line-height: 1;
            font-weight: 700;
            margin: 0 0 3rem;
            color: var(--black);
            text-align: center;
        }

        .wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
        }

        .button:hover {

            color: white;
        }

        .button {
            position: relative;
            border: 0;
            transition: 0.5s;
            z-index: 1;
            min-width: 15rem;
            padding: 1rem 2rem;
            font-size: 0.867rem;
            line-height: 1;

            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-transform: uppercase;
            background: var(--black);
            color: #5D596C;

            &:before,
            &:after {
                content: "";
                position: absolute;
                z-index: -1;
            }


            &.--shine {
                overflow: hidden;

                &:after {
                    height: 100%;
                    width: 0;
                    left: -25%;
                    top: 0;
                    color: white;
                    background: var(--primary);
                    transform: skew(50deg);
                    transform-origin: top left;
                    transition: 0.5s;
                }

                &:hover {
                    &:after {
                        width: 125%;
                        color: white;
                    }
                }
            }
        }






        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 var(--black);
            }

            50% {
                box-shadow: 0 0 10px var(--black);
            }

            100% {
                box-shadow: 0 0 0 var(--black);
            }
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
                         <a href="{{url('/admin')}}" class="app-brand-link">
                            <img width="100%" src="{{$AppSetting->CompanyLogo}}">
                        </a>
                    </div>
                    <!-- /Logo -->
                    @if($_REQUEST && $_REQUEST['user'] && $_REQUEST['email'] && $_REQUEST['token'])
                    @php 
                        Session::put('user_id',$_REQUEST['user']);

                    @endphp
                    <input type="hidden" value="{{ $_REQUEST['user'] }}" name="validated_user_id" class="validated_user_id">
                    <input type="hidden" value="{{ $_REQUEST['email'] }}" name="validated_email" class="validated_email">
                    <input type="hidden" value="{{ $_REQUEST['token'] }}" name="validated_token" class="validated_token">
                    @else
                    <input type="hidden" value="0" name="validated_user_id" class="validated_user_id">
                    <input type="hidden" value="0" name="validated_email" class="validated_email">
                    <input type="hidden" value="0" name="validated_token" class="validated_token">
                    @endif
                    <h3 class="mb-1" style="font-weight: 400;">Select Your Preferred Authentication Method</h3>
                    <span class="mb-4">Please select how you'd like to receive your One-Time Password (OTP) for added security:</span>
                     @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <h4 class="mb-3 mt-4" style="font-size: 18px;">Select Payment Method Type:</h4>
                    <form id="authForm" action="{{url('admin/TwoStepMethod')}}" method="post">
                        @csrf
                        <input type="hidden" id="authMethod" name="authMethod" value="">
                    <div class="row">
                        <a href="javascript::void(0);">
                            <div  id="razorpayButton" class="col-12 mb-3 button --shine d-flex"
                                style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;border-radius: 6px;justify-content: space-between;padding:0.3rem 2rem;">
                                <div class="inner_frst"  id="emailButton" style="align-self: center;"><span>OTP via Email </span><i
                                        class="fa-solid fa-arrow-right" style="margin-left:22px;"></i></div>
                                <div class="inner_scnd" ><img
    src="https://upload.wikimedia.org/wikipedia/commons/4/4e/Gmail_Icon.png"
    style="width:50px;">
</div>
                            </div>
                        
                            <div class="col-12 mb-4 button --shine d-flex"
                                style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;border-radius: 6px;justify-content: space-between;">
                                <div class="inner_frst" id="qrCodeButton" style="align-self: center;"><span>OTP via Google Authenticator</span><i
                                        class="fa-solid fa-arrow-right" style="margin-left:22px;"></i></div>
                                <div class="inner_scnd"><img
    src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Google_Authenticator_icon.png/1200px-Google_Authenticator_icon.png"
    style="width:50px;">
</div>

                            </div>
                    </div>
    </form>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div id="messageContainer"></div>
                        </div>
                    </div>

                </div>
               
            </div>
            <!-- /Login -->
        </div>
       
    </div>
<div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Two Factor Authentication</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align:center">
         <!-- QR Code Section -->
                    <div id="qrCode" class="qr-code">
                        <p>Scan the QR code below:</p>
                        <img id="qrCodeImage" src="" alt="QR Code" />
                    </div>
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      <!--</div>-->
    </div>
  </div>
</div>    <!-- / Content -->

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

  <script type="text/javascript">
 $(document).ready(function() {
    $('#emailButton').on('click', function() {
        $('#authMethod').val('email');
        $('#authForm').submit(); // Submit the form via email
    });

    $('#qrCodeButton').on('click', function() {
        $('#authMethod').val('2faGoogle');
         $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
        $.ajax({
            url: "{{url('admin/TwoStepMethod')}}", // Adjust URL as needed
            type: 'POST',
             data: {
                authMethod: '2faGoogle',
              },
            success: function(response) {
                $('#qrCode').html(response);
                        $('#qrCode').show();
                        $('.modal').show();

            },
            error: function(xhr, status, error) {
                console.error('Error fetching QR code:', error);
            }
        });
    });
});

    </script>

    <script>
        $(document).ready(function () {
            $('.alert-success').fadeOut(5000);
            $('.alert-danger').fadeOut(5000);
        });
    </script>
</body>

</html>