<?php
require 'assets/vendor/autoload.php';
// require_once __DIR__ . '/assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$nama_dokumen = 'Cetak-Barcode-Barang';
ob_start();
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

    <table class="table table-bordered">
        <?php
        $no = 1;
        include 'koneksi.php';
        $sql = mysqli_query($conn, "SELECT * FROM kitab");
        $jml = mysqli_num_rows($sql);
        
        for ($i = 0; $i < $jml; $i++) {
            $sql2 = mysqli_query($conn, "SELECT * FROM kitab LIMIT $i, 5");
            if ($i % 5 == 0) {
                ?> <tr> <?php
                while ($data = mysqli_fetch_assoc($sql2)) {
        ?>
                        <td class="text-center">
                            <?php
                            $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
                            file_put_contents('assets/barcode/' . $data['kd_kitab'] . '.jpg', $generator->getBarcode($data['kd_kitab'], $generator::TYPE_CODE_128, 1, 50));
                            // echo $generator->getBarcode($data['kd_kitab'], $generator::TYPE_CODE_128, 1, 50);
                            ?>
                            <img src="<?= 'assets/barcode/' . $data['kd_kitab'] . '.jpg' ?>">
                            <br>
                            <small><?= $data['nama'] ?></small>
                        </td>
                        <?php }
                     ?> </tr> <?php
            }
        }
        ?>
    </table>

</div>

<?php
$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output("" . $nama_dokumen . ".pdf", 'D');
// // $db1->close();
?>