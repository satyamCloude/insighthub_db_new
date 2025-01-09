 @if(count($Leave) > 0)
          @foreach($Leave as $key=> $user)
           <!-- //Leave -->
           
             <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->first_name }}</td>
                  <td>@if($user && $user->date) {{ $user->date }} @else {{ $user->start_date }} @endif </td>
                  <td>
                      @if($user->duration == 1)
                          {{ 'Full Day' }}
                      @elseif($user->duration == 2)
                          {{ 'Multiple' }}
                      @elseif($user->duration == 3)
                          {{ 'First Half' }}
                      @elseif($user->duration == 4)
                          {{ 'Second Half' }}
                      @endif </td> <td>{{ $user->leave_type }}</td> 
                      <td>  
                        
                        
                    </td>
                     <td>

                  
                      <select name="Status" class="form-select" onchange="LeaveStatusUpdate(this.value,{{$user->user_id}},{{$user->id}},{{$user->RoleID}},{{Auth::user()->id}},{{$AuthRole->job_role_id}})">
                          <option @if($user && $user->leave_accesses_status == 3) selected @endif value="3">PENDING</option>
                          <option @if($user && $user->leave_accesses_status == 1) selected @endif value="1">APPROVED</option>
                          <option @if($user && $user->leave_accesses_status == 2) selected @endif value="2">UNAPPROVED</option>
                      </select>
                  </td>
                 
                  <td>
                     @if(in_array('Leave', array_column($RoleAccess, 'per_name')))
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                               
                                @if($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['update'] == 1)
                                    <li><a class="dropdown-item" href="{{url('Employee/Leave/edit/'.$user->id)}}">Edit</a></li>
                                @elseif($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['delete'] == 1)
                                    <li><button class="dropdown-item delete_debtcase" url="{{url('Employee/Leave/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                                @else
                                    <li><button class="dropdown-item">No Action</button></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                   
                  </td>
                </tr>

          
              
          @endforeach
          @else
          <tr>
            <td class="text-center" colspan="9">No Data Found</td>
          </tr>
          @endif