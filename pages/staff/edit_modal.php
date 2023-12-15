<?php echo '
<div id="editModal' . $row['id'] . '" class="modal fade">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Manage Edit Staff</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" value="' . $row['id'] . '" name="hidden_id" id="hidden_id">
              <div class="form-group">
                <label>Firstname</label>
                <input name="input_edit_fname" class="form-control" type="text" value="' . $row['fname'] . '">
              </div>
              <div class="form-group">
                <label>Lastname</label>
                <input name="input_edit_lname" class="form-control" type="text" value="' . $row['lname'] . '">
              </div>
              <div class="form-group">
                <label>Username</label>
                <input name="input_edit_uname" class="form-control" type="text" value="' . $row['username'] . '">
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input name="input_edit_pass" class="form-control" type="password" placeholder="Your new password">
              </div>
              <div class="form-group">
                <label>Image</label>
                <input name="input_edit_image" class="form-control" type="file">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary btn-sm" name="btn_save">Save</button>
        </div>
      </div>
    </div>
  </form>
</div>'
  ?>