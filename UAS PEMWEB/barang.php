<?php
session_start();

// Jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// Ambil data barang
$barang = query("SELECT * FROM barang");

// Tombol cari ditekan
if (isset($_POST["cari"])) {
    $barang = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="style/nav.css">

    <title>Barang MowMart</title>
</head>

<body>
<header>
        <nav class="navbar">
            <div class="container">
                <div class="nav-left">
                    <a class="navbar-brand" href="#">DAFTAR BARANG MOW MART</a>
                </div>
                <div class="nav-right">
                    <a href="index.php">Home</a>
                    <a href="barang.php">Barang</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container p-4">
        <div class="row">
            <div class="col mt-3">
                <form action="" method="post" class="d-flex " role="search">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Telusuri..." aria-label="Search" autocomplete="off" style="border: 3px solid #d87093;">
                    <button class="btn btn-outline-primary" name="cari" type="submit">Telusuri</button>
                </form>
            </div>

            <div class="col text-end mt-3">
                <a href="tambah.php">
                    <button type="button" class="btn btn-outline-success">Tambah data barang</button>
                </a>
            </div>

            <table class="table table-striped table-hover mt-3">
                <tr>
                    <th>No.</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Asal Barang</th>
                    <th>Jumlah Barang/dus</th>
                    <th>Jenis Barang</th>
                    <th>Aksi</th>
                </tr>

                <?php $i = 1; ?>
                <?php foreach ($barang as $row) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row["kode"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["asal"]; ?></td>
                        <td><?= $row["jumlah"]; ?></td>
                        <td><?= $row["jenis"]; ?></td>
                        <td>
                            <a class="text-decoration-none" href="ubah.php?id=<?= $row["id"]; ?>">
                                <button type="button" class="btn btn-outline-warning">UPDATE</button>
                            </a>
                            <a class="text-decoration-none" href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Anda yakin menghapus data ini?');">
                                <button type="button" class="btn btn-outline-danger">DELETE</button>
                            </a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>
