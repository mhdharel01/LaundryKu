<?php
require_once "../../Config/Database.php";

$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

$sql = "DELETE FROM parfum WHERE id_parfum = $id;";
$conn->query($sql);
