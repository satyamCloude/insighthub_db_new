<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\MyProfileController;
use App\Http\Controllers\admin\TwoStepAuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\admin\LeadsController;
use App\Http\Controllers\admin\LeadFileController;
use App\Http\Controllers\admin\QuotesController;
use App\Http\Controllers\admin\MassMailController;
use App\Http\Controllers\admin\TransactionController;
use App\Http\Controllers\admin\ProductNewController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\user\UBalancesheetController;
use App\Http\Controllers\user\UServiceController;
use App\Http\Controllers\user\UTransactionController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\LeadsFollowupController;
use App\Http\Controllers\admin\ETemplateSettingController;
use App\Http\Controllers\admin\SpecialOffersController;
use App\Http\Controllers\admin\NotificationController;
use App\Http\Controllers\admin\GoalController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\FileManagementController;
use App\Http\Controllers\admin\JobRoleController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\HostingsController;
use App\Http\Controllers\admin\TimeShiftController;
use App\Http\Controllers\admin\ProjectCategoryController;
use App\Http\Controllers\admin\InvoiceSettingsController;
use App\Http\Controllers\admin\ProfileSettingsController;
use App\Http\Controllers\admin\LeaveSettingsController;
use App\Http\Controllers\admin\ModuleSettingsController;
use App\Http\Controllers\admin\CustomLinkSettingsController;
use App\Http\Controllers\admin\BuisnessAddressController;
use App\Http\Controllers\admin\CurrencyController;
use App\Http\Controllers\admin\TaxSettingsController;
use App\Http\Controllers\admin\CompanySettingsController;
use App\Http\Controllers\admin\TaskCategoryController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\AttendenceController;
use App\Http\Controllers\admin\HolidayController;
use App\Http\Controllers\admin\LeaveController;
use App\Http\Controllers\admin\LeaveTypeController;
use App\Http\Controllers\admin\LeavePoliciesController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\FileController;
use App\Http\Controllers\admin\PerformanceController;
use App\Http\Controllers\admin\PerformanceCategoryController;
use App\Http\Controllers\admin\PerformanceRatingController;
use App\Http\Controllers\admin\PerformanceSettingsController;
use App\Http\Controllers\admin\CalendarController;
use App\Http\Controllers\admin\PayRollController;
use App\Http\Controllers\admin\PayRollSettingController;
use App\Http\Controllers\admin\NetworkSubnetController;
use App\Http\Controllers\admin\IPAddressController;
use App\Http\Controllers\admin\RackController;
use App\Http\Controllers\admin\SwitchsController;
use App\Http\Controllers\admin\FirewallController;
use App\Http\Controllers\admin\BareMetalController;
use App\Http\Controllers\admin\CloudHostingController;
use App\Http\Controllers\admin\CloudServicesController;
use App\Http\Controllers\admin\DedicatedServerController;
use App\Http\Controllers\admin\AwsServiceController;
use App\Http\Controllers\admin\AzureController;
use App\Http\Controllers\admin\GoogleWorkSpaceController;
use App\Http\Controllers\admin\MicrosoftOffice365Controller;
use App\Http\Controllers\admin\OneTimeSetupController;
use App\Http\Controllers\admin\MonthelySetupController;
use App\Http\Controllers\admin\SSLCertificateController;
use App\Http\Controllers\admin\AntivirusController;
use App\Http\Controllers\admin\LicensesController;
use App\Http\Controllers\admin\AcronisController;
use App\Http\Controllers\admin\TsPlusController;
use App\Http\Controllers\admin\OtherController;
use App\Http\Controllers\admin\TicketController;
use App\Http\Controllers\admin\ServerMonitoringController;
use App\Http\Controllers\admin\ServiceMonitoringController;
use App\Http\Controllers\admin\MemoryMonitoringController;
use App\Http\Controllers\admin\DiskMonitoringController;
use App\Http\Controllers\admin\NetworkMonitoringController;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\InvoicesController;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\admin\TimeSheetController;
use App\Http\Controllers\admin\CompanyLoginController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PaymentMethodController;
use App\Http\Controllers\admin\SecurityController;
use App\Http\Controllers\admin\GrammarlyAPISettingsController;
use App\Http\Controllers\admin\SecuritySettingsController;
use App\Http\Controllers\admin\MailSettingsController;
use App\Http\Controllers\admin\LogActivityController;
use App\Http\Controllers\admin\NoticeController;
use App\Http\Controllers\admin\TemplateController;
use App\Http\Controllers\admin\LeadSettingsController;
use App\Http\Controllers\admin\CronJobController;
use App\Http\Controllers\admin\AppSettingsController;
use App\Http\Controllers\admin\StorageSettingsController;
use App\Http\Controllers\admin\TicketEmailSettingController;
use App\Http\Controllers\admin\SettingController;



use App\Http\Controllers\Employee\EAdminController;
use App\Http\Controllers\Employee\EMyProfileController;
use App\Http\Controllers\Employee\EDashboardController;
use App\Http\Controllers\Employee\EClientController;
use App\Http\Controllers\Employee\ELeadFileController;
use App\Http\Controllers\Employee\EVendorController;
use App\Http\Controllers\Employee\ELeadsController;
use App\Http\Controllers\Employee\EQuotesController;
use App\Http\Controllers\Employee\EMassMailController;
use App\Http\Controllers\Employee\EProductController;
use App\Http\Controllers\Employee\ECategoryController;
use App\Http\Controllers\Employee\ESpecialOffersController;
use App\Http\Controllers\Employee\EGoalController;
use App\Http\Controllers\Employee\EDepartmentController;
use App\Http\Controllers\Employee\EJobRoleController;
use App\Http\Controllers\Employee\ETimeShiftController;
use App\Http\Controllers\Employee\EProjectCategoryController;
use App\Http\Controllers\Employee\ETaskCategoryController;
use App\Http\Controllers\Employee\EProjectController;
use App\Http\Controllers\Employee\EAttendenceController;
use App\Http\Controllers\Employee\EHolidayController;
use App\Http\Controllers\Employee\ELeaveController;
use App\Http\Controllers\Employee\ELeaveTypeController;
use App\Http\Controllers\Employee\ENetworkMonitoringController;
use App\Http\Controllers\Employee\EDiskMonitoringController;
use App\Http\Controllers\Employee\EMemoryMonitoringController;
use App\Http\Controllers\Employee\EServerMonitoringController;
use App\Http\Controllers\Employee\EServiceMonitoringController;
use App\Http\Controllers\Employee\ELeavePoliciesController;
use App\Http\Controllers\Employee\ELeadsFollowupController;
use App\Http\Controllers\Employee\EEmployeeController;
use App\Http\Controllers\Employee\EFileController;
use App\Http\Controllers\Employee\EPerformanceController;
use App\Http\Controllers\Employee\EPerformanceCategoryController;
use App\Http\Controllers\Employee\EPerformanceRatingController;
use App\Http\Controllers\Employee\ECalendarController;
use App\Http\Controllers\Employee\EPayRollController;
use App\Http\Controllers\Employee\ENetworkSubnetController;
use App\Http\Controllers\Employee\EIPAddressController;
use App\Http\Controllers\Employee\ERackController;
use App\Http\Controllers\Employee\ESwitchsController;
use App\Http\Controllers\Employee\EFirewallController;
use App\Http\Controllers\Employee\EBareMetalController;
use App\Http\Controllers\Employee\ECloudHostingController;
use App\Http\Controllers\Employee\ECloudServicesController;
use App\Http\Controllers\Employee\EDedicatedServerController;
use App\Http\Controllers\Employee\EAwsServiceController;
use App\Http\Controllers\Employee\EAzureController;
use App\Http\Controllers\Employee\EGoogleWorkSpaceController;
use App\Http\Controllers\Employee\EMicrosoftOffice365Controller;
use App\Http\Controllers\Employee\EOneTimeSetupController;
use App\Http\Controllers\Employee\EMonthelySetupController;
use App\Http\Controllers\Employee\ESSLCertificateController;
use App\Http\Controllers\Employee\EAntivirusController;
use App\Http\Controllers\Employee\ELicensesController;
use App\Http\Controllers\Employee\EAcronisController;
use App\Http\Controllers\Employee\ETsPlusController;
use App\Http\Controllers\Employee\EOtherController;
use App\Http\Controllers\Employee\ETicketController;
use App\Http\Controllers\Employee\EInventoryController;
use App\Http\Controllers\Employee\EInvoicesController;
use App\Http\Controllers\Employee\ETaskController;
use App\Http\Controllers\Employee\ETimeSheetController;
use App\Http\Controllers\Employee\ECompanyLoginController;
use App\Http\Controllers\Employee\ERoleController;
use App\Http\Controllers\Employee\EPaymentMethodController;
use App\Http\Controllers\Employee\ESecurityController;
use App\Http\Controllers\Employee\ESecuritySettingsController;
use App\Http\Controllers\Employee\EMailSettingsController;
use App\Http\Controllers\Employee\ELogActivityController;
use App\Http\Controllers\Employee\ENoticeController;
use App\Http\Controllers\Employee\ETemplateController;
use App\Http\Controllers\Employee\ECronJobController;

use App\Http\Controllers\user\UserController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\MicrosoftController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\user\UDashboardController;
use App\Http\Controllers\user\UserServicesController;
use App\Http\Controllers\user\UMyProfileController;
use App\Http\Controllers\user\UNotificationController;
use App\Http\Controllers\user\UQuotesController;
use App\Http\Controllers\user\URazorpayPaymentController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\user\UTicketController;
use App\Http\Controllers\Auth\LoginController; // Make sure to import your controller

use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear-cache', function() {
        // Clear cache
      Artisan::call('cache:clear');
      Artisan::call('config:clear');
      Artisan::call('route:clear');
      Artisan::call('view:clear');
      Artisan::call('optimize:clear');
      Artisan::call('config:cache');
   return "Cache, config, route, and views cleared and re-cached successfully!";
});

Route::get('/Home', function () {
    return view('home');
});


Route::get('google', function () {
    return view('googleAuth');
});

Route::post('2fa/verify', [UMyProfileController::class, 'verify']);
Route::get('two-factor-authentication', [UMyProfileController::class, 'twoFA']);
Route::get('two-factor-auth-selection', [UMyProfileController::class, 'twoFAauthSelection']);

// Admin authentications start
Route::get('admin-two-factor-authentication', [SecuritySettingsController::class, 'twoFA']);
Route::get('admin-mailotp-authentication', [SecuritySettingsController::class, 'mailOtp']);
Route::post('2fa/admin-verify', [SecuritySettingsController::class, 'verify']);
Route::post('mailOtp/admin-verify', [SecuritySettingsController::class, 'mailOtp_verify']);
// Admin authentications end


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::controller(PaypalController::class)
// ->prefix('paypal')
// ->group(function () {
//     Route::view('payment', 'paypal')->name('create.payment');
//     Route::get('handle-payment', 'handlePayment')->name('make.payment');
//     Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
//     Route::get('payment-success', 'paymentSuccess')->name('success.payment');
// });
Route::controller(PaypalController::class)
    ->prefix('paypal')
    ->group(function () {
        Route::view('payment', 'paypal')->name('create.payment');
        Route::get('handle-payment-registration', 'handlePaymentRegistration');
        Route::get('payment-cancel-registration', 'paymentCancel2');
        Route::get('payment-success-registration', 'paymentSuccess2');
        Route::get('handle-payment', 'handlePayment')->name('make.payment');
        Route::get('payment-success', 'paymentSuccess')->name('success.payment');
        Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
});

/////FOR MS360 LOGIN MicrosoftController
Route::get('login/microsoft', [MicrosoftController::class, 'redirectToMicrosoft']);
Route::get('user/microsoft/callback', [MicrosoftController::class, 'handleMicrosoftCallback']);
// GoogleLoginController redirect and callback urls
Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('generateAutomaticInvoices', [GoogleLoginController::class, 'generateAutomaticInvoices']);
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
// Route::get('google/variemail', [UDashboardController::class, 'varify_email_page']);
Route::get('/google/varify_email', [UDashboardController::class, 'varifyEmail'])->name('google.varify_email');
Route::get('/google/resend_varification_email/{email}/{id}', [UDashboardController::class, 'resend_varification_email']);

Route::get('/account_verification/email/{user}/{email}/{token}', [UserController::class, 'account_verification'])->name('account_verification.email');
Route::get('/account_verification/email/{user}/{email}/{token}', [UserController::class, 'account_verification'])->name('verify.email');
Route::get('/get-forgot-password', [UserController::class, 'userForgotPassword']);
Route::get('/forgot-password', [UserController::class, 'userForgotPasswordPage']);
Route::post('/user-forgot-password-mail-send', [UserController::class, 'userForgotPasswordSendMail']);
Route::post('/user-forgot-password-store', [UserController::class, 'userForgotPasswordStore']);



Route::get('/validate_card', [UserController::class, 'validate_card'])->name('verify.validate_card');
Route::any('/validateCard/razorpay/callback/{id}/{email}/{token}/{price}', [UserController::class, 'handleCallback']);

//CronJob
Route::get('admin/Ticket/readEmails', [CronJobController::class, 'readEmails']);
Route::get('admin/Calender/CalenderEvents', [CronJobController::class, 'sendCalenderEvent']);
Route::get('admin/Ticket/getMailUsingImapServer', [CronJobController::class, 'getMailUsingImapServer']);
Route::get('admin/Ticket/getMailUsingImapServer', [CronJobController::class, 'getMailUsingImapServer']);
Route::get('admin/invoice/sendReminderBeforeDue', [CronJobController::class, 'sendReminderMail']);
Route::get('admin/invoice/sendReminderAfterDue', [CronJobController::class, 'sendOverdueMail']);
Route::get('admin/MassMail/SendScheduleMassMail', [CronJobController::class, 'SendScheduleMassMail']);
Route::get('admin/Attendence/AttendenceDailyCount', [CronJobController::class, 'AttendenceDailyCount']);
Route::get('admin/Attendence/punch_out', [CronJobController::class, 'punch_out']);
Route::get('admin/PayRollSetting/AutoGenerate', [PayRollSettingController::class, 'AutoGenerate']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('admin_Login', [AdminController::class, 'Login']);

//TwoStepAuth
Route::get('admin/TwoStepOtp', [TwoStepAuthController::class, 'index']);
Route::Post('admin/TwoStepMethod', [UMyProfileController::class, 'TwoStepMethod']);
Route::Post('admin/CheckOtp', [TwoStepAuthController::class, 'CheckOtp']);
Route::Post('user/CheckUserOtp', [TwoStepAuthController::class, 'CheckUserOtp']);
Route::get('admin/AuthReSendOtp', [TwoStepAuthController::class, 'AuthReSendOtp']);
Route::middleware(['auth'])->group(function () {
    Route::get('updateStatus/{id}', [DashboardController::class, 'updateStatus']);
});

Route::get('/', function () {
    return view('auth.user_login');
});
Route::get('UserRegister', function () {
    return view('auth.user_register');
});


Route::post('user_Login', [UserController::class, 'Login']);
Route::post('/Resgister', [UserController::class, 'register']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/Uregister', [UserController::class, 'register']);
Route::get('/homes', function () {
    return view('welcome');
});

Route::get('pages-pricing', function () {
    return view('pages-pricing');
});

Auth::routes();

//employee
// Route::group(['middleware' => 'check.ip'], function () {
    Route::get('/Employee', function () {
       return view('auth.employee_login');
   });
    Route::get('/employee', function () {
        return view('auth.employee_login');
    });
// });

//admin
// Route::group(['middleware' => 'check.ip'], function () {  

    //start ip validated middleware
    Route::get('/admin', function () {
        return view('auth.admin_login');
    });


    Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {


        //MyProfile
        Route::get('/MyProfile', [MyProfileController::class, 'index']);
        Route::post('/changePasswords/{id}', [ProfileSettingsController::class, 'changePassword']);
        Route::get('/MyProfile/edit', [MyProfileController::class, 'edit']);
        Route::post('/MyProfile/update', [MyProfileController::class, 'update']);
        Route::post('MyProfile/getstateData', [MyProfileController::class, 'Get_StateData']);
        Route::post('MyProfile/getcityData', [MyProfileController::class, 'Get_CityData']);
        Route::post('MyProfile/changePassword', [MyProfileController::class, 'changePassword']);


        //Dashboard
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::get('subscription/appUnapp/{id}/{category_id}/{status}', [DashboardController::class, 'subsApproveUn']);
        Route::get('Advanced', [DashboardController::class, 'Advanced']);
        Route::get('Dashboard/TabView', [DashboardController::class, 'TabView']);
        Route::get('ClockStatusUpdate', [DashboardController::class, 'ClockStatusUpdate']);
        Route::get('cancelRequests', [DashboardController::class, 'CancelRequests']);

        //Client
        Route::get('Client/home', [ClientController::class, 'home']);
        Route::get('Client/add', [ClientController::class, 'Create']);
        Route::post('Client/store', [ClientController::class, 'Store']);
        Route::post('Client/storeTeam', [ClientController::class, 'storeTeam']);
        Route::post('Client/Credits/store', [ClientController::class, 'storeCredits']);
        Route::get('Client/getCredit/{client_id}', [ClientController::class, 'getCredit']);
        Route::post('Client/getstateData', [ClientController::class, 'Get_StateData']);
        Route::post('Client/getcityData', [ClientController::class, 'Get_CityData']);
        Route::get('Client/view/{id}', [ClientController::class, 'view']);
        Route::get('Client/edit/{id}', [ClientController::class, 'edit']);
        Route::get('Client/editTeam/{id}', [ClientController::class, 'editTeam']);
        Route::post('Client/update/{id}', [ClientController::class, 'update']);
        Route::post('Client/updateTeam', [ClientController::class, 'updateTeam']);
        Route::get('Client/delete/{id}', [ClientController::class, 'delete']);
        Route::get('Client/deleteTeam/{id}', [ClientController::class, 'deleteTeam']);
        Route::post('Client/check-gst-number', [ClientController::class, 'checkGstNumber']);
        Route::post('Client/changePassword/{id}', [ClientController::class, 'changePassword']);
        Route::get('Client/2fa/disable', [ClientController::class, 'disable']);
        Route::get('Client/2fa/enable', [ClientController::class, 'enable']);
        //Vendor
        Route::get('Vendor/home', [VendorController::class, 'home']);
        Route::get('Vendor/add', [VendorController::class, 'Create']);
        Route::post('Vendor/store', [VendorController::class, 'Store']);
        Route::post('Vendor/getstateData', [VendorController::class, 'Get_StateData']);
        Route::post('Vendor/getcityData', [VendorController::class, 'Get_CityData']);
        Route::get('Vendor/view/{id}', [VendorController::class, 'view']);
        Route::get('Vendor/edit/{id}', [VendorController::class, 'edit']);
        Route::post('Vendor/update/{id}', [VendorController::class, 'update']);
        Route::get('Vendor/delete/{id}', [VendorController::class, 'delete']);

        //Leads
        Route::get('Leads/home', [LeadsController::class, 'home']);
        Route::get('Leads/ShowLeads', [LeadsController::class, 'ShowLeads']);
        Route::get('Leads/ShowFollowUps', [LeadsController::class, 'ShowFollowUp']);
        Route::post('Leads/LeadNotesUpdate', [LeadsController::class, 'LeadNotesUpdate']);
        Route::get('Leads/recent_follow_ups', [LeadsController::class, 'recent_follow_ups']);
        Route::get('recent_follow_ups', [LeadsController::class, 'recent_follow_ups']);
        Route::get('Leads/add', [LeadsController::class, 'Create']);
        Route::post('Leads/store', [LeadsController::class, 'Store']);
        Route::post('Leads/getstateData', [LeadsController::class, 'Get_StateData']);
        Route::post('Leads/getcityData', [LeadsController::class, 'Get_CityData']);
        Route::get('Leads/view/{id}', [LeadsController::class, 'view']);
        Route::get('Leads/edit/{id}', [LeadsController::class, 'edit']);
        Route::post('Leads/update/{id}', [LeadsController::class, 'update']);
        Route::get('Leads/delete/{id}', [LeadsController::class, 'delete']);
        Route::get('Leads/get_leads_yeardata', [LeadsController::class, 'get_leads_yeardata']);
        Route::get('Leads/getleadsYearfilterdata', [LeadsController::class, 'getleadsYearfilterdata']);
        Route::get('Leads/get_follow_up_type', [LeadsController::class, 'get_follow_up_type']);
        Route::get('Leads/LeadAssignUpdate', [LeadsController::class, 'LeadAssignUpdate']);

        Route::post('Leads/File/store', [LeadFileController::class, 'Store']);
        Route::get('Leads/File/delete/{id}/{leads_id}', [LeadFileController::class, 'delete']);


        //hosting panel
        Route::post('HostingPanel/store', [HostingsController::class, 'Store']);
        Route::get('HostingPanel/home', [HostingsController::class, 'home']);
        Route::get('HostingPanel/create', [HostingsController::class, 'create']);
        Route::get('HostingPanel/edit/{id}', [HostingsController::class, 'edit']);
        Route::post('HostingPanel/update/{id}', [HostingsController::class, 'update']);
        Route::get('HostingPanel/delete/{id}', [HostingsController::class, 'delete']);



        //Orders panel
        Route::post('Orders/store', [OrdersController::class, 'Store']);
        Route::get('Orders/home', [OrdersController::class, 'home']);
        Route::get('Orders/UpdateStatus', [OrdersController::class, 'UpdateStatus']);
        Route::get('Orders/create', [OrdersController::class, 'create']);
        Route::get('Orders/billingCycle/{id}', [OrdersController::class, 'billingCycle']);
        Route::get('Orders/getAddonProducts/{product_id}', [OrdersController::class, 'getAddonProducts']);
        Route::get('Orders/edit/{id}', [OrdersController::class, 'edit']);
        Route::get('Orders/view/{id}', [OrdersController::class, 'view']);
        Route::post('Orders/update/{id}', [OrdersController::class, 'update']);
        Route::get('Orders/delete/{id}', [OrdersController::class, 'delete']);
        Route::get('Orders/orderInvoiceCreate/{id}', [OrdersController::class, 'orderInvoiceCreate']);
        Route::get('getServicesIdWise/{id}', [OrdersController::class, 'getServicesIdWise']);

        //Quotes
        Route::get('Quotes/home', [QuotesController::class, 'home']);
        Route::get('getUserDetails', [QuotesController::class, 'getUserDetails']);
        Route::get('Quotes/add', [QuotesController::class, 'Create']);
        Route::post('Quotes/store', [QuotesController::class, 'Store']);
        Route::get('Quotes/get_Goal_data', [QuotesController::class, 'get_Goal_data']);
        Route::get('Quotes/get_productdata', [QuotesController::class, 'get_productdata']);
        Route::get('Quotes/get_product_addon', [QuotesController::class, 'get_product_addon']);
        Route::get('Quotes/get_categoryProduct', [QuotesController::class, 'get_categoryProduct']);
        Route::get('Quotes/view/{id}', [QuotesController::class, 'view']);
        Route::get('Quotes/edit/{id}', [QuotesController::class, 'edit']);
        Route::post('Quotes/update/{id}', [QuotesController::class, 'update']);
        Route::get('Quotes/delete/{id}', [QuotesController::class, 'delete']);
        Route::get('Quotes/printView/{id}', [QuotesController::class, 'printView']);
        Route::get('Quotes/downloadPDF/{id}', [QuotesController::class, 'downloadPDF']);
        Route::get('Quotes/downloadPDF', [QuotesController::class, 'downloadPDF']);
        Route::get('Quotes/SendQuotes/{id}', [QuotesController::class, 'SendQuotes']);
        Route::get('Quotes/EXPORTCSV', [QuotesController::class, 'EXPORTCSV']);
        Route::get('Quotes/GenerateQuotes/{id}', [QuotesController::class, 'GenerateQuotes']);
        Route::get('Quotes/MakeQuotesInvoice/{id}', [QuotesController::class, 'MakeQuotesInvoice']);
        Route::post('Quotes/changeQuotesStatus', [QuotesController::class, 'changeQuotesStatus']);

        Route::get('admin/Quotes/downloadSelected', [QuotesController::class, 'downloadSelected'])->name('quotes.downloadSelected');



        //MassMail
        Route::get('MassMail/home', [MassMailController::class, 'home']);
        Route::get('MassMail/add', [MassMailController::class, 'Create']);
        Route::post('MassMail/store', [MassMailController::class, 'Store']);
        Route::get('MassMail/Edit', [MassMailController::class, 'Edit']);
        Route::post('MassMail/update/{id}', [MassMailController::class, 'update']);
        Route::get('MassMail/Delete', [MassMailController::class, 'Delete']);
        Route::get('MassMail/Trash', [MassMailController::class, 'Trash']);
        Route::get('MassMail/SentMails', [MassMailController::class, 'SentMails']);
        Route::get('MassMail/Show', [MassMailController::class, 'Show']);
        Route::get('MassMail/DraftMails', [MassMailController::class, 'DraftMails']);
        Route::get('MassMail/StarMails', [MassMailController::class, 'StarMails']);
        Route::get('MassMail/StarUpdate', [MassMailController::class, 'StarUpdate']);
        Route::get('MassMail/Restore', [MassMailController::class, 'Restore']);
        Route::get('MassMail/ForceDelete', [MassMailController::class, 'ForceDelete']);
        Route::get('MassMail/SendM', [MassMailController::class, 'SendM']);
        Route::get('MassMail/Schedule', [MassMailController::class, 'Schedule']);
        Route::get('MassMail/LoadMore', [MassMailController::class, 'LoadMore']);


        //SpecialOffers
        Route::get('SpecialOffers/home', [SpecialOffersController::class, 'home']);
        Route::get('SpecialOffers/add', [SpecialOffersController::class, 'Create']);
        Route::post('SpecialOffers/store', [SpecialOffersController::class, 'Store']);
        Route::get('SpecialOffers/edit/{id}', [SpecialOffersController::class, 'edit']);
        Route::post('SpecialOffers/update/{id}', [SpecialOffersController::class, 'update']);
        Route::get('SpecialOffers/delete/{id}', [SpecialOffersController::class, 'delete']);


        //Goal
        Route::get('Goal/home', [GoalController::class, 'home']);
        Route::get('Goal/add', [GoalController::class, 'Create']);
        Route::post('Goal/store', [GoalController::class, 'Store']);
        Route::get('Goal/get_Goal_data', [GoalController::class, 'get_Goal_data']);
        Route::get('Goal/edit/{id}', [GoalController::class, 'edit']);
        Route::get('Goal/view/{id}/{Empid}', [GoalController::class, 'view']);
        Route::get('Goal/editView/{id}/{Empid}', [GoalController::class, 'editView']);
        Route::get('Goal/get_Goal_data_date_wise', [GoalController::class, 'getGoalDataDateWise']);
        Route::post('Goal/update/{id}', [GoalController::class, 'update']);
        Route::get('Goal/delete/{id}', [GoalController::class, 'delete']);
        Route::get('Goal/FromToDate', [GoalController::class, 'FromToDate']);

        //Department
        Route::get('Department/home', [DepartmentController::class, 'home']);
        Route::get('Department/add', [DepartmentController::class, 'Create']);
        Route::post('Department/store', [DepartmentController::class, 'Store']);
        Route::get('Department/edit/{id}', [DepartmentController::class, 'edit']);
        Route::post('Department/update', [DepartmentController::class, 'update']);
        Route::get('Department/delete/{id}', [DepartmentController::class, 'delete']);



        //LeadsFollowup
        Route::get('LeadsFollowup/home', [LeadsFollowupController::class, 'home']);
        Route::get('LeadsFollowup/add', [LeadsFollowupController::class, 'Create']);
        Route::post('LeadsFollowup/store', [LeadsFollowupController::class, 'Store']);
        Route::get('LeadsFollowup/edit', [LeadsFollowupController::class, 'edit']);
        Route::post('LeadsFollowup/update/{id}', [LeadsFollowupController::class, 'update']);
        Route::get('LeadsFollowup/delete/{id}', [LeadsFollowupController::class, 'delete']);

        //JobRole
        Route::get('JobRole/home', [JobRoleController::class, 'home']);
        Route::get('JobRole/add', [JobRoleController::class, 'Create']);
        Route::post('JobRole/store', [JobRoleController::class, 'Store']);
        Route::get('JobRole/edit/{id}', [JobRoleController::class, 'edit']);
        Route::post('JobRole/update/{id}', [JobRoleController::class, 'update']);
        Route::get('JobRole/delete/{id}', [JobRoleController::class, 'delete']);

        //TimeShift
        Route::get('TimeShift/home', [TimeShiftController::class, 'home']);
        Route::get('TimeShift/add', [TimeShiftController::class, 'Create']);
        Route::post('TimeShift/store', [TimeShiftController::class, 'Store']);
        Route::get('TimeShift/roaster', [TimeShiftController::class, 'roaster']);
        Route::get('TimeShift/edit/{id}', [TimeShiftController::class, 'edit']);
        Route::post('TimeShift/update/{id}', [TimeShiftController::class, 'update']);
        Route::get('TimeShift/delete/{id}', [TimeShiftController::class, 'delete']);

        //Attendence
        Route::get('Attendence/home', [AttendenceController::class, 'home']);
        Route::get('Attendence/add', [AttendenceController::class, 'Create']);
        Route::post('Attendence/store', [AttendenceController::class, 'Store']);
        Route::get('Attendence/edit/{id}', [AttendenceController::class, 'edit']);
        Route::get('Attendence/View/{id}', [AttendenceController::class, 'View']);
        Route::get('Attendence/filterAttendance/{id}', [AttendenceController::class, 'filterAttendance']);
        Route::post('Attendence/update/{id}', [AttendenceController::class, 'update']);
        Route::get('Attendence/delete/{id}', [AttendenceController::class, 'delete']);
        Route::get('Attendence/GetMonthYearData', [AttendenceController::class, 'GetMonthYearData']);
        Route::post('Attendence/fetch', [AttendenceController::class, 'fetchAttendance']);


        //NetworkSubnet
        Route::get('NetworkSubnet/home', [NetworkSubnetController::class, 'home']);
        Route::get('NetworkSubnet/add', [NetworkSubnetController::class, 'Create']);
        Route::post('NetworkSubnet/store', [NetworkSubnetController::class, 'Store']);
        Route::get('NetworkSubnet/edit/{id}', [NetworkSubnetController::class, 'edit']);
        Route::get('NetworkSubnet/view/{id}', [NetworkSubnetController::class, 'views']);
        Route::post('NetworkSubnet/update/{id}', [NetworkSubnetController::class, 'update']);
        Route::get('NetworkSubnet/delete/{id}', [NetworkSubnetController::class, 'delete']);

        //IPAddress
        Route::get('IPAddress/home', [IPAddressController::class, 'home']);
        Route::get('IPAddress/add', [IPAddressController::class, 'Create']);
        Route::post('IPAddress/store', [IPAddressController::class, 'Store']);
        Route::get('IPAddress/edit/{id}', [IPAddressController::class, 'edit']);
        Route::get('IPAddress/delete/{id}', [IPAddressController::class, 'delete']);
        Route::post('IPAddress/update/{id}', [IPAddressController::class, 'update']);
        Route::get('IPAddress/ExportCSV', [IPAddressController::class, 'ExportCSV']);

        //Rack
        Route::get('Rack/home', [RackController::class, 'home']);
        Route::get('Rack/add', [RackController::class, 'Create']);
        Route::post('Rack/store', [RackController::class, 'Store']);
        Route::get('Rack/vacant-units/{id}', [RackController::class, 'getVacantUnits']);
        Route::get('Rack/edit/{id}', [RackController::class, 'edit']);
        Route::post('Rack/update/{id}', [RackController::class, 'update']);
        Route::get('Rack/delete/{id}', [RackController::class, 'delete']);

        //Switchs
        Route::get('Switchs/home', [SwitchsController::class, 'home']);
        Route::get('Switchs/add', [SwitchsController::class, 'Create']);
        Route::post('Switchs/store', [SwitchsController::class, 'Store']);
        Route::get('Switchs/edit/{id}', [SwitchsController::class, 'edit']);
        Route::post('Switchs/update/{id}', [SwitchsController::class, 'update']);
        Route::get('Switchs/delete/{id}', [SwitchsController::class, 'delete']);

        //Switchs
        Route::get('Firewall/home', [FirewallController::class, 'home']);
        Route::get('Firewall/add', [FirewallController::class, 'Create']);
        Route::post('Firewall/store', [FirewallController::class, 'Store']);
        Route::get('Firewall/edit/{id}', [FirewallController::class, 'edit']);
        Route::post('Firewall/update/{id}', [FirewallController::class, 'update']);
        Route::get('Firewall/delete/{id}', [FirewallController::class, 'delete']);

        //BareMetal
        Route::get('BareMetal/home', [BareMetalController::class, 'home']);
        Route::get('BareMetal/add', [BareMetalController::class, 'Create']);
        Route::post('BareMetal/store', [BareMetalController::class, 'Store']);
        Route::get('BareMetal/edit/{id}', [BareMetalController::class, 'edit']);
        Route::post('BareMetal/update/{id}', [BareMetalController::class, 'update']);
        Route::get('BareMetal/delete/{id}', [BareMetalController::class, 'delete']);

        //CloudHosting
        Route::get('CloudHosting/home', [CloudHostingController::class, 'home']);
        Route::get('CloudHosting/add', [CloudHostingController::class, 'Create']);
        Route::post('CloudHosting/store', [CloudHostingController::class, 'Store']);
        Route::get('CloudHosting/edit/{id}', [CloudHostingController::class, 'edit']);
        Route::post('CloudHosting/update/{id}', [CloudHostingController::class, 'update']);
        Route::get('CloudHosting/delete/{id}', [CloudHostingController::class, 'delete']);
        Route::get('CloudHosting/EXPORTCSV', [CloudHostingController::class, 'EXPORTCSV']);

        //CloudServices
        Route::get('CloudServices/home', [CloudServicesController::class, 'home']);
        Route::get('CloudServices/add', [CloudServicesController::class, 'Create']);
        Route::post('CloudServices/store', [CloudServicesController::class, 'Store']);
        Route::get('CloudServices/edit/{id}', [CloudServicesController::class, 'edit']);
        Route::post('CloudServices/update/{id}', [CloudServicesController::class, 'update']);
        Route::get('CloudServices/delete/{id}', [CloudServicesController::class, 'delete']);
        Route::get('CloudServices/EXPORTCSV', [CloudServicesController::class, 'EXPORTCSV']);


        //DedicatedServer
        Route::get('DedicatedServer/home', [DedicatedServerController::class, 'home']);
        Route::get('DedicatedServer/add', [DedicatedServerController::class, 'Create']);
        Route::post('DedicatedServer/store', [DedicatedServerController::class, 'Store']);
        Route::get('DedicatedServer/edit/{id}', [DedicatedServerController::class, 'edit']);
        Route::post('DedicatedServer/update/{id}', [DedicatedServerController::class, 'update']);
        Route::get('DedicatedServer/delete/{id}', [DedicatedServerController::class, 'delete']);
        Route::get('DedicatedServer/EXPORTCSV', [DedicatedServerController::class, 'EXPORTCSV']);

        //AwsService
        Route::get('AwsService/home', [AwsServiceController::class, 'home']);
        Route::get('AwsService/add', [AwsServiceController::class, 'Create']);
        Route::post('AwsService/store', [AwsServiceController::class, 'Store']);
        Route::get('AwsService/edit/{id}', [AwsServiceController::class, 'edit']);
        Route::post('AwsService/update/{id}', [AwsServiceController::class, 'update']);
        Route::get('AwsService/delete/{id}', [AwsServiceController::class, 'delete']);
        Route::get('AwsService/EXPORTCSV', [AwsServiceController::class, 'EXPORTCSV']);

        //Azure
        Route::get('Azure/home', [AzureController::class, 'home']);
        Route::get('Azure/add', [AzureController::class, 'Create']);
        Route::post('Azure/store', [AzureController::class, 'Store']);
        Route::get('Azure/edit/{id}', [AzureController::class, 'edit']);
        Route::post('Azure/update/{id}', [AzureController::class, 'update']);
        Route::get('Azure/delete/{id}', [AzureController::class, 'delete']);
        Route::get('Azure/EXPORTCSV', [AzureController::class, 'EXPORTCSV']);

        //GoogleWorkSpace
        Route::get('GoogleWorkSpace/home', [GoogleWorkSpaceController::class, 'home']);
        Route::get('GoogleWorkSpace/add', [GoogleWorkSpaceController::class, 'Create']);
        Route::post('GoogleWorkSpace/store', [GoogleWorkSpaceController::class, 'Store']);
        Route::get('GoogleWorkSpace/edit/{id}', [GoogleWorkSpaceController::class, 'edit']);
        Route::post('GoogleWorkSpace/update/{id}', [GoogleWorkSpaceController::class, 'update']);
        Route::get('GoogleWorkSpace/delete/{id}', [GoogleWorkSpaceController::class, 'delete']);
        Route::get('GoogleWorkSpace/EXPORTCSV', [GoogleWorkSpaceController::class, 'EXPORTCSV']);

        //MicrosoftOffice365
        Route::get('MicrosoftOffice365/home', [MicrosoftOffice365Controller::class, 'home']);
        Route::get('MicrosoftOffice365/add', [MicrosoftOffice365Controller::class, 'Create']);
        Route::post('MicrosoftOffice365/store', [MicrosoftOffice365Controller::class, 'Store']);
        Route::get('MicrosoftOffice365/edit/{id}', [MicrosoftOffice365Controller::class, 'edit']);
        Route::post('MicrosoftOffice365/update/{id}', [MicrosoftOffice365Controller::class, 'update']);
        Route::get('MicrosoftOffice365/delete/{id}', [MicrosoftOffice365Controller::class, 'delete']);
        Route::get('MicrosoftOffice365/EXPORTCSV', [MicrosoftOffice365Controller::class, 'EXPORTCSV']);

        //OneTimeSetup
        Route::get('OneTimeSetup/home', [OneTimeSetupController::class, 'home']);
        Route::get('OneTimeSetup/add', [OneTimeSetupController::class, 'Create']);
        Route::post('OneTimeSetup/store', [OneTimeSetupController::class, 'Store']);
        Route::get('OneTimeSetup/edit/{id}', [OneTimeSetupController::class, 'edit']);
        Route::post('OneTimeSetup/update/{id}', [OneTimeSetupController::class, 'update']);
        Route::get('OneTimeSetup/delete/{id}', [OneTimeSetupController::class, 'delete']);
        Route::get('OneTimeSetup/EXPORTCSV', [OneTimeSetupController::class, 'EXPORTCSV']);

        //MonthelySetup
        Route::get('MonthelySetup/home', [MonthelySetupController::class, 'home']);
        Route::get('MonthelySetup/add', [MonthelySetupController::class, 'Create']);
        Route::post('MonthelySetup/store', [MonthelySetupController::class, 'Store']);
        Route::get('MonthelySetup/edit/{id}', [MonthelySetupController::class, 'edit']);
        Route::post('MonthelySetup/update/{id}', [MonthelySetupController::class, 'update']);
        Route::get('MonthelySetup/delete/{id}', [MonthelySetupController::class, 'delete']);
        Route::get('MonthelySetup/EXPORTCSV', [MonthelySetupController::class, 'EXPORTCSV']);

        //SSLCertificate
        Route::get('SSLCertificate/home', [SSLCertificateController::class, 'home']);
        Route::get('SSLCertificate/add', [SSLCertificateController::class, 'Create']);
        Route::post('SSLCertificate/store', [SSLCertificateController::class, 'Store']);
        Route::get('SSLCertificate/edit/{id}', [SSLCertificateController::class, 'edit']);
        Route::post('SSLCertificate/update/{id}', [SSLCertificateController::class, 'update']);
        Route::get('SSLCertificate/delete/{id}', [SSLCertificateController::class, 'delete']);
        Route::get('SSLCertificate/EXPORTCSV', [SSLCertificateController::class, 'EXPORTCSV']);


        //Antivirus
        Route::get('Antivirus/home', [AntivirusController::class, 'home']);
        Route::get('Antivirus/add', [AntivirusController::class, 'Create']);
        Route::post('Antivirus/store', [AntivirusController::class, 'Store']);
        Route::get('Antivirus/edit/{id}', [AntivirusController::class, 'edit']);
        Route::post('Antivirus/update/{id}', [AntivirusController::class, 'update']);
        Route::get('Antivirus/delete/{id}', [AntivirusController::class, 'delete']);
        Route::get('Antivirus/EXPORTCSV', [AntivirusController::class, 'EXPORTCSV']);

        //Licenses
        Route::get('Licenses/home', [LicensesController::class, 'home']);
        Route::get('Licenses/add', [LicensesController::class, 'Create']);
        Route::post('Licenses/store', [LicensesController::class, 'Store']);
        Route::get('Licenses/edit/{id}', [LicensesController::class, 'edit']);
        Route::post('Licenses/update/{id}', [LicensesController::class, 'update']);
        Route::get('Licenses/delete/{id}', [LicensesController::class, 'delete']);
        Route::get('Licenses/EXPORTCSV', [LicensesController::class, 'EXPORTCSV']);

        //Acronis
        Route::get('Acronis/home', [AcronisController::class, 'home']);
        Route::get('Acronis/add', [AcronisController::class, 'Create']);
        Route::post('Acronis/store', [AcronisController::class, 'Store']);
        Route::get('Acronis/edit/{id}', [AcronisController::class, 'edit']);
        Route::post('Acronis/update/{id}', [AcronisController::class, 'update']);
        Route::get('Acronis/delete/{id}', [AcronisController::class, 'delete']);
        Route::get('Acronis/EXPORTCSV', [AcronisController::class, 'EXPORTCSV']);

        //TsPlus
        Route::get('TsPlus/home', [TsPlusController::class, 'home']);
        Route::get('TsPlus/add', [TsPlusController::class, 'Create']);
        Route::post('TsPlus/store', [TsPlusController::class, 'Store']);
        Route::get('TsPlus/edit/{id}', [TsPlusController::class, 'edit']);
        Route::post('TsPlus/update/{id}', [TsPlusController::class, 'update']);
        Route::get('TsPlus/delete/{id}', [TsPlusController::class, 'delete']);
        Route::get('TsPlus/EXPORTCSV', [TsPlusController::class, 'EXPORTCSV']);

        //Other
        Route::get('Other/home', [OtherController::class, 'home']);
        Route::get('Other/add', [OtherController::class, 'Create']);
        Route::post('Other/store', [OtherController::class, 'Store']);
        Route::get('Other/edit/{id}', [OtherController::class, 'edit']);
        Route::post('Other/update/{id}', [OtherController::class, 'update']);
        Route::get('Other/delete/{id}', [OtherController::class, 'delete']);
        Route::get('Other/EXPORTCSV', [OtherController::class, 'EXPORTCSV']);

        //Ticket
        Route::get('Ticket/home', [TicketController::class, 'home']);
        Route::get('Ticket/overview', [TicketController::class, 'overview']);

        Route::get('Ticket/add', [TicketController::class, 'Create']);
        Route::post('Ticket/store', [TicketController::class, 'Store']);
        Route::get('Ticket/edit/{id}', [TicketController::class, 'edit']);
        Route::get('Ticket/view/{id}', [TicketController::class, 'view']);
        Route::any('Ticket/update/{id}', [TicketController::class, 'update']);
        Route::get('Ticket/delete/{id}', [TicketController::class, 'delete']);
        Route::get('Ticket/EXPORTCSV', [TicketController::class, 'EXPORTCSV']);
        Route::get('Ticket/ClientData', [TicketController::class, 'ClientData']);
        Route::post('Ticket/chatInsert', [TicketController::class, 'chatInsert']);
        Route::post('Ticket/markAsClosed', [TicketController::class, 'markAsClosed']);
        Route::get('Ticket/get_Ticket_yeardata', [TicketController::class, 'get_Ticket_yeardata']);

        // ServerMonitoringController
        Route::get('monitoring/server', [ServerMonitoringController::class, 'index']);
        Route::get('monitoring/service', [ServiceMonitoringController::class, 'index']);
        Route::get('monitoring/memory', [MemoryMonitoringController::class, 'index']);
        Route::get('monitoring/disk', [DiskMonitoringController::class, 'index']);
        Route::get('monitoring/network', [NetworkMonitoringController::class, 'index']);




        //Inventory
        Route::get('Inventory/home', [InventoryController::class, 'home']);
        Route::get('Inventory/add', [InventoryController::class, 'Create']);
        Route::post('Inventory/store', [InventoryController::class, 'Store']);
        Route::get('Inventory/edit/{id}', [InventoryController::class, 'edit']);
        Route::post('Inventory/update/{id}', [InventoryController::class, 'update']);
        Route::get('Inventory/delete/{id}', [InventoryController::class, 'delete']);
        Route::get('Inventory/EXPORTCSV', [InventoryController::class, 'EXPORTCSV']);


        //transaction
        Route::get('transaction/home', [TransactionController::class, 'home']);
        Route::get('transaction/add', [TransactionController::class, 'Create']);
        Route::post('transaction/store', [TransactionController::class, 'Store']);
        Route::get('transaction/edit/{id}', [TransactionController::class, 'edit']);
        Route::post('transaction/update/{id}', [TransactionController::class, 'update']);
        Route::get('transaction/delete/{id}', [TransactionController::class, 'delete']);
        Route::get('transaction/EXPORTCSV', [TransactionController::class, 'EXPORTCSV']);



        //Notification
        Route::get('notification/home', [NotificationController::class, 'home']);
        Route::get('notification/add', [NotificationController::class, 'Create']);
        Route::post('notification/store', [NotificationController::class, 'Store']);
        Route::get('notification/edit/{id}', [NotificationController::class, 'edit']);
        Route::post('notification/update/{id}', [NotificationController::class, 'update']);
        Route::get('notification/delete/{id}', [NotificationController::class, 'delete']);
        Route::get('notification/EXPORTCSV', [NotificationController::class, 'EXPORTCSV']);

        //Invoices
        Route::get('Invoices/home', [InvoicesController::class, 'home']);
        // Route::get('sendReminderMail', [InvoicesController::class, 'sendReminderMail']);
        // Route::get('sendOverdueMail', [InvoicesController::class, 'sendOverdueMail']);
        Route::get('Invoices/add', [InvoicesController::class, 'Create']);
        Route::get('Invoices/tds', [InvoicesController::class, 'showtds']);
        Route::get('Invoices/gst', [InvoicesController::class, 'showgst']);
        Route::post('Invoices/get_product_price', [InvoicesController::class, 'get_product_price']);
        Route::post('Invoices/get_project_details', [InvoicesController::class, 'get_project_details']);
        Route::get('Invoices/getClientDetails/{id}', [InvoicesController::class, 'getClientDetails']);
        Route::get('Invoices/getEmployeeDetails/{id}', [InvoicesController::class, 'getEmployeeDetails']);
        Route::post('Invoices/store', [InvoicesController::class, 'Store']);
        Route::get('Invoices/edit/{id}', [InvoicesController::class, 'edit']);
        Route::get('Invoices/view/{id}', [InvoicesController::class, 'view']);
        Route::get('Invoices/printView/{id}', [InvoicesController::class, 'printView']);
        Route::get('Invoices/downloadPDF', [InvoicesController::class, 'downloadPDF']);
        Route::post('Invoices/autopayinvoice', [InvoicesController::class, 'autopayinvoice']);
        Route::post('Invoices/update/{id}', [InvoicesController::class, 'update']);
        Route::get('Invoices/delete/{id}', [InvoicesController::class, 'delete']);
        Route::get('Invoices/EXPORTCSV', [InvoicesController::class, 'EXPORTCSV']);
        Route::post('Invoices/selectedCurrencyData', [InvoicesController::class, 'selectedCurrencyData']);
        Route::get('Invoices/get_selected_product_plan', [InvoicesController::class, 'get_selected_product_plan']);
        Route::get('Invoices/check_invoice_number', [InvoicesController::class, 'check_invoice_number']);
        Route::get('Invoices/paymentStatusUpdate', [InvoicesController::class, 'paymentStatusUpdate']);
        Route::get('getProductDetail', [InvoicesController::class, 'getProductDetail']);
        Route::get('getProduct', [InvoicesController::class, 'getProduct']);

        //ProjectCategory
        Route::get('ProjectCategory/home', [ProjectCategoryController::class, 'home']);
        Route::get('ProjectCategory/add', [ProjectCategoryController::class, 'Create']);
        Route::post('ProjectCategory/store', [ProjectCategoryController::class, 'Store']);
        Route::get('ProjectCategory/edit/{id}', [ProjectCategoryController::class, 'edit']);
        Route::post('ProjectCategory/update/{id}', [ProjectCategoryController::class, 'update']);
        Route::get('ProjectCategory/delete/{id}', [ProjectCategoryController::class, 'delete']);
        Route::get('ProjectCategory/EXPORTCSV', [ProjectCategoryController::class, 'EXPORTCSV']);


        //ProjectCategory
        Route::get('TaskCategory/home', [TaskCategoryController::class, 'home']);
        Route::get('TaskCategory/add', [TaskCategoryController::class, 'Create']);
        Route::post('TaskCategory/store', [TaskCategoryController::class, 'Store']);
        Route::get('TaskCategory/edit/{id}', [TaskCategoryController::class, 'edit']);
        Route::post('TaskCategory/update/{id}', [TaskCategoryController::class, 'update']);
        Route::get('TaskCategory/delete/{id}', [TaskCategoryController::class, 'delete']);
        Route::get('TaskCategory/EXPORTCSV', [TaskCategoryController::class, 'EXPORTCSV']);

        //Project
        Route::get('Project/home', [ProjectController::class, 'home']);
        Route::get('Project/add', [ProjectController::class, 'Create']);
        Route::get('Project/view/{id}', [ProjectController::class, 'view']);
        Route::post('Project/store', [ProjectController::class, 'Store']);
        Route::get('Project/edit/{id}', [ProjectController::class, 'edit']);
        Route::post('Project/update/{id}', [ProjectController::class, 'update']);
        Route::get('Project/delete/{id}', [ProjectController::class, 'delete']);
        Route::get('Project/EXPORTCSV', [ProjectController::class, 'EXPORTCSV']);
        Route::get('Project/UpdateStatus', [ProjectController::class, 'UpdateStatus']);


        //Task
        Route::get('Task/home', [TaskController::class, 'home']);
        Route::get('Task/add', [TaskController::class, 'Create']);
        Route::get('Task/GetTask', [TaskController::class, 'GetTask']);
        Route::post('Task/store', [TaskController::class, 'Store']);
        Route::get('Task/edit/{id}', [TaskController::class, 'edit']);
        Route::post('Task/update/{id}', [TaskController::class, 'update']);
        Route::get('Task/delete/{id}', [TaskController::class, 'delete']);
        Route::get('Task/EXPORTCSV', [TaskController::class, 'EXPORTCSV']);
        Route::get('Task/UpdateStatus', [TaskController::class, 'UpdateStatus']);
        Route::get('Task/StartTimer', [TaskController::class, 'StartTimer']);
        Route::get('Task/StopTimer', [TaskController::class, 'StopTimer']);
        Route::get('Task/checkStartTimer', [TaskController::class, 'checkStartTimer']);

        //TimeSheet
        Route::get('TimeSheet/home', [TimeSheetController::class, 'home']);
        Route::get('TimeSheet/add', [TimeSheetController::class, 'Create']);
        Route::post('TimeSheet/store', [TimeSheetController::class, 'Store']);
        Route::get('TimeSheet/edit/{id}', [TimeSheetController::class, 'edit']);
        Route::post('TimeSheet/update/{id}', [TimeSheetController::class, 'update']);
        Route::get('TimeSheet/delete/{id}', [TimeSheetController::class, 'delete']);
        Route::get('TimeSheet/EXPORTCSV', [TimeSheetController::class, 'EXPORTCSV']);
        Route::get('TimeSheet/UpdateStatus', [TimeSheetController::class, 'UpdateStatus']);

        //Holiday
        Route::get('Holiday/home', [HolidayController::class, 'home']);
        Route::get('Holiday/add', [HolidayController::class, 'Create']);
        Route::post('Holiday/store', [HolidayController::class, 'Store']);
        Route::get('Holiday/edit/{id}', [HolidayController::class, 'edit']);
        Route::post('Holiday/update/{id}', [HolidayController::class, 'update']);
        Route::get('Holiday/delete/{id}', [HolidayController::class, 'delete']);


        //Leave
        Route::get('Leave/home', [LeaveController::class, 'home']);
        Route::get('Leave/home2', [LeaveController::class, 'home2']);
        Route::get('Leave/add', [LeaveController::class, 'Create']);
        Route::post('Leave/store', [LeaveController::class, 'Store']);
        Route::get('Leave/edit/{id}', [LeaveController::class, 'edit']);
        Route::get('Leave/view/{id}', [LeaveController::class, 'views']);
        Route::post('Leave/update/{id}', [LeaveController::class, 'update']);
        Route::get('Leave/delete/{id}', [LeaveController::class, 'delete']);
        Route::get('Leave/Show_leaves_yeardata_single', [LeaveController::class, 'Show_leaves_yeardata_single']);
        Route::get('Leave/Show_leaves_yeardata', [LeaveController::class, 'Show_leaves_yeardata']);
        Route::POST('Leave/LeaveStatusUpdate', [LeaveController::class, 'LeaveStatusUpdate']);

        //LeavePolicies
        Route::get('LeavePolicies/home', [LeavePoliciesController::class, 'home']);
        Route::get('LeavePolicies/add', [LeavePoliciesController::class, 'Create']);
        Route::post('LeavePolicies/store', [LeavePoliciesController::class, 'Store']);
        Route::get('LeavePolicies/edit/{id}', [LeavePoliciesController::class, 'edit']);
        Route::get('LeavePolicies/view', [LeavePoliciesController::class, 'view']);
        Route::post('LeavePolicies/update/{id}', [LeavePoliciesController::class, 'update']);
        Route::get('LeavePolicies/delete/{id}', [LeavePoliciesController::class, 'delete']);


        //Employee
        Route::get('Employee/home', [EmployeeController::class, 'home']);
        Route::get('Employee/add', [EmployeeController::class, 'Create']);
        Route::post('Employee/store', [EmployeeController::class, 'Store']);
        Route::post('Employee/check-email', [EmployeeController::class, 'check_email']);
        Route::get('Employee/edit/{id}', [EmployeeController::class, 'edit']);
        Route::get('Employee/view/{id}', [EmployeeController::class, 'view']);
        Route::post('Employee/update/{id}', [EmployeeController::class, 'update']);
        Route::get('Employee/delete/{id}', [EmployeeController::class, 'delete']);
        Route::get('Employee/TabView', [EmployeeController::class, 'TabView']);
        Route::get('Employee/getEmployeeRole/{id}', [EmployeeController::class,'getEmployeeRole']);


        Route::get('Settings/home', [SettingController::class, 'home']);
        Route::get('Settings/smtp-details/{id}', [SettingController::class, 'smtpDetails']);
        Route::get('Settings/TabView', [SettingController::class, 'TabView']);
        Route::get('product/categoryWise', [SettingController::class, 'categoryWise']);
        Route::post('/updatePasswordDays', [SettingController::class, 'updatePasswordDays']);



        // email template settings

        Route::get('ETempleteSettings/home', [ETemplateSettingController::class, 'home']);
        Route::get('ETempleteSettings/TabView', [ETemplateSettingController::class, 'TabView']);
        Route::get('ETempleteSettings/categoryWise', [ETemplateSettingController::class, 'categoryWise']);

        //File
        Route::get('File/home', [FileController::class, 'home']);
        Route::get('File/add', [FileController::class, 'Create']);
        Route::post('File/store', [FileController::class, 'Store']);
        Route::get('File/edit/{id}', [FileController::class, 'edit']);
        Route::get('File/view', [FileController::class, 'view']);
        Route::post('File/update/{id}', [FileController::class, 'update']);
        Route::get('File/delete/{id}', [FileController::class, 'delete']);


        //CompanyLogin
        Route::get('CompanyLogin/home', [CompanyLoginController::class, 'home']);
        Route::get('CompanyLogin/add', [CompanyLoginController::class, 'Create']);
        Route::post('CompanyLogin/store', [CompanyLoginController::class, 'Store']);
        Route::get('CompanyLogin/edit/{id}', [CompanyLoginController::class, 'edit']);
        Route::post('CompanyLogin/update/{id}', [CompanyLoginController::class, 'update']);
        Route::get('CompanyLogin/delete/{id}', [CompanyLoginController::class, 'delete']);
        Route::get('CompanyLogin/EXPORTCSV', [CompanyLoginController::class, 'EXPORTCSV']);

        //Performance
        Route::get('Performance/home', [PerformanceController::class, 'home']);
        Route::get('Performance/home2', [PerformanceController::class, 'home2']);
        Route::get('Performance/add', [PerformanceController::class, 'Create']);
        Route::post('Performance/store', [PerformanceController::class, 'Store']);
        Route::get('Performance/view/{id}', [PerformanceController::class, 'view']);
        Route::get('Performance/view2/{id}', [PerformanceController::class, 'view2']);
        Route::get('Performance/get_Performance_yeardata', [PerformanceController::class, 'get_Performance_yeardata']);

        //PerformanceCategory
        Route::post('PerformanceCategory/store', [PerformanceCategoryController::class, 'Store']);
        Route::post('PerformanceCategory/edit', [PerformanceCategoryController::class, 'edit']);
        Route::post('PerformanceCategory/update', [PerformanceCategoryController::class, 'update']);
        Route::post('PerformanceCategory/delete', [PerformanceCategoryController::class, 'delete']);

        //PerformanceRating
        Route::post('PerformanceRating/store', [PerformanceRatingController::class, 'Store']);
        Route::post('PerformanceRating/edit', [PerformanceRatingController::class, 'edit']);
        Route::post('PerformanceRating/update', [PerformanceRatingController::class, 'update']);
        Route::post('PerformanceRating/delete', [PerformanceRatingController::class, 'delete']);

        //PerformanceSettings
        Route::get('PerformanceSettings/home', [PerformanceSettingsController::class, 'home']);
        Route::post('PerformanceSettings/update/{id}', [PerformanceSettingsController::class, 'update']);



        //PayRoll
        Route::get('PayRoll/TDS', [PayRollController::class, 'TDS']);
        Route::get('PayRoll/home', [PayRollController::class, 'home']);
        Route::get('PayRoll/add', [PayRollController::class, 'Create']);
        Route::get('PayRoll/edit', [PayRollController::class, 'edit']);
        Route::get('PayRoll/view/{id}', [PayRollController::class, 'view']);
        Route::get('PayRoll/home2', [PayRollController::class, 'home2']);
        Route::get('PayRoll/Salary', [PayRollController::class, 'Salary']);
        Route::get('PayRoll/Deduction', [PayRollController::class, 'Deduction']);
        Route::POST('PayRoll/update/{id}', [PayRollController::class, 'update']);
        Route::get('PayRoll/EXPORTCSV/', [PayRollController::class, 'EXPORTCSV']);
        Route::get('PayRoll/get_TdsData', [PayRollController::class, 'get_TdsData']);
        Route::POST('PayRoll/Rules/update/{id}', [PayRollController::class, 'RuleUpdate']);
        Route::get('PayRoll/GenerateSellary', [PayRollController::class, 'GenerateSellary']);
        Route::get('PayRoll/get_SallaryData', [PayRollController::class, 'get_SallaryData']);
        Route::get('PayRoll/getEmpPayroll', [PayRollController::class, 'getEmpPayroll']);
        Route::get('PayRoll/get_deductionData', [PayRollController::class, 'get_deductionData']);
        Route::get('PayRoll/SallarySlip/{id}', [PayRollController::class, 'SallarySlip']);

        //PayRollSetting
        Route::get('PayRollSetting/home', [PayRollSettingController::class, 'home']);
        Route::post('PayRollSetting/store', [PayRollSettingController::class, 'store']);
        Route::get('PayRollSetting/EmployeeData', [PayRollSettingController::class, 'EmployeeData']);
        Route::get('PayRollSetting/view/{id}', [PayRollSettingController::class, 'view']);
        Route::post('PayRollSetting/SettingApply/{id}', [PayRollSettingController::class, 'SettingApply']);
        Route::get('PayRollSetting/AutoGenerate', [PayRollSettingController::class, 'AutoGenerate']);

        //Calendar
        Route::get('Calendar/home', [CalendarController::class, 'home']);
        Route::POST('Calendar/store', [CalendarController::class, 'Store']);
        Route::GET('Calendar/fetch', [CalendarController::class, 'fetchData']);
        Route::POST('Calendar/update', [CalendarController::class, 'update']);
        Route::POST('Calendar/delete/{id}', [CalendarController::class, 'delete']);

        //LeaveType
        Route::post('LeaveType/store', [LeaveTypeController::class, 'Store']);
        Route::get('LeaveType/edit', [LeaveTypeController::class, 'edit']);
        Route::post('LeaveType/update/{id}', [LeaveTypeController::class, 'update']);
        Route::get('LeaveType/delete/{id}', [LeaveTypeController::class, 'delete']);


        //Role
        Route::get('Role/home', [RoleController::class, 'home']);
        Route::get('Role/add', [RoleController::class, 'Create']);
        Route::post('Role/store', [RoleController::class, 'Store']);
        Route::get('Role/view/{id}', [RoleController::class, 'view']);
        Route::get('Role/edit/{id}', [RoleController::class, 'edit']);
        Route::post('Role/update/{id}', [RoleController::class, 'update']);
        Route::get('Role/delete/{id}', [RoleController::class, 'delete']);



        //Product
        Route::get('Product/home', [ProductController::class, 'home']);
        Route::get('Product/add', [ProductController::class, 'Create']);
        Route::post('Product/store', [ProductController::class, 'Store']);
        Route::post('Product/storeAddOnProduct', [ProductController::class, 'storeAddOnProduct']);
        Route::get('ProductAddOn/delete/{id}', [ProductController::class, 'ProductAddOnDelete']);
        Route::get('Product/view/{id}', [ProductController::class, 'view']);
        Route::post('Product/update/{id}', [ProductController::class, 'update']);
        Route::get('Product/delete/{id}', [ProductController::class, 'delete']);

        Route::post('Product/updatenew/{id}', [ProductNewController::class, 'update']);
        Route::get('Product/edit/{id}', [ProductNewController::class, 'edit']);

        Route::get('Product/currency', [ProductNewController::class, 'currency']);
        Route::post('Product/store', [ProductNewController::class, 'Store']);

        //Category
        // Route::post('Category/store', [CategoryController::class, 'Store']);
        // Route::get('Category/edit', [CategoryController::class, 'edit']);
        // Route::post('Category/update/{id}', [CategoryController::class, 'update']);
        // Route::get('Category/delete/{id}', [CategoryController::class, 'delete']);

        Route::post('Category/store', [CategoryController::class, 'Store']);
        Route::get('Category/home', [CategoryController::class, 'home']);
        Route::get('Category/create', [CategoryController::class, 'create']);
        Route::get('Category/edit/{id}', [CategoryController::class, 'edit']);
        Route::get('Category/edits/{id}', [CategoryController::class, 'edits']);
        Route::post('Category/updates/{id}', [CategoryController::class, 'updates']);
        Route::post('Category/update/{id}', [CategoryController::class, 'update']);
        Route::get('Category/delete/{id}', [CategoryController::class, 'delete']);


        // os_category
        Route::post('os_category/store', [CategoryController::class, 'StoreOSCategory']);
        Route::get('os_category/edit/{id}', [CategoryController::class, 'editOSCategory']);
        Route::get('os_category/edits/{id}', [CategoryController::class, 'editOSCategory']);
        Route::post('os_category/updates/{id}', [CategoryController::class, 'updateOSCategory']);
        Route::post('os_category/update/{id}', [CategoryController::class, 'updateOSCategory']);
        Route::get('os_category/delete/{id}', [CategoryController::class, 'deleteOSCategory']);



        //PaymentMethod
        Route::get('PaymentMethod/home', [PaymentMethodController::class, 'home']);
        Route::get('PaymentMethod/add', [PaymentMethodController::class, 'Create']);
        Route::post('PaymentMethod/store', [PaymentMethodController::class, 'Store']);
        Route::get('PaymentMethod/view/{id}', [PaymentMethodController::class, 'view']);
        Route::get('PaymentMethod/edit/{id}', [PaymentMethodController::class, 'edit']);
        Route::post('PaymentMethod/update/{id}', [PaymentMethodController::class, 'update']);
        Route::get('PaymentMethod/delete/{id}', [PaymentMethodController::class, 'delete']);

        //Template
        Route::get('Template/home', [TemplateController::class, 'home']);
        Route::get('Template/add', [TemplateController::class, 'Create']);
        Route::post('Template/store', [TemplateController::class, 'Store']);
        Route::get('Template/view/{id}', [TemplateController::class, 'view']);
        Route::get('Template/edit/{id}', [TemplateController::class, 'edit']);
        Route::post('Template/update/{id}', [TemplateController::class, 'update']);
        Route::get('Template/delete/{id}', [TemplateController::class, 'delete']);
        Route::get('get-template/{id}', [TemplateController::class, 'getTemplate']);
        Route::get('templates/list', [TemplateController::class, 'list']);


        //Security
        Route::get('Security/home', [SecurityController::class, 'home']);
        Route::get('Security/add', [SecurityController::class, 'Create']);
        Route::post('Security/store', [SecurityController::class, 'Store']);
        Route::post('Security/confirm_password', [SecurityController::class, 'confirm_password']);
        Route::get('Security/view/{id}', [SecurityController::class, 'view']);
        Route::get('Security/edit/{id}', [SecurityController::class, 'edit']);
        Route::post('Security/update/{id}', [SecurityController::class, 'update']);
        Route::get('Security/delete/{id}', [SecurityController::class, 'delete']);


        //FileManagement
        Route::get('FileManagement/home', [FileManagementController::class, 'home']);
        Route::get('FileManagement/recent-files', [FileManagementController::class, 'recentFiles']);
        Route::get('FileManagement/work-history', [FileManagementController::class, 'workHistory']);

        Route::post('FileManagement/share-sub-folder', [FileManagementController::class, 'shareSubFolder']);

        Route::post('FileManagement/update-sub-folder', [FileManagementController::class, 'updateSubFolder']);


        Route::post('FileManagement/update-folder', [FileManagementController::class, 'updateFolder']);
        Route::post('FileManagement/share-folder', [FileManagementController::class, 'shareFolder']);
        Route::post('FileManagement/share-file', [FileManagementController::class, 'sharefile']);
        Route::post('FileManagement/store-folder', [FileManagementController::class, 'storeFolder']);
        Route::post('FileManagement/store-sub-folder', [FileManagementController::class, 'storeSubFolder']);
        Route::post('FileManagement/get-employees', [FileManagementController::class, 'getEmployeesByDepartment']);
        Route::get('FileManagement/get-department-emp/{id}', [FileManagementController::class, 'getEmployeesByDepartment']);
        Route::delete('FileManagement/delete-folder/{id}', [FileManagementController::class, 'deleteFolder'])->name('admin.delete-folder');
        Route::delete('FileManagement/delete-sub-folder/{id}', [FileManagementController::class, 'deleteSubFolder'])->name('admin.delete-sub-folder');
        Route::delete('FileManagement/delete-folder-files/{id}', [FileManagementController::class, 'deleteFolderFiles']);
        Route::get('FileManagement/folder-file-view/{id}', [FileManagementController::class, 'folderFileView']);
        Route::get('FileManagement/view-subfolder-files/{id}', [FileManagementController::class, 'viewSubFolderFiles'])->name('admin.view-subfolder-files');
        Route::get('FileManagement/view-folder-files/{id}', [FileManagementController::class, 'viewFolderFiles']);
        Route::get('FileManagement/view-all-files', [FileManagementController::class, 'getAllFiles']);
        Route::get('FileManagement/get-folder-files/{id}', [FileManagementController::class, 'getFolderFiles'])->name('admin.get-folder-files');
        Route::get('FileManagement/get-sub-folders', [FileManagementController::class, 'getSubFolders'])->name('admin.get-sub-folders');
        Route::get('FileManagement/folder-files/{id}', [FileManagementController::class, 'showFolderFiles'])->name('admin.folder-files');
        Route::post('FileManagement/store-file', [FileManagementController::class, 'storeFile']);
        Route::get('FileManagement/ShowUserList', [FileManagementController::class, 'show_user_list']);
        Route::get('FileManagement/ShowUserFileList/{id}/{section}', [FileManagementController::class, 'show_user_file_list']);
        Route::get('FileManagement/ShowUserFileList/pdf-viewer', [FileManagementController::class, 'pdf_viewer']);


        //Security
        Route::get('SecuritySettings/home', [SecuritySettingsController::class, 'home']);
        Route::get('SecuritySettings/add', [SecuritySettingsController::class, 'Create']);
        Route::post('SecuritySettings/store', [SecuritySettingsController::class, 'Store']);
        Route::get('SecuritySettings/view/{id}', [SecuritySettingsController::class, 'view']);
        Route::get('SecuritySettings/2fa/disable', [SecuritySettingsController::class, 'disable']);
        Route::post('match_password', [SecuritySettingsController::class, 'verify_password']);
        Route::post('2fa/enable', [SecuritySettingsController::class, 'enable']);
        Route::get('SecuritySettings/edit/{id}', [SecuritySettingsController::class, 'edit']);
        Route::post('SecuritySettings/update/{id}', [SecuritySettingsController::class, 'update']);
        Route::get('SecuritySettings/delete/{id}', [SecuritySettingsController::class, 'delete']);
        Route::post('SecuritySettings/confirm_password', [SecuritySettingsController::class, 'confirm_password']);
        Route::get('SecuritySettings/mail_setup', [SecuritySettingsController::class, 'mail_setup']);

        //MailSettings
        Route::get('MailSettings/home', [MailSettingsController::class, 'home']);
        Route::get('MailSettings/add', [MailSettingsController::class, 'Create']);
        Route::post('MailSettings/store', [MailSettingsController::class, 'Store']);
        Route::get('MailSettings/view/{id}', [MailSettingsController::class, 'view']);
        Route::get('MailSettings/edit/{id}', [MailSettingsController::class, 'edit']);
        Route::post('MailSettings/update/{id}', [MailSettingsController::class, 'update']);
        Route::get('MailSettings/delete/{id}', [MailSettingsController::class, 'delete']);
        Route::get('MailSettings/MailViaUpdate', [MailSettingsController::class, 'MailViaUpdate']);

        //InvoiceSettings
        Route::get('InvoiceSettings/home', [InvoiceSettingsController::class, 'home']);
        Route::get('InvoiceSettings/add', [InvoiceSettingsController::class, 'Create']);
        Route::post('InvoiceSettings/store', [InvoiceSettingsController::class, 'Store']);
        Route::get('InvoiceSettings/view/{id}', [InvoiceSettingsController::class, 'view']);
        Route::get('InvoiceSettings/edit/{id}', [InvoiceSettingsController::class, 'edit']);
        Route::post('InvoiceSettings/update/{id}', [InvoiceSettingsController::class, 'update']);
        Route::get('InvoiceSettings/delete/{id}', [InvoiceSettingsController::class, 'delete']);
        Route::get('InvoiceSettings/MailViaUpdate', [InvoiceSettingsController::class, 'MailViaUpdate']);

        //Template home
        Route::get('ETemplatesettings/InvoiceModule/add', [InvoiceSettingsController::class, 'InvoiceModuleETemplateadd']);
        Route::post('ETemplatesettings/InvoiceModule/store', [InvoiceSettingsController::class, 'InvoiceModuleETemplatestore']);
        Route::get('ETemplatesettings/QuotesModule/add', [InvoiceSettingsController::class, 'QuotesModuleETemplateadd']);
        Route::post('ETemplatesettings/QuotesModule/store', [InvoiceSettingsController::class, 'QuotesModuleETemplatestore']);
        Route::get('ETemplatesettings/TicketEmailSetting/add', [InvoiceSettingsController::class, 'TicketEmailSettingadd']);
        Route::post('ETemplatesettings/TicketEmailSetting/store', [InvoiceSettingsController::class, 'TicketEmailSettingstore']);
        Route::get('ETemplatesettings/ClientSettings/add', [InvoiceSettingsController::class, 'ClientSettingETemplateadd']);
        Route::post('ETemplatesettings/ClientSettings/store', [InvoiceSettingsController::class, 'ClientSettingETemplatestore']);

        Route::post('LoginRegisterModule/store/{id}', [ETemplateSettingController::class, 'LoginRegisterModuleStore']);
        Route::get('ETemplatesettings/LoginRegisterModule/home/{id}', [InvoiceSettingsController::class, 'LoginRegisterModuleETemplate']);
        Route::get('ETemplatesettings/LoginRegisterModule/add', [InvoiceSettingsController::class, 'LoginRegisterModuleETemplateadd']);
        Route::post('ETemplatesettings/LoginRegisterModule/store', [InvoiceSettingsController::class, 'LoginRegisterModuleETemplatestore']);
        Route::get('ETemplatesettings/InOfficeModule/add', [InvoiceSettingsController::class, 'InOfficeModuleETemplateadd']);
        Route::post('ETemplatesettings/InOfficeModule/store', [InvoiceSettingsController::class, 'InOfficeModuleETemplatestore']);
        Route::get('ETemplatesettings/InOfficeModule/home/{id}', [InvoiceSettingsController::class, 'InOfficeModuleETemplate']);
        Route::post('InOfficeModule/store/{id}', [ETemplateSettingController::class, 'InOfficeModuleStore']);


        Route::get('ETemplatesettings/InvoiceModule/home/{id}', [InvoiceSettingsController::class, 'InvoiceModuleETemplate']);
        Route::get('ETemplatesettings/QuotesModule/home/{id}', [InvoiceSettingsController::class, 'QuotesModuleETemplate']);
        Route::get('ETemplatesettings/TicketEmailSetting/home/{id}', [InvoiceSettingsController::class, 'TicketEmailSettingETemplate']);
        Route::get('ETemplatesettings/ClientSettings/home/{id}', [InvoiceSettingsController::class, 'ClientSettingETemplate']);
        Route::get('ETemplatesettings/OtherModule/home/{id}', [InvoiceSettingsController::class, 'OtherModuleETemplate']);
        Route::get('ETemplatesettings/TicketEmailSetting/home/{id}', [InvoiceSettingsController::class, 'TicketEmailSettingETemplate']);


        //Template Store
        Route::post('InvoiceModule/store/{id}', [ETemplateSettingController::class, 'InvoiceModuleStore']);
        Route::post('QuotesModule/store/{id}', [ETemplateSettingController::class, 'QuotesModuleStore']);
        Route::post('TicketModule/store/{id}', [ETemplateSettingController::class, 'TicketModuleStore']);
        Route::post('OtherModule/store/{id}', [ETemplateSettingController::class, 'OtherModuleStore']);
        Route::post('ClientModule/store/{id}', [ETemplateSettingController::class, 'ClientModuleStore']);

        Route::get('InvoiceModule/edit/{id}', [ETemplateSettingController::class, 'edit']);
        Route::post('InvoiceModule/update/{id}', [ETemplateSettingController::class, 'update']);
        Route::get('InvoiceModule/delete/{id}', [ETemplateSettingController::class, 'delete']);



        //ProfileSettings
        Route::get('ProfileSettings/home', [ProfileSettingsController::class, 'home']);
        Route::post('ProfileSettings/store', [ProfileSettingsController::class, 'Store']);

        //LeaveSettings
        Route::get('LeaveSettings/home', [LeaveSettingsController::class, 'home']);
        Route::post('LeaveSettings/store', [LeaveSettingsController::class, 'Store']);

        //ModuleSettings
        Route::get('ModuleSettings/home', [ModuleSettingsController::class, 'home']);
        Route::post('ModuleSettings/store', [ModuleSettingsController::class, 'Store']);
        Route::post('ModuleSettings/updateModuleStatus', [ModuleSettingsController::class, 'updateModuleStatus']);

        //LeadSettings
        Route::get('LeadSettings/home', [LeadSettingsController::class, 'home']);
        Route::post('LeadSettings/store', [LeadSettingsController::class, 'Store']);
        Route::post('LeadSettings/updateModuleStatus', [LeadSettingsController::class, 'updateModuleStatus']);
        Route::get('LeadSettings/VINETab', [LeadSettingsController::class, 'TabView']);
        Route::get('LeadSettings/LeadSource/add', [LeadSettingsController::class, 'createLeadSource']);
        Route::post('LeadSettings/LeadSource/store', [LeadSettingsController::class, 'storeLeadSource']);
        Route::get('LeadSettings/LeadSource/edit', [LeadSettingsController::class, 'editLeadSource']);
        Route::post('LeadSettings/LeadSource/update', [LeadSettingsController::class, 'updateLeadSource']);
        Route::get('LeadSettings/LeadSource/delete/{id}', [LeadSettingsController::class, 'deleteLeadSource']);
        Route::post('LeadSettings/LeadStatus/store', [LeadSettingsController::class, 'storeLeadStatus']);
        Route::get('LeadSettings/LeadStatus/edit', [LeadSettingsController::class, 'editLeadStatus']);
        Route::post('LeadSettings/LeadStatus/update', [LeadSettingsController::class, 'updateLeadStatus']);
        Route::get('LeadSettings/LeadStatus/delete/{id}', [LeadSettingsController::class, 'deleteLeadStatus']);
        Route::post('LeadSettings/LeadStatus/updateIsDefault', [LeadSettingsController::class, 'updateIsDefault']);

        Route::post('LeadSettings/leadCategory/store', [LeadSettingsController::class, 'storeleadCategory']);
        Route::get('LeadSettings/leadCategory/edit', [LeadSettingsController::class, 'editleadCategory']);
        Route::post('LeadSettings/leadCategory/update', [LeadSettingsController::class, 'updateleadCategory']);
        Route::get('LeadSettings/leadCategory/delete/{id}', [LeadSettingsController::class, 'deleteleadCategory']);


        //TaxSettings
        Route::get('TaxSettings/home', [TaxSettingsController::class, 'home']);
        Route::get('TaxSettings/add', [TaxSettingsController::class, 'Create']);
        Route::post('TaxSettings/store', [TaxSettingsController::class, 'Store']);
        Route::get('TaxSettings/view/{id}', [TaxSettingsController::class, 'view']);
        Route::get('TaxSettings/edit/{id}', [TaxSettingsController::class, 'edit']);
        Route::post('TaxSettings/update/{id}', [TaxSettingsController::class, 'update']);
        Route::get('TaxSettings/delete/{id}', [TaxSettingsController::class, 'delete']);


        //TaxSettings
        Route::get('CompanySettings/home', [CompanySettingsController::class, 'home']);
        Route::get('CompanySettings/add', [CompanySettingsController::class, 'Create']);
        Route::get('CompanySettings/getStates/{id}', [CompanySettingsController::class, 'getStates']);
        Route::get('CompanySettings/getCity/{id}', [CompanySettingsController::class, 'getCity']);
        Route::post('CompanySettings/store', [CompanySettingsController::class, 'Store']);
        Route::get('CompanySettings/view/{id}', [CompanySettingsController::class, 'view']);
        Route::get('CompanySettings/edit/{id}', [CompanySettingsController::class, 'edit']);
        Route::post('CompanySettings/update/{id}', [CompanySettingsController::class, 'update']);
        Route::get('CompanySettings/delete/{id}', [CompanySettingsController::class, 'delete']);


        //CurrencySettings
        Route::get('CurrencySettings/home', [CurrencyController::class, 'home']);
        Route::get('CurrencySettings/add', [CurrencyController::class, 'Create']);
        Route::post('CurrencySettings/store', [CurrencyController::class, 'Store']);
        Route::get('CurrencySettings/view/{id}', [CurrencyController::class, 'view']);
        Route::get('CurrencySettings/edit/{id}', [CurrencyController::class, 'edit']);
        Route::post('CurrencySettings/update/{id}', [CurrencyController::class, 'update']);
        Route::get('CurrencySettings/delete/{id}', [CurrencyController::class, 'delete']);


        //BuisnessAddress
        Route::get('BuisnessAddress/home', [BuisnessAddressController::class, 'home']);
        Route::get('BuisnessAddress/add', [BuisnessAddressController::class, 'Create']);
        Route::post('BuisnessAddress/store', [BuisnessAddressController::class, 'Store']);
        Route::get('BuisnessAddress/view/{id}', [BuisnessAddressController::class, 'view']);
        Route::get('BuisnessAddress/edit/{id}', [BuisnessAddressController::class, 'edit']);
        Route::post('BuisnessAddress/update/{id}', [BuisnessAddressController::class, 'update']);
        Route::get('BuisnessAddress/delete/{id}', [BuisnessAddressController::class, 'delete']);

        //CustomLinkSettings
        Route::get('CustomLinkSettings/home', [CustomLinkSettingsController::class, 'home']);
        Route::get('CustomLinkSettings/add', [CustomLinkSettingsController::class, 'Create']);
        Route::post('CustomLinkSettings/store', [CustomLinkSettingsController::class, 'Store']);
        Route::get('CustomLinkSettings/view/{id}', [CustomLinkSettingsController::class, 'view']);
        Route::get('CustomLinkSettings/edit/{id}', [CustomLinkSettingsController::class, 'edit']);
        Route::post('CustomLinkSettings/update/{id}', [CustomLinkSettingsController::class, 'update']);
        Route::get('CustomLinkSettings/delete/{id}', [CustomLinkSettingsController::class, 'delete']);

        //AppSettings
        Route::get('AppSettings/home', [AppSettingsController::class, 'home']);
        Route::get('AppSettings/add', [AppSettingsController::class, 'Create']);
        Route::post('AppSettings/store', [AppSettingsController::class, 'Store']);
        Route::get('AppSettings/view/{id}', [AppSettingsController::class, 'view']);
        Route::get('AppSettings/edit/{id}', [AppSettingsController::class, 'edit']);
        Route::post('AppSettings/update/{id}', [AppSettingsController::class, 'update']);
        Route::get('AppSettings/delete/{id}', [AppSettingsController::class, 'delete']);

        //TicketEmailSetting
        Route::get('TicketEmailSetting/home', [TicketEmailSettingController::class, 'home']);
        Route::post('TicketEmailSetting/update/{id}', [TicketEmailSettingController::class, 'update']);

        //StorageSettings
        Route::get('StorageSettings/home', [StorageSettingsController::class, 'home']);
        Route::post('StorageSettings/store', [StorageSettingsController::class, 'store']);


        //GrammarlyAPISettings
        Route::get('GrammarlyAPISettings/home', [GrammarlyAPISettingsController::class, 'home']);
        Route::get('GrammarlyAPISettings/add', [GrammarlyAPISettingsController::class, 'Create']);
        Route::post('GrammarlyAPISettings/store', [GrammarlyAPISettingsController::class, 'Store']);
        Route::get('GrammarlyAPISettings/view/{id}', [GrammarlyAPISettingsController::class, 'view']);
        Route::get('GrammarlyAPISettings/edit/{id}', [GrammarlyAPISettingsController::class, 'edit']);
        Route::post('GrammarlyAPISettings/update/{id}', [GrammarlyAPISettingsController::class, 'update']);
        Route::get('GrammarlyAPISettings/delete/{id}', [GrammarlyAPISettingsController::class, 'delete']);


        //LogActivity
        Route::get('LogActivity/home', [LogActivityController::class, 'home']);
        Route::get('LogActivity/ticket', [LogActivityController::class, 'ticket']);
        Route::get('LogActivity/invoice', [LogActivityController::class, 'invoice']);
        Route::get('LogActivity/lead', [LogActivityController::class, 'lead']);

        //Notice
        Route::get('Notice/home', [NoticeController::class, 'home']);
        Route::get('Notice/showNotice', [NoticeController::class, 'showNotice']);
        Route::get('Notice/add', [NoticeController::class, 'Create']);
        Route::post('Notice/store', [NoticeController::class, 'Store']);
        Route::get('Notice/view/{id}', [NoticeController::class, 'view']);
        Route::get('Notice/edit/{id}', [NoticeController::class, 'edit']);
        Route::post('Notice/update/{id}', [NoticeController::class, 'update']);
        Route::get('Notice/delete/{id}', [NoticeController::class, 'delete']);

        Route::get('logNotification', [AdminController::class, 'logNotification']);
        Route::get('logout', [AdminController::class, 'logout']);

    });
     //end ip validated middleware
// });

Route::post('user/2fas/enable', [UMyProfileController::class, 'enable']);

Route::middleware(['auth', 'user'])->prefix('user')->group(function () {

    //UBalancesheet
    Route::get('balancesheet/home', [UBalancesheetController::class, 'index']);
    //UService
    Route::get('services/home', [UServiceController::class, 'index']);
    //UTransaction
    Route::get('transaction/home', [UTransactionController::class, 'index']);
    Route::get('UTransaction/downloadPDF', [UTransactionController::class, 'downloadPDF']);





    //Dashboard
    Route::get('dashboard', [UDashboardController::class, 'index']);
    Route::post('getServiceData', [UDashboardController::class, 'getServiceData']);
    Route::get('get-related-data/{id}', [UDashboardController::class, 'getRelatedData']);
    Route::get('get-related-datas/add-cart', [UDashboardController::class, 'add_to_cart']);
    Route::get('get-billing-cycles/{product_id}/{currencyId}', [UDashboardController::class, 'getBillingCycles']);
    Route::post('get-related-datas/submit_cart_order', [UDashboardController::class, 'submit_cart_order']);
    Route::get('order', [OrderController::class, 'home']);
    Route::any('order/update', [OrderController::class, 'update']);
    Route::get('order/delete', [OrderController::class, 'delete']);
    Route::get('order/removeProduct/{id}', [OrderController::class, 'removeProduct']);
    Route::get('order/removeAddons/{id}', [OrderController::class, 'removeAddons']);
    Route::get('order/removeOsOrder/{id}', [OrderController::class, 'removeOsOrder']);
    Route::get('order/view/{id}', [OrderController::class, 'view']);
    Route::post('order/addOrder', [OrderController::class, 'addOrder']);
    Route::post('order/addCart', [OrderController::class, 'addCart']);
    Route::get('order/cart', [OrderController::class, 'cart']);
    Route::post('order/addTdsRemarkBeforePay', [OrderController::class, 'addTdsRemarkBeforePay']);
    Route::post('order/getInvoiceData', [OrderController::class, 'getInvoiceData']);
    Route::post('order/updateOrderPayment', [OrderController::class, 'updateOrderPayment']);
    Route::get('order/checkOrderAlreadyExit', [OrderController::class, 'checkOrderAlreadyExit']);
    Route::get('order/home', [OrderController::class, 'home']);
    ////user ticket
    Route::get('ticket/create', [UTicketController::class, 'create']);
    Route::get('ticket/edit/{id}', [TicketController::class, 'edit']);
    Route::post('ticket/update/{id}', [TicketController::class, 'update']);
    Route::get('ticket/delete/{id}', [TicketController::class, 'delete']);
    Route::get('ticket/view', [UTicketController::class, 'view']);
    Route::post('ticket/store', [UTicketController::class, 'store']);
    Route::post('Ticket/chatInsert', [UTicketController::class, 'chatInsert']);
    //UMyProfile
    Route::get('/MyProfile', [UMyProfileController::class, 'index']);
    Route::get('/MyProfile/edit', [UMyProfileController::class, 'edit']);
    Route::post('/MyProfile/update', [UMyProfileController::class, 'update']);
    Route::get('Credit/store', [UMyProfileController::class, 'creditStore']);
    Route::post('MyProfile/getstateData', [UMyProfileController::class, 'Get_StateData']);
    Route::post('MyProfile/getcityData', [UMyProfileController::class, 'Get_CityData']);
    Route::post('MyProfile/changePassword/{id}', [UMyProfileController::class, 'changePassword']);
    Route::post('match_password', [UMyProfileController::class, 'verify_password']);

    //show user SERVICES UserServicesController
    Route::get('getServicesIdWise/{id}', [UserServicesController::class, 'getServicesIdWise']);
    Route::post('cancel-subscription/{id}', [UserServicesController::class, 'cancelSubscription']);

    Route::get('userInvoice', [UMyProfileController::class, 'userInvoice']);
    Route::get('userInvoiceView/{id}', [UMyProfileController::class, 'userInvoiceView']);
    Route::get('userInvoice/downloadPDF', [UMyProfileController::class, 'downloadPDF']);
    Route::get('Invoices/paymentStatusUpdate', [UMyProfileController::class, 'paymentStatusUpdate']);
    Route::get('userTicket', [UMyProfileController::class, 'userTicket']);
    Route::get('userLogActivity', [UMyProfileController::class, 'userLogActivity']);
    Route::get('Invoices/downloadPDF', [UMyProfileController::class, 'downloadPDF']);
    //UQuotes
    Route::get('Quotes', [UQuotesController::class, 'home']);
    Route::post('Quotes/update', [UQuotesController::class, 'update']);
    Route::get('Quotes/view/{id}', [UQuotesController::class, 'view']);
    Route::post('Quotes/StatuPdate', [UQuotesController::class, 'StatuPdate']);

    Route::get('Quotes/printView/{id}', [UQuotesController::class, 'printView']);
    Route::get('Quotes/downloadPDF/{id}', [UQuotesController::class, 'downloadPDF']);


        //Notification
    Route::get('notification/home', [UNotificationController::class, 'home']);
    Route::get('notification/add', [UNotificationController::class, 'Create']);
    Route::post('notification/store', [UNotificationController::class, 'Store']);
    Route::get('notification/edit/{id}', [UNotificationController::class, 'edit']);
    Route::post('notification/update/{id}', [UNotificationController::class, 'update']);
    Route::get('notification/delete/{id}', [UNotificationController::class, 'delete']);
    Route::get('notification/EXPORTCSV', [UNotificationController::class, 'EXPORTCSV']);

    Route::get('Quotes/razorpay-payment', [URazorpayPaymentController::class, 'index'])->name('razorpay.payment.index');
    Route::post('Quotes/razorpay-payment', [URazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');

    Route::get('logout', [UserController::class, 'logout']);
});

//Employee
Route::post('employee_Login', [EAdminController::class, 'Login']);
Route::middleware(['auth', 'Employee'])->prefix('Employee')->group(function () {

        //EMyProfile
    Route::get('/MyProfile', [EMyProfileController::class, 'index']);
    Route::get('/MyProfile/edit', [EMyProfileController::class, 'edit']);
    Route::post('/MyProfile/update', [EMyProfileController::class, 'update']);
    Route::post('MyProfile/getstateData', [EMyProfileController::class, 'Get_StateData']);
    Route::post('MyProfile/getcityData', [EMyProfileController::class, 'Get_CityData']);
    Route::post('MyProfile/changePassword', [EMyProfileController::class, 'changePassword']);
    Route::get('MyProfile/TabView', [EMyProfileController::class, 'TabView']);

        //Dashboard
    Route::get('dashboard', [EDashboardController::class, 'index']);
    Route::get('Advanced', [EDashboardController::class, 'Advanced']);
    Route::get('ClockStatusUpdate', [EDashboardController::class, 'ClockStatusUpdate']);

        //Client
    Route::get('Client/home', [EClientController::class, 'home']);
    Route::get('Client/add', [EClientController::class, 'Create']);
    Route::post('Client/store', [EClientController::class, 'Store']);
    Route::post('Client/getstateData', [EClientController::class, 'Get_StateData']);
    Route::post('Client/getcityData', [EClientController::class, 'Get_CityData']);
    Route::get('Client/view/{id}', [EClientController::class, 'view']);
    Route::get('Client/edit/{id}', [EClientController::class, 'edit']);
    Route::post('Client/update/{id}', [EClientController::class, 'update']);
    Route::get('Client/delete/{id}', [EClientController::class, 'delete']);
    Route::post('Client/check-gst-number', [EClientController::class, 'checkGstNumber']);

    Route::post('Client/changePassword/{id}', [EClientController::class, 'changePassword']);

        //Vendor
    Route::get('Vendor/home', [EVendorController::class, 'home']);
    Route::get('Vendor/add', [EVendorController::class, 'Create']);
    Route::post('Vendor/store', [EVendorController::class, 'Store']);
    Route::post('Vendor/getstateData', [EVendorController::class, 'Get_StateData']);
    Route::post('Vendor/getcityData', [EVendorController::class, 'Get_CityData']);
    Route::get('Vendor/view/{id}', [EVendorController::class, 'view']);
    Route::get('Vendor/edit/{id}', [EVendorController::class, 'edit']);
    Route::post('Vendor/update/{id}', [EVendorController::class, 'update']);
    Route::get('Vendor/delete/{id}', [EVendorController::class, 'delete']);

        //Leads
    Route::get('Leads/home', [ELeadsController::class, 'home']);
    Route::get('Leads/add', [ELeadsController::class, 'Create']);
    Route::post('Leads/store', [ELeadsController::class, 'Store']);
    Route::post('Leads/getstateData', [ELeadsController::class, 'Get_StateData']);
    Route::post('Leads/getcityData', [ELeadsController::class, 'Get_CityData']);
    Route::get('Leads/view/{id}', [ELeadsController::class, 'view']);
    Route::get('Leads/edit/{id}', [ELeadsController::class, 'edit']);
    Route::post('Leads/update/{id}', [ELeadsController::class, 'update']);
    Route::get('Leads/delete/{id}', [ELeadsController::class, 'delete']);
    Route::get('Leads/get_leads_yeardata', [ELeadsController::class, 'get_leads_yeardata']);
    Route::get('Leads/getleadsYearfilterdata', [ELeadsController::class, 'getleadsYearfilterdata']);
    Route::get('Leads/get_follow_up_type', [ELeadsController::class, 'get_follow_up_type']);
    Route::get('Leads/LeadAssignUpdate', [ELeadsController::class, 'LeadAssignUpdate']);
    Route::get('Leads/ShowLeads', [ELeadsController::class, 'ShowLeads']);
    Route::get('Leads/ShowFollowUps', [ELeadsController::class, 'ShowFollowUp']);
    Route::post('Leads/LeadNotesUpdate', [ELeadsController::class, 'LeadNotesUpdate']);
    Route::get('recent_follow_ups', [ELeadsController::class, 'recent_follow_ups']);


    Route::post('Leads/File/store', [ELeadFileController::class, 'Store']);
    Route::get('Leads/File/delete/{id}/{leads_id}', [ELeadFileController::class, 'delete']);

    Route::post('Leads/LeadNotesUpdate', [ELeadsController::class, 'LeadNotesUpdate']);
    Route::get('recent_follow_ups', [ELeadsController::class, 'recent_follow_ups']);
        //LeadsFollowup
    Route::get('LeadsFollowup/home', [ELeadsFollowupController::class, 'home']);
    Route::get('LeadsFollowup/add', [ELeadsFollowupController::class, 'Create']);
    Route::post('LeadsFollowup/store', [ELeadsFollowupController::class, 'Store']);
    Route::get('LeadsFollowup/edit', [ELeadsFollowupController::class, 'edit']);
    Route::post('LeadsFollowup/update/{id}', [ELeadsFollowupController::class, 'update']);
    Route::get('LeadsFollowup/delete/{id}', [ELeadsFollowupController::class, 'delete']);

        //Quotes
    Route::get('Quotes/home', [EQuotesController::class, 'home']);
    Route::get('Quotes/add', [EQuotesController::class, 'Create']);
    Route::post('Quotes/store', [EQuotesController::class, 'Store']);
    Route::GET('Quotes/get_Goal_data', [EQuotesController::class, 'get_Goal_data']);
    Route::GET('Quotes/get_productdata', [EQuotesController::class, 'get_productdata']);
    Route::GET('Quotes/get_product_addon', [EQuotesController::class, 'get_product_addon']);
    Route::get('Quotes/view/{id}', [EQuotesController::class, 'view']);
    Route::get('Quotes/edit/{id}', [EQuotesController::class, 'edit']);
    Route::post('Quotes/update/{id}', [EQuotesController::class, 'update']);
    Route::get('Quotes/delete/{id}', [EQuotesController::class, 'delete']);
    Route::get('Quotes/EXPORTCSV', [EQuotesController::class, 'EXPORTCSV']);
    Route::GET('Quotes/get_Goal_data', [EQuotesController::class, 'get_Goal_data']);
    Route::GET('Quotes/get_productdata', [EQuotesController::class, 'get_productdata']);
    Route::GET('Quotes/get_product_addon', [EQuotesController::class, 'get_product_addon']);
    Route::GET('Quotes/get_categoryProduct', [EQuotesController::class, 'get_categoryProduct']);
    Route::get('Quotes/downloadPDF/{id}', [EQuotesController::class, 'downloadPDF']);
    Route::get('Quotes/downloadPDF', [EQuotesController::class, 'downloadPDF']);
    Route::get('getUserDetails', [EQuotesController::class, 'getUserDetails']);
    Route::get('Quotes/MakeQuotesInvoice/{id}', [EQuotesController::class, 'MakeQuotesInvoice']);
    Route::post('Quotes/changeQuotesStatus', [EQuotesController::class, 'changeQuotesStatus']);
    Route::get('Quotes/SendQuotes/{id}', [EQuotesController::class, 'SendQuotes']);



        //MassMail
    Route::get('MassMail/home', [EMassMailController::class, 'home']);
    Route::get('MassMail/add', [EMassMailController::class, 'Create']);
    Route::post('MassMail/store', [EMassMailController::class, 'Store']);
    Route::get('MassMail/Edit', [EMassMailController::class, 'Edit']);
    Route::post('MassMail/update/{id}', [EMassMailController::class, 'update']);
    Route::get('MassMail/Delete', [EMassMailController::class, 'Delete']);
    Route::get('MassMail/Trash', [EMassMailController::class, 'Trash']);
    Route::get('MassMail/SentMails', [EMassMailController::class, 'SentMails']);
    Route::get('MassMail/Show', [EMassMailController::class, 'Show']);
    Route::get('MassMail/DraftMails', [EMassMailController::class, 'DraftMails']);
    Route::get('MassMail/StarMails', [EMassMailController::class, 'StarMails']);
    Route::get('MassMail/StarUpdate', [EMassMailController::class, 'StarUpdate']);
    Route::get('MassMail/Restore', [EMassMailController::class, 'Restore']);
    Route::get('MassMail/ForceDelete', [EMassMailController::class, 'ForceDelete']);
    Route::get('MassMail/SendM', [EMassMailController::class, 'SendM']);
    Route::get('MassMail/Schedule', [EMassMailController::class, 'Schedule']);
    Route::get('MassMail/LoadMore', [EMassMailController::class, 'LoadMore']);


        //SpecialOffers
    Route::get('SpecialOffers/home', [ESpecialOffersController::class, 'home']);
    Route::get('SpecialOffers/add', [ESpecialOffersController::class, 'Create']);
    Route::post('SpecialOffers/store', [ESpecialOffersController::class, 'Store']);
    Route::get('SpecialOffers/edit/{id}', [ESpecialOffersController::class, 'edit']);
    Route::post('SpecialOffers/update/{id}', [ESpecialOffersController::class, 'update']);
    Route::get('SpecialOffers/delete/{id}', [ESpecialOffersController::class, 'delete']);


        //Goal
    Route::get('Goal/home', [EGoalController::class, 'home']);
    Route::get('Goal/add', [EGoalController::class, 'Create']);
    Route::post('Goal/store', [EGoalController::class, 'Store']);
    Route::get('Goal/get_Goal_data', [EGoalController::class, 'get_Goal_data']);
    Route::get('Goal/edit/{id}', [EGoalController::class, 'edit']);
    Route::post('Goal/update/{id}', [EGoalController::class, 'update']);
    Route::get('Goal/delete/{id}', [EGoalController::class, 'delete']);


    Route::get('Goal/get_Goal_data', [EGoalController::class, 'get_Goal_data']);
    Route::get('Goal/view/{id}/{Empid}', [EGoalController::class, 'view']);
    Route::get('Goal/editView/{id}/{Empid}', [EGoalController::class, 'editView']);
    Route::get('Goal/get_Goal_data_date_wise', [EGoalController::class, 'getGoalDataDateWise']);
    Route::get('Goal/FromToDate', [EGoalController::class, 'FromToDate']);

        //Department
    Route::get('Department/home', [EDepartmentController::class, 'home']);
    Route::get('Department/add', [EDepartmentController::class, 'Create']);
    Route::post('Department/store', [EDepartmentController::class, 'Store']);
    Route::get('Department/edit/{id}', [EDepartmentController::class, 'edit']);
    Route::post('Department/update/{id}', [EDepartmentController::class, 'update']);
    Route::get('Department/delete/{id}', [EDepartmentController::class, 'delete']);

        //JobRole
    Route::get('JobRole/home', [EJobRoleController::class, 'home']);
    Route::get('JobRole/add', [EJobRoleController::class, 'Create']);
    Route::post('JobRole/store', [EJobRoleController::class, 'Store']);
    Route::get('JobRole/edit/{id}', [EJobRoleController::class, 'edit']);
    Route::post('JobRole/update/{id}', [EJobRoleController::class, 'update']);
    Route::get('JobRole/delete/{id}', [EJobRoleController::class, 'delete']);

        //TimeShift
    Route::get('TimeShift/home', [ETimeShiftController::class, 'home']);
    Route::get('TimeShift/add', [ETimeShiftController::class, 'Create']);
    Route::post('TimeShift/store', [ETimeShiftController::class, 'Store']);
    Route::get('TimeShift/edit/{id}', [ETimeShiftController::class, 'edit']);
    Route::post('TimeShift/update/{id}', [ETimeShiftController::class, 'update']);
    Route::get('TimeShift/delete/{id}', [ETimeShiftController::class, 'delete']);
    Route::get('TimeShift/roaster', [ETimeShiftController::class, 'roaster']);
        //Attendence
    Route::get('Attendence/home', [EAttendenceController::class, 'home']);
    Route::get('Attendence/add', [EAttendenceController::class, 'Create']);
    Route::post('Attendence/store', [EAttendenceController::class, 'Store']);
    Route::get('Attendence/edit/{id}', [EAttendenceController::class, 'edit']);
    Route::get('Attendence/View/{id}', [EAttendenceController::class, 'View']);
    Route::post('Attendence/update/{id}', [EAttendenceController::class, 'update']);
    Route::get('Attendence/delete/{id}', [EAttendenceController::class, 'delete']);
    Route::get('Attendence/GetMonthYearData', [EAttendenceController::class, 'GetMonthYearData']);

        //NetworkSubnet
    Route::get('NetworkSubnet/home', [ENetworkSubnetController::class, 'home']);
    Route::get('NetworkSubnet/add', [ENetworkSubnetController::class, 'Create']);
    Route::post('NetworkSubnet/store', [ENetworkSubnetController::class, 'Store']);
    Route::get('NetworkSubnet/view/{id}', [ENetworkSubnetController::class, 'views']);
    Route::get('NetworkSubnet/edit/{id}', [ENetworkSubnetController::class, 'edit']);
    Route::post('NetworkSubnet/update/{id}', [ENetworkSubnetController::class, 'update']);
    Route::get('NetworkSubnet/delete/{id}', [ENetworkSubnetController::class, 'delete']);

        //IPAddress
    Route::get('IPAddress/home', [EIPAddressController::class, 'home']);
    Route::get('IPAddress/add', [EIPAddressController::class, 'Create']);
    Route::post('IPAddress/store', [EIPAddressController::class, 'Store']);
    Route::get('IPAddress/edit/{id}', [EIPAddressController::class, 'edit']);
    Route::get('IPAddress/delete/{id}', [EIPAddressController::class, 'delete']);
    Route::post('IPAddress/update/{id}', [EIPAddressController::class, 'update']);
    Route::get('IPAddress/ExportCSV', [EIPAddressController::class, 'ExportCSV']);

        //Rack
    Route::get('Rack/home', [ERackController::class, 'home']);
    Route::get('Rack/add', [ERackController::class, 'Create']);
    Route::post('Rack/store', [ERackController::class, 'Store']);
    Route::get('Rack/edit/{id}', [ERackController::class, 'edit']);
    Route::post('Rack/update/{id}', [ERackController::class, 'update']);
    Route::get('Rack/delete/{id}', [ERackController::class, 'delete']);

        //Switchs
    Route::get('Switchs/home', [ESwitchsController::class, 'home']);
    Route::get('Switchs/add', [ESwitchsController::class, 'Create']);
    Route::post('Switchs/store', [ESwitchsController::class, 'Store']);
    Route::get('Switchs/edit/{id}', [ESwitchsController::class, 'edit']);
    Route::post('Switchs/update/{id}', [ESwitchsController::class, 'update']);
    Route::get('Switchs/delete/{id}', [ESwitchsController::class, 'delete']);

        //Switchs
    Route::get('Firewall/home', [EFirewallController::class, 'home']);
    Route::get('Firewall/add', [EFirewallController::class, 'Create']);
    Route::post('Firewall/store', [EFirewallController::class, 'Store']);
    Route::get('Firewall/edit/{id}', [EFirewallController::class, 'edit']);
    Route::post('Firewall/update/{id}', [EFirewallController::class, 'update']);
    Route::get('Firewall/delete/{id}', [EFirewallController::class, 'delete']);

        //BareMetal
    Route::get('BareMetal/home', [EBareMetalController::class, 'home']);
    Route::get('BareMetal/add', [EBareMetalController::class, 'Create']);
    Route::post('BareMetal/store', [EBareMetalController::class, 'Store']);
    Route::get('BareMetal/edit/{id}', [EBareMetalController::class, 'edit']);
    Route::post('BareMetal/update/{id}', [EBareMetalController::class, 'update']);
    Route::get('BareMetal/delete/{id}', [EBareMetalController::class, 'delete']);

        //CloudHosting
    Route::get('CloudHosting/home', [ECloudHostingController::class, 'home']);
    Route::get('CloudHosting/add', [ECloudHostingController::class, 'Create']);
    Route::post('CloudHosting/store', [ECloudHostingController::class, 'Store']);
    Route::get('CloudHosting/edit/{id}', [ECloudHostingController::class, 'edit']);
    Route::post('CloudHosting/update/{id}', [ECloudHostingController::class, 'update']);
    Route::get('CloudHosting/delete/{id}', [ECloudHostingController::class, 'delete']);
    Route::get('CloudHosting/EXPORTCSV', [ECloudHostingController::class, 'EXPORTCSV']);

        //CloudServices
    Route::get('CloudServices/home', [ECloudServicesController::class, 'home']);
    Route::get('CloudServices/add', [ECloudServicesController::class, 'Create']);
    Route::post('CloudServices/store', [ECloudServicesController::class, 'Store']);
    Route::get('CloudServices/edit/{id}', [ECloudServicesController::class, 'edit']);
    Route::post('CloudServices/update/{id}', [ECloudServicesController::class, 'update']);
    Route::get('CloudServices/delete/{id}', [ECloudServicesController::class, 'delete']);
    Route::get('CloudServices/EXPORTCSV', [ECloudServicesController::class, 'EXPORTCSV']);


        //DedicatedServer
    Route::get('DedicatedServer/home', [EDedicatedServerController::class, 'home']);
    Route::get('DedicatedServer/add', [EDedicatedServerController::class, 'Create']);
    Route::post('DedicatedServer/store', [EDedicatedServerController::class, 'Store']);
    Route::get('DedicatedServer/edit/{id}', [EDedicatedServerController::class, 'edit']);
    Route::post('DedicatedServer/update/{id}', [EDedicatedServerController::class, 'update']);
    Route::get('DedicatedServer/delete/{id}', [EDedicatedServerController::class, 'delete']);
    Route::get('DedicatedServer/EXPORTCSV', [EDedicatedServerController::class, 'EXPORTCSV']);

        //AwsService
    Route::get('AwsService/home', [EAwsServiceController::class, 'home']);
    Route::get('AwsService/add', [EAwsServiceController::class, 'Create']);
    Route::post('AwsService/store', [EAwsServiceController::class, 'Store']);
    Route::get('AwsService/edit/{id}', [EAwsServiceController::class, 'edit']);
    Route::post('AwsService/update/{id}', [EAwsServiceController::class, 'update']);
    Route::get('AwsService/delete/{id}', [EAwsServiceController::class, 'delete']);
    Route::get('AwsService/EXPORTCSV', [EAwsServiceController::class, 'EXPORTCSV']);

        //Azure
    Route::get('Azure/home', [EAzureController::class, 'home']);
    Route::get('Azure/add', [EAzureController::class, 'Create']);
    Route::post('Azure/store', [EAzureController::class, 'Store']);
    Route::get('Azure/edit/{id}', [EAzureController::class, 'edit']);
    Route::post('Azure/update/{id}', [EAzureController::class, 'update']);
    Route::get('Azure/delete/{id}', [EAzureController::class, 'delete']);
    Route::get('Azure/EXPORTCSV', [EAzureController::class, 'EXPORTCSV']);

        //GoogleWorkSpace
    Route::get('GoogleWorkSpace/home', [EGoogleWorkSpaceController::class, 'home']);
    Route::get('GoogleWorkSpace/add', [EGoogleWorkSpaceController::class, 'Create']);
    Route::post('GoogleWorkSpace/store', [EGoogleWorkSpaceController::class, 'Store']);
    Route::get('GoogleWorkSpace/edit/{id}', [EGoogleWorkSpaceController::class, 'edit']);
    Route::post('GoogleWorkSpace/update/{id}', [EGoogleWorkSpaceController::class, 'update']);
    Route::get('GoogleWorkSpace/delete/{id}', [EGoogleWorkSpaceController::class, 'delete']);
    Route::get('GoogleWorkSpace/EXPORTCSV', [EGoogleWorkSpaceController::class, 'EXPORTCSV']);

        //MicrosoftOffice365
    Route::get('MicrosoftOffice365/home', [EMicrosoftOffice365Controller::class, 'home']);
    Route::get('MicrosoftOffice365/add', [EMicrosoftOffice365Controller::class, 'Create']);
    Route::post('MicrosoftOffice365/store', [EMicrosoftOffice365Controller::class, 'Store']);
    Route::get('MicrosoftOffice365/edit/{id}', [EMicrosoftOffice365Controller::class, 'edit']);
    Route::post('MicrosoftOffice365/update/{id}', [EMicrosoftOffice365Controller::class, 'update']);
    Route::get('MicrosoftOffice365/delete/{id}', [EMicrosoftOffice365Controller::class, 'delete']);
    Route::get('MicrosoftOffice365/EXPORTCSV', [EMicrosoftOffice365Controller::class, 'EXPORTCSV']);

        //OneTimeSetup
    Route::get('OneTimeSetup/home', [EOneTimeSetupController::class, 'home']);
    Route::get('OneTimeSetup/add', [EOneTimeSetupController::class, 'Create']);
    Route::post('OneTimeSetup/store', [EOneTimeSetupController::class, 'Store']);
    Route::get('OneTimeSetup/edit/{id}', [EOneTimeSetupController::class, 'edit']);
    Route::post('OneTimeSetup/update/{id}', [EOneTimeSetupController::class, 'update']);
    Route::get('OneTimeSetup/delete/{id}', [EOneTimeSetupController::class, 'delete']);
    Route::get('OneTimeSetup/EXPORTCSV', [EOneTimeSetupController::class, 'EXPORTCSV']);

        //MonthelySetup
    Route::get('MonthelySetup/home', [EMonthelySetupController::class, 'home']);
    Route::get('MonthelySetup/add', [EMonthelySetupController::class, 'Create']);
    Route::post('MonthelySetup/store', [EMonthelySetupController::class, 'Store']);
    Route::get('MonthelySetup/edit/{id}', [EMonthelySetupController::class, 'edit']);
    Route::post('MonthelySetup/update/{id}', [EMonthelySetupController::class, 'update']);
    Route::get('MonthelySetup/delete/{id}', [EMonthelySetupController::class, 'delete']);
    Route::get('MonthelySetup/EXPORTCSV', [EMonthelySetupController::class, 'EXPORTCSV']);

        //SSLCertificate
    Route::get('SSLCertificate/home', [ESSLCertificateController::class, 'home']);
    Route::get('SSLCertificate/add', [ESSLCertificateController::class, 'Create']);
    Route::post('SSLCertificate/store', [ESSLCertificateController::class, 'Store']);
    Route::get('SSLCertificate/edit/{id}', [ESSLCertificateController::class, 'edit']);
    Route::post('SSLCertificate/update/{id}', [ESSLCertificateController::class, 'update']);
    Route::get('SSLCertificate/delete/{id}', [ESSLCertificateController::class, 'delete']);
    Route::get('SSLCertificate/EXPORTCSV', [ESSLCertificateController::class, 'EXPORTCSV']);


        //Antivirus
    Route::get('Antivirus/home', [EAntivirusController::class, 'home']);
    Route::get('Antivirus/add', [EAntivirusController::class, 'Create']);
    Route::post('Antivirus/store', [EAntivirusController::class, 'Store']);
    Route::get('Antivirus/edit/{id}', [EAntivirusController::class, 'edit']);
    Route::post('Antivirus/update/{id}', [EAntivirusController::class, 'update']);
    Route::get('Antivirus/delete/{id}', [EAntivirusController::class, 'delete']);
    Route::get('Antivirus/EXPORTCSV', [EAntivirusController::class, 'EXPORTCSV']);

        //Licenses
    Route::get('Licenses/home', [ELicensesController::class, 'home']);
    Route::get('Licenses/add', [ELicensesController::class, 'Create']);
    Route::post('Licenses/store', [ELicensesController::class, 'Store']);
    Route::get('Licenses/edit/{id}', [ELicensesController::class, 'edit']);
    Route::post('Licenses/update/{id}', [ELicensesController::class, 'update']);
    Route::get('Licenses/delete/{id}', [ELicensesController::class, 'delete']);
    Route::get('Licenses/EXPORTCSV', [ELicensesController::class, 'EXPORTCSV']);

        //Acronis
    Route::get('Acronis/home', [EAcronisController::class, 'home']);
    Route::get('Acronis/add', [EAcronisController::class, 'Create']);
    Route::post('Acronis/store', [EAcronisController::class, 'Store']);
    Route::get('Acronis/edit/{id}', [EAcronisController::class, 'edit']);
    Route::post('Acronis/update/{id}', [EAcronisController::class, 'update']);
    Route::get('Acronis/delete/{id}', [EAcronisController::class, 'delete']);
    Route::get('Acronis/EXPORTCSV', [EAcronisController::class, 'EXPORTCSV']);

        //TsPlus
    Route::get('TsPlus/home', [ETsPlusController::class, 'home']);
    Route::get('TsPlus/add', [ETsPlusController::class, 'Create']);
    Route::post('TsPlus/store', [ETsPlusController::class, 'Store']);
    Route::get('TsPlus/edit/{id}', [ETsPlusController::class, 'edit']);
    Route::post('TsPlus/update/{id}', [ETsPlusController::class, 'update']);
    Route::get('TsPlus/delete/{id}', [ETsPlusController::class, 'delete']);
    Route::get('TsPlus/EXPORTCSV', [ETsPlusController::class, 'EXPORTCSV']);

        //Other
    Route::get('Other/home', [EOtherController::class, 'home']);
    Route::get('Other/add', [EOtherController::class, 'Create']);
    Route::post('Other/store', [EOtherController::class, 'Store']);
    Route::get('Other/edit/{id}', [EOtherController::class, 'edit']);
    Route::post('Other/update/{id}', [EOtherController::class, 'update']);
    Route::get('Other/delete/{id}', [EOtherController::class, 'delete']);
    Route::get('Other/EXPORTCSV', [EOtherController::class, 'EXPORTCSV']);

        //Ticket
    Route::get('Ticket/home', [ETicketController::class, 'home']);
    Route::get('Ticket/add', [ETicketController::class, 'Create']);
    Route::post('Ticket/store', [ETicketController::class, 'Store']);
    Route::get('Ticket/edit/{id}', [ETicketController::class, 'edit']);
    Route::get('Ticket/view/{id}', [ETicketController::class, 'view']);
    Route::post('Ticket/update/{id}', [ETicketController::class, 'update']);
    Route::any('Ticket/update/{id}', [ETicketController::class, 'update']);
    Route::get('Ticket/delete/{id}', [ETicketController::class, 'delete']);
    Route::get('Ticket/EXPORTCSV', [ETicketController::class, 'EXPORTCSV']);
    Route::get('Ticket/ClientData', [ETicketController::class, 'ClientData']);
    Route::post('Ticket/chatInsert', [ETicketController::class, 'chatInsert']);
    Route::post('Ticket/markAsClosed', [ETicketController::class, 'markAsClosed']);
    Route::get('Ticket/get_Ticket_yeardata', [ETicketController::class, 'get_Ticket_yeardata']);
    Route::get('Ticket/overview', [ETicketController::class, 'overview']);

        //Inventory
    Route::get('Inventory/home', [EInventoryController::class, 'home']);
    Route::get('Inventory/add', [EInventoryController::class, 'Create']);
    Route::post('Inventory/store', [EInventoryController::class, 'Store']);
    Route::get('Inventory/edit/{id}', [EInventoryController::class, 'edit']);
    Route::post('Inventory/update/{id}', [EInventoryController::class, 'update']);
    Route::get('Inventory/delete/{id}', [EInventoryController::class, 'delete']);
    Route::get('Inventory/EXPORTCSV', [EInventoryController::class, 'EXPORTCSV']);

        //Invoices
    Route::get('Invoices/home', [EInvoicesController::class, 'home']);
    Route::get('Invoices/downloadPDF', [EInvoicesController::class, 'downloadPDF']);
    Route::get('Invoices/add', [EInvoicesController::class, 'Create']);
    Route::post('Invoices/store', [EInvoicesController::class, 'Store']);
    Route::get('Invoices/edit/{id}', [EInvoicesController::class, 'edit']);
    Route::post('Invoices/update/{id}', [EInvoicesController::class, 'update']);
    Route::get('Invoices/delete/{id}', [EInvoicesController::class, 'delete']);
    Route::get('Invoices/EXPORTCSV', [EInvoicesController::class, 'EXPORTCSV']);
    Route::get('Invoices/printView/{id}', [EInvoicesController::class, 'printView']);
    Route::get('Invoices/getClientDetails/{id}', [EInvoicesController::class, 'getClientDetails']);
    Route::get('Invoices/getEmployeeDetails/{id}', [EInvoicesController::class, 'getEmployeeDetails']);
        //ProjectCategory
    Route::get('ProjectCategory/home', [EProjectCategoryController::class, 'home']);
    Route::get('ProjectCategory/add', [EProjectCategoryController::class, 'Create']);
    Route::post('ProjectCategory/store', [EProjectCategoryController::class, 'Store']);
    Route::get('ProjectCategory/edit/{id}', [EProjectCategoryController::class, 'edit']);
    Route::post('ProjectCategory/update/{id}', [EProjectCategoryController::class, 'update']);
    Route::get('ProjectCategory/delete/{id}', [EProjectCategoryController::class, 'delete']);
    Route::get('ProjectCategory/EXPORTCSV', [EProjectCategoryController::class, 'EXPORTCSV']);


        //ProjectCategory
    Route::get('TaskCategory/home', [ETaskCategoryController::class, 'home']);
    Route::get('TaskCategory/add', [ETaskCategoryController::class, 'Create']);
    Route::post('TaskCategory/store', [ETaskCategoryController::class, 'Store']);
    Route::get('TaskCategory/edit/{id}', [ETaskCategoryController::class, 'edit']);
    Route::post('TaskCategory/update/{id}', [ETaskCategoryController::class, 'update']);
    Route::get('TaskCategory/delete/{id}', [ETaskCategoryController::class, 'delete']);
    Route::get('TaskCategory/EXPORTCSV', [ETaskCategoryController::class, 'EXPORTCSV']);

        //Project
    Route::get('Project/home', [EProjectController::class, 'home']);
    Route::get('Project/add', [EProjectController::class, 'Create']);
    Route::get('Project/view/{id}', [EProjectController::class, 'view']);
    Route::post('Project/store', [EProjectController::class, 'Store']);
    Route::get('Project/edit/{id}', [EProjectController::class, 'edit']);
    Route::post('Project/update/{id}', [EProjectController::class, 'update']);
    Route::get('Project/delete/{id}', [EProjectController::class, 'delete']);
    Route::get('Project/EXPORTCSV', [EProjectController::class, 'EXPORTCSV']);
    Route::get('Project/UpdateStatus', [EProjectController::class, 'UpdateStatus']);


        //Task
    Route::get('Task/home', [ETaskController::class, 'home']);
    Route::get('Task/add', [ETaskController::class, 'Create']);
    Route::get('Task/GetTask', [ETaskController::class, 'GetTask']);
    Route::post('Task/store', [ETaskController::class, 'Store']);
    Route::get('Task/edit/{id}', [ETaskController::class, 'edit']);
    Route::post('Task/update/{id}', [ETaskController::class, 'update']);
    Route::get('Task/delete/{id}', [ETaskController::class, 'delete']);
    Route::get('Task/EXPORTCSV', [ETaskController::class, 'EXPORTCSV']);
    Route::get('Task/UpdateStatus', [ETaskController::class, 'UpdateStatus']);
    Route::get('Task/StartTimer', [ETaskController::class, 'StartTimer']);
    Route::get('Task/StopTimer', [ETaskController::class, 'StopTimer']);
    Route::get('Task/checkStartTimer', [ETaskController::class, 'checkStartTimer']);

        //TimeSheet
    Route::get('TimeSheet/home', [ETimeSheetController::class, 'home']);
    Route::get('TimeSheet/add', [ETimeSheetController::class, 'Create']);
    Route::post('TimeSheet/store', [ETimeSheetController::class, 'Store']);
    Route::get('TimeSheet/edit/{id}', [ETimeSheetController::class, 'edit']);
    Route::post('TimeSheet/update/{id}', [ETimeSheetController::class, 'update']);
    Route::get('TimeSheet/delete/{id}', [ETimeSheetController::class, 'delete']);
    Route::get('TimeSheet/EXPORTCSV', [ETimeSheetController::class, 'EXPORTCSV']);
    Route::get('TimeSheet/UpdateStatus', [ETimeSheetController::class, 'UpdateStatus']);

        //Holiday
    Route::get('Holiday/home', [EHolidayController::class, 'home']);
    Route::get('Holiday/add', [EHolidayController::class, 'Create']);
    Route::post('Holiday/store', [EHolidayController::class, 'Store']);
    Route::get('Holiday/edit/{id}', [EHolidayController::class, 'edit']);
    Route::post('Holiday/update/{id}', [EHolidayController::class, 'update']);
    Route::get('Holiday/delete/{id}', [EHolidayController::class, 'delete']);


        //Leave
    Route::get('Leave/home', [ELeaveController::class, 'home']);
    Route::get('Leave/home2', [ELeaveController::class, 'home2']);
    Route::get('Leave/add', [ELeaveController::class, 'Create']);
    Route::get('Leave/addLeave', [ELeaveController::class, 'addLeave']);
    Route::post('Leave/storeLeave', [ELeaveController::class, 'storeLeave']);
    Route::post('Leave/store', [ELeaveController::class, 'Store']);
    Route::get('Leave/editLeave/{id}', [ELeaveController::class, 'editLeave']);
    Route::get('Leave/edit/{id}', [ELeaveController::class, 'edit']);
    Route::get('Leave/viewLeave/{id}', [ELeaveController::class, 'viewLeave']);
    Route::get('Leave/view/{id}', [ELeaveController::class, 'view']);
    Route::post('Leave/updateLeave/{id}', [ELeaveController::class, 'update']);
    Route::get('Leave/delete/{id}', [ELeaveController::class, 'delete']);
    Route::get('Leave/Show_leaves_yeardata', [ELeaveController::class, 'Show_leaves_yeardata']);
    Route::POST('Leave/LeaveStatusUpdate', [ELeaveController::class, 'LeaveStatusUpdate']);

        //LeavePolicies
    Route::get('LeavePolicies/home', [ELeavePoliciesController::class, 'home']);
    Route::get('LeavePolicies/add', [ELeavePoliciesController::class, 'Create']);
    Route::post('LeavePolicies/store', [ELeavePoliciesController::class, 'Store']);
    Route::get('LeavePolicies/edit/{id}', [ELeavePoliciesController::class, 'edit']);
    Route::get('LeavePolicies/view', [ELeavePoliciesController::class, 'view']);
    Route::post('LeavePolicies/update/{id}', [ELeavePoliciesController::class, 'update']);
    Route::get('LeavePolicies/delete/{id}', [ELeavePoliciesController::class, 'delete']);


        //Employee
    Route::get('Employee/home', [EEmployeeController::class, 'home']);
    Route::get('Employee/add', [EEmployeeController::class, 'Create']);
    Route::post('Employee/store', [EEmployeeController::class, 'Store']);
    Route::post('Employee/check-email', [EEmployeeController::class, 'check_email']);
    Route::get('Employee/edit/{id}', [EEmployeeController::class, 'edit']);
    Route::get('Employee/view/{id}', [EEmployeeController::class, 'view']);
    Route::post('Employee/update/{id}', [EEmployeeController::class, 'update']);
    Route::get('Employee/delete/{id}', [EEmployeeController::class, 'delete']);
    Route::get('Employee/TabView', [EEmployeeController::class, 'TabView']);


    // ServerMonitoringController
    Route::get('monitoring/server', [EServerMonitoringController::class, 'index']);
    Route::get('monitoring/service', [EServiceMonitoringController::class, 'index']);
    Route::get('monitoring/memory', [EMemoryMonitoringController::class, 'index']);
    Route::get('monitoring/disk', [EDiskMonitoringController::class, 'index']);
    Route::get('monitoring/network', [ENetworkMonitoringController::class, 'index']);


        //File
    Route::get('File/home', [EFileController::class, 'home']);
    Route::get('File/add', [EFileController::class, 'Create']);
    Route::post('File/store', [EFileController::class, 'Store']);
    Route::post('FileManagement/e-store-sub-folder', [EFileController::class, 'storeSubFolder']);
    Route::post('FileManagement/e-share-folder', [EFileController::class, 'shareFolder']);
    Route::get('FileManagement/e-view-all-files', [EFileController::class, 'getAllFiles']);
    Route::post('FileManagement/e-share-file', [EFileController::class, 'sharefile']);
    Route::get('FileManagement/e-get-department-emp/{id}', [EFileController::class, 'getEmployeesByDepartment']);


    Route::post('FileManagement/e-share-sub-folder', [EFileController::class, 'shareSubFolder']);

    Route::post('FileManagement/e-update-sub-folder', [EFileController::class, 'updateSubFolder']);

    Route::delete('FileManagement/e-delete-sub-folder/{id}', [EFileController::class, 'deleteSubFolder']);
    Route::post('FileManagement/e-update-folder', [EFileController::class, 'updateFolder']);

    Route::get('FileManagement/get-subfolders/{folderId}', [EFileController::class, 'getSubfolders']);

    Route::post('FileManagement/e-get-employees', [EFileController::class, 'getEmployeesByDepartment']);
    Route::delete('FileManagement/e-delete-folder/{id}', [EFileController::class, 'deleteFolder']);
    Route::delete('FileManagement/e-delete-folder-files/{id}', [EFileController::class, 'deleteFolderFiles']);
    Route::get('FileManagement/e-folder-file-view/{id}', [EFileController::class, 'folderFileView']);
    Route::get('FileManagement/e-view-folder-files/{id}', [EFileController::class, 'viewFolderFiles']);
    Route::get('FileManagement/e-view-subfolder-files/{id}', [EFileController::class, 'viewSubFolderFiles']);
    Route::get('FileManagement/e-get-folder-files/{id}', [EFileController::class, 'getFolderFiles']);
    Route::get('FileManagement/e-folder-files/{id}', [EFileController::class, 'showFolderFiles']);
    Route::post('FileManagement/e-store-file', [EFileController::class, 'storeFile']);
    Route::get('FileManagement/e-ShowUserList', [EFileController::class, 'show_user_list']);


    Route::post('FileManagement/e-store-file', [EFileController::class, 'storeFile']);

    Route::get('File/edit/{id}', [EFileController::class, 'edit']);
    Route::get('File/view', [EFileController::class, 'view']);
    Route::post('File/update/{id}', [EFileController::class, 'update']);
    Route::get('File/delete/{id}', [EFileController::class, 'delete']);


        //CompanyLogin
    Route::get('CompanyLogin/home', [ECompanyLoginController::class, 'home']);
    Route::get('CompanyLogin/add', [ECompanyLoginController::class, 'Create']);
    Route::post('CompanyLogin/store', [ECompanyLoginController::class, 'Store']);
    Route::get('CompanyLogin/edit/{id}', [ECompanyLoginController::class, 'edit']);
    Route::post('CompanyLogin/update/{id}', [ECompanyLoginController::class, 'update']);
    Route::get('CompanyLogin/delete/{id}', [ECompanyLoginController::class, 'delete']);
    Route::get('CompanyLogin/EXPORTCSV', [ECompanyLoginController::class, 'EXPORTCSV']);

        //Performance
    Route::get('Performance/home', [EPerformanceController::class, 'home']);
    Route::get('Performance/add', [EPerformanceController::class, 'Create']);
    Route::post('Performance/store', [EPerformanceController::class, 'Store']);
    Route::get('Performance/view/{id}', [EPerformanceController::class, 'view']);
    Route::get('Performance/get_Performance_yeardata', [EPerformanceController::class, 'get_Performance_yeardata']);

        //PerformanceCategory
    Route::post('PerformanceCategory/store', [EPerformanceCategoryController::class, 'Store']);
    Route::post('PerformanceCategory/edit', [EPerformanceCategoryController::class, 'edit']);
    Route::post('PerformanceCategory/update', [EPerformanceCategoryController::class, 'update']);
    Route::post('PerformanceCategory/delete', [EPerformanceCategoryController::class, 'delete']);

        //PerformanceRating
    Route::post('PerformanceRating/store', [EPerformanceRatingController::class, 'Store']);
    Route::post('PerformanceRating/edit', [EPerformanceRatingController::class, 'edit']);
    Route::post('PerformanceRating/update', [EPerformanceRatingController::class, 'update']);
    Route::post('PerformanceRating/delete', [EPerformanceRatingController::class, 'delete']);



        //PayRoll
    Route::get('PayRoll/TDS', [EPayRollController::class, 'TDS']);
    Route::get('PayRoll/home', [EPayRollController::class, 'home']);
    Route::get('PayRoll/add', [EPayRollController::class, 'Create']);
    Route::get('PayRoll/edit', [EPayRollController::class, 'edit']);
    Route::get('PayRoll/view/{id}', [EPayRollController::class, 'view']);
    Route::get('PayRoll/Salary', [EPayRollController::class, 'Salary']);
    Route::get('PayRoll/Deduction', [EPayRollController::class, 'Deduction']);
    Route::POST('PayRoll/update/{id}', [EPayRollController::class, 'update']);
    Route::get('PayRoll/EXPORTCSV/', [EPayRollController::class, 'EXPORTCSV']);
    Route::get('PayRoll/get_TdsData', [EPayRollController::class, 'get_TdsData']);
    Route::POST('PayRoll/Rules/update/{id}', [EPayRollController::class, 'RuleUpdate']);
    Route::get('PayRoll/GenerateSellary', [EPayRollController::class, 'GenerateSellary']);
    Route::get('PayRoll/get_SallaryData', [EPayRollController::class, 'get_SallaryData']);
    Route::get('PayRoll/get_deductionData', [EPayRollController::class, 'get_deductionData']);
    Route::get('PayRoll/SallarySlip/{id}', [EPayRollController::class, 'SallarySlip']);
    Route::get('PayRoll/getEmpPayroll', [PayRollController::class, 'getEmpPayroll']);

        //Calendar
    Route::get('Calendar/home', [ECalendarController::class, 'home']);
    Route::POST('Calendar/store', [ECalendarController::class, 'Store']);
    Route::GET('Calendar/fetch', [ECalendarController::class, 'fetchData']);
    Route::POST('Calendar/update', [ECalendarController::class, 'update']);
    Route::POST('Calendar/delete/{id}', [ECalendarController::class, 'delete']);

        //LeaveType
    Route::post('LeaveType/store', [ELeaveTypeController::class, 'Store']);
    Route::get('LeaveType/edit', [ELeaveTypeController::class, 'edit']);
    Route::post('LeaveType/update/{id}', [ELeaveTypeController::class, 'update']);
    Route::get('LeaveType/delete/{id}', [ELeaveTypeController::class, 'delete']);


        //Role
    Route::get('Role/home', [ERoleController::class, 'home']);
    Route::get('Role/add', [ERoleController::class, 'Create']);
    Route::post('Role/store', [ERoleController::class, 'Store']);
    Route::get('Role/view/{id}', [ERoleController::class, 'view']);
    Route::get('Role/edit/{id}', [ERoleController::class, 'edit']);
    Route::post('Role/update/{id}', [ERoleController::class, 'update']);
    Route::get('Role/delete/{id}', [ERoleController::class, 'delete']);



        //Product
    Route::get('Product/home', [EProductController::class, 'home']);
    Route::get('Product/add', [EProductController::class, 'Create']);
    Route::post('Product/store', [EProductController::class, 'Store']);
    Route::get('Product/view/{id}', [EProductController::class, 'view']);
    Route::get('Product/edit/{id}', [EProductController::class, 'edit']);
    Route::post('Product/update/{id}', [EProductController::class, 'update']);
    Route::get('Product/delete/{id}', [EProductController::class, 'delete']);

        //Category
    Route::post('Category/store', [ECategoryController::class, 'Store']);
    Route::get('Category/edit', [ECategoryController::class, 'edit']);
    Route::post('Category/update/{id}', [ECategoryController::class, 'update']);
    Route::get('Category/delete/{id}', [ECategoryController::class, 'delete']);

        //PaymentMethod
    Route::get('PaymentMethod/home', [EPaymentMethodController::class, 'home']);
    Route::get('PaymentMethod/add', [EPaymentMethodController::class, 'Create']);
    Route::post('PaymentMethod/store', [EPaymentMethodController::class, 'Store']);
    Route::get('PaymentMethod/view/{id}', [EPaymentMethodController::class, 'view']);
    Route::get('PaymentMethod/edit/{id}', [EPaymentMethodController::class, 'edit']);
    Route::post('PaymentMethod/update/{id}', [EPaymentMethodController::class, 'update']);
    Route::get('PaymentMethod/delete/{id}', [EPaymentMethodController::class, 'delete']);

        //Template
    Route::get('Template/home', [ETemplateController::class, 'home']);
    Route::get('Template/add', [ETemplateController::class, 'Create']);
    Route::post('Template/store', [ETemplateController::class, 'Store']);
    Route::get('Template/view/{id}', [ETemplateController::class, 'view']);
    Route::get('Template/edit/{id}', [ETemplateController::class, 'edit']);
    Route::post('Template/update/{id}', [ETemplateController::class, 'update']);
    Route::get('Template/delete/{id}', [ETemplateController::class, 'delete']);

        //Security
    Route::get('Security/home', [ESecurityController::class, 'home']);
    Route::get('Security/add', [ESecurityController::class, 'Create']);
    Route::post('Security/store', [ESecurityController::class, 'Store']);
    Route::post('Security/confirm_password', [ESecurityController::class, 'confirm_password']);
    Route::get('Security/view/{id}', [ESecurityController::class, 'view']);
    Route::get('Security/edit/{id}', [ESecurityController::class, 'edit']);
    Route::post('Security/update/{id}', [ESecurityController::class, 'update']);
    Route::get('Security/delete/{id}', [ESecurityController::class, 'delete']);


        //Security
    Route::get('SecuritySettings/home', [ESecuritySettingsController::class, 'home']);
    Route::get('SecuritySettings/add', [ESecuritySettingsController::class, 'Create']);
    Route::post('SecuritySettings/store', [ESecuritySettingsController::class, 'Store']);
    Route::get('SecuritySettings/view/{id}', [ESecuritySettingsController::class, 'view']);
    Route::get('SecuritySettings/edit/{id}', [ESecuritySettingsController::class, 'edit']);
    Route::post('SecuritySettings/update/{id}', [ESecuritySettingsController::class, 'update']);
    Route::get('SecuritySettings/delete/{id}', [ESecuritySettingsController::class, 'delete']);
    Route::post('SecuritySettings/confirm_password', [ESecuritySettingsController::class, 'confirm_password']);

    Route::get('SecuritySettings/mail_setup', [ESecuritySettingsController::class, 'mail_setup']);

        //MailSettings
    Route::get('MailSettings/home', [EMailSettingsController::class, 'home']);
    Route::get('MailSettings/add', [EMailSettingsController::class, 'Create']);
    Route::post('MailSettings/store', [EMailSettingsController::class, 'Store']);
    Route::get('MailSettings/view/{id}', [EMailSettingsController::class, 'view']);
    Route::get('MailSettings/edit/{id}', [EMailSettingsController::class, 'edit']);
    Route::post('MailSettings/update/{id}', [EMailSettingsController::class, 'update']);
    Route::get('MailSettings/delete/{id}', [EMailSettingsController::class, 'delete']);
    Route::get('MailSettings/MailViaUpdate', [EMailSettingsController::class, 'MailViaUpdate']);






        //LogActivity
    Route::get('LogActivity/home', [ELogActivityController::class, 'home']);

        //Notice
    Route::get('Notice/home', [ENoticeController::class, 'home']);
    Route::get('Notice/add', [ENoticeController::class, 'Create']);
    Route::post('Notice/store', [ENoticeController::class, 'Store']);
    Route::get('Notice/view/{id}', [ENoticeController::class, 'view']);
    Route::get('Notice/edit/{id}', [ENoticeController::class, 'edit']);
    Route::post('Notice/update/{id}', [ENoticeController::class, 'update']);
    Route::get('Notice/delete/{id}', [ENoticeController::class, 'delete']);
    Route::get('elogNotification', [EAdminController::class, 'logNotification']);

    Route::get('logout', [EAdminController::class, 'logout']);
});
