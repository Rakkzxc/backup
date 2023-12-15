<!DOCTYPE html>
<html>
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
                  <h1 class="m-0">Manage Household</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Household</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-sm-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        &nbsp; Add Household
                      </button>
                      <?php
                      if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                        ?>
                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">
                          <i class="fas fa-trash-alt" aria-hidden="true"></i>
                          &nbsp; Delete Household
                        </button>
                        <?php
                      } ?>
                    </div>
                    <!-- ./card-header -->
                  </div>
                  <!-- .card-primary -->
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post">
                        <table id="tblhousehold" class="table table-bordered table-striped table-hover">
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
                              <th class="align-middle user-select-none">Household #</th>
                              <th class="align-middle user-select-none">Purok</th>
                              <th class="align-middle user-select-none">Total Members</th>
                              <th class="align-middle user-select-none">Head of Family</th>
                              <th class="align-middle user-select-none" width="80px">Option</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                              $squery = mysqli_query($con, "SELECT *, h.id AS hid, h.purok AS hpurok, CONCAT(r.lname, ', ', r.fname, ' ', r.mname) AS hname FROM tblhousehold h LEFT JOIN tblresident r ON r.id = h.headoffamily");
                              while ($row = mysqli_fetch_array($squery)) {
                                $checkboxId = 'cstm-chckbx-' . $row['hid'];
                                echo '
                                  <tr>
                                      <td class="align-middle user-select-none" style="width: 0px !important">
                                        <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                          <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input" id="' . $checkboxId . '" value="' . $row['hid'] . '">
                                          <label for="' . $checkboxId . '" class="custom-control-label"></label>
                                        </div>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <a class="text-light d-flex align-items-center" href="../resident/resident.php?resident=' . $row['householdno'] . '">' . $row['householdno'] . '
                                        <span class="badge badge-info ml-2">See household</span>
                                        </a>
                                      </td>
                                      <td class="align-middle user-select-none">' . $row['hpurok'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['totalhousehold'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['hname'] . '</td>
                                      <td class="align-middle user-select-none">
                                        <button type="button" class="btn btn-primary" data-target="#editModal' . $row['hid'] . '" data-toggle="modal">
                                          <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                        </button>
                                      </td>
                                  </tr>
                                ';
                                include "edit_modal.php";
                              }
                            } else {
                              $squery = mysqli_query($con, "SELECT *, CONCAT(r.lname, ', ', r.fname, ' ', r.mname) AS hname, h.purok AS hpurok, h.id AS hid FROM tblhousehold h LEFT JOIN tblresident r ON r.id = h.headoffamily");
                              while ($row = mysqli_fetch_array($squery)) {
                                echo '
                                  <tr>
                                      <td class="align-middle user-select-none">
                                        <a class="text-light" href="../resident/resident.php?resident=' . $row['householdno'] . '">' . $row['householdno'] . '</a>
                                      </td>
                                      <td class="align-middle user-select-none">' . $row['hpurok'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['totalhousehold'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['hname'] . '</td>
                                      <td class="align-middle user-select-none">
                                        <button type="button" class="btn btn-primary" data-target="#editModal' . $row['hid'] . '" data-toggle="modal">
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
                    <!-- ./card-body -->
                  </div>
                  <!-- .card-primary -->
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
            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->
    <?php }
}
include "../../include/footer.inc.php" ?>
</body>

</html>