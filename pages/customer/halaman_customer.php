<?php
session_start();
require_once "../../Config/Database.php";


if ($_SESSION['login'] != true) {
  header("Location: pages/login/loginv2.php");
  exit();
}

$conn = getConnection();
$sql = "SELECT customer.id_customer 'id', customer.no_telp 'no-telp', customer.nama 'nama', customer.alamat 'alamat' FROM customer;";
$hasil = $conn->query($sql);

// $jmlh=$num+1;
//  $waktu=date('dmy');
// $nounik="REG-".$waktu.-$jmlh;

$no = 1;

// Get user's name
$email = $_SESSION['email'];
$namasql = "SELECT nama FROM karyawan WHERE email = ?;";
$hasilNama = $conn->prepare($namasql);
$hasilNama->execute([$email]);

$nama = $hasilNama->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Star Admin2 v2 </title>
  <!-- plugins:css -->
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
  <!-- swal -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <!-- data tabel -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="index.html">
            <img src="../../images/logo.svg" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="../../images/logo-mini.svg" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold"><?php echo $nama['nama'] ?></span></h1>
            <h3 class="welcome-sub-text">Your performance summary this week </h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li>
          <a href="../../logout.php"class="btn btn-danger btn-rounded btn-fw">
            <i class="mdi mdi-logout"></i> 
          </a>
          </li>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../dasboard.php">
              <i class="mdi mdi-view-dashboard menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-account-group"></i>
              <span class="menu-title">Manajemen user</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../pages/manajer user/halaman_karyawan.php">Karyawan</a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/manajer user/halaman_admin.php">Admin</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/transaksi/halaman_transaksi.php">
              <i class="mdi mdi-cash-multiple menu-icon"></i>
              <span class="menu-title">Transaksi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/customer/halaman_customer.php">
              <i class="mdi mdi-account-plus menu-icon"></i>
              <span class="menu-title">Customer</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/paket/halaman_paket.php">
              <i class="mdi mdi-shopping menu-icon"></i>
              <span class="menu-title">Paket Laundry</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="mdi mdi-cup-water  menu-icon"></i>
              <span class="menu-title">Parfum</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="mdi mdi-folder menu-icon"></i>
              <span class="menu-title">Laporan</span>
            </a>
          </li>
          
      </nav>
        <!-- Modal -->
      <div class="modal fade" id="newCustomerModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <form id="newCustomerForm" method="post">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">ID</label>
                      <select class="form-select" name="id_customer" id="id_customer" disabled>
                        <?php $sqlSelectIdCustomer = "SELECT MAX(id_customer) 'id_customer' FROM customer;";
                        $stateSelectIdCustomer = $conn->query($sqlSelectIdCustomer);
                        foreach ($stateSelectIdCustomer as $row) {
                        ?>
                          <option value="<?= $row["id_customer"] + 1 ?>"><?= $row["id_customer"] + 1 ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Nama Customer</label>
                      <input name="nama_customer" id="nama_customer" type="text" class="form-control" placeholder="Nama Customer">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Alamat</label>
                      <input class="form-control" type="text" name="alamat" id="alamat" placeholder="Alamat">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Nomor Telepon</label>
                      <input class="form-control" type="text" name="no_telp" id="no_telp" placeholder="Nomor Telepon">
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark active aksi-btn" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success active aksi-btn">Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- partial -->
      <div class="main-panel ">
        <div class="content-wrapper">
          <div class="row" >
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                  <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                        <div>
                          <h4 class="card-title card-title-dash">List Customer</h4>
                        </div>
                        <div>
                          <button data-bs-toggle="modal" data-bs-target="#newCustomerModal" class="btn btn-primary btn-sm text-white aksi-btn tambah-btn" type="button"><i class="mdi mdi-account-plus menu-icon"></i></button>
                        </div>
                      </div>
                      <div>
                    <h2></h2>
                      </div>
                    <div class="table-responsive">
                      <table class="table"id="dt"style="width:100%">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Nomor Telfon</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($hasil as $row) { ?>
                            <tr>
                            <td><?php echo $no++;?></td>
                            <!-- <td><?php echo $nounik ?></td> -->
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php echo $row['alamat'] ?></td>
                            <td><?php echo $row['no-telp'] ?></td>
                            <!-- <td><label class="badge badge-danger">Pending</label></td> -->
                            <td>
                            <!-- <button type="button" id="<?= $row['id'] ?>" class="btn btn-outline-primary active aksi-btn edit">
                              Edit
                            </button> -->
                            <a type="button"  class="btn btn-primary aksi-btn edit "id="<?= $row['id'] ?>"><i class="mdi mdi-database-edit "></i></a>
                            <a type="button" class="btn btn-warning aksi-btn hapus "id="<?= $row['id'] ?>"><i class="mdi mdi-trash-can"></i></a>
                            <!-- <button type="button" id="<?= $row['id'] ?>" class="btn btn-outline-danger active aksi-btn font-kecil hapus">
                              Hapus
                            </button> -->
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div id="display-customer"></div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/chart.js/Chart.min.js"></script>
  <script src="../../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/chart.js"></script>
  <!-- End custom js for this page-->
  <script>
    $(document).ready(function() {

      // Searching dengan datatables
      $('#dt').DataTable();
    
      // Logout
      $("#logout").click(function() {
        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Anda akan keluar dari halaman ini!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, keluar saja!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "Logout.php",
              type: "POST",
              success: function() {
                Swal.fire(
                  'Logout berhasil!',
                  'Anda akan keluar dari halaman karyawan.',
                  'success'
                ).then(() => {
                  window.location.href = "login.php";
                })
              }
            })
          }
        })
      })



      // Edit
      $(document).on("click", ".edit", function() {
        const id = $(this).attr('id');
        console.log(id);
        $("#display-customer").html("");
        $.ajax({
          url: "../../control/display/displayEditCustomer.php",
          type: "POST",
          data: {
            id: id
          },
          cache: false,
          success: function(data) {
            $("#display-customer").html(data);
            $("#editCustomerModal").modal("show");
          }
        })

      })

      // Hapus
      $(document).on("click", ".hapus", function() {
        const id = $(this).attr('id');

        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Anda tidak akan bisa mengembalikan data ini!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus saja!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "../../control/hapus/deleteCustomer.php",
              type: 'POST',
              data: {
                id: id
              },
              success: function(data) {
                Swal.fire(
                  'Data terhapus!',
                  'Data customer berhasil dihapus.',
                  'success'
                ).then(() => {
                  window.location.reload();
                })
              }

            })
          }
        })
      })
      


      $("#newCustomerForm").submit(function(e) {
        e.preventDefault();
        const nama_customer = $("#nama_customer").val();
        const alamat = $("#alamat").val();
        const no_telp = $("#no_telp").val();


        if (nama_customer == "" || alamat == "" || no_telp == "") {
          Swal.fire(
            "Masukan Salah!",
            "Isian data belum lengkap!",
            "error"
          )
          // alert("COK")
        } else {

          Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda akan menambahkan transaksi baru?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tambahkan!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: '../../control/tambah/newCustomer.php',
                type: 'POST',
                data: $(this).serialize(),
                cache: false,
                success: function(data) {
                  Swal.fire(
                    "Berhasil!",
                    "Penambahan transaksi baru berhasil!",
                    "success"
                  ).then(() => {
                    window.location.reload();
                  })
                }
              })
            }
          })

        }

      })
    })


    let sideBar = document.getElementById("menu");
    let subMenu = document.getElementById("subMenu");
    let slideBar = document.getElementById("slide-bar");
    let manajemen = document.getElementById("manajemen-li");
    let manajemenDrop = document.getElementById("manajemen");

    // let x = window.matchMedia("(max-width: 769px)");

    function toggleMenu() {
      // subMenu.subMenu.classList.toggle("open-menu");
      if (subMenu.style.maxHeight == "400px") {
        subMenu.style.maxHeight = "0px";
      } else {
        subMenu.style.maxHeight = "400px";
      }
    }

    $("#manajemen-li").click(function() {
      $("#manajemen").toggleClass("active2");
    });


    $("#slide-bar").click(function() {
      $("#menu").toggleClass("active");
    });

    $("#slide-bar").click(function() {
      $("#menu").toggleClass("activeWeb");
    });

    // PINDAH PAGE
    function pindahPage(namaPage) {
      window.location.href = namaPage;
    }
  </script>
   <!-- SWAL -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js"></script>

<!-- BS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- data tabel -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>

