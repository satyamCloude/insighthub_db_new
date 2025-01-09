<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Models\SpecialOffers;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\ProductNew;
use App\Models\InvoiceSettings;
use App\Models\Category;
use App\Models\User;
use App\Models\OperatingSysten;
use App\Models\ClientDetail;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\HostingControlPanel;
use App\Models\Orders;
use App\Models\Product;

use Illuminate\Support\Carbon; // Add this line to import Carbon
use Auth;
use DB;


use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        
        // Add your logic to handle the user after login
        // For example, you can create or update the user in your database

        return redirect()->route('home'); // Redirect to home page after successful login
    }
}