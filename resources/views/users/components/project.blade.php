<div id="user_project_show" class="d-none ml-5">
    <div class="container">
        <button class="btn btn-primary" id="addNewProjectBtn">Add New Project</button>
        <div class="row">
            <div class="col-md-12">
                <div id="userAllProjects">

                  

                </div>
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
        <div class="project-image-preview d-none">
          <img id="projectImagePreviewId" alt="project"/>
        </div>
        <div class="form-group">
            <label for="projectImage">Project Overview Image</label>
            <p id="project_image_error" class="d-none text-danger">Image file size less than 1 MB</p>
            <input type="file" class="form-control" id="projectImage" accept="jpg,png,gif"/>
        </div>
        <div class="form-group">
            <label for="projectName">Project Name</label>
            <p id="project_name_error" class="d-none text-danger">Project name must be less than 150 characters and greater than 5 characters</p>
            <input type="text" class="form-control" placeholder="project name" id="projectName"/>
        </div>
        <div class="form-group">
            <label for="projectLiveUrl">Project Url</label>
            <p id="project_url_error" class="d-none text-danger">Provide url for Live Demo Or Source code</p>
            <input type="text" placeholder="Url for Live Demo" class="form-control" id="projectLiveUrl"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="postAddConfirmBtn" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>