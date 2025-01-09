<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Hash;
use App\Models\User;
use App\Models\Country;
use App\Models\Currency;
use App\Models\State;
use App\Models\CompanyLogin;
use App\Models\PaymentDetail;
use App\Models\City;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator; // Add this line
use Auth;

class PaymentMethodController extends Controller
{   
    //home page

        public function home(Request $request)
        {
        
            return view('admin.settings.PaymentMethod.home');
        }
    public function store(Request $request)
    {
        // return $request->all();
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'payment_mode' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = PaymentDetail::where('payment_mode', $request->payment_mode)->first();
        $datas = $request->all();

        if (!isset($datas['is_show_on_order_form'])) {
            $datas['is_show_on_order_form'] = 0;
        }
        if (!isset($datas['force_one_time_payments'])) {
            $datas['force_one_time_payments'] = 0;
        }
        if (!isset($datas['force_subscriptions'])) {
            $datas['force_subscriptions'] = 0;
        }
        if (!isset($datas['client_address_matching'])) {
            $datas['client_address_matching'] = 0;
        }
        if (!isset($datas['sandbox_mode'])) {
            $datas['sandbox_mode'] = 0;
        }
        if (!isset($datas['require_shipping_address'])) {
            $datas['require_shipping_address'] = 0;
        }

        if ($data) {
            $data->update($datas);
        } else {
            $data = PaymentDetail::create($datas);
        }


        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $log = $request->all();
        $log['user_id'] = Auth::user()->id;
        $log['ip'] = $request->ip();
        $log['subject'] = "PaymentMethod Data Store By " . Auth::user()->first_name;
        $log['url'] = url('/') . '/admin/PaymentMethod/store';
        $log['method'] = "Post";
        $log['browser'] = $browser . "-" . $version;
        LogActivity::create($log);

        return redirect('admin/Settings/home')->with('success', "New PaymentMethod Added Successfully");
    }
}