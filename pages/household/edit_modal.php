<?php echo '
<div class="modal fade" id="editModal' . $row['hid'] . '">
<form action="" method="post" enctype="multipart/form-data">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <h4 class="modal-title">Edit Household</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12 col-md-12 col-sm-12">
                <input type="hidden" value="' . $row['hid'] . '" name="hidden_id" id="hidden_id">
                <input type="hidden" value="' . $row['householdno'] . '" name="hiddennum" id="hiddennum">
                <div class="form-group pr-1">
                  <label>Household #</label>
                  <input class="form-control" type="text" value="' . $row['householdno'] . '" readonly>
                </div>
                <div class="form-group pr-1">
                  <label>Purok</label>
                  <input name="txt_edit_purok" class="form-control" type="text" value="' . $row['hpurok'] . '">
                </div>
                <div class="form-group pr-1">
                  <label>Total Number of Household Members</label>
                  <input readonly id="txt_edit_totalmembers" name="txt_edit_totalmembers" class="form-control"
                    type="number" value="' . $row['totalhousehold'] . '">
                </div>
                <div class="form-group pr-1">
                  <label>Head of the Family</label>
                  <span class="badge badge-warning ml-2">Please enter household number first</span>';
                  $qry = mysqli_query($con, "SELECT *,CONCAT(lname, ', ', fname, ' ', mname) AS NAME FROM tblresident WHERE id = '" . $row['headoffamily'] . "' ");
                  while ($row = mysqli_fetch_array($qry)) {
                    echo '<input class="form-control input-sm" type="text" value="' . $row['lname'] . ", " . $row['fname'] . " " . $row['mname'] . '" readonly />';
                  }
                  echo '
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btn_save">Save changes</button>
      </div>
    </div>
  </div>
</form>
</div>'
  ?>