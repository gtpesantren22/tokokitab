<?php
require 'assets/vendor/autoload.php';
// require_once __DIR__ . '/assets/vendor/autoload.php';
include 'koneksi.php';
$kode = $_POST['kd_kitab'];

$sql2 = mysqli_query($conn, "SELECT * FROM kitab WHERE kd_kitab = '$kode' ");
$data = mysqli_fetch_assoc($sql2);

?>
<link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

<div class="container-fluid">
    <!-- <div class="row">
    
            <div class="col-md-3">
                <div class="card" style="width: 10rem;">
                    <div class="card-body text-center">

                    </div>
                </div>
            </div>
       
    </div> -->

    <div class="text-center mt-1">
        <?php
        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        file_put_contents('assets/barcode/' . $data['kd_kitab'] . '.jpg', $generator->getBarcode($data['kd_kitab'], $generator::TYPE_CODE_128, 1, 50));
        // echo $generator->getBarcode($data['kd_kitab'], $generator::TYPE_CODE_128, 1, 50);
        ?>
        <img src="<?= 'assets/barcode/' . $data['kd_kitab'] . '.jpg' ?>">
        <br>
        <small><?= $data['nama'] ?></small>
    </div>
</div>

<script>
    window.print()
</script>