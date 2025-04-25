<?php
session_start();
include 'config/database.php'; // Pastikan file ini menghubungkan ke database Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa username
    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data pengguna dalam sesi
            $_SESSION['user'] = $user['username'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['level'] = $user['level'];

            // Pemetaan peran ke halaman
            $levelPages = [
                'superadmin' => 'index.php',
                'admin' => 'index.php',
                'user' => 'index.php'
            ];

            // Arahkan pengguna berdasarkan peran mereka
            $redirectPage = $levelPages[$user['level']] ?? 'login.php';

            // Simpan pesan SweetAlert ke dalam sesi
            $_SESSION['alert'] = [
                'title' => 'Login Berhasil!',
                'text' => "Selamat datang, {$user['nama']}!",
                'icon' => 'success',
                'redirect' => 'index.php'
            ];

            header("Location: $redirectPage");
            exit();
        } else {
            // Password salah
            $_SESSION['alert'] = [
                'title' => 'Login Gagal!',
                'text' => 'Username atau password salah.',
                'icon' => 'error',
                'redirect' => 'login.php'
            ];

            header("Location: login.php");
            exit();
        }
    } else {
        // Username tidak ditemukan
        $_SESSION['alert'] = [
            'title' => 'Login Gagal!',
            'text' => 'Username atau password salah.',
            'icon' => 'error',
            'redirect' => 'login.php'
        ];

        header("Location: login.php");
        exit();
    }
} else {
    // Jika bukan metode POST, arahkan ke halaman login
    header("Location: login.php");
    exit();
}
?>