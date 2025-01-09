@extends('layouts.admin')
@section('title', 'GoogleWorkSpace')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">GoogleWorkSpace /</span> Add</h4>
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
                            <span class="bs-stepper-title">Payment</span>
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
                            <span class="bs-stepper-title">Login Credintial</span>
                            <span class="bs-stepper-subtitle">Details</span>
                          </span>
                        </button>
                      </div>
                      <div class="line">
                        <i class="ti ti-chevron-right"></i>
                      </div>
                      <div class="step" data-target="#license-links-validation">
                        <button type="button" class="step-trigger">
                          <span class="bs-stepper-circle">4</span>
                          <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Email </span>
                            <span class="bs-stepper-subtitle">Details</span>
                          </span>
                        </button>
                      </div>
                      <div class="line">
                        <i class="ti ti-chevron-right"></i>
                      </div>
                      <div class="step" data-target="#Access-links-validation">
                        <button type="button" class="step-trigger">
                          <span class="bs-stepper-circle">5</span>
                          <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Access </span>
                            <span class="bs-stepper-subtitle">Management</span>
                          </span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <form id="wizard-validation-form" method="post" action="{{url('admin/GoogleWorkSpace/update/'.$GoogleWorkSpace->id)}}" enctype="multipart/form-data">
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
                                <select class="form-control" name="customer_id">
                                    @foreach($Client as $Clients)
                                    <option @if($GoogleWorkSpace && $GoogleWorkSpace->customer_id == $Clients->id) selected @endif value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_id">Product/Services </label>
                                <select class="form-control" name="product_id">
                                    @foreach($Product as $Produ)
                                    <option @if($GoogleWorkSpace && $GoogleWorkSpace->product_id == $Produ->id) selected @endif value="{{$Produ->id}}">{{$Produ->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="quantity">Quantity  <span class="text-danger">*</span></label>
                                <input type="number" class="form-control"  @if($GoogleWorkSpace && $GoogleWorkSpace->quantity) value="{{$GoogleWorkSpace->quantity}}" @endif  name="quantity">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="domain_name_tenant_id">Domain Name/Tenant ID  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  @if($GoogleWorkSpace && $GoogleWorkSpace->domain_name_tenant_id) value="{{$GoogleWorkSpace->domain_name_tenant_id}}" @endif  name="domain_name_tenant_id">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="vender_id">Vendor Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="vender_id">
                                    @foreach($Vendor as $Vend)
                                    <option @if($GoogleWorkSpace && $GoogleWorkSpace->vender_id == $Vend->id) selected @endif value="{{$Vend->id}}">{{$Vend->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="service_type">
                                    <option @if($GoogleWorkSpace && $GoogleWorkSpace->service_type == '1') selected @endif  value="1">Managed</option>
                                    <option @if($GoogleWorkSpace && $GoogleWorkSpace->service_type == '2') selected @endif value="2">Un-Managed</option>
                                </select>
                            </div>                    
                            <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Data Center</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="customer_id2">Customer ID</label>
                              <input type="text"name="customer_id2" @if($GoogleWorkSpace && $GoogleWorkSpace->customer_id2) value="{{$GoogleWorkSpace->customer_id2}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="subscription_id">Subscription ID</label>
                              <input type="text"name="subscription_id" @if($GoogleWorkSpace && $GoogleWorkSpace->subscription_id) value="{{$GoogleWorkSpace->subscription_id}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-control" name="status">
                                    @foreach($Status as $Status)
                                    <option @if($GoogleWorkSpace && $GoogleWorkSpace->status == $Status->id) selected @endif value="{{$Status->id}}">{{$Status->status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="google_notes">Google Notes</label>
                               <div class="editor-container">
                                    <div class="full-editor geteditor"> @if($GoogleWorkSpace && $GoogleWorkSpace->google_notes) {!!$GoogleWorkSpace->google_notes!!} @endif </div>
                                    <input type="hidden" name="google_notes" @if($GoogleWorkSpace && $GoogleWorkSpace->google_notes) value="{{$GoogleWorkSpace->google_notes}}" @endif  class="hidden-field">
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
                            <h6 class="mb-0">Payment Details</h6>
                            <small>Enter Your Details.</small>
                          </div>
                          <div class="row g-3">
                             <div class="col-sm-6">
                              <label class="form-label" for="first_payment">First Payment</label>
                              <input type="number"name="first_payment"  @if($GoogleWorkSpace && $GoogleWorkSpace->first_payment) value="{{$GoogleWorkSpace->first_payment}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="billing_cycle">Billing Cycle</label>
                              <select class="form-select select2 select2-hidden-accessible" name="billing_cycle" tabindex="-1" aria-hidden="true">
                                  <option @if($GoogleWorkSpace && $GoogleWorkSpace->billing_cycle == 'one_time') selected @endif value="one_time">One Time</option>
                                  <option @if($GoogleWorkSpace && $GoogleWorkSpace->billing_cycle == 'hourly') selected @endif value="hourly">Hourly</option>
                                  <option @if($GoogleWorkSpace && $GoogleWorkSpace->billing_cycle == 'Monthly') selected @endif value="Monthly">Monthly</option>
                                  <option @if($GoogleWorkSpace && $GoogleWorkSpace->billing_cycle == 'quartely') selected @endif value="quartely">Quartely</option>
                                  <option @if($GoogleWorkSpace && $GoogleWorkSpace->billing_cycle == 'semi_annually') selected @endif value="semi_annually">Semi-Annually</option>
                                  <option @if($GoogleWorkSpace && $GoogleWorkSpace->billing_cycle == 'annually') selected @endif value="annually">Annually</option>
                                  <option @if($GoogleWorkSpace && $GoogleWorkSpace->billing_cycle == 'biennially') selected @endif value="biennially">Biennially</option>
                                  <option @if($GoogleWorkSpace && $GoogleWorkSpace->billing_cycle == 'triennially') selected @endif value="triennially">Triennially</option>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="currency_id">Currency</label>
                              <select class="form-control" name="currency_id">
                                @foreach($Currency as $Currency)
                                    <option @if($GoogleWorkSpace && $GoogleWorkSpace->currency_id == $Currency->id) selected @endif value="{{$Currency->id}}">{{$Currency->prefix}} {{$Currency->code}}</option>
                                    @endforeach

                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="payment_method_id">Payment Method</label>
                              <select class="form-control" name="payment_method_id">
                                    @foreach($PaymentMethod as $PaymentMethod)
                                    <option @if($GoogleWorkSpace && $GoogleWorkSpace->payment_method_id == $PaymentMethod->id) selected @endif value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="signup_date">SignUp Date</label>
                              <input type="date"name="signup_date" @if($GoogleWorkSpace && $GoogleWorkSpace->signup_date) value="{{$GoogleWorkSpace->signup_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="next_due_date">Next Due Date</label>
                              <input type="date"name="next_due_date" @if($GoogleWorkSpace && $GoogleWorkSpace->next_due_date) value="{{$GoogleWorkSpace->next_due_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="terminate_date">Terminate Date</label>
                              <input type="date"name="terminate_date" @if($GoogleWorkSpace && $GoogleWorkSpace->terminate_date) value="{{$GoogleWorkSpace->terminate_date}}" @endif class="form-control"/>
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
                            <h6 class="mb-0">Login Credintial</h6>
                            <small>Enter Your  Details.</small>
                          </div>
                          <div class="row g-3">
                              <div class="col-sm-6">
                                <label class="form-label" for="login_url">Login URL</label>
                                <input type="text"name="login_url" @if($GoogleWorkSpace && $GoogleWorkSpace->login_url) value="{{$GoogleWorkSpace->login_url}}" @endif class="form-control"/>
                              </div>
                              <div class="col-sm-6">
                                <label class="form-label" for="username">User Name</label>
                                <input type="text"name="username" @if($GoogleWorkSpace && $GoogleWorkSpace->username) value="{{$GoogleWorkSpace->username}}" @endif class="form-control"/>
                              </div>
                              <div class="col-sm-6">
                                <label class="form-label" for="passwrod">Password</label>
                                <input type="password"name="passwrod" class="form-control"/>
                              </div>
                              
                            <div class="col-12 d-flex justify-content-between">
                              <button  type="button" class="btn btn-label-secondary btn-prev">
                                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                             <button  type="button" class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ti ti-arrow-right"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- license  Links -->
                        <div id="license-links-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Email</h6>
                            <small>Enter Your  Details.</small>
                          </div>
                          <div class="row g-3">
                              <div class="col-sm-12">
                              <label class="form-label" for="email">Email</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor"> @if($GoogleWorkSpace && $GoogleWorkSpace->email) {!!$GoogleWorkSpace->email!!} @endif </div>
                                    <input type="hidden" name="email" @if($GoogleWorkSpace && $GoogleWorkSpace->email) value="{{$GoogleWorkSpace->email}}" @endif  class="hidden-field">
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
                        <!-- Access  Links -->
                        <div id="Access-links-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Access Management</h6>
                            <small>Enter Your Details.</small>
                          </div>
                          <div class="row g-3">
                              <div class="col-sm-12">
                              <label class="form-label" for="employee_id">Employee</label>
                            <select class="form-control select2" name="employee_id[]" multiple >
                                    @foreach($Employee as $Employee)
                                        <option @if($GoogleWorkSpace && in_array($Employee->id, explode(',',$GoogleWorkSpace->employee_id))) selected @endif value="{{$Employee->id}}">{{$Employee->first_name}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                              <button type="button" class="btn btn-label-secondary btn-prev">
                                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                               <button type="submit" class="btn btn-success btn-next btn-submit">Submit</button>
                               
                            </div>
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