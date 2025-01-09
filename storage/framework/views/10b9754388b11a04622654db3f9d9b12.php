<?php
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
?>
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
      <img width="100%" src="<?php echo e(url('public/logo/company.png')); ?>">
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
      </a>
   </div>
   <div class="menu-inner-shadow"></div>
   <ul class="menu-inner py-1">
      <?php if(Auth::user()->type == '1'): ?>
      <!-- Dashboards start -->
      <li class="menu-item <?php echo e(request()->is('admin/dashboard') ? 'active':''); ?> <?php echo e(request()->is('admin/dashboard') ? 'open':''); ?>  <?php echo e(request()->is('admin/Advanced') ? 'open':''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home ntwk"></i>
            <div data-i18n="Dashboards">Dashboards</div>
            <div class="badge bg-primary rounded-pill ms-auto">2</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('admin/dashboard') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/dashboard')); ?>" class="menu-link">
                  <div data-i18n="Private">Private Dashboard</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Advanced') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Advanced')); ?>" class="menu-link">
                  <div data-i18n="Advanced">Advanced Dashboard</div>
               </a>
            </li>
         </ul>
      </li>
      <!-- Dashboards end -->
      <!-- User start -->
      <li class="menu-item <?php echo e(request()->is('admin/Client/*') ? 'open':''); ?> <?php echo e(request()->is('admin/Vendor/*') ? 'open':''); ?> <?php echo e(request()->is('admin/Client/*') ? 'active':''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-user color1"></i>
            <div data-i18n="Users">Users</div>
         </a>
         <ul class="menu-sub CircleR">
            <li class="menu-item <?php echo e(request()->is('admin/Client/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Client/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-handshake <?php echo e(request()->is('admin/Client*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Client</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Vendor/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Vendor/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-circle-user <?php echo e(request()->is('admin/Vendor*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Vendor</div>
               </a>
            </li>
         </ul>
      </li>
      <!-- User end -->
      <!-- <li class="menu-item <?php echo e(request()->is('admin/Invoices/*') ? 'open':''); ?>  <?php echo e(request()->is('admin/Orders/*') ? 'open':''); ?>  <?php echo e(request()->is('admin/Orders/*') ? 'open':''); ?>  <?php echo e(request()->is('admin/transaction/*') ? 'open':''); ?> <?php echo e(request()->is('admin/Role/*') ? 'open':''); ?> <?php echo e(request()->is('admin/Role/*') ? 'active':''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fas fa-calculator color1"></i>
            <div data-i18n="globe">Accounting</div>
         </a>
         <ul class="menu-sub CircleR">
            <li class="menu-item <?php echo e(request()->is('admin/Invoices/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Invoices/home')); ?>" class="menu-link">
                  <i class="fas fa-file-invoice <?php echo e(request()->is('admin/Invoices*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Invoices</div>
               </a>
            </li>
               <li class="menu-item <?php echo e(request()->is('admin/CurrencySettings/*') ? 'active':''); ?>">
                 <a href="<?php echo e(url('admin/CurrencySettings/home')); ?>" class="menu-link">
                   <div data-i18n="List">Balance sheet</div>
                 </a>
               </li> 
            <li class="menu-item <?php echo e(request()->is('admin/Orders/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Orders/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-box <?php echo e(request()->is('admin/Orders*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Order</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/transaction/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/transaction/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-sack-dollar <?php echo e(request()->is('admin/transaction*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Transaction</div>
               </a>
            </li>
         </ul>
      </li>
      -->
      <!-- Sales start -->
      <li class="menu-item <?php echo e(request()->is('admin/Leads/*') ? 'open':''); ?>   
         <?php echo e(request()->is('admin/Quotes/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Category/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/HostingPanel/*') ? 'open':''); ?>  
         <?php echo e(request()->is('admin/SpecialOffers/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Goal/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/MassMail/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/recent_follow_ups/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Leads/*') ? 'active':''); ?> 
         <?php echo e(request()->is('admin/HostingPanel/*') ? 'active':''); ?> 
         <?php echo e(request()->is('admin/Quotes/*') ? 'active':''); ?> 
         <?php echo e(request()->is('admin/recent_follow_ups/*') ? 'active':''); ?> 
         <?php echo e(request()->is('admin/Category/*') ? 'active':''); ?> 
         <?php echo e(request()->is('admin/SpecialOffers/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Goal/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/MassMail/*') ? 'active':''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-globe color1"></i>
            <div data-i18n="globe">Sales</div>
         </a>
         <ul class="menu-sub CircleR">
            <li class="menu-item <?php echo e(request()->is('admin/Leads/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Leads/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-circle-up <?php echo e(request()->is('admin/Leads*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Leads</div>
               </a>
            </li>
            <!--<li class="menu-item <?php echo e(request()->is('admin/recent_follow_ups/*') ? 'active':''); ?>">-->
            <!--  <a href="<?php echo e(url('admin/recent_follow_ups')); ?>" class="menu-link">-->
            <!--    <div data-i18n="List">Follow UP</div>-->
            <!--  </a>-->
            <!--</li>-->
            <li class="menu-item <?php echo e(request()->is('admin/Quotes/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Quotes/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-quote-left <?php echo e(request()->is('admin/Quotes*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Quotes</div>
               </a>
            </li>
            <!-- <li class="menu-item <?php echo e(request()->is('admin/Category/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Category/home')); ?>" class="menu-link">
                 <div data-i18n="List">Category</div>
               </a>
               </li> -->
            <li class="menu-item <?php echo e(request()->is('admin/MassMail/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/MassMail/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-envelope <?php echo e(request()->is('admin/MassMail*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Mass Mail</div>
               </a>
            </li>
            <!-- <li class="menu-item <?php echo e(request()->is('admin/HostingPanel/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/HostingPanel/home')); ?>" class="menu-link">
                 <div data-i18n="List">Hosting Panel</div>
               </a>
               </li> -->
            <li class="menu-item <?php echo e(request()->is('admin/SpecialOffers/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/SpecialOffers/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-envelope-open-text <?php echo e(request()->is('admin/SpecialOffers*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Special Offers</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Goal/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Goal/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-bullseye <?php echo e(request()->is('admin/Goal*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Goals </div>
               </a>
            </li>
            <li class="menu-item">
               <a href="#" class="menu-link">
                  <i class="fa-solid fa-rectangle-ad <?php echo e(request()->is('admin/BareMetal*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Advertisement</div>
               </a>
            </li>
         </ul>
      </li>
      <!-- Sales end -->
      <!-- Network Management start -->
      <li class="menu-item 
         <?php echo e(request()->is('admin/NetworkSubnet/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/NetworkSubnet/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/IPAddress/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/IPAddress/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Rack/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Rack/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Switchs/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Switchs/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Firewall/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Firewall/*') ? 'active':''); ?>

         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-brands fa-hive color1"></i>
            <div data-i18n="Users" class="small">Network Management</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('admin/NetworkSubnet/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/NetworkSubnet/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-network-wired ntwk <?php echo e(request()->is('admin/NetworkSubnet*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Network Subnet</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/IPAddress/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/IPAddress/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-i ntwk <?php echo e(request()->is('admin/IPAddress*') ? 'color2':'color1'); ?>" style="margin-right: 3px;"></i><i class="fa-solid fa-p ntwk <?php echo e(request()->is('admin/IPAddress*') ? 'color2':'color1'); ?>" style="margin-right:6px;"></i>
                  <div data-i18n="List">IP Address</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Rack/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Rack/home')); ?>" class="menu-link netwrk">
                  <i class="fas fa-server ntwk <?php echo e(request()->is('admin/Rack*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Rack</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Switchs/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Switchs/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-toggle-on ntwk <?php echo e(request()->is('admin/Switchs*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Switch</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Firewall/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Firewall/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-shield-halved ntwk <?php echo e(request()->is('admin/Firewall*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Firewall</div>
               </a>
            </li>
         </ul>
      </li>
      <!-- Network Management end -->
      <!-- Services start -->
      <li class="menu-item 
         <?php echo e(request()->is('admin/BareMetal/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/BareMetal/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/CloudHosting/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/CloudHosting/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/CloudServices/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/CloudServices/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/DedicatedServer/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/DedicatedServer/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/AwsService/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/AwsService/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Azure/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Azure/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/GoogleWorkSpace/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/GoogleWorkSpace/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/MicrosoftOffice365/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/MicrosoftOffice365/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/OneTimeSetup/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/OneTimeSetup/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/MonthelySetup/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/MonthelySetup/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/SSLCertificate/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/SSLCertificate/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Antivirus/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Antivirus/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Licenses/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Licenses/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Acronis/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Acronis/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/TsPlus/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/TsPlus/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Other/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Other/*') ? 'active':''); ?>                                  
         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-cloud color1"></i>
            <div data-i18n="Users">Services</div>
         </a>
         <ul class="menu-sub CircleR">
            <li class="menu-item <?php echo e(request()->is('admin/BareMetal/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/BareMetal/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-bars <?php echo e(request()->is('admin/BareMetal*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="Users">Bare Metal (VT)</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/CloudHosting/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/CloudHosting/home')); ?>" class="menu-link">
                  <i class="fas fa-cloud-upload-alt <?php echo e(request()->is('admin/CloudHosting*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Hosting</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/CloudServices/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/CloudServices/home')); ?> " class="menu-link">
                  <i class="fas fa-cloud <?php echo e(request()->is('admin/CloudServices*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Services</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/DedicatedServer/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/DedicatedServer/home')); ?>" class="menu-link">
                  <i class="fas fa-server <?php echo e(request()->is('admin/DedicatedServer*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Dedicated Server</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/AwsService/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/AwsService/home')); ?>" class="menu-link">
                  <i class="fa-brands fa-aws <?php echo e(request()->is('admin/AwsService*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Aws Service</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Azure/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Azure/home')); ?>" class="menu-link">
                  <i class="fab fa-microsoft <?php echo e(request()->is('admin/Azure*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft Azure</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/GoogleWorkSpace/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/GoogleWorkSpace/home')); ?>" class="menu-link">
                  <i class="fab fa-google <?php echo e(request()->is('admin/GoogleWorkSpace*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Google Work Space</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/MicrosoftOffice365/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/MicrosoftOffice365/home')); ?>" class="menu-link">
                  <!-- <i class="fas fa-briefcase"></i> -->
                  <img src="<?php echo e(request()->is('admin/MicrosoftOffice365*') ? url('public/images/m1white.png') : url('public/images/m2blue.png')); ?>" alt="Microsoft 365 Icon" style="width: 20px; height: 20px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft 365</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/OneTimeSetup/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/OneTimeSetup/home')); ?>" class="menu-link">
                  <i class="fas fa-cog <?php echo e(request()->is('admin/OneTimeSetup*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">One Time Setup</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/MonthelySetup/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/MonthelySetup/home')); ?>" class="menu-link">
                  <i class="fas fa-cogs <?php echo e(request()->is('admin/MonthelySetup*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Monthly Management</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/SSLCertificate/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/SSLCertificate/home')); ?>" class="menu-link">
                  <i class="fas fa-stamp <?php echo e(request()->is('admin/SSLCertificate*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">SSL Certificate</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Antivirus/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Antivirus/home')); ?>" class="menu-link">
                  <i class="fas fa-shield-virus <?php echo e(request()->is('admin/Antivirus*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Antivirus</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Licenses/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Licenses/home')); ?>" class="menu-link">
                  <i class="fas fa-id-badge <?php echo e(request()->is('admin/Licenses*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Licenses</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Acronis/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Acronis/home')); ?>" class="menu-link">
                  <img src="<?php echo e(request()->is('admin/Acronis*') ? url('public/images/Acronis1white.png') : url('public/images/Acroniss1blue.png')); ?>" alt="Acronis Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Acronis</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/TsPlus/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/TsPlus/home')); ?>" class="menu-link">
                  <img src="<?php echo e(request()->is('admin/TsPlus*') ? url('public/images/tswhite1.png') : url('public/images/tsblue1.png')); ?>" alt="TS plus Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">TsPlus</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Other/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Other/home')); ?>" class="menu-link">
                  <i class="fas fa-toolbox <?php echo e(request()->is('admin/Other*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Other</div>
               </a>
            </li>
         </ul>
      </li>
      <?php if(Auth::user()->type != 4 && Auth::user()->id == 1): ?>
      <!-- Services end -->
      <li class="menu-item <?php echo e(request()->is('admin/monitoring/*') ? 'open':''); ?> 
         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="fas fa-desktop" style="padding-right:13px;color:#7367f0;"></i>
            <div data-i18n="Ticket">Monitoring Service</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('admin/monitoring/server') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/monitoring/server')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Server Monitoring</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/monitoring/service') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/monitoring/service')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Service Monitoring</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/monitoring/memory') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/monitoring/memory')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Memory</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/monitoring/disk') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/monitoring/disk')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Disk</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/monitoring/network') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/monitoring/network')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Network</div>
               </a>
            </li>
         </ul>
      </li>
      <!-- Ticket start -->
      <li class="menu-item <?php echo e(request()->is('admin/Ticket/*') ? 'open':''); ?> <?php echo e(request()->is('admin/Vendor/*') ? 'open':''); ?> <?php echo e(request()->is('admin/Ticket/*') ? 'active':''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-ticket color1"></i>
            <div data-i18n="Ticket">Ticket Support</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('admin/Ticket/overview') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Ticket/overview')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Ticket Overview</div>
               </a>
            </li>
         </ul>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('admin/Ticket/home') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Ticket/home')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Ticket List</div>
               </a>
            </li>
         </ul>
      </li>
      <?php endif; ?>
      <!-- Ticket end -->
      <!-- Work start -->
      <li class="menu-item 
         <?php echo e(request()->is('admin/Project/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Project/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Task/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Task/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/TimeSheet/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/TimeSheet/*') ? 'active':''); ?>

         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons fa-solid fa-business-time color1"></i>
            <div data-i18n="Dashboards">Work</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
         </a>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('admin/Project*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Project/home')); ?>" class="menu-link">
                  <div data-i18n="Private">Project</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Task*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Task/home')); ?>" class="menu-link">
                  <div data-i18n="Advanced">Task</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/TimeSheet*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/TimeSheet/home')); ?>" class="menu-link">
                  <div data-i18n="Advanced">Time Sheet</div>
               </a>
            </li>
         </ul>
      </li>
      <!-- Work End -->
      <!-- Inventory Management start -->
      <li class="menu-item  <?php echo e(request()->is('admin/Inventory*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/Inventory/home')); ?>" class="menu-link " style="margin-left: 15px;">
            <i class="menu-icon fa-solid fa-boxes-stacked <?php echo e(request()->is('admin/Inventory*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Dashboards" class="small">Inventory Management</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <!--    <li class="menu-item  <?php echo e(request()->is('admin/Inventory*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/Inventory/home')); ?>" class="menu-link " style="margin-left: 15px;">
           <i class="menu-icon fa-solid fa-i"></i>
           <div data-i18n="Dashboards" class="small">Inventory Management</div>
         </a>
         </li> -->
      <!-- <li class="menu-item  <?php echo e(request()->is('admin/Orders*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/Orders/home')); ?>" class="menu-link ">
           <img src="<?php echo e(url('public/logo/ecommerce.png')); ?>" height="30px" width="30px" style="margin-right: 5px;">
           <div data-i18n="Dashboards" class="small">Orders Management</div>
         <div class="badge bg-primary rounded-pill ms-auto">3</div> 
         </a>
         </li> -->
      <!-- Inventory Management end -->
      <!-- Human Resources start -->
      <li class="menu-item <?php echo e(request()->is('admin/Department/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/JobRole/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/TimeShift/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/TimeShift/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Attendence/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Holiday/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Leave/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/LeavePolicies/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Employee/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Holiday/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/File/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/File/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Performance/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Performance/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Calendar/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/PayRoll/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/PayRoll/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Calendar/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Employee/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/LeavePolicies/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Leave/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Attendence/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/TimeShift/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/Department/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/FileManagement/*') ? 'open':''); ?>

         <?php echo e(request()->is('admin/JobRole/*') ? 'open':''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons fa-brands fa-osi color1"></i>
            <div data-i18n="globe">Human Resources</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('admin/Department/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Department/home')); ?>" class="menu-link netwrk">
                  <i class="fa-regular fa-building ntwk <?php echo e(request()->is('admin/Department*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Department </div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/JobRole/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/JobRole/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-briefcase ntwk <?php echo e(request()->is('admin/JobRole*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Job Role</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/TimeShift/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/TimeShift/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-business-time ntwk <?php echo e(request()->is('admin/TimeShift*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Time Shift</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Employee/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Employee/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-users ntwk <?php echo e(request()->is('admin/Employee*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Employee</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Attendence/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Attendence/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-clipboard-user ntwk <?php echo e(request()->is('admin/Attendence*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Attendance</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Leave/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Leave/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-outdent ntwk <?php echo e(request()->is('admin/Leave*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Leaves</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Holiday/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Holiday/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-h ntwk <?php echo e(request()->is('admin/Holiday*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Holiday</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Performance/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Performance/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-chart-simple ntwk <?php echo e(request()->is('admin/Performance*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Performance</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/PayRoll/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/PayRoll/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-money-check ntwk <?php echo e(request()->is('admin/PayRoll*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">PayRoll</div>
               </a>
            </li>
            <!-- <li class="menu-item <?php echo e(request()->is('admin/Recruitment/*') ? 'active':''); ?>">-->
            <!--  <a href="<?php echo e(url('admin/Recruitment/service')); ?>" class="menu-link netwrk">-->
            <!--    <i class="fa-solid fa-clipboard-user ntwk <?php echo e(request()->is('admin/Recruitment/service/*') ? 'color2':'color1'); ?>"></i>-->
            <!--    <div data-i18n="List">Recruitment</div>-->
            <!--  </a>-->
            <!--</li>-->
            <li class="menu-item <?php echo e(request()->is('admin/FileManagement/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/FileManagement/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-money-check ntwk <?php echo e(request()->is('admin/FileManagement/*')? 'color2':'color1'); ?>"></i></i>
                  <div data-i18n="List">File Management</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('admin/Calendar/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/Calendar/home')); ?>" class="menu-link netwrk">
                  <i class="fa-regular fa-calendar ntwk <?php echo e(request()->is('admin/Calendar*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Calendar</div>
               </a>
            </li>
            <!--<li class="menu-item <?php echo e(request()->is('admin/LeavePolicies/*') ? 'active':''); ?>">-->
            <!--  <a href="<?php echo e(url('admin/LeavePolicies/home')); ?>" class="menu-link netwrk">-->
            <!--    <i class="fa-solid fa-passport ntwk <?php echo e(request()->is('admin/LeavePolicies*') ? 'color2':'color1'); ?>"></i>-->
            <!--    <div data-i18n="List">Policies</div>-->
            <!--  </a>-->
            <!--</li>-->
            <!-- <li class="menu-item <?php echo e(request()->is('admin/File/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('admin/File/home')); ?>" class="menu-link netwrk">
                 <i class="fa-solid fa-file ntwk <?php echo e(request()->is('admin/File*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">File</div>
               </a>
               </li> -->
         </ul>
      </li>
      <!-- Human Resources end -->
      <!-- Company Login start -->
      <li class="menu-item  <?php echo e(request()->is('admin/CompanyLogin*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/CompanyLogin/home')); ?>" class="menu-link ">
            <i class="menu-icon fa-regular fa-building <?php echo e(request()->is('admin/CompanyLogin*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Dashboards">Company Login</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <!-- Company Login end -->
      <li class="menu-item  <?php echo e(request()->is('admin/LogActivity/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/LogActivity/home')); ?>" class="menu-link ">
            <i class="menu-icon  fas fa-tasks <?php echo e(request()->is('admin/LogActivity*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Dashboards">Logs Management</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <!-- Company Login start -->
      <li class="menu-item  <?php echo e(request()->is('admin/Settings*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/Settings/home')); ?>" class="menu-link ">
            <i class="menu-icon tf-icons fa-solid fa-gear <?php echo e(request()->is('admin/Settings*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Dashboards">Settings</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <!-- email templateSettings -->
      <!-- <li class="menu-item  <?php echo e(request()->is('admin/ETempleteSettings*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/ETempleteSettings/home')); ?>" class="menu-link ">
           <i class="menu-icon tf-icons fa-solid fa-user-gear <?php echo e(request()->is('admin/ETempleteSettings*') ? 'color2':'color1'); ?>"></i>
           <div data-i18n="Dashboards">Template Settings</div>
           <div class="badge bg-primary rounded-pill ms-auto">3</div>
         </a>
         </li> -->
      <!-- Company Login end -->
      <!-- Settings start -->
      <!-- <li class="menu-item 
         <?php echo e(request()->is('admin/Product/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Product/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Role/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Role/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/PaymentMethod/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/PaymentMethod/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Security/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Security/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/SecuritySettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/SecuritySettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/FileManagement/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/FileManagement/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/InvoiceSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/InvoiceSettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/ProfileSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/ProfileSettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/ModuleSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/ModuleSettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/CurrencySettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/CurrencySettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/BuisnessAddress/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/BuisnessAddress/*') ? 'active':''); ?>

          <?php echo e(request()->is('admin/LeadSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/LeadSettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/TaxSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/TaxSettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/LeaveSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/LeaveSettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/CompanySettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/CompanySettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/CustomLinkSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/CustomLinkSettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/MailSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/MailSettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/ProjectCategory/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/ProjectCategory/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/TaskCategory/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/TaskCategory/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/LogActivity/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/LogActivity/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Template/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Template/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/Notice/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/Notice/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/AppSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/AppSettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/TicketEmailSetting/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/TicketEmailSetting/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/PerformanceSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/PerformanceSettings/*') ? 'active':''); ?>

         <?php echo e(request()->is('admin/PayRollSetting/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/PayRollSetting/*') ? 'active':''); ?>\
         <?php echo e(request()->is('admin/StorageSettings/*') ? 'open':''); ?>    
         <?php echo e(request()->is('admin/StorageSettings/*') ? 'active':''); ?>

         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
         <i class="menu-icon tf-icons fa-solid fa-gear"></i>
         <div data-i18n="globe">Settings</div>
         </a>
         <ul class="menu-sub">
         <li class="menu-item <?php echo e(request()->is('admin/AppSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/AppSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">App Settings</div>
         </a>
         </li>
         
         <li class="menu-item <?php echo e(request()->is('admin/CurrencySettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/CurrencySettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Currency Category</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/BuisnessAddress/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/BuisnessAddress/home')); ?>" class="menu-link">
         <div data-i18n="List">Business Address</div>
         </a>
         </li> 
         
         
         <li class="menu-item <?php echo e(request()->is('admin/CompanySettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/CompanySettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Company Setting</div>
         </a>
         </li> 
         <li class="menu-item <?php echo e(request()->is('admin/CustomLinkSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/CustomLinkSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Custom Link Settings</div>
         </a>
         </li>
         
         <li class="menu-item <?php echo e(request()->is('admin/FileManagement/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/FileManagement/home')); ?>" class="menu-link">
         <div data-i18n="List">File Management</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/GrammarlyAPISettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/GrammarlyAPISettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Grammarly API Settings</div>
         </a>
         </li> 
         <li class="menu-item <?php echo e(request()->is('admin/InvoiceSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/InvoiceSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Invoice Setting</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/LogActivity/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/LogActivity/home')); ?>" class="menu-link">
         <div data-i18n="List">Logs Management</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/LeadSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/LeadSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Lead Setting</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/LeaveSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/LeaveSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Leave Setting</div>
         </a>
         </li> 
         <li class="menu-item <?php echo e(request()->is('admin/MailSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/MailSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Mail Setting</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/ModuleSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/ModuleSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Module Setting</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/Notice/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/Notice/home')); ?>" class="menu-link">
         <div data-i18n="List">Notice</div>
         </a>
         </li>                  
         <li class="menu-item <?php echo e(request()->is('admin/PaymentMethod/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/PaymentMethod/home')); ?>" class="menu-link">
         <div data-i18n="List">Payment Method</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/ProjectCategory/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/ProjectCategory/home')); ?>" class="menu-link">
         <div data-i18n="List">Project Category</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/ProfileSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/ProfileSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Profile Setting</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/PerformanceSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/PerformanceSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Performance Settings</div>
         </a>
         </li> 
         <li class="menu-item <?php echo e(request()->is('admin/PayRollSetting/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/PayRollSetting/home')); ?>" class="menu-link">
         <div data-i18n="List">PayRoll Settings</div>
         </a>
         </li> 
         <li class="menu-item <?php echo e(request()->is('admin/Role/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/Role/home')); ?>" class="menu-link">
         <div data-i18n="List">Role</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/Product/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/Product/home')); ?>" class="menu-link">
         <div data-i18n="List">Service Automation</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/Template/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/Template/home')); ?>" class="menu-link">
         <div data-i18n="List">SmS/Email Template</div>
         </a>
         </li>
         
         <li class="menu-item <?php echo e(request()->is('admin/SecuritySettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/SecuritySettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Security Setting</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/Security/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/Security/home')); ?>" class="menu-link">
         <div data-i18n="List">Security</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/StorageSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/StorageSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Storage Settings</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/TaskCategory/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/TaskCategory/home')); ?>" class="menu-link">
         <div data-i18n="List">Task Category</div>
         </a>
         </li>
         <li class="menu-item <?php echo e(request()->is('admin/TaxSettings/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/TaxSettings/home')); ?>" class="menu-link">
         <div data-i18n="List">Tax Setting</div>
         </a>
         </li> 
         <li class="menu-item <?php echo e(request()->is('admin/TicketEmailSetting/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('admin/TicketEmailSetting/home')); ?>" class="menu-link">
         <div data-i18n="List">Ticket-Email Setting</div>
         </a>
         </li> 
         
         </ul>
         </li> -->
      <!-- Settings end -->
      <?php
      $customLinks = \App\Models\CustomLinkSetting::get();
      ?>
      <!--  <?php if($customLinks->isNotEmpty()): ?>
         <ul class="menu-inner py-1">
                 <?php $__currentLoopData = $customLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="menu-item  <?php echo e(request()->is('$customLink->url') ? 'active':''); ?>">
                         <a target="__blank" href="<?php echo e(url($customLink->url)); ?>" class="menu-link">
                       <i class="menu-icon fa-solid fa-link color1"></i>
                       <div data-i18n="<?php echo e($customLink->link_title); ?>" class="small"><?php echo e($customLink->link_title); ?></div>
                     <div class="badge bg-primary rounded-pill ms-auto">3</div> 
                     </a>
                   </li>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </ul>
         <?php endif; ?> -->
      <?php elseif(Auth::user()->type == '2'): ?>
      <!-- Dashboards start -->
      <li class="menu-item <?php echo e(request()->is('user/dashboard') ? 'active':''); ?>">
         <a href="<?php echo e(url('user/dashboard')); ?>" class="menu-link">
            <i class="menu-icon tf-icons ti ti-smart-home  <?php echo e(request()->is('user/dashboard*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Dashboards">Dashboards</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
         </a>
      </li>
      <?php if(Auth::user()->type == '2'): ?>
      <li class="menu-item
         <?php echo e(request()->is('user/balancesheet/*') ? 'open':''); ?>

         <?php echo e(request()->is('user/balancesheet/*') ? 'open':''); ?>

         <?php echo e(request()->is('user/order/*') ? 'open':''); ?>

         <?php echo e(request()->is('user/order/*') ? 'open':''); ?>

         <?php echo e(request()->is('user/transaction/*') ? 'open':''); ?>

         <?php echo e(request()->is('user/transaction/*') ? 'open':''); ?>

         <?php echo e(request()->is('user/userInvoice') ? 'open':''); ?>

         <?php echo e(request()->is('user/userInvoiceView/*') ? 'open':''); ?>

         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fas fa-calculator color1"></i>
            <div data-i18n="Dashboards">Accounting</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
         </a>
         <ul class="menu-sub CircleR">
            <li class="menu-item <?php echo e(request()->is('user/userInvoice*') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/userInvoice')); ?>" class="menu-link">
                  <i class="fas fa-file-invoice <?php echo e(request()->is('user/userInvoice*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="Private">Invoice</div>
               </a>
            </li>
            <!--  <li class="menu-item <?php echo e(request()->is('user/balancesheet*') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/balancesheet/home')); ?>" class="menu-link">
                 <div data-i18n="Private">Balancesheet</div>
               </a>
               </li>
               -->
            <li class="menu-item <?php echo e(request()->is('user/order*') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/order/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-box <?php echo e(request()->is('user/order/home*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="Advanced">Order</div>
               </a>
            </li>
            <!-- <li class="menu-item <?php echo e(request()->is('user/services*') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/services/home')); ?>" class="menu-link">
                 <div data-i18n="Advanced">Services</div>
               </a>
               </li> -->
            <li class="menu-item <?php echo e(request()->is('user/transaction*') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/transaction/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-sack-dollar <?php echo e(request()->is('user/transaction/home*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="Advanced">Transactions</div>
               </a>
            </li>
         </ul>
      </li>
      <?php endif; ?>
      <!-- Dashboards end -->
      <!-- Quotes start -->
      <!--  <?php if(in_array('Quotes', array_column($ClientAccess, 'per_name'))): ?>
         <li class="menu-item <?php echo e(request()->is('user/Quotes') ? 'active':''); ?>">
           <a href="<?php echo e(url('user/Quotes')); ?>" class="menu-link">
             <i class="menu-icon fa-solid fa-quote-left"></i>
             <div data-i18n="Quotes">Quotes</div>
             <div class="badge bg-primary rounded-pill ms-auto"></div> 
           </a>
         </li>
         <?php endif; ?> -->
      <li class="menu-item <?php echo e(request()->is('user/Quotes') ? 'active':''); ?>">
         <a href="<?php echo e(url('user/Quotes')); ?>" class="menu-link">
            <i class="menu-icon fa-solid fa-quote-left <?php echo e(request()->is('user/Quotes*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Quotes">Quotes</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
         </a>
      </li>
      <li class="menu-item <?php echo e(request()->is('user/userTicket') ? 'active':''); ?>">
         <a href="<?php echo e(url('user/userTicket')); ?>" class="menu-link">
            <i class="menu-icon fas fa-ticket-alt <?php echo e(request()->is('user/userTicket*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Quotes">Ticket</div>
         </a>
      </li>
      <li class="menu-item <?php echo e(request()->is('user/userLogActivity') ? 'active':''); ?>">
         <a href="<?php echo e(url('user/userLogActivity')); ?>" class="menu-link">
            <i class="menu-icon fas fa-snowboarding <?php echo e(request()->is('user/userLogActivity*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Quotes">Log Activity</div>
         </a>
      </li>
      <!--   <li class="menu-item <?php echo e(request()->is('user/services') ? 'active':''); ?>">
         <a href="<?php echo e(url('user/services/home')); ?>" class="menu-link">
          <i class="menu-icon fas fa-cog"></i>
           <div data-i18n="Quotes">Services</div>
         </a>
         </li> -->
      <!--  <li class="menu-item <?php echo e(request()->is('user/order') ? 'active':''); ?>">
         <a href="<?php echo e(url('user/order')); ?>" class="menu-link">
           <i class="menu-icon tf-icons ti ti-smart-home"></i>
           <div data-i18n="Dashboards">Order</div>
         </a>
         </li> -->
      <!-- Quotes end -->
      <!-- Work start -->
      <li class="menu-item 
         <?php echo e(request()->is('user/Project/*') ? 'open':''); ?>

         <?php echo e(request()->is('user/Project/*') ? 'active':''); ?>

         <?php echo e(request()->is('user/Task/*') ? 'open':''); ?>

         <?php echo e(request()->is('user/Task/*') ? 'active':''); ?>

         <?php echo e(request()->is('user/TimeSheet/*') ? 'open':''); ?>

         <?php echo e(request()->is('user/TimeSheet/*') ? 'active':''); ?>

         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons fa-solid fa-business-time color1"></i>
            <div data-i18n="Dashboards">Work</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
         </a>
         <ul class="menu-sub">
            <?php if(in_array('Project', array_column($ClientAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('user/Project*') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/Project/home')); ?>" class="menu-link">
                  <div data-i18n="Private">Project</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Task', array_column($ClientAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('user/Task*') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/Task/home')); ?>" class="menu-link">
                  <div data-i18n="Advanced">Task</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('TimeSheet', array_column($ClientAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('user/TimeSheet*') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/TimeSheet/home')); ?>" class="menu-link">
                  <div data-i18n="Advanced">Time Sheet</div>
               </a>
            </li>
            <?php endif; ?>
         </ul>
      </li>
      <!--  <?php if(in_array('Project', array_column($ClientAccess, 'per_name')) || in_array('Task', array_column($ClientAccess, 'per_name')) || in_array('TimeSheet', array_column($ClientAccess, 'per_name'))): ?>
         <?php endif; ?> -->
      <!-- Work End -->
      <!-- Services start -->
      <li class="menu-item 
         <?php echo e(request()->is('user/getServicesIdWise/4') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/4') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/5') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/5') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/6') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/6') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/7') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/7') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/8') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/8') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/9') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/9') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/10') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/10') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/11') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/11') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/12') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/12') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/13') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/13') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/14') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/14') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/15') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/15') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/16') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/16') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/17') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/17') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/18') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/18') ? 'active':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/19') ? 'open':''); ?>

         <?php echo e(request()->is('user/getServicesIdWise/19') ? 'active':''); ?>

         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-cloud color1"></i>
            <div data-i18n="Users">Services</div>
         </a>
         <ul class="menu-sub CircleR">
            <?php if($BareMetal > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/4') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/4')); ?>" class="menu-link">
                  <i class="fa-solid fa-bars"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Bare Metal (VT)</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($CloudHosting > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/5') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/5')); ?>" class="menu-link">
                  <i class="fas fa-cloud-upload-alt"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Hosting</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($CloudServices > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/6') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/6')); ?>" class="menu-link">
                  <i class="fas fa-cloud"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Services</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($DedicatedServer > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/7') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/7')); ?>" class="menu-link">
                  <i class="fas fa-server"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Dedicated Server</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($AwsService > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/8') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/8')); ?>" class="menu-link">
                  <i class="fa-brands fa-aws"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Aws Service</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($MicrosoftAzure > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/9') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/9')); ?>" class="menu-link">
                  <i class="fab fa-microsoft"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft Azure</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($GoogleWorkSpace > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/10') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/10')); ?>" class="menu-link">
                  <i class="fab fa-google"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Google Work Space</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($MicrosoftOffice365 > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/11') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/11')); ?>" class="menu-link">
                  <!--<i class="fab fa-windows"></i>-->
                  <img src="<?php echo e(request()->is('user/getServicesIdWise/11*') ? url('public/images/m1white.png') : url('public/images/m2blue.png')); ?>" alt="Microsoft 365 Icon" style="width: 20px; height: 20px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft 365</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($OneTimeSetup > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/12') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/12')); ?>" class="menu-link">
                  <i class="fas fa-cog"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">One Time Setup</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($MonthelySetup > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/13') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/13')); ?>" class="menu-link">
                  <i class="fas fa-cogs"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Monthely Management</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($SSLCertificate > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/14') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/14')); ?>" class="menu-link">
                  <i class="fas fa-stamp"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">SSL Certificate</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($Antivirus > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/15') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/15')); ?>" class="menu-link">
                  <i class="fas fa-shield-virus"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Antivirus</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($Licenses > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/16') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/16')); ?>" class="menu-link">
                  <i class="fas fa-id-badge"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Licenses</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($Acronis > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/17') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/17')); ?>" class="menu-link">
                  <img src="<?php echo e(request()->is('user/getServicesIdWise/17*') ? url('public/images/Acronis1white.png') : url('public/images/Acroniss1blue.png')); ?>" alt="Acronis Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Acronis</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if($TsPlus > 0): ?>
            <li class="menu-item <?php echo e(request()->is('user/getServicesIdWise/18') ? 'active':''); ?>">
               <a href="<?php echo e(url('user/getServicesIdWise/18')); ?>" class="menu-link">
                  <img src="<?php echo e(request()->is('user/getServicesIdWise/18*') ? url('public/images/tswhite1.png') : url('public/images/tsblue1.png')); ?>" alt="TS plus Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">TsPlus</div>
               </a>
            </li>
            <?php endif; ?>
            <!--  <?php if(in_array('Other', array_column($ClientAccess, 'per_name'))): ?>  
               <li class="menu-item <?php echo e(request()->is('user/Other/*') ? 'active':''); ?>">
                 <a href="<?php echo e(url('user/Other/home')); ?>" class="menu-link">
                   <i class="fas fa-toolbox"></i>
                 &nbsp;&nbsp;
                   <div data-i18n="List">Other</div>
                 </a>
               </li>
               <?php endif; ?> -->
         </ul>
      </li>
      <!-- Services end
         <?php
          $customLinks = \App\Models\CustomLinkSetting::get();
         ?>
         <?php if($customLinks->isNotEmpty()): ?>
         <ul class="menu-inner py-1">
                <?php $__currentLoopData = $customLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li class="menu-item  <?php echo e(request()->is('$customLink->url') ? 'active':''); ?>">
                        <a target="__blank" href="<?php echo e(url($customLink->url)); ?>" class="menu-link">
                      <i class="menu-icon fa-solid fa-link"></i>
                      <div data-i18n="<?php echo e($customLink->link_title); ?>" class="small"><?php echo e($customLink->link_title); ?></div>
                       <div class="badge bg-primary rounded-pill ms-auto">3</div> 
                    </a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
         <?php endif; ?>
         
         </ul> -->
      <?php elseif(Auth::user()->type == '4'): ?>
      <!-- Dashboards start -->
      <?php if(in_array('Private_Dashboard', array_column($RoleAccess, 'per_name')) || in_array('Advanced_Dashboard', array_column($RoleAccess, 'per_name'))): ?>
      <!-- <li class="menu-item <?php echo e(request()->is('Employee/dashboard') ? 'open':''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
           <i class="menu-icon tf-icons ti ti-smart-home"></i>
           <div data-i18n="Dashboards">Dashboards</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('Employee/dashboard') ? 'active':''); ?>">
             <a href="<?php echo e(url('Employee/dashboard')); ?>" class="menu-link">
               <div data-i18n="Private">Dashboard</div>
             </a>
           </li>
         </ul>
         </li> -->
      <li class="menu-item <?php echo e(request()->is('Employee/dashboard') ? 'active':''); ?>">
         <a href="<?php echo e(url('Employee/dashboard')); ?>" class="menu-link ">
            <i class="menu-icon tf-icons ti ti-smart-home ntwk"></i>
            <div data-i18n="Dashboards">Dashboard</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <?php endif; ?>
      <!-- Dashboards end -->
      <!-- User start -->
      <?php if(in_array('Client', array_column($RoleAccess, 'per_name')) || in_array('Vendor', array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item <?php echo e(request()->is('Employee/Client/*') ? 'open':''); ?> <?php echo e(request()->is('Employee/Vendor/*') ? 'open':''); ?> <?php echo e(request()->is('Employee/Client/*') ? 'active':''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-user color1"></i>
            <div data-i18n="Users">Users</div>
         </a>
         <ul class="menu-sub CircleR">
            <?php if(in_array('Client', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Client/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Client/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-handshake <?php echo e(request()->is('Employee/Client*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Client</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Vendor', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Vendor/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Vendor/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-circle-user <?php echo e(request()->is('Employee/Vendor*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Vendor</div>
               </a>
            </li>
            <?php endif; ?>
         </ul>
      </li>
      <?php endif; ?>
      <!-- User end -->
      <!-- Sales start -->
      <?php if(in_array('Leads', array_column($RoleAccess, 'per_name')) || in_array('Quotes', array_column($RoleAccess, 'per_name')) || in_array('SpecialOffers', array_column($RoleAccess, 'per_name')) || in_array('Goal', array_column($RoleAccess, 'per_name')) || in_array('MassMail', array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item <?php echo e(request()->is('Employee/Leads/*') ? 'open':''); ?>   
         <?php echo e(request()->is('Employee/Quotes/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Category/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/HostingPanel/*') ? 'open':''); ?>  
         <?php echo e(request()->is('Employee/SpecialOffers/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Goal/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/MassMail/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/recent_follow_ups/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Leads/*') ? 'active':''); ?> 
         <?php echo e(request()->is('Employee/HostingPanel/*') ? 'active':''); ?> 
         <?php echo e(request()->is('Employee/Quotes/*') ? 'active':''); ?> 
         <?php echo e(request()->is('Employee/recent_follow_ups/*') ? 'active':''); ?> 
         <?php echo e(request()->is('Employee/Category/*') ? 'active':''); ?> 
         <?php echo e(request()->is('Employee/SpecialOffers/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/Goal/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/MassMail/*') ? 'active':''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-globe color1"></i>
            <div data-i18n="globe">Sales</div>
         </a>
         <ul class="menu-sub CircleR">
            <?php if(in_array('Leads', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Leads/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Leads/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-circle-up <?php echo e(request()->is('Employee/Leads*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Leads</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Quotes', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Quotes/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Quotes/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-quote-left <?php echo e(request()->is('Employee/Quotes*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Quotes</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Goal', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Goal/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Goal/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-bullseye <?php echo e(request()->is('Employee/Goal*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Goals</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('MassMail', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/MassMail/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/MassMail/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-envelope <?php echo e(request()->is('Employee/MassMail*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Mass Mail</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('SpecialOffers', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/SpecialOffers/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/SpecialOffers/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-envelope-open-text <?php echo e(request()->is('Employee/SpecialOffers*') ? 'color2':'color1'); ?>"></i>&nbsp;&nbsp;
                  <div data-i18n="List">Special Offers</div>
               </a>
            </li>
            <?php endif; ?>
         </ul>
      </li>
      <?php endif; ?>
      <!-- Sales end -->
      <!-- Network Management start -->
      <?php if(in_array('NetworkSubnet', array_column($RoleAccess, 'per_name')) || in_array('IPAddress', array_column($RoleAccess, 'per_name')) || in_array('Rack', array_column($RoleAccess, 'per_name')) || in_array('Switchs', array_column($RoleAccess, 'per_name')) || in_array('Firewall', array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item 
         <?php echo e(request()->is('Employee/NetworkSubnet/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/NetworkSubnet/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/IPAddress/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/IPAddress/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/Rack/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Rack/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/Switchs/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Switchs/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/Firewall/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Firewall/*') ? 'active':''); ?>

         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-brands fa-hive color1"></i>
            <div data-i18n="Users" class="small">Network Management</div>
         </a>
         <ul class="menu-sub">
            <?php if(in_array('NetworkSubnet', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/NetworkSubnet/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/NetworkSubnet/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-network-wired ntwk <?php echo e(request()->is('Employee/NetworkSubnet*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Network Subnet</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('IPAddress', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/IPAddress/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/IPAddress/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-i ntwk <?php echo e(request()->is('Employee/IPAddress*') ? 'color2':'color1'); ?>" style="margin-right: 3px;"></i><i class="fa-solid fa-p ntwk <?php echo e(request()->is('Employee/IPAddress*') ? 'color2':'color1'); ?>" style="margin-right:6px;"></i>
                  <div data-i18n="List">IP Address</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Rack', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Rack/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Rack/home')); ?>" class="menu-link netwrk">
                  <i class="fas fa-server ntwk <?php echo e(request()->is('Employee/Rack*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Rack</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Switchs', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Switchs/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Switchs/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-toggle-on ntwk <?php echo e(request()->is('Employee/Switchs*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Switch</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Firewall', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Firewall/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Firewall/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-shield-halved ntwk <?php echo e(request()->is('Employee/Firewall*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Firewall</div>
               </a>
            </li>
            <?php endif; ?>
         </ul>
      </li>
      <?php endif; ?>
      <!-- Network Management end -->
      <!-- Services start -->
      <?php if(in_array('BareMetal', array_column($RoleAccess, 'per_name')) || in_array('CloudHosting', array_column($RoleAccess, 'per_name')) || in_array('CloudServices', array_column($RoleAccess, 'per_name')) || in_array('DedicatedServer', array_column($RoleAccess, 'per_name')) || in_array('AwsService', array_column($RoleAccess, 'per_name')) || in_array('Azure', array_column($RoleAccess, 'per_name')) || in_array('GoogleWorkSpace', array_column($RoleAccess, 'per_name')) || in_array('MicrosoftOffice365', array_column($RoleAccess, 'per_name')) || in_array('OneTimeSetup', array_column($RoleAccess, 'per_name')) || in_array('MonthelySetup', array_column($RoleAccess, 'per_name')) || in_array('SSLCertificate', array_column($RoleAccess, 'per_name')) || in_array('Antivirus', array_column($RoleAccess, 'per_name')) || in_array('Licenses', array_column($RoleAccess, 'per_name')) || in_array('Acronis', array_column($RoleAccess, 'per_name')) || in_array('TsPlus', array_column($RoleAccess, 'per_name')) || in_array('Other', array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item 
         <?php echo e(request()->is('Employee/BareMetal/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/BareMetal/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/CloudHosting/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/CloudHosting/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/CloudServices/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/CloudServices/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/DedicatedServer/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/DedicatedServer/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/AwsService/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/AwsService/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/Azure/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Azure/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/GoogleWorkSpace/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/GoogleWorkSpace/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/MicrosoftOffice365/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/MicrosoftOffice365/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/OneTimeSetup/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/OneTimeSetup/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/MonthelySetup/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/MonthelySetup/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/SSLCertificate/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/SSLCertificate/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/Antivirus/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Antivirus/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/Licenses/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Licenses/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/Acronis/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Acronis/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/TsPlus/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/TsPlus/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/Other/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Other/*') ? 'active':''); ?>                                  
         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-cloud color1"></i>
            <div data-i18n="Users">Services</div>
         </a>
         <ul class="menu-sub CircleR">
            <?php if(in_array('BareMetal', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/BareMetal/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/BareMetal/home')); ?>" class="menu-link">
                  <i class="fa-solid fa-bars <?php echo e(request()->is('Employee/BareMetal*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="Users">Bare Metal (VT)</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('CloudHosting', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/CloudHosting/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/CloudHosting/home')); ?>" class="menu-link">
                  <i class="fas fa-cloud-upload-alt <?php echo e(request()->is('Employee/CloudHosting*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Hosting</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('CloudServices', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/CloudServices/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/CloudServices/home')); ?> " class="menu-link">
                  <i class="fas fa-cloud <?php echo e(request()->is('Employee/CloudServices*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Cloud Services</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('DedicatedServer', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/DedicatedServer/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/DedicatedServer/home')); ?>" class="menu-link">
                  <i class="fas fa-server <?php echo e(request()->is('Employee/DedicatedServer*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Dedicated Server</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('AwsService', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/AwsService/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/AwsService/home')); ?>" class="menu-link">
                  <i class="fa-brands fa-aws <?php echo e(request()->is('Employee/AwsService*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Aws Service</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Azure', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Azure/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Azure/home')); ?>" class="menu-link">
                  <i class="fab fa-microsoft <?php echo e(request()->is('Employee/Azure*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft Azure</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('GoogleWorkSpace', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/GoogleWorkSpace/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/GoogleWorkSpace/home')); ?>" class="menu-link">
                  <i class="fab fa-google <?php echo e(request()->is('Employee/GoogleWorkSpace*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Google Work Space</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('MicrosoftOffice365', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/MicrosoftOffice365/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/MicrosoftOffice365/home')); ?>" class="menu-link">
                  <!-- <i class="fas fa-briefcase"></i> -->
                  <img src="<?php echo e(request()->is('Employee/MicrosoftOffice365*') ? url('public/images/m1white.png') : url('public/images/m2blue.png')); ?>" alt="Microsoft 365 Icon" style="width: 20px; height: 20px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Microsoft 365</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('OneTimeSetup', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/OneTimeSetup/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/OneTimeSetup/home')); ?>" class="menu-link">
                  <i class="fas fa-cog <?php echo e(request()->is('Employee/OneTimeSetup*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">One Time Setup</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('MonthelySetup', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/MonthelySetup/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/MonthelySetup/home')); ?>" class="menu-link">
                  <i class="fas fa-cogs <?php echo e(request()->is('Employee/MonthelySetup*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Monthly Management</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('SSLCertificate', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/SSLCertificate/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/SSLCertificate/home')); ?>" class="menu-link">
                  <i class="fas fa-stamp <?php echo e(request()->is('Employee/SSLCertificate*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">SSL Certificate</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Antivirus', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Antivirus/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Antivirus/home')); ?>" class="menu-link">
                  <i class="fas fa-shield-virus <?php echo e(request()->is('Employee/Antivirus*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Antivirus</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Licenses', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Licenses/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Licenses/home')); ?>" class="menu-link">
                  <i class="fas fa-id-badge <?php echo e(request()->is('Employee/Licenses*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Licenses</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Acronis', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Acronis/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Acronis/home')); ?>" class="menu-link">
                  <img src="<?php echo e(request()->is('Employee/Acronis*') ? url('public/images/Acronis1white.png') : url('public/images/Acroniss1blue.png')); ?>" alt="Acronis Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">Acronis</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('TsPlus', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/TsPlus/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/TsPlus/home')); ?>" class="menu-link">
                  <img src="<?php echo e(request()->is('Employee/TsPlus*') ? url('public/images/tswhite1.png') : url('public/images/tsblue1.png')); ?>" alt="TS plus Icon" style="width: 15px; height: 15px;">
                  &nbsp;&nbsp;
                  <div data-i18n="List">TsPlus</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Other', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Other/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Other/home')); ?>" class="menu-link">
                  <i class="fas fa-toolbox <?php echo e(request()->is('Employee/Other*') ? 'color2':'color1'); ?>"></i>
                  &nbsp;&nbsp;
                  <div data-i18n="List">Other</div>
               </a>
            </li>
            <?php endif; ?>
         </ul>
      </li>
      <?php endif; ?>
      <?php if(Auth::user()->type == '4' && $depart_ment->department_id == 1): ?>
      <!-- Services end -->
      <li class="menu-item <?php echo e(request()->is('Employee/monitoring/*') ? 'open':''); ?> 
         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="fas fa-desktop" style="padding-right:13px;color:#7367f0;"></i>
            <div data-i18n="Ticket">Monitoring Service</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('Employee/monitoring/server') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/monitoring/server')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Server Monitoring</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('Employee/monitoring/service') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/monitoring/service')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Service Monitoring</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('Employee/monitoring/memory') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/monitoring/memory')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Memory</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('Employee/monitoring/disk') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/monitoring/disk')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Disk</div>
               </a>
            </li>
            <li class="menu-item <?php echo e(request()->is('Employee/monitoring/network') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/monitoring/network')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Network</div>
               </a>
            </li>
         </ul>
      </li>
      <?php endif; ?>
      <!-- Ticket start -->
      <!--<li class="menu-item <?php echo e(request()->is('admin/Ticket/*') ? 'open':''); ?> <?php echo e(request()->is('admin/Vendor/*') ? 'open':''); ?> <?php echo e(request()->is('admin/Ticket/*') ? 'active':''); ?>">-->
      <!--  <a href="javascript:void(0);" class="menu-link menu-toggle">-->
      <!--    <i class="menu-icon fa-solid fa-ticket color1"></i>-->
      <!--    <div data-i18n="Ticket">Ticket Support</div>-->
      <!--  </a>-->
      <!--  <ul class="menu-sub">-->
      <!--    <li class="menu-item <?php echo e(request()->is('admin/Ticket/overview') ? 'active':''); ?>">-->
      <!--      <a href="<?php echo e(url('admin/Ticket/overview')); ?>" class="menu-link">-->
      <!--        <div data-i18n="Ticket">Ticket Overview</div>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--  </ul>-->
      <!--  <ul class="menu-sub">-->
      <!--    <li class="menu-item <?php echo e(request()->is('admin/Ticket/home') ? 'active':''); ?>">-->
      <!--      <a href="<?php echo e(url('admin/Ticket/home')); ?>" class="menu-link">-->
      <!--        <div data-i18n="Ticket">Ticket List</div>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--  </ul>-->
      <!--</li>-->
      <!-- server monitoring -->
      <!-- Ticket start -->
      <?php if(in_array('Tickets', array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item <?php echo e(request()->is('Employee/Ticket/*') ? 'open':''); ?> <?php echo e(request()->is('Employee/Vendor/*') ? 'open':''); ?> <?php echo e(request()->is('Employee/Ticket/*') ? 'active':''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-ticket <?php echo e(request()->is('Employee/Ticket*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Ticket">Ticket Support</div>
         </a>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('Employee/Ticket/overview') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Ticket/overview')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Ticket Overview</div>
               </a>
            </li>
         </ul>
         <ul class="menu-sub">
            <li class="menu-item <?php echo e(request()->is('Employee/Ticket/home') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Ticket/home')); ?>" class="menu-link">
                  <div data-i18n="Ticket">Ticket List</div>
               </a>
            </li>
         </ul>
      </li>
      <?php endif; ?>
      <!-- Ticket end -->
      <!-- Work start -->
      <?php if(in_array('Project', array_column($RoleAccess, 'per_name')) || in_array('Task', array_column($RoleAccess, 'per_name')) || in_array('TimeSheet', array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item 
         <?php echo e(request()->is('Employee/Project/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Project/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/Task/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/Task/*') ? 'active':''); ?>

         <?php echo e(request()->is('Employee/TimeSheet/*') ? 'open':''); ?>

         <?php echo e(request()->is('Employee/TimeSheet/*') ? 'active':''); ?>

         ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons fa-solid fa-business-time color1"></i>
            <div data-i18n="Dashboards">Work</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto"></div> -->
         </a>
         <ul class="menu-sub">
            <?php if(in_array('Project', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Project*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Project/home')); ?>" class="menu-link">
                  <div data-i18n="Private">Project</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Task', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Task*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Task/home')); ?>" class="menu-link">
                  <div data-i18n="Advanced">Task</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('TimeSheet', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/TimeSheet*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/TimeSheet/home')); ?>" class="menu-link">
                  <div data-i18n="Advanced">Time Sheet</div>
               </a>
            </li>
            <?php endif; ?>
         </ul>
      </li>
      <?php endif; ?>
      <!-- Work End -->
      <!-- Inventory Management start -->
      <?php if(in_array('Inventory', array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item  <?php echo e(request()->is('Employee/Inventory*') ? 'active':''); ?>">
         <a href="<?php echo e(url('Employee/Inventory/home')); ?>" class="menu-link " style="margin-left: 15px;">
            <i class="menu-icon fa-solid fa-boxes-stacked <?php echo e(request()->is('Employee/Inventory*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Dashboards" class="small">Inventory Management</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <?php endif; ?>
      <!-- Inventory Management end -->
      <!-- Human Resources start -->
      <?php if(array_intersect(['Department', 'JobRole', 'TimeShift', 'Attendence', 'Holiday', 'Leave', 'LeavePolicies', 'Employee', 'File', 'Performance', 'Calendar', 'PayRoll'], array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item <?php echo e(array_intersect(['Department', 'JobRole', 'TimeShift', 'Attendence', 'Holiday', 'Leave', 'LeavePolicies', 'Employee', 'File', 'Performance', 'Calendar', 'PayRoll'], array_column($RoleAccess, 'per_name')) ? 'open' : ''); ?>">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons fa-brands fa-osi color1"></i>
            <div data-i18n="globe">Human Resources</div>
         </a>
         <ul class="menu-sub">
            <?php if(in_array('Department', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Department/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Department/home')); ?>" class="menu-link netwrk">
                  <i class="fa-regular fa-building ntwk <?php echo e(request()->is('Employee/Department*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Department</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('JobRole', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/JobRole/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/JobRole/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-briefcase ntwk <?php echo e(request()->is('Employee/JobRole*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Job Role</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('TimeShift', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/TimeShift/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/TimeShift/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-business-time ntwk <?php echo e(request()->is('Employee/TimeShift*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Time Shift</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Employee', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Employee/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Employee/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-users ntwk <?php echo e(request()->is('Employee/Employee*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Employee</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Attendence', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Attendence/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Attendence/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-clipboard-user ntwk <?php echo e(request()->is('Employee/Attendence*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Attendance</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Leave', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Leave/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Leave/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-outdent ntwk <?php echo e(request()->is('Employee/Leave*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Leaves</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Holiday', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Holiday/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Holiday/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-h ntwk <?php echo e(request()->is('Employee/Holiday*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Holiday</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Performance', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Performance/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Performance/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-chart-simple ntwk <?php echo e(request()->is('Employee/Performance*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Performance</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('PayRoll', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/PayRoll/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/PayRoll/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-money-check ntwk <?php echo e(request()->is('Employee/PayRoll*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">PayRoll</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('File', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/File/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/File/home')); ?>" class="menu-link netwrk">
                  <i class="fa-solid fa-file ntwk <?php echo e(request()->is('Employee/File*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">File Management</div>
               </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('Calendar', array_column($RoleAccess, 'per_name'))): ?>
            <li class="menu-item <?php echo e(request()->is('Employee/Calendar/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Calendar/home')); ?>" class="menu-link netwrk">
                  <i class="fa-regular fa-calendar ntwk <?php echo e(request()->is('Employee/Calendar*') ? 'color2':'color1'); ?>"></i>
                  <div data-i18n="List">Calendar</div>
               </a>
            </li>
            <?php endif; ?>
         </ul>
      </li>
      <?php endif; ?>
      <!-- Human Resources end -->
      <!-- Human Resources Old start -->
      <!--  <?php if(in_array('Department', array_column($RoleAccess, 'per_name')) || in_array('JobRole', array_column($RoleAccess, 'per_name')) || in_array('TimeShift', array_column($RoleAccess, 'per_name')) || in_array('Attendence', array_column($RoleAccess, 'per_name')) || in_array('Holiday', array_column($RoleAccess, 'per_name')) || in_array('Leave', array_column($RoleAccess, 'per_name')) || in_array('LeavePolicies', array_column($RoleAccess, 'per_name')) || in_array('Employee', array_column($RoleAccess, 'per_name')) || in_array('File', array_column($RoleAccess, 'per_name')) || in_array('Performance', array_column($RoleAccess, 'per_name')) || in_array('Calendar', array_column($RoleAccess, 'per_name')) || in_array('PayRoll', array_column($RoleAccess, 'per_name'))): ?>
         <li class="menu-item <?php echo e(request()->is('Employee/Department/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/JobRole/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/TimeShift/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/Attendence/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/Holiday/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/Leave/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/LeavePolicies/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/Employee/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/Holiday/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/File/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/File/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/Performance/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/Performance/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/Calendar/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/PayRoll/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/PayRoll/*') ? 'open':''); ?>    
                              <?php echo e(request()->is('Employee/Calendar/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/Employee/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/LeavePolicies/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/Leave/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/Attendence/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/TimeShift/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/Department/*') ? 'active':''); ?>

                              <?php echo e(request()->is('Employee/JobRole/*') ? 'active':''); ?>">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class="menu-icon tf-icons fa-brands fa-osi ntwk" style="font-size:17px;"></i>
             <div data-i18n="globe">Human Resources</div>
           </a>
           <ul class="menu-sub">
             <?php if(in_array('Department', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Department/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Department/home')); ?>" class="menu-link netwrk">
                    <i class="fa-regular fa-building ntwk <?php echo e(request()->is('Employee/Department*' ? 'color2':'color1')); ?>"></i>
                 <div data-i18n="List">Department </div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('JobRole', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/JobRole/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/JobRole/home')); ?>" class="menu-link netwrk">
                    <i class="fa-solid fa-briefcase ntwk <?php echo e(request()->is('Employee/JobRole*' ? 'color2':
                   'color1')); ?>"></i>
                 <div data-i18n="List">Job Role</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('TimeShift', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/TimeShift/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/TimeShift/home')); ?>" class="menu-link netwrk">
                   <i class="fa-solid fa-business-time ntwk <?php echo e(request()->is('admin/TimeShift*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Time Shift</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('Attendence', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Attendence/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Attendence/home')); ?>" class="menu-link netwrk">
                   <i class="fa-solid fa-clipboard-user ntwk <?php echo e(request()->is('admin/Attendence*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Attendance</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('Holiday', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Holiday/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Holiday/home')); ?>" class="menu-link netwrk">
                    <i class="fa-solid fa-h ntwk <?php echo e(request()->is('Employee/Holiday*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Holiday</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('Leave', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Leave/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Leave/home')); ?>" class="menu-link netwrk">
                   <i class="fa-solid fa-outdent ntwk <?php echo e(request()->is('admin/Leave*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Leaves</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('LeavePolicies', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/LeavePolicies/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/LeavePolicies/home')); ?>" class="menu-link netwrk">
                   <i class="fa-regular fa-file-powerpoint ntwk <?php echo e(request()->is('admin/Department*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Policies</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('Employee', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Employee/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Employee/home')); ?>" class="menu-link netwrk">
                     <i class="fa-solid fa-users ntwk <?php echo e(request()->is('Employee/Employee') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Employee</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('File', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/File/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/File/home')); ?>" class="menu-link netwrk">
                   <i class="fa-solid fa-file ntwk <?php echo e(request()->is('admin/Department*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">File Management</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('Performance', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Performance/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Performance/home')); ?>" class="menu-link netwrk">
                   <i class="fa-solid fa-chart-simple ntwk <?php echo e(request()->is('admin/Performance*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Performance</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('Calendar', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Calendar/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Calendar/home')); ?>" class="menu-link netwrk">
                   <i class="fa-regular fa-calendar ntwk <?php echo e(request()->is('admin/Calendar*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Calendar</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('PayRoll', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/PayRoll/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/PayRoll/home')); ?>" class="menu-link netwrk">
                   <i class="fa-solid fa-clipboard-user ntwk <?php echo e(request()->is('admin/monitoring/service/*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">PayRoll</div>
               </a>
             </li>
             <?php endif; ?>
           </ul>
         </li>
         <?php endif; ?> -->
      <!-- Human Resources old end -->
      <!-- Company Login start -->
      <?php if(in_array('CompanyLogin', array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item  <?php echo e(request()->is('Employee/CompanyLogin*') ? 'active':''); ?>">
         <a href="<?php echo e(url('Employee/CompanyLogin/home')); ?>" class="menu-link ">
            <i class="menu-icon fa-regular fa-building <?php echo e(request()->is('Employee/CompanyLogin*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Dashboards">Company Login</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <?php endif; ?>
      <?php if(in_array('LogManagement', array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item  <?php echo e(request()->is('Employee/LogActivity/*') ? 'active':''); ?>">
         <a href="<?php echo e(url('Employee/LogActivity/home')); ?>" class="menu-link ">
            <i class="menu-icon  fas fa-tasks <?php echo e(request()->is('Employee/LogActivity*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Dashboards">Logs Management</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <?php endif; ?>
      <?php if(in_array('Setting', array_column($RoleAccess, 'per_name'))): ?>
      <li class="menu-item  <?php echo e(request()->is('Employee/Settings*') ? 'active':''); ?>">
         <a href="<?php echo e(url('Employee/Settings/home')); ?>" class="menu-link ">
            <i class="menu-icon tf-icons fa-solid fa-gear <?php echo e(request()->is('Employee/Settings*') ? 'color2':'color1'); ?>"></i>
            <div data-i18n="Dashboards">Settings</div>
            <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
         </a>
      </li>
      <?php endif; ?>
      <!-- Company Login end -->
      <!-- Settings start -->
      <!-- <?php if(in_array('Product', array_column($RoleAccess, 'per_name')) || in_array('Role', array_column($RoleAccess, 'per_name')) || in_array('PaymentMethod', array_column($RoleAccess, 'per_name')) || in_array('Security', array_column($RoleAccess, 'per_name')) || in_array('SecuritySettings', array_column($RoleAccess, 'per_name')) || in_array('MailSettings', array_column($RoleAccess, 'per_name')) || in_array('ProjectCategory', array_column($RoleAccess, 'per_name')) || in_array('TaskCategory', array_column($RoleAccess, 'per_name')) || in_array('LogActivity', array_column($RoleAccess, 'per_name')) || in_array('Template', array_column($RoleAccess, 'per_name')) || in_array('Notice', array_column($RoleAccess, 'per_name'))): ?>
         <li class="menu-item 
          <?php echo e(request()->is('Employee/Product/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/Product/*') ? 'active':''); ?>

          <?php echo e(request()->is('Employee/Role/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/Role/*') ? 'active':''); ?>

          <?php echo e(request()->is('Employee/PaymentMethod/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/PaymentMethod/*') ? 'active':''); ?>

          <?php echo e(request()->is('Employee/Security/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/Security/*') ? 'active':''); ?>

          <?php echo e(request()->is('Employee/SecuritySettings/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/SecuritySettings/*') ? 'active':''); ?>

          <?php echo e(request()->is('Employee/MailSettings/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/MailSettings/*') ? 'active':''); ?>

          <?php echo e(request()->is('Employee/ProjectCategory/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/ProjectCategory/*') ? 'active':''); ?>

          <?php echo e(request()->is('Employee/TaskCategory/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/TaskCategory/*') ? 'active':''); ?>

          <?php echo e(request()->is('Employee/LogActivity/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/LogActivity/*') ? 'active':''); ?>

          <?php echo e(request()->is('Employee/Template/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/Template/*') ? 'active':''); ?>

          <?php echo e(request()->is('Employee/Notice/*') ? 'open':''); ?>    
          <?php echo e(request()->is('Employee/Notice/*') ? 'active':''); ?>

          ">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class="menu-icon tf-icons fa-solid fa-gear ntwk" style="font-size:17px;"></i>
             <div data-i18n="globe">Settings</div>
           </a>
           <ul class="menu-sub">
             <?php if(in_array('Role', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Role/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Role/home')); ?>" class="menu-link netwrk">
                    <i class="fas fa-user-tag ntwk <?php echo e(request()->is('Employee/Role*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Role</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('ProjectCategory', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/ProjectCategory/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/ProjectCategory/home')); ?>" class="menu-link netwrk">
                    <i class="fas fa-project-diagram ntwk <?php echo e(request()->is('Employee/ProjectCategory*') ? 'color2':
                   'color1'); ?>"></i>
                 <div data-i18n="List">Project Category</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('TaskCategory', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/TaskCategory/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/TaskCategory/home')); ?>" class="menu-link netwrk">
                    <i class="fas fa-tasks ntwk <?php echo e(request()->is('Employee/TaskCategory*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Task Category</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('ServiceAutomation', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Product/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Product/home')); ?>" class="menu-link netwrk">
                   <i class="fas fa-cogs ntwk <?php echo e(request()->is('Employee/Product*') ? 'color2':'
                   color1'); ?>"></i>
                 <div data-i18n="List">ServiceAutomation</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('PaymentMethod', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/PaymentMethod/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/PaymentMethod/home')); ?>" class="menu-link netwrk">
                   <i class="fas fa-hand-holding-usd  ntwk <?php echo e(request()->is('Employee/PaymentMethod*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Payment Method</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('Template', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Template/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Template/home')); ?>" class="menu-link netwrk">
                        <i class="fas fa-sms ntwk <?php echo e(request()->is('Employee/Template*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">SmS/Email Template</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('Security', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Security/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Security/home')); ?>" class="menu-link netwrk">
                 <i class="fas fa-unlock-alt ntwk <?php echo e(request()->is('Employee/Security*') ? 'color2':'color1'); ?>"></i>
         
                 <div data-i18n="List">Security</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('SecuritySettings', array_column($RoleAccess, 'per_name'))): ?>
              <li class="menu-item <?php echo e(request()->is('Employee/SecuritySettings/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/SecuritySettings/home')); ?>" class="menu-link ">
                 <div data-i18n="List">Security Setting</div>
               </a>
             </li>
             <?php endif; ?>
         
              <?php if(in_array('FileManagement', array_column($RoleAccess, 'per_name'))): ?>
              <li class="menu-item <?php echo e(request()->is('Employee/FileManagement/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/FileManagement/home')); ?>" class="menu-link">
                 <div data-i18n="List">File Management</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('MailSettings', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/MailSettings/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/MailSettings/home')); ?>" class="menu-link netwrk">
                 <i class="fas fa-envelope ntwk <?php echo e(request()->is('Employee/MailSettings/*') ? 'color2':'color1'); ?>"></i>
         
                 <div data-i18n="List">Mail Setting</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('LogActivity', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/LogActivity/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/LogActivity/home')); ?>" class="menu-link">
                 <div data-i18n="List">Logs Management</div>
               </a>
             </li>
             <?php endif; ?>
             <?php if(in_array('Notice', array_column($RoleAccess, 'per_name'))): ?>
             <li class="menu-item <?php echo e(request()->is('Employee/Notice/*') ? 'active':''); ?>">
               <a href="<?php echo e(url('Employee/Notice/home')); ?>" class="menu-link netwrk">
                   <i class="far fa-sticky-note ntwk <?php echo e(request()->is('Employee/Notice*') ? 'color2':'color1'); ?>"></i>
                 <div data-i18n="List">Notice</div>
               </a>
             </li>
             <?php endif; ?>
           </ul>
         </li>
         <?php endif; ?> -->
      <!-- Settings end -->
      <?php endif; ?>
   </ul>
</aside>
<!-- / Menu -->
























<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/insighthub_db/resources/views/includes/sidebar.blade.php ENDPATH**/ ?>