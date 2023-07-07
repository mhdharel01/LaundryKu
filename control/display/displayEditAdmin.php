<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];


    $sql = "SELECT * FROM karyawan WHERE karyawan.id_karyawan = $id ;";
    $hasil = $conn->query($sql);
    $hasil->execute();
    $hasilSatu = $hasil->fetch();


    $nama_admin = $hasilSatu["nama"];
    $email = $hasilSatu["email"];
    $password = $hasilSatu["password"];
    $no_telepon = $hasilSatu["no_telepon"];
}




?>

<div class="modal fade" id="editAdminModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="editAdminForm" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">ID</label>
                                <select class="form-select" name="edit_id_admin" id="edit_id_admin" selected="selected">

                                    <option value="<?= $id ?>"><?= $id ?></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama Admin</label>
                                <input name="edit_nama_admin" id="edit_nama_admin" type="text" class="form-control" placeholder="Nama Admin" value="<?= $nama_admin ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input class="form-control" type="text" name="edit_email" id="edit_email" placeholder="Email" value="<?= $email ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group bi bi-eye-slash">
                                <label for="">Password Baru</label>
                                <input class="form-control" type="password" name="edit_password" id="edit_password" placeholder="Password" value="<?= $password ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group bi bi-eye-slash">
                                <label for="">Konfirmasi Password</label>
                                <input class="form-control" type="password" name="edit_password_baru" id="edit_password_baru" placeholder="Password Baru" value="<?= $password ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input class="form-control bi bi-eye-slash" type="text" name="edit_no_telp" id="edit_no_telp" placeholder="Nomor Telepon" value="<?= $no_telepon ?>">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark active aksi-btn" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editAdminForm" class="btn btn-success active aksi-btn">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#editAdminForm").submit(function(e) {
            e.preventDefault();
            const id_admin = $("#edit_id_admin option:selected").val();
            const nama_admin = $("#edit_nama_admin").val();
            const email = $("#edit_email").val();
            const no_telp = $("#edit_no_telp").val();
            const password = $("#edit_password").val();
            const password_baru = $("#edit_password_baru").val();

            if (nama_admin == "" || email == "" || no_telp == "" || password == "") {
                Swal.fire(
                    "Masukan Salah!",
                    "Isian data belum lengkap!",
                    "error"
                )
                // alert("COK")
            } else {

                if (password != password_baru) {
                    Swal.fire(
                        "Password salah!",
                        "Password tidak sama, mohon cek kembali!",
                        "error"
                    )
                } else {


                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: `Anda akan mengubah data dengan ID ${id_admin}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, tambahkan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '../../control/edit/postEditAdmin.php',
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

            }
        })
    })
</script>