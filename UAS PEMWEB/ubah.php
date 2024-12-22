<?php

require 'functions.php';

// Ambil data di URL
$id = $_GET["id"];

// Query data barang berdasarkan id
$barang = query("SELECT * FROM barang WHERE id = $id")[0];

// Cek apakah tombol sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // Cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('DATA BERHASIL DIUBAH');
                document.location.href = 'barang.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('DATA GAGAL DIUBAH');
                document.location.href = 'barang.php';
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Barang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/ubah.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="row border rounded-3 p-3 shadow box-area">

            <h1 class="mb-3 text-white">Update Data Barang</h1>

            <form action="" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $barang["id"]; ?>">

                <div class="mb-3">
                    <label class="form-label" for="kode"> Kode Barang : </label>
                    <input class="form-control " type="text" name="kode" id="kode" value="<?= $barang['kode']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama"> Nama Barang : </label>
                    <input class="form-control" type="text" name="nama" id="nama" value="<?= $barang['nama']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="asal"> Asal Barang : </label>
                    <textarea class="form-control" type="text" name="asal" id="asal" required><?= $barang['asal']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="jumlah">Jumlah Barang/dus: </label> <br>
                    <input type="number" name="jumlah" id="jumlah" value="<?= $barang['jumlah']; ?>" min="1" placeholder=" " required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="jenis"> Jenis Barang : </label> <br>
                    <input type="radio" name="jenis" id="jenis1" value="Makanan" <?= $barang['jenis'] == 'Makanan' ? 'checked' : ''; ?> required>
                    <label for="jenis1">Makanan</label> <br>
                    <input type="radio" name="jenis" id="jenis2" value="Minuman" <?= $barang['jenis'] == 'Minuman' ? 'checked' : ''; ?> required>
                    <label for="jenis2">Minuman</label>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Update</button>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
