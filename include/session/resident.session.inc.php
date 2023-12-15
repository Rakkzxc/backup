<?php
if (isset($_SESSION['userid'])) {
  if ($_SESSION['role'] === "administrator") {
    header('location: ../../pages/dashboard/dashboard.php');
  } elseif ($_SESSION['role'] === "captain") {
    header('location: ../../pages/clearance/clearance.php');
  } elseif ($_SESSION['role'] === "staff") {
    header('location: ../../pages/resident/resident.php');
  } elseif ($_SESSION['role'] === "resident") {
    header('location: ../../pages/clearance/clearance.php');
  } else {
    header('location: main/index.php');
  } exit;
} ?>