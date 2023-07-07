<?php
session_start();
require_once "../../Config/Database.php";
require_once "../../Helper/functions.php";

if ($_SESSION['login'] != true) {
  header("Location: pages/login/loginv2.php");
  exit();
}

$conn = getConnection();

// Get user's name
$email = $_SESSION['email'];
$namasql = "SELECT nama FROM karyawan WHERE email = ?;";
$hasilNama = $conn->prepare($namasql);
$hasilNama->execute([$email]);

$nama = $hasilNama->fetch();

$hasil = array(); // Inisialisasi array hasil pencarian
$start_date = ''; // Inisialisasi tanggal awal
$end_date = ''; // Inisialisasi tanggal akhir
$total_harga = 0; // Inisialisasi total keseluruhan harga

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
  // Mengambil nilai dari form
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];

  // Query SQL dengan kondisi tanggal
  $sql = "SELECT p.id_pesanan 'id_p', c.nama 'nama', p.nama_pesanan 'nama_pesanan', p.tanggal_masuk_pesanan 'tgl-masuk', p.tanggal_keluar_pesanan 'tgl-keluar',  p.status_pesanan 'id_status_pesanan', p.status_pembayaran 'bayar',pr.nama 'pewangi', p.berat_pesanan 'berat', (p.berat_pesanan * pk.harga) 'harga',k.nama 'karyawan', pk.kategori 'jenis_paket'
          FROM pesanan p JOIN customer c 
          ON(c.id_customer = p.id_customer)
          JOIN paket_laundry pk
          ON(pk.id_paket = p.jenis_paket)
          JOIN status_pembayaran sp
          ON(p.status_pembayaran = sp.id_pembayaran)
          JOIN parfum pr
          ON (p.pewangi = pr.id_parfum)
          JOIN karyawan k
          ON (p.karyawan_id = k.id_karyawan)
          WHERE p.tanggal_masuk_pesanan BETWEEN ? AND ?
          ORDER BY p.tanggal_masuk_pesanan; ";

  $stmt = $conn->prepare($sql);
  $stmt->execute([$start_date, $end_date]);

  // Mengecek apakah query berhasil dieksekusi
  if ($stmt->rowCount() > 0) {
      // Mendapatkan data sebagai array asosiatif
      $hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Menghitung total keseluruhan harga
      foreach ($hasil as $row) {
          $total_harga += $row['harga'];
      }
  }
}

// Menutup koneksi
$conn = null;

$no =1;
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
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
</head>
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
            <a class="nav-link" href="#">
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
            <a class="nav-link" href="../../pages/parfum/halaman_parfum.php">
              <i class="mdi mdi-cup-water  menu-icon"></i>
              <span class="menu-title">Parfum</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"href="../../pages/laporan/halaman_laporan.php">
              <i class="mdi mdi-folder menu-icon"></i>
              <span class="menu-title">Laporan</span>
            </a>
          </li>
          
      </nav>
      <!-- Modal -->

      
      <!-- partial -->
      <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                  <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                      <h4 class="card-title card-title-dash">List Laporan <p class="text-success fw-bold"><?=$start_date?> <span class="text-black ">s/d </span><?=$end_date?></p> </h4>
                      
                      <div class="row">
                        <div class="col-lg-5">
                          <form class="form-inline" method="POST">
                            <div class="form-group mr-2">
                              <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group mr-2">
                            <input type="date" class="form-control" id="end_date" name="end_date">
                          </div>
                        </div>
                        <div class="col-lg-2">
                        <button type="submit" class="btn btn-success btn-sm aksi-btn tambah-btn" name="search"><i class="mdi mdi-magnify"></i></button>
                        </div>
                        </form>
                      </div>
                    </div>
                    
                    <div class="table-responsive">
                      <table id="dt" class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID pesanan</th>
                            <th>Customer</th>                      
                            <th>Nama pesanan</th>
                            <th>Tgl Masuk</th>
                            <th>jenis Paket</th>                           
                            <th>Berat(Kg)</th>
                            <th>Harga</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($hasil) && count($hasil) > 0) {
                            foreach ($hasil as $row) { ?>
                              <tr>
                                <td><?php echo $no ?></td>
                                <?php $no++; ?>
                                <td><?php echo $row['id_p'] ?></td>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['nama_pesanan'] ?></td>
                                <td><?php echo $row['tgl-masuk'] ?></td>
                                <td><?php echo $row['jenis_paket'] ?></td>
                                <td><?php echo $row['berat'] ?></td>
                                <td><?php echo rupiah($row['harga']) ?></td>
                              </tr>
                            <?php }
                          } else { ?>
                            <tr>
                              <td colspan="7">Tidak ada data yang ditampilkan.</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="row  align-items-center">
                      <div class="col"> <button type="button" class="btn btn-primary me-2" onclick="cetakLaporan()">Cetak Laporan</button></div>
                      <div class="col-lg-4"> <h5>Total Keseluruhan Harga: <span class="text-danger"><?php echo rupiah($total_harga); ?></span></h5></div>

                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
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
    $('#dt').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
    

   })


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

