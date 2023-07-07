<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();

$nama_parfum = $_POST["nama"];
$id_parfum = $_POST['id_parfum'];

// $sql = "INSERT INTO pesanan(nama_pesanan,`tanggal_masuk_pesanan`,`tanggal_keluar_pesanan`,`status_pesanan`,`id_customer`,`berat_pesanan`,`jenis_paket`,`status_pembayaran`) VALUES($nama_pesanan, $tgl_masuk, $tgl_keluar, $status_pesanan, $id, $berat, $jenis_paket, $status_bayar);";

$sql = "INSERT INTO `parfum` (`nama`, `id_parfum`) VALUES
('$nama_parfum', $id_parfum);";

$conn->query($sql);
$conn->errorInfo();