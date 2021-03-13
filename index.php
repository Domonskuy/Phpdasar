 <?php
    session_start();

    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';
    $mahasiswa = query("SELECT * FROM mahasiswa ");

    // tombol cari ditekan
    if (isset($_POST["cari"])) {
        $mahasiswa = cari($_POST["keyword"]);
    }

    ?>
 <!DOCTYPE html>
 <html>

 <head>
     <title>Halaman Admin</title>
     <style>
         .loader {
             width: 100px;
             position: absolute;
             top: 121px;
             left: 290px;
             z-index: -1;
             display: none;
         }

         @media print {

             .logout,
             .tambah,
             .form-cari,
             .aksi {
                 display: none;
             }
         }
     </style>
     <script src="js/jquery-3.5.1.min.js"></script>
     <script src="js/script.js"></script>
     <link rel="stylesheet" href="css/bootstrap.css" />
 </head>

 <body>
     <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
             <div class="container-fluid">
                 <a class="navbar-brand" href="#">Navbar</a>
                 <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                     <div class="navbar-nav">
                         <a class="nav-link active" aria-current="page" href="logout.php" class="logout">Logout</a>
                         <a class="nav-link" href="cetak.php">Cetak</a>
                         <a class="nav-link" href="registrasi.php">Registrasi</a>
                     </div>
                 </div>
             </div>
         </nav>
     </div>

     <h1>Daftar Mahasiswa</h1>
     </div>

     <a href="tambah.php" class="tambah mb-4">Tambah Data Mahasiswa</a>
     <br><br>

     <form action="" method="post" class="form-cari">

         <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian.." autocomplete="off" id="keyword">
         <button type="submit" name="cari" id="tombol-cari">Cari!</button>

         <img src="img/loader.gif" class="loader ">
     </form>

     <br></Br>
     <div class="container">
         <table border="1" cellpadding="10" cellspacing="0">
             <tr>
                 <th>No.</th>
                 <th class="aksi">Aksi</th>
                 <th>Gambar</th>
                 <th>NPM</th>
                 <th>Nama</th>
                 <th>Email</th>
                 <th>Jurusan</th>
             </tr>

             <?php $i = 1; ?>
             <?php foreach ($mahasiswa as $row) : ?>
                 <tr>
                     <td><?= $i; ?></td>
                     <td class="aksi">
                         <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
                         <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Anda Yakin Nih?');">Hapus</a>
                     </td>
                     <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
                     <td><?= $row["npm"]; ?></td>
                     <td><?= $row["nama"]; ?></td>
                     <td><?= $row["email"]; ?></td>
                     <td><?= $row["jurusan"]; ?></td>
                 </tr>
                 <?php $i++; ?>
             <?php endforeach; ?>
         </table>
     </div>

 </body>

 </html>