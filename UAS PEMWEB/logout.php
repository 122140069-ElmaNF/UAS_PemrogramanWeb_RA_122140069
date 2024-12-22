<?php
session_start();
require 'functions.php';

// Memanggil fungsi logout untuk menghapus sesi dan menghentikan sesi pengguna
logout();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="refresh" content="5;url=login.php">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - MowMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="text-center">
        <h1 class="text-success">Anda Telah Logout</h1>
        <p class="text-muted">Terima kasih! Silakan login kembali untuk melanjutkan.</p>
        <a href="login.php" class="btn btn-success">Login Kembali</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>