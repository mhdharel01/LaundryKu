<?php
session_start();
require_once "../../Config/Database.php";
require_once "../../Helper/functions.php";
$conn = getConnection();

$nama_customer = $_POST["nama_customer"];
$alamat = $_POST["alamat"];
$no_telp = $_POST["no_telp"];
$username = getName(10);

// $sql = "INSERT INTO pesanan(nama_pesanan,`tanggal_masuk_pesanan`,`tanggal_keluar_pesanan`,`status_pesanan`,`id_customer`,`berat_pesanan`,`jenis_paket`,`status_pembayaran`) VALUES($nama_pesanan, $tgl_masuk, $tgl_keluar, $status_pesanan, $id, $berat, $jenis_paket, $status_bayar);";

$sql = "INSERT INTO `customer` (`nama`, `alamat`, `no_telp`) VALUES
('$nama_customer', '$alamat', '$no_telp');";

$conn->query($sql);
$conn->errorInfo();
