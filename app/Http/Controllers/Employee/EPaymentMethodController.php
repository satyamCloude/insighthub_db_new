<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Hash;
use App\Models\User;
use App\Models\Country;
use App\Models\Currency;
use App\Models\State;
use App\Models\CompanyLogin;
use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;


class EPaymentMethodController extends Controller
{   
    //home page

        public function home(Request $request)
        {
        
            return view('Employee.settings.PaymentMethod.home');
        }
}
