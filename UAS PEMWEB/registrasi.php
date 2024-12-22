<?php
session_start();
require 'functions.php';

$error = '';

// Menangani proses registrasi
if (isset($_POST["register"])) {
    // Ambil data dari form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    $nomor_hp = $_POST["nomor_hp"];

    // Validasi form
    if (empty($username) || empty($password) || empty($confirm_password) || empty($email) || empty($nomor_hp)) {
        $error = 'Semua field harus diisi!';
    } elseif ($password !== $confirm_password) {
        $error = 'Password dan konfirmasi password tidak cocok!';
    } else {
        // Panggil fungsi registrasi
        $data = [
            'username' => $username,
            'email' => $email,
            'nomor_hp' => $nomor_hp,
            'password' => $password,
            'confirm_password' => $confirm_password
        ];
        
        // Lakukan registrasi
        if (register($data) > 0) {
            // Redirect ke halaman login setelah registrasi berhasil
            header("Location: login.php");
            exit();
        } else {
            $error = 'Username sudah terdaftar!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - MowMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-success text-white">
                        <h3>Daftar Akun Baru</h3>
                        <p class="mb-0">Selamat datang di Mow Mart, isi form di bawah untuk membuat akun</p>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form action="registrasi.php" method="post" id="registrationForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_hp" class="form-label">Nomor HP</label>
                                <input type="tel" name="nomor_hp" id="nomor_hp" class="form-control" placeholder="Masukkan nomor HP Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Ulangi password Anda" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="register" class="btn btn-success">Daftar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Sudah punya akun? <a href="login.php" class="text-success">Login di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
