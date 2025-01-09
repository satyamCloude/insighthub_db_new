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
use Hash;
use Auth;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;


class InventoryController extends Controller
{   
    //home page
   public function home(Request $request)
    {
        $query = Inventory::select('inventories.id','users.profile_img','users.email', 'inventories.product_name', 'inventories.purchase_date', 'inventories.warranty_expiry', 'inventories.total_amount', 'users.first_name')
            ->join('users', 'users.id', 'inventories.assigned_to_id')
            ->orderBy('inventories.created_at', 'desc');

        $searchTerm ='';    

        // Check if a search term is provided in the request
        if ($request->has('search')) {
            $searchTerm = $request->input('search');

            // Modify the query to search for the provided term
            $query->where(function ($q) use ($searchTerm) {
                $q->where('inventories.product_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('inventories.warranty_expiry', 'like', '%' . $searchTerm . '%')
                  ->orWhere('inventories.purchase_date', 'like', '%' . $searchTerm . '%')
                  ->orWhere('inventories.phone_number', 'like', '%' . $searchTerm . '%')
                  ->orWhere('inventories.brand_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Execute the query and paginate the results
        $Inventory = $query->paginate(10);
         $Inventory->appends(['search' => $searchTerm]);

        return view('admin.Inventory.home', compact('Inventory','searchTerm'));
    }




    //home page
    public function Create(Request $request)
    {   
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Inventory Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Inventory/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        return view('admin.Inventory.create',compact('Vendor','Employee')); 
    }


    //home page
  
  public function store(Request $req)
{
    $url = url('/').'/public/images/';
    $StorageSetting = StorageSetting::find(1);

    // Process bill_attachment
    $bill_attachment = 'default_bill_attachment.jpg';
    if ($req->hasFile('bill_attachment')) {
        $rand = Str::random(4);
        $file = $req->file('bill_attachment');
        $extension = $file->getClientOriginalExtension();
        $bill_attachment = 'bill_'.$rand.'.'.$extension;

        if ($StorageSetting->status == 0) {
            $file->move(public_path('images/'), $bill_attachment);
            $bill_attachment_url = $url . $bill_attachment;
        } else {
            $bill_attachment_url = $this->uploadToS3($StorageSetting, $bill_attachment, $file);
        }
    } else {
        $bill_attachment_url = $url . $bill_attachment; // Default if no file is uploaded
    }

    $data = $req->all();
    $data['bill_attachment'] = $bill_attachment_url;
    $data['user_id'] = Auth::user()->id;
    $data['password'] = Hash::make($req->password);
    Inventory::create($data);

    $this->createLogActivity($req, 'Inventory Data Updated', Auth::user()->id); // Pass $id as parameter

    return redirect('admin/Inventory/home')->with('success', "New Inventory Added Successfully");
}


    //edit
    public function edit(Request $req,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Inventory Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Inventory/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Inventory = Inventory::find($id);
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        return view('admin.Inventory.edit',compact('Inventory','Vendor','Employee'));
    }
public function update(Request $req, $id)
{
    $data = Inventory::find($id);
    $StorageSetting = StorageSetting::find(1);

    $data->user_id = Auth::user()->id;
    $data->product_name = $req->product_name;
    $data->product_code = $req->product_code;
    $data->brand_name = $req->brand_name;
    $data->phone_number = $req->phone_number;
    $data->purchase_date = $req->purchase_date;
    $data->warranty_expiry = $req->warranty_expiry;
    $data->base_amount = $req->base_amount;
    $data->gst_vat = $req->gst_vat;
    $data->tax_amount = $req->tax_amount;
    $data->total_amount = $req->total_amount;
    $data->assigned_to_id = $req->assigned_to_id;
    $data->Vendor_id = $req->Vendor_id;
    $data->product_description = $req->product_description;

    if ($req->hasFile('bill_attachment')) {
        $rand = Str::random(4);
        $file = $req->file('bill_attachment');
        $extension = $file->getClientOriginalExtension();
        $bill_attachment = 'bill_'.$rand.'.'.$extension;

        if ($StorageSetting->status == 0) {
            $file->move(public_path('images/'), $bill_attachment);
            $data->bill_attachment = url('/public/images/') . '/' . $bill_attachment;
        } else {
            $data->bill_attachment = $this->uploadToS3($StorageSetting, $bill_attachment, $file);
        }
    }

    $data->save();

    $this->createLogActivity($req, 'Inventory Data Updated', $id); // Pass $id as parameter

    return redirect('admin/Inventory/home')->with('success', "Inventory Edit Successfully");
}


private function createLogActivity($req, $subject, $id)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);

    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = $subject . " By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Inventory/update/' . $id; // Use $id parameter here
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;

    LogActivity::create($Log);
}


private function uploadToS3($StorageSetting, $fileName, $file)
{
    config([
        'filesystems.disks.s3.key' => $StorageSetting->AWS_ACCESS_KEY_ID,
        'filesystems.disks.s3.secret' => $StorageSetting->AWS_SECRET_ACCESS_KEY,
        'filesystems.disks.s3.region' => $StorageSetting->AWS_DEFAULT_REGION,
        'filesystems.disks.s3.bucket' => $StorageSetting->AWS_BUCKET,
    ]);

    $basePath = 'images/' . date('y') . '/' . date('m') . '/' . $fileName;
    $path = Storage::disk('s3')->put($basePath, $file, 'public');
    $url = $StorageSetting->S3_BASE_URL . '/' . $path;

    return $url;
}

    //updated
    public function updatesOld(Request $req, $id)
    {
        $data = Inventory::find($id);
        $data['user_id'] = Auth::user()->id;
        $data['product_name'] = $req->product_name;
        $data['product_code'] = $req->product_code;
        $data['brand_name'] = $req->brand_name;
        $data['phone_number'] = $req->phone_number;
        $data['purchase_date'] = $req->purchase_date;
        $data['warranty_expiry'] = $req->warranty_expiry;
        $data['base_amount'] = $req->base_amount;
        $data['gst_vat'] = $req->gst_vat;
        $data['tax_amount'] = $req->tax_amount;
        $data['total_amount'] = $req->total_amount;
        $data['assigned_to_id'] = $req->assigned_to_id;
        $data['Vendor_id'] = $req->Vendor_id;
        $data['product_description'] = $req->product_description;
        if($req->hasFile('bill_attachment')) {
             $bill_attachment = 'profile_' . Str::random(4) . '.' . $req->file('bill_attachment')->getClientOriginalExtension();
             $req->file('bill_attachment')->move('public/images/', $bill_attachment);
             $data->bill_attachment = url('/public/images/') . '/' . $bill_attachment;
          }
        $data->save();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Inventory Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Inventory/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/Inventory/home')->with('success', "Inventory Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Inventory Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Inventory/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Inventory::find($id)->delete();
        return redirect('admin/Inventory/home')->with('success', "Inventory Deleted Successfully");
    }

      // ExportCSV
    public function EXPORTCSV(Request $request)
    {
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "Inventory CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/Inventory/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        return Excel::download(new InventoryExport, 'Inventory.csv');
    }

}
