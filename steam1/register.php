<?php
include 'config/database.php';
session_start();
 
if (isset($_SESSION['nama'])) {
    header("Location: index.php");
    exit();
}
 
// Inisialisasi variabel
$nama = '';
$email = '';

// Proses form jika ada data yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password =  $_POST['password'];
    $cpassword =  $_POST['confirm_password']; 
 
    if ($password == $cpassword) {
        // Hash password sebelum menyimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM pegawai WHERE email='$email'";
        $result = mysqli_query($db, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO pegawai (nama, email, password)
                    VALUES ('$nama', '$email', '$password')";
            $result = mysqli_query($db, $sql);
            if ($result) {
                echo "<script>alert('Selamat, pendaftaran berhasil!')</script>";
                $nama = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['confirm_password'] = "";
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Ups, email Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password tidak sesuai.')</script>";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
<div class="register-container text-center">
        <h3 class="mb-4"><strong>REGISTER ACCOUNT</strong></h3>
        <form action="" method="POST">
            <div class="input-group">
                <input type="text" placeholder="Nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Konfirmasi Password" name="confirm_password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn-register">Daftar</button>
            </div>
            <p class="text-center">Sudah punya akun? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>