<div class="modal fade" id="addModal">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Manage Residents</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group pr-1">
                    <label class="control-label">Complainant</label>
                    <select name="txt_cname" class="form-control select2">
                      <option selected disabled>Please select complainant</option>
                      <?php
                      $qry = mysqli_query($con, "SELECT * FROM tblresident");
                      while ($row = mysqli_fetch_array($qry)) {
                        echo '<option>' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option>';
                      } ?>
                    </select>
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Age</label>
                    <input name="txt_cage" class="form-control" type="number"
                      placeholder="Please enter complainant age">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Address</label>
                    <input name="txt_cadd" class="form-control" type="text"
                      placeholder="Please enter complainant address">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Contact #</label>
                    <input name="txt_ccontact" class="form-control" type="number"
                      placeholder="Please enter complainant contact number">
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group pr-1">
                    <label class="control-label">Complainee</label>
                    <select name="txt_pname" class="form-control select2">
                      <option selected disabled>Please select complainee</option>
                      <?php
                      $qry = mysqli_query($con, "SELECT * FROM tblresident");
                      while ($row = mysqli_fetch_array($qry)) {
                        echo '<option value="' . $row['id'] . '">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option>';
                      } ?>
                    </select>
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Age</label>
                    <input name="txt_page" class="form-control" type="number" placeholder="Please enter complainee age">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Address</label>
                    <input name="txt_padd" class="form-control" type="text"
                      placeholder="Please enter complainee address">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Contact #</label>
                    <input name="txt_pcontact" class="form-control" type="number"
                      placeholder="Please enter complainee contact number">
                  </div>
                </div>
                <div class="col-12 col-md-12 col-sm-12">
                  <div class="form-group pr-1">
                    <div class="row">
                      <div class="col-12 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Complaint</label>
                          <input name="txt_complaint" class="form-control" type="text"
                            placeholder="Please enter complaint">
                        </div>
                      </div>
                      <div class="col-12 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Action</label>
                          <select name="ddl_acttaken" class="form-control select2"
                            data-minimum-results-for-search="Infinity">
                            <option selected disabled>Please select offense</option>
                            <option value="first offense">First Offense</option>
                            <option value="second Option">Second Offense</option>
                            <option value="kulong">Kulong</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Status</label>
                          <select name="ddl_stat" class="form-control select2"
                            data-minimum-results-for-search="Infinity">
                            <option selected disabled>Please select status</option>
                            <option value="solved">Solved</option>
                            <option value="unsolved">Unsolved</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Incidence</label>
                          <input name="txt_location" class="form-control" type="text"
                            placeholder="Location of Incidence">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="btn_add" id="btn_add">Add Blotter</button>
        </div>
      </div>
    </div>
  </form>
</div>