<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\PayRollSetting;
use App\Models\PayRollIncrement;
use App\Models\EmployeeDetail;
use App\Models\PayRoll;
use App\Models\User;
use DateTime;
use Hash;
use Auth;


class PayRollSettingController extends Controller
{   
        //home page
      public function home(Request $request)
        {
           $PayRollSetting = PayRollIncrement::select('users.first_name','users.profile_img','users.email','pay_roll_increments.increment_sallery','pay_roll_increments.increment_date','pay_roll_increments.Total_salary','pay_roll_increments.user_id')->leftjoin('users','users.id','pay_roll_increments.user_id')
                                            ->groupBy('pay_roll_increments.user_id')
                                            ->orderBy('pay_roll_increments.created_at','desc')
                                            ->get();
           $Employee = User::select('id','first_name')->where('type',4)->get();

           $PayCron = PayRollSetting::where('id',1)->first();

           return view('admin.settings.PayRollSetting.home',compact('Employee','PayRollSetting','PayCron'));
        }

        public function store(Request $request)
        {
            PayRollIncrement::create($request->all());

            $EmployeeDetail = EmployeeDetail::where('user_id',$request->user_id)->first();
            $EmployeeDetail->net_salary = $request->Total_salary;
            $EmployeeDetail->save();

            return redirect()->back()->with('success', 'Increment has been scheduled successfully.');
        }


        public function EmployeeData(Request $request)
        {
            
            $EmployeeData = EmployeeDetail::select('net_salary')->where('user_id', $request->id)->first();

            if ($EmployeeData) {
                return response()->json(['data' => $EmployeeData, 'success' => true, 'status' => 200]);
            } else {
                return response()->json(['success' => false, 'status' => 400]);
            }
        }

        public function view(Request $request,$id)
        {
           $PayRollSetting = PayRollIncrement::select('users.first_name','users.profile_img','users.email','pay_roll_increments.increment_sallery','pay_roll_increments.increment_date','pay_roll_increments.Total_salary','pay_roll_increments.id')
                                            ->leftjoin('users','users.id','pay_roll_increments.user_id')
                                            ->where('pay_roll_increments.user_id',$id)
                                            ->orderBy('pay_roll_increments.created_at','desc')
                                            ->get();
           return view('admin.settings.PayRollSetting.view',compact('PayRollSetting'));
        }

        public function SettingApply(Request $request,$id)
        {
            $SettingApply = PayRollSetting::find($id);
            $SettingApply->cron_url = $request->cron_url;
            $SettingApply->cron_date = $request->cron_date;
            if($request->auto_generate == 'on')
            {
            $SettingApply->auto_generate = 1;
            }else{
            $SettingApply->auto_generate = 0;
            }
            $SettingApply->save();
            return redirect()->back()->with('success', 'New Settings updated successfully.');
        }
        public function AutoGenerate(Request $request)
        {
            $PaySet = PayRollSetting::find(1);


            if($PaySet->auto_generate == 1)
            {
              $cron_date = new DateTime($PaySet->cron_date);
              $cron_date_formatted = $cron_date->format('d');
              $currentdate = date('d'); 
              if($currentdate == $cron_date_formatted)
              {

                $currentYear = date('Y');
                $currentMonth = date('m');

                $PayR = PayRoll::whereYear('date', $currentYear)
                    ->whereMonth('date', $currentMonth)
                    ->count();

                if($PayR == 0)
                {
                  $User = User::select('users.id', 'employee_details.net_salary')
                    ->join('employee_details', 'employee_details.user_id', 'users.id')
                    ->where('users.type', 4)
                    ->get();

                    foreach ($User as $userData) {
                        $PayRoll = new PayRoll;
                        $PayRoll->net_salary = $userData->net_salary;
                        $PayRoll->emp_id = $userData->id;
                        $PayRoll->date = now();  // Set the current date
                        $PayRoll->save();
                    }

                    echo "Sallery Generated";

                }else{

                    echo "Sallery not Generated";
                
                }   
              }
            }
        }


}
