<?php
include 'header.php';
include 'koneksi.php';
$tgl = date('d');
$mou = date('m');
$kodektb = 'KTB-' . rand(0, 999999);
?>

<div class="page-heading">
    <h1 class="page-title">Tambah Kitab</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Tambah Kitab</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-6">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Tambah Kitab </div>
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
                    <form action="" method="POST">

                        <div class="form-group">
                            <label>Kode Jual</label>
                            <input class="form-control" name="kd_kitab" type="text" value="<?= $kodektb; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="kategori" id="" class="form-control" required>
                                <option value=""> --pilih kategori-- </option>
                                <?php
                                $sql = mysqli_query($conn, "SELECT * FROM modal");
                                foreach ($sql as $ro) :
                                ?>
                                    <option value="<?= $ro['kode']; ?>"><?= $ro['kode'] . ' - ' . $ro['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" name="nama" type="text" placeholder="Masukkan Nama">
                        </div>

                        <div class="form-group">
                            <label>Harga Kolak</label>
                            <input class="form-control uang" name="harga_kolak" type="text" placeholder="Masukkan Harga Kolak">
                        </div>
                        <div class="form-group">
                            <label>Harga Jual</label>
                            <input class="form-control uang" name="harga_jual" type="text" placeholder="Masukkan Harga Jual">
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input class="form-control" name="gambar" type="file" placeholder="Upload Gambar ">
                        </div>

                        <div class="form-group">
                            <button type="submit" value="submit" name="simpan" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
<?php include 'footer.php'; ?>

<?php
if (isset($_POST['simpan'])) {
    $kd_kitab = $_POST['kd_kitab'];
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];
    $harga_kolak = preg_replace("/[^0-9]/", "", $_POST['harga_kolak']);
    $harga_jual = preg_replace("/[^0-9]/", "", $_POST['harga_jual']);
    $gambar = $_POST['gambar'];
    $kategori = $_POST['kategori'];
    $sql = mysqli_query($conn, "INSERT INTO kitab VALUES('','$kd_kitab', '$kategori', '$nama','$stok','$harga_kolak','$harga_jual','$gambar')");
    if ($sql) {
?>
        <script type="text/javascript">
            alert("Data Berhasil Di Simpan");
            window.location.href = "kitab.php";
        </script>
<?php
    }
}
?>