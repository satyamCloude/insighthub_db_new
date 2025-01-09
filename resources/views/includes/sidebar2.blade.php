@php 
$id = Auth::user()->id;

$RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
    ->join('employee_details','employee_details.admin_type_id','role_accesses.role_id')
    ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
    ->where('employee_details.user_id', $id)
    ->where(function($query) {
        $query->where('role_accesses.view', '!=', null)
            ->orWhere('role_accesses.add', '!=', null)
            ->orWhere('role_accesses.update', '!=', null)
            ->orWhere('role_accesses.delete', '!=', null);
    })
    ->get()
    ->toArray();

    $ClientAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
    ->join('client_details','client_details.role_id','role_accesses.role_id')
    ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
     ->where('client_details.user_id',$id)
    ->where(function($query) {
        $query->where('role_accesses.view', '!=', null)
            ->orWhere('role_accesses.add', '!=', null)
            ->orWhere('role_accesses.update', '!=', null)
            ->orWhere('role_accesses.delete', '!=', null);
    })
    ->get()
    ->toArray();

@endphp

<style>
  .CircleR .menu-item:not(.active) > .menu-link::before {
    color: #A5A3AE !important;
    display: none;
}


.color1{
  color: #7367f0 !important;
  font-size: 16px;

}


.color2{
    
    color:white !important;
    font-size: 16px;
}


</style>
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo mb-3">
            <a href="#" class="app-brand-link">
              <img width="100%" src="{{url('public/logo/company.png')}}">
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>
          @if(Auth::user()->type == '1')
            <ul class="menu-inner py-1">
              <!-- Dashboards start -->
              <li class="menu-item {{request()->is('admin/dashboard') ? 'active':''}} {{request()->is('admin/dashboard') ? 'open':''}} {{request()->is('admin/Advanced') ? 'open':''}}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <div class="badge bg-primary rounded-pill ms-auto">2</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{request()->is('admin/dashboard') ? 'active':''}}">
                  <a href="{{url('admin/dashboard')}}" class="menu-link">
                    <div data-i18n="Private">Private Dashboard</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/Advanced') ? 'active':''}}">
                  <a href="{{url('admin/Advanced')}}" class="menu-link">
                    <div data-i18n="Advanced">Advanced Dashboard</div>
                  </a>
                </li>
              </ul>
            </li>


              <!-- Dashboards end -->
              <!-- User start -->
              <li class="menu-item {{request()->is('admin/Client/*') ? 'open':''}} {{request()->is('admin/Vendor/*') ? 'open':''}} {{request()->is('admin/Client/*') ? 'active':''}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon fa-solid fa-user"></i>
                  <div data-i18n="Users">Users</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item {{request()->is('admin/Client/*') ? 'active':''}}">
                    <a href="{{url('admin/Client/home')}}" class="menu-link">
                      <div data-i18n="List">Client</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/Vendor/*') ? 'active':''}}">
                    <a href="{{url('admin/Vendor/home')}}" class="menu-link">
                      <div data-i18n="List">Vendor</div>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- User end -->
               <li class="menu-item {{request()->is('admin/Invoices/*') ? 'open':''}}  {{request()->is('admin/Orders/*') ? 'open':''}} {{request()->is('admin/Role/*') ? 'open':''}} {{request()->is('admin/Role/*') ? 'active':''}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon fas fa-calculator"></i>
                  <div data-i18n="globe">Accounting</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item {{request()->is('admin/Invoices/*') ? 'active':''}}">
                    <a href="{{url('admin/Invoices/home')}}" class="menu-link">
                      <div data-i18n="List">Invoices</div>
                    </a>
                  </li>
               <!--    
                  <li class="menu-item {{request()->is('admin/CurrencySettings/*') ? 'active':''}}">
                    <a href="{{url('admin/CurrencySettings/home')}}" class="menu-link">
                      <div data-i18n="List">Balance sheet</div>
                    </a>
                  </li> -->
                  <li class="menu-item {{request()->is('admin/Orders/*') ? 'active':''}}">
                    <a href="{{url('admin/Orders/home')}}" class="menu-link">
                      <div data-i18n="List">Order</div>
                    </a>
                  </li> 

                   
                  <li class="menu-item {{request()->is('admin/CompanySettings/*') ? 'active':''}}">
                    <a href="{{url('admin/CompanySettings/home')}}" class="menu-link">
                      <div data-i18n="List">Transaction</div>
                    </a>
                  </li> 
                </ul>
              </li>
              <!-- Sales start -->
              <li class="menu-item {{request()->is('admin/Leads/*') ? 'open':''}}   
                                   {{request()->is('admin/Quotes/*') ? 'open':''}}
                                   {{request()->is('admin/Category/*') ? 'open':''}}
                                    {{request()->is('admin/HostingPanel/*') ? 'open':''}}  
                                   {{request()->is('admin/SpecialOffers/*') ? 'open':''}}
                                   {{request()->is('admin/Goal/*') ? 'open':''}}
                                   {{request()->is('admin/MassMail/*') ? 'open':''}}

                                   {{request()->is('admin/Leads/*') ? 'active':''}} 
                                   {{request()->is('admin/HostingPanel/*') ? 'active':''}} 
                                   {{request()->is('admin/Quotes/*') ? 'active':''}} 
                                   {{request()->is('admin/Category/*') ? 'active':''}} 
                                   {{request()->is('admin/SpecialOffers/*') ? 'active':''}}
                                   {{request()->is('admin/Goal/*') ? 'active':''}}
                                   {{request()->is('admin/MassMail/*') ? 'active':''}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon fa-solid fa-globe"></i>
                  <div data-i18n="globe">Sales</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item {{request()->is('admin/Leads/*') ? 'active':''}}">
                    <a href="{{url('admin/Leads/home')}}" class="menu-link">
                      <div data-i18n="List">Leads</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/Quotes/*') ? 'active':''}}">
                    <a href="{{url('admin/Quotes/home')}}" class="menu-link">
                      <div data-i18n="List">Quotes</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/Category/*') ? 'active':''}}">
                    <a href="{{url('admin/Category/home')}}" class="menu-link">
                      <div data-i18n="List">Category</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/MassMail/*') ? 'active':''}}">
                    <a href="{{url('admin/MassMail/home')}}" class="menu-link">
                      <div data-i18n="List">Mass Mail</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/HostingPanel/*') ? 'active':''}}">
                    <a href="{{url('admin/HostingPanel/home')}}" class="menu-link">
                      <div data-i18n="List">Hosting Panel</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/SpecialOffers/*') ? 'active':''}}">
                    <a href="{{url('admin/SpecialOffers/home')}}" class="menu-link">
                      <div data-i18n="List">Special Offers</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/Goal/*') ? 'active':''}}">
                    <a href="{{url('admin/Goal/home')}}" class="menu-link">
                      <div data-i18n="List">Goals </div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#" class="menu-link">
                      <div data-i18n="List">Advertisement</div>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- Sales end -->
              <!-- Network Management start -->
              <li class="menu-item 
                                   {{request()->is('admin/NetworkSubnet/*') ? 'open':''}}
                                   {{request()->is('admin/NetworkSubnet/*') ? 'active':''}}
                                   {{request()->is('admin/IPAddress/*') ? 'open':''}}
                                   {{request()->is('admin/IPAddress/*') ? 'active':''}}
                                   {{request()->is('admin/Rack/*') ? 'open':''}}
                                   {{request()->is('admin/Rack/*') ? 'active':''}}
                                   {{request()->is('admin/Switchs/*') ? 'open':''}}
                                   {{request()->is('admin/Switchs/*') ? 'active':''}}
                                   {{request()->is('admin/Firewall/*') ? 'open':''}}
                                   {{request()->is('admin/Firewall/*') ? 'active':''}}
                                   ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon fa-brands fa-hive"></i>
                  <div data-i18n="Users" class="small">Network Management</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item {{request()->is('admin/NetworkSubnet/*') ? 'active':''}}">
                    <a href="{{url('admin/NetworkSubnet/home')}}" class="menu-link">
                      <div data-i18n="List">Network Subnet</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/IPAddress/*') ? 'active':''}}">
                    <a href="{{url('admin/IPAddress/home')}}" class="menu-link">
                      <div data-i18n="List">IP Address</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/Rack/*') ? 'active':''}}">
                    <a href="{{url('admin/Rack/home')}}" class="menu-link">
                      <div data-i18n="List">Rack</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/Switchs/*') ? 'active':''}}">
                    <a href="{{url('admin/Switchs/home')}}" class="menu-link">
                      <div data-i18n="List">Switch</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/Firewall/*') ? 'active':''}}">
                    <a href="{{url('admin/Firewall/home')}}" class="menu-link">
                      <div data-i18n="List">Firewall</div>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- Network Management end -->
              <!-- Services start -->
                <li class="menu-item 
                                  {{request()->is('admin/BareMetal/*') ? 'open':''}}
                                  {{request()->is('admin/BareMetal/*') ? 'active':''}}
                                  {{request()->is('admin/CloudHosting/*') ? 'open':''}}
                                  {{request()->is('admin/CloudHosting/*') ? 'active':''}}
                                  {{request()->is('admin/CloudServices/*') ? 'open':''}}
                                  {{request()->is('admin/CloudServices/*') ? 'active':''}}
                                  {{request()->is('admin/DedicatedServer/*') ? 'open':''}}
                                  {{request()->is('admin/DedicatedServer/*') ? 'active':''}}
                                  {{request()->is('admin/AwsService/*') ? 'open':''}}
                                  {{request()->is('admin/AwsService/*') ? 'active':''}}
                                  {{request()->is('admin/Azure/*') ? 'open':''}}
                                  {{request()->is('admin/Azure/*') ? 'active':''}}
                                  {{request()->is('admin/GoogleWorkSpace/*') ? 'open':''}}
                                  {{request()->is('admin/GoogleWorkSpace/*') ? 'active':''}}
                                  {{request()->is('admin/MicrosoftOffice365/*') ? 'open':''}}
                                  {{request()->is('admin/MicrosoftOffice365/*') ? 'active':''}}
                                  {{request()->is('admin/OneTimeSetup/*') ? 'open':''}}
                                  {{request()->is('admin/OneTimeSetup/*') ? 'active':''}}
                                  {{request()->is('admin/MonthelySetup/*') ? 'open':''}}
                                  {{request()->is('admin/MonthelySetup/*') ? 'active':''}}
                                  {{request()->is('admin/SSLCertificate/*') ? 'open':''}}
                                  {{request()->is('admin/SSLCertificate/*') ? 'active':''}}
                                  {{request()->is('admin/Antivirus/*') ? 'open':''}}
                                  {{request()->is('admin/Antivirus/*') ? 'active':''}}
                                  {{request()->is('admin/Licenses/*') ? 'open':''}}
                                  {{request()->is('admin/Licenses/*') ? 'active':''}}
                                  {{request()->is('admin/Acronis/*') ? 'open':''}}
                                  {{request()->is('admin/Acronis/*') ? 'active':''}}
                                  {{request()->is('admin/TsPlus/*') ? 'open':''}}
                                  {{request()->is('admin/TsPlus/*') ? 'active':''}}
                                  {{request()->is('admin/Other/*') ? 'open':''}}
                                  {{request()->is('admin/Other/*') ? 'active':''}}
                                                                                          ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fa-solid fa-cloud"></i>
                <div data-i18n="Users">Services</div>
                </a>
                <ul class="menu-sub CircleR">
                <li class="menu-item {{request()->is('admin/BareMetal/*') ? 'active':''}}">
                  <a href="{{url('admin/BareMetal/home')}}" class="menu-link">
                    <i class="fa-solid fa-bars"></i>
                    &nbsp;&nbsp;
                    <div data-i18n="Users">Bare Metal (VT)</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/CloudHosting/*') ? 'active':''}}">
                  <a href="{{url('admin/CloudHosting/home')}}" class="menu-link">
                    <i class="fas fa-cloud-upload-alt"></i> 
                    &nbsp;&nbsp;
                    <div data-i18n="List">Cloud Hosting</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/CloudServices/*') ? 'active':''}}">
                  <a href="{{url('admin/CloudServices/home')}}" class="menu-link">
                    <i class="fas fa-cloud"></i>
                    &nbsp;&nbsp;
                    <div data-i18n="List">Cloud Services</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/DedicatedServer/*') ? 'active':''}}">
                  <a href="{{url('admin/DedicatedServer/home')}}" class="menu-link">
                    <i class="fas fa-server"></i>
                     &nbsp;&nbsp;
                    <div data-i18n="List">Dedicated Server</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/AwsService/*') ? 'active':''}}">
                  <a href="{{url('admin/AwsService/home')}}" class="menu-link">
                    <i class="fa-brands fa-aws"></i>
                    &nbsp;&nbsp;
                    <div data-i18n="List">Aws Service</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/Azure/*') ? 'active':''}}">
                  <a href="{{url('admin/Azure/home')}}" class="menu-link">
                    <i class="fab fa-microsoft"></i>
                     &nbsp;&nbsp;
                    <div data-i18n="List">Microsoft Azure</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/GoogleWorkSpace/*') ? 'active':''}}">
                  <a href="{{url('admin/GoogleWorkSpace/home')}}" class="menu-link">
                    <i class="fab fa-google"></i>
                     &nbsp;&nbsp;
                    <div data-i18n="List">Google Work Space</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/MicrosoftOffice365/*') ? 'active':''}}">
                  <a href="{{url('admin/MicrosoftOffice365/home')}}" class="menu-link">
                    <!-- <i class="fas fa-briefcase"></i> -->
                     <img src="{{url('public/images/tsPlus.png')}}" alt="Acronis Icon" style="width: 20px; height: 20px;">

                    &nbsp;&nbsp;
                    <div data-i18n="List">MS Office 365</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/OneTimeSetup/*') ? 'active':''}}">
                  <a href="{{url('admin/OneTimeSetup/home')}}" class="menu-link">
                    <i class="fas fa-cog"></i>
                    &nbsp;&nbsp;
                    <div data-i18n="List">One Time Setup</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/MonthelySetup/*') ? 'active':''}}">
                  <a href="{{url('admin/MonthelySetup/home')}}" class="menu-link">
                    <i class="fas fa-cogs"></i>
                    &nbsp;&nbsp;
                    <div data-i18n="List">Monthely Setup</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/SSLCertificate/*') ? 'active':''}}">
                  <a href="{{url('admin/SSLCertificate/home')}}" class="menu-link">
                    <i class="fas fa-stamp"></i>
                    &nbsp;&nbsp;
                    <div data-i18n="List">SSL Certificate</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/Antivirus/*') ? 'active':''}}">
                  <a href="{{url('admin/Antivirus/home')}}" class="menu-link">
                    <i class="fas fa-shield-virus"></i>
                    &nbsp;&nbsp;
                    <div data-i18n="List">Antivirus</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/Licenses/*') ? 'active':''}}">
                  <a href="{{url('admin/Licenses/home')}}" class="menu-link">
                    <i class="fas fa-id-badge"></i>
                    &nbsp;&nbsp;
                    <div data-i18n="List">Licenses</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/Acronis/*') ? 'active':''}}">
                  <a href="{{url('admin/Acronis/home')}}" class="menu-link">
                              <img src="{{url('public/images/Acroniss.png')}}" alt="Acronis Icon" style="width: 15px; height: 15px;">
                    &nbsp;&nbsp;
                    <div data-i18n="List">Acronis</div>
                  </a>
                </li>
                <li class="menu-item {{request()->is('admin/TsPlus/*') ? 'active':''}}">
                  <a href="{{url('admin/TsPlus/home')}}" class="menu-link">
                              <img src="{{url('public/images/TSPLUS.png')}}" alt="Acronis Icon" style="width: 20px; height: 20px;">
                    &nbsp;&nbsp;
                    <div data-i18n="List">TsPlus</div>
                  </a>
                </li>



                <li class="menu-item {{request()->is('admin/Other/*') ? 'active':''}}">
                  <a href="{{url('admin/Other/home')}}" class="menu-link">
                    <i class="fas fa-toolbox"></i>
                    &nbsp;&nbsp;
                    <div data-i18n="List">Other</div>
                  </a>
                </li>
                </ul>
                </li>
              <!-- Services end -->
              <!-- Ticket start -->
                <li class="menu-item {{request()->is('admin/Ticket/*') ? 'open':''}} {{request()->is('admin/Vendor/*') ? 'open':''}} {{request()->is('admin/Ticket/*') ? 'active':''}}">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon fa-solid fa-ticket"></i>
                    <div data-i18n="Ticket">Ticket Support</div>
                  </a>
                  <ul class="menu-sub">
                    <li class="menu-item {{request()->is('admin/Ticket/*') ? 'active':''}}">
                      <a href="{{url('admin/Ticket/home')}}" class="menu-link">
                        <div data-i18n="Ticket">Tickets</div>
                      </a>
                    </li>
                  </ul>
                </li>
              <!-- Ticket end -->
              <!-- Work start -->
               <li class="menu-item 
                                  {{request()->is('admin/Project/*') ? 'open':''}}
                                  {{request()->is('admin/Project/*') ? 'active':''}}
                                  {{request()->is('admin/Task/*') ? 'open':''}}
                                  {{request()->is('admin/Task/*') ? 'active':''}}
                                  {{request()->is('admin/TimeSheet/*') ? 'open':''}}
                                  {{request()->is('admin/TimeSheet/*') ? 'active':''}}

               ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons fa-solid fa-business-time"></i>
                  <div data-i18n="Dashboards">Work</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
                </a>
                <ul class="menu-sub">
                  <li class="menu-item {{request()->is('admin/Project*') ? 'active':''}}">
                    <a href="{{url('admin/Project/home')}}" class="menu-link">
                      <div data-i18n="Private">Project</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/Task*') ? 'active':''}}">
                    <a href="{{url('admin/Task/home')}}" class="menu-link">
                      <div data-i18n="Advanced">Task</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/TimeSheet*') ? 'active':''}}">
                    <a href="{{url('admin/TimeSheet/home')}}" class="menu-link">
                      <div data-i18n="Advanced">Time Sheet</div>
                    </a>
                  </li>
                </ul>
                </li>
              <!-- Work End -->
              <!-- Inventory Management start -->
              <li class="menu-item  {{request()->is('admin/Inventory*') ? 'active':''}}">
                <a href="{{url('admin/Inventory/home')}}" class="menu-link " style="margin-left: 15px;">
                  <i class="menu-icon fa-solid fa-i"></i>
                  <div data-i18n="Dashboards" class="small">Inventory Management</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                </a>
              </li>
            <!--    <li class="menu-item  {{request()->is('admin/Inventory*') ? 'active':''}}">
                <a href="{{url('admin/Inventory/home')}}" class="menu-link " style="margin-left: 15px;">
                  <i class="menu-icon fa-solid fa-i"></i>
                  <div data-i18n="Dashboards" class="small">Inventory Management</div>
                </a>
              </li> -->
               <!-- <li class="menu-item  {{request()->is('admin/Orders*') ? 'active':''}}">
                <a href="{{url('admin/Orders/home')}}" class="menu-link ">
                  <img src="{{ url('public/logo/ecommerce.png') }}" height="30px" width="30px" style="margin-right: 5px;">
                  <div data-i18n="Dashboards" class="small">Orders Management</div>
              <div class="badge bg-primary rounded-pill ms-auto">3</div> 
                </a>
              </li> -->
              <!-- Inventory Management end -->
              <!-- Human Resources start -->
                <li class="menu-item {{request()->is('admin/Department/*') ? 'open':''}}    
                                     {{request()->is('admin/JobRole/*') ? 'open':''}}    
                                     {{request()->is('admin/TimeShift/*') ? 'open':''}}    
                                     {{request()->is('admin/Attendence/*') ? 'open':''}}    
                                     {{request()->is('admin/Holiday/*') ? 'open':''}}    
                                     {{request()->is('admin/Leave/*') ? 'open':''}}    
                                     {{request()->is('admin/LeavePolicies/*') ? 'open':''}}    
                                     {{request()->is('admin/Employee/*') ? 'open':''}}    
                                     {{request()->is('admin/Holiday/*') ? 'active':''}}
                                     {{request()->is('admin/File/*') ? 'open':''}}    
                                     {{request()->is('admin/File/*') ? 'active':''}}
                                     {{request()->is('admin/Performance/*') ? 'open':''}}    
                                     {{request()->is('admin/Performance/*') ? 'active':''}}
                                     {{request()->is('admin/Calendar/*') ? 'open':''}}    
                                     {{request()->is('admin/PayRoll/*') ? 'active':''}}
                                     {{request()->is('admin/PayRoll/*') ? 'open':''}}    
                                     {{request()->is('admin/Calendar/*') ? 'active':''}}
                                     {{request()->is('admin/Employee/*') ? 'active':''}}
                                     {{request()->is('admin/LeavePolicies/*') ? 'active':''}}
                                     {{request()->is('admin/Leave/*') ? 'active':''}}
                                     {{request()->is('admin/Attendence/*') ? 'active':''}}
                                     {{request()->is('admin/TimeShift/*') ? 'active':''}}
                                     {{request()->is('admin/Department/*') ? 'active':''}}
                                     {{request()->is('admin/JobRole/*') ? 'active':''}}">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons fa-brands fa-osi"></i>
                    <div data-i18n="globe">Human Resources</div>
                  </a>
                  <ul class="menu-sub">
                    <li class="menu-item {{request()->is('admin/Department/*') ? 'active':''}}">
                      <a href="{{url('admin/Department/home')}}" class="menu-link">
                        <div data-i18n="List">Department </div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/JobRole/*') ? 'active':''}}">
                      <a href="{{url('admin/JobRole/home')}}" class="menu-link">
                        <div data-i18n="List">Job Role</div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/TimeShift/*') ? 'active':''}}">
                      <a href="{{url('admin/TimeShift/home')}}" class="menu-link">
                        <div data-i18n="List">Time Shift</div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/Attendence/*') ? 'active':''}}">
                      <a href="{{url('admin/Attendence/home')}}" class="menu-link">
                        <div data-i18n="List">Attendence</div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/Holiday/*') ? 'active':''}}">
                      <a href="{{url('admin/Holiday/home')}}" class="menu-link">
                        <div data-i18n="List">Holiday</div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/Leave/*') ? 'active':''}}">
                      <a href="{{url('admin/Leave/home')}}" class="menu-link">
                        <div data-i18n="List">Leaves</div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/LeavePolicies/*') ? 'active':''}}">
                      <a href="{{url('admin/LeavePolicies/home')}}" class="menu-link">
                        <div data-i18n="List">Policies</div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/Employee/*') ? 'active':''}}">
                      <a href="{{url('admin/Employee/home')}}" class="menu-link">
                        <div data-i18n="List">Employee</div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/File/*') ? 'active':''}}">
                      <a href="{{url('admin/File/home')}}" class="menu-link">
                        <div data-i18n="List">File</div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/Performance/*') ? 'active':''}}">
                      <a href="{{url('admin/Performance/home')}}" class="menu-link">
                        <div data-i18n="List">Performance</div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/Calendar/*') ? 'active':''}}">
                      <a href="{{url('admin/Calendar/home')}}" class="menu-link">
                        <div data-i18n="List">Calendar</div>
                      </a>
                    </li>
                    <li class="menu-item {{request()->is('admin/PayRoll/*') ? 'active':''}}">
                      <a href="{{url('admin/PayRoll/home')}}" class="menu-link">
                        <div data-i18n="List">PayRoll</div>
                      </a>
                    </li>
                  </ul>
                </li>
              <!-- Human Resources end -->
              <!-- Company Login start -->
               <li class="menu-item  {{request()->is('admin/CompanyLogin*') ? 'active':''}}">
                <a href="{{url('admin/CompanyLogin/home')}}" class="menu-link ">
                  <i class="menu-icon fa-regular fa-building"></i>
                  <div data-i18n="Dashboards">Company Login</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                </a>
              </li>
              <!-- Company Login end -->
              <li class="menu-item  {{request()->is('admin/LogActivity/*') ? 'active':''}}">
                <a href="{{url('admin/LogActivity/home')}}" class="menu-link ">
                  <i class="menu-icon  fas fa-tasks"></i>
                  <div data-i18n="Dashboards">Logs Management</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                </a>
              </li>

              <li class="menu-item  {{request()->is('admin/FileManagement/*') ? 'active':''}}">
                <a href="{{url('admin/FileManagement/home')}}" class="menu-link ">
                  <i class="menu-icon  fas fa-tasks"></i>
                  <div data-i18n="Dashboards">File Management</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                </a>
              </li>
              
              <!-- Company Login start -->
               <li class="menu-item  {{request()->is('admin/Settings*') ? 'active':''}}">
                <a href="{{url('admin/Settings/home')}}" class="menu-link ">
                  <i class="menu-icon tf-icons fa-solid fa-gear"></i>
                  <div data-i18n="Dashboards">Settings</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                </a>
              </li>

              <!-- email templateSettings -->
                   <li class="menu-item  {{request()->is('admin/ETempleteSettings*') ? 'active':''}}">
                <a href="{{url('admin/ETempleteSettings/home')}}" class="menu-link ">
                  <i class="menu-icon tf-icons fa-solid fa-gear"></i>
                  <div data-i18n="Dashboards">Template Settings</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                </a>
              </li>
             
              <!-- Company Login end -->
              <!-- Settings start -->
              <!-- <li class="menu-item 
                                   {{request()->is('admin/Product/*') ? 'open':''}}    
                                   {{request()->is('admin/Product/*') ? 'active':''}}
                                   {{request()->is('admin/Role/*') ? 'open':''}}    
                                   {{request()->is('admin/Role/*') ? 'active':''}}
                                   {{request()->is('admin/PaymentMethod/*') ? 'open':''}}    
                                   {{request()->is('admin/PaymentMethod/*') ? 'active':''}}
                                   {{request()->is('admin/Security/*') ? 'open':''}}    
                                   {{request()->is('admin/Security/*') ? 'active':''}}
                                   {{request()->is('admin/SecuritySettings/*') ? 'open':''}}    
                                   {{request()->is('admin/SecuritySettings/*') ? 'active':''}}
                                   {{request()->is('admin/FileManagement/*') ? 'open':''}}    
                                   {{request()->is('admin/FileManagement/*') ? 'active':''}}
                                   {{request()->is('admin/InvoiceSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/InvoiceSettings/*') ? 'active':''}}
                                   {{request()->is('admin/ProfileSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/ProfileSettings/*') ? 'active':''}}
                                   {{request()->is('admin/ModuleSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/ModuleSettings/*') ? 'active':''}}
                                   {{request()->is('admin/CurrencySettings/*') ? 'open':''}}    
                                   {{request()->is('admin/CurrencySettings/*') ? 'active':''}}
                                   {{request()->is('admin/BuisnessAddress/*') ? 'open':''}}    
                                   {{request()->is('admin/BuisnessAddress/*') ? 'active':''}}
                                    {{request()->is('admin/LeadSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/LeadSettings/*') ? 'active':''}}
                                   {{request()->is('admin/TaxSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/TaxSettings/*') ? 'active':''}}
                                   {{request()->is('admin/LeaveSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/LeaveSettings/*') ? 'active':''}}
                                   {{request()->is('admin/CompanySettings/*') ? 'open':''}}    
                                   {{request()->is('admin/CompanySettings/*') ? 'active':''}}
                                   {{request()->is('admin/CustomLinkSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/CustomLinkSettings/*') ? 'active':''}}
                                   {{request()->is('admin/MailSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/MailSettings/*') ? 'active':''}}
                                   {{request()->is('admin/ProjectCategory/*') ? 'open':''}}    
                                   {{request()->is('admin/ProjectCategory/*') ? 'active':''}}
                                   {{request()->is('admin/TaskCategory/*') ? 'open':''}}    
                                   {{request()->is('admin/TaskCategory/*') ? 'active':''}}
                                   {{request()->is('admin/LogActivity/*') ? 'open':''}}    
                                   {{request()->is('admin/LogActivity/*') ? 'active':''}}
                                   {{request()->is('admin/Template/*') ? 'open':''}}    
                                   {{request()->is('admin/Template/*') ? 'active':''}}
                                   {{request()->is('admin/Notice/*') ? 'open':''}}    
                                   {{request()->is('admin/Notice/*') ? 'active':''}}
                                   {{request()->is('admin/AppSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/AppSettings/*') ? 'active':''}}
                                   {{request()->is('admin/TicketEmailSetting/*') ? 'open':''}}    
                                   {{request()->is('admin/TicketEmailSetting/*') ? 'active':''}}
                                   {{request()->is('admin/PerformanceSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/PerformanceSettings/*') ? 'active':''}}
                                   {{request()->is('admin/PayRollSetting/*') ? 'open':''}}    
                                   {{request()->is('admin/PayRollSetting/*') ? 'active':''}}\
                                   {{request()->is('admin/StorageSettings/*') ? 'open':''}}    
                                   {{request()->is('admin/StorageSettings/*') ? 'active':''}}
                                   ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons fa-solid fa-gear"></i>
                  <div data-i18n="globe">Settings</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item {{request()->is('admin/AppSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/AppSettings/home')}}" class="menu-link">
                      <div data-i18n="List">App Settings</div>
                    </a>
                  </li>
                  
                  <li class="menu-item {{request()->is('admin/CurrencySettings/*') ? 'active':''}}">
                    <a href="{{url('admin/CurrencySettings/home')}}" class="menu-link">
                      <div data-i18n="List">Currency Category</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/BuisnessAddress/*') ? 'active':''}}">
                    <a href="{{url('admin/BuisnessAddress/home')}}" class="menu-link">
                      <div data-i18n="List">Business Address</div>
                    </a>
                  </li> 

                   
                  <li class="menu-item {{request()->is('admin/CompanySettings/*') ? 'active':''}}">
                    <a href="{{url('admin/CompanySettings/home')}}" class="menu-link">
                      <div data-i18n="List">Company Setting</div>
                    </a>
                  </li> 
                    <li class="menu-item {{request()->is('admin/CustomLinkSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/CustomLinkSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Custom Link Settings</div>
                    </a>
                  </li>

                    <li class="menu-item {{request()->is('admin/FileManagement/*') ? 'active':''}}">
                    <a href="{{url('admin/FileManagement/home')}}" class="menu-link">
                      <div data-i18n="List">File Management</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/GrammarlyAPISettings/*') ? 'active':''}}">
                    <a href="{{url('admin/GrammarlyAPISettings/home')}}" class="menu-link">
                      <div data-i18n="List">Grammarly API Settings</div>
                    </a>
                  </li> 
                  <li class="menu-item {{request()->is('admin/InvoiceSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/InvoiceSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Invoice Setting</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/LogActivity/*') ? 'active':''}}">
                    <a href="{{url('admin/LogActivity/home')}}" class="menu-link">
                      <div data-i18n="List">Logs Management</div>
                    </a>
                  </li>
                   <li class="menu-item {{request()->is('admin/LeadSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/LeadSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Lead Setting</div>
                    </a>
                  </li>
                   <li class="menu-item {{request()->is('admin/LeaveSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/LeaveSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Leave Setting</div>
                    </a>
                  </li> 
                  <li class="menu-item {{request()->is('admin/MailSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/MailSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Mail Setting</div>
                    </a>
                  </li>
                    <li class="menu-item {{request()->is('admin/ModuleSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/ModuleSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Module Setting</div>
                    </a>
                  </li>
                   <li class="menu-item {{request()->is('admin/Notice/*') ? 'active':''}}">
                    <a href="{{url('admin/Notice/home')}}" class="menu-link">
                      <div data-i18n="List">Notice</div>
                    </a>
                  </li>                  
                  <li class="menu-item {{request()->is('admin/PaymentMethod/*') ? 'active':''}}">
                    <a href="{{url('admin/PaymentMethod/home')}}" class="menu-link">
                      <div data-i18n="List">Payment Method</div>
                    </a>
                  </li>
                   <li class="menu-item {{request()->is('admin/ProjectCategory/*') ? 'active':''}}">
                    <a href="{{url('admin/ProjectCategory/home')}}" class="menu-link">
                      <div data-i18n="List">Project Category</div>
                    </a>
                  </li>
                    <li class="menu-item {{request()->is('admin/ProfileSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/ProfileSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Profile Setting</div>
                    </a>
                  </li>
                 <li class="menu-item {{request()->is('admin/PerformanceSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/PerformanceSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Performance Settings</div>
                    </a>
                  </li> 
                  <li class="menu-item {{request()->is('admin/PayRollSetting/*') ? 'active':''}}">
                    <a href="{{url('admin/PayRollSetting/home')}}" class="menu-link">
                      <div data-i18n="List">PayRoll Settings</div>
                    </a>
                  </li> 
                  <li class="menu-item {{request()->is('admin/Role/*') ? 'active':''}}">
                    <a href="{{url('admin/Role/home')}}" class="menu-link">
                      <div data-i18n="List">Role</div>
                    </a>
                  </li>
                   <li class="menu-item {{request()->is('admin/Product/*') ? 'active':''}}">
                    <a href="{{url('admin/Product/home')}}" class="menu-link">
                      <div data-i18n="List">Service Automation</div>
                    </a>
                  </li>
                   <li class="menu-item {{request()->is('admin/Template/*') ? 'active':''}}">
                    <a href="{{url('admin/Template/home')}}" class="menu-link">
                      <div data-i18n="List">SmS/Email Template</div>
                    </a>
                  </li>
                  
                  <li class="menu-item {{request()->is('admin/SecuritySettings/*') ? 'active':''}}">
                    <a href="{{url('admin/SecuritySettings/home')}}" class="menu-link">
                      <div data-i18n="List">Security Setting</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/Security/*') ? 'active':''}}">
                    <a href="{{url('admin/Security/home')}}" class="menu-link">
                      <div data-i18n="List">Security</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/StorageSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/StorageSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Storage Settings</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/TaskCategory/*') ? 'active':''}}">
                    <a href="{{url('admin/TaskCategory/home')}}" class="menu-link">
                      <div data-i18n="List">Task Category</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('admin/TaxSettings/*') ? 'active':''}}">
                    <a href="{{url('admin/TaxSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Tax Setting</div>
                    </a>
                  </li> 
                  <li class="menu-item {{request()->is('admin/TicketEmailSetting/*') ? 'active':''}}">
                    <a href="{{url('admin/TicketEmailSetting/home')}}" class="menu-link">
                      <div data-i18n="List">Ticket-Email Setting</div>
                    </a>
                  </li> 
                 
                </ul>
              </li> -->
              <!-- Settings end -->
              @php
                $customLinks = \App\Models\CustomLinkSetting::get();
              @endphp
              @if($customLinks->isNotEmpty())
              <ul class="menu-inner py-1">
                      @foreach($customLinks as $customLink)
                           <li class="menu-item  {{request()->is('$customLink->url') ? 'active':''}}">
                              <a target="__blank" href="{{ url($customLink->url) }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-link"></i>
                            <div data-i18n="{{ $customLink->link_title }}" class="small">{{ $customLink->link_title }}</div>
                            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                          </a>
                        </li>
                      @endforeach
                  </ul>
              @endif

            </ul>
          @elseif(Auth::user()->type == '2')
             <ul class="menu-inner py-1">
              <!-- Dashboards start -->
              @if(in_array('Private_Dashboard', array_column($ClientAccess, 'per_name')))
                <li class="menu-item {{request()->is('user/dashboard') ? 'active':''}}">
                  <a href="{{url('user/dashboard')}}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Dashboards">Dashboards</div>
                    <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
                  </a>
                </li>
              @endif
               
              <!-- Dashboards end -->
              <!-- Quotes start -->
             <!--  @if(in_array('Quotes', array_column($ClientAccess, 'per_name')))
                <li class="menu-item {{request()->is('user/Quotes') ? 'active':''}}">
                  <a href="{{url('user/Quotes')}}" class="menu-link">
                    <i class="menu-icon fa-solid fa-quote-left"></i>
                    <div data-i18n="Quotes">Quotes</div>
                    <div class="badge bg-primary rounded-pill ms-auto"></div> 
                  </a>
                </li>
              @endif -->
              <li class="menu-item {{request()->is('user/Quotes') ? 'active':''}}">
                  <a href="{{url('user/Quotes')}}" class="menu-link">
                    <i class="menu-icon fa-solid fa-quote-left"></i>
                    <div data-i18n="Quotes">Quotes</div>
                    <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
                  </a>
                </li>
                 <li class="menu-item {{request()->is('user/userInvoice') ? 'active':''}}">
                  <a href="{{url('user/userInvoice')}}" class="menu-link">
                    <i class="menu-icon fas fa-file-invoice"></i>
                    <div data-i18n="Quotes">Invoices</div>
                  </a>
                </li>
                 <li class="menu-item {{request()->is('user/userTicket') ? 'active':''}}">
                  <a href="{{url('user/userTicket')}}" class="menu-link">
                    <i class="menu-icon fas fa-ticket-alt"></i>
                    <div data-i18n="Quotes">Ticket</div>
                  </a>
                </li>
               
                 <li class="menu-item {{request()->is('user/userLogActivity') ? 'active':''}}">
                  <a href="{{url('user/userLogActivity')}}" class="menu-link">
                   <i class="menu-icon fas fa-snowboarding"></i>
                    <div data-i18n="Quotes">Log Activity</div>
                  </a>
                </li>
               @if(Auth::user()->type == '2')

                <li class="menu-item
                                  {{request()->is('user/balancesheet/*') ? 'open':''}}
                                  {{request()->is('user/balancesheet/*') ? 'active':''}}
                                  {{request()->is('user/order/*') ? 'open':''}}
                                  {{request()->is('user/order/*') ? 'active':''}}
                                  {{request()->is('user/services/*') ? 'open':''}}
                                  {{request()->is('user/services/*') ? 'active':''}}
                                  {{request()->is('user/transaction/*') ? 'open':''}}
                                  {{request()->is('user/transaction/*') ? 'active':''}}
               ">
               
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon fas fa-calculator"></i>
                  <div data-i18n="Dashboards">Accounting</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
                </a>
                <ul class="menu-sub">
                  <li class="menu-item {{request()->is('user/balancesheet*') ? 'active':''}}">
                    <a href="{{url('user/balancesheet/home')}}" class="menu-link">
                      <div data-i18n="Private">balancesheet</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('user/order*') ? 'active':''}}">
                    <a href="{{url('user/order/home')}}" class="menu-link">
                      <div data-i18n="Advanced">Order</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('user/services*') ? 'active':''}}">
                    <a href="{{url('user/services/home')}}" class="menu-link">
                      <div data-i18n="Advanced">Services</div>
                    </a>
                  </li>
                  <li class="menu-item {{request()->is('user/transaction*') ? 'active':''}}">
                    <a href="{{url('user/transaction/home')}}" class="menu-link">
                      <div data-i18n="Advanced">Transactions</div>
                    </a>
                  </li>
                </ul>
                </li>

              @endif




             <!--  <li class="menu-item {{request()->is('user/order') ? 'active':''}}">
                  <a href="{{url('user/order')}}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Dashboards">Order</div>
                  </a>
                </li> -->




              <!-- Quotes end -->
              <!-- Work start -->
                @if(in_array('Project', array_column($ClientAccess, 'per_name')) || in_array('Task', array_column($ClientAccess, 'per_name')) || in_array('TimeSheet', array_column($ClientAccess, 'per_name')))
               <li class="menu-item 
                                  {{request()->is('user/Project/*') ? 'open':''}}
                                  {{request()->is('user/Project/*') ? 'active':''}}
                                  {{request()->is('user/Task/*') ? 'open':''}}
                                  {{request()->is('user/Task/*') ? 'active':''}}
                                  {{request()->is('user/TimeSheet/*') ? 'open':''}}
                                  {{request()->is('user/TimeSheet/*') ? 'active':''}}

               ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons fa-solid fa-business-time"></i>
                  <div data-i18n="Dashboards">Work</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
                </a>
                <ul class="menu-sub">
                @if(in_array('Project', array_column($ClientAccess, 'per_name')))
                  <li class="menu-item {{request()->is('user/Project*') ? 'active':''}}">
                    <a href="{{url('user/Project/home')}}" class="menu-link">
                      <div data-i18n="Private">Project</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('Task', array_column($ClientAccess, 'per_name')))
                  <li class="menu-item {{request()->is('user/Task*') ? 'active':''}}">
                    <a href="{{url('user/Task/home')}}" class="menu-link">
                      <div data-i18n="Advanced">Task</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('TimeSheet', array_column($ClientAccess, 'per_name')))
                  <li class="menu-item {{request()->is('user/TimeSheet*') ? 'active':''}}">
                    <a href="{{url('user/TimeSheet/home')}}" class="menu-link">
                      <div data-i18n="Advanced">Time Sheet</div>
                    </a>
                  </li>
                  @endif

                </ul>
                </li>
                @endif
              <!-- Work End -->
              <!-- Services start -->
                @if(in_array('BareMetal', array_column($ClientAccess, 'per_name')) || in_array('CloudHosting', array_column($ClientAccess, 'per_name')) || in_array('CloudServices', array_column($ClientAccess, 'per_name')) || in_array('DedicatedServer', array_column($ClientAccess, 'per_name')) || in_array('AwsService', array_column($ClientAccess, 'per_name')) || in_array('Azure', array_column($ClientAccess, 'per_name')) || in_array('GoogleWorkSpace', array_column($ClientAccess, 'per_name')) || in_array('MicrosoftOffice365', array_column($ClientAccess, 'per_name')) || in_array('OneTimeSetup', array_column($ClientAccess, 'per_name')) || in_array('MonthelySetup', array_column($ClientAccess, 'per_name')) || in_array('SSLCertificate', array_column($ClientAccess, 'per_name')) || in_array('Antivirus', array_column($ClientAccess, 'per_name')) || in_array('Licenses', array_column($ClientAccess, 'per_name')) || in_array('Acronis', array_column($ClientAccess, 'per_name')) || in_array('TsPlus', array_column($ClientAccess, 'per_name')) || in_array('Other', array_column($ClientAccess, 'per_name')))
                  <li class="menu-item 
                                    {{request()->is('user/BareMetal/*') ? 'open':''}}
                                    {{request()->is('user/BareMetal/*') ? 'active':''}}
                                    {{request()->is('user/CloudHosting/*') ? 'open':''}}
                                    {{request()->is('user/CloudHosting/*') ? 'active':''}}
                                    {{request()->is('user/CloudServices/*') ? 'open':''}}
                                    {{request()->is('user/CloudServices/*') ? 'active':''}}
                                    {{request()->is('user/DedicatedServer/*') ? 'open':''}}
                                    {{request()->is('user/DedicatedServer/*') ? 'active':''}}
                                    {{request()->is('user/AwsService/*') ? 'open':''}}
                                    {{request()->is('user/AwsService/*') ? 'active':''}}
                                    {{request()->is('user/Azure/*') ? 'open':''}}
                                    {{request()->is('user/Azure/*') ? 'active':''}}
                                    {{request()->is('user/GoogleWorkSpace/*') ? 'open':''}}
                                    {{request()->is('user/GoogleWorkSpace/*') ? 'active':''}}
                                    {{request()->is('user/MicrosoftOffice365/*') ? 'open':''}}
                                    {{request()->is('user/MicrosoftOffice365/*') ? 'active':''}}
                                    {{request()->is('user/OneTimeSetup/*') ? 'open':''}}
                                    {{request()->is('user/OneTimeSetup/*') ? 'active':''}}
                                    {{request()->is('user/MonthelySetup/*') ? 'open':''}}
                                    {{request()->is('user/MonthelySetup/*') ? 'active':''}}
                                    {{request()->is('user/SSLCertificate/*') ? 'open':''}}
                                    {{request()->is('user/SSLCertificate/*') ? 'active':''}}
                                    {{request()->is('user/Antivirus/*') ? 'open':''}}
                                    {{request()->is('user/Antivirus/*') ? 'active':''}}
                                    {{request()->is('user/Licenses/*') ? 'open':''}}
                                    {{request()->is('user/Licenses/*') ? 'active':''}}
                                    {{request()->is('user/Acronis/*') ? 'open':''}}
                                    {{request()->is('user/Acronis/*') ? 'active':''}}
                                    {{request()->is('user/TsPlus/*') ? 'open':''}}
                                    {{request()->is('user/TsPlus/*') ? 'active':''}}
                                    {{request()->is('user/Other/*') ? 'open':''}}
                                    {{request()->is('user/Other/*') ? 'active':''}}
                                                                                            ">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon fa-solid fa-cloud"></i>
                  <div data-i18n="Users">Services</div>
                  </a>
                  <ul class="menu-sub CircleR">
                    @if(in_array('BareMetal', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/BareMetal/*') ? 'active':''}}">
                      <a href="{{url('user/BareMetal/home')}}" class="menu-link">
                        <i class="fa-solid fa-bars"></i>
                      &nbsp;&nbsp;
                        <div data-i18n="List">Bare Metal (VT)</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('CloudHosting', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/CloudHosting/*') ? 'active':''}}">
                      <a href="{{url('user/CloudHosting/home')}}" class="menu-link">
                        <i class="fas fa-cloud-upload-alt"></i> 
                        &nbsp;&nbsp;
                        <div data-i18n="List">Cloud Hosting</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('CloudServices', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/CloudServices/*') ? 'active':''}}">
                      <a href="{{url('user/CloudServices/home')}}" class="menu-link">
                        <i class="fas fa-cloud"></i>
                      &nbsp;&nbsp;
                        <div data-i18n="List">Cloud Services</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('DedicatedServer', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/DedicatedServer/*') ? 'active':''}}">
                      <a href="{{url('user/DedicatedServer/home')}}" class="menu-link">
                        <i class="fas fa-server"></i>
                       &nbsp;&nbsp;
                        <div data-i18n="List">Dedicated Server</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('AwsService', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/AwsService/*') ? 'active':''}}">
                      <a href="{{url('user/AwsService/home')}}" class="menu-link">
                        <i class="fa-brands fa-aws"></i>
                      &nbsp;&nbsp;
                        <div data-i18n="List">Aws Service</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Azure', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/Azure/*') ? 'active':''}}">
                      <a href="{{url('user/Azure/home')}}" class="menu-link">
                        <i class="fab fa-microsoft"></i>
                       &nbsp;&nbsp;
                        <div data-i18n="List">Microsoft Azure</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('GoogleWorkSpace', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/GoogleWorkSpace/*') ? 'active':''}}">
                      <a href="{{url('user/GoogleWorkSpace/home')}}" class="menu-link">
                        <i class="fab fa-google"></i>
                       &nbsp;&nbsp;
                        <div data-i18n="List">Google Work Space</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('MicrosoftOffice365', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/MicrosoftOffice365/*') ? 'active':''}}">
                      <a href="{{url('user/MicrosoftOffice365/home')}}" class="menu-link">
                     <img src="{{url('public/images/tsPlus.png')}}" alt="Acronis Icon" style="width: 20px; height: 20px;">
                      &nbsp;&nbsp;
                        <div data-i18n="List">Microsoft Office 365</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('OneTimeSetup', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/OneTimeSetup/*') ? 'active':''}}">
                      <a href="{{url('user/OneTimeSetup/home')}}" class="menu-link">
                        <i class="fas fa-cog"></i>
                        &nbsp;&nbsp;
                        <div data-i18n="List">One Time Setup</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('MonthelySetup', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/MonthelySetup/*') ? 'active':''}}">
                      <a href="{{url('user/MonthelySetup/home')}}" class="menu-link">
                        <i class="fas fa-cogs"></i>
                      &nbsp;&nbsp;
                        <div data-i18n="List">Monthely Setup</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('SSLCertificate', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/SSLCertificate/*') ? 'active':''}}">
                      <a href="{{url('user/SSLCertificate/home')}}" class="menu-link">
                        <i class="fas fa-stamp"></i>
                      &nbsp;&nbsp;
                        <div data-i18n="List">SSL Certificate</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Antivirus', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/Antivirus/*') ? 'active':''}}">
                      <a href="{{url('user/Antivirus/home')}}" class="menu-link">
                        <i class="fas fa-shield-virus"></i>
                      &nbsp;&nbsp;
                        <div data-i18n="List">Antivirus</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Licenses', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/Licenses/*') ? 'active':''}}">
                      <a href="{{url('user/Licenses/home')}}" class="menu-link">
                        <i class="fas fa-id-badge"></i>
                      &nbsp;&nbsp;
                        <div data-i18n="List">Licenses</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Acronis', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/Acronis/*') ? 'active':''}}">
                      <a href="{{url('user/Acronis/home')}}" class="menu-link">
                          <i>
                              <img src="{{url('public/images/Acroniss.png')}}" alt="Acronis Icon" style="width: 15px; height: 15px;">
                          </i>
                          &nbsp;&nbsp;
                          <div data-i18n="List">Acronis</div>
                      </a>
                  </li>

                    @endif
                    @if(in_array('TsPlus', array_column($ClientAccess, 'per_name')))  
                    <!-- <li class="menu-item {{request()->is('user/TsPlus/*') ? 'active':''}}">
                      <a href="{{url('user/TsPlus/home')}}" class="menu-link">
                       <i class="fas fa-plus-square"></i>
                      &nbsp;&nbsp;
                        <div data-i18n="List">TsPlus</div>
                      </a>
                    </li> -->
                    <li class="menu-item {{request()->is('user/TsPlus/*') ? 'active':''}}">
                      <a href="{{url('user/TsPlus/home')}}" class="menu-link">
                          <i>
                              <img src="{{url('public/images/tsPlus.png')}}" alt="Acronis Icon" style="width: 20px; height: 20px;">
                          </i>
                          &nbsp;&nbsp;
                        <div data-i18n="List">TsPlus</div>
                      </a>
                  </li>
                    @endif
                    @if(in_array('Other', array_column($ClientAccess, 'per_name')))  
                    <li class="menu-item {{request()->is('user/Other/*') ? 'active':''}}">
                      <a href="{{url('user/Other/home')}}" class="menu-link">
                        <i class="fas fa-toolbox"></i>
                      &nbsp;&nbsp;
                        <div data-i18n="List">Other</div>
                      </a>
                    </li>
                    @endif
                  </ul>
                  </li>
                @endif
              <!-- Services end
               @php
                $customLinks = \App\Models\CustomLinkSetting::get();
              @endphp
              @if($customLinks->isNotEmpty())
              <ul class="menu-inner py-1">
                      @foreach($customLinks as $customLink)
                           <li class="menu-item  {{request()->is('$customLink->url') ? 'active':''}}">
                              <a target="__blank" href="{{ url($customLink->url) }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-link"></i>
                            <div data-i18n="{{ $customLink->link_title }}" class="small">{{ $customLink->link_title }}</div>
                            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                          </a>
                        </li>
                      @endforeach
                  </ul>
              @endif

            </ul> 
          @elseif(Auth::user()->type == '4')
            <ul class="menu-inner py-1">
              <!-- Dashboards start -->
              @if(in_array('Private_Dashboard', array_column($RoleAccess, 'per_name')) || in_array('Advanced_Dashboard', array_column($RoleAccess, 'per_name')))
                <li class="menu-item {{request()->is('Employee/dashboard') ? 'active':''}} {{request()->is('Employee/dashboard') ? 'open':''}} {{request()->is('Employee/Advanced') ? 'open':''}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons ti ti-smart-home"></i>
                  <div data-i18n="Dashboards">Dashboards</div>
                  <div class="badge bg-primary rounded-pill ms-auto">2</div>
                </a>
                <ul class="menu-sub">
                  @if(in_array('Private_Dashboard', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/dashboard') ? 'active':''}}">
                    <a href="{{url('Employee/dashboard')}}" class="menu-link">
                      <div data-i18n="Private">Private Dashboard</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('Advanced_Dashboard', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/Advanced') ? 'active':''}}">
                    <a href="{{url('Employee/Advanced')}}" class="menu-link">
                      <div data-i18n="Advanced">Advanced Dashboard</div>
                    </a>
                  </li>
                  @endif
                </ul>
                </li>
              @endif
              <!-- Dashboards end -->  
              <!-- User start -->
              @if(in_array('Client', array_column($RoleAccess, 'per_name')) || in_array('Vendor', array_column($RoleAccess, 'per_name')))
                <li class="menu-item {{request()->is('Employee/Client/*') ? 'open':''}} {{request()->is('Employee/Vendor/*') ? 'open':''}} {{request()->is('Employee/Client/*') ? 'active':''}}">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon fa-solid fa-user"></i>
                    <div data-i18n="Users">Users</div>
                  </a>
                  <ul class="menu-sub">
                    @if(in_array('Client', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Client/*') ? 'active':''}}">
                      <a href="{{url('Employee/Client/home')}}" class="menu-link">
                        <div data-i18n="List">Client</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Vendor', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Vendor/*') ? 'active':''}}">
                      <a href="{{url('Employee/Vendor/home')}}" class="menu-link">
                        <div data-i18n="List">Vendor</div>
                      </a>
                    </li>
                    @endif
                  </ul>
                </li>
              @endif
              <!-- User end -->
              <!-- Sales start -->
              @if(in_array('Leads', array_column($RoleAccess, 'per_name')) || in_array('Quotes', array_column($RoleAccess, 'per_name')) || in_array('SpecialOffers', array_column($RoleAccess, 'per_name')) || in_array('Goal', array_column($RoleAccess, 'per_name')) || in_array('MassMail', array_column($RoleAccess, 'per_name')))
                <li class="menu-item {{request()->is('Employee/Leads/*') ? 'open':''}}   
                                     {{request()->is('Employee/Quotes/*') ? 'open':''}}  
                                     {{request()->is('Employee/SpecialOffers/*') ? 'open':''}}
                                     {{request()->is('Employee/Goal/*') ? 'open':''}}
                                     {{request()->is('Employee/MassMail/*') ? 'open':''}}

                                     {{request()->is('Employee/Leads/*') ? 'active':''}} 
                                     {{request()->is('Employee/Quotes/*') ? 'active':''}} 
                                     {{request()->is('Employee/SpecialOffers/*') ? 'active':''}}
                                     {{request()->is('Employee/Goal/*') ? 'active':''}}
                                     {{request()->is('Employee/MassMail/*') ? 'active':''}}">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon fa-solid fa-globe"></i>
                    <div data-i18n="globe">Sales</div>
                  </a>
                  <ul class="menu-sub">
                    @if(in_array('Leads', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Leads/*') ? 'active':''}}">
                      <a href="{{url('Employee/Leads/home')}}" class="menu-link">
                        <div data-i18n="List">Leads</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Quotes', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Quotes/*') ? 'active':''}}">
                      <a href="{{url('Employee/Quotes/home')}}" class="menu-link">
                        <div data-i18n="List">Quotes</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('MassMail', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/MassMail/*') ? 'active':''}}">
                      <a href="{{url('Employee/MassMail/home')}}" class="menu-link">
                        <div data-i18n="List">Mass Mail</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('SpecialOffers', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/SpecialOffers/*') ? 'active':''}}">
                      <a href="{{url('Employee/SpecialOffers/home')}}" class="menu-link">
                        <div data-i18n="List">Special Offers</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Goal', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Goal/*') ? 'active':''}}">
                      <a href="{{url('Employee/Goal/home')}}" class="menu-link">
                        <div data-i18n="List">Goals </div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('SpecialOffers', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item">
                      <a href="#" class="menu-link">
                        <div data-i18n="List">Advertisement</div>
                      </a>
                    </li>
                    @endif
                  </ul>
                </li>
              @endif
              <!-- Sales end -->
              <!-- Network Management start -->
              @if(in_array('NetworkSubnet', array_column($RoleAccess, 'per_name')) || in_array('IPAddress', array_column($RoleAccess, 'per_name')) || in_array('Rack', array_column($RoleAccess, 'per_name')) || in_array('Switchs', array_column($RoleAccess, 'per_name')) || in_array('Firewall', array_column($RoleAccess, 'per_name')))
                <li class="menu-item 
                                     {{request()->is('Employee/NetworkSubnet/*') ? 'open':''}}
                                     {{request()->is('Employee/NetworkSubnet/*') ? 'active':''}}
                                     {{request()->is('Employee/IPAddress/*') ? 'open':''}}
                                     {{request()->is('Employee/IPAddress/*') ? 'active':''}}
                                     {{request()->is('Employee/Rack/*') ? 'open':''}}
                                     {{request()->is('Employee/Rack/*') ? 'active':''}}
                                     {{request()->is('Employee/Switchs/*') ? 'open':''}}
                                     {{request()->is('Employee/Switchs/*') ? 'active':''}}
                                     {{request()->is('Employee/Firewall/*') ? 'open':''}}
                                     {{request()->is('Employee/Firewall/*') ? 'active':''}}
                                     ">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon fa-brands fa-hive"></i>
                    <div data-i18n="Users" class="small">Network Management</div>
                  </a>
                  <ul class="menu-sub">
                    @if(in_array('NetworkSubnet', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/NetworkSubnet/*') ? 'active':''}}">
                      <a href="{{url('Employee/NetworkSubnet/home')}}" class="menu-link">
                        <div data-i18n="List">Network Subnet</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('IPAddress', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/IPAddress/*') ? 'active':''}}">
                      <a href="{{url('Employee/IPAddress/home')}}" class="menu-link">
                        <div data-i18n="List">IP Address</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Rack', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Rack/*') ? 'active':''}}">
                      <a href="{{url('Employee/Rack/home')}}" class="menu-link">
                        <div data-i18n="List">Rack</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Switchs', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Switchs/*') ? 'active':''}}">
                      <a href="{{url('Employee/Switchs/home')}}" class="menu-link">
                        <div data-i18n="List">Switch</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Firewall', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Firewall/*') ? 'active':''}}">
                      <a href="{{url('Employee/Firewall/home')}}" class="menu-link">
                        <div data-i18n="List">Firewall</div>
                      </a>
                    </li>
                    @endif
                  </ul>
                </li>
              @endif
              <!-- Network Management end -->
              <!-- Services start -->
              @if(in_array('BareMetal', array_column($RoleAccess, 'per_name')) || in_array('CloudHosting', array_column($RoleAccess, 'per_name')) || in_array('CloudServices', array_column($RoleAccess, 'per_name')) || in_array('DedicatedServer', array_column($RoleAccess, 'per_name')) || in_array('AwsService', array_column($RoleAccess, 'per_name')) || in_array('Azure', array_column($RoleAccess, 'per_name')) || in_array('GoogleWorkSpace', array_column($RoleAccess, 'per_name')) || in_array('MicrosoftOffice365', array_column($RoleAccess, 'per_name')) || in_array('OneTimeSetup', array_column($RoleAccess, 'per_name')) || in_array('MonthelySetup', array_column($RoleAccess, 'per_name')) || in_array('SSLCertificate', array_column($RoleAccess, 'per_name')) || in_array('Antivirus', array_column($RoleAccess, 'per_name')) || in_array('Licenses', array_column($RoleAccess, 'per_name')) || in_array('Acronis', array_column($RoleAccess, 'per_name')) || in_array('TsPlus', array_column($RoleAccess, 'per_name')) || in_array('Other', array_column($RoleAccess, 'per_name')))
                <li class="menu-item 
                                  {{request()->is('Employee/BareMetal/*') ? 'open':''}}
                                  {{request()->is('Employee/BareMetal/*') ? 'active':''}}
                                  {{request()->is('Employee/CloudHosting/*') ? 'open':''}}
                                  {{request()->is('Employee/CloudHosting/*') ? 'active':''}}
                                  {{request()->is('Employee/CloudServices/*') ? 'open':''}}
                                  {{request()->is('Employee/CloudServices/*') ? 'active':''}}
                                  {{request()->is('Employee/DedicatedServer/*') ? 'open':''}}
                                  {{request()->is('Employee/DedicatedServer/*') ? 'active':''}}
                                  {{request()->is('Employee/AwsService/*') ? 'open':''}}
                                  {{request()->is('Employee/AwsService/*') ? 'active':''}}
                                  {{request()->is('Employee/Azure/*') ? 'open':''}}
                                  {{request()->is('Employee/Azure/*') ? 'active':''}}
                                  {{request()->is('Employee/GoogleWorkSpace/*') ? 'open':''}}
                                  {{request()->is('Employee/GoogleWorkSpace/*') ? 'active':''}}
                                  {{request()->is('Employee/MicrosoftOffice365/*') ? 'open':''}}
                                  {{request()->is('Employee/MicrosoftOffice365/*') ? 'active':''}}
                                  {{request()->is('Employee/OneTimeSetup/*') ? 'open':''}}
                                  {{request()->is('Employee/OneTimeSetup/*') ? 'active':''}}
                                  {{request()->is('Employee/MonthelySetup/*') ? 'open':''}}
                                  {{request()->is('Employee/MonthelySetup/*') ? 'active':''}}
                                  {{request()->is('Employee/SSLCertificate/*') ? 'open':''}}
                                  {{request()->is('Employee/SSLCertificate/*') ? 'active':''}}
                                  {{request()->is('Employee/Antivirus/*') ? 'open':''}}
                                  {{request()->is('Employee/Antivirus/*') ? 'active':''}}
                                  {{request()->is('Employee/Licenses/*') ? 'open':''}}
                                  {{request()->is('Employee/Licenses/*') ? 'active':''}}
                                  {{request()->is('Employee/Acronis/*') ? 'open':''}}
                                  {{request()->is('Employee/Acronis/*') ? 'active':''}}
                                  {{request()->is('Employee/TsPlus/*') ? 'open':''}}
                                  {{request()->is('Employee/TsPlus/*') ? 'active':''}}
                                  {{request()->is('Employee/Other/*') ? 'open':''}}
                                  {{request()->is('Employee/Other/*') ? 'active':''}}
                                                                                          ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fa-solid fa-cloud"></i>
                <div data-i18n="Users">Services</div>
                </a>
                <ul class="menu-sub CircleR">
                  @if(in_array('BareMetal', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/BareMetal/*') ? 'active':''}}">
                    <a href="{{url('Employee/BareMetal/home')}}" class="menu-link">
                      <i class="fa-solid fa-bars"></i>
                    &nbsp;&nbsp;
                      <div data-i18n="List">Bare Metal (VT)</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('CloudHosting', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/CloudHosting/*') ? 'active':''}}">
                    <a href="{{url('Employee/CloudHosting/home')}}" class="menu-link">
                      <i class="fas fa-cloud-upload-alt"></i> 
                      &nbsp;&nbsp;
                      <div data-i18n="List">Cloud Hosting</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('CloudServices', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/CloudServices/*') ? 'active':''}}">
                    <a href="{{url('Employee/CloudServices/home')}}" class="menu-link">
                      <i class="fas fa-cloud"></i>
                    &nbsp;&nbsp;
                      <div data-i18n="List">Cloud Services</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('DedicatedServer', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/DedicatedServer/*') ? 'active':''}}">
                    <a href="{{url('Employee/DedicatedServer/home')}}" class="menu-link">
                      <i class="fas fa-server"></i>
                     &nbsp;&nbsp;
                      <div data-i18n="List">Dedicated Server</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('AwsService', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/AwsService/*') ? 'active':''}}">
                    <a href="{{url('Employee/AwsService/home')}}" class="menu-link">
                      <i class="fa-brands fa-aws"></i>
                    &nbsp;&nbsp;
                      <div data-i18n="List">Aws Service</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('Azure', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/Azure/*') ? 'active':''}}">
                    <a href="{{url('Employee/Azure/home')}}" class="menu-link">
                      <i class="fab fa-microsoft"></i>
                     &nbsp;&nbsp;
                      <div data-i18n="List">Microsoft Azure</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('GoogleWorkSpace', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/GoogleWorkSpace/*') ? 'active':''}}">
                    <a href="{{url('Employee/GoogleWorkSpace/home')}}" class="menu-link">
                      <i class="fab fa-google"></i>
                     &nbsp;&nbsp;
                      <div data-i18n="List">Google Work Space</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('MicrosoftOffice365', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/MicrosoftOffice365/*') ? 'active':''}}">
                    <a href="{{url('Employee/MicrosoftOffice365/home')}}" class="menu-link">
                     <img src="{{url('public/images/tsPlus.png')}}" alt="Acronis Icon" style="width: 20px; height: 20px;">
                    &nbsp;&nbsp;
                      <div data-i18n="List">Microsoft Office 365</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('OneTimeSetup', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/OneTimeSetup/*') ? 'active':''}}">
                    <a href="{{url('Employee/OneTimeSetup/home')}}" class="menu-link">
                      <i class="fas fa-cog"></i>
                      &nbsp;&nbsp;
                      <div data-i18n="List">One Time Setup</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('MonthelySetup', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/MonthelySetup/*') ? 'active':''}}">
                    <a href="{{url('Employee/MonthelySetup/home')}}" class="menu-link">
                      <i class="fas fa-cogs"></i>
                    &nbsp;&nbsp;
                      <div data-i18n="List">Monthely Setup</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('SSLCertificate', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/SSLCertificate/*') ? 'active':''}}">
                    <a href="{{url('Employee/SSLCertificate/home')}}" class="menu-link">
                      <i class="fas fa-stamp"></i>
                    &nbsp;&nbsp;
                      <div data-i18n="List">SSL Certificate</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('Antivirus', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/Antivirus/*') ? 'active':''}}">
                    <a href="{{url('Employee/Antivirus/home')}}" class="menu-link">
                      <i class="fas fa-shield-virus"></i>
                    &nbsp;&nbsp;
                      <div data-i18n="List">Antivirus</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('Licenses', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/Licenses/*') ? 'active':''}}">
                    <a href="{{url('Employee/Licenses/home')}}" class="menu-link">
                      <i class="fas fa-id-badge"></i>
                    &nbsp;&nbsp;
                      <div data-i18n="List">Licenses</div>
                    </a>
                  </li>
                  @endif
              
                  
                 
                   @if(in_array('Acronis', array_column($RoleAccess, 'per_name')))  
                   <li class="menu-item {{request()->is('Employee/Acronis/*') ? 'active':''}}">
                    <a href="{{url('Employee/Acronis/home')}}" class="menu-link">
                          <i>
                              <img src="{{url('public/images/Acroniss.png')}}" alt="Acronis Icon" style="width: 15px; height: 15px;">
                          </i>
                          &nbsp;&nbsp;
                          <div data-i18n="List">Acronis</div>
                      </a>
                  </li>

                    @endif
                    @if(in_array('TsPlus', array_column($RoleAccess, 'per_name')))  
                    <!-- <li class="menu-item {{request()->is('user/TsPlus/*') ? 'active':''}}">
                      <a href="{{url('user/TsPlus/home')}}" class="menu-link">
                       <i class="fas fa-plus-square"></i>
                      &nbsp;&nbsp;
                        <div data-i18n="List">TsPlus</div>
                      </a>
                    </li> -->
                   <li class="menu-item {{request()->is('Employee/TsPlus/*') ? 'active':''}}">
                    <a href="{{url('Employee/TsPlus/home')}}" class="menu-link">
                          <i>
                              <img src="{{url('public/images/tsPlus.png')}}" alt="Acronis Icon" style="width: 20px; height: 20px;">
                          </i>
                          &nbsp;&nbsp;
                        <div data-i18n="List">TsPlus</div>
                      </a>
                  </li>
                    @endif


                  @if(in_array('Other', array_column($RoleAccess, 'per_name')))  
                  <li class="menu-item {{request()->is('Employee/Other/*') ? 'active':''}}">
                    <a href="{{url('Employee/Other/home')}}" class="menu-link">
                      <i class="fas fa-toolbox"></i>
                    &nbsp;&nbsp;
                      <div data-i18n="List">Other</div>
                    </a>
                  </li>
                  @endif
                </ul>
                </li>
              @endif
              <!-- Services end -->
              <!-- Ticket start -->
               @if(in_array('Tickets', array_column($RoleAccess, 'per_name')))
                <li class="menu-item {{request()->is('Employee/Ticket/*') ? 'open':''}} {{request()->is('Employee/Vendor/*') ? 'open':''}} {{request()->is('Employee/Ticket/*') ? 'active':''}}">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon fa-solid fa-ticket"></i>
                    <div data-i18n="Ticket">Ticket Support</div>
                  </a>
                  <ul class="menu-sub">
                    <li class="menu-item {{request()->is('Employee/Ticket/*') ? 'active':''}}">
                      <a href="{{url('Employee/Ticket/home')}}" class="menu-link">
                        <div data-i18n="Ticket">Tickets</div>
                      </a>
                    </li>
                  </ul>
                </li>
                @endif
              <!-- Ticket end -->
              <!-- Work start -->
              @if(in_array('Project', array_column($RoleAccess, 'per_name')) || in_array('Task', array_column($RoleAccess, 'per_name')) || in_array('TimeSheet', array_column($RoleAccess, 'per_name')))
               <li class="menu-item 
                                  {{request()->is('Employee/Project/*') ? 'open':''}}
                                  {{request()->is('Employee/Project/*') ? 'active':''}}
                                  {{request()->is('Employee/Task/*') ? 'open':''}}
                                  {{request()->is('Employee/Task/*') ? 'active':''}}
                                  {{request()->is('Employee/TimeSheet/*') ? 'open':''}}
                                  {{request()->is('Employee/TimeSheet/*') ? 'active':''}}

               ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons fa-solid fa-business-time"></i>
                  <div data-i18n="Dashboards">Work</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
                </a>
                <ul class="menu-sub">
                @if(in_array('Project', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/Project*') ? 'active':''}}">
                    <a href="{{url('Employee/Project/home')}}" class="menu-link">
                      <div data-i18n="Private">Project</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('Task', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/Task*') ? 'active':''}}">
                    <a href="{{url('Employee/Task/home')}}" class="menu-link">
                      <div data-i18n="Advanced">Task</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('TimeSheet', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/TimeSheet*') ? 'active':''}}">
                    <a href="{{url('Employee/TimeSheet/home')}}" class="menu-link">
                      <div data-i18n="Advanced">Time Sheet</div>
                    </a>
                  </li>
                  @endif
                </ul>
                </li>
                @endif
              <!-- Work End -->
              <!-- Inventory Management start -->
              @if(in_array('Inventory', array_column($RoleAccess, 'per_name')))
                <li class="menu-item  {{request()->is('Employee/Inventory*') ? 'active':''}}">
                  <a href="{{url('Employee/Inventory/home')}}" class="menu-link ">
                    <i class="menu-icon fa-solid fa-i"></i>
                    <div data-i18n="Dashboards" class="small">Inventory Management</div>
                    <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                  </a>
                </li>
              @endif
              <!-- Inventory Management end -->
              <!-- Human Resources start -->
              @if(in_array('Department', array_column($RoleAccess, 'per_name')) || in_array('JobRole', array_column($RoleAccess, 'per_name')) || in_array('TimeShift', array_column($RoleAccess, 'per_name')) || in_array('Attendence', array_column($RoleAccess, 'per_name')) || in_array('Holiday', array_column($RoleAccess, 'per_name')) || in_array('Leave', array_column($RoleAccess, 'per_name')) || in_array('LeavePolicies', array_column($RoleAccess, 'per_name')) || in_array('Employee', array_column($RoleAccess, 'per_name')) || in_array('File', array_column($RoleAccess, 'per_name')) || in_array('Performance', array_column($RoleAccess, 'per_name')) || in_array('Calendar', array_column($RoleAccess, 'per_name')) || in_array('PayRoll', array_column($RoleAccess, 'per_name')))
                <li class="menu-item {{request()->is('Employee/Department/*') ? 'open':''}}    
                                     {{request()->is('Employee/JobRole/*') ? 'open':''}}    
                                     {{request()->is('Employee/TimeShift/*') ? 'open':''}}    
                                     {{request()->is('Employee/Attendence/*') ? 'open':''}}    
                                     {{request()->is('Employee/Holiday/*') ? 'open':''}}    
                                     {{request()->is('Employee/Leave/*') ? 'open':''}}    
                                     {{request()->is('Employee/LeavePolicies/*') ? 'open':''}}    
                                     {{request()->is('Employee/Employee/*') ? 'open':''}}    
                                     {{request()->is('Employee/Holiday/*') ? 'active':''}}
                                     {{request()->is('Employee/File/*') ? 'open':''}}    
                                     {{request()->is('Employee/File/*') ? 'active':''}}
                                     {{request()->is('Employee/Performance/*') ? 'open':''}}    
                                     {{request()->is('Employee/Performance/*') ? 'active':''}}
                                     {{request()->is('Employee/Calendar/*') ? 'open':''}}    
                                     {{request()->is('Employee/PayRoll/*') ? 'active':''}}
                                     {{request()->is('Employee/PayRoll/*') ? 'open':''}}    
                                     {{request()->is('Employee/Calendar/*') ? 'active':''}}
                                     {{request()->is('Employee/Employee/*') ? 'active':''}}
                                     {{request()->is('Employee/LeavePolicies/*') ? 'active':''}}
                                     {{request()->is('Employee/Leave/*') ? 'active':''}}
                                     {{request()->is('Employee/Attendence/*') ? 'active':''}}
                                     {{request()->is('Employee/TimeShift/*') ? 'active':''}}
                                     {{request()->is('Employee/Department/*') ? 'active':''}}
                                     {{request()->is('Employee/JobRole/*') ? 'active':''}}">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons fa-brands fa-osi"></i>
                    <div data-i18n="globe">Human Resources</div>
                  </a>
                  <ul class="menu-sub">
                    @if(in_array('Department', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Department/*') ? 'active':''}}">
                      <a href="{{url('Employee/Department/home')}}" class="menu-link">
                        <div data-i18n="List">Department </div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('JobRole', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/JobRole/*') ? 'active':''}}">
                      <a href="{{url('Employee/JobRole/home')}}" class="menu-link">
                        <div data-i18n="List">Job Role</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('TimeShift', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/TimeShift/*') ? 'active':''}}">
                      <a href="{{url('Employee/TimeShift/home')}}" class="menu-link">
                        <div data-i18n="List">Time Shift</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Attendence', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Attendence/*') ? 'active':''}}">
                      <a href="{{url('Employee/Attendence/home')}}" class="menu-link">
                        <div data-i18n="List">Attendence</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Holiday', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Holiday/*') ? 'active':''}}">
                      <a href="{{url('Employee/Holiday/home')}}" class="menu-link">
                        <div data-i18n="List">Holiday</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Leave', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Leave/*') ? 'active':''}}">
                      <a href="{{url('Employee/Leave/home')}}" class="menu-link">
                        <div data-i18n="List">Leaves</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('LeavePolicies', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/LeavePolicies/*') ? 'active':''}}">
                      <a href="{{url('Employee/LeavePolicies/home')}}" class="menu-link">
                        <div data-i18n="List">Policies</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Employee', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Employee/*') ? 'active':''}}">
                      <a href="{{url('Employee/Employee/home')}}" class="menu-link">
                        <div data-i18n="List">Employee</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('File', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/File/*') ? 'active':''}}">
                      <a href="{{url('Employee/File/home')}}" class="menu-link">
                        <div data-i18n="List">File</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Performance', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Performance/*') ? 'active':''}}">
                      <a href="{{url('Employee/Performance/home')}}" class="menu-link">
                        <div data-i18n="List">Performance</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Calendar', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/Calendar/*') ? 'active':''}}">
                      <a href="{{url('Employee/Calendar/home')}}" class="menu-link">
                        <div data-i18n="List">Calendar</div>
                      </a>
                    </li>
                    @endif
                    @if(in_array('Calendar', array_column($RoleAccess, 'per_name')))
                    <li class="menu-item {{request()->is('Employee/PayRoll/*') ? 'active':''}}">
                      <a href="{{url('Employee/PayRoll/home')}}" class="menu-link">
                        <div data-i18n="List">PayRoll</div>
                      </a>
                    </li>
                    @endif
                  </ul>
                </li>
              @endif
              <!-- Human Resources end -->
              <!-- Company Login start -->
              @if(in_array('CompanyLogin', array_column($RoleAccess, 'per_name')))
               <li class="menu-item  {{request()->is('Employee/CompanyLogin*') ? 'active':''}}">
                <a href="{{url('Employee/CompanyLogin/home')}}" class="menu-link ">
                  <i class="menu-icon fa-regular fa-building"></i>
                  <div data-i18n="Dashboards">Company Login</div>
                  <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                </a>
                </li>
              @endif
              <!-- Company Login end -->
              
              <!-- Settings start -->
              @if(in_array('Product', array_column($RoleAccess, 'per_name')) || in_array('Role', array_column($RoleAccess, 'per_name')) || in_array('PaymentMethod', array_column($RoleAccess, 'per_name')) || in_array('Security', array_column($RoleAccess, 'per_name')) || in_array('SecuritySettings', array_column($RoleAccess, 'per_name')) || in_array('MailSettings', array_column($RoleAccess, 'per_name')) || in_array('ProjectCategory', array_column($RoleAccess, 'per_name')) || in_array('TaskCategory', array_column($RoleAccess, 'per_name')) || in_array('LogActivity', array_column($RoleAccess, 'per_name')) || in_array('Template', array_column($RoleAccess, 'per_name')) || in_array('Notice', array_column($RoleAccess, 'per_name')))
              <li class="menu-item 
                                   {{request()->is('Employee/Product/*') ? 'open':''}}    
                                   {{request()->is('Employee/Product/*') ? 'active':''}}
                                   {{request()->is('Employee/Role/*') ? 'open':''}}    
                                   {{request()->is('Employee/Role/*') ? 'active':''}}
                                   {{request()->is('Employee/PaymentMethod/*') ? 'open':''}}    
                                   {{request()->is('Employee/PaymentMethod/*') ? 'active':''}}
                                   {{request()->is('Employee/Security/*') ? 'open':''}}    
                                   {{request()->is('Employee/Security/*') ? 'active':''}}
                                   {{request()->is('Employee/SecuritySettings/*') ? 'open':''}}    
                                   {{request()->is('Employee/SecuritySettings/*') ? 'active':''}}
                                   {{request()->is('Employee/MailSettings/*') ? 'open':''}}    
                                   {{request()->is('Employee/MailSettings/*') ? 'active':''}}
                                   {{request()->is('Employee/ProjectCategory/*') ? 'open':''}}    
                                   {{request()->is('Employee/ProjectCategory/*') ? 'active':''}}
                                   {{request()->is('Employee/TaskCategory/*') ? 'open':''}}    
                                   {{request()->is('Employee/TaskCategory/*') ? 'active':''}}
                                   {{request()->is('Employee/LogActivity/*') ? 'open':''}}    
                                   {{request()->is('Employee/LogActivity/*') ? 'active':''}}
                                   {{request()->is('Employee/Template/*') ? 'open':''}}    
                                   {{request()->is('Employee/Template/*') ? 'active':''}}
                                   {{request()->is('Employee/Notice/*') ? 'open':''}}    
                                   {{request()->is('Employee/Notice/*') ? 'active':''}}
                                   ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons fa-solid fa-gear"></i>
                  <div data-i18n="globe">Settings</div>
                </a>
                <ul class="menu-sub">
                  @if(in_array('Role', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/Role/*') ? 'active':''}}">
                    <a href="{{url('Employee/Role/home')}}" class="menu-link">
                      <div data-i18n="List">Role</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('ProjectCategory', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/ProjectCategory/*') ? 'active':''}}">
                    <a href="{{url('Employee/ProjectCategory/home')}}" class="menu-link">
                      <div data-i18n="List">Project Category</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('TaskCategory', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/TaskCategory/*') ? 'active':''}}">
                    <a href="{{url('Employee/TaskCategory/home')}}" class="menu-link">
                      <div data-i18n="List">Task Category</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('ServiceAutomation', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/Product/*') ? 'active':''}}">
                    <a href="{{url('Employee/Product/home')}}" class="menu-link">
                      <div data-i18n="List">ServiceAutomation</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('PaymentMethod', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/PaymentMethod/*') ? 'active':''}}">
                    <a href="{{url('Employee/PaymentMethod/home')}}" class="menu-link">
                      <div data-i18n="List">Payment Method</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('Template', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/Template/*') ? 'active':''}}">
                    <a href="{{url('Employee/Template/home')}}" class="menu-link">
                      <div data-i18n="List">SmS/Email Template</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('Security', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/Security/*') ? 'active':''}}">
                    <a href="{{url('Employee/Security/home')}}" class="menu-link">
                      <div data-i18n="List">Security</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('SecuritySettings', array_column($RoleAccess, 'per_name')))
                   <li class="menu-item {{request()->is('Employee/SecuritySettings/*') ? 'active':''}}">
                    <a href="{{url('Employee/SecuritySettings/home')}}" class="menu-link">
                      <div data-i18n="List">Security Setting</div>
                    </a>
                  </li>
                  @endif

                   @if(in_array('FileManagement', array_column($RoleAccess, 'per_name')))
                   <li class="menu-item {{request()->is('Employee/FileManagement/*') ? 'active':''}}">
                    <a href="{{url('Employee/FileManagement/home')}}" class="menu-link">
                      <div data-i18n="List">File Management</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('MailSettings', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/MailSettings/*') ? 'active':''}}">
                    <a href="{{url('Employee/MailSettings/home')}}" class="menu-link">
                      <div data-i18n="List">Mail Setting</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('LogActivity', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/LogActivity/*') ? 'active':''}}">
                    <a href="{{url('Employee/LogActivity/home')}}" class="menu-link">
                      <div data-i18n="List">Logs Management</div>
                    </a>
                  </li>
                  @endif
                  @if(in_array('Notice', array_column($RoleAccess, 'per_name')))
                  <li class="menu-item {{request()->is('Employee/Notice/*') ? 'active':''}}">
                    <a href="{{url('Employee/Notice/home')}}" class="menu-link">
                      <div data-i18n="List">Notice</div>
                    </a>
                  </li>
                  @endif
                </ul>
              </li>
              @endif
            <!-- Settings end -->
             @php
                $customLinks = \App\Models\CustomLinkSetting::get();
              @endphp
              @if($customLinks->isNotEmpty())
              <ul class="menu-inner py-1">
                      @foreach($customLinks as $customLink)
                           <li class="menu-item  {{request()->is('$customLink->url') ? 'active':''}}">
                              <a target="__blank" href="{{ url($customLink->url) }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-link"></i>
                            <div data-i18n="{{ $customLink->link_title }}" class="small">{{ $customLink->link_title }}</div>
                            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                          </a>
                        </li>
                      @endforeach
                  </ul>
              @endif


            </ul>
          @endif
       

        </aside>
        <!-- / Menu -->