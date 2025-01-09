@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<style>
  .swiper .swiper-slide {
    padding: 2rem 0;
    text-align: center;
    font-size: 1.5rem;
     background-color: #7367f0 !important; 
    background-position: center;
    background-size: cover;
}
</style>
<link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/ui-carousel.css')}}" />
<link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/cards-advance.css')}}" />
<!-- Content -->         
<div id="toast-container" class="toast-top-right">
  <div class="toast toast-success" aria-live="polite">
    <div class="toast-progress" style="width: 0%;"></div>
    <div class="toast-message">
     <b>Hello {{Auth::user()->first_name}} </b> </br>  <i class="fas fa-hand-peace"></i>Welcome To CloudTechtiq !
    </div>
  </div>
</div>
<div class="container-xxl flex-grow-1 container-p-y">

   <div class="row">
        <div class="col-lg-12 mb-4" >
      <div
      class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
      id="swiper-with-pagination-cards">
      <div class="swiper-wrapper" >
        <div class="swiper-slide">
          <div class="row">
            <div class="col-12">
              <h5 class="text-white mb-0 mt-2">{{Auth::user()->first_name}}</h5>
              <small>ID: Emp-{{Auth::user()->id}}</small><br/>
              <small>Role: Client</small></br>
              <small>Phone: {{Auth::user()->phone_number}}</small>
              <small>Email: {{Auth::user()->email}}</small><br/>
            </div>
            <div class="row">
              <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                <h6 class="text-white mt-0 mt-md-3 mb-3">Overview</h6>
                <div class="row">
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-4 align-items-center">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">22</p>
                        <p class="mb-0">Open Tasks</p>
                      </li>
                      <li class="d-flex align-items-center mb-2">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">10</p>
                        <p class="mb-0">Projects</p>
                      </li>
                    </ul>
                  </div>
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-4 align-items-center">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">20</p>
                        <p class="mb-0">Open Tickets</p>
                      </li>
                      <li class="d-flex align-items-center mb-2">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">12%</p>
                        <p class="mb-0">Averave response rate</p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                <img
                src="{{Auth::user()->profile_img}}"
                alt="Website Analytics"
                width="170"
                class="card-website-analytics-img" style="border-radius: 50%;"/>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="row">
            <div class="col-12">
              <h5 class="text-white mb-0 mt-2">Logs</h5>
              <!-- <small>2 : 40 : 06 PM</small> -->
            </div>
            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
              <h6 class="text-white mt-0 mt-md-3 mb-3">Time-Logs</h6>
              <div class="row">
                <div class="col-6">
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex mb-4 align-items-center">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="grand-total-time" style="min-width: 72px;">0</p>
                      <p class="mb-0">Total Duration</p>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="BreakTime" style="min-width: 72px;">0</p>
                      <p class="mb-0">Total Interval</p>
                    </li>
                  </ul>
                </div>
                <div class="col-6">
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex mb-4 align-items-center">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg" id="ExtraWorkingTime" style="min-width: 72px;">0</p>
                      <p class="mb-0">Overtime</p>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg"id="ShiftHours" style="min-width: 72px;">0k</p>
                      <p class="mb-0">Shift Hours</p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
              <img
              src="{{url('public/logo/clock.png')}}"
              alt="Website Analytics"
              width="170"
              class="card-website-analytics-img" style="border-radius: 50%;"/>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
<!--     @php
        if($InvoiceSettings){
            $final_date = date('Y-m-d');
            $current_date = date('Y-m-d');
            
            if($RecentInvoice){
                $issue_date = $RecentInvoice->issue_date;
                $due_date = $RecentInvoice->due_date;
            } else {
                $issue_date = date('Y-m-d');
                $due_date = date('Y-m-d');
            }
            
            $send_reminder_before = $InvoiceSettings->send_reminder_before;
            $send_reminder_after = $InvoiceSettings->send_reminder_after;

            if($InvoiceSettings->reminder == 'after'){
                $final_date = date('Y-m-d', strtotime($issue_date . ' + ' . $send_reminder_after . ' days'));
            } elseif($InvoiceSettings->reminder == 'before'){
                $final_date = date('Y-m-d', strtotime($issue_date . ' - ' . $send_reminder_before . ' days'));
            }

            if($final_date == $current_date){
            @endphp

                <span class="text-danger inv_msg">Your Invoice Is Generated, Please Download it.</span>

                <script>
                    // Use JavaScript to hide the span after 7 seconds
                    setTimeout(function() {
                        document.querySelector('.inv_msg').style.display = 'none';
                    }, 7000);
                </script>

            @php
            }
        }
    @endphp -->


        <div class="col-12 mb-4">
         @if($_REQUEST && $_REQUEST['msg'] == 'success')
        <span style="color:green">Order Added In Your Cart...</span>
        <script>
            setTimeout(function() {
                window.location.href = '{{url('/')}}/user/dashboard';
            }, 3000); // 3000 milliseconds = 3 seconds
        </script>
    @endif
<!-- 
          <h6 class="text-muted mt-3">Special Offer </h6>
          <div class="swiper" id="swiper-3d-coverflow-effect">
            <div class="swiper-wrapper">
              @foreach($SpecialOffers as $offer)
              <div class="swiper-slide" style="background-image: url({{$offer->attachment}})">
               <span class="text-dark"><b>{{$offer->name}}</b></span>
              </div>
              @endforeach                
            </div>
            <div class="swiper-pagination"></div>
          </div> -->
        </div>
     <!-- 3D coverflow effect -->
  </div>
  <div class="row">
        <div class="col-3">
          <div class="col-sm-12 mb-4">
                <h6 class="text-muted mt-3">Invoice</h6>
            <div class="card">
              <div class="card-body">
                <h6>Due Invoices : &nbsp;&nbsp;&nbsp;<span >{{  $DueInvoicesCount }}</span></h6>
                <h6>Due Invoices Amount : &nbsp;&nbsp;&nbsp;<span id="DueInvoices"></span></h6>
                <!-- <h6>Due Invoices : &nbsp;&nbsp;&nbsp;<span id="DueInvoices">{{  $DueInvoicesCount }}</span></h6> -->
                <h6>Total Amount : &nbsp;&nbsp;&nbsp;<span id="TotalsAmount"></span></h6>
              </div>
            </div>
          </div>
          <div class="col-sm-12 mb-4">
                <h6 class="text-muted mt-3">Tickets</h6>
            <div class="card">
              <div class="card-body">
                <h5>Open : &nbsp;&nbsp;&nbsp;{{$TOpen}}</h5>
                <h5>Pending :&nbsp;&nbsp;&nbsp;{{$TPending}}</h5>
              </div>
            </div>
          </div>
       
        </div>

        <div class="col-9">
        <div class="col-sm-12 mb-4">
              <h6 class="text-muted mt-3">Invoices list</h6>
          <div class="card">
              <div class="table-responsive text-nowrap" style="height: 319px;">
                  <table class="table mb-3">
                    <thead class="table-light">
                      <tr>
                        <th>#</th>
                        <th>Month</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Remianing</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($Invoice as $Ivoice)
                      <tr>
                        <td>
                          <span class="fw-medium">{{$Ivoice->invoice_number1}} {{$Ivoice->invoice_number2}}</span>
                        </td>
                        <td>
                        <span class="fw-medium">{{ \Carbon\Carbon::parse($Ivoice->created_at)->format('M') }}</span>

                        </td>
                        <td>
                          <span class="fw-medium TotalAmount">{{ number_format($Ivoice->amount, 2, '.', '')}}</span>
                        </td>
                        <td>
                          <span class="fw-medium">@if($Ivoice->is_payment_recieved == 1) {{ number_format($Ivoice->amount, 2, '.', '')}} @elseif($Ivoice->is_payment_recieved == 0) 00.00  @endif</span>
                        </td>
                        <td>
                          <span class="fw-medium dueAmmount">@if($Ivoice->is_payment_recieved == 0) {{ number_format($Ivoice->amount, 2, '.', '')}} @elseif($Ivoice->is_payment_recieved == 1) 00.00  @endif</span>
                        </td>
                        <td>@if($Ivoice->is_payment_recieved == 1)<span class="badge bg-label-success me-1">Paid</span>@elseif($Ivoice->is_payment_recieved == 0)<span class="badge bg-label-danger me-1">UnPaid</span>@endif</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
          </div>
        </div>
        </div>
  </div>
  <div class="row">
      <div class="col-sm-7 mb-4">
              <h6 class="text-muted mt-3">Active Services</h6>
          <div class="card">
              <div class="table-responsive text-nowrap" style="height: 385px;">
                  <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>Product/Host Name</th>
                        <th>Amount</th>
                        <th>Signup</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($InVls as $INVicec)
                      <tr>
                        <td>
                          <img src="{{$INVicec->product_image}}" style="height: 24px;width: 41px;">&nbsp;&nbsp;
                          <span class="fw-medium">{{$INVicec->product_name}}</span>
                        </td>
                        <td>{{ number_format($INVicec->total_amount, 2, '.', '')}}</td>
                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
          </div>
      </div>
      <div class="col-sm-5 mb-4">
              <h6 class="text-muted mt-3">PROJECT</h6>
          <div class="card">
              <div class="card-body">
                <canvas id="polarChart" class="chartjs" data-height="337" height="337" width="636"></canvas>

              </div>
          </div>
      </div>
  </div>
                
</div>
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
    $('#TotalsAmount').html(totalAmount);
     $('.dueAmmount').each(function() {
        remainingAmount += parseFloat($(this).text().replace(',', ''));
    });
     $('#DueInvoices').html(remainingAmount);
});

</script>
@endsection