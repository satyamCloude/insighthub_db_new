<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\File;
use App\Models\LeadFile;
use App\Models\User;
use Hash;
use Auth;


class ELeadFileController extends Controller
{  

    public function store(Request $req)
    {
        $url = url('/').'/public/images/';

        foreach ($req->file as $key => $value) {
            $data = new LeadFile;

            $profileFilename = 'file.jpg';
            $originalFileName = pathinfo($value->getClientOriginalName(), PATHINFO_FILENAME);

            // Check if the file with the same name exists
            $existingFile = LeadFile::where('file_name', $originalFileName)->first();

            if ($existingFile) {
                // Append a unique identifier to the file name
                $rand = Str::random(4);
                $originalFileName .= '_' . $rand;
            }

            $file = $req->file('file')[$key];
            $extension = $file->getClientOriginalExtension();
            $profileFilename = 'file_doc_'.$originalFileName.'.'.$extension;

            $file->move('public/images/', $profileFilename);

            $data['file'] = $url . $profileFilename;
            $data['file_name'] = $originalFileName;
            $data['leads_id'] = $req->leads_id;
            $data['user_id'] = Auth::user()->id;
            $data->save();
        }

     return redirect('Employee/Leads/view/'.$req->leads_id)->with('success', 'New File(s) Added Successfully');

    }




     public function delete(Request $request,$id,$leads_id)
    {
        LeadFile::find($id)->delete();
        return redirect('Employee/Leads/view/'.$leads_id)->with('success', 'File Deleted Successfully');
    }
}
