<div class="modal fade" id="addModal">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Manage Announcement</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-md-12 col-sm-12">
                  <div class="form-group pr-1">
                    <label>Date of Announcement</label>
                    <input name="input_doc" class="form-control" type="date">
                  </div>
                  <div class="form-group pr-1">
                    <label>Announcement</label>
                    <input name="input_act" class="form-control" type="text" placeholder="Please enter announcement">
                  </div>
                  <div class="form-group pr-1">
                    <label>Description</label>
                    <textarea name="input_desc" class="form-control" placeholder="Please enter description"></textarea>
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Image</label>
                    <input name="files[]" class="form-control" type="file" multiple>
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
</div>