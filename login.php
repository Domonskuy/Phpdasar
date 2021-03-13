<?php
session_start(); // memulai session
require 'functions.php'; // mengubungkan dengan function
    // // cek cookie
    if ( isset ($_COOKIE['id']) && isset($_COOKIE['key']) ) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        // ambil username berdasarkan id
        $result = mysqli_query($conn, "SELECT * FROM user WHERE 
        id = $id");
        $row = mysqli_fetch_assoc($result);

        // cek cookie dan username
        if ( $key === hash('sha256', $row['username']) ) {
            $_SESSION['login'] = true;
        }
    }

if ( isset($_SESSION["login"]) ) { // jika berhasil login diarahkan ke index
    header("Location : index.php");
    exit;
}

 
    // cek tombol submit sudah ditekan
    if ( isset($_POST["login"]) ){

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE 
        username = '$username'");  

        // cek username
        if ( mysqli_num_rows($result) === 1) {

            // cek password
            $row = mysqli_fetch_assoc($result);
            if ( password_verify($password, $row["password"]) ){
                // set session
                $_SESSION["login"] = true;
                
                // cek remember me
                if ( isset($_POST['remember']) ) {
                    //buat cookie

                    setcookie('id', $row['id'], time() + 60 );
                    setcookie('key', hash('sha256', $row['username']),
                        time() + 60);
                } 
                
                 
                header ("Location: index.php");
                exit;
            }
        }
        $error =true;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Halaman Login</h1>

<?php if ( isset($error) ) : ?>
<p style= "color:red; font-style:italic;"> 
            username / password salah </p>
<?php endif; ?>

<div class="kotak_login">
<form action="" method="post">

            <label>Username</label>
			<input type="text" name="username" id="username" class="form_login" autocomplete="off" placeholder="Username atau email ..">

			<label>Password</label>
            <input type="password" name="password" id="password" class="form_login" autocomplete="off" placeholder="Password ..">

            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me </label>

            <button type="submit" name="login" class="tombol_login">Login</button>

			<br/>
			<br/>
			<center>
				<a class="link" href="https://www.malasngoding.com">kembali</a>
			</center>
    <!-- <ul>
    <li>
        <label for="username">Username :</label>
        <input type="text" name="username" id="username">
    </li>
    <li>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password">
    </li>
    <li>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember Me </label>
    </li>
      <li>
        <button type="submit" name="login">Login</button>
      </li>    
    </ul> -->
</div>

</form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>