<?php
//start the session
session_start();

//session_destroy();
$_SESSION = [];

//Database connection
include('cn/cn.php');

if (isset($_POST['btn_login_1'])) {

  $Uname = mysqli_real_escape_string($dbc, $_POST['Uname']);
  $UPass = mysqli_real_escape_string($dbc, $_POST['UPass']);

  if (strpos($Uname, ";")) {
    die("Invalid Username");
  } elseif (strpos($UPass, ";")) {
    die();
  } else {
    $a = mysqli_query($dbc, "SELECT * FROM kaina_view WHERE ID='$Uname' AND NewPass=md5('$UPass')");

    if (mysqli_num_rows($a) == 1) {
      $an = mysqli_fetch_assoc($a);

      if ($an['ID'] == $Uname and $an['NewPass'] == md5($UPass)) {
        if ($an['Stats'] == 0) {
          echo "<script>Account is disabled. Contact your system administrator</script>";

        } else {

          $_SESSION['Uname'] = trim($Uname);
          $_SESSION['UPass'] = trim($UPass);
          $_SESSION['FName'] = trim($an['FullName']);
          $_SESSION['Initial'] = trim($an['Initial']);
          $_SESSION['BranchID'] = trim($an['BranchID']);
          $_SESSION['Nature'] = trim($an['Nature']);
          $_SESSION['BranchName'] = trim($an['BranchName']);
          $_SESSION['Nature'] = trim($an['Nature']);

          if ($_SESSION['Nature']== 'Admin-0') {
           //  header('Location: my-online-platform-0026201803');
            echo "<script>window.location.href='admin-model'</script>";

          } elseif ($_SESSION['Nature'] == 'FrontDesk') {
          //  header('Location: my-online-platform-0026201803');
            echo "<script>window.location.href='front-desk'</script>";

          }
        }
      } else {
        echo 1;
      }
    } else {
      echo '<script>alert("Invalid Username or Password")</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Freight Pro</title>

  <?php include('script.php') ?>

</head>

<body class="bg-gradient-dark">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row  bg-login-image bg-dark bg-opacity-25 text-white">
              <div class="col-lg-6 d-none d-lg-block sr-only"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center text-white">
                    <h1 class="h4  text-white mb-4 text-white"> <i class="fas fa-gem text-white"></i> FreightPro</h1>
                  </div>
                  <form class="user" method="post" action="">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="txt_Username_09" name="Uname" required="" aria-describedby="emailHelp" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="UPass" id="txt_Password_33" required="" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-secondary btn-user btn-block" type="submit" name="btn_login_1">
                      Login
                    </button>
                    <hr>
                    <a href="#" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="#" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small text-light-emphasis" href="#">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small text-light-emphasis" href="#">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  <?php include('script_bottom.php') ?>;

</body>

</html>