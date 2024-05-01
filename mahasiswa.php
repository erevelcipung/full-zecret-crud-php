<?php
session_start();

//membatasai halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Silahkan Login terlebih dahulu!');
            document.location.href = 'login.php';
        </script>";

    exit;
}

//membatasai halaman sesuai user yang login
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3) {
    echo "<script>
            alert('Perhatian anda tidak punya hak akses!');
            document.location.href = 'crud-modal.php';
        </script>";

    exit;
}


$title = 'Daftar Mahasiswa';

include 'layout/header.php';


//menampilkan data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Mahasiswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Mahasiswa</li>
                    </ol>
                </div><!-- /.col -->

                <!-- /.content-header -->

                <!-- Main content -->
                <a href="tambah-mahasiswa.php" class="btn btn-primary mb-1 mr-1"><i class="fas fa-plus-circle"></i> Tambah</a>
                <a href="download-excel-mahasiswa.php" class="btn btn-success mb-1 mr-1"><i class="fas fa-file-excel"></i> Download Excel</a>
                <a href="download-pdf-mahasiswa.php" class="btn btn-danger mb-1 mr-1"><i class="fas fa-file-pdf"></i> Download PDF</a>

                <table class="table table-bordered table-striped mt-3" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Jenis Kelamin</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $mahasiswa['nama']; ?></td>
                                <td><?= $mahasiswa['prodi']; ?></td>
                                <td><?= $mahasiswa['jk']; ?></td>
                                <td><?= $mahasiswa['telepon']; ?></td>
                                <td class="text-center" width="20%">
                                    <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
                                    <a href="ubah-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                    <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin data mahasiswa di hapus.?')"><i class="fas fa-trash-alt"></i> Hapus</a>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php include 'layout/footer.php'; ?>