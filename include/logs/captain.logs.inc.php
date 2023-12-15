<?php
include "../../pages/connection.php";
include "../../include/session.inc.php";
include "../../include/session/purok.session.inc.php";

if (isset($_POST['btn_login'])) {
  $username = mysqli_real_escape_string($con, $_POST['input_username']);
  $password = mysqli_real_escape_string($con, $_POST['input_password']);

  $stmt = mysqli_prepare($con, "SELECT id, fname, lname, image, username FROM tblcaptain WHERE username = ? AND password = ?");
  mysqli_stmt_bind_param($stmt, "ss", $username, $password);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $numrow_user = mysqli_stmt_num_rows($stmt);

  if ($numrow_user > 0) {
    mysqli_stmt_bind_result($stmt, $user_id, $user_fname, $user_lname, $user_image, $user_username);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $_SESSION['role'] = "captain";
    $_SESSION['userid'] = $user_id;
    $_SESSION['fname'] = $user_fname;
    $_SESSION['lname'] = $user_lname;
    $_SESSION['profile'] = $user_image;
    $_SESSION['name'] = $user_username;

    header('location: ../permit/permit.php');
  } else {
    echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Invalid Account";</script>';
  }
} ?>