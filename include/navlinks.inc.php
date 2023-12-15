<?php
if (isset($_SESSION['role'])) {
  $redirect = '<li class="nav-item d-none d-sm-inline-block active"><a class="nav-link" href="../login.php">Go back to your ' . ucfirst(strtolower(($_SESSION['fname']))) . " " . ucfirst(strtolower(($_SESSION['lname']))) . ' dashboard <span class="sr-only">(current)</span></a></li>';
  if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrator') {
    echo $redirect;
  } elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'staff') {
    echo $redirect;
  } elseif (isset($_SESSION['resident']) && $_SESSION['resident'] === 1) {
    echo $redirect;
  } elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'captain') {
    echo $redirect;
  }
} else {
  echo '<li class="nav-item d-none d-sm-inline-block active"><a class="nav-link" href="../login.php">Sign in <span class="sr-only">(current)</span></a></li>';
} ?>