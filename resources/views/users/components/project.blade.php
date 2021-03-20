<div id="user_project_show" class="d-none ml-5">
    <div class="container">
        <div class="row">
            <button class="btn btn-primary" id="addNewProjectBtn">Add New Project</button>
            <div class="col-md-12">
                
            </div>
        </div>
    </div>
</div>

<!-- Add New Project Modal -->


<div class="modal fade " id="addNewProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="projectImage">Project Overview Image</label>
            <input type="file" class="form-control" id="projectImage" accept="jpg,png,gif"/>
        </div>
        <input type="text" placeholder="Url for Live Demo" class="form-control" id="projectLiveUrl"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="postSubmitConfirmBtn" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>