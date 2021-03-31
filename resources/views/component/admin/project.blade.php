<div class="container">

    <div class="row">
    
        <div class="col-md-12">

            <h4 class="my-5">All User's Project Show,Confirm and Delete Pages</h4>

            <table  class="table ">
            
                <thead>

                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>View</th>
                        <th>Confirm</th>
                        <th>Delete</th>
                    </tr>
                
                </thead>
                <tbody id="projectTable">
                    <!-- <tr>
                        <td>Project Name</td>
                        <td><img src="{{asset('images/default/user.png')}}"/></td>
                        <td><a target="_blank" href="#"><i class="fas fa-eye"></i></a></td>
                        <td><a><i class="far fa-check-circle"></i></a></td>
                        <td><a><i class="fas fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>Project Name</td>
                        <td><img src="{{asset('images/default/user.png')}}"/></td>
                        <td><a target="_blank" href="#"><i class="fas fa-eye"></i></a></td>
                        <td><a><i class="far fa-check-circle"></i></a></td>
                        <td><a><i class="fas fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>Project Name</td>
                        <td><img src="{{asset('images/default/user.png')}}"/></td>
                        <td><a target="_blank" href="#"><i class="fas fa-eye"></i></a></td>
                        <td><a><i class="far fa-check-circle"></i></a></td>
                        <td><a><i class="fas fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>Project Name</td>
                        <td><img src="{{asset('images/default/user.png')}}"/></td>
                        <td><a target="_blank" href="#"><i class="fas fa-eye"></i></a></td>
                        <td><a><i class="far fa-check-circle"></i></a></td>
                        <td><a><i class="fas fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>Project Name</td>
                        <td><img src="{{asset('images/default/user.png')}}"/></td>
                        <td><a target="_blank" href="#"><i class="fas fa-eye"></i></a></td>
                        <td><a><i class="far fa-check-circle"></i></a></td>
                        <td><a><i class="fas fa-trash"></i></a></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="projectConfirmChangeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <span id="project_id"></span>
            <select id="selectProjectConfirmChange" value="" class="form-control">

                <option value="1">Accepted</option>
                <option value="0">Rejected</option>

            </select>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="selectProjectConfirmChange_saveBtn" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="projectDelectModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Project Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p class="text-danger" style="font-size:2rem;font-weight:bold">Are you sure ? to delete this</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="projectDeleteConfirmBtn" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
