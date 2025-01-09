<?php

namespace App\Http\Controllers\user; // Namespace declaration

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UBalancesheetController extends Controller // Class declaration, extending the Controller class
{
    public function index() // Method within the controller
    {
                  return view('user.balancesheet.home');
        // return view('users.balancesheet.home'); // Returning a view named 'balancesheet.home'
    }
}
