<?php
include "../connection.php";
$result = mysqli_query($con, "SELECT username FROM tblcaptain WHERE username = '" . $_POST['username'] . "' ");
$cnt = mysqli_num_rows($result);
print($cnt);
?>