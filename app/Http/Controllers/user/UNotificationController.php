<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Collection;
use App\Exports\QuotesExport; 
use App\Models\CompanyLogin;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\QuotesCal;
use App\Models\Currency;
use App\Models\Employee;
use App\Models\Country;
use App\Models\Product;
use App\Models\Quotes;
use App\Models\State;
use App\Models\ProductNew;
use App\Models\City;
use App\Models\MailSettings;
use App\Models\Template;
use App\Models\User;
use App\Models\Notification;
use App\Models\TaxSetting;
use App\Models\InvoiceSettings;
use App\Models\Invoice;
use App\Models\Orders;
use App\Mail\SendQuotes;
use Illuminate\Support\Facades\Mail;
use Session;
use Hash;
use Auth;
use DB;
use View;
use PDF;

class UNotificationController extends Controller
{
  public function home()
{
 
      $Quotes = Notification::leftJoin('users', 'users.id', '=', 'notifications.user_id')
            ->select('notifications.*', 'users.first_name', 'users.last_name', 'users.profile_img')
            ->whereNull('notifications.deleted_at')
            ->orderBy('notifications.id','desc')
            ->paginate(10);

        return view('user.Notification.home', compact('Quotes'));
    }


    public function view(Request $request,$id)
     {
        $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
                        ->leftjoin('users','users.id','quotes.customer_name')
                        ->leftjoin('invoices','invoices.Quotesid','quotes.id')
                        ->leftjoin('company_logins','company_logins.id','quotes.company_id')
                        ->where('quotes.id',$id)->first();
        $invoice_id = Invoice::select('id')->where('Quotesid',$id)->first();
        $order_id  = Orders::select('id')->where('quotes_id',$id)->first();
        $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
        $InvoiceSettings = InvoiceSettings::where('id',1)->first();
        $Currency = Currency::where('is_default',1)->first();

        return view('user.Notification.view',compact('Quotes','QuotesCal','InvoiceSettings','Currency','invoice_id','order_id'));
     }

         public function downloadPDF($id)
        { 
           $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
                        ->leftjoin('users','users.id','quotes.customer_name')
                        ->leftjoin('invoices','invoices.Quotesid','quotes.id')
                        ->leftjoin('company_logins','company_logins.id','quotes.company_id')
                        ->where('quotes.id',$id)->first();
        $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
        $InvoiceSettings = InvoiceSettings::where('id',1)->first();
        $Currency = Currency::where('is_default',1)->first();
            $pdf = PDF::loadView('user.Notification.downloadView', ['Currency' => $Currency ,'Quotes' => $Quotes ,'InvoiceSettings' => $InvoiceSettings ,'QuotesCal' => $QuotesCal]);


        $filename = 'Quotes_' . $id . '.pdf';
        return $pdf->download($filename);
        }


    public function printView(Request $request, $id)
    {
        $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
                        ->leftjoin('users','users.id','quotes.customer_name')
                        ->leftjoin('invoices','invoices.Quotesid','quotes.id')
                        ->leftjoin('company_logins','company_logins.id','quotes.company_id')
                        ->where('quotes.id',$id)->first();
        $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
        $InvoiceSettings = InvoiceSettings::where('id',1)->first();
        $Currency = Currency::where('is_default',1)->first();
                
        return view('user.Notification.printView', compact('Quotes', 'QuotesCal', 'InvoiceSettings','Currency'));


    }

    public function StatuPdate(Request $request)
    {
        $Quotes = Quotes::find($request->Qid);

        if ($Quotes) {
            $Quotes->status = $request->value;
            $Quotes->save();
        

        $quotId = QuotesCal::where('quotes_id',$request->Qid)->pluck('Products_id')->toArray();
        
         $productName = ProductNew::whereIn('id',$quotId)->pluck('product_name')->toArray();

          $productName = implode(",",$productName);

           if($Quotes->customer_name)
           {
            $userDetail = User::find($Quotes->customer_name);
            $userName = ucfirst($userDetail->first_name);
            $userEmail = $userDetail->email;
           }else
           {
            $userName = ucfirst($Quotes->first_name);
            $userEmail = $Quotes->email;
           }


        
            if($request->value == 3)
            {
                $TemplateSettings = Template::where('name', 'Quotation Acceptance Confirmation')->first();
                $subject  = $TemplateSettings->subject;
                $header   = $TemplateSettings->header;
                $template = $TemplateSettings->template;
                $footer   = $TemplateSettings->footer;
                $title   = 'Quotation Acceptance Confirmation';

                $replacementsTemplate = array(
                   '{$client_name}' => $userName,
                   '[Product/Service Name]' => $productName,
                   '[Company Name]' => 'CloudTechtiq',
               );
                $messageReplacementsTemplate = $template;
                $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate),$messageReplacementsTemplate);
                


                $replacementsSubject = array(
                   '{$ticket_subject}' => $request->subject,
               );
                $messageReplacementsSubject = $subject;
                $subject = str_replace(array_keys($replacementsSubject), array_values($replacementsSubject),$messageReplacementsSubject);
                  $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
     ->leftjoin('users','users.id','quotes.customer_name')
     ->leftjoin('quotes_cals','quotes_cals.quotes_id','quotes.id')
     ->leftjoin('product_news','product_news.id','quotes_cals.Products_id')
     ->leftjoin('invoices','invoices.Quotesid','quotes.id')
     ->leftjoin('company_logins','company_logins.id','quotes.company_id')
     ->where('quotes.id',$Quotes->id)->first();
     $QuotesCal = QuotesCal::where('quotes_id',$Quotes->id)->get();
    $InvoiceSettings = InvoiceSettings::first();

      $pdf = PDF::loadView('admin.sales.Quotes.downloadView', ['Quotes' => $Quotes ,'InvoiceSettings' => $InvoiceSettings ,'QuotesCal' => $QuotesCal]);

                  $filename = 'Quotes_' . $Quotes->id . '.pdf';
    // Save the PDF to the server
    $pdfPath = base_path('public/pdf/' . $filename);
     // Save the PDF to the server
            $pdfPath = public_path('pdf/' . $filename);
            $pdf->save($pdfPath);

            // Attach the PDF to the email
            $pdfData = file_get_contents($pdfPath);

                Mail::to($userEmail)->send(new SendQuotes($subject, $header, $template, $footer,$title, $pdfData, $filename));

            }

               if($request->value == 2)
                {
                $TemplateSettings = Template::where('name', 'Quotation Rejection Notification')->first();
                $subject  = $TemplateSettings->subject;
                $header   = $TemplateSettings->header;
                $template = $TemplateSettings->template;
                $footer   = $TemplateSettings->footer;
                $title   = 'Quotation Rejection Notification';

                $replacementsTemplate = array(
                   '{$client_name}' => $userName,
                   '[Product/Service Name]' => $productName,
                   '[Company Name]' => 'CloudTechtiq',
               );
                $messageReplacementsTemplate = $template;
                $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate),$messageReplacementsTemplate);
                
                $replacementsSubject = array(
                   '{$ticket_subject}' => $request->subject,
               );
                $messageReplacementsSubject = $subject;
                $subject = str_replace(array_keys($replacementsSubject), array_values($replacementsSubject),$messageReplacementsSubject);
                  $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
     ->leftjoin('users','users.id','quotes.customer_name')
     ->leftjoin('quotes_cals','quotes_cals.quotes_id','quotes.id')
     ->leftjoin('product_news','product_news.id','quotes_cals.Products_id')
     ->leftjoin('invoices','invoices.Quotesid','quotes.id')
     ->leftjoin('company_logins','company_logins.id','quotes.company_id')
     ->where('quotes.id',$Quotes->id)->first();
     $QuotesCal = QuotesCal::where('quotes_id',$Quotes->id)->get();
    $InvoiceSettings = InvoiceSettings::first();

      $pdf = PDF::loadView('admin.sales.Quotes.downloadView', ['Quotes' => $Quotes ,'InvoiceSettings' => $InvoiceSettings ,'QuotesCal' => $QuotesCal]);

                  $filename = 'Quotes_' . $Quotes->id . '.pdf';
    // Save the PDF to the server
    $pdfPath = base_path('public/pdf/' . $filename);
     // Save the PDF to the server
            $pdfPath = public_path('pdf/' . $filename);
            $pdf->save($pdfPath);

            // Attach the PDF to the email
            $pdfData = file_get_contents($pdfPath);
                  Mail::to($userEmail)->send(new SendQuotes($subject, $header, $template, $footer,$title, $pdfData, $filename));

            }
            
            if ($Quotes->status == 2) {
                return response()->json(['success' => true, 'message' => 'Quotes Decline successfully.']);
            } elseif ($Quotes->status == 3) {
                $QuotesNew = Quotes::leftJoin('quotes_cals', 'quotes_cals.quotes_id', '=', 'quotes.id')
                            ->where('quotes.id', $request->Qid)
                            ->select('quotes.*', 'quotes_cals.tax','quotes_cals.BillingCycle', 'quotes_cals.Products_id', 'quotes_cals.unit_price', 'quotes_cals.discount', 'quotes_cals.tax', 'quotes_cals.total')
                            ->first();

                $findQuotes = Orders::where('quotes_id',$Quotes->id)->first();

                if(!empty($findQuotes))
                {

                    // $order = new Orders();
                    $findQuotes->user_id       = Auth::user()->id;
                    $findQuotes->quotes_id     = $QuotesNew->id;
                    $findQuotes->due_date      = $QuotesNew->valid_until;
                    $findQuotes->generated_by  = 1; 
                    $findQuotes->issue_date    =  $QuotesNew->date_created;
                    $findQuotes->product_id    =  $QuotesNew->Products_id;
                    $findQuotes->cost_per_item     =  $QuotesNew->unit_price;
                    $findQuotes->calc_tax      =  $QuotesNew->tax;
                    $findQuotes->taxes      =  $QuotesNew->tax;
                    $findQuotes->client_id     =  $QuotesNew->customer_name;
                    $findQuotes->due_date      =  $QuotesNew->valid_until;
                    $findQuotes->discount_value  =  $QuotesNew->discount;
                    $findQuotes->amount  =  $QuotesNew->total;
                    $findQuotes->save();
                } else{
                    $findQuotes = new Orders();
                    $findQuotes->user_id       = Auth::user()->id;
                    $findQuotes->quotes_id     = $QuotesNew->id;
                    $findQuotes->due_date      = $QuotesNew->valid_until;
                    $findQuotes->generated_by  = 1; 
                    $findQuotes->issue_date    =  $QuotesNew->date_created;
                    $findQuotes->product_id    =  $QuotesNew->Products_id;
                    $findQuotes->cost_per_item     =  $QuotesNew->unit_price;
                    $findQuotes->taxes      =  $QuotesNew->tax;
                    $findQuotes->calc_tax      =  $QuotesNew->tax;
                    $findQuotes->client_id     =  $QuotesNew->customer_name;
                    $findQuotes->due_date      =  $QuotesNew->valid_until;
                    $findQuotes->discount_value  =  $QuotesNew->discount;
                    $findQuotes->amount  =  $QuotesNew->total;
                    $findQuotes->save();
                }

                $invoice_number2 = Invoice::max('invoice_number2');
                $invoice_number2 = (int)$invoice_number2 + 1;
                $datas = [
                    'user_id' => Auth::user()->id,
                    'invoice_number1' => 'INV#',
                    'invoice_number2' => $invoice_number2,
                    'issue_date' =>$QuotesNew->date_created,
                    'Quotesid' =>  $request->Qid,
                     'order_id' =>$findQuotes->id,
                     'product_id' =>$QuotesNew->Products_id,
                    'sub_total' =>$QuotesNew->unit_price,
                    'calc_tax' =>$QuotesNew->tax,
                    'client_id' =>$QuotesNew->customer_name,
                    'due_date' =>$QuotesNew->valid_until,
                    'discount_value' =>$QuotesNew->discount,
                    'final_total_amt' =>$QuotesNew->total,
                    'client_id' =>$QuotesNew->customer_name,
                    'discount_value' =>$QuotesNew->discount,
                    'product_id' =>$QuotesNew->Products_id,
                    'sub_total' =>$QuotesNew->unit_price,
                    'generated_by' =>$QuotesNew->user_id,
                ];

                $invoice = Invoice::create($datas);
                
                $findQuotes->invoice_id = $invoice->id;
                $findQuotes->save();

                return response()->json(['success' => true, 'message' => 'Quotes Accepted successfully.']);
            } elseif ($Quotes->status == 1) {
                $Invoice = Invoice::where('Quotesid', $request->Qid)->first();
                $Orders = Orders::where('quotes_id', $request->Qid)->first();
                if ($Invoice) {
                    $Invoice->forcedelete();
                }

                if ($Orders) {
                    $Orders->forcedelete();
                }

                return response()->json(['success' => true, 'message' => 'Quotes Declined successfully.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Quotes not found.']);
        }
    }



}
