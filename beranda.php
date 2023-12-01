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


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <style>
        /* Gaya CSS untuk menempatkan nama pengguna di pojok kanan atas */
        .username-container {
            position: fixed;
            top: 10px;
            right: 10px;
            font-weight: bold;
            font-size: 25px;
        }

        .form-wrapper {
 display: flex;
 justify-content: flex-end;
 align-items: center;
 height: 50vh;
 margin: 0;
}
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="username-container">Selamat datang, <a href="logout2.php"><?php echo $username; ?></a>!</div>
    <!-- Konten beranda lainnya di sini -->
    <div class="form-wrapper">
    <form action="bertanya.php" method="POST">
        <table>
            <tr>
                <td align="center"><label for="komentar">Masukan pertanyaan anda:</label></td>
            </tr>
            <tr>
                <td align="center"><textarea name="komentar" id="komentar" rows="5" cols="35" required></textarea></td>
            </tr>
            <tr>
                <td align="center"><button type="submit">Kirim</button></td>
            </tr>
        </table>
    </form>
    </div>
    <?php 
    echo "test"
    ?>
</body>
</html>
