<?php
include 'koneksi.php';
$id_kitab = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kitab WHERE id_kitab = '$id_kitab' "));
?>
<?php include 'header.php'; ?>
<div class="page-heading">
    <h1 class="page-title">Edit Kitab</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Edit Kitab</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-6">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Edit Kitab </div>
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
                            <label>Kode Kitab</label>
                            <input class="form-control" name="kd_kitab" type="text" placeholder="Masukkan Kode" value="<?= $data['kd_kitab']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" name="nama" type="text" placeholder="Masukkan Nama" value="<?= $data['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input class="form-control" name="stok" type="text" placeholder="Masukkan Stok" value="<?= $data['stok']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Harga Kolak</label>
                            <input class="form-control" name="harga_kolak" type="text" placeholder="Masukkan Harga Kolak" value="<?= $data['harga_kolak']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Harga Kolak</label>
                            <input class="form-control" name="harga_jual" type="text" placeholder="Masukkan Harga Jual" value="<?= $data['harga_jual']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input class="form-control" name="gambar" type="file" placeholder="Upload Gambar">
                        </div>

                        <div class="form-group">
                            <button name="edit" type="submit" value="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
<?php include 'footer.php'; ?>

<?php
if (isset($_POST['edit'])) {
    $kd_kitab = $_POST['kd_kitab'];
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nama']));
    $stok = $_POST['stok'];
    $harga_kolak = $_POST['harga_kolak'];
    $harga_jual = $_POST['harga_jual'];
    $gambar = $_POST['gambar'];
    $sql = mysqli_query($conn, "UPDATE kitab SET nama = '$nama',stok = '$stok',
    harga_kolak = '$harga_kolak', harga_jual = '$harga_jual', gambar = '$gambar' WHERE id_kitab = $id_kitab");

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