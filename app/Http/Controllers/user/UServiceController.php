<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class UServiceController extends Controller


{
	public function index(){
		return view('user.services.home');
	}
}
