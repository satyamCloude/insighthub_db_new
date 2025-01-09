<?php

namespace App\Http\Controllers;

use App\Models\ClientDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

use Razorpay\Api\Api;
use App\Models\MailSettings;
use App\Models\Template;
use Jenssegers\Agent\Agent;
use App\Models\CompanyLogin;
use App\Models\LogActivity;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\ProductNew;
use App\Models\Attendence;
use App\Models\InvoiceSettings;
use App\Models\Category;
use App\Models\User;
use App\Models\OperatingSysten;
use App\Models\DedicatedServer;
use App\Models\ProductPricing;
use App\Models\CloudServices;
use App\Models\Currency;
use App\Models\BareMetal;
use App\Models\CloudHosting;
use App\Models\Invoice;
use App\Models\HostingControlPanel;
use App\Models\OrderToProduct;
use App\Models\Azure;
use App\Models\MicrosoftOffice365;
use App\Models\OneTimeSetup;
use App\Models\MonthelySetup;
use App\Models\GoogleWorkSpace;
use App\Models\AwsService;
use App\Models\SSLCertificate;
use App\Models\TsPlus;
use App\Models\Antivirus;
use App\Models\Acronis;
use App\Models\Licenses;
use App\Models\Orders;
use App\Models\Product;
use App\Models\EmployeeDetail;
use App\Models\TimeShift;
use App\Models\AddonOrder;
use App\Models\Cart;
use App\Models\ProductAddOn;
use App\Models\ProductAddOnPrice;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail; // Import your mail class
use App\Mail\ClientAuthEmail; // Import your mail class
use App\Mail\ClientWelcomeEmail; // Import your mail class
use App\Models\Switchs;
use App\Models\Firewall;
use auth;
use Validator;
use Session;
use Hash;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }
public function generateAutomaticInvoices()
{
    $currentDate = now()->toDateString(); // Get the current date
    $generatedOrders = [];

    // Array to hold all the invoice models
    $invoices = [];

    // Collecting invoices for different services
    $services = [
        BareMetal::class,
        CloudHosting::class,
        CloudServices::class,
        DedicatedServer::class,
        AwsService::class,
        Azure::class,
        GoogleWorkSpace::class,
        MicrosoftOffice365::class,
        OneTimeSetup::class,
        MonthelySetup::class,
        SSLCertificate::class,
        Licenses::class,
        Acronis::class,
        TsPlus::class,
        Antivirus::class,
        Switchs::class,
        Firewall::class
    ];

    foreach ($services as $service) {
        $invoices[] = $service::whereDate('next_due_date', $currentDate)
            ->whereNotIn('status', [2, 4])
            ->get();
    }

    // Process each invoice
    foreach ($invoices as $order) {
        foreach ($order as $item) {
            if ($item->billing_cycle === 'one_time' || $item->billing_cycle === '1') {
                continue; // Skip one-time billing items
            }
            $inv_id = $item->invoice_id;
            $invoice = Invoice::find($inv_id);
            $order_id = $invoice->order_id;
            if($order_id){

            $order = Orders::find($order_id);
            $new_order = $order->replicate();
            $new_order->is_payment_recieved = 0;
        }else{
           //Create new order
            $new_order = new Orders();
            $new_order->user_id = 1;
            $new_order->client_id = $item->customer_id;
            $new_order->product_id = $item->product_id;
            $getProductPrice = ProductPricing::where('product_id', $item->product_id)->first();
            $new_order->order_type = 'automatically_recurring_order';
            $new_order->total_amt = $getProductPrice->amount;
            $new_order->productCategoryId = $item->productCategoryId;
            $new_order->productTypeId = $item->productTypeId;
            $new_order->order_status = 0;
            }

            $new_order->save();

            // // Generate invoice for the order
            // $invoiceData = [
            //     'client_id' => $newOrder->client_id,
            //     'user_id' => $newOrder->client_id,
            //     'product_id' => $newOrder->product_id,
            //     'invoice_number1' => 'INV#',
            //     'invoice_number2' => Invoice::max('invoice_number2') + 1,
            //     'issue_date' => now()->toDateString(),
            //     'amount' => $newOrder->total_amt,
            //     'due_date' => $newOrder->due_date, // Check where is due_date defined
            //     'order_id' => $newOrder->id,
            //     'sub_total' => $getProductPrice->price,
            //     'currency' => $newOrder->currency,
            //     'exchange_rate' => $newOrder->exchange_rate,
            //     'final_total_amt' => $newOrder->total_amt,
            //     'project_id' => $newOrder->project_id,
            //     'calc_tax' => $newOrder->calc_tax ?? 0,
            //     'bank_account' => $newOrder->bank_account,
            //     'billing_address' => $newOrder->billing_address,
            //     'shipping_address' => $newOrder->shipping_address,
            //     'generated_by' => $newOrder->generated_by,
            //     'is_payment_received' => 0,
            // ];

            // = Invoice::create($invoiceData);

            $new_invoice = $invoice->replicate();
            $new_invoice->is_payment_recieved = 0;
            $new_invoice->order_id = $new_order->id;
            $new_invoice->save();


            $new_order->invoice_id = $new_invoice->id;
            $new_order->save();
            $generatedOrders[] = $new_invoice;
             // return $new_invoice;

            // Update next due date
            $billingCycle = $new_order->billing_cycle;
            $productId = $new_order->product_id;
            $product = ProductNew::find($productId);
            $plan = ProductPricing::find($billingCycle);

            if ($plan && $plan->product_plan == 3) {
                switch ($product->plan_type) {
                    case 'triennially':
                        $addDays = 1095;
                        break;
                    case 'biennially':
                        $addDays = 730;
                        break;
                    case 'annually':
                        $addDays = 365;
                        break;
                    case 'semiannually':
                        $addDays = 150;
                        break;
                    case 'quarterly':
                        $addDays = 70;
                        break;
                    case 'monthly':
                        $addDays = 30;
                        break;
                    case 'hourly':
                        $addDays = 1;
                        break;
                    default:
                        $addDays = 30;
                }

                $nextDueDate = now()->addDays($addDays);
            } else {
                $addDays = 30;
                // $next_due_date = strtotime("+$add_days days", strtotime($item->next_due_date));
                $nextDueDate = now()->addDays($addDays);
            }

            $item->next_due_date = $nextDueDate;
            $item->invoice_id = end($generatedOrders)->id;
            $item->save();
        }
    }

    return $generatedOrders;
}




public function handleGoogleCallback(): RedirectResponse
{
    try {
        $user = Socialite::driver('google')->user();
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Login details are not valid');
    }

    // Check if the user already exists
    $existingUser = User::where('email', $user->email)->first();

    if ($existingUser) {
        // If the user exists, log them in
        auth()->login($existingUser, true);
        return redirect('/')->with('message', 'You are already registered. You can now log in.');
    } else {
        // If the user doesn't exist, create a new user
        $validator = Validator::make(['email' => $user->email], [
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator)->withInput();
        }

        // Generate verification token and random password
        $verificationToken = Str::random(32);
        $randomPass = $this->generateRandomPassword(6);

        // Create a new user
            $newUser = new User();
            $newUser->email = $user->email;
            $newUser->type = 2;
            $newUser->status = 5;
            $newUser->google_id = $user->id;
            $nameParts = explode(' ', $user->name);
            $newUser->first_name = $nameParts[0]; // First name
            $newUser->last_name = implode(' ', array_slice($nameParts, 1)); // Last name (if available)
            $newUser->password = Hash::make($randomPass);
            // $newUser->save();
        if ($newUser->save()) {
            $newUser->verification_token = $verificationToken;
            $newUser->save();
            $CompanyLogin = new CompanyLogin;
            $CompanyLogin->user_id = $newUser->id;
            $CompanyLogin->company_name = '';
            $CompanyLogin->save();

            $ClientDetail = new ClientDetail;
            $ClientDetail->user_id = $newUser->id;
            $ClientDetail->company_id = $CompanyLogin->id;
            $ClientDetail->save();

        $verificationLink = route('verify.email', ['user' => $user->id, 'email' => $user->email, 'token' => $verificationToken]);
        $msgs = "To finish creating your cloudtechtiq account, confirm your email address by clicking this link: $verificationLink\nHappy coding,\nTeam cloudtechtiq";

        $userDetals = "Welcome to cloudtechtiq, \n Your email id is: $newUser->email \n Password is:$randomPass  \nHappy coding,\nTeam cloudtechtiq";

        $msgs = wordwrap($msgs, 70);
        $userDetals = wordwrap($userDetals, 70);
        // mail($newUser->email, "Confirm your cloudtechtiq account", $msg);
  $TemplateSettings = Template::where('name', 'Successfully Registered')->first();
  $TemplateSettings1 = Template::where('name', 'Email Verification')->first();
                $MailSettings = MailSettings::where('type','Bulk')->where('id',1)->first();
                if ($MailSettings->smtp == '1') 
                {
                        config([
                            'mail.driver'     => $MailSettings->smtp_mailer,
                            'mail.host'       => $MailSettings->smtp_host,
                            'mail.port'       => $MailSettings->smtp_port,
                            'mail.username'   => $MailSettings->smtp_user_name,
                            'mail.password'   => $MailSettings->smtp_password,
                            'mail.encryption' => $MailSettings->smtp_encryption,
                        ]);
                        $subject = $TemplateSettings->subject;
                        $header = $TemplateSettings->header;
                        $template = $TemplateSettings->template;
                        $footer = $TemplateSettings->footer;


                        $subject1 = $TemplateSettings1->subject;
                        $header1 = $TemplateSettings1->header;
                        $template1 = $TemplateSettings1->template;
                        $footer1 = $TemplateSettings1->footer;

                  $replacementsSubject = array(
                 '[Company Name]' => 'CloudTechtiq',
                  );
                 $messageReplacementssubject = $subject;
                 $subject = str_replace(array_keys($replacementsSubject), array_values($replacementsSubject),$messageReplacementssubject);

                 $replacementsTemplate = array(
                 '{$client_name}' => $newUser->first_name,
                 '[Your Company Name]' => 'CloudTechtiq',
                 '{$client_username}' => $newUser->email,
                 '[automatically generated password or instructions to set up a password]' => $randomPass,
                  );
                 $messageReplacementsTemplate = $template;
                 $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate),      $messageReplacementsTemplate);


                 $replacementsFooter = array(
            '[Company Name]' => 'CloudTechtiq',
             );
            $messagefooter = $footer;
            $footer = str_replace(array_keys($replacementsFooter), array_values($replacementsFooter), $messagefooter);

            $replacementsTemplate1 = array(
            '{$client_name}' => $newUser->first_name,
            '[Your Company Name]' => 'CloudTechtiq',
            '[Verification Link]' => $msgs,
             );
            $messageReplacementsTemplate1 = $template1;
            $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);

         $replacementsFooter1 = array(
            '[Company Name]' => 'CloudTechtiq',
             );
            $messagefooter1 = $footer1;
            $footer1 = str_replace(array_keys($replacementsFooter1), array_values($replacementsFooter1), $messagefooter1);

                \Mail::to($newUser->email)->send(new ClientAuthEmail($subject,$header,$template,$footer));
                \Mail::to($newUser->email)->send(new ClientWelcomeEmail($subject1,$header1,$template1,$footer1));
                }       
           

            return redirect()->route('google.varify_email', ['user' => $newUser->id])->with('success', 'Google login done');
        } else {
            return redirect('/')->with('message', 'Your registration was failed. Please try again later.');
        }
    }
}
public function generateRandomPassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=<>?';
    $charCount = strlen($chars);
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, $charCount - 1)];
    }

    return $password;
}


// public function generateRandomPassword($length = 8) {
//     $chars = [
//         'abcdefghijklmnopqrstuvwxyz',
//         'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
//         '0123456789',
//         '!@#$%^&*()-_+=<>?'
//     ];

//     $charCount = count($chars);
//     $password = '';

//     // Ensure at least one character from each character set
//     foreach ($chars as $char) {
//         $password .= $char[rand(0, strlen($char) - 1)];
//     }

//     // Fill the rest of the password with random characters
//     for ($i = $charCount; $i < $length; $i++) {
//         $password .= $chars[rand(0, $charCount - 1)][rand(0, strlen($chars[rand(0, $charCount - 1)]) - 1)];
//     }

//     // Shuffle the password to mix characters
//     return str_shuffle($password);
// }

}
