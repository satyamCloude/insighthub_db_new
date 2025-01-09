@extends('layouts.admin')
@section('title', 'Create')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Product /</span> Add</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('Employee/Product/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('Employee/Product/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="product_type_id" class="form-label">Product Type <span class="text-danger">*</span></label>
                      <select name="product_type_id" class="form-select" required>
                          <option value="">Select Type</option>
                          @foreach($Productype as $Product)
                              <option value="{{$Product->id}}">{{$Product->name}}</option>
                          @endforeach
                      </select>
                </div>
                <div class="col-md-6">
                      <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                      <select name="category_id" class="form-select" required>
                          <option value="">Select Category</option>
                          @foreach($Category as $Cate)
                              <option value="{{$Cate->id}}">{{$Cate->category_name}}</option>
                          @endforeach
                      </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                      <input type="text" id="product_name" class="form-control" name="product_name" placeholder="ABC" required/>
                </div>
                <div class="col-md-6">
                      <label for="url"  class="form-label">Url <span class="text-danger">*</span></label>
                      <input type="text" readonly id="url" class="form-control" value="{{ url('/') }}" name="url" placeholder="https://www.google.com/">
                </div>
              </div>  
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="product_tag_line" class="form-label">Product Tag Line <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="product_tag_line" placeholder="ABC" required/>
                </div>
                <div class="col-md-6">
                      <label for="tax"  class="form-label">Tax <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="tax"  placeholder="ABC" required/>
                </div>
              </div>
              <div class="row mb-4"> 
                 <div class="col-md-6">
                      <label for="payment_method"  class="form-label">Payment Method <span class="text-danger">*</span></label>
                      <select name="payment_method" class="form-select" required>
                          <option value="">Select Method</option>
                          @foreach($PaymentMethod as $Method)
                              <option value="{{$Method->id}}">{{$Method->name}}</option>
                          @endforeach
                      </select>
                </div>
                <div class="col-md-6">
                      <label for="display_on_frontend"  class="form-label">Display on frontend </label><br>
                      <input type="checkbox" name="display_on_frontend"/>
                </div>
              </div>
              <div class="row mb-4"> 
                 <div class="col-md-12">
                      <label for="product_description"  class="form-label">Product Description <span class="text-danger">*</span></label>
                      <textarea name="product_description" class="form-control"></textarea>
                </div>
              </div>
              <hr>
              <h5 class="mb-4">2. Pricing</h5>
              <div class="row mb-4"> 
                <div class="col-md-2">
                      <label for="payment_type"  class="form-label">Payment Type <span class="text-danger">*</span></label>
                </div>
                 <div class="col-md-3">
                      <label for="free"class="form-label"><input type="radio" onclick="free()" name="payment_type" value="1" />&nbsp;&nbsp;Free</label>
                </div>
                <div class="col-md-3">
                      <label for="one_time"class="form-label"><input type="radio" onclick="onetime()" name="payment_type" value="2" />&nbsp;&nbsp;One Time</label>
                </div>
                <div class="col-md-3">
                      <label for="recurring"class="form-label"><input type="radio" onclick="recurring()" name="payment_type" value="3" />&nbsp;&nbsp;Recurring</label>
                </div>
              </div>
              <div class="mb-4 paymenttype"></div>                
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('Employee/Product/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div>
    <!-- /Sticky Actions -->
  </div>
<!-- / Content -->
<script>
        $(document).ready(function () {
            $('#product_name').on('input', function () {
                // Get the value of the category_name input
                var categoryNameValue = $(this).val();

                // Update the value of the url input with the base URL and the category name
                $('#url').val("{{ url('/') }}" + '/' + categoryNameValue);
            });
        });
    </script>
<script>
   function free() {
    $('.paymenttype').html('');
}

function onetime() {
    $('.paymenttype').html('<div class="row">' +
        '<div class="col-md-2 bg-success">' +
        '<label for="Currency" class="form-label">Currency</label>' +
        '</div>' +
        '<div class="col-md-2 bg-success">' +
        '<label for="One Time" class="form-label">One Time</label>' +
        '</div>' +
        '</div>' +
        '<div class="row mt-3">' +
        '<div class="col-md-2">' +
        ' <label for="INR "class="form-label mt-3">INR</label>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input type="number" class="form-control" name="onetime_inr"  placeholder="₹" required/>' +
        '</div>' +
        '</div>' +
        ' <div class="row mt-3">' +
        '<div class="col-md-2">' +
        '<label for="USD" class="form-label mt-3">USD</label>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input type="number" class="form-control" name="onetime_usd"  placeholder="$" required/>' +
        '</div>' +
        '</div>');
}

function recurring() {
    $('.paymenttype').html(' <div class="row">' +
        '<div class="col-md-1 bg-success">' +
        ' <label for="Currency"class="form-label">Currency</label>' +
        '</div>' +
        ' <div class="col-md-1 bg-success">' +
        ' <label for="Hourly"class="form-label">Hourly</label>' +
        '</div>' +
        '<div class="col-md-1 bg-success">' +
        ' <label for="Monthly"class="form-label">Monthly</label>' +
        '</div>' +
        '<div class="col-md-1 bg-success">' +
        '<label for="Quartely"class="form-label">Quartely</label>' +
        '</div>' +
        '<div class="col-md-2 bg-success">' +
        '<label for="Semi-Annually"class="form-label">Semi-Annually</label>' +
        '</div>' +
        '<div class="col-md-2 bg-success">' +
        '<label for="Annually"class="form-label">Annually</label>' +
        '</div>' +
        '<div class="col-md-2 bg-success">' +
        '<label for="Biennially"class="form-label">Biennially</label>' +
        '</div>' +
        '<div class="col-md-2 bg-success">' +
        '<label for="Triennially"class="form-label">Triennially</label>' +
        '</div>' +
        '</div>' +
        '<div class="row mt-3">' +
        '<div class="col-md-1">' +
        '<label for="INR "class="form-label mt-3">INR</label>' +
        '</div>' +
        '<div class="col-md-1">' +
        '<input type="number" class="form-control" name="recurr_inr_hourly"  placeholder="₹" required/>' +
        '</div>' +
        '<div class="col-md-1">' +
        '<input type="number" class="form-control" name="recurr_inr_monthly"  placeholder="₹" required/>' +
        '</div>' +
        '<div class="col-md-1">' +
        '<input type="number" class="form-control" name="recurr_inr_quartely"  placeholder="₹" required/>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input type="number" class="form-control" name="recurr_inr_semiannually"  placeholder="₹" required/>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input type="number" class="form-control" name="recurr_inr_annually"  placeholder="₹" required/>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input type="number" class="form-control" name="recurr_inr_biennially"  placeholder="₹" required/>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input type="number" class="form-control" name="recurr_inr_triennially"  placeholder="₹" required/>' +
        '</div>' +
        '</div>' +
        '<div class="row mt-3">' +
        ' <div class="col-md-1">' +
        '  <label for="USD "class="form-label mt-3">USD</label>' +
        ' </div>' +
        ' <div class="col-md-1">' +
        '  <input type="number" class="form-control" name="recurr_usd_hourly"  placeholder="$" required/>' +
        ' </div>' +
        ' <div class="col-md-1">' +
        ' <input type="number" class="form-control" name="recurr_usd_monthly"  placeholder="$" required/>' +
        '</div>' +
        '<div class="col-md-1">' +
        '  <input type="number" class="form-control" name="recurr_usd_quartely"  placeholder="$" required/>' +
        '</div>' +
        '<div class="col-md-2">' +
        ' <input type="number" class="form-control" name="recurr_usd_semiannually"  placeholder="$" required/>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input type="number" class="form-control" name="recurr_usd_annually"  placeholder="$" required/>' +
        '</div>' +
        ' <div class="col-md-2">' +
        '  <input type="number" class="form-control" name="recurr_usd_biennially"  placeholder="$" required/>' +
        '</div>' +
        '<div class="col-md-2">' +
        ' <input type="number" class="form-control" name="recurr_usd_triennially"  placeholder="$" required/>' +
        '</div>' +
        '</div>');
}

</script>
@endsection