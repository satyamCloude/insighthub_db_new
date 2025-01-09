@extends('layouts.admin')
@section('title', 'Azure')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Azure /</span> Edit</h4>
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
                            <span class="bs-stepper-title">Addon Credintial</span>
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
                      <form id="wizard-validation-form" method="post" action="{{url('Employee/Azure/update/'.$Azure->id)}}" enctype="multipart/form-data">
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
                                    <option @if($Azure && $Azure->customer_id == $Clients->id) selected @endif value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="product_id">Product/Services </label>
                                <select class="form-control" name="product_id">
                                    @foreach($Product as $Produ)
                                    <option @if($Azure && $Azure->product_id == $Produ->id) selected @endif value="{{$Produ->id}}">{{$Produ->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="host_domain_name">Host/Domain Name  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  @if($Azure && $Azure->host_domain_name)  value="{{$Azure->host_domain_name}}" @endif name="host_domain_name">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="services_name">Services Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" @if($Azure && $Azure->services_name)  value="{{$Azure->services_name}}" @endif  name="services_name">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="vender_id">Vendor Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="vender_id">
                                    @foreach($Vendor as $Vend)
                                    <option @if($Azure && $Azure->vender_id == $Vend->id) selected @endif value="{{$Vend->id}}">{{$Vend->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="service_type">
                                    <option @if($Azure && $Azure->service_type == '1') selected @endif value="1">Managed</option>
                                    <option @if($Azure && $Azure->service_type == '2') selected @endif value="2">Un-Managed</option>
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
                              <input type="number"name="first_payment" @if($Azure && $Azure->first_payment)  value="{{$Azure->first_payment}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="billing_cycle">Billing Cycle</label>
                              <select class="form-select select2 select2-hidden-accessible" name="billing_cycle" tabindex="-1" aria-hidden="true">
                                  <option @if($Azure && $Azure->billing_cycle == 'one_time') selected @endif value="one_time">One Time</option>
                                  <option @if($Azure && $Azure->billing_cycle == 'hourly') selected @endif value="hourly">Hourly</option>
                                  <option @if($Azure && $Azure->billing_cycle == 'Monthly') selected @endif value="Monthly">Monthly</option>
                                  <option @if($Azure && $Azure->billing_cycle == 'quartely') selected @endif value="quartely">Quartely</option>
                                  <option @if($Azure && $Azure->billing_cycle == 'semi_annually') selected @endif value="semi_annually">Semi-Annually</option>
                                  <option @if($Azure && $Azure->billing_cycle == 'annually') selected @endif value="annually">Annually</option>
                                  <option @if($Azure && $Azure->billing_cycle == 'biennially') selected @endif value="biennially">Biennially</option>
                                  <option @if($Azure && $Azure->billing_cycle == 'triennially') selected @endif value="triennially">Triennially</option>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="currency_id">Currency</label>
                              <select class="form-control" name="currency_id">
                                @foreach($Currency as $Currency)
                                    <option @if($Azure && $Azure->currency_id == $Currency->id) selected @endif value="{{$Currency->id}}">{{$Currency->prefix}} {{$Currency->code}}</option>
                                    @endforeach

                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="payment_method_id">Payment Method</label>
                              <select class="form-control" name="payment_method_id">
                                    @foreach($PaymentMethod as $PaymentMethod)
                                    <option @if($Azure && $Azure->payment_method_id == $PaymentMethod->id) selected @endif value="{{$PaymentMethod->id}}">{{$PaymentMethod->name}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="signup_date">SignUp Date</label>
                              <input type="date"name="signup_date" @if($Azure && $Azure->signup_date)  value="{{$Azure->signup_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="next_due_date">Next Due Date</label>
                              <input type="date"name="next_due_date" @if($Azure && $Azure->next_due_date)  value="{{$Azure->next_due_date}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="terminate_date">Terminate Date</label>
                              <input type="date"name="terminate_date" @if($Azure && $Azure->terminate_date)  value="{{$Azure->terminate_date}}" @endif class="form-control"/>
                            </div>
                            <hr>
                            </div>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Data Center</h6>
                            <small>Enter Your Details Here.</small>
                          </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="azure_account_Id">Azure Account Id</label>
                              <input type="text"name="azure_account_Id"  @if($Azure && $Azure->azure_account_Id)  value="{{$Azure->azure_account_Id}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="tenant_id">Tenant ID</label>
                              <input type="text"name="tenant_id"  @if($Azure && $Azure->tenant_id)  value="{{$Azure->tenant_id}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-control" name="status">
                                    @foreach($Status as $Status)
                                    <option @if($Azure && $Azure->status == $Status->id) selected @endif value="{{$Status->id}}">{{$Status->status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="azure_notes">Azure Notes</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor">@if($Azure && $Azure->azure_notes)  {!!$Azure->azure_notes!!} @endif</div>
                                    <input type="hidden" name="azure_notes" @if($Azure && $Azure->azure_notes) value="{{$Azure->azure_notes}}" @endif class="hidden-field">
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
                            <h6 class="mb-0">Azure Login Credential</h6>
                            <small>Enter Your Details.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="azure_login_url">Azure Login URL <span class="text-danger">*</span></label>
                              <input type="text"name="azure_login_url" @if($Azure && $Azure->azure_login_url)  value="{{$Azure->azure_login_url}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="azure_username">Azure User Name <span class="text-danger">*</span></label>
                              <input type="text"name="azure_username"  @if($Azure && $Azure->azure_username)  value="{{$Azure->azure_username}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="azure_password">Azure Password <span class="text-danger">*</span></label>
                              <input type="text"name="azure_password" class="form-control"/>
                            </div>
                            <hr>
                            <div class="content-header mb-3">
                            <h6 class="mb-0">Control Panel Login Credential</h6>
                            <small>Enter Your Credential Here.</small>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="hosting_control_panel">Hosting Control Panel</label>
                              <input type="text"name="hosting_control_panel"  @if($Azure && $Azure->hosting_control_panel)  value="{{$Azure->hosting_control_panel}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_user_name">Control Panel User Name</label>
                              <input type="text"name="control_panel_user_name"  @if($Azure && $Azure->control_panel_user_name)  value="{{$Azure->control_panel_user_name}}" @endif class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="control_panel_password">Control Panel Password</label>
                              <input type="Password"name="control_panel_password" class="form-control"/>
                            </div>
                            @foreach($Azure2 as $key=> $Azure2)
                            <hr>
                            <div class="content-header mb-3">
                              @if($key == 0)
                              <button type="button" class="btn btn-label-success" style="float: right;" onclick="Addmore()">+ More</button>
                              @else
                              <button type="button" class="btn btn-label-danger" style="float: right;" onclick="removethis(this)">- Remove</button>
                              @endif
                            <h6 class="mb-0">Login Credential</h6>
                            <small>Enter Your Credential Here.</small>
                            </div>
                            <div class="row">
                            <div class="col-sm-6">
                              <label class="form-label" for="server_ip">Server IP</label>
                              <input type="text"name="server_ip[]"  @if($Azure2 && $Azure2->server_ip)  value="{{$Azure2->server_ip}}" @endif  class="form-control" required />
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="hostname">Hostname</label>
                              <input type="text"name="hostname[]"  @if($Azure2 && $Azure2->hostname)  value="{{$Azure2->hostname}}" @endif   class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_username">SSH/RDP User Name</label>
                              <input type="text"name="rdp_ssh_username[]"  @if($Azure2 && $Azure2->rdp_ssh_username)  value="{{$Azure2->rdp_ssh_username}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_port">SSH/RDP Port</label>
                              <input type="text"name="rdp_ssh_port[]"  @if($Azure2 && $Azure2->rdp_ssh_port)  value="{{$Azure2->rdp_ssh_port}}" @endif  class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_password">SSH/RDP Password</label>
                              <input type="Password"name="rdp_ssh_password[]"   class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="region">Region</label>
                              <input type="text"name="region[]" @if($Azure2 && $Azure2->region)  value="{{$Azure2->region}}" @endif   class="form-control"/>
                            </div>
                            </div>
                             <hr>
                            <div class="content-header mb-3">
                              @if($key != 0)
                              <button type="button" class="btn btn-label-danger" style="float: right;" onclick="removethis(this)">- Remove</button>
                              @endif
                              <h6 class="mb-0">Login Authentication</h6>
                              <small>Enter Your Details.</small>
                            </div>
                            <div class="row">
                             <div class="col-sm-6">
                              <label class="form-label" for="pemkey">PemKey</label>&nbsp;&nbsp;&nbsp;  <a type="button" href="{{$Azure2->pemkey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file" name="pemkey[]" class="form-control"/> 
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="Privatekey">PrivateKey</label>&nbsp;&nbsp;&nbsp;  <a type="button" href="{{$Azure2->Privatekey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file" name="Privatekey[]" class="form-control"/> 
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="publickey">PublicKey</label>&nbsp;&nbsp;&nbsp;  <a type="button" href="{{$Azure2->publickey}}"><i class="fa-solid fa-download"></i></a>
                              <input type="file" name="publickey[]" class="form-control"/> 
                            </div>
                          </div>
                            @endforeach
                            <div class="showmore idnotwantoremove"></div>
                            <div class="col-12 d-flex justify-content-between idnotwantoremove">
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
                            <h6 class="mb-0">Notes</h6>
                            <small>Enter Your  Notes.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-12">
                              <label class="form-label" for="addon">Addon</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor">@if($Azure && $Azure->license_management) {!!$Azure->addon!!} @endif</div>
                                    <input type="hidden" name="addon" @if($Azure && $Azure->license_management) value="{{$Azure->addon}}" @endif class="hidden-field">
                                </div>
                            </div>
                            <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Specification</h6>
                            <small>Enter Your Specification.</small>
                          </div>
                            <div class="col-sm-12">
                              <label class="form-label" for="specification">Specification</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor">@if($Azure && $Azure->specification) {!!$Azure->specification!!} @endif</div>
                                    <input type="hidden" name="specification" @if($Azure && $Azure->specification) value="{{$Azure->specification}}" @endif class="hidden-field">
                                </div>
                            </div>
                           <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Enter Your Backup & Security.</h6>
                            <small>Backup Content.</small>
                          </div>
                              <div class="col-sm-12">
                              <label class="form-label" for="backup_security">Backup & Security</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor">@if($Azure && $Azure->backup_security) {!!$Azure->backup_security!!} @endif</div>
                                    <input type="hidden" name="backup_security" @if($Azure && $Azure->backup_security) value="{{$Azure->backup_security}}" @endif class="hidden-field">
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
                              <input type="text" name="license_management" @if($Azure && $Azure->license_management)  value="{{$Azure->license_management}}" @endif  class="form-control"/>
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
                                    <option @if($Azure && in_array($Employee->id, explode(',',$Azure->employee_id))) selected @endif value="{{$Employee->id}}">{{$Employee->first_name}}</option>
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
<script type="text/javascript">
  function Addmore() {
    $('.showmore').append( '<hr>'+
                            '<div class="content-header mb-3">'+
                            '<button type="button" class="btn btn-label-danger" style="float: right;" onclick="removethis(this)">- Remove</button>'+
                            '<h6 class="mb-0">Login Credential</h6>'+
                            '<small>Enter Your Credential Here.</small>'+
                            '</div>'+
                            '<div class="row">'+
                              '<div class="col-sm-6 mb-3">'+
                              '  <label class="form-label" for="server_ip">Server IP</label>'+
                              '  <input type="text"name="server_ip[]" class="form-control"/>'+
                              '</div>'+
                              '<div class="col-sm-6 mb-3">'+
                              '  <label class="form-label" for="hostname">Hostname</label>'+
                              '  <input type="text"name="hostname[]" class="form-control"/>'+
                              '</div>'+
                              '<div class="col-sm-6 mb-3">'+
                              '  <label class="form-label" for="rdp_ssh_username">SSH/RDP User Name</label>'+
                              '  <input type="text"name="rdp_ssh_username[]" class="form-control"/>'+
                              '</div>'+
                              '<div class="col-sm-6 mb-3">'+
                              '  <label class="form-label" for="rdp_ssh_port">SSH/RDP Port</label>'+
                              '  <input type="text"name="rdp_ssh_port[]" class="form-control"/>'+
                              '</div>'+
                              '<div class="col-sm-6 mb-3">'+
                              '  <label class="form-label" for="rdp_ssh_password">SSH/RDP Password</label>'+
                              '  <input type="Password"name="rdp_ssh_password[]" class="form-control"/>'+
                              '</div>'+
                              '<div class="col-sm-6 mb-3">'+
                              '  <label class="form-label" for="region">Region</label>'+
                              '  <input type="text"name="region[]" class="form-control"/>'+
                              '</div>'+
                              '</div>'+
                            ' <hr>'+
                            '<div class="content-header mb-3">'+
                            '<button type="button" class="btn btn-label-danger" style="float: right;" onclick="removethis(this)">- Remove</button>'+
                            '  <h6 class="mb-0">Login Authentication</h6>'+
                            '  <small>Enter Your Details.</small>'+
                            '</div>'+
                            '<div class="row">'+
                            ' <div class="col-sm-6 mb-3">'+
                            '  <label class="form-label" for="pemkey">PemKey</label>'+
                            '  <input type="file" name="pemkey[]" class="form-control"/>'+
                            '</div>'+
                            '<div class="col-sm-6 mb-3">'+
                            '  <label class="form-label" for="Privatekey">PrivateKey</label>'+
                            '  <input type="file" name="Privatekey[]" class="form-control"/>'+
                            '</div>'+
                            '<div class="col-sm-6 mb-3">'+
                            '  <label class="form-label" for="publickey">PublicKey</label>'+
                            '  <input type="file" name="publickey[]" class="form-control"/>'+
                            '</div>'+
                            '</div>');
  }

  function removethis(element) {
  // Find the closest '.content-header'
  var $contentHeader = $(element).closest('.content-header');

  // Find all elements until the next '.content-header'
  var $elementsToRemove = $contentHeader.nextUntil('.content-header').addBack();

  // Exclude elements with id 'idnotwantoremove'
  $elementsToRemove = $elementsToRemove.not('.idnotwantoremove');

  // Remove the found elements
  $elementsToRemove.remove();
}

</script>
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