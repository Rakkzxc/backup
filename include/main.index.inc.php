<?php
include_once "../pages/connection.php";
$squery = mysqli_query($con, "SELECT *,CONCAT(lname, ', ', fname, ' ', mname) as cname FROM tblresident");
while ($row = mysqli_fetch_array($squery)) {
  echo '
    <tr>
      <td style="width:70px;">
        <image src="../pages/resident/image/' . basename($row['image']) . '" style="width:60px;height:60px;" />
      </td>
      <td class="align-middle">' . ucwords(strtolower($row['cname'])) . '</td>
      <td class="align-middle">' . ucwords(strtolower($row['barangay'])) . '</td>
      <td class="align-middle">' . ucwords(strtolower($row['purok'])) . '</td>
      <td class="align-middle">' . ucwords(strtolower($row['age'])) . '</td>
      <td class="align-middle">' . ucwords(strtolower($row['gender'])) . '</td>
      <td class="align-middle">' . ucwords(strtolower($row['formerAddress'])) . '</td>
      <td class="align-middle">
        <button class="btn btn-block btn-primary" data-target="#modal' . $row['id'] . '" data-toggle="modal">
          <i class="fa fa-search" aria-hidden="true"></i> Details
        </button>
      </td>
    </tr>
  ';
  include "modal.php";
}