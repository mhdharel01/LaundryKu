<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();
$sql = "SELECT paket_laundry.kategori ,COUNT( pesanan.jenis_paket) AS jumlah_paket
        FROM pesanan RIGHT JOIN paket_laundry on (pesanan.jenis_paket=paket_laundry.id_paket)
        GROUP by paket_laundry.kategori";
$result = $conn->query($sql);

// Prepare the arrays for labels and data
$data = array();
$labels = array();

// Fetch the data from the result set
if ($result->rowCount() > 0) {
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    array_push($data, $row["jumlah_paket"]); 
    array_push($labels, $row["kategori"]);
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
