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
                <a href="tambah_kitab.php" class="btn btn-primary btn-rounded"><i class="fa ti-plus"> Tambah
                        Barang</i></a> |
                <!-- <a href="cetak_bar.php" target="_blank" class="btn btn-success btn-rounded"><i class="fa fa-barcode"> Cetak Barcode (semua)</i></a> -->
                <!-- <a href="cetak_bar.php" target="_blank" class="btn btn-success btn-rounded"><i class="fa fa-barcode"> Cetak Barcode (peritem)</i></a> -->
                <div class="btn-group">
                    <button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-barcode"></i> Cetak Barcode
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="cetak_bar.php">Download Semua</a>
                        </li>
                        <li>
                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Download Peritem</a>
                        </li>
                        <li>
                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal2">Print Barcode</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ibox-body">
            <br>
            <table class="table table-striped table-bordered table-hover table-sm" id="example-table" cellspacing="0" width="100%">
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
                                <a href="edit_kitab.php?id=<?= $data['id_kitab']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                <a href="<?= 'hapus_kitab.php?id_kitab=' . $data['id_kitab'] ?>" onclick="return confirm('Yakin Menghapus Data Ini?')" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Barcode Berdasarkan Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="cetak_item.php" method="post">
                    <div class="form-group">
                        <label for="">Pilih Barang</label><br>
                        <select class="form-control" name="kd_kitab" id="" required>
                            <option value="">-pilih kitab-</option>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM kitab ORDER BY nama ASC");
                            while ($row = mysqli_fetch_array($sql)) { ?>
                                <option value="<?= $row['kd_kitab']; ?>"><?= $row['nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Cetak</label>
                        <input type="number" name="jml" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Cetak</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Print Barcode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="print_barcode.php" method="post">
                    <div class="form-group">
                        <label for="">Pilih Barang</label><br>
                        <select class="form-control" name="kd_kitab" id="" required>
                            <option value="">-pilih kitab-</option>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM kitab ORDER BY nama ASC");
                            while ($row = mysqli_fetch_array($sql)) { ?>
                                <option value="<?= $row['kd_kitab']; ?>"><?= $row['nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Cetak</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>