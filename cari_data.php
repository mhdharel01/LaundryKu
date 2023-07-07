<?php

require_once "Config/Database.php";
require_once "Helper/functions.php";

$conn = getConnection();

$hasil = [];

if (isset($_POST['searchInput'])) {
  $searchInput = $_POST['searchInput'];
  $searchQuery = "SELECT p.id_pesanan 'id_p', c.nama 'nama', p.nama_pesanan 'nama_pesanan', p.tanggal_masuk_pesanan 'tgl_masuk', p.tanggal_keluar_pesanan 'tgl_keluar', p.status_pesanan 'id_status_pesanan', p.status_pembayaran 'bayar',pr.nama 'pewangi', p.berat_pesanan 'berat', (p.berat_pesanan * pk.harga) 'harga',k.nama 'karyawan', pk.kategori 'jenis_paket'
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
  WHERE p.id_pesanan = ?";
  $stmt = $conn->prepare($searchQuery);
  $stmt->execute([$searchInput]);
  $hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($hasil);
}


