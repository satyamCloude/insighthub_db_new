@extends('layouts.admin')
@section('title', 'Create')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Switch /</span> Add</h4>
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
                            <span class="bs-stepper-title">Network</span>
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
                            <span class="bs-stepper-title">Console</span>
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
                            <span class="bs-stepper-title">Access </span>
                            <span class="bs-stepper-subtitle">Management</span>
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
                            <span class="bs-stepper-title">Admin</span>
                            <span class="bs-stepper-subtitle">Notes</span>
                          </span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <form id="wizard-validation-form" method="post" action="{{url('admin/Switchs/store')}}" >
                        @csrf
                        <!-- Account Details -->
                        <div id="account-details-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">General Details</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="customer_name">Customer Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="customer_id" required>
                                    
                                    @foreach($Client as $Clients)
                                    <option value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_id">Product </label>
                                <select class="form-control" name="product_id">
                                   
                                    @foreach($Product as $Produ)
                                    <option value="{{$Produ->id}}">{{$Produ->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="host_domain_name">Host Name  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="host_name" required>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="switch_id">Switch ID <span class="text-danger">*</span></label>
                              <input type="number"name="switch_id" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="vender_id">Vendor Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="vender_id" required>
                                    
                                    @foreach($Vendor as $Vend)
                                    <option value="{{$Vend->id}}">{{$Vend->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="service_type">
                                   
                                    <option value="1">Managed</option>
                                    <option value="2">Un-Managed</option>
                                </select>
                            </div>
                            <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Payment Details</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="first_payment">First Payment</label>
                              <input type="number" name="first_payment" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="recurring_amount">Recurring Amount</label>
                              <input type="number" name="recurring_amount" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="billing_cycle">Billing Cycle</label>
                              <select class="form-select select2 select2-hidden-accessible" name="billing_cycle" tabindex="-1" aria-hidden="true">
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
                              <label class="form-label" for="payment_method_id">Payment Method</label>
                              <select class="form-control" name="payment_method_id">
                                
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
                            <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Data Center</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="modal_no">Modal No</label>
                              <input type="number"name="modal_no" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="hardware_tag">Hardware Tag</label>
                              <input type="text"name="hardware_tag" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="no_of_ports">No of Ports</label>
                              <input type="number"name="no_of_ports" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rack_id">Rack ID</label>
                              <select class="form-control" name="rack_id">
                                   
                                    @foreach($Rack as $racks)
                                    <option value="{{$racks->id}}">{{$racks->rack_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="unit_no">Unit No</label>
                              <input type="number"name="unit_no" class="form-control"/>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="floor_name">Floor Name</label>
                              <input type="text"name="floor_name" class="form-control"/>
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
                            <h6 class="mb-0">Network Details</h6>
                            <small>Enter Your Details.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="primary_public_ip">Primary Public IP <span class="text-danger">*</span></label>
                              <select class="form-control" name="primary_public_ip">
                                    
                                    @foreach($primary_public_ip as $primary_public)
                                    <option value="{{$primary_public->id}}">{{$primary_public->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="additional_public_ip">Additional Public IP</label>
                              <select class="form-control" name="additional_public_ip">
                                   
                                    @foreach($additional_public_ip as $additional_public)
                                    <option value="{{$additional_public->id}}">{{$additional_public->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="primary_private_ip">Primary Private IP <span class="text-danger">*</span></label>
                              <select class="form-control" name="primary_private_ip">
                                   
                                    @foreach($primary_private_ip as $primary_private)
                                    <option value="{{$primary_private->id}}">{{$primary_private->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="additional_private_ip">Additional Private IP</label>
                              <select class="form-control" name="additional_private_ip">
                                   
                                    @foreach($additional_private_ip as $additional_private)
                                    <option value="{{$additional_private->id}}">{{$additional_private->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Login Credential</h6>
                            <small>Enter Your Credential Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="login_url">Login URL</label>
                              <input type="text"name="login_url" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="user_name">User Name</label>
                              <input type="text"name="user_name" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="password">Password</label>
                              <input type="Password"name="password" class="form-control"/>
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
                            <h6 class="mb-0">Console</h6>
                            <small>Enter Your Console Details.</small>
                          </div>
                          <div class="row g-3">                            
                            <div class="col-sm-12">
                              <label class="form-label" for="console">Console Notes</label>
                               <div class="editor-container">
                                    <div class="full-editor geteditor"></div>
                                    <input type="hidden" name="console" class="hidden-field">
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
                        <!-- license  Links -->
                        <div id="license-links-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Access  Management</h6>
                            <small>Enter Your  Details.</small>
                          </div>
                          <div class="row g-3">
                              <div class="col-sm-12">
                              <label class="form-label" for="employee_id">Employee</label>
                            <select class="form-control select2" name="employee_id[]" multiple >
                                
                                    @foreach($Employee as $Employee)
                                    <option value="{{$Employee->id}}">{{$Employee->first_name}}</option>
                                    @endforeach
                              </select>
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
                            <h6 class="mb-0">Admin Notes</h6>
                            <small>Enter Your Firewall Details.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-md-12">
                                  <label for="status" class="form-label">status <span class="text-danger">*</span></label>
                                  <select class="form-control" name="status">
                                    
                                    <option value="1">Active</option>
                                    <option value="2">Suspended</option>
                                    <option value="3">Terminated</option>
                                  </select>
                            </div>
                              <div class="col-sm-12 mb-5">
                                    <label for="firewall_note" class="form-label">Firewall Notes <span class="text-danger">*</span></label>
                                      <div class="editor-container">
                                        <div class="full-editor geteditor"></div>
                                          <input type="hidden" name="firewall_note" class="hidden-field">
                                      </div>
                              </div>
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