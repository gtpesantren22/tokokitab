<?php
require 'assets/vendor/autoload.php';
require 'assets/vendor/spipu/html2pdf/src/Html2Pdf.php';
require 'koneksi.php';
$sql = mysqli_query($conn, "SELECT * FROM kitab ");
?>


<?php
ob_start();

use Spipu\Html2Pdf\Html2Pdf;

$filename = "Cetak Barcode.pdf";
$content = ob_get_clean();
$content = "<p style='width: 210mm; font-size: 11pt;'><span style='font-size: 10pt;'>Barcode Barang Unit Usaha</span></p>
                <table cellpadding='0' cellspacing='1' style='width: 210mm;'>";
while ($data = mysqli_fetch_assoc($sql)) {
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
    $spg = $generator->getBarcode($data['kd_kitab'], $generator::TYPE_CODE_128, 1, 50);
    $nama = $data['nama'];
    $content .= "<tr bgcolor='#FFFFFF' border=1>
                        <td>$spg $nama</td>
                    </tr>";
}
$content .= "</table>";
ob_end_clean();
// conversion HTML => PDF
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'fr', false, 'ISO-8859-15', array(2, 2, 2, 2));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
} catch (HTML2PDF_exception $e) {
    echo $e;
}
?>