
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Storage Setting's</h5>
          </div>
          <div class="col-md-12 mb-4 d-flex">
    <label class="form-label">Storage</label>
    <div class="col-md-6">
        <div class="form-check form-check-primary mt-4 py-2">
            <input class="form-check-input" name="status" value="local" @if($SsT && $SsT->status ==  "0" ) checked @endif type="radio" id="localRadio">
            <label class="form-check-label" for="localRadio">Local</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-check form-check-primary mt-4 py-2">
            <input class="form-check-input" name="status" value="Bucket" @if($SsT && $SsT->status ==  "1" ) checked @endif type="radio" id="bucketRadio">
            <label class="form-check-label" for="bucketRadio">S3 Bucket</label>
        </div>
    </div>
</div>

              <!-- Form for Local Storage -->
              <form id="localForm" action="{{url('admin/StorageSettings/store')}}"  method="post" enctype="multipart/form-data"  style="display: @if($SsT && $SsT->status ==  "0" ) block @else none @endif;">
                @csrf
                   <div class="card-body">
                    <div class="row">
                        <!-- Example field (adjust as needed) -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Local Storage Path</label>
                            <input name="local_storage_path"  value="System Storage"  placeholder="Local Storage Path" class="form-control" readonly>
                            <input name="status"  value="local" type="hidden">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </form>

            

             

          <form action="{{url('admin/StorageSettings/store')}}" method="post" enctype="multipart/form-data"  id="bucketForm" style="display: @if($SsT && $SsT->status ==  "1" ) block @else none @endif;">
            @csrf
            <div class="card-body">
              <div class="row"> 
                <div class="col-md-6 mb-4">
                  <label class="form-label">AWS_ACCESS_KEY_ID</label>
                  <input name="AWS_ACCESS_KEY_ID"  @if($SsT && $SsT->AWS_ACCESS_KEY_ID) value="{{$SsT->AWS_ACCESS_KEY_ID}}" @endif placeholder="AWS_ACCESS_KEY_ID" class="form-control">
                </div>
                <div class="col-md-6 mb-4">
                  <label class="form-label">AWS_SECRET_ACCESS_KEY</label>
                  <input name="AWS_SECRET_ACCESS_KEY"  @if($SsT && $SsT->AWS_SECRET_ACCESS_KEY) value="{{$SsT->AWS_SECRET_ACCESS_KEY}}" @endif placeholder="AWS_SECRET_ACCESS_KEY" class="form-control">
                </div>
                 <div class="col-md-6 mb-4">
                  <label class="form-label">AWS_DEFAULT_REGION</label>
                  <input name="AWS_DEFAULT_REGION"  @if($SsT && $SsT->AWS_DEFAULT_REGION) value="{{$SsT->AWS_DEFAULT_REGION}}" @endif placeholder="AWS_DEFAULT_REGION" class="form-control">
                </div>
                 <div class="col-md-6 mb-4">
                  <label class="form-label">AWS_BUCKET</label>
                  <input name="AWS_BUCKET"  @if($SsT && $SsT->AWS_BUCKET) value="{{$SsT->AWS_BUCKET}}" @endif placeholder="AWS_BUCKET" class="form-control">
                </div>
                <div class="col-md-6 mb-4">
                  <label class="form-label">S3_BASE_URL</label>
                  <input name="S3_BASE_URL"  @if($SsT && $SsT->S3_BASE_URL) value="{{$SsT->S3_BASE_URL}}" @endif placeholder="S3_BASE_URL" class="form-control">
                                              <input name="Bucket"  value="local" type="hidden">

                </div>
             
              </div>
            </div>
            <div class="card-footer text-center">
                  <button type="submit" class="btn btn-success">Submit</button>
            </div> 
          </form>
        </div>
      </div>
    </div>
   <script>
                  // Add an event listener for changes in the radio buttons
                  document.querySelectorAll('input[name="status"]').forEach(function(radio) {
                      radio.addEventListener('change', function() {
                          // Hide both forms initially
                          document.getElementById('localForm').style.display = 'none';
                          document.getElementById('bucketForm').style.display = 'none';

                          // Show the selected form based on the radio button
                          if (this.value === 'local') {
                              document.getElementById('localForm').style.display = 'block';
                          } else if (this.value === 'Bucket') {
                              document.getElementById('bucketForm').style.display = 'block';
                          }
                      });
                  });
              </script>