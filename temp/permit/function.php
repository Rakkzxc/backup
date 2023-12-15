<?php
if (isset($_POST['btn_add'])) {
  $txt_cnum = mysqli_real_escape_string($con, $_POST['txt_cnum']);
  $ddl_resident = mysqli_real_escape_string($con, $_POST['ddl_resident']);
  $txt_findings = mysqli_real_escape_string($con, $_POST['txt_findings']);
  $txt_purpose = mysqli_real_escape_string($con, $_POST['txt_purpose']);
  $txt_ornum = mysqli_real_escape_string($con, $_POST['txt_ornum']);
  $txt_amount = mysqli_real_escape_string($con, $_POST['txt_amount']);
  $date = date('Y-m-d H:i:s');

  $chkdup_query = mysqli_prepare($con, "SELECT * from tblpermit where permitNo = ?");
  mysqli_stmt_bind_param($chkdup_query, "s", $txt_cnum);
  mysqli_stmt_execute($chkdup_query);
  mysqli_stmt_store_result($chkdup_query);
  $num_rows = mysqli_stmt_num_rows($chkdup_query);

  if (isset($_SESSION['role'])) {
    $action = 'added permit with permit number ' . $txt_cnum;
    $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (user, logdate, action) VALUES (?, NOW(), ?)");
    mysqli_stmt_bind_param($log_query, "ss", $_SESSION['role'], $action);
    mysqli_stmt_execute($log_query);
  }

  if ($num_rows == 0) {
    $status = ($_SESSION['role'] == "Administrator" || $_SESSION['role'] == "Staff") ? 'Approved' : 'New';
    $recordedBy = ucfirst(strtolower($_SESSION['fname'])) . ' ' . ucfirst(strtolower($_SESSION['lname']));
    $insert_query = mysqli_prepare($con, "INSERT INTO tblpermit (permitNo, residentid, findings, purpose, orNo, samount, dateRecorded, recordedBy, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($insert_query, "sssssssss", $txt_cnum, $ddl_resident, $txt_findings, $txt_purpose, $txt_ornum, $txt_amount, $date, $recordedBy, $status);

    if (mysqli_stmt_execute($insert_query)) {
      $_SESSION['added'] = 1;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();
    } else {
      echo "Error: " . mysqli_stmt_error($insert_query);
    }
  } else {
    $_SESSION['duplicate'] = 1;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
  }
}

if (isset($_POST['btn_req'])) {
  $chkblot = mysqli_query($con, "select * from tblresident where '" . $_SESSION['userid'] . "' not in (select complainant from tblblotter)");
  $num_row = mysqli_num_rows($chkblot);
  if ($num_row > 0) {
    $chk = mysqli_query($con, "select * from tblresident where id = '" . $_SESSION['userid'] . "' ");
    while ($row = mysqli_fetch_array($chk)) {

      if ($row['lengthofstay'] < 6) {
        $_SESSION['lengthofstay'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
      } else {
        $txt_purpose = $_POST['txt_purpose'];
        $date = date('Y-m-d H:i:s');
        $reqquery = mysqli_query($con, "INSERT INTO tblpermit (permitNo,residentid,findings,purpose,orNo,samount,dateRecorded,recordedBy,status) 
                    values ('','" . $_SESSION['userid'] . "','','$txt_purpose','','','$date','" . $_SESSION['role'] . "','New') ") or die('Error: ' . mysqli_error($con));

        if ($reqquery == true) {
          header("location: " . $_SERVER['REQUEST_URI']);
        }
      }
    }
  } else {
    $_SESSION['blotter'] = 1;
    header("location: " . $_SERVER['REQUEST_URI']);
  }
}

if (isset($_POST['btn_approve'])) {
  $txt_id = $_POST['hidden_id'];
  $txt_cnum = $_POST['txt_cnum'];
  $txt_findings = $_POST['txt_findings'];
  $txt_ornum = $_POST['txt_ornum'];
  $txt_amount = $_POST['txt_amount'];

  $approve_query = mysqli_query($con, "UPDATE tblpermit set permitNo= '" . $txt_cnum . "', findings = '" . $txt_findings . "', orNo = '" . $txt_ornum . "', samount = '" . $txt_amount . "', status='Approved' where id = '" . $txt_id . "' ") or die('Error: ' . mysqli_error($con));

  if ($approve_query == true) {
    header("location: " . $_SERVER['REQUEST_URI']);
  }
}

if (isset($_POST['btn_disapprove'])) {
  $txt_id = $_POST['hidden_id'];
  $txt_findings = $_POST['txt_findings'];
  $disapprove_query = mysqli_query($con, "UPDATE tblpermit set findings = '" . $txt_findings . "' , status='Disapproved' where id = '" . $txt_id . "' ") or die('Error: ' . mysqli_error($con));

  if ($disapprove_query == true) {
    header("location: " . $_SERVER['REQUEST_URI']);
  }
}

if (isset($_POST['btn_save'])) {
  $txt_id = $_POST['hidden_id'];
  $txt_edit_cnum = $_POST['txt_edit_cnum'];
  $txt_edit_findings = $_POST['txt_edit_findings'];
  $txt_edit_purpose = $_POST['txt_edit_purpose'];
  $txt_edit_ornum = $_POST['txt_edit_ornum'];
  $txt_edit_amount = $_POST['txt_edit_amount'];

  $update_query = mysqli_query($con, "UPDATE tblpermit set permitNo= '" . $txt_edit_cnum . "', findings = '" . $txt_edit_findings . "', purpose = '" . $txt_edit_purpose . "', orNo = '" . $txt_edit_ornum . "', samount = '" . $txt_edit_amount . "' where id = '" . $txt_id . "' ") or die('Error: ' . mysqli_error($con));

  if (isset($_SESSION['role'])) {
    $action = 'update permit with permit number ' . $txt_edit_cnum;
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
      $delete_query = mysqli_query($con, "DELETE from tblpermit where id = '$value' ") or die('Error: ' . mysqli_error($con));

      if ($delete_query == true) {
        $_SESSION['delete'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
      }
    }
  }
} ?>