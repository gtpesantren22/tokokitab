<?php
$conn = mysqli_connect("localhost", "root", "", "db_usaha");

function rupiah($angka)
{

    $hasil_rupiah = "Rp. " . number_format($angka, 0, '.', '.');
    return $hasil_rupiah;
}
