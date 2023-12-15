<?php
include "pages/connection.php";
include "include/session.inc.php";
include "include/session/login.session.inc.php";

// Logging code
$log_username = isset($_POST['input_username']) ? ucwords(strtolower($_POST['input_username'])) : "username";
$log_role = isset($_POST['user_role']) ? ucwords(strtolower($_POST['user_role'])) : "role";

if (isset($_POST['btn_login'])) {
  $username = $_POST['input_username'];
  $password = $_POST['input_password'];
  $user_role = isset($_POST['user_role']) ? $_POST['user_role'] : '';

  // Simple form validation
  if (empty($username) || empty($password)) {
    echo '<script type="text/javascript">alert("Please fill out both username and password fields");</script>';
  } else {
    switch ($user_role) {
      case 'administrator':
        $stmt = mysqli_prepare($con, "SELECT id, fname, lname, username, password, image FROM tbluser WHERE username = ? AND type = 'administrator'");
        break;
      case 'captain':
        $stmt = mysqli_prepare($con, "SELECT id, fname, lname, username, password, image FROM tblcaptain WHERE username = ?");
        break;
      case 'staff':
        $stmt = mysqli_prepare($con, "SELECT id, fname, lname, username, password, image FROM tblstaff WHERE username = ?");
        break;
      case 'resident':
        $stmt = mysqli_prepare($con, "SELECT id, fname, lname, username, password, image FROM tblresident WHERE username = ?");
        break;
      default:
        // Handle invalid role, username, password
        $log_message = "$log_username please sign in with your identity";
        echo '<script type="text/javascript">alert("' . $log_message . '");</script>';
        break;
    }

    if (isset($stmt)) {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $numrow = mysqli_stmt_num_rows($stmt);

      if ($numrow > 0) {
        mysqli_stmt_bind_result($stmt, $user_id, $user_fname, $user_lname, $user_username, $hashed_password, $user_avatar);
        mysqli_stmt_fetch($stmt);

        // Verify the hashed password
        if (password_verify($password, $hashed_password)) {
          $_SESSION['userid'] = $user_id;
          $_SESSION['fname'] = $user_fname;
          $_SESSION['lname'] = $user_lname;
          $_SESSION['profile'] = $user_avatar;

          // Set role based on the selected option
          switch ($user_role) {
            case 'administrator':
              $_SESSION['role'] = "administrator";
              header('location: pages/dashboard/dashboard.php');
              break;
            case 'captain':
              $_SESSION['role'] = "captain";
              $_SESSION['name'] = $user_username;
              header('location: pages/clearance/clearance.php');
              break;
            case 'staff':
              $_SESSION['role'] = "staff";
              $_SESSION['username'] = $user_username;
              header('location: pages/resident/resident.php');
              break;
            case 'resident':
              $_SESSION['role'] = "resident";
              $_SESSION['resident'] = 1;
              $_SESSION['username'] = $user_username;
              header('location: pages/clearance/clearance.php');
              break;
          }
        } else {
          echo '<script type="text/javascript">alert("Invalid username or password");</script>';
        }
      } else {
        echo '<script type="text/javascript">alert("Invalid username or password");</script>';
      }
      mysqli_stmt_close($stmt);
    }
  }
} ?>