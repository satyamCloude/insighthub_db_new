@extends('layouts.admin')

@section('title', 'Ticket Chat')

@section('content')

<style>

   .active-tab {

   background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);

   border-radius: 5px;

   margin: 0px 10px;

   padding: 6px;

   color: #fff;

   }

   .active-tab a {

   color: #fff;

   display: flex !important;

   width: 100%;

   justify-content: space-between;

   }

   .active-tab a .avatar {

   width: 18%;

   }

   .active-tab a .avatar img {

   width: 40px;

   /*    margin: 0 auto;*/

   display: block;

   }

   .active-tab a .chat-contact-info {

   width: 60%;

   }

   .active-tab a .chat-contact-info h6 {

   color: #fff;

   }

   .active-tab a .chat-contact-info p {

   color: #fff !important;

   }

   .recent-chat li {

   padding: 5px 10px;

   margin: 5px 0px;

   }

</style>

<div class="container-xxl flex-grow-1 container-p-y">

   <div class="row ">

      <div class="col-lg-4 col-xl-3">

         <div class="sidebar">

            <div menuitemname="Ticket Information" class="mb-3 card card-sidebar">

               <div class="card-header" style="background: #9c94f4;border-bottom-right-radius: 19px;border-bottom-left-radius: 19px;">

                  <h4 class="card-title m-0" style="color: white;font-size: 21px;">

                     <i class="fas fa-ticket-alt"></i>&nbsp;Ticket Information

                     <i class="fas fa-chevron-up card-minimise float-right collapse1"></i>

                  </h4>

               </div>

               <div class="collapsable-card-body">

                  <div class="list-group list-group-flush d-md-flex" role="tablist">

                     <div menuitemname="Requestor" class="list-group-item list-group-item-action ticket-details-children" id="Primary_Sidebar-Ticket_Information-Requestor">

                        <span class="title">Requestor</span><br><span class="ticket-requestor-name">{{$ticket -> first_name}}</span> (<span class="label requestor-type-operator">@if($ticket && $ticket->type==2) Client @elseif($ticket && $ticket->type==3) Employee @else Sales @endif</span>)

                     </div>

                     <div menuitemname="Department" class="list-group-item list-group-item-action ticket-details-children" id="Primary_Sidebar-Ticket_Information-Department">

                        <span class="title">Department</span><br>{{$ticket->department_name}}

                     </div>

                     <div menuitemname="Date Opened" class="list-group-item list-group-item-action ticket-details-children" id="Primary_Sidebar-Ticket_Information-Date_Opened">

                        <span class="title">Submitted</span><br>{{$ticket->created_at->format('Y-m-d')}}

                     </div>

                     <div menuitemname="Last Updated" class="list-group-item list-group-item-action ticket-details-children" id="Primary_Sidebar-Ticket_Information-Last_Updated">

                        <span class="title">Last Updated</span><br>{{$ticket->updated_at->format('Y-m-d')}}

                     </div>

                     <div menuitemname="Priority" class="list-group-item list-group-item-action ticket-details-children" id="Primary_Sidebar-Ticket_Information-Priority">

                        <span class="title">Status/Priority</span><br>

                        <span class="btn btn-{{ 

                            $ticket->status == 1 ? 'success' : 

                            ($ticket->status == 2 ? 'primary' : 

                            ($ticket->status == 3 ? 'warning' :

                            ($ticket->status == 4 ? 'secondary' :

                            ($ticket->status == 5 ? 'danger' : '')))) }} btn-sm" disabled>

                            {{ 

                                $ticket->status == 1 ? 'Open' : 

                                ($ticket->status == 2 ? 'In Progress' : 

                                ($ticket->status == 3 ? 'On Hold' :

                                ($ticket->status == 4 ? 'Resolved' :

                                ($ticket->status == 5 ? 'Unanswered' : ''))))

                            }}

                        </span> 

                        {{ $overview->priority_id == 1 ? 'Normal' :

                          ($overview->priority_id == 2 ? 'Medium' :

                          ($overview->priority_id == 3 ? 'Urgent' : '')) }}

                     </div>

                  </div>

               </div>

               <div class="card-footer clearfix">

                  <div class="row">

                     <div class="col-6 col-xs-6 col-button-left">

                        <button class="btn btn-success btn-sm btn-block" id="ticketReply" >
                          
<!-- onclick="jQuery('#ticketReply').click()" -->
                        <i class="fas fa-pencil-alt me-2"></i> Reply

                        </button>

                     </div>

                     <!-- <div class="col-6 col-xs-6 col-button-right">

                        <button class="btn btn-danger btn-sm btn-block" disabled="disabled" onclick="window.location='?tid=593782&amp;c=qLnWbHYM&amp;closeticket=true'"><i class="fas fa-times"></i> Closed</button>

                     </div> -->

                  </div>

               </div>

            </div>

         </div>

         <div class="d-none d-lg-block sidebar">

            <!-- <div menuitemname="Attachments" class="mb-3 card card-sidebar">

               <div class="card-header" style="

                  background-color: #9c94f4;

                  border-bottom-right-radius: 19px;

                  border-bottom-left-radius: 19px;

                  ">

                  <h4 class="card-title m-0" style="

                     color: white;

                     ">

                     <i class="far fa-file"></i>&nbsp;                Attachments

                     <i class="fas fa-chevron-up card-minimise float-right"></i>

                  </h4>

               </div>

               <div class="collapsable-card-body">

                  <div class="list-group list-group-flush d-md-flex" role="tablist">

                     <a menuitemname="logs.png" href="/dl.php?type=a&amp;id=30059&amp;i=0" class="list-group-item list-group-item-action" id="Secondary_Sidebar-Attachments-logs.png">

                     logs.png

                     </a>

                  </div>

               </div>

            </div> -->

            <!-- <div menuitemname="CC Recipients" class="mb-3 card card-sidebar" id="sidebarTicketCc">

               <div class="card-header">

                  <h3 class="card-title m-0" style="

                     color: white;

                     ">

                     <i class="far fa-closed-captioning"></i>&nbsp;                CC Recipients

                     <i class="fas fa-chevron-up card-minimise float-right"></i>

                  </h3>

               </div>

               <div class="collapsable-card-body">

                  <div class="list-group list-group-flush d-md-flex" role="tablist">

                     <div menuitemname="emptyTicketCCRow" class="list-group-item list-group-item-action ticket-cc-item w-hidden" id="Secondary_Sidebar-CC_Recipients-emptyTicketCCRow">

                     </div>

                  </div>

               </div>

               <div class="card-footer clearfix">

                  <div class="list-group-item hidden w-hidden" id="ccCloneRow">

                     <div class="ticket-cc-email">

                        <span class="email truncate" title="" data-toggle="tooltip" data-placement="bottom"></span>

                        <div class="pull-right float-right">

                           <a href="#" class="delete-cc-email" onclick="return false;" data-email="">

                           <i class="far fa-do-not-enter fa-lg text-danger no-transform" aria-hidden="true" title="Remove Recipient">

                           <span class="sr-only">Remove Recipient</span>

                           </i>

                           </a>

                        </div>

                     </div>

                  </div>

                  <form id="frmAddCcEmail" action="https://portal.cloudtechtiq.com/viewticket.php">

                     <input type="hidden" name="token" value="6e459de0bb83d722a0a98c00ddfc701dfa28bf85">

                     <input type="hidden" name="action" value="add">

                     <input type="hidden" name="tid" value="593782">

                     <input type="hidden" name="c" value="qLnWbHYM">

                     <div class="input-group margin-bottom-5" id="containerAddCcEmail">

                        <input id="inputAddCcEmail" type="text" class="form-control input-email" name="email" placeholder="Enter Email Address">

                        <span class="input-group-btn input-group-append">

                        <button class="btn btn-default" id="btnAddCcEmail" type="submit">Add</button>

                        </span>

                     </div>

                  </form>

                  <div class="alert alert-danger hidden w-hidden small-font" id="divCcEmailFeedback"></div>

               </div>

            </div> -->

            <div menuitemname="Support" class="mb-3 card card-sidebar">

              <!--  <div class="card-header">

                  <h3 class="card-title m-0" style="

                     color: white;

                     ">

                     <i class="far fa-life-ring"></i>&nbsp;                Support

                     <i class="fas fa-chevron-up card-minimise float-right"></i>

                  </h3>

               </div> -->

             <!--   <div class="collapsable-card-body">

                  <div class="list-group list-group-flush d-md-flex" role="tablist">

                      <a menuitemname="Support Tickets" href="{{url('user/userTicket')}}" class="list-group-item list-group-item-action" id="Secondary_Sidebar-Support-Support_Tickets">

                     <i class="fas fa-ticket-alt fa-fw"></i>&nbsp;                                My Support Tickets

                     </a>

                      <a menuitemname="Announcements" href="/index.php/announcements" class="list-group-item list-group-item-action" id="Secondary_Sidebar-Support-Announcements">

                     <i class="fas fa-list fa-fw"></i>&nbsp;                                Announcements

                     </a>

                     <a menuitemname="Knowledgebase" href="/index.php/knowledgebase" class="list-group-item list-group-item-action" id="Secondary_Sidebar-Support-Knowledgebase">

                     <i class="fas fa-info-circle fa-fw"></i>&nbsp;                                Knowledgebase

                     </a>

                     <a menuitemname="Downloads" href="/index.php/download" class="list-group-item list-group-item-action" id="Secondary_Sidebar-Support-Downloads">

                     <i class="fas fa-download fa-fw"></i>&nbsp;                                Downloads

                     </a>

                     <a menuitemname="Network Status" href="/serverstatus.php" class="list-group-item list-group-item-action" id="Secondary_Sidebar-Support-Network_Status">

                     <i class="fas fa-rocket fa-fw"></i>&nbsp;                                Network Status

                     </a>

                      <a menuitemname="Open Ticket" href="/submitticket.php" class="list-group-item list-group-item-action" id="Secondary_Sidebar-Support-Open_Ticket">

                     <i class="fas fa-comments fa-fw"></i>&nbsp;                                Open Ticket

                     </a>

                  </div>

               </div> -->

            </div>

         </div>

      </div>

      <div class="col-lg-8 col-xl-9 primary-content">

        @if($ticket->type==3){

         <div class="alert alert-warning text-center">

            This ticket is closed.  You may reply to this ticket to reopen it.

         </div>

        }else{



        }

        @endif

         <div class="card view-ticket">

            <div class="card-body p-3">

              <div class="outer" style="display: flex;justify-content: space-between;">

               <h3 class="card-title" style="background-color: #9c94f4 !important;

    padding: 5px 11px;

    border-radius: 3px;color:white;">

                  Ticket #{{$ticket->id}}

                  </h3>

                  <div class="ticket-actions float-sm-right mt-3 mt-sm-0">

                     <!-- <button id="ticketReply" type="button" class="btn btn-default btn-sm" onclick="smoothScroll('#ticketReplyContainer')">

                     <i class="fas fa-pencil-alt fa-fw"></i>

                     Reply

                     </button> -->

                     <!-- <button class="btn btn-{{ 

                      $ticket->status == 1 ? 'success' : 

                      ($ticket->status == 2 ? 'warning' : 

                      ($ticket->status == 3 ? 'danger' :  ''))

                  }} btn-sm">

                     @if($ticket && $ticket->status==1) Open @elseif($ticket && $ticket->status==2) Hold @else Closed @endif

                     </button> -->

                  </div>

               </div>

               <p style="margin-bottom: 6px;color: #5d596c;

    margin-left: 2px;">

                  Subject:

                  <strong>{{$ticket->subject}}</strong>

               </p>

            </div>

            

         </div>

         <div class="card card-primary mt-2">

               <div class="card-body pb-0">

                 <ul class="timeline pt-3">

                  @foreach($chats as $chat)
                  @if($chat->message || $chat->image)

                   <li class="timeline-item pb-4 @if($chat->clientId == $ticket->user_id) timeline-item-primary @else timeline-item-success @endif border-left-dashed">

                     <span class="timeline-indicator-advanced timeline-indicator-primary">

                        <div class="avatar avatar-xs">

                           @if($chat->client && $chat->client->profile_img)

                           <img src="{{$chat->client->profile_img}}" alt="Avatar" class="rounded-circle">

                           @else



                           <img src="{{url('public/images/publickey_X5hf.png')}}" alt="Avatar" class="rounded-circle">

                           @endif

                        </div>

                     </span>

                     <div class="timeline-event">

                        <div class="timeline-header border-bottom mb-3">

                            <h6 class="mb-0">

                                Posted By 

                                <span class="posted-by-name">{{ $chat->client ? $chat->client->first_name : 'Cloud Techtiq'}}</span>

                                <span class="label requestor-badge requestor-type-operator float-md-right">

                                   @if($chat->clientId == $ticket->user_id)
                                    <strong>(Owner)</strong>
                                    @else
                                    <strong>(Operator)</strong>
                                   @endif

                                </span>

                            </h6>

                            <span class="text-muted">{{ $chat->created_at->format('jS F') }}</span>

                        </div>

                        <div class="d-flex justify-content-between flex-wrap mb-2">

                            <div class="d-flex align-items-center">

                                <p>{!! $chat->message !!}</p>

                            </div>

                            <span>{{ $chat->created_at->format('g:i A') }}</span>

                        </div>

                       <div class=" align-items-center">

                           @if($chat->image && $chat->extension == 'jpg' || $chat->extension == 'gif' || $chat->extension ==

                           'jpeg'|| $chat->extension == 'png')

                           <a href="{{ url('public/chat/',$chat->image) }}" download>

                              <img src="{{ url('public/chat/'.$chat->image) }}" alt="Avatar" width="100" />

                           </a>

                           @endif

                           @if($chat->image && $chat->extension == 'txt' || $chat->extension == 'pdf')

                           <a href="{{ url('public/chat/',$chat->image) }}" download>

                              <i class="fas fa-file-pdf">{{$chat->image}}</i>

                           </a>

                           <div class="pdf-layout mt-2">

                              <object class="pdf" data="{{ url('public/chat/'.$chat->image) }}" height="100"></object>

                           </div>

                           @endif

                           @if($chat->image && $chat->extension == 'zip' || $chat->extension == 'rar')

                           <a href="{{ url('public/chat/',$chat->image) }}" download>

                              <i class="fas fa-file-archive"> {{$chat->image}}</i>

                           </a>

                           @endif

                           @if($chat->image && $chat->extension == 'xls' || $chat->extension == 'xlsx' || $chat->extension ==

                           'docx')

                           <a href="{{ url('public/chat/',$chat->image) }}" download>

                              <i class="fas fa-file-excel"> {{$chat->image}}</i>

                           </a>

                           @endif

                        </div>

                     </div>

                   </li>
                   @endif

                  @endforeach

                   <!-- <li class="timeline-item pb-4 timeline-item-primary border-left-dashed">

                     <span class="timeline-indicator-advanced timeline-indicator-primary">

                       <div class="avatar avatar-xs">

                             <img src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle">

                           </div>

                     </span>

                     <div class="timeline-event">

                       <div class="timeline-header border-bottom mb-3">

                         <h6 class="mb-0">Get on the flight</h6>

                         <span class="text-muted">3rd October</span>

                       </div>

                       <div class="d-flex justify-content-between flex-wrap mb-2">

                         <div class="d-flex align-items-center">

                           <span>Charles de Gaulle Airport, Paris</span>

                           <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>

                           <span>Heathrow Airport, London</span>

                         </div>

                         <div>

                           <span>6:30 AM</span>

                         </div>

                       </div>

                       <div class="d-flex align-items-center">

                         <img src="https://demos.pixinvent.com/vuexy-html-admin-template/assets//img/icons/misc/pdf.png" alt="img" width="20" class="me-2">

                         <span class="mb-0">bookingCard.pdf</span>

                       </div>

                     </div>

                   </li> -->

                 </ul>

               </div>

            </div>

         <div class="card d-print-none mt-2" id="ticketReplyContainer">

            <div class="card-body">

               <h3 class="card-title">Reply</h3>

               <form action="{{url('user/Ticket/chatInsert')}}" enctype="multipart/form-data" id="formId" method="post">

                  @csrf

                        <input type="hidden" value="{{$ticketId}}" name="ticket_id">

                        <input type="hidden" value="{{url()->full()}}" name="url">

                  <div class="row mb-3">

                     <div class="form-group col-md-4">

                        <label for="inputName">Name</label>

                        <input type="text" id="multicol-first-name" class="form-control" placeholder="John" value="{{Auth::user()->first_name}}" disabled>

                     </div>

                     <div class="form-group col-md-5">

                        <label for="inputEmail">Email Address</label>

                        <input type="email" id="multicol-first-name" class="form-control" placeholder="abc@gmail.com"value="{{Auth::user()->email}}" disabled>

                     </div>

                  </div>

                  <div class="form-group">

                     <label for="inputMessage"></label>

                     <div class="card-body" style="padding-left:2px;">

                        <div class="md-editor" id="1709527323772">

                          <textarea id="inputMessage" rows="12" class="form-control markdown-editor md-input"

                              name="message" style="resize: vertical;"></textarea>

                        </div>

                     </div>

                  </div>

                  <div class="form-group">

                     <label for="inputAttachments">Attachments</label>

                     <div class="input-group mb-1 attachment-group">

                        <div class="custom-file">

                           <label class="custom-file-label text-truncate" for="inputAttachment1" data-default="Choose file">

                           </label>

                           <input type="file" class="custom-file-input" name="fileinput" id="inputAttachment1">

                        </div>

                      <!--   <div class="input-group-append">

                           <button class="btn btn-default" type="button" id="btnTicketAttachmentsAdd">

                           <i class="fas fa-plus"></i>

                           Add More

                           </button>

                        </div> -->

                     </div>

                     <!-- <div class="file-upload w-hidden">

                        <div class="input-group mb-1 attachment-group">

                           <div class="custom-file">

                              <label class="custom-file-label text-truncate">

                              Choose file

                              </label>

                              <input type="file" class="custom-file-input" name="attachments[]">

                           </div>

                        </div>

                     </div> -->

                     <div id="fileUploadsContainer"></div>

                     <div class="text-muted">

                        <small>Allowed File Extensions: .zip, .jpg, .gif, .jpeg, .png, .txt, .pdf, .pem, .csr, .crt, .xls, .xlsx, .docx, .ldf, .mdf, .msg, .ppk, .rar, .key (Max file size: 512MB)</small>

                     </div>

                  </div>

                  <div class="form-group text-center mt-3">

                     <button class="btn btn-outline-primary waves-effect">Submit</button>

                      <button class="btn btn-outline-danger waves-effect" type="reset" onclick="jQuery('#ticketReply').click()">Cancel</button>

                     <!-- <input class="btn btn-primary" type="submit" name="save" value="Submit"> -->

                     <!-- <input class="btn btn-default" type="reset" value="Cancel" onclick="jQuery('#ticketReply').click()"> -->

                  </div>

               </form>

            </div>

         </div>

      </div>

   </div>

</div>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>

   $(document).ready(function(){

        $(".collapse1").click(function(){

          console.log("Hello Worlds");

          $(".collapsable-card-body").slideToggle("slow");

          $(this).toggleClass("fa-chevron-up fa-chevron-down");

        });

    });



   $(document).ready(function() {

    $('.submit').click(function() {

     $('#formId').submit();

     $('#message').val('');

   });

   });

    /////////////status as closed      

                 function getStatus(val,ticketId)

                 {

                  $.ajax({

                    url: "{{url('Employee/Ticket/markAsClosed')}}",

                    type: 'post',

                    data: {val:val,ticketId:ticketId},

                    headers: {

                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },

                    success: function(response) {

                      window.location.reload();

                    },

                    error: function(xhr) {

                      alert('Error updating status.');

                    }

                  });

                }

   ////////////////FOR CKEDITOR

   $(document).ready(function() {

     CKEDITOR.replace('message', {

       extraPlugins: 'scayt',

       scayt_autoStartup: true,

     });

   });

</script>

<script>

// Function to smoothly scroll to a target element

function smoothScroll(target) {

  const element = document.querySelector(target);

  if (element) {

    window.scrollTo({

      top: element.offsetTop,

      behavior: 'smooth'

    });

  }

}

// Adding click event listener to the button

document.getElementById('ticketReply').addEventListener('click', function() {

  smoothScroll('#ticketReplyContainer');


});



console.log("dfdjhfh")



</script>

@endsection