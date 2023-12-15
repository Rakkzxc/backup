<!DOCTYPE html>
<html>
<?php
if (!isset($_SESSION)) {
  session_start();
  if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif ((!isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (!isset($_SESSION['role']) && $_SESSION['role'] === "staff") || (!isset($_SESSION['role']) && $_SESSION['role'] === "captain") || (!isset($_SESSION['role']) && $_SESSION['role'] === "resident")) {
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
                  <h1 class="m-0">Manage Announcement</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Announcement</li>
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
                  <?php
                  if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                    ?>
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal">
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                          &nbsp; Add Announcement</button>
                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">
                          <i class="fas fa-trash-alt" aria-hidden="true"></i>
                          &nbsp; Delete Announcement</button>
                      </div>
                      <!-- ./card-header -->
                    </div>
                    <!-- ./card-primary -->
                    <?php
                  } ?>
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post">
                        <table id="tblannouncement" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <?php
                              if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) {
                                ?>
                                <th class="align-middle user-select-none" style="width: 0px !important">
                                  <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                    <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                      id="cstm-chckbx-1" onchange="checkMain(this)">
                                    <label for="cstm-chckbx-1" class="custom-control-label custom-label"></label>
                                  </div>
                                </th>
                                <?php
                              } ?>
                              <th class="align-middle user-select-none" width="220px">Date of Announcement</th>
                              <th class="align-middle user-select-none">Announcement</th>
                              <th class="align-middle user-select-none">Description</th>
                              <th class="align-middle user-select-none" width="261.7px">Option</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                              $squery = mysqli_query($con, "SELECT * FROM tblannouncement");
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
                                      <td class="align-middle user-select-none">' . $row['dateofannouncement'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['announcement'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['description'] . '</td>
                                      <td class="align-middle user-select-none">
                                          <button type="button" class="btn btn-primary mr-1" data-target="#editModal' . $row['id'] . '" data-toggle="modal">
                                            <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit Details
                                          </button>
                                          <button type="button" class="btn btn-success ml-1" data-target="#viewModal' . $row['id'] . '" data-toggle="modal">
                                            <i class="fas fa-images" aria-hidden="true"></i>&nbsp See Photos
                                          </button>
                                      </td>
                                  </tr>
                                ';
                                include "modal/edit.mod.php";
                                include "modal/view.mod.php";
                              }
                            } elseif (isset($_SESSION['role']) && $_SESSION['role'] === "resident") {
                              $squery = mysqli_query($con, "SELECT * FROM tblannouncement");
                              while ($row = mysqli_fetch_array($squery)) {
                                echo '
                                  <tr>
                                      <td class="align-middle user-select-none">' . $row['dateofannouncement'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['announcement'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['description'] . '</td>
                                      <td class="align-middle user-select-none">
                                        <button type="button" class="btn btn-success ml-1" data-target="#viewModal' . $row['id'] . '" data-toggle="modal">
                                          <i class="fas fa-images" aria-hidden="true"></i>&nbsp See Photos
                                        </button>
                                      </td>
                                  </tr>
                                ';
                                include "modal/view.mod.php";
                              }
                            } else {
                              $squery = mysqli_query($con, "SELECT * FROM tblannouncement");
                              while ($row = mysqli_fetch_array($squery)) {
                                echo '
                                  <tr>
                                      <td class="align-middle user-select-none">' . $row['dateofannouncement'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['announcement'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['description'] . '</td>
                                      <td class="align-middle user-select-none">
                                        <button type="button" class="btn btn-success ml-1" data-target="#viewModal' . $row['id'] . '" data-toggle="modal">
                                          <i class="fas fa-images" aria-hidden="true"></i>&nbsp See Photos
                                        </button>
                                      </td>
                                  </tr>
                                ';
                                include "modal/edit.mod.php";
                                include "modal/view.mod.php";
                              }
                            } ?>
                          </tbody>
                        </table>
                        <?php include "../../include/modal/delete.modal.inc.php" ?>
                      </form>
                    </div>
                    <!-- ./card-body -->
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
  <script type="text/javascript">
    <?php
    if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
      ?>
      // datatables here ...
      $(function () {
        $("#tblannouncement").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print"],
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "aoColumnDefs": [
            { "bSortable": false, "aTargets": [0, 4] },
            { "orderable": false, "targets": [0, 4] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblannouncement_wrapper .col-md-6:eq(0)')
      });
      <?php
    } elseif (isset($_SESSION['role']) && $_SESSION['role'] === "resident") {
      ?>
      // datatables here ...
      $(function () {
        $("#tblannouncement").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print"],
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "aoColumnDefs": [
            { "bSortable": false, "aTargets": [3] },
            { "orderable": false, "targets": [3] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblannouncement_wrapper .col-md-6:eq(0)')
      });
      <?php
    } else {
      ?>
      // datatables here ...
      $(function () {
        $("#tblannouncement").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print"],
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "aoColumnDefs": [
            { "bSortable": false, "aTargets": [3] },
            { "orderable": false, "targets": [3] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblannouncement_wrapper .col-md-6:eq(0)')
      });
      <?php
    }
    ?>

    var select_all = document.getElementById("cbxMainphoto"); // select all checkbox
    var checkboxes = document.getElementsByClassName("chk_deletephoto"); // checkbox items
    // select all checkboxes
    select_all.addEventListener("change", function (e) {
      for (i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = select_all.checked;
      }
    });

    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].addEventListener('change', function (e) { // .checkbox change 
        // uncheck "select all", if one of the listed checkbox item is unchecked
        if (this.checked == false) {
          select_all.checked = false;
        }
        // check "select all" if all checkbox items are checked
        if (document.querySelectorAll('.checkbox:checked').length == checkboxes.length) {
          select_all.checked = true;
        }
      });
    }
  </script>
</body>

</html>