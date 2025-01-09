<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryExport; 
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Models\StorageSetting;
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


class EInventoryController extends Controller
{   
    //home page
   public function home(Request $request)
    {

         $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                    ->join('employee_details','employee_details.job_role_id','role_accesses.role_id')
                    ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                    ->where('employee_details.user_id', Auth::user()->id)
                    ->where(function($query) {
                        $query->where('role_accesses.view', '!=', null)
                            ->orWhere('role_accesses.add', '!=', null)
                            ->orWhere('role_accesses.update', '!=', null)
                            ->orWhere('role_accesses.delete', '!=', null);
                    })
                    ->get()
                    ->toArray();
    
        if($RoleAccess[array_search('Inventory', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = Inventory::select('inventories.id', 'inventories.product_name', 'inventories.purchase_date', 'inventories.warranty_expiry', 'inventories.total_amount', 'users.first_name')
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
            
        }

        if($RoleAccess[array_search('Inventory', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = Inventory::select('inventories.id', 'inventories.product_name', 'inventories.purchase_date', 'inventories.warranty_expiry', 'inventories.total_amount', 'users.first_name')
            ->join('users', 'users.id', 'inventories.assigned_to_id')
            ->where('inventories.user_id',Auth::user()->id)
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
                    
        }

        return view('Employee.Inventory.home', compact('RoleAccess','Inventory','searchTerm'));
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
        $Log['url'] = url('/') . '/Employee/Inventory/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        return view('Employee.Inventory.create',compact('Vendor','Employee')); 
    }


   
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


            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Inventory Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Inventory/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        
        return redirect('Employee/Inventory/home')->with('success', "New Inventory Added Successfully");
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
        $Log['url'] = url('/') . '/Employee/Inventory/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Inventory = Inventory::find($id);
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        return view('Employee.Inventory.edit',compact('Inventory','Vendor','Employee'));
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

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Inventory Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Inventory/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Inventory/home')->with('success', "Inventory Edit Successfully");
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
     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Inventory Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Inventory/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Inventory::find($id)->delete();
        return redirect('Employee/Inventory/home')->with('success', "Inventory Deleted Successfully");
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
            $Log['url'] = url('/') . '/Employee/Inventory/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        return Excel::download(new InventoryExport, 'Inventory.csv');
    }

}
