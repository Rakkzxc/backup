<?php
if (isset($_POST['btn_add'])) {
  $input_act = $_POST['input_act'];
  $input_desc = $_POST['input_desc'];

  // Use the current date and time in the proper datetime format
  $input_doc = date('Y-m-d H:i:s');

  if (isset($_SESSION['role'])) {
    $action = 'added announcement named ' . $input_act;
    $user_role = $_SESSION['role'];

    // Create a prepared statement for the logs
    $iquery = $con->prepare("INSERT INTO tbllogs (user, logdate, action) VALUES (?, NOW(), ?)");
    $iquery->bind_param("ss", $user_role, $action);
    $iquery->execute();
  }

  // Create a prepared statement for the announcement data
  $query = $con->prepare("INSERT INTO tblannouncement (dateofannouncement, announcement, description) VALUES (?, ?, ?)");
  $query->bind_param("sss", $input_doc, $input_act, $input_desc);
  $query->execute();

  $id = $query->insert_id;

  if (isset($_FILES['files'])) {
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
      $target = "photo/";
      $milliseconds = round(microtime(true) * 1000);
      $name = $milliseconds . $_FILES['files']['name'][$key];
      $target = $target . $name;

      if (move_uploaded_file($tmp_name, $target)) {
        // Create a prepared statement for announcement photos
        $photo_query = $con->prepare("INSERT INTO tblannouncementphoto (announcementid, filename) VALUES (?, ?)");
        $photo_query->bind_param("ss", $id, $name);
        $photo_query->execute();
      }
    }
  }

  if ($id > 0) {
    $_SESSION['added'] = 1;
    header("location: " . $_SERVER['REQUEST_URI']);
  }
}

if (isset($_POST['btn_save'])) {
  $input_id = $_POST['hidden_id'];
  $input_edit_doc = $_POST['input_edit_doc'];
  $input_edit_act = $_POST['input_edit_act'];
  $input_edit_desc = $_POST['input_edit_desc'];

  // prepare the update statement with placeholders
  $update_query = mysqli_prepare($con, "UPDATE tblannouncement SET dateofannouncement = ?, announcement = ?, description = ? WHERE id = ?");

  if ($update_query) {
    // bind parameters to the placeholders
    mysqli_stmt_bind_param($update_query, "sssi", $input_edit_doc, $input_edit_act, $input_edit_desc, $input_id);

    // execute the prepared statement
    if (mysqli_stmt_execute($update_query)) {
      if (isset($_SESSION['role'])) {
        $action = 'update announcement named ' . $input_edit_act;

        // prepare the insert statement with placeholders
        $iquery = mysqli_prepare($con, "INSERT INTO tbllogs (user, logdate, action) VALUES (?, NOW(), ?)");

        if ($iquery) {
          // bind parameters to the placeholders
          mysqli_stmt_bind_param($iquery, "ss", $_SESSION['role'], $action);

          // execute the prepared statement
          if (mysqli_stmt_execute($iquery)) {
            $_SESSION['edited'] = 1;
            header("location: " . $_SERVER['REQUEST_URI']);
          } else {
            // handle the insert error
            echo 'Error: ' . mysqli_stmt_error($iquery);
          }
          // close the prepared statement
          mysqli_stmt_close($iquery);
        } else {
          // handle the prepare error
          echo 'Error: ' . mysqli_error($con);
        }
      }
      $_SESSION['edited'] = 1;
      header("location: " . $_SERVER['REQUEST_URI']);
    } else {
      // handle the update error
      echo 'Error: ' . mysqli_stmt_error($update_query);
    }

    // close the prepared statement
    mysqli_stmt_close($update_query);
  } else {
    // handle the prepare error
    echo 'Error: ' . mysqli_error($con);
  }
}

if (isset($_POST['btn_delete'])) {
  if (isset($_POST['chk_delete'])) {
    foreach ($_POST['chk_delete'] as $value) {
      $delete_query = mysqli_query($con, "DELETE from tblannouncement where id = '$value' ") or die('Error: ' . mysqli_error($con));

      if ($delete_query == true) {
        $_SESSION['delete'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
      }
    }
  }
}

if (isset($_POST['btn_addimage'])) {
  $id = $_POST['hidden_id'];

  if (isset($_FILES['photos'])) {
    foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
      $target = "photo/";
      $milliseconds = round(microtime(true) * 1000);
      $name = $milliseconds . $_FILES['photos']['name'][$key];
      $target = $target . $name;

      if (move_uploaded_file($tmp_name, $target)) {
        $query = mysqli_query($con, "INSERT INTO tblannouncementphoto (announcementid,filename) 
                    values ('$id', '" . $name . "')") or die('Error: ' . mysqli_error($con));
        if ($query == true) {
          $_SESSION['added'] = 1;
          header("location: " . $_SERVER['REQUEST_URI']);
        }
      }
    }
  }
}

if (isset($_POST['btn_remove'])) {
  if (isset($_POST['chk_deletephoto'])) {
    foreach ($_POST['chk_deletephoto'] as $value) {
      $delete_query = mysqli_query($con, "DELETE from tblannouncementphoto where id = '$value' ") or die('Error: ' . mysqli_error($con));

      if ($delete_query == true) {
        $_SESSION['delete'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
      }
    }
  }
} ?>