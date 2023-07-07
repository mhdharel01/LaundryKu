<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_admin = $_POST["edit_id_admin"];
    $nama_admin = $_POST['edit_nama_admin'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $no_telp = $_POST['edit_no_telp'];

    $sql = "UPDATE karyawan SET nama = '$nama_admin' ,  email = '$email' , no_telepon = '$no_telp', `password` = '$password' WHERE id_karyawan = $id_admin;";

    // $conn->query($sql);
    $conn->exec($sql);
}
