<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{url('public/assets/')}}/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Pricing - Pages</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('public/logo/favicon.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
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

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/page-pricing.css')}}" />

    <!-- Helpers -->
    <script src="{{url('public/assets/vendor/js/helpers.js')}}"></script>
    
    <script src="{{url('public/assets/vendor/js/template-customizer.js')}}"></script>
  
    <script src="{{url('public/assets/js/config.js')}}"></script>
 <style>
  .navbar-nav .nav-link {
  color: #fff;
}
.dropend .dropdown-toggle {
  color: salmon;
  margin-left: 1em;
}
.dropdown-item:hover {
  background-color: lightsalmon;
  color: #fff;
}
.dropdown .dropdown-menu {
  display: none;
}
.dropdown:hover > .dropdown-menu,
.dropend:hover > .dropdown-menu {
  display: block;
  margin-top: 0.125em;
  margin-left: 0.125em;
}
@media screen and (min-width: 769px) {
  .dropend:hover > .dropdown-menu {
    position: absolute;
    top: 0;
    left: 100%;
  }
  .dropend .dropdown-toggle {
    margin-left: 0.5em;
  }
}

 </style>

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Layout container -->
        <div class="layout-page">
         
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content getProductCategory-->
<?php

 if(isset($_REQUEST['id']))
 {
  $id = $_REQUEST['id'];
 }else
 {
  $id='';
 }

        $getProduct = "{{url('/')}}/api/getProduct?id=".$id;
        $ch = curl_init($getProduct);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $apiResponse = curl_exec($ch);
        curl_close($ch);

        // Decode the JSON response
        $apiData = json_decode($apiResponse);


   
        $getProductCategory = '{{url('/')}}/api/getProductCategory';
        $chResponse = curl_init($getProductCategory);
        curl_setopt($chResponse, CURLOPT_RETURNTRANSFER, true);
        $getProductCategoryResponse = curl_exec($chResponse);
        curl_close($chResponse);
        $apiDataResponse = json_decode($getProductCategoryResponse);
       
       
        
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: salmon;">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Server & Cloud
          </a>
          @if($apiDataResponse)
          <ul class="dropdown-menu">
            @foreach($apiDataResponse->data as $dataMenu)
            <li><a class="dropdown-item" href="{{url('/pages-pricing?id='.$dataMenu->id)}}" {{$dataMenu->id == $id ? 'selected':''}}>{{$dataMenu->name}}</a></li>
            @endforeach
          </ul>
          @endif
        </li>
       
      </ul>
     
    </div>
  </div>
</nav>
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="card">
                <!-- Pricing Plans -->
                <div class="pb-sm-5 pb-2 rounded-top">
                  <div class="container py-5">
                    <h2 class="text-center mb-2 mt-0 mt-md-4">Pricing Plans</h2>
                    <p class="text-center">
                      Get started with us - it's perfect for individuals and teams. Choose a subscription plan that
                      meets your needs.
                    </p>
                    <!--<div
                      class="d-flex align-items-center justify-content-center flex-wrap gap-2 pb-5 pt-3 mb-0 mb-md-4">
                       <label class="switch switch-primary ms-3 ms-sm-0 mt-2">
                        <span class="switch-label">Monthly</span>
                        <input type="checkbox" class="switch-input price-duration-toggler" checked />
                        <span class="switch-toggle-slider">
                          <span class="switch-on"></span>
                          <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Annual</span>
                      </label> -->
                      <!-- <div class="mt-n5 ms-n5 d-none d-sm-block">
                        <i class="ti ti-corner-left-down ti-sm text-muted me-1 scaleX-n1-rtl"></i>
                        <span class="badge badge-sm bg-label-primary">Save up to 10%</span>
                      </div> 
                    </div>-->
                  
                    <div class="row mx-0 gy-3 px-lg-5">
                      <!-- Basic -->

                      @if($apiData->data != '')
                       @foreach($apiData->data as $product)

                      <div class="col-md-4">
                        <div class="card border rounded shadow-none">
                          <div class="card-body">
                            <div class="my-3 pt-2 text-center">
                              <img
                                src="{{$product->product_image}}"
                                alt="Basic Image"
                                height="140" />
                            </div>
                            <h3 class="card-title text-center text-capitalize mb-1">{{$product->product_name}}</h3>
                            <!-- <p class="text-center">A simple start for everyone</p> -->
                            <div class="text-center">
                              <div class="d-flex justify-content-center">
                                <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                                <h1 class="display-4 mb-0 text-primary">{{number_format($product->recurr_inr_monthly,)}}</h1>
                                <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                              </div>
                            </div>

                            <ul class="ps-3 my-4 pt-2">
                             {!! $product->product_description !!} 
                            </ul>

                            <a href="javascript::void(0);" class="btn btn-label-success d-grid w-100"
                              >Get Started</a
                            >
                          </div>
                        </div>
                      </div>
                       @endforeach
                       @else
                       <strong>Product Not found</strong>
                       @endif
                    </div>
                   
                  </div>
                </div>
                <!--/ Pricing Plans -->
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

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
    <script src="{{url('public/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{url('public/assets//js/pages-pricing.js')}}"></script>
  </body>
</html>
