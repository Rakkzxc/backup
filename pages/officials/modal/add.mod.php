<div class="modal fade" id="addModal">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Official</h4>
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
                    <label class="control-label">Position</label>
                    <select name="ddl_pos" class="form-control select2" data-minimum-results-for-search="Infinity"
                      autofocus>
                      <option selected disabled>Please select your position</option>
                      <option value="barangay captain">barangay captain</option>
                      <option value="kagawad (ordinance)">barangay kagawad (ordinance)</option>
                      <option value="kagawad (public safety)">barangay kagawad (public safety)</option>
                      <option value="kagawad (tourism)">barangay kagawad (tourism)</option>
                      <option value="kagawad (budget & finance)">barangay kagawad (budget & finance)</option>
                      <option value="kagawad (agriculture)">barangay kagawad (agriculture)</option>
                      <option value="kagawad (education)">barangay kagawad (education)</option>
                      <option value="kagawad (infrastracture)">barangay kagawad (infrastracture)</option>
                      <option value="sk chairman">sk chairman</option>
                      <option value="secretary">barangay secretary</option>
                      <option value="treasurer">barangay treasurer</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Name</label>
                    <select name="txt_cname" class="form-control select2">
                      <option selected disabled>Please select your name</option>
                      <?php
                      $squery = mysqli_query($con, "SELECT fname, lname, mname FROM tblresident");
                      while ($row = mysqli_fetch_array($squery)) {
                        echo ' <option value="' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option> ';
                      } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Contact #</label>
                    <input name="txt_contact" class="form-control" type="number"
                      placeholder="Please enter your contact number">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Address</label>
                    <input name="txt_address" class="form-control" type="text" placeholder="Please enter your address">
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="txt_sterm">Start Term</label>
                    <input name="txt_sterm" id="txt_sterm" class="form-control" type="text"
                      data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy"
                      data-mask>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="txt_eterm">End Term</label>
                    <input name="txt_eterm" id="txt_eterm" class="form-control" type="text"
                      data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy"
                      data-mask>
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
<script type="text/javascript">
  $(document).ready(function () {
    $('input[name="txt_sterm"]').change(function () {
      var startterm = document.getElementById("txt_sterm").value;
      console.log(startterm);
      document.getElementsByName("txt_eterm")[0].setAttribute('min', startterm);
    });
  });
</script>