<!DOCTYPE html>
<html>
<?php
if (!isset($_SESSION)) {
  session_start();
  if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif (($_SESSION['role'] !== "administrator") || ($_SESSION['role'] === "resident") || ($_SESSION['role'] === "staff") || ($_SESSION['role'] === "captain")) {
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
                  <h1 class="m-0">Barangay System Logs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Barangay System Logs</li>
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
                    <div class="card-body table-responsive">
                      <form method="post">
                        <table id="tbllogs" class="table table-bordered table-striped table-hover">
                          <thead>
                            <tr>
                              <th class="align-middle user-select-none" width="255px">User</th>
                              <th class="align-middle user-select-none" width="200px">Date</th>
                              <th class="align-middle user-select-none">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $squery = mysqli_query($con, "SELECT * FROM tbllogs ORDER BY logdate DESC");
                            while ($row = mysqli_fetch_array($squery)) {
                              echo '
                                <tr>
                                    <td class="align-middle user-select-none">' . $row['user'] . '</td>
                                    <td class="align-middle user-select-none">' . $row['logdate'] . '</td>
                                    <td class="align-middle user-select-none">' . $row['action'] . '</td>
                                </tr>
                              ';
                            } ?>
                          </tbody>
                        </table>
                      </form>
                    </div>
                  </div>
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