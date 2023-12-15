<?php
if (isset($_POST['btn_saveeditProfile'])) {
  $username = $_POST['input_username'];
  $password = $_POST['input_password'];
  $confirm_password = $_POST['input_confirm_password'];

  // Check if password field is empty
  if (empty($password)) {
    echo '<script>alert("Password cannot be empty!");</script>';
  }  // Check if passwords match
  elseif ($password !== $confirm_password) {
    echo '<script>alert("Passwords do not match!");</script>';
  } else {
    // Use prepared statements to prevent SQL injection
    if ($_SESSION['role'] === "administrator") {
      $query = mysqli_prepare($con, "UPDATE tbluser SET password = ? WHERE id = ?");
      $user_check_query = mysqli_query($con, "SELECT username FROM tbluser WHERE id = '" . $_SESSION['userid'] . "'");
    } elseif ($_SESSION['role'] === "captain") {
      $query = mysqli_prepare($con, "UPDATE tblcaptain SET password = ? WHERE id = ?");
      $user_check_query = mysqli_query($con, "SELECT username FROM tblcaptain WHERE id = '" . $_SESSION['userid'] . "'");
    } elseif ($_SESSION['role'] === "staff") {
      $query = mysqli_prepare($con, "UPDATE tblstaff SET password = ? WHERE id = ?");
      $user_check_query = mysqli_query($con, "SELECT username FROM tblstaff WHERE id = '" . $_SESSION['userid'] . "'");
    } elseif ($_SESSION['role'] === "resident") {
      $query = mysqli_prepare($con, "UPDATE tblresident SET password = ? WHERE id = ?");
      $user_check_query = mysqli_query($con, "SELECT username FROM tblresident WHERE id = '" . $_SESSION['userid'] . "'");
    }

    // Check if the username is being modified
    $original_username = mysqli_fetch_assoc($user_check_query)['username'];

    if ($username === $original_username) {
      // Hash the new password only if the username is not being modified
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Bind parameters and execute the query
      mysqli_stmt_bind_param($query, 'si', $hashed_password, $_SESSION['userid']);
      mysqli_stmt_execute($query);

      if (mysqli_stmt_affected_rows($query) > 0) {
        // No error, redirect
        header("location: " . $_SERVER['REQUEST_URI']);
      }
    } else {
      // Display an error message if the username is being modified
      echo '<script>alert("Username modification not allowed!");</script>';
    }
  }
} ?>