@extends('layouts.admin')
@section('title', 'Antivirus')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Antivirus /</span> Add</h4>
                <div class="col-12 mb-4"1>
                  <div id="wizard-validation" class="bs-stepper mt-2">
                    <div class="bs-stepper-header">
                      <div class="step" data-target="#account-details-validation">
                        <button type="button" class="step-trigger"1>
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
                            <span class="bs-stepper-title">License</span>
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
                      <form id="wizard-validation-form" method="post" action="{{url('Employee/Antivirus/update/'.$Antivirus->id)}}" enctype="multipart/form-data">
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
                                    <option @if($Antivirus && $Antivirus->customer_id == $Clients->id) selected @endif value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_id">Product/Services </label>
                                <select class="form-control" name="product_id">
                                    @foreach($Product as $Produ)
                                    <option @if($Antivirus && $Antivirus->product_id == $Produ->id) selected @endif value="{{$Produ->id}}">{{$Produ->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="host_domain_name">Host/Domain Name  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="host_domain_name"  @if($Antivirus && $Antivirus->host_domain_name) value="{{$Antivirus->host_domain_name}}" @endif>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="quantity"  @if($Antivirus && $Antivirus->quantity) value="{{$Antivirus->quantity}}" @endif>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="vender_id">Vendor Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="vender_id">
                                    @foreach($Vendor as $Vend)
                                    <option @if($Antivirus && $Antivirus->vender_id == $Vend->id) selected @endif value="{{$Vend->id}}">{{$Vend->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="service_type">
                                    <option @if($Antivirus && $Antivirus->service_type == '1') selected @endif value="1">Managed</option>
                                    <option @if($Antivirus && $Antivirus->service_type == '2') selected @endif value="2">Un-Managed</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-control" name="status">
                                    @foreach($Status as $Status)
                                    <option @if($Antivirus && $Antivirus->status == $Status->id) selected @endif value="{{$Status->id}}">{{$Status->status}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="col-sm-12">
                              <label class="form-label" for="antivirus_note">Antivirus  Note</label>
                              <div class="editor-container">
                                  <div class="full-editor geteditor">@if($Antivirus && $Antivirus->antivirus_note) {!!$Antivirus->antivirus_note!!} @endif</div>
                                      <input type="hidden" name="antivirus_note" @if($Antivirus && $Antivirus->antivirus_note) value="{{$Antivirus->antivirus_note}}" @endif class="hidden-field">
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
                        </div>
                        <!-- Personal Info -->
                             @php
    // Adjust the namespace according to your model's location
    use App\Models\EmployeeDetail;

    $checkUserDepartment = EmployeeDetail::where('user_id', Auth::user()->id)->first();
@endphp

                        
                        <div class="parent" @if($checkUserDepartment && $checkUserDepartment->department_id == 1) style="display:none" @endif>
                        <div id="personal-info-validation" class="content">
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Payment Details</h6>
                            <small>Enter Your Details.</small>
                          </div>
                          <div class="row g-3">
                             <div class="col-sm-6">
                              <label class="form-label" for="first_payment">First Payment</label>
                              <input type="number"name="first_payment"  @if($Antivirus && $Antivirus->first_payment) value="{{$Antivirus->first_payment}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="billing_cycle">Billing Cycle</label>
                              <select class="form-select select2 select2-hidden-accessible" name="billing_cycle" tabindex="-1" aria-hidden="true">
                                  <option @if($Antivirus && $Antivirus->billing_cycle == 'one_time') selected @endif value="one_time">One Time</option>
                                  <option @if($Antivirus && $Antivirus->billing_cycle == 'hourly') selected @endif value="hourly">Hourly</option>
                                  <option @if($Antivirus && $Antivirus->billing_cycle == 'Monthly') selected @endif value="Monthly">Monthly</option>
                                  <option @if($Antivirus && $Antivirus->billing_cycle == 'quartely') selected @endif value="quartely">Quartely</option>
                                  <option @if($Antivirus && $Antivirus->billing_cycle == 'semi_annually') selected @endif value="semi_annually">Semi-Annually</option>
                                  <option @if($Antivirus && $Antivirus->billing_cycle == 'annually') selected @endif value="annually">Annually</option>
                                  <option @if($Antivirus && $Antivirus->billing_cycle == 'biennially') selected @endif value="biennially">Biennially</option>
                                  <option @if($Antivirus && $Antivirus->billing_cycle == 'triennially') selected @endif value="triennially">Triennially</option>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="currency_id">Currency</label>
                              <select class="form-control" name="currency_id">
                                @foreach($Currency as $Currency)
                                    <option @if($Antivirus && $Antivirus->currency_id == $Currency->id) selected @endif value="{{$Currency->id}}">{{$Currency->prefix}} {{$Currency->code}}</option>
                                    @endforeach

                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="payment_method_id">Payment Method</label>
                              <select class="form-control" name="payment_method_id">
                                    @foreach($PaymentMethod as $PaymentMethod)
                                    <option @if($Antivirus && $Antivirus->payment_method_id == $PaymentMethod->id) selected @endif value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="signup_date">SignUp Date</label>
                              <input type="date"name="signup_date"  @if($Antivirus && $Antivirus->signup_date) value="{{$Antivirus->signup_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="next_due_date">Next Due Date</label>
                              <input type="date"name="next_due_date"  @if($Antivirus && $Antivirus->next_due_date) value="{{$Antivirus->next_due_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="terminate_date">Terminate Date</label>
                              <input type="date"name="terminate_date" @if($Antivirus && $Antivirus->terminate_date) value="{{$Antivirus->terminate_date}}" @endif  class="form-control"/>
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
                            <h6 class="mb-0">Login Credential</h6>
                            <small>Enter Your Login Details.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="protal_url">Portal URL  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="protal_url" @if($Antivirus && $Antivirus->protal_url) value="{{$Antivirus->protal_url}}" @endif >
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="username">User Name  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" @if($Antivirus && $Antivirus->username) value="{{$Antivirus->username}}" @endif >
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="password">Password  <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="license_key">License Key  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="license_key" @if($Antivirus && $Antivirus->license_key) value="{{$Antivirus->license_key}}" @endif >
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="valid_domain_upto">Valid Up to Domain  <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="valid_domain_upto" @if($Antivirus && $Antivirus->valid_domain_upto) value="{{$Antivirus->valid_domain_upto}}" @endif >
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
                                    <div class="full-editor geteditor">@if($Antivirus && $Antivirus->license_management) {!!$Antivirus->license_management!!} @endif</div>
                                    <input type="hidden" name="license_management" @if($Antivirus && $Antivirus->license_management) value="{{$Antivirus->license_management}}" @endif class="hidden-field">
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
                                    <option @if($Antivirus && in_array($Employee->id, explode(',',$Antivirus->employee_id))) selected @endif value="{{$Employee->id}}">{{$Employee->first_name}}</option>
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
@endsection