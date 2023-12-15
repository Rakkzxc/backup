<!DOCTYPE html>
<html lang="en">
<?php
if (!isset($_SESSION)) {
  session_start();
  if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif (!isset($_SESSION['role']) || ($_SESSION['role'] !== "administrator") && ($_SESSION['role'] !== "staff") || ($_SESSION['role'] === "resident") || ($_SESSION['role'] === "captain")) {
    header("Location: ../../login.php");
    exit();
  } else {
    ob_start();
    include('../../include/global.inc.php') ?>

    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
      <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__wobble" src="../../assets/img/brgy-logo.png" alt="AdminLTELogo" height="200" width="200">
        </div>

        <!-- Navbar -->
        <?php include "../connection.php" ?>
        <?php include('../header.php') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include('../sidebar.php') ?>
        <!-- /.main sidebar container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Manage Resident</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Resident</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <?php
          if (!isset($_GET['resident'])) {
            ?>
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-6 col-sm-6">
                            <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal"><i
                                class="fa fa-user-plus" aria-hidden="true"></i>
                              &nbsp; Add Resident</button>
                            <?php
                            if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                              ?>
                              <button type="button" class="btn btn-danger ml-1" data-toggle="modal"
                                data-target="#deleteModal"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                                &nbsp; Delete Resident</button>
                              <?php
                            } ?>
                          </div>
                          <div class="col-6 col-sm-6 d-flex justify-content-end" style="padding: 0 14px 0 0">
                            <form method="get">
                              <div class="row">
                                <div class="form-group d-flex align-items-center my-0 py-0 pr-2">
                                  <label for="purok" class="control-label my-0 mr-3">Filter by purok</label>
                                  <select name="filter" id="purok" class="form-control select2"
                                    data-minimum-results-for-search="Infinity">
                                    <option selected disabled>Please select purok</option>
                                    <option value="alacta" <?= isset($_GET['filter']) === true ? ($_GET['filter'] === 'alacta' ? 'selected' : '') : '' ?>>Alacta</option>
                                    <option value="alaska" <?= isset($_GET['filter']) === true ? ($_GET['filter'] === 'alaska' ? 'selected' : '') : '' ?>>Alaska</option>
                                    <option value="alpine" <?= isset($_GET['filter']) === true ? ($_GET['filter'] === 'alpine' ? 'selected' : '') : '' ?>>Alpine</option>
                                    <option value="bearbrand" <?= isset($_GET['filter']) === true ? ($_GET['filter'] === 'bearbrand' ? 'selected' : '') : '' ?>>Bearbrand</option>
                                    <option value="carnation" <?= isset($_GET['filter']) === true ? ($_GET['filter'] === 'carnation' ? 'selected' : '') : '' ?>>Carnation</option>
                                    <option value="liberty" <?= isset($_GET['filter']) === true ? ($_GET['filter'] === 'liberty' ? 'selected' : '') : '' ?>>Liberty</option>
                                    <option value="nido" <?= isset($_GET['filter']) === true ? ($_GET['filter'] === 'nido' ? 'selected' : '') : '' ?>>Nido</option>
                                    <option value="sustagen" <?= isset($_GET['filter']) === true ? ($_GET['filter'] === 'sustagen' ? 'selected' : '') : '' ?>>Sustagen</option>
                                  </select>
                                </div>
                                <div class="form-group my-0 py-0 pl-2">
                                  <button type="submit" class="btn btn-success mr-1"><i class="fas fa-filter"></i>&nbsp;
                                    Filter</button>
                                  <button type="button" class="btn btn-danger ml-1" onclick="resetSelect()"><i
                                      class="fas fa-undo-alt"></i>&nbsp; Reset</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- ./card-primary -->
                    <div class="card card-primary card-outline">
                      <div class="card-body table-responsive">
                        <form method="post" enctype="multipart/form-data">
                          <table id="tblresident" class="table table-bordered table-striped table-hover">
                            <thead>
                              <tr>
                                <?php
                                if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                                  ?>
                                  <th class="align-middle user-select-none" style="width: 0px !important">
                                    <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                      <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                        id="cstm-chckbx-0" onchange="checkMain(this)">
                                      <label for="cstm-chckbx-0" class="custom-control-label custom-label"></label>
                                    </div>
                                  </th>
                                  <?php
                                } ?>
                                <th class="align-middle user-select-none">Purok</th>
                                <th class="align-middle user-select-none">Image</th>
                                <th class="align-middle user-select-none">Name</th>
                                <th class="align-middle user-select-none">Age</th>
                                <th class="align-middle user-select-none">Gender</th>
                                <th class="align-middle user-select-none">Former Address</th>
                                <th class="align-middle user-select-none" width="80px">Option</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                                if (isset($_GET['filter']) && $_GET['filter'] != '') {
                                  $filter = $_GET['filter'];
                                  $squery = mysqli_query($con, "SELECT purok,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident WHERE purok = '$filter' order by purok");
                                } else {
                                  $squery = mysqli_query($con, "SELECT purok,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident order by purok");
                                }
                                while ($row = mysqli_fetch_array($squery)) {
                                  $checkboxId = 'cstm-chckbx-' . $row['id'];
                                  echo '
                                    <tr>
                                        <td class="align-middle user-select-none" style="width: 0px !important">
                                          <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                            <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input" id="' . $checkboxId . '" value="' . $row['id'] . '">
                                            <label for="' . $checkboxId . '" class="custom-control-label"></label>
                                          </div>
                                        </td>
                                        <td class="align-middle user-select-none">' . $row['purok'] . '</td>
                                        <td class="align-middle user-select-none" style="width:60px">
                                          <image src="image/' . basename($row['image']) . '" style="width:60px; height:60px;"/>
                                        </td>
                                        <td class="align-middle user-select-none">' . $row['cname'] . '</td>
                                        <td class="align-middle user-select-none">' . $row['age'] . '</td>
                                        <td class="align-middle user-select-none">' . $row['gender'] . '</td>
                                        <td class="align-middle user-select-none">' . $row['formerAddress'] . '</td>
                                        <td class="align-middle user-select-none">
                                          <button type="button" class="btn btn-primary" data-target="#editModal' . $row['id'] . '" data-toggle="modal">
                                            <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                          </button>
                                        </td>
                                    </tr>
                                  ';
                                  include "edit_modal.php";
                                }
                              } else {
                                $squery = mysqli_query($con, "SELECT purok,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident order by purok");
                                while ($row = mysqli_fetch_array($squery)) {
                                  echo '
                                    <tr>
                                        <td class="align-middle user-select-none">' . $row['purok'] . '</td>
                                        <td class="align-middle user-select-none" style="width:60px">
                                          <image src="image/' . basename($row['image']) . '" style="width:60px; height:60px;"/>
                                        </td>
                                        <td class="align-middle user-select-none">' . $row['cname'] . '</td>
                                        <td class="align-middle user-select-none">' . $row['age'] . '</td>
                                        <td class="align-middle user-select-none">' . $row['gender'] . '</td>
                                        <td class="align-middle user-select-none">' . $row['formerAddress'] . '</td>
                                        <td class="align-middle user-select-none">
                                          <button type="button" class="btn btn-primary" data-target="#editModal' . $row['id'] . '" data-toggle="modal">
                                            <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                          </button>
                                        </td>
                                    </tr>
                                  ';
                                  include "edit_modal.php";
                                }
                              } ?>
                            </tbody>
                          </table>
                          <?php include "../../include/modal/delete.modal.inc.php" ?>
                        </form>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- ./card-primary -->
                    <?php include "../../include/session/notification/edit.session.inc.php" ?> <!-- edit -->
                    <?php include "../../include/session/notification/added.session.inc.php" ?> <!-- added -->
                    <?php include "../../include/session/notification/delete.session.inc.php" ?> <!-- delete -->
                    <?php include "../../include/session/notification/duplicate.session.inc.php" ?> <!-- duplicate -->
                    <?php include "add_modal.php" ?>
                    <?php include "function.php" ?>
                  </div>
                  <!-- ./col-12 -->
                </div>
                <!-- ./row -->
              </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
            <?php
          } else {
            ?>
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline">
                      <div class="card-body table-responsive">
                        <form method="post" enctype="multipart/form-data">
                          <table id="tblresident1" class="table table-bordered table-striped table-hover">
                            <thead>
                              <tr>
                                <th class="align-middle user-select-none">Image</th>
                                <th class="align-middle user-select-none">Name</th>
                                <th class="align-middle user-select-none">Age</th>
                                <th class="align-middle user-select-none">Gender</th>
                                <th class="align-middle user-select-none">Former Address</th>
                                <th class="align-middle user-select-none" width="80px">Option</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $squery = mysqli_query($con, "SELECT id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident where householdnum = '" . $_GET['resident'] . "'");
                              while ($row = mysqli_fetch_array($squery)) {
                                echo '
                                  <tr>
                                      <td class="align-middle user-select-none" style="width:60px">
                                        <image src="image/' . basename($row['image']) . '" style="width:60px; height:60px;"/>
                                      </td>
                                      <td class="align-middle user-select-none">' . $row['cname'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['age'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['gender'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['formerAddress'] . '</td>
                                      <td class="align-middle user-select-none">
                                        <button type="button" class="btn btn-primary" data-target="#editModal' . $row['id'] . '" data-toggle="modal">
                                          <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                        </button>
                                      </td>
                                  </tr>
                                ';
                                include "edit_modal.php";
                              } ?>
                            </tbody>
                          </table>
                          <?php include "../../include/modal/delete.modal.inc.php" ?>
                          <?php include "../../include/session/notification/duplicate.session.inc.php" ?>
                        </form>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- ./card-primary -->
                  </div>
                  <!-- ./col-12 -->
                </div>
                <!-- ./row -->
              </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
            <?php
          } ?>
        </div>
        <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->
    <?php }
}
include "../../include/footer.inc.php" ?>
  <script>
    /* occupation input */
    $(document).ready(function () {
      // Add an event listener to the select element
      $("#occupationSelect").change(function () {
        // Get the selected value
        var selectedValue = $(this).val();
        // Get the input field for specifying the occupation
        var occupationSpecified = $("#occupationSpecified");
        // If the selected value is "Others, please specify", enable the input; otherwise, disable it
        occupationSpecified.prop(
          "disabled",
          selectedValue.toLowerCase() !== "others"
        );
        // Add or remove a class based on the disabled status
        if (occupationSpecified.prop("disabled")) {
          occupationSpecified.addClass("cstm_crsr");
        } else {
          occupationSpecified.removeClass("cstm_crsr");
        }
        // Clear the value of the input field
        occupationSpecified.val("");
      });
    });

    /* reset the filter query */
    function resetSelect() {
      // Get the select element by its ID
      const select = document.getElementById("purok")
      // Set the selectedIndex to -1 to reset the selected option
      select.selectedIndex = -1
      // Submit the form after resetting the select input
      select.form.submit()
    }
  </script>
</body>

</html>