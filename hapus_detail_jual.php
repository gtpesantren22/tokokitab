<?php

include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM detail_jual WHERE id_dtj = '$id' "));
$jumlah = $data['jumlah'];
$kd_kitab = $data['kd_kitab'];
$total = $data['total'];
$kd_jual = $data['kd_jual'];

$sql = mysqli_query($conn, "DELETE FROM detail_jual WHERE id_dtj = '$id' ");
$sql2 = mysqli_query($conn, "UPDATE kitab SET stok = stok + '$jumlah' WHERE kd_kitab = '$kd_kitab' ");
$sql3 = mysqli_query($conn, "UPDATE penjualan SET jml_jual = jml_jual - $jumlah, total = total - $total WHERE kd_jual = '$kd_jual' ");

if ($sql && $sql2 && $sql3) {
    echo "
    <script>
        alert('Data Berhasil Di Hapus');
        window.location = 'detail_penjualan.php?kd=" . $kd_jual . "';
    </script>
    ";
}
