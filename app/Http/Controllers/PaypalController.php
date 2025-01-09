<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpException;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Srmklive\PayPal\Services\ExpressCheckout;
use GuzzleHttp\Client;
use App\Models\User;
use App\Models\Credit;
use Session;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use PayPalCheckoutSdk\Core\ProductionEnvironment;


class PaypalController extends Controller
{
    public function handlePayment(Request $request)
    {
        // return $request->all();
        $amount = isset($request->amount) ? $request->amount : "10.00";
        if($request->currency_code == 'INR'){
            $amountUSD = $this->convertINRtoUSD($amount);
            $request->currency_code = 'USD';
        }else{
            $amountUSD = $amount ;
        }
        if(isset($request->type) && $request->type == 'credit'){
            $returnUrl = url('user/Credit/store?amount='.$amount);
        }else if($request->has('wallet_amt')){
            $returnUrl = url('paypal/payment-success?order_id=' . $request->order_id . '&wallet_amt='.$request->wallet_amt);
        }
        else{
            $returnUrl = url('paypal/payment-success?order_id=' . $request->order_id);
        }
        
        // return $returnUrl;
    
        if ($amountUSD > 0) {
            $amountUSD = number_format($amountUSD, 2, '.', '');
            $paymentDetails = PaymentDetail::where('payment_mode', 2)->first(); // Retrieve payment details from database
    
            // Check if payment details are retrieved successfully
            if ($paymentDetails) {
                $clientId = $paymentDetails->api_username;
                $clientSecret = $paymentDetails->api_password;
                $sandboxMode = $paymentDetails->sandbox_mode == 1 ? true : false;
    
                $environment = $sandboxMode ? new SandboxEnvironment($clientId, $clientSecret) : new ProductionEnvironment($clientId, $clientSecret);
                $client = new PayPalHttpClient($environment);
    
                $request2 = new OrdersCreateRequest();
                $request2->prefer('return=representation');
                $request2->body = [
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => $returnUrl,
                        "cancel_url" => route('cancel.payment'),
                    ],
                    "purchase_units" => [
                        [
                            "amount" => [
                                "currency_code" => $request->currency_code,
                                "value" => $amountUSD
                            ]
                        ]
                    ]
                ];
    
                try {
                    $response = $client->execute($request2);
                    // return $response->result;
                    // Handle success response
                    return redirect()->away($response->result->links[1]->href);
                } catch (\PayPalHttp\HttpException $ex) {
                    return $ex->getMessage();
                    // Handle exception
                    return redirect()->route('cancel.payment')->with('error', 'Something went wrong.');
                }
            } else {
                return redirect()->route('create.payment')->with('error', 'Payment details not found.');
            }
        } else {
            return redirect()->route('create.payment')->with('error', 'Failed to fetch exchange rate.');
        }
    }
    
public function handlePaymentRegistration(Request $request)
{
    Log::info('Payment Request Data:', $request->all());

    $amount = $request->input('amount', '100.00');
    $user = $request->input('user');
    $currencyCode = $request->input('currency_code', 'INR');

    // Convert currency if needed
    if ($currencyCode == 'INR') {
        $amountUSD = $this->convertINRtoUSD($amount);
        $currencyCode = 'USD';
    } else {
        $amountUSD = $amount;
    }

    $amountUSD = number_format($amountUSD, 2, '.', '');
    $returnUrl = url('paypal/payment-success-registration') . '?user=' . urlencode($user) . '&amount=' . urlencode($amountUSD);
    $cancelUrl = url('paypal/payment-cancel-registration') . '?user=' . urlencode($user) . '&amount=' . urlencode($amountUSD);

    if ($amountUSD > 0) {
        $paymentDetails = PaymentDetail::where('payment_mode', 2)->first();

        if ($paymentDetails) {
            $clientId = $paymentDetails->api_username;
            $clientSecret = $paymentDetails->api_password;
            $sandboxMode = $paymentDetails->sandbox_mode == 1;

            $environment = $sandboxMode
                ? new SandboxEnvironment($clientId, $clientSecret)
                : new ProductionEnvironment($clientId, $clientSecret);
            $client = new PayPalHttpClient($environment);

            $request2 = new OrdersCreateRequest();
            $request2->prefer('return=representation');
            $request2->body = [
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => $returnUrl,
                    "cancel_url" => $cancelUrl,
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => $currencyCode,
                            "value" => $amountUSD
                        ]
                    ]
                ]
            ];

            try {
                $response = $client->execute($request2);

                $approvalLink = collect($response->result->links)
                    ->firstWhere('rel', 'approve')
                    ->href;

                if ($approvalLink) {
                    return redirect()->away($approvalLink);
                } else {
                    Log::error('Approval link not found in PayPal response');
                    return redirect($cancelUrl)->with('error', 'Failed to get approval link from PayPal.');
                }
            } catch (\PayPalHttp\HttpException $ex) {
                Log::error('PayPal HTTP Exception:', ['message' => $ex->getMessage()]);
                return redirect($cancelUrl)->with('error', 'Something went wrong.');
            }
        } else {
            return redirect($cancelUrl)->with('error', 'Payment details not found.');
        }
    } else {
        return redirect($cancelUrl)->with('error', 'Invalid amount.');
    }
}


   public function paymentSuccess2(Request $request)
{
    $userId = $request->input('user');
    $amount = $request->input('amount');
    if (!$userId || !$amount) {
        return redirect('https://crm1.cloudtechtiq.com/')->with('error', 'Invalid payment details.');
    }

    // Insert transaction record
    try {
        DB::table('transactions')->insert([
            'user_id' => $userId,
            'amount' => $amount,
            'status' => 'completed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::find($userId);
        if ($user) {
            $user->email_verified_at = now();
            $user->payment_status = 1;
            $user->status = 4;
            $user->save();
        }

        return redirect('https://crm1.cloudtechtiq.com/')->with('success', 'Payment successful and registration completed.');
    } catch (\Exception $e) {
        // Log the error and redirect with an error message
        Log::error('Transaction Insertion Error:', ['message' => $e->getMessage()]);
        return redirect('https://crm1.cloudtechtiq.com/')->with('error', 'Something went wrong with the payment processing.');
    }
}


    public function paymentCancel2()
    {
        return redirect('https://crm1.cloudtechtiq.com/')->with('error', 'Payment was canceled.');
    }

    private function convertINRtoUSD2($amountINR)
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/INR');

        if ($response->successful()) {
            $exchangeRateData = $response->json();
            $exchangeRate = $exchangeRateData['rates']['USD'];
            return $amountINR * $exchangeRate;
        } else {
            Log::error('Exchange rate API error:', ['status' => $response->status()]);
            return null;
        }
    }

   
  public function paymentCancel()
  {
    return 'cancel';
    return redirect()
      ->route('create.payment')
      ->with('error', $response['message'] ?? 'You have canceled the transaction.');
  }

    public function paymentSuccess(Request $request)
    {
        $order_id = $request->order_id;
        $token = $request->token;
        // Accessing the wallet_amt from query parameters
        $wallet_amt = $request->wallet_amt;
        
    
        // Retrieve PayPal configuration from database
        $paymentDetails = PaymentDetail::where('payment_mode', 2)->first();
    
        if ($paymentDetails) {
            $clientId = $paymentDetails->api_username;
            $clientSecret = $paymentDetails->api_password;
            $sandboxMode = $paymentDetails->sandbox_mode == 1 ? true : false;
    
            $environment = $sandboxMode ? new SandboxEnvironment($clientId, $clientSecret) : new ProductionEnvironment($clientId, $clientSecret);
            $client = new PayPalHttpClient($environment);
    
            try {
                // Capture the payment
                $request = new OrdersCaptureRequest($token);
                $response = $client->execute($request);
    // return $response;
                // Check if payment is completed
                if ($response->result->status == 'COMPLETED') {
                    // Extract necessary information
                    $amount = $response->result->purchase_units[0]->payments->captures[0]->amount->value;
                    $captureId = $response->result->purchase_units[0]->payments->captures[0]->id;
    
                    if($wallet_amt && $wallet_amt > 0){
                        Credit::create([
                            'client_id' => Auth::user()->id,
                            'amount' => '-'.$wallet_amt
                        ]);
                    }
    
                    // Redirect to update order page with payment information
                    return redirect()->to(url('user/order/update') . "?orderId=" . $order_id . "&payment_id=" . $captureId . "&amount=" . $amount);
                } else {
                    // Payment not completed
                    return redirect()->route('create.payment')->with('error', 'Payment was not completed.');
                }
            } catch (\PayPalHttp\HttpException $ex) {
                // Handle exception
                return redirect()->route('create.payment')->with('error', 'Something went wrong with PayPal.');
            }
        } else {
            // PayPal configuration not found
            return redirect()->route('create.payment')->with('error', 'PayPal configuration not found.');
        }
    }


  //////PAYMENT REFUND
  public function refund($captureId, $amount)
  {

    $client = new Client([
      'base_uri' => 'https://api-m.sandbox.paypal.com/',
      'headers' => [
        'Content-Type' => 'application/json',
      ],
      'auth' => [
        config('services.paypal.client_id'),
        config('services.paypal.secret'),
      ],
    ]);

    try {
      $response = $client->post('v1/payments/captures/' . $captureId . '/refund', [
        'json' => [
          'amount' => [
            'value' => $amount,
            'currency_code' => 'USD', // Change currency code as needed
          ],
        ],
      ]);

      $responseData = json_decode($response->getBody(), true);

      // Process the refund response as needed
      return response()->json($responseData);
    } catch (\Exception $e) {
      // Handle refund failure
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }


    public function convertINRtoUSD($amountINR)
    {
        // Fetch exchange rate from the API
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/INR');

        // Check if the request was successful
        if ($response->successful()) {
            // Get exchange rate data
            $exchangeRateData = $response->json();
            // return $exchangeRateData;
            // Get the exchange rate for INR to USD
            $exchangeRate = $exchangeRateData['rates']['USD'];

            // Convert amount from INR to USD
            $amountUSD = $amountINR * $exchangeRate;

            // Return the converted amount
            return $amountUSD;
        } else {
            // Handle API request failure
            return null;
        }

    }
}
