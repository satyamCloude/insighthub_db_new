@extends('layouts.admin')
@section('title', 'Settings')
@section('content')
<style type="text/css">
      .bs-stepper-content{
        padding: 0px 10px 0px 10px !important;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">

           @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
    @endif

    <div class="bs-stepper vertical mt-2 linear">
      <div class="bs-stepper-header">
                  <div class="step @if(Session::get('TabViews')== 'App') active @endif">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="App">
                      <span class="bs-stepper-circle"><i class="fa-brands fa-app-store-ios"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">App</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step @if(Session::get('TabViews')== 'Currency') active @endif">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Currency">
                      <span class="bs-stepper-circle"><i class="fa-solid fa-coins"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Currency</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step @if(Session::get('TabViews')== 'Company') active @endif">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Company">
                      <span class="bs-stepper-circle"><i class="fas fa-building"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Company</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step @if(Session::get('TabViews')== 'CustomLink') active @endif">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="CustomLink">
                      <span class="bs-stepper-circle"> <i class="fas fa-link"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Custom Link</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="File">
                      <span class="bs-stepper-circle"><i class="fas fa-file"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">File Management</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Invoice">
                      <span class="bs-stepper-circle"><i class="fas fa-file-invoice"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Invoice</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Logs">
                      <span class="bs-stepper-circle"><i class="fas fa-tasks"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Logs Management</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Leads">
                      <span class="bs-stepper-circle"><i class="fas fa-chalkboard"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Leads</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="LeaveS">
                      <span class="bs-stepper-circle"><i class="fas fa-sign-out-alt"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Leave</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Mail">
                      <span class="bs-stepper-circle"><i class="fas fa-envelope"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Mail</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>  
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Module">
                      <span class="bs-stepper-circle"><i class="fab fa-buromobelexperte"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Module</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Notice">
                      <span class="bs-stepper-circle"><i class="far fa-sticky-note"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Notice</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>  
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="PaymentMethod">
                      <span class="bs-stepper-circle"><i class="fas fa-hand-holding-usd"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Payment Method</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="ProjectCategory">
                      <span class="bs-stepper-circle"><i class="fas fa-project-diagram"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Project Category</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>  
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Profile">
                      <span class="bs-stepper-circle"><i class="ti ti-users ti-sm"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Profile</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Performance">
                      <span class="bs-stepper-circle"><i class="fas fa-chart-line"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Performance</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="PayRoll">
                      <span class="bs-stepper-circle"><i class="fas fa-user-tag"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">PayRoll</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Role">
                      <span class="bs-stepper-circle"><i class="fas fa-user-tag"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Role</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div> 
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="ServiceAutomation">
                      <span class="bs-stepper-circle"><i class="fas fa-cogs"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Service Automation</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="SmSEmail">
                      <span class="bs-stepper-circle"> <i class="fas fa-sms"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">SmS/Email Template</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Security">
                      <span class="bs-stepper-circle"><i class="fas fa-unlock-alt"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Security</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="SecurityIP">
                      <span class="bs-stepper-circle"><i class="fas fa-key"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Security IP</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Storage">
                      <span class="bs-stepper-circle"><i class="fas fa-hdd"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Storage</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div> 
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="TaskCategory">
                      <span class="bs-stepper-circle"><i class="fas fa-tasks"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Task Category</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div> 
                  <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="Tax">
                      <span class="bs-stepper-circle"><i class="fa-brands fa-square-pied-piper"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Tax</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>
                  <div class="line"></div> 
                   <div class="step">
                    <button type="button" class="step-trigger" onclick="Tab(value)" value="TicketEmail">
                      <span class="bs-stepper-circle"><i class="fas fa-ticket-alt"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Ticket-Email</span>
                        <span class="bs-stepper-subtitle">Settings</span>
                      </span>
                    </button>
                  </div>  
      </div>
      <div class="bs-stepper-content"></div>
    </div>
</div>
 @if(session('TabViews'))
    <script>
      window.onload = function() {
    var tabs = "{{ session('TabViews') }}";
    if (tabs) {
        Tab(tabs);
    }
}
    </script>
@endif
<script type="text/javascript">
  function Tab(value) {
    // Remove 'active' class from all tabs
    $('.bs-stepper-header .step').removeClass('active');

    // Add 'active' class to the clicked tab
    $('.bs-stepper-header .step button[value="' + value + '"]').parent().addClass('active');

    // AJAX request to load tab content
    $.ajax({
        url: "{{ url('admin/Settings/TabView') }}",
        method: 'GET',
        data: { type: value },
        success: function (response) {
            $('.bs-stepper-content').html(response);
        },
        error: function () {
            // Handle error if needed
        }
    });
  }
</script>



@endsection