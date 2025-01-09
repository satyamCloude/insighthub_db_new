@extends('layouts.admin')
@section('title', 'Payment Method')
@section('content')
<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Payment Method /</span></h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Payment Method Detail's</h5>
          </div>
            <div class="card-body">
          <form action="{{url('Employee/Role/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
              <h4 class="mb-4 mt-2">1. Bank Transfer</h4>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="order_form" class="form-label"><h5>Show on Order Form </h5></label>
                </div>
                <div class="col-md-9">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="order_form" value="" type="checkbox">
                      </div>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="display_name" class="form-label"><h5>Display Name </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="display_name"  type="text" placeholder="NEFT/IMPS/RTGS Transfer">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="bank_transfer_instructions" class="form-label"><h5>Bank Transfer Instructions </h5></label>
                </div>
                <div class="col-md-9">
                        <textarea class="form-control" name="bank_transfer_instructions"></textarea>
                        <span class="small">The instructions you want displaying to customers who choose this payment method. The invoice number will be show underneath the text entered above</span>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="convert_to_for_processing" class="form-label"><h5>Convert To For Processing </h5></label>
                </div>
                <div class="col-md-9">
                        <select class="form-select" name="convert_to_for_processing">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <!-- <a href="{{url('Employee/Role/home')}}" type="button" class="btn btn-outline-danger">Discard</a> -->
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
              </form>
              <hr>
              <h4 class="mb-4">2. PayPal Basic (Deactivate)</h4>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="order_form" class="form-label"><h5>Show on Order Form </h5></label>
                </div>
                <div class="col-md-9">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="order_form" value="" type="checkbox">
                      </div>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="display_name" class="form-label"><h5>Display Name </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="display_name"  type="text" placeholder="PayPal">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="PayPal_email" class="form-label"><h5>PayPal Email </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="PayPal_email"  type="email" placeholder="PayPal@gmail.com">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="order_form" class="form-label"><h5>Force One Time Payments </h5></label>
                </div>
                <div class="col-md-9 d-flex">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="order_form" value="" type="checkbox">
                      </div>
                    &nbsp;&nbsp;<span>Never show the subsciption payment button </span>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="order_form" class="form-label"><h5>Force Subscriptions </h5></label>
                </div>
                <div class="col-md-9 d-flex">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="order_form" value="" type="checkbox">
                      </div>
                    &nbsp;&nbsp;<span>Hide the one time payment button when a subscription can be created </span>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="order_form" class="form-label"><h5>Require Shipping Address </h5></label>
                </div>
                <div class="col-md-9 d-flex">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="order_form" value="" type="checkbox">
                      </div>
                    &nbsp;&nbsp;<span>Check to request a shipping address from a user on PayPal's site </span>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="order_form" class="form-label"><h5>Client Address Matching </h5></label>
                </div>
                <div class="col-md-9 d-flex">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="order_form" value="" type="checkbox">
                      </div>
                    &nbsp;&nbsp;<span>Check to force using client profile information entered into WHMCS Paypal </span>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="API_Username" class="form-label"><h5>API Username </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="API_Username"  type="text" placeholder="PayPal">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="API_Password" class="form-label"><h5>API Password </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="API_Password"  type="password" placeholder="PayPal">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="API Signature" class="form-label"><h5>API Signature </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="API Signature"  type="text" placeholder="PayPal">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="order_form" class="form-label"><h5>Sandbox mode </h5></label>
                </div>
                <div class="col-md-9 d-flex">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="order_form" value="" type="checkbox">
                      </div>
                    &nbsp;&nbsp;<span>Check to use PayPal's Virtual Sandbox test Environment - requires a separate Sanbox tast Account </span>
                </div>
              </div>
               <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="convert_to_for_processing" class="form-label"><h5>Convert To For Processing </h5></label>
                </div>
                <div class="col-md-9">
                        <select class="form-select" name="convert_to_for_processing">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <!-- <a href="{{url('Employee/Role/home')}}" type="button" class="btn btn-outline-danger">Discard</a> -->
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
                <hr>
              <h4 class="mb-4">3. Debit/Credit Card</h4>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="order_form" class="form-label"><h5>Show on Order Form </h5></label>
                </div>
                <div class="col-md-9">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="order_form" value="" type="checkbox">
                      </div>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="display_name" class="form-label"><h5>Display Name </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="display_name"  type="text" placeholder="Debit/Credit Card(india)">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="display_name" class="form-label"><h5>Key Id </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="display_name"  type="text" placeholder="rzp_live_lXutjPIZuXGqk6">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="display_name" class="form-label"><h5>Key Secret </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="display_name"  type="text" placeholder="2nLKDV4yP16VemyUj9qRuBai">
                </div>
              </div>
               <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="display_name" class="form-label"><h5>Logo URL </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="display_name"  type="text" >
                </div>
              </div>
               <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="display_name" class="form-label"><h5>Theme Color </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="display_name"  type="text" placeholder="#15A4D3" >
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="convert_to_for_processing" class="form-label"><h5>Convert To For Processing </h5></label>
                </div>
                <div class="col-md-9">
                        <select class="form-select" name="convert_to_for_processing">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <!-- <a href="{{url('Employee/Role/home')}}" type="button" class="btn btn-outline-danger">Discard</a> -->
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div>          
        </div>
      </div>
    </div>
    <!-- /Sticky Actions -->
  </div>
  <!-- JavaScript to handle checkbox selection -->
<script>
    $(document).ready(function () {
        $('#customCheckDark').change(function () {
            var isChecked = $(this).prop('checked');
            $('input[name="id[]"]').prop('checked', isChecked);
        });

        $('input[name="id[]"]').change(function () {
            if (!$(this).prop('checked')) {
                $('#customCheckDark').prop('checked', false);
            } else {
                // Check if all checkboxes are checked
                if ($('input[name="id[]"]:checked').length === $('input[name="id[]"]').length) {
                    $('#customCheckDark').prop('checked', true);
                }
            }
        });
    });
</script>
@endsection