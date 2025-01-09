@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">CloudHosting /</span> Edit</h4>
                <div class="col-12 mb-4">
                  <div id="wizard-validation" class="bs-stepper mt-2">
                    <div class="bs-stepper-header">
                      <div class="step" data-target="#account-details-validation">
                        <button type="button" class="step-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">General</span>
                            <span class="bs-stepper-subtitle">Details</span>
                          </span>
                        </button>
                      </div>
                      <div class="line">
                        <i class="ti ti-chevron-right"></i>
                      </div>
                      <div class="step" data-target="#personal-info-validation">
                        <button type="button" class="step-trigger">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Login Credential</span>
                            <span class="bs-stepper-subtitle">Details</span>
                          </span>
                        </button>
                      </div>
                      <div class="line">
                        <i class="ti ti-chevron-right"></i>
                      </div>
                      <div class="step" data-target="#social-links-validation">
                        <button type="button" class="step-trigger">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Access</span>
                            <span class="bs-stepper-subtitle">Management</span>
                          </span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <form id="wizard-validation-form" method="post" action="{{url('Employee/CloudHosting/update/'.$CloudHosting->id)}}" enctype="multipart/form-data">
                        @csrf
                        <!-- Account Details -->
                        <div id="account-details-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">General Details</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="customer_id">Customer Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="customer_id" required>
                                    @foreach($Client as $Clients)
                                    <option @if($CloudHosting && $CloudHosting->customer_id == $Clients->id) selected @endif value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_id">Product/Services </label>
                                <select class="form-control" name="product_id">
                                    @foreach($Product as $Produ)
                                    <option @if($CloudHosting && $CloudHosting->product_id == $Produ->id) selected @endif value="{{$Produ->id}}">{{$Produ->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="host_domain_name">Host/Domain Name  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  @if($CloudHosting && $CloudHosting->host_domain_name) value="{{$CloudHosting->host_domain_name}}" @endif name="host_domain_name" required>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="server_name_id">Server Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="server_name_id" required>
                                    
                                    @foreach($Product as $Product)
                                    <option @if($CloudHosting && $CloudHosting->server_name_id == $Product->id) selected @endif value="{{$Product->id}}">{{$Product->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="vender_id">Vendor Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="vender_id" required>
                                    
                                    @foreach($Vendor as $Vend)
                                    <option @if($CloudHosting && $CloudHosting->vender_id == $Vend->id) selected @endif value="{{$Vend->id}}">{{$Vend->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="service_type">
                                    <option @if($CloudHosting && $CloudHosting->service_type == '1') selected @endif value="1">Managed</option>
                                    <option @if($CloudHosting && $CloudHosting->service_type == '2') selected @endif value="2">Un-Managed</option>
                                </select>
                            </div>
                            <hr>
                              @php
    // Adjust the namespace according to your model's location
    use App\Models\EmployeeDetail;

    $checkUserDepartment = EmployeeDetail::where('user_id', Auth::user()->id)->first();
@endphp

                        
                        <div class="parent" @if($checkUserDepartment && $checkUserDepartment->department_id == 1) style="display:none" @endif>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Payment Details</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="first_payment">First Payment</label>
                              <input type="number"name="first_payment" @if($CloudHosting && $CloudHosting->first_payment) value="{{$CloudHosting->first_payment}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="billing_cycle">Billing Cycle</label>
                              <select class="form-select select2 select2-hidden-accessible" name="billing_cycle" tabindex="-1" aria-hidden="true">
                                  <option @if($CloudHosting && $CloudHosting->billing_cycle == 'one_time') selected @endif value="one_time">One Time</option>
                                  <option @if($CloudHosting && $CloudHosting->billing_cycle == 'hourly') selected @endif value="hourly">Hourly</option>
                                  <option @if($CloudHosting && $CloudHosting->billing_cycle == 'Monthly') selected @endif value="Monthly">Monthly</option>
                                  <option @if($CloudHosting && $CloudHosting->billing_cycle == 'quartely') selected @endif value="quartely">Quartely</option>
                                  <option @if($CloudHosting && $CloudHosting->billing_cycle == 'semi_annually') selected @endif value="semi_annually">Semi-Annually</option>
                                  <option @if($CloudHosting && $CloudHosting->billing_cycle == 'annually') selected @endif value="annually">Annually</option>
                                  <option @if($CloudHosting && $CloudHosting->billing_cycle == 'biennially') selected @endif value="biennially">Biennially</option>
                                  <option @if($CloudHosting && $CloudHosting->billing_cycle == 'triennially') selected @endif value="triennially">Triennially</option>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="currency_id">Currency</label>
                              <select class="form-control" name="currency_id">
                                
                                @foreach($Currency as $Currency)
                                    <option @if($CloudHosting && $CloudHosting->currency_id == $Currency->id) selected @endif value="{{$Currency->id}}">{{$Currency->prefix}} {{$Currency->code}}</option>
                                    @endforeach

                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="payment_method_id">Payment Method</label>
                              <select class="form-control" name="payment_method_id">
                                
                                    @foreach($PaymentMethod as $PaymentMethod)
                                    <option @if($CloudHosting && $CloudHosting->payment_method_id == $PaymentMethod->id) selected @endif value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="signup_date">SignUp Date</label>
                              <input type="date"name="signup_date" @if($CloudHosting && $CloudHosting->signup_date) value="{{$CloudHosting->signup_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="next_due_date">Next Due Date</label>
                              <input type="date"name="next_due_date" @if($CloudHosting && $CloudHosting->next_due_date) value="{{$CloudHosting->next_due_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="terminate_date">Terminate Date</label>
                              <input type="date"name="terminate_date" @if($CloudHosting && $CloudHosting->terminate_date) value="{{$CloudHosting->terminate_date}}" @endif class="form-control"/>
                            </div>
                            <hr>
                            </div>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Data Center</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                          <div class="col-sm-6">
                              <label class="form-label" for="dc_location">DC Location</label>
                              <select class="form-control" name="dc_location">
                                
                                    @foreach($Country as $Country)
                                    <option @if($CloudHosting && $CloudHosting->dc_location == $Country->country_id) selected @endif value="{{$Country->country_id}}">{{$Country->country_name}}</option>
                                    @endforeach
                              </select>
                            </div> 
                            <div class="col-sm-6">
                              <label class="form-label" for="firewall_id">Firewall ID</label>
                              <select class="form-control" name="firewall_id">
                                    
                                    @foreach($firewall as $Firewall)
                                    <option @if($CloudHosting && $CloudHosting->firewall_id == $Firewall->id) selected @endif value="{{$Firewall->id}}">{{$Firewall->firewall_serial_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="dc_login_url">Login URL</label>
                              <input type="text"name="dc_login_url" @if($CloudHosting && $CloudHosting->dc_login_url) value="{{$CloudHosting->dc_login_url}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="dc_username">User Name</label>
                              <input type="text"name="dc_username" @if($CloudHosting && $CloudHosting->dc_username) value="{{$CloudHosting->dc_username}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="dc_password">Password</label>
                              <input type="Password"name="dc_password" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-control" name="status">
                                    @foreach($Status as $Status)
                                    <option @if($CloudHosting && $CloudHosting->status == $Status->id) selected @endif value="{{ $Status->id }}" >{{ $Status->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="cloudHosting_notes">CloudHosting Notes</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor">@if($CloudHosting && $CloudHosting->cloudHosting_notes) {!!$CloudHosting->cloudHosting_notes!!} @endif</div>
                                    <input type="hidden" name="cloudHosting_notes" @if($CloudHosting && $CloudHosting->cloudHosting_notes) value="{{$CloudHosting->cloudHosting_notes}}" @endif class="hidden-field">
                                </div>
                            </div>
                        </div>
                          <div class="row g-3 mt-2">
                            <div class="col-12 d-flex justify-content-between">
                              <button type="button" class="btn btn-label-secondary btn-prev" disabled>
                                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                              <button type="button" class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ti ti-arrow-right"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- Personal Info -->
                        <div id="personal-info-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Login Credential</h6>
                            <small>Enter Your Credential Here.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="username">User Name</label>
                              <input type="text"name="username" @if($CloudHosting && $CloudHosting->username) value="{{$CloudHosting->username}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="password">Password</label>
                              <input type="Password"name="password"  class="form-control"/>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="login_notes">Login Notes</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor">@if($CloudHosting && $CloudHosting->login_notes) {!!$CloudHosting->login_notes!!} @endif</div>
                                    <input type="hidden" name="login_notes" @if($CloudHosting && $CloudHosting->login_notes) value="{{$CloudHosting->login_notes}}" @endif class="hidden-field">
                                </div>
                            </div>
                             
                            <div class="col-12 d-flex justify-content-between">
                              <button type="button" class="btn btn-label-secondary btn-prev">
                                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                              <button type="button" class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ti ti-arrow-right"></i>
                              </button>
                            </div>
                          </div>
                          </div>
                        <!-- Social Links -->
                        <div id="social-links-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Access Management</h6>
                            <small>Enter Your Details.</small>
                          </div>
                          <div class="row g-3">
                             <div class="col-sm-12">
                              <label class="form-label" for="employee_id">Employee</label>
                            <select class="form-control select2" name="employee_id[]" multiple >
                                    
                                    @foreach($Employee as $Employee)
                                    <option @if($CloudHosting && in_array($Employee->id, explode(',',$CloudHosting->employee_id))) selected @endif value="{{$Employee->id}}">{{$Employee->first_name}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                              <button  type="button" class="btn btn-label-secondary btn-prev">
                                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </div>
                        </div>
                        <div id="license-links-validation" class="content">
                        </div>
                        <div id="Access-links-validation" class="content">
                          
                          </div>
                        </div>
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