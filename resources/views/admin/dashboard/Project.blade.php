<div class="row g-4 mb-4 ProjectScreen">
      <div class="col-sm-6 col-xl-3">
         <a class="text-dark" href="{{url('admin/Client/home')}}">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                     <div class="content-left">
                        <strong>Project InProgress</strong>
                        <div class="d-flex align-items-center my-2">
                           <h3 class="mb-0 me-2"></h3>
                           <!-- <p class="text-success mb-0">0</p> -->
                        </div>
                        <p class="mb-0">{{$InProgressProject}}</p>
                     </div>
                     <div class="">
                        <span class="">
                        <i class="fas fa-project-diagram mt-3"></i>
                        <!--<i class="fa fa-ellipsis-v"></i>-->
                        </span>
                        <!--<a href="#" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>-->
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-xl-3">
         <a class="text-dark" href="{{url('admin/Client/home')}}">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                     <div class="content-left">
                        <strong>Project Completed</strong>
                        <div class="d-flex align-items-center my-2">
                           <h3 class="mb-0 me-2"></h3>
                           <!-- <p class="text-success mb-0">0</p> -->
                        </div>
                        <p class="mb-0">{{$CompletedProject}}</p>
                     </div>
                     <div class="">
                        <span class="">
                        <i class="fas fa-tasks mt-3"></i>
                        <!--<i class="fa fa-ellipsis-v"></i>-->
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-xl-3">
         <a class="text-dark" href="{{url('admin/Client/home')}}">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                     <div class="content-left">
                        <strong>Project OverDue</strong>
                        <div class="d-flex align-items-center my-2">
                           <h3 class="mb-0 me-2"></h3>
                           <!-- <p class="text-success mb-0">0</p> -->
                        </div>
                        <p class="mb-0">{{$OverDueProject}}</p>
                     </div>
                     <div class="">
                        <span class="">
                        <i class="fas fa-tasks mt-3"></i>
                        <!--<i class="fa fa-ellipsis-v"></i>-->
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-xl-3">
         <a class="text-dark" href="{{url('admin/Client/home')}}">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                     <div class="content-left">
                        <strong>Project Cancel</strong>
                        <div class="d-flex align-items-center my-2">
                           <h3 class="mb-0 me-2"></h3>
                           <!-- <p class="text-success mb-0">0</p> -->
                        </div>
                        <p class="mb-0">{{$CancelProject}}</p>
                     </div>
                     <div class="">
                        <span class="">
                        <i class="fas fa-tasks mt-3"></i>
                        <!--<i class="fa fa-ellipsis-v"></i>-->
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 g-4 col-xl-6" style="80px">
        <div class="card bg-white border-0 b-shadow-4 table-height" style="100%">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <strong class="f-18 f-w-500 mb-0 card-title ">Status Wise Projects</strong>
                  <a href="{{url('admin/Project/home')}}" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               </div>  

                <div class="card-body" style="display: block;overflow: overlay;">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
              @if(count($ProActiTime) > 0)
              @foreach($ProActiTime as $key=> $Inventor)
              <tr class="odd">
                  <td>@if($Inventor && $Inventor->project_name) {{ $Inventor->project_name }} @endif</td>
                    <td>
                               <div class="parent d-flex">
                                   <div class="child1">
                                        <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" src="{{ isset($Inventor->project_manager_picture) ? $Inventor->project_manager_picture : url('public/images/21104.png') }}" height="30" width="30" alt="User avatar" />
                                   </div>
                                   <div class="child2">
                                        <a href="{{ url('admin/Client/view/' . $Inventor->id) }}">
                                    {{ $Inventor->project_manager_name }} {{ $Inventor->project_manager_lst_name }} (#{{ $Inventor->project_manager_id }})
                                        </a>
                                        <br> {{ $Inventor->company_name }}
                                   </div>
                                   </div>
                               
                               
                            </td>
                  
                        <td >
                            @switch($Inventor->status_id)
                          @case('1')
                            <span class="badge bg-label-primary">In Progress</span>
                              @break
                          @case('2')
                            <span class="badge bg-label-success">Completed</span>
                              @break
                          @case('3')
                            <span class="badge bg-label-warning">Over Due</span>
                              @break
                          @case('4')
                            <span class="badge bg-label-danger">Cancel</span>
                              @break
                          @default
                                <span></span>
                          @endswitch
                        </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
              </tr>
              @endif 
              </tbody>
                  </table>
                          </div>
              </div>
            
         </div>
      </div>
       <div class="col-sm-6 col-xl-6" style="80px">
        <div class="card bg-white border-0 b-shadow-4 table-height" style="100%">
               <div class="card-header bg-white border-0 text-capitalize d-flex justify-content-between pt-4">
                  <strong class="f-18 f-w-500 mb-0 card-title">Pending Project</strong>
                  <a href="{{url('admin/Project/home')}}" type="button" class="btn-primary rounded f-14 p-2 btn-sm">See More</a>
               </div>
               
                <div class="card-body" style="display: block;overflow: overlay;">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
              @if(count($ProjectPeding) > 0)
              @foreach($ProjectPeding as $key=> $Inventor)
              <tr class="odd">
                  <td>@if($Inventor && $Inventor->project_name) {{ $Inventor->project_name }} @endif</td>
                 
                      
                        <td>
                               <div class="parent d-flex">
                                   <div class="child1">
                                        <img class="rounded-circle" style="margin-right: 15px; margin-top: 10px;" src="{{ isset($Inventor->project_manager_picture) ? $Inventor->project_manager_picture : url('public/images/21104.png') }}" height="30" width="30" alt="User avatar" />
                                   </div>
                                   <div class="child2">
                                       <a href="{{ url('admin/Client/view/' . $Inventor->id) }}">
                                    {{ $Inventor->project_manager_name }} {{ $Inventor->project_manager_lst_name }} (#{{ $Inventor->project_manager_id }})
                                        </a>
                                        <br> {{ $Inventor->company_name }}
                                   </div>
                                   </div>
                               
                               
                            </td>
                      
                      </td>
                  
                        <td >
                            @switch($Inventor->status_id)
                          @case('1')
                            <span class="badge bg-label-warning">Pending</span>
                              @break
                          @default
                                <span></span>
                          @endswitch
                        </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="8">No Data Found</td>
              </tr>
              @endif 
            </tbody>
                  </table>
                          </div>
              </div>
         </div>
       </div>
</div>
  