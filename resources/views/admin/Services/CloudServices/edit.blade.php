@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">CloudServices /</span> Edit</h4>
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
                      <form id="wizard-validation-form" method="post" action="{{url('admin/CloudServices/update/'.$CloudServices->id)}}" enctype="multipart/form-data">
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
                                   
                                    @foreach($Client as $Clients)
                                    <option @if($CloudServices && $CloudServices->customer_id == $Clients->id) selected @endif value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_id">Product/Services </label>
                                <select class="form-control" name="product_id">
                                   
                                    @foreach($Product as $Produ)
                                    <option @if($CloudServices && $CloudServices->product_id == $Produ->id) selected @endif value="{{$Produ->id}}">{{$Produ->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="host_domain_name">Host/Domain Name  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" @if($CloudServices && $CloudServices->host_domain_name) value="{{$CloudServices->host_domain_name}}" @endif name="host_domain_name">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="os_id">Operating System <span class="text-danger">*</span></label>
                                <select class="form-control" name="os_id">
                                   
                                    @foreach($OperatingSysten as $operat)
                                    <option @if($CloudServices && $CloudServices->os_id == $operat->id) selected @endif value="{{$operat->id}}">{{$operat->ostype}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="vender_id">Vendor Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="vender_id">
                                   
                                    @foreach($Vendor as $Vend)
                                    <option @if($CloudServices && $CloudServices->vender_id == $Vend->id) selected @endif value="{{$Vend->id}}">{{$Vend->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="service_type">
                                   
                                    <option @if($CloudServices && $CloudServices->service_type == '1') selected @endif value="1">Managed</option>
                                    <option @if($CloudServices && $CloudServices->service_type == '2') selected @endif value="2">Un-Managed</option>
                                </select>
                            </div>
                            <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Payment Details</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="first_payment">First Payment</label>
                              <input type="number"name="first_payment" @if($CloudServices && $CloudServices->first_payment) value="{{$CloudServices->first_payment}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="billing_cycle">Billing Cycle</label>
                              <select class="form-select select2 select2-hidden-accessible" name="billing_cycle" tabindex="-1" aria-hidden="true">
                                  <option @if($CloudServices && $CloudServices->billing_cycle == 'one_time') selected @endif value="one_time">One Time</option>
                                  <option @if($CloudServices && $CloudServices->billing_cycle == 'hourly') selected @endif value="hourly">Hourly</option>
                                  <option @if($CloudServices && $CloudServices->billing_cycle == 'Monthly') selected @endif value="Monthly">Monthly</option>
                                  <option @if($CloudServices && $CloudServices->billing_cycle == 'quartely') selected @endif value="quartely">Quartely</option>
                                  <option @if($CloudServices && $CloudServices->billing_cycle == 'semi_annually') selected @endif value="semi_annually">Semi-Annually</option>
                                  <option @if($CloudServices && $CloudServices->billing_cycle == 'annually') selected @endif value="annually">Annually</option>
                                  <option @if($CloudServices && $CloudServices->billing_cycle == 'biennially') selected @endif value="biennially">Biennially</option>
                                  <option @if($CloudServices && $CloudServices->billing_cycle == 'triennially') selected @endif value="triennially">Triennially</option>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="currency_id">Currency</label>
                              <select class="form-control" name="currency_id">
                                @foreach($Currency as $Currency)
                                    <option @if($CloudServices && $CloudServices->currency_id == $Currency->id) selected @endif value="{{$Currency->id}}">{{$Currency->prefix}} {{$Currency->code}}</option>
                                    @endforeach

                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="payment_method_id">Payment Method</label>
                              <select class="form-control" name="payment_method_id">
                               
                                    @foreach($PaymentMethod as $PaymentMethod)
                                    <option @if($CloudServices && $CloudServices->payment_method_id == $PaymentMethod->id) selected @endif value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="signup_date">SignUp Date</label>
                              <input type="date"name="signup_date"  @if($CloudServices && $CloudServices->signup_date) value="{{$CloudServices->signup_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="next_due_date">Next Due Date</label>
                              <input type="date"name="next_due_date"  @if($CloudServices && $CloudServices->next_due_date) value="{{$CloudServices->next_due_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="terminate_date">Terminate Date</label>
                              <input type="date"name="terminate_date"  @if($CloudServices && $CloudServices->terminate_date) value="{{$CloudServices->terminate_date}}" @endif class="form-control"/>
                            </div>
                            <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Data Center</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                          <div class="col-sm-6">
                              <label class="form-label" for="bare_metal_id">Bare Metal (VT)</label>
                              <select class="form-control" name="bare_metal_id">
                                    @foreach($BareMetal as $BareMetals)
                                    <option @if($CloudServices && $CloudServices->bare_metal_id  == $BareMetals->id) selected @endif value="{{$BareMetals->id}}">{{$BareMetals->product_name}}</option>
                                    @endforeach
                              </select>
                            </div> 
                            <div class="col-sm-6">
                              <label class="form-label" for="dc_location">DC Location</label>
                              <select class="form-control" name="dc_location">
                                    @foreach($Country as $Country)
                                    <option @if($CloudServices && $CloudServices->dc_location  == $Country->country_id) selected @endif value="{{$Country->country_id}}">{{$Country->country_name}}</option>
                                    @endforeach
                              </select>
                            </div> 
                             <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Switches $ Firewalls</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                           <div class="col-sm-6">
                              <label class="form-label" for="firewall_serial_id">Firewall Serial No</label>
                              <select class="form-control" name="firewall_serial_id">
                                    @foreach($firewall as $fire)
                                    <option @if($CloudServices && $CloudServices->firewall_serial_id  == $fire->id) selected @endif value="{{$fire->id}}">{{$fire->firewall_serial_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="switch_id">Switch ID</label>
                              <select class="form-control" name="switch_id">
                                    @foreach($Switchs as $Switc)
                                    <option @if($CloudServices && $CloudServices->switch_id  == $Switc->id) selected @endif value="{{$Switc->id}}">{{$Switc->switch_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="swith_port">Switch Port</label>
                              <input type="text"name="swith_port"  @if($CloudServices && $CloudServices->swith_port) value="{{$CloudServices->swith_port}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="firewall_port">Firewall Port</label>
                              <input type="text"name="firewall_port" @if($CloudServices && $CloudServices->firewall_port) value="{{$CloudServices->firewall_port}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-control" name="status">
                                    @foreach($Status as $Status)
                                    <option @if($CloudServices && $CloudServices->status  == $Status->id) selected @endif value="{{$Status->id}}">{{$Status->status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="vps_notes">VPS Notes</label>
                               <div class="editor-container">
                                    <div class="full-editor geteditor"> @if($CloudServices && $CloudServices->vps_notes) {!!$CloudServices->vps_notes!!} @endif </div>
                                    <input type="hidden" name="vps_notes" @if($CloudServices && $CloudServices->vps_notes) {{$CloudServices->vps_notes}} @endif  class="hidden-field">
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
                            <h6 class="mb-0">Network Details</h6>
                            <small>Enter Your Details.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="primary_public_ip">Primary Public IP <span class="text-danger">*</span></label>
                              <select class="form-control" name="primary_public_ip">
                                   
                                    @foreach($public_ip as $ip)
                                    <option @if($CloudServices && $CloudServices->primary_public_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="additional_public_ip">Additional Public IP</label>
                              <select class="form-control" name="additional_public_ip">
                                   
                                    @foreach($public_ip as $ip)
                                    <option @if($CloudServices && $CloudServices->additional_public_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="primary_private_ip">Primary Private IP <span class="text-danger">*</span></label>
                              <select class="form-control" name="primary_private_ip">
                                   
                                    @foreach($private_ip as $ip)
                                    <option @if($CloudServices && $CloudServices->primary_private_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="additional_private_ip">Additional Private IP</label>
                              <select class="form-control" name="additional_private_ip">
                                   
                                    @foreach($private_ip as $ip)
                                    <option @if($CloudServices && $CloudServices->additional_private_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Login Credential</h6>
                            <small>Enter Your Credential Here.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="ip_kvm_console">IP KVM Console</label>
                              <input type="text"name="ip_kvm_console" @if($CloudServices && $CloudServices->ip_kvm_console) value="{{$CloudServices->ip_kvm_console}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="ip_kvm_username">User Name</label>
                              <input type="text"name="ip_kvm_username" @if($CloudServices && $CloudServices->ip_kvm_username) value="{{$CloudServices->ip_kvm_username}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="ip_kvm_password">Password</label>
                              <input type="Password"name="ip_kvm_password" class="form-control"/>
                            </div>
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
                        <!-- Social Links -->
                        <div id="social-links-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Control Panel Login Credential</h6>
                            <small>Enter Your Data Center Details.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="hosting_control_panel">Hosting Control Panel</label>
                              <input type="text"name="hosting_control_panel" @if($CloudServices && $CloudServices->hosting_control_panel) value="{{$CloudServices->hosting_control_panel}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_user_name">Control Panel User Name</label>
                              <input type="text"name="control_panel_user_name" @if($CloudServices && $CloudServices->control_panel_user_name) value="{{$CloudServices->control_panel_user_name}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_password">Control Panel Password</label>
                              <input type="Password"name="control_panel_password" class="form-control"/>
                            </div>
                             <hr>
                            <div class="content-header mb-3">
                              <h6 class="mb-0">RDP/SSH Credential</h6>
                              <small>Enter Your Details.</small>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_username">RDP/SSH User Name</label>
                              <input type="text"name="rdp_ssh_username" @if($CloudServices && $CloudServices->rdp_ssh_username) value="{{$CloudServices->rdp_ssh_username}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_port">RDP/SSH Port</label>
                              <input type="text"name="rdp_ssh_port"  @if($CloudServices && $CloudServices->rdp_ssh_port) value="{{$CloudServices->rdp_ssh_port}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_password">RDP/SSH Password</label>
                              <input type="Password"name="rdp_ssh_password" class="form-control"/>
                            </div>
                             <hr>
                            <div class="content-header mb-3">
                              <h6 class="mb-0">Login Authentication</h6>
                              <small>Enter Your Details.</small>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="pemkey">PemKey</label> <a type="button" href="{{$CloudServices->pemkey}}"><i class="fa-solid fa-download"></i></a> 
                              <input type="file"name="pemkey" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="Privatekey">PrivateKey</label> <a type="button" href="{{$CloudServices->Privatekey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file"name="Privatekey" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="publickey">PublicKey</label> <a type="button" href="{{$CloudServices->publickey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file"name="publickey" class="form-control"/>
                            </div>
                             <div class="col-sm-12">
                              <label class="form-label" for="addon">Login Notes</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor"> @if($CloudServices && $CloudServices->addon) {!!$CloudServices->addon!!} @endif </div>
                                    <input type="hidden" name="addon" @if($CloudServices && $CloudServices->addon) {{$CloudServices->addon}} @endif  class="hidden-field">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                              <button type="button"  class="btn btn-label-secondary btn-prev">
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
                            <h6 class="mb-0">License Management</h6>
                            <small>Enter Your  Details.</small>
                          </div>
                          <div class="row g-3">
                              <div class="col-sm-12">
                              <label class="form-label" for="license_management">License Management</label>
                              <input type="text"  @if($CloudServices && $CloudServices->license_management) value="{{$CloudServices->license_management}}" @endif  name="license_management" class="form-control"/>
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
                                   
                                    @foreach($Employee as $Employee)
                                   <option @if($CloudServices && in_array($Employee->id, explode(',',$CloudServices->employee_id))) selected @endif value="{{$Employee->id}}">{{$Employee->first_name}}</option>

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