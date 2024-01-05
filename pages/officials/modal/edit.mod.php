<?php echo '
<div class="modal fade" id="editModal' . $row['id'] . '">
<form action="" method="post" enctype="multipart/form-data">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <h4 class="modal-title">Manage Edit Officials</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12 col-md-12 col-sm-12">
                <input type="hidden" value="' . $row['id'] . '" name="hidden_id" id="hidden_id">
                <div class="form-group pr-1">
                  <label class="control-label">Position</label>
                  <input class="form-control" type="text" value="' . $row['sPosition'] . '" readonly>
                </div>
                <div class="form-group pr-1">
                  <label class="control-label">Name</label>
                  <input name="txt_edit_cname" class="form-control" type="text" value="' . $row['completeName'] . '" readonly>
                </div>
                <div class="form-group pr-1">
                  <label class="control-label">Contact #</label>
                  <input name="txt_edit_contact" class="form-control" type="text" value="' . $row['pcontact'] . '">
                </div>
                <div class="form-group pr-1">
                  <label class="control-label">Address</label>
                  <input name="txt_edit_address" class="form-control" type="text" value="' . $row['paddress'] . '">
                </div>
                <div class="form-group pr-1">
                  <label class="control-label" for="txt_sterm">Start Term</label>
                  <input name="txt_edit_sterm" class="form-control" type="date" value="' . $row['termStart'] . '">
                </div>
                <div class="form-group pr-1">
                  <label class="control-label" for="txt_eterm">End Term</label>
                  <input name="txt_edit_eterm" class="form-control" type="date" value="' . $row['termEnd'] . '">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel">
        <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Save changes">
      </div>
    </div>
  </div>
</form>
</div>'
  ?>