<?php
$conn = mysqli_connect("localhost", "root", "", "db_usaha");
// $conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_kitab");

function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, '.', '.');
    return $hasil_rupiah;
}