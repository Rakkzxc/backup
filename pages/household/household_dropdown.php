<?php
include "../connection.php";
if (isset($_POST['hhold_id'])) {
	$hhold_id = $_POST['hhold_id'];
	$stmt = mysqli_prepare($con, "SELECT id AS resID, lname, fname, mname FROM tblresident WHERE householdnum = ?");
	mysqli_stmt_bind_param($stmt, "s", $hhold_id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if ($result) {
		echo '<option selected disabled>Please select the head of family</option>';
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<option value="' . $row['resID'] . '">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option>';
		}
	} else {
		echo '<option selected disabled>No existing head of family for household # entered</option>';
	}
	mysqli_stmt_close($stmt);
}

if (isset($_POST['total_id'])) {
	$total_id = $_POST['total_id'];
	$stmt = mysqli_prepare($con, "SELECT totalhousehold FROM tblresident WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "s", $total_id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if ($result) {
		$row = mysqli_fetch_assoc($result);
		echo "<script>document.getElementsByName('txt_totalmembers')[0].value = " . $row['totalhousehold'] . ";</script>";
	} else {
		echo '<option selected disabled>No existing head of family for household # entered</option>';
	}
	mysqli_stmt_close($stmt);
} ?>