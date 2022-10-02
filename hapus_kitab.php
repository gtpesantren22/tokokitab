<?php

include 'koneksi.php';
$id_kitab = $_GET['id_kitab'];

$sql = mysqli_query($conn, "DELETE FROM kitab WHERE id_kitab = '$id_kitab' ");

if ($sql) {
    echo "
    <script>
        alert('Data Berhasil Di Hapus');
        window.location = 'kitab.php';
    </script>
    ";
}
