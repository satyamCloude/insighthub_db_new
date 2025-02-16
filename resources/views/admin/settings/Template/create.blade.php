    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <button type="button" onclick="Tab(value)" value="SmSEmail" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </button>
            </div>
          </div>
          <form action="{{url('admin/Template/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-4">
                      <label for="name" class="form-label"><h5>Template name <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="name" />
                </div>
                <div class="col-md-4">
                      <label for="subject" class="form-label"><h5>Subject <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="subject" />
                </div>
                <div class="col-md-4">
                      <label for="status" class="form-label"><h5>Status <span class="text-danger">*</span></h5></label>
                      <select name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="2">In Active</option>
                    </select>
                </div>
            </div>
             <div class="row mb-4"> 
                <div class="col-12">
                      <label for="template" class="form-label"><h5>Template Header<span class="text-danger">*</span></h5></label>
                       <textarea type="text" name="template" class="form-control"></textarea>                     
                </div>
            </div>
             <div class="row mb-4"> 
                <div class="col-12">
                      <label for="template2" class="form-label"><h5>Template Footer<span class="text-danger">*</span></h5></label>
                       <textarea type="text" name="template2" class="form-control"></textarea>                     
                </div>
            </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <button type="button" onclick="Tab(value)" value="SmSEmail" class="btn btn-label-danger me-3">
                <span class="align-middle"> Back</span>
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
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<script>
 CKEDITOR.replace( 'template' );
 CKEDITOR.replace( 'template2' );
</script>