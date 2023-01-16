<?php

include 'koneksi.php';
$kd = $_GET['kd'];
$sql = mysqli_query($conn, "SELECT a.*, b.nama FROM penjualan a JOIN tb_santri b ON a.nis=b.nis WHERE a.kd_jual = '$kd' ");

$datas = mysqli_fetch_assoc($sql);

function rp($angka)
{
    $hasil_rupiah = number_format($angka, 0, '.', '.');
    return $hasil_rupiah;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <style>
        span {
            font-family: Ubuntu;
        }

        .examnple,
        th,
        td {
            font-family: Ubuntu;
            color: #232323;
            border-collapse: collapse;
            border: 1px solid #999;
            /* padding: 8px 20px; */
        }
    </style>
</head>

<body>

    <span style="font-weight: bold;">UNIT USAHA</span><br>
    <span style="font-size: 10px;">PP Darul Lughah Wal Karomah</span><br>
    <span style="font-size: 10px;">Sidomukti - Kraksaan</span>
    <hr>
    <span style="font-size: 10px;">No. Nota : <?= $datas['kd_jual'] ?></span><br>
    <span style="font-size: 10px;">Pembeli : <?= $datas['nama'] ?></span><br>
    <span style="font-size: 10px;">Tanggal : <?= $datas['tanggal'] ?></span>
    <br>
    <br>
    <table style="font-size: 10px;" width="100%" class="examnple">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>QTY</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $sql = mysqli_query($conn, "SELECT * FROM detail_jual JOIN kitab ON detail_jual.kd_kitab=kitab.kd_kitab WHERE kd_jual = '$kd' ");
            $sql2 = mysqli_query($conn, "SELECT SUM(total) as sm FROM detail_jual WHERE kd_jual = '$kd' ");
            $jml = mysqli_fetch_assoc($sql2);
            while ($qs = mysqli_fetch_assoc($sql)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $qs['nama'] ?></td>
                    <td><?= $qs['jumlah'] ?></td>
                    <td><?= rp($qs['harga_jual']) ?></td>
                    <td><?= rp($qs['total']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align: right;">TOTAL</th>
                <th colspan="2"><?= rupiah($jml['sm']) ?></th>
            </tr>
            <tr>
                <th colspan="3" style="text-align: right;">BAYAR</th>
                <th colspan="2"><?= rupiah($datas['bayar']) ?></th>
            </tr>
            <tr>
                <th colspan="3" style="text-align: right;">KEMBALI</th>
                <th colspan="2"><?= rupiah($datas['kembali']) ?></th>
            </tr>
        </tfoot>
    </table>
    <hr>
    <p style="font-size: 8px;">* Nota ini sebagai bukti Pmebayaran yang sah dari UNIT USAHA PP Darul Lughah Wal Karomah</p>
    <center style="font-size: 8px;">powered by : SMK DWK</center>
</body>
<script>
    window.print();
</script>
<script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

</html>