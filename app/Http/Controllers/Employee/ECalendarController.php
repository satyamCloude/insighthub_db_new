<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Calendar;
use App\Models\Holiday;
use Hash;
use Auth;
use DateTime;


class ECalendarController extends Controller
{   
    //home page
   public function home()
    {
        $Calendar = Calendar::get();
        
        foreach($Calendar as $Cal)
        {
            $Cal->start = new DateTime($Cal->start);
            $Cal->start = date('Y').'-'.$Cal->start->format('m-d');
            $Cal->end = new DateTime($Cal->end);
            $Cal->end = date('Y').'-'.$Cal->end->format('m-d');
            $Cal->startStr = new DateTime($Cal->startStr);
            $Cal->startStr = date('Y').'-'.$Cal->startStr->format('m-d');
            $Cal->endStr = new DateTime($Cal->endStr);
            $Cal->endStr = date('Y').'-'.$Cal->endStr->format('m-d');
            $Cal->created_at = new DateTime($Cal->created_at);
            $Cal->created_at = date('Y').'-'.$Cal->created_at->format('m-d');
        }
        $Employee = User::select('first_name','id')->where('type',4)->get();
        
        return view('Employee.Humanesources.Calendar.home', compact('Calendar','Employee'));
    }



    //home page
    public function Create()
    {   
        $Employee = User::select('first_name','id')->where('type',4)->get();
        return view('Employee.Humanesources.JobRole.create',compact('Employee')); 
    }


    //home page
    public function store(Request $request)
    {
        try {
            // Extract additional properties from extendedProps
            $extendedProps = $request->input('extendedProps', []);

            // Use null coalescing operator to set default values
            $location = $extendedProps['location'] ?? null;
            $guests = $extendedProps['guests'] ?? [];
            $calendar = $extendedProps['calendar'] ?? null;
            $description = $extendedProps['description'] ?? null;

            // Create the calendar event in the database
            $calendarEvent = Calendar::create([
                'user_id' => Auth::user()->id,
                'start' => $request->input('start', null),
                'title' => $request->input('title', null),
                'startStr' => $request->input('startStr', null),
                'endStr' => $request->input('endStr', null),
                'display' => $request->input('display', null),
                'location' => $location,
                'guests' => json_encode($guests), // Assuming guests are stored as JSON
                'calendar' => $calendar,
                'description' => $description,
                'allDay' => $request->input('allDay', 0),
                'url' => $request->input('url', null),
                'end' => $request->input('end', null),
                'id' => $request->input('id', null),
            ]);

            return response()->json($calendarEvent, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    //home fatch
    public function fetchData(Request $req)
    {
        // Fetch events from the Calendar model
        $calendarEvents = Calendar::join('users','users.id','calendars.user_id')
        ->select('calendars.*','users.profile_img','users.first_name')
        ->get(); // Assuming Calendar is your model
        
        // Fetch events from the Holiday model
        $holidayEvents = Holiday::leftjoin('users','users.id','holidays.user_id')
        ->select('holidays.*','users.profile_img','users.first_name')->get(); 

        // Format Calendar events
        $formattedCalendarEvents = $calendarEvents->map(function ($event) {
            $formattedEvent = [
                'id' => $event->id,
            ];
        
            // Conditionally add 'url' immediately after 'id' if it exists
            if ($event->url !== null) {
                $formattedEvent['url'] = $event->url;
            }
            $title =  $event->first_name . ' ' . $event->title;
              
              
            // Add other properties
            $formattedEvent += [
                'title' => $title,
                'start' => $event->start,
                'end' => $event->end,
                'allDay' => $event->allDay,
                'extendedProps' => [
                    'calendar' => $event->calendar,
                ],
            ];
            
            return $formattedEvent;
        });
        
        // Format Holiday events
        $formattedHolidayEvents = $holidayEvents->map(function ($event) {
            
            
            $formattedEvent = [
                'id' => $event->id,
            ];
        
            // Conditionally add 'url' immediately after 'id' if it exists
            if ($event->url !== null) {
                $formattedEvent['url'] = $event->url;
            }
        
            // Add other properties
            $formattedEvent += [
                'title' => $event->description,
                'start' => $event->date,
                'end' => $event->date,
                'allDay' => false,
                'extendedProps' => [
                    'calendar' => 'Holiday',
                ],
            ];
            
            return $formattedEvent;
        });
        
       

        // Merge the formatted events from both models into a single array
        $events = $formattedCalendarEvents->merge($formattedHolidayEvents);
        $events = $events->sortBy('id')->values()->all();
        return response()->json($events);
    
    }

    public function update(Request $request)
    {
        
        try {
            // Extract additional properties from extendedProps
            $extendedProps = $request->input('extendedProps', []);

            // Use null coalescing operator to set default values
            $location = $extendedProps['location'] ?? null;
            $guests = $extendedProps['guests'] ?? [];
            $calendar = $extendedProps['calendar'] ?? null;
            $description = $extendedProps['calendar'] ?? null;

            // Create the calendar event in the database
            $calendarEvent = Calendar::find($request->id);
            $calendarEvent->update([
                'user_id' => Auth::user()->id,
                'start' => $request->input('start', null),
                'title' => $request->input('title', null),
                'startStr' => $request->input('startStr', null),
                'endStr' => $request->input('endStr', null),
                'display' => $request->input('display', null),
                'location' => $location,
                'guests' => json_encode($guests), // Assuming guests are stored as JSON
                'calendar' => $calendar,
                'description' => $description,
                'allDay' => $request->input('allDay', 0),
                'url' => $request->input('url', null),
                'end' => $request->input('end', null),
            ]);

            return response()->json($calendarEvent, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $calendarEvent = Calendar::findOrFail($id);
            $calendarEvent->delete();
            return response()->json(['message' => 'Calendar event deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




}
