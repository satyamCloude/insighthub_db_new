@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<style>

  .timeline .timeline-item-primary .timeline-event {
    background-color: rgba(115, 103, 240, .1);
}

  .swiper .swiper-slide {
    padding: 2rem 0;
    text-align: center;
    font-size: 1.5rem;
    background-color: #7367f0 !important; 
    background-position: center;
    background-size: cover;
  }


/* width */
::-webkit-scrollbar {
  width: 8px;
  border-radius:8px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #a7a0e9; 
  border-radius:8px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #776cda; 
}


</style>
<link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/ui-carousel.css')}}" />
<link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/cards-advance.css')}}" />
<!-- Content -->         
<div id="toast-container" class="toast-top-right">
  <div class="toast toast-success" aria-live="polite">
    @if(Auth::user()->status == 4)
    <script>
      $(document).ready(function(){
                // alert('Your are not allowed to perform this action. first complete your profile');
                var id = {{Auth::user()->id}};
                $.ajax({
                  url: "{{url('user/MyProfile/edit')}}",
                  method: 'GET',
                  data: { id: id },
                  success: function (data) {
                    if (data && typeof data == 'string') {
                      $('#showedit').html(data);
                      $('#showedit').modal('show');
                    } else {
                      $('#showedit').html('<div>No Data Found</div>');
                      $('#showedit').modal('show');
                    }
                  },
                  error: function () {
                    $('#showedit .modal-content').html('<div>Error fetching data.</div>');
                    $('#showedit').modal('show');
                  }
                });
              });
            </script>
            @endif
            <div class="toast-progress" style="width: 0%;"></div>
            <div class="toast-message">
             <b>Hello {{Auth::user()->first_name}}</b> </br>  <i class="fas fa-hand-peace"></i>Welcome To CloudTechtiq !
           </div>
         </div>
       </div>
       <div class="container-xxl flex-grow-1 container-p-y">

         <div class="row">
          <div class="col-lg-4" >
            <div>
              <h3 class="heading-h3 mb-0 f-21 font-weight-bold">Welcome Angelina</h3>
            </div>
            <br>

            @if(Auth::user()->accountManager != '0')
            <div class="card">
      <div class="card-body">
        <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
          <img class="img-fluid" src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/illustrations/girl-with-laptop.png" alt="Card girl image" width="140">
        </div>
        <h4 class="mb-3 pb-1 text-center">Angelina Marcus</h4>
        <div class="row mb-3 g-3">
          <div class="col-6">
            <div class="d-flex">
              <div class="avatar flex-shrink-0 me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-calendar-event ti-md"></i></span>
              </div>
              <div>
                <h6 class="mb-0 text-nowrap">17 Nov 23</h6>
                <small>Date Joined</small>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex">
              <div class="avatar flex-shrink-0 me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-clock ti-md"></i></span>
              </div>
              <div>
                <h6 class="mb-0 text-nowrap">32 minutes</h6>
                <small>Current Activity</small>
              </div>
            </div>
          </div>
        </div>
        <a href="{{ url('user/MyProfile') }}" class="btn btn-primary w-100 waves-effect waves-light">View Profile</a>
      </div>
    </div>@endif
        </div>

        <div class="col-lg-8 col-sm-12">
         <div class="d-flex" style="justify-content: space-between;">
          <h6 class="text-muted mt-3">&nbsp;</h6>
        </div>
        <div class="card" style="max-height: 400px;overflow:auto;">
      <h5 class="card-header sticky-top" style="color:#5d596c;background-color: #fff">Ticket Overview</h5>
      <div class="card-body pb-0">
        <ul class="timeline pt-3">
          <li class="timeline-item pb-4 timeline-item-primary border-left-dashed">
            <span class="timeline-indicator-advanced timeline-indicator-primary">
              <i class="ti ti-send rounded-circle scaleX-n1-rtl"></i>
            </span>
            <div class="timeline-event">
              <div class="timeline-header border-bottom mb-3">
                <h6 class="mb-0">Get on the flight</h6>
                <span class="text-muted">3rd October</span>
              </div>
              <div class="d-flex justify-content-between flex-wrap mb-2">
                <div class="d-flex align-items-center">
                  <span>Charles de Gaulle Airport, Paris</span>
                  <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                  <span>Heathrow Airport, London</span>
                </div>
                <div>
                  <span>6:30 AM</span>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <img src="https://demos.pixinvent.com/vuexy-html-admin-template/assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">
                <span class="mb-0">bookingCard.pdf</span>
              </div>
            </div>
          </li>
          <li class="timeline-item pb-4 timeline-item-success border-left-dashed">
            <span class="timeline-indicator-advanced timeline-indicator-success">
              <i class="ti ti-brush rounded-circle scaleX-n1-rtl"></i>
            </span>
            <div class="timeline-event pb-3">
              <div class="timeline-header mb-sm-0 mb-3">
                <h6 class="mb-0">Design Review</h6>
                <span class="text-muted">4th October</span>
              </div>
              <p>
                Weekly review of freshly prepared design for our new
                application.
              </p>
              <div class="d-flex justify-content-between">
                <h6>New Application</h6>
                <div class="d-flex">
                  <div class="avatar avatar-xs me-2">
                    <img src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle">
                  </div>
                  <div class="avatar avatar-xs">
                    <img src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item pb-4 timeline-item-danger border-left-dashed">
            <span class="timeline-indicator-advanced timeline-indicator-danger">
              <i class="ti ti-basket rounded-circle"></i>
            </span>
            <div class="timeline-event pb-3">
              <div class="d-flex flex-sm-row flex-column">
               <!--  <img src="../../assets/img/elements/11.jpg" class="rounded me-3" alt="Shoe img" height="62" width="62"> -->
                <div>
                  <div class="timeline-header flex-wrap mb-2 mt-3 mt-sm-0">
                    <h6 class="mb-0">Sold Puma POPX Blue Color</h6>
                    <span class="text-muted">5th October</span>
                  </div>
                  <p>
                    PUMA presents the latest shoes from its collection. Light &amp;
                    comfortable made with highly durable material.
                  </p>
                </div>
              </div>
              <div class="d-flex justify-content-between flex-wrap flex-sm-row flex-column text-center">
                <div class="mb-sm-0 mb-2">
                  <p class="mb-0">Customer</p>
                  <span class="text-muted">Micheal Scott</span>
                </div>
                <div class="mb-sm-0 mb-2">
                  <p class="mb-0">Price</p>
                  <span class="text-muted">$375.00</span>
                </div>
                <div>
                  <p class="mb-0">Quantity</p>
                  <span class="text-muted">1</span>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item pb-4 timeline-item-info border-left-dashed">
            <span class="timeline-indicator-advanced timeline-indicator-info">
              <i class="ti ti-user-circle rounded-circle"></i>
            </span>
            <div class="timeline-event pb-3">
              <div class="timeline-header">
                <h6 class="mb-0">Interview Schedule</h6>
                <span class="text-muted">6th October</span>
              </div>
              <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Possimus quos, voluptates voluptas rem veniam expedita.
              </p>
              <hr>
              <div class="d-flex justify-content-between flex-wrap gap-2">
                <div class="d-flex flex-wrap">
                  <div class="avatar me-3">
                    <img src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <p class="mb-0">Rebecca Godman</p>
                    <span class="text-muted">Javascript Developer</span>
                  </div>
                </div>
                <div class="d-flex flex-wrap align-items-center cursor-pointer">
                  <i class="ti ti-brand-hipchat me-2"></i>
                  <i class="ti ti-phone-call"></i>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item pb-0 timeline-item-warning border-transparent">
            <span class="timeline-indicator-advanced timeline-indicator-warning">
              <i class="ti ti-bell rounded-circle"></i>
            </span>
            <div class="timeline-event pb-3">
              <div class="timeline-header">
                <h6 class="mb-0">2 Notifications</h6>
                <span class="text-muted">7th October</span>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                  <div class="d-flex flex-wrap align-items-center">
                    <ul class="list-unstyled users-list d-flex align-items-center avatar-group m-0 my-3 me-2">
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                        <img class="rounded-circle" src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/5.png" alt="Avatar">
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Allen Rieske" data-bs-original-title="Allen Rieske">
                        <img class="rounded-circle" src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/12.png" alt="Avatar">
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Julee Rossignol" data-bs-original-title="Julee Rossignol">
                        <img class="rounded-circle" src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/4.png" alt="Avatar">
                      </li>
                    </ul>
                    <span>Commented on your post.</span>
                  </div>
                  <button class="btn btn-outline-primary btn-sm my-sm-0 my-3 waves-effect">
                    View
                  </button>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap pb-0 px-0">
                  <div class="d-flex flex-sm-row flex-column align-items-center">
                    <img src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/5.png" class="rounded-circle me-3" alt="avatar" height="24" width="24">
                    <div class="user-info">
                      <p class="my-0">Dwight repaid you</p>
                      <span class="text-muted">30 minutes ago</span>
                    </div>
                  </div>
                  <h5 class="mb-0">$20</h5>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
            </div>
             <div class="col-sm-12">
              <div class="d-flex" style="justify-content: space-between;">
          <h6 class="text-muted mt-3">&nbsp;</h6>
        </div>
<div class="card">
  <h5 class="card-header sticky-top" style="color:#5d596c;background-color: #fff">Billing & Plans</h5>
      <div class="outer_div d-flex card-header" style="justify-content:space-between;padding-top:0;">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
              <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked="">
              <label class="btn btn-outline-primary waves-effect" for="btnradio1">Bare Metal (VT)</label>

              <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
              <label class="btn btn-outline-primary waves-effect" for="btnradio2">Cloud Hosting</label>

              <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
              <label class="btn btn-outline-primary waves-effect" for="btnradio3">AWS Service</label>
                          </div>
             <!-- <button type="button" class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-plus"></i>&nbsp; Create</button> -->
             </div>
      <div class="card-body">
        <div class="row">
          <div class="col-xl-6 order-1 order-xl-0">
            <div class="mb-2">
              <h6 class="mb-1">Your Plan is Bare Metal (VT)</h6>
              <p>A simple start for everyone</p>
            </div>
            <div class="mb-2 pt-1">
              <h6 class="mb-1">Active until Dec 09, 2024</h6>
              <p>We will send you a notification upon Subscription expiration</p>
            </div>
            <div class="mb-3 pt-1">
               <button class="btn btn-primary me-2 waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#upgradePlanModal">Upgrade Plan</button>
            <button class="btn btn-label-danger cancel-subscription waves-effect">Cancel Subscription</button>
            </div>
          </div>
          <div class="col-xl-6 order-0 order-xl-0">
            <div class="alert alert-warning" role="alert">
              <h5 class="alert-heading mb-2">We need your attention!</h5>
              <span>Your plan requires update</span>
            </div>
            <div class="plan-statistics mt-4">
              <div class="d-flex justify-content-between">
                <h6 class="mb-1">Days</h6>
                <h6 class="mb-1">24 of 30 Days</h6>
              </div>
              <div class="progress mb-1" style="height: 10px;">
                <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <p>6 days remaining until your plan requires update</p>
            </div>
          </div>
          <div class="col-12 order-2 order-xl-0 d-flex flex-wrap gap-2">
           
          </div>
        </div>
      </div>
    </div>
</div>

        
        <div class="col-12 mb-4">
         @if($_REQUEST && $_REQUEST['msg'] == 'success')
         <span style="color:green">Order Added In Your Cart...</span>
         <script>
          setTimeout(function() {
            window.location.href = '{{url('/')}}/user/dashboard';
            }, 3000); // 3000 milliseconds = 3 seconds
          </script>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-12 mb-4">
          <div class="d-flex" style="justify-content: space-between;">
          <h6 class="text-muted mt-3"></h6>
        </div>
    <div class="card">
      <h5 class="card-header sticky-top" style="color:#5d596c;background-color: #fff">Invoices</h5>
      <div class="card-body">
        <canvas id="doughnutChart" class="chartjs mb-4" data-height="350" height="400" width="400" style="display: block; box-sizing: border-box; height: 300px; width: 300px;"></canvas>
        <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
          <li class="ct-series-0 d-flex flex-column">
            <h5 class="mb-0">Paid</h5>
            <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(102, 110, 232);width:100%; height:6px;"></span>
            <div class="text-muted">80 %</div>
          </li>
          <li class="ct-series-1 d-flex flex-column">
            <h5 class="mb-0">Unpaid</h5>
            <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(40, 208, 148);width:100%; height:6px;"></span>
            <div class="text-muted">10 %</div>
          </li>
          <li class="ct-series-2 d-flex flex-column">
            <h5 class="mb-0">Partially Paid</h5>
            <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(253, 172, 52);width:70%; height:6px;"></span>
            <div class="text-muted">70 %</div>
          </li>
        </ul>
      </div>
    </div>
  </div>
        <div class="col-xl-8 col-12 mb-4">
          <div class="d-flex" style="justify-content: space-between;">
          <h6 class="text-muted mt-3"></h6>
        </div>
    <div class="card">
      <div class="card-header header-elements" style="padding:0;padding-right:22px;">
        <h5 class="card-header sticky-top" style="color:#5d596c;background-color: #fff">Billing & Plans</h5>
        <div class="card-action-element ms-auto py-0">
          <div class="dropdown">
            <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-calendar"></i></button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <canvas id="horizontalBarChart" class="chartjs" data-height="400" height="500" width="682" style="display: block; box-sizing: border-box; height: 400px; width: 545px;"></canvas>
      </div>
    </div>
  </div>
          </div>
        </div>
      <!-- <div class="row">
        
            <div class="col-sm-5 mb-4">
              <h6 class="text-muted mt-3">PROJECT</h6>
              <div class="card">
                <div class="card-body">
                  <canvas id="polarChart" class="chartjs" data-height="337" height="337" width="636"></canvas>

                </div>
              </div>
            </div>
          </div>
        -->
      </div>
      @if(Auth::user()->status == 4)
      <div class="modal fade show" id="showedit" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog" style="display: block;">
      </div>
      @endif  
      <!-- / Content -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
  // Polar Chart
  // --------------------------------------------------------------------

  var InProgress = '{{$InProgress}}';
  var Completed = '{{$Completed}}';
  var OverDue = '{{$OverDue}}';
  var Cancel = '{{$Cancel}}';

  const polarChart = document.getElementById('polarChart');
  if (polarChart) {
    const polarChartVar = new Chart(polarChart, {
      type: 'polarArea',
      data: {
        labels: ['InProgress', 'Completed', 'OverDue', 'Cancel'],
        datasets: [
        {
          label: 'Project : ',
          backgroundColor: ['#7367f0', '#28c76f', '#ff9f43', '#ea5455'],
          data: [InProgress, Completed, OverDue, Cancel],
          borderWidth: 0
        }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 500
        },
        scales: {
          r: {
            ticks: {
              display: false,
              color: 'black' // Replace with the desired color for ticks
            },
            grid: {
              display: false
            }
          }
        },
        plugins: {
          tooltip: {
            rtl: false,
            backgroundColor: 'white', // Replace with the desired background color
            titleColor: 'black', // Replace with the desired title color
            bodyColor: 'black', // Replace with the desired body color
            borderWidth: 1,
            borderColor: 'black' // Replace with the desired border color
          },
          legend: {
            rtl: false,
            position: 'right',
            labels: {
              usePointStyle: true,
              padding: 25,
              boxWidth: 8,
              boxHeight: 8,
              color: 'black' // Replace with the desired legend color
            }
          }
        }
      }
    });
  }
});

        document.addEventListener('DOMContentLoaded', function() {
          function showToast() {
            var toastElement = document.querySelector('.toast');
            var progressBar = toastElement.querySelector('.toast-progress');

            if (toastElement) {
              toastElement.classList.add('show');
      var duration = 5000; // 5000 milliseconds = 5 seconds
      var interval = 50;  // Update the progress every 50 milliseconds
      var increment = (interval / duration) * 100;
      var progress = 0;

      var progressBarAnimation = setInterval(function() {
        progress += increment;
        progressBar.style.width = progress + '%';

        if (progress >= 100) {
          clearInterval(progressBarAnimation);
          setTimeout(function() {
            toastElement.classList.remove('show');
          }, interval);
        }
      }, interval);
    }
  }

  showToast();
});

        $(document).ready(function() {
          var totalAmount = 0;
          var remainingAmount = 0;
          $('.TotalAmount').each(function() {
            totalAmount += parseFloat($(this).text().replace(',', ''));
          });
          $('#TotalsAmount').html(totalAmount.toFixed(2));
          $('.dueAmmount').each(function() {
            remainingAmount += parseFloat($(this).text().replace(',', ''));
          });
          $('#DueInvoices').html(remainingAmount);
        });

      </script>


      @endsection