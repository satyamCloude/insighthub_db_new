@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')

<style>
  .btmtable th {
    background-color: #eae8fd  !important;
}
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-2"> Order Details</h4>



    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

        <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">

            <h5 class="mb-1 mt-3 d-flex flex-wrap gap-2 align-items-end">

                Order #{{$Order->id}} <span class="badge bg-label-info"> <span

                        class="badge {!! $Order->is_payment_recieved == 1 ? 'bg-label-success' : 'bg-label-warning' !!}">

                        {{ $Order->is_payment_recieved == 1 ? 'Paid' : 'Unpaid' }}</span> </span>

                <span class="badge bg-label-info">@switch($Order->order_status)

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

            <p class="text-body">

                {{ date("M d", strtotime($Order->created_at)) }}<span id="orderYear"></span>,

                {{ date("h:i A", strtotime($Order->created_at)) }}

            </p>



        </div>



    </div>



    <!-- Order Details Table -->



    <div class="row">

        <div class="col-12 col-lg-9">

            <div class="card mb-4 px-2">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="card-title m-0">Order details</h5>

                    <h6 class="m-0"><a href="{{url('user/order/home')}}">Back</a></h6>

                </div>

                <div class="card-datatable table-responsive">

                    <table class="datatables-order-details table border-top btmtable">

                        <thead>

                            <tr>

                                <th>

                                <th>

                                <th>products name</th>

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

                                  // Check if $order->price and $order->rate are numeric, otherwise default to 0
                                  $quantity = $order->quantity ?? 1;
                                  $price = is_numeric($order->price) ? floatval($order->price * $quantity) : 0;

                                  $rate = is_numeric($order->rate) ? floatval($order->rate) : 0;

                                  $priceSubtotal += floatval($price);
                                 if($clientDetails && $clientDetails->tax_exampt == 0){

                                  $totalGstPrice = floatval($price) * floatval($rate) / 100;
                                    }else{
                                        $totalGstPrice = 0;
                                    }
                                  $tax += floatval($totalGstPrice);



                              @endphp



                              <tr>

                                  <td></td>

                                  <td></td>

                                  <td>{{ isset($order) ? ucfirst($order->product_name) : '' }}</td>

                                  <td>{{ isset($order) ? number_format($price, 2) : '' }}</td>

                                  <td>{{$quantity}}</td>

                                  <td>{{ number_format($totalGstPrice,2) }}</td>

                                  <td>{{ isset($Currency) ? $Currency->prefix : '' }}

                                      {{ number_format(($price + $totalGstPrice),2) }}

                                      {{ isset($Currency) ? $Currency->code : '' }}

                                  </td>


                              </tr>
                          @endforeach
                          @if($OsOrder)
                                  <tr>

                                  <td></td>

                                  <td></td>

                                  <td>{{ isset($OsOrder) ? ucfirst($OsOrder->ostype) : '' }}</td>

                                  <td>{{ isset($OsOrder) ? number_format($OsOrder->os_price, 2) : '' }}</td>

                                  <td>1</td>

                                  @php
                                  $totalGstPriceOs=0;
                                   $rate = is_numeric($OsOrder->tax_rates) ? floatval($OsOrder->tax_rates) : 0;

                                  $priceSubtotal += floatval($OsOrder->os_price);
                                  if($clientDetails && $clientDetails->tax_exampt == 0){

                                  $totalGstPriceOs = floatval($OsOrder->os_price) * floatval($rate) / 100;
                              }
                                  $tax += floatval($totalGstPriceOs);

                                  @endphp
                                  <td>{{ number_format($totalGstPriceOs,2) }}</td>

                                  <td>{{ isset($Currency) ? $Currency->prefix : '' }}

                                      {{ number_format(($OsOrder->os_price + $totalGstPriceOs),2) }}

                                      {{ isset($Currency) ? $Currency->code : '' }}

                                  </td>

                              </tr>
                              @endif

                        </tbody>

                    </table>

                    <div class="d-flex justify-content-end align-items-center m-3 mb-2 p-1">

                        <div class="order-calculations">

                            <div class="d-flex justify-content-between mb-2">

                                <span class="w-px-100 text-heading">Subtotal:</span>

                                <h6 class="mb-0">{{isset($Currency) ? $Currency->prefix : ''}}

                                    {{number_format($priceSubtotal,2)}} {{isset($Currency) ? $Currency->code : ''}}</h6>

                            </div>



                            <div class="d-flex justify-content-between mb-2">

                                <span class="text-heading">Tax:</span>
                                    @php
                                 if($clientDetails && $clientDetails->tax_exampt == 0){
                                                $tax = $tax;
                                            }else{
                                                $tax = 0;
                                            }
                                        @endphp
                                <h6 class="mb-0">{{isset($Currency) ? $Currency->prefix : ''}} {{number_format($tax,2)}}

                                    {{isset($Currency) ? $Currency->code : ''}}</h6>

                            </div>

                            <div class="d-flex justify-content-between">

                                <h6 class="w-px-100 mb-0">Total:</h6>

                                <h6 class="mb-0">{{isset($Currency) ? $Currency->prefix : ''}} {{isset($order) ?

                                    number_format($priceSubtotal+$tax,2) : ''}} {{isset($Currency) ? $Currency->code :

                                    ''}}</h6>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- <div class="col-12 col-lg-3">

                  <div class="card mb-4">

                    <div class="card-header">

                      <h6 class="card-title m-0">Customer details</h6>

                    </div>

                    <div class="card-body">

                      <div class="d-flex justify-content-start align-items-center mb-4">

                        <div class="avatar me-2">

                          <img src="{{isset($order) ? $order->profile_img : url('public/images/default_profile.jpg')}}" alt="Avatar" class="rounded-circle" />

                        </div>

                        <div class="d-flex flex-column">

                          <a href="app-user-view-account.html" class="text-body text-nowrap">

                            <h6 class="mb-0">{{isset($order) ? ucfirst($order->first_name) : ''}}</h6>

                          </a>

                          <small class="text-muted">Customer ID: #{{isset($order) ? ucfirst($order->uid) : ''}}</small>

                        </div>

                      </div>

                      <div class="d-flex justify-content-between">

                        <h6>Contact info</h6>

                       

                      </div>

                      <p class="mb-1">Email: {{isset($order) ? $order->email : ''}}</p>

                      <p class="mb-0">Mobile: {{isset($order) ? ucfirst($order->phone_number) : ''}}</p>

                    </div>

                  </div>

                </div> -->

    </div>

</div>

@endsection