<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryExport; 
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\IPAddress;
use App\Models\Inventory;   
use App\Models\Countrys;
use App\Models\Employee;
use App\Models\Currency;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\Switchs;
use App\Models\Status;
use App\Models\User;
use App\Models\Rack;
use App\Models\HostingControlPanel;
use Hash;
use Auth;

class HostingsController extends Controller
{
    public function home(Request $req){
        $host = HostingControlPanel::get();
        return view('admin.sales.HostingPanel.home', compact('host'));
    }
    public function Create(Request $request){
        $currencies = Currency::get();
        return view('admin.sales.HostingPanel.create',compact('currencies'));
    }
    public function store(Request $req){
        $data = $req->all();
        HostingControlPanel::create($data);
        return redirect('admin/Settings/home')->with('success', "New Hosting Added Successfully");
    }
    public function edit(Request $req,$id){
        $currencies = Currency::get();
        $data = HostingControlPanel::find($id);
        return view('admin.sales.HostingPanel.edit',compact('data','id','currencies'));
    }
    public function update(Request $req,$id){
        $data = HostingControlPanel::find($id);
        $data['hosting_name'] = $req->hosting_name;
        $data['price'] = $req->price;
        $data['status'] = $req->status;
        $data['currency_id'] = $req->currency_id;
        $data['plan_type'] = $req->plan_type;

        $data->save();
        return redirect('admin/HostingPanel/home')->with('success', "Hosting Edited Successfully");
    }
    public function delete($id)  
    {  
        $data = HostingControlPanel::find($id);  
        $data -> delete();  
        return redirect()->back()->with('success', "Hosting Deleted Successfully");
    }
}
