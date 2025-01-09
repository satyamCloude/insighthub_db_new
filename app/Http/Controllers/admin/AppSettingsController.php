<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Exports\AcronisExport; 
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;

use App\Models\IPAddress;
use App\Models\Countrys;
use App\Models\Currency;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\AppSetting;
use App\Models\Switchs;
use App\Models\Acronis;   
use App\Models\Status;
use App\Models\User;
use App\Models\Host;
use App\Models\Rack;
use Hash;
use Auth;

use Intervention\Image\Facades\Image;


class AppSettingsController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        $pSe = AppSetting::where('id',1)->first();
        $Currency = Currency::get();
       
        return view('admin.settings.AppSettings.home',compact('pSe','Currency'));
    }
// Store method
public function store(Request $request)
{
    $url = url('/').'/public/images/';

    $data = AppSetting::find(1);
    $data->user_id = Auth::user()->id;
    $data->date_format = $request->date_format;
    $data->time_format = $request->time_format;
    $data->timezone = $request->timezone;
    $data->currencyid = $request->currencyid;
    $data->Language = $request->Language;
    $data->datatable_row_limit = $request->datatable_row_limit;
    $data->Employeecanexportdata = $request->Employeecanexportdata;
    $data->welcometext = $request->welcometext;
    $data->welcometextEmployee = $request->welcometextEmployee;
    $data->welcometextClient = $request->welcometextClient;

    $StorageSetting = StorageSetting::find(1);
    $storageLocal = $StorageSetting->status == 0;

    // Process Company Logo
    if ($request->hasFile('CompanyLogo')) {
        $CompanyLogo = 'file_doc_' . Str::random(4) . '.' . $request->file('CompanyLogo')->getClientOriginalExtension();
        $image = Image::make($request->file('CompanyLogo'));
        $image->encode('jpg', 80);

        if ($storageLocal) {
            $image->save(public_path('images/' . $CompanyLogo));
            $data->CompanyLogo = url('public/images') . '/' . $CompanyLogo;
        } else {
            $url = $this->Upload($StorageSetting, $CompanyLogo, $request->file('CompanyLogo'));
            $data->CompanyLogo = $url;
        }
    }

    // Process Company Banner
    if ($request->hasFile('CompanyBanner')) {
        $CompanyBanner = 'file_doc_' . Str::random(4) . '.' . $request->file('CompanyBanner')->getClientOriginalExtension();
        $image = Image::make($request->file('CompanyBanner'));
        $image->resize(800, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->encode('jpg', 80);

        if ($storageLocal) {
            $image->save(public_path('images/' . $CompanyBanner));
            $data->CompanyBanner = url('public/images') . '/' . $CompanyBanner;
        } else {
            $url = $this->Upload($StorageSetting, $CompanyBanner, $request->file('CompanyBanner'));
            $data->CompanyBanner = $url;
        }
    }

    // Process Company Banner for Employee
    if ($request->hasFile('CompanyBannerEmployee')) {
        $CompanyBannerEmployee = 'file_doc_' . Str::random(4) . '.' . $request->file('CompanyBannerEmployee')->getClientOriginalExtension();
        $image = Image::make($request->file('CompanyBannerEmployee'));
        $image->resize(800, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->encode('jpg', 80);

        if ($storageLocal) {
            $image->save(public_path('images/' . $CompanyBannerEmployee));
            $data->CompanyBannerEmployee = url('public/images') . '/' . $CompanyBannerEmployee;
        } else {
            $url = $this->Upload($StorageSetting, $CompanyBannerEmployee, $request->file('CompanyBannerEmployee'));
            $data->CompanyBannerEmployee = $url;
        }
    }

    // Process Company Banner for Client
    if ($request->hasFile('CompanyBannerClient')) {
        $CompanyBannerClient = 'file_doc_' . Str::random(4) . '.' . $request->file('CompanyBannerClient')->getClientOriginalExtension();
        $image = Image::make($request->file('CompanyBannerClient'));
        $image->resize(800, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->encode('jpg', 80);

        if ($storageLocal) {
            $image->save(public_path('images/' . $CompanyBannerClient));
            $data->CompanyBannerClient = url('public/images') . '/' . $CompanyBannerClient;
        } else {
            $url = $this->Upload($StorageSetting, $CompanyBannerClient, $request->file('CompanyBannerClient'));
            $data->CompanyBannerClient = $url;
        }
    }

    $data->save();

    $Currency = Currency::find($request->currencyid);
    if ($Currency) {
        Currency::where('id', '!=', $request->currencyid)->update(['is_default' => 0]);
        $Currency->is_default = 1;
        $Currency->save();
    }

    return redirect()->back()->with('success', "AppSettings Updated Successfully");
}

// Upload method
public function Upload($StorageSetting, $fileName, $file)
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

}
