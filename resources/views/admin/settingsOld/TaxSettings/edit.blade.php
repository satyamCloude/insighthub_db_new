    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <button type="button" onclick="Tab(value)" value="Tax" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </button>
            </div>
          </div>
          <form action="{{url('admin/TaxSettings/update/'.$id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="tax_name" class="form-label"><h5>Tax Name <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" value="{{$tax->tax_name}}" name="tax_name" required />
                </div>
                <div class="col-md-6">
                      <label for="rate" class="form-label"><h5>Rate <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" value="{{$tax->rate}}" name="rate" required />
                </div>
            </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                 <button type="button" onclick="Tab(value)" value="Tax" class="btn btn-outline-danger">
                    <span class="align-middle"> Discard</span>
                  </button>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div>