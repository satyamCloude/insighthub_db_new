    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <button type="button" onclick="Tab(value)" value="ServiceAutomation" class="btn btn-primary3">Back</button>
            </div>
          </div>
          <form action="{{url('admin/Product/updatenew/'.$Product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4">
                <div class="col-md-6">
                  <label for="product_type_id" class="form-label">Product Type <span class="text-danger">*</span></label>
                  <select name="product_type_id" class="form-select">
                    <option value="">Select Type</option>
                    @foreach($Productype as $Prod)
                    <option @if($Product->product_type_id == $Prod->id) selected @endif value="{{$Prod->id}}">{{$Prod->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                  <select name="category_id" class="form-select">
                    <option value="">Select Category</option>
                    @foreach($Category as $Cate)
                    <option @if($Product->category_id == $Cate->id) selected @endif value="{{$Cate->id}}">{{$Cate->category_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-md-6">
                  <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                  <input type="text" @if($Product && $Product->product_name) value="{{$Product->product_name}}" @endif id="product_name" class="form-control" name="product_name" placeholder="ABC"/>
                </div>
                <div class="col-md-6">
                  <label for="url" class="form-label">Url <span class="text-danger">*</span></label>
                  <input type="text" readonly id="url" class="form-control" @if($Product && $Product->url) value="{{$Product->url}}" @endif name="url" placeholder="https://www.google.com/">
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-md-6">
                  <label for="product_tag_line" class="form-label">Product Tag Line <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" @if($Product && $Product->product_tag_line) value="{{$Product->product_tag_line}}" @endif name="product_tag_line" placeholder="ABC"/>
                </div>
                <!--  <div class="col-md-6">
                                <label for="tax" class="form-label">Tax <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" @if($Product && $Product->tax) value="{{$Product->tax}}" @endif name="tax" placeholder="ABC"/>
                            </div> -->
                <div class="col-md-6">
                  <label for="tax" class="form-label">Tax </label>
                  <select class="form-control select2" name="tax_id" placeholder="ABC">
                    <option value="">Select Tax</option>
                    @foreach($TaxSettings as $TaxSetting)
                    <option @if($Product->tax_id == $TaxSetting->id) selected @endif value="{{$TaxSetting->id}}">{{ucfirst($TaxSetting->tax_name)}} - {{$TaxSetting->rate}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-4">
                <!--  <div class="col-md-6">
                                <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                                <select name="payment_method" class="form-select">
                                    <option value="">Select Method</option>
                                    @foreach($PaymentMethod as $Method)
                                    <option @if($Product->payment_method == $Method->id) selected @endif value="{{$Method->id}}">{{$Method->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                             -->
               <!--  <div class="col-md-6">
                  <label for="payment_method" class="form-label">Payment Method </label>
                  <select name="payment_method[]" class="form-control select2" multiple>
                    <option value="">Select Method</option>
                    @foreach($PaymentMethod as $Method)
                    <option @if($Product->payment_method == $Method->id) selected @endif value="{{ $Method->id }}">{{ $Method->name }}</option>
                    @endforeach
                  </select>
                </div> -->

                <div class="col-md-3">
                  <label for="display_on_frontend" class="form-label">Display on frontend </label><br>
                  <input type="checkbox" @if($Product->display_on_frontend == "1") checked @endif name="display_on_frontend"/>
                </div>
               <!--  <div class="col-md-3">
                  <label for="product_image" class="form-label">Product Image <span class="text-danger">*</span> <a @if($Product && $Product->product_image) href="{{$Product->product_image}}" @endif><i class="fa-solid fa-download"></i></a></label>
                  <input type="file" class="form-control" name="product_image" />
                </div> -->
              </div>

              <div class="row mb-4">
                <div class="col-md-12">
                  <label for="product_description" class="form-label">Product Description<span class="text-danger">*</span></label>
                  <!-- Add required attribute directly to the textarea -->
                  <textarea name="description" id="description" class="form-control" required>@if($Product && $Product->description) {{$Product->description}} @endif</textarea>
                </div>
              </div>

              <hr>
              <h5 class="mb-4">2. Pricing</h5>
              <div class="row mb-4">
                <div class="col-md-2">
                  <label for="payment_type" class="form-label">Payment Type <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-3">
                  <label for="free" class="form-label">
                    <input type="radio" <?php echo ($Product && $Product->payment_type == 1) ? 'checked' : ''; ?> required onclick="free()" name="payment_type" value="1" />&nbsp;&nbsp;Free
                  </label>
                </div>
                <div class="col-md-3">
                  <label for="one_time" class="form-label">
                    <input type="radio" <?php echo ($Product && $Product->payment_type == 2)  ? 'checked' : ''; ?> onclick="onetime('{{$Product->id}}')" @if($Product && $Product->pricing) data-price="{{$Product->pricing}}" @endif name="payment_type" value="2" />&nbsp;&nbsp;One Time
                  </label>
                </div>
                <div class="col-md-3">
                  <label for="recurring" class="form-label">
                    <input type="radio" <?php echo ($Product && $Product->payment_type == 3)  ? 'checked' : ''; ?> onclick="recurring()" name="payment_type" value="3" />&nbsp;&nbsp;Recurring
                  </label>
                </div>
              </div>

              <div class="mb-4 paymenttype">
                
              </div>

              <hr>
              <h5 class="mb-4">3. Addons</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="addons" class="form-label">Addon<span class="text-danger">*</span></label>
                    <select name="addon_id[]" class="form-control select2" id="addons"  multiple>
                        <option value="">Select Method</option>
                        @foreach($Products as $Method)
                            <option value="{{ $Method->id }}" @if(in_array($Method->id, $Product->addon)) selected @endif>{{ $Method->product_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

              <div class="card-footer">
                <div class="row mb-4">
                  <div class="col-md-6 text-end">
                    <button type="button" onclick="Tab(value)" value="ServiceAutomation" class="btn btn-outline-danger">Discard</button>
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

    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        CKEDITOR.replace('description', {
          extraPlugins: 'scayt',
          scayt_autoStartup: true,
        });


        $('form').submit(function(e) {
          // e.preventDefault();

          // Get CKEditor instance
          var editor1 = CKEDITOR.instances['description'].getData();

          if (editor1.trim() === '') {
            // Show error message or handle validation as needed
            alert('Product description is required.');
            // Prevent form submission
            return false;
          } else {
            return true;
          }
        });
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#product_name').on('input', function() {
          // Get the value of the category_name input
          var categoryNameValue = $(this).val();

          // Update the value of the url input with the base URL and the category name
          $('#url').val("{{ url('/') }}" + '/' + categoryNameValue);
        });
      });
      $(document).ready(function() {
        // Check which radio button is checked initially
        var checkedValue = $('input[name="payment_type"]:checked').val();
        // Call the corresponding function based on the checked radio button value
        switch (checkedValue) {
          case '1':
            free();
            break;
          case '2':
            var price = $('input[name="payment_type"]:checked').data('price');
            onetime(price);
            break;
          case '3':
            recurring();
            break;
          default:
            // Handle default case if needed
            break;
        }
      });
    </script>

    <script>
      function free() {
        var paymenttype = 1;
        var plan_type = 'free';
        $.ajax({
          type: 'GET',
          data: {
            plan_type: plan_type,
            paymenttype: paymenttype
          },
          url: "{{url('admin/Product/currency')}}", // Laravel route for fetching states
          success: function(data) {
            console.log(data);
            $('.paymenttype').html('');

          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });

      }

      function onetime(value) {
        
        var paymenttype = 2;
        var plan_type = 'onetime';
        $.ajax({
          type: 'GET',
          data: {
            plan_type: plan_type,
            paymenttype: paymenttype,
             p_id: "{{$Product->id}}"
          },
          url: "{{url('admin/Product/currency')}}", // Laravel route for fetching states
          success: function(data) {
            console.log(data);
            $('.paymenttype').html(data);

          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });

      }

      function recurring() {
        var paymenttype = 3;
        var plan_type = 'recurring';

        $.ajax({
          type: 'GET',
          data: {
            plan_type: plan_type,
            paymenttype: paymenttype,
            p_id: "{{$Product->id}}"
          },
          url: "{{url('admin/Product/currency')}}", // Laravel route for fetching states
          success: function(data) {
            console.log(data);
            $('.paymenttype').html(data);

          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }


       $(document).ready(function() {
            // Initialize all select2 elements
            $('.select2').select2();
        });



    </script>