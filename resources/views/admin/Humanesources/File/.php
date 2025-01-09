@if(count($Leave) > 0)
              @foreach($Leave as $key=> $user)
              <tr class="odd">
                  <td>{{ $key+1 }} </td>
                  <td>{{ $user->first_name }}</td>
                  <td>
                      @if($user->full_half_day == 2)
                          {{ 'Full Day' }}
                      @elseif($user->full_half_day == 1)
                          {{ 'Half Day' }}
                      @endif
                  </td>
                  <td>{{ $user->start_date }}</td>
                  <td>{{ $user->end_date }}</td>
                  <?php
                    $startDate = new DateTime($user->start_date);
                    $endDate = new DateTime($user->end_date);
                    $interval = $startDate->diff($endDate);
                    $totalDays = $interval->days;
                  ?>
                  <td>{{ $totalDays }}</td>
                  <td>{{ $user->approved_by }}</td>
                  <td>
                   @switch($user->status)
                          @case('1')
                            <span class="badge bg-label-success">APPROVED</span>
                              @break
                          @case('2')
                            <span class="badge bg-label-danger">UNAPPROVED</span>
                              @break
                          @case('3')
                            <span class="badge bg-label-warning">PENDING</span>
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