<?php
include 'koneksi.php';
$dari = $_GET['dari'];
$sampai = $_GET['sampai'];
$no = 1;
$data = mysqli_query($conn, "SELECT detail_jual.jumlah, penjualan.kd_jual, penjualan.tanggal, kitab.nama AS barang, kitab.harga_jual, modal.nama AS kategori FROM detail_jual JOIN penjualan ON detail_jual.kd_jual=penjualan.kd_jual JOIN kitab ON kitab.kd_kitab=detail_jual.kd_kitab JOIN modal ON detail_jual.kategori=modal.kode WHERE penjualan.tanggal >= '$dari' AND penjualan.tanggal <= '$sampai' ORDER BY penjualan.kd_jual ASC, penjualan.tanggal ASC, detail_jual.kategori ASC  ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Penjualan.xls");
?>

<body>
    <h5>Rekap Data Penjualan</h5>
    <p><b>Dari tanggal : <?= $dari ?></b> s.d <b>Sampai tanggal : <?= $sampai ?></b></p>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kd_jual'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['barang'] ?></td>
                    <td><?= $row['harga_jual'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['harga_jual'] * $row['jumlah'] ?></td>
                    <td><?= $row['kategori'] ?></td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</body>

</html>