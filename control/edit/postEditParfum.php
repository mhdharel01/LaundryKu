<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_parfum = $_POST["edit_id_parfum"];
    $nama_parfum = $_POST['edit_nama_parfum'];
    

    $sql = "UPDATE parfum SET nama = '$nama_parfum' WHERE id_parfum = $id_parfum;";

    // $conn->query($sql);
    $conn->exec($sql);
}
