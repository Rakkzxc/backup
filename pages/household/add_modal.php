<div class="modal fade" id="addModal">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Household</h4>
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
                    <label>Household #</label>
                    <input onkeyup="show_head()" id="txt_householdno" name="txt_householdno" class="form-control"
                      type="number" placeholder="Please enter your household number" autofocus required>
                  </div>
                  <div class="form-group pr-1">
                    <label>Purok</label>
                    <input name="txt_purok" class="form-control" type="text" placeholder="Please enter your address"
                      required>
                  </div>
                  <div class="form-group pr-1">
                    <label>Total Number of Household Members</label>
                    <input id="txt_totalmembers" name="txt_totalmembers" class="form-control" type="text"
                      placeholder="This is auto generated" readonly required>
                  </div>
                  <div class="form-group pr-1">
                    <label>Head of the Family</label>
                    <span class="badge badge-warning ml-2">Please enter household number first</span>
                    <select id="txt_hof" name="txt_hof" class="form-control select2"
                      data-minimum-results-for-search="Infinity" required onchange="show_total()">
                      <option selected disabled>Please select the head of family</option>
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
</div>

<script>
  function show_head() {
    var householdID = $('#txt_householdno').val();
    console.log(householdID);
    if (householdID) {
      $.ajax({
        type: 'POST',
        url: 'household_dropdown.php',
        data: 'hhold_id=' + householdID,
        success: function (html) {
          $('#txt_hof').html(html);
        }
      });
    }
  }

  function show_total() {
    var totalID = $('#txt_hof').val();
    console.log(totalID);
    if (totalID) {
      $.ajax({
        type: 'POST',
        url: 'household_dropdown.php',
        data: 'total_id=' + totalID,
        success: function (html) {
          $('#txt_totalmembers').html(html);
        }
      });
    }
  }
</script>