<div id="addModal" class="modal fade">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-sm" style="width:300px !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Manage Barangay Captain</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Firstname:</label>
                <input name="input_fname" class="form-control input-sm" type="text" placeholder="Your first name">
              </div>
              <div class="form-group">
                <label>Lastname:</label>
                <input name="input_lname" class="form-control input-sm" type="text" placeholder="Your last name">
              </div>
              <div class="form-group">
                <label>Username:</label>
                <input name="input_uname" class="form-control input-sm" id="username" type="text"
                  placeholder="Username">
                <label id="user_msg"></label>
              </div>
              <div class="form-group">
                <label>Password:</label>
                <input name="input_pass" class="form-control input-sm" type="password" placeholder="*******">
              </div>
              <div class="form-group">
                <label>Image:</label>
                <input name="input_image" class="form-control input-sm" type="file">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-primary btn-sm" name="btn_add" value="Add" id="btn_add">
        </div>
      </div>
    </div>
  </form>
</div>