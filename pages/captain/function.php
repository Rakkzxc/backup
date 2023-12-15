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

  if(isset($_SESSION['role'])) {
    $action = 'added barangay captain named '.$input_fname." ".$input_lname;
    $iquery = mysqli_prepare($con, "INSERT INTO tbllogs (user, logdate, action) VALUES (?, NOW(), ?)");
    mysqli_stmt_bind_param($iquery, 'ss', $_SESSION['role'], $action);
    mysqli_stmt_execute($iquery);
  }

  $su = mysqli_prepare($con, "SELECT * from tblcaptain where username = ?");
  mysqli_stmt_bind_param($su, 's', $input_uname);
  mysqli_stmt_execute($su);
  mysqli_stmt_store_result($su);
  $ct = mysqli_stmt_num_rows($su);

  if($ct == 0) {
    if($name != "") {
      if(($imagetype == "image/jpeg" || $imagetype == "image/png" || $imagetype == "image/bmp") && $size <= 2048000) {
        if(move_uploaded_file($temp, 'image/'.$image)) {
          $input_image = $image;
          $hashed_password = password_hash($input_pass, PASSWORD_DEFAULT);

          $query = mysqli_prepare($con, "INSERT INTO tblcaptain (fname, lname, image, username, password) VALUES (?, ?, ?, ?, ?)");
          mysqli_stmt_bind_param($query, 'sssss', $input_fname, $input_lname, $input_image, $input_uname, $hashed_password);
          mysqli_stmt_execute($query);
        }
      } else {
        $_SESSION['filesize'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
      }
    } else {
      $input_image = 'default.png';
      $hashed_password = password_hash($input_pass, PASSWORD_DEFAULT);

      $query = mysqli_prepare($con, "INSERT INTO tblcaptain (fname, lname, image, username, password) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($query, 'sssss', $input_fname, $input_lname, $input_image, $input_uname, $hashed_password);
      mysqli_stmt_execute($query);
    }

    if(mysqli_stmt_affected_rows($query) > 0) {
      $_SESSION['added'] = 1;
      header("location: ".$_SERVER['REQUEST_URI']);
    }
  } else {
    $_SESSION['duplicateuser'] = 1;
    header("location: ".$_SERVER['REQUEST_URI']);
  }
}

if(isset($_POST['btn_save'])) {
  $input_id = $_POST['hidden_id'];
  $input_edit_zone = $_POST['input_edit_zone'];
  $input_edit_uname = $_POST['input_edit_uname'];
  $input_edit_pass = $_POST['input_edit_pass'];

  if(isset($_SESSION['role'])) {
    $action = 'update barangay kapitan named '.$input_edit_uname; // Fixed variable name here
    $iquery = mysqli_query($con, "INSERT INTO tbllogs (user, logdate, action) VALUES ('".$_SESSION['role']."', NOW(), '".$action."')");
  }

  // Check if the username already exists, excluding the current record being edited
  $su = mysqli_query($con, "SELECT * FROM tblcaptain WHERE username = '".$input_edit_uname."' AND id <> '".$input_id."'");
  $ct = mysqli_num_rows($su);

  if($ct == 0) {
    // Update the record
    $update_query = mysqli_query($con, "UPDATE tblcaptain SET name = '".$input_edit_zone."', username = '".$input_edit_uname."', password = '".$input_edit_pass."' WHERE id = '".$input_id."'") or die('Error: '.mysqli_error($con));

    if($update_query == true) {
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
      $delete_query = mysqli_query($con, "DELETE from tblcaptain where id = '$value' ") or die('Error: '.mysqli_error($con));
      if($delete_query == true) {
        $_SESSION['delete'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
      }
    }
  }
} ?>