<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Department;
use App\Models\Chat;
use App\Models\Template;
use App\Models\MailSettings;
use App\Models\Product;
use App\Models\ClientDetail;
use App\Models\Notification;
use App\Models\Ticket;
use App\Models\EmployeeDetail;
use App\Models\User;
use App\Events\AppEvents;
use Hash;
use Auth;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\Mail;
use DB;

class ServiceMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       return view('admin.MonitoringService.ServiceMonitoring.index'); 
    }
}