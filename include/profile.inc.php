<?php
$profile = $_SESSION['profile'];
if (isset($_SESSION['role'])) {
  if ((!isset($_SESSION['role']) || $_SESSION['role'] === "administrator")) {
    $zxcqwepoibnm = 'src="../../assets/avatar/' . $profile . '"';
  } elseif ((!isset($_SESSION['role']) || $_SESSION['role'] === "staff")) {
    $zxcqwepoibnm = 'src="../../pages/staff/image/' . $profile . '"';
  } elseif ((!isset($_SESSION['role']) || $_SESSION['role'] === "captain")) {
    $zxcqwepoibnm = 'src="../../pages/captain/image/' . $profile . '"';
  } elseif ((!isset($_SESSION['role']) || $_SESSION['role'] === "resident")) {
    $zxcqwepoibnm = 'src="../../pages/resident/image/' . $profile . '"';
  }
}