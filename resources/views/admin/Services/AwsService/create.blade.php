@extends('layouts.admin')
@section('title', 'Aws Service')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Aws Service /</span> Add</h4>
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
                      <form id="wizard-validation-form" method="post" action="{{url('admin/AwsService/store')}}" enctype="multipart/form-data">
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
                                    <option value="{{$Clients->id}}">{{$Clients->first_name}}</option>
                                    @endforeach
                                </select>
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
                              <label class="form-label" for="services_name">Services Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="services_name" required>
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
                              <label class="form-label" for="aws_account_Id">AWS Account Id</label>
                              <input type="text"name="aws_account_Id" class="form-control"/>
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
                              <label class="form-label" for="aws_notes">AWS Notes</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor"></div>
                                    <input type="hidden" name="aws_notes" class="hidden-field">
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
                            <h6 class="mb-0">AWS Login Credential</h6>
                            <small>Enter Your Details.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label" for="aws_login_url">Aws Login URL <span class="text-danger">*</span></label>
                              <input type="text"name="aws_login_url" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="aws_username">AWS User Name <span class="text-danger">*</span></label>
                              <input type="text"name="aws_username" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="aws_password">AWS Password <span class="text-danger">*</span></label>
                              <input type="text"name="aws_password" class="form-control"/>
                            </div>
                            <hr>
                            <div class="content-header mb-3">
                            <h6 class="mb-0">Control Panel Login Credential</h6>
                            <small>Enter Your Credential Here.</small>
                            </div>
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
                            <h6 class="mb-0">Login Credential</h6>
                            <small>Enter Your Credential Here.</small>
                            <button type="button" class="btn btn-label-success" style="float: right;" onclick="Addmore()">+ More</button>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="server_ip">Server IP</label>
                              <input type="text"name="server_ip[]" class="form-control" required />
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="hostname">Hostname</label>
                              <input type="text"name="hostname[]" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_username">SSH/RDP User Name</label>
                              <input type="text"name="rdp_ssh_username[]" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_port">SSH/RDP Port</label>
                              <input type="text"name="rdp_ssh_port[]" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="rdp_ssh_password">SSH/RDP Password</label>
                              <input type="Password"name="rdp_ssh_password[]" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="region">Region</label>
                              <input type="text"name="region[]" class="form-control"/>
                            </div>
                             <hr>
                            <div class="content-header mb-3">
                              <h6 class="mb-0">Login Authentication</h6>
                              <small>Enter Your Details.</small>
                            </div>
                             <div class="col-sm-6">
                              <label class="form-label" for="pemkey">PemKey</label>
                              <input type="file" name="pemkey[]" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="Privatekey">PrivateKey</label>
                              <input type="file" name="Privatekey[]" class="form-control"/>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label" for="publickey">PublicKey</label>
                              <input type="file" name="publickey[]" class="form-control"/>
                            </div>
                            <div class="showmore"></div>
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
                            <h6 class="mb-0">Notes</h6>
                            <small>Enter Your  Notes.</small>
                          </div>
                          <div class="row g-3">
                            <div class="col-sm-12">
                              <label class="form-label" for="addon">Addon</label>
                              <div class="editor-container">
                                    <div class="full-editor geteditor"></div>
                                    <input type="hidden" name="addon" class="hidden-field">
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
                                    <div class="full-editor geteditor"></div>
                                    <input type="hidden" name="specification" class="hidden-field">
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
                                    <div class="full-editor geteditor"></div>
                                    <input type="hidden" name="backup_security" class="hidden-field">
                                </div>
                            </div>
                          <hr>
                          <div class="content-header mb-3">
                            <h6 class="mb-0">Upload Architecture.</h6>
                            <small>Architecture</small>
                          </div>
                          <div class="col-sm-12">
                              <label class="form-label" for="architecture">Architecture</label>
                              <input type="file" name="architecture" class="form-control">
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
                              <input type="text" name="license_management" class="form-control"/>
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
    $(element).closest('.content-header').nextUntil('.content-header').remove();
    $(element).closest('.content-header').remove();
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