<?php
session_start(); // Mulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: login.html");
    exit(); // Pastikan untuk keluar agar kode di bawahnya tidak dieksekusi setelah pengalihan header
}

// Pengguna sudah login, dapatkan nama pengguna dari sesi
$username = $_SESSION['username'];

// Sesuaikan konfigurasi database Anda
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "masuk2";

// Membuat koneksi ke database
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Memproses formulir jika data dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan teks komentar dari formulir
    $komentar = $_POST["komentar"];

    // Mendapatkan nama pengguna (anda bisa mengganti ini dengan sistem login yang sesungguhnya)
    $nama_pengguna = $username;  // Gantilah dengan cara yang sesuai dengan sistem login Anda.

    // Menyimpan data komentar ke database
    $sql = "INSERT INTO komentar (nama, komen) VALUES ('$nama_pengguna', '$komentar')";

    if ($conn->query($sql) === TRUE) {
        echo "Komentar berhasil disimpan.<br>";
        echo '<a href="beranda.php" style="text-decoration: none;">Kembali ke Beranda</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menutup koneksi ke database
$conn->close();
?>