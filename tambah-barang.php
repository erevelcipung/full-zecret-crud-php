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

$title = 'Tambah Barang';

include 'layout/header.php';

//cek apakah tombol tambah ditekan
if (isset($_POST['tambah'])){
    if (create_barang($_POST) > 0){
        echo "<script>
        alert('Data barang berhasil ditambahkan!');
        document.location.href = 'index.php';
            </script>";
    }else{
        echo "<script>
        alert('Data barang gagal ditambahkan!');
        document.location.href = 'index.php';
            </script>";
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-plus"></i> Tambah Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Data Barang</a></li>
                        <li class="breadcrumb-item active">Tambah Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang..." required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="jumlah barang..." required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang..." required>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
    </form>
        </div>
    </section>

</div>

<?php include 'layout/footer.php'; ?>