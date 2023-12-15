<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: ../../login.php");
} else {
  ob_start();
  include('../../include/global.inc.php') ?>

  <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="../../assets/img/brgy-logo.png" alt="Brgy Logo" height="200" width="200">
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
                <h1 class="m-0">Manage Clearance</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Manage Clearance</li>
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
              <?php
              if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff") || (!isset($_SESSION['role']) && $_SESSION['role'] !== "captain") && (!isset($_SESSION['role']) && $_SESSION['role'] !== "resident")) {
                ?>
                <div class="col-12 col-sm-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal"><i
                          class="fa fa-user-plus" aria-hidden="true"></i>
                        &nbsp; Add Clearance</button>
                      <?php if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) { ?>
                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal"><i
                            class="fas fa-trash-alt" aria-hidden="true"></i>
                          &nbsp; Delete Clearance</button>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <!-- new -->
                        <li class="nav-item">
                          <a class="nav-link active" id="new-cstm-tab" data-target="#new" data-toggle="pill" href="#new"
                            role="tab" aria-controls="new-cstm-tab" aria-selected="true">New</a>
                        </li>
                        <!-- approved -->
                        <li class="nav-item">
                          <a class="nav-link" id="approved-cstm-tab" data-target="#approved" data-toggle="pill"
                            href="#approved" role="tab" aria-controls="approved-cstm-tab"
                            aria-selected="false">Approrved</a>
                        </li>
                        <!-- disapproved -->
                        <li class="nav-item">
                          <a class="nav-link" id="disapproved-cstm-tab" data-target="#disapproved" data-toggle="pill"
                            href="#disapproved" role="tab" aria-controls="disapproved-cstm-tab"
                            aria-selected="false">Disapprove</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body table-responsive">
                      <form method="post">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                          <!-- new -->
                          <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-cstm-tab">
                            <table id="tblclearance" class="table table-bordered table-striped table-hover">
                              <thead>
                                <tr>
                                  <th class="align-middle user-select-none" style="width: 0px !important">
                                    <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                      <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                        id="cstm-chckbx-0" onchange="checkMain(this)">
                                      <label for="cstm-chckbx-0" class="custom-control-label custom-label"></label>
                                    </div>
                                  </th>
                                  <th class="align-middle user-select-none">Resident Name</th>
                                  <th class="align-middle user-select-none">Purpose</th>
                                  <th class="align-middle user-select-none" width="253.95px">Option</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'new'") or die('Error: ' . mysqli_error($con));
                                while ($row = mysqli_fetch_array($squery)) {
                                  $checkboxId = 'cstm-chckbx-' . $row['pid'];
                                  echo '
                                  <tr>
                                      <td class="align-middle user-select-none" style="width: 0px !important">
                                        <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                          <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input" id="' . $checkboxId . '" value="' . $row['pid'] . '">
                                          <label for="' . $checkboxId . '" class="custom-control-label"></label>
                                        </div>
                                      </td>
                                      <td class="align-middle user-select-none">' . $row['residentname'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['purpose'] . '</td>
                                      <td class="align-middle user-select-none">
                                          <button type="button" class="btn btn-success mr-1" data-target="#approveModal' . $row['pid'] . '" data-toggle="modal">
                                            <i class="fas fa-thumbs-up" aria-hidden="true"></i>&nbsp Approve
                                          </button>
                                          <button type="button" class="btn btn-danger ml-1" data-target="#disapproveModal' . $row['pid'] . '" data-toggle="modal">
                                            <i class="fas fa-thumbs-down" aria-hidden="true"></i>&nbsp Disapprove
                                          </button>
                                      </td>
                                  </tr>
                                ';
                                  include "modal/approve.mod.php";
                                  include "modal/disapprove.mod.php";
                                } ?>
                              </tbody>
                              <?php include "function.php" ?>
                            </table>
                          </div>
                          <!-- approved -->
                          <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-cstm-tab">
                            <table id="tblclearance1" class="table table-bordered table-striped table-hover">
                              <thead>
                                <tr>
                                  <?php
                                  if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) {
                                    ?>
                                    <th class="align-middle" style="width: 0px !important">
                                      <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                        <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                          id="cstm-chckbx-1" onchange="checkMain(this)">
                                        <label for="cstm-chckbx-1" class="custom-control-label custom-label"></label>
                                      </div>
                                    </th>
                                    <?php
                                  } ?>
                                  <th class="align-middle user-select-none">Clearance #</th>
                                  <th class="align-middle user-select-none">Resident Name</th>
                                  <th class="align-middle user-select-none">Findings</th>
                                  <th class="align-middle user-select-none">Purpose</th>
                                  <th class="align-middle user-select-none">OR Number</th>
                                  <th class="align-middle user-select-none">Amount</th>
                                  <th class="align-middle user-select-none" width="212px">Option</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) {
                                  $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'approved'") or die('Error: ' . mysqli_error($con));
                                  while ($row = mysqli_fetch_array($squery)) {
                                    $checkboxId = 'cstm-chckbx-' . $row['pid'];
                                    echo '
                                        <tr>
                                            <td class="align-middle user-select-none" style="width: 0px !important">
                                              <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                                <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input" id="' . $checkboxId . '" value="' . $row['pid'] . '">
                                                <label for="' . $checkboxId . '" class="custom-control-label"></label>
                                              </div>
                                            </td>
                                            <td class="align-middle user-select-none">' . $row['clearanceNo'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['residentname'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['findings'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['purpose'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['orNo'] . '</td>
                                            <td class="align-middle user-select-none">₱ ' . number_format($row['samount'], 2) . '</td>
                                            <td class="align-middle user-select-none">
                                              <button type="button" class="btn btn-success ml-1" data-target="#editModal' . $row['pid'] . '" data-toggle="modal">
                                                <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                              </button>
                                              <a target="_blank" href="form.php?resident=' . $row['residentid'] . '&clearance=' . $row['clearanceNo'] . '&val=' . base64_encode($row['clearanceNo'] . '|' . $row['residentname'] . '|' . $row['dateRecorded']) . '"" class="btn btn-primary ml-1">
                                                <i class="fas fa-download" aria-hidden="true"></i>&nbsp Generate
                                              </a>
                                            </td>
                                        </tr>
                                      ';
                                    include "modal/edit.mod.php";
                                  }
                                } else {
                                  $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'approved'") or die('Error: ' . mysqli_error($con));
                                  while ($row = mysqli_fetch_array($squery)) {
                                    echo '
                                        <tr>
                                            <td class="align-middle user-select-none">' . $row['clearanceNo'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['residentname'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['findings'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['purpose'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['orNo'] . '</td>
                                            <td class="align-middle user-select-none">₱ ' . number_format($row['samount'], 2) . '</td>
                                            <td class="align-middle user-select-none">
                                              <button type="button" class="btn btn-success ml-1" data-target="#editModal' . $row['pid'] . '" data-toggle="modal">
                                                <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                              </button>
                                              <a target="_blank" href="form.php?resident=' . $row['residentid'] . '&clearance=' . $row['clearanceNo'] . '&val=' . base64_encode($row['clearanceNo'] . '|' . $row['residentname'] . '|' . $row['dateRecorded']) . '"" class="btn btn-primary ml-1">
                                                <i class="fas fa-download" aria-hidden="true"></i>&nbsp Generate
                                              </a>
                                            </td>
                                        </tr>
                                      ';
                                    include "modal/edit.mod.php";
                                  }
                                } ?>
                              </tbody>
                            </table>
                          </div>
                          <!-- disapproved -->
                          <div class="tab-pane fade" id="disapproved" role="tabpanel"
                            aria-labelledby="disapproved-cstm-tab">
                            <table id="tblclearance2" class="table table-bordered table-striped table-hover">
                              <thead>
                                <?php
                                if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) {
                                  ?>
                                  <th class="align-middle" style="width: 0px !important">
                                    <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                      <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                        id="cstm-chckbx-3" onchange="checkMain(this)">
                                      <label for="cstm-chckbx-3" class="custom-control-label custom-label"></label>
                                    </div>
                                  </th>
                                  <?php
                                } ?>
                                <th>Resident Name</th>
                                <th>Findings</th>
                                <th>Purpose</th>
                              </thead>
                              <tbody>
                                <?php
                                if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) {
                                  $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid where status = 'disapproved' ") or die('Error: ' . mysqli_error($con));
                                  while ($row = mysqli_fetch_array($squery)) {
                                    $checkboxId = 'cstm-chckbx-' . $row['pid'];
                                    echo '
                                        <tr>
                                            <td class="align-middle user-select-none" style="width: 0px !important">
                                              <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                                <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input" id="' . $checkboxId . '" value="' . $row['pid'] . '">
                                                <label for="' . $checkboxId . '" class="custom-control-label"></label>
                                              </div>
                                            </td>
                                            <td class="align-middle user-select-none">' . $row['residentname'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['findings'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['purpose'] . '</td>
                                        </tr>
                                      ';
                                    include "modal/edit.mod.php";
                                  }
                                } else {
                                  $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid where status = 'disapproved' ") or die('Error: ' . mysqli_error($con));
                                  while ($row = mysqli_fetch_array($squery)) {
                                    echo '
                                        <tr>
                                            <td class="align-middle user-select-none">' . $row['residentname'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['findings'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['purpose'] . '</td>
                                        </tr>
                                      ';
                                    include "modal/edit.mod.php";
                                  }
                                } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <?php include "../../include/modal/delete.modal.inc.php" ?>
                      </form>
                    </div>
                    <!-- /.card -->
                  </div>
                  <?php include "../../include/session/notification/edit.session.inc.php" ?> <!-- edit -->
                  <?php include "../../include/session/notification/added.session.inc.php" ?> <!-- added -->
                  <?php include "../../include/session/notification/delete.session.inc.php" ?> <!-- delete -->
                  <?php include "../../include/session/notification/duplicate.session.inc.php" ?> <!-- duplicate -->
                  <?php include "modal/add.mod.php" ?>
                  <?php include "function.php" ?>
                </div>
                <!-- /. col-12 -->
                <?php
              } elseif ((isset($_SESSION['role']) && $_SESSION['role'] === "captain") || (!isset($_SESSION['role']) && $_SESSION['role'] !== "administrator") && (!isset($_SESSION['role']) && $_SESSION['role'] !== "staff") && (!isset($_SESSION['role']) && $_SESSION['role'] !== "resident")) {
                ?>
                <div class="col-12 col-sm-12">
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post">
                        <table id="tblclearance" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th class="align-middle user-select-none">Resident Name</th>
                              <th class="align-middle user-select-none">Purpose</th>
                              <th class="align-middle user-select-none">Option</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'new'") or die('Error: ' . mysqli_error($con));
                            while ($row = mysqli_fetch_array($squery)) {
                              echo '
                                  <tr>
                                      <td class="align-middle user-select-none">' . $row['residentname'] . '</td>
                                      <td class="align-middle user-select-none">' . $row['purpose'] . '</td>
                                      <td class="align-middle user-select-none">
                                          <button type="button" class="btn btn-success mr-1" data-target="#approveModal' . $row['pid'] . '" data-toggle="modal">
                                            <i class="fas fa-thumbs-up" aria-hidden="true"></i>&nbsp Approve
                                          </button>
                                          <button type="button" class="btn btn-danger ml-1" data-target="#disapproveModal' . $row['pid'] . '" data-toggle="modal">
                                            <i class="fas fa-thumbs-down" aria-hidden="true"></i>&nbsp Disapprove
                                          </button>
                                      </td>
                                  </tr>
                                ';
                              include "modal/approve.mod.php";
                              include "modal/disapprove.mod.php";
                            } ?>
                          </tbody>
                        </table>
                      </form>
                    </div>
                    <!-- /.card -->
                  </div>
                  <?php include "function.php" ?>
                </div>
                <!-- /. col-12 -->
                <?php
              } elseif ((isset($_SESSION['role']) && $_SESSION['role'] === "resident") || (!isset($_SESSION['role']) && $_SESSION['role'] !== "administrator") && (!isset($_SESSION['role']) && $_SESSION['role'] !== "staff") && (!isset($_SESSION['role']) && $_SESSION['role'] !== "captain")) {
                ?>
                <div class="col-12 col-sm-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#reqModal"><i
                          class="fa fa-user-plus" aria-hidden="true"></i>
                        &nbsp; Request Clearance</button>
                      <?php if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) { ?>
                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal"><i
                            class="fas fa-trash-alt" aria-hidden="true"></i>
                          &nbsp; Delete Clearance</button>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <!-- new -->
                        <li class="nav-item">
                          <a class="nav-link active" id="new-cstm-tab" data-target="#new" data-toggle="pill" href="#new"
                            role="tab" aria-controls="new-cstm-tab" aria-selected="true">New</a>
                        </li>
                        <!-- approved -->
                        <li class="nav-item">
                          <a class="nav-link" id="approved-cstm-tab" data-target="#approved" data-toggle="pill"
                            href="#approved" role="tab" aria-controls="approved-cstm-tab"
                            aria-selected="false">Approrved</a>
                        </li>
                        <!-- disapproved -->
                        <li class="nav-item">
                          <a class="nav-link" id="disapproved-cstm-tab" data-target="#disapproved" data-toggle="pill"
                            href="#disapproved" role="tab" aria-controls="disapproved-cstm-tab"
                            aria-selected="false">Disapprove</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body table-responsive">
                      <form method="post">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                          <!-- new -->
                          <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-cstm-tab">
                            <table id="tblclearance" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th class="align-middle user-select-none">Purpose</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $squery = mysqli_query($con, "SELECT * FROM tblclearance p left join tblresident r on r.id = p.residentid where r.id = " . $_SESSION['userid'] . " and status = 'new' ") or die('Error: ' . mysqli_error($con));
                                if (mysqli_num_rows($squery) > 0) {
                                  while ($row = mysqli_fetch_array($squery)) {
                                    echo '
                                        <tr>
                                            <td class="align-middle user-select-none">' . $row['purpose'] . '</td>
                                        </tr>
                                      ';
                                  }
                                } ?>
                              </tbody>
                            </table>
                          </div>
                          <!-- approved -->
                          <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-cstm-tab">
                            <table id="tblclearance1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <?php
                                  if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff") && !(isset($_SESSION['role']) && $_SESSION['role'] == "captain") || !(isset($_SESSION['role']) && $_SESSION['role'] == "resident")) {
                                    ?>
                                    <th class="align-middle" style="width: 0px !important">
                                      <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                        <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                          id="cstm-chckbx-1" onchange="checkMain(this)">
                                        <label for="cstm-chckbx-1" class="custom-control-label custom-label"></label>
                                      </div>
                                    </th>
                                    <?php
                                  } ?>
                                  <th class="align-middle user-select-none">Clearance #</th>
                                  <th class="align-middle user-select-none">Findings</th>
                                  <th class="align-middle user-select-none">Purpose</th>
                                  <th class="align-middle user-select-none">OR Number</th>
                                  <th class="align-middle user-select-none">Amount</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $squery = mysqli_query($con, "SELECT * FROM tblclearance p left join tblresident r on r.id = p.residentid where r.id = " . $_SESSION['userid'] . " and status = 'approved' ") or die('Error: ' . mysqli_error($con));
                                if (mysqli_num_rows($squery) > 0) {
                                  while ($row = mysqli_fetch_array($squery)) {
                                    echo '
                                        <tr>
                                            <td class="align-middle user-select-none">' . $row['clearanceNo'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['findings'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['purpose'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['orNo'] . '</td>
                                            <td class="align-middle user-select-none">₱ ' . number_format($row['samount'], 2) . '</td>
                                        </tr>
                                      ';
                                  }
                                } ?>
                              </tbody>
                            </table>
                          </div>
                          <!-- disapproved -->
                          <div class="tab-pane fade" id="disapproved" role="tabpanel"
                            aria-labelledby="disapproved-cstm-tab">
                            <table id="tblclearance2" class="table table-bordered table-striped">
                              <thead>
                                <?php
                                if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff") && !(isset($_SESSION['role']) && $_SESSION['role'] == "captain") || !(isset($_SESSION['role']) && $_SESSION['role'] == "resident")) {
                                  ?>
                                  <th class="align-middle" style="width: 0px !important">
                                    <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                      <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                        id="cstm-chckbx-3" onchange="checkMain(this)">
                                      <label for="cstm-chckbx-3" class="custom-control-label custom-label"></label>
                                    </div>
                                  </th>
                                  <?php
                                } ?>
                                <th class="align-middle user-select-none">Findings</th>
                                <th class="align-middle user-select-none">Purpose</th>
                              </thead>
                              <tbody>
                                <?php
                                $squery = mysqli_query($con, "SELECT * FROM tblclearance p left join tblresident r on r.id = p.residentid where r.id = " . $_SESSION['userid'] . " and status = 'disapproved' ") or die('Error: ' . mysqli_error($con));
                                if (mysqli_num_rows($squery) > 0) {
                                  while ($row = mysqli_fetch_array($squery)) {
                                    echo '
                                        <tr>
                                            <td class="align-middle user-select-none">' . $row['findings'] . '</td>
                                            <td class="align-middle user-select-none">' . $row['purpose'] . '</td>
                                        </tr>
                                      ';
                                  }
                                } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.card -->
                  </div>
                  <?php
                  include "../../include/session/notification/duplicate.session.inc.php"; /* duplicate */
                  include "session/lengthofstay.session.php"; /* length of stay */
                  include "modal/request.mod.php";
                  include "function.php";
                  ?>
                </div>
                <!-- /. col-12 -->
                <?php
              } ?>
            </div>
          </div>
          <!-- /. container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
  <?php }
include "../../include/footer.inc.php" ?>
  <script type="text/javascript">
    <?php
    if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
      ?>
      $(function () {
        $("#tblclearance").DataTable({
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
            { "bSortable": false, "aTargets": [0, 3] },
            { "orderable": false, "targets": 0 }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance_wrapper .col-md-6:eq(0)')
        $("#tblclearance1").DataTable({
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
            { "bSortable": false, "aTargets": [0, 7] },
            { "orderable": false, "targets": 0 }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance1_wrapper .col-md-6:eq(0)')
        $("#tblclearance2").DataTable({
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
            { "bSortable": false, "aTargets": [0] },
            { "orderable": false, "targets": 0 }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance2_wrapper .col-md-6:eq(0)')
      });
      <?php
    } elseif ((isset($_SESSION['role']) && $_SESSION['role'] === "captain")) {
      ?>
      $(document).ready(function () {
        $("#tblclearance").DataTable({
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
            { "bSortable": false, "aTargets": [2] },
            { "orderable": false, "targets": [2] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance_wrapper .col-md-6:eq(0)')
      });
      <?php
    } elseif ((isset($_SESSION['role']) && $_SESSION['role'] === "resident")) {
      ?>
      $(function () {
        $("#tblclearance").DataTable({
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
            { "bSortable": true, "aTargets": [0] },
            { "orderable": true, "targets": [0] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance_wrapper .col-md-6:eq(0)')
        $("#tblclearance1").DataTable({
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
            { "bSortable": true, "aTargets": [0, 4] },
            { "orderable": true, "targets": [0, 4] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance1_wrapper .col-md-6:eq(0)')
        $("#tblclearance2").DataTable({
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
            { "bSortable": true, "aTargets": [0, 1] },
            { "orderable": true, "targets": [0, 1] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance2_wrapper .col-md-6:eq(0)')
      });
      <?php
    } ?>
  </script>
</body>

</html>