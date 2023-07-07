<?php
session_start();

require_once "../../Config/Database.php";
require_once "../../Helper/functions.php";
$conn = getConnection();
$_SESSION['loginStr'] = "false";
// error_reporting(E_ALL ^ E_WARNING);
// if (isset($_SESSION['login']) && $_SESSION['login']) {
//     header("Location: ../../dasboard.php");
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM karyawan WHERE email=? AND password=?;";
    $hasil = $conn->prepare($sql);
    $hasil->execute([$email, $password]);

    if ($row = $hasil->fetch()) {
        $nama = $row['nama'];
        $_SESSION['admin'] = "";
        $_SESSION['nama'] = $nama;
        $_SESSION['login'] = true;
        $_SESSION['loginStr'] = "true";
        $_SESSION['email'] = $email;
        $_SESSION['id_karyawan'] = $row["id_karyawan"];
        if ($row["role"] == 1) {
            $_SESSION['admin'] = true;
             header("Location: ../../dasboard.php");
        } else {
            $_SESSION['admin'] = false;
            header("Location: ../../pages_karywan/transaksi/halaman_transaksi.php");
        }


        // // successLogin($nama);
        // header("Location: ../../dasboard.php");
        exit();
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
    // $_SESSION['login'] = true;
    // $_SESSION['username'] = 'Eko';

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../images/logo.svg" alt="logo">
              </div>
              <div class="heading mb-3 text-md-center text-center">
                        <!-- <h2>Welcome Back</h2> -->
                        <!-- <p><?php if (isset($_SESSION['login'])) {
                                echo $_SESSION['login'];
                            }  ?></p>
                      
                        <?php
                        if (isset($_GET['error'])) {
                            echo '
                            <p class="error-msg">
                                ' . $_GET['error'] . '
                            </p>
                            ';
                        } else {
                            echo '
                            <p>
                            Silahkan isi dengan detail akun anda
                            </p>

                            ';
                        }
                        ?> -->
                    </div>
              <h4>Hello! let's get started</h4>
              <h6 class="fw-light">Sign in to continue.</h6>
              <div>
              <form method="POST" class="mt-3" action="#" id="formlogin">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Username">
                  <!-- <input autocomplete="off" type="email" id="email" name="email" placeholder="Email Address"> -->
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                  <!-- <input autocomplete="off" type="password" id="password" name="password" placeholder="Password"> -->
                </div>
                <div class="mt-3">
                <button type="submit" class="btn btn-primary" login="<?php if (isset($_SESSION['loginStr'])) {
                                                                                                        echo $_SESSION['loginStr'];
                                                                                                    } ?>">SIGN IN</button>
                  </div> 
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check" methode="POST" id="formlogin">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      
                    </label>
                  </div>
                  <a href="../../utama.php" class="auth-link text-black">Back</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <script>
    let errormsg = document.getElementById("errormsg");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let hide = document.getElementById("hide");
    let form = document.getElementById("formlogin");
  </script>
</body>

</html>
