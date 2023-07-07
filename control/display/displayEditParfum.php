<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // echo "<p>$id</p>";
    $sql = "SELECT * FROM parfum WHERE parfum.id_parfum = $id ;";
    $hasil = $conn->query($sql);
    $hasil->execute();
    $hasilSatu = $hasil->fetch();


    $nama_parfum = $hasilSatu["nama"];
    $id_parfum = $hasilSatu["id_parfum"];
}

?>
<div class="modal fade" id="editParfumModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="editParfumForm" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">ID</label>
                                <select class="form-select" name="edit_id_parfum" id="edit_id_parfum" selected="selected">

                                    <option value="<?= $id ?>"><?= $id ?></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama </label>
                                <input name="edit_nama_parfum" id="edit_nama_parfum" type="text" class="form-control" placeholder="Nama Paket" value="<?= $nama_parfum ?> ">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark active aksi-btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="editParfumForm" class="btn btn-success active aksi-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#editParfumForm").submit(function(e) {
            e.preventDefault();
            const nama_parfum = $("#edit_nama_parfum").val();
            const id_parfum = $("#edit_id_parfum").val();

            if (nama_parfum == "" || id_parfum == "") {
                Swal.fire(
                    "Masukan Salah!",
                    "Isian data belum lengkap!",
                    "error"
                )
                // alert("COK")
            } else {
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: `Anda akan mengubah data dengan ID ${id_parfum}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '../../control/edit/postEditParfum.php',
                            type: 'POST',
                            data: $(this).serialize(),
                            cache: false,
                            success: function(data) {
                                Swal.fire(
                                    "Berhasil!",
                                    "Perubahan parfum sukses!",
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