<div class="container">
    <div class="row">
        <div class="col-12">
           <table id="contactDataTable" class="table  table-bordered w-100"  cellspacing="0">
                <thead >
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message Details</th>
                    <th>Delete Message</th>
                </thead>
                <tbody id="contactDataTableBody">
                    <!-- <tr>
                        <td>Tareq</td>
                        <td>tareq@gmail.com</td>
                        <td>Subject</td>
                    </tr> -->
                </tbody>
           </table>
        </div>
    </div>
</div>

<div class="modal fade" id="contactMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Message Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body text-center mt-3">
        <span id="contactDataMessage"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="contactDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Are you sure? Delete this!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-secondary" id="ContactDeleteConfirmBtn">Yes</button>
      </div>
    </div>
  </div>
</div>