<?php
session_start();
include 'koneksi.php';

$nama_user = $_SESSION['nama'];

$id_nota = $_GET['id'];
$datanota = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nota WHERE id_nota = $id_nota"));
$kode_pengajuan = $datanota['kode_pengajuan'];
$id_mitra = $datanota['id_mitra'];
$nomor = $datanota['nomor'];

$pengajuan = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT * FROM pengajuan WHERE kode_pengajuan = '$kode_pengajuan' "));
$lmb = $pengajuan['lembaga'];
$tahun = $pengajuan['tahun'];
$lembaga = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT nama FROM lembaga WHERE kode = '$lmb' AND tahun = '$tahun' "));
$mitra = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT nama FROM mitra WHERE  id_mitra = '$id_mitra' "));

// $total = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT SUM(realis.nominal) AS total FROM order_mitra JOIN realis ON realis.kode_pengajuan=order_mitra.kode_pengajuan WHERE order_mitra.kode_pengajuan = '$kode_pengajuan' AND order_mitra.id_mitra = '$id_mitra' "));
?>
<link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    table.no-border,
    table.no-border th,
    table.no-border td {
        border: none;
    }

    .table-bordered {
        border: 2px solid black;
        /* Thicker border for the entire table */
    }

    .table-bordered th {
        border: 2px solid black;
        /* Thicker border for table cells */
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
                                <th>: <?= $nomor ?></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Mitra</th>
                                <th>: <?= $mitra['nama'] ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <br>
            <table class="table table-bordered table-sm">
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
                    $total = 0;
                    $sql = mysqli_query($sentral, "SELECT * FROM order_mitra WHERE kode_pengajuan = '$kode_pengajuan' AND id_mitra = '$id_mitra' ");
                    while ($data = mysqli_fetch_assoc($sql)) {
                        $kode = $data['kode'];
                        $rab = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT * FROM rab WHERE kode = '$kode' "));
                        $rincian = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT * FROM realis WHERE kode_pengajuan = '$kode_pengajuan' AND kode = '$kode' "));
                        $total += $rincian['nominal'];
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?>.</td>
                            <td><?= $rab['nama']; ?></td>
                            <td class="text-center"><?= $rincian['vol']; ?></td>
                            <td><?= rupiah($rab['harga_satuan']); ?></td>
                            <td><?= $rab['satuan']; ?></td>
                            <td><?= rupiah($rincian['nominal']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
            <table class="table table-striped table-bordered table-hover table-sm" id="" cellspacing="0" width="100%">
                <tfoot>
                    <tr>
                        <th colspan="5">Total</th>
                        <th style="width: 20%;"><?= rupiah($total) ?></th>
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