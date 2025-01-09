@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')

<style>
  .btmtable th {
    background-color: #eae8fd  !important;
}

thead, tbody, tfoot, tr, td, th {
    padding: 6px !important;
}
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-2"> Manage Orders</h4>
    
    
    
    <div class="mb-4 px-3">
        <!--<div class="card-header d-flex justify-content-between align-items-center">-->
        <!--    <h5 class="card-title m-0"> </h5>-->
            <!--<h6 class="m-0"><a href="{{url('admin/Orders/home')}}">Back</a></h6>-->
        <!--</div>-->
        <div class="row border border-2 rounded">
            <div class="col-6">
                <div class="row">
                    <div class="col-6 text-end p-1">Date</div>
                    <div class="col-6 bg-light p-1 border-bottom">{{ date("d/m/Y H:i", strtotime($Order->created_at)) }}</div>
                    
                    <div class="col-6 text-end p-1">Order #</div>
                    <div class="col-6 bg-light p-1 border-bottom">{{ $Order->id }}</div>
                    
                    <div class="col-6 text-end p-1">Client</div>
                    <div class="col-6 bg-light p-1 border-bottom">
                        @if($client){{$client->first_name}} {{$client->last_name}},<br>
                        {{$client->address_1}} {{$client->address_2}} @endif<br>
                    </div>
                    
                    <div class="col-6 text-end p-1">Order PLaced By</div>
                    <div class="col-6 bg-light p-1  border-bottom">
                        @if($user) 
                            @if($user->id == 1) Admin: @endif
                            {{$user->first_name}} {{$user->last_name}} (ID: {{$user->id}}) 
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6 ">
                <div class="row">
                    <div class="col-6 text-end p-1">Payment Method</div>
                    <div class="col-6 bg-light p-1 border-bottom">
                        @if($Order)
                            @if($Order->bank_account == 1)
                            Bank Transfer
                            @elseif($Order->bank_account == 2)
                            NEFT/IMPS/RTGS Transfer
                            @else
                            Debit/Credit
                            @endif
                        @endif
                    </div>
                    
                    <div class="col-6 text-end p-1">Amount</div>
                    <div class="col-6 bg-light p-1 border-bottom">{{$Order->total_amt}}</div>
                        
                    <div class="col-6 text-end p-1"># Invoice</div>
                    <div class="col-6 bg-light p-1 border-bottom">
                        @if($Order->invoice_id)
                            {{$Order->invoice_id}}
                        @else
                            No invoice
                        @endif
                    </div>
                    
                    <div class="col-6 text-end p-1">Status</div>
                    <div class="col-6 bg-light p-1 border-bottom">
                        <select onchange="updatepro(this.value,`{{$Order->id}}`)" class="form-control select2" name="status_id">
                          <option value="0" {{$Order->order_status == 0 ? 'selected':''}}>Pending</option>
                          <option value="1" {{$Order->order_status == 1 ? 'selected':''}}>Accepted</option>
                          <option value="2" {{$Order->order_status == 2 ? 'selected':''}}>Declined</option>
                        </select>
                    </div>
                    
                    <!--<div class="col-6 text-end p-1">Promotion Code</div>-->
                    <!--<div class="col-6 bg-light p-1"></div>-->
                </div>
            </div>
        </div>
    </div>



    <!-- Order Details Table -->



    <div class="row">

        <div class="col-12 col-lg-12">

            <div class="card mb-4 px-2">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="card-title m-0">Order details</h5>

                    <h6 class="m-0"><a href="{{url('admin/Orders/home')}}">Back</a></h6>

                </div>

                <div class="card-datatable table-responsive">

                    <table class="datatables-order-details table border-top btmtable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>item</th>
                                <th>description</th>
                                <th>billing cycle</th>
                                <th>Amount</th>
                                <th>qty</th>
                                <th>GST/CGST</th>
                                <th>total</th>
                                <th>status</th>
                                <th>payment status</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php
                              $priceSubtotal = 0;
                              $tax = 0;
                              $quantity = 0;
                          @endphp
                          
                            @foreach($orders as $order)
                                @php
                                  // Check if $order->price and $order->rate are numeric, otherwise default to 0
                                  $price = is_numeric($order->price) ? floatval($order->price * $order->quantity) : 0;
                                   $Product_price = is_numeric($order->price) ? floatval($order->price) : 0;
                                  $rate = is_numeric($order->rate) ? floatval($order->rate) : 0;
                                  $priceSubtotal += floatval($price);
                                   if($clientDetails && $clientDetails->tax_exampt == 0)
                                  $totalGstPrice = floatval($price) * floatval($rate) / 100;
                                  else
                                  $totalGstPrice = 0;
                                  $tax += floatval($totalGstPrice);
                                  $quantity += $order->quantity;
                                @endphp
                                <tr>
                                  <td></td>
                                  <td>{{ isset($order) ? ucfirst($order->product_name) : '' }}</td>
                                  <td style="width:290px">
                                      @if($order && $order->hostname) <b>Host</b> : {{$order->hostname}}<br/><br/> @endif
                                        {!! isset($order) ? ucfirst($order->description) : '' !!}
                                  </td>
                                  <td>{{ucfirst($order->plan_type)}}</td>
                                  <td>{{ isset($order) ? number_format($Product_price , 2) : '' }}</td>
                                  <td>{{ isset($order) ? $order->quantity : 1 }}</td>
                                  <td>{{ number_format($totalGstPrice,2) }}</td>
                                  <td>{{ isset($Currency) ? $Currency->prefix : '' }}
                                   
                                      {{ number_format(($price + $totalGstPrice),2) }}
                                      {{ isset($Currency) ? $Currency->code : '' }}
                                  </td>
                                  <td>
                                    @switch($Order->order_status)
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
                                    @endswitch
                                  </td>
                                  <td>
                                      <span class="badge {!! $Order->is_payment_recieved == 1 ? 'bg-label-success' : 'bg-label-warning' !!}">
                                        {{ $Order->is_payment_recieved == 1 ? 'Paid' : 'Unpaid' }}
                                      </span>
                                  </td>
                                </tr>
                            @endforeach
                           @if($OsOrder)
                                  <tr>

                                  <td></td>
                                  <td>Operating System</td>
                                  <td>{{ isset($OsOrder) ? ucfirst($OsOrder->ostype) : '' }}</td>
                                  <td>NA</td>
                                  <td>{{ isset($OsOrder) ? number_format($OsOrder->os_price, 2) : '' }}</td>

                                  <td>1</td>

                                  @php
                                   $rate = is_numeric($OsOrder->tax_rates) ? floatval($OsOrder->tax_rates) : 0;

                                  $priceSubtotal += floatval($OsOrder->os_price);
                                    if($clientDetails && $clientDetails->tax_exampt == 0)
                                  $totalGstPriceOs = floatval($OsOrder->os_price) * floatval($rate) / 100;
                                  else
                                  $totalGstPriceOs = 0;
                                  $tax += floatval($totalGstPriceOs);
                                  $quantity += 1;

                                  @endphp
                                  <td>{{ number_format($totalGstPriceOs,2) }}</td>

                                  <td>{{ isset($Currency) ? $Currency->prefix : '' }}

                                      {{ number_format(($OsOrder->os_price + $totalGstPriceOs),2) }}

                                      {{ isset($Currency) ? $Currency->code : '' }}

                                  </td>
                                  <td>
                                    @switch($Order->order_status)
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
                                    @endswitch
                                  </td>
                                  <td>
                                      <span class="badge {!! $Order->is_payment_recieved == 1 ? 'bg-label-success' : 'bg-label-warning' !!}">
                                        {{ $Order->is_payment_recieved == 1 ? 'Paid' : 'Unpaid' }}
                                      </span>
                                  </td>
                              </tr>
                              @endif
                              <tfoot>
                              <tr style="background-color:#eae8fd;">
                                  <td ></td>
                                  <td ></td>
                                  <td ></td>
                                  <td >Total </td>
                                  <td >{{$Currency->prefix}} {{number_format($priceSubtotal,2)}}</td>
                                  <td >{{$quantity}}</td>
                                  <td >{{$Currency->prefix}} {{number_format($tax,2)}}</td>
                                  <td ><b>{{isset($Currency) ? $Currency->prefix : ''}} {{isset($order) ?
                                    number_format($priceSubtotal+$tax,2) : ''}} {{isset($Currency) ? $Currency->code :
                                    ''}}</b></td>
                                  <td ></td>
                                  <td ></td>
                              </tr>
                              </tfoot>
                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>

</div>


<script>
    function updatepro(value, id) {
        var status = "stu";
        // alert(value);
        // alert(id);
        $.ajax({
          url: "{{ url('admin/Orders/UpdateStatus') }}",
          method: 'GET',
          data: {
            id: id,
            status_pro: value,
            status: status
          },
          success: function() {
            // location.reload();
          },
          error: function() {
          }
        });
    }
</script>

@endsection