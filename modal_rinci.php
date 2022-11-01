<?php
include 'header.php';
include 'koneksi.php';

$kd = $_GET['id'];
$df = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM modal WHERE kode = '$kd' "));

?>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Statistik Modal</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-info color-white widget-stat">
                        <div class="ibox-body">
                            <h3 class="m-b-5 font-strong"><?= rupiah($df['nominal']); ?></h3>
                            <div class="m-b-5">Modal Awal</div><i class="ti-book widget-stat-icon"></i>
                            <div>
                                <a href="#" class="small-box-footer color-white ">
                                    Lihat Selengkapnya <i class="fa fa-arrow-circle-right color-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-success color-white widget-stat">
                        <div class="ibox-body">
                            <h3 class="m-b-5 font-strong">0</h3>
                            <div class="m-b-5">Pemasukan</div><i class="ti-user widget-stat-icon"></i>
                            <div><a href="santri.php" class="small-box-footer color-white ">
                                    Lihat Selengkapnya <i class="fa fa-arrow-circle-right color-white"></i>
                                </a></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-danger color-white widget-stat">
                        <div class="ibox-body">
                            <h3 class="m-b-5 font-strong">108</h3>
                            <div class="m-b-5">Pengeluaran</div><i class="ti-user widget-stat-icon"></i>
                            <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-warning color-white widget-stat">
                        <div class="ibox-body">
                            <h3 class="m-b-5 font-strong">$1570</h3>
                            <div class="m-b-5">Saldo</div><i class="fa fa-money widget-stat-icon"></i>
                            <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>