
  
    <div class="card">
        <form action="{{ url('admin/MailSettings/store') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="card-header sticky-element bg-label-secondary">
                   <div class="row">
                        <div class="col-md-2 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="mail_setup" onclick="mailsetup(value)" id="radio1" value="1" @if($MailSet && $MailSet->mail_setup == 1) checked @else checked @endif>&nbsp;&nbsp;
                            <label for="radio1">SMTP</label>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="mail_setup" id="radio2" onclick="mailsetup(value)" value="2" @if($MailSet && $MailSet->mail_setup == 1) checked @endif>&nbsp;&nbsp;
                            <label for="radio2">MailChimp</label>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="mail_setup" id="radio3" onclick="mailsetup(value)" value="3" @if($MailSet && $MailSet->mail_setup == 1) checked @endif >&nbsp;&nbsp;
                            <label for="radio3">Microsoft Office</label>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="mail_setup" id="radio4" onclick="mailsetup(value)" value="4" @if($MailSet && $MailSet->mail_setup == 1) checked @endif >&nbsp;&nbsp;
                            <label for="radio4">G-Suite</label>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="mail_setup" id="radio5" onclick="mailsetup(value)" value="5" @if($MailSet && $MailSet->mail_setup == 1) checked @endif >&nbsp;&nbsp;
                            <label for="radio5">SES</label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row mt-5" id="smtp"> 
                        <div class="col-sm-6 mb-4">
                              <label for="smtp_mailer" class="form-label"><h5>MAIL MAILER <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->smtp_mailer) value="{{$MailSet->smtp_mailer}}" @endif name="smtp_mailer" id="smtp_mailer"/>
                        </div>
                         <div class="col-sm-6 mb-4">
                              <label for="smtp_host" class="form-label"><h5>MAIL HOST <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->smtp_host) value="{{$MailSet->smtp_host}}" @endif name="smtp_host" id="smtp_host"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="smtp_port" class="form-label"><h5>MAIL_PORT <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->smtp_port) value="{{$MailSet->smtp_port}}" @endif name="smtp_port" id="smtp_port"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="smtp_user_name" class="form-label"><h5>MAIL USERNAME <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->smtp_user_name) value="{{$MailSet->smtp_user_name}}" @endif name="smtp_user_name" id="smtp_user_name"/>
                        </div> 
                         <div class="col-sm-6 mb-4">
                              <label for="smtp_password" class="form-label"><h5>MAIL PASSWORD<span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->smtp_password) value="{{$MailSet->smtp_password}}" @endif name="smtp_password" id="smtp_password"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="smtp_encryption" class="form-label"><h5>MAIL ENCRYPTION<span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->smtp_encryption) value="{{$MailSet->smtp_encryption}}" @endif name="smtp_encryption" id="smtp_encryption"/>
                        </div> 
                        <div class="col-sm-7 mb-5 text-end">
                        
                              <button type="submit" name="mail_via" value="smtp" class="btn btn-success">Submit</button>
                        </div> 
                  </div>
                  <div class="row mt-5" id="chimps" style="display:none;">
                        <div class="col-sm-12 mb-4">
                            <label for="MAILCHIMP_API_KEY" class="form-label"><h5>MAILCHIMP_API_KEY <span class="text-danger">*</span></h5></label>
                            <input type="text" class="form-control"  @if($MailSet && $MailSet->MAILCHIMP_API_KEY) value="{{$MailSet->MAILCHIMP_API_KEY}}" @endif name="MAILCHIMP_API_KEY" id="MAILCHIMP_API_KEY"/>
                        </div>
                        <div class="col-sm-12 mb-4">
                            <label for="SERVER_PREFIX" class="form-label"><h5>SERVER_PREFIX <span class="text-danger">*</span></h5></label>
                            <input type="text" class="form-control"  @if($MailSet && $MailSet->SERVER_PREFIX) value="{{$MailSet->SERVER_PREFIX}}" @endif name="SERVER_PREFIX" id="SERVER_PREFIX"/>
                        </div>
                        <div class="col-sm-6 mb-5 text-end">
                              <a href="{{url('admin/MailSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                        </div>
                        <div class="col-sm-6 mb-5">
                              <button type="submit" name="mail_via" value="chimps" class="btn btn-success">Submit</button>
                        </div> 
                    </div>
                    <div class="row mt-5" id="microsoft" style="display:none;">
                        <div class="col-sm-6 mb-4">
                              <label for="microSmtp_mailer" class="form-label"><h5>MAIL MAILER <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->microSmtp_mailer) value="{{$MailSet->microSmtp_mailer}}" @endif name="microSmtp_mailer" id="microSmtp_mailer"/>
                        </div>
                         <div class="col-sm-6 mb-4">
                              <label for="microSmtp_host" class="form-label"><h5>MAIL HOST <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->microSmtp_host) value="{{$MailSet->microSmtp_host}}" @endif name="microSmtp_host" id="microSmtp_host"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="microSmtp_port" class="form-label"><h5>MAIL_PORT <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->microSmtp_port) value="{{$MailSet->microSmtp_port}}" @endif name="microSmtp_port" id="microSmtp_port"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="microSmtp_user_name" class="form-label"><h5>MAIL USERNAME <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->microSmtp_user_name) value="{{$MailSet->microSmtp_user_name}}" @endif name="microSmtp_user_name" id="microSmtp_user_name"/>
                        </div> 
                         <div class="col-sm-6 mb-4">
                              <label for="microSmtp_password" class="form-label"><h5>MAIL PASSWORD<span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->microSmtp_password) value="{{$MailSet->microSmtp_password}}" @endif name="microSmtp_password" id="microSmtp_password"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="microSmtp_encryption" class="form-label"><h5>MAIL ENCRYPTION<span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->microSmtp_encryption) value="{{$MailSet->microSmtp_encryption}}" @endif name="microSmtp_encryption" id="microSmtp_encryption"/>
                        </div> 
                        <div class="col-sm-6 mb-5 text-end">
                              <a href="{{url('admin/MailSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                        </div>
                        <div class="col-sm-6 mb-5">
                              <button type="submit" name="mail_via" value="microsoft" class="btn btn-success">Submit</button>
                        </div> 
                    </div>
                    <div class="row mt-5" id="GSuite" style="display:none;">
                         <div class="col-sm-6 mb-4">
                              <label for="GSuite_mailer" class="form-label"><h5>MAIL MAILER <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->GSuite_mailer) value="{{$MailSet->GSuite_mailer}}" @endif name="GSuite_mailer" id="GSuite_mailer"/>
                        </div>
                         <div class="col-sm-6 mb-4">
                              <label for="GSuite_host" class="form-label"><h5>MAIL HOST <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->GSuite_host) value="{{$MailSet->GSuite_host}}" @endif name="GSuite_host" id="GSuite_host"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="GSuite_port" class="form-label"><h5>MAIL_PORT <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->GSuite_port) value="{{$MailSet->GSuite_port}}" @endif name="GSuite_port" id="GSuite_port"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="GSuite_user_name" class="form-label"><h5>MAIL USERNAME <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->GSuite_user_name) value="{{$MailSet->GSuite_user_name}}" @endif name="GSuite_user_name" id="GSuite_user_name"/>
                        </div> 
                         <div class="col-sm-6 mb-4">
                              <label for="GSuite_password" class="form-label"><h5>MAIL PASSWORD<span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->GSuite_password) value="{{$MailSet->GSuite_password}}" @endif name="GSuite_password" id="GSuite_password"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="GSuite_encryption" class="form-label"><h5>MAIL ENCRYPTION<span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->GSuite_encryption) value="{{$MailSet->GSuite_encryption}}" @endif name="GSuite_encryption" id="GSuite_encryption"/>
                        </div> 
                        <div class="col-sm-6 mb-5 text-end">
                              <a href="{{url('admin/MailSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                        </div>
                        <div class="col-sm-6 mb-5">
                              <button type="submit" name="mail_via" value="GSuite" class="btn btn-success">Submit</button>
                        </div> 
                    </div>
                    <div class="row mt-5" id="SES" style="display:none;">
                         <div class="col-sm-6 mb-4">
                              <label for="SES_mailer" class="form-label"><h5>MAIL MAILER <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->SES_mailer) value="{{$MailSet->SES_mailer}}" @endif name="SES_mailer" id="SES_mailer"/>
                        </div>
                         <div class="col-sm-6 mb-4">
                              <label for="SES_host" class="form-label"><h5>MAIL HOST <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->SES_host) value="{{$MailSet->SES_host}}" @endif name="SES_host" id="SES_host"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="SES_port" class="form-label"><h5>MAIL_PORT <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->SES_port) value="{{$MailSet->SES_port}}" @endif name="SES_port" id="SES_port"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="SES_user_name" class="form-label"><h5>MAIL USERNAME <span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->SES_user_name) value="{{$MailSet->SES_user_name}}" @endif name="SES_user_name" id="SES_user_name"/>
                        </div> 
                         <div class="col-sm-6 mb-4">
                              <label for="SES_password" class="form-label"><h5>MAIL PASSWORD<span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->SES_password) value="{{$MailSet->SES_password}}" @endif name="SES_password" id="SES_password"/>
                        </div> 
                        <div class="col-sm-6 mb-4">
                              <label for="SES_encryption" class="form-label"><h5>MAIL ENCRYPTION<span class="text-danger">*</span></h5></label>
                             <input type="text" class="form-control" @if($MailSet && $MailSet->SES_encryption) value="{{$MailSet->SES_encryption}}" @endif name="SES_encryption" id="SES_encryption"/>
                        </div> 
                        <div class="col-sm-6 mb-5 text-end">
                              <a href="{{url('admin/MailSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                        </div>
                        <div class="col-sm-6 mb-5">
                              <button type="submit" name="mail_via" value="SES" class="btn btn-success">Submit</button>
                        </div> 
                    </div>
                </div>
            </form>
    </div>

    <div class="row">
            <div class="col-lg-12">
               <div class="border-grey mt-3 p-4 rounded-top">
                  <div class="row">
                     <div class="col-md-11">
                        <h6>Bulk Emails / Promo</h6>
                        <div class="d-flex justify-content-between">
                           <div>
                              <input type="radio" name="mail_setup" id="bsmtp" value="smtp" @if($Bulk && $Bulk->smtp ==
                              "1") checked @endif onclick="BulkMail(value)">
                              <label for="radio1">SMTP</label>
                           </div>
                           <div>
                              <input type="radio" name="mail_setup" id="bMailChimp" value="chimps" @if($Bulk &&
                                 $Bulk->chimps == "1") checked @endif onclick="BulkMail(value)" >
                              <label for="radio2">MailChimp</label>
                           </div>
                           <div>
                              <input type="radio" name="mail_setup" id="bMicrosoft" value="microsoft" @if($Bulk &&
                                 $Bulk->microsoft == "1") checked @endif onclick="BulkMail(value)" >
                              <label for="radio3">Microsoft Office</label>
                           </div>
                           <div>
                              <input type="radio" name="mail_setup" id="bGSuite" value="GSuite" @if($Bulk &&
                                 $Bulk->GSuite == "1") checked @endif onclick="BulkMail(value)" >
                              <label for="radio4">G-Suite</label>
                           </div>
                           <div>
                              <input type="radio" name="mail_setup" id="bSES" value="SES" @if($Bulk && $Bulk->SES ==
                              "1") checked @endif onclick="BulkMail(value)" >
                              <label for="radio5">SES</label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
             
            <div class="col-lg-12">
                <div class="border-grey mt-3 p-4 rounded-top">
                   <div class="row">

                      <div class="col-md-11">
                         <h6>Complete system</h6>
                         <div class="d-flex justify-content-between">
                            <div>
                               <input type="radio" name="mail1" id="csmtp" value="smtp" @if($Complete && $Complete->smtp ==
                               "1") checked @endif onclick="Completemailsetup(value)">
                               <label for="radio1">SMTP</label>
                            </div>
                            <div>
                               <input type="radio" name="mail2" id="cMailChimp" value="chimps" @if($Complete &&
                                  $Complete->chimps == "1") checked @endif onclick="Completemailsetup(value)" >
                               <label for="radio2">MailChimp</label>
                            </div>
                            <div>
                               <input type="radio" name="mail3" id="cMicrosoft" value="microsoft" @if($Complete &&
                                  $Complete->microsoft == "1") checked @endif onclick="Completemailsetup(value)" >
                               <label for="radio3">Microsoft Office</label>
                            </div>
                            <div>
                               <input type="radio" name="mail4" id="cGSuite" value="GSuite" @if($Complete &&
                                  $Complete->GSuite == "1") checked @endif onclick="Completemailsetup(value)" >
                               <label for="radio4">G-Suite</label>
                            </div>
                            <div>
                               <input type="radio" name="mail5" id="cSES" value="SES" @if($Complete && $Complete->SES ==
                               "1") checked @endif onclick="Completemailsetup(value)" >
                               <label for="radio5">SES</label>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>

<script type="text/javascript">


function mailsetup(value){

    if (value == 1) {
        $('#smtp').show();
        $('#chimps').hide();
        $('#microsoft').hide();
        $('#GSuite').hide();
        $('#SES').hide();
    }else if(value == 2)
    {
        $('#chimps').show();
        $('#smtp').hide();
        $('#microsoft').hide();
        $('#GSuite').hide();
        $('#SES').hide();
    }else if(value == 3)
    {
        $('#microsoft').show();
         $('#smtp').hide();
        $('#chimps').hide();
        $('#GSuite').hide();
        $('#SES').hide();
    }
    else if(value == 4)
    {
        $('#GSuite').show();
        $('#microsoft').hide();
         $('#smtp').hide();
        $('#chimps').hide();
        $('#SES').hide();
    }
    else if(value == 5)
    {
        $('#SES').show();
        $('#GSuite').hide();
        $('#microsoft').hide();
         $('#smtp').hide();
        $('#chimps').hide();
    }

}


 function BulkMail(value) {
      var type = "Bulk";
      $.ajax({
         url: "{{ url('admin/MailSettings/MailViaUpdate') }}",
         type: "get",
         data: { value: value, type: type, _token: "{{ csrf_token() }}" },
         success: function (response) {
            location.reload();
         },
         error: function (error) {
            console.log('Error:', error);
         }
      });
   }

   function Completemailsetup(value) {
      var type = "Complete";
      $.ajax({
         url: "{{ url('admin/MailSettings/MailViaUpdate') }}",
         type: "get",
         data: { value: value, type: type, _token: "{{ csrf_token() }}" },
         success: function (response) {
            location.reload();
         },
         error: function (error) {
            console.log('Error:', error);
         }
      });
   }
   
</script>