<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();

$nama_pesanan = $_POST["judul_pesanan"];
$id_nama = $_POST["id_nama"];
$id_nama_arr = explode(" - ", $id_nama);
$id = $id_nama_arr[0];
$nama = $id_nama_arr[1];
$status_bayar = $_POST["status_bayar"];
$status_pesanan = $_POST["status_pesanan"];
$jenis_paket = $_POST["jenis_paket"];
$pewangi = $_POST["pewangi"];
$karyawan = $_POST["karyawan"];
$berat = $_POST["berat"];
$tgl_masuk = date("Y-m-d", strtotime($_POST["tgl_masuk"]));
$tgl_keluar = date("Y-m-d", strtotime($_POST["tgl_keluar"]));

$sqlSelectIdPesanan = "SELECT MAX(id_pesanan) 'id_pesanan' FROM pesanan;";
$stateSelectIdPesanan = $conn->query($sqlSelectIdPesanan);
$row = $stateSelectIdPesanan->fetch(PDO::FETCH_ASSOC);
$nextId = $row["id_pesanan"] + 1;
$alphabet = chr(65 + ($nextId - 1) % 26);
$no_order = $alphabet . str_pad($nextId, 4, '0', STR_PAD_LEFT);

$sql = "INSERT INTO pesanan (id_pesanan, nama_pesanan, tanggal_masuk_pesanan, tanggal_keluar_pesanan, status_pesanan, id_customer, berat_pesanan, jenis_paket, pewangi, status_pembayaran, karyawan_id) VALUES
(:id_pesanan, :nama_pesanan, :tgl_masuk, :tgl_keluar, :status_pesanan, :id, :berat, :jenis_paket, :pewangi, :status_bayar, :karyawan)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_pesanan', $no_order);
$stmt->bindParam(':nama_pesanan', $nama_pesanan);
$stmt->bindParam(':tgl_masuk', $tgl_masuk);
$stmt->bindParam(':tgl_keluar', $tgl_keluar);
$stmt->bindParam(':status_pesanan', $status_pesanan);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':berat', $berat);
$stmt->bindParam(':jenis_paket', $jenis_paket);
$stmt->bindParam(':pewangi', $pewangi);
$stmt->bindParam(':status_bayar', $status_bayar);
$stmt->bindParam(':karyawan', $karyawan);

$stmt->execute();

$errorInfo = $stmt->errorInfo();
if ($errorInfo[0] !== '00000') {
    echo "Error: " . $errorInfo[2];
} else {
    echo "Data berhasil disimpan.";
}
?>

