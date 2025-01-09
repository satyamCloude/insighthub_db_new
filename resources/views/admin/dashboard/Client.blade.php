
<style>

/* Custom scrollbar for .card-body */
.card-body::-webkit-scrollbar {
    width: 10px; /* Width of the scrollbar */
    height: 10px; /* Height of the horizontal scrollbar */
}

.card-body::-webkit-scrollbar-track {
    background: #f1f1f1; /* Color of the track (scrollbar background) */
}

.card-body::-webkit-scrollbar-thumb {
    background-color: #a39bf3; /* Color of the scrollbar thumb */
    border-radius: 10px;    /* Roundness of the scrollbar thumb */
    border: 2px solid #f1f1f1; /* Padding around the thumb */
}


</style>
<div class="row g-4 mb-4 ClientScreen">
    <!-- Total Clients -->
    <div class="col-sm-6 col-xl-4">
        <a class="text-dark" href="{{ url('admin/Client/home') }}">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Clients</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2"></h3>
                                <!-- <p class="text-success mb-0">0</p> -->
                            </div>
                            <p class="mb-0">{{ $TClient }}</p>
                        </div>
                        <div>
                            <span>
                                <i class="fas fa-users mt-3"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Total Leads -->
    <div class="col-sm-6 col-xl-4">
        <a class="text-dark" href="{{ url('admin/Client/home') }}">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Leads</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2"></h3>
                                <!-- <p class="text-success mb-0">0</p> -->
                            </div>
                            <p class="mb-0">{{ $TotalLeads }}</p>
                        </div>
                        <div>
                            <span>
                                <i class="fas fa-users mt-3"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Win Leads -->
    <div class="col-sm-6 col-xl-4">
        <a class="text-dark" href="{{ url('admin/Client/home') }}">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Win Leads</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2"></h3>
                                <!-- <p class="text-success mb-0">0</p> -->
                            </div>
                            <p class="mb-0">{{ $win }}</p>
                        </div>
                        <div>
                            <span>
                                <i class="fas fa-users mt-3"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Loss Leads -->
    <div class="col-sm-6 col-xl-4">
        <a class="text-dark" href="{{ url('admin/Client/home') }}">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Loss Leads</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2"></h3>
                                <!-- <p class="text-success mb-0">0</p> -->
                            </div>
                            <p class="mb-0">{{ $loss }}</p>
                        </div>
                        <div>
                            <span>
                                <i class="fas fa-file-contract mt-3"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Progress Leads -->
    <div class="col-sm-6 col-xl-4">
        <a class="text-dark" href="{{ url('admin/Client/home') }}">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Progress Leads</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2"></h3>
                                <!-- <p class="text-success mb-0">0</p> -->
                            </div>
                            <p class="mb-0">{{ $progress }}</p>
                        </div>
                        <div>
                            <span>
                                <i class="fas fa-file-signature mt-3"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row g-4 mb-4 ClientScreen" >
    <!-- Leads Count By Status -->
    <div class="col-sm-6 col-xl-6" style="height: 380px">
        <div class="card bg-white border-0 b-shadow-4 table-height" style="height: 100%">
            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                <strong class="f-18 f-w-500 mb-0">Leads Count By Status</strong>
            </div>
            <div class="card-body pt-2" style="min-height: 305px; overflow: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Generated By</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($LeadsCountByStatus as $user)
                        <tr>
                            <td style="padding: 1.4rem 1.25rem;">
                                <div class="parent d-flex"><div class="child1"><img class="rounded-circle" style="margin-right: 15px;" src="{{ isset($user->profile_img) ? $user->profile_img : url('public/images/21104.png') }}" height="30" width="30" alt="User avatar" /></div>
                                <div class="child2"> {{ $user->first_name }} {{ $user->last_name }}</div></div>
                                <div style="font-size: 12px; margin-left: 46px; margin-top: -11px;"></div>
                            </td>
                            <td style="padding: 1.4rem 1.25rem;">
                                 @php
                                  $role = DB::table('jobroles')->whereRaw("FIND_IN_SET($user->id, assign_emp_id)")->value('name');
                              @endphp
                              <div class="parent d-flex">
                                  <div class="child1">
                                      <img class="rounded-circle" 
                                           style="margin-right: 15px;" 
                                           src="{{ isset($user->profile_img) ? $user->profile_img : url('public/images/21104.png') }}" 
                                           height="30" 
                                           width="30" 
                                           alt="User avatar" />
                                  </div>
                                  <div class="child2">
                                      <a href="{{ url('admin/Client/view/' . $user->id) }}">
                                          {{ $user->generated_by_first_name }} {{ $user->generated_by_last_name }} (#{{ $user->generated_by_id }})
                                      </a>
                                      <div style="font-size: 12px; margin-left: 46px; margin-top: -11px;">
                                          {{ $role }}
                                      </div>
                                  </div>
                              </div>
                            </td>
                            <td>
                                @switch($user->status)
                                @case('1')
                                <span class="badge bg-label-primary">InProgress</span>
                                @break
                                @case('2')
                                <span class="badge bg-label-warning">Hold</span>
                                @break
                                @case('3')
                                <span class="badge bg-label-success">Win</span>
                                @break
                                @case('4')
                                <span class="badge bg-label-danger">Loss</span>
                                @break
                                @case('5')
                                <span class="badge bg-label-secondary">Open</span>
                                @break
                                @default
                                <span></span>
                                @endswitch
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="3">No Data Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Leads Count By Source -->
    <div class="col-sm-6 col-xl-6 mb-4" style="height: 380px;">
        <div class="card bg-white border-0 b-shadow-4 table-height" style="height: 100%">
            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                <strong class="f-18 f-w-500 mb-0">Leads Count By Source</strong>
            </div>
            <div class="card-body pt-2" style="min-height: 305px; overflow: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Generated By</th>
                            <th>Source</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($LeadsCountByStatusSource as $user)
                        <tr>
                            <td style="padding: 1.4rem 1.25rem;">
                                <div class="parent d-flex"><div class="child1"><img class="rounded-circle" style="margin-right: 15px;" src="{{ isset($user->profile_img) ? $user->profile_img : url('public/images/21104.png') }}" height="30" width="30" alt="User avatar" /></div>
                                <div class="child2"> {{ $user->first_name }} {{ $user->last_name }}</div></div>
                                <div style="font-size: 12px; margin-left: 46px; margin-top: -11px;"></div>
                            </td>
                            <td style="padding: 1.4rem 1.25rem;">
                                @php
                                  $role = DB::table('jobroles')->whereRaw("FIND_IN_SET($user->id, assign_emp_id)")->value('name');
                              @endphp
                              <div class="parent d-flex">
                                  <div class="child1">
                                      <img class="rounded-circle" 
                                           style="margin-right: 15px;" 
                                           src="{{ isset($user->profile_img) ? $user->profile_img : url('public/images/21104.png') }}" 
                                           height="30" 
                                           width="30" 
                                           alt="User avatar" />
                                  </div>
                                  <div class="child2">
                                      <a href="{{ url('admin/Client/view/' . $user->id) }}">
                                          {{ $user->generated_by_first_name }} {{ $user->generated_by_last_name }} (#{{ $user->generated_by_id }})
                                      </a>
                                      <div style="font-size: 12px; margin-left: 46px; margin-top: -11px;">
                                          {{ $role }}
                                      </div>
                                  </div>
                              </div>
                            </td>
                            <td>{{ $user->lead_source_name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="3">No Data Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Latest Clients -->
    <div class="col-sm-6 col-xl-6 mb-4" style="height: 380px;">
        <div class="card bg-white border-0 b-shadow-4 table-height" style="height: 100%">
            <div class="card-header">
                <strong>Latest Clients</strong>
            </div>
            <div class="card-body" style="overflow: auto;">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Email</th>
                            <th class="text-right">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($CClient as $key => $client)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                         
                              <td>
                               <div class="parent d-flex align-items-center">
                                   <div class="child1">
                                        <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" src="{{ isset($client->profile_img) ? $user->profile_img : url('public/images/21104.png') }}" height="30" width="30" alt="User avatar" />
                                   </div>
                                   <div class="child2">
                                        <a href="{{ url('admin/Client/view/'. $client->id) }}">
                                    {{ $client->first_name }} {{ $client->last_name }} (#{{ $client->id }})
                                        </a>
                                        <br> {{ $client->company_name }}
                                   </div>
                                   </div>
                               
                               
                            </td>
                            <td>{{ $client->email }}</td>
                            <td class="text-right">{{ $client->created_at ? $client->created_at->format('Y-m-d H:i:s') : '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Login Activities -->
    <div class="col-sm-6 col-xl-6 mt-4" style="height: 380px;">
        <div class="card bg-white border-0 b-shadow-4 table-height" style="height: 100%">
            <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                <strong class="f-18 f-w-500 mb-0">Recent Login Activities</strong>
            </div>
            <div class="card-body pt-2" style="min-height: 305px; overflow: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Email</th>
                            <th>IP</th>
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($CRecentLogin as $key => $recentLogin)
                        <tr>
                            <!--<td>-->
                            <!--    <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" src="{{ isset($recentLogin->profile_img) ? $recentLogin->profile_img : url('public/images/21104.png') }}" height="30" width="30" alt="User avatar" />-->
                            <!--    {{ $recentLogin->first_name }}-->
                            <!--    <div style="font-size: 12px; margin-left: 46px; margin-top: -11px;">-->
                                    <!-- Display additional details if needed -->
                            <!--    </div>-->
                            <!--</td>-->
                            
                            
                              <td>
                               <div class="parent d-flex align-items-center">
                                   <div class="child1">
                                        <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" src="{{ isset($recentLogin->profile_img) ? $user->profile_img : url('public/images/21104.png') }}" height="30" width="30" alt="User avatar" />
                                   </div>
                                   <div class="child2">
                                        <a href="{{ url('admin/Client/view/' . $recentLogin->id) }}">
                                    {{ $recentLogin->first_name }} {{ $recentLogin->last_name }} (#{{ $recentLogin->id }})
                                        </a>
                                        <br> {{ $recentLogin->company_name }}
                                   </div>
                                   </div>
                               
                               
                            </td>
                            
                            <td>{{ $recentLogin->email }}</td>
                            <td>{{ $recentLogin->ip }}</td>
                            <td>{{ $recentLogin->subject }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="4">No Data Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
