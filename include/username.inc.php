<?php
if (isset($_SESSION['role'])) {
  $role = strtolower($_SESSION['role']);
  if ($role === 'administrator') { // administrator role
    $userMessage = '<p>' . ucwords(strtolower($_SESSION['fname'])) . " " . ucwords(strtolower($_SESSION['lname'])) . '</p>';
  } elseif ($role === 'captain') { // purok leader role
    $userMessage = '<p>' . ucwords(strtolower($_SESSION['fname'])) . " " . ucwords(strtolower($_SESSION['lname'])) . '</p>';
  } elseif ($role === 'staff') { // staff role
    $userMessage = '<p>' . ucwords(strtolower($_SESSION['fname'])) . " " . ucwords(strtolower($_SESSION['lname'])) . '</p>';
  } elseif ($role === 'resident') { // resident role
    $userMessage = '<p>' . ucwords(strtolower($_SESSION['fname'])) . " " . ucwords(strtolower($_SESSION['lname'])) . '</p>';
  }
} ?>