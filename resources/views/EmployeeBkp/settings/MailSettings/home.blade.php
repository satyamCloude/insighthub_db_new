@extends('layouts.admin')
@section('title', 'Mail Settings')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Mail Settings /</span> Mail Configuration</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" Security="alert">{{ Session::get('success') }}</div>
    @endif
  
    <div class="card">
        <form action="{{ url('Employee/MailSettings/store') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="card-header sticky-element bg-label-secondary">
                   <div class="row">
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="mail_setup" onclick="mailsetup(value)" id="radio1" value="1" @if($MailSet && $MailSet->mail_setup == 1) checked @else checked @endif>&nbsp;&nbsp;
                            <label for="radio1">Via SMTP</label>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="mail_setup" id="radio2" onclick="mailsetup(value)" value="2" @if($MailSet && $MailSet->mail_setup == 1) checked @endif>&nbsp;&nbsp;
                            <label for="radio2">Via MailChimp</label>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="mail_setup" id="radio3" onclick="mailsetup(value)" value="3" @if($MailSet && $MailSet->mail_setup == 1) checked @endif >&nbsp;&nbsp;
                            <label for="radio3">Via Microsoft Office</label>
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
                        <div class="col-sm-6 mb-5 text-end">
                              <a href="{{url('Employee/MailSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                        </div>
                        <div class="col-sm-6 mb-5">
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
                              <a href="{{url('Employee/MailSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                        </div>
                        <div class="col-sm-6 mb-5">
                              <button type="submit" name="mail_via" value="chimps" class="btn btn-success">Submit</button>
                        </div> 
                    </div>
                    <div class="row mt-5" id="microsoft" style="display:none;">
                        <div class="col-sm-12 mb-4">
                            <label for="MailProvider" class="form-label"><h5>Mail Provider <span class="text-danger">*</span></h5></label>
                            <input type="text" class="form-control" @if($MailSet && $MailSet->MailProvider) value="{{$MailSet->MailProvider}}" @endif name="MailProvider" id="MailProvider"/>
                        </div>
                        <div class="col-sm-12 mb-4">
                            <label for="RedirectUrl" class="form-label"><h5>Redirect Url <span class="text-danger">*</span></h5></label>
                            <input type="text" class="form-control" @if($MailSet && $MailSet->RedirectUrl) value="{{$MailSet->RedirectUrl}}" @endif name="RedirectUrl" id="RedirectUrl"/>
                        </div>
                        <div class="col-sm-12 mb-4">
                            <label for="clientID" class="form-label"><h5>Application (client)ID <span class="text-danger">*</span></h5></label>
                            <input type="text" class="form-control" @if($MailSet && $MailSet->clientID) value="{{$MailSet->clientID}}" @endif name="clientID" id="clientID"/>
                        </div>
                        <div class="col-sm-12 mb-4">
                            <label for="ClientSecret" class="form-label"><h5>Client Secret <span class="text-danger">*</span></h5></label>
                            <input type="text" class="form-control" @if($MailSet && $MailSet->ClientSecret) value="{{$MailSet->ClientSecret}}" @endif name="ClientSecret" id="ClientSecret"/>
                        </div>
                        <div class="col-sm-12 mb-4">
                            <label for="connectionToken" class="form-label"><h5>Connection Token <span class="text-danger">*</span></h5></label>
                            <input type="text" class="form-control" @if($MailSet && $MailSet->connectionToken) value="{{$MailSet->connectionToken}}" @endif name="connectionToken" id="connectionToken"/>
                        </div>
                        <div class="col-sm-6 mb-5 text-end">
                              <a href="{{url('Employee/MailSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                        </div>
                        <div class="col-sm-6 mb-5">
                              <button type="submit" name="mail_via" value="microsoft" class="btn btn-success">Submit</button>
                        </div> 
                    </div>
                </div>
            </form>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    var mailset = "";

    if(mailset == 0 || mailset == 1)
    {
        $('#smtp').show();
        $('#chimps').hide();
        $('#microsoft').hide();

    } else if(mailset == 2)
    {
        $('#smtp').hide();
        $('#chimps').show();
        $('#microsoft').hide();
    }else if(mailset == 3)
    {
         $('#smtp').hide();
        $('#chimps').hide();
        $('#microsoft').show();
    }

});

function mailsetup(value){

    if (value == 1) {
        $('#smtp').show();
        $('#chimps').hide();
        $('#microsoft').hide();
    }else if(value == 2)
    {
        $('#smtp').hide();
        $('#chimps').show();
        $('#microsoft').hide();
    }else if(value == 3)
    {
         $('#smtp').hide();
        $('#chimps').hide();
        $('#microsoft').show();
    }

}
</script>
@endsection