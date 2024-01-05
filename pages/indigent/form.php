<!DOCTYPE html>
<html id="clearance">
<style>
  @media print {
    .noprint {
      visibility: hidden;
    }

    @page {
      size: A4;
      margin: 4mm;
    }
  }
</style>
<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: ../../login.php");
} else {
  ob_start();
  $_SESSION['clr'] = $_GET['clearance'];
  include('../../include/global.inc.php') ?>

  <body>
    <?php include "../connection.php" ?>
    <div style="margin: 55px 100px 0;" class="clearance_container">
      <div class="clearance_header"
        style="display: flex; align-items: flex-start; justify-content: space-between; width: 100%; height: 100%;">
        <div class="left_logo">
          <img style="width: 150px; height: 150px;" src="../../assets/img/city-logo.png" alt="Logo">
        </div>
        <div style="text-align: center;" class="header_text">
          <h3><i>Republic of the Philippines</i></h3>
          <h3><i>Province of Davao del Norte</i></h3>
          <h3><i>City of Panabo</i></h3>
          <h3 class=" text-uppercase" style="font-weight: bolder;"><i>barangay new pandan</i></h3>
          <br />
          <br />
          <br />
          <br />
          <br />
          <h3 class=" text-uppercase"><i>office of the punong barangay</i></h3>
        </div>
        <div class="right_logo">
          <img style="width: 150px; height: 150px;" src="../../assets/img/brgy-logo.png" alt="Logo">
        </div>
      </div>
      <br>
      <br>
      <br>
      <hr style="border: 1px solid #6b6b6b;">
      <br>
      <br>
      <br>
      <h1 class="text-center text-uppercase text-bold">barangay clearance</h1>
      <br>
      <br>
      <h3 class="text-uppercase"><i>to whom it may concern:</i></h3>
      <br>
      <br>
      <div class="text-content"
        style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
        <?php
        function addDaySuffix($day)
        {
          $day = ltrim($day, '0');
          if ($day >= 11 && $day <= 13) {
            return $day . 'th';
          } else {
            switch ($day % 10) {
              case 1:
                return $day . 'st';
              case 2:
                return $day . 'nd';
              case 3:
                return $day . 'rd';
              default:
                return $day . 'th';
            }
          }
        }

        $qry = mysqli_query($con, "SELECT * from tblresident r left join tblclearance c on c.residentid = r.id where residentid = '" . $_GET['resident'] . "' and clearanceNo = '" . $_GET['clearance'] . "' ");
        while ($row = mysqli_fetch_array($qry)) {
          $bdate = date_create($row['bdate']);
          $date = date_create($row['dateRecorded']);
          $day = date_format($date, 'd');
          $month = date_format($date, 'F');
          $year = date_format($date, 'Y');
          $dayWithSuffix = addDaySuffix($day);
          echo '
                  <h3 style="line-height: 1.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is to certify that <span style="display: inline; border-bottom: 1px solid #000000;">' . "&nbsp; &nbsp; &nbsp;" . ucwords(strtolower($row['fname'])) . " " . ucwords(strtolower($row['mname'])) . " " . ucwords(strtolower($row['lname'])) . "&nbsp; &nbsp; &nbsp;" . '</span>, <span style="display: inline; border-bottom: 1px solid #000000;">' . "&nbsp; &nbsp;" . $row['age'] . "&nbsp; &nbsp;" . '</span>, years
                  old, <span style="display: inline; border-bottom: 1px solid #000000;">' . "&nbsp; &nbsp;" . ucfirst(strtolower($row['civilstatus'])) . "/" . ucfirst(strtolower($row['civilstatus'])) . "&nbsp; &nbsp;" . '</span> a bonafide resident of Purok <span style="display: inline; border-bottom: 1px solid #000000;">' . "&nbsp; &nbsp;" . ucwords(strtolower($row['purok'])) . "&nbsp; &nbsp;" . '</span>, Barangay New Pandan, Panabo City.
                  <br>
                  <br>
                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is to certify further that the above-mentioned has no criminal/civil
                  records or any pending case filed against him/her.
                  <br>
                  <br>
                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This certification is
                  being issued upon the verbal request of the above-mentioned for whatever legal purposes it may serve him/her
                  best.
                  <br>
                  <br>
                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Purpose: <span style="display: inline; border-bottom: 1px solid #000000;">' . "&nbsp; &nbsp;" . ucwords(strtolower($row['purpose'])) . "&nbsp; &nbsp;" . '</span>
                  <br>
                  <br>
                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Issued this on <span style="display: inline; border-bottom: 1px solid #000000;">' . "&nbsp; &nbsp;" . $dayWithSuffix . "&nbsp; &nbsp;" . '</span> day of <span style="display: inline; border-bottom: 1px solid #000000;">' . "&nbsp; &nbsp;" . $month . "&nbsp; &nbsp;" . '</span>, <span style="display: inline; border-bottom: 1px solid #000000;">' . "&nbsp; &nbsp;" . $year . "&nbsp; &nbsp;" . '</span> Barangay New Pandan,
                  Panabo City.
                </h3>
              ';
        } ?>

      </div>
      <div class="captain_container"
        style="display: flex; align-items: center; justify-content: flex-end; margin: 100px 0 0;">
        <div class="punong_barangay" style="width: 222px; height: 100%;">
          <h3 class="text-uppercase text-right text-bold">michael john d. badal</h3>
          <h4 class="text-capitalize text-center">punong barangay</h4>
        </div>
      </div>
      <button class="noprint" id="printpagebutton"
        style="width: 100%; height: 100%; background: blue; border: none; outline: none; padding: 7px 25px; font-size: 16px; color: whitesmoke; border-radius: 7px; margin: 70px 0 20px 0;"
        onclick="PrintElem('#clearance')">Print</button>
    </div>
  </body>
  <?php
} ?>

<script>
  function PrintElem(elem) {
    window.print();
  }

  function Popup(data) {
    var mywindow = window.open('', 'main', '');
    var printButton = document.getElementById("printpagebutton");
    printButton.style.visibility = 'hidden';
    mywindow.document.write(data);
    mywindow.document.close();
    mywindow.focus();
    mywindow.print();
    printButton.style.visibility = 'visible';
    mywindow.close();
    return true;
  }
</script>

</html>