<?php
require_once "../../Config/Database.php";

$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

$sql = "DELETE FROM customer WHERE id_customer = $id;";
$conn->query($sql);
