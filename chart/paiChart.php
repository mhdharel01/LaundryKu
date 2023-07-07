<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();
$sql = "SELECT parfum.nama, COUNT(pesanan.pewangi) AS jumlah_pesanan
        FROM pesanan
        RIGHT JOIN parfum ON (pesanan.pewangi = parfum.id_parfum)
        GROUP BY parfum.nama";
$result = $conn->query($sql);

// Prepare the arrays for labels and data
$data = array();
$labels = array();

// Fetch the data from the result set
if ($result->rowCount() > 0) {
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    array_push($data, $row["jumlah_pesanan"]); 
    array_push($labels, $row["nama"]);
  }
}

// Close the database connection
$conn = null;

// Return the data as JSON
$response = array(
  "data" => $data,
  "labels" => $labels
);
header("Content-type: application/json");
echo json_encode($response);
?>

