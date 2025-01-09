@if(count($Goal) > 0)
@foreach($Goal as $key => $user)
                  <tr class="odd">
                      <td>{{ $key + 1 }} </td>
                      <td>
                          <img 
                                  class="rounded-circle"
                                  style="margin-right: 15px;margin-top: 10px;" 
                                  src="{{$user->profile_img}}"
                                  height="30"
                                  width="30"
                                  alt="User avatar" /><a href="{{ url('admin/Goal/view/'.$user->id) }}">{{$user->first_name }}</a><div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$user->job_name}}</div>
                      </td>
                      <td>@if($user && $user->job_name) {{ $user->job_name }} @endif</td>
                      <td>@if($user && $user->goal_value) {{ $user->goal_value }} @endif</td>
                      <td>@if($user && $user->archieved_value) {{ $user->archieved_value }} @endif</td>
                      <td>
                          @if($user && $user->goal_value != 0)
                              <?php
                                  $percentage = ($user->archieved_value / $user->goal_value) * 100;
                                  $progressClass = 'bg-danger'; // Default to danger

                                  if ($percentage > 1 && $percentage < 100) {
                                      $progressClass = 'bg-primary';
                                  } elseif ($percentage == 100) {
                                      $progressClass = 'bg-success';
                                  }
                              ?>
                              
                              <div class="progress">
                                  <div class="progress-bar {{ $progressClass }} progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($percentage, 2) }}%</div>
                              </div>
                          @else
                              N/A
                          @endif
                      </td>


                      <td>
                          @switch($user->status)
                              @case('1')
                              <span class="badge bg-label-danger">Failed</span>
                              @break
                              @case('2')
                              <span class="badge bg-label-primary">InProgress</span>
                              @break
                              @case('3')
                              <span class="badge bg-label-success">Achieved</span>
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
                                  <li><a class="dropdown-item" href="{{ url('admin/Goal/edit/'.$user->id) }}">Edit</a></li>
                                  <li><button class="dropdown-item delete_debtcase" url="{{ url('admin/Goal/delete/'.$user->id) }}" id="{{ $user->id }}">Delete</button></li>
                              </ul>
                          </div>
                      </td>
                  </tr>
@endforeach
@else
<tr>
  <td class="text-center" colspan="8">No Data Found</td>
</tr>
@endif             
