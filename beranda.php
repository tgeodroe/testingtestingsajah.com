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
            justify-content: center;
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
    <header style="">
        <nav>
            <img src="logoweb.png" width="5%%">
            <div class="username-container">Selamat datang, <a href="logout2.php"><?php echo $username; ?></a>!</div>
        </nav>
    </header>
    <center>
        
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
        <h3>Pertanyaan Terbaru</h3>
        <?php 
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

        // Menyusun query SQL untuk mengambil data dari kolom tertentu
        $sql = "SELECT id, nama, komen FROM komentar ORDER BY id DESC LIMIT 20";

        // Menjalankan query
        $result = $conn->query($sql);

        // Memeriksa apakah query berhasil dijalankan
        if ($result) {
            // Menampilkan hasil jika ada data
            if ($result->num_rows > 0) {
                echo "<table>";
                while ($row = $result->fetch_assoc()) {
                    $commentId = $row["id"];
                    $commentContent = $row["komen"];
                    
                    // Limit the display to 50 characters
                    $shortenedContent = strlen($commentContent) > 50 ? substr($commentContent, 0, 50) . "..." : $commentContent;
                    
                    // Output the table row with a link to reply and view responses
                    echo "<tr><td>" . $row["nama"] . ":</td><td>" . nl2br($shortenedContent) . "</td><td><a href=\"jawab.php?pertanyaan_id=$commentId\">Jawab</a></td><td><a href=\"responjawaban.php?question_id=$commentId\">Respon</a></td></tr>";
                }
                echo "</table>";
            } else {
                echo "Tidak ada data.";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi ke database
        $conn->close();
        ?>
    </center>
</body>
</html>