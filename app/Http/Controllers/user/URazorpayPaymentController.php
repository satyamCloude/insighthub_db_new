<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Transaction;
use auth;
use Session;
use Hash;
use Razorpay\Api\Api;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
  
class URazorpayPaymentController extends Controller
{
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {        
        return view('user.razorpay.razorpayView');
    }

   
public function store(Request $request): RedirectResponse
{
    
    try {
          
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
       
       $Transaction = [
            'user_id' => $request->user_id,
            'quotes_id' => $request->quotes_id,
            'invoice_id' => $request->invoice_id,
            'transactions_id' => $response->acquirer_data->upi_transaction_id,
            'razorpay_payment_id' => $input['razorpay_payment_id'],
            'amount' => $response->amount / 100, // Convert paise to rupees
            'status' => $response->status,
            'razerpay_created_at' => $response->created_at,
            'razerpay_contact' => $response->contact,
            'razerpay_vpa' => $response->vpa,
        ];

        if ($response['status'] == 'captured') {
            Transaction::create($Transaction);
            $invoice = Invoice::where('Quotesid',$request->invoice_id)->first();
            $invoice->is_payment_recieved = 1;
            $invoice->save();
            
                Session::put('success', 'Payment successfully captured');
        } else {
            Transaction::create($Transaction);
            Session::put('error', 'Payment capture failed');
        }
         return redirect()->back();
    } catch (Exception $e) {
    Log::error('Razorpay Payment Exception: ' . $e->getMessage());
    Session::put('error', 'An unexpected error occurred.');
    return redirect()->back();
}

    
}



}