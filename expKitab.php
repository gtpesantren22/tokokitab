<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Barang.xls");
?>

<body>
    <h3>Data Barang Unit Usaha</h3>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Harga Kolak</th>
                <th>Harga Jual</th>
                <th>Kategori</th>
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
                    <td><?= $data['harga_kolak']; ?></td>
                    <td><?= $data['harga_jual']; ?></td>
                    <td><?= $data['nmMd']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>