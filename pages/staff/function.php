<?php
if(isset($_POST['btn_add'])) {
  $input_fname = $_POST['input_fname'];
  $input_lname = $_POST['input_lname'];
  $input_uname = $_POST['input_uname'];
  $input_pass = $_POST['input_pass'];

  $name = basename($_FILES['input_image']['name']);
  $temp = $_FILES['input_image']['tmp_name'];
  $imagetype = $_FILES['input_image']['type'];
  $size = $_FILES['input_image']['size'];

  $milliseconds = round(microtime(true) * 1000);
  $image = $milliseconds.'_'.$name;

  // Hash the password using PASSWORD_DEFAULT
  $input_hashed_password = password_hash($input_pass, PASSWORD_DEFAULT);

  if(isset($_SESSION['role'])) {
    $action = 'added staff named '.$input_fname.' '.$input_lname;
    $iquery = mysqli_prepare($con, "INSERT INTO tbllogs (user, logdate, action) VALUES (?, NOW(), ?)");
    mysqli_stmt_bind_param($iquery, 'ss', $_SESSION['role'], $action);
    mysqli_stmt_execute($iquery);
  }

  $stmt = mysqli_prepare($con, "SELECT * FROM tblstaff WHERE username = ?");
  mysqli_stmt_bind_param($stmt, 's', $input_uname);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $ct = mysqli_stmt_num_rows($stmt);

  if($ct == 0) {
    if($name != "") {
      if(($imagetype == "image/jpeg" || $imagetype == "image/png" || $imagetype == "image/bmp") && $size <= 2048000) {
        if(move_uploaded_file($temp, 'image/'.$image)) {
          $input_image = $image;
        } else {
          $_SESSION['filesize'] = 1;
          header("location: ".$_SERVER['REQUEST_URI']);
          exit;
        }
      } else {
        $_SESSION['filesize'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
        exit;
      }
    } else {
      $input_image = 'default.png';
    }

    $query = mysqli_prepare($con, "INSERT INTO tblstaff (fname, lname, image, username, password) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, 'sssss', $input_fname, $input_lname, $input_image, $input_uname, $input_hashed_password);
    mysqli_stmt_execute($query);

    if(mysqli_stmt_affected_rows($query) > 0) {
      $_SESSION['added'] = 1;
      header("location: ".$_SERVER['REQUEST_URI']);
      exit;
    }
  } else {
    $_SESSION['duplicateuser'] = 1;
    header("location: ".$_SERVER['REQUEST_URI']);
    exit;
  }
}

if(isset($_POST['btn_save'])) {
  $input_id = $_POST['hidden_id'];
  $input_edit_fname = $_POST['input_edit_fname'];
  $input_edit_lname = $_POST['input_edit_lname'];
  $input_edit_uname = $_POST['input_edit_uname'];
  $input_edit_pass = $_POST['input_edit_pass'];

  // Hash the password using PASSWORD_DEFAULT
  $edit_hashed_password = password_hash($input_edit_pass, PASSWORD_DEFAULT);

  if(isset($_SESSION['role'])) {
    $action = 'update staff named '.$input_edit_fname.' '.$input_edit_lname;
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

  if($ct == 0) {
    $stmt = mysqli_prepare($con, "UPDATE tblstaff SET fname = ?, lname = ?, username = ?, password = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'ssssi', $input_edit_fname, $input_edit_lname, $input_edit_uname, $edit_hashed_password, $input_id);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) > 0) {
      $_SESSION['edited'] = 1;
      header("location: ".$_SERVER['REQUEST_URI']);
    }
  } else {
    $_SESSION['duplicateuser'] = 1;
    header("location: ".$_SERVER['REQUEST_URI']);
  }
}

if(isset($_POST['btn_delete'])) {
  if(isset($_POST['chk_delete'])) {
    foreach($_POST['chk_delete'] as $value) {
      $delete_query = mysqli_query($con, "DELETE from tblstaff where id = '$value' ") or die('Error: '.mysqli_error($con));

      if($delete_query == true) {
        $_SESSION['delete'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
      }
    }
  }
} ?>