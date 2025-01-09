<style>
    #disabl {
        display: none !important;
    }
</style>

  

      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
      
            <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
              <h5 class="card-title mb-sm-0 me-2 p-2">Add Detail's</h5>
            </div>
            <form action="{{url('admin/CompanySettings/store')}}" method="post" enctype="multipart/form-data"> 
                @csrf
                <div class="card-body">
                  <div class="row mt-4"> 
                    <div class="col-sm-6 mb-4">
                        <label for="project_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->company_name) value="{{$CompanyLogin->company_name}}" @endif name="company_name" required/>
                    </div>

                    <div class="col-sm-6 mb-4">
                        <label for="project_name" class="form-label">Company Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" @if($CompanyLogin && $CompanyLogin->email_address) value="{{$CompanyLogin->email_address}}" @endif  name="email_address" required/>
                    </div> 
                    <div class="col-sm-6 mb-4">
                        <label for="project_name" class="form-label">Company Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->contact_no) value="{{$CompanyLogin->contact_no}}" @endif name="contact_no" required/>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <label for="project_name" class="form-label">Company Website<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->company_website) value="{{$CompanyLogin->company_website}}" @endif name="company_website" required/>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <label for="project_name" class="form-label">Country<span class="text-danger">*</span></label>
                        <select class="form-control" name="country_id" id="country_id">
                            @foreach($Country as $country)
                                <option @if($CompanyLogin && $CompanyLogin->country_id == $country->id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6 mb-4">
                        <label for="project_name" class="form-label">State<span class="text-danger">*</span></label>
                        <select class="form-control" name="state_id" id="state_id">
                                <option value="0">Select</option>
                        </select>
                    </div>

                    <div class="col-sm-6 mb-4">
                        <label for="project_name" class="form-label">City<span class="text-danger">*</span></label>
                        <select class="form-control" name="city_id">
                                                                       <option value="0">Select</option>

                        </select>
                    </div>

                   <!--  <div class="col-sm-6 mb-4">
                          <label for="project_name" class="form-label">Location<span class="text-danger">*</span></label>
                         <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->location) value="{{$CompanyLogin->location}}" @endif name="location" required/>
                    </div> -->
                    <div class="col-sm-6 mb-4">
                        <label for="project_name" class="form-label">GST Number<span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}" />
                        <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->gst_number) value="{{$CompanyLogin->gst_number}}" @endif name="gst_number" required />
                        <div class="invalid-feedback">Invalid GST number</div>
                    </div>

                    <div class="col-sm-6 mb-4">
                          <label for="project_name" class="form-label">Tan Number<span class="text-danger">*</span></label>
                         <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->tan_number) value="{{$CompanyLogin->tan_number}}" @endif name="tan_number" required/>

                    </div>
                    <div class="col-sm-6 mb-4">
                        <label for="project_name" class="form-label">Pan Number<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->pan_number) value="{{$CompanyLogin->pan_number}}" @endif name="pan_number" required />
                        <div class="invalid-feedback">Invalid PAN number</div>
                    </div>
                     <div class="col-sm-6 mb-4">
                        <label for="pin_code" class="form-label">Pin code<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" @if($CompanyLogin && $CompanyLogin->pin_code) value="{{$CompanyLogin->pin_code}}" @endif name="pin_code" required />
                    </div>

                   <!--   <div class="col-sm-6 mb-4">
                          <label for="project_name" class="form-label">Latitude<span class="text-danger">*</span></label>
                         <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->latitude) value="{{$CompanyLogin->latitude}}" @endif name="latitude" required/>

                    </div>
                     <div class="col-sm-6 mb-4">
                          <label for="project_name" class="form-label">Longitude<span class="text-danger">*</span></label>
                         <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->longitude) value="{{$CompanyLogin->longitude}}" @endif name="longitude" required/>
                    </div> -->
                    <!-- <div class="col-sm-12 mb-4">
                          <label for="billing_address" class="form-label">Billing Address <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="billing_address"> @if($CompanyLogin && $CompanyLogin->billing_address) {{$CompanyLogin->billing_address}} @endif</textarea>


                    </div> -->
                    <div class="col-sm-12 mb-4">
                          <label for="billing_address" class="form-label">Billing Address <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="billing_address" name="billing_address">@if($CompanyLogin && $CompanyLogin->billing_address){{$CompanyLogin->billing_address}} @endif</textarea>


                    </div>
                    <!-- <div class="col-sm-12 mb-4">
                          <label for="address2" class="form-label">Address 2<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="address2"> @if($CompanyLogin && $CompanyLogin->address1) {{$CompanyLogin->address1}} @endif</textarea>
                    </div> -->
                  </div>               
                </div>               
                <div class="card-footer">
                  <div class="row mb-4"> 
                    <div class="col-md-5 text-end" >
                      <!-- <a href="{{url('admin/LeadSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a> -->
                    </div>
                    <div class="col-md-7">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
                </div> 
            </form>
         </div>
      </div>
                   
            
 <script>
    $(document).ready(function () {
        // GST number validation regex
        var gstRegex = /^([0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1})$/;

        // Function to validate GST number
        function validateGST(gstNumber) {
            return gstRegex.test(gstNumber);
        }

        // Bind the validation on input change
        $('input[name="gst_number"]').on('input', function () {
            var gstInput = $(this).val();
            var isValidGST = validateGST(gstInput);

            if (isValidGST) {
                // GST number is valid
                $(this).removeClass('is-invalid').addClass('is-valid');
                $('.btn-success').attr('disabled',false);
            } else {
                // GST number is invalid
                $('.btn-success').attr('disabled',true);
                $(this).removeClass('is-valid').addClass('is-invalid');
            }
        });
    });
    $(document).ready(function() {

        var countryId = $('#country_id').val();

        $.ajax({
            type: 'GET',
            url: "{{url('admin/CompanySettings/getStates')}}" +'/'+ countryId, // Laravel route for fetching states
            success: function(data) {
                $('select[name="state_id"]').empty();
                $('select[name="state_id"]').append('<option value="0" disabled selected>Select</option>');
                $.each(data.data, function(key, value) {
                    if(value.id == "{{$CompanyLogin->state_id}}"){
                        var selected="selected";
                    }else{
                        var selected="";
                    }
                    $('select[name="state_id"]').append('<option value="' + value.id +  '" '+selected+'>' + value.name + '</option>');
                });

                var state_id = "{{$CompanyLogin->state_id}}";
                $.ajax({
                    type: 'GET',
                    url: "{{url('admin/CompanySettings/getCity')}}" +'/'+ state_id, // Laravel route for fetching states
                    success: function(data) {
                        $('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append('<option value="0" disabled selected>Select</option>');
                        $.each(data.data, function(key, value) {
                            if(value.id == "{{$CompanyLogin->city_id}}"){
                                var selected="selected";
                            }else{
                                var selected="";
                            }
                            $('select[name="city_id"]').append('<option value="' + value.id + '" '+ selected+'>' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });


        


        // Event listener for country dropdown change
        $('#country_id').change(function() {
            var countryId = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{url('admin/CompanySettings/getStates')}}" +'/'+ countryId, // Laravel route for fetching states
                 success: function(data) {
                        console.log(data);
                        $('select[name="state_id"]').empty();
                        $('select[name="state_id"]').append('<option value="0" disabled selected>Select</option>');
                        $.each(data.data, function(key, value) {
                            $('select[name="state_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
            });
        });
          $('#state_id').change(function() {
            var countryId = $('#country_id').val();
            var state_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{url('admin/CompanySettings/getCity')}}" +'/'+ state_id, // Laravel route for fetching states
                 success: function(data) {
                        console.log(data);
                        $('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append('<option value="0" disabled selected>Select</option>');
                        $.each(data.data, function(key, value) {
                            $('select[name="city_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
            });
        });
    });

    $(document).ready(function () {
        // PAN number validation regex
        var panRegex = /^([A-Z]{5}[0-9]{4}[A-Z]{1})$/;

        // Function to validate PAN number
        function validatePAN(panNumber) {
            return panRegex.test(panNumber);
        }

        // Bind the validation on input change
        $('input[name="pan_number"]').on('input', function () {
            var panInput = $(this).val();
            var isValidPAN = validatePAN(panInput);

            if (isValidPAN) {
                // PAN number is valid
                $(this).removeClass('is-invalid').addClass('is-valid');
                $('.btn-success').attr('disabled',false);
            } else {
                // PAN number is invalid
                $(this).removeClass('is-valid').addClass('is-invalid');
                $('.btn-success').attr('disabled',true);
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        // PIN code validation regex (accepts exactly 6 digits)
        var pinRegex = /^[0-9]{6}$/;

        // Function to validate PIN code
        function validatePIN(pinCode) {
            return pinRegex.test(pinCode);
        }

        // Bind the validation on input change
        $('input[name="pin_code"]').on('input', function () {
            var pinInput = $(this).val();
            var isValidPIN = validatePIN(pinInput);

            if (isValidPIN) {
                // PIN code is valid
                $(this).removeClass('is-invalid').addClass('is-valid');
                $('.btn-success').attr('disabled',false);
            } else {
                // PIN code is invalid
                $(this).removeClass('is-valid').addClass('is-invalid');
                $('.btn-success').attr('disabled',true);
            }
        });
    });
</script>
