@extends('layouts.admin')
@section('title', 'Order')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Order /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Order's List</h5>
      </div>
    <!--   <div class="col-md-6 text-end">
         <a href="{{url('admin/Order/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>
          <a href="{{url('admin/Order/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
          <a href="{{url('admin/Order/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
      </div> -->
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                  <form method="GET" action="">
                  <label>Search: <input value="{{$searchTerm}}" type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
              </div>
            </div>
          </div>
                              <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                               <thead>
                        <tr>
                            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($products) > 0)
                            @foreach($products as $key => $product)
                                <tr class="odd">
                                    <td>{{ $key + 1 }} </td>
                                    <td>{{$product->product_name}}</td>
                                    <td>@if($product->payment_type == 1) Free @endif @if($product->payment_type == 2 && $product->onetime_inr) {{$product->onetime_inr}} @endif @if($product->payment_type == 2 && $product->onetime_usd) {{$product->onetime_usd}} @endif 
                                    @if($product->payment_type == 3 && $product->recurr_inr_hourly) {{$product->recurr_inr_hourly}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_inr_monthly) {{$product->recurr_inr_monthly}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_inr_quartely) {{$product->recurr_inr_quartely}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_inr_semiannually) {{$product->recurr_inr_semiannually}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_inr_annually) {{$product->recurr_inr_annually}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_inr_biennially) {{$product->recurr_inr_biennially}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_inr_triennially) {{$product->recurr_inr_triennially}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_usd_hourly) {{$product->recurr_usd_hourly}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_usd_monthly) {{$product->recurr_usd_monthly}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_usd_quartely) {{$product->recurr_usd_quartely}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_usd_semiannually) {{$product->recurr_usd_semiannually}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_usd_annually) {{$product->recurr_usd_annually}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_usd_biennially) {{$product->recurr_usd_biennially}} @endif
                                     @if($product->payment_type == 3 && $product->recurr_usd_triennially) {{$product->recurr_usd_triennially}} @endif
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

          <div class="p-1" style="float: right;">
              {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
</div>
                              <script>
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