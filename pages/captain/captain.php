<!DOCTYPE html>
<html>

<?php
if (!isset($_SESSION)) {
  session_start();
  if (!isset($_SESSION['role']) || ($_SESSION['role'] !== "administrator") && ($_SESSION['role'] !== "staff") || ($_SESSION['role'] === "resident") || ($_SESSION['role'] === "captain")) {
    header("Location: ../../public/404.public.php");
    exit();
  } else {
    ob_start();
    include('../../include/global.inc.php'); ?>

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
                  <h1 class="m-0">Manage Barangay Captain</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Barangay Captain</li>
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
                        &nbsp; Add Captain
                      </button>
                      <?php
                      if (!isset($_SESSION['staff'])) {
                        ?>
                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">
                          <i class="fas fa-trash-alt" aria-hidden="true"></i>
                          &nbsp; Delete Captain
                        </button>
                        <?php
                      } ?>
                    </div>
                  </div>
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post">
                        <table id="tblcaptain" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <?php
                              if (!isset($_SESSION['staff'])) {
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
                              <th>Image</th>
                              <th>Name</th>
                              <th>Userame</th>
                              <th>Option</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if (!isset($_SESSION['staff'])) {
                              $squery = mysqli_query($con, "SELECT * FROM tblcaptain ");
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
                                      <td class="align-middle" style="width:60px">
                                        <image src="image/' . basename($row['image']) . '" style="width:60px; height:60px;"/>
                                      </td>
                                      <td class="align-middle">' . ucwords(strtolower($row['fname'])) . ' ' . ucwords(strtolower($row['lname'])) . '</td>
                                      <td class="align-middle">' . ucwords(strtolower($row['username'])) . '</td>
                                      <td class="align-middle">
                                        <button type="button" class="btn btn-primary" data-target="#editModal' . $row['id'] . '" data-toggle="modal">
                                          <i class="fas fa-edit" aria-hidden="true"></i> &nbsp; Edit Details
                                        </button>
                                      </td>
                                  </tr>
                                ';
                                include "edit_modal.php";
                              }
                            } else {
                              $squery = mysqli_query($con, "SELECT * FROM tblcaptain ");
                              while ($row = mysqli_fetch_array($squery)) {
                                echo '
                                  <tr>
                                      <td class="align-middle">' . ucwords(strtolower($row['purok'])) . '</td>
                                      <td class="align-middle" style="width:60px">
                                        <image src="image/' . basename($row['image']) . '" style="width:60px; height:60px;"/>
                                      </td>
                                      <td class="align-middle">' . ucwords(strtolower($row['fname'])) . ' ' . ucwords(strtolower($row['lname'])) . '</td>
                                      <td class="align-middle">' . ucwords(strtolower($row['username'])) . '</td>
                                      <td class="align-middle">
                                        <button type="button" class="btn btn-primary" data-target="#editModal' . $row['id'] . '" data-toggle="modal">
                                          <i class="fas fa-edit" aria-hidden="true"></i> &nbsp; Edit Details
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
                  </div>
                  <!-- ./card-primary -->
                  <?php include "../../include/session/notification/edit.session.inc.php" ?> <!-- edit -->
                  <?php include "../../include/session/notification/added.session.inc.php" ?> <!-- added -->
                  <?php include "../../include/session/notification/delete.session.inc.php" ?> <!-- delete -->
                  <?php include "../../include/session/notification/duplicate.session.inc.php" ?> <!-- duplicate -->
                  <?php include "add_modal.php" ?>
                  <?php include "function.php" ?>
                </div>
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