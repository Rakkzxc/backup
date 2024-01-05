<div class="modal fade" id="addModal">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Reference</h4>
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
                    <label class="control-label">Reference Name</label>
                    <input type="text" name="input_ref_name" class="form-control"
                      placeholder="Please enter your reference name" autofocus>
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