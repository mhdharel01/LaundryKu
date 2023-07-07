<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_customer = $_POST["edit_id_customer"];
    $nama_customer = $_POST['edit_nama_customer'];
    $alamat = $_POST['edit_alamat'];
    $no_telp = $_POST['edit_no_telp'];

    $sql = "UPDATE customer SET nama = '$nama_customer' ,  alamat = '$alamat' , no_telp = '$no_telp' WHERE id_customer = $id_customer;";

    // $conn->query($sql);
    $conn->exec($sql);
}
