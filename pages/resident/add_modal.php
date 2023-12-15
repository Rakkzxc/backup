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
                  <!-- name of resident -->
                  <div class="form-group pr-1">
                    <div class="row">
                      <div class="col-4">
                        <label class="form-label" for="lastName">Last name</label>
                        <input name="txt_lname" class="form-control" type="text" id="lastName"
                          placeholder="Your last name" autofocus>
                      </div>
                      <div class="col-4">
                        <label class="form-label" for="firstName">First name</label>
                        <input name="txt_fname" class="form-control" type="text" id="firstName"
                          placeholder="Your first name">
                      </div>
                      <div class="col-4">
                        <label class="form-label" for="middleName">Middle name</label>
                        <input name="txt_mname" class="form-control" type="text" id="middleName"
                          placeholder="Your middle name">
                      </div>
                    </div>
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label" for="birthDate">Birthdate</label>
                    <input name="txt_bdate" class="form-control" type="text" data-inputmask-alias="datetime"
                      data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy" data-mask>
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Barangay:</label>
                    <input name="txt_brgy" class="form-control" type="text" placeholder="Barangay">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Household #:</label>
                    <input name="txt_householdnum" class="form-control" type="number" min="1" placeholder="Household #">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Differently-abled Person:</label>
                    <input name="txt_dperson" class="form-control" type="text" placeholder="Differently-abled Person">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Blood Type:</label>
                    <input name="txt_btype" class="form-control" type="text" placeholder="Blood Type">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Civil Status:</label>
                    <select name="txt_cstatus" class="form-control select2" data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select your civil status</option>
                      <option value="married">Married</option>
                      <option value="single">Single</option>
                      <option value="widow/widower">Widow/widower</option>
                      <option value="separated">Separated</option>
                      <option value="live-in">Live-in</option>
                    </select>
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Length of Stay: (in Months)</label><br>
                    <input name="txt_length" class="form-control" type="number" min="0" placeholder="Length of Stay">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Religion:</label>
                    <input name="txt_religion" class="form-control" type="text" placeholder="Religion">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">IgpitID:</label>
                    <input name="txt_igpit" class="form-control" type="number" placeholder="" min="1">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Educational Attainment</label>
                    <select name="ddl_eattain" class="form-control select2" data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select your educational attainment</option>
                      <option value="no schooling completed">No schooling completed</option>
                      <option value="elementary level">Elementary level</option>
                      <option value="elementary graduate">Elementary graduate</option>
                      <option value="high school level">High school level</option>
                      <option value="high school graduate">High school graduate</option>
                      <option value="vocational">Vocational</option>
                      <option value="college level">College level</option>
                      <option value="college graduate">College graduate</option>
                      <option value="post graduate">Post graduate</option>
                    </select>
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Land Ownership Status:</label>
                    <select name="ddl_los" class="form-control">
                      <option value="owned">Owned</option>
                      <option value="landless">Landless</option>
                      <option value="tenant">Tenant</option>
                      <option value="care Taker">Care Taker</option>
                    </select>
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Sources of Water Supply for Drinking</label>
                    <select name="txt_sofwatersupply[]" class="form-control select2"
                      data-placeholder="Please select your sources of water supply" multiple>
                      <option value="community water system">Community Water System</option>
                      <option value="developed spring">Developed Spring</option>
                      <option value="protected well">Protected Well</option>
                      <option value="truck/tanker peddler">Truck/tanker Peddler</option>
                      <option value="bottled water">Bottled Water</option>
                      <option value="undevelop spring">Undevelop Spring</option>
                      <option value="unprotected well">Unprotected Well</option>
                      <option value="rainwater">Rainwater</option>
                      <option value="river, stream or dam">River, Stream or Dam</option>
                    </select>
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Sanitary Toilet:</label>
                    <select name="txt_toilet" class="form-control">
                      <option value="water-sealed">Water-sealed</option>
                      <option value="antipolo">Antipolo</option>
                      <option value="none">None</option>
                    </select>
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Remarks:</label>
                    <input name="txt_remarks" class="form-control" type="text" placeholder="Remarks">
                  </div>
                  <div class="form-group pr-1">
                    <label class="control-label">Username:</label>
                    <input name="txt_uname" id="username" class="form-control" type="text" placeholder="Username">
                    <label id="user_msg"></label>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group pl-1">
                    <label class="control-label">Gender:</label>
                    <select name="ddl_gender" class="form-control select2" data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select your gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Birthplace:</label>
                    <input name="txt_bplace" class="form-control" type="text" placeholder="Birthplace">
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Health Status</label>
                    <select name="txt_hstatus" class="form-control select2" data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select your health status</option>
                      <option value="hypertension">Hypertension</option>
                      <option value="diabetes mellitus">Diabetes Mellitus</option>
                      <option value="tuberculosis">Tuberculosis</option>
                      <option value="cancer">Cancer</option>
                      <option value="mental illness">Mental Illness</option>
                      <option value="persons with disability">Persons with Disability</option>
                      <option value="smokers">Smokers</option>
                    </select>
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Purok:</label>
                    <input name="txt_purok" class="form-control" type="text" placeholder="Purok">
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Total Household Member:</label>
                    <input name="txt_householdmem" class="form-control" type="number" min="1"
                      placeholder="Total Household Member">
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Relationship to the Head of the Family</label>
                    <select name="txt_rthead" class="form-control select2" data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select your relationship</option>
                      <option value="spouse">Spouse</option>
                      <option value="child">Child</option>
                      <option value="live-in partner">Live-in partner</option>
                      <option value="co-wife">Co-wife</option>
                      <option value="son-in-law">Son-in-law</option>
                      <option value="daughter-in-law">Daughter-in-law</option>
                      <option value="parent">Parent</option>
                      <option value="sibling">Sibling</option>
                      <option value="grandparent">Grandparent</option>
                      <option value="grandchild">Grandchild</option>
                    </select>
                  </div>
                  <div class="form-group pr-1">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Occupation</label>
                        <select name="txt_occp" id="occupationSelect" class="form-control select2"
                          data-minimum-results-for-search="Infinity">
                          <option selected disabled>Please select your occupation</option>
                          <option value="government employee">Government employee</option>
                          <option value="private employee">Private employee</option>
                          <option value="farmer">Farmer</option>
                          <option value="fisherman">Fisherman</option>
                          <option value="housekeeper/housewife">Housekeeper/housewife</option>
                          <option value="laborer/construction worker">Laborer/construction worker</option>
                          <option value="vendor">Vendor</option>
                          <option value="others">Others, please specify</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your occupation</label>
                        <input type="text" name="txt_occp" id="occupationSpecified" class="form-control cstm_crsr"
                          placeholder="Please specify your occupation" disabled autofocus>
                      </div>
                    </div>
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Monthly Income:</label>
                    <input name="txt_income" class="form-control" type="number" min="1" placeholder="Monthly Income">
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Nationality:</label>
                    <input name="txt_national" class="form-control" type="text" placeholder="Nationality">
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Skills:</label>
                    <input name="txt_skills" class="form-control" type="text" placeholder="Skills">
                  </div>
                  <div class="form-group pl-1">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">PhilHealth Number</label>
                        <input name="txt_phno" class="form-control" type="text"
                          data-inputmask='"mask": "99-999999999-9"' placeholder="__-_________-_" data-mask>
                      </div>
                      <div class="col-6">
                        <label class="control-label">PhilHealth Expiration Date</label>
                        <input name="txt_phno_exp_date" class="form-control" type="text" data-inputmask-alias="datetime"
                          data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy" data-mask>
                      </div>
                    </div>
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">House Ownership Status:</label>
                    <select name="ddl_hos" class="form-control">
                      <option value="own home">Own Home</option>
                      <option value="rent">Rent</option>
                      <option value="live with parents/relatives">Live with Parents/Relatives</option>
                    </select>
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Dwelling Type:</label>
                    <select name="ddl_dtype" class="form-control">
                      <option value="1st option">1st Option</option>
                      <option value="2nd option">2nd Option</option>
                    </select>
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Lightning Facilities:</label>
                    <select name="txt_lightning" class="form-control">
                      <option value="electric">Electric</option>
                      <option value="lamp">Lamp</option>
                    </select>
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Former Address:</label>
                    <input name="txt_faddress" class="form-control" type="text" placeholder="Former Address">
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Password:</label>
                    <input name="txt_upass" class="form-control" type="password" placeholder="Password">
                  </div>
                  <div class="form-group pl-1">
                    <label class="control-label">Image:</label>
                    <input name="txt_image" class="form-control" type="file">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_add" id="btn_add">Save changes</button>
        </div>
      </div>
      <!--.modal-content -->
    </div>
    <!--.modal-dialog -->
  </form>
</div>
<!--.modal -->