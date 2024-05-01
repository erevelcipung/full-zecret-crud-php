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
        <div class="container">
            <div class="mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Mahasiswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Tambah Mahasiswa</li>
                    </ol>
                </div><!-- /.col -->

                <!-- /.content-header -->

                <!-- Main content -->
                <form action="" method="post" enctype="multipart/form-data"> <!-- jika mewajibkan mengunggah sebuah file pake enctype -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa..." required>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select name="prodi" id="prodi" class="form-control" required>
                                <option value="">-- Pilih Prodi --</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Teknik Industri">Teknik Industri</option>
                                <option value="Kesenian">Kesenian</option>
                            </select>
                        </div>

                        <div class="mb-3 col-6">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control" required>
                                <option value="">-- Jenis Kelamin --</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon..." required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email..." required>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto..." onchange="previewImg()">

                        <img src="" alt="" class="img-thumbnail img-preview mt-2" width="100px">
                    </div>

                    <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
                </form>
            </div>

            <!-- Preview Image -->
            <script>
                function previewImg() {
                    const foto = document.querySelector('#foto');
                    const imgPreview = document.querySelector('.img-preview');

                    const fileFoto = new FileReader();
                    fileFoto.readAsDataURL(foto.files[0]);

                    fileFoto.onload = function(e) {
                        imgPreview.src = e.target.result;
                    }
                }
            </script>
        </div>
    </div>
</div>

</div>

<?php include 'layout/footer.php'; ?>