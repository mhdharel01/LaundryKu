<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paket = $_POST["edit_id_paket"];
    $nama_paket = $_POST['edit_nama_paket'];
    $harga = $_POST['edit_harga'];

    $sql = "UPDATE paket_laundry SET kategori = '$nama_paket' , harga = '$harga' WHERE id_paket = $id_paket;";

    // $conn->query($sql);
    $conn->exec($sql);
}
