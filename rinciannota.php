<?php
include 'header.php';
include 'koneksi.php';

$kode_pengajuan = $_GET['kode'];
$pengajuan = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT * FROM pengajuan WHERE kode_pengajuan = '$kode_pengajuan' "));
$lmb = $pengajuan['lembaga'];
$tahun = $pengajuan['tahun'];
$lembaga = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT nama FROM lembaga WHERE kode = '$lmb' AND tahun = '$tahun' "));
$mitradata = mysqli_query($sentral, "SELECT order_mitra.id_mitra, mitra.nama FROM order_mitra JOIN mitra ON order_mitra.id_mitra=mitra.id_mitra WHERE kode_pengajuan = '$kode_pengajuan' GROUP BY order_mitra.id_mitra ");
?>
<div class="page-heading">
    <button class="pull-right btn btn-danger" onclick="window.location='nota_kpa.php'"><i class="fa fa-arrow-left"></i> Kembali</button>
    <h1 class="page-title">Nota Pengajuan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">List Order</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <?php while ($mitras = mysqli_fetch_object($mitradata)):
        $lastnota = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nota WHERE id_mitra = '$mitras->id_mitra' ORDER BY id_nota DESC LIMIT 1 "));
        $nota = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM nota WHERE kode_pengajuan = '$kode_pengajuan' AND id_mitra = '$mitras->id_mitra' "));
    ?>
        <div class="ibox">
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
                                    <th>: <?= $mitras->nama ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <thead>
                                <tr>
                                    <th>No. Nota</th>
                                    <th>: <?= $nota ? $nota->nomor : '-' ?></th>
                                </tr>
                                <tr>
                                    <th>
                                        <button class="btn btn-sm btn-warning edit-nota" type="button" data-mitra-id="<?= $mitras->id_mitra ?>" data-last-nota="<?= $lastnota ? $lastnota['nomor'] : '-' ?>">Update No. Nota</button><br>
                                        <?php if ($nota): ?>
                                            <button class="btn btn-sm btn-info mt-2" onclick="window.location='cetaknota.php?id=<?= $nota->id_nota ?>'">Cetak Nota</button>
                                        <?php endif ?>
                                    </th>
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
                        $total = 0;
                        $sql = mysqli_query($sentral, "SELECT * FROM order_mitra WHERE kode_pengajuan = '$kode_pengajuan' AND id_mitra = '$mitras->id_mitra' ");
                        while ($data = mysqli_fetch_assoc($sql)) {
                            $kode = $data['kode'];
                            $rab = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT * FROM rab WHERE kode = '$kode' "));
                            $rincian = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT * FROM realis WHERE kode_pengajuan = '$kode_pengajuan' AND kode = '$kode' "));
                            $total += $rincian['nominal'];
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $rab['nama']; ?></td>
                                <td><?= $rincian['vol']; ?></td>
                                <td><?= rupiah($rab['harga_satuan']); ?></td>
                                <td><?= $rab['satuan']; ?></td>
                                <td><?= rupiah($rincian['nominal']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">Total</th>
                            <th><?= rupiah($total) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php endwhile ?>
</div>
<div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                Update No. Nota
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" id="id_mitra" name="id_mitra">
                    <div class="form-group">
                        <label for="">No. Nota Terakhir : <b id="lastnota"></b></label>
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
<script>
    $(document).ready(function() {
        $('.edit-nota').on('click', function() {
            var mitraid = $(this).data('mitra-id');
            var lastnota = $(this).data('last-nota');

            $('#id_mitra').val(mitraid)
            $('#lastnota').text(lastnota)
            $('#updatemodal').modal('show')
        })
    })
</script>
<?php
if (isset($_POST['save'])) {
    $idmitra = $_POST['id_mitra'];
    $cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nota WHERE kode_pengajuan = '$kode_pengajuan' AND id_mitra = '$idmitra' "));
    if ($cek) {
        $nomor = $_POST['nomor'];
        $sql = mysqli_query($conn, "UPDATE nota SET nomor = '$nomor' WHERE kode_pengajuan = '$kode_pengajuan' AND id_mitra = '$idmitra' ");
    } else {
        $nomor = $_POST['nomor'];
        $sql = mysqli_query($conn, "INSERT INTO nota(kode_pengajuan, nomor, id_mitra) VALUES ('$kode_pengajuan','$nomor', '$idmitra') ");
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