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

include 'config/app.php';
    // menerima id barang yang dipilih pengguna

    $id_mahasiswa = (int)$_GET['id_mahasiswa'];


    if (delete_mahasiswa($id_mahasiswa) > 0) {
        echo "<script>
            alert('Data Mahasiswa berhasil dihapus');
            document.location.href = 'mahasiswa.php';
        </script>";
    }else {
        echo "<script>
        alert('Data Mahasiswa Gagal dihapus');
        document.location.href = 'mahasiswa.php';
    </script>";
    }