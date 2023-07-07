<?php
require_once "../../Config/Database.php";

$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

$sql = "DELETE FROM pesanan WHERE id_pesanan = $id;";
$conn->query($sql);
