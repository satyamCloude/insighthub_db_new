@extends('layouts.admin')
@section('title', 'One Time Setup')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">One Time Setup /</span> Edit</h4>
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
                            <span class="bs-stepper-title">Login Credential</span>
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
                            <span class="bs-stepper-title">License </span>
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
                            <span class="bs-stepper-title">Access </span>
                            <span class="bs-stepper-subtitle">Management</span>
                          </span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <form id="wizard-validation-form" method="post" action="{{url('Employee/OneTimeSetup/update/'.$OneTimeSetup->id)}}" enctype="multipart/form-data">
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
                                <select class="form-control" name="customer_id">
                                    <option value="0">Select Name</option>
                                    @foreach($Client as $Clients)
                                    <option @if($OneTimeSetup && $OneTimeSetup->customer_id == $Clients->id) selected @endif value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_id">Product/Services </label>
                                <select class="form-control" name="product_id">
                                    <option value="0">Select Name</option>
                                    @foreach($Product as $Produ)
                                    <option @if($OneTimeSetup && $OneTimeSetup->product_id == $Produ->id) selected @endif value="{{$Produ->id}}">{{$Produ->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="host_domain_name">Host/Domain Name  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" @if($OneTimeSetup && $OneTimeSetup->host_domain_name) value="{{$OneTimeSetup->host_domain_name}}" @endif name="host_domain_name">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="os_id">Operating System <span class="text-danger">*</span></label>
                                <select class="form-control" name="os_id">
                                    <option value="0">Select OS</option>
                                    @foreach($OperatingSysten as $operat)
                                    <option @if($OneTimeSetup && $OneTimeSetup->os_id == $operat->id) selected @endif value="{{$operat->id}}">{{$operat->ostype}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="vender_id">Vendor Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="vender_id">
                                    <option value="0">Select Name</option>
                                    @foreach($Vendor as $Vend)
                                    <option @if($OneTimeSetup && $OneTimeSetup->vender_id == $Vend->id) selected @endif value="{{$Vend->id}}">{{$Vend->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="service_type">
                                    <option value="0">Select Type</option>
                                    <option @if($OneTimeSetup && $OneTimeSetup->service_type == '1') selected @endif value="1">Managed</option>
                                    <option @if($OneTimeSetup && $OneTimeSetup->service_type == '2') selected @endif value="2">Un-Managed</option>
                                </select>
                            </div>
                            <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Payment Details</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="first_payment">First Payment</label>
                              <input type="text"name="first_payment" @if($OneTimeSetup && $OneTimeSetup->first_payment) value="{{$OneTimeSetup->first_payment}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="billing_cycle">Billing Cycle</label>
                              <select class="form-select select2 select2-hidden-accessible" name="billing_cycle" tabindex="-1" aria-hidden="true">
                                  <option @if($OneTimeSetup && $OneTimeSetup->billing_cycle == 'one_time') selected @endif value="one_time">One Time</option>
                                  <option @if($OneTimeSetup && $OneTimeSetup->billing_cycle == 'hourly') selected @endif value="hourly">Hourly</option>
                                  <option @if($OneTimeSetup && $OneTimeSetup->billing_cycle == 'Monthly') selected @endif value="Monthly">Monthly</option>
                                  <option @if($OneTimeSetup && $OneTimeSetup->billing_cycle == 'quartely') selected @endif value="quartely">Quartely</option>
                                  <option @if($OneTimeSetup && $OneTimeSetup->billing_cycle == 'semi_annually') selected @endif value="semi_annually">Semi-Annually</option>
                                  <option @if($OneTimeSetup && $OneTimeSetup->billing_cycle == 'annually') selected @endif value="annually">Annually</option>
                                  <option @if($OneTimeSetup && $OneTimeSetup->billing_cycle == 'biennially') selected @endif value="biennially">Biennially</option>
                                  <option @if($OneTimeSetup && $OneTimeSetup->billing_cycle == 'triennially') selected @endif value="triennially">Triennially</option>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="currency_id">Currency</label>
                              <select class="form-control" name="currency_id">
                                <option value="0">Select Currency</option>
                                @foreach($Currency as $Currency)
                                    <option @if($OneTimeSetup && $OneTimeSetup->currency_id == $Currency->id) selected @endif value="{{$Currency->id}}">{{$Currency->prefix}} {{$Currency->code}}</option>
                                    @endforeach

                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="payment_method_id">Payment Method</label>
                              <select class="form-control" name="payment_method_id">
                                <option value="0">Select Payment</option>
                                    @foreach($PaymentMethod as $PaymentMethod)
                                    <option @if($OneTimeSetup && $OneTimeSetup->payment_method_id == $PaymentMethod->id) selected @endif value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="signup_date">SignUp Date</label>
                              <input type="date"name="signup_date"  @if($OneTimeSetup && $OneTimeSetup->signup_date) value="{{$OneTimeSetup->signup_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="next_due_date">Next Due Date</label>
                              <input type="date"name="next_due_date"  @if($OneTimeSetup && $OneTimeSetup->next_due_date) value="{{$OneTimeSetup->next_due_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="terminate_date">Terminate Date</label>
                              <input type="date"name="terminate_date"  @if($OneTimeSetup && $OneTimeSetup->terminate_date) value="{{$OneTimeSetup->terminate_date}}" @endif class="form-control"/>
                            </div>
                            <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Data Center</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-control" name="status">
                                    <option value="0">Select Status</option>
                                    @foreach($Status as $Status)
                                    <option @if($OneTimeSetup && $OneTimeSetup->status == $Status->id) selected @endif value="{{$Status->id}}">{{$Status->status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="onetimesetup_notes">One Time Setup Notes</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor"> @if($OneTimeSetup && $OneTimeSetup->onetimesetup_notes) {!!$OneTimeSetup->onetimesetup_notes!!} @endif</div>
                                    <input type="hidden" name="onetimesetup_notes" @if($OneTimeSetup && $OneTimeSetup->onetimesetup_notes) value="{{$OneTimeSetup->onetimesetup_notes}}" @endif class="hidden-field">
                                </div>
                            </div>
                        </div>
                          <div class="row g-3 mt-2">
                            <div class="col-12 d-flex justify-content-between">
                              <button type="button"  class="btn btn-label-secondary btn-prev" disabled>
                                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                              <button type="button"  class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ti ti-arrow-right"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- Personal Info -->
                        <div id="personal-info-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">To Do Details</h6>
                            <small>Enter Your Details.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-12">
                              <label class="form-label" for="todo_notes">To Do  Notes</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor"> @if($OneTimeSetup && $OneTimeSetup->todo_notes) {!!$OneTimeSetup->todo_notes!!} @endif </div>
                                    <input type="hidden" name="todo_notes" @if($OneTimeSetup && $OneTimeSetup->todo_notes) value="{{$OneTimeSetup->todo_notes}}" @endif  class="hidden-field">
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
                            <h6 class="mb-0">Control Panel Login Credential</h6>
                            <small>Enter Your Data Center Details.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_login_url">Control Panel Login URL</label>
                              <input type="text"name="control_panel_login_url" @if($OneTimeSetup && $OneTimeSetup->control_panel_login_url) value="{{$OneTimeSetup->control_panel_login_url}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_user_name">Control Panel User Name</label>
                              <input type="text"name="control_panel_user_name" @if($OneTimeSetup && $OneTimeSetup->control_panel_user_name) value="{{$OneTimeSetup->control_panel_user_name}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_password">Control Panel Password</label>
                              <input type="Password"name="control_panel_password"  class="form-control"/>
                            </div>
                             <hr>
                            <div class="content-header mb-3">
                              <h6 class="mb-0">RDP/SSH Credential</h6>
                              <small>Enter Your Details.</small>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_username">RDP/SSH User Name</label>
                              <input type="text"name="rdp_ssh_username" @if($OneTimeSetup && $OneTimeSetup->rdp_ssh_username) value="{{$OneTimeSetup->rdp_ssh_username}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_port">RDP/SSH Port</label>
                              <input type="text"name="rdp_ssh_port" @if($OneTimeSetup && $OneTimeSetup->rdp_ssh_port) value="{{$OneTimeSetup->rdp_ssh_port}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_password">RDP/SSH Password</label>
                              <input type="Password"name="rdp_ssh_password" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="server_ip">Server IP</label>
                              <input type="text"name="server_ip" @if($OneTimeSetup && $OneTimeSetup->server_ip) value="{{$OneTimeSetup->server_ip}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_url">Control Panel URL</label>
                              <input type="text"name="control_panel_url" @if($OneTimeSetup && $OneTimeSetup->control_panel_url) value="{{$OneTimeSetup->control_panel_url}}" @endif class="form-control"/>
                            </div>
                             <hr>
                            <div class="content-header mb-3">
                              <h6 class="mb-0">Login Authentication</h6>
                              <small>Enter Your Details.</small>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="pemkey">PemKey</label> <a type="button" href="{{ $OneTimeSetup->pemkey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file" name="pemkey" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="Privatekey">PrivateKey</label>  <a type="button" href="{{ $OneTimeSetup->Privatekey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file" name="Privatekey" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="publickey">PublicKey</label> <a type="button" href="{{ $OneTimeSetup->publickey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file" name="publickey" class="form-control"/>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="addon">Addon</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor"> @if($OneTimeSetup && $OneTimeSetup->addon) {!!$OneTimeSetup->addon!!} @endif</div>
                                    <input type="hidden" name="addon" @if($OneTimeSetup && $OneTimeSetup->addon) value="{{$OneTimeSetup->addon}}" @endif class="hidden-field">
                                </div>
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
                            <h6 class="mb-0">License Management</h6>
                            <small>Enter Your  Details.</small>
                          </div>
                          <div class="row g-3">
                              <div class="col-sm-12">
                              <label class="form-label" for="license_management">License Management</label>
                              <input type="text"  @if($OneTimeSetup && $OneTimeSetup->license_management) value="{{$OneTimeSetup->license_management}}" @endif  name="license_management" class="form-control"/>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                              <button type="button"  class="btn btn-label-secondary btn-prev">
                                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                              <button type="button"  class="btn btn-primary btn-next">
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
                                    <option value="0">Select Employee</option>
                                    @foreach($Employee as $Employee)
                                    <option @if($OneTimeSetup && in_array($Employee->id, explode(',',$OneTimeSetup->employee_id))) selected @endif value="{{$Employee->id}}">{{$Employee->first_name}}</option>
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