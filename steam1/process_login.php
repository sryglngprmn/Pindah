
<?php
session_start();
include 'config/database.php'; // Pastikan file ini menghubungkan ke database Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa email
    $query = "SELECT * FROM pegawai WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['nama']; // Simpan nama pengguna dalam sesi
            $_SESSION['role'] = $user['role']; // Simpan peran pengguna dalam sesi

            // Arahkan pengguna berdasarkan peran mereka
            if ($user['role'] == 'ADMIN') {
                header("Location: index.php");
            } elseif ($user['role'] == 'TEKNISI') {
                header("Location: kendaraan.php");
            } elseif ($user['role'] == 'KASIR') {
                header("Location: transaksi.php");
            } else {
                header("Location: login.php");
            }
            exit();
        } else {
            echo "<script>alert('Email atau password salah!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Email atau password salah!'); window.location.href='login.php';</script>";
    }
} else {
    header("Location: login.php");
    exit();
}
?>