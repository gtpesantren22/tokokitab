<?php
include 'koneksi.php';
$dari = $_GET['dari'];
$sampai = $_GET['sampai'];
$no = 1;
$data = mysqli_query($conn, "SELECT keluar.*, modal.nama FROM keluar JOIN modal ON keluar.kategori=modal.kode WHERE tanggal >= '$dari' AND tanggal <= '$sampai' ORDER BY kategori ASC, tanggal ASC");
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
header("Content-Disposition: attachment; filename=Data Pengeluaran.xls");
?>

<body>
    <h5>Rekap Data Pengeluaran</h5>
    <p><b>Dari tanggal : <?= $dari ?></b> s.d <b>Sampai tanggal : <?= $sampai ?></b></p>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Modal</th>
                <th>Ket</th>
                <th>Nominal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kategori'] ?> - <?= $row['nama'] ?></td>
                    <td><?= $row['ket'] ?></td>
                    <td><?= $row['nominal'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</body>

</html>