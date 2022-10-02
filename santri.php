<?php include 'header.php'; ?>
<div class="page-heading">
    <h1 class="page-title">Data Santri</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Data Santri</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Data Santi</div>
            <a href="tambah_kitab.php" class="btn btn-primary  btn-rounded pull-right"><i class="fa ti-plus"> Tambah Santri</i></a>
        </div>
        <div class="ibox-body">
            <br>
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kelas</th>
                        <th>Kamar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    include 'koneksi.php';
                    $sql = mysqli_query($conn, "SELECT * FROM tb_santri");
                    while ($data = mysqli_fetch_assoc($sql)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['nis']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['desa']; ?> - <?= $data['kec']; ?></td>
                            <td><?= $data['k_formal']; ?> - <?= $data['t_formal']; ?></td>
                            <td><?= $data['kamar']; ?> - <?= $data['komplek']; ?></td>
                            <td>
                                <!-- <a href="edit_kitab.php?id=<?= $data['id_kitab']; ?>" class="btn btn-warning "><i class="fa fa-pencil"></i></a>
                                <a href="<?= 'hapus_kitab.php?id_kitab=' . $data['id_kitab'] ?>" onclick="return confirm('Yakin Menghapus Data Ini?')" class="btn btn-danger "><i class="fa fa-times"></i></a> -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php include 'footer.php'; ?>