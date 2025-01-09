    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <button type="button" onclick="Tab(value)" value="ProjectCategory"  class="btn btn-label-primary me-3">Back</button>
            </div>
          </div>
         <form action="{{ url('admin/ProjectCategory/update/'.$id) }}" method="post" enctype="multipart/form-data">
             @csrf
            <div class="card-body">
              <h5 class="mb-4">1. Project Category</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="project_name" class="form-label">Project Category Name  <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="category_name" @if($ProjectCategory && $ProjectCategory->category_name) value="{{$ProjectCategory->category_name}}" @endif required/>
                </div>
             
            </div>
          </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/ProjectCategory/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div>
 