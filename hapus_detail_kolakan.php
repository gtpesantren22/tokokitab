<?php

include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM detail_kolakan WHERE id_dtk = '$id' "));

$kdktb = $data['kd_kitab'];
$dtkitab = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kitab WHERE kd_kitab = '$kdktb' "));

$jumlah = $data['jumlah'];
$kd_kitab = $data['kd_kitab'];
$total = $data['total'];
$kd_kolakan = $data['kd_kolakan'];
$stok = $dtkitab['stok'];

if ($stok < $jumlah) {
    echo "
        <script type='text/javascript'>
            alert('Maaf Stok kitab tidak mencukupi');
            window.location.href = 'detail_kolakan.php?kd=" . $kd_kolakan . "';
        </script>
        ";
} else {
    $sql = mysqli_query($conn, "DELETE FROM detail_kolakan WHERE id_dtk = '$id' ");
    $sql2 = mysqli_query($conn, "UPDATE kitab SET stok = stok - '$jumlah' WHERE kd_kitab = '$kd_kitab' ");
    $sql3 = mysqli_query($conn, "UPDATE kolakan SET jml_kolakan = jml_kolakan - $jumlah, total = total - $total WHERE kd_kolakan = '$kd_kolakan' ");

    if ($sql && $sql2 && $sql3) {
        echo "
    <script>
        alert('Data Berhasil Di Hapus');
        window.location = 'detail_kolakan.php?kd=" . $kd_kolakan . "';
    </script>
    ";
    }
}
