@extends('layouts.admin')
@section('title', 'Dedicated Server')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dedicated Server /</span> Edit</h4>
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
                      <form id="wizard-validation-form" method="post" action="{{url('Employee/DedicatedServer/update/'.$DedicatedServer->id)}}" enctype="multipart/form-data">
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
                                    <option @if($DedicatedServer && $DedicatedServer->customer_id == $Clients->id) selected @endif value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_id">Product/Services </label>
                                <select class="form-control" name="product_id">
                                    
                                    @foreach($Product as $Produ)
                                    <option @if($DedicatedServer && $DedicatedServer->product_id == $Produ->id) selected @endif value="{{$Produ->id}}">{{$Produ->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="host_domain_name">Host/Domain Name  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" @if($DedicatedServer && $DedicatedServer->host_domain_name) value="{{$DedicatedServer->host_domain_name}}" @endif name="host_domain_name">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="os_id">Operating System <span class="text-danger">*</span></label>
                                <select class="form-control" name="os_id">
                                    
                                    @foreach($OperatingSysten as $operat)
                                    <option @if($DedicatedServer && $DedicatedServer->os_id == $operat->id) selected @endif value="{{$operat->id}}">{{$operat->ostype}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="vender_id">Vendor Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="vender_id">
                                    
                                    @foreach($Vendor as $Vend)
                                    <option @if($DedicatedServer && $DedicatedServer->vender_id == $Vend->id) selected @endif value="{{$Vend->id}}">{{$Vend->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="service_type">
                                    
                                    <option @if($DedicatedServer && $DedicatedServer->service_type == '1') selected @endif value="1">Managed</option>
                                    <option @if($DedicatedServer && $DedicatedServer->service_type == '2') selected @endif value="2">Un-Managed</option>
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
                              <input type="text"name="first_payment" @if($DedicatedServer && $DedicatedServer->first_payment) value="{{$DedicatedServer->first_payment}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="billing_cycle">Billing Cycle</label>
                              <select class="form-select select2 select2-hidden-accessible" name="billing_cycle" tabindex="-1" aria-hidden="true">
                                  <option @if($DedicatedServer && $DedicatedServer->billing_cycle == 'one_time') selected @endif value="one_time">One Time</option>
                                  <option @if($DedicatedServer && $DedicatedServer->billing_cycle == 'hourly') selected @endif value="hourly">Hourly</option>
                                  <option @if($DedicatedServer && $DedicatedServer->billing_cycle == 'Monthly') selected @endif value="Monthly">Monthly</option>
                                  <option @if($DedicatedServer && $DedicatedServer->billing_cycle == 'quartely') selected @endif value="quartely">Quartely</option>
                                  <option @if($DedicatedServer && $DedicatedServer->billing_cycle == 'semi_annually') selected @endif value="semi_annually">Semi-Annually</option>
                                  <option @if($DedicatedServer && $DedicatedServer->billing_cycle == 'annually') selected @endif value="annually">Annually</option>
                                  <option @if($DedicatedServer && $DedicatedServer->billing_cycle == 'biennially') selected @endif value="biennially">Biennially</option>
                                  <option @if($DedicatedServer && $DedicatedServer->billing_cycle == 'triennially') selected @endif value="triennially">Triennially</option>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="currency_id">Currency</label>
                              <select class="form-control" name="currency_id">
                                
                                @foreach($Currency as $Currency)
                                    <option @if($DedicatedServer && $DedicatedServer->currency_id == $Currency->id) selected @endif value="{{$Currency->id}}">{{$Currency->prefix}} {{$Currency->code}}</option>
                                    @endforeach

                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="payment_method_id">Payment Method</label>
                              <select class="form-control" name="payment_method_id">
                                
                                    @foreach($PaymentMethod as $PaymentMethod)
                                    <option @if($DedicatedServer && $DedicatedServer->payment_method_id == $PaymentMethod->id) selected @endif value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="signup_date">SignUp Date</label>
                              <input type="date"name="signup_date"  @if($DedicatedServer && $DedicatedServer->signup_date) value="{{$DedicatedServer->signup_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="next_due_date">Next Due Date</label>
                              <input type="date"name="next_due_date"  @if($DedicatedServer && $DedicatedServer->next_due_date) value="{{$DedicatedServer->next_due_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="terminate_date">Terminate Date</label>
                              <input type="date"name="terminate_date"  @if($DedicatedServer && $DedicatedServer->terminate_date) value="{{$DedicatedServer->terminate_date}}" @endif class="form-control"/>
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
                                    <option @if($DedicatedServer && $DedicatedServer->dc_location == $Country->country_id) selected @endif value="{{$Country->country_id}}">{{$Country->country_name}}</option>
                                    @endforeach
                              </select>
                            </div> 
                            <div class="col-sm-6">
                              <label class="form-label" for="floor_name">Floor Name</label>
                              <input type="text"name="floor_name" @if($DedicatedServer && $DedicatedServer->floor_name) value="{{$DedicatedServer->floor_name }}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                            <label class="form-label" for="rack_id">Rack ID</label>
                            <select class="form-control select2" id="rack_id" name="rack_id">
                                <option value="">Select</option>
                                @foreach($Rack as $Racks)
                                <option @if($DedicatedServer && $DedicatedServer->rack_id == $Racks->id) selected @endif value="{{ $Racks->id }}">{{ $Racks->rack_id }}</option>
                                @endforeach
                            </select>
                        </div>
                          
                              <div class="col-sm-6">
                            <label class="form-label" for="unit_no">Unit No</label>
                            <select class="form-control select2" id="unit_no" name="unit_no[]" multiple>
                                <option value="">Select Rack ID First</option>
                                <!-- Options will be populated here -->
                            </select>
                                                         <input type="hidden"name="unit_no" @if($DedicatedServer && $DedicatedServer->unit_no) value="{{$DedicatedServer->unit_no}}" @endif  class="form-control"/>

                        </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="server_serial_no">Server Serial No</label>
                              <input type="text"name="server_serial_no" @if($DedicatedServer && $DedicatedServer->server_serial_no) value="{{$DedicatedServer->server_serial_no}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="server_tag_id">Server Tag ID</label>
                              <input type="text"name="server_tag_id" @if($DedicatedServer && $DedicatedServer->server_tag_id) value="{{$DedicatedServer->server_tag_id}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_manufacturer">Product Manufacturer</label>
                              <input type="text"name="product_manufacturer" @if($DedicatedServer && $DedicatedServer->product_manufacturer) value="{{$DedicatedServer->product_manufacturer}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-control" name="status">
                                    
                                    @foreach($Status as $Status)
                                    <option @if($DedicatedServer && $DedicatedServer->status == $Status->id) selected @endif value="{{$Status->id}}">{{$Status->status}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="col-sm-12">
                              <label class="form-label" for="bare_notes">Notes</label>
                               <div class="editor-container">
                                    <div class="full-editor geteditor">@if($DedicatedServer && $DedicatedServer->bare_notes) {!!$DedicatedServer->bare_notes!!} @endif</div>
                                    <input type="hidden" name="bare_notes" @if($DedicatedServer && $DedicatedServer->bare_notes) value="{{$DedicatedServer->bare_notes}}" @endif  class="hidden-field">
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
                                    <option @if($DedicatedServer && $DedicatedServer->primary_public_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="additional_public_ip">Additional Public IP</label>
                              <select class="form-control" name="additional_public_ip">
                                    
                                    @foreach($public_ip as $ip)
                                    <option @if($DedicatedServer && $DedicatedServer->additional_public_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="primary_private_ip">Primary Private IP <span class="text-danger">*</span></label>
                              <select class="form-control" name="primary_private_ip">
                                    
                                    @foreach($private_ip as $ip)
                                    <option @if($DedicatedServer && $DedicatedServer->primary_private_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="additional_private_ip">Additional Private IP</label>
                              <select class="form-control" name="additional_private_ip">
                                    
                                    @foreach($private_ip as $ip)
                                    <option @if($DedicatedServer && $DedicatedServer->additional_private_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach

                                </select>
                            </div>
                             <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Login Credential</h6>
                            <small>Enter Your Credential Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="ilo_rmm_darc_console_url">ILO/RMM/DARC Console URL</label>
                              <input type="text"name="ilo_rmm_darc_console_url"  @if($DedicatedServer && $DedicatedServer->ilo_rmm_darc_console_url) value="{{$DedicatedServer->ilo_rmm_darc_console_url}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="username">User Name</label>
                              <input type="text"name="username"  @if($DedicatedServer && $DedicatedServer->username) value="{{$DedicatedServer->username}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="password">Password</label>
                              <input type="Password"name="password" class="form-control"/>
                            </div>
                             <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Switch $ Firewall</h6>
                            <small>Enter Your Details.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="switch_id">Switch ID</label>
                              <select class="form-control" name="switch_id">
                                    
                                    @foreach($Switchs as $Switc)
                                    <option @if($DedicatedServer && $DedicatedServer->switch_id == $Switc->id) selected @endif value="{{$Switc->id}}">{{$Switc->switch_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="swith_port">Switch Port</label>
                              <input type="text"name="swith_port"  @if($DedicatedServer && $DedicatedServer->swith_port) value="{{$DedicatedServer->swith_port}}" @endif class="form-control"/>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="firewall_serial_id">Firewall Serial No</label>
                              <select class="form-control" name="firewall_serial_id">
                                    
                                    @foreach($firewall as $fire)
                                    <option @if($DedicatedServer && $DedicatedServer->firewall_serial_id == $fire->id) selected @endif value="{{$fire->id}}">{{$fire->firewall_serial_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="firewall_port">Firewall Port</label>
                              <input type="text"name="firewall_port" @if($DedicatedServer && $DedicatedServer->firewall_port) value="{{$DedicatedServer->firewall_port}}" @endif class="form-control"/>
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
                              <input type="text"name="hosting_control_panel" @if($DedicatedServer && $DedicatedServer->hosting_control_panel) value="{{$DedicatedServer->hosting_control_panel}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_user_name">Control Panel User Name</label>
                              <input type="text"name="control_panel_user_name" @if($DedicatedServer && $DedicatedServer->control_panel_user_name) value="{{$DedicatedServer->control_panel_user_name}}" @endif class="form-control"/>
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
                              <input type="text"name="rdp_ssh_username" @if($DedicatedServer && $DedicatedServer->rdp_ssh_username) value="{{$DedicatedServer->rdp_ssh_username}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_port">RDP/SSH Port</label>
                              <input type="text"name="rdp_ssh_port"  @if($DedicatedServer && $DedicatedServer->rdp_ssh_port) value="{{$DedicatedServer->rdp_ssh_port}}" @endif class="form-control"/>
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
                              <label class="form-label" for="pemkey">PemKey</label> <a type="button" href="{{$DedicatedServer->pemkey}}"><i class="fa-solid fa-download"></i></a> 
                              <input type="file"name="pemkey" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="Privatekey">PrivateKey</label> <a type="button" href="{{$DedicatedServer->Privatekey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file"name="Privatekey" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="publickey">PublicKey</label> <a type="button" href="{{$DedicatedServer->publickey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file"name="publickey" class="form-control"/>
                            </div>
                             <div class="col-sm-12">
                              <label class="form-label" for="addon">Addon</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor"> @if($DedicatedServer && $DedicatedServer->addon) {!!$DedicatedServer->addon!!} @endif</div>
                                    <input type="hidden" name="addon" @if($DedicatedServer && $DedicatedServer->addon) value="{{$DedicatedServer->addon}}" @endif class="hidden-field">
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
                              <input type="text"  @if($DedicatedServer && $DedicatedServer->license_management) value="{{$DedicatedServer->license_management}}" @endif  name="license_management" class="form-control"/>
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
                                    <option @if($DedicatedServer && in_array($Employee->id, explode(',',$DedicatedServer->employee_id))) selected @endif value="{{$Employee->id}}">{{$Employee->first_name}}</option>
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

$(document).ready(function() {
    $('#rack_id').change(function() {
        var rackId = $(this).val();

        if (rackId) {
            $.ajax({
                url: '{{ url("Employee/Rack/vacant-units") }}/' + rackId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#unit_no').empty();
                    $('#unit_no').append('<option value="">Select</option>');
                    $.each(data, function(key, value) {
                        $('#unit_no').append('<option value="' + value + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        } else {
            $('#unit_no').empty();
            $('#unit_no').append('<option value="">Select Rack ID First</option>');
        }
    });
});
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
   function getUserDetails(id) {
    $.ajax({
        type: 'GET',
        url: "{{url('Employee/getUserDetails')}}",
        data: {
            id: id,
        },
        success: function (res) {
            var responseObject = JSON.parse(res);
            if (responseObject.status === true) {
                $('#customer_name').val(id);
                $('#first_name').val(responseObject.first_name);
                $('#last_name').val(responseObject.last_name);
                $('#email').val(responseObject.email);
                $('#phone_number').val(responseObject.phone_number);
                $('#company_id').val(responseObject.company_name);
                
                // Update the button text with the selected customer's name
                $('#selected_customer_btn').text(responseObject.first_name + ' ' + responseObject.last_name);
            } else {
                $('.showinvoice_err').text(responseObject.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ' + error);
        },
    });
}

</script>
@endsection