<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();

$nama_karyawan = $_POST["nama_karyawan"];
$email = $_POST["email"];
$no_telp = $_POST["no_telp"];
$password = $_POST["password"];

// $sql = "INSERT INTO pesanan(nama_pesanan,`tanggal_masuk_pesanan`,`tanggal_keluar_pesanan`,`status_pesanan`,`id_customer`,`berat_pesanan`,`jenis_paket`,`status_pembayaran`) VALUES($nama_pesanan, $tgl_masuk, $tgl_keluar, $status_pesanan, $id, $berat, $jenis_paket, $status_bayar);";

$sql = "INSERT INTO `karyawan` (`nama`, `email`, `no_telepon`,`role`, `password`) VALUES
('$nama_karyawan', '$email', '$no_telp',1, '$password');";

$conn->query($sql);
$conn->errorInfo();
