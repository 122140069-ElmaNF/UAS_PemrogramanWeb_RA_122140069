<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "barang");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}  

function tambah($data) {
    global $conn;

    // Ambil data dari tiap elemen
    $kode = htmlspecialchars($data["kode"]);
    $nama = htmlspecialchars($data["nama"]);
    $asal = htmlspecialchars($data["asal"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $jenis = htmlspecialchars($data["jenis"]);

    // Query insert data
    $query = "INSERT INTO barang VALUES ('', '$kode', '$nama', '$asal', '$jumlah', '$jenis')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;

    // Validasi ID agar aman dari SQL injection
    $id = intval($id);

    // Query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM barang WHERE id = $id";

    // Eksekusi query
    mysqli_query($conn, $query);

    // Mengembalikan jumlah baris yang terpengaruh
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    // Ambil data dari tiap elemen
    $id = $data["id"];
    $kode = htmlspecialchars($data["kode"]);
    $nama = htmlspecialchars($data["nama"]);
    $asal = htmlspecialchars($data["asal"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $jenis = htmlspecialchars($data["jenis"]);

    // Query update data
    $query = "UPDATE barang SET
                kode = '$kode',
                nama = '$nama',
                asal = '$asal',
                jumlah = '$jumlah',
                jenis = '$jenis'
            WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM barang
                WHERE
            kode LIKE '%$keyword%' OR
            nama LIKE '%$keyword%' OR
            asal LIKE '%$keyword%' OR
            jenis LIKE '%$keyword%' OR
            jumlah LIKE '%$keyword%'";
    return query($query);
}

// Fungsi untuk menambah user (registrasi)
function register($data) {
    global $conn;

    // Ambil data dari tiap elemen
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $nomor_hp = htmlspecialchars($data["nomor_hp"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $data["confirm_password"]);

    // Validasi password
    if ($password !== $confirm_password) {
        return false;
    }

    // Enkripsi password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk mengecek apakah username sudah ada
    $result = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username'");

    if (mysqli_num_rows($result) > 0) {
        return false; // Username sudah ada
    }

    // Query untuk menambah data user ke dalam database
    $query = "INSERT INTO login (username, password, email, nomor_hp) 
              VALUES ('$username', '$password_hash', '$email', '$nomor_hp')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Fungsi untuk login
function login($username, $password) {
    global $conn;

    // Query untuk mengambil data berdasarkan username
    $result = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username'");

    // Cek apakah username ditemukan
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $row["password"])) {
            return $row; // Login berhasil
        }
    }

    return false; // Login gagal
}

// Fungsi untuk menangani proses logout
function logout() {
    // Hapus semua data sesi
    session_unset();
    session_destroy();

    // Hapus semua cookie
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 3600, '/'); // Hapus cookie dengan mengatur waktu kadaluwarsa
        }
    }
}

?>
