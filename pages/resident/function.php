<?php
if(isset($_POST['btn_add'])) {
  $txt_lname = $_POST['txt_lname'];
  $txt_fname = $_POST['txt_fname'];
  $txt_mname = $_POST['txt_mname'];
  $ddl_gender = $_POST['ddl_gender'];
  $txt_bdate = $_POST['txt_bdate'];
  $txt_bplace = $_POST['txt_bplace'];

  $dateOfBirth = $txt_bdate;
  $today = date("Y-m-d");
  $diff = date_diff(date_create($dateOfBirth), date_create($today));
  $txt_age = $diff->format('%y');

  $txt_brgy = $_POST['txt_brgy'];
  $txt_dperson = $_POST['txt_dperson'];
  $txt_hstatus = $_POST['txt_hstatus'];
  $txt_purok = $_POST['txt_purok'];
  $txt_householdmem = $_POST['txt_householdmem'];
  $txt_rthead = $_POST['txt_rthead'];

  $txt_btype = $_POST['txt_btype'];
  $txt_cstatus = $_POST['txt_cstatus'];
  $txt_occp = $_POST['txt_occp'];
  $txt_income = $_POST['txt_income'];
  $txt_householdnum = $_POST['txt_householdnum'];
  $txt_length = $_POST['txt_length'];
  $txt_religion = $_POST['txt_religion'];
  $txt_national = $_POST['txt_national'];
  $txt_skills = $_POST['txt_skills'];
  $txt_igpit = $_POST['txt_igpit'];
  $txt_phno = $_POST['txt_phno'];
  $txt_phno_exp_date = $_POST['txt_phno_exp_date'];
  $ddl_eattain = $_POST['ddl_eattain'];
  $ddl_hos = $_POST['ddl_hos'];

  $ddl_los = $_POST['ddl_los'];
  $ddl_dtype = $_POST['ddl_dtype'];
  $txt_sofwatersupply = implode(', ', $_POST['txt_sofwatersupply']);
  $txt_lightning = $_POST['txt_lightning'];
  $txt_toilet = $_POST['txt_toilet'];
  $txt_faddress = $_POST['txt_faddress'];
  $txt_uname = $_POST['txt_uname'];
  $txt_upass = $_POST['txt_upass'];

  $txt_remarks = $_POST['txt_remarks'];

  $name = basename($_FILES['txt_image']['name']);
  $temp = $_FILES['txt_image']['tmp_name'];
  $imagetype = $_FILES['txt_image']['type'];
  $size = $_FILES['txt_image']['size'];

  $milliseconds = round(microtime(true) * 1000);
  $image = $milliseconds.'_'.$name;

  // Hash the password using PASSWORD_DEFAULT
  $hashed_password = password_hash($txt_upass, PASSWORD_DEFAULT);

  if(isset($_SESSION['role'])) {
    $action = 'added resident named '.$txt_lname.' '.$txt_fname.' '.$txt_mname;
    $iquery = mysqli_prepare($con, "INSERT INTO tbllogs (user, logdate, action) VALUES (?, NOW(), ?)");
    mysqli_stmt_bind_param($iquery, 'ss', $_SESSION['role'], $action);
    mysqli_stmt_execute($iquery);
  }

  $stmt = mysqli_prepare($con, "SELECT * FROM tblresident WHERE username = ?");
  mysqli_stmt_bind_param($stmt, 's', $txt_uname);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $ct = mysqli_stmt_num_rows($stmt);

  if($ct == 0) {
    if($name != "") {
      if(($imagetype == "image/jpeg" || $imagetype == "image/png" || $imagetype == "image/bmp") && $size <= 2048000) {
        if(move_uploaded_file($temp, 'image/'.$image)) {
          $txt_image = $image;
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
      $txt_image = 'default.png';
    }

    $query = mysqli_prepare(
      $con,
      "INSERT INTO tblresident (
                        lname, fname, mname, bdate, bplace, age, barangay, purok, totalhousehold,
                        differentlyabledperson, relationtohead, healthstatus, bloodtype, civilstatus,
                        occupation, monthlyincome, householdnum, lengthofstay, religion, nationality,
                        gender, skills, igpitID, philhealthNo, philhealthnoexpdate, highestEducationalAttainment,
                        houseOwnershipStatus, landOwnershipStatus, dwellingtype, sourceofwatersupply,
                        lightningFacilities, sanitaryToilet, formerAddress, remarks, image, username, password
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
      $query,
      'sssssssssssssssssssssssssssssssssssss',
      $txt_lname,
      $txt_fname,
      $txt_mname,
      $txt_bdate,
      $txt_bplace,
      $txt_age,
      $txt_brgy,
      $txt_purok,
      $txt_householdmem,
      $txt_dperson,
      $txt_rthead,
      $txt_hstatus,
      $txt_btype,
      $txt_cstatus,
      $txt_occp,
      $txt_income,
      $txt_householdnum,
      $txt_length,
      $txt_religion,
      $txt_national,
      $ddl_gender,
      $txt_skills,
      $txt_igpit,
      $txt_phno,
      $txt_phno_exp_date,
      $ddl_eattain,
      $ddl_hos,
      $ddl_los,
      $ddl_dtype,
      $txt_sofwatersupply,
      $txt_lightning,
      $txt_toilet,
      $txt_faddress,
      $txt_remarks,
      $txt_image,
      $txt_uname,
      $hashed_password
    );

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
  $txt_id = $_POST['hidden_id'];
  $txt_edit_lname = $_POST['txt_edit_lname'];
  $txt_edit_fname = $_POST['txt_edit_fname'];
  $txt_edit_mname = $_POST['txt_edit_mname'];
  $txt_edit_bdate = $_POST['txt_edit_bdate'];
  $txt_edit_bplace = $_POST['txt_edit_bplace'];

  $dateOfBirth = $txt_edit_bdate;
  $today = date("Y-m-d");
  $diff = date_diff(date_create($dateOfBirth), date_create($today));
  $txt_edit_age = $diff->format('%y');

  $txt_edit_brgy = $_POST['txt_edit_brgy'];
  $txt_edit_dperson = $_POST['txt_edit_dperson'];
  $txt_edit_hstatus = $_POST['txt_edit_hstatus'];
  $txt_edit_purok = $_POST['txt_edit_purok'];
  $txt_edit_householdmem = $_POST['txt_edit_householdmem'];
  $txt_edit_rthead = $_POST['txt_edit_rthead'];

  $txt_edit_btype = $_POST['txt_edit_btype'];
  $txt_edit_cstatus = $_POST['txt_edit_cstatus'];
  $txt_edit_occp = $_POST['txt_edit_occp'];
  $txt_edit_income = $_POST['txt_edit_income'];

  $txt_edit_householdnum = $_POST['txt_edit_householdnum'];
  $txt_edit_length = $_POST['txt_edit_length'];
  $txt_edit_religion = $_POST['txt_edit_religion'];
  $txt_edit_national = $_POST['txt_edit_national'];
  $ddl_edit_gender = $_POST['ddl_edit_gender'];
  $txt_edit_skills = $_POST['txt_edit_skills'];
  $txt_edit_igpit = $_POST['txt_edit_igpit'];
  $txt_edit_phno = $_POST['txt_edit_phno'];
  $txt_edit_phno_exp_date = $_POST['txt_edit_phno_exp_date'];
  $ddl_edit_eattain = $_POST['ddl_edit_eattain'];
  $ddl_edit_hos = $_POST['ddl_edit_hos'];

  $ddl_edit_los = $_POST['ddl_edit_los'];
  $ddl_edit_dtype = $_POST['ddl_edit_dtype'];
  $txt_edit_sofwatersupply = implode(', ', $_POST['txt_edit_sofwatersupply']);
  $txt_edit_lightning = $_POST['txt_edit_lightning'];
  $txt_edit_toilet = $_POST['txt_edit_toilet'];
  $txt_edit_faddress = $_POST['txt_edit_faddress'];

  $txt_edit_uname = $_POST['txt_edit_uname'];
  $txt_edit_upass = $_POST['txt_edit_upass'];
  $txt_edit_remarks = $_POST['txt_edit_remarks'];

  $name = basename($_FILES['txt_edit_image']['name']);
  $temp = $_FILES['txt_edit_image']['tmp_name'];
  $imagetype = $_FILES['txt_edit_image']['type'];
  $size = $_FILES['txt_edit_image']['size'];

  $milliseconds = round(microtime(true) * 1000);
  $image = $milliseconds.'_'.$name;

  if(isset($_SESSION['role'])) {
    $action = 'update resident named '.$txt_edit_lname.', '.$txt_edit_fname.' '.$txt_edit_mname;
    $iquery = mysqli_query($con, "INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
  }
  $su = mysqli_query($con, "SELECT * from tblresident where username = '".$txt_edit_uname."' and id not in (".$txt_id.") ");
  $ct = mysqli_num_rows($su);
  if($ct == 0) {
    if($name != "") {
      if(($imagetype == "image/jpeg" || $imagetype == "image/png" || $imagetype == "image/bmp") && $size <= 2048000) {
        if(move_uploaded_file($temp, 'image/'.$image)) {
          $txt_edit_image = $image;
          $update_query = mysqli_query($con, "UPDATE tblresident set 
                                        lname = '".$txt_edit_lname."',
                                        fname = '".$txt_edit_fname."',
                                        mname = '".$txt_edit_mname."',
                                        bdate = '".$txt_edit_bdate."',
                                        bplace = '".$txt_edit_bplace."',
                                        age = '".$txt_edit_age."',
                                        barangay = '".$txt_edit_brgy."',
                                        purok = '".$txt_edit_purok."',
                                        totalhousehold = '".$txt_edit_householdmem."',
                                        differentlyabledperson = '".$txt_edit_dperson."',
                                        relationtohead = '".$txt_edit_rthead."',
                                        healthstatus = '".$txt_edit_hstatus."',
                                        bloodtype = '".$txt_edit_btype."',
                                        civilstatus = '".$txt_edit_cstatus."',
                                        occupation = '".$txt_edit_occp."',
                                        monthlyincome = '".$txt_edit_income."',
                                        householdnum = '".$txt_edit_householdnum."',
                                        lengthofstay = '".$txt_edit_length."',
                                        religion = '".$txt_edit_religion."',
                                        nationality = '".$txt_edit_national."',
                                        gender = '".$ddl_edit_gender."',
                                        skills = '".$txt_edit_skills."',
                                        igpitID = '".$txt_edit_igpit."',
                                        philhealthNo = '".$txt_edit_phno."',
                                        philhealthnoexpdate = '".$txt_edit_phno_exp_date."',
                                        highestEducationalAttainment = '".$ddl_edit_eattain."',
                                        houseOwnershipStatus = '".$ddl_edit_hos."',
                                        landOwnershipStatus = '".$ddl_edit_los."',
                                        dwellingtype = '".$ddl_edit_dtype."',
                                        sourceofwatersupply = '".$txt_edit_sofwatersupply."',
                                        lightningFacilities = '".$txt_edit_lightning."',
                                        sanitaryToilet = '".$txt_edit_toilet."',
                                        formerAddress = '".$txt_edit_faddress."',
                                        remarks = '".$txt_edit_remarks."',
                                        image = '".$txt_edit_image."',
                                        username = '".$txt_edit_uname."',
                                        password = '".$txt_edit_upass."'
                                        where id = '".$txt_id."'
                                ") or die('Error: '.mysqli_error($con));
        }
      } else {
        $_SESSION['filesize'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
      }
    } else {
      $chk_image = mysqli_query($con, "SELECT * from tblresident where id = '".$_POST['hidden_id']."' ");
      $rowimg = mysqli_fetch_array($chk_image);
      $txt_edit_image = $rowimg['image'];
      $update_query = mysqli_query($con, "UPDATE tblresident set 
                                        lname = '".$txt_edit_lname."',
                                        fname = '".$txt_edit_fname."',
                                        mname = '".$txt_edit_mname."',
                                        bdate = '".$txt_edit_bdate."',
                                        bplace = '".$txt_edit_bplace."',
                                        age = '".$txt_edit_age."',
                                        barangay = '".$txt_edit_brgy."',
                                        purok = '".$txt_edit_purok."',
                                        totalhousehold = '".$txt_edit_householdmem."',
                                        differentlyabledperson = '".$txt_edit_dperson."',
                                        relationtohead = '".$txt_edit_rthead."',
                                        healthstatus = '".$txt_edit_hstatus."',
                                        bloodtype = '".$txt_edit_btype."',
                                        civilstatus = '".$txt_edit_cstatus."',
                                        occupation = '".$txt_edit_occp."',
                                        monthlyincome = '".$txt_edit_income."',
                                        householdnum = '".$txt_edit_householdnum."',
                                        lengthofstay = '".$txt_edit_length."',
                                        religion = '".$txt_edit_religion."',
                                        nationality = '".$txt_edit_national."',
                                        gender = '".$ddl_edit_gender."',
                                        skills = '".$txt_edit_skills."',
                                        igpitID = '".$txt_edit_igpit."',
                                        philhealthNo = '".$txt_edit_phno."',
                                        philhealthnoexpdate = '".$txt_edit_phno_exp_date."',
                                        highestEducationalAttainment = '".$ddl_edit_eattain."',
                                        houseOwnershipStatus = '".$ddl_edit_hos."',
                                        landOwnershipStatus = '".$ddl_edit_los."',
                                        dwellingtype = '".$ddl_edit_dtype."',
                                        sourceofwatersupply = '".$txt_edit_sofwatersupply."',
                                        lightningFacilities = '".$txt_edit_lightning."',
                                        sanitaryToilet = '".$txt_edit_toilet."',
                                        formerAddress = '".$txt_edit_faddress."',
                                        remarks = '".$txt_edit_remarks."',
                                        image = '".$txt_edit_image."',
                                        username = '".$txt_edit_uname."',
                                        password = '".$txt_edit_upass."'
                                        where id = '".$txt_id."'
                                ") or die('Error: '.mysqli_error($con));
    }
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
      $delete_query = mysqli_query($con, "DELETE from tblresident where id = '$value' ") or die('Error: '.mysqli_error($con));

      if($delete_query == true) {
        $_SESSION['delete'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
      }
    }
  }
} ?>