<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Producttype;
use Illuminate\Support\Carbon; // Add this line to import Carbon
use Auth;
use DB;


class OrderController2 extends Controller
{
    public function index()
    {   
        $products = Product::paginate(15);
        $searchTerm ='';
        return view('user.order.home',compact('products','searchTerm'));
    }

    
}
