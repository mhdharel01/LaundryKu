<?php
session_start();
require_once "../../Config/Database.php";
$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];


    $sql = "SELECT customer.id_customer 'id', customer.no_telp 'no_telp', customer.nama 'nama', customer.alamat 'alamat' FROM customer WHERE customer.id_customer = $id ;";
    $hasil = $conn->query($sql);
    $hasil->execute();
    $hasilSatu = $hasil->fetch();


    $nama_customer = $hasilSatu["nama"];
    $alamat = $hasilSatu["alamat"];
    $no_telp = $hasilSatu["no_telp"];
}




?>

<div class="modal fade" id="editCustomerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="editCustomerForm" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">ID</label>
                                <select class="form-select" name="edit_id_customer" id="edit_id_customer" selected="selected">

                                    <option value="<?= $id ?>"><?= $id ?></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama Customer</label>
                                <input name="edit_nama_customer" id="edit_nama_customer" type="text" class="form-control" placeholder="Nama Customer" value="<?= $nama_customer ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input class="form-control" type="text" name="edit_alamat" id="edit_alamat" placeholder="Alamat" value="<?= $alamat ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input class="form-control" type="text" name="edit_no_telp" id="edit_no_telp" placeholder="Nomor Telepon" value="<?= $no_telp ?> ">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark active aksi-btn" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editCustomerForm" class="btn btn-success active aksi-btn">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#editCustomerForm").submit(function(e) {
            e.preventDefault();
            const id_customer = $("#edit_id_customer option:selected").val();
            const nama_customer = $("#edit_nama_customer").val();
            const alamat = $("#edit_alamat").val();
            const no_telp = $("#edit_no_telp").val();

            if (nama_customer == "" || alamat == "" || no_telp == "") {
                Swal.fire(
                    "Masukan Salah!",
                    "Isian data belum lengkap!",
                    "error"
                )
                // alert("COK")
            } else {
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: `Anda akan mengubah data dengan ID ${id_customer}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '../../control/edit/postEditCustomer.php',
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