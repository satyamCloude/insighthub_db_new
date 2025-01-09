    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Performance Setting's</h5>
          </div>
          <form action="{{url('admin/PerformanceSettings/update/'.$PS->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <div class="row mb-4"> 
                <div class="col-md-6">
                    <input type="radio" name="status"  value="1" @if($PS && $PS->status == 1) checked @endif   >
                    <label for="radio1">Quarterly</label>
                </div>
                <div class="col-md-6">
                    <input type="radio" name="status"  value="2" @if($PS && $PS->status == 2) checked @endif  >
                    <label for="radio1">Annual</label>
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
    <!-- /Sticky Actions -->