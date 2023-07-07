<?php
require_once "Config/Database.php";
$conn = getConnection();

// Kueri SQL
$sql = "SELECT karyawan.nama, COUNT(pesanan.karyawan_id) AS jumlah_pesanan
        FROM pesanan
        RIGHT JOIN karyawan ON (pesanan.karyawan_id = karyawan.id_karyawan)
        GROUP BY karyawan.nama
        ORDER BY COUNT(pesanan.karyawan_id) DESC";

$result = $conn->query($sql);

// Memperoleh data dari kueri SQL
$data = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

// Menutup koneksi ke database
$sql = "SELECT p.id_pesanan 'id_p', c.nama 'nama', p.nama_pesanan 'nama_pesanan', p.tanggal_masuk_pesanan 'tgl-masuk', p.tanggal_keluar_pesanan 'tgl-keluar', p.status_pesanan 'id_status_pesanan', p.status_pembayaran 'bayar',pr.nama 'pewangi', p.berat_pesanan 'berat', (p.berat_pesanan * pk.harga) 'harga', pk.kategori 'jenis_paket'
FROM pesanan p JOIN customer c 
ON(c.id_customer = p.id_customer)
JOIN paket_laundry pk
ON(pk.id_paket = p.jenis_paket)
JOIN status_pembayaran sp
ON(p.status_pembayaran = sp.id_pembayaran)
JOIN parfum pr
ON (p.pewangi = pr.id_parfum)
ORDER BY p.tanggal_masuk_pesanan; ";
$hasil = $conn->query($sql);

$data_1 = array();
while ($row = $hasil->fetch(PDO::FETCH_ASSOC)) {
    $data_1[] = $row;
}
?>


