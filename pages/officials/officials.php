<!DOCTYPE html>
<html>
<?php
if (!isset($_SESSION)) {
  session_start();
  if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif (!isset($_SESSION['role']) || ($_SESSION['role'] !== "administrator") && ($_SESSION['role'] !== "staff") || ($_SESSION['role'] === "resident") || ($_SESSION['role'] === "captain")) {
    header("Location: ../../login.php"); // 404
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
                  <h1 class="m-0">Manage Barangay Officials</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Barangay Officials</li>
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
                        &nbsp; Add Officials
                      </button>
                      <?php
                      if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                        ?>
                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">
                          <i class="fas fa-trash-alt" aria-hidden="true"></i>
                          &nbsp; Delete Officials
                        </button>
                        <?php
                      } ?>
                    </div>
                    <!-- ./card-header -->
                  </div>
                  <!-- ./card-primary -->
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post" enctype="multipart/form-data">
                        <table id="tblofficials" class="table table-bordered table-striped table-hover">
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
                              <th class="align-middle user-select-none">Position</th>
                              <th class="align-middle user-select-none">Name</th>
                              <th class="align-middle user-select-none">Contact</th>
                              <th class="align-middle user-select-none">Address</th>
                              <th class="align-middle user-select-none" width="90px">Start Term</th>
                              <th class="align-middle user-select-none" width="90px">End Term</th>
                              <th class="align-middle user-select-none" width="159px">Option</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                              $squery = mysqli_query($con, "SELECT * FROM tblofficial ");
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
                                      <td class="align-middle user-select-none">' . $row['sPosition'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['completeName'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['pcontact'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['paddress'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['termStart'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['termEnd'] . '</td>
                                      <td class="align-middle user-select-none">
                                        <button type="button" class="btn btn-primary mr-1" data-target="#editModal' . $row['id'] . '" data-toggle="modal">
                                          <i class="fas fa-edit" aria-hidden="true"></i> Edit
                                        </button>';
                                if ($row['status'] == 'ongoing term') {
                                  echo '
                                    <button type="button" class="btn btn-danger ml-1" data-target="#endModal' . $row['id'] . '" data-toggle="modal">
                                      <i class="far fa-calendar-times" aria-hidden="true"></i> End
                                    </button>';
                                } else {
                                  echo '
                                    <button type="button" class="btn btn-success ml-1" data-target="#startModal' . $row['id'] . '" data-toggle="modal">
                                      <i class="far fa-calendar-check" aria-hidden="true"></i> Start Term
                                    </button>';
                                }
                                echo '</td>
                                  </tr>
                                ';
                                include "modal/edit.mod.php";
                                include "modal/end.mod.php";
                                include "modal/start.mod.php";
                              }
                            } else {
                              $squery = mysqli_query($con, "SELECT * FROM tblofficial WHERE status = 'ongoing term' group by termend");
                              while ($row = mysqli_fetch_array($squery)) {
                                echo '
                                  <tr>
                                      <td class="align-middle user-select-none">' . $row['sPosition'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['completeName'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['pcontact'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['paddress'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['termStart'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['termEnd'] . '</td>
                                      <td class="align-middle user-select-none">
                                        <button type="button" class="btn btn-primary" data-target="#editModal' . $row['id'] . '" data-toggle="modal">
                                          <i class="fas fa-edit" aria-hidden="true"></i> Edit Details
                                        </button>
                                      </td>
                                  </tr>
                                ';
                                include "modal/edit.mod.php";
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
                  <?php include "modal/add.mod.php" ?>
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