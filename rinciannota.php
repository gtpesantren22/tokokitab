<?php
include 'header.php';
include 'koneksi.php';

$kode_pengajuan = $_GET['kode'];
$pengajuan = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT * FROM pengajuan WHERE kode_pengajuan = '$kode_pengajuan' "));
$lmb = $pengajuan['lembaga'];
$tahun = $pengajuan['tahun'];
$lembaga = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT nama FROM lembaga WHERE kode = '$lmb' AND tahun = '$tahun' "));
$nota = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nota WHERE kode_pengajuan = '$kode_pengajuan' "));
$lastnota = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nota ORDER BY id_nota DESC LIMIT 1 "));
?>
<div class="page-heading">
    <h1 class="page-title">Nota Pengajuan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">List Order</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">List Order Pengajuan</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>: <?= $kode_pengajuan ?></th>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <th>: <?= tanggalIndonesia(date('Y-m-d', strtotime($pengajuan['at']))) ?></th>
                            </tr>
                            <tr>
                                <th>Lembaga</th>
                                <th>: <?= $lembaga['nama'] ?></th>
                            </tr>
                            <tr>
                                <th>Mitra</th>
                                <th>: Unit Usaha / U2</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-md-6">
                    <table>
                        <thead>
                            <tr>
                                <th>No. Nota</th>
                                <th>: <?= $nota ? $nota['nomor'] : '-' ?></th>
                            </tr>
                            <tr>
                                <th><button class="btn btn-sm btn-warning" data-toggle="modal" data-target=".updatemodal">Update No. Nota</button></th>
                                <th><button class="btn btn-sm btn-info" onclick="window.location='cetaknota.php?kode=<?= $kode_pengajuan ?>'">Cetak Nota</button></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <br>
            <table class="table table-striped table-bordered table-hover" id="" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Item</th>
                        <th>QTY</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    $sql = mysqli_query($sentral, "SELECT * FROM order_mitra WHERE kode_pengajuan = '$kode_pengajuan' AND id_mitra = 'be2b631e-86cc-4e71-918a-b39ac4168a01' ");
                    while ($data = mysqli_fetch_assoc($sql)) {
                        $kode = $data['kode'];
                        $rab = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT * FROM rab WHERE kode = '$kode' "));
                        $rincian = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT * FROM realis WHERE kode_pengajuan = '$kode_pengajuan' AND kode = '$kode' "));
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $rab['nama']; ?></td>
                            <td><?= $rincian['vol']; ?></td>
                            <td><?= rupiah($rab['harga_satuan']); ?></td>
                            <td><?= $rab['satuan']; ?></td>
                            <td><?= rupiah($rincian['nominal']); ?></td>
                            <!-- <td><?= rupiah($rab['harga_satuan'] * $rincian['vol']); ?></td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="modal fade updatemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                Update No. Nota
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">No. Nota Terakhir : <b><?= $lastnota ? $lastnota['nomor'] : '-' ?></b></label>
                    </div>

                    <div class="form-group">
                        <label for="">Input No. Baru</label>
                        <input type="text" name="nomor" id="" class="form-control" required>
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
<?php include 'footer.php'; ?>

<?php
if (isset($_POST['save'])) {
    $cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nota WHERE kode_pengajuan = '$kode_pengajuan' "));
    $nomor = $_POST['nomor'];
    if ($cek) {
        $sql = mysqli_query($conn, "UPDATE nota SET nomor = '$nomor' WHERE kode_pengajuan = '$kode_pengajuan' ");
    } else {
        $sql = mysqli_query($conn, "INSERT INTO nota(kode_pengajuan, nomor) VALUES ('$kode_pengajuan','$nomor') ");
    }

    if ($sql) {
        echo "
        <script>
            alert('Update berhasil');
            window.location.href = 'rinciannota.php?kode=$kode_pengajuan';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Update gagal');
            window.location.href = 'rinciannota.php?kode=$kode_pengajuan';
        </script>
        ";
    }
}
?>