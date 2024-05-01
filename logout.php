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

//kosongkan $_SESSION user login
$_SESSION = [];

session_unset();
session_destroy();

header("Location: login.php");

?>