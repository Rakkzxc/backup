<div id="addModal" class="modal fade">
  <form method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Manage Officials</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Position</label>
                <select name="ddl_pos" class="form-control select2" data-minimum-results-for-search="Infinity">
                  <option selected disabled>Please select your position</option>
                  <option value="captain">Barangay Captain</option>
                  <option value="kagawad(ordinance)">Barangay Kagawad(Ordinance)</option>
                  <option value="kagawad(public safety)">Barangay Kagawad(Public Safety)</option>
                  <option value="kagawad(tourism)">Barangay Kagawad(Tourism)</option>
                  <option value="kagawad(budget & finance)">Barangay Kagawad(Budget & Finance)</option>
                  <option value="kagawad(agriculture)">Barangay Kagawad(Agriculture)</option>
                  <option value="kagawad(education)">Barangay Kagawad(Education)</option>
                  <option value="kagawad(infrastracture)">Barangay Kagawad(Infrastracture)</option>
                  <option value="sk chairman">SK Chairman</option>
                  <option value="secretary">Barangay Secretary</option>
                  <option value="treasurer">Barangay Treasurer</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Name</label>
                <select name="txt_cname" class="form-control select2">
                  <option selected disabled>Please select your name</option>
                  <?php
                  $squery = mysqli_query($con, "SELECT fname, lname, mname FROM tblresident");
                  while ($row = mysqli_fetch_array($squery)) {
                    echo ' <option value="' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '">' . ucwords(strtolower($row['lname'])) . ', ' . ucwords(strtolower($row['fname'])) . ' ' . ucwords(strtolower($row['mname'])) . '</option> ';
                  } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Contact #:</label>
                <input name="txt_contact" class="form-control" type="number" placeholder="Contact #">
              </div>
              <div class="form-group">
                <label>Address:</label>
                <input name="txt_address" class="form-control" type="text" placeholder="Address">
              </div>
              <div class="form-group">
                <label>Start Term:</label>
                <input id="txt_sterm" name="txt_sterm" class="form-control" type="date" placeholder="Start Term">
              </div>
              <div class="form-group">
                <label>End Term:</label>
                <input name="txt_eterm" class="form-control" type="date" placeholder="End Term">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-primary btn-sm" name="btn_add" value="Add Officials">
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