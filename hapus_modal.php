<?php

include 'koneksi.php';
$id = $_GET['id'];

$cek = mysqli_query($conn, "SELECT * FROM kitab WHERE kategori = '$id' ");

if (mysqli_num_rows($cek) > 0) {
    echo "
    <script>
        alert('Maaf Data Modal ini sedang terpakai');
        window.location = 'modal_pecah.php';
    </script>
    ";
}else{
$sql = mysqli_query($conn, "DELETE FROM modal WHERE kode = '$id' ");

if ($sql) {
    echo "
    <script>
        alert('Data Berhasil Di Hapus');
        window.location = 'modal_pecah.php';
    </script>
    ";
}
}