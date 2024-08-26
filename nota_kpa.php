<?php
include 'header.php';
include 'koneksi.php';
?>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Data Nota Belanja</div>
            <select name="tahun" id="select-tahun" class="form-control pull-right">
                <?php
                $thndata = mysqli_query($sentral, "SELECT * FROM tahun ORDER BY nama_tahun DESC");
                while ($thn = mysqli_fetch_array($thndata)) {
                ?>
                    <option value="<?= $thn['nama_tahun']; ?>"><?= $thn['nama_tahun']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="ibox-body">
            <br>
            <div id="hasil-data"></div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "datanota.php",
            data: {
                "tahun": ""
            },
            success: function(data) {
                $('#hasil-data').html(data);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        })
    });
</script>