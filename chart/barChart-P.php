<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();

$sql = "SELECT bulan.bulan, IFNULL(total_pendapatan, 0) AS total_pendapatan
        FROM (
        SELECT 'January' AS bulan
        UNION SELECT 'February'
        UNION SELECT 'March'
        UNION SELECT 'April'
        UNION SELECT 'May'
        UNION SELECT 'June'
        UNION SELECT 'July'
        UNION SELECT 'August'
        UNION SELECT 'September'
        UNION SELECT 'October'
        UNION SELECT 'November'
        UNION SELECT 'December'
        ) AS bulan
        LEFT JOIN (
        SELECT DATE_FORMAT(pesanan.tanggal_masuk_pesanan, '%M') AS bulan,
                SUM(pesanan.berat_pesanan * paket_laundry.harga) AS total_pendapatan
        FROM pesanan
        JOIN paket_laundry ON pesanan.jenis_paket = paket_laundry.id_paket
        GROUP BY DATE_FORMAT(pesanan.tanggal_masuk_pesanan, '%M')
        ) AS pendapatan ON bulan.bulan = pendapatan.bulan;
        ";

$result = $conn->query($sql);

$labels = array();
$earningsData = array();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  $labels[] = $row['bulan'];
  $earningsData[] = $row['total_pendapatan'];
}

$response = array(
  "labels" => $labels,
  "earningsData" => $earningsData
);

header("Content-type: application/json");
echo json_encode($response);

$conn = null;
?>
