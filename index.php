<?php
include 'header.php';
include 'koneksi.php';

$masuk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IF(SUM(nominal) IS null, 0, SUM(nominal)) as jml FROM masuk"));
$keluar =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT IF(SUM(nominal) IS null, 0, SUM(nominal)) as jml FROM keluar"));
$jual =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT IF(SUM(total) IS null, 0, SUM(total)) as jml FROM detail_jual"));
$kolak =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT IF(SUM(total) IS null, 0, SUM(total)) as jml FROM detail_kolakan"));
$jasa =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT IF(SUM(debet) IS null, 0, SUM(debet)) AS jasa_masuk, IF(SUM(kredit) IS null, 0, SUM(kredit)) AS jasa_keluar FROM jasa"));

$pemasuk = $masuk['jml'] + $jual['jml'] + $jasa['jasa_masuk'];
$pekeluar = $keluar['jml'] + $kolak['jml'] + $jasa['jasa_keluar'];
?>
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Dashboard</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Dashboard</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong"><?= rupiah($pemasuk) ?></h2>
                    <div class="m-b-5">Pemasukan</div><i class="ti-user widget-stat-icon"></i>
                    <div><a href="#" class="small-box-footer color-white ">
                            Lihat Selengkapnya <i class="fa fa-arrow-circle-right color-white"></i>
                        </a></div>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong"><?= rupiah($pekeluar) ?>
                    </h2>
                    <div class="m-b-5">Pengeluaran</div><i class="fa fa-money widget-stat-icon"></i>
                    <div><a href="#" class="small-box-footer color-white ">
                            Lihat Selengkapnya <i class="fa fa-arrow-circle-right color-white"></i>
                        </a></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong"><?= rupiah($pemasuk - $pekeluar) ?></h2>
                    <div class="m-b-5">Saldo</div><i class="ti-book widget-stat-icon"></i>
                    <div> <a href="#" class="small-box-footer color-white ">
                            Lihat Selengkapnya <i class="fa fa-arrow-circle-right color-white"></i>
                        </a></div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-body">
                    <div class="flexbox mb-4">
                        <div>
                            <h3 class="m-0">Statistics Modal</h3>
                            <div>Statistik Penggunaan Modal</div>
                        </div>
                        <div class="d-inline-flex">
                        </div>
                    </div>
                    <div>
                        <div id="bar-example"></div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
                        <script src="morris/morris.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
                        <script src="morris/examples/lib/example.js"></script>
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
                        <link rel="stylesheet" href="morris/morris.css">
                        <script>
                        Morris.Bar({
                            element: 'bar-example',
                            data: [
                                <?php
                                    $sqlr = mysqli_query($conn, "SELECT * FROM modal ");
                                    while ($ar = mysqli_fetch_assoc($sqlr)) {
                                        $ktg = $ar['kode'];
                                        $masuk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IF(SUM(nominal) IS null, 0, SUM(nominal)) as jml FROM masuk WHERE kategori = '$ktg' "));
                                        $keluar =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT IF(SUM(nominal) IS null, 0, SUM(nominal)) as jml FROM keluar WHERE kategori = '$ktg' "));
                                        $jual =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT IF(SUM(total) IS null, 0, SUM(total)) as jml FROM detail_jual WHERE kategori = '$ktg'"));
                                        $kolak =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT IF(SUM(total) IS null, 0, SUM(total)) as jml FROM detail_kolakan WHERE kategori = '$ktg'"));
                                        $jasa =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT IF(SUM(debet) IS null, 0, SUM(debet)) AS jasa_masuk, IF(SUM(kredit) IS null, 0, SUM(kredit)) AS jasa_keluar FROM jasa WHERE kategori = '$ktg'"));

                                    ?> {
                                    y: '<?= $ar['nama'] ?>',
                                    Pemasukan: Number(<?= $masuk['jml'] ?>),
                                    Pengeluaran: Number(<?= $keluar['jml'] ?>),
                                    Penjualan: Number(<?= $jual['jml'] ?>),
                                    Kolakan: Number(<?= $kolak['jml'] ?>),
                                    Jasa: Number(<?= $jasa['jasa_masuk'] ?>),
                                    Jasa2: Number(<?= $jasa['jasa_keluar'] ?>)
                                },
                                <?php } ?>
                            ],
                            xkey: 'y',
                            ykeys: ['Pemasukan', 'Pengeluaran', 'Penjualan', 'Kolakan', 'Jasa', 'Jasa2'],
                            labels: ['Pemasukan', 'Pengeluaran', 'Penjualan', 'Kolakan', 'Jasa Debet',
                                'Jasa Kredit'
                            ]
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Statistics</div>
                </div>
                <div class="ibox-body">

                </div>
            </div>
        </div> -->
    </div>

</div>
<!-- END PAGE CONTENT-->
<?php include 'footer.php'; ?>