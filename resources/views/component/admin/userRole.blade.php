   <div class="container">
        <div class="row mb-2 ">
            <div class="col-12">
                <button class="btn btn-primary"  data-toggle="modal" data-target="#addUserRoleModal">Add New User Role</button>
                <h2>User Role Set by admin</h2>
                <table id="roleDataTable" class="table w-100">
                    <thead class="thead-dark text-center">
                        <th>Email</th>
                        <th id="role-html-id">Role</th>
                        <th>Edit</th>
                        <th>Delete<td>
                    </thead>
                    <tbody id="userRoleTableBody">
                        <!-- <tr>
                            <td>email@example.com</td>
                            <td>subscriber,admin,team member,blogger</td>
                            <td><a id="roleEditBtn"><i class="fas fa-edit"></i></a></td>
                            <td><a><i class="far fa-trash-alt"></i></a></td>
                        <tr> -->
                    </tbody>
                <table>
            </div>
        </div>
   </div>

   <!-- Role Add Modal -->
   <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->

<!--ROle ADD Modal -->
<div class="modal fade" id="addUserRoleModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add New Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <input class="form-control" id="roleInputValue" type="text" placeholder="Role"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="addRoleConfirmBtn" type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>


<!--ROle Edit Modal -->
<div class="modal fade" id="updateUserRoleModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Update User Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
           <div class="container">
             <div class="row">
               <div class="col-6 offset-4" id="updateRoleModalShowRole">

               </div>
             </div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="updateRoleConfirmBtn" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>