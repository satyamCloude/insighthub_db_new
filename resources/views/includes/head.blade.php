    <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/core-dark.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{url('public/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/swiper/swiper.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/dropzone/dropzone.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/toastr/toastr.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/animate-css/animate.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/spinkit/spinkit.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/quill/typography.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/quill/katex.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/quill/editor.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/fullcalendar/fullcalendar.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/flatpickr/flatpickr.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/jquery-timepicker/jquery-timepicker.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/libs/pickr/pickr-themes.css')}}" />


<link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/wizard-ex-checkout.css')}}" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/cards-advance.css')}}" />

    <link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/page-user-view.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/app-calendar.css')}}" />
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/app-email.css')}}" />
     <!-- Page CSS -->
    <link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/app-chat.css')}}" />
    <!-- Helpers -->
    <script src="{{url('public/assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{url('public/assets/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{url('public/assets/js/config.js')}}"></script>

    <link rel="stylesheet" href="{{url('resources/css/app.css')}}" />
    <script src="{{url('resources/js/app.js')}}"></script>


    <!-- Addition js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootbox@6.0.0/dist/bootbox.min.js"></script>

    <style type="text/css">
      .ql-tooltip, .ql-hidden{
        display: none !important;
      }
      body table,.text-muted ,.layout-wrapper,.menu-vertical{
        color:black !important;
      }
      
      
      
      
           /* Custom scrollbar for .card-body */
.card::-webkit-scrollbar {
    width: 10px; /* Width of the scrollbar */
    height: 10px; /* Height of the horizontal scrollbar */
}

.card::-webkit-scrollbar-track {
    background: #f1f1f1; /* Color of the track (scrollbar background) */
}

.card::-webkit-scrollbar-thumb {
    background-color: #a39bf3; /* Color of the scrollbar thumb */
    border-radius: 10px;    /* Roundness of the scrollbar thumb */
    border: 2px solid #f1f1f1; /* Padding around the thumb */
} 
   
     
     
     
     /* Custom scrollbar for .card-body */
.card-body::-webkit-scrollbar {
    width: 10px; /* Width of the scrollbar */
    height: 10px; /* Height of the horizontal scrollbar */
}

.card-body::-webkit-scrollbar-track {
    background: #f1f1f1; /* Color of the track (scrollbar background) */
}

.card-body::-webkit-scrollbar-thumb {
    background-color: #a39bf3; /* Color of the scrollbar thumb */
    border-radius: 10px;    /* Roundness of the scrollbar thumb */
    border: 2px solid #f1f1f1; /* Padding around the thumb */
} 
      
      
      
           /* Custom scrollbar for .card-body */
.nav::-webkit-scrollbar {
    width: 10px; /* Width of the scrollbar */
    height: 10px; /* Height of the horizontal scrollbar */
}

.nav::-webkit-scrollbar-track {
    background: #f1f1f1; /* Color of the track (scrollbar background) */
}

.nav::-webkit-scrollbar-thumb {
    background-color: #a39bf3; /* Color of the scrollbar thumb */
    border-radius: 10px;    /* Roundness of the scrollbar thumb */
    border: 2px solid #f1f1f1; /* Padding around the thumb */
} 



           /* Custom scrollbar for .card-body */
.table-responsive::-webkit-scrollbar {
    width: 10px; /* Width of the scrollbar */
    height: 10px; /* Height of the horizontal scrollbar */
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1; /* Color of the track (scrollbar background) */
}

.table-responsive::-webkit-scrollbar-thumb {
    background-color: #a39bf3; /* Color of the scrollbar thumb */
    border-radius: 10px;    /* Roundness of the scrollbar thumb */
    border: 2px solid #f1f1f1; /* Padding around the thumb */
} 
      
      
      
    </style>
  @yield('css')
  </head>
  @php
    $employee_detail  = DB::table('employee_details')->where('user_id',Auth::user()->id)->first();
  @endphp

  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<!-- Your custom JavaScript code -->
<script>
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
    cluster: "{{env('PUSHER_APP_CLUSTER')}}"
});

@if($employee_detail && $employee_detail->department_id)
    var channel = pusher.subscribe('cloud-techtiq-' + "{{$employee_detail->department_id}}");
    channel.bind('app-event', function(data) {
        bootbox.alert({
            message: data.message,
            centerVertical: true, // Center the modal vertically
            callback: function() {
                // Reload the page after the alert is dismissed
                location.reload();
            }
        });
    });
@else
    console.log('Error: Department ID does not exist for the current user.');
@endif

    
    @if($employee_detail && $employee_detail->user_id)
        var channel = pusher.subscribe('user-id-'+"{{$employee_detail->user_id}}");
        channel.bind('single-event', function(data) {
          bootbox.alert({
            message: data.message,
            centerVertical: true // Center the modal vertically
          });
        });
    @else
        console.log('Error: Department ID does not exist for the current user.');
    @endif
</script>
