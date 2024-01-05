<div class="modal fade" id="endModal<?php echo $row['id']; ?>">
  <form method="post">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">End Term Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-md-12 col-sm-12">
                  <div class="form-group pr-1">
                    <input type="hidden" value="<?php echo $row['id']; ?>" name="hidden_id" id="hidden_id">
                    <p style="margin: 16px 0">Are you sure you want to end the term of
                      <i><?php echo $row['completeName'] ?></i> ?
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary" name="btn_end" id="btn_end">Yes</button>
        </div>
      </div>
    </div>
  </form>
</div>