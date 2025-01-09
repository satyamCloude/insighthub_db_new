@extends('layouts.admin')
@section('title', 'Order')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Order /</span> Home</h4>
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
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Order's List</h5>
      </div>
      <div class="col-md-6 text-end">
         <!-- <a href="{{url('admin/Order/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>
          <a href="{{url('admin/Order/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="{{url('admin/Order/add')}}" class="btn btn-primary mt-3 m-3">Add</a> -->
      </div>
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
            <!-- <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                  <form method="GET" action="">
                  <label>Search: <input value="{{$searchTerm}}" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div> -->
          </div>
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                               <thead>
                        <tr>
                            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                            <th>ID</th>
                            <th>Order id.</th>
                            <th>Product Name</th>
                            <!-- <th>Paid Amount</th> -->
                            <th>Total Amount</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($users) > 0)
                            @foreach($users as $key => $product)
                            @php
                                                            $checkInvoice = App\Models\Invoice::where('order_id', $product->order_number)->first();
                                                            if ($checkInvoice && ($checkInvoice->paid_amount == $checkInvoice->final_total_amt || $checkInvoice->paid_amount > $checkInvoice->final_total_amt)) {
                                                                $is_payment_recieved = 1; // fully paid
                                                            } elseif ($checkInvoice && $checkInvoice->paid_amount < $checkInvoice->final_total_amt) {
                                                                $is_payment_recieved = 2; // partially paid
                                                            } else {
                                                                $is_payment_recieved = 0; // unpaid
                                                            }
                                                        @endphp
                                <tr class="odd">
                                    <td>{{ $key + 1 }} </td>
                                    <td><a href="{{url('user/order/view/'.$product->order_number)}}">{{$product->order_number}}</a></td>
                                    <td>{{ $product->product_name}}</td>
                                    <!-- <td>@if($checkInvoice && $checkInvoice->paid_amount != 'NaN') {{$checkInvoice->paid_amount}} @else -- @endif</td> -->
                                    <td>@if($product->total_amt != 'NaN') {{$product->prefix}} {{$product->total_amt}} @else -- @endif</td>
                                    <td>@if($product->order_date) {{ date('d-m-Y', strtotime($product->order_date)) }} @endif</td>
                                    <td>
                                       @switch($product->order_status)
                                              @case('0')
                                                <span class="btn btn-warning btn-sm">Pending</span>
                                                  @break
                                              @case('1')
                                                <span class="btn btn-success btn-sm">Delivered</span>
                                                  @break
                                              @case('2')
                                                <span class="btn btn-danger btn-sm">Canceled</span>
                                                  @break
                                              @default
                                                    <span></span>
                                              @endswitch
                                    </td>
                                   <td>
                                                        
                                                        @switch($is_payment_recieved)
                                                            @case(0)
                                                                <span class="btn btn-danger btn-sm">UnPaid</span>
                                                                @break
                                                            @case(1)
                                                                <span class="btn btn-success btn-sm">Paid</span>
                                                                @break
                                                            @case(2)
                                                                <span class="btn btn-info btn-sm">Partially Paid</span>
                                                                @break
                                                            @default
                                                                <span>--</span>
                                                        @endswitch
                                                    </td>

                                    <td></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="8">No Data Found</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                         <!--      <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                               <thead>
                        <tr>
                            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                            <th>ID</th>
                            <th>Order no.</th>
                            <th>Product Name</th>
                            <th>Total Amount</th>
                            <th>Order Status</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($users) > 0)
                            @foreach($users as $key => $product)
                                <tr class="odd">
                                    <td>{{ $key + 1 }} </td>
                                    <td>{{$product->order_number}}</td>
                                   <td>
                                        {{ $product->first_name }}
                                        <br>{{$product->email}}</td> 
                                    <td>{{$product->total_amt}}</td>
                                    <td>@if($product->order_status == 0) Pending @endif @if($product->order_status == 1) Varrified @endif</td>
                                    <td>{{$product->order_date}}</td>                                   
                                </tr>
                  
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="8">No Data Found</td>
                            </tr>
                        @endif
                    </tbody>
                    </table> -->

          <!--  -->
        </div>
      </div>
    </div>
</div>
@if(Auth::user()->status == 4)
<div class="modal fade show" id="showedit" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog" style="display: block;">
</div>
@endif                             <script>
                    function downloadPDF(invoiceId) {
                        window.location.href = "{{ url('admin/Order/downloadPDF') }}/" + invoiceId;
                    }
                </script>
<script>
    $(document).ready(function () {

        $(".delete_debtcase").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Delete'
                    },
                },
                callback: function (result) {
                    if (result) {
                        window.location.href = url;
                    }
                }
            });
        });
    });
</script>

@endsection