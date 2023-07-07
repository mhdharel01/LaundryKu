<?php
session_start();
if ($_SESSION['login'] != true) {
  header("Location: login.php");
  exit();
}


require_once "../../Config/Database.php";
require_once "../../Helper/functions.php";

$conn = getConnection();
$sql = "SELECT p.id_pesanan 'id_p', c.nama 'nama', p.nama_pesanan 'nama_pesanan', p.tanggal_masuk_pesanan 'tgl-masuk', p.tanggal_keluar_pesanan 'tgl-keluar', p.status_pesanan 'id_status_pesanan', p.status_pembayaran 'bayar',pr.nama 'pewangi', p.berat_pesanan 'berat', (p.berat_pesanan * pk.harga) 'harga',k.nama 'karyawan', pk.kategori 'jenis_paket'
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
ORDER BY p.tanggal_masuk_pesanan; ";
$hasil = $conn->query($sql);

// Get user's name
$email = $_SESSION['email'];
$namasql = "SELECT nama FROM karyawan WHERE email = ?;";
$hasilNama = $conn->prepare($namasql);
$hasilNama->execute([$email]);

$nama = $hasilNama->fetch();

$no = 1;
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
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
       <!-- MODAL -->
    <div class="modal fade" id="newUserModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <form id="newTransactionForm" method="post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">No Order</label>
                    <select class="form-select" name="no_order" id="ID" disabled>
                      <?php
                      $sqlSelectIdPesanan = "SELECT MAX(id_pesanan) 'id_pesanan' FROM pesanan;";
                      $stateSelectIdPesanan = $conn->query($sqlSelectIdPesanan);
                      foreach ($stateSelectIdPesanan as $row) {
                        $nextId = $row["id_pesanan"] + 1;
                        $alphabet = chr(65 + ($nextId - 1) % 26); 
                        $paddedNumber = str_pad($nextId, 4, '0', STR_PAD_LEFT); 
                        $result = $alphabet . $paddedNumber;
                      ?>
                        <option value="<?= $nextId ?>"><?= $result ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Nama Pesanan</label>
                    <input name="judul_pesanan" id="judul_pesanan" type="text" class="form-control" placeholder="Nama Pesanan">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">ID - Nama Customer</label>
                    <select class="form-select" name="id_nama" id="id_nama">
                      <option value="">- Masukkan ID & Nama -</option>
                      <?php $sqlSelectIdNama = "SELECT CONCAT(c.id_customer, ' - ', c.nama) 'id_nama' FROM customer c;";
                      $stateSelectIdNama = $conn->query($sqlSelectIdNama);
                      foreach ($stateSelectIdNama as $row) {
                      ?>
                        <option value="<?php echo $row["id_nama"] ?>"><?php echo $row["id_nama"] ?> </option> <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Karyawan</label>
                    <select class="form-select" name="karyawan" id="karyawan">
                      <option value="">- ID Karyawan -</option>
                      <?php $sqlSelectKarywan = "SELECT nama, id_karyawan FROM karyawan;";
                      $stateSelectKaryawan = $conn->query($sqlSelectKarywan);
                      foreach ($stateSelectKaryawan as $row) {
                      ?>
                        <option value="<?php echo $row["id_karyawan"] ?>"><?php echo $row["nama"] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Status Pembayaran</label>
                    <select class="form-select" name="status_bayar" id="status_bayar">
                      <option value="">- Pilih Status Pembayaran -</option>
                      <option value="2">Lunas</option>
                      <option value="1">Belum Bayar</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Status Pesanan</label>
                    <select class="form-select" name="status_pesanan" id="status_pesanan">
                      <option value="">- Pilih Status Pesanan -</option>
                      <option value="1">Diproses</option>
                      <option value="2">Selesai</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Paket</label>
                    <select class="form-select" name="jenis_paket" id="jenis_paket">
                      <option value="">- Pilih Paket -</option>
                      <?php $sqlSelectPaket = "SELECT kategori, id_paket FROM paket_laundry;";
                      $stateSelectPaket = $conn->query($sqlSelectPaket);
                      foreach ($stateSelectPaket as $row) {
                      ?>
                        <option value="<?php echo $row["id_paket"] ?>"><?php echo $row["kategori"] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Pewangi</label>
                    <select class="form-select" name="pewangi" id="pewangi">
                      <option value="">- Pilih pewangi -</option>
                      <?php $sqlSelectPaket = "SELECT nama, id_parfum FROM parfum;";
                      $stateSelectPaket = $conn->query($sqlSelectPaket);
                      foreach ($stateSelectPaket as $row) {
                      ?>
                        <option value="<?php echo $row["id_parfum"] ?>"><?php echo $row["nama"] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Berat (kg)</label>
                    <input class="form-control" type="text" name="berat" id="berat" placeholder="Berat (kg)">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Tanggal Masuk</label>
                    <input class="form-control" type="date" name="tgl_masuk" id="tgl_masuk">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Tanggal Keluar</label>
                    <input class="form-control" type="date" name="tgl_keluar" id="tgl_keluar">
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
    <div id="display-transaction"></div>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                  <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                        <div>
                          <h4 class="card-title card-title-dash">List Transaksi</h4>
                        </div>
                        <div>
                        <button data-bs-toggle="modal" data-bs-target="#newUserModal" class="btn btn-primary btn-sm text-white aksi-btn tambah-btn" type="button"><i class="mdi mdi-account-plus menu-icon"></i></button>
                        </div>
                      </div>
                      <div><h4></h4></div>
                      <div class="table-responsive">
                      <table id="dt" class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>No Order</th>
                            <th>Customer</th>
                            <th>Karyawan</th>
                            <th>Nama pesanan</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl keluar</th>
                            <th>Status Pesanan</th>
                            <th>Status Pembayaran</th>
                            <th>Jenis Paket</th>
                            <th>Pewangi</th>
                            <th>Berat(Kg)</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($hasil as $row) { ?>
                          <tr>
                            <td><?php echo $no ?></td>
                            <?php $no++; ?>
                            <?php
                            $nextId = $row['id_p'];
                            $alphabet = chr(65 + ($nextId - 1) % 26);
                            $paddedNumber = str_pad($nextId, 4, '0', STR_PAD_LEFT);
                            $no_order = $alphabet . $paddedNumber;
                            ?>
                            <td><?php echo $no_order ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php echo $row['karyawan'] ?></td>
                            <td><?php echo $row['nama_pesanan'] ?></td>
                            <td><?php echo $row['tgl-masuk'] ?></td>
                            <td><?php echo $row['tgl-keluar'] ?></td>
                            <td>
                              <?php if ($row["id_status_pesanan"] == 1) {
                                echo "<span class='badge bg-warning'>PROSES</span>";
                              } else {
                                echo "<span class='badge bg-success'>SELESAI</span>";
                              } ?>
                            </td>
                            <td>
                              <?php if ($row['bayar'] == 1) {
                                echo "<span class='badge bg-warning'>BELUM BAYAR</span>";
                              } else {
                                echo "<span class='badge bg-success'>LUNAS</span>";
                              } ?>
                            </td>
                            <td><?php echo $row['jenis_paket'] ?></td>
                            <td><?php echo $row['pewangi'] ?></td>
                            <td><?php echo $row['berat'] ?></td>
                            <td><?php echo rupiah($row['harga']) ?></td>
                            <td>
                              <form action="../../invoicev2/dispalyInvoice.php" method="post">
                                <button type="submit" class="btn btn-outline-success waves-effect waves-light active aksi-btn"><i class="mdi mdi-receipt-text-check"></i></button>
                                <a type="button" class="btn btn-outline-primary waves-effect waves-light active aksi-btn edit" id="<?= $row['id_p'] ?>"><i class="mdi mdi-database-edit-outline"></i></a>
                                <a type="button" class="btn btn-outline-danger waves-effect waves-light active aksi-btn hapus" id="<?= $row['id_p'] ?>"><i class="mdi mdi-trash-can"></i></a>
                                <input type="hidden" name="customer_id" id="customer_id" value=<?php echo ($row['id_p']) ?>>
                              </form>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
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
    // Modal
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
      //edit
      $(document).on("click", ".edit", function() {
        const id = $(this).attr('id');

        $("#display-transaction").html("");
        $.ajax({
          url: "../../control/display/displayEditTransaction.php",
          type: "POST",
          data: {
            id: id
          },
          cache: false,
          success: function(data) {
            $("#display-transaction").html(data);
            $("#editTransactionModal").modal("show");
          }
        })

      })

       //ditail
       $(document).on("click", ".ditail", function() {
        const id = $(this).attr('id');

        $("#display-transaction").html("");
        $.ajax({
          url: "../../invoicev2/displayIncoive.php",
          type: "POST",
          data: {
            id: id
          },
          cache: false,
          success: function(data) {
            $("#display-transaction").html(data);
            $("#dispalyinvoice").modal("show");
          }
        })

      })
      //hapus
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
              url: "../../control/hapus/deleteTransaction.php",
              type: 'POST',
              data: {
                id: id
              },
              success: function(data) {
                Swal.fire(
                  'Data terhapus!',
                  'Data transaksi telah terhapus.',
                  'success'
                ).then(() => {
                  window.location.reload();
                })
              }

            })
          }
        })
      })

      //tambah transaksi
      $("#newTransactionForm").submit(function(e) {
        e.preventDefault();
        const judul_pesanan = $("#judul_pesanan").val();
        const id_nama = $("#id_nama option:selected").val();
        const status_bayar = $("#status_bayar option:selected").val();
        const status_pesanan = $("#status_pesanan option:selected").val();
        const jenis_paket = $("#jenis_paket option:selected").val();
        const pewangi = $("#pewangi option:selected").val();
        const berat = $("#berat").val();
        const tgl_masuk = $("#tgl_masuk").val();
        const tgl_keluar = $("#tgl_keluar").val();

        if (judul_pesanan == "" || id_nama == "" || status_bayar == "" || status_pesanan == "" || jenis_paket == ""|| pewangi == "" || berat == "" || tgl_masuk == "" || tgl_keluar == "") {
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
                url: '../../control/tambah/newTransaction.php',
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

  </script>
</body>
<!-- SWAL -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js"></script>

<!-- BS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- data tabel -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
</html>

