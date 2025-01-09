 @extends('layouts.admin')
@section('title', 'Order Details')
@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-2"> Order Details</h4>

              <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
                  <h5 class="mb-1 mt-3 d-flex flex-wrap gap-2 align-items-end">
                    Order #{{$Quotes->id}} <span class="badge {!! $Quotes->is_payment_recieved == 1 ? 'bg-label-success' : 'bg-label-warning' !!}"> {{ $Quotes->is_payment_recieved == 1 ? 'Paid' : 'Unpaid' }}</span>
                    <span class="badge bg-label-info">@switch($Quotes->order_status)
                                              @case('0')
                                                <span class="badge bg-label-warning">Pending</span>
                                                  @break
                                              @case('1')
                                                <span class="badge bg-label-success">Delivered</span>
                                                  @break
                                              @case('2')
                                                <span class="badge bg-label-danger">Canceled</span>
                                                  @break
                                              @default
                                                    <span></span>
                                              @endswitch</span>
                  </h5>
                  <p class="text-body">{{date("M d",strtotime($Quotes->created_at))}}<span id="orderYear"></span>, {{date("h:i",strtotime($Quotes->created_at))}}</p>
                </div>
               
              </div>

              <!-- Order Details Table -->

              <div class="row">
                <div class="col-12 col-lg-9">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="card-title m-0">Order details</h5>
                      <!-- <h6 class="m-0"><a href="{{url('admin/Orders/edit/'.$Quotes->id)}}">Edit</a></h6> -->
                    </div>
                    <div class="card-datatable table-responsive">
                      <table class="datatables-order-details table border-top">
                        <thead>
                          <tr>
                           <th>
                           <th>
                            <th>products</th>
                            <th>price</th>
                            <th>qty</th>
                            <th>GST/CGST</th>
                            <th>total</th>
                          </tr>
                        </thead>
                        <tbody>
                         @php
                         $priceSubtotal = 0;
                         $tax = 0;
                         @endphp
                          @foreach($orders as $order)
                          @php
                         $priceSubtotal += $order->price;
                         $totalGstPrice = number_format($order->price*$order->rate/100,2);
                         $tax += number_format($order->price*$order->rate/100,2);
                         
                         @endphp
                          <tr>
                            <td></td>
                            <td></td>
                            <td>{{isset($order) ? ucfirst($order->product_name) : ''}}</td>
                            <td>{{isset($order) ? number_format($order->price,2) : ''}}</td>
                            <td>1</td>
                            <td>{{$totalGstPrice}}</td>
                            <td>{{isset($Currency) ? $Currency->code : ''}} {{number_format($order->price+$totalGstPrice,2)}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-end align-items-center m-3 mb-2 p-1">
                        <div class="order-calculations">
                          <div class="d-flex justify-content-between mb-2">
                            <span class="w-px-100 text-heading">Subtotal:</span>
                            <h6 class="mb-0">{{isset($Currency) ? $Currency->code : ''}} {{number_format($priceSubtotal,2)}}</h6>
                          </div>
                        
                          <div class="d-flex justify-content-between mb-2">
                            <span class="text-heading">Tax:</span>
                            <h6 class="mb-0">{{isset($Currency) ? $Currency->code : ''}} {{number_format($tax,2)}}</h6>
                          </div>
                          <div class="d-flex justify-content-between">
                            <h6 class="w-px-100 mb-0">Total:</h6>
                            <h6 class="mb-0">{{isset($Currency) ? $Currency->code : ''}} {{isset($order) ? number_format($priceSubtotal+$tax,2) : ''}}</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-3">
                  <div class="card mb-4">
                    <div class="card-header">
                      <h6 class="card-title m-0">Customer details</h6>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-start align-items-center mb-4">
                        <div class="avatar me-2">
                          <img src="{{isset($Quotes) ? $Quotes->profile_img : url('public/images/default_profile.jpg')}}" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex flex-column">
                          <a href="app-user-view-account.html" class="text-body text-nowrap">
                            <h6 class="mb-0">{{isset($Quotes) ? ucfirst($Quotes->first_name) : ''}}</h6>
                          </a>
                          <small class="text-muted">Customer ID: #{{isset($Quotes) ? ucfirst($Quotes->uid) : ''}}</small>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between">
                        <h6>Contact info</h6>
                       
                      </div>
                      <p class="mb-1">Email: {{isset($Quotes) ? $Quotes->email : ''}}</p>
                      <p class="mb-0">Mobile: {{isset($Quotes) ? ucfirst($Quotes->phone_number) : ''}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endsection