<?php

//nge render halaman dari array menjadi json
header('Content-Type: application/json'); 

require '../config/app.php';

// menerima rquest put/delete
parse_str(file_get_contents('php://input'), $delete);

//menerima input id data yang akan dihapus
$id_barang = $delete['id_barang'];


//query hapus data
$query = "DELETE FROM barang WHERE id_barang = $id_barang";
mysqli_query($db, $query);

//cek status data
if ($query) {
    echo json_encode(['pesan' => 'Data barang berhasil Dihapus']);
}else{
    echo json_encode(['pesan' => 'Data barang gagal Dihapus']);
}



?>