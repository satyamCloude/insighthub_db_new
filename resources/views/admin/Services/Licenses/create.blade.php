@extends('layouts.admin')
@section('title', 'Licenses')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Licenses /</span> Add</h4>
  <div class="col-12 mb-4"1>
    <div id="wizard-validation" class="bs-stepper mt-2">

      <div class="bs-stepper-content">
        <form  method="post" action="{{url('admin/Licenses/store')}}" enctype="multipart/form-data">
          @csrf
          <!-- Account Details -->
         <!--  <div class="content-header mb-3">
            <h6 class="mb-0">General Details</h6>
            <small>Enter Your Details Here.</small>
          </div> -->
          <div class="row g-3">
            <div class="col-sm-6">
              <label class="form-label" for="customer_id">Customer Name <span class="text-danger">*</span></label>
              <select class="form-control select2" name="customer_id" required>
                @foreach($Client as $Clients)
                <option value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="product_id">Product/Services </label>
              <select class="form-control select2" name="product_id">
                @foreach($Product as $Produ)
                <option value="{{$Produ->id}}">{{$Produ->product_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="host_domain_name">Host/Domain Name  <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="host_domain_name" required>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="vender_id">Vendor Name <span class="text-danger">*</span></label>
              <select class="form-control select2" name="vender_id" required>
                @foreach($Vendor as $Vend)
                <option value="{{$Vend->id}}">{{$Vend->first_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
              <select class="form-control select2" name="service_type">
                <option value="1">Managed</option>
                <option value="2">Un-Managed</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="tenant_id">Tenant ID <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="tenant_id" required>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="customer_id2">Customer ID <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="customer_id2" required>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="subscription_id">Subscription ID <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="subscription_id" required>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="quantity">Quantity <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="quantity" required>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="status">Status</label>
              <select class="form-control select2" name="status">
                @foreach($Status as $Status)
                <option value="{{$Status->id}}">{{$Status->status}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="Licenses_note">Licenses  Note</label>
              <div class="editor-container">
                <!-- <div class="full-editor geteditor"></div> -->
                <textarea name="Licenses_note" class="form-control"></textarea>
              </div>
            </div>
            <div class="row g-3">
             <div class="col-sm-6">
              <label class="form-label" for="first_payment">First Payment</label>
              <input type="number"name="first_payment" class="form-control"/>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="billing_cycle">Billing Cycle</label>
              <select class="form-select select2" name="billing_cycle" tabindex="-1" aria-hidden="true">
                <option value="one_time">One Time</option>
                <option value="hourly">Hourly</option>
                <option value="Monthly">Monthly</option>
                <option value="quartely">Quartely</option>
                <option value="semi_annually">Semi-Annually</option>
                <option value="annually">Annually</option>
                <option value="biennially">Biennially</option>
                <option value="triennially">Triennially</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="currency_id">Currency</label>
              <select class="form-control select2" name="currency_id">
                @foreach($Currency as $Currency)
                <option value="{{$Currency->id}}">{{$Currency->prefix}} {{$Currency->code}}</option>
                @endforeach

              </select>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="payment_method_id">Payment Method</label>
              <select class="form-control select2" name="payment_method_id">
                @foreach($PaymentMethod as $PaymentMethod)
                <option value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="signup_date">SignUp Date</label>
              <input type="date"name="signup_date" class="form-control"/>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="next_due_date">Next Due Date</label>
              <input type="date"name="next_due_date" class="form-control"/>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="terminate_date">Terminate Date</label>
              <input type="date"name="terminate_date" class="form-control"/>
            </div>
             <div class="col-sm-6">
              <label class="form-label" for="protal_url">Portal URL  <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="protal_url" required>
            </div>


          </div>
          <div class="row g-3">
           
            <div class="col-sm-6">
              <label class="form-label" for="username">User Name  <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="username" required>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="password">Password  <span class="text-danger">*</span></label>
              <input type="password" class="form-control" name="password" required>
            </div>
          </div>
          <div class="row g-3">
            <div class="col-sm-12">
              <label class="form-label" for="license_management">License Management</label>
              <div class="editor-container">
                <!-- <div class="full-editor geteditor"></div> -->
                <textarea name="license_management" class="form-control"></textarea>
              </div>
            </div>

          </div>
          <div class="row g-3">
            <div class="col-sm-12">
              <label class="form-label" for="employee_id">Employee</label>
              <select class="form-control select2" name="employee_id">
                @foreach($Employee as $Employee)
                <option value="{{$Employee->id}}">{{$Employee->first_name}}</option>
                @endforeach
              </select>
            </div>

          </div>
          <div class="row g-3 mt-2">
            <div class="col-12 d-flex justify-content-between">
             <!--  <button type="button" class="btn btn-label-secondary btn-prev" disabled>
                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
              </button> -->
              <button type="submit" class="btn btn-primary btn-next">
                <span class="align-middle d-sm-inline-block d-none me-sm-1">Submit</span>
                <!-- <i class="ti ti-arrow-right"></i> -->
              </button>
            </div>
          </div>
        </div>
        <!-- Personal Info -->

      </form>
    </div>
  </div>
</div>
</div>
<script>
  $(document).ready(function () {
    // Function to update the hidden field based on the editor content
    function updateHiddenField(index) {
      var editorContentText = $(".full-editor.geteditor").eq(index).html();
      console.log("Editor " + (index + 1) + " Text content: " + editorContentText);

      // Update the value of the hidden field based on the index
      $('.hidden-field').eq(index).val(editorContentText);
    }

    // Use event delegation to handle keyup and blur on any .full-editor.geteditor
    $(document).on('keyup blur', '.full-editor.geteditor', function () {
      // Get the index of the editor
      var index = $(".full-editor.geteditor").index(this);

      // Update the corresponding hidden field
      updateHiddenField(index);
    });
  });
</script>
@endsection