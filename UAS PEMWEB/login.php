<?php
session_start();
require 'functions.php';

$error = '';

// Jika cookie login ada dan valid
if (isset($_COOKIE['login']) && $_COOKIE['login'] === 'true') {
    $_SESSION['login'] = true;
    header("Location: index.php");
    exit();
}

// Menangani proses login
if (isset($_POST["login"])) {
    // Ambil data dari form
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Panggil fungsi login untuk validasi user
    $result = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username'");

    // Periksa apakah username ditemukan
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $row["password"])) {
            // Jika login berhasil, set session
            $_SESSION["login"] = true;

            // Periksa apakah opsi "Remember me" dipilih
            if (isset($_POST['remember'])) {
                // Set cookie untuk username dan sesi login
                setcookie('username', $username, time() + (86400 * 30), "/"); // Cookie berlaku 30 hari
                setcookie('login', 'true', time() + (86400 * 30), "/");
            }

            // Arahkan ke halaman index
            header("Location: index.php");
            exit();
        } else {
            $error = 'Password salah!';
        }
    } else {
        $error = 'Username tidak ditemukan!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MowMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/login.css">
</head>
<body>

    <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-header text-center">
            <h3>Selamat Datang di Mow Mart!</h3>
            <p class="mb-0">Silakan login terlebih dahulu</p>
        </div>
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="post" id="loginForm">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username Anda" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password Anda" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>
                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-success">Login</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <p>Belum punya akun? <a href="registrasi.php" class="text-success">Daftar di sini</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
