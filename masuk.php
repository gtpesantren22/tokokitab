<?php include 'header.php'; ?>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Data Pemasukan</div>
            <button type="button" class="btn btn-primary  btn-rounded pull-right" data-toggle="modal"
                data-target=".bd-example-modal-lg"><i class="fa ti-plus"> Tambah Pemasukan</i></button>
        </div>
        <div class="ibox-body">
            <br>
            <table class="table table-striped table-bordered table-hover table-sm" id="example-table" cellspacing="0"
                width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Penyetor</th>
                        <th>Ket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    include 'koneksi.php';
                    $sql = mysqli_query($conn, "SELECT * FROM masuk");
                    while ($data = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['tanggal']; ?></td>
                        <td><?= rupiah($data['nominal']); ?></td>
                        <td><?= $data['penyetor']; ?></td>
                        <td><?= $data['ket']; ?></td>
                        <td>
                            <a href="<?= 'hapus.php?kd=masuk&id=' . $data['id_masuk'] ?>"
                                onclick="return confirm('Yakin Menghapus Data Ini?')" class="btn btn-danger btn-sm"><i
                                    class="fa fa-times"></i> Del</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                Tambah Pemasukan
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="kategori" id="" class="form-control" required>
                            <option value=""> --pilih kategori-- </option>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM modal");
                            foreach ($sql as $ro) :
                            ?>
                            <option value="<?= $ro['kode']; ?>"><?= $ro['kode'] . ' - ' . $ro['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Setor</label>
                        <input type="date" name="tanggal" id="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Penyetor</label>
                        <input type="text" name="nama" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nominal</label>
                        <input type="text" name="nominal" id="" class="form-control uang" required>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="ket" id="" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="save" class="btn btn-success"><i class="fa fa-check"></i>
                            Simpan</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<?php
include 'footer.php';

if (isset($_POST['save'])) {
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $nominal = mysqli_real_escape_string($conn, preg_replace("/[^0-9]/", "", $_POST['nominal']));
    $ket = mysqli_real_escape_string($conn, $_POST['ket']);
    // $kode = 'MDL' . rand(0, 9999999999);

    $sql = mysqli_query($conn, "INSERT INTO masuk VALUES ('', '$kategori', '$tanggal', '$nominal', '$nama', '$ket') ");

    if ($sql) {
        echo "
        <script>
            window.location = 'masuk.php';
        </script>
        ";
    }
}

?>