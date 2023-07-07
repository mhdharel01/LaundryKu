<?php
require_once "../../Config/Database.php";

$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

$sql = "DELETE FROM paket_laundry WHERE id_paket = $id;";
$conn->query($sql);
