
    <div class="row mb-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Ticket-Email Setting's</h5>
            <h5 class="card-title mb-sm-0 me-2">For Send</h5>
          </div>
          <form action="{{url('admin/TicketEmailSetting/update/'.$TES->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <div class="sticky-element bg-label-secondary">
                   <div class="row">
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="leadsetting" onclick="Taber(value)" id="radio1" checked="" value="Support">&nbsp;&nbsp;
                            <label for="radio1">Support E-mail</label>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="leadsetting" id="radio2" onclick="Taber(value)" value="Sales">&nbsp;&nbsp;
                            <label for="radio2">Sales E-mail</label>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="leadsetting" id="radio3" onclick="Taber(value)" value="Account">&nbsp;&nbsp;
                            <label for="radio3">Account E-mail</label>
                        </div>
                    </div>
              </div>
              <div class="row mt-5" id="Supportsmtp"> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_mailer" class="form-label"><h5>MAIL MAILER <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->support_smtp_mailer) value="{{$TES->support_smtp_mailer}}" @endif name="support_smtp_mailer" id="smtp_mailer">
                  </div>
                   <div class="col-sm-6 mb-4">
                        <label for="smtp_host" class="form-label"><h5>MAIL HOST <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->support_smtp_host) value="{{$TES->support_smtp_host}}" @endif name="support_smtp_host" id="smtp_host">
                  </div> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_port" class="form-label"><h5>MAIL_PORT <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->support_smtp_port) value="{{$TES->support_smtp_port}}" @endif name="support_smtp_port" id="smtp_port">
                  </div> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_user_name" class="form-label"><h5>MAIL USERNAME <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->support_smtp_user_name) value="{{$TES->support_smtp_user_name}}" @endif name="support_smtp_user_name" id="smtp_user_name">
                  </div> 
                   <div class="col-sm-6 mb-4">
                        <label for="smtp_password" class="form-label"><h5>MAIL PASSWORD<span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->support_smtp_password) value="{{$TES->support_smtp_password}}" @endif name="support_smtp_password" id="smtp_password">
                  </div> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_encryption" class="form-label"><h5>MAIL ENCRYPTION<span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->support_smtp_encryption) value="{{$TES->support_smtp_encryption}}" @endif name="support_smtp_encryption" id="smtp_encryption">
                  </div> 
                  <div class="col-sm-6 mb-5 text-end">
                        <a href="#" type="button" class="btn btn-outline-danger waves-effect">Discard</a>
                  </div>
                  <div class="col-sm-6 mb-5">
                        <button type="submit" name="smtp" value="support" class="btn btn-success waves-effect waves-light">Submit</button>
                  </div> 
              </div>
              <div class="row mt-5" id="Salessmtp" style="display: none;"> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_mailer" class="form-label"><h5>MAIL MAILER <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->sales_smtp_mailer) value="{{$TES->sales_smtp_mailer}}" @endif name="sales_smtp_mailer" id="smtp_mailer">
                  </div>
                   <div class="col-sm-6 mb-4">
                        <label for="smtp_host" class="form-label"><h5>MAIL HOST <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->sales_smtp_host) value="{{$TES->sales_smtp_host}}" @endif name="sales_smtp_host" id="smtp_host">
                  </div> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_port" class="form-label"><h5>MAIL_PORT <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->sales_smtp_port) value="{{$TES->sales_smtp_port}}" @endif name="sales_smtp_port" id="smtp_port">
                  </div> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_user_name" class="form-label"><h5>MAIL USERNAME <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->sales_smtp_user_name) value="{{$TES->sales_smtp_user_name}}" @endif name="sales_smtp_user_name" id="smtp_user_name">
                  </div> 
                   <div class="col-sm-6 mb-4">
                        <label for="smtp_password" class="form-label"><h5>MAIL PASSWORD<span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->sales_smtp_password) value="{{$TES->sales_smtp_password}}" @endif name="sales_smtp_password" id="smtp_password">
                  </div> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_encryption" class="form-label"><h5>MAIL ENCRYPTION<span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->sales_smtp_encryption) value="{{$TES->sales_smtp_encryption}}" @endif name="sales_smtp_encryption" id="smtp_encryption">
                  </div> 
                  <div class="col-sm-6 mb-5 text-end">
                        <a href="#" type="button" class="btn btn-outline-danger waves-effect">Discard</a>
                  </div>
                  <div class="col-sm-6 mb-5">
                        <button type="submit" name="smtp" value="sales" class="btn btn-success waves-effect waves-light">Submit</button>
                  </div> 
              </div>
              <div class="row mt-5" id="Accountsmtp" style="display: none;"> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_mailer" class="form-label"><h5>MAIL MAILER <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->account_smtp_mailer) value="{{$TES->account_smtp_mailer}}" @endif name="account_smtp_mailer" id="smtp_mailer">
                  </div>
                   <div class="col-sm-6 mb-4">
                        <label for="smtp_host" class="form-label"><h5>MAIL HOST <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->account_smtp_host) value="{{$TES->account_smtp_host}}" @endif name="account_smtp_host" id="smtp_host">
                  </div> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_port" class="form-label"><h5>MAIL_PORT <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->account_smtp_port) value="{{$TES->account_smtp_port}}" @endif name="account_smtp_port" id="smtp_port">
                  </div> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_user_name" class="form-label"><h5>MAIL USERNAME <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->account_smtp_user_name) value="{{$TES->account_smtp_user_name}}" @endif name="account_smtp_user_name" id="smtp_user_name">
                  </div> 
                   <div class="col-sm-6 mb-4">
                        <label for="smtp_password" class="form-label"><h5>MAIL PASSWORD<span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->account_smtp_password) value="{{$TES->account_smtp_password}}" @endif name="account_smtp_password" id="smtp_password">
                  </div> 
                  <div class="col-sm-6 mb-4">
                        <label for="smtp_encryption" class="form-label"><h5>MAIL ENCRYPTION<span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->account_smtp_encryption) value="{{$TES->account_smtp_encryption}}" @endif name="account_smtp_encryption" id="smtp_encryption">
                  </div> 
                  <div class="col-sm-6 mb-5 text-end">
                        <a href="#" type="button" class="btn btn-outline-danger waves-effect">Discard</a>
                  </div>
                  <div class="col-sm-6 mb-5">
                        <button type="submit" name="smtp" value="account" class="btn btn-success waves-effect waves-light">Submit</button>
                  </div> 
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Sticky Actions -->

    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Ticket-Email Setting's</h5>
            <h5 class="card-title mb-sm-0 me-2">For Receive</h5>
          </div>
          <form action="{{url('admin/TicketEmailSetting/update/'.$TES->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <div class="sticky-element bg-label-secondary">
                   <div class="row">
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="Auth" onclick="TabAuth(value)" id="radio1" checked="" value="Support">&nbsp;&nbsp;
                            <label for="radio1">Support E-mail</label>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="Auth" id="radio2" onclick="TabAuth(value)" value="Sales">&nbsp;&nbsp;
                            <label for="radio2">Sales E-mail</label>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-self-baseline">
                            <input type="radio" name="Auth" id="radio3" onclick="TabAuth(value)" value="Account">&nbsp;&nbsp;
                            <label for="radio3">Account E-mail</label>
                        </div>
                    </div>
              </div>
              <div class="row mt-5" id="SupportAuth"> 
                  <div class="col-sm-6 mb-4">
                        <label for="support_email" class="form-label"><h5>E-mail <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->support_email) value="{{$TES->support_email}}" @endif name="support_email" id="support_email">
                  </div>
                   <div class="col-sm-6 mb-4">
                        <label for="Auth" class="form-label"><h5>Authentication Code <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->support_Auth) value="{{$TES->support_Auth}}" @endif name="support_Auth" id="Auth">
                  </div> 
                  <div class="col-sm-6 mb-5 text-end">
                        <a href="#" type="button" class="btn btn-outline-danger waves-effect">Discard</a>
                  </div>
                  <div class="col-sm-6 mb-5">
                        <button type="submit" name="Auth" value="support" class="btn btn-success waves-effect waves-light">Submit</button>
                  </div> 
              </div>
              <div class="row mt-5" id="SalesAuth" style="display: none;"> 
                  <div class="col-sm-6 mb-4">
                        <label for="Sales_email" class="form-label"><h5>E-mail <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->Sales_email) value="{{$TES->Sales_email}}" @endif name="Sales_email" id="Sales_email">
                  </div>
                   <div class="col-sm-6 mb-4">
                        <label for="Sales_Auth" class="form-label"><h5>Authentication Code <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->Sales_Auth) value="{{$TES->Sales_Auth}}" @endif name="Sales_Auth" id="Auth">
                  </div> 
                  <div class="col-sm-6 mb-5 text-end">
                        <a href="#" type="button" class="btn btn-outline-danger waves-effect">Discard</a>
                  </div>
                  <div class="col-sm-6 mb-5">
                        <button type="submit" name="Auth" value="sales" class="btn btn-success waves-effect waves-light">Submit</button>
                  </div> 
              </div>
              <div class="row mt-5" id="AccountAuth" style="display: none;"> 
                  <div class="col-sm-6 mb-4">
                        <label for="Account_email" class="form-label"><h5>E-mail <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->Account_email) value="{{$TES->Account_email}}" @endif name="Account_email" id="Account_email">
                  </div>
                   <div class="col-sm-6 mb-4">
                        <label for="Account_Auth" class="form-label"><h5>Authentication Code <span class="text-danger">*</span></h5></label>
                       <input type="text" class="form-control" @if($TES && $TES->Account_Auth) value="{{$TES->Account_Auth}}" @endif name="Account_Auth" id="Auth">
                  </div> 
                  <div class="col-sm-6 mb-5 text-end">
                        <a href="#" type="button" class="btn btn-outline-danger waves-effect">Discard</a>
                  </div>
                  <div class="col-sm-6 mb-5">
                        <button type="submit" name="Auth" value="account" class="btn btn-success waves-effect waves-light">Submit</button>
                  </div> 
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
<script>
  function Taber(value) {
    if(value == 'Support')
    {
      $('#Supportsmtp').show(500);
      $('#Salessmtp').hide(500);
      $('#Accountsmtp').hide(500);
    }
    if(value == 'Sales')
    {
      $('#Salessmtp').show(500);
      $('#Supportsmtp').hide(500);
      $('#Accountsmtp').hide(500);
    }
    if(value == 'Account')
    {
      $('#Accountsmtp').show(500);
      $('#Supportsmtp').hide(500);
      $('#Salessmtp').hide(500);
    }
  }
 function TabAuth(value) {
    if(value == 'Support')
    {
      $('#SupportAuth').show(500);
      $('#SalesAuth').hide(500);
      $('#AccountAuth').hide(500);
    }
    if(value == 'Sales')
    {
      $('#SalesAuth').show(500);
      $('#SupportAuth').hide(500);
      $('#AccountAuth').hide(500);
    }
    if(value == 'Account')
    {
      $('#AccountAuth').show(500);
      $('#SupportAuth').hide(500);
      $('#SalesAuth').hide(500);
    }
  }
</script>