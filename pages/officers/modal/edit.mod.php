<?php echo '
<div class="modal fade" id="editModal' . $row['id'] . '">
<form action="" method="post" enctype="multipart/form-data">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <h4 class="modal-title">Add Officer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12 col-md-12 col-sm-12">
                <div class="form-group">
                  <label class="control-label">Name</label>
                  <select name="input_edit_name" class="form-control select2" autofocus>
                    <option selected disabled value="' . $row['name'] . '">' . $row['name'] . '</option>';
                    $query = mysqli_query($con, "SELECT name FROM tbladdofficeroftheday ORDER BY name ASC");
                    while ($row = mysqli_fetch_array($query)) {
                      echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                    }
                    echo '
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Position</label>
                  <select name="input_position" class="form-control select2" data-minimum-results-for-search="Infinity">
                    <option selected disabled>Please select your position</option>
                    <option value="ipmr">ipmr</option>
                    <option value="barangay kagawad">barangay kagawad</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btn_add" id="btn_add">Save changes</button>
      </div>
    </div>
  </div>
</form>
</div>'
  ?>