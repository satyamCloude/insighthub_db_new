@extends('layouts.admin')
@section('title', 'Edit')
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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">BareMetal /</span> Edit</h4>
    <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
          <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
          <div class="action-btns">
            <a href="{{url('admin/BareMetal/home')}}" class="btn btn-label-primary me-3">
              <span class="align-middle"> Back</span>
            </a>
          </div>
        </div>
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
                      <form id="wizard-validation-form" method="post" action="{{url('admin/BareMetal/update/'.$BareMetal->id)}}" enctype="multipart/form-data">
                        @csrf
                        <!-- Account Details -->
                        <div id="account-details-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">General Details</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                          <div class="row g-3">
                              <div class="col-md-6 customer_name">
                                  <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                                  <div class="dropdown">
                                      <button type="button" class="dropbtn" id="selected_customer_btn">Select Customer<i class="fa fa-angle-down" style="font-size:24px"></i></button>
                                      <div class="dropdown-content" style="max-height: 45vh;overflow: auto;">
                                          
                                         @foreach($Client as $vendors)
                                          <div class="outer" id="customer_{{ $vendors->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="getUserDetails('{{ $vendors->id }}')">
                                              <div style="border-radius:50%;">
                                                  @if($vendors->profile_img)
                                                                                                    <img src="{{ $vendors->profile_img }}" style="width:45px;border-radius:50%;height:auto;">

                                                  @else
                                                                                                    <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;">

                                                  @endif
                                              </div>
                                              <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                                  <span>{{ $vendors->first_name }} {{ $vendors->last_name }} ({{ $vendors->id }}) <br/>{{ $vendors->company_name }}</span>
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
                                <select class="form-control select2" name="product_id">
                                    @foreach($Product as $Produ)
                                    <option @if($BareMetal && $BareMetal->product_id == $Produ->id) selected @endif value="{{$Produ->id}}">{{$Produ->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="host_domain_name">Host/Domain Name  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" @if($BareMetal && $BareMetal->host_domain_name) value="{{$BareMetal->host_domain_name}}" @endif name="host_domain_name">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="os_id">Operating System <span class="text-danger">*</span></label>
                                <select class="form-control" name="os_id">
                                    @foreach($OperatingSysten as $operat)
                                    <option @if($BareMetal && $BareMetal->os_id == $operat->id) selected @endif value="{{$operat->id}}">{{$operat->ostype}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="vender_id">Vendor Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="vender_id">
                                    @foreach($Vendor as $Vend)
                                    <option @if($BareMetal && $BareMetal->vender_id == $Vend->id) selected @endif value="{{$Vend->id}}">{{$Vend->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="service_type">
                                    <option @if($BareMetal && $BareMetal->service_type == '1') selected @endif value="1">Managed</option>
                                    <option @if($BareMetal && $BareMetal->service_type == '2') selected @endif value="2">Un-Managed</option>
                                </select>
                            </div>
                            <hr>

                          <div class="content-header mb-3">
                            <h6 class="mb-0">Payment Details</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="first_payment">First Payment</label>
                              <input type="number"name="first_payment" @if($BareMetal && $BareMetal->final_total_amt) value="{{$BareMetal->final_total_amt}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="billing_cycle">Billing Cycle</label>
                              <select class="form-select select2 select2-hidden-accessible" name="billing_cycle" tabindex="-1" aria-hidden="true">
                                  <option @if($BareMetal && $BareMetal->plan_type == 'one_time') selected @endif value="one_time">One Time</option>
                                  <option @if($BareMetal && $BareMetal->plan_type == 'hourly') selected @endif value="hourly">Hourly</option>
                                  <option @if($BareMetal && $BareMetal->plan_type == 'Monthly') selected @endif value="Monthly">Monthly</option>
                                  <option @if($BareMetal && $BareMetal->plan_type == 'quartely') selected @endif value="quartely">Quartely</option>
                                  <option @if($BareMetal && $BareMetal->plan_type == 'semi_annually') selected @endif value="semi_annually">Semi-Annually</option>
                                  <option @if($BareMetal && $BareMetal->plan_type == 'annually') selected @endif value="annually">Annually</option>
                                  <option @if($BareMetal && $BareMetal->plan_type == 'biennially') selected @endif value="biennially">Biennially</option>
                                  <option @if($BareMetal && $BareMetal->plan_type == 'triennially') selected @endif value="triennially">Triennially</option>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="currency_id">Currency</label>
                              <select class="form-control" name="currency_id">
                                @foreach($Currency as $Currency)
                                    <option @if($BareMetal && $BareMetal->currency == $Currency->id) selected @endif value="{{$Currency->id}}">{{$Currency->prefix}} {{$Currency->code}}</option>
                                    @endforeach

                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="payment_method_id">Payment Method</label>
                              <select class="form-control" name="payment_method_id">
                                    @foreach($PaymentMethod as $PaymentMethod)
                                    <option @if($BareMetal && $BareMetal->payment_method_id == $PaymentMethod->id) selected @endif value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="signup_date">SignUp Date</label>
                              <input type="date"name="signup_date"  @if($BareMetal && $BareMetal->signup_date) value="{{$BareMetal->signup_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="next_due_date">Next Due Date</label>
                              <input type="date"name="next_due_date"  @if($BareMetal && $BareMetal->next_due_date) value="{{$BareMetal->next_due_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="terminate_date">Terminate Date</label>
                              <input type="date"name="terminate_date"  @if($BareMetal && $BareMetal->terminate_date) value="{{$BareMetal->terminate_date}}" @endif class="form-control"/>
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
                                    <option @if($BareMetal && $BareMetal->dc_location == $Country->country_id) selected @endif value="{{$Country->country_id}}">{{$Country->country_name}}</option>
                                    @endforeach
                              </select>
                            </div> 
                            <div class="col-sm-6">
                              <label class="form-label" for="floor_name">Floor Name</label>
                              <input type="text"name="floor_name" @if($BareMetal && $BareMetal->floor_name) value="{{$BareMetal->floor_name }}" @endif class="form-control"/>
                            </div>

                            <div class="col-sm-6">
                            <label class="form-label" for="rack_id">Rack ID</label>
                            <select class="form-control select2" id="rack_id" name="rack_id">
                                <option value="">Select</option>
                                @foreach($Rack as $Racks)
                                <option @if($BareMetal && $BareMetal->rack_id == $Racks->id) selected @endif value="{{ $Racks->id }}">{{ $Racks->rack_id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="unit_no">Unit No</label>
                            <select class="form-control select2" id="unit_no" name="unit_no[]" multiple>
                                <option value="">Select Rack ID First</option>
                                <!-- Options will be populated here -->
                            </select>
                         <input type="hidden"name="unit_no" @if($BareMetal && $BareMetal->unit_no) value="{{$DedicatedServer->unit_no}}" @endif  class="form-control"/>
                        </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="server_serial_no">Server Serial No</label>
                              <input type="text"name="server_serial_no" @if($BareMetal && $BareMetal->server_serial_no) value="{{$BareMetal->server_serial_no}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="server_tag_id">Server Tag ID</label>
                              <input type="text"name="server_tag_id" @if($BareMetal && $BareMetal->server_tag_id) value="{{$BareMetal->server_tag_id}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_manufacturer">Product Manufacturer</label>
                              <input type="text"name="product_manufacturer" @if($BareMetal && $BareMetal->product_manufacturer) value="{{$BareMetal->product_manufacturer}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-control" name="status">
                                    @foreach($Status as $Status)
                                    <option @if($BareMetal && $BareMetal->status == $Status->id) selected @endif value="{{$Status->id}}">{{$Status->status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="bare_notes">Bare Notes</label>
                              <div class="editor-container">
                                <div class="full-editor geteditor">@if($BareMetal && $BareMetal->bare_notes) {!! $BareMetal->bare_notes !!} @endif </div>
                                <input type="hidden" name="bare_notes"  @if($BareMetal && $BareMetal->bare_notes) value="{{ $BareMetal->bare_notes }}" @endif   class="hidden-field">
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
                              <select class="form-control select2" name="primary_public_ip">
                                    @foreach($public_ip as $ip)
                                    <option @if($BareMetal && $BareMetal->primary_public_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="additional_public_ip">Additional Public IP</label>
                              <select class="form-control select2" name="additional_public_ip">
                                    @foreach($public_ip as $ip)
                                    <option @if($BareMetal && $BareMetal->additional_public_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="primary_private_ip">Primary Private IP <span class="text-danger">*</span></label>
                              <select class="form-control select2" name="primary_private_ip">
                                    @foreach($private_ip as $ip)
                                    <option @if($BareMetal && $BareMetal->primary_private_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="additional_private_ip">Additional Private IP</label>
                              <select class="form-control select2" name="additional_private_ip">
                                    @foreach($private_ip as $ip)
                                    <option @if($BareMetal && $BareMetal->additional_private_ip == $ip->id) selected @endif value="{{$ip->id}}">{{$ip->ip_address}}</option>
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
                              <input type="text"name="ilo_rmm_darc_console_url"  @if($BareMetal && $BareMetal->ilo_rmm_darc_console_url) value="{{$BareMetal->ilo_rmm_darc_console_url}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="username">User Name</label>
                              <input type="text"name="username"  @if($BareMetal && $BareMetal->username) value="{{$BareMetal->username}}" @endif  class="form-control"/>
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
                                    <option @if($BareMetal && $BareMetal->switch_id == $Switc->id) selected @endif value="{{$Switc->id}}">{{$Switc->switch_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="swith_port">Switch Port</label>
                              <input type="text"name="swith_port"  @if($BareMetal && $BareMetal->swith_port) value="{{$BareMetal->swith_port}}" @endif class="form-control"/>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="firewall_serial_id">Firewall Serial No</label>
                              <select class="form-control" name="firewall_serial_id">
                                    @foreach($firewall as $fire)
                                    <option @if($BareMetal && $BareMetal->firewall_serial_id == $fire->id) selected @endif value="{{$fire->id}}">{{$fire->firewall_serial_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="firewall_port">Firewall Port</label>
                              <input type="text"name="firewall_port" @if($BareMetal && $BareMetal->firewall_port) value="{{$BareMetal->firewall_port}}" @endif class="form-control"/>
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
                              <input type="text"name="hosting_control_panel" @if($BareMetal && $BareMetal->hosting_control_panel) value="{{$BareMetal->hosting_control_panel}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_user_name">Control Panel User Name</label>
                              <input type="text"name="control_panel_user_name" @if($BareMetal && $BareMetal->control_panel_user_name) value="{{$BareMetal->control_panel_user_name}}" @endif class="form-control"/>
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
                              <input type="text"name="rdp_ssh_username" @if($BareMetal && $BareMetal->rdp_ssh_username) value="{{$BareMetal->rdp_ssh_username}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_port">RDP/SSH Port</label>
                              <input type="text"name="rdp_ssh_port"  @if($BareMetal && $BareMetal->rdp_ssh_port) value="{{$BareMetal->rdp_ssh_port}}" @endif class="form-control"/>
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
                              <label class="form-label" for="pemkey">PemKey</label>  <a type="button" href="{{$BareMetal->pemkey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file"name="pemkey" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="Privatekey">PrivateKey</label>  <a type="button" href="{{$BareMetal->Privatekey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file"name="Privatekey" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="publickey">PublicKey</label> <a type="button" href="{{$BareMetal->publickey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file"name="publickey" class="form-control"/>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="addon">Addon</label>
                              <div class="editor-container">
                                <div class="full-editor geteditor">@if($BareMetal && $BareMetal->addon) {!! $BareMetal->addon !!} @endif </div>
                                <input type="hidden" name="addon" @if($BareMetal && $BareMetal->addon) value="{{ $BareMetal->addon }}" @endif class="hidden-field">
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
                              <div class="editor-container">
                                <div class="full-editor geteditor">@if($BareMetal && $BareMetal->license_management) {!! $BareMetal->license_management !!} @endif </div>
                                <input type="hidden" name="license_management"  @if($BareMetal && $BareMetal->license_management) value="{{ $BareMetal->license_management }}" @endif  class="hidden-field">
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
                                    <option @if($BareMetal && in_array($Employee->id, explode(',',$BareMetal->employee_id))) selected @endif value="{{$Employee->id}}">{{$Employee->first_name}}</option>
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
                url: '{{ url("admin/Rack/vacant-units") }}/' + rackId,
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