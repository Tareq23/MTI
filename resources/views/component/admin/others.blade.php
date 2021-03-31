<div class="container">

    <div class="row w-100">
        <div class="col-md-6 col-sm-12 category">
            <button type="button" id="addCategoryBtn" class="btn btn-primary">Add Category</button>
            <div id="addCategoryInputDiv" class="d-none">
                <div class="form-group mt-3">
                    <label for="categoryName">Category Name</label>
                    <input class="form-control" id="categoryInputValue" type="text" placeholder="category name"/>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" id="addCategoryCancelBtn" class="btn btn-secondary mr-5">Cancel</button>
                    <button type="button" id="addCategoryConfirmBtn" class="btn btn-primary">Save</button>
                </div>
            </div>
            <div class="mt-5" >
                <table id="categoryDataTable" class="table w-100">
                    <thead class="thead-dark text-center">
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody id="categoryTableBody">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 tag">
            <button type="button" id="addTagBtn" class="btn btn-primary">Add Tag</button>
            <div id="addTagInputDiv" class="d-none">
                <div class="form-group mt-3">
                    <label for="TagName">Tags Name</label>
                    <input class="form-control" id="TagInputValue" type="text" placeholder="category name"/>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" id="addTagCancelBtn" class="btn btn-secondary mr-5">Cancel</button>
                    <button type="button" id="addTagConfirmBtn" class="btn btn-primary">Save</button>
                </div>
            </div>
            <div class="mt-5">
                 <div id="tagListShow" class="d-flex flex-wrap">
                  
                 </div>
            </div>
        </div>
    </div>
</div>




<!-- Category Delete Modal -->
<div class="modal" id="deleteCategoryModalShow" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <p id="deleteCategoryId" class="danger">Are Your Sure Want to Delete This</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="deleteCategoryConfirmBtn" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>




<!-- category update modal -->
<div class="modal" id="updateCategoryModalShow" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input id="updateCategoryId" type="text" value="" class="form-control" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="updateCategoryConfirmBtn" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>