  <ul class="timeline mb-0">
              @if($Leave)
              @foreach($Leave as $myleave)
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header border-bottom mb-3">
                 <h6 class="mb-0">{{ date('d F Y', strtotime($myleave->start_date)) }} - {{ date('d F Y', strtotime($myleave->end_date)) }}</h6>

                  @php
                      if($myleave->status == 1){
                       $color = 'success';
                        $status = 'APPROVED';
                        }
                        elseif($myleave->status == 2){
                        $color = 'danger';
                        $status = 'UNAPPROVED';
                        }
                        elseif($myleave->status == 3){
                        $color = 'warning';
                         $status = 'PENDING';
                         }
                  @endphp
                  
                  <button class="btn btn-{{$color}} waves-effect waves-light" style="
    padding: 6px 5px;
    margin-bottom: 9px;
">{{$status}}</button>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-2">
                  <div class="d-flex align-items-center">
                    <span>{!! $myleave->description !!}</span>
                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                    <span>{{$myleave->leave_type}}</span>
                  </div>
                  <div>
<span class="text-muted">{{ date('d F Y h:i A', strtotime($myleave->created_at)) }}</span>
                  </div>
                </div>
                     
             @if($myleave && $myleave->reply)   <div class="d-flex justify-content-between flex-wrap mb-2 ml-4" style="background-color:pink;height:100px;overflow:hidden;border-radius:10px;margin-left:20%;text-align:center">
                  <div class="d-flex align-items-center">
                        @php
                $user_details = App\Models\User::find(1);
            @endphp  

        @if($user_details->profile_img)

      <span>  
      
      <img 
                            class="rounded-circle"
                            style="margin-right: 15px;margin-top: 10px;" 
                            src="{{$user_details->profile_img}}"
                            height="30"
                            width="30"
                            alt="User avatar" />
                                                    @else

                                                    <img class="rounded-circle"

                                                    style="margin-right: 15px;margin-top: 10px;" 

                                                    src="{{url('public/images/21104.png')}}"

                                                    height="30"

                                                    width="30"

                                                    alt="User avatar" />

                                                    @endif
                       </span> <br/>
                    <span>@if($myleave && $myleave->reply) {{ $myleave->reply }}@else -- @endif
</span>
                   
                  </div>
                </div>
                 @endif
                <!--<div class="d-flex align-items-center">-->
                <!--  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">-->
                <!--  <span class="mb-0">bookingCard.pdf</span>-->
                <!--</div>-->
              </div>
            </li>
            @endforeach
            @else
            <span>No Record Found</span>
            @endif
          
          </ul>