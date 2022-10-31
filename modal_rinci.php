<?php include 'header.php'; ?>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Statistik Modal</div>
        </div>
        <div class="ibox-body">

        </div>
    </div>
</div>

<?php
include 'footer.php';

if (isset($_POST['save'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $sumber = mysqli_real_escape_string($conn, $_POST['sumber']);
    $nominal = mysqli_real_escape_string($conn, preg_replace("/[^0-9]/", "", $_POST['nominal']));
    $kode = 'MDL' . rand(0, 9999999999);

    $sql = mysqli_query($conn, "INSERT INTO modal VALUES ('', '$kode', '$nama', '$sumber', '$nominal') ");

    if ($sql) {
        echo "
        <script>
            window.location = 'modal_pecah.php';
        </script>
        ";
    }
}

?>