
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Add Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/LeadSettings/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/LeadSettings/LeadSource/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <div class="row "> 
                <div class="col-sm-6 mb-4">
                      <label for="project_name" class="form-label">Title  <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="task_name" required/>
                </div>
                <div class="col-sm-6 mb-4">
                      <label for="project_name" class="form-label">Task category <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="task_name" required/>

                </div>
               
              </div>               
            </div>               
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/LeadSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      