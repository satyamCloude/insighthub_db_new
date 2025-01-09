<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Currency;
use App\Models\Orders;
use App\Models\InvoiceSettings;
use App\Models\CompanyLogin;
use App\Models\Project;
use PDF;
use DB;
use Auth;
use ZipArchive;


class UTransactionController extends Controller


{
    public function index(){
        $invoices = Invoice::select('invoices.*', 'currencies.prefix', 'users.first_name', 'users.last_name', 'users.profile_img', 'users.email','transactions.razorpay_payment_id')
        ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
        ->leftJoin('transactions', 'invoices.id', '=', 'transactions.invoice_id')
        ->leftJoin('client_details', 'client_details.user_id', '=', 'users.id')
        ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
        ->where('invoices.is_payment_recieved', '1')
        ->where('invoices.client_id',auth::user()->id)
        ->orderBy('invoices.created_at', 'desc')
        ->groupBy('transactions.id')
        ->paginate(10);
        // return $invoices;
    $totalAmount = DB::table('invoices')
        ->where('is_payment_recieved', '1')
        ->sum('amount');
        $data = Invoice::where('client_id',auth::user()->id)->where('is_payment_recieved',1)->get();
        return view('user.transaction.home',compact('data','invoices'));
    }






    public function downloadPDF(Request $request)
        { 
            $ids =  explode(",", $request->id);
            $user_id = Auth::user()->id;
            $pdfFiles = [];

            foreach($ids as $id)
            {
                $user = User::find($id);
                $Ticket = Ticket::where('client_id', $id)->get();

                $Invoice = Invoice::with('orders')->find($id);
                $Currency = Currency::where('is_default',1)->first();

                $InvoiceDetailsAll = Orders::where('invoice_id', $id)
                ->with('user', 'clientDetails')
                ->get();
                $InvoiceSettings = InvoiceSettings::first();

                $InvoiceDetails = Invoice::leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
                ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
                ->leftJoin('client_details', 'client_details.user_id', '=', 'invoices.client_id')
                ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
                ->leftJoin('company_logins', 'company_logins.id', '=', 'invoices.generated_by')
                ->select('invoices.*', 'orders.*', 'users.id as user_id', 'users.first_name', 'users.last_name', 'users.email', 'client_details.address_2', 'client_details.address_1', 'client_details.pincode', 'company_logins.company_name', 'currencies.prefix', 'currencies.code')
                ->where('invoices.id', $id)
                ->first();

                $Company = CompanyLogin::select('id', 'company_name', 'contact_no')->where('user_id', $user_id)->first();
                $Project = Project::where('status_id', 1)->get();

                $data = [
                    'Ticket' => $Ticket,
                    'user' => $user,
                    'Currency' => $Currency,
                    'InvoiceDetails' => $InvoiceDetails,
                    'InvoiceSettings' => $InvoiceSettings,
                    'Invoice' => $Invoice,
                    'InvoiceDetailsAll' => $InvoiceDetailsAll,
                    'Company' => $Company,
                    'Project' => $Project,
                ];

                $pdf = PDF::loadView('admin.Invoices.downloadView', $data);
                $filename = 'invoice_' . $id . '.pdf';
                $pdfFiles[] = [
                    'file' => $pdf->output(),
                    'filename' => $filename
                ];
            }

    // Create a ZIP file containing all PDFs
            $zip = new ZipArchive;
            $zipFileName = 'invoices.zip';
            $zipFilePath = storage_path('app/' . $zipFileName);

            if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                foreach ($pdfFiles as $pdfFile) {
                    $zip->addFromString($pdfFile['filename'], $pdfFile['file']);
                }
                $zip->close();
            }

    // Return the ZIP archive as a downloadable response
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        }
}
