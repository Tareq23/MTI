<div class="container">

    <div class="row">

        <button id="addTechnologyBtn" class="btn btn-primary">Add Technology</button>
        <div class="col-md-12 pl-0 ml-0">
            <div id="addTechnologyDiv" class="w-50 float-left d-none">
                <div class="form-group">
                    <label for="technology_name">Technology Name</label>
                    <p id="technology_error" class="d-none text-danger">Technology Name Must be less than 80 characters and greater than 2 characters</p>
                    <input class="form-control" type="text" id="technology_name"/>
                </div>
                <div class="float-right">
                    <button class="btn btn-secondary mr-5" id="addTechnologyCancelBtn">Cancel</button>
                    <button id="addTechnologyConfirmBtn" class="btn btn-primary">Save</button>
                </div>
            </div>
            </br>
            <table  class="table ">
            
                <thead>

                    <tr>
                        <th>Name</th>
                        <th>Delete</th>
                    </tr>
                
                </thead>
                <tbody id="technologyTable">
                    <!-- <tr>
                        <td>Project Name</td>
                        <td><a><i class="fas fa-trash"></i></a></td>
                    </tr>
                     -->
                </tbody>
            </table>
        </div>
    
    </div>

</div>
<div class="modal" id="technologyDelectModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Technology Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p class="text-danger" style="font-size:2rem;font-weight:bold">Are you sure ? to delete this</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="technologyDeleteConfirmBtn" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>