<?php
include 'header.php';


?>
<div class="page-heading">
    <h1 class="page-title">Rekap Data</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">DataTables</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Rekap Data Pengeluaran</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-4 col-md-4">
                    <div class="form-group">
                        <label for="">Dari Tanggal</label>
                        <input type="date" name="dari" id="dariKeluar" class="form-control" required>
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <div class="form-group">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" name="sampai" id="sampaiKeluar" class="form-control" required>
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label for="">Download</label><br>
                    <button class="btn btn-success" onclick="cetakKeluar()">Download</button>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Rekap Data Pemasukan</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-4 col-md-4">
                    <div class="form-group">
                        <label for="">Dari Tanggal</label>
                        <input type="date" name="dari" id="dariMasuk" class="form-control" required>
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <div class="form-group">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" name="sampai" id="sampaiMasuk" class="form-control" required>
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label for="">Download</label><br>
                    <button class="btn btn-success" onclick="cetakMasuk()">Download</button>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Rekap Data Penjualan</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-4 col-md-4">
                    <div class="form-group">
                        <label for="">Dari Tanggal</label>
                        <input type="date" name="dari" id="dariJual" class="form-control" required>
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <div class="form-group">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" name="sampai" id="sampaiJual" class="form-control" required>
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label for="">Download</label><br>
                    <button class="btn btn-success" onclick="cetakJual()">Download</button>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include 'footer.php'; ?>

<script>
    function cetakKeluar() {
        var dari = $('#dariKeluar').val();
        var sampai = $('#sampaiKeluar').val();

        $.ajax({
            url: 'cetakPengeluaran.php',
            data: {
                dari: dari,
                sampai: sampai
            },

            type: 'POST',
            success: function(data) {

                window.open("cetakPengeluaran.php?dari=" + dari + "&sampai=" + sampai, "_blank");
            }
        });
    }

    function cetakMasuk() {
        var dari = $('#dariMasuk').val();
        var sampai = $('#sampaiMasuk').val();

        $.ajax({
            url: 'cetakPemasukan.php',
            data: {
                dari: dari,
                sampai: sampai
            },

            type: 'POST',
            success: function(data) {

                window.open("cetakPemasukan.php?dari=" + dari + "&sampai=" + sampai, "_blank");
            }
        });
    }

    function cetakJual() {
        var dari = $('#dariJual').val();
        var sampai = $('#sampaiJual').val();

        $.ajax({
            url: 'cetakPenjualan.php',
            data: {
                dari: dari,
                sampai: sampai
            },

            type: 'POST',
            success: function(data) {
                window.open("cetakPenjualan.php?dari=" + dari + "&sampai=" + sampai, "_blank");
            }
        });
    }
</script>