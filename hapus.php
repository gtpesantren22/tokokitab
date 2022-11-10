<?php

include 'koneksi.php';

$kd = $_GET['kd'];
$id = $_GET['id'];

if ($kd === 'masuk') {
    $sql = mysqli_query($conn, "DELETE FROM masuk WHERE id_masuk = $id ");
    if ($sql) {
        echo "
        <script>
            window.location = 'masuk.php';
        </script>
        ";
    }
}

if ($kd === 'keluar') {
    $sql = mysqli_query($conn, "DELETE FROM keluar WHERE id_keluar = $id ");
    if ($sql) {
        echo "
        <script>
            window.location = 'keluar.php';
        </script>
        ";
    }
}

if ($kd === 'jasa') {
    $sql = mysqli_query($conn, "DELETE FROM jasa WHERE id_jasa = $id ");
    if ($sql) {
        echo "
        <script>
            window.location = 'jasa.php';
        </script>
        ";
    }
}

if ($kd === 'mdu') {
    $sql = mysqli_query($conn, "DELETE FROM modal_utama ");
    if ($sql) {
        echo "
        <script>
            window.location = 'modal.php';
        </script>
        ";
    }
}