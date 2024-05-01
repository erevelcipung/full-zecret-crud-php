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

    $id_akun = (int)$_GET['id_akun'];


    if (delete_akun($id_akun) > 0) {
        echo "<script>
            alert('Data Akun berhasil dihapus');
            document.location.href = 'crud-modal.php';
        </script>";
    }else {
        echo "<script>
        alert('Data Akun Gagal dihapus');
        document.location.href = 'crud-modal.php';
    </script>";
    }