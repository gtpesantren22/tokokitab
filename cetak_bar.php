<?php
require 'assets/vendor/autoload.php';

                    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                    echo $generator->getBarcode($data['kd_kitab'], $generator::TYPE_CODE_128, 1, 50);
                    ?>
                    // <?= $data['nama'] ?>
$content = "


<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link href='./assets/vendors/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
    <script src='./assets/vendors/bootstrap/dist/js/bootstrap.min.js' type='text/javascript'></script>
</head>

<body>
    <div class='container-fluid'>
        ".
        $no = 1;
        include 'koneksi.php';
        $sql = mysqli_query($conn, 'SELECT a.*, b.nama as nmMd FROM kitab a JOIN modal b ON a.kategori=b.kode ');
        while ($data = mysqli_fetch_assoc($sql)) {
        "


            <div class='card' style='width: 10rem;'>
                <div class='card-body text-center'>
                   
                </div>
            </div>

        
    </div>
</body>

</html>

"

?>