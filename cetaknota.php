<?php
session_start();
include 'koneksi.php';

$nama_user = $_SESSION['nama'];

$kode_pengajuan = $_GET['kode'];
$pengajuan = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT * FROM pengajuan WHERE kode_pengajuan = '$kode_pengajuan' "));
$lmb = $pengajuan['lembaga'];
$tahun = $pengajuan['tahun'];
$lembaga = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT nama FROM lembaga WHERE kode = '$lmb' AND tahun = '$tahun' "));
$nota = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nota WHERE kode_pengajuan = '$kode_pengajuan' "));
$total = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT SUM(nominal) AS total FROM realis WHERE kode_pengajuan = '$kode_pengajuan' GROUP BY kode_pengajuan "));
?>
<link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    table.no-border,
    table.no-border th,
    table.no-border td {
        border: none;
    }
</style>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">

        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-12">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 65%;">NOTA PEMBELANJAAN UNIT USAHA</th>
                                <th>Tanggal</th>
                                <th>: <?= tanggalIndonesia(date('Y-m-d', strtotime($pengajuan['at']))) ?></th>
                            </tr>
                            <tr>
                                <th>PP. DARUL LUGHAH WAL KAROMAH</th>
                                <th>Kpd. Yth</th>
                                <th>: <?= $lembaga['nama'] ?></th>
                            </tr>
                            <tr>
                                <th><small>Sidomukti - Kraksaan - Probolinggo</small></th>
                                <th>No. Nota</th>
                                <th>: <?= $nota['nomor'] ?></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Mitra</th>
                                <th>: Unit Usaha / U2</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <br>
            <table class="table table-striped table-bordered table-hover table-sm" id="" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Item</th>
                        <th class="text-center">QTY</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center">Total</th>
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
                            <td class="text-center"><?= $no++; ?>.</td>
                            <td><?= $rab['nama']; ?></td>
                            <td class="text-center"><?= $rincian['vol']; ?></td>
                            <td><?= rupiah($rab['harga_satuan']); ?></td>
                            <td><?= $rab['satuan']; ?></td>
                            <td><?= rupiah($rincian['nominal']); ?></td>
                            <!-- <td><?= rupiah($rab['harga_satuan'] * $rincian['vol']); ?></td> -->
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Total</th>
                        <th><?= rupiah($total['total']) ?></th>
                    </tr>
                </tfoot>
            </table>
            <b><u><i>Nota ini adalah tanda bukti yang sah</i></u></b>
            <table class="table no-border table-sm">
                <thead>
                    <tr>
                        <th style="width: 70%;">&nbsp;</th>
                        <th>Hormat Kami</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th><u><?= $nama_user ?></u></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>
<script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script>
    window.print()
</script>