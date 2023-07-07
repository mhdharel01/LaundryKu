<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();

$nama_paket = $_POST["nama_paket"];
$harga = $_POST["harga"];
$id_paket = $_POST['id_paket'];

// $sql = "INSERT INTO pesanan(nama_pesanan,`tanggal_masuk_pesanan`,`tanggal_keluar_pesanan`,`status_pesanan`,`id_customer`,`berat_pesanan`,`jenis_paket`,`status_pembayaran`) VALUES($nama_pesanan, $tgl_masuk, $tgl_keluar, $status_pesanan, $id, $berat, $jenis_paket, $status_bayar);";

$sql = "INSERT INTO `paket_laundry` (`kategori`, `harga`, `id_paket`) VALUES
('$nama_paket', '$harga', $id_paket);";

$conn->query($sql);
$conn->errorInfo();
