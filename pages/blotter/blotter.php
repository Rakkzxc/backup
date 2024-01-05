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
                  <h1 class="m-0">Manage Blotter</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Blotter</li>
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
                      <?php
                      if ((!isset($_SESSION['role'])) || ($_SESSION['role'] == "administrator") || (!isset($_SESSION['role'])) || ($_SESSION['role'] == "staff")) {
                        // kong naay naka login then display the add and delete buttons else remove
                        ?>
                        <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal">
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                          &nbsp; Add Blotter
                        </button>
                        <?php
                        if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) {
                          ?>
                          <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            &nbsp; Delete Blotter
                          </button>
                          <?php
                        }
                      } ?>
                    </div>
                  </div>
                  <!-- ./card-primary -->
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post">
                        <table id="tblblotter" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <?php
                              if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) {
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
                              <th class="align-middle">Date</th>
                              <th class="align-middle">Complainant</th>
                              <th class="align-middle">Complainee</th>
                              <th class="align-middle">Complaint</th>
                              <th class="align-middle">Action</th>
                              <th class="align-middle">Status</th>
                              <th class="align-middle">Location</th>
                              <th class="align-middle" width="101px">Option</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) {
                              $squery = mysqli_query($con, "SELECT *,r.id as rid,b.id as bid,CONCAT(r.lname,', ', r.fname, ' ', r.mname) as rname from tblblotter b left join tblresident r on b.personToComplain = r.id ") or die('Error: ' . mysqli_error($con));
                              while ($row = mysqli_fetch_array($squery)) {
                                $checkboxId = 'cstm-chckbx-' . $row['bid'];
                                echo '
                                  <tr>
                                      <td class="align-middle user-select-none" style="width: 0px !important">
                                        <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                          <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input" id="' . $checkboxId . '" value="' . $row['bid'] . '">
                                          <label for="' . $checkboxId . '" class="custom-control-label"></label>
                                        </div>
                                      </td>
                                      <td class="align-middle">' . $row['datetimeRecorded'] . '</td>
                                      <td class="align-middle">' . $row['complainant'] . '</td>
                                      <td class="align-middle">' . $row['rname'] . '</td>
                                      <td class="align-middle">' . $row['complaint'] . '</td>
                                      <td class="align-middle">' . $row['actionTaken'] . '</td>
                                      <td class="align-middle">' . $row['sStatus'] . '</td>
                                      <td class="align-middle">' . $row['locationOfIncidence'] . '</td>
                                      <td class="align-middle">
                                        <button type="button" class="btn btn-primary" data-target="#editModal' . $row['bid'] . '" data-toggle="modal">
                                          <i class="fas fa-edit" aria-hidden="true"></i> Update
                                        </button>
                                      </td>
                                  </tr>
                                ';
                                include "edit_modal.php";
                              }
                            } else {
                              $squery = mysqli_query($con, "SELECT *,r.id as rid,b.id as bid,CONCAT(r.lname,', ', r.fname, ' ', r.mname) as rname from tblblotter b left join tblresident r on b.personToComplain = r.id ") or die('Error: ' . mysqli_error($con));
                              while ($row = mysqli_fetch_array($squery)) {
                                echo '
                                  <tr>
                                      <td>' . $row['datetimeRecorded'] . '</td>
                                      <td>' . $row['complainant'] . '</td>
                                      <td>' . $row['rname'] . '</td>
                                      <td>' . $row['complaint'] . '</td>
                                      <td>' . $row['actionTaken'] . '</td>
                                      <td>' . $row['sStatus'] . '</td>
                                      <td>' . $row['locationOfIncidence'] . '</td>
                                      <td>
                                        <button type="button" class="btn btn-primary" data-target="#editModal' . $row['bid'] . '" data-toggle="modal">
                                          <i class="fas fa-edit" aria-hidden="true"></i> Edit Details
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