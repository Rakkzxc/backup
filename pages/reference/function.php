<?php
if (isset($_POST['btn_add'])) {
  $input_ref_name = $_POST['input_ref_name'];
  $input_created = $date = date('Y-m-d H:i:s');
  $input_added_by = $_SESSION['fname'] . ' ' . $_SESSION['lname'];

  if (isset($_SESSION['role'])) {
    $action = 'added reference named ' . $input_ref_name;
    $iquery = mysqli_prepare($con, "INSERT INTO tbllogs (user, logdate, action) VALUES (?, NOW(), ?)");
    mysqli_stmt_bind_param($iquery, 'ss', $_SESSION['role'], $action);
    mysqli_stmt_execute($iquery);
  }

  $stmt = mysqli_prepare($con, "SELECT * FROM tbladdreference WHERE ref_name = ?");
  mysqli_stmt_bind_param($stmt, 's', $input_ref_name);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $ct = mysqli_stmt_num_rows($stmt);

  if ($ct == 0) {
    $query = mysqli_prepare($con, "INSERT INTO tbladdreference (ref_name, created, added_by) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($query, 'sss', $input_ref_name, $input_created, $input_added_by);
    mysqli_stmt_execute($query);

    if (mysqli_stmt_affected_rows($query) > 0) {
      $_SESSION['added'] = 1;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit;
    }
  } else {
    $_SESSION['duplicateuser'] = 1;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit;
  }
}

if (isset($_POST['btn_save'])) {
  $input_id = $_POST['hidden_id'];
  $input_edit_fname = $_POST['input_edit_fname'];
  $input_edit_lname = $_POST['input_edit_lname'];
  $input_edit_uname = $_POST['input_edit_uname'];
  $input_edit_pass = $_POST['input_edit_pass'];

  // Hash the password using PASSWORD_DEFAULT
  $edit_hashed_password = password_hash($input_edit_pass, PASSWORD_DEFAULT);

  if (isset($_SESSION['role'])) {
    $action = 'update staff named ' . $input_edit_fname . ' ' . $input_edit_lname;
    $iquery = mysqli_prepare($con, "INSERT INTO tbllogs (user, logdate, action) VALUES (?, NOW(), ?)");
    mysqli_stmt_bind_param($iquery, 'ss', $_SESSION['role'], $action);
    mysqli_stmt_execute($iquery);
  }

  // Check if the username already exists, excluding the current record being edited
  $stmt = mysqli_prepare($con, "SELECT * FROM tblstaff WHERE username = ? AND id <> ?");
  mysqli_stmt_bind_param($stmt, 'si', $input_edit_uname, $input_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $ct = mysqli_stmt_num_rows($stmt);

  if ($ct == 0) {
    $stmt = mysqli_prepare($con, "UPDATE tblstaff SET fname = ?, lname = ?, username = ?, password = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'ssssi', $input_edit_fname, $input_edit_lname, $input_edit_uname, $edit_hashed_password, $input_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
      $_SESSION['edited'] = 1;
      header("location: " . $_SERVER['REQUEST_URI']);
    }
  } else {
    $_SESSION['duplicateuser'] = 1;
    header("location: " . $_SERVER['REQUEST_URI']);
  }
}

if (isset($_POST['btn_delete'])) {
  if (isset($_POST['chk_delete'])) {
    foreach ($_POST['chk_delete'] as $value) {
      $delete_query = mysqli_query($con, "DELETE FROM tbladdreference WHERE id = '$value' ") or die('Error: ' . mysqli_error($con));

      if ($delete_query == true) {
        $_SESSION['delete'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
      }
    }
  }
} ?>