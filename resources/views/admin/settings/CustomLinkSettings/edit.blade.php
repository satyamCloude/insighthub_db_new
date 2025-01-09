
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
               <button type="button" onclick="Tab(value)" value="CustomLink" class="btn btn-primary">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/CustomLinkSettings/update/'.$id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="link_title" class="form-label"><h5>Link Title<span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="link_title" value="{{ $custm_link->link_title }}" required />
                </div>
                <div class="col-md-6">
                      <label for="url" class="form-label"><h5>URL <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="url"  value="{{ $custm_link->url }}" required />
                </div>
                <!-- <div class="col-md-6">
                      <label for="rate" class="form-label"><h5>Can Be Viewed By <span class="text-danger">*</span></h5></label>
                      <select class="form-control" name="who_can_view" required >
                        <option value="employee">Employee</option>
                        <option value="client">Client</option>
                        <option value="manager">Manager</option>
                      </select>
                </div> --> 
                 <div class="col-md-6 mt-2">
                      <label for="rate" class="form-label"><h5>Status<span class="text-danger">*</span></h5></label>
                      <select class="form-control" name="status" required >
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                </div>
            </div>
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/CustomLinkSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>