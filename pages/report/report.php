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
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Manage System Reports</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage System Reports</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <form action="export.php" method="post">
                        <button class="btn btn-primary" type="submit" name="export"><i class="fas fa-download"
                            aria-hidden="true"></i> &nbsp; Export Report</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <!-- AREA CHART -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Resident Per Purok Area Chart</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="areaChart"
                          style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.area chart -->

                  <!-- PIE CHART -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Educational Attainment Pie Chart</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="pieChart"
                        style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.pie chart -->

                  <!-- BAR CHART -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Resident with this Age Bar Chart</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="barChart"
                          style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.bar chart -->
                </div>
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->
    <?php }
}
include "../../include/footer.inc.php";
include "area.php";
include "pie.php";
include "bar.php";
?>
</body>

</html>