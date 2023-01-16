<?php
include 'koneksi.php';
include 'header.php';

$kd = $_GET['kd'];
$sql = mysqli_query($conn, "SELECT * FROM penjualan WHERE kd_jual = '$kd' ");

$datas = mysqli_fetch_assoc($sql);
$kd_jual = $datas['kd_jual'];
?>

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Detail penjualan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Detail Penjualan</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Penjualan</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item">option 1</a>
                            <a class="dropdown-item">option 2</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">No. Nota</label>
                                    <div class="col-sm-10">
                                        <input class="form-control form-control-sm" type="text"
                                            value="<?= $datas['kd_jual']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input class="form-control form-control-sm" type="text"
                                            value="<?= $datas['tanggal']; ?>" readonly>
                                    </div>
                                </div>
                            </form>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <!-- <small>TOTAL BELANJA</small> -->
                            <p style="font-weight: bold; font-size: 50px; text-align: right;">
                                <?= rupiah($datas['total']); ?></p>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <form method="post">
                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <input class="form-control" name="kode" type="text" placeholder="Scan Barcode"
                                            required autofocus>
                                    </div>
                                    <div class="col-sm-1 form-group">
                                        <button type="submit" name="cari" class="btn btn-md btn-primary"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <button type="button" class="btn btn-md btn-success" data-toggle="modal"
                                            data-target=".bd-example-modal-lg">Cari Barang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php if (isset($_POST['cari']) || isset($_POST['pilih'])) {
                            $kodekk = $_POST['kode'];
                            $ktb = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kitab WHERE kd_kitab = '$kodekk' "));
                        ?>
                        <div class="col-md-12">
                            <form action="" method="post">
                                <input type="hidden" name="kd_jual" value="<?= $kd_jual; ?>">
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label for="">Kode</label>
                                        <input name="kd_kitab" class="form-control" type="text"
                                            placeholder="Kode Barang" value="<?= $ktb['kd_kitab']; ?>" readonly>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="">Nama Barang</label>
                                        <input class="form-control" type="text" placeholder="Nama Barang"
                                            value="<?= $ktb['nama']; ?>" readonly>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label for="">Harga</label>
                                        <input class="form-control" type="text" placeholder="Harga Satuan"
                                            value="<?= rupiah($ktb['harga_jual']); ?>" readonly>
                                    </div>
                                    <div class="col-sm-1 form-group">
                                        <label for="">Stok</label>
                                        <input class="form-control" type="text" placeholder="Stok"
                                            value="<?= $ktb['stok']; ?>" readonly>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label for="">QTY</label>
                                        <input class="form-control" type="number" placeholder="QTY" name="jumlah"
                                            required>
                                    </div>
                                    <div class="col-sm-1 form-group">
                                        <label for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <button class="btn btn-success" name="simpan" type="submit"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php } ?>

                        <div class="col-md-12">
                            <br>
                            <table class="table table-striped table-bordered table-hover table-sm" id="example-table"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr style="background-color: greenyellow;">
                                        <th>No</th>
                                        <th>Kitab</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sql = mysqli_query($conn, "SELECT d.id_dtj, d.jumlah, d.total, k.nama, k.harga_jual FROM detail_jual d JOIN kitab k ON d.kd_kitab = k.kd_kitab WHERE d.kd_jual = '$kd' ");
                                    while ($data = mysqli_fetch_assoc($sql)) {

                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?= rupiah($data['harga_jual']); ?></td>
                                        <td><?= $data['jumlah']; ?></td>
                                        <td><?= rupiah($data['total']); ?></td>
                                        <td>
                                            <a href="hapus_detail_jual.php?id=<?= $data['id_dtj']; ?>"
                                                onclick="return confirm('Yakin Akan Menghapus Data Ini ?')"
                                                class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                data-original-title="Delete"><i class="fa fa-trash font-14"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 mt-3">
                            <table class="table table-sm">
                                <tr>
                                    <th>TOTAL BELANJA</th>
                                    <th>:</th>
                                    <th><?= rupiah($datas['total']); ?></th>
                                </tr>
                                <tr>
                                    <th>BAYAR</th>
                                    <th>:</th>
                                    <th><?= rupiah($datas['bayar']); ?></th>
                                </tr>
                                <tr>
                                    <th>KEMBALI</th>
                                    <th>:</th>
                                    <th><?= rupiah($datas['kembali']); ?></th>
                                </tr>
                                <tr>
                                    <th>
                                        <a href="nota.php?kd=<?= $kd_jual ?>" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-print"></i> Cetak
                                            Nota</a>
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-2 mt-3">
                        </div>
                        <div class="col-md-6 mt-3">
                            <form class="form-horizontal" action="" method="POST" name="autoSumForm">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jumlah </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="<?= $datas['jml_jual']; ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Total</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="<?= rupiah($datas['total']); ?>">
                                        <input type="hidden" name="total" value="<?= $datas['total']; ?>"
                                            onFocus="startCalc();" onBlur="stopCalc();" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Bayar </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" placeholder="Nominal Bayar"
                                            name="bayar" onFocus="startCalc();" onBlur="stopCalc();">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kembali</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="kembali" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10 ml-sm-auto">
                                        <button class="btn btn-info" name="majer" type="submit"
                                            value="submit">Bayar</button>
                                    </div>
                                </div>
                            </form>
                            <script>
                            function startCalc() {

                                interval = setInterval("calc()", 1);
                            }

                            function calc() {
                                total = document.autoSumForm.total.value;
                                bayar = document.autoSumForm.bayar.value;
                                document.autoSumForm.kembali.value = bayar - total;
                            }

                            function stopCalc() {

                                clearInterval(interval);
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                Tambah pecah modal
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover table-sm" id="example-table2"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Harga Kolak</th>
                            <th>Harga Jual</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        // include 'koneksi.php';
                        $sql = mysqli_query($conn, "SELECT a.*, b.nama as nmMd FROM kitab a JOIN modal b ON a.kategori=b.kode ");
                        while ($data = mysqli_fetch_assoc($sql)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <?= $data['kd_kitab']; ?>

                            </td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['stok']; ?></td>
                            <td><?= rupiah($data['harga_kolak']); ?></td>
                            <td><?= rupiah($data['harga_jual']); ?></td>
                            <td><?= $data['nmMd']; ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="kode" value="<?= $data['kd_kitab']; ?>">
                                    <button type="submit" name="pilih" class="btn btn-success btn-primary btn-sm"><i
                                            class="fa fa-check"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php';

if (isset($_POST['simpan'])) {
    $kd_kitab = $_POST['kd_kitab'];
    $jumlah = $_POST['jumlah'];
    $kd_jual = $_POST['kd_jual'];

    $dtkitab = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kitab WHERE kd_kitab = '$kd_kitab' "));
    $total = $jumlah * $dtkitab['harga_jual'];
    $stok = $dtkitab['stok'];
    $kate = $dtkitab['kategori'];

    if ($stok < $jumlah) {
        echo "
        <script type='text/javascript'>
            alert('Maaf Stok kitab tidak mencukupi');
            window.location.href = 'detail_penjualan.php?kd=" . $kd . "';
        </script>
        ";
    } else {
        $sql = mysqli_query($conn, "INSERT INTO detail_jual VALUES('', '$kd_jual', '$kd_kitab', '$kate', '$jumlah', '$total')");

        $jmljual = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) AS jmlKitab, SUM(total) AS totHarga FROM detail_jual WHERE kd_jual = '$kd_jual' "));

        $jmlKitab = $jmljual['jmlKitab'];
        $totHarga = $jmljual['totHarga'];

        $sql2 = mysqli_query($conn, "UPDATE penjualan SET jml_jual = '$jmlKitab', total = '$totHarga' WHERE kd_jual = '$kd_jual' ");
        $sql3 = mysqli_query($conn, "UPDATE kitab SET stok = stok - $jumlah WHERE kd_kitab = '$kd_kitab' ");
        if ($sql && $sql2 && $sql3) {
            echo "
        <script type='text/javascript'>
            alert('Data Berhasil Di Simpan');
            window.location.href = 'detail_penjualan.php?kd=" . $kd . "';
        </script>
        ";
        }
    }
}

if (isset($_POST['majer'])) {
    $bayar = $_POST['bayar'];
    $kembali = $_POST['kembali'];
    // $totalbayar = $_POST['total'];


    $sql = mysqli_query($conn, "UPDATE penjualan SET bayar = $bayar, kembali = $kembali  WHERE kd_jual = '$kd_jual' ");
    // $sql2 = mysqli_query($conn, "UPDATE penjualan SET bayar = bayar - $totalbayar WHERE kd_kitab = '$kd_kitab' ");


    if ($sql) {
        echo "
        <script>
            alert('Berhasil Di Bayar');
            window.location = 'detail_penjualan.php?kd=" . $kd_jual . "';
        </script>
        ";
    }
}
?>