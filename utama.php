<?php
session_start();


require_once "Config/Database.php";
require_once "Helper/functions.php";
require "cari_data.php";

$conn = getConnection();

// Get total customer 
$jmlCustomerSql = "SELECT * FROM customer;";
$jmlCustomerState = $conn->query($jmlCustomerSql);
$jmlCustomerAngka = $jmlCustomerState->rowCount();

// Get total pemasukan
$totalPemasukanSql = "SELECT SUM(p.berat_pesanan * pl.harga) 'total' FROM pesanan p JOIN paket_laundry pl ON (p.jenis_paket = pl.id_paket) GROUP BY 'total';";
$totalPemasukanState = $conn->query($totalPemasukanSql);
$totalPemasukanAngka = $totalPemasukanState->fetch();

$totalPemasukanAngka = rupiah($totalPemasukanAngka['total']);

// Get total transaction
$totalTransactionSql = "SELECT * FROM pesanan";
$totalTransactionState = $conn->query($totalTransactionSql);
$totalTransactionAngka = $totalTransactionState->rowCount();

// Get total karyawan
$totalKaryawanSql = "SELECT * FROM karyawan";
$totalKaryawanState = $conn->query($totalKaryawanSql);
$totalKaryawanAngka = $totalKaryawanState->rowCount();

// Get total pewangi
$totalKaryawanSql = "SELECT * FROM parfum";
$totalKaryawanState = $conn->query($totalKaryawanSql);
$totalParfumAngka = $totalKaryawanState->rowCount();


$no = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home - Laundry</title>
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
</head>

<body class="index-page" data-bs-spy="scroll" data-bs-target="#navmenu">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>LaundryKu</h1>
        <span>.</span>
      </a>

      <!-- Nav Menu -->
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="utama.php#hero" class="active">Home</a></li>
          <li><a href="utama.php#about">About</a></li>
          <li><a href="utama.php#transaksi">Cek Order</a></li>
          <li><a href="utama.php#services">Features</a></li>
          <li><a href="utama.php#team">Team</a></li>
          <li><a href="utama.php#contact">Contact</a></li>
        </ul>

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav><!-- End Nav Menu -->

      <a class="btn-getstarted" href="pages/login/loginv2.php">login</a>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- Hero Section - Home Page -->
    <section id="hero" class="hero">
    <img src="assets/img/hero-bg-2.png" alt="" data-aos="fade-in">
    <div class="container">
      <div class="row">
        <div class="col-lg-10">
          <h2 data-aos="fade-up" data-aos-delay="100">Welcome to LaundryKu</h2>
          <p data-aos="fade-up" data-aos-delay="200">Bergabunglah dengan LaundryKu dan rasakan perbedaan nyata dalam melayani laundry Anda.</p>
        </div>
        <div class="col-lg-5">
          <form id="searchForm" class="sign-up-form" data-aos="fade-up" data-aos-delay="300">
            <div class="input-group">
              <input id="searchInput" type="text" class="form-control" placeholder="No Order">
              <button href="utama.php#transaksi" type="submit" class="btn btn-primary btn-sm aksi-btn tambah-btn" >Cari</button>
            </div>
          </form>
        </div>
      </div>    
    
  </section>

  

    <!-- About Section - Home Page -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">

          <div class="col-xl-5 content">
            <h3>About Us</h3>
            <h2>LaundryKu</h2>
            <p>LaundryKu merupakan sebuah website yang menghadirkan sistem informasi untuk memudahkan pengelola usaha laundry secara online. LaundryKu dapat menyimpan informasi pelanggan, daftar layanan, jadwal pengambilan, dan menyimpan serta menampilkan laporan pengelolaan bisnis. Dengan LaundryKu, pengelola dapat mengelola bisnis laundry dengan lebih efisien dan produktif.</p>
          </div>

          <div class="col-xl-7">
            <div class="row gy-4 icon-boxes">

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box">
                  <i class="bi bi-gear-wide-connected"></i>
                  <h3>Efisiensi Operasional</h3>
                  <p>Meningkatkan efisiensi operasional dalam bisnis laundry dan membantu di tingkat manajemen untuk mengambil keputusan yang tepat melalui penggunaan sistem informasi manajemen yang efektif.</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-person-up"></i>
                  <h3>Kepuasan Pelanggan</h3>
                  <p>Meningkatkan kepuasan pelanggan dan mempertahankan pelanggan yang ada serta menarik pelanggan baru melalui penyediaan layanan yang lebih baik dan lebih cepat.</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-coin"></i>
                  <h3>Biaya Operasional</h3>
                  <p>Mengurangi biaya operasional dan meningkatkan profitabilitas bisnis laundry dengan memperbaiki manajemen inventaris, mengoptimalkan jadwal kerja, dan mengurangi kesalahan manusia.</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-graph-up-arrow"></i>
                  <h3>Keputusan Bisnis</h3>
                  <p>Meningkatkan pengambilan keputusan bisnis yang lebih cerdas dan efektif denganmenggunakan sistem informasi manajemen laundry yang akurat dan real-time.</p>
                </div>
              </div> <!-- End Icon Box -->

            </div>
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- Stats Section - Home Page -->
    <section id="stats" class="stats">

      <img src="assets/img/hero-bg-1.jpeg" alt="" data-aos="fade-in">

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-3">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?= $jmlCustomerAngka ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Customer</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?= $totalTransactionAngka ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Trensaksi</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?= $totalParfumAngka ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Parfum</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?= $totalKaryawanAngka ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>karyawan</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- End Stats Section -->

    <section id="transaksi" class="contact">

    <div class="container section-title" data-aos="fade-up">
      <h2>Cek Order</h2>
      <p>Terima kasih telah melakukan pemesanan di LaundryKu. Kami menghargai dukungan dan kepercayaan Anda kepada kami.</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row">
            <div class="col">
              <div class="table-responsive">
                <table id="resultTable" class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Order</th>
                    <th>Customer</th>
                    <th>Karyawan</th>
                    <th>Nama Pesanan</th>
                    <th>Tgl Masuk</th>
                    <th>Tgl Keluar</th>
                    <th>Status Pesan</th>
                    <th>Status Bayar</th>
                    <th>Paket</th>
                    <th>Pewangi</th>
                    <th>Berat</th>
                    <th>Harga</th>
                  </tr>
                </thead>
                <tbody id="resultTableBody"></tbody>
              </table>
              </div>
              
            </div>
          </div>

    </section><!-- End Contact Section -->

    <!-- Services Section - Home Page -->
    <section id="services" class="services">

      <!--  Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Features</h2>
        <p>Selamat datang di LaundryKu! Kami bangga menyajikan sejumlah fitur yang dirancang untuk memberikan kemudahan penguna. </p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="400">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-binoculars"></i></div>
              <div>
                <h4 class="title"><a >Dashboard</a></h4>
                <p class="description">menampilkan jumlah pesanan, pendapatan, dan rata-rata rating pelanggan.</p>
              </div>
            </div>
          </div><!-- End Service Item -->
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="400">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-binoculars"></i></div>
              <div>
                <h4 class="title"><a >Manajemen user</a></h4>
                <p class="description">mengatur hak akses pengguna LaundryKu.</p>
              </div>
            </div>
          </div><!-- End Service Item -->
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="400">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-binoculars"></i></div>
              <div>
                <h4 class="title"><a >Transaks</a></h4>
                <p class="description">memantau dan mengelola transaksi bisnis laundry seperti pesanan yang masuk dan pembayaran yang diterima.</p>
              </div>
            </div>
          </div><!-- End Service Item -->
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="400">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-binoculars"></i></div>
              <div>
                <h4 class="title"><a >Customer</a></h4>
                <p class="description">menampilkan informasi pelanggan, seperti nama, alamat, dan riwayat pesanan.</p>
              </div>
            </div>
          </div><!-- End Service Item -->
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="400">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-binoculars"></i></div>
              <div>
                <h4 class="title"><a >Paket laundry</a></h4>
                <p class="description">menampilkan daftar layanan laundry yang tersedia.</p>
              </div>
            </div>
          </div><!-- End Service Item -->
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="400">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-binoculars"></i></div>
              <div>
                <h4 class="title"><a> Laporan</a></h4>
                <p class="description">informasi seperti total customer, pemasukan, transaksi, karyawan grafik pendapatan, paket terlaris, dan parfum terlaris dalam periode waktu tertentu.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- End Services Section -->

    <!-- Team Section - Home Page -->
    <section id="team" class="team">

      <!--  Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Orang-orang yang berpartisipasi dalam website ini .</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-3">

          <div class="col-lg-3 col-md-5 member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
              <img src="assets/img/team/team-7.jpg" class="img-fluid" alt="">
            </div>
            <div class="member-info text-center">
              <h4>Muhammad Harel</h4>
              <span>Leader</span>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-3 col-md-5 member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
              <img src="assets/img/team/team-8.jpg" class="img-fluid" alt="">
            </div>
            <div class="member-info text-center">
              <h4>Muhammad Ivander Ramusta</h4>
              <span>Member</span>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-3 col-md-5 member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
              <img src="assets/img/team/team-10.jpg" class="img-fluid" alt="">
            </div>
            <div class="member-info text-center">
              <h4>Nabila Okta Emiliana</h4>
              <span>Member</span>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-3 col-md-5 member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
              <img src="assets/img/team/team-9.jpg" class="img-fluid" alt="">
            </div>
            <div class="member-info text-center">
              <h4>Muhammad Ridky Mustofa</h4>
              <span>Member</span>
              
            </div>
          </div><!-- End Team Member -->
          

         
        </div>

      </div>

    </section><!-- End Team Section -->
    <!-- Contact Section - Home Page -->
    <section id="contact" class="contact">

      <!--  Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>A108 Adam Street</p>
                  <p>New York, NY 535022</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55</p>
                  <p>+1 6678 254445 41</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>info@example.com</p>
                  <p>contact@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>Monday - Friday</p>
                  <p>9:00AM - 05:00PM</p>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- End Contact Section -->

  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span>LaundryKu</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>A108 Adam Street</p>
          <p>New York, NY 535022</p>
          <p>United States</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>&copy; <span>Copyright</span> <strong class="px-1">2023</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        
       
      </div>
    </div>

  </footer><!-- End Footer -->

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
  // Handle form submission
  document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent form submission

    var searchInput = document.getElementById('searchInput').value;
    window.location.href = 'utama.php#transaksi';
    // Send AJAX request to cari_data.php
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var result = JSON.parse(xhr.responseText);
        displaySearchResults(result);
      }
    };
    xhr.open('POST', 'cari_data.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('searchInput=' + searchInput);
  });

  // Display search results in the table
  function displaySearchResults(data) {
    var resultTableBody = document.getElementById('resultTableBody');
    resultTableBody.innerHTML = '';

    if (data.length > 0) {
      var tableRows = '';
      for (var i = 0; i < data.length; i++) {
        var row = data[i];
        var no = i + 1;
        var no_order = generateNoOrder(row.id_p);

        tableRows += '<tr>';
        tableRows += '<td>' + no + '</td>';
        tableRows += '<td>' + no_order + '</td>';
        tableRows += '<td>' + row.nama + '</td>';
        tableRows += '<td>' + row.karyawan + '</td>';
        tableRows += '<td>' + row.nama_pesanan + '</td>';
        tableRows += '<td>' + row['tgl_masuk'] + '</td>';
        tableRows += '<td>' + row['tgl_keluar'] + '</td>';
        tableRows += '<td>' + getStatusPesananLabel(row.id_status_pesanan) + '</td>';
        tableRows += '<td>' + getStatusPembayaranLabel(row.bayar) + '</td>';
        tableRows += '<td>' + row.jenis_paket + '</td>';
        tableRows += '<td>' + row.pewangi + '</td>';
        tableRows += '<td>' + row.berat + '</td>';
        tableRows += '<td>' + row.harga + '</td>';
        tableRows += '</tr>';
      }
      resultTableBody.innerHTML = tableRows;
    } else {
      document.getElementById('informasi').textContent = 'Data not found';
    }
  }

  // Generate No Order based on ID
  function generateNoOrder(id) {
    var alphabet = String.fromCharCode(65 + (id - 1) % 26);
    var paddedNumber = id.toString().padStart(4, '0');
    return alphabet + paddedNumber;
  }

  // Get status pesanan label
  function getStatusPesananLabel(idStatus) {
    if (idStatus == 1) {
      return '<span class="badge bg-warning">PROSES</span>';
    } else {
      return '<span class="badge bg-success">SELESAI</span>';
    }
  }

  // Get status pembayaran label
  function getStatusPembayaranLabel(statusBayar) {
    if (statusBayar == 1) {
      return '<span class="badge bg-warning">BELUM BAYAR</span>';
    } else {
      return '<span class="badge bg-success">LUNAS</span>';
    }
  }

  
</script>


  
</body>

</html>