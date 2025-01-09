    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Payment Method Detail's</h5>
          </div>
            <div class="card-body">
          <!-- <form action="#" method="post" enctype="multipart/form-data">  -->
           <form action="{{url('admin/PaymentMethod/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
           
                <div class="card-header sticky-element bg-label-secondary mt-4">
                  <div class="row">
                      <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                          <input type="radio" name="payment_mode" onclick="mailsetup(1)" id="radio1" value="1" >&nbsp;&nbsp;
                          <label for="radio1"> Bank Transfer</label>
                      </div>
                      <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                          <input type="radio" name="payment_mode" id="radio2" onclick="mailsetup(2)" value="2">&nbsp;&nbsp;
                          <label for="radio2">PayPal Basic (Deactivate)</label>
                      </div>
                      <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                          <input type="radio" name="payment_mode" id="radio3" onclick="mailsetup(3)" value="3">&nbsp;&nbsp;
                          <label for="radio3">Debit/Credit Card</label>
                      </div>
                  </div>
              </div>

                <div id="bankTransfer" class="mt-4">


              <!-- <h4 class="mb-4 mt-2">1. Bank Transfer</h4> -->
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="is_show_on_order_form" class="form-label"><h5>Show on Order Form </h5></label>
                </div>
                <div class="col-md-9">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="is_show_on_order_form1" value="" type="checkbox">
                      </div>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="name" class="form-label"><h5>Display Name </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="display_name1"  type="text" placeholder="NEFT/IMPS/RTGS Transfer">
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
                        <select class="form-select" name="convert_to_for_processing1">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <!-- <a href="{{url('admin/Role/home')}}" type="button" class="btn btn-outline-danger">Discard</a> -->
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div>
              
              <!-- <h4 class="mb-4">2. PayPal Basic (Deactivate)</h4> -->
                              <div id="PayPal" class="mt-4">

              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="is_show_on_order_form" class="form-label"><h5>Show on Order Form </h5></label>
                </div>
                <div class="col-md-9">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="is_show_on_order_form2" value="" type="checkbox">
                      </div>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="name" class="form-label"><h5>Display Name </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="name2"  type="text" placeholder="PayPal">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="paypal_email" class="form-label"><h5>PayPal Email </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="paypal_email"  type="email" placeholder="PayPal@gmail.com">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="force_one_time_payments" class="form-label"><h5>Force One Time Payments </h5></label>
                </div>
                <div class="col-md-9 d-flex">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="force_one_time_payments" value="" type="checkbox">
                      </div>
                    &nbsp;&nbsp;<span>Never show the subsciption payment button </span>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="force_subscriptions" class="form-label"><h5>Force Subscriptions </h5></label>
                </div>
                <div class="col-md-9 d-flex">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="force_subscriptions" value="" type="checkbox">
                      </div>
                    &nbsp;&nbsp;<span>Hide the one time payment button when a subscription can be created </span>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="require_shipping_address" class="form-label"><h5>Require Shipping Address </h5></label>
                </div>
                <div class="col-md-9 d-flex">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="require_shipping_address" value="" type="checkbox">
                      </div>
                    &nbsp;&nbsp;<span>Check to request a shipping address from a user on PayPal's site </span>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="client_address_matching" class="form-label"><h5>Client Address Matching </h5></label>
                </div>
                <div class="col-md-9 d-flex">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="client_address_matching" value="" type="checkbox">
                      </div>
                    &nbsp;&nbsp;<span>Check to force using client profile information entered into WHMCS Paypal </span>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="api_username" class="form-label"><h5>API Username </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="api_username"  type="text" placeholder="PayPal">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="api_password" class="form-label"><h5>API Password </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="api_password"  type="password" placeholder="PayPal">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="api_signature" class="form-label"><h5>API Signature </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="api_signature"  type="text" placeholder="PayPal">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="sandbox_mode" class="form-label"><h5>Sandbox mode </h5></label>
                </div>
                <div class="col-md-9 d-flex">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="sandbox_mode" value="" type="checkbox">
                      </div>
                    &nbsp;&nbsp;<span>Check to use PayPal's Virtual Sandbox test Environment - requires a separate Sanbox tast Account </span>
                </div>
              </div>
               <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="convert_to_for_processing" class="form-label"><h5>Convert To For Processing </h5></label>
                </div>
                <div class="col-md-9">
                        <select class="form-select" name="convert_to_for_processing2">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <!-- <a href="{{url('admin/Role/home')}}" type="button" class="btn btn-outline-danger">Discard</a> -->
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div>
                <!-- <h4 class="mb-4">3. Debit/Credit Card</h4> -->

              <div id="debitcr_card" class="mt-4"> 
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="is_show_on_order_form" class="form-label"><h5>Show on Order Form </h5></label>
                </div>
                <div class="col-md-9">
                      <div class="form-check form-check-dark">
                        <input class="form-check-input" name="is_show_on_order_form" value="" type="checkbox">
                      </div>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="name" class="form-label"><h5>Display Name </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="name"  type="text" placeholder="Debit/Credit Card(india)">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="key_id" class="form-label"><h5>Key Id </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="key_id"  type="text" placeholder="rzp_live_lXutjPIZuXGqk6">
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="key_secret" class="form-label"><h5>Key Secret </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="key_secret"  type="text" placeholder="2nLKDV4yP16VemyUj9qRuBai">
                </div>
              </div>
               <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="logo_url" class="form-label"><h5>Logo URL </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="logo_url"  type="text" >
                </div>
              </div>
               <div class="row mb-4"> 
                <div class="col-md-3">
                      <label for="theme_color" class="form-label"><h5>Theme Color </h5></label>
                </div>
                <div class="col-md-9">
                        <input class="form-control" name="theme_color"  type="text" placeholder="#15A4D3" >
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
                  <!-- <a href="{{url('admin/Role/home')}}" type="button" class="btn btn-outline-danger">Discard</a> -->
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
      </div>
    <!-- /Sticky Actions -->
    </div>
 
<!-- JavaScript to handle checkbox selection -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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

<script type="text/javascript">
    $(document).ready(function(){
        var mailset = ""; // You need to set the value of mailset based on your logic

        if(mailset == 0 || mailset == 1)
        {
            $('#bankTransfer').show();
            $('#PayPal').hide();
            $('#debitcr_card').hide();

        } else if(mailset == 2)
        {
            $('#bankTransfer').hide();
            $('#PayPal').show();
            $('#debitcr_card').hide();
        }else if(mailset == 3)
        {
            $('#bankTransfer').hide();
            $('#PayPal').hide();
            $('#debitcr_card').show();
        }

    });

    function mailsetup(value){

        if (value == 1) {
            $('#bankTransfer').show();
            $('#PayPal').hide();
            $('#debitcr_card').hide();
        }else if(value == 2)
        {
            $('#bankTransfer').hide();
            $('#PayPal').show();
            $('#debitcr_card').hide();
        }else if(value == 3)
        {
            $('#bankTransfer').hide();
            $('#PayPal').hide();
            $('#debitcr_card').show();
        }

    }
</script>