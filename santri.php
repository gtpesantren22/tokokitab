<?php include 'header.php'; ?>
<div class="page-heading">
    <h1 class="page-title">Data Santri</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Data Santri</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Data Santi</div>
            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Tambah Pembeli</button>
        </div>
        <div class="ibox-body">
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Kelas</th>
                            <th>Kamar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        include 'koneksi.php';
                        $sql = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' ");
                        while ($data = mysqli_fetch_assoc($sql)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['nis']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['desa']; ?> - <?= $data['kec']; ?></td>
                            <td><?= $data['k_formal']; ?> - <?= $data['t_formal']; ?></td>
                            <td><?= $data['kamar']; ?> - <?= $data['komplek']; ?></td>
                            <td>
                                <!-- <a href="edit_kitab.php?id=<?= $data['id_kitab']; ?>" class="btn btn-warning "><i class="fa fa-pencil"></i></a>
                                <a href="<?= 'hapus_kitab.php?id_kitab=' . $data['id_kitab'] ?>" onclick="return confirm('Yakin Menghapus Data Ini?')" class="btn btn-danger "><i class="fa fa-times"></i></a> -->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Masukan Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include 'footer.php';

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $nis = 'BR_' . rand(0, 99999);

    $sql = mysqli_query($conn, "INSERT INTO tb_santri (id_santri, nis, nama, jln, aktif) VALUES ('', '$nis', '$nama', '$alamat', 'Y') ");

    if ($sql) {
        echo "
    <script>
        window.location = 'santri.php';
    </script>
    ";
    }
}

?>