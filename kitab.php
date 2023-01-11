<?php
include 'header.php';
require 'assets/vendor/autoload.php';
?>
<div class="page-heading">
    <h1 class="page-title">Data Barang</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Data Barang</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                <a href="tambah_kitab.php" class="btn btn-primary btn-rounded pull-right"><i class="fa ti-plus"> Tambah
                        Barang</i></a>
                <a href="cetak_bar.php" target="_blank" class="btn btn-success btn-rounded pull-right"><i
                        class="fa fa-barcode">
                        Cetak
                        Barcode</i></a>
            </div>
        </div>
        <div class="ibox-body">
            <br>
            <table class="table table-striped table-bordered table-hover table-sm" id="example-table" cellspacing="0"
                width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga Kolak</th>
                        <th>Harga Jual</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    include 'koneksi.php';
                    $sql = mysqli_query($conn, "SELECT a.*, b.nama as nmMd FROM kitab a JOIN modal b ON a.kategori=b.kode ");
                    while ($data = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?= $data['kd_kitab']; ?>

                        </td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['stok']; ?></td>
                        <td><?= rupiah($data['harga_kolak']); ?></td>
                        <td><?= rupiah($data['harga_jual']); ?></td>
                        <td><?= $data['nmMd']; ?></td>
                        <td>
                            <a href="edit_kitab.php?id=<?= $data['id_kitab']; ?>" class="btn btn-warning btn-sm"><i
                                    class="fa fa-pencil"></i></a>
                            <a href="<?= 'hapus_kitab.php?id_kitab=' . $data['id_kitab'] ?>"
                                onclick="return confirm('Yakin Menghapus Data Ini?')" class="btn btn-danger btn-sm"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php include 'footer.php'; ?>