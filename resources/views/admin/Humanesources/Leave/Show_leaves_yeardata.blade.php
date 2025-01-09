 @if(count($Leave) > 0)
              @foreach($Leave as $key=> $user)
                  <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>
                    <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />{{$user->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->email}}</div>
                          </td>
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
                      @endif
                  </td>
                
                  <td>
                      @if($user && ($user->status == 3))
                             <select name="Status" class="form-select" onchange="LeaveStatusUpdate(this.value,{{$user->user_id}},{{$user->id}},{{$user->RoleID}},{{Auth::user()->id}},{{$AuthRoles}})">
                                <option @if($user && $user->status == 1) selected @endif value="1">APPROVED</option>
                                <option @if($user && $user->status == 2) selected @endif value="2">UNAPPROVED</option>
                                <option @if($user && $user->status == 3) selected @endif value="3">PENDING</option>
                              </select> 
                        @else
                            @switch($user->status)
                                @case('2')
                                    <span class="badge bg-label-warning">UNAPPROVED</span>
                                    @break
                                @case('1')
                                    <span class="badge bg-label-primary">APPROVED</span>
                                    @break
                                @default
                                    <span></span>
                            @endswitch
                        @endif
                  
                  </td>
                   <td>{{ $user->leave_type }}</td>
                  <td>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="{{url('admin/Leave/edit/'.$user->id)}}">Edit</a></li>
                            <li><button class="dropdown-item delete_debtcase" url="{{url('admin/Leave/delete/'.$user->id)}}" id="{{$user->id}}">Delete</button></li>
                          </ul>
                      </div>
                  </td>
              </tr>

              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="9">No Data Found</td>
              </tr>
              @endif