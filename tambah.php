<?php
session_start();

    if ( !isset($_SESSION["login"])) {
         header("location: login.php");
    exit;
}
require 'functions.php';

//cek apakah tombol submit sudah ditekan atau belum
if (isset ($_POST["submit"]) ) {
    
    

     // cek apakah data berhasil ditambahkan atau tidak
    if ( tambah($_POST) > 0 ) {
        echo"
            <script> 
                     alert('data berhasil ditambahkan!');
                    document.location.href = 'index.php'; 
            </script>";
    } else {
        echo"
            <script> 
                     alert('data gagal ditambahkan!');
                    document.location.href = 'index.php'; 
            </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body>
    <h1>Tambah data mahasiswa</h1>

    <form action="" method="post"enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama"
                required>
             </li>
            <li>
                <label for="npm">Npm: </label>
                <input type="text" name="npm" id="npm"
                required>
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email"
                required>
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan"
                required>
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="File" name="gambar" id="gambar">
            </li>
            <li>
            <button type="submit" name="submit">Tambah Data!</button>
            </li>
        </ul>
    
    
    
    </form>



</body>
</html>