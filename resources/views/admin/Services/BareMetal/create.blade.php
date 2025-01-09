@extends('layouts.admin')
@section('title', 'Create')
@section('content')
<!-- Content -->

<style>
 .avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 50px auto;
}

.avatar-upload .avatar-edit {
    position: absolute;
    right: 12px;
    z-index: 1;
    top: 10px;
}

.avatar-upload .avatar-edit input {
    display: none;
}

.avatar-upload .avatar-edit label {
    display: inline-block;
    width: 34px;
    height: 34px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #ffffff;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
}

.avatar-upload .avatar-edit label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
}

.avatar-upload .avatar-edit label:after {
    content: "\f040";
    font-family: "FontAwesome";
    color: #757575;
    position: absolute;
    top: 10px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
}

.avatar-upload .avatar-preview {
    width: 192px;
    height: 192px;
    position: relative;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}

.avatar-upload .avatar-preview > div {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
.selected {
    background-color: #f0f0f0; /* Change background color to indicate selection */
    font-weight: bold; /* Change font weight to indicate selection */
}
.dropbtn {
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  background-color: #fff;
  border: 1px solid #dbdade;
  border-radius: 0.375rem;
  border-color: #C9C8CE !important;
  height:40px;
  width:100%;
  text-align:left;
  color:#6f6b7d;
  font-weight:500;
  font-size:16px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 100%;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: white;
}


.outer:hover{

  background-color:#685dd8 !important;
  color:white !important;

}


.outer{


  background-color: rgba(115, 103, 240, 0.08);
  color: #7367f0;

  border-radius:10px;



}



</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">BareMetal /</span> Add</h4>
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
                      <form id="wizard-validation-form" method="post" action="{{url('admin/BareMetal/store')}}" enctype="multipart/form-data">
                        @csrf
                        <!-- Account Details -->
                        <div id="account-details-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">General Details</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                          <div class="row g-3">
                            <!-- <div class="col-sm-6">
                              <label class="form-label" for="customer_name">Customer Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="customer_id" required>
                                    @foreach($Client as $Clients)
                                    <option value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                                    @endforeach
                                </select>
                            </div> -->
                              @php
                            // Use the `firstWhere` collection method to find the first client matching the Ticket's client_id
                            $client = collect($Client)->firstWhere('id', $Client->id);
                    
                            // Use null coalescence operator to handle the case when $client is null
                            $first_name = $client->first_name ?? 'Select Client';
                            $last_name = $client->last_name ?? '';
                            $id = $client->id ?? '';
                            $profile_img = $client->profile_img ?? '';
                            @endphp
                             <div class="col-md-6 customer_name">
                                  <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                                  <div class="dropdown">
                                      <button class="dropbtn" id="selected_customer_btn">Select Customer<i class="fa fa-angle-down" style="font-size:24px"></i></button>
                                      <div class="dropdown-content" style="max-height: 45vh;overflow: auto;">
                                          
                                         @foreach($Client as $vendors)
                                          <div class="outer" id="customer_{{ $vendors->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="getUserDetails('{{ $vendors->id }}')">
                                              <div style="border-radius:50%;">
                                                   <img src="{{ $profile_img ? $profile_img : url('/') . '/public/images/profile_Ri1o.jpeg' }}" alt="" id="selected_client_img" class="rounded-circle avatar-xs" style="display:{{ $profile_img ? 'inline' : 'none' }};">
                                              </div>
                                              <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                      <span id="selected_client_btn">{{ $first_name }} {{ $last_name }} ({{ $id }})</span>
                                                  <!-- <span>active</span> -->
                                              </div>
                                          </div>
                                          @endforeach
                                      </div>
                                  </div>
                                  <input type="hidden" name="customer_id" id="customer_name">
                        </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_id">Product/Services </label>
                                <select class="form-control" name="product_id">
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
                              <label class="form-label" for="os_id">Operating System <span class="text-danger">*</span></label>
                                <select class="form-control" name="os_id" required>
                                    @foreach($OperatingSysten as $operat)
                                    <option value="{{$operat->id}}">{{$operat->ostype}}</option>
                                    @endforeach
                                </select>
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
                              <input type="number"name="first_payment" class="form-control"/>
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
                              <label class="form-label" for="currency_id">Currency</label>
                              <select class="form-control" name="currency_id">
                                @foreach($Currency as $Currency)
                                    <option value="{{$Currency->id}}">{{$Currency->prefix}} {{$Currency->code}}</option>
                                    @endforeach

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
                              <label class="form-label" for="dc_location">DC Location</label>
                              <select class="form-control" name="dc_location">
                                    @foreach($Country as $Country)
                                    <option value="{{$Country->country_id}}">{{$Country->country_name}}</option>
                                    @endforeach
                              </select>
                            </div> 
                            <div class="col-sm-6">
                              <label class="form-label" for="floor_name">Floor Name</label>
                              <input type="text"name="floor_name" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rack_id">Rack ID</label>
                              <select class="form-control" name="rack_id">
                                    @foreach($Rack as $Racks)
                                    <option value="{{$Racks->id}}">{{$Racks->rack_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="unit_no">Unit No</label>
                              <input type="number"name="unit_no" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="server_serial_no">Server Serial No</label>
                              <input type="text"name="server_serial_no" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="server_tag_id">Server Tag ID</label>
                              <input type="text"name="server_tag_id" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_manufacturer">Product Manufacturer</label>
                              <input type="text"name="product_manufacturer" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-control" name="status">
                                    @foreach($Status as $Status)
                                    <option value="{{$Status->id}}">{{$Status->status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="bare_notes">Bare Notes</label>
                              <div class="editor-container">
                                <div class="full-editor geteditor"></div>
                                <input type="hidden" name="bare_notes" class="hidden-field">
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
                            <h6 class="mb-0">Network Details</h6>
                            <small>Enter Your Details.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="primary_public_ip">Primary Public IP <span class="text-danger">*</span></label>
                              <select class="form-control" name="primary_public_ip">
                                @php 
                               
                                @endphp
                                    @foreach($public_ip as $ip)
                                    <option value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="additional_public_ip">Additional Public IP</label>
                              <select class="form-control" name="additional_public_ip">
                                    @foreach($public_ip as $ip)
                                    <option value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="primary_private_ip">Primary Private IP <span class="text-danger">*</span></label>
                              <select class="form-control" name="primary_private_ip">
                                    @foreach($private_ip as $ip)
                                    <option value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="additional_private_ip">Additional Private IP</label>
                              <select class="form-control" name="additional_private_ip">
                                    @foreach($private_ip as $ip)
                                    <option value="{{$ip->id}}">{{$ip->ip_address}}</option>
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
                              <input type="text"name="ilo_rmm_darc_console_url" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="username">User Name</label>
                              <input type="text"name="username" class="form-control"/>
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
                                    <option value="">Select Switch</option>
                                    @foreach($Switchs as $Switc)
                                    <option value="{{$Switc->id}}">{{$Switc->switch_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="swith_port">Switch Port</label>
                              <input type="text"name="swith_port" class="form-control"/>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="firewall_serial_id">Firewall Serial No</label>
                              <select class="form-control" name="firewall_serial_id">
                                    <option value="">Select Firewall</option>
                                    @foreach($firewall as $fire)
                                    <option value="{{$fire->id}}">{{$fire->firewall_serial_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="firewall_port">Firewall Port</label>
                              <input type="text"name="firewall_port" class="form-control"/>
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
                              <label class="form-label" for="hosting_control_panel">Hosting Control Panel</label>
                              <input type="text"name="hosting_control_panel" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_user_name">Control Panel User Name</label>
                              <input type="text"name="control_panel_user_name" class="form-control"/>
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
                              <input type="text"name="rdp_ssh_username" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_port">RDP/SSH Port</label>
                              <input type="text"name="rdp_ssh_port" class="form-control"/>
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
                              <label class="form-label" for="pemkey">PemKey</label>
                              <input type="file" name="pemkey" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="Privatekey">PrivateKey</label>
                              <input type="file" name="Privatekey" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="publickey">PublicKey</label>
                              <input type="file" name="publickey" class="form-control"/>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="addon">Addon</label>
                              <div class="editor-container">
                                <div class="full-editor geteditor"></div>
                                <input type="hidden" name="addon" class="hidden-field">
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
                              <div class="editor-container">
                                <div class="full-editor geteditor"></div>
                                <input type="hidden" name="license_management" class="hidden-field">
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
                              <select class="form-control" name="employee_id">
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
   function getUserDetails(id) {
    $.ajax({
        type: 'GET',
        url: "{{url('admin/getUserDetails')}}",
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