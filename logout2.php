<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: login.html");
    exit();
}

// Pengguna sudah login, dapatkan informasi pengguna
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <style>

    </style>
</head>
<body>

    
    <!-- Konten halaman beranda -->
    <br>

    <button id="logoutButton">Logout</button>

    <script>
        // Menangkap klik tombol logout
        document.getElementById('logoutButton').addEventListener('click', function() {
            // Menggunakan AJAX untuk memanggil logout.php
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'logout.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Redirect ke halaman login setelah logout
                    window.location.href = 'login.html';
                }
            };
            xhr.send();
        });
    </script>
</body>
</html>
