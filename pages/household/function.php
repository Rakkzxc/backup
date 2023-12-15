<?php
if (isset($_POST['btn_add'])) {
  $txt_householdno = $_POST['txt_householdno'];
  $txt_purok = $_POST['txt_purok'];
  $txt_totalmembers = isset($_POST['txt_totalmembers']) ? $_POST['txt_totalmembers'] : '';
  $txt_hof = $_POST['txt_hof'];

  // Create a prepared statement
  $chkdup = mysqli_prepare($con, "SELECT * FROM tblhousehold WHERE householdno = ?");
  mysqli_stmt_bind_param($chkdup, "s", $txt_householdno);
  mysqli_stmt_execute($chkdup);
  $result = mysqli_stmt_get_result($chkdup);
  $num_rows = mysqli_num_rows($result);

  if (isset($_SESSION['role'])) {
    $action = 'added household number ' . $txt_householdno;
    $iquery = mysqli_query($con, "INSERT INTO tbllogs (user,logdate,action) values ('" . $_SESSION['role'] . "', NOW(), '" . $action . "')");
  }

  if ($num_rows == 0) {
    // Use prepared statements for inserting data
    $query = mysqli_prepare($con, "INSERT INTO tblhousehold (householdno, purok, totalhouseholdmembers, headoffamily) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, "ssss", $txt_householdno, $txt_purok, $txt_totalmembers, $txt_hof);

    // Check if the query was executed successfully
    if (mysqli_stmt_execute($query)) {
      $_SESSION['added'] = 1;
      header("location: " . $_SERVER['REQUEST_URI']);
    } else {
      echo "Error: " . mysqli_error($con); // You can log the error or handle it appropriately
    }
  } else {
    $_SESSION['duplicate'] = 1;
    header("location: " . $_SERVER['REQUEST_URI']);
  }
}

if (isset($_POST['btn_save'])) {
  $txt_id = $_POST['hidden_id'];
  $hiddennum = $_POST['hiddennum'];
  $txt_edit_purok = $_POST['txt_edit_purok'];

  $update_query = mysqli_query($con, "UPDATE tblhousehold set purok ='" . $txt_edit_purok . "' where id = '" . $txt_id . "' ") or die('Error: ' . mysqli_error($con));

  if (isset($_SESSION['role'])) {
    $action = 'update household number ' . $hiddennum;
    $iquery = mysqli_query($con, "INSERT INTO tbllogs (user,logdate,action) values ('" . $_SESSION['role'] . "', NOW(), '" . $action . "')");
  }

  if ($update_query == true) {
    $_SESSION['edited'] = 1;
    header("location: " . $_SERVER['REQUEST_URI']);
  }
}

if (isset($_POST['btn_delete'])) {
  if (isset($_POST['chk_delete'])) {
    foreach ($_POST['chk_delete'] as $value) {
      $delete_query = mysqli_query($con, "DELETE from tblhousehold where id = '$value' ") or die('Error: ' . mysqli_error($con));

      if ($delete_query == true) {
        $_SESSION['delete'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
      }
    }
  }
} ?>