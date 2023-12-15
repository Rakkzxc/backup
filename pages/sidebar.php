<?php
include "../../include/profile.inc.php";
include "../../include/username.inc.php";
include "../../include/state.inc.php";

if (!isset($_SESSION)) {
  session_start();
}

echo '
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-3">
  <!-- Brand Logo -->
  <a href="#" class="d-flex align-items-center justify-content-center py-3" style="border-bottom: 1px solid #4f5962">
      <img src="../../assets/img/brgy-logo.png" class="img-fluid" alt="AdminLTE Logo">
  </a>

  <style>
  .os-theme-dark>.os-scrollbar-horizontal,
  .os-theme-light>.os-scrollbar-horizontal {
    display: none }

  .layout-navbar-fixed.layout-fixed .wrapper .sidebar {
    margin-top: calc(0rem + 1px) }

  .layout-navbar-fixed.layout-fixed .wrapper .sidebar {
    margin-top: calc(0rem + 1px) }

  .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand):hover .sidebar .user-panel {
    justify-content: flex-start !important }

  .sidebar-mini.sidebar-collapse .sidebar .user-panel {
    justify-content: center !important }

  .sidebar-mini.sidebar-collapse .sidebar .user-panel .info {
    display: none }

  @supports not (-webkit-touch-callout:none) {
    .layout-fixed .wrapper .sidebar {
      height: calc(100vh - (11.375rem + 1px)) }
  }
</style>
  
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center justify-content-start">
      <div class="widget-user-image img-circle d-flex align-items-center" style="background: rgb(132,208,247)">
        <img class="img-circle" ' . $zxcqwepoibnm . '  alt="User Avatar" style="width: 40px; height: 40px;">
      </div>
      <div class="info">
      <style> a p { margin: 0 } </style>
        <a href="../../main/index.php" class="d-block">' . $userMessage . '</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="my-3">
    ';
if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrator') {
  echo '
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="../dashboard/dashboard.php" class="nav-link ' . ($page == "dashboard.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-th-large"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

        <li class="nav-item">
            <a href="../officials/officials.php" class="nav-link ' . ($page == "officials.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Officials
              </p>
            </a>
          </li>

        <li class="nav-item ' . (($page == "household.php" || $page == "resident.php") ? 'menu-open' : '') . '">
          <a href="#" class="nav-link ' . (($page == "household.php" || $page == "resident.php") ? 'active' : '') . '">
            <i class="nav-icon fas fa-scroll"></i>
            <p>
              Profiling
              <i class="fas fa-angle-right right"></i>
              <span class="badge badge-success right">2</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../household/household.php" class="nav-link ' . ($page == "household.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Household</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../resident/resident.php" class="nav-link ' . ($page == "resident.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Resident</p>
                </a>
              </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="../blotter/blotter.php" class="nav-link ' . ($page == "blotter.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                Blotter
              </p>
            </a>
          </li>

        <li class="nav-item ' . (($page == "clearance.php" || $page == "permit.php" || $page == "lowincome.php") ? 'menu-open' : '') . '">
          <a href="#" class="nav-link ' . (($page == "clearance.php" || $page == "permit.php" || $page == "lowincome.php") ? 'active' : '') . '">
            <i class="nav-icon fas fa-scroll"></i>
            <p>
              Certificates
              <i class="fas fa-angle-right right"></i>
              <span class="badge badge-info right">3</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../clearance/clearance.php" class="nav-link ' . ($page == "clearance.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Clearance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../permit/permit.php" class="nav-link ' . ($page == "permit.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Permit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../lowincome/lowincome.php" class="nav-link ' . ($page == "lowincome.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Low Income</p>
                </a>
              </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="../announcement/announcement.php" class="nav-link ' . ($page == "announcement.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcement
              </p>
            </a>
          </li>

          <li class="nav-item ' . (($page == "staff.php" || $page == "captain.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "staff.php" || $page == "captain.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-danger right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../captain/captain.php" class="nav-link ' . ($page == "captain.php" ? 'active' : '') . '">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Captain</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../staff/staff.php" class="nav-link ' . ($page == "staff.php" ? 'active' : '') . '">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Staff</p>
                  </a>
                </li>
              </ul>
          </li>

        <li class="nav-item">
            <a href="../report/report.php" class="nav-link ' . ($page == "report.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                Report
              </p>
            </a>
          </li>

        <li class="nav-item">
            <a href="../logs/logs.php" class="nav-link ' . ($page == "logs.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Logs
              </p>
            </a>
          </li>

        <li class="nav-item">
            <a href="../backup/backup.php" class="nav-link ' . ($page == "backup.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Backup
              </p>
            </a>
          </li>

      </ul>
      ';
} elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'captain') {
  echo '
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->

            <li class="nav-item ' . (($page == "clearance.php" || $page == "permit.php" || $page == "lowincome.php") ? 'menu-open' : '') . '">
              <a href="#" class="nav-link ' . (($page == "clearance.php" || $page == "permit.php" || $page == "lowincome.php") ? 'active' : '') . '">
                <i class="nav-icon fas fa-scroll"></i>
                <p>
                  Certificates
                  <i class="fas fa-angle-right right"></i>
                  <span class="badge badge-info right">3</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../clearance/clearance.php" class="nav-link ' . ($page == "clearance.php" ? 'active' : '') . '">
                      <i class="fas fa-angle-right nav-icon"></i>
                      <p>Clearance</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../permit/permit.php" class="nav-link ' . ($page == "permit.php" ? 'active' : '') . '">
                      <i class="fas fa-angle-right nav-icon"></i>
                      <p>Permit</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../lowincome/lowincome.php" class="nav-link ' . ($page == "lowincome.php" ? 'active' : '') . '">
                      <i class="fas fa-angle-right nav-icon"></i>
                      <p>Low Income</p>
                    </a>
                  </li>
                </ul>
            </li>

            <li class="nav-item">
              <a href="../announcement/announcement.php" class="nav-link ' . ($page == "announcement.php" ? 'active' : '') . '">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                  Announcement
                </p>
              </a>
            </li>
      </ul>
      ';
} elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'staff') {
  echo '
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->

          <li class="nav-item">
              <a href="../officials/officials.php" class="nav-link ' . ($page == "officials.php" ? 'active' : '') . '">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                  Officials
                </p>
              </a>
            </li>

          <li class="nav-item ' . (($page == "household.php" || $page == "resident.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "household.php" || $page == "resident.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Profiling
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-success right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../household/household.php" class="nav-link ' . ($page == "household.php" ? 'active' : '') . '">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Household</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../resident/resident.php" class="nav-link ' . ($page == "resident.php" ? 'active' : '') . '">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Resident</p>
                  </a>
                </li>
              </ul>
          </li>
  
          <li class="nav-item">
              <a href="../captain/captain.php" class="nav-link ' . ($page == "captain.php" ? 'active' : '') . '">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                  Captain
                </p>
              </a>
            </li>
  
          <li class="nav-item ' . (($page == "clearance.php" || $page == "permit.php" || $page == "lowincome.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "clearance.php" || $page == "permit.php" || $page == "lowincome.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Certificates
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-info right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../clearance/clearance.php" class="nav-link ' . ($page == "clearance.php" ? 'active' : '') . '">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Clearance</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../permit/permit.php" class="nav-link ' . ($page == "permit.php" ? 'active' : '') . '">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Permit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../lowincome/lowincome.php" class="nav-link ' . ($page == "lowincome.php" ? 'active' : '') . '">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Low Income</p>
                  </a>
                </li>
              </ul>
          </li>
  
          <li class="nav-item">
              <a href="../blotter/blotter.php" class="nav-link ' . ($page == "blotter.php" ? 'active' : '') . '">
                <i class="nav-icon fas fa-file-signature"></i>
                <p>
                  Blotter
                </p>
              </a>
            </li>
  
          <li class="nav-item">
              <a href="../announcement/announcement.php" class="nav-link ' . ($page == "announcement.php" ? 'active' : '') . '">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                  Announcement
                </p>
              </a>
            </li>

      </ul>
      ';
} elseif (isset($_SESSION['resident']) && $_SESSION['resident'] === 1) {
  echo '
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->

          <li class="nav-item ' . (($page == "clearance.php" || $page == "permit.php" || $page == "lowincome.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "clearance.php" || $page == "permit.php" || $page == "lowincome.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Certificates
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-info right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../clearance/clearance.php" class="nav-link ' . ($page == "clearance.php" ? 'active' : '') . '">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Clearance</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../permit/permit.php" class="nav-link ' . ($page == "permit.php" ? 'active' : '') . '">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Permit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../lowincome/lowincome.php" class="nav-link ' . ($page == "lowincome.php" ? 'active' : '') . '">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Low Income</p>
                  </a>
                </li>
              </ul>
          </li>

          <li class="nav-item">
              <a href="../announcement/announcement.php" class="nav-link ' . ($page == "announcement.php" ? 'active' : '') . '">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                  Announcement
                </p>
              </a>
            </li>

      </ul>
      ';
}
echo '
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
'
  ?>