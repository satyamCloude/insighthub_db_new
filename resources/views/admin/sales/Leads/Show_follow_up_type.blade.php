        <thead class="">
          <tr>
            <th>Created</th>
            <th>Next Follow Up</th>
            <th>Client Name</th>
            <th>Phone Number</th>
            <th>Requirement</th>
            <th>Remark</th>
            <th>Status</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>
                                                          <tbody>
          @if(count($LeadsFollowup) > 0)
          @foreach($LeadsFollowup as $Followup)
           @php 
           $leadStatus = DB::table('lead_statuses')->where('id',$Followup->status)->first();  @endphp

          <tr>
            <td>{{$Followup->created_at}}</td>         
            <td>{{$Followup->follow_up_next}}</td>
             <td>@if($Followup && $Followup->first_name) {{ $Followup->first_name }} @endif</td>
            <td>{{$Followup->phone_number}}</td>
            <td>
                @if($Followup && $Followup->requirement)
                    {{ substr(strip_tags($Followup->requirement), 0, 10) }}
                @else
                    --
                @endif
            </td>

            <td>{{substr(strip_tags($Followup->remark), 0, 5)}}</td>
            <td>
                                                                                                    <div style="display:flex;align-items:center;">
                                                                                                    <div class="status" style="background-color:{{$leadStatus->label_color}};width:13px;height:13px;border-radius:50%;">&nbsp;</div>
                                                                                                  <span style="padding: 5px;border-radius: 4px;">{{ucfirst($leadStatus->lead_status)}}</span>
                                                                                    </div>
                                                                                                 </td>
            <td>
              <a href="#" onclick="EditFollowUp({{$Followup->id}})"><i class="fa-solid fa-edit"></i></a>
              &nbsp;&nbsp;
              <a class="delete_debtcase2" href="{{url('admin/LeadsFollowup/delete/'.$Followup->id)}}" id="{{$Followup->id}}"><i class="fa-solid fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
          @else
          <tr>
            <td></td>
            <td>No data found</td>
            <td></td>
          </tr>
          @endif
        </tbody>
