<?php
include 'header.php';
include 'koneksi.php';

$kd = $_GET['id'];
$df = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM modal WHERE kode = '$kd' "));

$masuk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) as jml FROM masuk WHERE kategori = '$kd' "));
$keluar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) as jml FROM keluar WHERE kategori = '$kd' "));

$sql3 = mysqli_query($conn, "SELECT *, SUM(total) as jml FROM detail_jual WHERE kategori = '$kd' ");
$jual = mysqli_fetch_assoc($sql3);
$sql4 = mysqli_query($conn, "SELECT *, SUM(total) as jml FROM detail_kolakan WHERE kategori = '$kd' ");
$kolak = mysqli_fetch_assoc($sql4);
$sql5 = mysqli_query($conn, "SELECT *, SUM(debet) as jml FROM jasa WHERE kategori = '$kd' ");
$jasa = mysqli_fetch_assoc($sql5);
?>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Statistik Modal</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-3">
                    <table>
                        <tr>
                            <td>Kode</td>
                            <th>: <?= $df['kode']; ?></th>
                        </tr>
                        <tr>
                            <td>Nama Modal</td>
                            <th>: <?= $df['nama']; ?></th>
                        </tr>
                        <tr>
                            <td>Sumber</td>
                            <th>: <?= $df['sumber']; ?></th>
                        </tr>
                        <tr>
                            <td>Nominal</td>
                            <th>: <?= rupiah($df['nominal']); ?></th>
                        </tr>
                    </table>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <!-- <div class="col-lg-3 col-md-6">
                            <div class="ibox bg-info color-white widget-stat">
                                <div class="ibox-body">
                                    <h3 class="m-b-5 font-strong"><?= rupiah($df['nominal']); ?></h3>
                                    <div class="m-b-5">Modal Awal</div><i class="ti-book widget-stat-icon"></i>
                                    <div>
                                        <a href="#" class="small-box-footer color-white ">
                                            Selengkapnya <i class="fa fa-arrow-circle-right color-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-4 col-md-6">
                            <div class="ibox bg-success color-white widget-stat">
                                <div class="ibox-body">
                                    <h3 class="m-b-5 font-strong"><?= rupiah($masuk['jml']+$jual['jml']+$jasa['jml']) ?></h3>
                                    <div class="m-b-5">Pemasukan</div><i class="ti-arrow-circle-up widget-stat-icon"></i>
                                    <div>
                                        <a href="masuk.php" class="small-box-footer color-white ">
                                            Selengkapnya <i class="fa fa-arrow-circle-right color-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ibox bg-danger color-white widget-stat">
                                <div class="ibox-body">
                                    <h3 class="m-b-5 font-strong"><?= rupiah($keluar['jml']+$kolak['jml']) ?></h3>
                                    <div class="m-b-5">Pengeluaran</div><i class="ti-arrow-circle-down widget-stat-icon"></i>
                                    <div><a href="keluar.php" class="small-box-footer color-white ">
                                            Selengkapnya <i class="fa fa-arrow-circle-right color-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ibox bg-warning color-white widget-stat">
                                <div class="ibox-body">
                                    <h3 class="m-b-5 font-strong">
                                        <?= rupiah(($masuk['jml'] + $jual['jml'] + $jasa['jml']) - ($df['nominal'] + $keluar['jml'] + $kolak['jml'])); ?></h3>
                                    <div class="m-b-5">Saldo</div><i class="fa fa-money widget-stat-icon"></i>
                                    <div><small>Termasuk modal utama</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-7">
                    <center><b><u>Rincian Debet & Kredit</u></b></center>
                    <table class="table table-striped table-bordered table-hover table-sm" id="example-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Ket</th>
                                <th>Dari</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($conn, "SELECT * FROM masuk WHERE kategori = '$kd' ");
                            while ($data = mysqli_fetch_assoc($sql)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['tanggal']; ?></td>
                                    <td><?= rupiah($data['nominal']); ?></td>
                                    <td class="text-success"><b><i class="fa fa-arrow-circle-up"></i> Pemasukan</b></td>
                                    <td>Pemasukan</td>
                                </tr>
                            <?php }
                            $sql2 = mysqli_query($conn, "SELECT * FROM keluar WHERE kategori = '$kd' ");
                            while ($data2 = mysqli_fetch_assoc($sql2)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data2['tanggal']; ?></td>
                                    <td><?= rupiah($data2['nominal']); ?></td>
                                    <td class="text-danger"><b><i class="fa fa-arrow-circle-down"></i> Pengeluaran</b></td>
                                    <td>Pengeluaran</td>
                                </tr>

                            <?php }
$sql3 = mysqli_query($conn, "SELECT * FROM detail_jual WHERE kategori = '$kd' ");
                            while ($data2 = mysqli_fetch_assoc($sql3)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>-</td>
                                    <td><?= rupiah($data2['total']); ?></td>
                                    <td class="text-success"><b><i class="fa fa-arrow-circle-up"></i> Pemasukan</b></td>
                                    <td>Penjualan</td>
                                </tr>

                            <?php }
$sql4 = mysqli_query($conn, "SELECT * FROM detail_kolakan WHERE kategori = '$kd' ");
                            while ($data2 = mysqli_fetch_assoc($sql4)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>-</td>
                                    <td><?= rupiah($data2['total']); ?></td>
                                    <td class="text-danger"><b><i class="fa fa-arrow-circle-down"></i> Pengeluaran</b></td>
                                    <td>Kolakan</td>
                                </tr>

                            <?php } 
                            
$sql5 = mysqli_query($conn, "SELECT * FROM jasa WHERE kategori = '$kd' ");
                            while ($data2 = mysqli_fetch_assoc($sql5)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>-</td>
                                    <td><?= rupiah($data2['debet']); ?></td>
                                    <td class="text-success"><b><i class="fa fa-arrow-circle-up"></i> Pemasukan</b></td>
                                    <td>Jasa</td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>

                <div class="col-md-5">
                    <center><b><u>Statistik Modal</u></b></center>
                    <!-- <canvas id="bar-example" width="400" height="400"></canvas> -->
                    <div id="bar-example"></div>
                    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script> -->
                    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
                    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
                    <script src="morris/morris.js"></script>
                    <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
                    <script src="morris/examples/lib/example.js"></script>
                    <!-- <link rel="stylesheet" href="morris/examples/lib/example.css"> -->
                    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
                    <link rel="stylesheet" href="morris/morris.css">
                    <script>
                        var masuk = Number(<?= $masuk['jml'] ?>);
                        var keluar = Number(<?= $keluar['jml'] ?>);
                        var jual = Number(<?= $jual['jml'] ?>);
                        var kolak = Number(<?= $kolak['jml'] ?>);
                        var jasa = Number(<?= $jasa['jml'] ?>);
                        Morris.Bar({
                            element: 'bar-example',
                            data: [{
                                y: '<?= $df['nama'] ?>',
                                Pemasukan: masuk,
                                Pengeluaran: keluar,
                                Penjualan: jual,
                                Kolakan: kolak,
                                Jasa: jasa,
                            }],
                            xkey: 'y',
                            ykeys: ['Pemasukan', 'Pengeluaran', 'Penjualan', 'Kolakan', 'Jasa'],
                            labels: ['Pemasukan', 'Pengeluaran', 'Penjualan', 'Kolakan', 'Jasa']
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>