<?php
$conn = mysqli_connect("localhost", "root", "", "db_kitab");

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, '.', '.');
    return $hasil_rupiah;
}
