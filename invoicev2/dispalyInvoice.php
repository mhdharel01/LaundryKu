<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();

$customer_id = $_POST['customer_id'];
// echo("<h1> customer_id: " . $customer_id . "</h1>");

if (isset($_POST['customer_id'])) {
    $id = $_POST['customer_id'];
  
    $sql = "SELECT customer.nama 'nama',customer.alamat'alamat',customer.no_telp'nomor hp', nama_pesanan, id_pesanan, customer.id_customer 'id_customer' , pesanan.status_pembayaran 'bayar', status_pesanan, jenis_paket, berat_pesanan, tanggal_masuk_pesanan, tanggal_keluar_pesanan ,parfum.nama'pewangi', paket_laundry.harga'harga', (pesanan.berat_pesanan * paket_laundry.harga) 'total_harga' FROM pesanan JOIN customer ON (pesanan.id_customer = customer.id_customer) JOIN parfum  ON (pesanan.pewangi  = parfum.id_parfum) JOIN paket_laundry  ON(paket_laundry.id_paket = pesanan.jenis_paket) JOIN status_pembayaran  ON(pesanan.status_pembayaran = status_pembayaran.id_pembayaran)WHERE id_pesanan = $id;";
    $hasil = $conn->query($sql);
    $hasil->execute();
    $hasilSatu = $hasil->fetch();

    $nama_customer = $hasilSatu["nama"];
    $nama_pesanan = $hasilSatu["nama_pesanan"];
    $alamat = $hasilSatu["alamat"];
    $telfon = $hasilSatu["nomor hp"];
    $id_customer = $hasilSatu["id_customer"];
    $id = $hasilSatu["id_pesanan"];
    $status_bayar = $hasilSatu["bayar"];
    $status_pesanan = $hasilSatu["status_pesanan"];
    $jenis_paket = $hasilSatu["jenis_paket"];
    $berat = $hasilSatu["berat_pesanan"];
    $tgl_masuk = ($hasilSatu["tanggal_masuk_pesanan"]);
    $tgl_keluar = ($hasilSatu["tanggal_keluar_pesanan"]);
    $pewangi = ($hasilSatu["pewangi"]);
    $harga = ($hasilSatu["harga"]);
    $total_harga = ($hasilSatu["total_harga"]);
    $tgl_masuk_html = date("d-m-Y", strtotime($tgl_masuk));
    $tgl_keluar_html = date("d-m-Y", strtotime($tgl_keluar));
    $no =1 ;
    
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}


?>


<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
  rel="stylesheet"
/>
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<div class="card" id="ditailInvoiveModal">
  <div class="card-body">
    <div class="container mb-5 mt-3">
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
          <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID:</strong><?= $id?> </p>
        </div>
        <hr>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-xl-6">
            <ul class="list-unstyled">
              <li class="text-muted">To: <span style="color:#5d9fc5 ;"> <?= $nama_customer ?></span></li>
              <li class="text-muted"><?= $alamat?></li>
              <li class="text-muted"><i class="fas fa-phone"></i> <?= $telfon?></li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Invoice</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">ID:</span>#123-456</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">tanggal masuk: <?= $tgl_masuk_html ?></span></li>
            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">tanggal ambil: <?= $tgl_keluar_html ?></span></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="me-1 fw-bold">Status:</span><span>
                 <?php  if ($status_bayar == 1 ){
                    echo "<span class='badge bg-warning'>BELUM BAYAR</span>";
                    }else{
                      echo"<span class='badge bg-success'>LUNAS</span>";;
                    }?></span></li>
              </ul>
          </div>
        </div>
      
        <div class="row my-2 mx-1 justify-content-center" id="dispalyinvoice">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA ;" class="text-white">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pesanan</th>
                <th scope="col">Jenis Pesanan</th>
                <th scope="col">Jenis Pewangi</th>
                <th scope="col">Berat</th>
                <th scope="col">Harga</th>
              </tr>
            </thead>
            <tbody>
            
              <tr>
                <td><?php echo $no ?></td>
                <?php $no++; ?>
                <td><?= $nama_pesanan?></td>
                <td><?= $jenis_paket ?></td>
                <td><?= $pewangi?></td>
                <td><?= $berat?></td>
                <td><?= rupiah($harga) ?></td>
              </tr>
            </tbody>
          
          </table>
        </div>
        <div class="row">
          <div class="col-xl-9">
            <p class="ms-3">Add additional notes and payment information</p>

          </div>
         
          <div class="col-xl-3">
            <p class="text-black float-start"><span > Total Semua :<?= rupiah($total_harga) ?></span></p>
          </div>
      
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-10">
            <p>Thank you for your purchase</p>
          </div>
          <div class="col-xl-2">
          <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark" href="javascript:window.print()"><i
              class="fas fa-print text-primary" ></i> Print</a>
          <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
              class="far fa-file-pdf text-danger"></i> Export</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</body>
</html>

