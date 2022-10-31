<?php include 'header.php'; ?>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Data Modal</div>
            <button type="button" class="btn btn-primary  btn-rounded pull-right" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa ti-plus"> Tambah Modal</i></button>
        </div>
        <div class="ibox-body">
            <br>
            <table class="table table-striped table-bordered table-hover table-sm" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Modal</th>
                        <th>Sumber</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    include 'koneksi.php';
                    $sql = mysqli_query($conn, "SELECT * FROM modal");
                    while ($data = mysqli_fetch_assoc($sql)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['kode']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['sumber']; ?></td>
                            <td><?= rupiah($data['nominal']); ?></td>
                            <td>
                                <a href="modal_rinci.php?id=<?= $data['id_modal']; ?>" class="btn btn-info btn-sm"><i class="fa fa-line-chart"></i></a>
                                <a href="<?= 'hapus_modal.php?id=' . $data['kode'] ?>" onclick="return confirm('Yakin Menghapus Data Ini?')" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                Tambah pecah modal
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Nama Modal</label>
                        <input type="text" name="nama" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Sumber Modal</label>
                        <input type="text" name="sumber" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nominal</label>
                        <input type="text" name="nominal" id="" class="form-control uang" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="save" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<?php
include 'footer.php';

if (isset($_POST['save'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $sumber = mysqli_real_escape_string($conn, $_POST['sumber']);
    $nominal = mysqli_real_escape_string($conn, preg_replace("/[^0-9]/", "", $_POST['nominal']));
    $kode = 'MDL' . rand(0, 9999999999);

    $sql = mysqli_query($conn, "INSERT INTO modal VALUES ('', '$kode', '$nama', '$sumber', '$nominal') ");

    if ($sql) {
        echo "
        <script>
            window.location = 'modal_pecah.php';
        </script>
        ";
    }
}

?>