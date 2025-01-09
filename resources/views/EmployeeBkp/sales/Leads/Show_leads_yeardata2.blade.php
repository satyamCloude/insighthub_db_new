@foreach($users as $key => $user)
    @php 
        $assignedto =  \App\Models\User::select('first_name', 'id', 'profile_img')->where('type', '4')->where('id', $user->assignedto)->first();           
        $generated_by =  \App\Models\User::select('first_name', 'id', 'profile_img')->where('id', $user->generated_by)->first();           
        $lead_status =  \App\Models\LeadStatus::select('lead_statuses.label_color as leadStatusColor', 'lead_statuses.lead_status')->where('id', $user->leadStatus)->count(); 
        
        if($lead_status == 0) {
            $lead_status =  \App\Models\LeadStatus::select('lead_statuses.label_color as leadStatusColor', 'lead_statuses.lead_status')->where('id', $user->status)->first(); 
        } else {
            $lead_status =  \App\Models\LeadStatus::select('lead_statuses.label_color as leadStatusColor', 'lead_statuses.lead_status')->where('id', $user->leadStatus)->first(); 
        }   
              $lead_status =  \App\Models\LeadStatus::select('lead_status','id','label_color')->where('id',$user->leadStatus)->first();           
     
    @endphp

    <tr class="{{ $key % 2 == 0 ? 'even' : 'odd' }}">
        <td>{{ $key + 1 }}</td>
        <td>{{ $user->first_name ?? '' }}</td>
        <td>{{ $user->phone_number ?? '' }}</td>
         <td>
                @if($user && $user->requirement)
                    {{ substr(strip_tags($user->requirement), 0, 10) }}
                @else
                    --
                @endif
            </td>
        <td>
            @if($assignedto && $assignedto->first_name)  
                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{ $assignedto->profile_img ? asset($assignedto->profile_img) : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                {{ $assignedto->first_name }}
                <div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{ $assignedto->id }}</div>
            @endif
        </td>
        <td>
            @if($generated_by && $generated_by->first_name)
                <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="{{ $generated_by->profile_img ? asset($generated_by->profile_img) : url('public/images/21104.png')}}" height="30" width="30" alt="User avatar" />
                {{ $generated_by->first_name }}
                <div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{ $generated_by->id }}</div>
            @endif
        </td>
        <!-- <td>
              <span style="background-color:{{$lead_status->label_color}};padding: 5px;border-radius: 4px;">{{ucfirst($lead_status->lead_status)}}</span>
             </td> -->
              <td>
                <div style="display:flex;align-items:center;">
                <div class="status" style="background-color:{{$lead_status->label_color}};width:13px;height:13px;border-radius:50%;">&nbsp;</div>
              <span style="padding: 5px;border-radius: 4px;">{{ucfirst($lead_status->lead_status)}}</span>
</div>
             </td>
      <!--   <td>
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" style="">
                    @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['view'] == 1 || $RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['view'] == 2)
                        <li><a class="dropdown-item" href="{{ url('Employee/Leads/view/' . $user->id) }}">View</a></li>
                    @endif
                    @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                        <li><a class="dropdown-item" href="{{ url('Employee/Leads/edit/' . $user->id) }}">Edit</a></li>
                    @endif
                    @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                        <li><button class="dropdown-item delete_debtcase" url="{{ url('Employee/Leads/delete/' . $user->id) }}" id="{{ $user->id }}">Delete</button></li>
                    @endif
                </ul>
            </div>
        </td>
         -->
            <td>                     @if(in_array('Leads', array_column($RoleAccess, 'per_name')))

              <div class="d-flex">
                                @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['view'] == 1 || $RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['view'] == 2)

                <a href="{{url('Employee/Leads/view/'.$user->id)}}"><svg style="margin-left: 10px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" font-size="1.375rem" class="iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667-6 7-10 7s-7.333-2.333-10-7c2.667-4.667 6-7 10-7s7.333 2.333 10 7"></path></g></svg></a>

@endif
                                @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['delete'] == 1)

                <a href="{{ url('Employee/Leads/delete/'.$user->id) }}" id="{{ $user->id }}" class="delete_debtcase">
                    <svg style="margin-left: 10px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" font-size="1.375rem" class="iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"></path>
                    </svg>
                </a>
                       @endif
      
<a href="{{url('Employee/Quotes/add/?id='.$user->id)}}">
                <svg style="margin-left: 10px; fill: #7367f0;" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/></svg>
                </a>
             </div>
                    @endif

           </td>
    </tr>
@endforeach
