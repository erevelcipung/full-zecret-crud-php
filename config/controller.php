<?php

//fungsi menampilkan data
function select($query)
{
    //panggil koneksi dari database.php
    global $db;

    $result = mysqli_query($db, $query);
    $rows   = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// fungsi menambahkan data barang
function create_barang($post)
{
    global $db;


    $nama      = strip_tags($post['nama']);
    $jumlah    = strip_tags($post['jumlah']);
    $harga     = strip_tags($post['harga']);
    $barcode   = rand(10000, 999999);

    // query tambah data
    $query = "INSERT INTO barang VALUES(null, '$nama', '$jumlah', '$harga', '$barcode', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menggubah data barang
function update_barang($post)
{
    global $db;

    $id_barang = strip_tags($post['id_barang']);

    $nama      = strip_tags($post['nama']);
    $jumlah    = strip_tags($post['jumlah']);
    $harga     = strip_tags($post['harga']);
    


    // query ubah data
    $query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga' WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// fungsi menghapus data barang

function delete_barang($id_barang)
{
    global $db;

    //query hapus data barang
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// fungsi menambahkan data Mahasiswa
function create_mahasiswa($post)
{
    global $db;

    $nama       = strip_tags($post['nama']); //htmlspecialchars dan strip_tags untuk memfilter input supaya gak terjadi hack XSS
    $prodi      = strip_tags($post['prodi']);
    $jk         = strip_tags($post['jk']);
    $telepon    = strip_tags($post['telepon']);
    $alamat     = $post['alamat'];
    $email      = strip_tags($post['email']);
    $foto       = upload_file();

    //cek upload foto
    if (!$foto) {
        return false;
    }

    // query tambah data
    $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$prodi', '$jk', '$telepon', '$alamat', '$email', '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi ubah mahasiswa
function update_mahasiswa($post)
{
    global $db;
    $id_mahasiswa   = strip_tags($post['id_mahasiswa']);
    $nama           = strip_tags($post['nama']); //htmlspecialchars dan strip_tags untuk memfilter imnput supaya gak terjadi hack XSS
    $prodi          = strip_tags($post['prodi']);
    $jk             = strip_tags($post['jk']);
    $telepon        = strip_tags($post['telepon']);
    $alamat         = $post['alamat'];
    $email          = strip_tags($post['email']);
    $fotoLama       = strip_tags($post['fotoLama']);

    //cek upload foto baru atau tidak
    if ($_FILES['foto']['error']  == 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_file();
    }

    // query ubah data
    $query = "UPDATE mahasiswa SET nama = '$nama', prodi ='$prodi', jk = '$jk', telepon = $telepon, alamat = '$alamat', email = '$email', foto = '$foto' WHERE id_mahasiswa = $id_mahasiswa ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi mengupload file
function upload_file()
{
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name']; //tmpName itu tempat penyimpanan sementara

    //cek file yg di upload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile)); //strtolower untuk mengecilkan semua teksnya suapaya tdak kapital

    //cek format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {

        // pesan gagal
        echo "<script>
                alert('Format File Tidak Valid');
                document.location.href = 'tambah-mahasiswa.php';
            </script>";
        die();
    }

    // cek ukuran file 2mb
    if ($ukuranFile > 2048000) {

        echo "<script>
                alert('Ukuran File maximal 2 MB !');
                document.location.href = 'tambah-mahasiswa.php';
            </script>";
        die();
    }

    //GENERATE NAMA FILE BARU SUPAYA AMAN DARI MALWARE/VIRUS
    $namaFileBaru = Uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    //pindahkan ke folder local
    move_uploaded_file($tmpName, 'assets/images/' . $namaFileBaru);
    return $namaFileBaru;
}

//fungsi delete mahasiswa
function delete_mahasiswa($id_mahasiswa)
{
    global $db;

    // ambil foto sesuai data yag dipilih
    $foto = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
    unlink("assets/images/". $foto['foto']); //unlink inni utk menghapus file foto di file assets/images

    //query hapus data mahasiswa
    $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

////////////////////////////////////////////////////////////////////////////////////////////////

// Fungsi tambah akun
function create_akun($post) {
    global $db;

    $nama       = strip_tags($post['nama']); //htmlspecialchars dan strip_tags untuk memfilter imnput supaya gak terjadi hack XSS
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $level      = strip_tags($post['level']);

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query tambah data
    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi delete akun
function delete_akun($id_akun)
{
    global $db;

    //query hapus data akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi ubah akun
function update_akun($post) {
    global $db;

    $id_akun    = strip_tags($post['id_akun']);
    $nama       = strip_tags($post['nama']); //htmlspecialchars dan strip_tags untuk memfilter imnput supaya gak terjadi hack XSS
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $level      = strip_tags($post['level']);

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query ubah data
    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}