<!DOCTYPE html>
<html lang="en">
<?php include "include/logs/login.logs.inc.php" ?>
<title>Barangay New Pandan | Sign in</title>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <title>Barangay Information System</title>
  <link rel="shortcut icon" href="assets/img/favicon.svg" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition login-page dark-mode">
  <div class="login-box shadow-lg">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <style>
          .card-header {
            border-bottom: 2px double rgba(255, 255, 255, 0.075) !important
          }
        </style>
        <img src="assets/img/brgy-logo.png" style="height:125px">
      </div>
      <div class="card-body">
        <p class="login-box-msg" style="color: rgba(255, 255, 255, 0.85)">Blee<span>😋</span></p>
        <form method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="input_username"
              value="<?php echo isset($_POST['input_username']) ? htmlspecialchars($_POST['input_username']) : '' ?>"
              placeholder="Enter your username" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="input_password" placeholder="Enter your password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <select name="user_role" class="form-control select2" data-minimum-results-for-search="Infinity" required>
              <option selected disabled>Please sign in as</option>
              <option value="administrator">Administrator</option>
              <option value="captain">Captain</option>
              <option value="staff">Staff</option>
              <option value="resident">Resident</option>
            </select>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="btn_login">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->


  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Initialize Plugins -->
  <script> $(".select2").select2() </script>
</body>

</html>