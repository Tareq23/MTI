<div class="container">

    <div class="row">

        <div class="col-12">
        
            <table class="table">
                <thead>
                    <tr>
                        <th>Profile Image</th>
                        <th>Name</th>
                        <th>Priority Number</th>
                        <!-- <th>social link</th> -->
                        <th>Details</th>
                        <th>confirm</th>
                    </tr>
                </thead>
                <tbody id="team_member_table">
                    <!-- <tr>
                        <td>image</td>
                        <td>Team Member Name</td>
                        <td>priority</td>
                        <td>
                            <ul>
                                <li>facebook</li>
                                <li>Linked In</li>
                                <li>git hub</li>
                            </ul>
                        </td>
                        <td><i class="fas fa-eye"></i></td>
                        <td><a><i class="fas fa-check-circle"></i></a></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal" id="userProfileDetailsModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div>
            <h3>Social Link</h3>
            <ul id="profile_social_link">
            
            </ul>
        </div>
        <div>
            <h4>Short description</h4>
            <p id="profile_description"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
