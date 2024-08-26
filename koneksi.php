<?php
$conn = mysqli_connect("localhost", "root", "", "db_usaha");
// $conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_kitab");

$sentral = mysqli_connect("localhost", "root", "", "db_sentral");
// $conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_sentral");

function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, '.', '.');
    return $hasil_rupiah;
}

function tanggalIndonesia($tanggal)
{
    // Daftar nama bulan dalam bahasa Indonesia
    $bulanIndo = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    // Mengubah tanggal menjadi format 'Y-m-d' jika belum dalam format ini
    $tanggalObj = new DateTime($tanggal);

    // Memisahkan bagian tanggal, bulan, dan tahun
    $hari = $tanggalObj->format('d');
    $bulan = $tanggalObj->format('n');
    $tahun = $tanggalObj->format('Y');

    // Mengembalikan tanggal dalam format Indonesia
    return $hari . ' ' . $bulanIndo[$bulan] . ' ' . $tahun;
}
