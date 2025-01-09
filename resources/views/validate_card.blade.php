@php 
$AppSetting =  \App\Models\AppSetting::select('CompanyLogo','CompanyBanner','welcometext')->where('id','1')->first(); 
@endphp
<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{url('public/assets/')}}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="ZnPYxerNHYdEcyM5WNzv6fuRfeHBBs1bZzpVIv4w">

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
                    <h3 class="mb-1" style="font-weight: 400;">Verify Your Identity</h3>
                    <span class="mb-4">In order to use DigitalOcean, you must first verify your identity with a payment
                        method. This allows us to better guard community against spammers and bots.</span>
                     @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <h4 class="mb-3 mt-4" style="font-size: 18px;">Select Payment Method Type:</h4>

                    <div class="row">
                        <a href="javascript::void(0);">
                            <div  id="razorpayButton" class="col-12 mb-3 button --shine d-flex"
                                style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;border-radius: 6px;justify-content: space-between;padding:0.3rem 2rem;">
                                <div class="inner_frst" style="align-self: center;"><span>Add a Card</span><i
                                        class="fa-solid fa-arrow-right" style="margin-left:22px;"></i></div>
                                <div class="inner_scnd"><img
                                        src="https://brandslogo.net/wp-content/uploads/2016/07/mastercard-vector-logo.png"
                                        style="width:50px;"></div>
                            </div>
                                                @php 

                        if($_REQUEST && $_REQUEST['user'] && $_REQUEST['email'] && $_REQUEST['token']){
                        Session::put('user_id',$_REQUEST['user']);
                    $user =$_REQUEST['user'];
                    $email =$_REQUEST['email'];
                    $token =$_REQUEST['token'];
                   
                    }else{
                     $user = 0;
                    $email = 0;
                    $token = 0;
                }
                $finalAmount = '100.00';
                
                @endphp
                <a href="{{ url('paypal/handle-payment-registration?type=registration&amount=' . $finalAmount.'&user='.$user) }}" id="paypalButton">
                            <div class="col-12 mb-4 button --shine d-flex"
                                style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;border-radius: 6px;justify-content: space-between;">
                                <div class="inner_frst" style="align-self: center;"><span>Connect with Paypal</span><i
                                        class="fa-solid fa-arrow-right" style="margin-left:22px;"></i></div>
                                <div class="inner_scnd"><img
                                        src="https://1000logos.net/wp-content/uploads/2021/04/Paypal-logo.png"
                                        style="width:50px;"></div>

                            </div>
                        </a>
                    </div>

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

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var razorpayButton = document.getElementById('razorpayButton');
            razorpayButton.addEventListener('click', function () {
                var price = 10;
                var PlanId = 1;
                var validated_user_id = $('.validated_user_id').val();
                var validated_email = $('.validated_email').val();
                var validated_token = $('.validated_token').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var baseUrl = "{{url('/')}}"; // Include the domain and any base path
                var callbackUrl = baseUrl + '/validateCard/razorpay/callback/' + validated_user_id + "/" + validated_email + "/" + validated_token + "/" + price;

                var options = {
                    "key": "{{ $PaymentDetail->key_id ?? 'rzp_test_905d9rOq4TKriv' }}",
                    "amount": price * 100,
                    "currency": "INR",
                    "name": "CloudTechtiq",
                    "image": "{{$PaymentDetail->logo_url ?? url('public/logo/company.png') }}",
                    "theme": {
                        "color": "{{$PaymentDetail->theme_color ?? '#3399cc'}}"
                    },
                    "callback_url": callbackUrl
                };

                options.headers = {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                };

                var rzp1 = new Razorpay(options);
                rzp1.open();
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