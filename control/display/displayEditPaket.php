<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    echo "<p>$id</p>";
    $sql = "SELECT * FROM paket_laundry WHERE paket_laundry.id_paket = $id ;";
    $hasil = $conn->query($sql);
    $hasil->execute();
    $hasilSatu = $hasil->fetch();


    $nama_paket = $hasilSatu["kategori"];
    $harga = $hasilSatu["harga"];
    $id_paket = $hasilSatu["id_paket"];
}




?>

<div class="modal fade" id="editPaketModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="editPaketForm" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">ID</label>
                                <select class="form-select" name="edit_id_paket" id="edit_id_paket" selected="selected">

                                    <option value="<?= $id ?>"><?= $id ?></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama Paket</label>
                                <input name="edit_nama_paket" id="edit_nama_paket" type="text" class="form-control" placeholder="Nama Paket" value="<?= $nama_paket ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input class="form-control" type="text" name="edit_harga" id="edit_harga" placeholder="Harga" value="<?= $harga ?> ">
                            </div>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark active aksi-btn" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editPaketForm" class="btn btn-success active aksi-btn">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#editPaketForm").submit(function(e) {
            e.preventDefault();
            const nama_paket = $("#edit_nama_paket").val();
            const harga = $("#edit_harga").val();
            const id_paket = $("#edit_id_paket").val();

            if (nama_paket == "" || harga == "" || id_paket == "") {
                Swal.fire(
                    "Masukan Salah!",
                    "Isian data belum lengkap!",
                    "error"
                )
                // alert("COK")
            } else {
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: `Anda akan mengubah data dengan ID ${id_paket}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '../../control/edit/postEditPaket.php',
                            type: 'POST',
                            data: $(this).serialize(),
                            cache: false,
                            success: function(data) {
                                Swal.fire(
                                    "Berhasil!",
                                    "Perubahan paket sukses!",
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