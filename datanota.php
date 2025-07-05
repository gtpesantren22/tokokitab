<?php
include 'koneksi.php';

$tahunPost = $_POST['tahun'];

if (isset($tahunPost) || $tahunPost != '') {
    $tahun = $tahunPost;
} else {
    $th = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT nama_tahun FROM tahun ORDER BY nama_tahun DESC LIMIT 1 "));
    $tahun = $th['nama_tahun'];
}
$sql = mysqli_query($sentral, "SELECT kode_pengajuan, lembaga, at FROM pengajuan WHERE tahun = '$tahun' AND cair = 1 ORDER BY at DESC ");

?>

<table class="table table-striped table-bordered table-hover table-sm" id="example-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Pengajuan</th>
            <th>Tanggal</th>
            <th>Lembaga</th>
            <th>Jml Item</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($sql)) {
            $lembagaKode = $row['lembaga'];
            $pengajuanKode = $row['kode_pengajuan'];
            $lembaga = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT nama FROM lembaga WHERE kode = '$lembagaKode' AND tahun = '$tahun' "));
            $total = mysqli_fetch_assoc(mysqli_query($sentral, "SELECT COUNT(kode_pengajuan) as items, SUM(nominal) as total FROM realis WHERE kode_pengajuan = '$pengajuanKode' GROUP BY kode_pengajuan "));
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $pengajuanKode ?></td>
                <td><?= $row['at'] ?></td>
                <td><?= $lembaga['nama'] ?></td>
                <td><?= $total['items'] ?></td>
                <td><?= rupiah($total['total']) ?></td>
                <td><button class="btn btn-sm btn-primary" onclick="window.location.href='<?= 'rinciannota.php?kode=' . $pengajuanKode ?>'">Rincian</button></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#example-table').DataTable();
    })
</script>