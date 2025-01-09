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
        border-radius: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #a7a0e9;
        border-radius: 8px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #776cda;
    }
</style>
<link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/ui-carousel.css')}}" />
<link rel="stylesheet" href="{{url('public/assets/vendor/css/pages/cards-advance.css')}}" />
<!-- Content -->

        @if(Auth::user()->status == 4)
        <script>
            $(document).ready(function() {
                // alert('Your are not allowed to perform this action. first complete your profile');
                   var id = {{ Auth::user()->id }};

                $.ajax({
                    url: "{{url('user/MyProfile/edit')}}",
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data && typeof data == 'string') {
                            $('#showedit').html(data);
                            $('#showedit').modal('show');
                        } else {
                            $('#showedit').html('<div>No Data Found</div>');
                            $('#showedit').modal('show');
                        }
                    },
                    error: function() {
                        $('#showedit .modal-content').html('<div>Error fetching data.</div>');
                        $('#showedit').modal('show');
                    }
                });
            });
        </script>
        @endif
        @if (!session('welcome_message_displayed'))
        <div id="toast-container" class="toast-top-right">
    <div class="toast toast-success" aria-live="polite">
   <div class="toast-progress" style="width: 0%;background-color: #7367F0;opacity: 0.7;"></div>
        <div class="toast-message">
            <b>Hello {{Auth::user()->first_name}}</b> </br> <i class="fas fa-hand-peace"></i>Welcome To CloudTechtiq !
        </div>
         </div>
</div>
    @php
        session(['welcome_message_displayed' => true]);
    @endphp
@endif

        
   
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
              <div class="carousel-inner" style="height: 180px;border-radius: 4px;">
                  @foreach($SpecialOffers as $SpecialOffer)
                <div class="carousel-item @if($SpecialOffersactive->id == $SpecialOffer->id) active @endif"  style="height:100%">
                  <img src="{{$SpecialOffer->attachment}}?q=80&w=1948&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100 " alt="{{$SpecialOffer->name}}" style="height:100%">
              </div>
              
              @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="display:none;"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="display:none;"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</div>
</div>
<div class="row mt-4">
    <div class="col-lg-4">
            <!-- <div>
                <h3 class="heading-h3 mb-0 f-21 font-weight-bold">Good Afternoon {{Auth::user()->first_name}}</h3>
            </div> -->
            <div class="card">
                <div class="card-body">
                    <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                        <img class="img-fluid" style="border-radius: 20px 20px 0px 0px;max-width: 110px;" src="@if(Auth::user()->profile_img){{Auth::user()->profile_img}}@else {{url('public/images/publickey_X5hf.png')}} @endif" alt="Card girl image" width="140">
                    </div>
                    <h4 class="mb-3 pb-1 text-center">{{ucfirst(Auth::user()->first_name)}} {{ucfirst(Auth::user()->last_name)}} </h4>
                    <div class="row mb-3 g-3">
                        <div class="col-6">
                            <div class="d-flex">
                                <div class="avatar flex-shrink-0 me-2">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-calendar-event ti-md"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->isoFormat('D MMM YYYY') }}</h6>
                                    <small>Date Joined</small>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex">
                                <div class="avatar flex-shrink-0 me-2">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-user ti-md"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">@if($getData && $getData->first_name){{ucfirst($getData->first_name . ' '.$getData->last_name)}} @endif</h6>
                                    <small>Account Manager </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('user/MyProfile')}}" class="btn btn-primary w-100 waves-effect waves-light">View Profile</a>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-sm-12">
            @if($ticket)
            <div class="card" style="max-height: 400px;overflow:auto;">
                <div class="sticky-top card-header" style="color:#5d596c;background-color: #fff">
                    <h4 style="background-color: #9c94f4 !important;padding: 5px 11px;border-radius: 4px;color: white;display: inline;">Ticket ID :#@if($ticket && $ticket->id) {{$ticket->id}} @endif</h4>
                    <h5 class="mt-3">Subject :@if($ticket && $ticket->subject) {{$ticket->subject}} @endif</h5>
                </div>
                <div class="card-body pb-0">

                    <ul class="timeline pt-3">
                        @if($ticket && $ticket->chat)
                        @foreach($ticket->chat as $chat)
                        @if($chat && $chat->message || $chat->image)
                        <li class="timeline-item pb-4 @if($chat && $chat->clientId && $chat->clientId == $ticket->user_id) timeline-item-primary @else timeline-item-success @endif border-left-dashed">
                            <span class="timeline-indicator-advanced timeline-indicator-primary">
                                <div class="avatar avatar-xs">
                                    @if($chat && $chat->client && $chat->client->profile_img)
                                    <img src="{{$chat->client->profile_img}}" alt="Avatar" class="rounded-circle">
                                    @else

                                    <img src="{{url('public/images/publickey_X5hf.png')}}" alt="Avatar" class="rounded-circle">
                                    @endif
                                </div>
                            </span>
                            <div class="timeline-event">
                                <div class="timeline-header border-bottom mb-3">
                                    <h6 class="mb-0">
                                        Posted By
                                        <span class="posted-by-name">{{ $chat->client ? $chat->client->first_name : 'Cloud Techtiq'}}</span>
                                        <span class="label requestor-badge requestor-type-operator float-md-right">
                                            @if($chat && $chat->clientId == $ticket->user_id)
                                                <strong>(Owner)</strong>
                                            @else
                                                 <strong>(Operator)</strong>
                                            @endif
                                        </span>
                                    </h6>
                                    <span class="text-muted">{{ $chat->created_at->format('jS F') }}</span>
                                </div>
                                <div class="d-flex justify-content-between flex-wrap mb-2">
                                    <div class="d-flex align-items-center">
                                        <p>{!! $chat->message !!}</p>
                                    </div>
                                    <span>{{ $chat->created_at->format('g:i A') }}</span>
                                </div>
                                <div class=" align-items-center">
                                    @if($chat &&  $chat->image && $chat->extension == 'jpg' || $chat->extension == 'gif' || $chat->extension ==
                                    'jpeg'|| $chat->extension == 'png')
                                    <a href="{{ url('public/chat/',$chat->image) }}" download>

                                        <img src="{{ url('public/chat/'.$chat->image) }}" alt="Avatar" width="100" />

                                    </a>
                                    @endif
                                    @if($chat && $chat->image && $chat->extension == 'txt' || $chat->extension == 'pdf')
                                    <a href="{{ url('public/chat/',$chat->image) }}" download>
                                        <i class="fas fa-file-pdf">{{$chat->image}}</i>
                                    </a>
                                    <div class="pdf-layout mt-2">
                                        <object class="pdf" data="{{ url('public/chat/'.$chat->image) }}" height="100"></object>
                                    </div>
                                    @endif
                                    @if($chat && $chat->image && $chat->extension == 'zip' || $chat->extension == 'rar')
                                    <a href="{{ url('public/chat/',$chat->image) }}" download>
                                        <i class="fas fa-file-archive"> {{$chat->image}}</i>
                                    </a>
                                    @endif
                                    @if($chat && $chat->image && $chat->extension == 'xls' || $chat->extension == 'xlsx' || $chat->extension ==
                                    'docx')
                                    <a href="{{ url('public/chat/',$chat->image) }}" download>
                                        <i class="fas fa-file-excel"> {{$chat->image}}</i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                        @else
                         <li class="timeline-item pb-4  border-left-dashed">
                            <span class="timeline-indicator-advanced timeline-indicator-primary">
                                <div class="avatar avatar-xs">
                                   
                                    <img src="{{url('public/images/publickey_X5hf.png')}}" alt="Avatar" class="rounded-circle">
                                </div>
                            </span>
                            No Record Found
                        </li>

                        @endif
                    </ul>
                </div>
            </div>
            @else
                        <div class="card" style="min-height: 280px;overflow:auto;">
                            <h4 style="marign:0px auto;text-align: center;">No Record Found</h4>
                        </div>
                        @endif
        </div>
    </div>
        <div class="row mt-4">
        <div class="col-12 order-5">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                  <h5 class="m-0 me-2">Active Services </h5>
              </div>
            
        </div>
      <div class="card-datatable table-responsive">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="table-responsive">
            <table class="dt-route-vehicles table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1214px;">
                <thead class="border-top">
                    <tr>
                        <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 132px;" aria-label="location: activate to sort column descending" aria-sort="ascending">Service Name</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 216px;" aria-label="starting route: activate to sort column ascending">Total Amount</th>
                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 214px;" aria-label="ending route: activate to sort column ascending">Renewal Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 167px;" aria-label="warnings: activate to sort column ascending">Status</th>
                        <th class="w-20 sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 300px;" aria-label="progress: activate to sort column ascending">Days left</th>
                        <th class=" sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 60px;" aria-label="progress: activate to sort column ascending">Actions</th>
                    </tr>
                </thead>
                <tbody>
            @if($product_data)
            @foreach($product_data as $service)
            @if($service)
           
                @php

                    $currentDate = new DateTime();
                    $nextDueDate = new DateTime($service->next_due_date);
                    $interval = $currentDate->diff($nextDueDate);
                    $totalDays = $interval->days;
                    if($service->status == 1){
                        $status = 'Active';
                        $class = 'bg-success';
                    }if($service->status == 2){
                        $status = 'Suspended';
                        $class = 'bg-danger';
                    }if($service->status == 4){
                        $status = 'Pending';
                        $class = 'bg-info';
                    }

                @endphp
                @php 
              
                $Invoice = \App\Models\Invoice::where('id',$service->invoice_id)
                    ->first();
            @endphp
        <tr>
            <td>{{ $service->product_name }}</td>
            <td>@if($Invoice && $Invoice->final_total_amt){{ $Invoice->final_total_amt }}@endif</td>
            <td>{{ $service->next_due_date }}</td>
            <td><span class="badge rounded {{ $class }}">{{ $status }}</span></td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="progress w-100" style="height: 8px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $totalDays }}%;" aria-valuenow="{{ $totalDays }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="text-body ms-3">{{ $totalDays }}</div>
                </div>
            </td>
            <td class="text-center">
                @if($service->status==2)
                    <button class="btn btn-label-danger text-danger  waves-effect" data-id="{{ $service->id }}"><i class="fa-solid fa-close text-danger" style="color:#7367f0;"></i></button>

                @elseif($service->status == 4)
                    <button class="btn btn-label-warning  waves-effect" data-id="{{ $service->id }}"><i class="fa-solid fa-cancel" style="color:#7367f0;"></i></button>

                @else
                            <button class="btn btn-label-danger cancel-subscription waves-effect" category-id = "{{$service->category_id}}" data-id="{{ $service->id }}"><i class="fa-solid fa-trash" style="color:#7367f0;"></i></button>
                            @endif
                <!-- <a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="fa-solid fa-eye" style="color:#7367f0;"></i></a> -->


            </td>
        </tr>
        @endif
    @endforeach
    @else
      <tr>
            <td colspan="8" class="text-center">No Record Found</td>
        </tr>
        @endif
</tbody>

            </table>
            <div style="width: 1%;"></div>
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
</div>
</div>
    <div class="row">
        <div class="col-lg-4 col-12 mb-4">
            <div class="d-flex" style="justify-content: space-between;">
                <h6 class="text-muted mt-3"></h6>
            </div>
            <div class="card">
                <h5 class="card-header sticky-top" style="color:#5d596c;background-color: #fff">Invoices</h5>
                <div class="card-body" id="dynamicDoughnutText">
                    <!-- Updated ID for the canvas element -->
                    <canvas id="dynamicDoughnutChart" class="chartjs mb-4" data-height="350" height="400" width="400" style="display: block; box-sizing: border-box; height: 300px; width: 300px;"></canvas>
                    <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                        <li class="ct-series-0 d-flex flex-column">
                            <h5 class="mb-0">Paid</h5>
                            <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(102, 110, 232);width:100%; height:6px;"></span>
                            <!-- Use dynamic data here -->
                            <div class="text-muted" id="paidPercentage">0%</div>
                        </li>
                       <li class="ct-series-0 d-flex flex-column">
    <h5 class="mb-0">Overdue</h5>
    <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(255, 99, 132); width:100%; height:6px;"></span>
    <!-- Use dynamic data here -->
    <div class="text-muted" id="overduePercentage">0%</div>
</li>

                        <li class="ct-series-1 d-flex flex-column">
                            <h5 class="mb-0">Unpaid</h5>
                            <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(40, 208, 148);width:100%; height:6px;"></span>
                            <!-- Use dynamic data here -->
                            <div class="text-muted" id="unpaidPercentage">0%</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Your PHP code to calculate Paid and Unpaid invoice counts should be here -->
       <script>
    $(document).ready(function() {
        var paidInvoicesCount = <?php echo $PaidInvoicesCount ?? 0; ?>;

        var unpaidInvoicesCount = <?php echo $DueInvoicesCount ?? 0; ?>;
        var overdueInvoicesCount = <?php echo $OverdueInvoicesCount ?? 0; ?>;
        var totalInvoices = paidInvoicesCount + unpaidInvoicesCount + overdueInvoicesCount;
        // alert(totalInvoices);
        if(totalInvoices > 0){

            var paidPercentage = totalInvoices === 0 ? 0 : ((paidInvoicesCount / totalInvoices) * 100).toFixed(2);
            var unpaidPercentage = totalInvoices === 0 ? 0 : ((unpaidInvoicesCount / totalInvoices) * 100).toFixed(2);
            var overduePercentage = totalInvoices === 0 ? 0 : ((overdueInvoicesCount / totalInvoices) * 100).toFixed(2);
            document.getElementById('paidPercentage').innerText = paidPercentage + "%";
            document.getElementById('unpaidPercentage').innerText = unpaidPercentage + "%";
            document.getElementById('overduePercentage').innerText = overduePercentage + "%";
            const dynamicDoughnutChart = document.getElementById('dynamicDoughnutChart');
            if (dynamicDoughnutChart) {
                const doughnutChartVar = new Chart(dynamicDoughnutChart, {
                    type: 'doughnut',
                    data: {
                        labels: ['Paid', 'Unpaid', 'Overdue'],
                        datasets: [{
                            data: [paidPercentage, unpaidPercentage, overduePercentage],
                            backgroundColor: [
                                'rgb(102, 110, 232)', // Paid invoices color
                                'rgb(40, 208, 148)', // Unpaid invoices color
                                'rgb(255, 99, 132)' // Overdue invoices color
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        animation: {
                            duration: 500
                        },
                        cutout: '68%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.parsed.toFixed(2); // Round to two decimal places
                                        const output = ' ' + label + ' : ' + value + ' %';
                                        return output;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        }else{
            $('#dynamicDoughnutText').html('<p>No Record Available.</p>');
        }
    });
</script>

        <div class="col-xl-8 col-12 mb-4">
            <div class="d-flex" style="justify-content: space-between;">
                <h6 class="text-muted mt-3"></h6>
            </div>
            <div class="card">
                <div class="card-header header-elements" style="padding:0;padding-right:22px;">
                    <h5 class="card-header sticky-top" style="color:#5d596c;background-color: #fff">Unpaid Invoices</h5>
                   <!--  <div class="card-action-element ms-auto py-0">
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
                    </div> -->
                </div>
                <div class="card-body">
                    <!-- <canvas id="horizontalBarChart" class="chartjs" data-height="400" height="500" width="682" style="display: block; box-sizing: border-box; height: 400px; width: 545px;"></canvas> -->
                    <table class="table table-striped">
                      <thead>
                        <th>ID</th>
                        <th>Amount</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                        <tbody>
                                @if($UPInvoices->isNotEmpty()) 
                                    @foreach($UPInvoices as $invoices)
                                        <tr>
                                            <td>{{$invoices->invoice_number1.$invoices->invoice_number2}}</td>
                                            <td>{{$invoices->final_total_amt}}</td>
                                            <td>{{$invoices->due_date}}</td>
                                            <td><span class="badge bg-danger">Unpaid</span></td>
                                            <td>

                                                <!-- <button class="btn btn-info btn-sm">Pay</button> -->
 @if($invoices && $invoices->is_payment_recieved == 1)
                     <span class="btn btn-success btn-sm">Paid</span>
                     @else
                     <button class="btn btn-primary btn-next rzp-payment-btn" data-id="{{ $invoices->id }}" data-amount="{{ $invoices->final_total_amt }}">Pay</button>
                     @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No Record Found</td>
                                    </tr>
                                @endif
                        </tbody>
              </table>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

  <script>
  $(document).ready(function(){
       if ({{ Auth::user()->status }} == 4) {
                $('#showedit').modal('show');
            } 
  });
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
                    datasets: [{
                        label: 'Project : ',
                        backgroundColor: ['#7367f0', '#28c76f', '#ff9f43', '#ea5455'],
                        data: [InProgress, Completed, OverDue, Cancel],
                        borderWidth: 0
                    }]
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


    $(document).ready(function() {
                showToast();

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

<script>
 function showToast() {
            var toastElement = document.querySelector('.toast');
            var progressBar = toastElement.querySelector('.toast-progress');

            if (toastElement) {
                toastElement.classList.add('show');
                var duration = 5000; // 5000 milliseconds = 5 seconds
                var interval = 50; // Update the progress every 50 milliseconds
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

    function getServiceData(value) {
        var selectedProductId = value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{url('user/getServiceData')}}",
            data: {
                OrderId: selectedProductId,
            },
            success: function(res) {
                console.log(res);

                var productName = res.data.order_data.product_name;
                var next_due_date = new Date(res.data.product_data.next_due_date);
                var currentDate = new Date();

                // Calculate the remaining days
                var timeDifference = next_due_date.getTime() - currentDate.getTime();
                var remainingDays = Math.ceil(timeDifference / (1000 * 3600 * 24));

                // Calculate the progress percentage
                var totalDays = 30; // Assuming 30 days in a month
                var progressPercentage = ((totalDays - remainingDays) / totalDays) * 100;

                // Update progress bar width
                $('.progress-bar').css('width', progressPercentage + '%');
                $('.progress-bar').attr('aria-valuenow', progressPercentage);

                // Update days remaining text
                $('.plan-statistics p').text(remainingDays + ' days remaining until your plan requires update');

                // Update days display
                $('.plan-statistics .d-flex h6:nth-child(2)').text(remainingDays + ' of ' + totalDays + ' Days');

                // Set the formatted due date to the element
                var formattedDueDate = next_due_date.getDate() + ' ' +
                getMonthName(next_due_date.getMonth()) + ' ' +
                next_due_date.getFullYear();
                $('#next_due_date').text(formattedDueDate);

                // Set product name
                $('#product_name_span').text(productName);

                var terminate_date = res.data.product_data.terminate_date;
                var next_due_date = new Date(res.data.product_data.next_due_date);

                // Parse the terminate_date string to a Date object
                var parsedDate = new Date(next_due_date);
                var formattedDate = parsedDate.getDate() + ' ' +
                    getMonthName(parsedDate.getMonth() + 1) + ' ' + // Add 1 to the month index to adjust for JavaScript's zero-based month indexing
                    parsedDate.getFullYear();

                // Set the formatted date to the element
                    $('#terminate_date').text(formattedDate);

                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                },
            });
    }

    // Function to get month name from month index
    function getMonthName(monthIndex) {
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return months[monthIndex];
    }


        // Cancel Subscription alert
    const cancelSubscription = document.querySelector('.cancel-subscription');

  if (cancelSubscription) {
  cancelSubscription.onclick = function () {
    var id = $(this).data('id');
    var category_id = $(this).attr('category-id');
    // alert(id);
    Swal.fire({
      text: 'Are you sure you would like to cancel your subscription?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      customClass: {
        confirmButton: 'btn btn-primary me-2',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        // alert(category_id);
        console.log(category_id);
        $.ajax({
          type: 'POST',
          url: "{{url('user/cancel-subscription')}}/"+id,
          dataType: 'json',
          data: {
            category_id: category_id
          },
          success: function(res) {
            Swal.fire({
              icon: 'success',
              title: 'Cancellation Request Submitted!',
              html: 'Your subscription cancellation request has been successfully submitted. <br> We are currently reviewing your request.',
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
            // Refresh the page after successful cancellation
            location.reload();
          },
          error: function(xhr, status, error) {
            console.error('AJAX Error: ' + error);
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: 'Cancelled',
          text: 'Unsubscription Cancelled!!',
          icon: 'error',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      }
    });
  };
}

</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.querySelectorAll('.rzp-payment-btn').forEach(button => {
        button.addEventListener('click', function() {
            var invoiceId = this.getAttribute('data-id');
            var paymentAmount = parseFloat(this.getAttribute('data-amount'))*100; // Convert amount to paise
            // alert(paymentAmount);
            var finalAmount = paymentAmount.toFixed(2);
            var options = {
                "key": "rzp_test_905d9rOq4TKriv",
                "amount": finalAmount,
                "currency": "{{ $default_currency->code }}",
                "name": "Tech CRM",
                "image": "{{url('/')}}/public/logo/company.png",
                "handler": function(response) {
                    window.location.href = "{{ url('user/Invoices/paymentStatusUpdate') }}?orderId=" + invoiceId + "&payment_id=" + response.razorpay_payment_id;
                },
                "theme": {
                    "color": "#3399cc"
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
        });
    });
</script>
@endsection