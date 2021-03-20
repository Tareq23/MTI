<div id="user_post_show" class="d-none ml-5">
    <div class="container">
        <div class="row">
            <button class="btn btn-primary" id="addNewPostBtn">Add New Post</button>
            <div class="col-md-12">

                <p>own post view</p>

            </div>
        </div>
    </div>
</div>


<!-- Add New Post Modal -->


<div class="modal fade " id="addNewPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea class="form-control" id="post-editor" name="post-editor"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="postSubmitConfirmBtn" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>