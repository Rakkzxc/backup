<!DOCTYPE html>
<html lang="en">
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
          <div class="content-header" style="padding: 20px 0.5rem 15px !important">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <!-- Info boxes -->
              <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>
                        <?php
                        $sql = mysqli_query($con, "SELECT * from tblhousehold");
                        $num_rows = mysqli_num_rows($sql);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Household</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="../household/household.php" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                  <!-- /. small-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * from tblresident");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Residents</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="../resident/resident.php" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                  <!-- /. small-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * from tblclearance where status = 'Approved' ");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Clearance</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="../clearance/clearance.php" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                  <!-- /. small-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * from tblpermit where status = 'Approved' ");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Permit</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="../permit/permit.php" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                  <!-- /. small-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * from tblblotter");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Blotter</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="../blotter/blotter.php" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                  <!-- /. small-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * from tblblotter");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Low Income</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="../blotter/blotter.php" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                  <!-- /. small-box -->
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * from tblblotter");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Certificates</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="../blotter/blotter.php" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                  <!-- /. small-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * from tblblotter");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Indigent</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="../blotter/blotter.php" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                  <!-- /. small-box -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div><!--/. container-fluid -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->
    </body>
  <?php }
}
include "../../include/footer.inc.php" ?>

</html>