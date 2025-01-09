<form action="{{url('user/2fas/enable')}}" method="post">
    @csrf
    <div class="mb-4">
        <h5>Finish enabling two factor authentication.</h5>
        <h4>Scan QR Code</h4>
        {{$qrCodeImage}}
    </div>
    <label class="mb-2">Enter Code</label>
    <input type="text" name="two_factor_recovery_codes"  placeholder="234569" class="form-control">
    <input type="hidden" name="two_factor_secret" value="{{$secretKey}}" class="form-control">
    <button type="submit" class="btn btn-success mt-4">Submit</button>
    <button type="reset" id="cancelAuth" class="btn btn-light mt-4">Cancel</button>
</form>



