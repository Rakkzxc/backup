<?php
include "../../include/profile.inc.php";

echo '
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark elevation-2" style="border: none !important">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="../../main/index.php" class="nav-link">Home</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments mr-1"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="margin: 10px 10px 0 0;   box-shadow: 0 40px 55px rgba(0,0,0,0.30), 0 0px 12px rgba(0,0,0,0.22);">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="../../assets/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Call me whenever you can...</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="../../assets/img/user2-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Nora Silvester
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">The subject goes here</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="../../assets/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                John Pierce
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">I got your message bro</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell mr-2"></i>
        <span class="badge badge-danger navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="margin: 10px 10px 0 0;   box-shadow: 0 40px 55px rgba(0,0,0,0.30), 0 0px 12px rgba(0,0,0,0.22);">
        <span class="d-block text-center text-light py-3">Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-bullhorn" style="margin: 0 10px 0 0;"></i> 4 announcements
          <span class="float-right text-muted text-sm">3 mins ago</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-scroll mr-2"></i> 8 certificate requests
          <span class="float-right text-muted text-sm">1 hour ago</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file-signature" style="margin: 0 10px 0 0;"></i> 3 blotter messages
          <span class="float-right text-muted text-sm">2 days ago</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    <!-- Full Screen Dropdown Menu -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <!-- Account Settings Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user-cog"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" style="margin: 10px 10px 0 0;   box-shadow: 0 40px 55px rgba(0,0,0,0.30), 0 0px 12px rgba(0,0,0,0.22);">

        <div class="col-md-12 pt-2 px-2">
          <!-- Widget: user widget style 1 -->
          <div class="card card-widget widget-user shadow-lg m-0">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header text-white"
              style="background: url(../../assets/img/user-bckgrnd.png) center center/cover;">
            </div>
            <div class="widget-user-image img-circle" style="background: rgb(132,208,247)">
              <img class="img-circle" ' . $zxcqwepoibnm . '  alt="User Avatar" style="width: 100px; height: 100px;">
            </div>
            <div class="card-footer p-0">
              <div class="row">
                <div class="col-sm-12">
                  <div class="description-block text-left m-0">
                    <span class="d-block text-center" style="margin: 55px 0 20px 0">You’ve logged in as <br /> ' .
  ucwords(strtolower($_SESSION['fname'])) . " " . ucwords(strtolower($_SESSION['lname'])) . '</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item py-3" data-toggle="modal" data-target="#editProfileModal">
                      <i class="fas fa-unlock-alt" style="margin: 0 9px 0 0;"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="../../logout.php" class="dropdown-item py-3">
                      <i class="fas fa-sign-out-alt" style="margin: 0 7.5px 0 0;"></i> Signout
                    </a>
                    <div class="dropdown-divider"></div>
                    <a target="_blank" href="https://www.facebook.com/jeffern.malinao.90" class="dropdown-item py-3">
                      <i class="fas fa-hand-holding-heart" style="margin: 0 6.275px 0 0;"></i> Follow me on social media
                    </a>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>

      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
'
  ?>

<?php include "../../include/chngpss.inc.php" ?>
<div class="modal fade" id="editProfileModal">
  <form action="" method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          if ($_SESSION['role'] == "administrator") {
            $user = mysqli_query($con, "SELECT * from tbluser where id = '" . $_SESSION['userid'] . "' ");
            while ($row = mysqli_fetch_array($user)) {
              $original_username = $row['username'];
              echo '
                      <div class="form-group">
                        <label for="input_username">Username</label>
                        <input type="text" name="input_username" class="form-control" id="input_username"
                        value="' . $row['username'] . '">
                      </div>
                      <div class="form-group">
                        <label for="input_password">New Password</label>
                        <input type="password" name="input_password" class="form-control" id="input_password">
                      </div>
                      <div class="form-group">
                        <label for="input_confirm_password">Confirm Password</label>
                        <input type="password" name="input_confirm_password" class="form-control" id="input_confirm_password">
                      </div>
                    ';
            }
          } elseif ($_SESSION['role'] == "captain") {
            $user = mysqli_query($con, "SELECT * from tblcaptain where id = '" . $_SESSION['userid'] . "' ");
            while ($row = mysqli_fetch_array($user)) {
              $original_username = $row['username'];
              echo '
                      <div class="form-group">
                        <label for="input_username">Username</label>
                        <input type="text" name="input_username" class="form-control" id="input_username"
                        value="' . $row['username'] . '">
                      </div>
                      <div class="form-group">
                        <label for="input_password">New Password</label>
                        <input type="password" name="input_password" class="form-control" id="input_password">
                      </div>
                      <div class="form-group">
                        <label for="input_confirm_password">Confirm Password</label>
                        <input type="password" name="input_confirm_password" class="form-control" id="input_confirm_password">
                      </div>
                    ';
            }
          } elseif ($_SESSION['role'] == "staff") {
            $user = mysqli_query($con, "SELECT * from tblstaff where id = '" . $_SESSION['userid'] . "' ");
            while ($row = mysqli_fetch_array($user)) {
              $original_username = $row['username'];
              echo '
                      <div class="form-group">
                        <label for="input_username">Username</label>
                        <input type="text" name="input_username" class="form-control" id="input_username"
                        value="' . $row['username'] . '">
                      </div>
                      <div class="form-group">
                        <label for="input_password">New Password</label>
                        <input type="password" name="input_password" class="form-control" id="input_password">
                      </div>
                      <div class="form-group">
                        <label for="input_confirm_password">Confirm Password</label>
                        <input type="password" name="input_confirm_password" class="form-control" id="input_confirm_password">
                      </div>
                    ';
            }
          } elseif ($_SESSION['role'] == "resident") {
            $user = mysqli_query($con, "SELECT * from tblresident where id = '" . $_SESSION['userid'] . "' ");
            while ($row = mysqli_fetch_array($user)) {
              $original_username = $row['username'];
              echo '
                      <div class="form-group">
                        <label for="input_username">Username</label>
                        <input type="text" name="input_username" class="form-control" id="input_username"
                        value="' . $row['username'] . '">
                      </div>
                      <div class="form-group">
                        <label for="input_password">New Password</label>
                        <input type="password" name="input_password" class="form-control" id="input_password">
                      </div>
                      <div class="form-group">
                        <label for="input_confirm_password">Confirm Password</label>
                        <input type="password" name="input_confirm_password" class="form-control" id="input_confirm_password">
                      </div>
                    ';
            }
          } ?>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default px-3" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary px-3" id="btn_saveeditProfile" name="btn_saveeditProfile">Save
            changes</button>
        </div>
      </div>
    </div>
  </form>
</div>