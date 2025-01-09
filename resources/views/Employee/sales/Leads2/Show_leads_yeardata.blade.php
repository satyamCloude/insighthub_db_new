@foreach($users as $key=> $user)
    @php 
      $assignedto =  \App\Models\User::select('first_name')->where('type', '4')->where('id',$user->assignedto)->first();           
      $generated_by =  \App\Models\User::select('first_name')->where('id',$user->generated_by)->first();           
    @endphp
    <tr class="odd">
        <td>{{ $key+1 }} </td>
        <td>@if($user && $user->first_name) {{ $user->first_name }} @endif</td>
        <td>@if($user && $user->phone_number) {{ $user->phone_number }} @endif</td>
        <td>@if($user && $user->requirement) {{ $user->requirement }} @endif</td>
        <td>@if($assignedto && $assignedto->first_name) {{ $assignedto->first_name }} @endif</td>
        <td>@if($generated_by && $generated_by->first_name) {{ $generated_by->first_name }} @endif</td>
         <td>
         @switch($user->status)
                @case('1')
                  <span class="badge bg-label-primary">InProgress</span>
                    @break
                @case('2')
                  <span class="badge bg-label-success">Win</span>
                    @break
                @case('3')
                  <span class="badge bg-label-danger">Loss</span>
                    @break
                @default
                      <span></span>
                @endswitch
        </td>
        <td>
    <div class="btn-group">
      <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ti ti-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="">
                                @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['view'] == 1 || $RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['view'] == 2)
                                    <li><a class="dropdown-item" href="{{url('Employee/Leads/view/'.$user->id)}}">View</a></li>
                                @endif
                                @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/Leads/edit/'.$user->id)}}">Edit</a></li>
                                @endif
                                @if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Leads/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                                @endif
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach