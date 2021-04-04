<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <label for="select_category_for_post">Select Cateogry</label>
                    <select id="select_category_for_post" class="form-control">
                        <option value="0">All Category</option>
                        
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-md-12">

            
            <table class="table">

                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Verified</th>
                        <th>Details</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="post_table">
                    <!-- <tr>
                        <td>post Title</td>
                        <td>Verified</td>
                        <td><a><i class="fas fa-eye"></i></a></td>
                        <td><a><i class="fas fa-trash-alt"></i></a></td>
                    </tr> -->
                </tbody>


            </table>


        </div>


    </div>


</div>


<!-- Modal -->
<div class="modal fade" id="postDetailsShowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="post_content_details" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="postDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="post_delete_id" class="modal-body text-danger">
        Do You Want To Delete ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="postDeleteConfirmBtn" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>