
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Module Settings</h5>
      </div>
      <div class="col-md-6 text-end">
        <!-- <a href="{{url('admin/Security/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a> -->
        <!-- <a href="{{url('admin/Security/add')}}" class="btn btn-primary mt-3 m-3">Add</a> -->
    </div>
        </div>
        <div class="card-datatable table-responsive">
    <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">

       <div class="row">
        <div class="col-lg-12">
            <div class="border-grey mt-3 p-4 rounded-top">
              <form id="security-settings-form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-25">Clients

                            </label>

                            <div class="custom-control custom-switch">
                              <input type="checkbox" @if($ModuleSetting && $ModuleSetting->clients) {{ $ModuleSetting->clients ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-25" data-setting-id="25" data-module-name="clients" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-25"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-26">Projects

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox"  @if($ModuleSetting) {{ $ModuleSetting->projects ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-26" data-setting-id="26" data-module-name="projects" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-26"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-27">Tickets

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)  {{ $ModuleSetting->tickets ? 'checked' : '' }} @endif  class="cursor-pointer custom-control-input change-module-setting" id="module-27" data-setting-id="27" data-module-name="tickets" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-27"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-28">Invoices

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->invoices ? 'checked' : '' }} @endif  class="cursor-pointer custom-control-input change-module-setting" id="module-28" data-setting-id="28" data-module-name="invoices" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-28"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-29">Estimates

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox"  @if($ModuleSetting)  {{ $ModuleSetting->estimates ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-29" data-setting-id="29" data-module-name="estimates" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-29"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-30">Events

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)  {{ $ModuleSetting->events ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-30" data-setting-id="30" data-module-name="events" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-30"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-31">Messages

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)  {{ $ModuleSetting->messages ? 'checked' : '' }}  @endif class="cursor-pointer custom-control-input change-module-setting" id="module-31" data-setting-id="31" data-module-name="messages" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-31"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-32">Tasks

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->tasks ? 'checked' : '' }}  @endif class="cursor-pointer custom-control-input change-module-setting" id="module-32" data-setting-id="32" data-module-name="tasks" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-32"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-33">Time Logs

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->timelogs ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-33" data-setting-id="33" data-module-name="timelogs" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-33"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-34">Contracts

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->contracts ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-34" data-setting-id="34" data-module-name="contracts" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-34"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-35">Notices

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->notices ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-35" data-setting-id="35" data-module-name="notices" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-35"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-36">Payments

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->payments ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-36" data-setting-id="36" data-module-name="payments" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-36"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-37">Orders

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->orders ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-37" data-setting-id="37" data-module-name="orders" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-37"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-38">Knowledge Base

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)    {{ $ModuleSetting->knowledge_base ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-38" data-setting-id="38" data-module-name="knowledge_base" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-38"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-39">Employees

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->employees ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-39" data-setting-id="39" data-module-name="employees" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-39"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-40">Attendance

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)    {{ $ModuleSetting->attendance ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-40" data-setting-id="40" data-module-name="attendance" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-40"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-41">Expenses

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->expenses ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-41" data-setting-id="41" data-module-name="expenses" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-41"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-42">Leaves

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)    {{ $ModuleSetting->leaves ? 'checked' : '' }}  @endif class="cursor-pointer custom-control-input change-module-setting" id="module-42" data-setting-id="42" data-module-name="leaves" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-42"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-43">Leads

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->leads ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-43" data-setting-id="43" data-module-name="leads" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-43"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-44">Holidays

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)    {{ $ModuleSetting->holidays ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-44" data-setting-id="44" data-module-name="holidays" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-44"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-45">Products

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->products ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-45" data-setting-id="45" data-module-name="products" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-45"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-46">Reports

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->products ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-46" data-setting-id="46" data-module-name="reports" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-46"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-48">Bank Account

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)    {{ $ModuleSetting->bank_account ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-48" data-setting-id="48" data-module-name="bank_account" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-48"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-63">Assets

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)    {{ $ModuleSetting->assets ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-63" data-setting-id="63" data-module-name="assets" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-63"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-66">Payroll

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->payroll ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-66" data-setting-id="66" data-module-name="payroll" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-66"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-67">Purchase

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)    {{ $ModuleSetting->purchase ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-67" data-setting-id="67" data-module-name="purchase" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-67"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-69">Recruit

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)    {{ $ModuleSetting->recruit ? 'checked' : '' }}  @endif class="cursor-pointer custom-control-input change-module-setting" id="module-69" data-setting-id="69" data-module-name="recruit" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-69"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-73">Webhooks

                            </label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->webhooks ? 'checked' : '' }}  @endif class="cursor-pointer custom-control-input change-module-setting" id="module-73" data-setting-id="73" data-module-name="webhooks" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-73"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="form-group mb-4">
                            <label class="f-14 text-dark-grey mb-12" data-label="" for="module-76">Zoom
                            </label><div class="custom-control custom-switch">
                                <input type="checkbox" @if($ModuleSetting)   {{ $ModuleSetting->zoom ? 'checked' : '' }} @endif class="cursor-pointer custom-control-input change-module-setting" id="module-76" data-setting-id="76" data-module-name="zoom" autocomplete="off">
                                <label class="custom-control-label cursor-pointer" for="module-76"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div></div>
    </div>
  </div>

                                    <script>
                                        $(document).ready(function () {
                                            $('.change-module-setting').change(function () {
                                                    console.log('Change event triggered'); // Check if this line is logged

                                                    var settingId = $(this).data('setting-id');
                                                    var moduleName = $(this).data('module-name');
                                                    var isChecked = $(this).prop('checked');
                                                    console.log('Setting ID:', settingId);
                                                    console.log('Module Name:', moduleName);
                                                    console.log('Is Checked:', isChecked);

                                                // Send Ajax request to update database
                                                $.ajax({
                                                    url: "{{url('admin/ModuleSettings/updateModuleStatus')}}",
                                                    type: 'POST',
                                                    data: {
                                                        '_token': '{{ csrf_token() }}',
                                                        'settingId': settingId,
                                                        'moduleName': moduleName,
                                                        'isChecked': isChecked,
                                                    },
                                                    success: function (response) {
                                                        console.log(response);
                                                        // Handle success (if needed)
                                                    },
                                                    error: function (error) {
                                                        console.log(error);
                                                        // Handle error (if needed)
                                                    }
                                                });
                                            });
                                        });
                                    </script>