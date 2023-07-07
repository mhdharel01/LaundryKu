<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $sql = "SELECT customer.nama 'nama', nama_pesanan, id_pesanan, customer.id_customer 'id_customer' ,status_pembayaran, status_pesanan, jenis_paket, berat_pesanan, tanggal_masuk_pesanan, tanggal_keluar_pesanan FROM pesanan JOIN customer ON (pesanan.id_customer = customer.id_customer) WHERE id_pesanan = $id;";
    $hasil = $conn->query($sql);
    $hasil->execute();
    $hasilSatu = $hasil->fetch();

    $nama_customer = $hasilSatu["nama"];
    $nama_pesanan = $hasilSatu["nama_pesanan"];
    $id_customer = $hasilSatu["id_customer"];
    $id = $hasilSatu["id_pesanan"];
    $status_bayar = $hasilSatu["status_pembayaran"];
    $status_pesanan = $hasilSatu["status_pesanan"];
    $jenis_paket = $hasilSatu["jenis_paket"];
    $berat = $hasilSatu["berat_pesanan"];
    $tgl_masuk = ($hasilSatu["tanggal_masuk_pesanan"]);
    $tgl_keluar = ($hasilSatu["tanggal_keluar_pesanan"]);

    $tgl_masuk_html = date("Y-m-d", strtotime($tgl_masuk));
    $tgl_keluar_html = date("Y-m-d", strtotime($tgl_keluar));
}




?>

<div class="modal fade" id="editTransactionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="editTransactionForm" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">No Order</label>
                                <select class="form-select" name="edit_no_order" id="edit_no_order">
                                    <?php $sqlSelectIdPesanan = "SELECT id_pesanan 'id_pesanan' FROM pesanan WHERE id_customer = $id_customer AND nama_pesanan = '$nama_pesanan' AND id_pesanan = $id AND status_pembayaran = $status_bayar AND status_pesanan = $status_pesanan;";
                                    // AND nama_pesanan = $nama_pesanan AND 'id_pesanan' = $id AND status_pembayaran = $status_bayar AND status_pesanan = $status_pesanan;
                                    $stateSelectIdPesanan = $conn->query($sqlSelectIdPesanan);
                                    $row = $stateSelectIdPesanan->fetch();
                                    ?>
                                    <option value="<?= $row["id_pesanan"]  ?>" selected="selected"><?= $row["id_pesanan"] ?></option>
                                    <?php  ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama Pesanan</label>
                                <input name="edit_judul_pesanan" id="edit_judul_pesanan" type="text" class="form-control" value="<?= $nama_pesanan ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">ID - Nama Customer</label>
                                <select class="form-select" name="edit_id_nama" id="edit_id_nama">
                                    <option value="">- Masukkan ID & Nama -</option>
                                    <?php $sqlSelectIdNama = "SELECT CONCAT(c.id_customer, ' - ', c.nama) 'id_nama' FROM customer c;";
                                    $stateSelectIdNama = $conn->query($sqlSelectIdNama);
                                    foreach ($stateSelectIdNama as $row) {
                                    ?>
                                        <option value="<?php echo $row["id_nama"] ?>" <?php
                                                                                        $idNamaBanding = $hasilSatu["id_customer"] . " - " . $hasilSatu["nama"];
                                                                                        if ($row["id_nama"] == $idNamaBanding) {
                                                                                            echo "selected='selected'";
                                                                                        } ?>><?php echo $row["id_nama"] ?> </option> <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Status Pembayaran</label>
                                <select class="form-select" name="edit_status_bayar" id="edit_status_bayar">
                                    <option value="">- Pilih Status Pembayaran -</option>
                                    <option value="2" <?php if ($hasilSatu['status_pembayaran'] == 2) {
                                                            echo "selected='selected'";
                                                        } ?>>Lunas</option>
                                    <option value="1" <?php if ($hasilSatu['status_pembayaran'] == 1) {
                                                            echo "selected='selected'";
                                                        } ?>>Belum Bayar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Status Pesanan</label>
                                <select class="form-select" name="edit_status_pesanan" id="edit_status_pesanan">
                                    <option value="">- Pilih Status Pesanan -</option>
                                    <option value="1" <?php if ($hasilSatu['status_pesanan'] == 1) {
                                                            echo "selected='selected'";
                                                        } ?>>Diproses</option>
                                    <option value="2" <?php if ($hasilSatu['status_pesanan'] == 2) {
                                                            echo "selected='selected'";
                                                        } ?>>Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Paket</label>
                                <select class="form-select" name="edit_jenis_paket" id="edit_jenis_paket">
                                <option value="">- Pilih Paket -</option>
                                <?php $sqlSelectPaket = "SELECT kategori, id_paket FROM paket_laundry;";
                                $stateSelectPaket = $conn->query($sqlSelectPaket);
                                foreach ($stateSelectPaket as $row) {
                                ?>
                                    <option value="<?php echo $row["id_paket"] ?>"><?php echo $row["kategori"] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Pewangi</label>
                                <select class="form-select" name="edit_pewangi" id="edit_pewangi">
                                <option value="">- Pilih pewangi -</option>
                                <?php $sqlSelectPaket = "SELECT nama, id_parfum FROM parfum;";
                                $stateSelectPaket = $conn->query($sqlSelectPaket);
                                foreach ($stateSelectPaket as $row) {
                                ?>
                                    <option value="<?php echo $row["id_parfum"] ?>"><?php echo $row["nama"] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Berat (kg)</label>
                                <input class="form-control" type="text" name="edit_berat" id="edit_berat" placeholder="Berat (kg)" value="<?= $berat ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Tanggal Masuk</label>
                                <input class="form-control" type="date" name="edit_tgl_masuk" id="edit_tgl_masuk" value="<?= $tgl_masuk_html ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Tanggal Keluar</label>
                                <input class="form-control" type="date" name="edit_tgl_keluar" id="edit_tgl_keluar" value="<?= $tgl_keluar_html ?>">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark active aksi-btn" data-bs-dismiss="modal">Close</button>
                <button form="editTransactionForm" type="submit" class="btn btn-success active aksi-btn" id="edit-mase">Update</button>
            </div>
            </form>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#editTransactionForm").submit(function(e) {
            // alert();
            e.preventDefault();
            const no_order = $("#edit_no_order option:selected").val();
            const judul_pesanan = $("#edit_judul_pesanan").val();
            const id_nama = $("#edit_id_nama option:selected").val();
            const status_bayar = $("#edit_status_bayar option:selected").val();
            const status_pesanan = $("#edit_status_pesanan option:selected").val();
            const jenis_paket = $("#edit_jenis_paket option:selected").val();
            const pewangi = $("#edit_pewangi option:selected").val();
            const berat = $("#edit_berat").val();
            const tgl_masuk = $("#edit_tgl_masuk").val();
            const tgl_keluar = $("#edit_tgl_keluar").val();

            if (judul_pesanan == "" || id_nama == "" || status_bayar == "" || status_pesanan == "" || jenis_paket == "" || jenis_paket == "" || berat == "" || tgl_masuk == "" || tgl_keluar == "") {
                Swal.fire(
                    "Masukan Salah!",
                    "Isian data belum lengkap!",
                    "error"
                )
            } else {

                console.log(judul_pesanan);
                // alert();
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: `Anda akan mengubah transaksi tersebut? `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '../../control/edit/postEditTransaction.php',
                            type: 'POST',
                            data: $(this).serialize(),
                            cache: false,
                            success: function(data) {
                                Swal.fire(
                                    "Berhasil!",
                                    "Penambahan transaksi baru berhasil!",
                                    "success"
                                ).then(() => {
                                    window.location.reload();
                                })
                            }
                        })
                    }
                })

            }

        })
    })
</script>