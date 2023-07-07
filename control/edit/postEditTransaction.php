<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pesanan = $_POST["edit_judul_pesanan"];
    echo $nama_pesanan;
    $id_nama = $_POST["edit_id_nama"];
    $id_nama_arr = explode(" - ", $id_nama);
    $id = $id_nama_arr[0];
    $id_pesanan = $_POST["edit_no_order"];
    $nama = $id_nama_arr[1];
    $status_bayar = $_POST["edit_status_bayar"];
    $status_pesanan = $_POST["edit_status_pesanan"];
    echo $status_pesanan;
    $jenis_paket = $_POST["edit_jenis_paket"];
    $pewangi = $_POST["edit_pewangi"];
    $berat = $_POST["edit_berat"];
    $tgl_masuk = date("Y-m-d", strtotime($_POST["edit_tgl_masuk"]));
    $tgl_keluar = date("Y-m-d", strtotime($_POST["edit_tgl_keluar"]));

    $sql = "UPDATE pesanan SET nama_pesanan = '$nama_pesanan' ,  tanggal_masuk_pesanan = '$tgl_masuk' , tanggal_keluar_pesanan = '$tgl_keluar', status_pesanan = $status_pesanan , pewangi = $pewangi,  berat_pesanan = $berat, jenis_paket = $jenis_paket, status_pembayaran = $status_bayar, id_customer = $id WHERE id_pesanan = $id_pesanan ;";

    // $conn->query($sql);
    $conn->exec($sql);
}
