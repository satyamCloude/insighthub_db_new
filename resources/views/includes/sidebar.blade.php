@php
$id = Auth::user()->id;
$username = Session::get('UserName');
$RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
->join('employee_details','employee_details.job_role_id','role_accesses.role_id')
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
$BareMetal = \App\Models\Orders::where('productCategoryId',4)->where('user_id',Auth::user()->id)->count();
$CloudHosting = \App\Models\Orders::where('productCategoryId',5)->where('user_id',Auth::user()->id)->count();
$CloudServices = \App\Models\Orders::where('productCategoryId',6)->where('user_id',Auth::user()->id)->count();
$DedicatedServer = \App\Models\Orders::where('productCategoryId',7)->where('user_id',Auth::user()->id)->count();
$AwsService = \App\Models\Orders::where('productCategoryId',8)->where('user_id',Auth::user()->id)->count();
$MicrosoftAzure = \App\Models\Orders::where('productCategoryId',9)->where('user_id',Auth::user()->id)->count();
$GoogleWorkSpace = \App\Models\Orders::where('productCategoryId',10)->where('user_id',Auth::user()->id)->count();
$MicrosoftOffice365 = \App\Models\Orders::where('productCategoryId',11)->where('user_id',Auth::user()->id)->count();
$OneTimeSetup = \App\Models\Orders::where('productCategoryId',12)->where('user_id',Auth::user()->id)->count();
$MonthelySetup = \App\Models\Orders::where('productCategoryId',13)->where('user_id',Auth::user()->id)->count();
$SSLCertificate = \App\Models\Orders::where('productCategoryId',14)->where('user_id',Auth::user()->id)->count();
$Antivirus = \App\Models\Orders::where('productCategoryId',15)->where('user_id',Auth::user()->id)->count();
$Licenses = \App\Models\Orders::where('productCategoryId',16)->where('user_id',Auth::user()->id)->count();
$Acronis = \App\Models\Orders::where('productCategoryId',17)->where('user_id',Auth::user()->id)->count();
$TsPlus = \App\Models\Orders::where('productCategoryId',18)->where('user_id',Auth::user()->id)->count();
$role_id = \App\Models\EmployeeDetail::where('user_id',Auth::user()->id)->select('admin_type_id')->first();
$depart_ment = \App\Models\EmployeeDetail::where('user_id',Auth::user()->id)->select('department_id','job_role_id','jobrole_id')->first();
$services = \App\Models\Category::get();
@endphp
<style>
   .ntwk {
   color: #7367f0;
   margin-right: 6px;
   }
   .netwrk::before {
   display: none;
   }
   .CircleR .menu-item:not(.active)>.menu-link::before {
   color: #A5A3AE !important;
   display: none;
   }
   .color1 {
   color: #7367f0 !important;
   font-size: 16px;
   }
   .menu-vertical .menu-sub .menu-link {
   padding-left: 2.2rem;
   }
   .color2 {
   color: white !important;
   font-size: 16px;
   }
   .bg-menu-theme.menu-vertical .menu-sub>.menu-item>.menu-link:before {
   color: transparent !important;
   }
   .bg-menu-theme .menu-inner .menu-sub .menu-item:not(.active)>.menu-link::before {
   color: #7367f0 !important;
   }
   .menu-item.open > .menu-sub {
   display: block; /* Ensures the submenu is always visible */
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
   <ul class="menu-inner py-1">
      @if(Auth::user()->type == '1')
      <!-- Dashboards start -->
      <li class="menu-item {{request()->is('admin/dashboard') ? 'active':''}} {{request()->is('admin/dashboard') ? 'open':''}}  {{request()->is('admin/Advanced') ? 'open':''}}">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home ntwk"></i>
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
            <i class="menu-icon fa-solid fa-user color1"></i>
            <div data-i18n="Users">Users</div>
         </a>
         <ul class="menu-sub CircleR">
            <li class="menu-item {{request()->is('admin/Client/*') ? 'active':''}}">
               <a href="{{url('admin/Client/home')}}" class="menu-link">
                  <i class="fa-solid fa-handshake {{request()->is('admin/Client*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Client</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Vendor/*') ? 'active':''}}">
               <a href="{{url('admin/Vendor/home')}}" class="menu-link">
                  <i class="fa-solid fa-circle-user {{request()->is('admin/Vendor*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Vendor</div>
               </a>
            </li>
         </ul>
      </li>
      <!-- User end -->
      <!-- <li class="menu-item {{request()->is('admin/Invoices/*') ? 'open':''}}  {{request()->is('admin/Orders/*') ? 'open':''}}  {{request()->is('admin/Orders/*') ? 'open':''}}  {{request()->is('admin/transaction/*') ? 'open':''}} {{request()->is('admin/Role/*') ? 'open':''}} {{request()->is('admin/Role/*') ? 'active':''}}">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fas fa-calculator color1"></i>
            <div data-i18n="globe">Accounting</div>
         </a>
         <ul class="menu-sub CircleR">
            <li class="menu-item {{request()->is('admin/Invoices/*') ? 'active':''}}">
               <a href="{{url('admin/Invoices/home')}}" class="menu-link">
                  <i class="fas fa-file-invoice {{request()->is('admin/Invoices*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Invoices</div>
               </a>
            </li>
               <li class="menu-item {{request()->is('admin/CurrencySettings/*') ? 'active':''}}">
                 <a href="{{url('admin/CurrencySettings/home')}}" class="menu-link">
                   <div data-i18n="List">Balance sheet</div>
                 </a>
               </li> 
            <li class="menu-item {{request()->is('admin/Orders/*') ? 'active':''}}">
               <a href="{{url('admin/Orders/home')}}" class="menu-link">
                  <i class="fa-solid fa-box {{request()->is('admin/Orders*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Order</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/transaction/*') ? 'active':''}}">
               <a href="{{url('admin/transaction/home')}}" class="menu-link">
                  <i class="fa-solid fa-sack-dollar {{request()->is('admin/transaction*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Transaction</div>
               </a>
            </li>
         </ul>
      </li>
      -->
      <!-- Sales start -->
      <li class="menu-item {{request()->is('admin/Leads/*') ? 'open':''}}   
         {{request()->is('admin/Quotes/*') ? 'open':''}}
         {{request()->is('admin/Category/*') ? 'open':''}}
         {{request()->is('admin/HostingPanel/*') ? 'open':''}}  
         {{request()->is('admin/SpecialOffers/*') ? 'open':''}}
         {{request()->is('admin/Goal/*') ? 'open':''}}
         {{request()->is('admin/MassMail/*') ? 'open':''}}
         {{request()->is('admin/recent_follow_ups/*') ? 'open':''}}
         {{request()->is('admin/Leads/*') ? 'active':''}} 
         {{request()->is('admin/HostingPanel/*') ? 'active':''}} 
         {{request()->is('admin/Quotes/*') ? 'active':''}} 
         {{request()->is('admin/recent_follow_ups/*') ? 'active':''}} 
         {{request()->is('admin/Category/*') ? 'active':''}} 
         {{request()->is('admin/SpecialOffers/*') ? 'active':''}}
         {{request()->is('admin/Goal/*') ? 'active':''}}
         {{request()->is('admin/MassMail/*') ? 'active':''}}">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-globe color1"></i>
            <div data-i18n="globe">Sales</div>
         </a>
         <ul class="menu-sub CircleR">
            <li class="menu-item {{request()->is('admin/Leads/*') ? 'active':''}}">
               <a href="{{url('admin/Leads/home')}}" class="menu-link">
                  <i class="fa-solid fa-circle-up {{request()->is('admin/Leads*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Leads</div>
               </a>
            </li>
            <!--<li class="menu-item {{request()->is('admin/recent_follow_ups/*') ? 'active':''}}">-->
            <!--  <a href="{{url('admin/recent_follow_ups')}}" class="menu-link">-->
            <!--    <div data-i18n="List">Follow UP</div>-->
            <!--  </a>-->
            <!--</li>-->
            <li class="menu-item {{request()->is('admin/Quotes/*') ? 'active':''}}">
               <a href="{{url('admin/Quotes/home')}}" class="menu-link">
                  <i class="fa-solid fa-quote-left {{request()->is('admin/Quotes*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Quotes</div>
               </a>
            </li>
            <!-- <li class="menu-item {{request()->is('admin/Category/*') ? 'active':''}}">
               <a href="{{url('admin/Category/home')}}" class="menu-link">
                 <div data-i18n="List">Category</div>
               </a>
               </li> -->
            <li class="menu-item {{request()->is('admin/MassMail/*') ? 'active':''}}">
               <a href="{{url('admin/MassMail/home')}}" class="menu-link">
                  <i class="fa-solid fa-envelope {{request()->is('admin/MassMail*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Mass Mail</div>
               </a>
            </li>
            <!-- <li class="menu-item {{request()->is('admin/HostingPanel/*') ? 'active':''}}">
               <a href="{{url('admin/HostingPanel/home')}}" class="menu-link">
                 <div data-i18n="List">Hosting Panel</div>
               </a>
               </li> -->
            <li class="menu-item {{request()->is('admin/SpecialOffers/*') ? 'active':''}}">
               <a href="{{url('admin/SpecialOffers/home')}}" class="menu-link">
                  <i class="fa-solid fa-envelope-open-text {{request()->is('admin/SpecialOffers*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Special Offers</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Goal/*') ? 'active':''}}">
               <a href="{{url('admin/Goal/home')}}" class="menu-link">
                  <i class="fa-solid fa-bullseye {{request()->is('admin/Goal*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Goals </div>
               </a>
            </li>
            <li class="menu-item">
               <a href="#" class="menu-link">
                  <i class="fa-solid fa-rectangle-ad {{request()->is('admin/BareMetal*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
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
            <i class="menu-icon fa-brands fa-hive color1"></i>
            <div data-i18n="Users" class="small">Network Management</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item {{request()->is('admin/NetworkSubnet/*') ? 'active':''}}">
               <a href="{{url('admin/NetworkSubnet/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-network-wired ntwk {{request()->is('admin/NetworkSubnet*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Network Subnet</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/IPAddress/*') ? 'active':''}}">
               <a href="{{url('admin/IPAddress/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-i ntwk {{request()->is('admin/IPAddress*') ? 'color2':'color1'}}" style="margin-right: 3px;"></i><i class="fa-solid fa-p ntwk {{request()->is('admin/IPAddress*') ? 'color2':'color1'}}" style="margin-right:6px;"></i>
                  <div data-i18n="List">IP Address</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Rack/*') ? 'active':''}}">
               <a href="{{url('admin/Rack/home')}}" class="menu-link netwrk">
                  <i class="fas fa-server ntwk {{request()->is('admin/Rack*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Rack</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Switchs/*') ? 'active':''}}">
               <a href="{{url('admin/Switchs/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-toggle-on ntwk {{request()->is('admin/Switchs*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Switch</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Firewall/*') ? 'active':''}}">
               <a href="{{url('admin/Firewall/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-shield-halved ntwk {{request()->is('admin/Firewall*') ? 'color2':'color1'}}"></i>
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
            <i class="menu-icon fa-solid fa-cloud color1"></i>
            <div data-i18n="Users">Services</div>
         </a>
         <ul class="menu-sub CircleR">
            <li class="menu-item {{request()->is('admin/BareMetal/*') ? 'active':''}}">
               <a href="{{url('admin/BareMetal/home')}}" class="menu-link">
                  <i class="fa-solid fa-bars {{request()->is('admin/BareMetal*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="Users">Bare Metal (VT)</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/CloudHosting/*') ? 'active':''}}">
               <a href="{{url('admin/CloudHosting/home')}}" class="menu-link">
                  <i class="fas fa-cloud-upload-alt {{request()->is('admin/CloudHosting*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Hosting</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/CloudServices/*') ? 'active':''}}">
               <a href="{{url('admin/CloudServices/home')}} " class="menu-link">
                  <i class="fas fa-cloud {{request()->is('admin/CloudServices*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Services</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/DedicatedServer/*') ? 'active':''}}">
               <a href="{{url('admin/DedicatedServer/home')}}" class="menu-link">
                  <i class="fas fa-server {{request()->is('admin/DedicatedServer*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Dedicated Server</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/AwsService/*') ? 'active':''}}">
               <a href="{{url('admin/AwsService/home')}}" class="menu-link">
                  <i class="fa-brands fa-aws {{request()->is('admin/AwsService*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Aws Service</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Azure/*') ? 'active':''}}">
               <a href="{{url('admin/Azure/home')}}" class="menu-link">
                  <i class="fab fa-microsoft {{request()->is('admin/Azure*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft Azure</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/GoogleWorkSpace/*') ? 'active':''}}">
               <a href="{{url('admin/GoogleWorkSpace/home')}}" class="menu-link">
                  <i class="fab fa-google {{request()->is('admin/GoogleWorkSpace*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Google Work Space</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/MicrosoftOffice365/*') ? 'active':''}}">
               <a href="{{ url('admin/MicrosoftOffice365/home') }}" class="menu-link">
                  <!-- <i class="fas fa-briefcase"></i> -->
                  <img src="{{ request()->is('admin/MicrosoftOffice365*') ? url('public/images/m1white.png') : url('public/images/m2blue.png') }}" alt="Microsoft 365 Icon" style="width: 20px; height: 20px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft 365</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/OneTimeSetup/*') ? 'active':''}}">
               <a href="{{url('admin/OneTimeSetup/home')}}" class="menu-link">
                  <i class="fas fa-cog {{request()->is('admin/OneTimeSetup*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">One Time Setup</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/MonthelySetup/*') ? 'active':''}}">
               <a href="{{url('admin/MonthelySetup/home')}}" class="menu-link">
                  <i class="fas fa-cogs {{request()->is('admin/MonthelySetup*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Monthly Management</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/SSLCertificate/*') ? 'active':''}}">
               <a href="{{url('admin/SSLCertificate/home')}}" class="menu-link">
                  <i class="fas fa-stamp {{request()->is('admin/SSLCertificate*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">SSL Certificate</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Antivirus/*') ? 'active':''}}">
               <a href="{{url('admin/Antivirus/home')}}" class="menu-link">
                  <i class="fas fa-shield-virus {{request()->is('admin/Antivirus*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Antivirus</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Licenses/*') ? 'active':''}}">
               <a href="{{url('admin/Licenses/home')}}" class="menu-link">
                  <i class="fas fa-id-badge {{request()->is('admin/Licenses*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Licenses</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Acronis/*') ? 'active':''}}">
               <a href="{{url('admin/Acronis/home')}}" class="menu-link">
                  <img src="{{ request()->is('admin/Acronis*') ? url('public/images/Acronis1white.png') : url('public/images/Acroniss1blue.png') }}" alt="Acronis Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Acronis</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/TsPlus/*') ? 'active':''}}">
               <a href="{{url('admin/TsPlus/home')}}" class="menu-link">
                  <img src="{{ request()->is('admin/TsPlus*') ? url('public/images/tswhite1.png') : url('public/images/tsblue1.png') }}" alt="TS plus Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">TsPlus</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Other/*') ? 'active':''}}">
               <a href="{{url('admin/Other/home')}}" class="menu-link">
                  <i class="fas fa-toolbox {{request()->is('admin/Other*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Other</div>
               </a>
            </li>
         </ul>
      </li>
      @if(Auth::user()->type != 4 && Auth::user()->id == 1)
      <!-- Services end -->
      <li class="menu-item {{request()->is('admin/monitoring/*') ? 'open':''}} 
         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="fas fa-desktop" style="padding-right:13px;color:#7367f0;"></i>
            <div data-i18n="Ticket">Monitoring Service</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item {{request()->is('admin/monitoring/server') ? 'active':''}}">
               <a href="{{url('admin/monitoring/server')}}" class="menu-link">
                  <div data-i18n="Ticket">Server Monitoring</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/monitoring/service') ? 'active':''}}">
               <a href="{{url('admin/monitoring/service')}}" class="menu-link">
                  <div data-i18n="Ticket">Service Monitoring</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/monitoring/memory') ? 'active':''}}">
               <a href="{{url('admin/monitoring/memory')}}" class="menu-link">
                  <div data-i18n="Ticket">Memory</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/monitoring/disk') ? 'active':''}}">
               <a href="{{url('admin/monitoring/disk')}}" class="menu-link">
                  <div data-i18n="Ticket">Disk</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/monitoring/network') ? 'active':''}}">
               <a href="{{url('admin/monitoring/network')}}" class="menu-link">
                  <div data-i18n="Ticket">Network</div>
               </a>
            </li>
         </ul>
      </li>
      <!-- Ticket start -->
      <li class="menu-item {{request()->is('admin/Ticket/*') ? 'open':''}} {{request()->is('admin/Vendor/*') ? 'open':''}} {{request()->is('admin/Ticket/*') ? 'active':''}}">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-ticket color1"></i>
            <div data-i18n="Ticket">Ticket Support</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item {{request()->is('admin/Ticket/overview') ? 'active':''}}">
               <a href="{{url('admin/Ticket/overview')}}" class="menu-link">
                  <div data-i18n="Ticket">Ticket Overview</div>
               </a>
            </li>
         </ul>
         <ul class="menu-sub">
            <li class="menu-item {{request()->is('admin/Ticket/home') ? 'active':''}}">
               <a href="{{url('admin/Ticket/home')}}" class="menu-link">
                  <div data-i18n="Ticket">Ticket List</div>
               </a>
            </li>
         </ul>
      </li>
      @endif
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
            <i class="menu-icon tf-icons fa-solid fa-business-time color1"></i>
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
            <i class="menu-icon fa-solid fa-boxes-stacked {{request()->is('admin/Inventory*') ? 'color2':'color1'}}"></i>
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
         {{request()->is('admin/TimeShift/*') ? 'open':''}}    
         {{request()->is('admin/Attendence/*') ? 'open':''}}    
         {{request()->is('admin/Holiday/*') ? 'open':''}}    
         {{request()->is('admin/Leave/*') ? 'open':''}}    
         {{request()->is('admin/LeavePolicies/*') ? 'open':''}}    
         {{request()->is('admin/Employee/*') ? 'open':''}}    
         {{request()->is('admin/Holiday/*') ? 'open':''}}
         {{request()->is('admin/File/*') ? 'open':''}}    
         {{request()->is('admin/File/*') ? 'open':''}}
         {{request()->is('admin/Performance/*') ? 'open':''}}    
         {{request()->is('admin/Performance/*') ? 'open':''}}
         {{request()->is('admin/Calendar/*') ? 'open':''}}    
         {{request()->is('admin/PayRoll/*') ? 'open':''}}
         {{request()->is('admin/PayRoll/*') ? 'open':''}}    
         {{request()->is('admin/Calendar/*') ? 'open':''}}
         {{request()->is('admin/Employee/*') ? 'open':''}}
         {{request()->is('admin/LeavePolicies/*') ? 'open':''}}
         {{request()->is('admin/Leave/*') ? 'open':''}}
         {{request()->is('admin/Attendence/*') ? 'open':''}}
         {{request()->is('admin/TimeShift/*') ? 'open':''}}
         {{request()->is('admin/Department/*') ? 'open':''}}
         {{request()->is('admin/FileManagement/*') ? 'open':''}}
         {{request()->is('admin/JobRole/*') ? 'open':''}}">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons fa-brands fa-osi color1"></i>
            <div data-i18n="globe">Human Resources</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item {{request()->is('admin/Department/*') ? 'active':''}}">
               <a href="{{url('admin/Department/home')}}" class="menu-link netwrk">
                  <i class="fa-regular fa-building ntwk {{request()->is('admin/Department*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Department </div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/JobRole/*') ? 'active':''}}">
               <a href="{{url('admin/JobRole/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-briefcase ntwk {{request()->is('admin/JobRole*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Job Role</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/TimeShift/*') ? 'active':''}}">
               <a href="{{url('admin/TimeShift/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-business-time ntwk {{request()->is('admin/TimeShift*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Time Shift</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Employee/*') ? 'active':''}}">
               <a href="{{url('admin/Employee/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-users ntwk {{request()->is('admin/Employee*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Employee</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Attendence/*') ? 'active':''}}">
               <a href="{{url('admin/Attendence/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-clipboard-user ntwk {{request()->is('admin/Attendence*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Attendance</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Leave/*') ? 'active':''}}">
               <a href="{{url('admin/Leave/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-outdent ntwk {{request()->is('admin/Leave*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Leaves</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Holiday/*') ? 'active':''}}">
               <a href="{{url('admin/Holiday/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-h ntwk {{request()->is('admin/Holiday*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Holiday</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Performance/*') ? 'active':''}}">
               <a href="{{url('admin/Performance/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-chart-simple ntwk {{request()->is('admin/Performance*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Performance</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/PayRoll/*') ? 'active':''}}">
               <a href="{{url('admin/PayRoll/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-money-check ntwk {{request()->is('admin/PayRoll*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">PayRoll</div>
               </a>
            </li>
            <!-- <li class="menu-item {{request()->is('admin/Recruitment/*') ? 'active':''}}">-->
            <!--  <a href="{{url('admin/Recruitment/service')}}" class="menu-link netwrk">-->
            <!--    <i class="fa-solid fa-clipboard-user ntwk {{request()->is('admin/Recruitment/service/*') ? 'color2':'color1'}}"></i>-->
            <!--    <div data-i18n="List">Recruitment</div>-->
            <!--  </a>-->
            <!--</li>-->
            <li class="menu-item {{request()->is('admin/FileManagement/*') ? 'active':''}}">
               <a href="{{url('admin/FileManagement/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-money-check ntwk {{request()->is('admin/FileManagement/*')? 'color2':'color1'}}"></i></i>
                  <div data-i18n="List">File Management</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('admin/Calendar/*') ? 'active':''}}">
               <a href="{{url('admin/Calendar/home')}}" class="menu-link netwrk">
                  <i class="fa-regular fa-calendar ntwk {{request()->is('admin/Calendar*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Calendar</div>
               </a>
            </li>
            <!--<li class="menu-item {{request()->is('admin/LeavePolicies/*') ? 'active':''}}">-->
            <!--  <a href="{{url('admin/LeavePolicies/home')}}" class="menu-link netwrk">-->
            <!--    <i class="fa-solid fa-passport ntwk {{request()->is('admin/LeavePolicies*') ? 'color2':'color1'}}"></i>-->
            <!--    <div data-i18n="List">Policies</div>-->
            <!--  </a>-->
            <!--</li>-->
            <!-- <li class="menu-item {{request()->is('admin/File/*') ? 'active':''}}">
               <a href="{{url('admin/File/home')}}" class="menu-link netwrk">
                 <i class="fa-solid fa-file ntwk {{request()->is('admin/File*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">File</div>
               </a>
               </li> -->
         </ul>
      </li>
      <!-- Human Resources end -->
      <!-- Company Login start -->
      <li class="menu-item  {{request()->is('admin/CompanyLogin*') ? 'active':''}}">
         <a href="{{url('admin/CompanyLogin/home')}}" class="menu-link ">
            <i class="menu-icon fa-regular fa-building {{request()->is('admin/CompanyLogin*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Dashboards">Company Login</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <!-- Company Login end -->
      <li class="menu-item  {{request()->is('admin/LogActivity/*') ? 'active':''}}">
         <a href="{{url('admin/LogActivity/home')}}" class="menu-link ">
            <i class="menu-icon  fas fa-tasks {{request()->is('admin/LogActivity*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Dashboards">Logs Management</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <!-- Company Login start -->
      <li class="menu-item  {{request()->is('admin/Settings*') ? 'active':''}}">
         <a href="{{url('admin/Settings/home')}}" class="menu-link ">
            <i class="menu-icon tf-icons fa-solid fa-gear {{request()->is('admin/Settings*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Dashboards">Settings</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <!-- email templateSettings -->
      <!-- <li class="menu-item  {{request()->is('admin/ETempleteSettings*') ? 'active':''}}">
         <a href="{{url('admin/ETempleteSettings/home')}}" class="menu-link ">
           <i class="menu-icon tf-icons fa-solid fa-user-gear {{request()->is('admin/ETempleteSettings*') ? 'color2':'color1'}}"></i>
           <div data-i18n="Dashboards">Template Settings</div>
           <div class="badge bg-primary rounded-pill ms-auto">3</div>
         </a>
         </li> -->
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
      <!--  @if($customLinks->isNotEmpty())
         <ul class="menu-inner py-1">
                 @foreach($customLinks as $customLink)
                      <li class="menu-item  {{request()->is('$customLink->url') ? 'active':''}}">
                         <a target="__blank" href="{{ url($customLink->url) }}" class="menu-link">
                       <i class="menu-icon fa-solid fa-link color1"></i>
                       <div data-i18n="{{ $customLink->link_title }}" class="small">{{ $customLink->link_title }}</div>
                     <div class="badge bg-primary rounded-pill ms-auto">3</div> 
                     </a>
                   </li>
                 @endforeach
             </ul>
         @endif -->
      @elseif(Auth::user()->type == '2')
      <!-- Dashboards start -->
      <li class="menu-item {{request()->is('user/dashboard') ? 'active':''}}">
         <a href="{{url('user/dashboard')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-smart-home  {{request()->is('user/dashboard*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Dashboards">Dashboards</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
         </a>
      </li>
      @if(Auth::user()->type == '2')
      <li class="menu-item
         {{request()->is('user/balancesheet/*') ? 'open':''}}
         {{request()->is('user/balancesheet/*') ? 'open':''}}
         {{request()->is('user/order/*') ? 'open':''}}
         {{request()->is('user/order/*') ? 'open':''}}
         {{request()->is('user/transaction/*') ? 'open':''}}
         {{request()->is('user/transaction/*') ? 'open':''}}
         {{request()->is('user/userInvoice') ? 'open':''}}
         {{request()->is('user/userInvoiceView/*') ? 'open':''}}
         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fas fa-calculator color1"></i>
            <div data-i18n="Dashboards">Accounting</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
         </a>
         <ul class="menu-sub CircleR">
            <li class="menu-item {{request()->is('user/userInvoice*') ? 'active':''}}">
               <a href="{{url('user/userInvoice')}}" class="menu-link">
                  <i class="fas fa-file-invoice {{request()->is('user/userInvoice*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="Private">Invoice</div>
               </a>
            </li>
            <!--  <li class="menu-item {{request()->is('user/balancesheet*') ? 'active':''}}">
               <a href="{{url('user/balancesheet/home')}}" class="menu-link">
                 <div data-i18n="Private">Balancesheet</div>
               </a>
               </li>
               -->
            <li class="menu-item {{request()->is('user/order*') ? 'active':''}}">
               <a href="{{url('user/order/home')}}" class="menu-link">
                  <i class="fa-solid fa-box {{request()->is('user/order/home*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="Advanced">Order</div>
               </a>
            </li>
            <!-- <li class="menu-item {{request()->is('user/services*') ? 'active':''}}">
               <a href="{{url('user/services/home')}}" class="menu-link">
                 <div data-i18n="Advanced">Services</div>
               </a>
               </li> -->
            <li class="menu-item {{request()->is('user/transaction*') ? 'active':''}}">
               <a href="{{url('user/transaction/home')}}" class="menu-link">
                  <i class="fa-solid fa-sack-dollar {{request()->is('user/transaction/home*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="Advanced">Transactions</div>
               </a>
            </li>
         </ul>
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
            <i class="menu-icon fa-solid fa-quote-left {{request()->is('user/Quotes*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Quotes">Quotes</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
         </a>
      </li>
      <li class="menu-item {{request()->is('user/userTicket') ? 'active':''}}">
         <a href="{{url('user/userTicket')}}" class="menu-link">
            <i class="menu-icon fas fa-ticket-alt {{request()->is('user/userTicket*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Quotes">Ticket</div>
         </a>
      </li>
      <li class="menu-item {{request()->is('user/userLogActivity') ? 'active':''}}">
         <a href="{{url('user/userLogActivity')}}" class="menu-link">
            <i class="menu-icon fas fa-snowboarding {{request()->is('user/userLogActivity*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Quotes">Log Activity</div>
         </a>
      </li>
      <!--   <li class="menu-item {{request()->is('user/services') ? 'active':''}}">
         <a href="{{url('user/services/home')}}" class="menu-link">
          <i class="menu-icon fas fa-cog"></i>
           <div data-i18n="Quotes">Services</div>
         </a>
         </li> -->
      <!--  <li class="menu-item {{request()->is('user/order') ? 'active':''}}">
         <a href="{{url('user/order')}}" class="menu-link">
           <i class="menu-icon tf-icons ti ti-smart-home"></i>
           <div data-i18n="Dashboards">Order</div>
         </a>
         </li> -->
      <!-- Quotes end -->
      <!-- Work start -->
      <li class="menu-item 
         {{request()->is('user/Project/*') ? 'open':''}}
         {{request()->is('user/Project/*') ? 'active':''}}
         {{request()->is('user/Task/*') ? 'open':''}}
         {{request()->is('user/Task/*') ? 'active':''}}
         {{request()->is('user/TimeSheet/*') ? 'open':''}}
         {{request()->is('user/TimeSheet/*') ? 'active':''}}
         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons fa-solid fa-business-time color1"></i>
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
      <!--  @if(in_array('Project', array_column($ClientAccess, 'per_name')) || in_array('Task', array_column($ClientAccess, 'per_name')) || in_array('TimeSheet', array_column($ClientAccess, 'per_name')))
         @endif -->
      <!-- Work End -->
      <!-- Services start -->
      <li class="menu-item 
         {{request()->is('user/getServicesIdWise/4') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/4') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/5') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/5') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/6') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/6') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/7') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/7') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/8') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/8') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/9') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/9') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/10') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/10') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/11') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/11') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/12') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/12') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/13') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/13') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/14') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/14') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/15') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/15') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/16') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/16') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/17') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/17') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/18') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/18') ? 'active':''}}
         {{request()->is('user/getServicesIdWise/19') ? 'open':''}}
         {{request()->is('user/getServicesIdWise/19') ? 'active':''}}
         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-cloud color1"></i>
            <div data-i18n="Users">Services</div>
         </a>
         <ul class="menu-sub CircleR">
            @if($BareMetal > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/4') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/4')}}" class="menu-link">
                  <i class="fa-solid fa-bars"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Bare Metal (VT)</div>
               </a>
            </li>
            @endif
            @if($CloudHosting > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/5') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/5')}}" class="menu-link">
                  <i class="fas fa-cloud-upload-alt"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Hosting</div>
               </a>
            </li>
            @endif
            @if($CloudServices > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/6') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/6')}}" class="menu-link">
                  <i class="fas fa-cloud"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Services</div>
               </a>
            </li>
            @endif
            @if($DedicatedServer > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/7') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/7')}}" class="menu-link">
                  <i class="fas fa-server"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Dedicated Server</div>
               </a>
            </li>
            @endif
            @if($AwsService > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/8') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/8')}}" class="menu-link">
                  <i class="fa-brands fa-aws"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Aws Service</div>
               </a>
            </li>
            @endif
            @if($MicrosoftAzure > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/9') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/9')}}" class="menu-link">
                  <i class="fab fa-microsoft"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft Azure</div>
               </a>
            </li>
            @endif
            @if($GoogleWorkSpace > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/10') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/10')}}" class="menu-link">
                  <i class="fab fa-google"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Google Work Space</div>
               </a>
            </li>
            @endif
            @if($MicrosoftOffice365 > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/11') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/11')}}" class="menu-link">
                  <!--<i class="fab fa-windows"></i>-->
                  <img src="{{ request()->is('user/getServicesIdWise/11*') ? url('public/images/m1white.png') : url('public/images/m2blue.png') }}" alt="Microsoft 365 Icon" style="width: 20px; height: 20px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft 365</div>
               </a>
            </li>
            @endif
            @if($OneTimeSetup > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/12') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/12')}}" class="menu-link">
                  <i class="fas fa-cog"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">One Time Setup</div>
               </a>
            </li>
            @endif
            @if($MonthelySetup > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/13') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/13')}}" class="menu-link">
                  <i class="fas fa-cogs"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Monthely Management</div>
               </a>
            </li>
            @endif
            @if($SSLCertificate > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/14') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/14')}}" class="menu-link">
                  <i class="fas fa-stamp"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">SSL Certificate</div>
               </a>
            </li>
            @endif
            @if($Antivirus > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/15') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/15')}}" class="menu-link">
                  <i class="fas fa-shield-virus"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Antivirus</div>
               </a>
            </li>
            @endif
            @if($Licenses > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/16') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/16')}}" class="menu-link">
                  <i class="fas fa-id-badge"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Licenses</div>
               </a>
            </li>
            @endif
            @if($Acronis > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/17') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/17')}}" class="menu-link">
                  <img src="{{ request()->is('user/getServicesIdWise/17*') ? url('public/images/Acronis1white.png') : url('public/images/Acroniss1blue.png') }}" alt="Acronis Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Acronis</div>
               </a>
            </li>
            @endif
            @if($TsPlus > 0)
            <li class="menu-item {{request()->is('user/getServicesIdWise/18') ? 'active':''}}">
               <a href="{{url('user/getServicesIdWise/18')}}" class="menu-link">
                  <img src="{{ request()->is('user/getServicesIdWise/18*') ? url('public/images/tswhite1.png') : url('public/images/tsblue1.png') }}" alt="TS plus Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">TsPlus</div>
               </a>
            </li>
            @endif
            <!--  @if(in_array('Other', array_column($ClientAccess, 'per_name')))  
               <li class="menu-item {{request()->is('user/Other/*') ? 'active':''}}">
                 <a href="{{url('user/Other/home')}}" class="menu-link">
                   <i class="fas fa-toolbox"></i>
                 &nbsp;&nbsp;
                   <div data-i18n="List">Other</div>
                 </a>
               </li>
               @endif -->
         </ul>
      </li>
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
                       <div class="badge bg-primary rounded-pill ms-auto">3</div> 
                    </a>
                  </li>
                @endforeach
            </ul>
         @endif
         
         </ul> -->
      @elseif(Auth::user()->type == '4')
      <!-- Dashboards start -->
      @if(in_array('Private_Dashboard', array_column($RoleAccess, 'per_name')) || in_array('Advanced_Dashboard', array_column($RoleAccess, 'per_name')))
      <!-- <li class="menu-item {{request()->is('Employee/dashboard') ? 'open':''}}">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
           <i class="menu-icon tf-icons ti ti-smart-home"></i>
           <div data-i18n="Dashboards">Dashboards</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item {{request()->is('Employee/dashboard') ? 'active':''}}">
             <a href="{{url('Employee/dashboard')}}" class="menu-link">
               <div data-i18n="Private">Dashboard</div>
             </a>
           </li>
         </ul>
         </li> -->
      <li class="menu-item {{request()->is('Employee/dashboard') ? 'active':''}}">
         <a href="{{url('Employee/dashboard')}}" class="menu-link ">
            <i class="menu-icon tf-icons ti ti-smart-home ntwk"></i>
            <div data-i18n="Dashboards">Dashboard</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      @endif
      <!-- Dashboards end -->
      <!-- User start -->
      @if(in_array('Client', array_column($RoleAccess, 'per_name')) || in_array('Vendor', array_column($RoleAccess, 'per_name')))
      <li class="menu-item {{request()->is('Employee/Client/*') ? 'open':''}} {{request()->is('Employee/Vendor/*') ? 'open':''}} {{request()->is('Employee/Client/*') ? 'active':''}}">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-user color1"></i>
            <div data-i18n="Users">Users</div>
         </a>
         <ul class="menu-sub CircleR">
            @if(in_array('Client', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Client/*') ? 'active':''}}">
               <a href="{{url('Employee/Client/home')}}" class="menu-link">
                  <i class="fa-solid fa-handshake {{request()->is('Employee/Client*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Client</div>
               </a>
            </li>
            @endif
            @if(in_array('Vendor', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Vendor/*') ? 'active':''}}">
               <a href="{{url('Employee/Vendor/home')}}" class="menu-link">
                  <i class="fa-solid fa-circle-user {{request()->is('Employee/Vendor*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
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
         {{request()->is('Employee/Category/*') ? 'open':''}}
         {{request()->is('Employee/HostingPanel/*') ? 'open':''}}  
         {{request()->is('Employee/SpecialOffers/*') ? 'open':''}}
         {{request()->is('Employee/Goal/*') ? 'open':''}}
         {{request()->is('Employee/MassMail/*') ? 'open':''}}
         {{request()->is('Employee/recent_follow_ups/*') ? 'open':''}}
         {{request()->is('Employee/Leads/*') ? 'active':''}} 
         {{request()->is('Employee/HostingPanel/*') ? 'active':''}} 
         {{request()->is('Employee/Quotes/*') ? 'active':''}} 
         {{request()->is('Employee/recent_follow_ups/*') ? 'active':''}} 
         {{request()->is('Employee/Category/*') ? 'active':''}} 
         {{request()->is('Employee/SpecialOffers/*') ? 'active':''}}
         {{request()->is('Employee/Goal/*') ? 'active':''}}
         {{request()->is('Employee/MassMail/*') ? 'active':''}}">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-globe color1"></i>
            <div data-i18n="globe">Sales</div>
         </a>
         <ul class="menu-sub CircleR">
            @if(in_array('Leads', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Leads/*') ? 'active':''}}">
               <a href="{{url('Employee/Leads/home')}}" class="menu-link">
                  <i class="fa-solid fa-circle-up {{request()->is('Employee/Leads*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Leads</div>
               </a>
            </li>
            @endif
            @if(in_array('Quotes', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Quotes/*') ? 'active':''}}">
               <a href="{{url('Employee/Quotes/home')}}" class="menu-link">
                  <i class="fa-solid fa-quote-left {{request()->is('Employee/Quotes*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Quotes</div>
               </a>
            </li>
            @endif
            @if(in_array('Goal', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Goal/*') ? 'active':''}}">
               <a href="{{url('Employee/Goal/home')}}" class="menu-link">
                  <i class="fa-solid fa-bullseye {{request()->is('Employee/Goal*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Goals</div>
               </a>
            </li>
            @endif
            @if(in_array('MassMail', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/MassMail/*') ? 'active':''}}">
               <a href="{{url('Employee/MassMail/home')}}" class="menu-link">
                  <i class="fa-solid fa-envelope {{request()->is('Employee/MassMail*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Mass Mail</div>
               </a>
            </li>
            @endif
            @if(in_array('SpecialOffers', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/SpecialOffers/*') ? 'active':''}}">
               <a href="{{url('Employee/SpecialOffers/home')}}" class="menu-link">
                  <i class="fa-solid fa-envelope-open-text {{request()->is('Employee/SpecialOffers*') ? 'color2':'color1'}}"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Special Offers</div>
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
            <i class="menu-icon fa-brands fa-hive color1"></i>
            <div data-i18n="Users" class="small">Network Management</div>
         </a>
         <ul class="menu-sub">
            @if(in_array('NetworkSubnet', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/NetworkSubnet/*') ? 'active':''}}">
               <a href="{{url('Employee/NetworkSubnet/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-network-wired ntwk {{request()->is('Employee/NetworkSubnet*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Network Subnet</div>
               </a>
            </li>
            @endif
            @if(in_array('IPAddress', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/IPAddress/*') ? 'active':''}}">
               <a href="{{url('Employee/IPAddress/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-i ntwk {{request()->is('Employee/IPAddress*') ? 'color2':'color1'}}" style="margin-right: 3px;"></i><i class="fa-solid fa-p ntwk {{request()->is('Employee/IPAddress*') ? 'color2':'color1'}}" style="margin-right:6px;"></i>
                  <div data-i18n="List">IP Address</div>
               </a>
            </li>
            @endif
            @if(in_array('Rack', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Rack/*') ? 'active':''}}">
               <a href="{{url('Employee/Rack/home')}}" class="menu-link netwrk">
                  <i class="fas fa-server ntwk {{request()->is('Employee/Rack*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Rack</div>
               </a>
            </li>
            @endif
            @if(in_array('Switchs', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Switchs/*') ? 'active':''}}">
               <a href="{{url('Employee/Switchs/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-toggle-on ntwk {{request()->is('Employee/Switchs*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Switch</div>
               </a>
            </li>
            @endif
            @if(in_array('Firewall', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Firewall/*') ? 'active':''}}">
               <a href="{{url('Employee/Firewall/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-shield-halved ntwk {{request()->is('Employee/Firewall*') ? 'color2':'color1'}}"></i>
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
            <i class="menu-icon fa-solid fa-cloud color1"></i>
            <div data-i18n="Users">Services</div>
         </a>
         <ul class="menu-sub CircleR">
            @if(in_array('BareMetal', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/BareMetal/*') ? 'active':''}}">
               <a href="{{url('Employee/BareMetal/home')}}" class="menu-link">
                  <i class="fa-solid fa-bars {{request()->is('Employee/BareMetal*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="Users">Bare Metal (VT)</div>
               </a>
            </li>
            @endif
            @if(in_array('CloudHosting', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/CloudHosting/*') ? 'active':''}}">
               <a href="{{url('Employee/CloudHosting/home')}}" class="menu-link">
                  <i class="fas fa-cloud-upload-alt {{request()->is('Employee/CloudHosting*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Hosting</div>
               </a>
            </li>
            @endif
            @if(in_array('CloudServices', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/CloudServices/*') ? 'active':''}}">
               <a href="{{url('Employee/CloudServices/home')}} " class="menu-link">
                  <i class="fas fa-cloud {{request()->is('Employee/CloudServices*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Services</div>
               </a>
            </li>
            @endif
            @if(in_array('DedicatedServer', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/DedicatedServer/*') ? 'active':''}}">
               <a href="{{url('Employee/DedicatedServer/home')}}" class="menu-link">
                  <i class="fas fa-server {{request()->is('Employee/DedicatedServer*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Dedicated Server</div>
               </a>
            </li>
            @endif
            @if(in_array('AwsService', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/AwsService/*') ? 'active':''}}">
               <a href="{{url('Employee/AwsService/home')}}" class="menu-link">
                  <i class="fa-brands fa-aws {{request()->is('Employee/AwsService*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Aws Service</div>
               </a>
            </li>
            @endif
            @if(in_array('Azure', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Azure/*') ? 'active':''}}">
               <a href="{{url('Employee/Azure/home')}}" class="menu-link">
                  <i class="fab fa-microsoft {{request()->is('Employee/Azure*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft Azure</div>
               </a>
            </li>
            @endif
            @if(in_array('GoogleWorkSpace', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/GoogleWorkSpace/*') ? 'active':''}}">
               <a href="{{url('Employee/GoogleWorkSpace/home')}}" class="menu-link">
                  <i class="fab fa-google {{request()->is('Employee/GoogleWorkSpace*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Google Work Space</div>
               </a>
            </li>
            @endif
            @if(in_array('MicrosoftOffice365', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/MicrosoftOffice365/*') ? 'active':''}}">
               <a href="{{url('Employee/MicrosoftOffice365/home')}}" class="menu-link">
                  <!-- <i class="fas fa-briefcase"></i> -->
                  <img src="{{ request()->is('Employee/MicrosoftOffice365*') ? url('public/images/m1white.png') : url('public/images/m2blue.png') }}" alt="Microsoft 365 Icon" style="width: 20px; height: 20px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft 365</div>
               </a>
            </li>
            @endif
            @if(in_array('OneTimeSetup', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/OneTimeSetup/*') ? 'active':''}}">
               <a href="{{url('Employee/OneTimeSetup/home')}}" class="menu-link">
                  <i class="fas fa-cog {{request()->is('Employee/OneTimeSetup*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">One Time Setup</div>
               </a>
            </li>
            @endif
            @if(in_array('MonthelySetup', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/MonthelySetup/*') ? 'active':''}}">
               <a href="{{url('Employee/MonthelySetup/home')}}" class="menu-link">
                  <i class="fas fa-cogs {{request()->is('Employee/MonthelySetup*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Monthly Management</div>
               </a>
            </li>
            @endif
            @if(in_array('SSLCertificate', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/SSLCertificate/*') ? 'active':''}}">
               <a href="{{url('Employee/SSLCertificate/home')}}" class="menu-link">
                  <i class="fas fa-stamp {{request()->is('Employee/SSLCertificate*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">SSL Certificate</div>
               </a>
            </li>
            @endif
            @if(in_array('Antivirus', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Antivirus/*') ? 'active':''}}">
               <a href="{{url('Employee/Antivirus/home')}}" class="menu-link">
                  <i class="fas fa-shield-virus {{request()->is('Employee/Antivirus*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Antivirus</div>
               </a>
            </li>
            @endif
            @if(in_array('Licenses', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Licenses/*') ? 'active':''}}">
               <a href="{{url('Employee/Licenses/home')}}" class="menu-link">
                  <i class="fas fa-id-badge {{request()->is('Employee/Licenses*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Licenses</div>
               </a>
            </li>
            @endif
            @if(in_array('Acronis', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Acronis/*') ? 'active':''}}">
               <a href="{{url('Employee/Acronis/home')}}" class="menu-link">
                  <img src="{{ request()->is('Employee/Acronis*') ? url('public/images/Acronis1white.png') : url('public/images/Acroniss1blue.png') }}" alt="Acronis Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Acronis</div>
               </a>
            </li>
            @endif
            @if(in_array('TsPlus', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/TsPlus/*') ? 'active':''}}">
               <a href="{{url('Employee/TsPlus/home')}}" class="menu-link">
                  <img src="{{ request()->is('Employee/TsPlus*') ? url('public/images/tswhite1.png') : url('public/images/tsblue1.png') }}" alt="TS plus Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">TsPlus</div>
               </a>
            </li>
            @endif
            @if(in_array('Other', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Other/*') ? 'active':''}}">
               <a href="{{url('Employee/Other/home')}}" class="menu-link">
                  <i class="fas fa-toolbox {{request()->is('Employee/Other*') ? 'color2':'color1'}}"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Other</div>
               </a>
            </li>
            @endif
         </ul>
      </li>
      @endif
      @if(Auth::user()->type == '4' && $depart_ment->department_id == 1)
      <!-- Services end -->
      <li class="menu-item {{request()->is('Employee/monitoring/*') ? 'open':''}} 
         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="fas fa-desktop" style="padding-right:13px;color:#7367f0;"></i>
            <div data-i18n="Ticket">Monitoring Service</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item {{request()->is('Employee/monitoring/server') ? 'active':''}}">
               <a href="{{url('Employee/monitoring/server')}}" class="menu-link">
                  <div data-i18n="Ticket">Server Monitoring</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('Employee/monitoring/service') ? 'active':''}}">
               <a href="{{url('Employee/monitoring/service')}}" class="menu-link">
                  <div data-i18n="Ticket">Service Monitoring</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('Employee/monitoring/memory') ? 'active':''}}">
               <a href="{{url('Employee/monitoring/memory')}}" class="menu-link">
                  <div data-i18n="Ticket">Memory</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('Employee/monitoring/disk') ? 'active':''}}">
               <a href="{{url('Employee/monitoring/disk')}}" class="menu-link">
                  <div data-i18n="Ticket">Disk</div>
               </a>
            </li>
            <li class="menu-item {{request()->is('Employee/monitoring/network') ? 'active':''}}">
               <a href="{{url('Employee/monitoring/network')}}" class="menu-link">
                  <div data-i18n="Ticket">Network</div>
               </a>
            </li>
         </ul>
      </li>
      @endif
      <!-- Ticket start -->
      <!--<li class="menu-item {{request()->is('admin/Ticket/*') ? 'open':''}} {{request()->is('admin/Vendor/*') ? 'open':''}} {{request()->is('admin/Ticket/*') ? 'active':''}}">-->
      <!--  <a href="javascript:void(0);" class="menu-link menu-toggle">-->
      <!--    <i class="menu-icon fa-solid fa-ticket color1"></i>-->
      <!--    <div data-i18n="Ticket">Ticket Support</div>-->
      <!--  </a>-->
      <!--  <ul class="menu-sub">-->
      <!--    <li class="menu-item {{request()->is('admin/Ticket/overview') ? 'active':''}}">-->
      <!--      <a href="{{url('admin/Ticket/overview')}}" class="menu-link">-->
      <!--        <div data-i18n="Ticket">Ticket Overview</div>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--  </ul>-->
      <!--  <ul class="menu-sub">-->
      <!--    <li class="menu-item {{request()->is('admin/Ticket/home') ? 'active':''}}">-->
      <!--      <a href="{{url('admin/Ticket/home')}}" class="menu-link">-->
      <!--        <div data-i18n="Ticket">Ticket List</div>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--  </ul>-->
      <!--</li>-->
      <!-- server monitoring -->
      <!-- Ticket start -->
      @if(in_array('Tickets', array_column($RoleAccess, 'per_name')))
      <li class="menu-item {{request()->is('Employee/Ticket/*') ? 'open':''}} {{request()->is('Employee/Vendor/*') ? 'open':''}} {{request()->is('Employee/Ticket/*') ? 'active':''}}">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-ticket {{request()->is('Employee/Ticket*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Ticket">Ticket Support</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item {{request()->is('Employee/Ticket/overview') ? 'active':''}}">
               <a href="{{url('Employee/Ticket/overview')}}" class="menu-link">
                  <div data-i18n="Ticket">Ticket Overview</div>
               </a>
            </li>
         </ul>
         <ul class="menu-sub">
            <li class="menu-item {{request()->is('Employee/Ticket/home') ? 'active':''}}">
               <a href="{{url('Employee/Ticket/home')}}" class="menu-link">
                  <div data-i18n="Ticket">Ticket List</div>
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
            <i class="menu-icon tf-icons fa-solid fa-business-time color1"></i>
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
         <a href="{{url('Employee/Inventory/home')}}" class="menu-link " style="margin-left: 15px;">
            <i class="menu-icon fa-solid fa-boxes-stacked {{request()->is('Employee/Inventory*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Dashboards" class="small">Inventory Management</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      @endif
      <!-- Inventory Management end -->
      <!-- Human Resources start -->
      @if(array_intersect(['Department', 'JobRole', 'TimeShift', 'Attendence', 'Holiday', 'Leave', 'LeavePolicies', 'Employee', 'File', 'Performance', 'Calendar', 'PayRoll'], array_column($RoleAccess, 'per_name')))
      <li class="menu-item {{ array_intersect(['Department', 'JobRole', 'TimeShift', 'Attendence', 'Holiday', 'Leave', 'LeavePolicies', 'Employee', 'File', 'Performance', 'Calendar', 'PayRoll'], array_column($RoleAccess, 'per_name')) ? 'open' : '' }}">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons fa-brands fa-osi color1"></i>
            <div data-i18n="globe">Human Resources</div>
         </a>
         <ul class="menu-sub">
            @if(in_array('Department', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Department/*') ? 'active':''}}">
               <a href="{{url('Employee/Department/home')}}" class="menu-link netwrk">
                  <i class="fa-regular fa-building ntwk {{request()->is('Employee/Department*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Department</div>
               </a>
            </li>
            @endif
            @if(in_array('JobRole', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/JobRole/*') ? 'active':''}}">
               <a href="{{url('Employee/JobRole/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-briefcase ntwk {{request()->is('Employee/JobRole*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Job Role</div>
               </a>
            </li>
            @endif
            @if(in_array('TimeShift', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/TimeShift/*') ? 'active':''}}">
               <a href="{{url('Employee/TimeShift/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-business-time ntwk {{request()->is('Employee/TimeShift*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Time Shift</div>
               </a>
            </li>
            @endif
            @if(in_array('Employee', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Employee/*') ? 'active':''}}">
               <a href="{{url('Employee/Employee/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-users ntwk {{request()->is('Employee/Employee*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Employee</div>
               </a>
            </li>
            @endif
            @if(in_array('Attendence', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Attendence/*') ? 'active':''}}">
               <a href="{{url('Employee/Attendence/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-clipboard-user ntwk {{request()->is('Employee/Attendence*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Attendance</div>
               </a>
            </li>
            @endif
            @if(in_array('Leave', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Leave/*') ? 'active':''}}">
               <a href="{{url('Employee/Leave/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-outdent ntwk {{request()->is('Employee/Leave*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Leaves</div>
               </a>
            </li>
            @endif
            @if(in_array('Holiday', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Holiday/*') ? 'active':''}}">
               <a href="{{url('Employee/Holiday/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-h ntwk {{request()->is('Employee/Holiday*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Holiday</div>
               </a>
            </li>
            @endif
            @if(in_array('Performance', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Performance/*') ? 'active':''}}">
               <a href="{{url('Employee/Performance/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-chart-simple ntwk {{request()->is('Employee/Performance*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Performance</div>
               </a>
            </li>
            @endif
            @if(in_array('PayRoll', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/PayRoll/*') ? 'active':''}}">
               <a href="{{url('Employee/PayRoll/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-money-check ntwk {{request()->is('Employee/PayRoll*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">PayRoll</div>
               </a>
            </li>
            @endif
            @if(in_array('File', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/File/*') ? 'active':''}}">
               <a href="{{url('Employee/File/home')}}" class="menu-link netwrk">
                  <i class="fa-solid fa-file ntwk {{request()->is('Employee/File*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">File Management</div>
               </a>
            </li>
            @endif
            @if(in_array('Calendar', array_column($RoleAccess, 'per_name')))
            <li class="menu-item {{request()->is('Employee/Calendar/*') ? 'active':''}}">
               <a href="{{url('Employee/Calendar/home')}}" class="menu-link netwrk">
                  <i class="fa-regular fa-calendar ntwk {{request()->is('Employee/Calendar*') ? 'color2':'color1'}}"></i>
                  <div data-i18n="List">Calendar</div>
               </a>
            </li>
            @endif
         </ul>
      </li>
      @endif
      <!-- Human Resources end -->
      <!-- Human Resources Old start -->
      <!--  @if(in_array('Department', array_column($RoleAccess, 'per_name')) || in_array('JobRole', array_column($RoleAccess, 'per_name')) || in_array('TimeShift', array_column($RoleAccess, 'per_name')) || in_array('Attendence', array_column($RoleAccess, 'per_name')) || in_array('Holiday', array_column($RoleAccess, 'per_name')) || in_array('Leave', array_column($RoleAccess, 'per_name')) || in_array('LeavePolicies', array_column($RoleAccess, 'per_name')) || in_array('Employee', array_column($RoleAccess, 'per_name')) || in_array('File', array_column($RoleAccess, 'per_name')) || in_array('Performance', array_column($RoleAccess, 'per_name')) || in_array('Calendar', array_column($RoleAccess, 'per_name')) || in_array('PayRoll', array_column($RoleAccess, 'per_name')))
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
             <i class="menu-icon tf-icons fa-brands fa-osi ntwk" style="font-size:17px;"></i>
             <div data-i18n="globe">Human Resources</div>
           </a>
           <ul class="menu-sub">
             @if(in_array('Department', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Department/*') ? 'active':''}}">
               <a href="{{url('Employee/Department/home')}}" class="menu-link netwrk">
                    <i class="fa-regular fa-building ntwk {{request()->is('Employee/Department*' ? 'color2':'color1')}}"></i>
                 <div data-i18n="List">Department </div>
               </a>
             </li>
             @endif
             @if(in_array('JobRole', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/JobRole/*') ? 'active':''}}">
               <a href="{{url('Employee/JobRole/home')}}" class="menu-link netwrk">
                    <i class="fa-solid fa-briefcase ntwk {{request()->is('Employee/JobRole*' ? 'color2':
                   'color1')}}"></i>
                 <div data-i18n="List">Job Role</div>
               </a>
             </li>
             @endif
             @if(in_array('TimeShift', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/TimeShift/*') ? 'active':''}}">
               <a href="{{url('Employee/TimeShift/home')}}" class="menu-link netwrk">
                   <i class="fa-solid fa-business-time ntwk {{request()->is('admin/TimeShift*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Time Shift</div>
               </a>
             </li>
             @endif
             @if(in_array('Attendence', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Attendence/*') ? 'active':''}}">
               <a href="{{url('Employee/Attendence/home')}}" class="menu-link netwrk">
                   <i class="fa-solid fa-clipboard-user ntwk {{request()->is('admin/Attendence*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Attendance</div>
               </a>
             </li>
             @endif
             @if(in_array('Holiday', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Holiday/*') ? 'active':''}}">
               <a href="{{url('Employee/Holiday/home')}}" class="menu-link netwrk">
                    <i class="fa-solid fa-h ntwk {{request()->is('Employee/Holiday*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Holiday</div>
               </a>
             </li>
             @endif
             @if(in_array('Leave', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Leave/*') ? 'active':''}}">
               <a href="{{url('Employee/Leave/home')}}" class="menu-link netwrk">
                   <i class="fa-solid fa-outdent ntwk {{request()->is('admin/Leave*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Leaves</div>
               </a>
             </li>
             @endif
             @if(in_array('LeavePolicies', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/LeavePolicies/*') ? 'active':''}}">
               <a href="{{url('Employee/LeavePolicies/home')}}" class="menu-link netwrk">
                   <i class="fa-regular fa-file-powerpoint ntwk {{request()->is('admin/Department*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Policies</div>
               </a>
             </li>
             @endif
             @if(in_array('Employee', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Employee/*') ? 'active':''}}">
               <a href="{{url('Employee/Employee/home')}}" class="menu-link netwrk">
                     <i class="fa-solid fa-users ntwk {{request()->is('Employee/Employee') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Employee</div>
               </a>
             </li>
             @endif
             @if(in_array('File', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/File/*') ? 'active':''}}">
               <a href="{{url('Employee/File/home')}}" class="menu-link netwrk">
                   <i class="fa-solid fa-file ntwk {{request()->is('admin/Department*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">File Management</div>
               </a>
             </li>
             @endif
             @if(in_array('Performance', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Performance/*') ? 'active':''}}">
               <a href="{{url('Employee/Performance/home')}}" class="menu-link netwrk">
                   <i class="fa-solid fa-chart-simple ntwk {{request()->is('admin/Performance*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Performance</div>
               </a>
             </li>
             @endif
             @if(in_array('Calendar', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Calendar/*') ? 'active':''}}">
               <a href="{{url('Employee/Calendar/home')}}" class="menu-link netwrk">
                   <i class="fa-regular fa-calendar ntwk {{request()->is('admin/Calendar*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Calendar</div>
               </a>
             </li>
             @endif
             @if(in_array('PayRoll', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/PayRoll/*') ? 'active':''}}">
               <a href="{{url('Employee/PayRoll/home')}}" class="menu-link netwrk">
                   <i class="fa-solid fa-clipboard-user ntwk {{request()->is('admin/monitoring/service/*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">PayRoll</div>
               </a>
             </li>
             @endif
           </ul>
         </li>
         @endif -->
      <!-- Human Resources old end -->
      <!-- Company Login start -->
      @if(in_array('CompanyLogin', array_column($RoleAccess, 'per_name')))
      <li class="menu-item  {{request()->is('Employee/CompanyLogin*') ? 'active':''}}">
         <a href="{{url('Employee/CompanyLogin/home')}}" class="menu-link ">
            <i class="menu-icon fa-regular fa-building {{request()->is('Employee/CompanyLogin*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Dashboards">Company Login</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      @endif
      @if(in_array('LogManagement', array_column($RoleAccess, 'per_name')))
      <li class="menu-item  {{request()->is('Employee/LogActivity/*') ? 'active':''}}">
         <a href="{{url('Employee/LogActivity/home')}}" class="menu-link ">
            <i class="menu-icon  fas fa-tasks {{request()->is('Employee/LogActivity*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Dashboards">Logs Management</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      @endif
      @if(in_array('Setting', array_column($RoleAccess, 'per_name')))
      <li class="menu-item  {{request()->is('Employee/Settings*') ? 'active':''}}">
         <a href="{{url('Employee/Settings/home')}}" class="menu-link ">
            <i class="menu-icon tf-icons fa-solid fa-gear {{request()->is('Employee/Settings*') ? 'color2':'color1'}}"></i>
            <div data-i18n="Dashboards">Settings</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      @endif
      <!-- Company Login end -->
      <!-- Settings start -->
      <!-- @if(in_array('Product', array_column($RoleAccess, 'per_name')) || in_array('Role', array_column($RoleAccess, 'per_name')) || in_array('PaymentMethod', array_column($RoleAccess, 'per_name')) || in_array('Security', array_column($RoleAccess, 'per_name')) || in_array('SecuritySettings', array_column($RoleAccess, 'per_name')) || in_array('MailSettings', array_column($RoleAccess, 'per_name')) || in_array('ProjectCategory', array_column($RoleAccess, 'per_name')) || in_array('TaskCategory', array_column($RoleAccess, 'per_name')) || in_array('LogActivity', array_column($RoleAccess, 'per_name')) || in_array('Template', array_column($RoleAccess, 'per_name')) || in_array('Notice', array_column($RoleAccess, 'per_name')))
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
             <i class="menu-icon tf-icons fa-solid fa-gear ntwk" style="font-size:17px;"></i>
             <div data-i18n="globe">Settings</div>
           </a>
           <ul class="menu-sub">
             @if(in_array('Role', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Role/*') ? 'active':''}}">
               <a href="{{url('Employee/Role/home')}}" class="menu-link netwrk">
                    <i class="fas fa-user-tag ntwk {{request()->is('Employee/Role*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Role</div>
               </a>
             </li>
             @endif
             @if(in_array('ProjectCategory', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/ProjectCategory/*') ? 'active':''}}">
               <a href="{{url('Employee/ProjectCategory/home')}}" class="menu-link netwrk">
                    <i class="fas fa-project-diagram ntwk {{request()->is('Employee/ProjectCategory*') ? 'color2':
                   'color1'}}"></i>
                 <div data-i18n="List">Project Category</div>
               </a>
             </li>
             @endif
             @if(in_array('TaskCategory', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/TaskCategory/*') ? 'active':''}}">
               <a href="{{url('Employee/TaskCategory/home')}}" class="menu-link netwrk">
                    <i class="fas fa-tasks ntwk {{request()->is('Employee/TaskCategory*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Task Category</div>
               </a>
             </li>
             @endif
             @if(in_array('ServiceAutomation', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Product/*') ? 'active':''}}">
               <a href="{{url('Employee/Product/home')}}" class="menu-link netwrk">
                   <i class="fas fa-cogs ntwk {{request()->is('Employee/Product*') ? 'color2':'
                   color1'}}"></i>
                 <div data-i18n="List">ServiceAutomation</div>
               </a>
             </li>
             @endif
             @if(in_array('PaymentMethod', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/PaymentMethod/*') ? 'active':''}}">
               <a href="{{url('Employee/PaymentMethod/home')}}" class="menu-link netwrk">
                   <i class="fas fa-hand-holding-usd  ntwk {{request()->is('Employee/PaymentMethod*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Payment Method</div>
               </a>
             </li>
             @endif
             @if(in_array('Template', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Template/*') ? 'active':''}}">
               <a href="{{url('Employee/Template/home')}}" class="menu-link netwrk">
                        <i class="fas fa-sms ntwk {{request()->is('Employee/Template*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">SmS/Email Template</div>
               </a>
             </li>
             @endif
             @if(in_array('Security', array_column($RoleAccess, 'per_name')))
             <li class="menu-item {{request()->is('Employee/Security/*') ? 'active':''}}">
               <a href="{{url('Employee/Security/home')}}" class="menu-link netwrk">
                 <i class="fas fa-unlock-alt ntwk {{request()->is('Employee/Security*') ? 'color2':'color1'}}"></i>
         
                 <div data-i18n="List">Security</div>
               </a>
             </li>
             @endif
             @if(in_array('SecuritySettings', array_column($RoleAccess, 'per_name')))
              <li class="menu-item {{request()->is('Employee/SecuritySettings/*') ? 'active':''}}">
               <a href="{{url('Employee/SecuritySettings/home')}}" class="menu-link ">
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
               <a href="{{url('Employee/MailSettings/home')}}" class="menu-link netwrk">
                 <i class="fas fa-envelope ntwk {{request()->is('Employee/MailSettings/*') ? 'color2':'color1'}}"></i>
         
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
               <a href="{{url('Employee/Notice/home')}}" class="menu-link netwrk">
                   <i class="far fa-sticky-note ntwk {{request()->is('Employee/Notice*') ? 'color2':'color1'}}"></i>
                 <div data-i18n="List">Notice</div>
               </a>
             </li>
             @endif
           </ul>
         </li>
         @endif -->
      <!-- Settings end -->
      @endif
   </ul>
</aside>
<!-- / Menu -->
























